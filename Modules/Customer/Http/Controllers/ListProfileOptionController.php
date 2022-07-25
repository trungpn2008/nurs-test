<?php

namespace Modules\Customer\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\Customer\Entities\ChooseProfileCategory;
use Modules\Customer\Entities\ListProfileOption;
use Modules\Investigation\Entities\Investigation;
use Modules\Investigation\Entities\InvestigationType;

class ListProfileOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $chooseProfileCategory;
    private $listProfileOption;
    private $history_activity;
    function __construct()
    {
        $this->chooseProfileCategory = new ChooseProfileCategory();
        $this->listProfileOption = new ListProfileOption();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ListProfileOption']) || in_array('list-profile-option.index',isset($pemission['perms']['ListProfileOption'])?$pemission['perms']['ListProfileOption']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $listProfileOption = $this->listProfileOption->select(['list_profile_option.id','list_profile_option.title','list_profile_option.choose_category_id','chosse_profile_category.title as cate_title'])->whereOperator(new Operator('list_profile_option.deleted_at',null));
        if($request->keyword){
            $listProfileOption = $listProfileOption->whereOperator(new Operator('list_profile_option.name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $listProfileOption = $listProfileOption->join(new Operator(null,null,'chosse_profile_category','list_profile_option.choose_category_id','chosse_profile_category.id'));
        $listProfileOption = $listProfileOption->orderByDesc('list_profile_option.created_at')->paging($data['per_page'],$data['page'],false);
        $data['listProfileOption'] = $listProfileOption;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách list profile option','ListProfileOption','View','Tài khoản '.Auth::user()->name.' Xem danh sách list profile option','Mở xem Xem danh sách list profile option','Nomal');
        return view('customer::listProfileChoose.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ListProfileOption']) || in_array('list-profile-option.add',isset($pemission['perms']['ListProfileOption'])?$pemission['perms']['ListProfileOption']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm list profile option','ListProfileOption','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm list profile option','Vào trang thêm list profile option','Nomal');
        return view('customer::listProfileChoose.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ListProfileOption']) || in_array('list-profile-option.add',isset($pemission['perms']['ListProfileOption'])?$pemission['perms']['ListProfileOption']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $listProfileOption = $this->listProfileOption->insertData($data);
        if($listProfileOption){
            $this->history_activity->addHistory('Thêm list profile option thành công','ListProfileOption','Add','Tài khoản '.Auth::user()->name.' thêm list profile option thành công','Thêm list profile option','Success',$listProfileOption);
            return redirect()->route('admin.list-profile-option.index')->with('success','Thêm list profile option thành công');
        }
        $this->history_activity->addHistory('Thêm list profile option không thành công','ListProfileOption','Add','Tài khoản '.Auth::user()->name.' thêm list profile option không thành công','Thêm list profile option','Error');
        return back()->with('error','Thêm list profile option không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết list profile option','ListProfileOption','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết list profile option','Vào xem chi tiết list profile option','Nomal',$id);
        return view('investigation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ListProfileOption']) || in_array('list-profile-option.edit',isset($pemission['perms']['ListProfileOption'])?$pemission['perms']['ListProfileOption']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['listProfileOption'] = $this->listProfileOption->select(['list_profile_option.id','list_profile_option.title','list_profile_option.choose_category_id','chosse_profile_category.title as cate_title'])->whereOperator(new Operator('list_profile_option.id',$id))
            ->join(new Operator(null,null,'chosse_profile_category','list_profile_option.choose_category_id','chosse_profile_category.id'))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa list profile option','ListProfileOption','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa list profile option','Vào trang sửa list profile option','Nomal',$id);
        return view('customer::listProfileChoose.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ListProfileOption']) || in_array('list-profile-option.edit',isset($pemission['perms']['ListProfileOption'])?$pemission['perms']['ListProfileOption']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $listProfileOption = $this->listProfileOption->updateData($data,$id);
            if($listProfileOption){
                $this->history_activity->addHistory('Sửa list profile option thành công','ListProfileOption','Edit','Tài khoản '.Auth::user()->name.' Sửa list profile option thành công','sửa list profile option','Success',$id);
                return redirect()->route('admin.list-profile-option.index')->with('success','Sửa list profile option thành công');
            }
            $this->history_activity->addHistory('Sửa list profile option không thành công','ListProfileOption','Edit','Tài khoản '.Auth::user()->name.' Sửa list profile option không thành công','sửa list profile option','Error');
            return back()->with('error','Sửa list profile option không thành công');
        }
        $this->history_activity->addHistory('Sửa list profile option không tìm thấy bản ghi','ListProfileOption','Edit','Tài khoản '.Auth::user()->name.' Sửa list profile option không tìm thấy bản ghi','sửa list profile option không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ListProfileOption']) || in_array('list-profile-option.delete',isset($pemission['perms']['ListProfileOption'])?$pemission['perms']['ListProfileOption']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $listProfileOption = $this->listProfileOption->del(new Operator('id',$id));
            if($listProfileOption){
                $this->history_activity->addHistory('Xóa list profile option thành công','ListProfileOption','Delete','Tài khoản '.Auth::user()->name.' Xóa list profile option thành công','Xóa list profile option','Success',$id);
                return redirect()->route('admin.list-profile-option.index')->with('success','Xóa list profile option thành công');
            }
            $this->history_activity->addHistory('Xóa list profile option không thành công','ListProfileOption','Delete','Tài khoản '.Auth::user()->name.' Xóa list profile option không thành công','Xóa list profile option','Error');
            return back()->with('error','Xóa list profile option không thành công');
        }
        $this->history_activity->addHistory('Xóa list profile option không tìm thấy bản ghi','ListProfileOption','Delete','Tài khoản '.Auth::user()->name.' Xóa list profile option không tìm thấy bản ghi','Xóa list profile option không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listListProfileOption(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $listProfileOption = $this->listProfileOption->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $listProfileOption = $listProfileOption->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $listProfileOption = $listProfileOption->orderByDesc('created_at')->builder(false);
        return $this->responseAPI($listProfileOption,'Lấy dữ liệu thành công',200);
    }
}

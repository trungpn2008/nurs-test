<?php

namespace Modules\Customer\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\Customer\Entities\ChooseProfileCategory;
use Modules\Customer\Entities\ListProfileOption;

class ChooseProfileCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $chooseProfileCategory;
    private $listOption;
    private $history_activity;
    function __construct()
    {
        $this->chooseProfileCategory = new ChooseProfileCategory();
        $this->listOption = new ListProfileOption();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ChooseProfileCategory']) || in_array('choose-profile-category.index',isset($pemission['perms']['ChooseProfileCategory'])?$pemission['perms']['ChooseProfileCategory']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $chooseProfileCategory = $this->chooseProfileCategory->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $chooseProfileCategory = $chooseProfileCategory->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $chooseProfileCategory = $chooseProfileCategory->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['chooseProfileCategory'] = $chooseProfileCategory;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách choose profile category','ChooseProfileCategory','View','Tài khoản '.Auth::user()->name.' Xem danh sách choose profile category','Mở xem Xem danh sách choose profile category','Nomal');
        return view('customer::chooseProfileCategory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ChooseProfileCategory']) || in_array('choose-profile-category.add',isset($pemission['perms']['ChooseProfileCategory'])?$pemission['perms']['ChooseProfileCategory']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm choose profile category','ChooseProfileCategory','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm choose profile category','Vào trang thêm choose profile category','Nomal');
        return view('customer::chooseProfileCategory.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['ChooseProfileCategory']) || in_array('choose-profile-category.add',isset($pemission['perms']['ChooseProfileCategory'])?$pemission['perms']['ChooseProfileCategory']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['required'] = isset($data['required']) && $data['required'] =='on'?1:0;
        $data['status'] = isset($data['status']) && $data['status'] =='on'?1:0;
        $data['created_at'] = $data['updated_at'] =now();
        $chooseProfileCategory = $this->chooseProfileCategory->insertData($data);
        if($chooseProfileCategory){
            $this->history_activity->addHistory('Thêm choose profile category thành công','ChooseProfileCategory','Add','Tài khoản '.Auth::user()->name.' thêm choose profile category thành công','Thêm choose profile category','Success',$chooseProfileCategory);
            return redirect()->route('admin.choose-profile-category.index')->with('success','Thêm choose profile category thành công');
        }
        $this->history_activity->addHistory('Thêm choose profile category không thành công','ChooseProfileCategory','Add','Tài khoản '.Auth::user()->name.' thêm choose profile category không thành công','Thêm choose profile category','Error');
        return back()->with('error','Thêm choose profile category không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết choose profile category','ChooseProfileCategory','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết choose profile category','Vào xem chi tiết choose profile category','Nomal',$id);
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
        if((!isset($pemission['perms']['ChooseProfileCategory']) || in_array('choose-profile-category.edit',isset($pemission['perms']['ChooseProfileCategory'])?$pemission['perms']['ChooseProfileCategory']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['chooseProfileCategory'] = $this->chooseProfileCategory->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa choose profile category','ChooseProfileCategory','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa choose profile category','Vào trang sửa choose profile category','Nomal',$id);
        return view('customer::chooseProfileCategory.edit',$data);
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
        if((!isset($pemission['perms']['ChooseProfileCategory']) || in_array('choose-profile-category.edit',isset($pemission['perms']['ChooseProfileCategory'])?$pemission['perms']['ChooseProfileCategory']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['required'] = isset($data['required']) && $data['required'] =='on'?1:0;
        $data['status'] = isset($data['status']) && $data['status'] =='on'?1:0;
        $data['updated_at'] =now();
        if($id){
            $chooseProfileCategory = $this->chooseProfileCategory->updateData($data,$id);
            if($chooseProfileCategory){
                $this->history_activity->addHistory('Sửa choose profile category thành công','ChooseProfileCategory','Edit','Tài khoản '.Auth::user()->name.' Sửa choose profile category thành công','sửa choose profile category','Success',$id);
                return redirect()->route('admin.choose-profile-category.index')->with('success','Sửa choose profile category thành công');
            }
            $this->history_activity->addHistory('Sửa choose profile category không thành công','ChooseProfileCategory','Edit','Tài khoản '.Auth::user()->name.' Sửa choose profile category không thành công','sửa choose profile category','Error');
            return back()->with('error','Sửa choose profile category không thành công');
        }
        $this->history_activity->addHistory('Sửa choose profile category không tìm thấy bản ghi','ChooseProfileCategory','Edit','Tài khoản '.Auth::user()->name.' Sửa choose profile category không tìm thấy bản ghi','sửa choose profile category không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['ChooseProfileCategory']) || in_array('choose-profile-category.delete',isset($pemission['perms']['ChooseProfileCategory'])?$pemission['perms']['ChooseProfileCategory']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $chooseProfileCategory = $this->chooseProfileCategory->del(new Operator('id',$id));
            if($chooseProfileCategory){
                $this->history_activity->addHistory('Xóa choose profile category thành công','ChooseProfileCategory','Delete','Tài khoản '.Auth::user()->name.' Xóa choose profile category thành công','Xóa choose profile category','Success',$id);
                return redirect()->route('admin.choose-profile-category.index')->with('success','Xóa choose profile category thành công');
            }
            $this->history_activity->addHistory('Xóa choose profile category không thành công','ChooseProfileCategory','Delete','Tài khoản '.Auth::user()->name.' Xóa choose profile category không thành công','Xóa choose profile category','Error');
            return back()->with('error','Xóa choose profile category không thành công');
        }
        $this->history_activity->addHistory('Xóa choose profile category không tìm thấy bản ghi','ChooseProfileCategory','Delete','Tài khoản '.Auth::user()->name.' Xóa choose profile category không tìm thấy bản ghi','Xóa choose profile category không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function getChooseProfileCategory(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $chooseProfileCategory = $this->chooseProfileCategory->select(['id','title'])->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $chooseProfileCategory = $chooseProfileCategory->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $chooseProfileCategory = $chooseProfileCategory->orderByDesc('created_at')->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($chooseProfileCategory as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
    public function listChooseProfileCategory(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $chooseProfileCategory = $this->chooseProfileCategory->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $chooseProfileCategory = $chooseProfileCategory->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $chooseProfileCategory = $chooseProfileCategory->orderByDesc('created_at')->builder(false);
        return $this->responseAPI($chooseProfileCategory,'Lấy dữ liệu thành công',200);
    }
    public function detailChooseProfileCategory(Request $request)
    {
        $data=[];
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $nameInput = $request->input('code', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $chooseProfileCategory = $this->chooseProfileCategory->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('name_input',$nameInput));
        if($request->keyword){
            $chooseProfileCategory = $chooseProfileCategory->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $chooseProfileCategory = $chooseProfileCategory->orderByDesc('created_at')->builder();

        if($chooseProfileCategory){
            $data['category'] = $chooseProfileCategory;
            $listOption = $this->listOption->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('choose_category_id',$chooseProfileCategory->id))->builder(false);
            $data['content'] = $listOption;
        }
        return $this->responseAPI($data,'Lấy dữ liệu thành công',200);
    }
}

<?php

namespace Modules\Investigation\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\Investigation\Entities\Investigation;
use Modules\Investigation\Entities\InvestigationType;

class InvestigationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $investigation;
    private $investigationType;
    private $history_activity;
    function __construct()
    {
        $this->investigation = new Investigation();
        $this->investigationType = new InvestigationType();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['InvestigationType']) || in_array('investigation-type.index',isset($pemission['perms']['InvestigationType'])?$pemission['perms']['InvestigationType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $investigationType = $this->investigationType->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $investigationType = $investigationType->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $investigationType = $investigationType->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['investigationType'] = $investigationType;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách investigation type','InvestigationType','View','Tài khoản '.Auth::user()->name.' Xem danh sách investigation type','Mở xem Xem danh sách investigation type','Nomal');
        return view('investigation::type.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['InvestigationType']) || in_array('investigation-type.add',isset($pemission['perms']['InvestigationType'])?$pemission['perms']['InvestigationType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm investigation type','InvestigationType','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm investigation type','Vào trang thêm investigation type','Nomal');
        return view('investigation::type.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['InvestigationType']) || in_array('investigation-type.add',isset($pemission['perms']['InvestigationType'])?$pemission['perms']['InvestigationType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $investigationType = $this->investigationType->insertData($data);
        if($investigationType){
            $this->history_activity->addHistory('Thêm investigation type thành công','InvestigationType','Add','Tài khoản '.Auth::user()->name.' thêm investigation type thành công','Thêm investigation type','Success',$investigationType);
            return redirect()->route('admin.investigation-type.index')->with('success','Thêm investigation type thành công');
        }
        $this->history_activity->addHistory('Thêm investigation type không thành công','InvestigationType','Add','Tài khoản '.Auth::user()->name.' thêm investigation type không thành công','Thêm investigation type','Error');
        return back()->with('error','Thêm investigation type không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết investigation type','InvestigationType','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết investigation type','Vào xem chi tiết investigation type','Nomal',$id);
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
        if((!isset($pemission['perms']['InvestigationType']) || in_array('investigation-type.edit',isset($pemission['perms']['InvestigationType'])?$pemission['perms']['InvestigationType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['investigationType'] = $this->investigationType->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa investigation type','InvestigationType','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa investigation type','Vào trang sửa investigation type','Nomal',$id);
        return view('investigation::type.edit',$data);
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
        if((!isset($pemission['perms']['InvestigationType']) || in_array('investigation-type.edit',isset($pemission['perms']['InvestigationType'])?$pemission['perms']['InvestigationType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $investigationType = $this->investigationType->updateData($data,$id);
            if($investigationType){
                $this->history_activity->addHistory('Sửa investigation type thành công','InvestigationType','Edit','Tài khoản '.Auth::user()->name.' Sửa investigation type thành công','sửa investigation type','Success',$id);
                return redirect()->route('admin.investigation-type.index')->with('success','Sửa investigation type thành công');
            }
            $this->history_activity->addHistory('Sửa investigation type không thành công','InvestigationType','Edit','Tài khoản '.Auth::user()->name.' Sửa investigation type không thành công','sửa investigation type','Error');
            return back()->with('error','Sửa investigation type không thành công');
        }
        $this->history_activity->addHistory('Sửa investigation type không tìm thấy bản ghi','InvestigationType','Edit','Tài khoản '.Auth::user()->name.' Sửa investigation type không tìm thấy bản ghi','sửa investigation type không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['InvestigationType']) || in_array('investigation-type.delete',isset($pemission['perms']['InvestigationType'])?$pemission['perms']['InvestigationType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $investigationType = $this->investigationType->del(new Operator('id',$id));
            if($investigationType){
                $this->history_activity->addHistory('Xóa investigation type thành công','InvestigationType','Delete','Tài khoản '.Auth::user()->name.' Xóa investigation type thành công','Xóa investigation type','Success',$id);
                return redirect()->route('admin.investigation-type.index')->with('success','Xóa investigation type thành công');
            }
            $this->history_activity->addHistory('Xóa investigation type không thành công','InvestigationType','Delete','Tài khoản '.Auth::user()->name.' Xóa investigation type không thành công','Xóa investigation type','Error');
            return back()->with('error','Xóa investigation type không thành công');
        }
        $this->history_activity->addHistory('Xóa investigation type không tìm thấy bản ghi','InvestigationType','Delete','Tài khoản '.Auth::user()->name.' Xóa investigation type không tìm thấy bản ghi','Xóa investigation type không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listInvestigationType(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $investigationType = $this->investigationType->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $investigationType = $investigationType->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $investigationType = $investigationType->orderByDesc('created_at')->builder(false);
        return $this->responseAPI($investigationType,'Lấy dữ liệu thành công',200);
    }
}

<?php

namespace Modules\QA\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\QA\Entities\QA;

class QAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $qa;
    private $history_activity;
    function __construct()
    {
        $this->qa = new QA();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QA']) || in_array('qa.index',isset($pemission['perms']['QA'])?$pemission['perms']['QA']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $qa = $this->qa->select(['qa.id','qa.title','qa.content','qa.status','qa.customer_id','qa_cate.title as qa_cate_title','qa_type.title as qa_type_title'])->whereOperator(new Operator('qa.deleted_at',null))
            ->join([
                new Operator(null,null,'qa_cate','qa.qa_cate','qa_cate.id'),
                new Operator(null,null,'qa_type','qa.qa_type','qa_type.id'),
                new Operator(null,null,'customer','qa.customer_id','customer.id'),
            ])
        ;
        if($request->keyword){
            $qa = $qa->whereOperator(new Operator('qa.name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $qa = $qa->orderByDesc('qa.created_at')->paging($data['per_page'],$data['page'],false);
        $data['qa'] = $qa;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách QA','QA','View','Tài khoản '.Auth::user()->name.' Xem danh sách QA','Mở xem Xem danh sách QA','Nomal');
        return view('qa::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QA']) || in_array('qa.add',isset($pemission['perms']['QA'])?$pemission['perms']['QA']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm QA','QA','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm QA','Vào trang thêm QA','Nomal');
        return view('qa::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QA']) || in_array('qa.add',isset($pemission['perms']['QA'])?$pemission['perms']['QA']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $qa = $this->qa->insertData($data);
        if($qa){
            $this->history_activity->addHistory('Thêm QA thành công','QA','Add','Tài khoản '.Auth::user()->name.' thêm QA thành công','Thêm QA','Success',$qa);
            return redirect()->route('admin.qa.index')->with('success','Thêm QA thành công');
        }
        $this->history_activity->addHistory('Thêm QA không thành công','QA','Add','Tài khoản '.Auth::user()->name.' thêm QA không thành công','Thêm QA','Error');
        return back()->with('error','Thêm QA không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết QA','QA','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết QA','Vào xem chi tiết QA','Nomal',$id);
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
        if((!isset($pemission['perms']['QA']) || in_array('qa.edit',isset($pemission['perms']['QA'])?$pemission['perms']['QA']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['qa'] = $this->qa->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa QA','QA','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa QA','Vào trang sửa QA','Nomal',$id);
        return view('qa::edit',$data);
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
        if((!isset($pemission['perms']['QA']) || in_array('qa.edit',isset($pemission['perms']['QA'])?$pemission['perms']['QA']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $qa = $this->qa->updateData($data,$id);
            if($qa){
                $this->history_activity->addHistory('Sửa QA thành công','QA','Edit','Tài khoản '.Auth::user()->name.' Sửa QA thành công','sửa QA','Success',$id);
                return redirect()->route('admin.qa.index')->with('success','Sửa QA thành công');
            }
            $this->history_activity->addHistory('Sửa QA không thành công','QA','Edit','Tài khoản '.Auth::user()->name.' Sửa QA không thành công','sửa QA','Error');
            return back()->with('error','Sửa QA không thành công');
        }
        $this->history_activity->addHistory('Sửa QA không tìm thấy bản ghi','QA','Edit','Tài khoản '.Auth::user()->name.' Sửa QA không tìm thấy bản ghi','sửa QA không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['QA']) || in_array('qa.delete',isset($pemission['perms']['QA'])?$pemission['perms']['QA']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $qa = $this->qa->del(new Operator('id',$id));
            if($qa){
                $this->history_activity->addHistory('Xóa QA thành công','QA','Delete','Tài khoản '.Auth::user()->name.' Xóa QA thành công','Xóa QA','Success',$id);
                return redirect()->route('admin.qa.index')->with('success','Xóa QA thành công');
            }
            $this->history_activity->addHistory('Xóa QA không thành công','QA','Delete','Tài khoản '.Auth::user()->name.' Xóa QA không thành công','Xóa QA','Error');
            return back()->with('error','Xóa QA không thành công');
        }
        $this->history_activity->addHistory('Xóa QA không tìm thấy bản ghi','QA','Delete','Tài khoản '.Auth::user()->name.' Xóa QA không tìm thấy bản ghi','Xóa QA không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listQA(Request $request)
    {
        $data['per_page'] = $request->input('per_page',6);
        $data['page'] = $request->input('page',1);
        $qa = $this->qa->select(['qa.id','qa.title','qa.content','qa.status','qa.customer_id','qa_cate.title as qa_cate_title','qa_type.title as qa_type_title'])->whereOperator(new Operator('qa.deleted_at',null))
            ->join([
                new Operator(null,null,'qa_cate','qa.qa_cate','qa_cate.id'),
                new Operator(null,null,'qa_type','qa.qa_type','qa_type.id'),
                new Operator(null,null,'customer','qa.customer_id','customer.id'),
            ])
        ;
        if($request->keyword){
            $qa = $qa->whereOperator(new Operator('qa.name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $qa = $qa->orderByDesc('qa.created_at')->paging($data['per_page'],$data['page'],false);
        return $this->responseAPI($qa,'Lấy dữ liệu thành công',200);
    }
    public function AddQa(Request $request)
    {
        $data = $request->all();
        if(!$data['title']){
            return $this->responseAPI([],'Vui lòng điền title',500);
        }
        if(!$data['qa_type']){
            return $this->responseAPI([],'Vui lòng điền type',500);
        }
        if(!$data['qa_cate']){
            return $this->responseAPI([],'Vui lòng điền qa_cate',500);
        }
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $qa = $this->qa->insertData($data);
        if($qa){
            $this->history_activity->addHistory('Thêm investigation thành công','Investigation','Add','Guest thêm investigation thành công','Thêm investigation','Success',$qa);
            return $this->responseAPI($qa,'Thêm dữ liệu thành công',200);
        }
        $this->history_activity->addHistory('Thêm investigation không thành công','Investigation','Add','Guest thêm investigation không thành công','Thêm investigation','Error');
        return $this->responseAPI([],'Thêm dữ liệu không thành công',500);
    }
}

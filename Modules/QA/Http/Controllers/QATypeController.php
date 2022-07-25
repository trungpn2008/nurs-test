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
use Modules\QA\Entities\QAType;

class QATypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $qaType;
    private $history_activity;
    function __construct()
    {
        $this->qaType = new QAType();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QAType']) || in_array('qa-type.index',isset($pemission['perms']['QAType'])?$pemission['perms']['QAType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $qaType = $this->qaType->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $qaType = $qaType->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $qaType = $qaType->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['qaType'] = $qaType;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách QA Type','QAType','View','Tài khoản '.Auth::user()->name.' Xem danh sách QA Type','Mở xem Xem danh sách QA Type','Nomal');
        return view('qa::qaType.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QAType']) || in_array('qa-type.add',isset($pemission['perms']['QAType'])?$pemission['perms']['QAType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm QA Type','QAType','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm QA Type','Vào trang thêm QA Type','Nomal');
        return view('qa::qaType.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QAType']) || in_array('qa-type.add',isset($pemission['perms']['QAType'])?$pemission['perms']['QAType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $qaType = $this->qaType->insertData($data);
        if($qaType){
            $this->history_activity->addHistory('Thêm QA Type thành công','QAType','Add','Tài khoản '.Auth::user()->name.' thêm QA Type thành công','Thêm QA Type','Success',$qaType);
            return redirect()->route('admin.qa-type.index')->with('success','Thêm QA Type thành công');
        }
        $this->history_activity->addHistory('Thêm QA Type không thành công','QAType','Add','Tài khoản '.Auth::user()->name.' thêm QA Type không thành công','Thêm QA Type','Error');
        return back()->with('error','Thêm QA Type không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết QA Type','QAType','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết QA Type','Vào xem chi tiết QA Type','Nomal',$id);
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
        if((!isset($pemission['perms']['QAType']) || in_array('qa-type.edit',isset($pemission['perms']['QAType'])?$pemission['perms']['QAType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['qaType'] = $this->qaType->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa QA Type','QAType','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa QA Type','Vào trang sửa QA Type','Nomal',$id);
        return view('qa::qaType.edit',$data);
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
        if((!isset($pemission['perms']['QAType']) || in_array('qa-type.edit',isset($pemission['perms']['QAType'])?$pemission['perms']['QAType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $qaType = $this->qaType->updateData($data,$id);
            if($qaType){
                $this->history_activity->addHistory('Sửa QA Type thành công','QAType','Edit','Tài khoản '.Auth::user()->name.' Sửa QA Type thành công','sửa QA Type','Success',$id);
                return redirect()->route('admin.qa-type.index')->with('success','Sửa QA Type thành công');
            }
            $this->history_activity->addHistory('Sửa QA Type không thành công','QAType','Edit','Tài khoản '.Auth::user()->name.' Sửa QA Type không thành công','sửa QA Type','Error');
            return back()->with('error','Sửa QA Type không thành công');
        }
        $this->history_activity->addHistory('Sửa QA Type không tìm thấy bản ghi','QAType','Edit','Tài khoản '.Auth::user()->name.' Sửa QA Type không tìm thấy bản ghi','sửa QA Type không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['QAType']) || in_array('qa-type.delete',isset($pemission['perms']['QAType'])?$pemission['perms']['QAType']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $qaType = $this->qaType->del(new Operator('id',$id));
            if($qaType){
                $this->history_activity->addHistory('Xóa QA Type thành công','QAType','Delete','Tài khoản '.Auth::user()->name.' Xóa QA Type thành công','Xóa QA Type','Success',$id);
                return redirect()->route('admin.qa-type.index')->with('success','Xóa QA Type thành công');
            }
            $this->history_activity->addHistory('Xóa QA Type không thành công','QAType','Delete','Tài khoản '.Auth::user()->name.' Xóa QA Type không thành công','Xóa QA Type','Error');
            return back()->with('error','Xóa QA Type không thành công');
        }
        $this->history_activity->addHistory('Xóa QA Type không tìm thấy bản ghi','QAType','Delete','Tài khoản '.Auth::user()->name.' Xóa QA Type không tìm thấy bản ghi','Xóa QA Type không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function getQaType(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $qaType = $this->qaType->select(['id','title'])->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $qaType = $qaType->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $qaType = $qaType->orderByDesc('created_at')->build(false);
        $data = [];
        foreach ($qaType as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }

    public function listQaType(Request $request)
    {
        $data['per_page'] = $request->input('per_page',3);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $qaType = $this->qaType->select(['id','title'])->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $qaType = $qaType->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $qaType = $qaType->orderByDesc('created_at')->builder(false);
        return $this->responseAPI($qaType,'Lấy dữ liệu thành công',200);
    }
}

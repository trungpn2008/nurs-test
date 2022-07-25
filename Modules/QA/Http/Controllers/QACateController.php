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
use Modules\QA\Entities\QACate;

class QACateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $qaCate;
    private $history_activity;
    function __construct()
    {
        $this->qaCate = new QACate();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QACate']) || in_array('qa-cate.index',isset($pemission['perms']['QACate'])?$pemission['perms']['QACate']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $qaCate = $this->qaCate->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $qaCate = $qaCate->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $qaCate = $qaCate->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['qaCate'] = $qaCate;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách QA Category','QACate','View','Tài khoản '.Auth::user()->name.' Xem danh sách QA Category','Mở xem Xem danh sách QA Category','Nomal');
        return view('qa::qaCate.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QACate']) || in_array('qa-cate.add',isset($pemission['perms']['QACate'])?$pemission['perms']['QACate']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm QA Category','QACate','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm QA Category','Vào trang thêm QA Category','Nomal');
        return view('qa::qaCate.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['QACate']) || in_array('qa-cate.add',isset($pemission['perms']['QACate'])?$pemission['perms']['QACate']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $qaCate = $this->qaCate->insertData($data);
        if($qaCate){
            $this->history_activity->addHistory('Thêm QA Category thành công','QACate','Add','Tài khoản '.Auth::user()->name.' thêm QA Category thành công','Thêm QA Category','Success',$qaCate);
            return redirect()->route('admin.qa-cate.index')->with('success','Thêm QA Category thành công');
        }
        $this->history_activity->addHistory('Thêm QA Category không thành công','QACate','Add','Tài khoản '.Auth::user()->name.' thêm QA Category không thành công','Thêm QA Category','Error');
        return back()->with('error','Thêm QA Category không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết QA Category','QACate','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết QA Category','Vào xem chi tiết QA Category','Nomal',$id);
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
        if((!isset($pemission['perms']['QACate']) || in_array('qa-cate.edit',isset($pemission['perms']['QACate'])?$pemission['perms']['QACate']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['qaCate'] = $this->qaCate->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa QA Category','QACate','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa QA Category','Vào trang sửa QA Category','Nomal',$id);
        return view('qa::qaCate.edit',$data);
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
        if((!isset($pemission['perms']['QACate']) || in_array('qa-cate.edit',isset($pemission['perms']['QACate'])?$pemission['perms']['QACate']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $qaCate = $this->qaCate->updateData($data,$id);
            if($qaCate){
                $this->history_activity->addHistory('Sửa QA Category thành công','QACate','Edit','Tài khoản '.Auth::user()->name.' Sửa QA Category thành công','sửa QA Category','Success',$id);
                return redirect()->route('admin.qa-cate.index')->with('success','Sửa QA Category thành công');
            }
            $this->history_activity->addHistory('Sửa QA Category không thành công','QACate','Edit','Tài khoản '.Auth::user()->name.' Sửa QA Category không thành công','sửa QA Category','Error');
            return back()->with('error','Sửa QA Category không thành công');
        }
        $this->history_activity->addHistory('Sửa QA Category không tìm thấy bản ghi','QACate','Edit','Tài khoản '.Auth::user()->name.' Sửa QA Category không tìm thấy bản ghi','sửa QA Category không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['QACate']) || in_array('qa-cate.delete',isset($pemission['perms']['QACate'])?$pemission['perms']['QACate']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $qaCate = $this->qaCate->del(new Operator('id',$id));
            if($qaCate){
                $this->history_activity->addHistory('Xóa QA Category thành công','QACate','Delete','Tài khoản '.Auth::user()->name.' Xóa QA Category thành công','Xóa QA Category','Success',$id);
                return redirect()->route('admin.qa-cate.index')->with('success','Xóa QA Category thành công');
            }
            $this->history_activity->addHistory('Xóa QA Category không thành công','QACate','Delete','Tài khoản '.Auth::user()->name.' Xóa QA Category không thành công','Xóa QA Category','Error');
            return back()->with('error','Xóa QA Category không thành công');
        }
        $this->history_activity->addHistory('Xóa QA Category không tìm thấy bản ghi','QACate','Delete','Tài khoản '.Auth::user()->name.' Xóa QA Category không tìm thấy bản ghi','Xóa QA Category không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function getQaCate(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $qaCate = $this->qaCate->select(['id','title'])->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $qaCate = $qaCate->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $qaCate = $qaCate->orderByDesc('created_at')->build(false);
        $data = [];
        foreach ($qaCate as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
    public function listQaCate(Request $request)
    {
        $data['per_page'] = $request->input('per_page',3);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $qaCate = $this->qaCate->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $qaCate = $qaCate->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $qaCate = $qaCate->orderByDesc('news.created_at')->builder(false);
        return $this->responseAPI($qaCate,'Lấy dữ liệu thành công',200);
    }
}

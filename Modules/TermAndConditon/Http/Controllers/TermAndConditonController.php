<?php

namespace Modules\TermAndConditon\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\TermAndConditon\Entities\TermAndCondition;
use Modules\TermAndConditon\Entities\TermAndConditionCategory;

class TermAndConditonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $termAndCondition;
    private $termAndConditionCategory;
    private $history_activity;
    function __construct()
    {
        $this->termAndCondition = new TermAndCondition();
        $this->termAndConditionCategory = new TermAndConditionCategory();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndCondition']) || in_array('term-and-condition.index',isset($pemission['perms']['TermAndCondition'])?$pemission['perms']['TermAndCondition']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $termAndCondition = $this->termAndCondition->select(['termandcondition.title','termandcondition.id','termandconditioncategory.title as title_cate'])->whereOperator(new Operator('termandcondition.deleted_at',null));
        if($request->keyword){
            $termAndCondition = $termAndCondition->whereOperator(new Operator('termandcondition.question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $termAndCondition = $termAndCondition->join(new Operator(null,null,'termandconditioncategory','termandcondition.category_id','termandconditioncategory.id'));
        $termAndCondition = $termAndCondition->orderByDesc('termandcondition.created_at')->paging($data['per_page'],$data['page'],false);
        $data['termAndCondition'] = $termAndCondition;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách Term And Condition','TermAndCondition','View','Tài khoản '.Auth::user()->name.' Xem danh sách Term And Condition','Mở xem Xem danh sách Term And Condition','Nomal');
        return view('termandconditon::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndCondition']) || in_array('term-and-condition.add',isset($pemission['perms']['TermAndCondition'])?$pemission['perms']['TermAndCondition']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm Term And Condition','TermAndCondition','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm Term And Condition','Vào trang thêm Term And Condition','Nomal');
        return view('termandconditon::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndCondition']) || in_array('term-and-condition.add',isset($pemission['perms']['TermAndCondition'])?$pemission['perms']['TermAndCondition']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $termAndCondition = $this->termAndCondition->insertData($data);
        if($termAndCondition){
            $this->history_activity->addHistory('Thêm Term And Condition thành công','TermAndCondition','Add','Tài khoản '.Auth::user()->name.' thêm Term And Condition thành công','Thêm Term And Condition','Success',$termAndCondition);
            return redirect()->route('admin.term-and-condition.index')->with('success','Thêm Term And Condition thành công');
        }
        $this->history_activity->addHistory('Thêm Term And Condition không thành công','TermAndCondition','Add','Tài khoản '.Auth::user()->name.' thêm Term And Condition không thành công','Thêm Term And Condition','Error');
        return back()->with('error','Thêm Term And Condition không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết Term And Condition','TermAndCondition','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết Term And Condition','Vào xem chi tiết Term And Condition','Nomal',$id);
        return view('termandconditon::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndCondition']) || in_array('term-and-condition.edit',isset($pemission['perms']['TermAndCondition'])?$pemission['perms']['TermAndCondition']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['termAndCondition'] = $this->termAndCondition->select(['termandcondition.title','termandcondition.content','termandcondition.category_id','termandcondition.id','termandconditioncategory.title as title_cate'])->whereOperator(new Operator('termandcondition.id',$id))
            ->join(new Operator(null,null,'termandconditioncategory','termandcondition.category_id','termandconditioncategory.id'))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa Term And Condition','TermAndCondition','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa Term And Condition','Vào trang sửa Term And Condition','Nomal',$id);
        return view('termandconditon::edit',$data);
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
        if((!isset($pemission['perms']['TermAndCondition']) || in_array('term-and-condition.edit',isset($pemission['perms']['TermAndCondition'])?$pemission['perms']['TermAndCondition']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $termAndCondition = $this->termAndCondition->updateData($data,$id);
            if($termAndCondition){
                $this->history_activity->addHistory('Sửa Term And Condition thành công','TermAndCondition','Edit','Tài khoản '.Auth::user()->name.' Sửa Term And Condition thành công','sửa Term And Condition','Success',$id);
                return redirect()->route('admin.term-and-condition.index')->with('success','Sửa Term And Condition thành công');
            }
            $this->history_activity->addHistory('Sửa Term And Condition không thành công','TermAndCondition','Edit','Tài khoản '.Auth::user()->name.' Sửa Term And Condition không thành công','sửa Term And Condition','Error');
            return back()->with('error','Sửa Term And Condition không thành công');
        }
        $this->history_activity->addHistory('Sửa Term And Condition không tìm thấy bản ghi','TermAndCondition','Edit','Tài khoản '.Auth::user()->name.' Sửa Term And Condition không tìm thấy bản ghi','sửa Term And Condition không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['TermAndCondition']) || in_array('term-and-condition.delete',isset($pemission['perms']['TermAndCondition'])?$pemission['perms']['TermAndCondition']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $termAndCondition = $this->termAndCondition->del(new Operator('id',$id));
            if($termAndCondition){
                $this->history_activity->addHistory('Xóa Term And Condition thành công','TermAndCondition','Delete','Tài khoản '.Auth::user()->name.' Xóa Term And Condition thành công','Xóa Term And Condition','Success',$id);
                return redirect()->route('admin.term-and-condition.index')->with('success','Xóa Term And Condition thành công');
            }
            $this->history_activity->addHistory('Xóa Term And Condition không thành công','TermAndCondition','Delete','Tài khoản '.Auth::user()->name.' Xóa Term And Condition không thành công','Xóa Term And Condition','Error');
            return back()->with('error','Xóa Term And Condition không thành công');
        }
        $this->history_activity->addHistory('Xóa Term And Condition không tìm thấy bản ghi','TermAndCondition','Delete','Tài khoản '.Auth::user()->name.' Xóa Term And Condition không tìm thấy bản ghi','Xóa Term And Condition không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listTernCondition(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $termAndCondition = $this->termAndCondition->select(['termandcondition.answer','termandcondition.question','termandcondition.id','termandconditioncategory.title'])->whereOperator(new Operator('termandcondition.deleted_at',null));
        if($request->keyword){
            $termAndCondition = $termAndCondition->whereOperator(new Operator('termandcondition.question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $termAndCondition = $termAndCondition->join(new Operator(null,null,'termandconditioncategory','termandcondition.category_id','termandconditioncategory.id'));
        $termAndCondition = $termAndCondition->orderByDesc('termandcondition.created_at')->paging($size,$page,false);
        return $this->responseAPI($termAndCondition,'Lấy dữ liệu thành công',200);
    }
    public function getTernAndConditionCategory(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $termAndConditionCategory = $this->termAndConditionCategory->select(['id','title'])->whereOperator(new Operator('deleted_at',null));
        if ($keyword) {
            $termAndConditionCategory = $termAndConditionCategory->whereOperator([new Operator('title','%'.$keyword.'%',null,null,null,null,'like')]);
        }
        $termAndConditionCategory = $termAndConditionCategory->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($termAndConditionCategory as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
}

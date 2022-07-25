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

class TermAndConditonCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $termAndConditionCategory;
    private $termAndConditionCategoryCategory;
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
        if((!isset($pemission['perms']['TermAndConditionCategories']) || in_array('term-and-condition-category.index',isset($pemission['perms']['TermAndConditionCategories'])?$pemission['perms']['TermAndConditionCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $termAndConditionCategory = $this->termAndConditionCategory->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $termAndConditionCategory = $termAndConditionCategory->whereOperator(new Operator('question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $termAndConditionCategory = $termAndConditionCategory->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['termAndConditionCategories'] = $termAndConditionCategory;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách Term And Condition Category','TermAndConditionCategories','View','Tài khoản '.Auth::user()->name.' Xem danh sách Term And Condition Category','Mở xem Xem danh sách Term And Condition Category','Nomal');
        return view('termandconditon::category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndConditionCategories']) || in_array('term-and-condition-category.add',isset($pemission['perms']['TermAndConditionCategories'])?$pemission['perms']['TermAndConditionCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm Term And Condition Category','TermAndConditionCategories','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm Term And Condition Category','Vào trang thêm Term And Condition Category','Nomal');
        return view('termandconditon::category.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndConditionCategories']) || in_array('term-and-condition-category.add',isset($pemission['perms']['TermAndConditionCategories'])?$pemission['perms']['TermAndConditionCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $termAndConditionCategory = $this->termAndConditionCategory->insertData($data);
        if($termAndConditionCategory){
            $this->history_activity->addHistory('Thêm Term And Condition Category thành công','TermAndConditionCategories','Add','Tài khoản '.Auth::user()->name.' thêm Term And Condition Category thành công','Thêm Term And Condition Category','Success',$termAndConditionCategory);
            return redirect()->route('admin.term-and-condition-category.index')->with('success','Thêm Term And Condition Category thành công');
        }
        $this->history_activity->addHistory('Thêm Term And Condition Category không thành công','TermAndConditionCategories','Add','Tài khoản '.Auth::user()->name.' thêm Term And Condition Category không thành công','Thêm Term And Condition Category','Error');
        return back()->with('error','Thêm Term And Condition Category không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết Term And Condition Category','TermAndConditionCategories','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết Term And Condition Category','Vào xem chi tiết Term And Condition Category','Nomal',$id);
        return view('termandconditon::category.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['TermAndConditionCategories']) || in_array('term-and-condition-category.edit',isset($pemission['perms']['TermAndConditionCategories'])?$pemission['perms']['TermAndConditionCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['termAndConditionCategory'] = $this->termAndConditionCategory->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa Term And Condition Category','TermAndConditionCategories','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa Term And Condition Category','Vào trang sửa Term And Condition Category','Nomal',$id);
        return view('termandconditon::category.edit',$data);
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
        if((!isset($pemission['perms']['TermAndConditionCategories']) || in_array('term-and-condition-category.edit',isset($pemission['perms']['TermAndConditionCategories'])?$pemission['perms']['TermAndConditionCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $termAndConditionCategory = $this->termAndConditionCategory->updateData($data,$id);
            if($termAndConditionCategory){
                $this->history_activity->addHistory('Sửa Term And Condition Category thành công','TermAndConditionCategories','Edit','Tài khoản '.Auth::user()->name.' Sửa Term And Condition Category thành công','sửa Term And Condition Category','Success',$id);
                return redirect()->route('admin.term-and-condition-category.index')->with('success','Sửa Term And Condition Category thành công');
            }
            $this->history_activity->addHistory('Sửa Term And Condition Category không thành công','TermAndConditionCategories','Edit','Tài khoản '.Auth::user()->name.' Sửa Term And Condition Category không thành công','sửa Term And Condition Category','Error');
            return back()->with('error','Sửa Term And Condition Category không thành công');
        }
        $this->history_activity->addHistory('Sửa Term And Condition Category không tìm thấy bản ghi','TermAndConditionCategories','Edit','Tài khoản '.Auth::user()->name.' Sửa Term And Condition Category không tìm thấy bản ghi','sửa Term And Condition Category không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['TermAndConditionCategories']) || in_array('term-and-condition-category.delete',isset($pemission['perms']['TermAndConditionCategories'])?$pemission['perms']['TermAndConditionCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $termAndConditionCategory = $this->termAndConditionCategory->del(new Operator('id',$id));
            if($termAndConditionCategory){
                $this->history_activity->addHistory('Xóa Term And Condition Category thành công','TermAndConditionCategories','Delete','Tài khoản '.Auth::user()->name.' Xóa Term And Condition Category thành công','Xóa Term And Condition Category','Success',$id);
                return redirect()->route('admin.term-and-condition-category.index')->with('success','Xóa Term And Condition Category thành công');
            }
            $this->history_activity->addHistory('Xóa Term And Condition Category không thành công','TermAndConditionCategories','Delete','Tài khoản '.Auth::user()->name.' Xóa Term And Condition Category không thành công','Xóa Term And Condition Category','Error');
            return back()->with('error','Xóa Term And Condition Category không thành công');
        }
        $this->history_activity->addHistory('Xóa Term And Condition Category không tìm thấy bản ghi','TermAndConditionCategories','Delete','Tài khoản '.Auth::user()->name.' Xóa Term And Condition Category không tìm thấy bản ghi','Xóa Term And Condition Category không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listTernConditionCategory(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $termAndConditionCategory = $this->termAndConditionCategory->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $termAndConditionCategory = $termAndConditionCategory->whereOperator(new Operator('question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $termAndConditionCategory = $termAndConditionCategory->orderByDesc('created_at')->builder(false);
        return $this->responseAPI($termAndConditionCategory,'Lấy dữ liệu thành công',200);
    }
    public function detailTernConditionCategory(Request $request,$id)
    {
        $data=[];
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $termAndConditionCategory = $this->termAndConditionCategory->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('id',$id));
        if($request->keyword){
            $termAndConditionCategory = $termAndConditionCategory->whereOperator(new Operator('question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $termAndConditionCategory = $termAndConditionCategory->orderByDesc('created_at')->builder();

        if($termAndConditionCategory){
            $data['category'] = $termAndConditionCategory;
            $termAndCondition = $this->termAndCondition->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('category_id',$id))->builder(false);
            $data['content'] = $termAndCondition;
        }
        return $this->responseAPI($data,'Lấy dữ liệu thành công',200);
    }
}

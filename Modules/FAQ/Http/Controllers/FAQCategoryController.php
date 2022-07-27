<?php

namespace Modules\FAQ\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\FAQ\Entities\Faq;
use Modules\FAQ\Entities\FaqCategory;

class FAQCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $faq;
    private $faq_cate;
    private $history_activity;
    function __construct()
    {
        $this->faq = new Faq();
        $this->faq_cate = new FaqCategory();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['FaqCategories']) || in_array('faqcates.index',isset($pemission['perms']['FaqCategories'])?$pemission['perms']['FaqCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $faqCategories = $this->faq_cate->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $faqCategories = $faqCategories->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $faqCategories = $faqCategories->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['faqCategories'] = $faqCategories;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách Faq category','FaqCategories','View','Tài khoản '.Auth::user()->name.' Xem danh sách Faq category','Mở xem Xem danh sách Faq category','Nomal');
        return view('faq::faqCategory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['FaqCategories']) || in_array('faqcates.add',isset($pemission['perms']['FaqCategories'])?$pemission['perms']['FaqCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm Faq category','FaqCategories','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm Faq category','Vào trang thêm Faq category','Nomal');
        return view('faq::faqCategory.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['FaqCategories']) || in_array('faqcates.add',isset($pemission['perms']['FaqCategories'])?$pemission['perms']['FaqCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $faq_categories = $this->faq_cate->insertData($data);
        if($faq_categories){
            $this->history_activity->addHistory('Thêm Faq category thành công','FaqCategories','Add','Tài khoản '.Auth::user()->name.' thêm Faq category thành công','Thêm Faq category','Success',$faq_categories);
            return redirect()->route('admin.faqcates.index')->with('success','Thêm Faq category thành công');
        }
        $this->history_activity->addHistory('Thêm Faq category không thành công','FaqCategories','Add','Tài khoản '.Auth::user()->name.' thêm Faq category không thành công','Thêm Faq category','Error');
        return back()->with('error','Thêm Faq category không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết Faq category','FaqCategories','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết Faq category','Vào xem chi tiết Faq category','Nomal',$id);
        return view('faq::faqCategory.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['FaqCategories']) || in_array('faqcates.edit',isset($pemission['perms']['FaqCategories'])?$pemission['perms']['FaqCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['faqCategories'] = $this->faq_cate->whereOperator(new Operator('id',$id))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa Faq category','FaqCategories','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa Faq category','Vào trang sửa Faq category','Nomal',$id);
        return view('faq::faqCategory.edit',$data);
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
        if((!isset($pemission['perms']['FaqCategories']) || in_array('faqcates.edit',isset($pemission['perms']['FaqCategories'])?$pemission['perms']['FaqCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $faqCategories = $this->faq_cate->updateData($data,$id);
            if($faqCategories){
                $this->history_activity->addHistory('Sửa Faq category thành công','FaqCategories','Edit','Tài khoản '.Auth::user()->name.' Sửa Faq category thành công','sửa Faq category','Success',$id);
                return redirect()->route('admin.faqcates.index')->with('success','Sửa Faq category thành công');
            }
            $this->history_activity->addHistory('Sửa Faq category không thành công','FaqCategories','Edit','Tài khoản '.Auth::user()->name.' Sửa Faq category không thành công','sửa Faq category','Error');
            return back()->with('error','Sửa Faq category không thành công');
        }
        $this->history_activity->addHistory('Sửa Faq category không tìm thấy bản ghi','FaqCategories','Edit','Tài khoản '.Auth::user()->name.' Sửa Faq category không tìm thấy bản ghi','sửa Faq category không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['FaqCategories']) || in_array('faqcates.delete',isset($pemission['perms']['FaqCategories'])?$pemission['perms']['FaqCategories']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $faqCategories = $this->faq_cate->del(new Operator('id',$id));
            if($faqCategories){
                $this->history_activity->addHistory('Xóa Faq category thành công','FaqCategories','Delete','Tài khoản '.Auth::user()->name.' Xóa Faq category thành công','Xóa Faq category','Success',$id);
                return redirect()->route('admin.faqcates.index')->with('success','Xóa Faq category thành công');
            }
            $this->history_activity->addHistory('Xóa Faq category không thành công','FaqCategories','Delete','Tài khoản '.Auth::user()->name.' Xóa Faq category không thành công','Xóa Faq category','Error');
            return back()->with('error','Xóa Faq category không thành công');
        }
        $this->history_activity->addHistory('Xóa Faq category không tìm thấy bản ghi','FaqCategories','Delete','Tài khoản '.Auth::user()->name.' Xóa Faq category không tìm thấy bản ghi','Xóa Faq category không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listFaqCategory(Request $request)
    {
        $data['per_page'] = $request->input('per_page',5);
        $data['page'] = $request->input('page',1);
        $faqCategories = $this->faq_cate->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $faqCategories = $faqCategories->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $faqCategories = $faqCategories->orderByDesc('created_at')->builder(false);
        foreach ($faqCategories as $key => $item){
            $faq = $this->faq->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('faq_category_id',$item->id))->builder(false);
            $faqCategories[$key]->content = $faq;
        }
        return $this->responseAPI($faqCategories,'Lấy dữ liệu thành công',200);
    }
}

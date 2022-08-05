<?php

namespace Modules\FAQ\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\FAQ\Entities\Faq;
use Modules\FAQ\Entities\FaqCategory;

class FAQController extends Controller
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
        if((!isset($pemission['perms']['Faqs']) || in_array('faqs.index',isset($pemission['perms']['Faqs'])?$pemission['perms']['Faqs']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $faqs = $this->faq->select(['faq.answer','faq.question','faq.id','faq_categories.title'])->whereOperator(new Operator('faq.deleted_at',null));
        if($request->keyword){
            $faqs = $faqs->whereOperator(new Operator('faq.question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $faqs = $faqs->join(new Operator(null,null,'faq_categories','faq.faq_category_id','faq_categories.id'));
        $faqs = $faqs->orderByDesc('faq.created_at')->paging($data['per_page'],$data['page'],false);
        $data['faqs'] = $faqs;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách Faq','Faq','View','Tài khoản '.Auth::user()->name.' Xem danh sách Faq','Mở xem Xem danh sách Faq','Nomal');
        return view('faq::faq.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Faqs']) || in_array('faqs.add',isset($pemission['perms']['Faqs'])?$pemission['perms']['Faqs']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm Faq','Faqs','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm Faq','Vào trang thêm Faq','Nomal');
        return view('faq::faq.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Faqs']) || in_array('faqs.add',isset($pemission['perms']['Faqs'])?$pemission['perms']['Faqs']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $faqs = $this->faq->insertData($data);
        if($faqs){
            $this->history_activity->addHistory('Thêm Faq thành công','Faqs','Add','Tài khoản '.Auth::user()->name.' thêm Faq thành công','Thêm Faq','Success',$faqs);
            return redirect()->route('admin.faqs.index')->with('success','Thêm Faq thành công');
        }
        $this->history_activity->addHistory('Thêm Faq không thành công','Faqs','Add','Tài khoản '.Auth::user()->name.' thêm Faq không thành công','Thêm Faq','Error');
        return back()->with('error','Thêm Faq không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết Faq','Faqs','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết Faq','Vào xem chi tiết Faq','Nomal',$id);
        return view('faq::faq.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Faqs']) || in_array('faqs.edit',isset($pemission['perms']['Faqs'])?$pemission['perms']['Faqs']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['faqs'] = $this->faq->whereOperator(new Operator('faq.id',$id))
            ->join(new Operator(null,null,'faq_categories','faq.faq_category_id','faq_categories.id'))
            ->builder();
        $this->history_activity->addHistory('Vào trang sửa Faq','Faqs','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa Faq','Vào trang sửa Faq','Nomal',$id);
        return view('faq::faq.edit',$data);
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
        if((!isset($pemission['perms']['Faqs']) || in_array('faqs.edit',isset($pemission['perms']['Faqs'])?$pemission['perms']['Faqs']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $faqs = $this->faq->updateData($data,$id);
            if($faqs){
                $this->history_activity->addHistory('Sửa Faq thành công','Faqs','Edit','Tài khoản '.Auth::user()->name.' Sửa Faq thành công','sửa Faq','Success',$id);
                return redirect()->route('admin.faqs.index')->with('success','Sửa Faq thành công');
            }
            $this->history_activity->addHistory('Sửa Faq không thành công','Faqs','Edit','Tài khoản '.Auth::user()->name.' Sửa Faq không thành công','sửa Faq','Error');
            return back()->with('error','Sửa Faq không thành công');
        }
        $this->history_activity->addHistory('Sửa Faq không tìm thấy bản ghi','Faqs','Edit','Tài khoản '.Auth::user()->name.' Sửa Faq không tìm thấy bản ghi','sửa Faq không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['Faqs']) || in_array('faqs.delete',isset($pemission['perms']['Faqs'])?$pemission['perms']['Faqs']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $faqs = $this->faq->del(new Operator('id',$id));
            if($faqs){
                $this->history_activity->addHistory('Xóa Faq thành công','Faqs','Delete','Tài khoản '.Auth::user()->name.' Xóa Faq thành công','Xóa Faq','Success',$id);
                return redirect()->route('admin.faqs.index')->with('success','Xóa Faq thành công');
            }
            $this->history_activity->addHistory('Xóa Faq không thành công','Faqs','Delete','Tài khoản '.Auth::user()->name.' Xóa Faq không thành công','Xóa Faq','Error');
            return back()->with('error','Xóa Faq không thành công');
        }
        $this->history_activity->addHistory('Xóa Faq không tìm thấy bản ghi','Faqs','Delete','Tài khoản '.Auth::user()->name.' Xóa Faq không tìm thấy bản ghi','Xóa Faq không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function getFaqCategory(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $faq_cates = $this->faq_cate->select(['id','title']);
        if ($keyword) {
            $faq_cates = $faq_cates->whereOperator([new Operator('title','%'.$keyword.'%',null,null,null,null,'like')]);
        }
        $faq_cates = $faq_cates->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($faq_cates as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
    public function listFaq(Request $request)
    {
        $data['per_page'] = $request->input('per_page',5);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $faqs = $this->faq->select(['faq.answer','faq.question','faq.id','faq_categories.title'])->whereOperator(new Operator('faq.deleted_at',null));
        if($request->keyword){
            $faqs = $faqs->whereOperator(new Operator('faq.question','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $faqs = $faqs->join(new Operator(null,null,'faq_categories','faq.faq_category_id','faq_categories.id'));
        $faqs = $faqs->orderByDesc('faq.created_at')->paging($data['per_page'],$data['page'],false);
        return $this->responseAPI($faqs,'Lấy dữ liệu thành công',200);
    }
}

<?php

namespace Modules\News\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\News\Entities\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $news;
    private $history_activity;
    function __construct()
    {
        $this->news = new News();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $data['per_page'] = Cookie::get('per_page', 20);
//        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách bài viết';
        $search = ['keyword'=>''];
        DB::enableQueryLog();
//        $data['news'] = $this->news->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $news = $this->news->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $news = $news->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        $news = $news->orderByDesc()->paging($data['per_page'],$data['page'],false);
        $data['news'] = $news;
        $data['search'] = $search;
//        dd(DB::getQueryLog(),$data['per_page']);
//        dd($data);
        $this->history_activity->addHistory('Xem danh sách bài viết','New','View','Tài khoản '.Auth::user()->name.' xem danh sách bài viết','Mở xem danh sách bài viết','Nomal');
        return view('news::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->history_activity->addHistory('Vào trang thêm bài viết','New','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm bài viết','Vào trang thêm bài viết','Nomal');
        return view('news::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $new = $this->news->insertData($data);
        if($new){
            $this->history_activity->addHistory('Thêm bài viết thành công','New','Add','Tài khoản '.Auth::user()->name.' thêm bài viết thành công','Thêm bài viết','Success',$new);
            return redirect()->route('admin.news.index')->with('success','Thêm bài viết thành công');
        }
        $this->history_activity->addHistory('Thêm bài viết không thành công','New','Add','Tài khoản '.Auth::user()->name.' thêm bài viết không thành công','Thêm bài viết','Error');
        return back()->with('error','Thêm bài viết không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết bài viết','New','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết bài viết','Vào xem chi tiết bài viết','Nomal',$id);
        return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['new'] = $this->news->whereOperator(new Operator('id',$id))->builder();
        $this->history_activity->addHistory('Vào trang sửa bài viết','New','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa bài viết','Vào trang sửa bài viết','Nomal',$id);
        return view('news::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        if($id){
            $new = $this->news->updateData($data,$id);
            if($new){
                $this->history_activity->addHistory('Sửa bài viết thành công','New','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết thành công','sửa bài viết','Success',$id);
                return redirect()->route('admin.news.index')->with('success','Sửa bài viết thành công');
            }
            $this->history_activity->addHistory('Sửa bài viết không thành công','New','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết không thành công','sửa bài viết','Error',$id);
            return back()->with('error','Sửa bài viết không thành công');
        }
        $this->history_activity->addHistory('Sửa bài viết không tìm thấy bản ghi','New','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết không tìm thấy bản ghi','sửa bài viết không tìm thấy bản ghi','Error',$id);
        return back()->with('error','Không tìm thấy bản ghi');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if($id){
            $new = $this->news->del(new Operator('id',$id));
            if($new){
                $this->history_activity->addHistory('Xóa bài viết thành công','New','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết thành công','Xóa bài viết','Success',$id);
                return redirect()->route('admin.news.index')->with('success','Xóa bài viết thành công');
            }
            $this->history_activity->addHistory('Xóa bài viết không thành công','New','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không thành công','Xóa bài viết','Error',$id);
            return back()->with('error','Xóa bài viết không thành công');
        }
        $this->history_activity->addHistory('Xóa bài viết không tìm thấy bản ghi','New','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không tìm thấy bản ghi','Xóa bài viết không tìm thấy bản ghi','Error',$id);
        return back()->with('error','Không tìm thấy bản ghi');
    }
}

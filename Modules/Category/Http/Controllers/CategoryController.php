<?php

namespace Modules\Category\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

class CategoryController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $categorys;
        private $history_activity;
        function __construct()
        {
            $this->categorys = new Category();
            $this->history_activity = new HistoryActivity();
        }

        public function index(Request $request)
        {
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['categorys'] = $this->categorys->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $categorys = $this->categorys->whereOperator(new Operator('deleted_at',null));
            if($request->keyword){
                $categorys = $categorys->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $categorys = $categorys->orderByDesc()->paging($data['per_page'],$data['page'],false);
            $data['categorys'] = $categorys;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách bài viết','Category','View','Tài khoản '.Auth::user()->name.' xem danh sách bài viết','Mở xem danh sách bài viết','Nomal');
            return view('category::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $this->history_activity->addHistory('Vào trang thêm bài viết','Category','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm bài viết','Vào trang thêm bài viết','Nomal');
            return view('category::add');
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
            $category = $this->categorys->insertData($data);
            if($category){
                $this->history_activity->addHistory('Thêm bài viết thành công','Category','Add','Tài khoản '.Auth::user()->name.' thêm bài viết thành công','Thêm bài viết','Success',$category);
                return redirect()->route('admin.category.index')->with('success','Thêm bài viết thành công');
            }
            $this->history_activity->addHistory('Thêm bài viết không thành công','Category','Add','Tài khoản '.Auth::user()->name.' thêm bài viết không thành công','Thêm bài viết','Error');
            return back()->with('error','Thêm bài viết không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết bài viết','Category','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết bài viết','Vào xem chi tiết bài viết','Nomal',$id);
            return view('category::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $data['category'] = $this->categorys->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa bài viết','Category','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa bài viết','Vào trang sửa bài viết','Nomal',$id);
            return view('category::edit',$data);
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
                $category = $this->categorys->updateData($data,$id);
                if($category){
                    $this->history_activity->addHistory('Sửa bài viết thành công','Category','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết thành công','sửa bài viết','Success',$id);
                    return redirect()->route('admin.category.index')->with('success','Sửa bài viết thành công');
                }
                $this->history_activity->addHistory('Sửa bài viết không thành công','Category','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết không thành công','sửa bài viết','Error');
                return back()->with('error','Sửa bài viết không thành công');
            }
            $this->history_activity->addHistory('Sửa bài viết không tìm thấy bản ghi','Category','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết không tìm thấy bản ghi','sửa bài viết không tìm thấy bản ghi','Error');
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
                $category = $this->categorys->del(new Operator('id',$id));
                if($category){
                    $this->history_activity->addHistory('Xóa bài viết thành công','Category','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết thành công','Xóa bài viết','Success',$id);
                    return redirect()->route('admin.category.index')->with('success','Xóa bài viết thành công');
                }
                $this->history_activity->addHistory('Xóa bài viết không thành công','Category','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không thành công','Xóa bài viết','Error');
                return back()->with('error','Xóa bài viết không thành công');
            }
            $this->history_activity->addHistory('Xóa bài viết không tìm thấy bản ghi','Category','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không tìm thấy bản ghi','Xóa bài viết không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
}

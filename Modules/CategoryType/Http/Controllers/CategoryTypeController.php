<?php

namespace Modules\CategoryType\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\CategoryType\Entities\CategoryType;

class CategoryTypeController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $categorytypes;
        private $history_activity;
        function __construct()
        {
            $this->categorytypes = new CategoryType();
            $this->history_activity = new HistoryActivity();
        }

        public function index(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['CategoryType']) || in_array('categorytype.index',isset($pemission['perms']['CategoryType'])?$pemission['perms']['CategoryType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền vào trang này!');
            }
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['categorytypes'] = $this->categorytypes->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $categorytypes = $this->categorytypes->whereOperator(new Operator('deleted_at',null));
            if($request->keyword){
                $categorytypes = $categorytypes->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $categorytypes = $categorytypes->orderByDesc()->paging($data['per_page'],$data['page'],false);
            $data['categorytypes'] = $categorytypes;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách bài viết','CategoryType','View','Tài khoản '.Auth::user()->name.' xem danh sách bài viết','Mở xem danh sách bài viết','Nomal');
            return view('categorytype::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['CategoryType']) || in_array('categorytype.add',isset($pemission['perms']['CategoryType'])?$pemission['perms']['CategoryType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $this->history_activity->addHistory('Vào trang thêm bài viết','CategoryType','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm bài viết','Vào trang thêm bài viết','Nomal');
            return view('categorytype::add');
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Renderable
         */
        public function store(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['CategoryType']) || in_array('categorytype.add',isset($pemission['perms']['CategoryType'])?$pemission['perms']['CategoryType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['created_at'] = $data['updated_at'] =now();
            $categorytype = $this->categorytypes->insertData($data);
            if($categorytype){
                $this->history_activity->addHistory('Thêm bài viết thành công','CategoryType','Add','Tài khoản '.Auth::user()->name.' thêm bài viết thành công','Thêm bài viết','Success',$categorytype);
                return redirect()->route('admin.categorytype.index')->with('success','Thêm bài viết thành công');
            }
            $this->history_activity->addHistory('Thêm bài viết không thành công','CategoryType','Add','Tài khoản '.Auth::user()->name.' thêm bài viết không thành công','Thêm bài viết','Error');
            return back()->with('error','Thêm bài viết không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết bài viết','CategoryType','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết bài viết','Vào xem chi tiết bài viết','Nomal',$id);
            return view('categorytype::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['CategoryType']) || in_array('categorytype.edit',isset($pemission['perms']['CategoryType'])?$pemission['perms']['CategoryType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data['categorytype'] = $this->categorytypes->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa bài viết','CategoryType','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa bài viết','Vào trang sửa bài viết','Nomal',$id);
            return view('categorytype::edit',$data);
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
            if((!isset($pemission['perms']['CategoryType']) || in_array('categorytype.edit',isset($pemission['perms']['CategoryType'])?$pemission['perms']['CategoryType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['updated_at'] =now();
            if($id){
                $categorytype = $this->categorytypes->updateData($data,$id);
                if($categorytype){
                    $this->history_activity->addHistory('Sửa bài viết thành công','CategoryType','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết thành công','sửa bài viết','Success',$id);
                    return redirect()->route('admin.categorytype.index')->with('success','Sửa bài viết thành công');
                }
                $this->history_activity->addHistory('Sửa bài viết không thành công','CategoryType','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết không thành công','sửa bài viết','Error');
                return back()->with('error','Sửa bài viết không thành công');
            }
            $this->history_activity->addHistory('Sửa bài viết không tìm thấy bản ghi','CategoryType','Edit','Tài khoản '.Auth::user()->name.' Sửa bài viết không tìm thấy bản ghi','sửa bài viết không tìm thấy bản ghi','Error');
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
            if((!isset($pemission['perms']['CategoryType']) || in_array('categorytype.delete',isset($pemission['perms']['CategoryType'])?$pemission['perms']['CategoryType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền delete!');
            }
            if($id){
                $categorytype = $this->categorytypes->del(new Operator('id',$id));
                if($categorytype){
                    $this->history_activity->addHistory('Xóa bài viết thành công','CategoryType','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết thành công','Xóa bài viết','Success',$id);
                    return redirect()->route('admin.categorytype.index')->with('success','Xóa bài viết thành công');
                }
                $this->history_activity->addHistory('Xóa bài viết không thành công','CategoryType','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không thành công','Xóa bài viết','Error');
                return back()->with('error','Xóa bài viết không thành công');
            }
            $this->history_activity->addHistory('Xóa bài viết không tìm thấy bản ghi','CategoryType','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không tìm thấy bản ghi','Xóa bài viết không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
    public function getCategoryType(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $category_types = $this->categorytypes->select(['id','title','code']);
        if ($keyword) {
            $category_types = $category_types->whereOperator([new Operator('title','%'.$keyword.'%',null,null,null,null,'like')]);
        }
        $category_types = $category_types->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($category_types as $item) {
            $data[] = [
                'id' => $item->code,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
    public function listType(Request $request)
    {
        $data['per_page'] = $request->input('per_page',6);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $categorytypes = $this->categorytypes->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'],false);
        return $this->responseAPI($categorytypes,'Lấy dữ liệu thành công',200);
    }
}

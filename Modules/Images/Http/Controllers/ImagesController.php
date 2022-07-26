<?php

namespace Modules\Images\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\BlueprintType\Entities\BlueprintType;
use Modules\Images\Entities\Images;

class ImagesController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $images;
        private $history_activity;
        private $bluesprint;
        function __construct()
        {
            $this->images = new Images();
            $this->history_activity = new HistoryActivity();
            $this->bluesprint = new BlueprintType();
        }

        public function index(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Images']) || in_array('images.index',isset($pemission['perms']['Images'])?$pemission['perms']['Images']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền vào trang này!');
            }
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['images'] = $this->images->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $images = $this->images->whereOperator([new Operator('deleted_at',null),new Operator('type','Banner')]);
            if($request->keyword){
                $images = $images->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $images = $images->orderByDesc()->paging($data['per_page'],$data['page'],false);
            $data['images'] = $images;
            $data['search'] = $search;

            $data['type'] = $request->type?$request->type:'';
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách hình ảnh','Images','View','Tài khoản '.Auth::user()->name.' xem danh sách hình ảnh','Mở xem danh sách hình ảnh','Nomal');
            return view('images::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Images']) || in_array('images.add',isset($pemission['perms']['Images'])?$pemission['perms']['Images']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }

            $data['type'] = $request->type?$request->type:'';
            $this->history_activity->addHistory('Vào trang thêm hình ảnh','Images','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm hình ảnh','Vào trang thêm hình ảnh','Nomal');
            return view('images::add',$data);
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Renderable
         */
        public function store(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Images']) || in_array('images.add',isset($pemission['perms']['Images'])?$pemission['perms']['Images']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['created_at'] = $data['updated_at'] =now();
            $data['type'] = 'Banner';
            $data['list_image'] = json_encode($data['list_image']);
            $images = $this->images->insertData($data);
            if($images){
                $this->history_activity->addHistory('Thêm hình ảnh thành công','Images','Add','Tài khoản '.Auth::user()->name.' thêm hình ảnh thành công','Thêm hình ảnh','Success',$images);
                return redirect()->route('admin.images.index')->with('success','Thêm hình ảnh thành công');
            }
            $this->history_activity->addHistory('Thêm hình ảnh không thành công','Images','Add','Tài khoản '.Auth::user()->name.' thêm hình ảnh không thành công','Thêm hình ảnh','Error');
            return back()->with('error','Thêm hình ảnh không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết hình ảnh','Images','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết hình ảnh','Vào xem chi tiết hình ảnh','Nomal',$id);
            return view('images::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id,Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Images']) || in_array('images.edit',isset($pemission['perms']['Images'])?$pemission['perms']['Images']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data['type'] = $request->type?$request->type:'';
            $data['blueprinttype'] = null;
            $data['images'] = $this->images->whereOperator(new Operator('id',$id))->builder();
            if($data['images']->blueprint_type_id){
                $data['blueprinttype'] = $this->bluesprint->whereOperator([new Operator('status',1),new Operator('id',$data['images']->blueprint_type_id)])->builder();
            }
            $this->history_activity->addHistory('Vào trang sửa hình ảnh','Images','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa hình ảnh','Vào trang sửa hình ảnh','Nomal',$id);
            return view('images::edit',$data);
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
            if((!isset($pemission['perms']['Images']) || in_array('images.edit',isset($pemission['perms']['Images'])?$pemission['perms']['Images']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['updated_at'] =now();
            $data['status'] =isset($data['status'])?1:0;
            $data['list_image'] = isset($data['list_image'])?json_encode($data['list_image']):null;
            if($id){
                $images = $this->images->updateData($data,$id);
                if($images){
                    $this->history_activity->addHistory('Sửa hình ảnh thành công','Images','Edit','Tài khoản '.Auth::user()->name.' Sửa hình ảnh thành công','sửa hình ảnh','Success',$id);
                    return redirect()->route('admin.images.index')->with('success','Sửa hình ảnh thành công');
                }
                $this->history_activity->addHistory('Sửa hình ảnh không thành công','Images','Edit','Tài khoản '.Auth::user()->name.' Sửa hình ảnh không thành công','sửa hình ảnh','Error');
                return back()->with('error','Sửa hình ảnh không thành công');
            }
            $this->history_activity->addHistory('Sửa hình ảnh không tìm thấy bản ghi','Images','Edit','Tài khoản '.Auth::user()->name.' Sửa hình ảnh không tìm thấy bản ghi','sửa hình ảnh không tìm thấy bản ghi','Error');
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
            if((!isset($pemission['perms']['Images']) || in_array('images.delete',isset($pemission['perms']['Images'])?$pemission['perms']['Images']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền delete!');
            }
            if($id){
                $images = $this->images->del(new Operator('id',$id));
                if($images){
                    $this->history_activity->addHistory('Xóa hình ảnh thành công','Images','Delete','Tài khoản '.Auth::user()->name.' Xóa hình ảnh thành công','Xóa hình ảnh','Success',$id);
                    return redirect()->route('admin.images.index')->with('success','Xóa hình ảnh thành công');
                }
                $this->history_activity->addHistory('Xóa hình ảnh không thành công','Images','Delete','Tài khoản '.Auth::user()->name.' Xóa hình ảnh không thành công','Xóa hình ảnh','Error');
                return back()->with('error','Xóa hình ảnh không thành công');
            }
            $this->history_activity->addHistory('Xóa hình ảnh không tìm thấy bản ghi','Images','Delete','Tài khoản '.Auth::user()->name.' Xóa hình ảnh không tìm thấy bản ghi','Xóa hình ảnh không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }

    public function getBoxImages(Request $request)
    {
        $type = $request->input('type', null);
        $count = $request->input('count', 0);
        if(empty($type)){
            self::jsonError('Không có type');
        }
        if (file_exists(base_path('Modules/Images/Resources/views/box/'.$type.'.blade.php'))) {
//            $categorys = $this->categorys->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder();
            $projects = '';
            return view('images::box.'.$type,compact('projects','type','count'));
        }
        return 'false-load';
    }
    public function listImages(Request $request)
    {
        $data['per_page'] = $request->input('per_page',6);
        $data['page'] = $request->input('page',1);
        $images = $this->images->whereOperator([new Operator('deleted_at',null),new Operator('type','Banner')])->orderByDesc()->paging($data['per_page'],$data['page'],false);
        return $this->responseAPI($images,'Lấy dữ liệu thành công',200);
    }
    public function listDetail(Request $request,$id)
    {
        $data['arrange'] = $request->input('arrange',null);
        $data['type'] = $request->input('type',null);
        $images = $this->images->whereOperator([new Operator('deleted_at',null),new Operator('type','Banner'),new Operator('id',$id)]);
        if($data['arrange']){
            $images = $images->whereOperator(new Operator('arrange',$data['arrange']));
        }
        if($data['type']){
            $images = $images->whereOperator(new Operator('blueprint_type_id',$data['type']));
        }
        $images = $images->builder();
        if($images){
            return $this->responseAPI($images,'Lấy dữ liệu thành công',200);
        }
        return $this->responseAPI([],'Lấy dữ liệu không thành công',500);
    }
}

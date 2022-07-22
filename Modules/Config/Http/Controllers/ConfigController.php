<?php

namespace Modules\Config\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Config\Entities\Config;

class ConfigController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $configs;
        private $history_activity;
        function __construct()
        {
            $this->configs = new Config();
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
    //        $data['configs'] = $this->configs->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $configs = $this->configs->whereOperator(new Operator('deleted_at',null));
            if($request->keyword){
                $configs = $configs->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $configs = $configs->orderByDesc()->paging($data['per_page'],$data['page'],false);
            $data['configs'] = $configs;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách cài đặt','Config','View','Tài khoản '.Auth::user()->name.' xem danh sách cài đặt','Mở xem danh sách cài đặt','Nomal');
            return view('config::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $this->history_activity->addHistory('Vào trang thêm cài đặt','Config','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm cài đặt','Vào trang thêm cài đặt','Nomal');
            return view('config::add');
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
            $config = $this->configs->insertData($data);
            if($config){
                $this->history_activity->addHistory('Thêm cài đặt thành công','Config','Add','Tài khoản '.Auth::user()->name.' thêm cài đặt thành công','Thêm cài đặt','Success',$config);
                return redirect()->route('admin.config.index')->with('success','Thêm cài đặt thành công');
            }
            $this->history_activity->addHistory('Thêm cài đặt không thành công','Config','Add','Tài khoản '.Auth::user()->name.' thêm cài đặt không thành công','Thêm cài đặt','Error');
            return back()->with('error','Thêm cài đặt không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết cài đặt','Config','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết cài đặt','Vào xem chi tiết cài đặt','Nomal',$id);
            return view('config::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $data['config'] = $this->configs->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa cài đặt','Config','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa cài đặt','Vào trang sửa cài đặt','Nomal',$id);
            return view('config::edit',$data);
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
                $config = $this->configs->updateData($data,$id);
                if($config){
                    $this->history_activity->addHistory('Sửa cài đặt thành công','Config','Edit','Tài khoản '.Auth::user()->name.' Sửa cài đặt thành công','sửa cài đặt','Success',$id);
                    return redirect()->route('admin.config.index')->with('success','Sửa cài đặt thành công');
                }
                $this->history_activity->addHistory('Sửa cài đặt không thành công','Config','Edit','Tài khoản '.Auth::user()->name.' Sửa cài đặt không thành công','sửa cài đặt','Error');
                return back()->with('error','Sửa cài đặt không thành công');
            }
            $this->history_activity->addHistory('Sửa cài đặt không tìm thấy bản ghi','Config','Edit','Tài khoản '.Auth::user()->name.' Sửa cài đặt không tìm thấy bản ghi','sửa cài đặt không tìm thấy bản ghi','Error');
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
                $config = $this->configs->del(new Operator('id',$id));
                if($config){
                    $this->history_activity->addHistory('Xóa cài đặt thành công','Config','Delete','Tài khoản '.Auth::user()->name.' Xóa cài đặt thành công','Xóa cài đặt','Success',$id);
                    return redirect()->route('admin.config.index')->with('success','Xóa cài đặt thành công');
                }
                $this->history_activity->addHistory('Xóa cài đặt không thành công','Config','Delete','Tài khoản '.Auth::user()->name.' Xóa cài đặt không thành công','Xóa cài đặt','Error');
                return back()->with('error','Xóa cài đặt không thành công');
            }
            $this->history_activity->addHistory('Xóa cài đặt không tìm thấy bản ghi','Config','Delete','Tài khoản '.Auth::user()->name.' Xóa cài đặt không tìm thấy bản ghi','Xóa cài đặt không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
    public function editConfig(Request $request,$type)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Config']) || in_array('config.edit',isset($pemission['perms']['Config'])?$pemission['perms']['Config']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['config']=$this->configs->whereOperator([new Operator('config_key',$type),new Operator('deleted_at',null)])->builder();
        $data['value']=isset($data['config'])?json_decode($data['config']->config_value,true):[];
        $data['type']=$type;
        $this->history_activity->addHistory('Vào trang sửa cài đặt','Config','editGeneral','Tài khoản '.Auth::user()->name.' vào trang thêm cài đặt','Vào trang thêm cài đặt','Nomal');
        return view('config::layouts.home',$data);
    }
    public function updateConfig(Request $request,$type)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Config']) || in_array('config.edit',isset($pemission['perms']['Config'])?$pemission['perms']['Config']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $check = $this->configs->whereOperator([new Operator('config_key',$type),new Operator('deleted_at',null)])->builder();
        if($check){
            $update = $this->configs->updateData(['config_value'=>json_encode($data),'updated_at'=>now()],$check->id);
            if($update){
                $this->history_activity->addHistory('Sửa cài đặt thành công','Config','editGeneral','Tài khoản '.Auth::user()->name.' Sửa cài đặt thành công','sửa cài đặt','Success',$check->id);
                return back()->with('success','Sửa cài đặt thành công');
            }
            $this->history_activity->addHistory('Sửa cài đặt không thành công','Config','editGeneral','Tài khoản '.Auth::user()->name.' Sửa cài đặt không thành công','sửa cài đặt không thành công','Error');
            return back()->with('error','Sửa cài đặt không thành công');
        }else{
            $insert = $this->configs->insertData(['config_key'=>$type,'config_value'=>json_encode($data),'created_at'=>now(),'updated_at'=>now()]);
            if($insert){
                $this->history_activity->addHistory('Thêm cài đặt thành công','Config','editGeneral','Tài khoản '.Auth::user()->name.' Thêm cài đặt thành công','Thêm cài đặt','Success',$insert);
                return back()->with('success','Sửa cài đặt thành công');
            }
            $this->history_activity->addHistory('Thêm cài đặt không thành công','Config','editGeneral','Tài khoản '.Auth::user()->name.' Thêm cài đặt không thành công','Thêm cài đặt không thành công','Error');
            return back()->with('error','Thêm cài đặt không thành công');
        }
    }
    public function getBoxConfig(Request $request)
    {
        $type = $request->input('type', null);
        $count = $request->input('count', 0);
        if(empty($type)){
            self::jsonError('Không có type');
        }
        if (file_exists(base_path('Modules/Config/Resources/views/box/'.$type.'.blade.php'))) {
//            $categorys = $this->categorys->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder();
            $projects = '';
            return view('config::box.'.$type,compact('projects','type','count'));
        }
        return 'false-load';
    }
    public function config(Request $request)
    {
        $data['per_page'] = $request->input('per_page',6);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $configs = $this->configs->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $configs = $configs->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        $configs = $configs->orderByDesc()->builder(false);
        return $this->responseAPI($configs,'Lấy dữ liệu thành công',200);
    }
    public function detailByKey(Request $request,$type)
    {
        $configs = $this->configs->whereOperator([new Operator('config_key',$type),new Operator('deleted_at',null)])->builder();
        if($configs){
            return $this->responseAPI($configs,'Lấy dữ liệu thành công',200);
        }
        return $this->responseAPI([],'Lấy dữ liệu không thành công',500);
    }
}

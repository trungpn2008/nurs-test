<?php

namespace Modules\Admin\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\OptionActionPermission;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\permissions;
use Modules\News\Entities\News;

class OptionActionPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $options;
    private $history_activity;
    function __construct()
    {
        $this->options = new OptionActionPermission();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $data['per_page'] = Cookie::get('per_page', 20);
//        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách lựa chọn hành động permission';
        $search = ['keyword'=>''];
        DB::enableQueryLog();
//        $data['news'] = $this->options->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $options = $this->options->whereOperator([new Operator('status',1),new Operator('deleted_at',null)]);
        if($request->keyword){
            $options = $options->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        $options = $options->orderByAsc()->paging($data['per_page'],$data['page'],false);
        $data['options'] = $options;
        $data['search'] = $search;
//        dd(DB::getQueryLog(),$data['per_page']);
//        dd($data);
        $this->history_activity->addHistory('Xem danh sách lựa chọn hành động permission','OptionActionPermission','View','Tài khoản '.Auth::user()->name.' xem danh sách lựa chọn hành động permission','Mở xem danh sách lựa chọn hành động permission','Nomal');
        return view('admin::optionPermission.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['options'] = (new OptionActionPermission())->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
        $this->history_activity->addHistory('Vào trang thêm lựa chọn hành động permission','OptionActionPermission','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm lựa chọn hành động permission','Vào trang thêm lựa chọn hành động permission','Nomal');
        return view('admin::optionPermission.add',$data);
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
        $check_action = $this->options->whereOperator([new Operator('code',$data['code']),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        if($check_action){
            $this->history_activity->addHistory('Thêm lựa chọn hành động permission không thành công','OptionActionPermission','Add','Tài khoản '.Auth::user()->name.' thêm lựa chọn hành động permission không thành công','Thêm lựa chọn hành động permission không thành công, đã có lựa chọn hành động permission này, tại id: '.$check_action->id,'Error');
            return back()->with('error','Đã có lựa chọn hành động permission này, tại id: '.$check_action->id);
        }
        $option = $this->options->insertData($data);
        if($option){
            $this->history_activity->addHistory('Thêm lựa chọn hành động permission thành công','OptionActionPermission','Add','Tài khoản '.Auth::user()->name.' thêm lựa chọn hành động permission thành công','Thêm lựa chọn hành động permission','Success',$option);
            return redirect()->route('admin.option.index')->with('success','Thêm lựa chọn hành động permission thành công');
        }
        $this->history_activity->addHistory('Thêm lựa chọn hành động permission không thành công','OptionActionPermission','Add','Tài khoản '.Auth::user()->name.' thêm lựa chọn hành động permission không thành công','Thêm lựa chọn hành động permission không thành công','Error');
        return back()->with('error','Thêm lựa chọn hành động permission không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết lựa chọn hành động permission','OptionActionPermission','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết lựa chọn hành động permission','Vào xem chi tiết lựa chọn hành động permission','Nomal',$id);
        return view('admin::optionPermission.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['options'] = (new OptionActionPermission())->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
        $data['option'] = $this->options->whereOperator(new Operator('id',$id))->builder();
        $this->history_activity->addHistory('Vào trang sửa lựa chọn hành động permission','OptionActionPermission','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa lựa chọn hành động permission','Vào trang sửa lựa chọn hành động permission','Nomal',$id);
        return view('admin::optionPermission.edit',$data);
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
        $info = $this->options->whereOperator([new Operator('id',$id),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        $check_action = $this->options->whereOperator([new Operator('code',$data['code']),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        if(isset($check_action) && $check_action->code != $info->code){
            $this->history_activity->addHistory('Sửa lựa chọn hành động permission không thành công','OptionActionPermission','Add','Tài khoản '.Auth::user()->name.' Sửa lựa chọn hành động permission không thành công','Sửa lựa chọn hành động permission không thành công, đã có lựa chọn hành động permission này, tại id: '.$check_action->id,'Error',$id);
            return back()->with('error','Đã có lựa chọn hành động permission này, tại id: '.$check_action->id);
        }
        if($id){
            $option = $this->options->updateData($data,$id);
            if($option){
                $this->history_activity->addHistory('Sửa lựa chọn hành động permission thành công','OptionActionPermission','Edit','Tài khoản '.Auth::user()->name.' Sửa lựa chọn hành động permission thành công','sửa lựa chọn hành động permission','Success',$id);
                return redirect()->route('admin.option.index')->with('success','Sửa lựa chọn hành động permission thành công');
            }
            $this->history_activity->addHistory('Sửa lựa chọn hành động permission không thành công','OptionActionPermission','Edit','Tài khoản '.Auth::user()->name.' Sửa lựa chọn hành động permission không thành công','sửa lựa chọn hành động permission không thành công','Error',$id);
            return back()->with('error','Sửa lựa chọn hành động permission không thành công');
        }
        $this->history_activity->addHistory('Sửa lựa chọn hành động permission không tìm thấy bản ghi','OptionActionPermission','Edit','Tài khoản '.Auth::user()->name.' Sửa lựa chọn hành động permission không tìm thấy bản ghi','sửa lựa chọn hành động permission không tìm thấy bản ghi','Error',$id);
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
            $option = $this->options->del(new Operator('id',$id));
            if($option){
                $this->history_activity->addHistory('Xóa lựa chọn hành động permission thành công','OptionActionPermission','Delete','Tài khoản '.Auth::user()->name.' Xóa lựa chọn hành động permission thành công','Xóa lựa chọn hành động permission','Success',$id);
                return redirect()->route('admin.option.index')->with('success','Xóa lựa chọn hành động permission thành công');
            }
            $this->history_activity->addHistory('Xóa lựa chọn hành động permission không thành công','OptionActionPermission','Delete','Tài khoản '.Auth::user()->name.' Xóa lựa chọn hành động permission không thành công','Xóa lựa chọn hành động permission không thành công','Error',$id);
            return back()->with('error','Xóa lựa chọn hành động permission không thành công');
        }
        $this->history_activity->addHistory('Xóa lựa chọn hành động permission không tìm thấy bản ghi','OptionActionPermission','Delete','Tài khoản '.Auth::user()->name.' Xóa lựa chọn hành động permission không tìm thấy bản ghi','Xóa lựa chọn hành động permission không tìm thấy bản ghi','Error',$id);
        return back()->with('error','Không tìm thấy bản ghi');
    }
}

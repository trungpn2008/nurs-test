<?php

namespace Modules\BlueprintType\Http\Controllers;

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

class BlueprintTypeController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $blueprinttypes;
        private $history_activity;
        function __construct()
        {
            $this->blueprinttypes = new BlueprintType();
            $this->history_activity = new HistoryActivity();
        }

        public function index(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['BlueprintType']) || in_array('blueprinttype.index',isset($pemission['perms']['BlueprintType'])?$pemission['perms']['BlueprintType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền vào trang này!');
            }
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['blueprinttypes'] = $this->blueprinttypes->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $blueprinttypes = $this->blueprinttypes->whereOperator(new Operator('deleted_at',null));
            if($request->keyword){
                $blueprinttypes = $blueprinttypes->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $blueprinttypes = $blueprinttypes->orderByDesc()->paging($data['per_page'],$data['page'],false);
            $data['blueprinttypes'] = $blueprinttypes;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách mặt bằng','BlueprintType','View','Tài khoản '.Auth::user()->name.' xem danh sách mặt bằng','Mở xem danh sách mặt bằng','Nomal');
            return view('blueprinttype::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['BlueprintType']) || in_array('blueprinttype.add',isset($pemission['perms']['BlueprintType'])?$pemission['perms']['BlueprintType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $this->history_activity->addHistory('Vào trang thêm mặt bằng','BlueprintType','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm mặt bằng','Vào trang thêm mặt bằng','Nomal');
            return view('blueprinttype::add');
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Renderable
         */
        public function store(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['BlueprintType']) || in_array('blueprinttype.add',isset($pemission['perms']['BlueprintType'])?$pemission['perms']['BlueprintType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['created_at'] = $data['updated_at'] =now();
            $blueprinttype = $this->blueprinttypes->insertData($data);
            if($blueprinttype){
                $this->history_activity->addHistory('Thêm mặt bằng thành công','BlueprintType','Add','Tài khoản '.Auth::user()->name.' thêm mặt bằng thành công','Thêm mặt bằng','Success',$blueprinttype);
                return redirect()->route('admin.blueprinttype.index')->with('success','Thêm mặt bằng thành công');
            }
            $this->history_activity->addHistory('Thêm mặt bằng không thành công','BlueprintType','Add','Tài khoản '.Auth::user()->name.' thêm mặt bằng không thành công','Thêm mặt bằng','Error');
            return back()->with('error','Thêm mặt bằng không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết mặt bằng','BlueprintType','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết mặt bằng','Vào xem chi tiết mặt bằng','Nomal',$id);
            return view('blueprinttype::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['BlueprintType']) || in_array('blueprinttype.edit',isset($pemission['perms']['BlueprintType'])?$pemission['perms']['BlueprintType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data['blueprinttype'] = $this->blueprinttypes->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa mặt bằng','BlueprintType','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa mặt bằng','Vào trang sửa mặt bằng','Nomal',$id);
            return view('blueprinttype::edit',$data);
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
            if((!isset($pemission['perms']['BlueprintType']) || in_array('blueprinttype.edit',isset($pemission['perms']['BlueprintType'])?$pemission['perms']['BlueprintType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['status'] = isset($data['status']) && $data['status']==='on'?1:0;
            $data['updated_at'] =now();
            if($id){
                $blueprinttype = $this->blueprinttypes->updateData($data,$id);
                if($blueprinttype){
                    $this->history_activity->addHistory('Sửa mặt bằng thành công','BlueprintType','Edit','Tài khoản '.Auth::user()->name.' Sửa mặt bằng thành công','sửa mặt bằng','Success',$id);
                    return redirect()->route('admin.blueprinttype.index')->with('success','Sửa mặt bằng thành công');
                }
                $this->history_activity->addHistory('Sửa mặt bằng không thành công','BlueprintType','Edit','Tài khoản '.Auth::user()->name.' Sửa mặt bằng không thành công','sửa mặt bằng','Error');
                return back()->with('error','Sửa mặt bằng không thành công');
            }
            $this->history_activity->addHistory('Sửa mặt bằng không tìm thấy bản ghi','BlueprintType','Edit','Tài khoản '.Auth::user()->name.' Sửa mặt bằng không tìm thấy bản ghi','sửa mặt bằng không tìm thấy bản ghi','Error');
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
            if((!isset($pemission['perms']['BlueprintType']) || in_array('blueprinttype.delete',isset($pemission['perms']['BlueprintType'])?$pemission['perms']['BlueprintType']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền delete!');
            }
            if($id){
                $blueprinttype = $this->blueprinttypes->del(new Operator('id',$id));
                if($blueprinttype){
                    $this->history_activity->addHistory('Xóa mặt bằng thành công','BlueprintType','Delete','Tài khoản '.Auth::user()->name.' Xóa mặt bằng thành công','Xóa mặt bằng','Success',$id);
                    return redirect()->route('admin.blueprinttype.index')->with('success','Xóa mặt bằng thành công');
                }
                $this->history_activity->addHistory('Xóa mặt bằng không thành công','BlueprintType','Delete','Tài khoản '.Auth::user()->name.' Xóa mặt bằng không thành công','Xóa mặt bằng','Error');
                return back()->with('error','Xóa mặt bằng không thành công');
            }
            $this->history_activity->addHistory('Xóa mặt bằng không tìm thấy bản ghi','BlueprintType','Delete','Tài khoản '.Auth::user()->name.' Xóa mặt bằng không tìm thấy bản ghi','Xóa mặt bằng không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
    public function getBlueprintType(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $blueprint_types = $this->blueprinttypes->select(['id','title']);
        if ($keyword) {
            $blueprint_types = $blueprint_types->whereOperator([new Operator('title','%'.$keyword.'%',null,null,null,null,'like')]);
        }
        $blueprint_types = $blueprint_types->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($blueprint_types as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
    public function listType(Request $request)
    {
        $data['per_page'] = $request->input('per_page',6);
        $data['page'] = $request->input('page',1);
        $blueprinttypes = $this->blueprinttypes->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'],false);
        return $this->responseAPI($blueprinttypes,'Lấy dữ liệu thành công',200);
    }
    public function listDetail(Request $request)
    {
        $data['id'] = $request->input('id',null);
        $blueprinttypes = $this->blueprinttypes->whereOperator([new Operator('deleted_at',null),new Operator('id',$data['id'])])->orderByDesc()->builder();
        if($blueprinttypes){
            return $this->responseAPI($blueprinttypes,'Lấy dữ liệu thành công',200);
        }
        return $this->responseAPI([],'Lấy dữ liệu không thành công',500);
    }
}

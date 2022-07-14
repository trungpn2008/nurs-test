<?php

namespace Modules\Recruitment\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Alias\Entities\Alias;
use Modules\Recruitment\Entities\Recruitment;

class RecruitmentController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $recruitments;
        private $alias;
        private $history_activity;
        function __construct()
        {
            $this->recruitments = new Recruitment();
            $this->alias = new Alias();
            $this->history_activity = new HistoryActivity();
        }

        public function index(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Recruitment']) || in_array('recruitment.index',isset($pemission['perms']['Recruitment'])?$pemission['perms']['Recruitment']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền vào trang này!');
            }
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách tuyển dụng';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['recruitments'] = $this->recruitments->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $recruitments = $this->recruitments->whereOperator(new Operator('deleted_at',null));
            if($request->keyword){
                $recruitments = $recruitments->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $recruitments = $recruitments->orderByDesc()->paging($data['per_page'],$data['page'],false);
            $data['recruitments'] = $recruitments;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách tuyển dụng','Recruitment','View','Tài khoản '.Auth::user()->name.' xem danh sách tuyển dụng','Mở xem danh sách tuyển dụng','Nomal');
            return view('recruitment::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Recruitment']) || in_array('recruitment.add',isset($pemission['perms']['Recruitment'])?$pemission['perms']['Recruitment']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $this->history_activity->addHistory('Vào trang thêm tuyển dụng','Recruitment','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm tuyển dụng','Vào trang thêm tuyển dụng','Nomal');
            return view('recruitment::add');
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Renderable
         */
        public function store(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Recruitment']) || in_array('recruitment.add',isset($pemission['perms']['Recruitment'])?$pemission['perms']['Recruitment']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền add!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['created_at'] = $data['updated_at'] =now();
            $data['hot'] = isset($data['hot']) && $data['hot']==='on'?1:0;
            $recruitment = $this->recruitments->insertData($data);
            if($recruitment){
//                $check_alias = $this->alias->whereOperator([new Operator('status',1),new Operator('deleted_at',null),new Operator('recruitment_id',$recruitment)])->builder();
                $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
                    ->where('recruitment_id','!=',null)
                    ->where(function ($query) use ($data){
                        $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                        $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                    })->get();
                if(count($check_alias)<=0){
                    $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'recruitment_id'=>$recruitment,'created_at'=>now(),'updated_at'=>now()]);
                    if($alias){
                        $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                    }
                    $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
                }else{
                    $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))).'-'.(count($check_alias)+1),'recruitment_id'=>$recruitment,'created_at'=>now(),'updated_at'=>now()]);
                    if($alias){
                        $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                    }
                    $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
                }
                $this->history_activity->addHistory('Thêm tuyển dụng thành công','Recruitment','Add','Tài khoản '.Auth::user()->name.' thêm tuyển dụng thành công','Thêm tuyển dụng','Success',$recruitment);
                return redirect()->route('admin.recruitment.index')->with('success','Thêm tuyển dụng thành công');
            }
            $this->history_activity->addHistory('Thêm tuyển dụng không thành công','Recruitment','Add','Tài khoản '.Auth::user()->name.' thêm tuyển dụng không thành công','Thêm tuyển dụng','Error');
            return back()->with('error','Thêm tuyển dụng không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết tuyển dụng','Recruitment','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết tuyển dụng','Vào xem chi tiết tuyển dụng','Nomal',$id);
            return view('recruitment::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Recruitment']) || in_array('recruitment.edit',isset($pemission['perms']['Recruitment'])?$pemission['perms']['Recruitment']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data['recruitment'] = $this->recruitments->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa tuyển dụng','Recruitment','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa tuyển dụng','Vào trang sửa tuyển dụng','Nomal',$id);
            return view('recruitment::edit',$data);
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
            if((!isset($pemission['perms']['Recruitment']) || in_array('recruitment.edit',isset($pemission['perms']['Recruitment'])?$pemission['perms']['Recruitment']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền edit!');
            }
            $data = $request->all();
            unset($data['_token']);
            $data['updated_at'] =now();
            $data['status'] = isset($data['status']) && $data['status']==='on'?1:0;
            $data['hot'] = isset($data['hot']) && $data['hot']==='on'?1:0;
            if($id){
                $recruitment = $this->recruitments->updateData($data,$id);
                if($recruitment){
//                    $check_alias = $this->alias->whereOperator([new Operator('status',1),new Operator('deleted_at',null),new Operator('recruitment_id',$id)])->builder();
//                    $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
////                    ->where('category_id','!=',$id)
//                        ->where(function ($query) use ($data){
//                            $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                            $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                        })->get();
//                    if(count($check_alias)<=0){
//                        DB::table('alias')->where(['recruitment_id'=>$id])->update(['deleted_at'=>now()]);
//                        $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'recruitment_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                        if($alias){
//                            $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                        }
//                        $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//                    }elseif(count($check_alias)>0 && count($check_alias)<2) {
                        $alias = DB::table('alias')->where(['status'=>1,'deleted_at'=>null,'recruitment_id'=>$id])->update(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'updated_at'=>now()]);
                        if($alias){
                            $this->history_activity->addHistory('Sửa alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' sửa alias thành công','Sửa alias','Success',$id);
                        }
                        $this->history_activity->addHistory('Sửa alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' sửa alias không thành công','Sửa alias','Error',$id);
//                    }
//                    else{
//                        DB::table('alias')->where(['recruitment_id'=>$id])->update(['deleted_at'=>now()]);
//                        $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'recruitment_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                        if($alias){
//                            $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                        }
//                        $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//                    }
                    $this->history_activity->addHistory('Sửa tuyển dụng thành công','Recruitment','Edit','Tài khoản '.Auth::user()->name.' Sửa tuyển dụng thành công','sửa tuyển dụng','Success',$id);
                    return redirect()->route('admin.recruitment.index')->with('success','Sửa tuyển dụng thành công');
                }
                $this->history_activity->addHistory('Sửa tuyển dụng không thành công','Recruitment','Edit','Tài khoản '.Auth::user()->name.' Sửa tuyển dụng không thành công','sửa tuyển dụng','Error');
                return back()->with('error','Sửa tuyển dụng không thành công');
            }
            $this->history_activity->addHistory('Sửa tuyển dụng không tìm thấy bản ghi','Recruitment','Edit','Tài khoản '.Auth::user()->name.' Sửa tuyển dụng không tìm thấy bản ghi','sửa tuyển dụng không tìm thấy bản ghi','Error');
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
            if((!isset($pemission['perms']['Recruitment']) || in_array('recruitment.delete',isset($pemission['perms']['Recruitment'])?$pemission['perms']['Recruitment']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền delete!');
            }
            if($id){
                $recruitment = $this->recruitments->del(new Operator('id',$id));
                DB::table('alias')->where(['recruitment_id'=>$id])->update(['deleted_at'=>now()]);
                if($recruitment){
                    $this->history_activity->addHistory('Xóa tuyển dụng thành công','Recruitment','Delete','Tài khoản '.Auth::user()->name.' Xóa tuyển dụng thành công','Xóa tuyển dụng','Success',$id);
                    return redirect()->route('admin.recruitment.index')->with('success','Xóa tuyển dụng thành công');
                }
                $this->history_activity->addHistory('Xóa tuyển dụng không thành công','Recruitment','Delete','Tài khoản '.Auth::user()->name.' Xóa tuyển dụng không thành công','Xóa tuyển dụng','Error');
                return back()->with('error','Xóa tuyển dụng không thành công');
            }
            $this->history_activity->addHistory('Xóa tuyển dụng không tìm thấy bản ghi','Recruitment','Delete','Tài khoản '.Auth::user()->name.' Xóa tuyển dụng không tìm thấy bản ghi','Xóa tuyển dụng không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
}

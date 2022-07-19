<?php

namespace Modules\Category\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Alias\Entities\Alias;
use Modules\Category\Entities\Category;
use Modules\CategoryType\Entities\CategoryType;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $categorys;
    private $category_types;
    private $alias;
    private $history_activity;
    function __construct()
    {
        $this->categorys = new Category();
        $this->category_types = new CategoryType();
        $this->alias = new Alias();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Category']) || in_array('category.index',isset($pemission['perms']['Category'])?$pemission['perms']['Category']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        DB::enableQueryLog();
        //        $data['categorys'] = $this->categorys->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $categorys = $this->categorys
            ->select(['category.id','category.image','category.title','parent.title as parent_title','category.url_location','category.arrange','category.status','users.name'])
            ->join([
                new Operator(null,null,'category as parent','category.parent_id','parent.id'),
                new Operator(null,null,'users','category.updater','users.id'),
            ])
            ->whereOperator(new Operator('category.deleted_at',null));
        if($request->keyword){
            $categorys = $categorys->whereOperator(new Operator('category.title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        $categorys = $categorys->orderByDesc('category.created_at')->paging($data['per_page'],$data['page'],false);
        $data['categorys'] = $categorys;
        $data['search'] = $search;
        //        dd(DB::getQueryLog(),$data['per_page']);
        //        dd($data);
        $this->history_activity->addHistory('Xem danh sách danh mục','Category','View','Tài khoản '.Auth::user()->name.' xem danh sách danh mục','Mở xem danh sách danh mục','Nomal');
        return view('category::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Category']) || in_array('category.add',isset($pemission['perms']['Category'])?$pemission['perms']['Category']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm danh mục','Category','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm danh mục','Vào trang thêm danh mục','Nomal');
        return view('category::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Category']) || in_array('category.add',isset($pemission['perms']['Category'])?$pemission['perms']['Category']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $data['parent_id'] = !empty($data['category_id'])?$data['category_id']:null;
        if(isset($data['introduce'])){
            $data['data'] = json_encode($data['introduce']);
            unset($data['introduce']);
        }elseif (isset($data['recruitment'])){
            $data['data'] = json_encode($data['recruitment']);
            unset($data['recruitment']);
        } else {
            $data['data'] = null;
        }

        $data['creator'] = $data['updater'] = Auth::id();
        unset($data['category_id']);unset($data['short_description']);unset($data['note']);unset($data['hashtag']);unset($data['source']);
        $category = $this->categorys->insertData($data);
        if($category){
            $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])->where('category_id','!=',null)
                ->where(function ($query) use ($data){
                    $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                    $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                })->get();
            if(count($check_alias)<=0){
                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'category_id'=>$category,'created_at'=>now(),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
            }else{
                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))).'-'.(count($check_alias)+1),'category_id'=>$category,'created_at'=>now(),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
            }
            $this->history_activity->addHistory('Thêm danh mục thành công','Category','Add','Tài khoản '.Auth::user()->name.' thêm danh mục thành công','Thêm danh mục','Success',$category);
            return redirect()->route('admin.category.index')->with('success','Thêm danh mục thành công');
        }
        $this->history_activity->addHistory('Thêm danh mục không thành công','Category','Add','Tài khoản '.Auth::user()->name.' thêm danh mục không thành công','Thêm danh mục','Error');
        return back()->with('error','Thêm danh mục không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết danh mục','Category','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết danh mục','Vào xem chi tiết danh mục','Nomal',$id);
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Category']) || in_array('category.edit',isset($pemission['perms']['Category'])?$pemission['perms']['Category']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['category'] = $this->categorys
            ->select(['category.title','category.status','category.icon','category.image','category.type','category.text_image','category.parent_id','category.arrange','category.url_location','category.data','category_type.id as cate_type_id','category_type.status as cate_type_status','category_type.title as cate_type_title','parent.title as parent_title'])
            ->join(new Operator(null,null,'category_type','category.type','category_type.code'))
            ->join(new Operator(null,null,'category as parent','category.parent_id','parent.id'))
            ->whereOperator(new Operator('category.id',$id))->builder();
        $data['datas'] = json_decode($data['category']->data,true);
        $data['id'] = $id;
        $this->history_activity->addHistory('Vào trang sửa danh mục','Category','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa danh mục','Vào trang sửa danh mục','Nomal',$id);
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
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Category']) || in_array('category.edit',isset($pemission['perms']['Category'])?$pemission['perms']['Category']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        $data['parent_id'] = !empty($data['category_id'])?$data['category_id']:null;
        if(isset($data['introduce'])){
            $data['data'] = json_encode($data['introduce']);
            unset($data['introduce']);
        }elseif (isset($data['recruitment'])){
            $data['data'] = json_encode($data['recruitment']);
            unset($data['recruitment']);
        } else {
            $data['data'] = null;
        }
        $data['status'] = isset($data['status']) && $data['status']==='on'?1:0;
        $data['updater'] = Auth::id();
        unset($data['category_id']);unset($data['introduce']);unset($data['short_description']);unset($data['note']);unset($data['hashtag']);unset($data['source']);
        if($id){
            $category = $this->categorys->updateData($data,$id);
            if($category){
//                $check_alias = $this->alias->whereOperator([new Operator('status',1),new Operator('deleted_at',null),new Operator('category_id',$id)])->builder();


//                $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
////                    ->where('category_id','!=',$id)
//                    ->where(function ($query) use ($data){
//                        $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                        $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                    })->get();
//                if(count($check_alias)<=0){
                $alias = DB::table('alias')->where(['category_id'=>$id,'status'=>1,'deleted_at'=>null])->update(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'category_id'=>$id,'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Sửa alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' Sửa alias thành công','Sửa alias','Success',$alias);
                }
                $this->history_activity->addHistory('Sửa alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' Sửa alias không thành công','Sửa alias','Error');
//                }elseif(count($check_alias)>0){
//                    foreach ($check_alias as $item){
//                        if ($item->category_id == $id) {
//                            $alias = DB::table('alias')->where(['status'=>1,'deleted_at'=>null,'category_id'=>$id])->update(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))).'-'.count($check_alias),'updated_at'=>now()]);
//                        }
//                        $alias = DB::table('alias')->where(['status'=>1,'deleted_at'=>null,'category_id'=>$id])->update(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))).'-'.count($check_alias),'updated_at'=>now()]);
//                    }
//
//                    if($alias){
//                        $this->history_activity->addHistory('Sửa alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' sửa alias thành công','Sửa alias','Success',$id);
//                    }
//                    $this->history_activity->addHistory('Sửa alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' sửa alias không thành công','Sửa alias','Error',$id);
//                }
//                else{
//                    DB::table('alias')->where(['category_id'=>$id])->update(['deleted_at'=>now()]);
//                    $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'category_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                    if($alias){
//                        $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                    }
//                    $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//                }
                $this->history_activity->addHistory('Sửa danh mục thành công','Category','Edit','Tài khoản '.Auth::user()->name.' Sửa danh mục thành công','sửa danh mục','Success',$id);
                return redirect()->route('admin.category.index')->with('success','Sửa danh mục thành công');
            }
            $this->history_activity->addHistory('Sửa danh mục không thành công','Category','Edit','Tài khoản '.Auth::user()->name.' Sửa danh mục không thành công','sửa danh mục','Error');
            return back()->with('error','Sửa danh mục không thành công');
        }
        $this->history_activity->addHistory('Sửa danh mục không tìm thấy bản ghi','Category','Edit','Tài khoản '.Auth::user()->name.' Sửa danh mục không tìm thấy bản ghi','sửa danh mục không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['Category']) || in_array('category.delete',isset($pemission['perms']['Category'])?$pemission['perms']['Category']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $category = $this->categorys->del(new Operator('id',$id));
            if($category){
                DB::table('alias')->where(['category_id'=>$id])->update(['deleted_at'=>now()]);
                $this->history_activity->addHistory('Xóa danh mục thành công','Category','Delete','Tài khoản '.Auth::user()->name.' Xóa danh mục thành công','Xóa danh mục','Success',$id);
                return redirect()->route('admin.category.index')->with('success','Xóa danh mục thành công');
            }
            $this->history_activity->addHistory('Xóa danh mục không thành công','Category','Delete','Tài khoản '.Auth::user()->name.' Xóa danh mục không thành công','Xóa danh mục','Error');
            return back()->with('error','Xóa danh mục không thành công');
        }
        $this->history_activity->addHistory('Xóa danh mục không tìm thấy bản ghi','Category','Delete','Tài khoản '.Auth::user()->name.' Xóa danh mục không tìm thấy bản ghi','Xóa danh mục không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function getCategory(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $id = $request->input('id', '');
        $type = $request->input('type', null);
        $offset = ($page - 1) * $size;
        $categorys = $this->categorys->select(['id','title'])->whereOperator([new Operator('deleted_at',null),new Operator('status',1)]);
        if ($keyword) {
            $categorys = $categorys->whereOperator([new Operator('title','%'.$keyword.'%',null,null,null,null,'like')]);
        }
        if ($id) {
            $categorys = $categorys->whereOperator([new Operator('id',$id,null,null,null,null,'!=')]);
        }
//        if ($type) {
//            $categorys = $categorys->whereOperator([new Operator('type',$type)]);
//        }
        $categorys = $categorys->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($categorys as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return self::jsonSuccess($data);
    }
    public function getForm(Request $request)
    {
        $type = $request->input('type', null);
        $id = $request->input('id', null);
        if(empty($type)){
            self::jsonError('Không có type');
        }
        if (file_exists(base_path('Modules/Category/Resources/views/form/'.$type.'.blade.php'))) {
            if(empty($id)){
                $categorys=null;
                $datas=[];
            }else{
                $categorys = $this->categorys->whereOperator([new Operator('id',$id),new Operator('deleted_at',null)])->builder();
                $datas = json_decode($categorys->data,true);
            }
            return view('category::form.'.$type,compact('categorys','type','datas'));
        }
        return 'false-load';
    }
    public function getBox(Request $request)
    {
        $type = $request->input('type', null);
        $count = $request->input('count', 0);
        if(empty($type)){
            self::jsonError('Không có type');
        }
        if (file_exists(base_path('Modules/Category/Resources/views/box/'.$type.'.blade.php'))) {
//            $categorys = $this->categorys->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder();
            $categorys = '';
            return view('category::box.'.$type,compact('categorys','type','count'));
        }
        return 'false-load';
    }
}

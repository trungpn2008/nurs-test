<?php

namespace Modules\Projects\Http\Controllers;

use App\Data\Operator;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Alias\Entities\Alias;
use Modules\BlueprintType\Entities\BlueprintType;
use Modules\Category\Entities\Category;
use Modules\Images\Entities\Images;
use Modules\Projects\Entities\Projects;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $projects;
    private $alias;
    private $images;
    private $category;
    private $bluesprint;
    private $history_activity;
    function __construct()
    {
        $this->projects = new Projects();
        $this->alias = new Alias();
        $this->images = new Images();
        $this->category = new Category();
        $this->bluesprint = new BlueprintType();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Projects']) || in_array('projects.index',isset($pemission['perms']['Projects'])?$pemission['perms']['Projects']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        DB::enableQueryLog();
        //        $data['projects'] = $this->projects->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $projects = $this->projects
            ->select(['category.title as category_title','projects.id','projects.image','projects.title','projects.arrange','projects.status','projects.hot','projects.created_at','projects.updated_at','users.name'])
            ->join(new Operator(null,null,'category','projects.category_id','category.id'))
            ->join(new Operator(null,null,'users','projects.creator','users.id'),)
            ->whereOperator(new Operator('projects.deleted_at',null));
        if($request->keyword){
            $projects = $projects->whereOperator(new Operator('projects.title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        if($request->category){
            $projects = $projects->whereOperator(new Operator('projects.category_id',$request->category));
            $search['category']=$request->category;
            $data['category']= $this->category->select(['id','title'])->whereOperator([new Operator('deleted_at',null),new Operator('id',$request->category),new Operator('status',1)])->builder();
        }

        if($request->status != 'all' && $request->status != ''){
            $projects = $projects->whereOperator(new Operator('projects.status',$request->status));

        }
        $search['status']=$request->status;
        $projects = $projects->orderByDesc('projects.created_at')->paging($data['per_page'],$data['page'],false);
        $data['projects'] = $projects;
        $data['search'] = $search;
        //        dd(DB::getQueryLog(),$data['per_page']);
        //        dd($data);
        $this->history_activity->addHistory('Xem danh sách dự án','Projects','View','Tài khoản '.Auth::user()->name.' xem danh sách dự án','Mở xem danh sách dự án','Nomal');
        return view('projects::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Projects']) || in_array('projects.add',isset($pemission['perms']['Projects'])?$pemission['perms']['Projects']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $this->history_activity->addHistory('Vào trang thêm dự án','Projects','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm dự án','Vào trang thêm dự án','Nomal');
        return view('projects::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Projects']) || in_array('projects.add',isset($pemission['perms']['Projects'])?$pemission['perms']['Projects']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();$data_chosse= ['utilities'=>isset($data['utilities'])?$data['utilities']:null,'blueprint'=>isset($data['blueprint'])?$data['blueprint']:null,'reasonbuy'=>isset($data['reasonbuy'])?$data['reasonbuy']:null,'library'=>isset($data['library'])?$data['library']:null,'image_sale'=>isset($data['image_sale'])?$data['image_sale']:null,'image_info'=>isset($data['image_info'])?$data['image_info']:null,'image_location'=>isset($data['image_location'])?$data['image_location']:null];
//            dd($data);
        unset($data['_token']);unset($data['utilities']);unset($data['blueprint']);unset($data['reasonbuy']);unset($data['library']);unset($data['image_sale']);unset($data['image_info']);;unset($data['image_location']);
        $data['created_at'] = $data['updated_at'] =now();
        $data['creator'] = $data['updater'] = Auth::user()->id;
        $data['hot'] = isset($data['hot']) && $data['hot']==='on'?1:0;
        $data['data'] = json_encode($data_chosse);
        $projects = $this->projects->insertData($data);
        if($projects){
            $data_all = [];
            if($data_chosse['utilities']){
                foreach ($data_chosse['utilities'] as $utility) {
                    $data_all[]=['title'=>$utility['title'],'image'=>$utility['image'],'project_id'=>$projects,'blueprint_type_id'=>null,'type'=>'Utilities','arrange'=>$utility['arrange'],'number'=>$utility['number'],'status'=>isset($utility['status']) && $utility['status']==='on'?1:0,'created_at'=>now(),'updated_at'=>now()];
                }
            }
            if($data_chosse['blueprint']){
                foreach ($data_chosse['blueprint'] as $item) {
                    $data_all[]=['title'=>$item['title'],'image'=>$item['image'],'project_id'=>$projects,'blueprint_type_id'=>$item['blueprint_id'],'type'=>'Blueprint','arrange'=>$item['arrange'],'number'=>$item['number'],'status'=>isset($item['status']) && $item['status']==='on'?1:0,'created_at'=>now(),'updated_at'=>now()];
                }
            }
            if($data_chosse['library']){
                foreach ($data_chosse['library'] as $item) {
                    $data_all[]=['title'=>$item['title'],'image'=>$item['image'],'project_id'=>$projects,'blueprint_type_id'=>null,'type'=>'Library','arrange'=>$item['arrange'],'number'=>$item['number'],'status'=>isset($item['status']) && $item['status']==='on'?1:0,'created_at'=>now(),'updated_at'=>now()];
                }
            }
//                dd(array_merge($data_all,[['title'=>'Ưu đãi '.$data['title'],'image'=>$data_chosse['image_sale'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'status'=>1,'type'=>'Sale'],['title'=>'Tổng quan '.$data['title'],'image'=>$data_chosse['image_info'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'status'=>1,'type'=>'Overview'],['title'=>'Vị trí '.$data['title'],'image'=>$data_chosse['image_location'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'status'=>1,'type'=>'Location']]));
            $this->images->insertData(array_merge($data_all,[['title'=>'Ưu đãi '.$data['title'],'image'=>$data_chosse['image_sale'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Sale','created_at'=>now(),'updated_at'=>now()],['title'=>'Tổng quan '.$data['title'],'image'=>$data_chosse['image_info'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Overview','created_at'=>now(),'updated_at'=>now()],['title'=>'Vị trí '.$data['title'],'image'=>$data_chosse['image_location'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Location','created_at'=>now(),'updated_at'=>now()]]),true);
//            $check_alias = $this->alias->whereOperator([new Operator('status',1),new Operator('deleted_at',null),new Operator('project_id',$projects)])->builder();
            $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
                    ->where('project_id','!=',null)
                ->where(function ($query) use ($data){
                    $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                    $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                })->get();
            if(count($check_alias)<=0){
                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'project_id'=>$projects,'created_at'=>now(),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
            }else{
                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))).'-'.(count($check_alias)+1),'project_id'=>$projects,'created_at'=>now(),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
            }
            $this->history_activity->addHistory('Thêm dự án thành công','Projects','Add','Tài khoản '.Auth::user()->name.' thêm dự án thành công','Thêm dự án','Success',$projects);
            return redirect()->route('admin.projects.index')->with('success','Thêm dự án thành công');
        }
        $this->history_activity->addHistory('Thêm dự án không thành công','Projects','Add','Tài khoản '.Auth::user()->name.' thêm dự án không thành công','Thêm dự án','Error');
        return back()->with('error','Thêm dự án không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết dự án','Projects','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết dự án','Vào xem chi tiết dự án','Nomal',$id);
        return view('projects::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Projects']) || in_array('projects.edit',isset($pemission['perms']['Projects'])?$pemission['perms']['Projects']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['projects'] = $this->projects->whereOperator(new Operator('id',$id))->builder();
        $data['blueprinttype'] = $this->bluesprint->whereOperator(new Operator('status',1))->builder(false);
        $data['category'] = $this->category->whereOperator(new Operator('id',$data['projects']->category_id))->builder();
        $data['project_data'] = json_decode($data['projects']->data,true);
        $this->history_activity->addHistory('Vào trang sửa dự án','Projects','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa dự án','Vào trang sửa dự án','Nomal',$id);
        return view('projects::edit',$data);
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
        if((!isset($pemission['perms']['Projects']) || in_array('projects.edit',isset($pemission['perms']['Projects'])?$pemission['perms']['Projects']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();$data_chosse= ['utilities'=>isset($data['utilities'])?$data['utilities']:null,'blueprint'=>isset($data['blueprint'])?$data['blueprint']:null,'reasonbuy'=>isset($data['reasonbuy'])?$data['reasonbuy']:null,'library'=>isset($data['library'])?$data['library']:null,'image_sale'=>isset($data['image_sale'])?$data['image_sale']:null,'image_info'=>isset($data['image_info'])?$data['image_info']:null,'image_location'=>isset($data['image_location'])?$data['image_location']:null];
        unset($data['_token']);unset($data['utilities']);unset($data['blueprint']);unset($data['reasonbuy']);unset($data['library']);unset($data['image_sale']);unset($data['image_info']);;unset($data['image_location']);
        $data['updated_at'] =now();
        $data['hot'] = isset($data['hot']) && $data['hot']==='on'?1:0;
        $data['updater'] = Auth::user()->id;
        $data['data'] = json_encode($data_chosse);
        if($id){
            $projects = $this->projects->updateData($data,$id);
            $data_all = [];
            if($data_chosse['utilities']){
                foreach ($data_chosse['utilities'] as $utility) {

                    $check = $this->checkImage('Utilities',$utility['number'],$id);

                    if($check){
                        (new Images())->updateData(['title'=>$utility['title'],'image'=>$utility['image'],'project_id'=>$id,'blueprint_type_id'=>null,'type'=>'Utilities','arrange'=>$utility['arrange'],'number'=>$utility['number'],'status'=>isset($utility['status']) && $utility['status']==='on'?1:0,'updated_at'=>now()],$check->id);
                    }else{
                        $data_all[]=['title'=>$utility['title'],'image'=>$utility['image'],'project_id'=>$id,'blueprint_type_id'=>null,'type'=>'Utilities','arrange'=>$utility['arrange'],'number'=>$utility['number'],'status'=>isset($utility['status']) && $utility['status']==='on'?1:0,'created_at'=>now(),'updated_at'=>now()];
                    }
                }
            }
            if($data_chosse['blueprint']){
                foreach ($data_chosse['blueprint'] as $item) {
                    $check = $this->checkImage('Blueprint',$item['number'],$id);
                    if($check){
                        (new Images())->updateData(['title'=>$item['title'],'image'=>$item['image'],'project_id'=>$id,'blueprint_type_id'=>$item['blueprint_id'],'type'=>'Blueprint','arrange'=>$item['arrange'],'number'=>$item['number'],'status'=>isset($item['status']) && $item['status']==='on'?1:0,'updated_at'=>now()],$check->id);
                    }else{
                        $data_all[]=['title'=>$item['title'],'image'=>$item['image'],'project_id'=>$id,'blueprint_type_id'=>$item['blueprint_id'],'type'=>'Blueprint','arrange'=>$item['arrange'],'number'=>$item['number'],'status'=>isset($item['status']) && $item['status']==='on'?1:0,'created_at'=>now(),'updated_at'=>now()];
                    }
                }
            }
            if($data_chosse['library']){
                foreach ($data_chosse['library'] as $item) {
                    $check = $this->checkImage('Library',$item['number'],$id);
                    if($check){
                        (new Images())->updateData(['title'=>$item['title'],'image'=>$item['image'],'project_id'=>$id,'blueprint_type_id'=>null,'type'=>'Library','arrange'=>$item['arrange'],'number'=>$item['number'],'status'=>isset($item['status']) && $item['status']==='on'?1:0,'updated_at'=>now()],$check->id);
                    }else{
                        $data_all[]=['title'=>$item['title'],'image'=>$item['image'],'project_id'=>$id,'blueprint_type_id'=>null,'type'=>'Library','arrange'=>$item['arrange'],'number'=>$item['number'],'status'=>isset($item['status']) && $item['status']==='on'?1:0,'created_at'=>now(),'updated_at'=>now()];
                    }
                }
            }
            $check_img_sale = $this->checkImage('Sale',null,$id);
            if($check_img_sale){
                (new Images())->updateData(['title'=>'Ưu đãi '.$data['title'],'image'=>$data_chosse['image_sale'],'project_id'=>$id,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Sale','updated_at'=>now()],$check_img_sale->id);
            }else{
                $data_all[]=['title'=>'Ưu đãi '.$data['title'],'image'=>$data_chosse['image_sale'],'project_id'=>$id,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Sale','created_at'=>now(),'updated_at'=>now()];
            }
            $check_overview = $this->checkImage('Overview',null,$id);
            if($check_overview){
                (new Images())->updateData(['title'=>'Tổng quan '.$data['title'],'image'=>$data_chosse['image_info'],'project_id'=>$id,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Overview','updated_at'=>now()],$check_overview->id);
            }else{
                $data_all[]=['title'=>'Tổng quan '.$data['title'],'image'=>$data_chosse['image_info'],'project_id'=>$id,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Overview','created_at'=>now(),'updated_at'=>now()];
            }
            $check_location = $this->checkImage('Location',null,$id);
            if($check_location){
                (new Images())->updateData(['title'=>'Vị trí '.$data['title'],'image'=>$data_chosse['image_location'],'project_id'=>$id,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Location','updated_at'=>now()],$check_location->id);
            }else{
                $data_all[]=['title'=>'Vị trí '.$data['title'],'image'=>$data_chosse['image_location'],'project_id'=>$id,'blueprint_type_id'=>null,'arrange'=>null,'number'=>null,'status'=>1,'type'=>'Location','created_at'=>now(),'updated_at'=>now()];
            }
//                dd(array_merge($data_all,[['title'=>'Ưu đãi '.$data['title'],'image'=>$data_chosse['image_sale'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'status'=>1,'type'=>'Sale'],['title'=>'Tổng quan '.$data['title'],'image'=>$data_chosse['image_info'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'status'=>1,'type'=>'Overview'],['title'=>'Vị trí '.$data['title'],'image'=>$data_chosse['image_location'],'project_id'=>$projects,'blueprint_type_id'=>null,'arrange'=>null,'status'=>1,'type'=>'Location']]));
//            $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
////                    ->where('category_id','!=',$id)
//                ->where(function ($query) use ($data){
//                    $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                    $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                })->get();
//            if(count($check_alias)<=0){
//                DB::table('alias')->where(['project_id'=>$id])->update(['deleted_at'=>now()]);
//                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'project_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                if($alias){
//                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                }
//                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//            }elseif(count($check_alias)>0 && count($check_alias)<2){
                $alias = DB::table('alias')->where(['status'=>1,'deleted_at'=>null,'project_id'=>$id])->update(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//            } else{
//                DB::table('alias')->where(['project_id'=>$id])->update(['deleted_at'=>now()]);
//                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'project_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                if($alias){
//                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                }
//                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//            }
            (new Images())->insertData($data_all,true);

            if($projects){
                $this->history_activity->addHistory('Sửa dự án thành công','Projects','Edit','Tài khoản '.Auth::user()->name.' Sửa dự án thành công','sửa dự án','Success',$id);
                return redirect()->route('admin.projects.index')->with('success','Sửa dự án thành công');
            }
            $this->history_activity->addHistory('Sửa dự án không thành công','Projects','Edit','Tài khoản '.Auth::user()->name.' Sửa dự án không thành công','sửa dự án','Error');
            return back()->with('error','Sửa dự án không thành công');
        }
        $this->history_activity->addHistory('Sửa dự án không tìm thấy bản ghi','Projects','Edit','Tài khoản '.Auth::user()->name.' Sửa dự án không tìm thấy bản ghi','sửa dự án không tìm thấy bản ghi','Error');
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
        if((!isset($pemission['perms']['Projects']) || in_array('projects.delete',isset($pemission['perms']['Projects'])?$pemission['perms']['Projects']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $projects = $this->projects->del(new Operator('id',$id));
            if($projects){
                DB::table('alias')->where(['project_id'=>$id])->update(['deleted_at'=>now()]);
                $this->history_activity->addHistory('Xóa dự án thành công','Projects','Delete','Tài khoản '.Auth::user()->name.' Xóa dự án thành công','Xóa dự án','Success',$id);
                return redirect()->route('admin.projects.index')->with('success','Xóa dự án thành công');
            }
            $this->history_activity->addHistory('Xóa dự án không thành công','Projects','Delete','Tài khoản '.Auth::user()->name.' Xóa dự án không thành công','Xóa dự án','Error');
            return back()->with('error','Xóa dự án không thành công');
        }
        $this->history_activity->addHistory('Xóa dự án không tìm thấy bản ghi','Projects','Delete','Tài khoản '.Auth::user()->name.' Xóa dự án không tìm thấy bản ghi','Xóa dự án không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function getBox(Request $request)
    {
        $type = $request->input('type', null);
        $count = $request->input('count', 0);
        if(empty($type)){
            self::jsonError('Không có type');
        }
        if (file_exists(base_path('Modules/Projects/Resources/views/box/'.$type.'.blade.php'))) {
//            $categorys = $this->categorys->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder();
            $projects = '';
            return view('projects::box.'.$type,compact('projects','type','count'));
        }
        return 'false-load';
    }
    public static function getImage($project_id,$type,$number=null,$blueprint = null,$oneRaw = true){

        $image = (new Images())->select('image')->whereOperator([new Operator('project_id',$project_id),new Operator('type',$type)]);
        if($number){
            $image = $image->whereOperator(new Operator('number',$number));
        }
        if($blueprint){
            $image = $image->whereOperator(new Operator('blueprint_type_id',$blueprint));
        }
        $image = $image->builder($oneRaw);
        if($oneRaw){
            return !empty($image)?$image->image:null;
        }
        return !empty($image)?$image:null;
    }
    public static function getBlueprintType($id){
        $image = (new BlueprintType())->select('title')->whereOperator([new Operator('id',$id),new Operator('status',1)])->builder();
        return $image->title;
    }
    public function checkImage($type,$number,$id){
        $image = $this->images->whereOperator([new Operator('type',$type),new Operator('number',$number),new Operator('project_id',$id)])->builder();
        return $image;
    }
    public function getProjects(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $id = $request->input('id', '');
        $type = $request->input('type', null);
        $offset = ($page - 1) * $size;
        $categorys = $this->projects->select(['id','title'])->whereOperator([new Operator('deleted_at',null),new Operator('status',1)]);
        if ($keyword) {
            $categorys = $categorys->whereOperator([new Operator('title','%'.$keyword.'%',null,null,null,null,'like')]);
        }
        if ($id) {
            $categorys = $categorys->whereOperator([new Operator('id',$id,null,null,null,null,'!=')]);
        }
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
}

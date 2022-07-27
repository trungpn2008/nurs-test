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
use Modules\Alias\Entities\Alias;
use Modules\Category\Entities\Category;
use Modules\News\Entities\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $news;
    private $history_activity;
    private $alias;
    private $category;
    function __construct()
    {
        $this->news = new News();
        $this->category = new Category();
        $this->history_activity = new HistoryActivity();
        $this->alias = new Alias();
    }

    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['News']) || in_array('news.index',isset($pemission['perms']['News'])?$pemission['perms']['News']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 3);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách bài viết';
        $search = ['keyword'=>'','category'=>''];
        DB::enableQueryLog();
//        $data['news'] = $this->news->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $news = $this->news
            ->select(['news.id','news.image','news.title','news.arrange','news.short_description','news.status','news.view','news.created_at','news.updated_at','users.name','category.title as cate_name'])
            ->join([
                new Operator(null,null,'category','news.category_id','category.id'),
                new Operator(null,null,'users','news.creator','users.id'),
            ])
            ->whereOperator([new Operator('news.deleted_at',null),new Operator('news.status',1)]);
        if($request->keyword){
            $news = $news->whereOperator(new Operator('news.title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        if($request->category){
            $news = $news->whereOperator(new Operator('news.category_id',$request->category));
            $search['category']=$request->category;
            $data['category']= $this->category->select(['id','title'])->whereOperator([new Operator('deleted_at',null),new Operator('id',$request->category),new Operator('status',1)])->builder();
        }
        $news = $news->orderByDesc('news.created_at')->paging($data['per_page'],$data['page'],false);
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
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['News']) || in_array('news.add',isset($pemission['perms']['News'])?$pemission['perms']['News']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
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
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['News']) || in_array('news.add',isset($pemission['perms']['News'])?$pemission['perms']['News']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $data['status'] = 1;
        $data['creator'] = $data['updater'] =Auth::user()->id;
        $new = $this->news->insertData($data);
        if($new){
//            $check_alias = $this->alias->whereOperator([new Operator('status',1),new Operator('deleted_at',null),new Operator('news_id',$new)])->builder();
            $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
                ->where('news_id','!=',null)
                ->where(function ($query) use ($data){
                    $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                    $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
                })->get();
            if(count($check_alias)<=0){
                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'news_id'=>$new,'created_at'=>now(),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
            }else{
                $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))).'-'.(count($check_alias)+1),'news_id'=>$new,'created_at'=>now(),'updated_at'=>now()]);
                if($alias){
                    $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
                }
                $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
            }
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
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['News']) || in_array('news.edit',isset($pemission['perms']['News'])?$pemission['perms']['News']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào edit!');
        }
        $data['new'] = $this->news
            ->select(['news.title','news.type','news.status','news.image','news.category_id','news.project_id','news.alias','news.arrange','news.short_description','news.note','news.hashtag','news.description','news.source','category.title as parent_title','projects.title as project_title','category_type.id as cate_type_id','category_type.status as cate_type_status','category_type.title as cate_type_title'])
            ->join(new Operator(null,null,'category_type','news.type','category_type.code'))
            ->join(new Operator(null,null,'category','category.id','news.category_id'))
            ->join(new Operator(null,null,'projects','projects.id','news.project_id'))
            ->whereOperator(new Operator('news.id',$id))->builder();
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
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['News']) || in_array('news.edit',isset($pemission['perms']['News'])?$pemission['perms']['News']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        $data['updater']  =Auth::user()->id;
        if($id){
            $new = $this->news->updateData($data,$id);
            if($new){
//                $check_alias = $this->alias->whereOperator([new Operator('status',1),new Operator('deleted_at',null),new Operator('news_id',$id)])->builder();
//                $check_alias = $this->alias->where(['status'=>1,'deleted_at'=>null])
////                    ->where('category_id','!=',$id)
//                    ->where(function ($query) use ($data){
//                        $query->where('slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                        $query->orWhere('sub_slug',str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))));
//                    })->get();
//                if(count($check_alias)<=0){
//                    DB::table('alias')->where(['news_id'=>$id])->update(['deleted_at'=>now()]);
//                    $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'news_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                    if($alias){
//                        $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                    }
//                    $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//                }elseif(count($check_alias)>0 && count($check_alias)<2) {
                    $alias = DB::table('alias')->where(['status'=>1,'deleted_at'=>null,'news_id'=>$id])->update(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'updated_at'=>now()]);
                    if($alias){
                        $this->history_activity->addHistory('Sửa alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' sửa alias thành công','Sửa alias','Success',$id);
                    }
                    $this->history_activity->addHistory('Sửa alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' sửa alias không thành công','Sửa alias','Error',$id);
//                }else{
//                    DB::table('alias')->where(['news_id'=>$id])->update(['deleted_at'=>now()]);
//                    $alias = $this->alias->insertData(['title'=>$data['title'],'slug'=>str_replace([' ','/','\\','"',"'",',','.',':',';'],'-',strtolower(self::stripVN($data['title']))),'news_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);
//                    if($alias){
//                        $this->history_activity->addHistory('Thêm alias thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias thành công','Thêm alias','Success',$alias);
//                    }
//                    $this->history_activity->addHistory('Thêm alias không thành công','Alias','Add','Tài khoản '.Auth::user()->name.' thêm alias không thành công','Thêm alias','Error');
//                }
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
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['News']) || in_array('news.delete',isset($pemission['perms']['News'])?$pemission['perms']['News']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền xóa!');
        }
        if($id){
            $new = $this->news->del(new Operator('id',$id));
            if($new){
                DB::table('alias')->where(['news_id'=>$id])->update(['deleted_at'=>now()]);
                $this->history_activity->addHistory('Xóa bài viết thành công','New','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết thành công','Xóa bài viết','Success',$id);
                return redirect()->route('admin.news.index')->with('success','Xóa bài viết thành công');
            }
            $this->history_activity->addHistory('Xóa bài viết không thành công','New','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không thành công','Xóa bài viết','Error',$id);
            return back()->with('error','Xóa bài viết không thành công');
        }
        $this->history_activity->addHistory('Xóa bài viết không tìm thấy bản ghi','New','Delete','Tài khoản '.Auth::user()->name.' Xóa bài viết không tìm thấy bản ghi','Xóa bài viết không tìm thấy bản ghi','Error',$id);
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function listArticle(Request $request)
    {
        $data['per_page'] = $request->input('per_page',3);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $news = $this->news
            ->select(['news.id','news.image','news.title','news.arrange','news.short_description','news.status','news.view','news.created_at','news.updated_at','users.name','category.title as cate_name','category_type.id as cate_type_id','category_type.status as cate_type_status','category_type.title as cate_type_title'])
            ->join([
                new Operator(null,null,'category_type','news.type','category_type.code'),
                new Operator(null,null,'category','news.category_id','category.id'),
                new Operator(null,null,'users','news.creator','users.id'),
            ])
            ->whereOperator([new Operator('news.deleted_at',null),new Operator('news.status',1)]);
        if($request->keyword){
            $news = $news->whereOperator(new Operator('news.title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        if($request->category){
            $news = $news->whereOperator(new Operator('news.category_id',$request->category));
            $search['category']=$request->category;
            $data['category']= $this->category->select(['id','title'])->whereOperator([new Operator('deleted_at',null),new Operator('id',$request->category),new Operator('status',1)])->builder();
        }
        $news = $news->orderByDesc('news.created_at')->paging($data['per_page'],$data['page'],false);
        $data['news']=$news;
        return $this->responseAPI($data,'Lấy dữ liệu thành công',200);
    }
    public function listPopular(Request $request)
    {
        $data['per_page'] = $request->input('per_page',5);
//        dd($data['per_page']);
        $data['page'] = $request->input('page',1);
        $news = $this->news
            ->select(['news.id','news.image','news.title','news.short_description','news.arrange','news.status','news.view',DB::raw("DATE_FORMAT(`news`.`created_at`, '%Y.%d.%m') as date"),'news.updated_at','users.name','category.title as cate_name','category_type.id as cate_type_id','category_type.status as cate_type_status','category_type.title as cate_type_title'])
            ->join([
                new Operator(null,null,'category_type','news.type','category_type.code'),
                new Operator(null,null,'category','news.category_id','category.id'),
                new Operator(null,null,'users','news.creator','users.id'),
            ])
            ->whereOperator([new Operator('news.deleted_at',null),new Operator('news.status',1)]);
        if($request->keyword){
            $news = $news->whereOperator(new Operator('news.title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        if($request->category){
            $news = $news->whereOperator(new Operator('news.category_id',$request->category));
            $search['category']=$request->category;
            $data['category']= $this->category->select(['id','title'])->whereOperator([new Operator('deleted_at',null),new Operator('id',$request->category),new Operator('status',1)])->builder();
        }
        $news = $news->orderByDesc('news.view')->paging($data['per_page'],$data['page'],false);
        $data['news']=$news;
        return $this->responseAPI($news,'Lấy dữ liệu thành công',200);
    }
    public function listDetail(Request $request)
    {
        $data['id'] = $request->input('id',null);
        if($data['id']){
        $news = $this->news
            ->select(['news.id','news.image','news.title','news.arrange','news.status','news.view','news.created_at','news.updated_at','users.name','category.title as cate_name','category_type.id as cate_type_id','category_type.status as cate_type_status','category_type.title as cate_type_title'])
            ->join([
                new Operator(null,null,'category_type','news.type','category_type.code'),
                new Operator(null,null,'category','news.category_id','category.id'),
                new Operator(null,null,'users','news.creator','users.id'),
            ])
            ->whereOperator([new Operator('news.deleted_at',null),new Operator('news.status',1)]);

            $news = $news->whereOperator(new Operator('news.id',$data['id']));
            $search['keyword']=$request->keyword;
            $news = $news->orderByDesc('news.created_at')->builder();
            return $this->responseAPI($news,'Lấy dữ liệu thành công',200);
        }
        return $this->responseAPI([],'Lấy dữ liệu không thành công',500);
    }
}

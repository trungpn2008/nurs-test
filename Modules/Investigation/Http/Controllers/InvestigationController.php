<?php

namespace Modules\Investigation\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\Investigation\Entities\Investigation;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $investigation;
    private $history_activity;
    function __construct()
    {
        $this->investigation = new Investigation();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Investigation']) || in_array('investigation.index',isset($pemission['perms']['Investigation'])?$pemission['perms']['Investigation']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $investigation = $this->investigation->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $investigation = $investigation->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $investigation = $investigation->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['investigation'] = $investigation;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách investigation','Investigation','View','Tài khoản '.Auth::user()->name.' Xem danh sách investigation','Mở xem Xem danh sách investigation','Nomal');
        return view('investigation::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('investigation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['investigation']= $this->investigation->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('id',$id))->builder();
        if($data['investigation']){
            $this->history_activity->addHistory('Vào xem chi tiết investigation','Investigation','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết investigation','Vào xem chi tiết investigation','Nomal',$id);
            return view('investigation::show',$data);
        }else{
            return back()->with('error','Không có tìm thấy bản ghi');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('investigation::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    public function addInvestigation(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $investigation = $this->investigation->insertData($data);
        if($investigation){
            $this->history_activity->addHistory('Thêm investigation thành công','Investigation','Add','Tài khoản '.Auth::user()->name.' thêm investigation thành công','Thêm investigation','Success',$investigation);
            return $this->responseAPI($investigation,'Thêm dữ liệu thành công',200);
        }
        $this->history_activity->addHistory('Thêm investigation không thành công','Investigation','Add','Tài khoản '.Auth::user()->name.' thêm investigation không thành công','Thêm investigation','Error');
        return $this->responseAPI([],'Thêm dữ liệu không thành công',500);
    }
}

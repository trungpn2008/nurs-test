<?php

namespace Modules\Customer\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\HistoryActivity;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Entities\CustomerLoginHistory;
use Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $customer;
    private $customerLoginHistory;
    private $history_activity;
    function __construct()
    {
        $this->customer = new Customer();
        $this->customerLoginHistory = new CustomerLoginHistory();
        $this->history_activity = new HistoryActivity();
    }
    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Customer']) || in_array('customer.index',isset($pemission['perms']['Customer'])?$pemission['perms']['Customer']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        $customers = $this->customer->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $customers = $customers->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));

            $search['keyword']=$request->keyword;
        }
        $customers = $customers->orderByDesc('created_at')->paging($data['per_page'],$data['page'],false);
        $data['customers'] = $customers;
        $data['search'] = $search;
        $this->history_activity->addHistory('Xem danh sách customer','Customer','View','Tài khoản '.Auth::user()->name.' Xem danh sách customer','Mở xem Xem danh sách customer','Nomal');
        return view('customer::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
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
        $data['customer']= $this->customer->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('id',$id))->builder();
        if($data['customer']){
            $this->history_activity->addHistory('Vào xem chi tiết customer','Customer','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết customer','Vào xem chi tiết customer','Nomal',$id);
            return view('customer::show',$data);
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
        return view('customer::edit');
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
    public function register(Request $request)
    {
        $name = $request->input('name',null);
        $nickName = $request->input('nickName',null);
        $furigana = $request->input('furigana',null);
        $email = $request->input('email',null);
        $pass = $request->input('password',null);
        $contact = $request->input('contact',null);
        if(!$name){
            return $this->responseAPI([],'required name',500);
        }
        if(!$nickName){
            return $this->responseAPI([],'required nickname',500);
        }
        if(!$furigana){
            return $this->responseAPI([],'required furigana',500);
        }
        if(!$email){
            return $this->responseAPI([],'required email',500);
        }
        if(!$pass){
            return $this->responseAPI([],'required pass',500);
        }
//        if(!$contact){
//            return $this->responseAPI([],'required contact',500);
//        }
        $customer = $this->customer->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('email',$email))->builder();
        if($customer){
            return $this->responseAPI([],'This email has been register',500);
        }
        $data = [];
        $data_choose = $request->input('data_choose',null);
        unset($data['_token']);
        $data['name'] = $name;
        $data['user_name'] = $nickName;
        $data['furigana'] = $furigana;
        $data['email'] = $email;
        $data['password'] = bcrypt($pass);
        $data['data_choose'] = json_encode($data_choose);
        $data['gender'] = $request->input('gender',null);
        $data['zipcode'] = $request->input('zipcode',null);
        $data['address2'] = $request->input('address2',null);
        $data['address'] = $request->input('address',null);
        $data['phone'] = $request->input('phone',null);
        $data['pass_port'] = $request->input('pass_port',null);
        $data['status'] = 1;
        $data['created_at'] = $data['updated_at'] =now();
        $customer = $this->customer->insertData($data);
        if($customer){
            $this->history_activity->addHistory('Thêm customer thành công','Customer','Add','Guest thêm customer thành công','Thêm customer','Success',$customer);
            return $this->responseAPI($customer,'Tạo tài khoản thành công',200);
        }
        $this->history_activity->addHistory('Thêm customer không thành công','Customer','Add','Guest thêm customer không thành công','Thêm customer','Error');
        return $this->responseAPI([],'Tạo tài khoản không thành công',500);
    }

    public function updateProfile(Request $request)
    {
        try {
            $customer_id = Auth::guard('api')->user()->id;
            $gender= $request->input('gender',null);
            $year_of_birth = $request->input('year_of_birth',null);
            if(!$gender){
                return $this->responseAPI([],'required gender',500);
            }
            if(!$year_of_birth){
                return $this->responseAPI([],'required year of birth',500);
            }
            if(!$customer_id){
                return $this->responseAPI([],'required id',500);
            }
            $customer = $this->customer->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('id',$customer_id))->builder();
            if(!$customer){
                return $this->responseAPI([],'No records found',500);
            }
            $data = [];
            $data_choose = json_decode($customer->data_choose,true);
            $inputChoose = $request->input('data_choose',null);
            if($inputChoose){
                $data_choose = array_merge($data_choose,$inputChoose);
            }
            $avatar = $request->input('avatar',null);
            if($avatar){
                if($customer->avatar === $avatar){
                    $avatar = $customer->avatar;
                }else{
                    $avatar =$this->saveImgBase64($avatar,'uploads');
                }
            }else{
                $avatar = $customer->avatar;
            }

            unset($data['_token']);
            $data['user_name'] = $request->input('nickname',$customer->user_name);
            $data['data_choose'] = json_encode($data_choose);
            $data['avatar'] = $avatar;
            $data['gender'] = $gender;
            $data['year_of_birth'] = $year_of_birth;
            $data['content_profile'] = $request->input('content_profile',$customer->content_profile);
            $customer = $this->customer->updateData($data,$customer_id,'id');
            if($customer){
                $this->history_activity->addHistory('update customer thành công','Customer','Add','Guest update customer thành công','update customer','Success',$customer);
                return $this->responseAPI($customer,'update profile thành công',200);
            }
            $this->history_activity->addHistory('Dữ liệu update không thay đổi','Customer','Add','Guest update customer không thành công','update customer','Error');
            return $this->responseAPI([],'Dữ liệu update không thay đổi',200);
        }catch (Exception $e){
            $this->history_activity->addHistory('update customer không thành công','Customer','Add','Guest update customer không thành công','update customer','Error');
            return $this->responseAPI($e,'Dữ liệu update không thay đổi',500);
        }

    }
    protected function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return 'storage/'.$folder . '/' . $fileName;
    }
    public function login(Request $request)
    {
        if (Auth::guard('client')->attempt(['email' => $request->email,'password' => $request->password, 'deleted_at' => null, 'status' => 1])) {
            $token = Auth::guard('client')->user()->createToken(env('APP_KEY'));
            if ($request->remember) {
                $token->token->expires_at = Carbon::now()->addYear(1);
            }
            $success['token'] = $token->accessToken;
            $success['user'] = Auth::guard('client')->user();

            return $this->responseAPI($success,'Login thành công',200);
        }
        else {
            return $this->responseAPI([],'Unauthorised',500);
        }
    }

    public function infoCustomer(Request $request)
    {
        $id = Auth::guard('api')->user()->id;
        if($id){
            $customer = $this->customer->whereOperator(new Operator('deleted_at',null))->whereOperator(new Operator('id',$id));
            $customer = $customer->orderByDesc('created_at')->builder();
            $customer->data_choose = json_decode($customer->data_choose,true);
            $customer->date_begin = date('Y',strtotime($customer->created_at))."年".date('m',strtotime($customer->created_at))."月".date('d',strtotime($customer->created_at))."日に参加";
            $customer->age_number = empty($customer->year_of_birth)?"非公開": (int) date('Y',time()) - $customer->year_of_birth;
            return $this->responseAPI($customer,'Lấy dữ liệu thành công',200);
        }
        return $this->responseAPI([],'Không lấy được thông tin customer',500);
    }
    public function checLogin(Request $request)
    {
        if(Auth::guard('api')->check()){
            return $this->responseAPI([],'Tk vẫn giữ đăng nhập',200);
        }
        return $this->responseAPI([],'Tk hết hạn sử dụng, login lại',500);
    }

    public function getCustomer(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
        $customer = $this->customer->select(['id','name'])->whereOperator(new Operator('deleted_at',null));
        if($request->keyword){
            $customer = $customer->whereOperator(new Operator('name','%'.$request->keyword.'%',null,null,null,[],'like'));
        }
        $customer = $customer->orderByDesc('created_at')->builder(false);
        $data = [];
        foreach ($customer as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->name
            ];
        }
        return self::jsonSuccess($data);
    }
}

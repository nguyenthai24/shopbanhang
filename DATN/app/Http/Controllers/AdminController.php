<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use App\Models\Social;
use Socialite;
use App\Models\Login;
use App\Http\Requests;
use App\Rules\Captcha;
use Session;
use Illuminate\Support\Facades\Redirect;

use Validator;
session_start();
class AdminController extends Controller
{   
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect(); //chưa đăng nhập thỳ chả về Redirect về trang facebook  còn nếu đăng nhập rồi thỳ gọi haffm callback_facebook
    }

    public function callback_facebook(){
        // ->user(); là phương thức của facebook
        $provider = Socialite::driver('facebook')->user();

        // kiểm tra provider =  facebook trong tbl_social và lấy id của provider đó luôn
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

        if($account){
            //login in vao trang quan tri  
            // kiểm tra admin_id của tbl_admin vs user trong tbl_social
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $data = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''
                    
                ]);
            }
            //->associate cũng giống save() và thêm dữ liệu của $data và $orang
            $data->login()->associate($orang);
            $data->save();

            $account_name = Login::where('admin_id',$data->user)->first();
            Session::put('admin_name',$data->admin_name);
            Session::put('admin_id',$data->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
        
    }

    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index() {
    	return view('admin_login');
    }
    public function showdashboard() {
        $this->AuthLogin();
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request) {
        //làm việc với model
        // $data = $request->all();
        $messages = [
            'admin_email.required' => 'Làm ơn điền Email',
            'admin_password.required' => 'Làm ơn điền mật khẩu',
            
        ];
        $data = $request->validate([
            //validation laravel 
            'admin_email' => 'required|email',
            'admin_password' => 'required|max:8|min:1',
            'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
        ],$messages);
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($login){
            $login_count = $login->count();
            if($login_count > 0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                return Redirect::to('/admin');
        }



        //lam việc vs DB
    	// // $admin_email = $request->admin_email;
    	// // $admin_password = md5($request->admin_password);

    	// // $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
    	// if($result) {
    	// 	Session::put('admin_name', $result->admin_name);
    	// 	Session::put('admin_id', $result->admin_id);
    		
    	// 	return Redirect::to('dashboard');
    		
    	// }else {
    	// 	Session::put('message', 'Mật khẩu hoặc Tài khoản bị sai');
    	// 	return Redirect::to('/admin');
    	// }
    }
    public function logout (){
        $this->AuthLogin();
    	Session::put('admin_name', null);
    	Session::put('admin_id', null);
    	return Redirect::to('/admin');
    }
}	

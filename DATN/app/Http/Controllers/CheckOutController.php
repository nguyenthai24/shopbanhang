<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use Cart;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Validator;
use App\Rules\Captcha;
session_start();

class CheckOutController extends Controller
{
    public function login_checkout (Request $request) {
        
        //seo
        $meta_desc = 'Thanh toán';
        $meta_keywords = 'Thanh toán';
        $meta_title = 'Thanh toán';
        $url_canonical = $request->url();
        //seo
    	$product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
    	$product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
    	return view('pages.checkout.login_checkout')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);

    }
    public function add_customer (Request $request) {
          $messages = [
            'customer_name.required' => 'Vui lòng nhập họ và tên',
            'customer_phone.min' => 'Vui lòng nhập 5 kí tự',
            'customer_password.min' => 'Vui lòng nhập 5 kí tự',
            'confirm_password.min' => 'Vui lòng nhập 5 kí tự',
            'confirm_password.min' => 'Vui lòng nhập 5 kí tự',
            'customer_phone.integer' => 'Vui lòng nhập số',
            'customer_password.required' => 'Vui lòng nhập mật khẩu',
            'confirm_password.required' => 'Vui lòng nhập mật khẩu',
            'confirm_password.same' => 'Mật khẩu không trùng',
            'customer_email.required' => 'Vui lòng nhập Email',
            'dieukhoan.required' => 'Vui lòng đồng các điều khoản',           
        ];

        $data = $request->validate([
            'customer_name' =>'bail|required|min:5', 
            'customer_phone' =>'bail|required|min:5|integer', 
            'customer_password' =>'bail|required|min:5', 
            'confirm_password' =>'bail|required|same:customer_password|min:5', 
            'customer_email' =>'bail|required|email',
            'dieukhoan' =>'bail|required',       
            'g-recaptcha-response' => new Captcha(), ],$messages);   
       // ]);

        
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_phone'] = $request->customer_phone;

    	//insertGetId($data) là khi mình insert vào rồi, thỳ lấy luôn id vùa insert
    	$customer_id = DB::table('tbl_customer')->insertGetId($data);
    	Session::put('customer_id',$customer_id );
    	Session::put('customer_name', $request->customer_name);
    	return Redirect::to('/checkout');
    }
    public function checkout (Request $request) {

          //seo
        $meta_desc = 'Thanh toán';
        $meta_keywords = 'Thanh toán';
        $meta_title = 'Thanh toán';
        $url_canonical = $request->url();
        //seo
    	$product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();


        $city = City::orderby('matp', 'asc')->get();
        return view('pages.checkout.show_checkout')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('city', $city);
    }
    public function save_checkout_customer(Request $request) {
        $data = array();
      
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id );
        return Redirect::to('/payment');

    }
    public function payment(Request $request) {
            //seo
        $meta_desc = 'Thanh toán';
        $meta_keywords = 'Thanh toán';
        $meta_title = 'Thanh toán';
        $url_canonical = $request->url();
        //seo
        $product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);;
    }
    public function logout_checkout() {
        Session::flush();
        return Redirect('/login-checkout');
    }
    public function login_customer (Request $request) {

        //   $messages = [
        //     'email_account.required' => 'Vui lòng nhập nhập tài khoản',
        //     'password_account.min' => 'Vui lòng nhập mật khẩu',         
        // ];
        // $data = $request->validate([
        //     'email_account' =>'bail|required', 
        //     'password_account' =>'bail|required', 
        // ]);
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id );
            return Redirect::to('/checkout');
        } else {
            Session::put('alert','Đăng nhập không thành công' );
             return Redirect::to('/login-checkout');
        }
    
    }
    public function order_place(Request $request) {
        //seo
        $meta_desc = 'Thanh toán';
        $meta_keywords = 'Thanh toán';
        $meta_title = 'Thanh toán';
        $url_canonical = $request->url();
        //seo
        // insert tbl_payment 
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lí';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // insert tbl_order
        
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id ;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] ='Đang chờ xử lí';
        $order_id = Db::table('tbl_order')->insertGetId($order_data);

        //insert tbl_order_details
        $content = Cart::content();
        foreach($content as $key => $v_content) {   
            $order_d_data['order_id'] =  $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }

        if($data['payment_method'] == 1) {
            echo 'Thanh toán bằng thẻ ATM';
        } elseif($data['payment_method'] == 2) {
            Cart::destroy();
            $product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
            $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
            return view('pages.checkout.cash')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
        } else {
            echo 'Thanh toán bằng thẻ ghi nợ';
        }
        // return Redirect::to('/payment');

    }
    // admin pages

    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
        ->select('tbl_order.*', 'tbl_customer.customer_name')
        ->orderby('tbl_order.order_id', 'desc')->get();

        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }

    public function view_order($order_id){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order_details.order_id')
        // ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_order_details.*')
        ->where('tbl_order.order_id', $order_id)
        ->get();

        $manager_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        
        return view('admin_layout')->with('admin.view_order', $manager_by_id);
    }


    public function select_delivery_home (Request $request) {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'asc')->get();

                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'asc')->get();


                $output .='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function fee_shipping (Request $request) {
        $data = $request->all();
        if($data['matp']) {
            $feeship = Feeship::where('fee_tp', $data['matp'])->where('fee_qh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if($feeship) {
                $count_fee = $feeship->count();
                if ($count_fee > 0) {
                    foreach($feeship as $key => $fee) {
                        Session::put('fee', $fee->fee_feeship);
                        Session::save();
                    }
                }else {
                    Session::put('fee', 25000);
                    Session::save();
                }
                 
            }
           
        }
    }
    public function delete_fee(){
        Session::forget('fee');
        return redirect()->back();
    }

    public function confirm_order(Request $request) {
          $data = $request->all();
          $shipping = new Shipping();
          $shipping->shipping_name = $data['shipping_name'];
          $shipping->shipping_email = $data['shipping_email'];
          $shipping->shipping_address = $data['shipping_address'];
          $shipping->shipping_phone = $data['shipping_phone'];
          $shipping->shipping_note = $data['shipping_note'];
          $shipping->shipping_method = $data['shipping_method'];
          $shipping->save();
          // sau khi save $shipping->shipping_id sẽ lấy shipping_id mới nhất
          $shipping_id = $shipping->shipping_id;
          $checkou_code = substr(md5(microtime()),rand(0,26),5); //tại random 

          $order = new Order();
          // sau khi đăng nhập tài khoản lấy id khách hàng
          $order->customer_id = Session::get('customer_id');
          $order->shipping_id = $shipping_id;
          $order->order_status = 1;
          $order->order_code = $checkou_code;
          date_default_timezone_set('Asia/Ho_Chi_Minh');
          $order->created_at = now();
          //now t
          $order->save();

          if (Session::get('cart') == true ) {
              foreach (Session::get('cart') as $key => $cart) {
                $order_details = new OrderDetails();
                $order_details->order_code = $checkou_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_coupons = $data['order_coupons'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->save();
                } 
            }
        Session::forget('coupons');
        Session::forget('cart');
        Session::forget('fee'); 
    }

           
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use App\Http\Requests;
use App\Models\Coupons;

use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request) {
    	
    	// $productId = $request->productid_hidden;
    	// $qty = $request->qty;
    	// $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

    	// // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    	// //$data['id']  k thể thay đổi, $data['id'] theo Shopping cart
    	// $data['id'] = $product_info->product_id;
    	// $data['qty'] = $qty;
    	// $data['name'] = $product_info->product_name;
    	// $data['price'] = $product_info->product_price;
    	// $data['weight'] ='50';
    	// $data['options']['image'] = $product_info->product_image;
    	// Cart::add($data);
        Cart::destroy();
    	return Redirect::to('/show-cart');
    }
    public function show_cart(Request $request) {

          //seo
        $meta_desc = 'Giỏ hàng';
        $meta_keywords = 'Giỏ hàng';
        $meta_title = 'Giỏ hàng';
        $url_canonical = $request->url();
        //seo
    	$product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
    	$product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

    	return view('pages.cart.show_cart')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
    public function delete_to_cart($rowId) {
    	Cart::update($rowId, 0);
    	return Redirect::to('/show-cart');
    }
    public function update_cart_quantity (Request $request) {
    	$rowId = $request->rowId_cart;
    	$qty = $request->cart_quantity;
    	Cart::update($rowId, $qty);
    	return Redirect::to('/show-cart');
    }



    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();
    }
        public function gio_hang(Request $request){
         //seo
        $meta_desc = 'Giỏ hàng';
        $meta_keywords = 'Giỏ hàng';
        $meta_title = 'Giỏ hàng';
        $url_canonical = $request->url();
        //seo
        $product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        return view('pages.cart.cart_ajax')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    
    }
    public function delete_cart($session_id) {
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart == true) {
            foreach ($cart as $key => $value) {
                if($value['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'xóa sản phẩm trong giỏ hàng thành công');
        }  else {
            return redirect()->back()->with('error', 'xóa sản phẩm trong giỏ hàng thất bại');
        }   
    }
    public function update_cart (Request $request) {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true) {
            foreach ($data['cart_qty'] as $key => $val) {
                // echo $key; echo ra giá trị session_id trong Cart_ajax
                //echo $val; echo ra giá trị qty trong form  trong Cart_ajax
                // echo '<br>';
                foreach($cart as $session => $val1) {
                    if($val1['session_id'] == $key) {
                        //sẽ update $cart mang cái Session_id đó vs product_qty dc gán trị $val
                        $cart[$session]['product_qty'] = $val;
                    }
                }
            }
            Session::put('cart', $cart);
            // đăt cái cart mới
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật số lượng thất bại');
        }
    }

    public function delete_all_product() {
        $cart = Session::get('cart');
        if($cart == true) {
            Session::forget('cart');
            Session::forget('coupons');
            return redirect()->back()->with('message', 'Xóa hết sản phẩm trong giỏ hàng thành công');
        }
    }

    // coupons

    public function check_coupons(Request $request){
        $data = $request->all();
        $coupons = Coupons::where('coupons_code',$data['coupons'])->first();
        if($coupons == true){
            $count_coupons = $coupons->count();
            if($count_coupons > 0){
                $coupons_session = Session::get('coupons');
                if($coupons_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable == 0){
                        $cou[] = array(
                            'coupons_code' => $coupons->coupons_code,
                            'coupons_condition' => $coupons->coupons_condition,
                            'coupons_number' => $coupons->coupons_number,

                        );
                        Session::put('coupons',$cou);
                    }
                } else{
                    $cou[] = array(
                            'coupons_code' => $coupons->coupons_code,
                            'coupons_condition' => $coupons->coupon_condition,
                            'coupons_number' => $coupons->coupons_number,

                        );
                    Session::put('coupons',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }

    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use Mail;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{
    public function index (Request $request) {
    //seo
        $meta_desc = 'Hàng 100% chính hãng được phân phối bởi hệ thống bán lẻ cùng với nhiều khuyến mãi hấp dẫn, bảo hành chính hãng. Mua trực tuyến';
        $meta_keywords = 'dien thoai di dong, điện thoại di động, phụ kiện điện thoại';
        $meta_title = 'điện thoại di động chính hãng, phụ kiện điện thoại';
        $url_canonical = $request->url();
    //seo
    	$product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
    	$product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
    	$all_product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(8)->get();
    	return view('pages.home')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical); //cach 1

        //compact tự lấy key theo biến mk đặt
        // return view('pages.home')->with(compact('product_cate', 'product_brand', 'all_product', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
    public function search(Request $request) {

          //seo
        $meta_desc = 'Tìm kiếm sản phẩm';
        $meta_keywords = 'Tìm kiếm sản phẩm';
        $meta_title = 'Tìm kiếm sản phẩm';
        $url_canonical = $request->url();
        //seo

    	$keyword = $request->keyword_submit;
    	$product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
    	$product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
    	$search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keyword.'%')->get();

    	return view('pages.product.search')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('search_product', $search_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);


       
    }

    // public function send_mail() {
    //      //send mail
    //             $to_name = "Nguyễn Văn Thái";
    //             $to_email = "nguyenvanthai.humg24@gmail.com";//send to this email
               
             
    //             $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
                
    //             Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

    //                 $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
    //                 $message->from($to_email,$to_name);//send from this mail

    //             });
    //             // return redirect('/')->with('message','');
    //             //--send mail
    // }
}

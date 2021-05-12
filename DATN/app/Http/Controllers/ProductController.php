<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductController extends Controller
{ 
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product() {
       $this->AuthLogin();
    	$product_cate = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
    	$product_brand = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

   		return view('admin.add_product')->with('product_cate', $product_cate)->with('product_brand', $product_brand);
   }
   public function all_product() {
   	  $this->AuthLogin();
      $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
      $manager_product  = view('admin.all_product')->with('all_product',$all_product);
      return view('admin_layout')->with('admin.all_product', $manager_product);
    
   }
   public function save_product(Request $request) {
     $this->AuthLogin();
   		$data = array();
   		// $data['name']  đặt theo tên cột tbl_product
   		$data['product_name'] = $request->product_name;
      $data['product_slug'] = $request->product_slug;
      $data['meta_keywords'] = $request->meta_keywords;
   		$data['product_price'] = $request->product_price;
      $data['product_price_old'] = $request->product_price_old;
   		$data['product_desc'] = $request->product_desc;
   		$data['product_content'] = $request->product_content;
   		$data['product_status'] = $request->product_status;
   		$data['category_id'] = $request->product_cate;
   		$data['brand_id'] = $request->product_brand;
   		// $data['product_image'] = $request->product_brand;

   		$get_image = $request->file('product_image');
   		// echo '<pre>';
   		// print_r ($data);
   		// echo '</pre>';
   		if($get_image) {
   			$get_name_image = $get_image->getClientOriginalName();
   			$name_image = current(explode('.',$get_name_image ));
   			//getClienOriginalExtension() thêm đuôi mở rộng của file ảnh
   			$new_image = $name_image.'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('public/uploads/products', $new_image);
   			$data['product_image'] = $new_image;
   			DB::table('tbl_product')->insert($data);
	   		Session::put('message', 'Thêm sản phẩm thành công');
	   		return Redirect::to('/all-product');
   		}
   		$data['product_image'] = '';
   		DB::table('tbl_product')->insert($data);
   		Session::put('message', 'Thêm sản phẩm thành công');
   		return Redirect::to('/all-product');
   }
   //update(['status'=>0]) là update theo mảng giá trị
   public function unactive_product ($product_id) {
     $this->AuthLogin();
   		DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
   		Session::put('message', 'Không kích hoạt sản phẩm hành công');
   		return Redirect::to('/all-product');
   }
   public function active_product($product_id){
        $this->AuthLogin();
    	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
    	Session::put('message',' Kích hoạt sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function edit_product ($product_id) {
       $this->AuthLogin();
    	$product_cate = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
    	$product_brand = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
    	$edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();

    	$manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('product_cate', $product_cate)->with('product_brand', $product_brand);

    	return view('admin_layout')->with('admin.edit_product', $manager_product);

    	 


    }

    public function	update_product (Request $request, $product_id) {
       $this->AuthLogin();
    	$data = array();
   		// $data['name']  đặt theo tên cột tbl_product
   		$data['product_name'] = $request->product_name;
      $data['product_slug'] = $request->product_slug;
      $data['meta_keywords'] = $request->meta_keywords;
   		$data['product_price'] = $request->product_price;
      $data['product_price_old'] = $request->product_price_old;
   		$data['product_desc'] = $request->product_desc;
   		$data['product_content'] = $request->product_content;
   		$data['product_status'] = $request->product_status;
   		$data['category_id'] = $request->product_cate;
   		$data['brand_id'] = $request->product_brand;
   		$get_image = $request->file('product_image');
   		// echo '<pre>';
   		// print_r ($data);
   		// echo '</pre>';
   		if($get_image) {
   			$get_name_image = $get_image->getClientOriginalName();
   			$name_image = current(explode('.',$get_name_image ));
   			//getClienOriginalExtension() thêm đuôi mở rộng của file ảnh
   			$new_image = $name_image.'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('public/uploads/products', $new_image);
   			$data['product_image'] = $new_image;
   			DB::table('tbl_product')->where('product_id', $product_id)->update($data);
	   		Session::put('message', 'cập nhật sản phẩm thành công');
	   		return Redirect::to('/all-product');
   		}
   		
   		DB::table('tbl_product')->where('product_id', $product_id)->update($data);
   		Session::put('message', 'cập nhật sản phẩm thành công');
   		return Redirect::to('/all-product');
    }
    public function delete_product ($product_id) {
       $this->AuthLogin();
     DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message',' Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //end admin pages

    public function show_product( Request $request, $product_slug) {
      $product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
      $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

      $details_product =  DB::table('tbl_product')
      ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
      ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
      ->where('tbl_product.product_slug', $product_slug)->get();

       foreach($details_product as $key => $val){
                $category_id = $val->category_id; // lấy các sp liên quan the0 danh mục sản phâ
                //seo
                $meta_desc = $val->product_content; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->product_name;
                $url_canonical = $request->url();
            
                }
      $relate_product =  DB::table('tbl_product')
      ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
      ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
      ->where('tbl_category_product.category_id', $category_id)
      ->whereNotIn('tbl_product.product_slug',[$product_slug])
      ->get();


      return view('pages.product.show_details')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('details_product', $details_product)->with('relate_product', $relate_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}

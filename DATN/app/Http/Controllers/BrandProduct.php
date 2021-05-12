<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use App\Models\Brand;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProduct extends Controller
{
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product() {
      $this->AuthLogin();
   		return view('admin.add_brand_product');
   }
   public function all_brand_product() {
    $this->AuthLogin();
   		// get lấy toàn bộ dữ liệu trong tbl
   		// $all_brand_product = DB::table('tbl_brand')->get(); // là cách sử dụng DB
      // $all_brand_product = Brand::all(); // lấy tất cả dữ liệu trong tbl_brand , đây là cách sử dụng model
    // :: satic hướng đối tượng
      $all_brand_product = Brand::orderby('brand_id', 'desc')->get();

      // muốn hiện bao nhiêu brand thỳ sử dụng ->take()

   		$manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
   		
   		return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
   }
   public function save_brand_product(Request $request) {
      $this->AuthLogin();
      $data = $request->all();
      $brand = new Brand(); // trong laravel dùng để chèn dữ liệu
      $brand->brand_name = $data['brand_product_name'];
      $brand->brand_slug = $data['brand_slug'];
      $brand->meta_keywords = $data['meta_keywords'];
      $brand->brand_desc = $data['brand_product_desc'];
      $brand->brand_status = $data['brand_product_status'];
      $brand->save();


   		// $data = array();
   		// // $data['brand_name']  đặt theo tên cột tbl_brand_product
   		// $data['brand_name'] = $request->brand_product_name;
     //  $data['brand_slug'] = $request->brand_slug;
     //  $data['meta_keywords'] = $request->meta_keywords;
   		// $data['brand_desc'] = $request->brand_product_desc;
   		// $data['brand_status'] = $request->brand_product_status;
   		// DB::table('tbl_brand')->insert($data);
   		Session::put('message', 'Thêm thương hiệu thành công');
   		return Redirect::to('/add-brand-product');
   }
   //update(['brand_status'=>0]) là update theo mảng giá trị
   public function unactive_brand_product ($brand_product_id) {
      $this->AuthLogin();
   		DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
   		Session::put('message', 'Không kích hoạt thương hiệu thành công');
   		return Redirect::to('/all-brand-product');
   }
   public function active_brand_product($brand_product_id){
      $this->AuthLogin();  
    	DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
    	Session::put('message',' Kích hoạt thương hiệu thành công');
    	return Redirect::to('all-brand-product');
    }
    public function edit_brand_product ($brand_product_id) {
      $this->AuthLogin();
    	$edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();
    	$manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product)->with('');
    	return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function	update_brand_product (Request $request, $brand_product_id) {
      $this->AuthLogin();
      $data = $request->all();
      $brand = Brand::find($brand_product_id); //::find là hàm tìm kiếm  1 brand dựa trên brand_id đc truyền vào 
      //  $brand = new Brand(); nếu hàm này thay cho ::find thỳ laravel nó tạo thêm 1 brand mới
      $brand->brand_name = $data['brand_product_name'];
      $brand->brand_slug = $data['brand_slug'];
      $brand->meta_keywords = $data['meta_keywords'];
      $brand->brand_desc = $data['brand_product_desc'];
      $brand->save();


    	// $data = array();
    	// $data['brand_name'] = $request->brand_product_name;
     //  $data['brand_slug'] = $request->brand_slug;
     //  $data['meta_keywords'] = $request->meta_keywords;
     //  $data['brand_desc'] = $request->brand_product_desc;
   		// DB::table('tbl_brand')->where('brand_id' ,$brand_product_id)->update($data);
   		Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
   		return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product ($brand_product_id) {
      $this->AuthLogin();
      DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
      Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
      return Redirect::to('/all-brand-product');
    }

  //end function admin pages

    public function show_brand_home (Request $request, $brand_slug) {
      $product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
      $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

      $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_brand.brand_slug', $brand_slug)->get();

      $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug', $brand_slug)->limit(1)->get();
        foreach($brand_by_id as $key => $val){
                //seo 
                $meta_desc = $val->brand_desc; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->brand_name;
                $url_canonical = $request->url();
                //--seo
                }
      return view('pages.brand.show_brand')->with('product_cate', $product_cate)->with('product_brand', $product_brand)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}

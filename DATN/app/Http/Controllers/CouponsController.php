<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB; //db là database
use App\Http\Requests;
use Session;
use App\Models\Coupons;
use Illuminate\Support\Facades\Redirect;

session_start();

class CouponsController extends Controller
{
    public function insert_coupons(){
    	return view('admin.coupons.insert_coupons');
    }
    public function insert_coupons_code(Request $request) {
    	$data = $request->all();
    	$coupons = new Coupons;
    	// $coupons->coupons_name ten cot tbl_coupons
    	$coupons->coupons_name = $data['coupons_name'];
    	$coupons->coupons_code = $data['coupons_code'];
    	$coupons->coupons_condition = $data['coupons_condition'];
    	$coupons->coupons_time = $data['coupons_time'];
    	$coupons->coupons_number = $data['coupons_number'];

    	$coupons->save();
    	Session::put('message', 'Thêm mã giảm giá thành công');
   		return Redirect::to('/insert-coupons');
    }
    public function list_coupons () {
    	$list_coupons = Coupons::orderby('coupons_id', 'desc')->get();
    	return view('admin.coupons.list_coupons')->with(compact('list_coupons'));
    }
    public function delete_coupons($coupons_id) {
    	// hàm find tìm dựa theo cột coupons_id và biến $coupons_id dc truyền vào
    	$conpons = Coupons::find($coupons_id);
    	$coupons->delete();
    	Session::put('message', 'Xóa mã giảm giá thành công');
   		return Redirect::to('/list-coupons');
    }
    public function unset_coupons() {
    	$coupons = Session::get('coupons');
        if($coupons == true) {
            
        Session::forget('coupons');
        return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');
        }
    }
}

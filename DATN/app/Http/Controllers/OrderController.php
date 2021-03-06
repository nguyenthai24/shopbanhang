<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupons;
use App\Http\Requests;
use PDF;

use Session;
session_start();

class OrderController extends Controller
{
    public function manage_order(){
    	$order = Order::orderby('created_at', 'desc')->get();
    	return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code) {
    	$order_details = OrderDetails::where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();

        foreach ($order_details as $key => $order_d) {
           $coupons_product = $order_d->product_coupons;
          
        }
        if($coupons_product != 'no') {
            $coupons =  Coupons::where('coupons_code', $coupons_product)->first();
         $coupons_condition = $coupons->coupons_condition;
         $coupons_number = $coupons->coupons_number;
        }
        else {
            $coupons_condition = 2;
             $coupons_number = 0; 
        }
         
    	
    	return view('admin.view_order')->with(compact('order_details', 'customer', 'shipping','order_details_product','coupons_condition','coupons_number'));
    }

    public function print_order($checkout_code) {
       $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code',$checkout_code)->get();

        foreach ($order_details as $key => $order_d) {
           $coupons_product = $order_d->product_coupons;
          
        }
       if($coupons_product != 'no'){
            $coupons = Coupons::where('coupons_code',$coupons_product)->first();

            $coupons_condition = $coupons->coupons_condition;
            $coupons_number = $coupons->coupons_number;

            if($coupons_condition == 1){
                $coupons_echo = $coupons_number.'%';
            }elseif($coupons_condition == 2){
                $coupons_echo = number_format($coupons_number,0,',','.').'??';
            }
        }else{
            $coupons_condition = 2;
            $coupons_number = 0;

            $coupons_echo = '0';
        
        }

        $output = '';

        $output .= 
        '<style>
            body {
                font-family: DejaVu Sans, sans-serif;
            }
            .table-styling {
                border : solid 1px #000;
                width: 100%;
                border-collapse: collapse;
                

            }
            .table-styling td, .table-styling th {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
              
            }

            .table-styling tr:nth-child(even){background-color: #f2f2f2;}

            .table-styling tr:hover {background-color: #ddd;}

            .table-styling th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: center;
                background-color: #4CAF50;
                color: white;
                }
        </style>
        <h3>Th??ng tin kh??ch h??ng</h3>
        <table class="table-styling">
            <thead style="text-align: center">
                <tr >
                    <th>T??n kh??ch ?????t</th>
                    <th>S??? ??i???n tho???i</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>'; 
        $output .='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_phone.'</td>
                    <td>'.$customer->customer_email.'</td>
                </tr>';
  
        $output .='
            </tbody>
        </table>

        <h3>Th??ng tin v???n chuy???n</h3>
        <table class="table-styling">
            <thead style="text-align: center">
                <tr >
                    <th>T??n ng?????i nh???n</th>
                    <th>?????a ch???</th>
                    <th>SDT</th>
                    <th>Email</th>
                    <th>Ghi ch??</thd>
                </tr>
            </thead>
            <tbody>'; 
        $output .='
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_email.'</td>
                    <td>'.$shipping->shipping_note.'</td>
                </tr>';
  
        $output .='
            </tbody>
        </table>

        <h3>Th??ng tin chi ti???t ????n h??ng</h3>
        <table class="table-styling">
            <thead style="text-align: center">
                <tr >
                    <th>T??n s???n ph???m</th>
                    <th>M?? gi???m gi??</th>
                    <th>Ph?? v???n chuy???n</th>
                    <th>S??? l?????ng</th>
                    <th>Gi?? s???n ph???m</td>
                    <th>Th??nh ti???n</td>
                </tr>
            </thead>
            <tbody>'; 
            $total = 0;
           
            foreach ($order_details_product as  $key => $order_d) {
                $subtotal = $order_d->product_price * $order_d->product_sales_quantity;
                $total += $subtotal ;
                if($ord->product_coupons !='no') {
                     $product_coupons = $order_d->product_coupons;
                } else {
                    $product_coupons = 'Kh??ng m?? gi???m gi??';
                }
                $output .='

                <tr>
                    <td>'.$order_d->product_name.'</td>
                    <td>'. $product_coupons.'</td>
                    <td>'.number_format($order_d->product_feeship,0,',','.').'??</td>
                    <td>'.$order_d->product_sales_quantity.'</td>
                    <td>'.number_format($order_d->product_price,0,',','.').'??</td>
                    <td>'.number_format($subtotal,0,',','.').'??</td>
                </tr>';
            }
             if($coupons_condition == 1) {
                $total_after_coupons = ($total*$coupons_number)/100;
                  
                $total_coupons = $total - $total_after_coupons - $order_d->product_feeship;
            } else {       
                $total_coupons = $total-$coupons_number -$order_d->product_feeship;
            }
        $output .='
            <tr>
                <td colspan = "3" style="text-align: left">
                    <p>T???ng gi???m: '.$coupons_echo.'</p>
                    <p>Ph?? v???n chuy???n: '.number_format($order_d->product_feeship,0,',','.').'??</p>
                    <p>Thanh to??n: '.number_format($total_coupons,0,',','.').'??</p>
                </td>
            </tr>';
        
        $output .='
            </tbody>
        </table>

        <p>K?? t??n</p>
            <table>
                <thead>
                    <tr>
                        <th width="200px">Ng?????i l???p phi???u</th>
                        <th width="800px">Ng?????i nh???n</th>
                        
                    </tr>
                </thead>
                <tbody>';
                        
        $output.='              
                </tbody>
            
        </table>

        ';

        return $output;
    }
   
}

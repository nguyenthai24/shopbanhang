@extends('welcome')
@section('content')
					<div class="breadcrumbs">
						<ol class="breadcrumb">
						  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
						  <li class="active">Thanh toán</li>
						</ol>
					</div><!--/breadcrums-->
					<div class="register">
						<p>Đăng kí hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
					</div><!--/register-req-->
					<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form  method="post">
									@csrf
									{{-- session ajax lấy dữ liệu thông classs --}}
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email"  required="nhập họ và tên">
									<input type="text" name="shipping_name" class="shipping_name"  placeholder="Họ và Tên"  required>
									<input type="text" name="shipping_address" class="shipping_address"  placeholder="Địa chỉ"  required>
									<input type="text" name="shipping_phone" class="shipping_phone"  placeholder="Số điện thoại"  required>
									<div class="order-message">
										<textarea  name=" shipping_note" class="shipping_note" placeholder="Ghi chú đơn hàng của bạn" rows="5" required></textarea> 
									</div>
									
									@if(Session::get('fee'))
										<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else
										<input type="hidden" name="order_fee" class="order_fee" value="25000">
									@endif


									@if(Session::get('coupons'))
										@foreach(Session::get('coupons') as $key => $cou)
											<input type="hidden" name="order_coupons" class="order_coupons" value="{{$cou['coupons_code']}}">
										@endforeach
									@else
										<input type="hidden" name="order_coupons" class="order_coupons" value="no">
									@endif
									
									

									<div class="s">
										 <div class="form-group">
                                    		<label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                      			<select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            		<option value="0">Qua chuyển khoản</option>
                                            		<option value="1">Tiền mặt</option>      
                                   			 	</select>
                                		</div>
									</div>
									<input type="button" name="send_order" class="btn btn-secondary send_order
										" value="Xác nhận đơn hàng" style="margin-top: 55px">	
								</form>
								 <form>
                                    @csrf 
                             
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">--Chọn xã phường--</option>   
                                    </select>
                                </div>
                                
   
                                <input type="button" name="calculate_order" class="btn btn-secondary calculate_delivery" value="tính phí vận chuyển"
								style=" 

									margin-top: 20px;
									margin-bottom: 15px;
									margin-left: 0px;
									background: red;
								   	color: #fff;
								" >


                                </form>
                             
								
								
										
								
							</div>
					</div>
					<div >

			  			@if(session()->has('message'))
		                    <div class="alert alert-success" style="text-align: center;">
		                        {{ session()->get('message') }}
		                    </div>
		                @elseif(session()->has('error'))
		                     <div class="alert alert-danger">
		                        {{ session()->get('error') }}
		                    </div>
		                @endif
						<div class="table-responsive cart-info">
						<form method="post" action="{{URL::to('/update-cart')}}">
							{{csrf_field()}}
						<table class="table table-condensed">
							@if(Session::get('cart') ==true )
							<thead>
								<tr class="cart-menu">
									<td class="image">Hình ảnh</td>
									<td class="description">Tên sản phẩm</td>
									<td class="price">Giá sản phẩm</td>
									<td class="quantity">Số lượng</td>
									<td class="total">Thành tiền</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
							
								@php
									$total = 0;
								@endphp
							@foreach(Session::get('cart') as $key =>$val)
								@php
									$subtotal = $val['product_price'] * $val['product_qty'];
									$total += $subtotal;
								@endphp
								<tr>
									<td class="cart-product">
										<a href=""><img src="{{URL::to('public/uploads/products/'.$val['product_image'])}}" alt=""></a>
									</td>
									<td class="cart-description">
										<p>{{$val['product_name']}}</p>
									</td>
									<td class="cart-price">
										<p>
											{{number_format($val['product_price'],0,',','.')}}đ
										</p>
									</td>
									<td class="cart-quantity">
										<div class="cart-quantity-button">
											<input class="cart-quantity" type="number" name="cart_qty[{{($val['session_id'])}}]" value="{{$val['product_qty']}}" min="1" style="text-align: center; width: 100px">			
										</div>
									</td>
									<td class="cart-total">
										<p class="cart-total-price">
											{{number_format($subtotal,0,',','.')}}đ
										</p>
									</td>
									<td class="cart-delete">
										<a class="cart-quantity-delete" href="{{URL::to('/delete-cart/'.$val['session_id'])}}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							@endforeach

								
							
							</tbody>
							<tr>
								<td>
									<input type="submit" name="update_qty" class="btn btn-secondary
												" value="Cập nhật giỏ hàng">
								</td>
								<td>
									<a class="btn btn-default check_out2" href="{{URL::to('/delete-all-product')}}">Xóa tất cả</a>
								</td>
                                <td>
                                    @if(Session::get('cart'))
                                        <a class="btn btn-default check_out2" href="{{URL::to('/unser-coupons')}}">Xóa mã khuyến mãi</a>
                                        @endif
                                </td>
								
								{{-- <td>
									<a class="btn btn-default check_out2" href="">Thanh toán</a>
		                                 
								</td> --}}
								<td colspan="2">
									<li>Thành tiền <span>{{number_format($total,0,',','.')}}đ</span></li>
                                    @if(Session::get('coupons') == true)
                                    <li>
                                        
                                            @foreach(Session::get('coupons') as $key => $cou)
                                                @if($cou['coupons_condition'] == 1)
                                                    Phiếu mã giảm giá: {{$cou['coupons_number']}} %
                                                    <p>
                                                        @php
                                                        $total_coupons = ($total * $cou['coupons_number'])/100;
                                                       
                                                        @endphp
                                                    </p>
                                                    <p>
                                                       	@php
                                                       		$total_after_coupons = $total - $total_coupons;

                                                       	@endphp
                                                    <p>
                                                 @elseif($cou['coupons_condition'] == 2)
                                                    Mã giảm:  {{number_format($cou['coupons_number'],0,',','.')}}đ
                                                    <p>
                                                        @php
                                                        $total_coupons = $total - $cou['coupons_number'];
                                                     
                                                        @endphp
                                                    </p>
                                                    <p>
                                                      	@php
                                                      			$total_after_coupons = $total_coupons ;
                                                      			
                                                      	@endphp
                                                    <p>
                                                @endif
                                            @endforeach
                                       
                                      


                                    </li>
                                    @endif
                                    @if(Session::get('fee'))
                                  	<div class="abc" style="display: flex">
                              
                                    	<li>Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></li>
                                    	<a class="delete-fee" href="{{URL::to('/delete-fee')}}"><i class="fa fa-times" style="padding-left: 10px"></i></a>
                                    	@php
                                    		$total_after_fee = $total + Session::get('fee');
                                    	@endphp
                                  	</div>

                                    @endif
                                    <li>Tổng còn : 
                                    	@php
                                    		if(Session::get('fee') && !Session::get('coupons')){
												$total_after = $total_after_fee;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && Session::get('coupons')){
												$total_after = $total_after_coupons;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(Session::get('fee') && Session::get('coupons')){
												$total_after = $total_after_coupons;
												$total_after = $total_after - Session::get('fee');
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && !Session::get('coupons')){
												$total_after = $total;
												echo number_format($total_after,0,',','.').'đ';
											}
                                    	@endphp
                                   
								</li>
									
								</td>

								</tr>
							@else 
								<tr >
									<td colspan="5"><center>
										@php
											echo 'Làm ơn hãy thêm sản phẩm vào giỏ hàng';
										@endphp
									</center></td>
									
								</tr>
							@endif

						</table>
					</form>
                        @if(Session::get('cart'))
								<tr >
									<td colspan="2">
									<form method="post" action="{{URL::to('/check-coupons')}}" style="width: 200px" class="coupons mb-3">
										{{csrf_field()}}
										<input type="text" class="form-control" name="coupons" placeholder="Nhập mã giảm giá">
										<br>
										<input class="btn btn-default check_coupons" name="check_coupons" type="submit" value="Tính mã giảm giá">
                                        
					</form>
								</td>
								</tr>	
                        @endif
					{{-- </div>
 --}}				</div>
					</div>
					
					

@endsection
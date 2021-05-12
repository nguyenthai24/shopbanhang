@extends('welcome') {{-- lay theo ten welcome.blade.php --}}
@section('content') {{--  content la ten tu dat --}}
<div class="cart-items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
						  <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
						  <li class="active">Check out</li>
						</ol>
			</div>
			<div class="table-responsive cart-info">
				<?php
				//  Cart::content() hiện tất cả những gì mà add cart vào
				$content = Cart::content();
					echo '<pre>';
					print_r ($content);
					echo '</pre>';
				 ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart-menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $key => $v_content)
						<tr>
							<td class="cart-product">
								<a href=""><img src="{{URL::to('public/uploads/products/'.$v_content->options->image)}}" alt=""></a>
							</td>
							<td class="cart-description">
								<p>{{$v_content->name}}</p>
							</td>
							<td class="cart-price">
								<p>{{number_format($v_content->price).' '.'VND'}}</p>
							</td>
							<td class="cart-quantity">
								<div class="cart-quantity-button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
										{{csrf_field()}}
										<input class="cart-quantity-input" type="text" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="3">
										<input type="hidden" name="rowId_cart" class="form-control" value="{{$v_content->rowId}}">
										<input type="submit" name="update_qty" class="btn btn-secondary
										" value="cập nhật">
									</form>
								</div>
							</td>
							<td class="cart-total">
								<p class="cart-total-price">
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '. 'VND';
									 ?>
								</p>
							</td>
							<td class="cart-delete">
								<a class="cart-quantity-delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- heet cart-items -->
	<div class="cart-checkout">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				{{-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							
						</ul>
						<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::total().' '.'VND'}}</span></li>
							<li>Thuế <span>{{Cart::tax().' '.'VND'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().' '.'VND'}}</span></li>
						</ul>
							<div class="btn1">
								{{-- <a class="btn btn-default update2" href="">Update</a> --}}

                                 <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                 ?>
                                    <a class="btn btn-default check_out2" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                <?php
                                    }else{
                                 ?>
                                    <a class="btn btn-default check_out2" href="{{URL::to('/login-checkout')}}">Thanh toán</a>></li>
                                <?php
                                    }
                                 ?>
							
							</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- het cart-checkout -->
@endsection
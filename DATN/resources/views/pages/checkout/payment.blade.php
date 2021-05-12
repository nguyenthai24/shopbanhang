@extends('welcome')
@section('content')
<div class="breadcrumbs">
					<ol class="breadcrumb">
						<li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
						<li class="active">Thanh toán giỏ hàng</li>
					</ol>
</div><!--/breadcrums-->
					<div class="review-payment">
						<h2>Xem lại giỏ hàng</h2>
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
										{{csrf_field ()}}
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
			<h4 class="payment mt-2" style="font-weight: 700; font-size: 20px;">Chọn hình thức thanh toán</h4>
				<div class="payment-options mt-2">
				<form action="{{URL::to('/order-place')}}" method="post">
					{{csrf_field() }}
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Thanh toán bằng tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> Thanh toán bằng thẻ ghi nợ</label>
					</span>
					<input type="submit" name="send_order_place" class="btn btn-secondary
										" value="Thanh toán" >	
				</form>	
				</div>
@endsection
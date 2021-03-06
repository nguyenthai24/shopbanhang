
<!DOCTYPE html>
<html lang="en"><head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    {{-- SEO --}}
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX, FOLLOW">
    <link rel="canonical" href="{{$url_canonical}}">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="">
    {{-- /SEO --}}
       {{-- <meta property="og:image" content="{{$image_og}}" />  
      <meta property="og:site_name" content="http://localhost/tutorial_youtube/shopbanhanglaravel" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" /> --}}
    <title>{{$meta_title}}</title> 
    <script type="text/javascript" src="{{asset('public/front-end/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/front-end/js/1.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/front-end/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('public/front-end/css/1.css')}}">
    <link rel="stylesheet" href="{{asset('public/front-end/css/responsive.css')}}">
    <link rel="stylesheet"  href="{{asset('public/front-end/css/font-awesome.css')}}">
    <link rel="stylesheet"  href="{{asset('public/front-end/css/sweetalert.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="usuy2pZ4"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/front-end/js/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(){

                        swal({
                                title: "???? th??m s???n ph???m v??o gi??? h??ng",
                                text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
                                showCancelButton: true,
                                cancelButtonText: "Xem ti???p",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "??i ?????n gi??? h??ng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }

                });
            });
        });
    </script>
</head>
<body >
<!-- header -->
 <div class="header">
    <!-- header_top -->
    <div class="header_top">
        <div class="container">
            <div class="row">
                    <div class="col-sm-6">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li class="a"><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="right pull-right">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>  <!-- h???t container -->
    </div>  <!-- h???t header_top -->

    <!-- header-mid -->
    <div class="header-mid mt-1 mb-3">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{URL::to('/trang-chu')}}">Shop Nvt</a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-heart"></i> Y??u th??ch</a></li>

                                <?php

                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != NULL && $shipping_id == NULL){
                                ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                <?php
                                    }elseif($customer_id != NULL && $shipping_id != NULL){
                                 ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                <?php
                                    }else{
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                <?php
                                    }
                                ?>

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                 ?>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> ????ng xu???t</a></li>
                                <?php
                                    }else{
                                 ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> ????ng nh???p</a></li>
                                <?php
                                    }
                                 ?>
                            </ul>
                    </div>
                </div>
            </div>
        </div> <!-- h???t container -->
    </div>  <!--  h???t header-mid -->

    <div class="container mt-1 ">
        <hr class="hr">
    </div>

    <!-- header-menu -->
    <div class="header-menu mb-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="menu">
                        <nav class="navbar navbar-light ">
                            <button class="navbar-toggler hidden-sm-up phai" type="button" data-toggle="collapse"
            data-target="#menu"></button>
                            <div class="collapse navbar-toggleable-xs" id="menu" s>
                                <ul class=" nav navbar-nav mphai float-xs-left">
                                    <li class="nav-item active">
                                        <a href="{{URL::to('/trang-chu')}}" class="nav-link">Home<span class="sr-only">(Current)</span></a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown">Shop</a>
                                        <!-- <div class="dropdown-menu drop">
                                            <a class="dropdown-item" href="#">Products</a>
                                            <a class="dropdown-item" href="#">Products Details</a>
                                            <a class="dropdown-item" href="#">Checkout</a>
                                            <a class="dropdown-item" href="#">Cart</a>
                                            <a class="dropdown-item" href="#">Login</a> 
                                        </div> -->
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">404</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Contact</a>
                                    </li>
                                </ul>   
                            </div>
                            <div>
                            <form class="form-inline my-2 my-lg-0 pull-right" action="{{URL::to('/tim-kiem')}}" method="post">
                                {{csrf_field() }}
                                    <input class="form-control mr-sm-2" type="search" placeholder="T??m ki???m" name="keyword_submit" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0 tk" name="search_iteams" type="submit" >T??m ki???m</button>
                            </form> 
                            </div>  
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- h???t container -->
    </div> <!-- h???t header-menuu -->
 </div>  <!-- h???t header -->


<!-- Slider -->
<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- carousel -->
                <div id="slidekhachhang" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slidekhachhang" data-slide-to="0" class="active"></li>
                        <li data-target="#slidekhachhang" data-slide-to="1"></li>
                        <li data-target="#slidekhachhang" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{('public/front-end/images/banner1.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{('public/front-end/images/banner2.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{('public/front-end/images/banner3.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <div class="nutslide">
                        <a class="left carousel-control" href="#slidekhachhang" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#slidekhachhang" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                    </a>
                    </div>
                </div> <!-- h???tcarousel -->
            </div>
        </div>  <!-- h???t row -->
    </div>  <!-- h???t container -->
</div> <!-- h???t slider -->

<!-- main -->
<div class="main mt-3 mb-3">
    <div class="container">
        <div class="row"> 
            <div class="col-sm-12">
               <div class="cart-items" style="margin-right: -15px;margin-left: -15px;">
    
	  			@if(session()->has('message'))
                    <div class="alert alert-success" style="text-align: center;">
                        {{ session()->get('message') }}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
				<div class="container">
					<div class="breadcrumbs">
						<ol class="breadcrumb">
								  <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
								  <li class="active">Check out</li>
								</ol>
					</div>
					<div class="table-responsive cart-info">
						<form method="post" action="{{URL::to('/update-cart')}}">
							{{csrf_field()}}
						<table class="table table-condensed">
							@if(Session::get('cart') ==true )
							<thead>
								<tr class="cart-menu">
									<td class="image">H??nh ???nh</td>
									<td class="description">T??n s???n ph???m</td>
									<td class="price">Gi?? s???n ph???m</td>
									<td class="quantity">S??? l?????ng</td>
									<td class="total">Th??nh ti???n</td>
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
											{{number_format($val['product_price']).''.'??'}}
										</p>
									</td>
									<td class="cart-quantity">
										<div class="cart-quantity-button">
											<input class="cart-quantity" type="number" name="cart_qty[{{($val['session_id'])}}]" value="{{$val['product_qty']}}" min="1" style="text-align: center; width: 100px">			
										</div>
									</td>
									<td class="cart-total">
										<p class="cart-total-price">
											{{number_format($subtotal).''.'??'}}
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
												" value="C???p nh???t gi??? h??ng">
								</td>
								<td>
									<a class="btn btn-default check_out2" href="{{URL::to('/delete-all-product')}}">X??a t???t c???</a>
								</td>
                                <td>
                                    @if(Session::get('cart'))
                                        <a class="btn btn-default check_out2" href="{{URL::to('/unser-coupons')}}">X??a m?? khuy???n m??i</a>
                                        @endif
                                </td>
                                <td>
                                    @if(Session::get('customer'))
                                        <a class="btn btn-default check_out2" href="{{URL::to('/checkout')}}">?????t h??ng</a>
                                    @else
                                        <a class="btn btn-default check_out2" href="{{URL::to('/login-checkout')}}">?????t h??ng</a>
                                    @endif

                                </td>
								
								{{-- <td>
									<a class="btn btn-default check_out2" href="">Thanh to??n</a>
		                                 
								</td> --}}
								<td colspan="2">
									<li>Th??nh ti???n <span>{{number_format($total).''.'??'}}</span></li>
                                    @if(Session::get('coupons') == true)
                                    <li>
                                        
                                            @foreach(Session::get('coupons') as $key => $cou)
                                                @if($cou['coupons_condition'] == 1)
                                                    Phi???u m?? gi???m gi??: {{$cou['coupons_number']}} %
                                                    <p>
                                                        @php
                                                        $total_coupons = ($total * $cou['coupons_number'])/100;
                                                        echo '<p><li>T???ng gi???m:'.number_format($total_coupons).''.
                                                        '?? </li></p>';
                                                        @endphp
                                                    </p>
                                                    <p>
                                                        <li>T???ng ti???n ???? gi???m: {{number_format($total-$total_coupons).''.'??'}}</li>
                                                    <p>
                                                 @elseif($cou['coupons_condition'] == 2)
                                                    M?? gi???m:  {{number_format($cou['coupons_number']).''.'??'}}
                                                    <p>
                                                        @php
                                                        $total_coupons1 = $total - $cou['coupons_number'];
                                                        echo '<p><li>T???ng gi???m:'.number_format($total_coupons1).''.
                                                        '?? </li></p>'; 
                                                        @endphp
                                                    </p>
                                                    <p>
                                                        <li>T???ng ti???n ???? gi???m: {{number_format($total_coupons1).''.'??'}}</li>
                                                    <p>
                                                @endif
                                            @endforeach
                                       
                                      


                                    </li>
                                    @endif
								
									
								</td>

								</tr>
							@else 
								<tr >
									<td colspan="5"><center>
										@php
											echo 'L??m ??n h??y th??m s???n ph???m v??o gi??? h??ng';
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
										@csrf
										<input type="text" class="form-control" name="coupon" placeholder="Nh???p m?? gi???m gi??"><br>
                                        <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="T??nh m?? gi???m gi??">
                                        
									</form>
								</td>
								</tr>	
                        @endif
					{{-- </div>
 --}}				</div>
				</div> 
         	</div>  <!-- h???t col-sm-12 -->
        </div>
    </div>  <!-- h???t row     -->
</div> <!-- h???t container -->
<!-- /main -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="box-footer">
                    <h3>Th??ng tin li??n h???</h3>
                        <div class="content-contact">
                            <p>Website chuy??n cung c???p thi???t b??? ??i???n t??? h??ng ?????u Vi???t Nam</p>
                            <p>
                                <span>?????a ch???:</span> 457/44 T??n ?????c Th???ng, Li??n Chi???u, ???? N???ng
                            </p>
                            <p>
                                <span>Email: </span> thietkeweb43.com@gmail.com
                            </p>
                            <p>
                                <span>??i???n tho???i: </span> 0358949xxx
                            </p>
                        </div>
                </div> <!-- h???t box-footer -->
            </div>  <!-- col-sm-4 -->   

            <div class="col-sm-4">
                <div class="box-footer">
                    <h3>Th??ng tin kh??c</h3>
                    <div class="content-list">
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Ch??nh s??ch b???o m???t</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Ch??nh s??ch ?????i tr???</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Ph?? v???n chuy???n</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> H?????ng d???n thanh to??n</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Ch????ng tr??nh khuy???n m??i</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="box-footer mb-3">
                    <h3>Form li??n h???</h3>
                    <div class="content-contact">
                        <form action="/" method="GET" role="form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" name="" id="" class="form-control" placeholder="H??? v?? T??n">
                                </div>
                                
                                     <div class="col-sm-6">
                                        <input type="email" name="" id="" class="form-control" placeholder="?????a ch??? mail">
                                     </div>
                                     <div class="col-sm-6 right">
                                        <input type="text" name="" id="" class="form-control" placeholder="S??? ??i???n tho???i" style="color: #fff;">
                                     </div>
                                    
                                
                                <div class="col-sm-12>
                                    <input type="text" name="" id="" class="form-control" placeholder="Ti??u ?????">
                                </div>
                                <div class="col-sm-12">
                                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" style="border-radius: 10px">Li??n h??? ngay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>

</div>
<!-- /footer -->
</body>
</html>

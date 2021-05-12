
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
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript"> 
    //validatin jquery form login-ckeout
    //   $(document).ready(function() {

    //     //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
    //     $("#login-checkout").validate({
    //                 rules: {                     
    //                     customer_name: "required",
    //                     customer_phone: {
    //                         required: true,
    //                         minlength: 5
    //                     },
    //                     customer_password: {
    //                         required: true,
    //                         minlength: 5
    //                     },
    //                     confirm_password: {
    //                         required: true,
    //                         minlength: 5,
    //                         equalTo: "#customer_password"
    //                     },
    //                     customer_email: {
    //                         required: true,
    //                         email: true
    //                     },
    //                     dieukhoan: "required",
    //                      g-recaptcha-response => new Captcha(),
    //                 },
    //                 messages: {   
    //                     customer_name: "Vui lòng nhập họ và tên",                       
    //                     customer_phone: {
    //                         required: "Vui lòng nhập số điện thoại",
    //                         minlength: "Số máy quý khách vừa nhập là số không có thực"
    //                     },
    //                     customer_password: {
    //                         required: 'Vui lòng nhập mật khẩu',
    //                         minlength: 'Vui lòng nhập ít nhất 5 kí tự'
    //                     },
    //                     confirm_password: {
    //                         required: 'Vui lòng nhập mật khẩu',
    //                         minlength: 'Vui lòng nhập ít nhất 5 kí tự',
    //                         equalTo: 'Mật khẩu không trùng'
    //                     },
    //                     // customer_email: {
    //                     //     required: "Please provide a password",
    //                     //     minlength: "Your password must be at least 5 characters long",
    //                     //     equalTo: "Please enter the same password as above"
    //                     // },
    //                     customer_email: "Vui lòng nhập Email",
    //                     dieukhoan: "Vui lòng đồng ý các điều khoản",
                       
    //                 }
    //             });
    // });
    </script>
    {{--  <script type="text/javascript">
        $(document).ready(function () {
            $('#login-checkout').jqxValidator({ rules: [
                { input: '#userInput', message: 'The username should be more than 3 characters!', action: 'keyup', rule: 'minLength=3' },
                { input: '#emailInput', message: 'Invalid e-mail!', action: 'keyup', rule: 'email'}],
                theme: 'summer'
            });
        });
    </script> --}}
    <script type="text/javascript">
         $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng sẽ không hoàn trả khi đặt hàng thành công, bạn có muốn đặt đơn hàng không",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Cảm ơn, Mua hàng",
                        cancelButtonText: "Đóng",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var id = $(this).data('id_product');
                                // alert(id);
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name' ).val();
                            var shipping_address = $('.shipping_address' ).val();
                            var shipping_phone = $('.shipping_phone' ).val();
                            var shipping_note = $('.shipping_note' ).val();
                            var shipping_method = $('.payment_select' ).val();
                            var order_fee = $('.order_fee' ).val();
                            var order_coupons = $('.order_coupons' ).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: '{{url('/confirm-order')}}',
                                method: 'post',
                                data:{shipping_email: shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_note:shipping_note,order_fee:order_fee,order_coupons:order_coupons,_token:_token,shipping_method:shipping_method},
                                success:function(){
                                     swal("Đơn hàng", "Đơn hàng của bạn đã được thành công.", "success");
                                }


                            });
                            window.setTimeout(function(){
                                location.reload();
                            }, 3000);
                          
                        } else {
                            swal("Đóng", "Đơn hàng của bạn đặt không thành công", "error");
                        }
                    });
               
            });
        });
    </script>
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
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
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
    <script type="text/javascript">
        $(document).ready(function(){
              $('.choose').on('change',function(){
            //attr lấy giá trị id của class chosse
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action == 'city') {
                result = 'province';
            } else {
                result= 'wards';
            }
            $.ajax({
                url: '{{url('/select-delivery-home')}}',
                method: 'post',
                data: {action: action, ma_id: ma_id, _token: _token},
                success:function(data) {
                    $('#'+result).html(data);
                }
            });

        });  
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
           $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                    url : '{{url('/fee-shipping')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload(); 
                       //tải lại trang
                    }
                    });
                }
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
                                <li><a href="#"><i class="fa fa-phone"></i> +099999999</a></li>
                                <li class="a"><a href="#"><i class="fa fa-envelope"></i> nguyenvanthai.humg24@gmail.com</a></li>
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
        </div>  <!-- hết container -->
    </div>  <!-- hết header_top -->

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
                                <li><a href=""><i class="fa fa-heart"></i> Yêu thích</a></li>

                                <?php

                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != NULL && $shipping_id == NULL){
                                ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }elseif($customer_id != NULL && $shipping_id != NULL){
                                 ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }else{
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }
                                ?>

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                 ?>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                <?php
                                    }else{
                                 ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                    }
                                 ?>
                            </ul>
                    </div>
                </div>
            </div>
        </div> <!-- hết container -->
    </div>  <!--  hết header-mid -->

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
                                    <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" name="keyword_submit" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0 tk" name="search_iteams" type="submit" >Tìm kiếm</button>
                            </form> 
                            </div>  
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- hết container -->
    </div> <!-- hết header-menuu -->
 </div>  <!-- hết header -->


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
                </div> <!-- hếtcarousel -->
            </div>
        </div>  <!-- hết row -->
    </div>  <!-- hết container -->
</div> <!-- hết slider -->

<!-- main -->
<div class="main mt-3 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left">
                    <div class="danhmuc">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục </span>
                    </div>
                   
                    <ul class="item">
                        @foreach($product_cate as $key => $cate)
                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">{{$cate->category_name}}</a></li>
                         @endforeach
                    </ul>
                   
                    <div class="thuonghieu">
                        <i class="fa fa-bars"></i>
                        <span>Thương hiệu </span>
                    </div>
                    <ul class="item">
                       @foreach($product_brand as $key => $bra)
                        <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$bra->brand_slug)}}">{{$bra->brand_name}}</a></li>
                        @endforeach
                    </ul>
                </div> <!-- hết left -->
            </div>  <!-- hết col-sm-3 -->
            <div class="col-sm-9">
               @yield('content')
            </div>  <!-- hết col-sm-9 -->
        </div>
    </div>  <!-- hết row     -->
</div> <!-- hết container -->
<!-- /main -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="box-footer">
                    <h3>Thông tin liên hệ</h3>
                        <div class="content-contact">
                            <p>Website chuyên cung cấp thiết bị điện tử hàng đầu Việt Nam</p>
                            <p>
                                <span>Địa chỉ:</span> Bắc Hồng, Đông Anh, Hà Nội
                            </p>
                            <p>
                                <span>Email: </span> nguyenvanthai.humg24@gmail.com
                            </p>
                            <p>
                                <span>Điện thoại: </span> 0358949xxx
                            </p>
                        </div>
                </div> <!-- hết box-footer -->
            </div>  <!-- col-sm-4 -->   

            <div class="col-sm-4">
                <div class="box-footer">
                    <h3>Thông tin khác</h3>
                    <div class="content-list">
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Chính sách bảo mật</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Chính sách đổi trả</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Phí vẫn chuyển</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Hướng dẫn thanh toán</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Chương trình khuyến mãi</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="box-footer mb-3">
                    <h3>Form liên hệ</h3>
                    <div class="content-contact">
                        <form action="/" method="GET" role="form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" name="" id="" class="form-control" placeholder="Họ và Tên">
                                </div>
                                
                                     <div class="col-sm-6">
                                        <input type="email" name="" id="" class="form-control" placeholder="Địa chỉ mail">
                                     </div>
                                     <div class="col-sm-6 right">
                                        <input type="text" name="" id="" class="form-control" placeholder="Số điện thoại" style="color: #fff;">
                                     </div>
                                    
                                
                                <div class="col-sm-12>
                                    <input type="text" name="" id="" class="form-control" placeholder="Tiêu đề">
                                </div>
                                <div class="col-sm-12">
                                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" style="border-radius: 10px">Liên hệ ngay</button>
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
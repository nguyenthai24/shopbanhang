@extends('welcome') {{-- lay theo ten welcome.blade.php --}}
@section('content') {{--  content la ten tu dat --}}
<div class="right">
                    <div class="sanpham">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#" class="title pull-left">Kết quả tìm kiếm</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="right pull-right">
                                    <ul>
                                        <li><a href="#">Điện thoại</a></li>
                                        <li><a href="#">Máy tính bảng</a></li>
                                        <li><a href="#">Laptop</a></li>
                                        <li><a href="#">Phụ kiện</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- hết row -->                 
                    </div> <!-- hết sản phẩm -->

                    <div class="content-product mt-1">
                        <div class="row">
                            @foreach($search_product as $key =>$pro)
                            <div class="col-sm-4">                          
                                <div class="item-product">
                                    <div class="thumb">
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}"><img src="{{URL::to('public/uploads/products/'.$pro->product_image)}}" alt=""></a>
                                        <span class="sale">Giảm {{number_format($pro->product_price_old - $pro->product_price ,0,',','.')}}đ  
                                         
                                        </span>
                                        <div class="action">
                                            <a href="#" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
                                            <a href="#" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="info-product">
                                        <h4><a href="#">{{$pro->product_name}}</a></h4>
                                        <div class="price">
                                            <span class="price-current">{{number_format($pro->product_price,0,',','.')}}đ</span>
                                            <span class="price-old">{{number_format($pro->product_price_old,0,',','.')}}</span>
                                        </div>
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}"><button type="button" class="btn btn-primary">Thêm giỏ hàng</button></a>
                                    </div>
                                </div> <!-- hết item-product -->
                             </a>
                            </div> <!-- hết col-sm-4 -->  
                               @endforeach    
                        </div> <!-- hết row -->
                    </div> <!-- hết content-product -->
</div> <!-- hết right -->           
@endsection
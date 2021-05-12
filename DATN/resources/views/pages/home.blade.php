@extends('welcome') {{-- lay theo ten welcome.blade.php --}}
@section('content') {{--  content la ten tu dat --}}
<div class="right">
                    <div class="sanpham">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#" class="title pull-left">sản phẩm nổi bật</a>
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
                            @foreach($all_product as $key =>$pro)
                            <div class="col-sm-4">                          
                                <div class="item-product">
                                <form>
                                {{csrf_field()}}
                                    <input type="hidden" class="cart_product_id_{{$pro->product_id}}" value="{{$pro->product_id}}">
                                    <input type="hidden" class="cart_product_name_{{$pro->product_id}}" value="{{$pro->product_name}}">  
                                    <input type="hidden" class="cart_product_image_{{$pro->product_id}}" value="{{$pro->product_image}}">  
                                    <input type="hidden" class="cart_product_price_{{$pro->product_id}}" value="{{$pro->product_price}}">  
                                    <input type="hidden" class="cart_product_qty_{{$pro->product_id}}" value="1">     
                                    <div class="thumb">
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}"><img src="{{URL::to('public/uploads/products/'.$pro->product_image)}}" alt=""></a>
                                        <span class="sale">Giảm: {{number_format($pro->product_price_old - $pro->product_price ,0,',','.')}}đ
                                            
                                            </span> 
                                           
                                        </span>
                                        <div class="action">
                                            <a href="#" class="buy"><i class="fa fa-cart-plus"></i>Xem chi tiết</a>
                                            <a href="#" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="info-product">
                                        <h4><a href="#">{{$pro->product_name}}</a></h4>
                                        <div class="price">
                                            <span class="price-current">{{number_format($pro->product_price,0,',','.')}}đ</span>
                                            <span class="price-old">{{number_format($pro->product_price_old,0,',','.')}}đ</span>
                                        </div>
                                        <button type="button" class="btn btn-primary add-to-cart" name="add-to-cart" data-id_product="{{$pro->product_id}}">Thêm giỏ hàng</button>
                                        {{-- chú ý tên data là không thay đổi 39-trang welcome --}}
                                    </div>
                                </form> 
                                </div> <!-- hết item-product -->
                             </a>
                            </div> <!-- hết col-sm-4 -->  
                               @endforeach    
                        </div> <!-- hết row -->
                    </div> <!-- hết content-product -->
</div> <!-- hết right -->           
@endsection
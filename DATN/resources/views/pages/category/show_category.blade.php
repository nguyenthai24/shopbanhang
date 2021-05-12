@extends('welcome') {{-- lay theo ten welcome.blade.php --}}
@section('content') {{--  content la ten tu dat --}}
<div class="fb-share-button" data-href="http://localhost/DATN/" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
<div class="right">
                    <div class="sanpham">
                        <div class="row">
                            <div class="col-sm-6">
                                @foreach($category_name as $key => $name)
                                <p class="title pull-left">thương hiệu {{$name->category_name}}</p>
                                @endforeach()
                            </div>
                           
                        </div> <!-- hết row -->                 
                    </div> <!-- hết sản phẩm -->

                    <div class="content-product mt-1">
                        <div class="row">
                            @foreach($category_by_id as $key => $cate_pro)
                            <div class="col-sm-4">
                                <div class="item-product">
                                    <div class="thumb">
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$cate_pro->product_slug)}}"><img src="{{URL::to('public/uploads/products/'.$cate_pro->product_image)}}" alt=""></a>
                                        <span class="sale">Giảm {{number_format($cate_pro->product_price_old - $cate_pro->product_price ,0,',','.')}}đ
                                           
                                        </span>
                                        <div class="action">
                                            <a href="#" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
                                            <a href="#" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="info-product">
                                        <h4><a href="#">{{$cate_pro->product_name}}</a></h4>
                                        <div class="price">
                                            <span class="price-current">{{number_format($cate_pro->product_price,0,',','.')}}</span>
                                            <span class="price-old">{{number_format($cate_pro->product_price_old,0,',','.')}}đ</span>
                                        </div>
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$cate_pro->product_slug)}}"><button type="button" class="btn btn-primary">Xem chi tiết</button></a>
                                    </div>
                                </div> <!-- hết item-product -->
                             </a>
                            </div> <!-- hết col-sm-4 -->  
                               @endforeach    
                        </div> <!-- hết row -->
                    </div> <!-- hết content-product -->
</div> <!-- hết right -->
<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="10"></div>
<div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>

@endsection
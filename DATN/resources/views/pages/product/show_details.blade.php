@extends('welcome') {{-- lay theo ten welcome.blade.php --}}
@section('content') {{--  content la ten tu dat --}}
<div class="fb-share-button" data-href="http://localhost/DATN/" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
@foreach($details_product as $key => $details)
<div class="details-product">

					<div class="col-sm-6">
						<div class="view-product">
							<img src="{{URL::to('public/uploads/products/'.$details->product_image)}}" id="place-img">
							{{-- <ul>
								<li><img src="{{URL::to('public/front-end/images/product-details-1.jpg')}}" id="img1"></li>
								<li><img src="{{URL::to('public/front-end/images/product-details-2.jpg')}}" id="img2"></li>
								<li><img src="{{URL::to('public/front-end/images/product-details-3.jpg')}}" id="img3"></li>
								<li><img src="{{URL::to('public/front-end/images/product-details-4.jpg')}}" id="img4"></li>
							</ul> --}}
						</div>			
					</div>	<!-- hết col-sm-6 -->

					<div class="col-sm-6" style=" ">
						<div class="info-product">
							<img src="images/details-product/new.jpg" class="new" alt="">
							<h3 class="h3">{{$details->product_name}}</h3>
							<p>ID: {{$details->product_id}}</p>
							<div class="rating">
								<i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star-half-o"></i>
	                            <span>(18 reviews)</span>
							</div>
							<form action="{{URL::to('/save-cart')}}" method="post">
								{{csrf_field()}}
								<span>
									 <input type="hidden" class="cart_product_id_{{$details->product_id}}" value="{{$details->product_id}}">
                                    <input type="hidden" class="cart_product_name_{{$details->product_id}}" value="{{$details->product_name}}">  
                                    <input type="hidden" class="cart_product_image_{{$details->product_id}}" value="{{$details->product_image}}">  
                                    <input type="hidden" class="cart_product_price_{{$details->product_id}}" value="{{$details->product_price}}">  
                                    <input type="hidden" class="cart_product_qty_{{$details->product_id}}" value="1">
									<span class="price">{{number_format($details->product_price,0,',','.')}}đ</span>
									<label class="qty">Số lượng: </label>
									<input name="qty" type="number" value="1" min="1" max="10"/>
									<input name="productid_hidden" type="hidden" value="{{$details->product_id}}"/>
									<button type="button" class="btn btn-primary add-to-cart" name="add-to-cart" data-id_product="{{$details->product_id}}"
									style="margin-left: 41px;" 
										>Thêm giỏ hàng</button>
								</span>
							</form>
							<div class="info">
								<p><b>Tình trạng: </b>Còn hàng</p>
								<p><b>Điều kiện: </b>Mới</p>
								<p><b>Thương hiệu: </b>{{$details->brand_name}}</p>
								<p><b>Danh mục: </b>{{$details->category_name}}</p>
								<p><b class="abc">Share on:</b>
									
										<a href="#"><i class="fa fa-facebook"></i></a>
	                                    <a href="#"><i class="fa fa-twitter"></i></a>
	                                    <a href="#"><i class="fa fa-instagram"></i></a>
	                                    <a href="#"><i class="fa fa-pinterest"></i></a>
								</p>

							</div>
						</div>
					</div>
				</div>	<!-- hết details-product -->

				<div class="category-tab mt-2 mb-2">
						<div class="row ">
							<div class="col-sm-12">
						      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#details" role="tab">Chi tiết sản phẩm</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#content" role="tab" >Mô tả sản phẩm</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#evaluate" role="tab" >Đánh giá</a>
									</li>
								</ul>

								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="pills-home-tab">
										<div class="content has-table">
											
													{!!$details->product_desc!!}
													
											
										</div>
									</div>
									<div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="pills-profile-tab"><p>{!!$details->product_content!!}</p></div>
									<div class="tab-pane fade" id="evaluate" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
								</div>
							</div>
						</div>
					</div>
					<div class="recommended_items mb-2" >			
					<h2 class="title text-center">Sản phẩm liên quan</h2>
					<div id="slidekhachhang" class="carousel slide" data-ride="carousel">
	  					<div class="carousel-inner">
						    <div class="carousel-item active">
						    	@foreach($relate_product as $key => $relate)
						      	<div class="col-sm-4">
						      		<div class="item-product">						      		
										<div class="thumb">
											<a href="{{URL::to('/chi-tiet-san-pham/'.$relate->product_slug)}}"><img src="{{URL::to('public/uploads/products/'.$relate->product_image)}}" alt=""></a>
											<span class="sale">Giảm: {{number_format($relate->product_price_old - $relate->product_price ,0,',','.')}}đ	
											</span>		
										</div>
										<div class="info-product">
											<h4>{{$relate->product_name}}</h4>
												<div class="price">
													<span class="price-current">{{number_format($relate->product_price,0,',','.')}}đ</span>
													<span class="price-old">{{number_format($relate->product_price_old,0,',','.')}}đ</span>
												</div>
											<div class="action">
												<a href="{{URL::to('/chi-tiet-san-pham/'.$relate->product_slug)}}" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
											</div>
										</div>
									
									</div> <!-- hết item-product -->
						      	</div> <!-- hết col-sm-4 -->

						      	@endforeach				      	
						    </div>		{{-- carousel-item active"	 --}}
						   
					    
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
				</div> {{-- carousel slide --}}

				<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="10"></div>
				<div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
			</div> {{-- recommended_items --}}


@endforeach

@endsection
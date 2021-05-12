@extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                        	<?php

                        		$message = Session::get('message');
                        		if($message) {
                        			echo '<span class="text-alert">'.$message.'</span>';
                        			Session::put('message', null);
                        		}
                        	 ?>
                            <div class="position-center">
                            	 {{-- enctype='multipart/form-data'nghĩa trong một phương pháp mã hóa HTML --}}
                            	  @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                	{{csrf_field()}}
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Enter email" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="product_slug" id="exampleInputEmail1" placeholder="Enter email" value="{{$pro->product_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa sản phẩm</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="exampleInputEmail1" placeholder="Enter email" value="{{$pro->meta_keywords}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm mới</label>
                                    <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" placeholder="Enter email" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm cũ</label>
                                    <input type="text" class="form-control" name="product_price_old" id="exampleInputEmail1" placeholder="Enter email" value="{{$pro->product_price_old}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1" placeholder="Enter email" >
                                    <img src="{{URL::to('public/uploads/products/'.$pro->product_image)}}" style="width: 100px; height: 100px">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows: 8;  type="password" class="form-control" id="editor" name="product_desc" placeholder="Mô tả danh mục">{{$pro->product_desc}}</textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows: 8;  type="password" class="form-control" id="editor1" name="product_content" placeholder="Mô tả danh mục">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
		                            @foreach($product_cate as $key => $cate_product){
		                            	@if($pro->category_id == $cate_product->category_id)    
		                                	<option selected value="{{$cate_product->category_id}}">{{$cate_product->category_name}}</option>
		                               	}		
		                                @else {
		                                  <option value="{{$cate_product->category_id}}">{{$cate_product->category_name}}</option>
		                            }
		                            	@endif
		                            @endforeach  
		                            </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
		                            @foreach($product_brand as $key => $brand_product)    
		                            	@if($pro->brand_id == $brand_product->brand_id){
		                                	<option selected value="{{$brand_product->brand_id}}">{{$brand_product->brand_name}}</option>
		                            	} 
		                            	@else {
		                            		<option value="{{$brand_product->brand_id}}">{{$brand_product->brand_name}}</option>
		                           		}
		                           		@endif
		                            	@endforeach  
		                               
		                            </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
		                                <option value="0">Ẩn</option>
		                                <option value="1">Hiển thị</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            @endforeach
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
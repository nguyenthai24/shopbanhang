 @extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu sản phẩm
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                	{{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="brand_slug" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa thương hiệu</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows: 8;  type="password" class="form-control" id="editor" name="brand_product_desc" placeholder="Mô tả danh mục" required  ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
		                                <option value="0">Ẩn</option>
		                                <option value="1">Hiển thị</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
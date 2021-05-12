 @extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                	{{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="slug_category_product" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa danh mục</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="editor" placeholder="Mô tả danh mục" ></textarea>
                                </div>
                                  
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
		                                <option value="0">Ẩn</option>
		                                <option value="1">Hiển thị</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
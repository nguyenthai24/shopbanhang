@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span>' .$message. '</span>';
                                    Session::put('message',null);
                                }
                             ?>
                        <div class="panel-body">
                            @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="brand_product_name" value="{{$edit_value->brand_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="brand_slug" value="{{$edit_value->brand_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa thương hiệu</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="từ khóa thương hiệu" name="meta_keywords" value="{{$edit_value->meta_keywords}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="6" class="form-control" id="editor" placeholder="Mô tả sản phẩm" name="brand_product_desc">{{$edit_value->brand_desc}}</textarea>
                                </div>        
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
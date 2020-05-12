@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm nhà cung cấp
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" name="TEN_NCC" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại nhà cung cấp</label>
                                    <input type="text" name="SDT_NCC" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ nhà cung cấp</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="DC_NCC" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">BRAND SLUG</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div><div class="form-group">
                                    <label for="exampleInputEmail1">BRAND DESC</label>
                                    <input type="text" name="desc" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div><div class="form-group">
                                    <label for="exampleInputEmail1">BRAND STATUS</label>
                                    <input type="text" name="status" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm nhà cung cấp</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

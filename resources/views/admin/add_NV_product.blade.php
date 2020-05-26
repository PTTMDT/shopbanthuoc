@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm nhân viên
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
                                <form role="form" action="{{URL::to('/saveNV-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="ten_nv" class="form-control" id="exampleInputEmail1" placeholder="Nhân viên">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text"  name="sdt" class="form-control" id="exampleInputEmail1" placeholder="Nhân viên">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email_nv" class="form-control" id="exampleInputEmail1" placeholder="Nhân viên">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại nhân viên</label>
                                      <select name="id_loai" class="form-control input-sm m-bot15">
                                        @foreach($nv_product as $key => $cate)
                                            <option value="{{$cate->ID_LOAI}}">{{$cate->TEN_LOAI}}</option>
                                        @endforeach  
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">KM_status</label>
                                    <input type="text" value="0"name="km_status" class="form-control" id="exampleInputEmail1" placeholder="Khuyến mãi">
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm nhân viên</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

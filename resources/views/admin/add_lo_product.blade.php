@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm lô
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
                                <form role="form" action="{{URL::to('/savelo-product')}}" method="post">
                                    {{ csrf_field() }}

                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Nhà cung cấp</label>
                                    <input type="text" name="id_ncc" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div> -->

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục nhà cung cấp</label>
                                      <select name="id_ncc" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $cate)
                                            <option value="{{$cate->ID_NCC}}">{{$cate->TEN_NCC}}</option>
                                        @endforeach  
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại lô</label>
                                      <select name="id_loai_lo" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->ID_LOAI_LO}}">{{$cate->TEN_LOAI_LO}}</option>
                                        @endforeach  
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên thuốc</label>
                                      <select name="id_ncc" class="form-control input-sm m-bot15">
                                        @foreach($detail_lo as $key => $cate)
                                            <option value="{{$cate->ID_THUOC}}">{{$cate->TEN_THUOC}}</option>
                                        @endforeach  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sản xuất</label>
                                    <input type="date"  name="ngaysx" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày hết hạn</label>
                                    <input type="date" name="ngayhh" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày nhập</label>
                                    <input type="date" name="ngaynhap" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="so_luong" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá lô</label>
                                    <input type="text" name="don_gia_lo" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">LO_status</label>
                                    <input type="text" value="0"name="lo_status" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm lô</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

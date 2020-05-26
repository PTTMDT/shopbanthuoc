@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật lô
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
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/updatelo-product/'.$pro->ID_LO)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="id_ncc" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $cate)
                                            @if($cate->ID_NCC==$pro->ID_NCC)
                                            <option selected value="{{$cate->ID_NCC}}">{{$cate->TEN_NCC}}</option>
                                            @else
                                            <option value="{{$cate->ID_NCC}}">{{$cate->TEN_NCC}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại lô</label>
                                      <select name="id_loai_lo" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->ID_LOAI_LO==$pro->ID_LOAI_LO)
                                            <option selected value="{{$cate->ID_LOAI_LO}}">{{$cate->TEN_LOAI_LO}}</option>
                                            @else
                                            <option value="{{$cate->ID_LOAI_LO}}">{{$cate->TEN_LOAI_LO}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sản xuất</label>
                                    <input type="date" name="ngaysx" class="form-control" id="exampleInputEmail1" value="{{$pro->NGAY_SX}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày hết hạn</label>
                                    <input type="date" name="ngayhh" class="form-control" id="exampleInputEmail1" value="{{$pro->NGAY_HH}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày nhập</label>
                                    <input type="date" name="ngaynhap" class="form-control" id="exampleInputEmail1" value="{{$pro->NGAY_NHAP}}">
                                </div>
                                 
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật lô</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection

@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật khuyến mãi
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
                                <form role="form" action="{{URL::to('/updateKM-product/'.$pro->ID_KM)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá trị khuyến mãi</label>
                                    <input type="text" name="gia_tri_km" class="form-control" id="exampleInputEmail1" value="{{$pro->GIA_TRI_KM}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày bắt đầu</label>
                                    <input type="date" name="ngaybd" class="form-control" id="exampleInputEmail1" value="{{$pro->NGAYBD}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày kết thúc</label>
                                    <input type="date" name="ngaykt" class="form-control" id="exampleInputEmail1" value="{{$pro->NGAYKT}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Loại khuyến mãi</label>
                                      <select name="id_loai_km" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->ID_LOAI_KM==$pro->ID_LOAI_KM)
                                            <option selected value="{{$cate->ID_LOAI_KM}}">{{$cate->TEN_LOAI_KM}}</option>
                                            @else
                                            <option value="{{$cate->ID_LOAI_KM}}">{{$cate->TEN_LOAI_KM}}</option>
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
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật khuyến mãi</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection

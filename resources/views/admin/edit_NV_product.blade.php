@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật nhân viên
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
                                <form role="form" action="{{URL::to('/updateNV-product/'.$pro->ID_NV)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="ten_nv" class="form-control" id="exampleInputEmail1" value="{{$pro->TEN_NV}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="sdt" class="form-control" id="exampleInputEmail1" value="{{$pro->SDT}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email_nv" class="form-control" id="exampleInputEmail1" value="{{$pro->EMAIL_NV}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Loại nhân viên</label>
                                      <select name="id_loai" class="form-control input-sm m-bot15">
                                        @foreach($nv_product as $key => $cate)
                                            @if($cate->ID_LOAI==$pro->ID_LOAI)
                                            <option selected value="{{$cate->ID_LOAI}}">{{$cate->TEN_LOAI}}</option>
                                            @else
                                            <option value="{{$cate->ID_LOAI}}">{{$cate->TEN_LOAI}}</option>
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
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật nhân viên<nav></nav></button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection

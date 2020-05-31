@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật khách hàng
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
                                @foreach($edit_customer as $key => $pro)
                                <form role="form" action="{{URL::to('/update-customer/'.$pro->ID_KH)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khách hàng</label>
                                    <input type="text" name="ten_kh" class="form-control" id="exampleInputEmail1" value="{{$pro->TEN_KH}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="sdt" class="form-control" id="exampleInputEmail1" value="{{$pro->SDT}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email_kh" class="form-control" id="exampleInputEmail1" value="{{$pro->EMAIL_KH}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Loại khách hàng</label>
                                      <select name="id_loai" class="form-control input-sm m-bot15">
                                        @foreach($loaikh as $key => $cate)
                                            @if($cate->ID_LKH==$pro->ID_LKH)
                                            <option selected value="{{$cate->ID_LKH}}">{{$cate->TEN_LKH}}</option>
                                            @else
                                            <option value="{{$cate->ID_LKH}}">{{$cate->TEN_LKH}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="update" class="btn btn-info">Cập nhật khách hàng<nav></nav></button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection

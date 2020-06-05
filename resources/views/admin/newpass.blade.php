@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật mật khẩu
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
                                <form role="form" action="{{URL::to('/check-updateMK')}}" method="post">
                                    {{ csrf_field() }}
                                 <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu mới</label>
                                    <input type="password" name="PASSWORD" class="forn-control"  id="exampleInputEmail1" placeholder="Nhập  mật khẩu mới">
                                    
                                </div>  -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu mới</label>
                                    <input type="password" name="PASSWORD" class="form-control" id="exampleInputEmail1" placeholder="Nhập mật khẩu mới">
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                                    <input type="password" name="password1" class="form-control" id="exampleInputEmail1" placeholder="Nhập lại mật khẩu mới">
                                </div> 
                                 <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="password1" class="forn-control"  id="exampleInputEmail1" placeholder="Nhập lại mật khẩu mới">
                                    
                                </div>   -->
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật</button>
                                
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

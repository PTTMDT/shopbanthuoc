@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Xác thực mật khẩu
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
                                <form role="form" action="{{URL::to('/mkdashboard-xt')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu cũ</label>
                                    <input type="password" name="password" class="forn-control"  placeholder="******" required="">
                                   
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu mới</label>
                                    <input type="password" name="passwordnew" class="forn-control"  placeholder="******" required="">
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="password" class="forn-control"  placeholder="******" required="">
                                    
                                </div> -->
                                <button type="submit" name="add_category_product" class="btn btn-info">Xác nhận</button>
                                
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

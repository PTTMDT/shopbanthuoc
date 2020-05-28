@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm chi tiết lô
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
                                <form role="form" action="{{URL::to('/save-detail-lo')}}" method="post">
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên thuốc</label>
                                      <select name="id_thuoc" class="form-control input-sm m-bot15">
                                        @foreach($thuoc as $key => $value)
                                            <option value="{{$value->ID_THUOC}}">{{$value->TEN_THUOC}}</option>
                                        @endforeach  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="so_luong" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá lô</label>
                                    <input type="text" name="don_gia_lo" class="form-control" id="exampleInputEmail1" placeholder="Lô">
                                </div>
                              
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm thuốc</button>
                                
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

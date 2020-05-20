@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm thuốc
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thuốc</label>
                                    <input type="text" name="ten_thuoc" class="form-control" id="exampleInputEmail1" placeholder="Tên thuốc">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục thuốc</label>
                                      <select name="goc" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->ID_GOC}}">{{$cate->GOC_THUOC}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Khuyến mãi</label>
                                      <select name="khuyen_mai" class="form-control input-sm m-bot15">
                                            <option value=""></option>
                                        @foreach($khuyenmai as $key => $value)
                                            <option value="{{$value->ID_KM}}">{{$value->GIA_TRI_KM}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">ID Khuyến mãi</label>
                                    <input type="text" name="khuyen_mai" class="form-control" id="exampleInputEmail1" placeholder="id khuyen mai">
                                </div>-->
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hoạt chất chính</label>
                                    <input type="text" name="hoat_chat_chinh" class="form-control" id="exampleInputEmail1" placeholder="Hoạt chất chính">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hàm lượng</label>
                                    <input type="text" name="ham_luong" class="form-control" id="exampleInputEmail1" placeholder="Hàm lượng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quy cách đóng gói</label>
                                    <input type="text" name="quy_cach" class="form-control" id="exampleInputEmail1" placeholder="Quy cách đóng gói">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tác dụng</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="tac_dung" id="exampleInputPassword1" placeholder="Tác dụng của thuốc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Desc</label>
                                    <input type="text" name="product_desc" class="form-control" id="exampleInputEmail1" placeholder="Desc">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cách dùng</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="cach_dung" id="exampleInputPassword1" placeholder="Cách dùng"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá</label>
                                    <input type="text" name="don_gia" class="form-control" id="exampleInputEmail1" placeholder="Đơn giá">
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="hinh_anh" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lưu ý</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="luu_y" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá khuyến mãi</label>
                                    <input type="text" name="don_gia_km" class="form-control" id="exampleInputEmail1" placeholder="Đơn giá khuyến mãi (nếu có)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Đơn vị tính</label>
                                      <select name="dvt" class="form-control input-sm m-bot15">
                                      @foreach($DVT as $key => $cate)
                                            <option value="{{$cate->DVT}}">{{$cate->DVT}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn</label>
                                    <input type="text" name="so_luong_ton" class="form-control" id="exampleInputEmail1" placeholder="Số lượng tồn">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <input type="text" name="status" class="form-control" id="exampleInputEmail1" placeholder="Status">
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Thêm thuốc</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection

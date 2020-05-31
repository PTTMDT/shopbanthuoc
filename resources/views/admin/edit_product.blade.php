@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật thuốc
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
                                <form role="form" action="{{URL::to('/update-product/'.$pro->ID_THUOC)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thuốc</label>
                                    <input type="text" name="ten_thuoc" class="form-control" id="exampleInputEmail1" value="{{$pro->TEN_THUOC}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="exampleInputEmail1" value="{{$pro->product_slug}}">
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá thuốc</label>
                                    <input type="text" value="{{$pro->DON_GIA}}" name="don_gia" class="form-control" id="exampleInputEmail1" >
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="hinh_anh" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->HINH_ANH)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tác dụng thuốc</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="tac_dung" id="exampleInputPassword1">{{$pro->TAC_DUNG}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hàm lượng</label>
                                    <input type="text" name="ham_luong" class="form-control" id="exampleInputEmail1" value="{{$pro->HAM_LUONG}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quy cách đóng gói</label>
                                    <input type="text" value="{{$pro->QUY_CACH_DONG_GOI}}" name="quy_cach" class="form-control" id="exampleInputEmail1" placeholder="Quy cách đóng gói">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Hoạt chất chính</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="hoat_chat_chinh" id="exampleInputPassword1" >{{$pro->HOAT_CHAT_CHINH}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Desc</label>
                                    <input type="text" value="{{$pro->product_desc}}" name="product_desc" class="form-control" id="exampleInputEmail1" placeholder="Desc">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục thuốc</label>
                                      <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->ID_GOC==$pro->ID_GOC)
                                            <option selected value="{{$cate->ID_GOC}}">{{$cate->GOC_THUOC}}</option>
                                            @else
                                            <option value="{{$cate->ID_GOC}}">{{$cate->GOC_THUOC}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Khuyến mãi</label>
                                    <select name="khuyen_mai" class="form-control">
    
                                            <option  value="{{$pro->ID_KM}}"></option>
                                    @foreach($km as $key => $km)  
                                            <option value="{{$km->ID_KM}}">{{$km->ID_KM}}</option>
                                            
                                    @endforeach
                                    </select>
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá khuyến mãi</label>
                                    <input type="text" value="{{$pro->DON_GIA_KM}}" name="don_gia_km" class="form-control" id="exampleInputEmail1"  disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Đơn vị tính</label>
                                       <select  name="dvt" class="form-control input-sm m-bot15">
                                      
                                            <option value="{{$pro->DVT}}">{{$pro->DVT}}</option>
                                            @foreach($DVT as $value)
                                            <option value="{{$value->DVT}}">{{$value->DVT}}</option>
                                            @endforeach
                                     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn</label>
                                    <input type="text" value="{{$pro->SO_LUONG_TON}}" name="so_luong_ton" class="form-control" id="exampleInputEmail1" disabled>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                             @if($cate->ID_GOC==$pro->ID_GOC)
                                            <option selected value="{{$brand->ID_NCC}}">{{$brand->TEN_NCC}}</option>
                                             @else
                                            <option value="{{$brand->ID_NCC}}">{{$brand->TEN_NCC}}</option>
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
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật thuốc</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection

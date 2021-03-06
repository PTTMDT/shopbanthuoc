@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center" style="color: #008B8B">Sản phẩm mới nhất</h2>
                        @foreach($all_product as $key => $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                             <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('public/uploads/product/'.$product->HINH_ANH)}}" alt="" />
                                            <!-- <h2 style="color: #008B8B ">{{number_format($product->DON_GIA).' '.'VNĐ'}}</h2> -->
                                  <?php
								      
                                      if($product->DON_GIA_KM==NULL)
                                      {
                                  ?>
                                      <h2 style="color: #008B8B;">{{number_format($product->DON_GIA).'VNĐ'}}</h2>
                                      
                                  <?php
                                  }else{
                                  ?>
                                      <h2  style="color: #008B8B;text-decoration:line-through"><del>{{number_format($product->DON_GIA).'VNĐ'}}</del></h2>
                                      <h2  style="color: red;">{{number_format($product->DON_GIA_KM).'VNĐ'}}</h2>
                                  <?php
                                  }
                                  ?>
                                            <p>{{$product->TEN_THUOC}}</p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}" class="btn btn-default add-to-cart" style="background-color: #008B8B;color: white"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                      
                                </div>

                            </a>
                                <!-- <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->
        <!--/recommended_items-->
@endsection

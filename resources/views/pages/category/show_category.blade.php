@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        
                        @foreach($category_name as $key => $name)
                       
                        <h2 class="title text-center" style="color: #008B8B ">{{$name->GOC_THUOC}}</h2>

                        @endforeach
                        @foreach($category_by_id as $key => $product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">

                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('public/uploads/product/'.$product->HINH_ANH)}}" alt="" />
                                            <h2 style="color: #008B8B">{{number_format($product->DON_GIA).' '.'VNĐ'}}</h2>
                                            <p>{{$product->TEN_THUOC}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"style="background-color: #008B8B; color: white "><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                      
                                </div>

                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach
                    </div><!--features_items-->
        <!--/recommended_items-->
@endsection

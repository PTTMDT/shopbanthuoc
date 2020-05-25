<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | LYNTT-Health</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

    <header id="header"><!--header-->
        <div class="header_top" style="background-color:#008B8B; color:white"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#" style="color:white"><i class="fa fa-phone"></i> +84782925679</a></li>
                                <li><a href="#" style="color:white"><i class="fa fa-envelope"></i>lyntthealth@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav"style="color:white">
                                <li><a href="#" style="color:white"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" style="color:white"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" style="color:white"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" style="color:white"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#" style="color:white"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{('public/frontend/images/yy.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"data-toggle="dropdown">
                                    Vietnamese
                                    <span class="caret"></span> 
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Vietnamese</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VNĐ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">VNĐ</a></li>
                                    <li><a href="#">Dollar</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                               
                                
                                <?php
                                   $customer_id = Session::get('ID_KH');
                                   $shipping_id = Session::get('TEN_TIENTE');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/checkout')}}" style="color:#008B8B "><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán{{$shipping_id}}</a></li>
                                 <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                 }
                                ?>
                                

                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php
                                   $customer_id = Session::get('ID_KH');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                
                                <?php
                            }else{
                                 ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                 <?php 
                             }
                                 ?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active"style="color:#008B8B ">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    @foreach($category as $value)
                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$value->slug_category_product)}}">{{$value->GOC_THUOC}}</a></li>
                                    @endforeach
                                        <!-- <li><a href="shop.html">THUỐC DA LIỄU</a></li>
                                        <li><a href="shop.html">THUỐC HỖ TRỢ TRÍ NHỚ</a></li>
                                        <li><a href="shop.html">THUỐC CẢM CÚM</a></li>
                                        <li><a href="shop.html">THUỐC HẠ SỐT, GIẢM ĐAU</a></li>
                                        <li><a href="shop.html">THUỐC DỊ ỨNG</a></li> -->
                                       
                                    </ul>
                                </li> 
                               
                                </li> 
                                <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
                                <li><a href="{{URL::to('/login')}}">Lịch sử mua hàng</a></li>
                                <li><a href="{{URL::to('/lienhe')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" method="POST">
                            {{csrf_field()}}
                        <div class="search_box pull-right">
                            <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
                            <input type="submit" style="margin-top:0;color:white;background-color: #008B8B " name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span style="color: #008B8B ">LYNTT</span>-Health</h1>
                                    <h2>Nhà Thuốc Trực Tuyến Thân Thiện Cho Mọi Gia Đình</h2>
                                    <p>Tự tạo đơn thuốc, Free ship cho hóa đơn từ 100.000đ trở lên</p>
                                    <button type="button" class="btn btn-default get"style="background-color: #008B8B ">ĐẶT THUỐC NGAY</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/c.jpg')}}" class="girl img-responsive" alt="" />
                                    <!-- <img src="{{('public/frontend/images/pricing.png')}}"  class="pricing" alt="" /> -->
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span style="color: #008B8B ">LYNTT</span>-Health</h1>
                                    <h2>Mở Rộng Phạm Vi Giao Hàng</h2>
                                    <p>Những Sản Phẩm Cần Thiết Trong MÙa Dịch Covid-19 Đáp Ứng Nhu Cầu Khắp Mọi Nơi </p>
                                    <button type="button" class="btn btn-default get" style="background-color: #008B8B ">ĐẶT THUỐC NGAY</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/d.jpg')}}" class="girl img-responsive" alt="" />
                                    <!-- <img src="{{('public/frontend/images/pricing.ipg')}}"  class="pricing" alt="" /> -->
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span style="color: #008B8B ">LYNTT</span>-Health</h1>
                                    <h2>Nhanh & Tiện Lợi</h2>
                                    <p>Tiết Kiệm Ngay 10% Trên Tổng Giá Trị Đơn Hàng </p>
                                    <button type="button" class="btn btn-default get" style="background-color: #008B8B ">ĐẶT THUỐC NGAY</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/E.jpg')}}" class="girl img-responsive" alt="" />
                                    <!-- <img src="{{('public/frontend/images/pricing.png')}}" class="pricing" alt="" /> -->
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2 style="color:#008B8B ">Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                          @foreach($category as $key => $cate)
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">{{$cate->GOC_THUOC}}</a></h4>
                                </div>
                            </div>
                        @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2 style="color:#008B8B ">Nhà cung cấp</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_slug)}}"> <span class="pull-right">(50)</span>{{$brand->TEN_NCC}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                     
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">

                   @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span style="color: #008B8B ">LYNTT</span>-Health</h2>
                            <h5>Cùng Khám Phá Trải NGhiệm - Nhà Thuốc Trực Tuyến</h5>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{('public/frontend/images/h.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Allerfar</p>
                                <h2>Hộp 10 vỉ x 20 viên</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                         <img src="{{('public/frontend/images/u.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Bromhexin</p>
                                <h2>Hộp 10 vỉ x 20 viên</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                         <img src="{{('public/frontend/images/n.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Stadleucin</p>
                                <h2>Hộp 10 vỉ x 10 viên</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                         <img src="{{('public/frontend/images/m.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Eumovate cream</p>
                                <h2>Hộp 1 tuýt</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Liên Hệ Với Chúng Tôi</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Điện Thoại: 0782925679</a></li>
                                <li><a href="#" >Hotline: 1900737891</a></li>
                                <li><a href="#" >Hỗ Trợ: lyntthealth@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch Vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Trò Chuyện Với Bác Sĩ</a></li>
                                <li><a href="#">Nhà Thuốc LYNTT-Health</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Tìm Hiểu Thêm</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Dịch Vụ Thăm Khám</a></li>
                                <li><a href="#">Dịch Vụ Kê Đơn Theo Toa</a></li>
                                <li><a href="#">Dịch Vụ Khách Hàng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Hỗ Trợ Khách Hàng</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Câu Hỏi Thường Gặp</a></li>
                                <li><a href="#">Chính Sách Bảo Mật</a></li>
                                <li><a href="#">Điều Khoản</a></li>
                                <li><a href="#">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2 style ="color: #FF8C00;color: #008B8B ">LYNTT-Health</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default" style="background-color: #008B8B "><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Địa Chỉ: 17/140b Nguyễn Văn CỪ Ninh Kiều Cần Thơ <br />Hân Hạnh Được Phục Vụ Quý Khách Hàng</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom" style="background-color:#008B8B;">
            <div class="container">
                <div class="row">
                    <p class="pull-left" style="color: white">Copyright © 2020 LYNTT-Health Inc. All rights reserved.</p>
                    <p class="pull-right" style="color: white">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>
</html>

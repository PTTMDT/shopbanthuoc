@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
							<img src="{{URL::to('public/uploads/product/'.$value->HINH_ANH)}}"/>
						
								
								<!-- <h3  style="background-color: #008B8B; color: white ">ZOOM</h3> -->
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <!-- <div class="carousel-inner">

										<div class="item active">
										  <a href=""><img src="{{URL::to('public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
										
										
										
									</div> -->

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev"  style="background-color: #008B8B; color: white ">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->TEN_THUOC}}</h2>
								<!-- <p>Mã ID: {{$value->ID_THUOC}}</p> -->
								<img src="images/product-details/rating.png" alt="" />
								
								<form action="{{URL::to('/save-cart')}}" method="POST">
									{{ csrf_field() }}
								<span>
									<span  style="color: #008B8B;">{{number_format($value->DON_GIA).'VNĐ'}}</span>
								
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" max="{{$value->SO_LUONG_TON}}" value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->ID_THUOC}}" />
									<button type="submit" class="btn btn-fefault cart"  style="background-color: #008B8B; color: white ">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
							
								</span>
								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mơi 100%</p>

							    <p><b>Giá khuyến mãi:</b> {{$value->DON_GIA_KM}}</p>
								<p><b>Danh mục:</b> {{$value->GOC_THUOC}}</p>
								<p><b>Hoạt chất chính:</b> {{$value->HOAT_CHAT_CHINH}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12"style="backgrund-color:#FFB367" >
							<ul class="nav nav-tabs" >
								<!-- <li class="active"><a href="#details" data-toggle="tab">Hoạt chất chính</a></li> -->
								<!-- <li><a href="#companyprofile" data-toggle="tab">Hàm lượng</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Quy cách đóng gói</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Tác dụng</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Cách dùng</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Lưu ý</a></li>
								 -->
								 <li><a href="#companyprofile" data-toggle="tab" style="color: white">Thông tin</a></li>
								
								<li ><a href="#reviews" data-toggle="tab" style="color: white">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<!-- <div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_desc!!}</p>
								
							</div> -->
							
							<div class="tab-pane fade" id="companyprofile" >
								<!-- <p>Hàm lượng: {!!$value->HOAT_CHAT_CHINH!!}</p> -->
								<p>Hàm lượng: {!!$value->HAM_LUONG!!}</p>
								<p>Quy cách đóng gói: {!!$value->QUY_CACH_DONG_GOI!!}</p>
								<p>Tác dụng: {!!$value->TAC_DUNG!!}</p>
								<p>Cách dùng: {!!$value->CACH_DUNG!!}</p>
								<p>Lưu ý: {!!$value->CACH_DUNG!!}</p>
							</div>

							
							<!-- <div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->HAM_LUONG!!}</p>
						
							</div>

							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->QUY_CACH_DONG_GOI!!}</p>
						
							</div>

							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->TAC_DUNG!!}</p>
						
							</div>
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->CACH_DUNG!!}</p>
						
							</div>
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->LUU_Y!!}</p>
						
							</div> -->
							

							<div class="tab-pane fade" id="reviews" >
					
								<div class="col-sm-12">
							@foreach($danhgia as $key => $value)
									<ul>
										<li><a href=""><i class="fa fa-user"></i>{{$value->TEN_KH}}</a></li>
										
										<li><a href=""><i class="fa fa-calendar-o"></i>{{$value->NGAY}}</a></li>
									</ul>
									<p>{{$value->ND_DANH_GIA}}</p>
                                    
							@endforeach	     
							        <hr/>
                                    <form action="{{URL::to('/add_binhluan')}}" method="POST"> 
									    {{csrf_field()}} 
										<span>
											<input type="text" name="TEN_KH" placeholder="Your Name"/>
											<input type="text" name="EMAIL_KH" placeholder="Email Address"/>
										     <!-- <input type="text" name="ND_DANH_GIA" placeholder=""/>  --> 
										</span> 

										<textarea name="nd_danhgia" ></textarea>
										<b></b> <img src="images/product-details/rating.png" alt="" />
										<button type="submit" class="btn btn-default pull-right" >Submit</button>
									</form> 	 
								</div> 
					
									<!-- <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b></b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form> -->
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
							@foreach($relate as $key => $lienquan)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											 <div class="single-products">
		                                        <div class="productinfo text-center">
		                                            <img src="{{URL::to('public/uploads/product/'.$lienquan->HINH_ANH)}}" alt="" />
													
												    <h2>{{number_format($lienquan->DON_GIA).' '.'VNĐ'}}</h2>
		                                            <p>{{$lienquan->TEN_THUOC}}</p>
		                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
		                                        </div>
		                                      
                                			</div>
										</div>
									</div>
							@endforeach		

								
								</div>
									
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection

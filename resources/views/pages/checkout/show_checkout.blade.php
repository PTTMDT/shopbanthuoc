@extends('layout')
@section('content')
@foreach($customer as $key => $value)
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<div class="register-req">
				<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
									{{csrf_field()}}
									<input type="text" value="{{$value->EMAIL_KH}}" name="shipping_email" placeholder="Email" disabled>
									<input type="text" value="{{$value->TEN_KH}}" name="shipping_name" placeholder="Họ và tên" disabled>
									<input type="text" value="{{$value->DIA_CHI}}" name="shipping_address" placeholder="Địa chỉ" disabled>
									<input type="text" value="{{$value->SDT}}" name="shipping_phone" placeholder="Phone" disabled>
									<input type="text"  name="offer" placeholder="Mã khuyến mãi (nếu có)" >
									<textarea name="shipping_notes"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
									<!-- <input type="text" value="{{Cart::total(0,'','')}}" name="tong_tien"> -->
									<div class="review-payment">
			                        	<h2>Chọn dịch vụ</h2>
			                         	<br>
		                        	</div>

		
			                         <div class="payment-options">
			                         @foreach($tranport as $key => $vc)
			                   		<span>
					                 	<label><input type="radio" name="vanchuyen" value="{{$vc->ID_VC}}"> {{$vc->TEN_VC}} </label>
									
				                	</span>
		                            @endforeach	
			                    	<!-- <span>
			            			<label><input type="checkbox"> Check Payment</label>
				                	</span>
			                		<span>
				            		<label><input type="checkbox"> Paypal</label>
				                	</span> -->
			                    	</div>
		                     		<div class="payment-options">
	                         		@foreach($payment as $key => $tt)
			                		<span>
				            		<label><input type="radio" name="thanhtoan" value="{{$tt->ID_HT}}"> {{$tt->TEN_HT}} </label>
				                	</span>
		                          @endforeach	
					<!-- <span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span> -->
		                    		</div>
									
									<input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">
								</form>
							</div>
							
						</div>
					</div>
									
				</div>
			</div>
			
		</div>
	</section> <!--/#cart_items-->
@endforeach		

@endsection
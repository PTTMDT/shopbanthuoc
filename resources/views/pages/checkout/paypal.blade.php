@extends('layout')
@section('content')
<section id="cart_items">
   <div class="container" >
	<script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
    <script>paypal.Buttons().render('#cart_items');</script>
	</div>
</section> <!--/#cart_items-->
@endsection
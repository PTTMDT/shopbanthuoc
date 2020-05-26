@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin chi tiết lô
    </div>
    
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên thuốc</th>
            <th>Loại lô</th>
            <th>Số lượng</th>
            <th>Đơn giá lô</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($order_by_id as $order)
          <tr>
           
          <td>{{$order->TEN_THUOC}}</td>
          <td>{{$order->TEN_LOAI_LO}}</td>
          <td>{{$order->SO_LUONG}}</td>
          <td>{{$order->DON_GIA_LO}}</td>
            
         
            </td>
          
          </tr>
        @endforeach
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>

     



@endsection

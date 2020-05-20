@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin khách hàng
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
           
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
          <td>{{$order_by_id->TEN_KH}}</td>
          <td>{{$order_by_id->SDT}}</td>
            
           
          
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin đơn đặt hàng
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
           
            <th>Tổng đơn đặt hàng:</th>
            <td>{{$order_by_id->TONG_DDH}}</td>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <thead>
          <tr>
           
            <th>Ngày đặt:</th>
            <td>{{$order_by_id->NGAY_DAT}}</td>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <thead>
          <tr>
           
            <th>Nhân viên giao dịch:</th>
            <td>{{$order_by_id->TEN_NV}}</td>
            <th>Số điện thoại:</th>
            <td>{{$order_by_id->SDT}}</td>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        

        <thead>
        
          <tr>
           
            <th>Hình thức vận chuyển:</th>
            <td>{{$order_by_id->TEN_VC}}</td>
            <th>Giá vận chuyển:</th>
            <td>{{$order_by_id->GIA_VC}}</td>
             
            
           
          
          </tr>
     
        </tbody>
        <thead>
          <tr>
           
            <th>Hình thức thanh_toán</th>
            <td>{{$order_by_id->TEN_HT}}</td>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
      </table>

    </div>
   
  </div>
</div>
<br><br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Chi tiết đơn hàng
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
            <th>Số lượng</th>
            <th>Đơn giá</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
        
          <td>{{$order_by_id->TEN_THUOC}}</td>
          <td>{{$order_by_id->SO_LUONG}}</td>
          <td>{{$order_by_id->DON_GIA}}</td>
            
           
          
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>

@endsection

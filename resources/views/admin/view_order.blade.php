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
            <td>{{$order_by_id->ID_DDH}}</td>
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
            <th>Khuyến mãi</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($detail_order as $value)
          <tr>
        <?php
        $km=$value->ID_KM;
        if($km==NULL){
        ?>
          <td>{{$value->TEN_THUOC}}</td>
          <td>{{$value->SO_LUONG}}</td>
          <td>{{$value->DON_GIA}}</td>
          <td></td>
        <?php
        }else{
        ?>
          <td>{{$value->TEN_THUOC}}</td>
          <td>{{$value->SO_LUONG}}</td>
          <td>{{$value->DON_GIA}}</td>
          <td>{{$value->GIA_TRI_KM}}</td>  
        <?php
        }
        ?>   
          </tr>
        @endforeach
        </tbody>
      </table>
      <a href="{{url('/print-order/'.$order_by_id->ID_DDH)}}">In đơn hàng</a>
    </div>

   
  </div>
</div>
<br>

@endsection

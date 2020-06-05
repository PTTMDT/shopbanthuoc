@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin nhân viên
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
           
            <th>Tên nhân viên</th>
            <td>{{$NV_by_id->TEN_NV}}</td>
           
           
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <thead>
        
          <tr>
           
          <th>Số điện thoại</th>
          <td>{{$NV_by_id->SDT}}</td>
          
            
           
          
          </tr>
     
        </thead>
        <thead>
        
          <tr>
           
          
          <th>Email</th>
          <td>{{$NV_by_id->EMAIL_NV}}</td>
          
            
           
          
          </tr>
     
        </thead>
        <thead>
        
          <tr>
           
          
          
          <th>Loại nhân viên</th>
          <td>{{$NV_by_id->TEN_LOAI}}</td>
            
           
          
          </tr>
     
        </thead>
      </table>
      

    </div>
   
  </div>
  <table>
          <thead>
              <tr>
                <td>
                  <a href="{{URL::to('/edit-admin/'.$NV_by_id->ID_NV)}}">Sửa đổi thông tin </a>
                 
               </td>
              </tr>
          </thead>
          <thead>
              <tr>
                <td>
                  <a href="{{URL::to('/mkdashboard/')}}">Thay đổi mật khẩu </a>
                 
               </td>
              </tr>
          </thead>
      </table>
</div>
<br>

<br>

@endsection

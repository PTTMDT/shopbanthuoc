@extends('layout')
@section('content')

<table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <!-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> -->
            <th>Ngày đặt hàng</th>
            <th>Mã đơn đặt hàng</th>
            <th>Tổng giá tiền</th>
            <th>Ghi chú</th>
            <th>Trạng thái đơn hàng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($history as $key => $value)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $value->NGAY_DAT}}</td>
            <td>{{ $value->ID_DDH}}</td>
            <td>{{ $value->THANH_TIEN}}</td>
            <td>{{ $value->GHI_CHU}}</td>
            <td>{{ $value->TEN_TT}}</td>
            
             
          </tr>
          @endforeach
        </tbody>
      </table>
@endsection
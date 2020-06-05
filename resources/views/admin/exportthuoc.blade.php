<p>LYNTT-Shop bán thuốc</p>
<p>Thống kê thuốc</p>
<table id="thuoc" class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Slug</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hàm lượng</th>
            <th>Quy cách đóng gói</th>
            <th>Tác dụng</th>
            <th>Cách Dùng</th>
            <th>Đơn giá </th>
            <th>Lưu ý</th>
            <th>Đơn vị tính</th>
            <th>Số lượng tồn</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <td>{{ $pro['TEN_THUOC'] }}</td>
            <td>{{ $pro['product_slug'] }}</td>
            <td>{{ $pro['GOC_THUOC'] }}</td>
            <td>{{ $pro['HAM_LUONG'] }}</td>
            <td>{{ $pro['QUY_CACH_DONG_GOI'] }}</td>
            <td>{{ $pro['TAC_DUNG'] }}</td>
            <td>{{ $pro['CACH_DUNG'] }}</td>
            <td>{{ $pro['DON_GIA'] }}</td>
            <td>{{ $pro['LUU_Y'] }}</td>
            <td>{{ $pro['DVT'] }}</td>
            <td>{{ $pro['SO_LUONG_TON'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
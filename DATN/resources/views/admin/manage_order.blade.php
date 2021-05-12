@extends('admin_layout')
@section('admin_content')
  <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
    
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php
          $message = Session::get('message');
          //nếu tồn tại biến $message thỳ thực hiện lệnh
          if($message) {
            echo '<span class="text-alert">'.$message.' </span';
            Session::put('message', null);
          }
        ?>
        <thead>
          <tr>
          
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng đơn hàng</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i =0;
          @endphp
          @foreach($order as $key => $val)
            @php
              $i++;
            @endphp
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{ $val->order_code}}</td>
            <td>{{$val->created_at}}</td>
            <td>
              @php
                if($val->order_status == 1)
                  echo 'Đơn hàng mới';
                else {
                  echo 'Đã xử lí';
                }
              @endphp
            </td>
           
           
            <td>
              <a href="{{URL::to('/view-order/'.$val->order_code)}}" class="active edit-styling" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>
              </a>
              <a onclick="return confirm('Are you sure delete ?')" href="{{URL::to('/delete-order/'.$val->order_code)}}" class="active edit-styling" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   
  </div>
</div>
@endsection
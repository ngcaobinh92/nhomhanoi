@extends('cms.master.default')

@section('content')

@if(session('thongbao'))
<span class="error"><b>{{session('thongbao')}}</b></span>
@endif

<header class="page-header">
  <h2>{{ trans('cms.danh_sach') }}</h2>
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quán lý đơn hàng</span></li>
      <li><span>Danh sách</span></li>
    </ol>

    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<div class="row">
  <section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="fa fa-caret-down"></a>
          <a href="#" class="fa fa-times"></a>
        </div>
      <h2 class="panel-title">Danh sách</h2>
        
      <form method="GET">
        <section>
            <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Tên khách hàng</label>
                  <input type="text" name="order_cus_name" class="form-control" value="@if(isset($_GET['order_cus_name'])){{$_GET['order_cus_name']}}@endif">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">SĐT</label>
                  <input type="text" name="order_cus_phone" class="form-control" value="@if(isset($_GET['order_cus_phone'])){{$_GET['order_cus_phone']}}@endif">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Địa chi</label>
                  <input type="text" name="order_cus_address" class="form-control" value="@if(isset($_GET['order_cus_address'])){{$_GET['order_cus_address']}}@endif">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.tinh_trang') }}</label>
                  <select id="order_status" name="order_status" class="form-control">
                    <option value="" @if(isset($_GET['order_status']) && $_GET['order_status'] == ''){{'selected'}}@endif>Tất cả</option>
                    <option value="public" @if(isset($_GET['order_status']) && $_GET['order_status'] == 'pending'){{'selected'}}@endif>Đang chờ</option>
                    <option value="preview" @if(isset($_GET['order_status']) && $_GET['order_status'] == 'approved'){{'selected'}}@endif>Đã duyệt</option>
                  </select>
                </div>
              </div>
              
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Khoảng giá</label>
                  <div class="m-md slider-primary" data-plugin-slider data-plugin-options='{ "values": [ @if(isset($_GET['price_range'])){{str_replace('/', ', ', $_GET['price_range'])}}@else{{'333333333, 666666666'}}@endif ], "range": true, "max": 999999999 }' data-plugin-slider-output="#listenSlider2">
                    <input id="listenSlider2" name="price_range" type="hidden" value="@if(isset($_GET['price_range'])){{urldecode($_GET['price_range'])}}@else{{'333333333/666666666'}}@endif" />
                  </div>
                  <p class="output2">Khoảng giá <code>tối thiểu</code> hiện tại là: <b class="min">@if(isset($_GET['price_range'])){{number_format(explode('/', $_GET['price_range'])[0])}}@else{{'333,333,333'}}@endif đ</b> và <code>tối đa</code> là: <b class="max"> @if(isset($_GET['price_range'])){{number_format(explode('/', $_GET['price_range'])[1])}}@else{{'666,666,666'}}@endif đ</b></p>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group" id="range">
                  <label class="control-label">Ngày đặt hàng</label>
                  <div class="input-daterange input-group date_range @if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'){{'hidden'}}@endif" data-plugin-datepicker>
                    <span class="input-group-addon">Từ</span>
                    <input type="text" class="form-control" name="date_start" value="@if(isset($_GET['date_start'])){{$_GET['date_start']}}@endif">
                    <span class="input-group-addon">Đến</span>
                    <input type="text" class="form-control" name="date_end" value="@if(isset($_GET['date_end'])){{$_GET['date_end']}}@endif">
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <br>
                  <button class="btn btn-primary">Tìm kiếm</button>
                </div>
              </div>
            </div>
        </section>
      </form>
    </header>

    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th class="center">ID</th>
              <th class="center">Tên khách hàng</th>
              <th class="center">SĐT</th>
              <th class="center">Địa chỉ</th>
              <th class="center">Số lượng sản phẩm</th>
              <th class="center">Giá cả (VNĐ)</th>
              <th class="center">Ngày đặt hàng</th>
              <th class="center">Trạng thái</th>
              <th class="center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $product)
            <tr>
              <td class="center">{{$product->id}}</td>
              <td>
                <a href="cms/don-hang/edit/{{$product->id}}" title="{{$product->order_cus_name}}">
                  {{$product->order_cus_name}}
                </a>
              </td>
              <td>
                {{$product->order_cus_phone}}
              </td>
              <td>
                {{$product->order_cus_address}}
              </td>
              <td class="center">
                {{count($product->items)}} sản phẩm
              </td>
              <td class="center">
                {{$product->total_price}}
              </td>
              <td class="center">
                {{date('H:i:s d/m/Y', strtotime($product->created_at))}}
              </td>
              @php
                switch ($product->order_status) {
                  case 'pending':
                    $status = 'Đang chờ';
                    break;
                  
                  default:
                    $status = 'Đã duyệt';
                    break;
                }
              @endphp
              <td class="center">
                {{$status}}
              </td>
              <td class="center actions-hover actions-fade">
                <a href="cms/don-hang/edit/{{$product->id}}" title="Sửa"><i class="fa fa-pencil"></i></a>
                <a href="cms/don-hang/delete/{{$product->id}}" title="Xóa" class="btn-delete" data-id="{{$product->id}}"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

@endsection

@section('extra-script')
<script type="text/javascript">

  $('#listenSlider2').change(function() {
    var min = addCommas(parseInt(this.value.split('/')[0], 10)) + ' đ';
    var max = addCommas(parseInt(this.value.split('/')[1], 10)) + ' đ';

    $('.output2 b.min').text( min );
    $('.output2 b.max').text( max );
  });


  var datatableInit = function() {
    $('#datatable-default').dataTable();
  };

  $('#type_date').on('change', function() {
    if (this.value == 'origin_price') {
      $(".date_range :input").attr("disabled", true);
      $(".date_range").addClass('hidden');
      $(".amount_range :input").attr("disabled", false).val('');
      $(".amount_range").removeClass('hidden');
    } else {
      $(".date_range :input").attr("disabled", false).val('');
      $(".date_range").removeClass('hidden');
      $(".amount_range :input").attr("disabled", true);
      $(".amount_range").addClass('hidden');
    }
  });

  function addCommas(nStr) {
    nStr += '';
    x = nStr.split( /(?=(?:...)*$)/);
    return x;
  }
</script>
@endsection
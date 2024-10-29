@extends('cms.master.default')

@section('extra-script')
<script type="text/javascript">
  $('.cart-delete').click(function(){
    if(confirm('Bạn chắc chắn muốn thực hiện hành động?')){
      var del_url = $(this).attr('href');
      $.ajax({
        type: 'get',
        url: del_url,
        context: this
      }).done(function(data){
        if(data > 0){
          alert('Xóa đơn hàng thành công');
          window.location.replace("/cms/don-hang/list");
        }else{
          alert('Xóa dữ liệu thất bại, vui lòng thử lại sau');
        }
      });
    }
    return false;
  });
</script>
@endsection

@section('content')

<header class="page-header">
  <h2>Chỉnh sửa</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="index.html">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quán lý đơn hàng</span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->
@if(session('thongbao'))
<div><b>{{session('thongbao')}}</b></div><br>
@endif

<div class="row">
  <form class="form-horizontal" method="post" id="form summary-form">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <section class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="fa fa-caret-down"></a>
          <a href="#" class="fa fa-times"></a>
        </div>
        <h2 class="panel-title">Thông tin đơn hàng</h2>
      </header>

      <div class="panel-body">  
        <div class="col-md-7 col-lg-8">
          <section class="panel">
            <div class="row">
              <div class="panel-body">
                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Tên khách hàng</label>
                    <input type="text" class="form-control" name="title" value="{{$data->order_cus_name}}" required disabled="">
                    @if($errors->has('order_cus_name'))
                    <span class="error_mess">{{$errors->first('order_cus_name')}}</span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Điện thoại liên hệ</label>
                    <input type="text" class="form-control" name="order_cus_phone" value="{{$data->order_cus_phone}}" required="" disabled="">
                    @if($errors->has('order_cus_phone'))
                    <span class="error_mess">{{$errors->first('order_cus_phone')}}</span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Địa chỉ nhận hàng</label>
                    <textarea class="form-control" name="order_cus_address" required="" disabled="">{{$data->order_cus_address}}</textarea>
                  </div>
                </div>

              </div>
            </div>
          </section>

          <section class="panel">
            <div class="row">
              
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped mb-none" id="datatable-default">
                    <thead>
                      <tr>
                        <th class="center">ID sản phẩm</th>
                        <th class="center">Ảnh sản phẩm</th>
                        <th class="center">Tên sản phẩm</th>
                        <th class="center">Giá gốc</th>
                        <th class="center">Sale</th>
                        <th class="center">Giá sau giảm</th>
                        <th class="center">Số lượng đặt mua / tồn kho</th>
                        <th class="center">Trạng thái</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data->items as $product)
                      <tr>
                        <td class="center">{{$product->product_id}}</td>
                        <td>
                          <a href="cms/san-pham/edit/{{$product->product_id}}" title="{{$product->title}}">
                            <img src="{{$product->featured_image}}" alt="" style="width: 100px;">
                          </a>
                        <td>
                          <a href="cms/san-pham/edit/{{$product->product_id}}" title="{{$product->title}}">
                            {{$product->title}}
                          </a>
                        </td>
                        <td class="center">{{number_format($product->origin_price)}}đ</td>
                        <td class="center">{{$product->sale}}%</td>
                        <td class="center">{{number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))}}đ</td>
                        <td class="center">{{$product->order_quantity}} / {{$product->quantity}} (@if(($product->quantity - $product->order_quantity) > 0){{'còn hàng'}}@else{{'thiếu '.abs($product->quantity - $product->order_quantity).' sản phẩm'}}@endif)</td>
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
                        <td class="center">{{$status}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div class="col-md-5 col-lg-4">
          <section class="panel">
            <div class="row">
              <div class="panel-body">

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Ngày đặt hàng</label>
                    <input type="text" class="form-control" name="created_at" min="0" step="1" value="{{date('d/m/Y H:i:s', strtotime($data->created_at))}}" required="" disabled="">
                    @if($errors->has('created_at'))
                    <span class="error_mess">{{$errors->first('created_at')}}</span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Tổng trước thuế</label>
                    <input type="text" class="form-control" name="all_price" min="0" step="any" value="{{number_format($data->all_price)}}" required="" disabled="">
                    @if($errors->has('all_price'))
                    <span class="error_mess">{{$errors->first('all_price')}}</span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Tiền thuế</label>
                    <input type="text" class="form-control" name="vat_price" max="100" min="0" step="any" value="{{number_format($data->vat_price)}}" required="" disabled="">
                    @if($errors->has('vat_price'))
                    <span class="error_mess">{{$errors->first('vat_price')}}</span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Tổng sau thuế</label>
                    <input type="text" class="form-control" name="total_price" max="100" min="0" step="any" value="{{number_format($data->total_price)}}" required="" disabled="">
                    @if($errors->has('total_price'))
                    <span class="error_mess">{{$errors->first('total_price')}}</span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Trạng thái</label>
                    <select id="order_status" name="order_status" class="form-control">
                      <option value="{{$data->order_status}}" hidden="" selected="">@if($data->order_status == 'pending'){{'Đang chờ'}}@else{{'Đã duyệt'}}@endif</option>
                      <option value="pending">Chờ</option>
                      <option value="approved">Duyệt</option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-12 form-type center">
                  <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-primary ">Xác nhận</button>&emsp;
                    <a href="cms/don-hang/delete/{{$data->id}}" class="btn btn-default cart-delete">Xóa đơn hàng</a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>

  </form>
</div>
<!-- end: page -->
@endsection
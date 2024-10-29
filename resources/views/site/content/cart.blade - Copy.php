@extends('site.master.default')
@section('content')
<style type="text/css">
  .cart_product img {
    max-width: 30%;
  }
</style>

<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
          <span class="divider"></span>
        </li>
        <li>Giỏ hàng</li>
      </ul>
    </div>
  </div>
</section>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="cat_header">
        <h2 class="page_title">Giỏ hàng</h2>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row content-page">
      <div class="box padding cart">
        <section id="cart_submit">
          <div class="container">
            <div class="table-responsive cart_info">
              @if(count($cart))
              <table class="table table-condensed">
                <thead style="top: 0;position: sticky;z-index: 1;background: white;">
                  <tr class="cart_menu">
                    <td class="image" colspan="2">Sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng cộng</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                @php
                  $total_bill = 0;
                @endphp
                @foreach($cart as $item)
                  <tr>
                    <td class="cart_product">
                      <a href="{{$item->options->slug}}"><img src="{{$item->options->image}}" alt=""></a>
                    </td>
                    <td class="cart_description">
                      <p><a href="{{$item->options->slug}}">{{$item->name}}</a></p>
                    </td>
                    <td class="cart_price">
                      <p>{{$item->price}} VNĐ</p>
                    </td>
                    <td class="cart_quantity">
                      <div class="cart_quantity_button">
                        <a class="cart_change" data-href='{{url("gio-hang?product_id=$item->id&increment=1")}}'> + </a>
                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2">
                        <a class="cart_change" data-href='{{url("gio-hang?product_id=$item->id&decrease=1")}}'> - </a>
                      </div>
                    </td>
                    <td class="cart_total">
                      <p class="cart_total_price">{{$item->subtotal}} VNĐ</p>
                    </td>
                    <td>
                      <a class="cart_change" data-href='{{url("gio-hang?product_id=$item->id&remove=1")}}'><i class="fa fa-times"></i></a>
                    </td>
                  </tr>
                  @php
                    $total_bill = $total_bill + $item->subtotal;
                  @endphp
                @endforeach
                  <tr>
                    <td colspan="5">Tổng cộng</td>
                    <td>{{$total_bill}}</td>
                  </tr>
                  <tr>
                    <td colspan="5">VAT</td>
                    <td>{{$total_bill / 10}}</td>
                  </tr>
                  <tr>
                    <td colspan="5">Thành tiên</td>
                    <td>{{$total_bill + ($total_bill / 10)}}</td>
                  </tr>
                </tbody>
              </table>
              @else
              <p>Giỏ hàng của bạn hiện đang trống.</p>
              @endif
            </div>
          </div>
          <div class="panel-control submit-control" style="text-align: right;padding: 10px;">
          @if(count($cart))
            <a class="cart_delete btn btn-danger" data-href='{{url("gio-hang?destroy=1")}}'>Xóa toàn bộ</a>
            &nbsp;&nbsp;&nbsp;<a class="btn btn-success submit-btn">Đặt hàng</a>
          @endif
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
<div style="background: #fff;height: 20px;"></div>

<script type="text/javascript">
  $("#cart_submit").on('click', '.submit-btn', function(){
    var user = CheckUserSession();
    if (user == true) {
      payment();
    } else {
      alert('none');
    }
  });

  function payment() {
    var email = $('#email').val();
    $.ajax({
      url: 'gio-hang/payment',
      type: 'POST',
      dataType: 'json',
      data: email,
      contentType: 'application/json; charset=utf-8',
      async: false,
      success: function (data) {
        console.log(data);

        // alert('Đặt hàng thành công, vui lòng kiểm tra lại email để xác thực lại đơn hàng');
        // var total_bill = parseInt(data.total_bill);
        // var total_all_bill = total_bill + (total_bill/10);
        // $( "#cart-info .cart_info" ).html( data.response );
        // $( "#cart_submit .cart_info" ).html( data.submit );
        // $( "#cart_submit tbody" ).append( '<tr><td colspan="5">Tổng cộng</td><td>' + total_bill + '</td></tr><tr><td colspan="5">VAT</td><td>' + (total_bill / 10) + '</td></tr><tr><td colspan="5">Thành tiên</td><td>' + total_all_bill + '</td></tr>' );
        // if (data.total > 0) {
        //    $( "#cart_submit .submit-control" ).html('<a class="cart_delete btn btn-danger" data-href={{url("gio-hang?destroy=1")}}>Xóa toàn bộ</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-success submit-btn">Đặt hàng</a>');
        // } else {
        //    $( "#cart_submit .submit-control" ).empty();
        // }
        // $( "#cart-total" ).text( data.total );
      }
    });
  }
</script>
@endsection
$(function() {
  $(document).on('click', '.product-add', function() {
    var click = $(this).prev();
    var product = click.attr('data-product');

    $.get( $(this).data('href'), function( data ) {
      if (data.status == true) {
        var a;
        var c = product;
        if (click.is( "input" )) {
          a = click.val();
        } else if (click.is( "span" )) {
          a = click.text();
        } else {
          return false;
        }
        var b = parseInt(a) + 1;
        if (b == 99) {
          return
        }

        $("[data-product="+product+"]").text(b);
        $("[data-product="+product+"]").attr('value', b);
        // click.val(b);

        TotalPrice();
        CountPrice(product);
      } else {
        return false;
      }
    });
  });

  $(document).on('click', '.product-jian', function() {
    var click = $(this).next();
    var product = click.attr('data-product');

    $.get( $(this).data('href'), function( data ) {
      if (data.status == true) {
        var a;
        if (click.is( "input" )) {
          a = click.val();
        } else if (click.is( "span" )) {
          a = click.text();
        } else {
          return false;
        }
        var b = parseInt(a) - 1;
        if (b == 0) {
          return false;
        }
        $("[data-product="+product+"]").text(b);
        $("[data-product="+product+"]").attr('value', b);

        TotalPrice();
        CountPrice(product);
      } else {
        return false;
      }
    });
  });


  $(".product-ckb").click(function() {
    $(this).children("em").toggleClass("product-xz");
    TotalPrice();
    productxz()
  });

  $(".product-al").click(function() {
    var a = $(".product-em");
    var b = $(".product-all em");
    b.toggleClass("product-all-on");
    if ($(this).find(".product-all em").is(".product-all-on")) {
      a.addClass("product-xz")
    } else {
      a.removeClass("product-xz")
    }
    TotalPrice();
    shuliang()
  });

  $(document).on('click', '.cart_change', function() {
    if (confirm("Bạn có chắc chắn muốn xóa mục hiện tại không?")) {
      var a = $(this);
      var b = $(this).attr("data-product-id");
      $.get( a.data('href'), function( data ) {
        if (data.status == true) {
          $('[data-product-id="'+b+'"]').closest(".product-box").remove();
          shuliang();
          koncat();
          TotalPrice()
        } else {
          return false;
        }
      });
    }
  });

  TotalPrice();
  shuliang();
  koncat()
});

function productxz() {
  var a = $(".product-em");
  var b = $(".product-xz");
  if (b.length == a.length) {
    $(".product-all em").addClass("product-all-on")
  } else {
    $(".product-all em").removeClass("product-all-on")
  }
  shuliang();
  TotalPrice()
}

function TotalPrice() {
  var a = 0, e = 0;
  var s = parseInt($(".sale-price").text());

  $(".product-em").each(function() {
    if ($(this).is(".product-xz")) {
      var c = parseInt($(this).parents(".product-ckb").siblings().find(".price-cart").text().split(",").join(""));
      var d = parseInt($(this).parents(".product-ckb").siblings().find(".product-num").val());
      var b = c * d;
      a += b
    }
    e = ((a - s) / 10);
    $(".all-price").text(addCommas(a) + " đ");
    $("input[name=all_price]").val(a);
    $(".sale-price").text(addCommas(s) + " đ");
    $("input[name=sale_price]").val(s);
    $(".vat-price").text(addCommas(e) + " đ");
    $("input[name=vat_price]").val(e);
    $(".total-price").text(addCommas(e + a) + " đ");
    $("input[name=total_price]").val(e + a);
  });
}

function CountPrice(id) {
  var a = parseInt($(".cart_quantity_button").find("[data-product="+id+"]").text());
  var b = parseInt($(".cart_price").find("[data-product-price="+id+"]").text().split(",").join(""));
  var c = a * b;
  $("[data-product-total="+id+"]").text(addCommas(c) + " đ");
}

function addCommas(nStr) {
  nStr += '';
  x = nStr.split( /(?=(?:...)*$)/);
  return x;
}

function shuliang() {
  $(".product-all-sl").text("");
  var a = $(".product-xz").length;
  $(".product-all-sl").text(a);
  if (a > 0) {
    $(".product-all-qx").html("đã chọn <b>" + a + "</b> sản phẩm");
    $("em",".product-all").addClass("product-all-on");
    $(".product-sett").removeClass("product-sett-a");
  } else {
    $(".product-all-qx").text("chọn tất cả");
    $(".product-sett").addClass("product-sett-a");
  }
}

function koncat() {
  var a = $(".product-box").length;
  if (a <= 0) {
    $(".all-price").text("0");
    $(".product-all-qx").text("chọn tất cả");
    $(".all-sl").css("display", "none");
    $(".product-sett").addClass("product-sett-a");
    $(".product-all em").removeClass("product-all-on");
    $(".product-js").css("display", "none");
    $(".product").css("display", "none");
    $(".kon-cat").css("display", "block")
  } else {
    $(".kon-cat").css("display", "none")
    $(".product-js").css("display", "block");
    $(".product").css("display", "block");
  }
};

function deleteAll() {
  $(".product-box").remove();
  shuliang();
  koncat();
  TotalPrice();
};

var city = $("#city");
var district = $("#district");
var ward = $("#ward");
var citis = document.getElementById("city");
var districts = document.getElementById("district");
var wards = document.getElementById("ward");

$.ajax({
  url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
  method: "GET",
  responseType: "application/json", 
  success: function(result) {
    city.html('<option value="">Chọn Tỉnh/Thành phố</option>');
    district.html('<option value="">Chọn Quận/huyện</option>');
    ward.html('<option value="">Chọn Phường/thị xã</option>');
    renderCity(result);
  }
});


$("#cart-to-order-form").validate({
  rules: {
    order_cus_name: {
      required: true,
    },
    order_cus_phone: {
      required: true,
    },
    order_cus_city: {
      required: true,
    },
    order_cus_district: {
      required: true,
    },
    order_cus_ward: {
      required: true,
    },
    order_cus_address: {
      required: true,
    },
    order_confirm: {
      required: true,
    },
  },
  messages: {
    order_cus_name: {
      required: "Vui lòng nhập họ tên.",
    },
    order_cus_phone: {
      required: "Vui lòng nhập chính xác số điện thoại.",
    },
    order_cus_city: {
      required: "Vui lòng cung cấp chính xác địa chỉ.",
    },
    order_cus_district: {
      required: "Vui lòng cung cấp chính xác địa chỉ.",
    },
    order_cus_ward: {
      required: "Vui lòng cung cấp chính xác địa chỉ.",
    },
    order_cus_address: {
      required: "Vui lòng nhập chính xác địa chỉ.",
    },
    order_confirm: {
      required: "Trường này là bắt buộc.",
    },
  },
});

function renderCity(data) {
  $.each(JSON.parse(data), function(index, value) {
    city.append($('<option/>', { 
        value: value.Name,
        text : value.Name
    }));
  });

  citis.onchange = function () {
    district.html('<option value="">Chọn Quận/huyện</option>');
    ward.html('<option value="">Chọn Phường/thị xã</option>');
    if(this.value != ""){
      var n;
      var result = JSON.parse(data).filter(n => n.Name === this.value);
      $.each(result[0].Districts, function(index, value) {
        district.append($('<option/>', { 
            value: value.Name,
            text : value.Name
        }));
      });
    }
  };

  districts.onchange = function () {
    ward.html('<option value="">Chọn Phường/thị xã</option>');
    var e;
    var n;
    var result = JSON.parse(data).filter(n => n.Name === citis.value);
    if(this.value != ""){
      var rs = result[0].Districts.filter(n => n.Name === this.value)[0].Wards;
      $.each(rs, function(key, val) {
        ward.append($('<option/>', { 
            value: val.Name,
            text : val.Name
        }));
      });
    }
  };
}

$('#submitButton').click( function() {

  if ($("form#cart-to-order-form").valid()) {
    var p = [];
    $('.product-box').each(function(i, obj) {
      if ($(obj).find('em').hasClass('product-xz')) {
        p.push({'id':$(obj).find('.cart_change').attr("data-product-id"),'qty': $(obj).find('.product-num').val()});
      }
    });
    var o = {};
    var t = $('form#cart-to-order-form').serializeArray();
    $.each(t, function( i, obj ) {
      var v1, v2;
      $.each(obj, function( k, v ) {
        if (k == 'name') {
          v1 = v;
        }else if (k == 'value') {
          v2 = v;
        } else {
        }
      });
      o[v1] = v2;
    });

    $.ajax({
      url: 'gio-hang',
      type: 'post',
      data: {
        customer: o,
        items: p,
        all_price: $('input[name=all_price]').val(),
        sale_price: $('input[name=sale_price]').val(),
        vat_price: $('input[name=vat_price]').val(),
        total_price: $('input[name=total_price]').val(),
      },
      success: function(data) {
        alert(data.message);
        location.reload();
      },
      error: function(data) {
        alert(data.responseJSON.message);
        return false;
      }
    });
  }

});
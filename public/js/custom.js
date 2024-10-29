jQuery(document).ready(function($) {

  $(window).scroll(function() {
    if($(this).scrollTop() > 150) {
      $('.header').addClass('fixmenu');
      $('.mobile-menu').addClass('fixmenu');
    } else{
      $('.header').removeClass('fixmenu');
      $('.mobile-menu').removeClass('fixmenu');
    }
  })

  // browser window scroll (in pixels) after which the "back to top" link is shown
  var offset = 300,
  //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
  offset_opacity = 1200,
  //duration of the top scrolling animation (in ms)
  scroll_top_duration = 700,
  //grab the "back to top" link
  $back_to_top = $('.cd-top');

  //hide or show the "back to top" link
  $(window).scroll(function() {
    ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
    if( $(this).scrollTop() > offset_opacity ) { 
      $back_to_top.addClass('cd-fade-out');
    }
  });

  //smooth scroll to top
  $back_to_top.on('click', function(event) {
    event.preventDefault();
    $('body,html').animate({
      scrollTop: 0 ,
    }, scroll_top_duration);
  });

  $('#customer_login_link').click(function() {
    $('#registerform').hide();
    $('#normal-login').hide();
    $('#fast-login').show();
    $('#loginform').show();
  });

  $('#customer_register_link').click(function() {
    $('#loginform').hide();
    $('#registerform').show();
  });
  
  $('.modal').on('click', '*[data-dismiss="modal"]', function() {
    $('.modal').hide();
  });

  $('.list-cate-banner .btn-cate').on('click', function() {
    var $this = $(this);
    var ulP = $(this).parent('li').children('ul');
    if(ulP.is(":visible")) {
      ulP.slideUp();
      $this.removeClass('fa-minus');
    }else{
      $('.list-cate-banner ul').hide();
      $('.btn-cate').removeClass('fa-minus');
      ulP.slideDown();
      $this.addClass('fa-minus');
    }
  });

  function addCommas(nStr)
  {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }

  $(".forgot-password").click(function() {
    $( ".customer-login" ).fadeOut( "1000", function() {
      $(".title").fadeOut(function() {
        $(this).text("Lấy mật khẩu")
      }).fadeIn();
      $(".recover-password").show();
    });
  });

  $(".recover-cancel").click(function() {
    $( ".recover-password" ).fadeOut( "1000", function() {
      $(".title").fadeOut(function() {
        $(this).text("Đăng nhập")
      }).fadeIn();
      $(".customer-login").show();
    });
  });

  $('.cart').on('click', '.cart_change', function() {
    $.get( $(this).data('href'), function( data ) {
      var total_bill = parseInt(data.total_bill);
      var total_all_bill = total_bill + (total_bill/10);
      $( "#cart-info .cart_info" ).html( data.response );
      $( "#cart_submit .cart_info" ).html( data.submit );
      $( "#cart_submit tbody" ).append( '<tr><td colspan="5">Tổng cộng</td><td>' + total_bill + '</td></tr><tr><td colspan="5">VAT</td><td>' + (total_bill / 10) + '</td></tr><tr><td colspan="5">Thành tiên</td><td>' + total_all_bill + '</td></tr>' );
      if (data.total > 0) {
         $( "#cart_submit .submit-control" ).html('<a class="cart_delete btn btn-danger" data-href={{url("gio-hang?destroy=1")}}>Xóa toàn bộ</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-success submit-btn">Đặt hàng</a>');
      } else {
         $( "#cart_submit .submit-control" ).empty();
      }
      $( "#cart-total" ).text( data.total );
    });
  });

  $('.cart_delete').click(function() {
    if(confirm('Bạn chắc chắn muốn thực hiện hành động?')){
      $.get( $(this).data('href'), function( data ) {
        var total_bill = parseInt(data.total_bill);
        var total_all_bill = total_bill + (total_bill/10);
        $( "#cart-info .cart_info" ).html( data.response );
        $( "#cart_submit .cart_info" ).html( data.submit );
        $( "#cart_submit tbody" ).append( '<tr><td colspan="5">Tổng cộng</td><td>' + total_bill + '</td></tr><tr><td colspan="5">VAT</td><td>' + (total_bill / 10) + '</td></tr><tr><td colspan="5">Thành tiên</td><td>' + total_all_bill + '</td></tr>' );
        $( "#cart_submit tbody" ).append( '<tr><td colspan="5">Tổng cộng</td><td>'+parseInt("data.total_bill")+'</td></tr><tr><td colspan="5">VAT</td><td>'+(parseInt("data.total_bill")/10)+'</td></tr><tr><td colspan="5">Thành tiên</td><td>'+(parseInt("data.total_bill") + (parseInt("data.total_bill")/10))+'</td></tr>' );
        $( "#cart_submit .submit-control" ).empty();
        $( "#cart-total" ).text( data.total );
        deleteAll();
      });
    }
    return false;
  });

  $(".openpassword").hover( function () {
    $(".openpassword").find('span').removeClass();
    $(".openpassword").find('span').addClass('glyphicon glyphicon-eye-open');
    $('[data-id="password"]').attr('type', 'text');
  }, function() {
    $(".openpassword").find('span').removeClass();
    $(".openpassword").find('span').addClass('glyphicon glyphicon-eye-close');
    $('[data-id="password"]').attr('type', 'password');
  });

  $("#login-email").on('click', function() {
    back_to_login();
    $("#fast-login").hide();
    $("#normal-login").show();
  });

  $("#register-email").on('click', function() {
    $('.modal').fadeOut( "fast", function() {
      $("#fast-register").hide( function() {
        $("#normal-register").show();
        $('#registerform').fadeIn();
      });
    });
  });

  $(".chevron-back").on('click', function() {
    if ($("#loginform").is(":visible")) {
      $("#normal-login").fadeOut( function() {
        $("#fast-login").show();
        $('#loginform').fadeIn();
      });
      back_to_login();
    } else {
      $('.modal').fadeOut( function() {
        $("#normal-register").hide( function() {
          $("#fast-register").show();
          $('#registerform').fadeIn();
        });
      });
    }
  });

  function back_to_login() {
    $('.modal').fadeOut( function() {
      $('[data-type="login"]').hide(function() {
        $('#recovery').hide();
        $('[data-type="forgot-password"]').show();
        var element1 = recovery.elements;
        for (var i = 0, len = element1.length; i < len; ++i) {
            element1[i].readOnly = true;
        }
        var element2 = login.elements;
        for (var i = 0, len = element2.length; i < len; ++i) {
            element2[i].readOnly = false;
        }
        $("#myModalLabel").text("Đăng nhập");
        $('#login').show();
      });
    });
    $('#loginform').fadeIn();
  }

  $('#loginform').on('click', '[data-type="forgot-password"]', function() {
    $('.modal').fadeOut( function() {
      $( '[data-type="forgot-password"]' ).hide(function() {
        $('#login').hide();
        $('[data-type="login"]').show();
        var element1 = login.elements;
        for (var i = 0, len = element1.length; i < len; ++i) {
            element1[i].readOnly = true;
        }
        var element2 = recovery.elements;
        for (var i = 0, len = element2.length; i < len; ++i) {
            element2[i].readOnly = false;
        }
        $("#myModalLabel").text("Lấy mật khẩu");
        $('#recovery').show();
      });
    });
    $('#loginform').fadeIn();
  });

  $('#loginform').on('click', '[data-type="login"]', function() {
    back_to_login();
  });

  function CheckUserSession() {
    var userInSession = false;
    $.ajax({
      url: 'tai-khoan/getinfo',
      type: 'POST',
      dataType: 'json',
      contentType: 'application/json; charset=utf-8',
      async: false,
      success: function (result) {
        if(result.user.length != 0){
          userInSession = true;
        }
      }
    });
    return userInSession;
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#login').validate({
    rules: {
      email: {
        required: true,
        minlength: 2
      },
      password: {
        required: true,
      },
    },
    submitHandler: function (form, e) {
      e.stopPropagation();
      e.preventDefault();
      let _token   = $('meta[name="csrf-token"]').attr('content');
      let email   = $(form).find('input[name="email"]').val();
      let password   = $(form).find('input[name="password"]').val();
      $.ajax({
        url: 'tai-khoan/dang-nhap',
        type: 'POST',
        data:{
          type:'fast',
          email:email,
          password:password,
          _token: _token,
        },
        success: function (result) {
          if (result.status == true) {
            location.reload();
          } else {
            alert(result.message);
          }
        },
        error: function(error) {
          alert('Không thể thực hiện được yêu cầu lúc này, vui lòng thử lại sau!');
        }
      });
    }
  });

  $('#recovery').validate({
    rules: {
      email: {
        required: true,
        minlength: 2
      },
    },
    submitHandler: function (form, e) {
      e.stopPropagation();
      e.preventDefault();
      let _token   = $('meta[name="csrf-token"]').attr('content');
      let email   = $(form).find('input[name="email"]').val();

      $.ajax({
        url: 'tai-khoan/phuc-hoi',
        type: 'POST',
        data:{
          type:'fast',
          re_email:email,
          _token: _token,
        },
        success: function (result) {
          if (result.status == true) {
            console.log(result);
            $('#recovery .modal-body').html('<div class="form-group"><label>'+result.message+'</label></div>')
          } else {
            alert(result.message);
          }
        },
        error: function(error) {
          alert('Không thể thực hiện được yêu cầu lúc này, vui lòng thử lại sau!');
        }
      });
    }
  });

  $('#register').validate({
    rules: {
      name: {
        required: true,
        minlength: 1,
      },
      email: {
        required: true,
        minlength: 3,
      },
    },
    submitHandler: function (form, e) {
      e.stopPropagation();
      e.preventDefault();
      let _token   = $('meta[name="csrf-token"]').attr('content');
      let email   = $(form).find('input[name="email"]').val();
      let name   = $(form).find('input[name="name"]').val();
      let gender   = $(form).find('select[name="gender"]').val();

      $.ajax({
        url: 'tai-khoan/dang-ky',
        type: 'POST',
        data:{
          type:'fast',
          email:email,
          name:name,
          gender:gender,
          _token: _token,
        },
        success: function (result) {
          console.log(result);
          if (result.status == true) {
            $('#register .modal-body').html('<div class="form-group"><label>'+result.message+'</label></div>');
            $('#register .modal-footer').find('input[type="submit"]').remove();
          } else {
            alert(result.message);
          }
        },
        error: function(error) {
          var messenger = JSON.parse( decodeURIComponent( error.responseText ) );
          alert(JSON.stringify(messenger));
        }
      });
    }
  });

  $(document).on("click",".maintenance",function(){
   alert("Chức năng đang được bảo trì");
  });
});
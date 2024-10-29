<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="robots" content="noodp,index,follow">
    <meta name="keywords" content="">
    <meta name="format-detection" content="telephone=no">
    <base href="<?php echo e(asset('')); ?>">
    <title>Công ty Cổ phần Phân phối nhôm Hà Nội</title>
    <meta name="description" content="NHÔM HỆ VIỆT PHÁP, NHÔM HỆ XINGFA, Hệ cửa đi, Hệ cửa số, Hệ cửa trượt, Hệ vách dựng XINGFA, PHỤ KIỆN CỬA, Phụ kiện cửa nhôm Việt Pháp, Phụ kiện cửa nhôm XingFa">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Công ty Cổ phần Phân phối nhôm Hà Nội">
    <meta property="og:image" content="public/img/logo.png">
    <meta property="og:image:secure_url" content="public/img/logo.png">
    <meta property="og:description" content="NHÔM HỆ VIỆT PHÁP, NHÔM HỆ XINGFA, Hệ cửa đi, Hệ cửa số, Hệ cửa trượt, Hệ vách dựng XINGFA, PHỤ KIỆN CỬA, Phụ kiện cửa nhôm Việt Pháp, Phụ kiện cửa nhôm XingFa">
    <meta property="og:url" content="/">
    <meta property="og:site_name" content="Công ty Cổ phần Phân phối nhôm Hà Nội">
    <link rel="canonical" href="/">
    <!-- Favicon -->
    <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="public/bootstrap/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="public/css/style.css" rel="stylesheet" type="text/css">
    <link href="public/jGrowl-master/jquery.jgrowl.css" rel="stylesheet" type="text/css">
    <link href="public/css/filecss.css" rel="stylesheet" type="text/css">
    <script src="public/jquery/jquery.min.js" type="text/javascript"></script>

    <!-- Include Cloud Zoom CSS. -->
    <link rel="stylesheet" type="text/css" href="public/cloud-zoom/cloud-zoom.css" />
    <!-- Include Cloud Zoom script. -->
    <script type="text/javascript" src="public/cloud-zoom/cloud-zoom.1.0.3.js"></script>
    <script src="public/jGrowl-master/jquery.jgrowl.js" type="text/javascript"></script>
    <script src="public/bootstrap/js/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/sliderproduct.js" type="text/javascript"></script>
    <link href="public/fontawesome/css/all.css" rel="stylesheet" type="text/css">
    <link href="public/jquery/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <script src="public/jquery/jquery.fancybox.js" type="text/javascript"></script>
    <link href="public/css/custom.css" rel="stylesheet" type="text/css">
    <script src="public/js/js.cookie.min.js"></script>
    <script src="public/js/jquery.validate.min.js"></script>
  </head>

  <body>
    <div class="loader"></div>
    <div class="page-container">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-xs-8 col-sm-8 hidden-xs">
              <div class="hotline_top">
                <img src="public/img/icondienthoai.png">
                <b style="color:#fff;">Tư vấn 24/7:</b> <a href="tel:<?php echo e($configs->hotline); ?>"><?php echo e($configs->hotline); ?> </a>
              </div>
              <p class="diachi_header"><span>Địa chỉ:</span> <?php echo e($configs->address); ?></p>
            </div>
            <div class="col-xs-12 col-sm-4 text-right">
              <!-- <a href="javascript:;" data-customer-id="0">Danh sách mong muốn</a> -->
              <div class="dropdown boxtaikhoan">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if(Auth::user()): ?>
                <i class="fa fa-user" aria-hidden="true"></i> Xin chào <?php echo e(Auth::user()->name); ?> <i class="far fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="tai-khoan/quan-ly">Quản lý tài khoản</a></li>
                  <li><a href="tai-khoan/dang-xuat">Đăng xuất</a></li>
                </ul>
                <?php else: ?>
                <i class="fa fa-user" aria-hidden="true"></i> Tài khoản <i class="far fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a id="customer_login_link">Đăng nhập</a></li>
                  <li><a id="customer_register_link">Đăng ký</a></li>
                </ul>
                <?php endif; ?>

              </div>

              <div class="mini-cart dropdown box-cart cart hidden-xs">
                <a href="gio-hang" class="dropdown-toggle basket" data-toggle="dropdown" data-hover="dropdown">
                  <img src="public/img/icon_minicart.png"> Giỏ hàng
                  <span id="cart-total"><?php echo e(count(@$cart)); ?></span>
                </a>
                <div class="top-cart-content arrow_box cart-info dropdown-menu" id="cart-info">
                  <div class="table-responsive cart_info" style="overflow-x: hidden; height: 350px;">

                  <?php if(count($cart)): ?>
                  <table class="table table-condensed cart_info">
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
                      <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td class="cart_product">
                          <a href="<?php echo e($item->options->slug); ?>"><img src="<?php echo e($item->options->image); ?>" alt=""></a>
                        </td>
                        <td class="cart_description">
                          <p><a href="<?php echo e($item->options->slug); ?>"><?php echo e($item->name); ?></a></p>
                        </td>
                        <td class="cart_price">
                          <p data-product-price="<?php echo e($item->id); ?>"><?php echo e(number_format($item->price)); ?> đ</p>
                        </td>
                        <td class="cart_quantity">
                          <div class="cart_quantity_button">
                            <a class="product-jian" data-href='<?php echo e(url("gio-hang?product_id=$item->id&decrease=1")); ?>'> - </a>
                            <span class="product-num" data-product='<?php echo e($item->id); ?>'/><?php echo e($item->qty); ?></span>
                            <a class="product-add" data-href='<?php echo e(url("gio-hang?product_id=$item->id&increment=1")); ?>'> + </a>
                          </div>
                        </td>
                        <td class="cart_total">
                          <p class="cart_total_price" data-product-total='<?php echo e($item->id); ?>'><?php echo e(number_format($item->subtotal)); ?> đ</p>
                        </td>
                        <td>
                          <a class="cart_change" data-href='<?php echo e(url("gio-hang?product_id=$item->id&remove=1")); ?>' data-product-id="<?php echo e($item->id); ?>"><i class="fa fa-times"></i></a>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                  <?php else: ?>
                  <br>
                    <center>Giỏ hàng của bạn hiện đang trống.</center>
                  <br>
                  <?php endif; ?>


                  </div>
                  <div class="panel-control" style="text-align: right;padding: 10px;">
                    <a class="cart_delete btn btn-danger" data-href='<?php echo e(url("gio-hang?destroy=1")); ?>'>Xóa toàn bộ</a>
                    <a class="btn btn-success" href="gio-hang">Vào thanh toán</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar menumain visible-xs mobile-menu">
        <h2 class="tencongty">Công ty Cổ phần Phân phối nhôm Hà Nội</h2>
        <div class="logo">
          <a title="Công ty Cổ phần Phân phối nhôm Hà Nội" href="/" class="navbar-brand">
            <img alt="Công ty Cổ phần Phân phối nhôm Hà Nội" src="public/img/logo.png">
          </a>
        </div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="mini-cart dropdown box-cart cart" style="float: right;margin-top: 10px;margin-right: 15px;">
            <a onclick="window.location.href='gio-hang'" href="gio-hang" class="dropdown-toggle basket" data-toggle="dropdown" data-hover="dropdown">
              <img src="public/img/icon_minicart.png">
              <span id="cart-total"><?php echo e(count(@$cart)); ?></span>
            </a>
            <div class="top-cart-content arrow_box cart-info dropdown-menu" id="cart-info">
            </div>
          </div>
        </div>
        <div class="navbar-collapse collapse navbar-left">
          <ul class="nav navbar-nav list-collections list-cate-banner">
            <li class="menu_lv1 item-sub-cat"><a href="/">Trang chủ</a></li>
            <li class="menu_lv1 item-sub-cat"><a href="gioi-thieu">Giới thiệu</a></li>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="menu_lv1 item-sub-cat"><a href="<?php echo e($category->slug); ?>"><?php echo e($category->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li class="menu_lv1 item-sub-cat"><a href="lien-he">Liên hệ</a></li>
          </ul>
        </div>
        <form action="tim-kiem" method="get" class="navbar-form navbar-search navbar-right hidden-md hidden-lg hidden-sm">
          <input name="ten" placeholder="Nhập thông tin cần tìm kiếm" class="search-query" maxlength="128" type="text" value="<?php echo e(@$params['ten']); ?>">
          <button type="submit" class="btn icon-search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
      </nav>
      <div class="header hidden-xs">
        <div class=" container">
          <nav class="navbar menumain">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Menu</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a title="CÔNG TY CỔ PHẦNCông ty Cổ phần Phân phối nhôm Hà Nội" href="/" class="navbar-brand">
              <img alt="CÔNG TY CỔ PHẦNCông ty Cổ phần Phân phối nhôm Hà Nội" src="public/img/logo.png">
              </a>
            </div>
            <div class="navbar-collapse collapse navbar-left">
              <ul class="nav navbar-nav">
                <li><a href="/">Trang chủ</a></li>
                <li><a href="gioi-thieu">Giới thiệu</a></li>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li <?php if(count($category->child) > 0): ?> <?php echo e('class=dropdown'); ?><?php endif; ?>>
                  <a href="<?php echo e($category->slug); ?>"><?php echo e($category->title); ?> <?php if(count($category->child) > 0): ?> <i class="fa fa-caret-down pull-right" aria-hidden="true"></i><?php endif; ?></a>
                  <ul class="dropdown-menu sub1">
                    <div class="col-xs-12 col-sm-8">
                      <div class="row">
                      <?php if(count($category->child) > 0): ?>
                        <?php $__currentLoopData = $category->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="col-xs-12 col-sm-6">
                          <a href="<?php echo e($child->slug); ?>"><?php echo e($child->title); ?>

                            <?php if(count($category->child) > 0): ?>
                            <ul class="sub2">
                              <?php $__currentLoopData = $child->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li>
                                <a href="<?php echo e($grandchild->slug); ?>"><?php echo e($grandchild->title); ?>

                              </li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php endif; ?>
                          </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 hidden-xs">
                      <div class="box-bestseller">
                        <div class="title_bestseller">
                          Sản phẩm nổi bật
                        </div>
                        <div class="body_bestseller">
                        <?php if(count($hot) > 0): ?>
                          <?php $__currentLoopData = $hot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hot_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="bestseller_one">
                            <a href="<?php echo e($hot_product->slug); ?>" title="<?php echo e($hot_product->title); ?>" class="bestseller_one_img">
                              <img src="<?php echo e($hot_product->featured_image); ?>" alt="<?php echo e($hot_product->title); ?>">
                            </a>
                            <h3 class="bestseller_one_name">
                              <a href="san-pham" title="<?php echo e($hot_product->title); ?>"><?php echo e($hot_product->title); ?></a>
                            </h3>
                            <div data-id="<?php echo e($hot_product->id); ?>"></div>
                            <p class="bestseller_one_price">
                              <span class="price-new">0₫</span> 
                            </p>
                            <div class="clearfix"></div>
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </ul>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li><a href="lien-he">Liên hệ</a></li>
              </ul>
            </div>
            <form action="tim-kiem" method="get" class="navbar-form navbar-search navbar-right hidden-xs">
              <input name="ten" placeholder="Nhập thông tin cần tìm kiếm tại đây" class="search-query" maxlength="128" type="text" value="<?php echo e(@$params['ten']); ?>">
              <button type="submit" class="btn icon-search"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
          </nav>
        </div>
      </div>

      <?php echo $__env->yieldContent('content'); ?>

      <section class="box_blog"></section>
      <div id="ggmap">
        <div class="container">
          <div class="so-maps">
            <div class="module google-map">
              <div class="modcontent clearfix">
                <div class="contact">
                  <div style="width: 100%; height: 450px;"><?php echo $configs->google_map; ?></div>
                  <div class="contact-info">
                    <div class="shop-name">
                      <div class="icon"> </div>
                      <h2>CÔNG TY CỔ PHẦN</h2>
                      <span>PHÂN PHỐI NHÔM HÀ NỘI</span>    
                    </div>
                    <div class="address"> 
                      <strong>Công ty Cổ phần Phân phối nhôm Hà Nội</strong><br>
                      <strong>Website:</strong> <?php echo e(URL::to('/')); ?><br>
                      <?php if($configs->factory != ''): ?> <strong>Nhà máy :</strong> <?php echo $configs->factory; ?><br><?php endif; ?>
                      <?php if($configs->hotline != ''): ?> <strong>Điện thoại:</strong> <?php echo e($configs->hotline); ?><br><?php endif; ?>
                      <?php if($configs->email != ''): ?> <strong>Email:</strong>  <?php echo e($configs->email); ?><br><?php endif; ?>
                      <?php if($configs->address != ''): ?> <strong>Địa chỉ :</strong> <?php echo e($configs->address); ?><br><?php endif; ?>
                      <?php if($configs->showroom != ''): ?> <strong>Showroom:</strong> <?php echo $configs->address; ?><br><?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="community">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-4 social-box">
              <span>MẠNG XÃ HỘI</span>
              <ul class="social-block">
              <?php if($configs->facebook != ''): ?> 
                <li class="facebook"><a class="_blank" href="https://facebook.com/<?php echo e($configs->facebook); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              <?php endif; ?>
              <?php if($configs->twitter != ''): ?> 
                <li class="twitter"><a class="_blank" href="https://twitter.com/<?php echo e($configs->twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
              <?php endif; ?>
              <?php if($configs->rss != ''): ?> 
                <li class="rss"><a class="_blank" href="rss" target="_blank"><i class="fas fa-rss"></i></a></li>
              <?php endif; ?>
              <?php if($configs->google_plus != ''): ?> 
                <li class="google_plus"><a class="_blank" href="#" target="_blank"><i class="fab fa-google-plus"></i></a></li>
              <?php endif; ?>
              <?php if($configs->pinterest != ''): ?> 
                <li class="pinterest"><a class="_blank" href="https://www.pinterest.com/<?php echo e($configs->pinterest); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
              <?php endif; ?>
              <?php if($configs->zalo != ''): ?> 
                <li class="zalo"><a class="_blank" href="https://zalo.me/<?php echo e($configs->zalo); ?>" target="_blank"><div class="fa-zalo">Zalo</div></a></li>
              <?php endif; ?>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-8">
              <ul class="list-ft pull-right">
                <li class="col-xs-6"><a href="/">Trang chủ</a></li>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="col-xs-6"><a href="<?php echo e($category->slug); ?>"><?php echo e($category->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul> 
            </div>
          </div>
        </div>
      </div>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
              <h3 class="title-f">Hỗ trợ</h3>
              <ul class="list-f">
                <li><a href="/">Trang chủ</a></li>
                <li><a href="san-pham">Sản phẩm</a></li>
                <li><a href="tin-tuc">Tin tức</a></li>
                <li><a href="lien-he">Liên hệ</a></li>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <h3 class="title-f">Hướng dẫn</h3>
              <ul class="list-f">
                <li><a href="huong-dan">Hướng dẫn mua hàng</a></li>
                <li><a href="tai-khoan/dang-ky">Đăng kí thành viên</a></li>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <h3 class="title-f">Chính sách</h3>
              <ul class="list-f">
                <li><a href="chinh-sach">Chính sách sử dụng</a></li>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <h3 class="title-f">Điều khoản</h3>
              <ul class="list-f">
                <li><a href="dieu-khoan-dich-vu">Điều khoản sử dụng</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="copy text-center">  Copyright © 2020 NHOMHANOI Co., Ltd.</div>
      </div>
    </div>

    <div id="loginform" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content animate">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
          </div>

          <div class="modal-body" id="fast-login">
            <div class="container-fluid">
                <div class="regist_right col-md-6">
                  <a id="login-email">
                    <div class="social-login-btn btn-hnc">
                      <div class="social-login-txt">Đăng nhập bằng email</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-sms maintenance">
                      <div class="social-login-icon"><i class="glyphicon glyphicon-phone"></i></div>
                      <div class="social-login-txt">Đăng nhập bằng SMS</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-google maintenance">
                      <div class="social-login-icon"><i class="fab fa-google"></i></div>
                      <div class="social-login-txt">Đăng nhập bằng Google</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-facebook maintenance">
                      <div class="social-login-icon"><i class="fab fa-facebook-f"></i></div>
                      <div class="social-login-txt">Đăng nhập bằng Faceook</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-zalo maintenance">
                      <div class="social-login-icon"><i class="fas fa-comment"></i></div>
                      <div class="social-login-txt">Đăng nhập bằng Zalo</div>
                    </div>
                  </a>
                </div>
                <div class="col-md-6">
                  <p>Đăng ký tài khoản để dễ dàng mua hàng, bình luận, đánh giá sản phẩm trên website</p>
                </div>
              </div>
          </div>

          <div class="modal-body" id="normal-login" style="display: none;">
            <a class="chevron-back"><i class="fa fa-chevron-left" aria-hidden="true"></i> Quay lại</a>

            <form id="login">
              <div class="modal-body">
                <div class="form-group">
                  <label>Email <span class="required">*</span>
                    <div class="input-group pb-modalreglog-input-group">
                      <input type="email" class="form-control" name="email" data-id="email" placeholder="Email" required autocomplete="on">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                  </label>
                </div>
                <div class="form-group">
                  <label>Mật khẩu <span class="required">*</span>
                    <div class="input-group pb-modalreglog-input-group">
                      <input type="password" class="form-control" name="password" data-id="password" placeholder="password" required>
                      <span class="input-group-addon openpassword"><span class="glyphicon glyphicon-eye-close"></span></span>
                    </div>
                  </label>
                </div>
              </div>

              <div class="modal-footer">
                <a data-type="forgot-password">Mất mật khẩu?</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Gửi</button>
              </div>
            </form>

            <form id="recovery" style="display: none;" method="post" action="tai-khoan/phuc-hoi">
              <div class="modal-body">
                <div class="form-group">
                  <span>Chúng tôi sẽ gửi email chứa đường dẫn đến trang đặt lại mật khẩu cho bạn. Vui lòng điền địa chỉ email bạn đã dùng để đăng ký tài khoản!</span>
                </div>
                <div class="form-group">
                  <label>Email <span class="required">*</span>
                    <div class="input-group pb-modalreglog-input-group">
                      <input type="email" class="form-control" name="email" data-id="email" placeholder="Email" required autocomplete="on">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                  </label>
                </div>
              </div>

              <div class="modal-footer">
                <a data-type="forgot-password">Mất mật khẩu?</a>
                <a data-type="login" style="display: none;">Đăng nhập bằng email</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Gửi</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <div id="registerform" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content animate">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Đăng ký</h4>
          </div>

          <div class="modal-body" id="fast-register">
            <div class="container-fluid">
                <div class="regist_right col-md-6">
                  <a id="register-email">
                    <div class="social-login-btn btn-hnc">
                      <div class="social-login-txt">Đăng ký bằng email</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-sms maintenance">
                      <div class="social-login-icon"><i class="glyphicon glyphicon-phone"></i></div>
                      <div class="social-login-txt">Đăng ký bằng SMS</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-google maintenance">
                      <div class="social-login-icon"><i class="fab fa-google"></i></div>
                      <div class="social-login-txt">Đăng ký bằng Google</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-facebook maintenance">
                      <div class="social-login-icon"><i class="fab fa-facebook-f"></i></div>
                      <div class="social-login-txt">Đăng ký bằng Faceook</div>
                    </div>
                  </a>
                  <a>
                    <div class="social-login-btn btn-zalo maintenance">
                      <div class="social-login-icon"><i class="fas fa-comment"></i></div>
                      <div class="social-login-txt">Đăng ký bằng Zalo</div>
                    </div>
                  </a>
                </div>
                <div class="col-md-6">
                  <p>Đăng ký tài khoản để dễ dàng mua hàng, bình luận, đánh giá sản phẩm trên website</p>
                </div>
              </div>
          </div>

          <div class="modal-body" id="normal-register" style="display: none;">
            <a class="chevron-back"><i class="fa fa-chevron-left" aria-hidden="true"></i> Quay lại</a>
            <form id="register" method="post" action="tai-khoan/dang-ky">
              <div class="modal-body">
                <div class="form-group">
                  <label>Họ Tên <span class="required">*</span>
                    <div class="input-group pb-modalreglog-input-group">
                      <input type="text" class="form-control" name="name" data-id="name" placeholder="Tên" required autocomplete="on">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                  </label>
                </div>
                <div class="form-group">
                  <labe>Email <span class="required">*</span>
                    <div class="input-group pb-modalreglog-input-group">
                      <input type="text" class="form-control" name="email" data-id="email" placeholder="email" required autocomplete="on">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                  </label>
                </div>
                <div class="form-group">
                  <label>Giới tính
                    <select class="form-control" name="gender" data-id="gender" placeholder="gender" title="">
                      <option value="male">Nam</option>
                      <option value="female">Nữ</option>
                    </select>
                  </label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input class="btn btn-primary" type="submit" value="Gửi" />
              </div>
              <div class="modal-footer">

              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <!-- <div id="regiterform" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content animate">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Đăng ký</h4>
          </div>
          <form id="register" method="post" action="tai-khoan/dang-ky">
            <div class="modal-body">
              <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <div class="input-group pb-modalreglog-input-group">
                  <input type="text" class="form-control" name="name" data-id="name" placeholder="Tên" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Mật khẩu <span class="required">*</span></label>
                <div class="input-group pb-modalreglog-input-group">
                  <input type="password" class="form-control" name="repassword" data-id="password" placeholder="password" required>
                  <span class="input-group-addon openpassword"><span class="glyphicon glyphicon-eye-close"></span></span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              <input class="btn btn-primary" type="submit" value="Gửi" />
            </div>
            <div class="modal-footer">

            </div>
          </form>
        </div>
      </div>
    </div> -->

    <a class="cd-top">Top</a>
    <script src="public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/jquery/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="public/js/custom.js" type="text/javascript"></script>
    <a href="tel:<?php echo e($configs->hotline); ?>" class="hotline-fixed-mobile"><i class="fa fa-phone ringing"></i> <?php echo e($configs->hotline); ?></a>
    <script src="public/js/cart.js"></script>
    <script type="text/javascript">
      function addcart(slug) {
        $.post( "gio-hang/"+slug, function( data ) {
          $( ".cart_info" ).html( data.response );
          $( "#cart-total" ).text( data.total );
          if (data.status === true) {
            alert('Thêm sản phẩm vào giỏ hàng thành công');
          } else {
            alert('Không thể thêm sản phẩm vào giỏ hàng, vui lòng thử lại sau');
          }
        });
      }
    </script>
  </body>
</html><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/master/default.blade.php ENDPATH**/ ?>
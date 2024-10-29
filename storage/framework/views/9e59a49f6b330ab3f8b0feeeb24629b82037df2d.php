
<?php $__env->startSection('content'); ?>
<link href="public/css/cart.css" rel="stylesheet" type="text/css">

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
  <div class="row content-page cart">
    <div class="col-md-12">
        <div class="product col-md-5 col-lg-5">
          <div class="product-al">
            <div class="product-all">
              <em class=""></em>
            </div>
            <div class="all-xz">
              <span class="product-all-qx">Chọn tất cả</span>
              <div class="all-sl" style="display: none;"></div>
            </div>
          </div>
          <a class="delete-all cart_delete" data-href='<?php echo e(url("gio-hang?destroy=1")); ?>'>Xóa toàn bộ</a>

          <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="product-box">
            <div class="product-ckb">
              <em class="product-em product-xz"></em>
            </div>
            <div class="product-sx">
              <a href="<?php echo e($item->options->slug); ?>">
                <img src="<?php echo e($item->options->image); ?>" class="product-img" />
                <span class="product-name"><?php echo e($item->name); ?></span>
              </a>
              <span class="product-price"><span class="price-cart"><?php echo e(number_format($item->price)); ?></span>đ</span>
              <div class="product-amount">
                <div class="product_gw">
                  <a class="product-jian" data-href='<?php echo e(url("gio-hang?product_id=$item->id&decrease=1")); ?>'> - </a>
                  <input type="text" value="<?php echo e($item->qty); ?>" class="product-num" data-product='<?php echo e($item->id); ?>' id="product-<?php echo e($item->id); ?>-num" />
                  <a class="product-add" data-href='<?php echo e(url("gio-hang?product_id=$item->id&increment=1")); ?>'> + </a>
                </div>
              </div>
              <div class="product-del">
                <a class="cart_change" data-href='<?php echo e(url("gio-hang?product_id=$item->id&remove=1")); ?>' data-product-id="<?php echo e($item->id); ?>"><img src="public/img/deleteico.png" /></a>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <div class="product-total col-md-12 col-xs-12">
            <div class="col-md-12 col-xs-12">
              <span class="">Tạm tính:</span>
              <input type="hidden" name="all_price" value="0">
              <span class="all-price">0đ</span>
            </div>
            <div class="col-md-12 col-xs-12">
              <span class="">Giảm giá:</span>
              <input type="hidden" name="sale_price" value="0">
              <span class="sale-price">0đ</span>
            </div>
            <div class="col-md-12 col-xs-12">
              <span class="">VAT (10%):</span>
              <input type="hidden" name="vat_price" value="0">
              <span class="vat-price">0đ</span>
            </div>
            <div class="col-md-12 col-xs-12">
              <span class="">Thành tiền:</span>
              <input type="hidden" name="total_price" value="0">
              <span class="total-price">0đ</span>
            </div>
          </div>
        </div>

        <form id="cart-to-order-form" class="form" method="POST">
          <div class="product-js col-md-6 col-lg-6">
            <h4 class="cart__head d-block text-uppercase"><i class="fas fa-map-marker-alt"></i>Thông tin nhận hàng</h4>
            <div class="cart__body">
              <div class="col">
                <div class="mb-2">
                  <label for="order_cus_name" class="col-12 col-form-label">Họ và tên <span class="text-danger">*</span></label>
                  <div class="col-12">
                    <input type="text" name="order_cus_name" id="order_cus_name" class="form-control" placeholder="Nhập họ và tên" value="<?php if(auth()->guard()->check()): ?><?php echo e(Auth::user()->name); ?><?php endif; ?>" required="">
                  </div>
                </div>

                <div class="mb-2">
                  <label for="order_cus_phone" class="col-12 col-form-label">Số điện thoại <span class="text-danger">*</span></label>
                  <div class="col-12">
                    <input type="text" name="order_cus_phone" id="order_cus_phone" class="form-control" placeholder="Nhập số điện thoại" value="<?php if(auth()->guard()->check()): ?><?php echo e(Auth::user()->phone); ?><?php endif; ?>" pattern="^(0[3-9][0-9]{8})$" required="">
                  </div>
                </div>

                <div class="mb-2 row">
                  <div class="col-12 col-md-4">
                    <label for="city" class="col-form-label">Tỉnh/thành phố <span class="text-danger">*</span></label>
                    <select name="order_cus_city" id="city" class="form-select form-select-sm" required="">
                    </select>
                  </div>

                  <div class="col-12 col-md-4">
                    <label for="district" class="col-form-label"> Quận/huyện <span class="text-danger">*</span> </label>
                    <select name="order_cus_district" id="district" class="form-select form-select-sm" required=""></select>
                  </div>

                  <div class="col-12 col-md-4">
                    <label for="ward" class="col-form-label"> Phường/Thị xã <span class="text-danger">*</span> </label>
                    <select name="order_cus_ward" id="ward" class="form-select form-select-sm" required=""></select>
                  </div>
                </div>
                
                <div class="mb-2">
                  <label for="order_cus_address" class="col-12 col-form-label">Địa chỉ chi tiết <span class="text-danger">*</span></label>
                  <div class="col-12">
                    <textarea name="order_cus_address" id="order_cus_address" class="form-control" placeholder="Nhập địa chỉ đầy đủ: số nhà, tên đường" required=""><?php if(auth()->guard()->check()): ?><?php echo e(Auth::user()->address); ?><?php endif; ?></textarea>
                  </div>
                </div>

                <div class="mb-2 payment-method">
                  <label class="col-12 col-form-label" for="payment_method">Phương thức thanh toán</label>
                  <div class="col-12">
                    <input type="radio" checked="" value="COD" required="" class="form-check-input" name="payment_method" id="payment_method">
                    <label class="col-12 col-form-label" for="payment_method">Giao hàng và thu tiền tại nhà (COD)</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="cart__footer flex-column flex-md-row">
              <div class="font-14">
                <input type="checkbox" checked="" required="" name="order_confirm" id="order_confirm" style="margin-right: 5px;">
                <label for="order_confirm">Tôi đồng ý với <a href="<?php echo e(url('dieu-khoan-dich-vu')); ?>" target="__blank" class="text-primary fw-bold" title="Chính sách và điều khoản">&nbsp;chính sách và điểu khoản</a>&nbsp;của <?php echo e($_SERVER['SERVER_NAME']); ?> </label>
              </div>
              <button type="button" id="submitButton" class="btn btn-success" style="margin: 10px 0;">Gửi đơn hàng</button>
            </div>
          </div>
        </form>

        <div class="kon-cat">
          <div class="catkon">
            <div class="kon-box">
              <div class="kon-hz">
                <img src="public/img/cart-air.png" />
                <span class="kon-wz">Xe đẩy không có gì</span>
                <a href="#" class="kon-lj">đi mua sắm</a>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
</div>
<div style="background: #fff;height: 20px;"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nhomdaiviet/resources/views/site/content/cart.blade.php ENDPATH**/ ?>
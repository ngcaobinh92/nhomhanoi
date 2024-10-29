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
        <div class="product col-md-6">
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
              <span class="product-price"><span class="price-cart">
                <?php echo e(number_format($item->price)); ?>

              </span>đ
              </span>
              <div class="product-amount">
                <div class="product_gw">
                  <a class="product-jian" data-href='<?php echo e(url("gio-hang?product_id=$item->id&decrease=1")); ?>'> - </a>
                  <input type="text" value="<?php echo e($item->qty); ?>" class="product-num" data-product='<?php echo e($item->id); ?>'/>
                  <a class="product-add" data-href='<?php echo e(url("gio-hang?product_id=$item->id&increment=1")); ?>'> + </a>
                </div>
              </div>
              <div class="product-del">
                <a class="cart_change" data-href='<?php echo e(url("gio-hang?product_id=$item->id&remove=1")); ?>' data-product-id="<?php echo e($item->id); ?>"><img src="public/img/deleteico.png" /></a>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="product-js col-md-5">
          <div class="col-md-12">
            <span class="">Tạm tính:</span>
            <span class="all-price">0đ</span>
          </div>
          <div class="col-md-12">
            <span class="">Giảm giá:</span>
            <span class="sale-price">0đ</span>
          </div>
          <div class="col-md-12">
            <span class="">VAT (10%):</span>
            <span class="vat-price">0đ</span>
          </div>
          <div class="col-md-12">
            <span class="">Thành tiền:</span>
            <span class="total-price">0đ</span>
          </div>
          <div class="col-md-12">
            <a onclick="alert('Giỏ hàng đang tạm bảo trì, xin vui lòng thủ lại sau')" class="btn btn-primary" style="width: 100%">Tiến hành đặt hàng</a>
          </div>
        </div>

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
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/cart.blade.php ENDPATH**/ ?>
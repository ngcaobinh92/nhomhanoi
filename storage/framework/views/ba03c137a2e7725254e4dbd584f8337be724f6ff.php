<?php $__env->startSection('content'); ?>
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a> 
          <span class="divider"></span>
        </li>
        <li class="active">Tìm kiếm</li>
      </ul>
    </div>
  </div>
</section>
<section style="background:#fff">
  <div class="container">
    <div class="row">

      <?php echo $__env->make('site.master.side-product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="cat_header">
              <h2 class="page_title">Tìm kiếm</h2>
            </div>
          </div>
        </div>
        <p>Kết quả tìm kiếm với từ khóa "<?php echo e($params['ten']); ?>":</p>
        <form action="tim-kiem" method="get" class="btformsearch">
          <input type="text" class="input-control" name="ten" value="<?php echo e($params['ten']); ?>" placeholder="Tìm kiếm ...">
          <button type="submit" class="button searchbt">Tìm kiếm</button>
        </form>
        
        <div class="row product-thumb">
          <?php if(isset($products) && count($products) > 0): ?>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xs-6 col-sm-4 col-md-3 productcollections">
              <div class="item">
                <div class="item-inner transition">
                  <div class="image">
                    <a class="lt-image" href="<?php echo e($product->slug); ?>" target="_self" title="<?php echo e($product->title); ?>">
                      <img src="<?php if($product->featured_image != ''): ?><?php echo e($product->featured_image); ?><?php else: ?><?php echo e('public/img/logo.png'); ?><?php endif; ?>" class="<?php if($product->thump_image != ''): ?><?php echo e('img-1'); ?><?php endif; ?>" alt="<?php echo e($product->title); ?>">
                      <?php if($product->thump_image != ''): ?>
                        <img src="<?php echo e($product->thump_image); ?>" class="img-2" alt="<?php echo e($product->title); ?>">
                      <?php endif; ?>
                    </a>
                  </div>
                  <div class="caption">
                    <h4><a href="<?php echo e($product->slug); ?>" title="<?php echo e($product->title); ?>" target="_self"><?php echo e($product->title); ?></a></h4>
                    <p class="price">
                      <?php if($product->sale > 0): ?>
                        <a href="<?php echo e($product->slug); ?>"><span class="price-old"><?php echo e($product->origin_price); ?>đ</span></a> <small>(Tiết kiệm <?php echo e($product->sale); ?>%)</small></br>
                        <a href="<?php echo e($product->slug); ?>"><span class="price-new"><?php echo e(number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))); ?>đ</span></a></br>
                      <?php else: ?>
                        </br>
                        <a href="<?php echo e($product->slug); ?>"><span class="price-new"><?php echo e(number_format($product->origin_price)); ?>đ</span></a></br>
                      <?php endif; ?>

                      <div class="p-action">
                        <?php if($product->quantity > 0): ?>
                          <span class="p-qty">
                            <i class="fa fa-check" aria-hidden="true"></i> Sẵn hàng 
                          </span>
                          <a href="javascript:;" onclick="addcart('<?php echo e($product->slug); ?>')" class="p-buy"></a>
                        <?php else: ?>
                          <a href="lien-he">
                            <span class="p-empty">Liên hệ</span>
                          </a>
                        <?php endif; ?>
                      </div>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-12 productcollections">Không có sản phẩm nào để hiển thị</div>
          <?php endif; ?>
        </div>

        <?php if($products->total() > $products->perPage()): ?>
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-12 col-sm-offset-6 col-sm-6 text-right"><?php echo e($products->links('site.master.pagination')); ?></div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/search.blade.php ENDPATH**/ ?>
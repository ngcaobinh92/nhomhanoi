<?php $__env->startSection('content'); ?>
<style type="text/css">
  .title-collection-menu-l {
    display: none;
  }
  .left-menu {
    border: none;
  }
</style>

<div class="so-slideshow">
  <div class="module sohomepage-slider">
    <div class="modcontent">
      <div id="sohomepage-slider1">
        <?php if(count($data['header_slide']) > 0): ?>
        <!-- Start Slide Header -->
        <div class="so-homeslider sohomeslider-inner-1">
          <?php $__currentLoopData = $data['header_slide']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $header_slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="item">
            <a title="Slider <?php echo e($key + 1); ?>" target="_blank">
              <img class="responsive" src="<?php echo e($header_slide->image); ?>" alt="Slider <?php echo e($key + 1); ?>">
            </a>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!-- End Slide Header -->
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>

<section class="so-spotlight1">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="module moduleship"></div>
      </div>
    </div>
  </div>
</section>

<!--Banner-->
<section class="box-collection1">
  <div class="container">
    <div class=" modcontent">
      <div class="header-title">
        <h3 class="modtitle"><span>Danh mục </span>&nbsp;<span>Sản phẩm</span></h3>
      </div>
      <div class="row">
      <?php echo $__env->make('site.master.side-product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Start Slider Hot -->
        <div class="col-md-9 col-sm-8 col-md-9 hidden-xs">
          <?php if(count($data['hots']) > 0): ?>
          <div class="product-slider-1 product-thumb">
            <?php
            $count = 0;
            ?>
            <?php $__currentLoopData = $data['hots']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              ++$count;
              ?>
              <?php if($count == 1): ?>
                <div>
              <?php endif; ?>
              <div class="item">
                <div class="item-inner transition">
                  <div class="image">
                    <a class="lt-image" href="<?php echo e($hotproduct->slug); ?>" target="_self" title="<?php echo e($hotproduct->title); ?>">
                      <img src="<?php echo e($hotproduct->featured_image); ?>" class="img-1" alt="<?php echo e($hotproduct->title); ?>">
                      <img src="<?php echo e($hotproduct->thump_image); ?>" class="img-2" alt="<?php echo e($hotproduct->title); ?>">
                    </a>
                  </div>
                  <div class="caption">
                    <h4><a href="<?php echo e($hotproduct->slug); ?>" title="<?php echo e($hotproduct->title); ?>" target="_self"><?php echo e($hotproduct->title); ?></a></h4>
                    <p class="price">
                      <a href="<?php echo e($hotproduct->slug); ?>"><span class="price-new">Liên hệ</span></a>
                    </p>
                  </div>
                </div>
              </div>
              <?php if($count == 2): ?>
                </div>
                <?php
                $count = 0;
                ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          <?php else: ?>
            <img src="public/img/slide1.jpg" style="width: 100%;">
          <?php endif; ?>
        </div>
        <!-- End Slider Hot -->
      </div>
    </div>
  </div>
</section>

<!-- Start Slider -->
<?php if(count($data['products']) > 0): ?>
  <?php
  $last = key(end($data['products']));
  ?>
  <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($products->product) > 0): ?>
      <?php if($key == $last): ?>
      <section class="box-collection">
        <div class="container">
          <div class="modcontent">
            <div class="header-title">
              <h3 class="modtitle"><span><?php echo e($products->title); ?></span></h3>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12 hidden-xs">
                <img src="public/img/banne2.jpg">
              </div>
              <div class="col-md-9 col-sm-8 col-xs-12">
                <!-- Start Slider last -->
                <div class="product-slider-3 product-thumb">
                  <?php $__currentLoopData = $products->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="item">
                    <div class="item-inner transition">
                      <div class="image">
                        <a class="lt-image" href="<?php echo e($product->slug); ?>" target="_self" title="<?php echo e($product->title); ?>">
                        <img src="<?php echo e($product->featured_image); ?>" class="img-1" alt="<?php echo e($product->title); ?>">
                        <img src="<?php echo e($product->thump_image); ?>" class="img-2" alt="<?php echo e($product->title); ?>">
                        </a>
                      </div>
                      <div class="caption">
                        <h4>
                          <a href="<?php echo e($product->slug); ?>" title="<?php echo e($product->title); ?>" target="_self"><?php echo e($product->title); ?></a>
                        </h4>
                        <p class="price">
                          <a href="lien-he"><span class="price-new">Liên hệ</span></a>
                        </p>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- End Slider last -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php else: ?>
      <section class="box-collection">
        <div class="container">
          <div class="modcontent">
            <div class="header-title">
              <h3 class="modtitle"><span><?php echo e($products->title); ?></span></h3>
            </div>
            <div class="product-slider-2 product-thumb">
              <?php $__currentLoopData = $products->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <div class="item-inner transition">
                  <div class="image">
                    <a class="lt-image" href="<?php echo e($product->slug); ?>" target="_self" title="<?php echo e($product->title); ?>">
                    <img src="<?php echo e($product->featured_image); ?>" class="img-1" alt="<?php echo e($product->title); ?>">
                    <img src="<?php echo e($product->thump_image); ?>" class="img-2" alt="<?php echo e($product->title); ?>">
                    </a>
                  </div>
                  <div class="caption">
                    <h4><a href="<?php echo e($product->slug); ?>" title="<?php echo e($product->title); ?>" target="_self"><?php echo e($product->title); ?></a></h4>
                    <p class="price">
                      <a href="lien-he"><span class="price-new">Liên hệ</span></a>
                    </p>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </section>
      <?php endif; ?>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<!-- End Slider -->

<section class="box_blog">
<?php if(count($data['news']) > 0): ?>
  <div class="container">
    <div class="modcontent">
      <div class="header-title">
        <h3 class="modtitle"><span>Tin</span>&nbsp;<span>Mới</span></h3>
      </div>
      <!-- Start Slider News -->
      <div class="product-slider-5 product-thumb">
        <?php $__currentLoopData = $data['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item item-blog">
          <div class="blog_item_inner transition">
            <a class="lt-image" href="<?php echo e($news->slug); ?>" target="_self" title="<?php echo e($news->title); ?>">
              <img src="<?php echo e($news->featured_image); ?>" alt="<?php echo e($news->title); ?>">
            </a>
            <div class="thongtin">
              <h4 class="blog_item_title"><a href="<?php echo e($news->slug); ?>" title="<?php echo e($news->title); ?>" target="_self"><?php echo e($news->title); ?></a></h4>
              <div class="blog_item_motangan"><?php echo e(substr($news->title, 0, 125)); ?>...</div>
              <a href="<?php echo e($news->slug); ?>" class="blog_itemt_link">Xem thêm</a>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <!-- End Slider News -->
      <div class="clearfix"></div>
    </div>
  </div>
<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp_7.2.34\htdocs\nhomdaiviet.com.test\resources\views/site/content/home.blade.php ENDPATH**/ ?>
<div class="col-xs-12 col-sm-4 col-md-3">
  <div class=" left-menu">
    <div class="box-colection">
      <div class="title-collection-menu-l">SẢN PHẨM</div>
      <ul class="list-collections list-cate-banner list-index">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($category_list->slug == 'san-pham' && count($category_list->child) > 0): ?>
            <?php $__currentLoopData = $category_list->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="menu_lv1 item-sub-cat">
              <a href="<?php echo e($category->slug); ?>">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo e($category->title); ?>

              </a>
              <?php if(count($category->child) > 0): ?>
              <i class="fa fa-plus btn-cate" aria-hidden="true"></i>
              <ul style="display:none">
                <?php $__currentLoopData = $category->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e($child->slug); ?>"><?php echo e($child->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  </div>
  <div class="module moduleship">
    <div class="modcontent clearfix">
      <div class="row re-ship-phone">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon1"></span>
            <p class="des"><span>Tư vấn 24/7</span> Miễn phí</p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon2"></span>
            <p class="des">Vận chuyển <span>theo yêu cầu</span></p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon3"></span>
            <p class="des">Nhận hàng <span>Nhận tiền</span></p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon4"></span>
            <p class="des">Gọi ngay <span><a href="tel:<?php echo e($configs->hotline); ?>"><?php echo e($configs->hotline); ?></a></span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/master/side-product.blade.php ENDPATH**/ ?>
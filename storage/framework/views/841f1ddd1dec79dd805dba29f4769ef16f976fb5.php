<div class="col-post">
  <div class="header-title">
    <h3 class="modtitle"><span>Danh mục</span>&nbsp;<span>tin tức</span></h3>
  </div>
  <ul class="post-menu">
    <li class="cat-item"><a href="tin-tuc">Tin tức (<?php echo e($news['total']); ?>)</a></li>
  </ul>
</div>

<div class="col-post">
  <h3>Bài viết mới</h3>
  <ul class="post-menu">
    <?php if($news['total'] > 0): ?>
      <?php $__currentLoopData = $news['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="<?php echo e($new->slug); ?>" title="<?php echo e($new->title); ?>"><?php echo e($new->title); ?></a></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
      <li>Không có bài viết nào để hiển thị</li>
    <?php endif; ?>
  </ul>
</div>
<div class="col-post">
  <h3></h3>
  <div class="banner">
    <a href="tin-tuc"><img alt="Công ty Cổ phần Phân phối nhôm Hà Nội" src="public/img/blog-img.jpg"></a>
  </div>
</div><?php /**PATH /var/www/html/nhomdaiviet/resources/views/site/master/side-new.blade.php ENDPATH**/ ?>
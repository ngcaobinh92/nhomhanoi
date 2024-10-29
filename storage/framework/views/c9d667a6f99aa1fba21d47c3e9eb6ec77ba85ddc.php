
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('site.master.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page_collection">
  <div class="container">
    <div class="row content-blog-list">
      <div class="col-xs-12 col-sm-4 col-md-3">
        <?php echo $__env->make('site.master.side-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
      <div class="col-xs-12 col-sm-8 col-md-9">

        <?php if(isset($data['news']) && $data['news']->total() > 0): ?>
          <?php $__currentLoopData = $data['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="box-article-item">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-4">
                <a href="<?php echo e($new->slug); ?>"><img src="<?php echo e($new->featured_image); ?>" alt="<?php echo e($new->title); ?>"></a>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-8">
                <h3 class="title-article-inner"><a href="<?php echo e($new->slug); ?>"><?php echo e($new->title); ?></a></h3>
                <div class="post-detail">
                  <?php echo e(\Carbon\Carbon::parse($new->created_at)->format('d/m/Y H:i:s')); ?> -<?php echo e($new->comments); ?> bình luận
                </div>
                <div class="text-blog">
                  <p><?php echo e($new->description); ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <div>Không có bài viết nào để hiển thị</div>
        <?php endif; ?>
        <?php if($data['news']->total() > $data['news']->perPage()): ?>
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-12 col-sm-offset-6 col-sm-6 text-right"><?php echo e($data['news']->links('site.master.pagination')); ?></div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nhomdaiviet/resources/views/site/content/new/category.blade.php ENDPATH**/ ?>
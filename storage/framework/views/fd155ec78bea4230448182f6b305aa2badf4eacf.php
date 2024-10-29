<?php $__env->startSection('content'); ?>
<?php echo $__env->make('site.master.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="cat_header">
        <h2 class="page_title"><?php echo e($data['page']->title); ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row content-page">
      <div class="box padding">
      	<?php echo $data['page']->content; ?>

      </div>
    </div>
  </div>
</div>
<div style="background: #fff;height: 20px;"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/page.blade.php ENDPATH**/ ?>
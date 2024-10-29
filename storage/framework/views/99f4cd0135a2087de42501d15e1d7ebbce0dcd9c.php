<?php $__env->startSection('extra-script'); ?>
<script src="public/octopus/assets/javascripts/dashboard/examples.dashboard.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('thongbao')): ?>
<span class="error"><b><?php echo e(session('thongbao')); ?></b></span>
<?php endif; ?>

<header class="page-header">
  <h2>Dashboard</h2>

  <div class="right-wrapper pull-right">
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- end: page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/home.blade.php ENDPATH**/ ?>
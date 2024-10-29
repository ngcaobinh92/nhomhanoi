<?php if($paginator->hasPages()): ?>
<div class="pagination">
  
  <?php if($paginator->onFirstPage()): ?>
    <span class="page disabled">«</span>
  <?php else: ?>
    <span class="page"><a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo;</a></span>
  <?php endif; ?>

  
  <?php if($paginator->currentPage() > 2): ?>
      <span class="page hidden-xs"><a href="<?php echo e($paginator->url(1)); ?>">1</a></span>
  <?php endif; ?>
  <?php if($paginator->currentPage() > 3): ?>
      <span class="hidden-xs">...</span>
  <?php endif; ?>
  <?php $__currentLoopData = range(1, $paginator->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1): ?>
          <?php if($i == $paginator->currentPage()): ?>
              <span class="page current"><?php echo e($i); ?></span>
          <?php else: ?>
              <span class="page"><a href="<?php echo e($paginator->url($i)); ?>"><?php echo e($i); ?></a></span>
          <?php endif; ?>
      <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php if($paginator->currentPage() < $paginator->lastPage() - 2): ?>
      <span class="hidden-xs">...</span>
  <?php endif; ?>
  <?php if($paginator->currentPage() < $paginator->lastPage() - 1): ?>
      <span class="page hidden-xs"><a href="<?php echo e($paginator->url($paginator->lastPage())); ?>"><?php echo e($paginator->lastPage()); ?></a></span>
  <?php endif; ?>

  
  <?php if($paginator->hasMorePages()): ?>
    <span class="page"><a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&raquo;</a></span>
  <?php else: ?>
    <span class="page disabled">»</span>
  <?php endif; ?>
</div>
<?php endif; ?>



        
<?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/master/pagination.blade.php ENDPATH**/ ?>
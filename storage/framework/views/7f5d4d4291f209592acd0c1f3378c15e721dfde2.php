<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
          <span class="divider"></span>
        </li>
        <?php if(count($data['breadcrumb']) > 0): ?>
          <?php
            $last_key = count($data['breadcrumb']) - 1;
          ?>
          <?php $__currentLoopData = $data['breadcrumb']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key == $last_key): ?>
              <li><?php echo e($value['title']); ?></li>
            <?php else: ?>
              <li>
                <a href="<?php echo e($value['slug']); ?>"><?php echo e($value['title']); ?></a>
                <span class="divider"></span>
              </li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</section><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/master/breadcrumbs.blade.php ENDPATH**/ ?>
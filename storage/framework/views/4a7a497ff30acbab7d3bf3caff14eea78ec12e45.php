<?php $__env->startSection('content'); ?>
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ </a>
          <span class="divider"></span>
        </li>
        <li class="active">Kích hoạt tài khoản</li>
      </ul>
    </div>
  </div>
</section>

<div class="contaier" style="background:#fff">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
      <h2 class="title">Cập nhật mật khẩu</h2>
      <?php if(session('thongbao')): ?>
      <div class="alert alert-info">
        <p class="m-none text-semibold h6"><?php echo e(session('thongbao')); ?></p>
      </div>
      <?php endif; ?>
      <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-3 customer-login">
      <form accept-charset="utf-8" action="" method="post">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" name="_key" value="<?php echo e($key); ?>">
        <div class="loginbox form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-4" for="password">Mật khẩu <span class="required">*</span></label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password" id="password" minlength="6" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4" for="password_confirmation">Nhập lại Mật khẩu <span class="required">*</span></label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" minlength="6" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit">Đổi mật khẩu</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/changepass.blade.php ENDPATH**/ ?>
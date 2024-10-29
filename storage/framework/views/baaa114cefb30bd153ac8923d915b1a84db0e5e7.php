
<?php $__env->startSection('content'); ?>
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ </a>
          <span class="divider"></span>
        </li>
        <li class="active">Đăng nhập tài khoản</li>
      </ul>
    </div>
  </div>
</section>

<div class="contaier" style="background:#fff">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
      <h2 class="title">Đăng nhập</h2>
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
      <div class="alert alert-success reset-success">Vui lòng kiểm tra email để lấy lại mật khẩu .</div>
      <form accept-charset="utf-8" action="" id="customer_login" method="post">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="loginbox form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-4" for="email">Email <span class="required">*</span></label>
            <div class="col-md-8">
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4" for="password">Mật khẩu <span class="required">*</span></label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit">Đăng nhập</button>
              <a class="forgot-password">Mất mật khẩu?</a>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-6 col-md-offset-3 recover-password">
      <form action="tai-khoan/phuc-hoi" id="recover_customer_password" method="post">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="loginbox form-horizontal">
          <div style="margin-bottom: 10px"> Chúng tôi sẽ gửi email chứa đường dẫn đến trang đặt lại mật khẩu cho bạn. Vui lòng điền địa chỉ email bạn đã dùng để đăng ký tài khoản! </div>
          <div class="form-group">
            <label class="control-label col-md-4" for="re_email">Email <span class="required">*</span>
            </label>
            <div class="col-md-8">
              <input name="re_email" type="text" class="form-control" id="re_email" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit">Gửi yêu cầu</button>
              <a class="recover-cancel">Hủy</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nhomdaiviet/resources/views/site/content/login.blade.php ENDPATH**/ ?>
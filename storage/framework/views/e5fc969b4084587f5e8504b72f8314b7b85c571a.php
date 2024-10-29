<?php $__env->startSection('content'); ?>
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
        	<a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
          <span class="divider"></span>
        </li>
        <li class="active">Đăng ký tài khoản</li>
      </ul>
    </div>
  </div>
</section>

<div class="contaier" style="background:#fff">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
      <h2 class="page_title">Đăng ký tài khoản</h2>
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
  <div class="container">
    <div class="row">
      <div class="col-lg-6 loginbox">
        <div class="new-header">
          <h1>Đăng ký</h1>
          <div class="new-info">
            <p>Đăng ký tài khoản để dễ dàng mua hàng, bình luận, đánh giá sản phẩm trên website</p>
            <p>Bạn cũng có thể</p>
          </div>
        </div>
        <div class="regist_right">
          <a href="<?php echo e(url('tai-khoan/dang-nhap')); ?>">
            <div class="social-login-btn btn-hnc">
              <div class="social-login-txt">Đăng nhập bằng email</div>
            </div>
          </a>
          <a>
            <div class="social-login-btn btn-sms maintenance">
              <div class="social-login-icon"><i class="glyphicon glyphicon-phone"></i></div>
              <div class="social-login-txt">Đăng ký bằng SMS</div>
            </div>
          </a>
          <a>
            <div class="social-login-btn btn-google maintenance">
              <div class="social-login-icon"><i class="fab fa-google"></i></div>
              <div class="social-login-txt">Đăng ký bằng Google</div>
            </div>
          </a>
          <a>
            <div class="social-login-btn btn-facebook maintenance">
              <div class="social-login-icon"><i class="fab fa-facebook-f"></i></div>
              <div class="social-login-txt">Đăng ký bằng Faceook</div>
            </div>
          </a>
          <a>
            <div class="social-login-btn btn-zalo maintenance">
              <div class="social-login-icon"><i class="fas fa-comment"></i></div>
              <div class="social-login-txt">Đăng ký bằng Zalo</div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-lg-6 customer-register">
        <form accept-charset="utf-8" action="" id="customer_register" method="post">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <div class="loginbox form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-4" for="name">Họ Tên<span class="required">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="name" id="name" required value="<?php echo e(old('name')); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4" for="email">Email <span class="required">*</span></label>
              <div class="col-md-8">
                <input type="email" class="form-control" name="email" id="email" required value="<?php echo e(old('email')); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4" for="gender">Giới tính</label>
              <div class="col-md-8">
                <select class="form-control" name="gender">
                  <option value="male">Nam</option>
                  <option value="female">Nữ</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <button class="btn btn_button col-md-12" type="submit">Đăng ký</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/register.blade.php ENDPATH**/ ?>
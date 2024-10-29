<?php $__env->startSection('content'); ?>
<link href="public/css/user.css" rel="stylesheet" type="text/css">
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a> 
          <span class="divider"></span>
        </li>
        <li class="active">Quản lý tài khoản</li>
      </ul>
    </div>
  </div>
</section>
<section style="background:#fff">
  <div class="container">
    <div class="row">

      <?php echo $__env->make('site.master.side-product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="cat_header">
              <h2 class="page_title">Quản lý tài khoản</h2>
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
        </div>
        <div class="col-md-12 customer-register">
          <form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="user_form">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="loginbox form-horizontal">

              <div class="form-group" style="text-align: center">
                <div id="profile-container">
                  <div class="avatar-wrapper">
                    <img class="profile-pic" src="<?php echo e($user->avatar); ?>" id="profileImage" />
                    <div class="upload-button">
                      <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input id="file-upload" type="file" accept="image/*" name="avatar" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-4" for="name">Họ Tên<span class="required">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="name" id="name" required value="<?php echo e($user->name); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="email">Email</label>
                <div class="col-md-8">
                  <input type="email" class="form-control" disabled value="<?php echo e($user->email); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4">Chức vụ</label>
                <div class="col-md-8">
                  <select class="form-control" disabled>
                    <option value="<?php echo e($user->role); ?>"><?php echo e($user->role); ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4">Ngày đăng ký</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" disabled value="<?php echo e(Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:m:s')); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="gender">Giới tính</label>
                <div class="col-md-8">
                  <select class="form-control" name="gender">
                    <?php
                      switch ($user->gender) {
                        case 'male':
                          $gender = 'Nam';
                          break;
                        case 'female':
                          $gender = 'Nữ';
                          break;
                        case 'intersex':
                          $gender = 'Không xác định';
                          break;
                        default:
                          $gender = 'Không biết';
                          break;
                      }
                    ?>
                    <option value="<?php echo e($user->gender); ?>" hidden selected><?php echo e($gender); ?></option>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="password">Mật khẩu</label>
                <div class="col-md-8">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Bỏ qua nếu không muốn thay đổi mật khẩu!!!">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="re_password">Xác thực Mật khẩu</span></label>
                <div class="col-md-8">
                  <input type="password" class="form-control" name="re_password" id="re_password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-3 col-md-offset-3">
                  <button class="btn btn_primary col-md-12" type="reset">Reset</button>
                </div>
                <div class="col-md-3">
                  <button class="btn btn_button col-md-12" type="submit">Cập nhật</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="public/js/user.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/user.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

<?php if(session('thongbao')): ?>
<span class="error"><b><?php echo e(session('thongbao')); ?></b></span>
<?php endif; ?>

<header class="page-header">
  <h2><?php echo e(trans('cms.danh_sach')); ?></h2>
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <?php if(isset($module)): ?><li><span><a href="cms/<?php echo e($module); ?>"><?php echo e(trans('cms.quan_ly_nguoi_dung')); ?></a></span></li><?php endif; ?>
      <?php if(isset($path)): ?><li><span><?php echo e(trans('cms.danh_sach')); ?></span></li><?php endif; ?>
    </ol>

    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<div class="row">

  <div class="mailbox-email">
    <div class="mailbox-email-header mb-lg">
      <h3 class="mailbox-email-subject m-none text-light"><?php echo e($data[0]->title); ?> (<?php echo e($data->count()); ?>)</h3>
  
      <p class="mt-lg mb-none text-md"><?php echo e(trans('cms.tu')); ?> <a href="cms/user/edit/<?php echo e($user->id); ?>"><?php echo e($user->name); ?></a> <?php echo e(trans('cms.gui_toi_ban')); ?> <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data[0]->created_at)->format('D d M, Y. H:M A')); ?></p>
    </div>
    <div class="mailbox-email-container">
      <div class="mailbox-email-screen">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
              <!-- <a href="#" class="fa fa-mail-reply"></a> -->
              <!-- <a href="#" class="fa fa-mail-reply-all"></a> -->
              <!-- <a href="#" class="fa fa-star-o"></a> -->
            </div>
            <?php if($dt->user_id == 0): ?>
            <p class="panel-title"><?php echo e(trans('cms.you')); ?> <i class="fa fa-angle-right fa-fw"></i> <?php echo e($user->name); ?>

            <?php else: ?>
            <p class="panel-title"><?php echo e($user->name); ?> <i class="fa fa-angle-right fa-fw"></i> <?php echo e(trans('cms.you')); ?>

            <?php endif; ?>
          </div>
          <div class="panel-body"><?php echo $dt->content; ?></div>
          <div class="panel-footer">
            <p class="m-none"><small><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dt->created_at)->format('D d M, Y. H:M A')); ?></small></p>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <form class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="col-md-12 col-lg-12">
          <section class="panel">
            <div class="row">
              <div class="panel-body">
                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label"><?php echo e(trans('cms.tra_loi')); ?></label>
                    <input type="hidden" name="to_noid" value="<?php echo e($to_noid); ?>">
                    <textarea class="form-control mce_basic" name="content"><?php echo e(old('content')); ?></textarea>
                    <?php if($errors->has('content')): ?>
                    <span class="error_mess"><?php echo e($errors->first('content')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="compose">
              <div class="text-right mt-md">
                <button class="btn btn-primary">
                  <i class="fa fa-send mr-xs"></i><?php echo e(trans('cms.gui')); ?>

                </button>
              </div>
            </div>
          </section>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-script'); ?>

<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/messenger/detail.blade.php ENDPATH**/ ?>
<?php $__env->startSection('extra-script'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<header class="page-header">
  <h2>Chỉnh sửa</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="index.html">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quán lý bài viết</span></li>
      <li><span><?php echo e($page->title); ?></span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->
<?php if(session('thongbao')): ?>
<div><b><?php echo e(session('thongbao')); ?></b></div><br>
<?php endif; ?>

<div class="row">
  <form class="form-horizontal" method="post" id="form summary-form">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="col-md-7 col-lg-8">
      <section class="panel">
        <div class="row">
          <div class="panel-body">
            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Tiêu đề</label>
                <input type="text" class="form-control" name="title" value="<?php echo e($page->title); ?>" required>
                <?php if($errors->has('title')): ?>
                <span class="error_mess"><?php echo e($errors->first('title')); ?></span>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Đường dẫn tin tức</label>
                <input type="text" class="form-control" name="slug" value="<?php echo e($page->slug); ?>">
                <?php if($errors->has('slug')): ?>
                <span class="error_mess"><?php echo e($errors->first('slug')); ?></span>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Nội dung</label>
                <textarea class="form-control mce_full" name="content"><?php echo e($page->content); ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="col-md-5 col-lg-4">
      <section class="panel">
        <div class="row">
          <div class="panel-body">

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Trạng thái</label>
                <select id="status" name="status" class="form-control">
                  <option value="public" <?php if($page->status == 'public'): ?><?php echo e('selected'); ?><?php endif; ?>>Hiện</option>
                  <option value="preview" <?php if($page->status == 'preview'): ?><?php echo e('selected'); ?><?php endif; ?>>Ẩn</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12 form-type center">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary">OK</button>&emsp;
                <a href="cms/page/edit/<?php echo e($page->id); ?>" class="btn btn-default">Reset</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </form>
</div>
<!-- end: page -->

<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/page/edit.blade.php ENDPATH**/ ?>
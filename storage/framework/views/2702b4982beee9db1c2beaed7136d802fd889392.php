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
      <li><span>Quán lý tin tức</span></li>
      <li><span>Danh sách</span></li>
    </ol>

    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<div class="row">
  <section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="fa fa-caret-down"></a>
          <a href="#" class="fa fa-times"></a>
        </div>
      <h2 class="panel-title">Danh sách</h2>
        
      <form method="GET">
        <section>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Tiêu đề</label>
                  <input type="text" name="title" class="form-control" value="<?php if(isset($_GET['title'])): ?><?php echo e($_GET['title']); ?><?php endif; ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Ngày</label>
                  <select id="type_date" name="type_date" class="form-control">
                    <option value="created_at" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'created_at'): ?><?php echo e('selected'); ?><?php endif; ?> >Ngày tạo</option>
                    <option value="updated_at" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'updated_at'): ?><?php echo e('selected'); ?><?php endif; ?>>Ngày cập nhật</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Từ ngày</label>
                  <div class="input-daterange input-group" data-plugin-datepicker>
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control" name="start" value="<?php if(isset($_GET['start'])): ?><?php echo e($_GET['start']); ?><?php endif; ?>">
                    <span class="input-group-addon">Đến ngày</span>
                    <input type="text" class="form-control" name="end" value="<?php if(isset($_GET['end'])): ?><?php echo e($_GET['end']); ?><?php endif; ?>">
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label"><?php echo e(trans('cms.trang_thai')); ?></label>
                  <select id="status" name="status" class="form-control">
                    <option value="" <?php if(isset($_GET['status']) && $_GET['status'] == ''): ?><?php echo e('selected'); ?><?php endif; ?>>Tất cả</option>
                    <option value="preview" <?php if(isset($_GET['status']) && $_GET['status'] == 'preview'): ?><?php echo e('selected'); ?><?php endif; ?>>Ẩn</option>
                    <option value="public" <?php if(isset($_GET['status']) && $_GET['status'] == 'public'): ?><?php echo e('selected'); ?><?php endif; ?>>Hiện</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <br>
                  <button class="btn btn-primary">Tìm kiếm</button>
                </div>
              </div>
            </div>
        </section>
      </form>
    </header>

    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th class="center">ID</th>
              <th class="center">Tiêu đề</th>
              <th class="center">Trạng thái</th>
              <th class="center">Ngày tạo</th>
              <th class="center">Chỉnh sửa</th>
              <th class="center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="center"><?php echo e($page->id); ?></td>
              <td><a href="cms/page/edit/<?php echo e($page->id); ?>" title="<?php echo e($page->title); ?>"><?php echo e($page->title); ?></a></td>
              <?php
                switch ($page->status) {
                  case 'public':
                    $status = 'Hiện';
                    break;
                  
                  default:
                    $status = 'Ẩn';
                    break;
                }
              ?>
              <td class="center"><?php echo e($status); ?></td>
              <td class="center"><?php echo e($page->created_at); ?></td>
              <td class="center"><?php echo e($page->updated_at); ?></td>
              <td class="center actions-hover actions-fade">
                <a href="cms/page/edit/<?php echo e($page->id); ?>" title="Sửa"><i class="fa fa-pencil"></i></a>&emsp;
                <a href="cms/page/delete/<?php echo e($page->id); ?>" title="Xóa}" class="btn-delete" data-id="<?php echo e($page->id); ?>"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-script'); ?>
<script type="text/javascript">
  var datatableInit = function() {
    $('#datatable-default').dataTable();
  };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/page/list.blade.php ENDPATH**/ ?>
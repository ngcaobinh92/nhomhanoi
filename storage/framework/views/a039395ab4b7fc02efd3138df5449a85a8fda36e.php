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
      <li><span>Quán lý sản phẩm</span></li>
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
                  <label class="control-label">Lọc</label>
                  <select id="type_date" name="type_date" class="form-control">
                    <option value="created_at" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'created_at'): ?><?php echo e('selected'); ?><?php endif; ?> >Ngày tạo</option>
                    <option value="updated_at" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'updated_at'): ?><?php echo e('selected'); ?><?php endif; ?>>Ngày cập nhật</option>
                    <option value="origin_price" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'): ?><?php echo e('selected'); ?><?php endif; ?>>Khoảng giá gốc</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group" id="range">
                  <label class="control-label">Trong khoảng</label>
                  <div class="input-daterange input-group date_range <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'): ?><?php echo e('hidden'); ?><?php endif; ?>" data-plugin-datepicker>
                    <span class="input-group-addon">Từ</span>
                    <input type="text" class="form-control" name="start" value="<?php if(isset($_GET['start'])): ?><?php echo e($_GET['start']); ?><?php endif; ?>" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'): ?><?php echo e('disabled'); ?><?php endif; ?>>
                    <span class="input-group-addon">Đến</span>
                    <input type="text" class="form-control" name="end" value="<?php if(isset($_GET['end'])): ?><?php echo e($_GET['end']); ?><?php endif; ?>" <?php if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'): ?><?php echo e('disabled'); ?><?php endif; ?>>
                  </div>
                  <div class="input-daterange input-group amount_range <?php if(@$_GET['type_date'] == 'origin_price'): ?><?php else: ?><?php echo e('hidden'); ?><?php endif; ?>">
                    <span class="input-group-addon">Từ</span>
                    <input type="number" class="form-control" name="start" value="<?php if(isset($_GET['start'])): ?><?php echo e($_GET['start']); ?><?php endif; ?>" <?php if(@$_GET['type_date'] == 'origin_price'): ?><?php else: ?><?php echo e('disabled'); ?><?php endif; ?>>
                    <span class="input-group-addon">Đến</span>
                    <input type="number" class="form-control" name="end" value="<?php if(isset($_GET['end'])): ?><?php echo e($_GET['end']); ?><?php endif; ?>" <?php if(@$_GET['type_date'] == 'origin_price'): ?><?php else: ?><?php echo e('disabled'); ?><?php endif; ?>>
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
                  <label class="control-label"><?php echo e(trans('cms.tinh_trang')); ?></label>
                  <select id="quantity" name="quantity" class="form-control">
                    <option value="" <?php if(isset($_GET['quantity']) && $_GET['quantity'] == ''): ?><?php echo e('selected'); ?><?php endif; ?>>Tất cả</option>
                    <option value="public" <?php if(isset($_GET['quantity']) && $_GET['quantity'] == 'public'): ?><?php echo e('selected'); ?><?php endif; ?>>Còn hàng</option>
                    <option value="preview" <?php if(isset($_GET['quantity']) && $_GET['quantity'] == 'preview'): ?><?php echo e('selected'); ?><?php endif; ?>>Hết hàng</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label"><?php echo e(trans('cms.danh_muc')); ?></label>
                  <select id="category" name="category" class="form-control">
                    <option value="" <?php if(isset($_GET['category']) && $_GET['category'] == ''): ?><?php echo e('selected'); ?><?php endif; ?>>Tất cả</option>
                    <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($cp->parent == 0): ?>
                        <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($cp2->parent == $cp->id): ?>
                          <option value="<?php echo e($cp2->id); ?>" <?php if(isset($_GET['category']) && $_GET['category'] == '<?php echo e($cp2->id); ?>'): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($cp2->title); ?></option>
                            <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($cp3->parent == $cp2->id): ?>
                              <option value="<?php echo e($cp3->id); ?>" <?php if(isset($_GET['category']) && $_GET['category'] == '<?php echo e($cp3->id); ?>'): ?><?php echo e('selected'); ?><?php endif; ?>>-- &nbsp;&nbsp;<?php echo e($cp3->title); ?></option>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
              <th class="center">Ảnh sản phẩm</th>
              <th class="center">Tiêu đề</th>
              <th class="center">Danh mục</th>
              <th class="center">Giá cả (VNĐ)</th>
              <th class="center">Tình trạng</th>
              <th class="center">Trạng thái</th>
              <th class="center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="center"><?php echo e($product->id); ?></td>
              <td>
                <a href="cms/san-pham/edit/<?php echo e($product->id); ?>" title="<?php echo e($product->description); ?>">
                  <img src="<?php echo e($product->featured_image); ?>" alt="" style="width: 100px;">
                </a>
              </td>
              <td>
                <?php echo e($product->title); ?>

              </td>
              <td>
                <?php if($product->category != ''): ?>
                  <?php echo e($product->category->title); ?>

                <?php else: ?>
                  <?php echo e('Sản phẩm không nằm trong danh mục nào'); ?>

                <?php endif; ?>
              </td>
              <td class="center">
                <?php if($product->sale > 0): ?>
                  <span style="text-decoration-line:line-through;"><?php echo e(number_format($product->origin_price)); ?>đ</span> - <b style="color: red"><?php echo e(number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))); ?>đ</b> (<?php echo e($product->sale); ?>%)
                <?php else: ?>
                  <?php if($product->origin_price == null): ?>
                    <?php echo e('miễn phí'); ?>

                  <?php else: ?>
                    <?php echo e(number_format($product->origin_price)); ?>đ
                  <?php endif; ?>
                <?php endif; ?>
              </td>
              <td class="center">
                <?php if($product->quantity == null || $product->quantity == 0): ?>
                  <?php echo e('0 sản phẩm (hết hàng)'); ?>

                <?php else: ?>
                  <?php echo e($product->quantity.' sản phẩm (còn lại)'); ?>

                <?php endif; ?>
              </td>
              <?php
                switch ($product->status) {
                  case 'public':
                    $status = 'Công khai';
                    break;
                  
                  default:
                    $status = 'Ẩn';
                    break;
                }
              ?>
              <td class="center">
                Đã <?php echo e($status); ?> lúc  <?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$product->updated_at)->format('H:i:s d/m/Y')); ?>

              </td>
              <td class="center actions-hover actions-fade">
                <a href="cms/san-pham/edit/<?php echo e($product->id); ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                <a href="cms/san-pham/delete/<?php echo e($product->id); ?>" title="Xóa" class="btn-delete" data-id="<?php echo e($product->id); ?>"><i class="fa fa-trash-o"></i></a>
                <a href="<?php echo e($product->slug); ?>" title="Link sản phẩm" target="_blank"><i class="fa fa-external-link"></i></a>
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

  $('#type_date').on('change', function() {
    if (this.value == 'origin_price') {
      $(".date_range :input").attr("disabled", true);
      $(".date_range").addClass('hidden');
      $(".amount_range :input").attr("disabled", false).val('');
      $(".amount_range").removeClass('hidden');
    } else {
      $(".date_range :input").attr("disabled", false).val('');
      $(".date_range").removeClass('hidden');
      $(".amount_range :input").attr("disabled", true);
      $(".amount_range").addClass('hidden');
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/product/list.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
<header class="page-header">
  <h2>Danh mục</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Danh mục</span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->
<?php if(session('thongbao')): ?>
<div><b><?php echo e(session('thongbao')); ?></b></div><br>
<?php endif; ?>

<div class="row">
  <form class="frm-pr-add" method="post" action="">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="col-md-12">
      <?php if(session('message')): ?>
      <div class="alert alert-success"><?php echo e(session('message')); ?></div>
      <?php endif; ?>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Tên danh mục</label>
        <?php if($errors->has('title')): ?>
        <br>
        <span><?php echo e($errors->first('title')); ?></span>
        <?php endif; ?>
        <input class="form-control" name="title" type="text" value="<?php echo e(old('title')); ?>" required>
      </div>

      <div class="form-group">
        <label>Đường dẫn danh mục</label>
        <input class="form-control" name="slug" type="text" value="<?php echo e(old('slug')); ?>">
      </div>

      <div class="form-group">
        <label>Danh mục cha</label>
        <select name="parent" class="form-control">
          <option value="0">Không</option>
          <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($cp->parent == 0): ?>
            <option value="<?php echo e($cp->id); ?>"><?php echo e($cp->title); ?></option>
              <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($cp2->parent == $cp->id): ?>
                <option value="<?php echo e($cp2->id); ?>">-- &nbsp;&nbsp;<?php echo e($cp2->title); ?></option>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="form-group">
        <label>Mô tả</label>
        <textarea class="form-control" rows="3" name="description"><?php echo e(old('description')); ?></textarea>
      </div>

      <div class="form-group">
        <label>Vị trí</label>
        <input class="form-control" name="order" type="number" value="0" required>
      </div>

      <div class="form-group">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
          <option value="public">Hiển thị</option>
          <option value="preview">Ẩn</option>
        </select>
      </div>

      <div class="form-group">
        <label>Ảnh mô tả</label>
        <input type="hidden" name="featured_image" id="featured_image" value="">
        <img src="" id="featured_image_src" class="featured_image" width="100%">
        <p><a class="btn btn-default imageUpload">Chọn ảnh</a></p>
      </div>

      <div class="form-group">
        <label>Ảnh phụ</label>
        <input type="hidden" name="thump_image" id="featured_icon" value="">
        <img src="" id="featured_icon_src" class="featured_icon" width="100%">
        <p><a class="btn btn-default iconUpload">Chọn ảnh</a></p>
      </div>

      <p>
        <button type="submit" class="btn btn-primary">Thêm mới</button> &nbsp; 
        <a href="cms/danh-muc/list" class="btn btn-primary">Hủy</a>
      </p>
    </div>

    <div class="col-md-8">
      <label>&nbsp;</label>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Tên danh mục</th>
              <th>Trạng thái</th>
              <th>Áp dụng</th>
              <th>Vị trí</th>
              <th>Thao tác</th>
            </tr>
          </thead>

          <tbody>
            <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($cp->parent == 0): ?>
                <tr data-id="<?php echo e($cp->id); ?>" data-parent="<?php echo e($cp->parent); ?>">
                  <td class="td-header">
                    <i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>
                  </td>
                  <td><?php echo e($cp->title); ?></td>
                  <td><?php echo e($cp->status); ?></td>
                  <td><?php echo e($cp->type); ?></td>
                  <td><?php echo e($cp->order); ?></td>
                  <td>
                    <a href="cms/danh-muc/edit/<?php echo e($cp->id); ?>"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                    <a class="btn-delete-cat" href="cms/danh-muc/delete/<?php echo e($cp->id); ?>"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                  </td>
                </tr>
                <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($cp2->parent == $cp->id): ?>
                    <tr data-id="<?php echo e($cp2->id); ?>" data-parent="<?php echo e($cp2->parent); ?>">
                      <td class="td-header">
                        <i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>
                      </td>
                      <td>-- &nbsp;&nbsp;<?php echo e($cp2->title); ?></td>
                      <td><?php echo e($cp2->status); ?></td>
                      <td><?php echo e($cp2->type); ?></td>
                      <td><?php echo e($cp2->order); ?></td>
                      <td>
                        <a href="cms/danh-muc/edit/<?php echo e($cp2->id); ?>"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                        <a class="btn-delete-cat" href="cms/danh-muc/delete/<?php echo e($cp2->id); ?>"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                      </td>
                    </tr>
                    <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($cp3->parent == $cp2->id): ?>
                        <tr data-parent="<?php echo e($cp3->parent); ?>">
                          <td></td>
                          <td>------ &nbsp;&nbsp;<?php echo e($cp3->title); ?></td>
                          <td><?php echo e($cp3->status); ?></td>
                          <td><?php echo e($cp3->type); ?></td>
                          <td><?php echo e($cp3->order); ?></td>
                          <td>
                            <a href="cms/danh-muc/edit/<?php echo e($cp3->id); ?>"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                            <a class="btn-delete-cat" href="cms/danh-muc/delete/<?php echo e($cp3->id); ?>"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                          </td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </form>
</div>

<!-- end: page -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-script'); ?>
<script type="text/javascript">
$('.td-header').click(function(){
  var id = $(this).parent().data("id");
  if ($('tr[data-id="'+id+'"] td:first-child').hasClass('expanded')) {
    $('tr[data-parent="'+id+'"]').fadeIn(500);
    $('tr[data-parent="'+id+'"]').each(function( index ) {
      var id_sub = $(this).data("id");
      $('tr[data-parent="'+id_sub+'"]').fadeIn(500);
      $('tr[data-id="'+id_sub+'"] td:first-child').removeClass('expanded');
      $('tr[data-id="'+id_sub+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>');
    });
    $('tr[data-id="'+id+'"] td:first-child').removeClass('expanded');
    $('tr[data-id="'+id+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>');
  } else {
    $('tr[data-parent="'+id+'"]').fadeOut(500);
    $('tr[data-parent="'+id+'"]').each(function( index ) {
      var id_sub = $(this).data("id");
      $('tr[data-parent="'+id_sub+'"]').fadeOut(500);
      $('tr[data-id="'+id_sub+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-plus-square-o" style="cursor: pointer;"></i>');
      $('tr[data-id="'+id_sub+'"] td:first-child').addClass('expanded');
    });
    $('tr[data-id="'+id+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-plus-square-o" style="cursor: pointer;"></i>');
    $('tr[data-id="'+id+'"] td:first-child').addClass('expanded');
  }
});

$('.btn-delete-cat').click(function(){
  if(confirm('Bạn chắc chắn muốn thực hiện hành động?')){
    var del_url = $(this).attr('href');
    $.ajax({
      type: 'get',
      url: del_url,
      context: this
    }).done(function(data){
      if(data > 0){
        location.reload();
      }else{
        alert('Không áp dụng được với kiểu dữ liệu này');
      }
    });
  }
  return false;
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nhomdaiviet.com.test\resources\views/cms/content/cateproduct/list.blade.php ENDPATH**/ ?>
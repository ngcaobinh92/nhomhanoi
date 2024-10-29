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
  <section class="panel">
    <header class="panel-heading">
      <h2 class="panel-title"><?php echo e(trans('cms.danh_sach')); ?></h2>
      <form method="GET">
        <section>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label"><?php echo e(trans('cms.ten')); ?></label>
                  <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['name'])): ?><?php echo e($_GET['name']); ?><?php endif; ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label"><?php echo e(trans('cms.email')); ?></label>
                  <input type="text" name="email" class="form-control" value="<?php if(isset($_GET['email'])): ?><?php echo e($_GET['email']); ?><?php endif; ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label"><?php echo e(trans('cms.quyen_han')); ?></label>
                  <select id="role" name="role" class="form-control">
                    <?php $__currentLoopData = $roles_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>" <?php if(isset($_GET['role']) && $_GET['role'] == $role->id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($role->title); ?></option>
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
      <table class="table table-bordered table-striped mb-none" id="table-list">
        <thead>
          <tr>
            <th class="center"><?php echo e(trans('cms.id')); ?></th>
            <th class="center"><?php echo e(trans('cms.ten')); ?></th>
            <th class="hidden" style="display: none"><?php echo e(trans('cms.avatar')); ?></th>
            <th class="center"><?php echo e(trans('cms.email')); ?></th>
            <th class="center"><?php echo e(trans('cms.quyen_han')); ?></th>
            <th class="center"><?php echo e(trans('cms.thao_tac')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td class="center"><?php echo e($user->id); ?></td>
            <td><a href="cms/user/edit/<?php echo e($user->id); ?>"><?php echo e($user->name); ?></a></td>
            <td class="hidden"><img src="<?php echo e($user->avatar); ?>" width="100" height="100"></td>
            <td><?php echo e($user->email); ?></td>
            <?php
              $role = DB::table('roles')->where('id', $user->role)->where('status', 1)->first();
              if ($role != '') {
                $role = $role->title;
              } else {
                $role = 'Không xác định';
              }
            ?>
            <td class="center"><?php echo e($role); ?></td>
            <td class="center actions-hover actions-fade">
              <a href="cms/user/edit/<?php echo e($user->id); ?>" title="<?php echo e(trans('cms.sua')); ?>"><i class="fa fa-pencil"></i></a>&emsp;
              <a href="cms/user/delete/<?php echo e($user->id); ?>" title="<?php echo e(trans('cms.xoa')); ?>" class="delete" data-id="<?php echo e($user->id); ?>"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-script'); ?>

<script type="text/javascript">

  var datatableInit = function() {
    var $table = $('#table-list');

    // format function for row details
    var fnFormatDetails = function( datatable, tr ) {
      var data = datatable.fnGetData( tr );

      return [
        '<table class="table mb-none" data-id="' + data[1]+ '">',
          '<tr class="b-top-none">',
            '<td><label class="mb-none">Avatar:</label></td>',
            '<td>' + data[3]+ '</td>',
          '</tr>',
        '</div>'
      ].join('');
    };

    // insert the expand/collapse column
    var th = document.createElement( 'th' );
    var td = document.createElement( 'td' );
    td.innerHTML = '<i data-toggle class="fa fa-plus-square-o text-primary h5 m-none" style="cursor: pointer;"></i>';
    td.className = "text-center";

    $table
      .find( 'thead tr' ).each(function() {
        this.insertBefore( th, this.childNodes[0] );
      });

    $table
      .find( 'tbody tr' ).each(function() {
        this.insertBefore(  td.cloneNode( true ), this.childNodes[0] );
      });

    // initialize
    var datatable = $table.dataTable({
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [ 0 ]
      }],
      aaSorting: [
        [1, 'asc']
      ]
    });

    // add a listener
    $table.on('click', 'i[data-toggle]', function() {
      var $this = $(this),
        tr = $(this).closest( 'tr' ).get(0);

      if ( datatable.fnIsOpen(tr) ) {
        $this.removeClass( 'fa-minus-square-o' ).addClass( 'fa-plus-square-o' );
        datatable.fnClose( tr );
      } else {
        $this.removeClass( 'fa-plus-square-o' ).addClass( 'fa-minus-square-o' );
        datatable.fnOpen( tr, fnFormatDetails( datatable, tr), 'details' );
      }
    });
  };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/user/list.blade.php ENDPATH**/ ?>
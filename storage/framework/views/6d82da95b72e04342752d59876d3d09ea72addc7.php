<?php $__env->startSection('extra-script'); ?>
<script type="text/javascript">
(function( $ ) {

  /*
  Thumbnail: Select
  */
  $('.mg-option input[type=checkbox]').on('change', function( ev ) {
    var wrapper = $(this).parents('.thumbnail');
    if($(this).is(':checked')) {
      wrapper.addClass('thumbnail-selected');
    } else {
      wrapper.removeClass('thumbnail-selected');
    }
  });

  $('.mg-option input[type=checkbox]:checked').trigger('change');

  /*
  Toolbar: Select All
  */
  $('#mgSelectAll').on('click', function( ev ) {
    ev.preventDefault();
    var $this = $(this),
      $label = $this.find('> span');
      $checks = $('.mg-option input[type=checkbox]');

    if($this.attr('data-all-selected')) {
      $this.removeAttr('data-all-selected');
      $checks.prop('checked', false).trigger('change');
      $label.html($label.data('all-text'));
    } else {
      $this.attr('data-all-selected', 'true');
      $checks.prop('checked', true).trigger('change');
      $label.html($label.data('none-text'));
    }
  });

  /*
  Image Preview: Lightbox
  */
  $('.thumb-preview a[href]').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'mfp-img-mobile',
    image: {
      verticalFit: true
    }
  });

  $('.thumb-preview .mg-zoom').on('click.lightbox', function( ev ) {
    ev.preventDefault();
    $(this).closest('.thumb-preview').find('a.thumb-image').triggerHandler('click');
  });

  /*
  Thumnail: Dropdown Options
  */
  $('.thumbnail .mg-toggle').parent()
    .on('show.bs.dropdown', function( ev ) {
      $(this).closest('.mg-thumb-options').css('overflow', 'visible');
    })
    .on('hidden.bs.dropdown', function( ev ) {
      $(this).closest('.mg-thumb-options').css('overflow', '');
    });

  $('.thumbnail').on('mouseenter', function() {
    var toggle = $(this).find('.mg-toggle');
    if ( toggle.parent().hasClass('open') ) {
      toggle.dropdown('toggle');
    }
  });

  /*
  Isotope: Sort Thumbnails
  */
  $("[data-sort-source]").each(function() {

    var source = $(this);
    var destination = $("[data-sort-destination][data-sort-id=" + $(this).attr("data-sort-id") + "]");

    if(destination.get(0)) {

      $(window).load(function() {

        destination.isotope({
          itemSelector: ".isotope-item",
          layoutMode: 'fitRows'
        });

        $(window).on('sidebar-left-toggle inner-menu-toggle', function() {
          destination.isotope();
        });

        source.find("a[data-option-value]").click(function(e) {

          e.preventDefault();

          var $this = $(this),
            filter = $this.attr("data-option-value");

          source.find(".active").removeClass("active");
          $this.closest("li").addClass("active");

          destination.isotope({
            filter: filter
          });

          if(window.location.hash != "" || filter.replace(".","") != "*") {
            window.location.hash = filter.replace(".","");
          }

          return false;

        });

        $(window).bind("hashchange", function(e) {

          var hashFilter = "." + location.hash.replace("#",""),
            hash = (hashFilter == "." || hashFilter == ".*" ? "*" : hashFilter);

          source.find(".active").removeClass("active");
          source.find("[data-option-value='" + hash + "']").closest("li").addClass("active");

          destination.isotope({
            filter: hash
          });

        });

        var hashFilter = "." + (location.hash.replace("#","") || "*");
        var initFilterEl = source.find("a[data-option-value='" + hashFilter + "']");

        if(initFilterEl.get(0)) {
          source.find("[data-option-value='" + hashFilter + "']").click();
        } else {
          source.find(".active a").click();
        }

      });

    }

  });

}(jQuery));

$("#delSelected").click(function(){
  var clicked = $('input:checkbox.slide:checked').map(function () {
    return this.id;
  }).get();

  $.each(clicked, function( index, value ) {
    $('[data-id="'+value+'"]').remove();
  });
});

function delSlide(id) {
  $('[data-id="'+id+'"]').remove();
}

function uploadSlider(id) {
  $('.SliderUpload').popupWindow({
    windowURL:'public/elfinder/standalone-elfinder.php?mode=slider&id='+id,
    windowName:'Filebrowser',
    height:490,
    width:950,
    centerScreen:1
  });
}

$(".AddSlider").click(function(){
  var total = $(".total").val();
  var num = parseInt(total)+1;
  console.log(num);
  $('[data-sort-id="media-gallery"]').append('<div class="isotope-item col-sm-6 col-md-4 col-lg-3" data-id="file_'+num+'"><div class="thumbnail"><div class="thumb-preview"><a class="thumb-image" id="slide_image_file_'+num+'_href" href="public/octopus/assets/images/projects/project-1.jpg"><img class="img-responsive" alt="Project" id="slide_image_file_'+num+'_src" src="public/octopus/assets/images/projects/project-1.jpg"></a><div class="mg-thumb-options"><div class="mg-zoom"><i class="fa fa-search"></i></div><div class="mg-toolbar"><div class="mg-option checkbox-custom checkbox-inline"><input type="hidden" id="slide_image_file_'+num+'" name="slider[]" value=""><input type="checkbox" id="file_'+num+'" class="slide"><label for="file_'+num+'">SELECT</label></div><div class="mg-group pull-right"><a style="cursor: pointer;" onclick="uploadSlider(&#39;file_'+num+'&#39;)" class="SliderUpload">EDIT</a><button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown"><i class="fa fa-caret-up"></i></button><ul class="dropdown-menu mg-menu" role="menu"><li><a style="cursor: pointer;" onclick="uploadSlider(&#39;file_'+num+'&#39;)" class="SliderUpload"><i class="fa fa-edit"></i> Edit</a></li><li><a style="cursor: pointer;" onclick="delSlide(&#39;file_'+num+'&#39;)" class="SliderUpload"><i class="fa fa-trash-o"></i> Delete</a></li></ul></div></div></div></div></div></div>');
  $(".total").val(num);
});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<header class="page-header">
  <h2>Cài đặt</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Cài đặt</span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->
<?php if(session('thongbao')): ?>
<div><b><?php echo e(session('thongbao')); ?></b></div><br>
<?php endif; ?>

<div class="row">
  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="#" class="fa fa-caret-down"></a>
        <a href="#" class="fa fa-times"></a>
      </div>
      <h2 class="panel-title">Quản lý website</h2>
			<p class="panel-subtitle">Quản lý thông tin hiển thị trang website.</p>
    </header>
        
	  <form class="form-horizontal" method="post" id="form summary-form">
	    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	    
			<div class="panel-body">
				<div class="form-body">
					<form class="form-horizontal form-bordered">

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Google Plus</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-google-plus"></i>
										</span>
										<input class="form-control" name="google_plus" value="<?php echo e($cms_siteInfo->google_plus); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Facebook</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-facebook"></i>
										</span>
										<input class="form-control" name="facebook" value="<?php echo e($cms_siteInfo->facebook); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Phone</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-phone"></i>
										</span>
										<input class="form-control" name="hotline" value="<?php echo e($cms_siteInfo->hotline); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</span>
										<input class="form-control" name="email" value="<?php echo e($cms_siteInfo->email); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Twitter</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-twitter"></i>
										</span>
										<input class="form-control" name="twitter" value="<?php echo e($cms_siteInfo->twitter); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Pinterest</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-pinterest"></i>
										</span>
										<input class="form-control" name="pinterest" value="<?php echo e($cms_siteInfo->pinterest); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">zalo</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-windows"></i>
										</span>
										<input class="form-control" name="zalo" value="<?php echo e($cms_siteInfo->zalo); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-6 form-type">
							<div class="form-group">
								<label class="col-md-3 control-label">Địa chỉ</label>
								<div class="col-md-9 control-label">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-building"></i>
										</span>
										<input class="form-control" name="zalo" value="<?php echo e($cms_siteInfo->address); ?>">
									</div>
								</div>
							</div>
						</div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Địa chỉ showroom</label>
                <textarea class="form-control mce_basic" name="showroom"><?php echo e($cms_siteInfo->showroom); ?></textarea>
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Địa chỉ nhà máy</label>
                <textarea class="form-control mce_basic" name="factory"><?php echo e($cms_siteInfo->factory); ?></textarea>
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">link chia sẻ google map</label>
                <textarea class="form-control" name="google_map" rows="7"><?php echo e($cms_siteInfo->google_map); ?></textarea>
              </div>
            </div>

						<div class="col-sm-12 col-sm-offset-4 form-type">
	            <button type="submit" class="btn btn-primary" name="form_type" value="config_site">OK</button>&emsp;
	            <button type="reset" class="btn btn-default">Reset</button>
						</div>

					</div>
				</form>
			</div>
	  </form>
  </section>
</div>

<div class="row">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-caret-down"></a>
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="panel-title">Quản lý danh mục</h2>
			<p class="panel-subtitle">Quản lý quyền truy cập các danh mục trên CMS.</p>
		</header>

		<form id="chk-radios-form" action="" method="POST">
	    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			<div class="panel-body">
    	<?php $__currentLoopData = $cms_cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    		<?php if(count($cat->child) == 0): ?>
    		<div class="form-group">
					<label class="col-md-3 control-label"><?php echo e($cat->title); ?></label>
					<div class="col-md-6">
						<?php $__currentLoopData = $cms_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<label class="checkbox-inline">
							<input type="checkbox" value="<?php echo e($role->id); ?>" <?php if(in_array($role->id, $cat->require)): ?><?php echo e('checked'); ?><?php endif; ?> name="<?php echo e($cat->id); ?>[]"> <?php echo e($role->title); ?>

						</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
    		<?php else: ?>
    		<div class="form-group">
					<label class="col-md-3 control-label"><?php echo e($cat->title); ?></label>
				</div>
					<?php $__currentLoopData = $cat->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="form-group">
						<label class="col-md-3"><?php echo e($catchild->title); ?></label>
						<div class="col-md-6">
							<?php $__currentLoopData = $cms_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<label class="checkbox-inline">
								<input type="checkbox" value="<?php echo e($role->id); ?>" <?php if(in_array($role->id, $catchild->require)): ?><?php echo e('checked'); ?><?php endif; ?> name="<?php echo e($catchild->id); ?>[]"> <?php echo e($role->title); ?>

							</label>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    		<?php endif; ?>
    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary" name="form_type" value="config_roles">OK</button>&emsp;
            <button type="reset" class="btn btn-default">Reset</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>

<div class="row">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-caret-down"></a>
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="panel-title">Ảnh Slide</h2>
			<p class="panel-subtitle">Quản lý Ảnh Slide đầu trang chủ.</p>
		</header>

		<form action="" method="POST">
	    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			<div class="panel-body" style="position: relative;height: 500px;overflow-x: scroll;">
        <div class="col-md-12 col-lg-12">
          <section class="media-gallery" style="position: relative;">
            <div class="content-with-menu-container">
              <div class="mg-main">
                <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                  <div class="inner-toolbar" style="position: sticky;top: 0;z-index: 1;">
                    <ul>
                      <li>
                        <a id="mgSelectAll" style="cursor: pointer;"><i class="fa fa-check-square"></i> <span data-all-text="Chọn toàn bộ" data-none-text="Bỏ chọn hết">Chọn toàn bộ</span></a>
                      </li>
                      <li>
                        <a id="delSelected" style="cursor: pointer;"><i class="fa fa-trash-o"></i> Xóa</a>
                      </li>
                      <li class="right">
                        <ul class="nav nav-pills nav-pills-primary">
                          <li>
                            <a class="AddSlider"><i class="fa fa-plus"></i> Thêm mới</a>
                          </li>
                          <li>
                            <button type="reset" class="btn btn-default">Reset</button>
                          </li>
                          <li>
                            <button type="submit" class="btn btn-primary" name="form_type" value="config_slide">OK</button>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>

                  <input type="hidden" class="total" value="<?php echo e(count($cms_slide)); ?>">
                  <?php if(count($cms_slide) > 0): ?>
                    <?php $__currentLoopData = $cms_slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="isotope-item col-sm-6 col-md-4 col-lg-3" data-id="file_<?php echo e($key+1); ?>">
                      <div class="thumbnail">
                        <div class="thumb-preview">
                          <a class="thumb-image" id="slide_image_file_<?php echo e($key+1); ?>_href" href="<?php echo e($slider->image); ?>">
                            <img class="img-responsive" alt="Project" id="slide_image_file_<?php echo e($key+1); ?>_src" src="<?php echo e($slider->image); ?>">
                          </a>
                          <div class="mg-thumb-options">
                            <div class="mg-zoom"><i class="fa fa-search"></i></div>
                            <div class="mg-toolbar">
                              <div class="mg-option checkbox-custom checkbox-inline">
                                <input type="hidden" id="slide_image_file_<?php echo e($key+1); ?>" name="slider[]" value="<?php echo e($slider->image); ?>">
                                <input type="checkbox" id="file_<?php echo e($key+1); ?>" class="slide">
                                <label for="file_<?php echo e($key+1); ?>">CHỌN</label>
                              </div>
                              <div class="mg-group pull-right">
                                <a style="cursor: pointer;" onclick="uploadSlider('file_<?php echo e($key+1); ?>')" class="SliderUpload">THAY ĐỔI</a>
                                <button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown">
                                  <i class="fa fa-caret-up"></i>
                                </button>
                                <ul class="dropdown-menu mg-menu" role="menu">
                                  <li><a style="cursor: pointer;" onclick="uploadSlider('file_<?php echo e($key+1); ?>')" class="SliderUpload"><i class="fa fa-edit"></i> Thay đổi</a></li>
                                  <li><a style="cursor: pointer;" onclick="delSlide('file_<?php echo e($key+1); ?>')" class="SliderUpload"><i class="fa fa-trash-o"></i> Xóa</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
		</form>
	</section>
</div>

<!-- end: page -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nhomdaiviet.com.test\resources\views/cms/content/setting/index.blade.php ENDPATH**/ ?>
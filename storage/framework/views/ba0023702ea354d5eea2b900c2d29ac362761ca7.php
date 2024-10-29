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
      $('i', this).removeClass('fa-check-square-o').addClass('fa-square-o');
    } else {
      $this.attr('data-all-selected', 'true');
      $checks.prop('checked', true).trigger('change');
      $label.html($label.data('none-text'));
      $('i', this).removeClass('fa-square-o').addClass('fa-check-square-o');
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
  $('[data-sort-id="media-gallery"]').append('<div class="isotope-item col-sm-6 col-md-4 col-lg-3" data-id="file_'+num+'"><div class="thumbnail"><div class="thumb-preview"><a class="thumb-image" id="slide_image_file_'+num+'_href" href="public/octopus/assets/images/projects/project-1.jpg"><img class="img-responsive" alt="Project" id="slide_image_file_'+num+'_src" src="public/octopus/assets/images/projects/project-1.jpg"></a><div class="mg-thumb-options"><div class="mg-zoom"><i class="fa fa-search"></i></div><div class="mg-toolbar"><div class="mg-option checkbox-custom checkbox-inline"><input type="hidden" id="slide_image_file_'+num+'" name="slider[]" value=""><input type="checkbox" id="file_'+num+'" class="slide"><label for="file_'+num+'">SELECT</label></div><div class="mg-group pull-right"><a style="cursor: pointer;" onclick="uploadSlider(&#39;file_'+num+'&#39;)" class="SliderUpload">EDIT</a><button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown"><i class="fa fa-caret-up"></i></button><ul class="dropdown-menu mg-menu" role="menu"><li><a style="cursor: pointer;" onclick="uploadSlider(&#39;file_'+num+'&#39;)" class="SliderUpload"><i class="fa fa-edit"></i> Edit</a></li><li><a style="cursor: pointer;" onclick="delSlide(&#39;file_'+num+'&#39;)" class="SliderUpload"><i class="fa fa-trash-o"></i> Delete</a></li></ul></div></div></div></div></div></div>');
  $(".total").val(num);
});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style type="text/css">
  .AddSlider {
    cursor: pointer;
  }
</style>

<header class="page-header">
  <h2>Chỉnh sửa</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="index.html">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quán lý sản phẩm</span></li>
      <li><span><?php echo e($product->title); ?></span></li>
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

    <section class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="fa fa-caret-down"></a>
          <a href="#" class="fa fa-times"></a>
        </div>
        <h2 class="panel-title">Thông tin sản phẩm</h2>
      </header>

      <div class="panel-body">  
        <div class="col-md-7 col-lg-8">
          <section class="panel">
            <div class="row">
              <div class="panel-body">
                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" value="<?php echo e($product->title); ?>" required>
                    <?php if($errors->has('title')): ?>
                    <span class="error_mess"><?php echo e($errors->first('title')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Đường dẫn tin tức</label>
                    <input type="text" class="form-control" name="slug" value="<?php echo e($product->slug); ?>">
                    <?php if($errors->has('slug')): ?>
                    <span class="error_mess"><?php echo e($errors->first('slug')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Mô tả</label>
                    <textarea class="form-control mce_basic" name="description"><?php echo e($product->description); ?></textarea>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Nội dung</label>
                    <textarea class="form-control mce_full" name="content"><?php echo e($product->content); ?></textarea>
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
                    <label class="control-label">Tags</label>
                    <input name="tags" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="<?php echo e($product->tags); ?>">
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Ảnh mô tả chính</label>
                      <input type="hidden" name="featured_image" id="featured_image" value="<?php echo e($product->featured_image); ?>">
                      <img src="<?php echo e($product->featured_image); ?>" id="featured_image_src" class="thumbnail" width="100%">
                      <p><a class="btn btn-default imageUpload">Chọn ảnh</a></p>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Ảnh mô tả phụ</label>
                      <input type="hidden" name="thump_image" id="featured_icon" value="<?php echo e($product->thump_image); ?>">
                      <img src="<?php echo e($product->thump_image); ?>" id="featured_icon_src" class="thumbnail" width="100%">
                      <p><a class="btn btn-default iconUpload">Chọn ảnh</a></p>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Danh mục</label>
                    <select id="parent" name="parent" class="form-control">
                      <option value="0">Không</option>
                      <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($cp->parent == 0): ?>
                          <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($cp2->parent == $cp->id): ?>
                            <option value="<?php echo e($cp2->id); ?>" <?php if($product->parent == $cp2->id): ?><?php echo e('hidden selected'); ?><?php endif; ?>><?php echo e($cp2->title); ?></option>
                            <?php $__currentLoopData = $categories_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($cp3->parent == $cp2->id): ?>
                              <option value="<?php echo e($cp2->id); ?>" <?php if($product->parent == $cp3->id): ?><?php echo e('hidden selected'); ?><?php endif; ?>>-- &nbsp;&nbsp;<?php echo e($cp3->title); ?></option>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Số lượng sản phẩm</label>
                    <input type="number" class="form-control" name="quantity" min="0" step="1" value="<?php echo e($product->quantity); ?>" required="">
                    <?php if($errors->has('quantity')): ?>
                    <span class="error_mess"><?php echo e($errors->first('quantity')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Giá cơ bản (VNđ)</label>
                    <input type="number" class="form-control" name="origin_price" min="0" step="any" value="<?php echo e($product->origin_price); ?>" required="">
                    <?php if($errors->has('origin_price')): ?>
                    <span class="error_mess"><?php echo e($errors->first('origin_price')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Giảm giá (%)</label>
                    <input type="number" class="form-control" name="sale" max="100" min="0" step="any" value="<?php echo e($product->sale); ?>" required="">
                    <?php if($errors->has('sale')): ?>
                    <span class="error_mess"><?php echo e($errors->first('sale')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">Trạng thái</label>
                    <select id="status" name="status" class="form-control">
                      <option value="public" <?php if($product->status == 'public'): ?><?php echo e('selected'); ?><?php endif; ?>>Hiện</option>
                      <option value="preview" <?php if($product->status == 'preview'): ?><?php echo e('selected'); ?><?php endif; ?>>Ẩn</option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-12 form-type center">
                  <div class="form-group">
                    <br>
                    <a href="<?php echo e($product->slug); ?>" class="btn btn-info" target="_blank">Link sản phẩm</a>&emsp;
                    <button type="submit" class="btn btn-primary">OK</button>&emsp;
                    <a href="cms/san-pham/edit/<?php echo e($product->id); ?>" class="btn btn-default">Reset</a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>

    <section class="panel">
      <header class="panel-heading">
          <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
          </div>
        <h2 class="panel-title">Ảnh Slide sản phẩm</h2>
      </header>

      <div class="panel-body" style="position: relative;height: 500px;overflow-x: scroll;">
        <div class="col-md-12 col-lg-12">
          <section class="media-gallery" style="position: relative;">
            <div class="content-with-menu-container">
  
              <div class="mg-main">
                <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">

                  <div class="inner-toolbar" style="position: sticky;top: 0;z-index: 1;">
                    <ul>
                      <li>
                        <a id="mgSelectAll" style="cursor: pointer;"><i class="fa fa-square-o"></i> <span data-all-text="Chọn toàn bộ" data-none-text="Bỏ chọn hết">Chọn toàn bộ</span></a>
                      </li>
                      <li>
                        <a id="delSelected" style="cursor: pointer;"><i class="fa fa-trash-o"></i> Xóa</a>
                      </li>
                      <li class="right">
                        <ul class="nav nav-pills nav-pills-primary">
                          <li>
                            <a class="AddSlider"><i class="fa fa-plus"></i> Thêm mới</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>

                  <input type="hidden" class="total" value="<?php echo e(count($product->slider)); ?>">
                  <?php if(count($product->slider) > 0): ?>
                    <?php $__currentLoopData = $product->slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="isotope-item col-sm-6 col-md-4 col-lg-3" data-id="file_<?php echo e($key+1); ?>">
                      <div class="thumbnail">
                        <div class="thumb-preview">
                          <a class="thumb-image" id="slide_image_file_<?php echo e($key+1); ?>_href" href="<?php echo e($slider->image); ?>">
                            <img class="img-responsive" alt="Project" id="slide_image_file_<?php echo e($key+1); ?>_src" src="<?php echo e($slider->thumb); ?>">
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
                        <!-- <h5 class="mg-title text-semibold">SEO<small>.png</small></h5>
                        <div class="mg-description">
                          <small class="pull-left text-muted">Design, Websites</small>
                          <small class="pull-right text-muted">07/10/2014</small>
                        </div> -->
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
    </section>

  </form>
</div>
<!-- end: page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/content/product/edit.blade.php ENDPATH**/ ?>
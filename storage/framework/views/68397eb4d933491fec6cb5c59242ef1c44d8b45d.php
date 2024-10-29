<?php $__env->startSection('content'); ?>
<?php echo $__env->make('site.master.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page_collection">
  <div class="container">
    <div class="row">

      <?php echo $__env->make('site.master.side-product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="bannercollection">
          <img src="public/img/img_collection.jpg" alt="<?php echo e(@$data['breadcrumb'][$last_key]['title']); ?>">
        </div>
        <!--Sắp xếp-->
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-4 col-sm-6">
              <div class="sorter">
                <div class="view-mode"> 
                  <a id="grid-tab" title="Danh sách" class="button button-grid"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                  <a id="list-tab" title="Danh sách" class="button button-list"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <div class="col-xs-8 col-sm-6 text-right">
              <div id="sort-by">
                <label class="left">Sắp xếp: </label>
                <select id="soft_by" class="coll-soft-by">
                  <option <?php if(@$params["orderBy"].'-'.@$params["order"] == "title-asc"): ?><?php echo e('selected'); ?><?php endif; ?> value="title-asc">Từ A-Z</option>
                  <option <?php if(@$params["orderBy"].'-'.@$params["order"] == "title-desc"): ?><?php echo e('selected'); ?><?php endif; ?> value="title-desc">Từ Z-a</option>
                  <option <?php if(@$params["orderBy"].'-'.@$params["order"] == "created_at-asc"): ?><?php echo e('selected'); ?><?php endif; ?> value="created_at-asc">Mới đến cũ</option>
                  <option <?php if(@$params["orderBy"].'-'.@$params["order"] == "created_at-desc"): ?><?php echo e('selected'); ?><?php endif; ?> value="created_at-desc">Cũ đến mới</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div id="grid-div" class="row product-thumb" style="display: none;">
          <?php if(count($data['products']) > 0): ?>
            <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xs-6 col-sm-4 col-md-3 productcollections">
              <div class="item">
                <div class="item-inner transition">
                  <div class="image">
                    <a class="lt-image" href="<?php echo e($product->slug); ?>" target="_self" title="<?php echo e($product->title); ?>">
                      <?php if($product->featured_image != ''): ?><img src="<?php echo e($product->featured_image); ?>" class="img-1" alt="<?php echo e($product->title); ?>"><?php endif; ?>
                      <?php if($product->thump_image != ''): ?><img src="<?php echo e($product->thump_image); ?>" class="img-2" alt="<?php echo e($product->title); ?>"><?php endif; ?>
                    </a>
                  </div>
                  <div class="caption">
                    <h4><a href="<?php echo e($product->slug); ?>" title="<?php echo e($product->title); ?>" target="_self"><?php echo e($product->title); ?></a></h4>
                    <p class="price">
                      <a href="lien-he"><span class="price-new">Liên hệ</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-12 productcollections">Không có sản phẩm nào để hiển thị</div>
          <?php endif; ?>
        </div>

        <div id="list-div" class="row product-thumb" style="display: none;">
          <?php if(count($data['products']) > 0): ?>
            <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xs-12">
              <div class="item collection-item">
                <div class="item-inner transition">
                  <div class="row">
                    <div class="col-xs-12 col-sm-4">
                      <div class="image">
                        <a class="lt-image" href="<?php echo e($product->slug); ?>" target="_self" title="<?php echo e($product->title); ?>">
                        <?php if($product->featured_image != ''): ?><img src="<?php echo e($product->featured_image); ?>" class="img-1 category" alt="<?php echo e($product->title); ?>"><?php endif; ?>
                        <?php if($product->thump_image != ''): ?><img src="<?php echo e($product->thump_image); ?>" class="img-2" alt="<?php echo e($product->title); ?>"><?php endif; ?>
                        </a>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 text-left">
                      <div class="caption">
                        <h4><a href="<?php echo e($product->slug); ?>" title="<?php echo e($product->title); ?>" target="_self"><?php echo e($product->title); ?></a></h4>
                        <div class="">
                          <?php if(strlen($product->content) > 170): ?> <?php echo e(substr($product->content, 170).'...'); ?> <?php else: ?> <?php echo e($product->content); ?> <?php endif; ?>
                        </div>
                        <p class="price">
                          <a href="lien-he"><span class="price-new">Liên hệ</span></a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="col-xs-12">Không có sản phẩm nào để hiển thị</div>
          <?php endif; ?>
        </div>

        <?php if($data['products']->total() > $data['products']->perPage()): ?>
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-12 col-sm-offset-6 col-sm-6 text-right"><?php echo e($data['products']->links('site.master.pagination')); ?></div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var view = Cookies.get('view');
  if( view ) {
    if (view == 'grid') {
      $("#grid-tab").addClass("change-view--active");
      $("#grid-div").show("fast");
    } else {
      $("#list-tab").addClass("change-view--active");
      $("#list-div").show("fast");
    }
  } else {
    Cookies.set('view', 'grid');
    $("#grid-tab").addClass("change-view--active");
    $("#grid-div").fadeOut("fast");
  }

  $("#grid-tab").on('click', function(){
    Cookies.set('view', 'grid');
    $("#list-tab").removeClass("change-view--active");
    $("#list-div").fadeOut("fast");
    $("#grid-tab").addClass("change-view--active");
    $("#grid-div").fadeIn("fast");
  });

  $("#list-tab").on('click', function(){
    Cookies.set('view', 'list');
    $("#grid-tab").removeClass("change-view--active");
    $("#grid-div").fadeOut("fast");
    $("#list-tab").addClass("change-view--active");
    $("#list-div").fadeIn("fast");
  });

  $("#soft_by").change(function() {
    var $option = $(this).find(':selected');
    var val = $option.val();
    var url = 'http://' + window.location.hostname + window.location.pathname;
    if (val != "") {
      val = val.split("-");
      url += "?orderBy=" + val[0] + "&order=" + val[1];
      window.location.href = url;
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nhomdaiviet.com.test\resources\views/site/content/product/category.blade.php ENDPATH**/ ?>
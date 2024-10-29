
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('site.master.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page_collection">
  <div class="container">
    <div class="product-info">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <?php if(count($data['product']->slide_product) > 0): ?>
          <div class="image large-image">
            <a title="<?php echo e($data['product']->title); ?>" class="cloud-zoom" rel="adjustX: 0, adjustY:0" id="zoom1" href="<?php echo e($data['product']->slide_product[0]->image); ?>">
              <img src="<?php echo e($data['product']->slide_product[0]->image); ?>" id="image" alt="<?php echo e($data['product']->title); ?>">
            </a>
          </div>
          <div class="image-additional">
            <?php $__currentLoopData = $data['product']->slide_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a title="<?php echo e($data['product']->title); ?>" rel="useZoom: 'zoom1', smallImage: '<?php echo e($slide_product->image); ?>'" class="cloud-zoom-gallery" href="<?php echo e($slide_product->image); ?>">
              <img title="<?php echo e($data['product']->title); ?>" src="<?php echo e($slide_product->thumb); ?>" alt="<?php echo e($data['product']->title); ?>">
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php else: ?>
          <div class="image large-image"> Không có hình ảnh để hiển thị</div>
          <?php endif; ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
          <h1 class="name_product"><?php echo e($data['product']->title); ?></h1>
          <div class="box-price-titrang">
            <div class="row">
              <div class="giasp col-xs-8 col-sm-6">
                <?php if(@$data['product']->detail_product->quantity > 0): ?>
                  <?php if(@$data['product']->detail_product->sale > 0): ?> 
                    <a href="lien-he">
                      <strong class="sale-old"><?php echo e(number_format($data['product']->detail_product->origin_price)); ?>đ</strong>
                      <strong class="sale-new"> - <?php echo e(number_format($data['product']->detail_product->origin_price - (($data['product']->detail_product->origin_price * $data['product']->detail_product->sale) / 100))); ?>đ</strong>
                    </a>
                  <?php else: ?>
                    <a href="lien-he"><strong class="sale-price">
                      <?php echo e(number_format($data['product']->detail_product->origin_price)); ?>đ</strong></a>
                  <?php endif; ?>
                <?php else: ?>
                  <a href="lien-he"><strong class="sale-price">Liên hệ</strong></a>
                <?php endif; ?>
              </div>
              <div class="col-xs-4 col-sm-6">
                <ul class="tinhtrang">
                  <li><span class="hidden-xs">Tình trạng: </span>
                    <span class="green bl"><?php if(@$data['product']->detail_product->quantity > 0): ?> <?php echo e('Còn hàng'); ?> <?php else: ?><?php echo e('Liên hệ'); ?><?php endif; ?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="line"></div>
          <div class="">
            <ul class="list_thongtin">
              <li><span>Nhà sản xuất:</span> <a href="<?php echo e($data['product']->slug); ?>">Công ty Cổ phần Phân phối nhôm Hà Nội</a></li>
            </ul>
          </div>
          <div class="line"></div>
          <div class="motanganproduct">
            <div class="tieude_motanganproduct">Mô tả:</div>
            <div>
              <div class="than_motanganproduct"><?php echo $data['product']->description; ?></div>
            </div>
            <div class="detailcall">
              <div class="callphoneicon">
                <i class="fa fa-phone"></i>
              </div>
              <a href="tel:<?php echo e($configs->hotline); ?>">đặt mua qua điện thoại (8h00 - 20h00) <br><span><?php echo e($configs->hotline); ?></span></a>
            </div>
            <div class="clearfix"></div>
            <div class="line"></div>
            <?php if(@$data['product']->detail_product->origin_price > 0 && @$data['product']->detail_product->quantity > 0): ?> 
            <div class="addtocart">
              <a class="btn btn-info btn-lg" onclick="addcart('<?php echo e($data['product']->slug); ?>')">  
                <span class="glyphicon glyphicon-shopping-cart"></span><b>Thêm vào giỏ</b>  
              </a>
              <div class="clearfix"></div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-9">
          <div class="">
            <div class="tabthongtinchitiet">
              <div class="tabs">
                <ul class="nav nav-tabs tabs-title" id="myTab">
                  <li class="active"><a href="#home">Thông tin sản phẩm</a></li>
                  <li><a href="#more">Vận chuyển</a></li>
                  <li><a href="#more2">Hướng dẫn mua hàng</a></li>
                </ul>
                <div class="tab-content tab-body" style="overflow: auto;">
                  <div class="tab-pane active" id="home">
                    <?php echo $data['product']->content; ?>

                  </div>
                  <div class="tab-pane" id="more">
                    <p>- Sản phẩm chúng tôi cung cấp đến địa điểm công trình của khách hàng.</p>
                    <p>- Giao tại kho Công ty Cổ phần Phân phối nhôm Hà Nội</p>
                    <p>Quý khách hàng có yêu cầu về vận chuyển sản phẩm xin liên hệ trực tiếp đến số hotline: <?php echo e($configs->hotline); ?></p>
                  </div>
                  <div class="tab-pane" id="more2">
                    <?php echo @$data['product']->guide_buy->content; ?>

                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop">
              <span style="vertical-align: bottom; width: 100%; height: 278px;">
              </span>
            </div> -->
          </div>
        </div>
        <div class="col-md-3 col-xs-12">
          <div class="" id="related_products">
            <div class="">
              <div class="block-sidebar-product-title">
                <h2>Sản phẩm liên quan</h2>
              </div>
              <div class="block-sidebar-product-content">
                <?php if(isset($data['product']->relate_product) && $data['product']->relate_product != ''): ?>
                  <?php $__currentLoopData = $data['product']->relate_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="item" style="border: 1px solid #ddd; margin-bottom: 30px; padding-top: 5px">
                    <div class="item-inner transition">
                      <div class="image">
                        <a class="lt-image" href="<?php echo e($product->slug); ?>" target="_self" title="<?php echo e($product->title); ?>">
                          <img src="<?php echo e($product->featured_image); ?>" class="img-1 product" alt="<?php echo e($product->title); ?>">
                        </a>
                      </div>
                      
                      <div class="caption">
                        <h4><a href="<?php echo e($product->slug); ?>" title="<?php echo e($product->title); ?>" target="_self"><?php echo e($product->title); ?></a></h4>
                        <p class="price">
                          <?php if($product->sale > 0): ?>
                            <a href="<?php echo e($product->slug); ?>"><span class="price-old"><?php echo e($product->origin_price); ?>đ</span></a> <small>(Tiết kiệm <?php echo e($product->sale); ?>%)</small></br>
                            <a href="<?php echo e($product->slug); ?>"><span class="price-new"><?php echo e(number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))); ?>đ</span></a></br>
                          <?php else: ?>
                            </br>
                            <a href="<?php echo e($product->slug); ?>"><span class="price-new"><?php echo e(number_format($product->origin_price)); ?>đ</span></a></br>
                          <?php endif; ?>

                          <div class="p-action">
                            <?php if($product->quantity > 0): ?>
                              <span class="p-qty">
                                <i class="fa fa-check" aria-hidden="true"></i> Sẵn hàng 
                              </span>
                              <a href="javascript:;" class="p-buy"></a>
                            <?php else: ?>
                              <a href="lien-he">
                                <span class="p-empty">Liên hệ</span>
                              </a>
                            <?php endif; ?>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery(function($) {
    $('.selector-wrapper').hide();
  	$('.selector-wrapper').css({
  		'text-align':'left',
  		'margin-bottom':'15px'
    });
  });
    
  $.fn.CloudZoom.defaults = {
    zoomWidth:"500",
    zoomHeight:"300",
    position:"inside",
    adjustX:0,
    adjustY:0,
    adjustY:"",
    tintOpacity:0.5,
    lensOpacity:0.5,
    titleOpacity:0.5,
    smoothMove:3,
    showTitle:false
  };
  
  jQuery(document).ready(function(){
  	$('#myTab a').click(function (e) {
  		e.preventDefault();
  		$(this).tab('show');
  	})
  });
  
  const slider = document.querySelector('.image-additional');
  let isDown = false;
  let startX;
  let scrollLeft;

  slider.addEventListener('mousedown', (e) => {
    isDown = true;
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });
  slider.addEventListener('mouseleave', () => {
    isDown = false;
  });
  slider.addEventListener('mouseup', () => {
    isDown = false;
  });
  slider.addEventListener('mousemove', (e) => {
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3;
    slider.scrollLeft = scrollLeft - walk;
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nhomdaiviet/resources/views/site/content/product/detail.blade.php ENDPATH**/ ?>
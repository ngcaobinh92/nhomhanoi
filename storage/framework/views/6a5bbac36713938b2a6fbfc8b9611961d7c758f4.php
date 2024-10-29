<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">Navigation</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
        <?php if(!isset($module)){$module = '';}
          (\Session::has('website_language') == true) ? $lang = \Session::get('website_language') : $lang = 'vi';
        ?>
        <?php $__currentLoopData = App\Models\CMSMenuModel::where('menu_id', '0')->where('status', '1')->orderBy('order','DESC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        <?php
            $menu->child = App\Models\CMSMenuModel::where('menu_id', $menu->id)->where('status', '1')->orderBy('order','DESC')->get();
	        ?>
	        <li class="<?php if(count($menu->child) > 0): ?><?php echo e('nav-parent'); ?><?php endif; ?> <?php if($module == $menu->url): ?><?php echo e('nav-active nav-expanded'); ?><?php endif; ?>">
            <a href="<?php if(count($menu->child) == 0): ?><?php echo e('cms/'.$menu->url); ?><?php else: ?><?php echo e('javascript:;'); ?><?php endif; ?>">
            	<i class="fa fa-copy" aria-hidden="true"></i>
            	<span><?php echo e(trans('cms.'.$menu->translate)); ?></span>
            </a>
            <?php if(count($menu->child) > 0): ?>
              <ul class="nav nav-children">
                <?php $__currentLoopData = $menu->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e('cms/'.$menu->url.'/'.$child->url); ?>">
			            	<i class="fa fa-copy" aria-hidden="true"></i>
                  	<span><?php echo e(trans('cms.'.$child->translate)); ?></span>
                  </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php endif; ?>
	        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php if($adminLogin->role == 0): ?>
          <li class="<?php if($module == 'setting'): ?><?php echo e('nav-active nav-expanded'); ?><?php endif; ?>">
            <a href="cms/setting">
	          	<i class="fa fa-cog" aria-hidden="true"></i>
	            <span><?php echo e(trans('cms.setting')); ?></span>
	          </a>
          </li>
        <?php endif; ?>
				</ul>
			</nav>
		</div>
	</div>
</aside><?php /**PATH C:\xampp\htdocs\nhomdaiviet.com.test\resources\views/cms/master/side.blade.php ENDPATH**/ ?>
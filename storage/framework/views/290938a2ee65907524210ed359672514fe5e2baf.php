<?php
$rq = array();
$CMSNotificationModel = new App\Models\CMSNotificationModel;
$new = $CMSNotificationModel::select('id')->where('user_id', '>', 0)->where('status', 1)->count();
$total = $CMSNotificationModel::select('id')->where('user_id', '>', 0)->count();
$noti_list = $CMSNotificationModel::where('user_id', '>', 0)->orderBy('id', 'DESC')->limit(4)->get();
?>

<ul class="notifications">
	<li>
		<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
			<i class="fa fa-envelope"></i>
			<span class="badge"><?php echo e($new); ?></span>
		</a>

		<div class="dropdown-menu notification-menu">
			<div class="notification-title">
				<span class="pull-right label label-default"><?php echo e($total); ?></span>
				<?php echo e(trans('cms.tin_nhan')); ?>

			</div>

			<div class="content">
				<ul class="noticms">
					<?php $__currentLoopData = $noti_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
					$user = DB::table('users')->where('id', $noti->user_id)->first();
					?>
					<li>
						<a href="cms/notified/detail/<?php echo e($noti->id); ?>" class="clearfix">
							<figure class="image">
								<img src="<?php echo e($user->avatar); ?>" alt="<?php echo e($user->name); ?>" class="img-circle" />
							</figure>
							<span class="title"><?php echo e($user->name); ?></span>
							<span class="message <?php if(strlen($noti->content) > 800): ?><?php echo e('truncate'); ?><?php endif; ?>"><?php if($noti->status == 1): ?><b><?php echo e($noti->content); ?></b><?php else: ?><?php echo e($noti->content); ?><?php endif; ?><br><?php echo e($noti->created_at->format('d/m/Y H:m:i')); ?></span>
						</a>
					</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>

				<hr />

				<div class="text-right">
					<a href="cms/notified/list" class="view-more">View All</a>
				</div>
			</div>
		</div>
	</li>
</ul>

<span class="separator"></span><?php /**PATH C:\xampp\htdocs\nhomdaiviet.com.test\resources\views/cms/master/noti.blade.php ENDPATH**/ ?>
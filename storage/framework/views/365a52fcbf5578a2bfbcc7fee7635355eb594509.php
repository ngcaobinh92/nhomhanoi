<?php $__env->startSection('content'); ?>
<?php echo $__env->make('site.master.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page_collection">
  <div class="container">
    <div class="row content-blog-list">
      <div class="col-xs-12 col-sm-4 col-md-3 sticky_top">
        <?php echo $__env->make('site.master.side-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="box-detail">
          <h3><a href="<?php echo e($data['new']->slug); ?>"><?php echo e($data['new']->title); ?></a></h3>
          <div class="post-detail"> <?php echo e(\Carbon\Carbon::parse($data['new']->created_at)->format('d/m/Y H:i:s')); ?> - <?php echo e(count($data['new']->comments)); ?> bình luận </div>
          <div class="text-blog"><?php echo $data['new']->content; ?></div>
        </div>

        <?php if(count($data['new']->comments) > 0): ?>
        <div class="comments box padding"> 
          <h3>Bình luận (<?php echo e(count($data['new']->comments)); ?>)</h3>

          <?php $__currentLoopData = $data['new']->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="comments-content row">
            <div class="avatar col-md-2 col-xs-2">
              <img alt="Guest" src="public/img/avatar.png">
            </div>  
            <div class="comments-details col-md-10 col-xs-10">
              <div class="comment-author">
                <a><?php echo e($comment->name); ?></a> 
              </div>
              <div class="comment-meta"><?php echo e(\Carbon\Carbon::parse($comment->updated_at)->format('d/m/Y H:i:s')); ?></div>  
              <div class="comment-text">
                <p><?php echo e($comment->content); ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
        </div>
        <?php endif; ?>

        <!-- <div class="respond box padding">
          <form accept-charset="utf-8" action="comments/<?php echo e($data['new']->id); ?>" id="article_comments" method="post">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <h3>Viết bình luận của bạn</h3>
            <?php if(session('thongbao')): ?>
            <div style="word-wrap: break-word;"><b style="color: red"><?php echo e(session('thongbao')); ?></b></div><br>
            <?php endif; ?>
            <div class="form-group ">
              <label for="name">Tên:<span class="required">*</span></label>
              <div>
                <input name="name" type="text" class="form-control" id="name" placeholder="Tên của bạn" required>
              </div>
            </div>
            <div class="form-group ">
              <label for="email">Email:<span class="required">*</span></label>
              <input name="email" type="email" class="form-control" id="email" placeholder="Email của bạn" required>
            </div>
            <div class="form-group ">
              <label>Bình luận:<span class="required">*</span></label>
              <textarea name="content" rows="3" cols="10" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn_button" type="submit">Gửi bình luận</button>
            </div>
          </form>
        </div> -->
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.master.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/site/content/new/detail.blade.php ENDPATH**/ ?>
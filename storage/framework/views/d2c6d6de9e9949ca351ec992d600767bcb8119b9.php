<!doctype html>
<html class="fixed">
<head>
	<!-- Basic -->
	<meta charset="UTF-8">

	<title>Admin</title>
	<meta name="author" content="Bình Nguyễn">
    <base href="<?php echo e(asset('')); ?>">
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="public/octopus/assets/vendor/select2/select2.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

	<link rel="stylesheet" href="public/octopus/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/morris/morris.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="public/octopus/assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="public/octopus/assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="public/octopus/assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="public/octopus/assets/vendor/modernizr/modernizr.js"></script>

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/dropzone/css/basic.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/dropzone/css/dropzone.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/summernote/summernote.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/summernote/summernote-bs3.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/codemirror/lib/codemirror.css" />
	<link rel="stylesheet" href="public/octopus/assets/vendor/codemirror/theme/monokai.css" />

	<link rel="stylesheet" href="public/css/admin.css" />

	<style type="text/css">
		.noticms {
		    overflow-y: scroll;
		    height: 15vw;
		}

		.img-circle {
			width: 35px;
			height: 35px;
		}
	</style>

</head>
<body>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="cms" class="logo">
					<img src="public/octopus/assets/images/logo.png" height="35" alt="JSOFT Admin" />
				</a>
				<input type="hidden" id="langfont" value="<?php echo e(\Session::get('website_language')); ?>">
				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
					<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>
		
			<!-- start: search & user box -->
			<div class="header-right">
		
				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<div class="profile-info">
							<span class="name"><?php echo e(trans('cms.ngon_ngu_hien_thi')); ?></span>
							<span class="role"><?php echo e(DB::table('language')->where('lang_code', $website_language)->first()->lang_name); ?></span>
						</div>
		
						<i class="fa custom-caret"></i>
					</a>
		
					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>
							<?php
								$list = DB::table('language')->where('lang_theme', 1)->orderBy('lang_order', 'ASC')->get();
							?>
							<?php if($list != null): ?>
								<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo route('user.change-language', ['language' => $lang->lang_code]); ?>">
										<img src="public/img/flags/1x1/<?php echo e($lang->lang_flag); ?>" class="flag"><?php echo e($lang->lang_name); ?>

									</a>
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
		
				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<div class="profile-info">
							<span class="name"><?php echo e(trans('cms.ngon_ngu_bai_viet')); ?></span>
							<span class="role"><?php echo e(DB::table('language')->where('lang_code', $post_language)->first()->lang_name); ?></span>
						</div>
		
						<i class="fa custom-caret"></i>
					</a>
		
					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>
							<?php
								$list = DB::table('language')->where('lang_post', 1)->orderBy('lang_order', 'ASC')->get();
							?>
							<?php if($list != null): ?>
								<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo route('user.change-post-lang', ['language' => $lang->lang_code]); ?>">
										<img src="public/img/flags/1x1/<?php echo e($lang->lang_flag); ?>" class="flag"><?php echo e($lang->lang_name); ?>

									</a>
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
		
				<span class="separator"></span>

				<?php echo $__env->make('cms.master.noti', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src="public/octopus/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="public/octopus/assets/images/!logged-user.jpg" />
						</figure>
						<div class="profile-info">
							<span class="name"><?php echo e($adminLogin->user_name); ?></span>
			                <?php
				                $role = DB::table('roles')->where('id', $adminLogin->role)->first();
			                ?>
							<span class="role"><?php echo e($role->title); ?></span>
						</div>
		
						<i class="fa custom-caret"></i>
					</a>
		
					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>
							<li>
								<a role="menuitem" tabindex="-1" href="cms/user/edit/<?php echo e($adminLogin->id); ?>"><i class="fa fa-user"></i> <?php echo e(trans('cms.thong_tin_ca_nhan')); ?></a>
							</li>
							<li>
								<a role="menuitem" tabindex="-1" href="cms/logout"><i class="fa fa-power-off"></i> <?php echo e(trans('cms.thoat')); ?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end: search & user box -->
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php echo $__env->make('cms.master.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<!-- end: sidebar -->

			<section role="main" class="content-body">

				<?php echo $__env->yieldContent('content'); ?>

				<div class="modal fade" id="confirm-delete" tabindex="-1">
			        <div class="modal-dialog">
			            <div class="modal-content">
			            
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    <h4 class="modal-title" id="myModalLabel">Xác nhận</h4>
			                </div>
			            
			                <div class="modal-body">
			                    <p>Bạn chắc chứ?</p>
			                    <p class="debug-url"></p>
			                </div>
			                
			                <div class="modal-footer">
			                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
			                    <a class="btn btn-danger btn-ok">OK</a>
			                </div>
			            </div>
			        </div>
			    </div>

				<div class="modal fade" id="modal-message" tabindex="-1">
			        <div class="modal-dialog">
			            <div class="modal-content">
			            
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    <h4 class="modal-title" id="myModalLabel">Xóa thất bại, vui lòng thử lại sau</h4>
			                </div>
			            
			                <div class="modal-body"><p></p></div>
			                
			                <div class="modal-footer">
			                    <a class="btn btn-primary" data-dismiss="modal">OK</a>
			                </div>
			            </div>
			        </div>
			    </div>

			</section>
		</div>

	</section>

	<!-- Vendor -->
	<script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
	<script src="public/octopus/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="public/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="public/octopus/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="public/octopus/assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="public/octopus/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
	
	<!-- Specific Page Vendor -->
	<script src="public/octopus/assets/vendor/select2/select2.js"></script>
	<script src="public/octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
	<script src="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
	<script src="public/octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
	<script src="public/octopus/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<script src="public/octopus/assets/vendor/isotope/jquery.isotope.js"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script src="public/octopus/assets/javascripts/theme.js"></script>
	
	<!-- Theme Custom -->
	<script src="public/octopus/assets/javascripts/theme.custom.js"></script>
	
	<!-- Theme Initialization Files -->
	<script src="public/octopus/assets/javascripts/theme.init.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="public/js/jquery.table2excel.js"></script>
	
    <script src="public/js/jquery.popupWindow.js"></script>

    <!-- Tiny MCE -->
    <script src="public/tinymce/tinymce.min.js"></script>

	<?php echo $__env->yieldContent('extra-script'); ?>

	<script type="text/javascript">
	(function( $ ) {

	  'use strict';

	  $(function() {
	  	if(typeof datatableInit != 'undefined')
		    datatableInit();

	  	if(typeof EditableTable != 'undefined')
		    EditableTable.initialize();

	  });
	}).apply( this, [ jQuery ]);

    var IdDelete = 0;
    var del_url;
    $('.delete').on('click', function (e) {
        IdDelete = $(this).attr('data-id');
		del_url = $(this).attr('href');
        e.preventDefault();
        $('#confirm-delete').modal("show");
    });

    $('.btn-ok').on('click', function (e) {
        if (del_url != '') {
            $.ajax({
                type: 'get',
                url: del_url,
            }).done(function(data){
                if(data > 0){
                    location.reload(true);
                }else{
                    alert("Không áp dụng được với dữ liệu này");
                }
            });
        }
        $('#confirm-delete').modal("hide");
    });

    var loadImg = function(event){
        $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
    };

    jQuery(document).ready(function(e) {
	    datalang = document.getElementById("langfont").value;
	    var lang;
	    switch(datalang) {
		  case 'vn':
		    lang = 'vi';
		    break;
		  case 'kr':
		    lang = 'ko_KR';
		    break;
		  default:
		    lang = 'en';
		}

	    tinymce.init({
	        selector: '.mce_full',
	        language: lang,
	        height: 500,
	        theme: 'modern',
	        plugins: [
	            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	            'searchreplace wordcount visualblocks visualchars code fullscreen',
	            'insertdatetime media nonbreaking save table contextmenu directionality',
	            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
	        ],
	        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
	        image_advtab: true,
	        templates: [
	            { title: 'Test template 1', content: 'Test 1' },
	            { title: 'Test template 2', content: 'Test 2' }
	        ],
	        file_picker_callback : elFinderBrowser
	    });
	    // }

	    // function tinyMceBasic(){
	    tinymce.init({
	        selector: '.mce_basic',
	        language: lang,
	        height: 100,
	        menubar: false,
	        plugins: [
	            'advlist autolink lists link image charmap print preview anchor',
	            'searchreplace visualblocks code fullscreen',
	            'insertdatetime media table contextmenu paste code'
	        ],
	        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	    });
	    // }

	    tinymce.init({
	        selector: '.mceu_full',
	        language: lang,
	        height: 500,
	        theme: 'modern',
	        plugins: [
	            'advlist autolink lists link image preview hr pagebreak',
	            'searchreplace wordcount visualblocks visualchars',
	            'insertdatetime media nonbreaking save table contextmenu directionality',
	            'paste textcolor colorpicker textpattern imagetools codesample toc'
	        ],
	        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	        toolbar2: 'preview media | forecolor backcolor',
	        image_advtab: true,
	        file_picker_callback : elFinderBrowser,
	    });

	    tinymce.init({
	        selector: '.mceu_basic',
	        height: 100,
	        menubar: false,
	        allow_html_in_named_anchor: false,
	        // font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n'
	        plugins: [
	            'advlist autolink lists link print preview',
	            'searchreplace visualblocks code fullscreen',
	            'insertdatetime table contextmenu paste code'
	        ],
	        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
	    });

	    tinymce.init({
	        selector: '.mce_voice',
	        lang: lang,
	        theme: 'modern',
	        plugins: [
	            'advlist autolink lists link image preview hr anchor pagebreak',
	            'searchreplace wordcount visualblocks visualchars code fullscreen',
	            'insertdatetime media nonbreaking save table contextmenu directionality',
	            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
	        ],
	        toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	        toolbar2: 'preview media | forecolor backcolor | help',
	        image_advtab: true,
	        file_picker_callback : elFinderBrowser
	    });

	    function elFinderBrowser (callback, value, meta) {
	        tinymce.activeEditor.windowManager.open({
	            file: 'public/elfinder/elfinder.php',// use an absolute path!
	            title: 'File Management',
	            width: 900,
	            height: 450,
	            // resizable: 'yes',
	            lang: lang,
	        }, {
	            oninsert: function (file, elf) {
	                var url, reg, info;
	                // URL normalization
	                url = file.url;
	                reg = /\/[^/]+?\/\.\.\//;
	                while(url.match(reg)) {
	                    url = url.replace(reg, '/');
	                }
	                // Make file info
	                info = file.name + ' (' + elf.formatSize(file.size) + ')';
	                // Provide file and text for the link dialog
	                if (meta.filetype == 'file') {
	                    callback(url, {text: info, title: info});
	                }
	                // Provide image and alt text for the image dialog
	                if (meta.filetype == 'image') {
	                    callback(url, {alt: info});
	                }
	                // Provide alternative source and posted for the media dialog
	                if (meta.filetype == 'media') {
	                    callback(url);
	                }
	            }
	        });
	        return false;
	    }

	    //Brow server image upload
	    if($('.mediaUpload').length){
	        $('.mediaUpload').popupWindow({
	            windowURL:'public/elfinder2/standalone-elfinder.php?mode=audio',
	            windowName:'Filebrowser',
	            height:490,
	            width:950,
	            centerScreen:1
	        });
	    }

	    //Brow server image upload
	    if($('.imageUpload').length){
	        $('.imageUpload').popupWindow({
	            windowURL:'public/elfinder2/standalone-elfinder.php?mode=image',
	            windowName:'Filebrowser',
	            height:490,
	            width:950,
	            centerScreen:1
	        });
	    }

	    if($('.iconUpload').length){
	        $('.iconUpload').popupWindow({
	            windowURL:'public/elfinder2/standalone-elfinder.php?mode=icon',
	            windowName:'Filebrowser',
	            height:490,
	            width:950,
	            centerScreen:1
	        });
	    }

	    $('.btn-delete').click(function(){
	        if(confirm('Bạn chắc chắn muốn thực hiện hành động?')){
	            var del_url = $(this).attr('href');
	            $.ajax({
	                type: 'get',
	                url: del_url,
	                context: this
	            }).done(function(data){
	                if(data > 0){
	                    $(this).parent().parent().hide('slow');
	                }else{
	                    alert('Không áp dụng được với dữ liệu này');
	                }
	            });
	        }
	        return false;
	    });

	    $('.menu-bar').click(function(){
	        $('.side-bar').toggle('slow');
	    });

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	});

	</script>
</body>
</html><?php /**PATH D:\laragon\www\nhomdaiviet\resources\views/cms/master/default.blade.php ENDPATH**/ ?>
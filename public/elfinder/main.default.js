"use strict";
/**
 * elFinder client options and main script for RequireJS
 *
 * Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things. And use that in elfinder.html.
 * e.g. `<script data-main="./main.js" src="./require.js"></script>`
 **/
(function(){
	var // jQuery and jQueryUI version
		jqver = '3.2.1',
		uiver = '1.12.1',
		// Detect language (optional)
		lang = (function() {
			var locq = window.location.search,
				fullLang, locm, lang;
			if (locq && (locm = locq.match(/lang=([a-zA-Z_-]+)/))) {
				// detection by url query (?lang=xx)
				fullLang = locm[1];
			} else {
				// detection by browser language
				fullLang = (navigator.browserLanguage || navigator.language || navigator.userLanguage);
			}
			lang = fullLang.substr(0,2);
			if (lang === 'ja') lang = 'jp';
			else if (lang === 'pt') lang = 'pt_BR';
			else if (lang === 'ug') lang = 'ug_CN';
			else if (lang === 'zh') lang = (fullLang.substr(0,5).toLowerCase() === 'zh-tw')? 'zh_TW' : 'zh_CN';
			return lang;
		})(),
		
		// elFinder options (REQUIRED)
		// Documentation for client options:
		// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
		opts = {
			getFileCallback : function(file, fm) {
				// pass selected file data to TinyMCE
				parent.tinymce.activeEditor.windowManager.getParams().oninsert(file, fm);
				// close popup window
				parent.tinymce.activeEditor.windowManager.close();
			},
			uiOptions: {
	            // toolbar configuration
	            toolbar: [
	                ['home', 'back', 'forward', 'up', 'reload'],
	                ['mkdir', 'mkfile', 'upload'],
	                ['download', 'getfile'],
	                ['undo', 'redo'],
	                ['copy', 'cut', 'paste'],
	                ['duplicate', 'rename', 'edit', 'resize', 'chmod'],
	                ['selectall', 'selectnone', 'selectinvert'],
	                ['quicklook', 'info'],
	                ['search'],
	                ['view', 'sort'],
	                ['fullscreen']
	            ]
	        },
	        contextmenu: {
	            // navbarfolder menu
	            navbar: ['download', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', '|', 'rename', '|', 'places', 'info', 'chmod', 'netunmount'],
	            // current directory menu
	            cwd: ['undo', 'redo', '|', 'back', 'up', 'reload', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', '|', 'view', 'sort', 'selectall', 'colwidth', '|', 'info', '|', 'fullscreen', '|'],
	            // current directory file menu
	            files: ['getfile', '|', 'download', 'opendir', 'quicklook', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'empty', '|', 'rename', 'edit', 'resize', '|', 'archive', 'extract', '|', 'selectall', 'selectinvert', '|', 'places', 'info', 'chmod', 'netunmount']
	        },
			url : 'php/connector.php', // connector URL (REQUIRED)
			lang: lang,                         // auto detected language (optional)
			handlers : {
			    // Auto crop OR Auto resize
			    upload : function(e, fm) {
			        var uploadedFiles = e.data.added,
			            mode = {
			                resize: {
			                    mode: 'resize',
			                    width: 1450,
			                    height: 1450,
			                    quality: 80
			                },
			            };
			        if (uploadedFiles.length) {
			            $.each(uploadedFiles, function() {
			                if (this.read && this.write && this.mime.indexOf('image/') !== -1) {
			                    fm.request($.extend(
			                        {
			                            cmd: 'resize',
			                            target: this.hash
			                        },
			                        mode['resize'] /* or mode['resize'] */
			                    ));
			                }
			            });
			        }
			    }
			}
		},
		
		// Start elFinder (REQUIRED)
		start = function(elFinder) {
			// load jQueryUI CSS
			elFinder.prototype.loadCss('//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/themes/smoothness/jquery-ui.css');
			
			$(function() {
				// Optional for Japanese decoder "extras/encoding-japanese.min"
				if (window.Encoding && Encoding.convert) {
					elFinder.prototype._options.rawStringDecoder = function(s) {
						return Encoding.convert(s,{to:'UNICODE',type:'string'});
					};
				}
				// Make elFinder (REQUIRED)
				$('#elfinder').elfinder(opts);
			});
		},
		
		// JavaScript loader (REQUIRED)
		load = function() {
			require(
				[
					'elfinder'
					, (lang !== 'en')? 'elfinder.lang' : null    // load detected language
				//	, 'extras/quicklook.googledocs'              // optional preview for GoogleApps contents on the GoogleDrive volume
				//	, (lang === 'jp')? 'extras/encoding-japanese.min' : null // optional Japanese decoder for archive preview
				],
				start,
				function(error) {
					alert(error.message);
				}
			);
		},
		
		// is IE8? for determine the jQuery version to use (optional)
		ie8 = (typeof window.addEventListener === 'undefined' && typeof document.getElementsByClassName === 'undefined');

	// config of RequireJS (REQUIRED)
	require.config({
		baseUrl : 'js',
		paths : {
			'jquery'   : '//cdnjs.cloudflare.com/ajax/libs/jquery/'+(ie8? '1.12.4' : jqver)+'/jquery.min',
			'jquery-ui': '//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/jquery-ui.min',
			'elfinder' : 'elfinder.full',
			'elfinder.lang': [
				'i18n/elfinder.'+lang,
				'i18n/elfinder.fallback'
			]
		},
		waitSeconds : 10 // optional
	});

	// load JavaScripts (REQUIRED)
	load();

})();

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//cronjob
Route::get('backup_tables', 'Controller@backup_tables');

//Admin CMS
Route::group(['middleware' => 'locale'], function(){
	
	Route::get('resetPassword/{token?}', 'Cms\UserController@getResetPassword')->name('resetpass');
	Route::post('resetPassword/{token}', 'Cms\UserController@postResetPassword');

	Route::group(['prefix' => 'cms'], function(){
    Route::get('change-language/{language}', 'Cms\UserController@changeLanguage')->name('user.change-language');
    Route::get('change-post-lang/{language}', 'Cms\UserController@changeLanguagePost')->name('user.change-post-lang');

    // Route::get('change-push/{id}', 'Cms\SmsController@changePush')->name('sms.change-push');
		Route::get('login', 'Cms\UserController@getLoginAdmin')->name('login');
		Route::post('login', 'Cms\UserController@postLoginAdmin')->middleware("throttle:5,10");
		Route::get('recover', 'Cms\UserController@getRecoverAdmin');
		Route::post('recover', 'Cms\UserController@postRecoverAdmin');
		Route::get('readmess', 'Cms\HomeController@getreadmess');
		Route::group(['middleware' => ['adminLogin', 'langpost']], function(){
			Route::get('/', 'Cms\HomeController@getHome');
			Route::get('logout', 'Cms\UserController@getLogoutAdmin');
			Route::get('message/show', 'Cms\HomeController@getMessenger');
			Route::get('setting', 'Cms\HomeController@getSetting');
			Route::post('setting', 'Cms\HomeController@postSetting');

			Route::group(['prefix' => 'user'], function(){
				Route::get('list', 'Cms\UserController@getList');
				Route::get('add', 'Cms\UserController@getAdd');
				Route::post('add', 'Cms\UserController@postAdd');
				Route::get('edit/{id}', 'Cms\UserController@getEdit');
				Route::post('edit/{id}', 'Cms\UserController@postEdit');
				Route::get('delete/{id}', 'Cms\UserController@getDelete');
			});

			Route::group(['prefix' => 'notified'], function(){
				Route::get('list', 'Cms\NotificationController@getList');
				Route::get('detail/{id}', 'Cms\NotificationController@getDetail');
				Route::post('detail/{id}', 'Cms\NotificationController@postDetail');
				Route::get('delete/{id}', 'Cms\NotificationController@getDelete');
			});

			Route::group(['prefix' => 'danh-muc'], function(){
				Route::get('list', 'Cms\CateProductController@getList');
				Route::post('list', 'Cms\CateProductController@postList');
				Route::get('edit/{id}', 'Cms\CateProductController@getEdit');
				Route::post('edit/{id}', 'Cms\CateProductController@postEdit');
				Route::get('delete/{id}', 'Cms\CateProductController@getDelete');
			});

			Route::group(['prefix' => 'tin-tuc'], function(){
				Route::get('list', 'Cms\NewController@getList');
				Route::get('add', 'Cms\NewController@getAdd');
				Route::post('add', 'Cms\NewController@postAdd');
				Route::get('edit/{id}', 'Cms\NewController@getEdit');
				Route::post('edit/{id}', 'Cms\NewController@postEdit');
				Route::get('delete/{id}', 'Cms\NewController@getDelete');
			});

			Route::group(['prefix' => 'page'], function(){
				Route::get('list', 'Cms\PageController@getList');
				Route::get('add', 'Cms\PageController@getAdd');
				Route::post('add', 'Cms\PageController@postAdd');
				Route::get('edit/{id}', 'Cms\PageController@getEdit');
				Route::post('edit/{id}', 'Cms\PageController@postEdit');
				Route::get('delete/{id}', 'Cms\PageController@getDelete');
			});

			Route::group(['prefix' => 'san-pham'], function(){
				Route::get('list', 'Cms\ProductController@getList');
				Route::get('add', 'Cms\ProductController@getAdd');
				Route::post('add', 'Cms\ProductController@postAdd');
				Route::get('edit/{id}', 'Cms\ProductController@getEdit');
				Route::post('edit/{id}', 'Cms\ProductController@postEdit');
				Route::get('delete/{id}', 'Cms\ProductController@getDelete');
			});

			Route::group(['prefix' => 'don-hang'], function(){
				Route::get('list', 'Cms\OrderController@getList');
				Route::get('add', 'Cms\OrderController@getAdd');
				Route::post('add', 'Cms\OrderController@postAdd');
				Route::get('edit/{id}', 'Cms\OrderController@getEdit');
				Route::post('edit/{id}', 'Cms\OrderController@postEdit');
				Route::get('delete/{id}', 'Cms\OrderController@getDelete');
			});

		});
	});
});

//Site
Route::group(['middleware' => 'users'], function(){
	Route::group(['prefix' => 'gio-hang'], function(){
		Route::get('/', 'Site\HomeController@getcart');
		Route::post('/', 'Site\HomeController@postpayment');	
		Route::post('{slug?}', 'Site\HomeController@postcart')->where('slug', '.*');
	});
	Route::get('tim-kiem','Site\HomeController@getSearch');
	Route::get('lien-he','Site\HomeController@getContact');
	Route::post('lien-he','Site\HomeController@postContact');
	Route::group(['prefix' => 'tai-khoan'], function(){
		Route::get('quan-ly','Site\UserController@getUserInfo');
		Route::post('quan-ly','Site\UserController@postUserInfo');
		Route::get('dang-nhap','Site\UserController@getLogin');
		Route::post('dang-nhap','Site\UserController@postLogin');
		Route::get('dang-xuat','Site\UserController@getLogout');
		Route::get('dang-ky','Site\UserController@getRegister');
		Route::post('dang-ky','Site\UserController@postRegister');
		Route::post('phuc-hoi','Site\UserController@postRecover');
		Route::get('xac-thuc/{key?}','Site\UserController@getActiceAccount');
		Route::post('xac-thuc/{key?}','Site\UserController@postActiceAccount');
	});

	Route::get('auth/google','Site\UserController@googlepage');
	Route::get('auth/google/callback','Site\UserController@googlecallback');
	Route::get('auth/facebook','Site\UserController@facebookpage');
	Route::get('auth/facebook/callback','Site\UserController@facebookcallback');
	Route::get('auth/facebook/deletion','Site\UserController@facebookdeleteioncallback');
	Route::get('auth/zalo','Site\UserController@zalopage');
	Route::get('auth/zalo/callback','Site\UserController@zalocallback');

	Route::get('test', 'Site\HomeController@getTest');

	Route::get('/{slug?}', 'Site\HomeController@getHome')->where('slug', '.*');
});
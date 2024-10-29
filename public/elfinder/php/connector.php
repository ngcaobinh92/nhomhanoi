<?php

error_reporting(0); // Set E_ALL for debuging

// load composer autoload before load elFinder autoload If you need composer
//require './vendor/autoload.php';

// elFinder autoload
require './autoload.php';
// ===============================================

// Enable FTP connector netmount
elFinder::$netDrivers['ftp'] = 'FTP'; 
// ===============================================

// // Required for Dropbox network mount
// // Installation by composer
// // `composer require kunalvarma05/dropbox-php-sdk`
// // Enable network mount
// elFinder::$netDrivers['dropbox2'] = 'Dropbox2';
// // Dropbox2 Netmount driver need next two settings. You can get at https://www.dropbox.com/developers/apps
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=dropbox2&host=1"
// define('ELFINDER_DROPBOX_APPKEY',    '');
// define('ELFINDER_DROPBOX_APPSECRET', '');
// ===============================================

// // Required for Google Drive network mount
// // Installation by composer
// // `composer require google/apiclient:^2.0`
// // Enable network mount
// elFinder::$netDrivers['googledrive'] = 'GoogleDrive';
// // GoogleDrive Netmount driver need next two settings. You can get at https://console.developers.google.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=googledrive&host=1"
// define('ELFINDER_GOOGLEDRIVE_CLIENTID',     '');
// define('ELFINDER_GOOGLEDRIVE_CLIENTSECRET', '');
// // Required case of without composer
// define('ELFINDER_GOOGLEDRIVE_GOOGLEAPICLIENT', '/path/to/google-api-php-client/vendor/autoload.php');
// ===============================================

// // Required for Google Drive network mount with Flysystem
// // Installation by composer
// // `composer require nao-pon/flysystem-google-drive:~1.1 nao-pon/elfinder-flysystem-driver-ext`
// // Enable network mount
// elFinder::$netDrivers['googledrive'] = 'FlysystemGoogleDriveNetmount';
// // GoogleDrive Netmount driver need next two settings. You can get at https://console.developers.google.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=googledrive&host=1"
// define('ELFINDER_GOOGLEDRIVE_CLIENTID',     '');
// define('ELFINDER_GOOGLEDRIVE_CLIENTSECRET', '');
// ===============================================

// // Required for One Drive network mount
// //  * cURL PHP extension required
// //  * HTTP server PATH_INFO supports required
// // Enable network mount
// elFinder::$netDrivers['onedrive'] = 'OneDrive';
// // GoogleDrive Netmount driver need next two settings. You can get at https://dev.onedrive.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL/netmount/onedrive/1"
// define('ELFINDER_ONEDRIVE_CLIENTID',     '');
// define('ELFINDER_ONEDRIVE_CLIENTSECRET', '');
// ===============================================

// // Required for Box network mount
// //  * cURL PHP extension required
// // Enable network mount
// elFinder::$netDrivers['box'] = 'Box';
// // Box Netmount driver need next two settings. You can get at https://developer.box.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL"
// define('ELFINDER_BOX_CLIENTID',     '');
// define('ELFINDER_BOX_CLIENTSECRET', '');
// ===============================================

/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from '.' (dot)
 *
 * @param  string    $attr    attribute name (read|write|locked|hidden)
 * @param  string    $path    absolute file path
 * @param  string    $data    value of volume option `accessControlData`
 * @param  object    $volume  elFinder volume driver object
 * @param  bool|null $isDir   path is directory (true: directory, false: file, null: unknown)
 * @param  string    $relpath file path relative to volume root directory started with directory separator
 * @return bool|null
 **/



function access($attr, $path, $data, $volume, $isDir, $relpath) {

	$basename = basename($path);
	return basename($path)[0] === '.'            // if file/folder begins with '.' (dot) with out volume root
			 && strlen($relpath) !== 1
		? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
		:  null;                                 // else elFinder decide it itself
}

// Documentation for connector options:
// https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options

$opts = array(
	// 'debug' => true,

	'bind' => array(
		'upload.presave' => array(
			'Plugin.Watermark.onUpLoadPreSave'
		)
	),
	'roots' => array(
		// Items volume
		array(
			'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
			'path'          => '../../../public/media/',                 // path to files (REQUIRED)
			'URL'           => '/public/media/',//dirname($_SERVER['PHP_SELF']) . '/../files/', // URL to files (REQUIRED) 
			'trashHash'     => 't1_Lw',                     // elFinder's hash of trash folder
			'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
			'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
			'uploadAllow'   => array('all'),// Mimetype `image` and `text/plain` allowed to upload
			'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
			'accessControl' => 'access',                     // disable and hide dot starting files (OPTIONAL)
			'utf8fix'    => true,
			'fileMode'     => 0666,         // new files mode
			'dirMode'      => 0777,         // new folders mode
			'tmbPathMode'      => 0777,
			'plugin' => array(
				'Watermark' => array(
		 			'enable'         => true,       // For control by volume driver
					'source'         => '../../../public/img/watermark.png', // Path to Water mark image
					'marginRight'    => 5,          // Margin right pixel
					'marginBottom'   => 5,          // Margin bottom pixel
					'quality'        => 100,         // JPEG image save quality
					'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
					'targetMinPixel' => 200,        // Target image minimum pixel size
					'interlace'      => IMG_GIF|IMG_JPG, // Set interlacebit image formats ( bit-field )
					'offDropWith'    => null        // To disable it if it is dropped with pressing the meta key
					                                // Alt: 8, Ctrl: 4, Meta: 2, Shift: 1 - sum of each value
					                                // In case of using any key, specify it as an array
				)
			),
		),
		// Trash volume
		array(
			'id'       		=> 1,
			'driver'        => 'Trash',
			'path'          => '../../../public/trash/',                 // path to files (REQUIRED)
			'URL'           => '/public/trash',//dirname($_SERVER['PHP_SELF']) . '/../files/', // URL to files (REQUIRED) 
			'tmbURL'        => '/public/trash',
			'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
			'uploadDeny'    => array('all'),                // Recomend the same settings as the original volume that uses the trash
			'uploadAllow'   => array('all'),// Mimetype `image` and `text/plain` allowed to upload
			'uploadOrder'   => array('deny', 'allow'),      // Same as above
			'accessControl' => null,                    // Same as above
		)
	)
);

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

// function debug($var) {
//     ob_start();
//     //debug_print_backtrace();
//     var_dump($var);
//     $out = ob_get_clean();
//     file_put_contents('PATH_TO/debug.txt', $out . "\n", FILE_APPEND);
// }
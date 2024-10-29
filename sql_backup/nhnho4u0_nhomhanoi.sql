-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for nhnho4u0_nhomhanoi
DROP DATABASE IF EXISTS `nhnho4u0_nhomhanoi`;
CREATE DATABASE IF NOT EXISTS `nhnho4u0_nhomhanoi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `nhnho4u0_nhomhanoi`;

-- Dumping structure for table nhnho4u0_nhomhanoi.cms_notification
DROP TABLE IF EXISTS `cms_notification`;
CREATE TABLE IF NOT EXISTS `cms_notification` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int NOT NULL DEFAULT '0',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `parent` (`parent`),
  KEY `title` (`title`(191))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhnho4u0_nhomhanoi.cms_notification: ~3 rows (approximately)
INSERT IGNORE INTO `cms_notification` (`id`, `user_id`, `title`, `parent`, `content`, `status`, `created_at`, `updated_at`) VALUES
	(1, 64, 'ngcaobinh92@yahoo.com.vn - Bình nguyễn', 0, '12313', 1, '2022-03-04 03:29:14', '2022-03-04 03:29:14'),
	(2, 2, 'ngcaobinh92@yahoo.com.vn - Bình nguyễn', 0, 'ABC1234', 0, '2022-03-04 03:29:53', '2022-03-04 03:32:24'),
	(3, 64, 'ngcaobinh92@yahoo.com.vn - Bình nguyễn', 0, '13123', 1, '2022-03-04 03:35:24', '2022-03-04 03:35:24');

-- Dumping structure for table nhnho4u0_nhomhanoi.cms_site_menu
DROP TABLE IF EXISTS `cms_site_menu`;
CREATE TABLE IF NOT EXISTS `cms_site_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `require` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `translate` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `menu_id` int NOT NULL DEFAULT '0',
  `lang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'vn',
  `order` tinyint NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `translate` (`translate`),
  KEY `menu_id` (`menu_id`),
  KEY `order` (`order`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `status` (`status`),
  KEY `lang` (`lang`),
  KEY `title` (`title`) USING BTREE,
  KEY `url` (`url`),
  KEY `require` (`require`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table nhnho4u0_nhomhanoi.cms_site_menu: ~25 rows (approximately)
INSERT IGNORE INTO `cms_site_menu` (`id`, `title`, `url`, `require`, `translate`, `menu_id`, `lang`, `order`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Quản lí người dùng', 'user', '0', 'quan_ly_nguoi_dung', 0, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(2, 'Danh sách', 'list', '0', 'danh_sach', 1, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(3, 'Thêm mới', 'add', '0', 'them', 1, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(4, 'Chỉnh sửa', 'edit', '0', 'sua', 1, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(5, 'Xóa', 'delete', '0', 'xoa', 1, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(6, 'Quản lí tin nhắn', 'notified', '0', 'quan_ly_tin_nhan', 0, 'vn', 0, 0, '2019-07-10 00:03:04', NULL),
	(7, 'Danh sách', 'list', '0', 'danh_sach', 6, 'vn', 0, 0, '2019-07-10 00:03:04', NULL),
	(8, 'Chi tiết', 'detail', '0', 'chi_tiet', 6, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(9, 'Xóa', 'delete', '0', 'xoa', 6, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(10, 'Quản lý danh mục', 'danh-muc/list', '0', 'quan_ly_danh_muc', 0, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(13, 'Quản lý Sản phẩm', 'san-pham', '0', 'quan_ly_san_pham', 0, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(14, 'Quản lý tin tức', 'tin-tuc', '0', 'quan_ly_tin_tuc', 0, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(15, 'Thêm mới', 'add', '0', 'them', 14, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(16, 'Chỉnh sửa', 'edit', '0', 'sua', 14, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(17, 'Xóa', 'delete', '0', 'xoa', 14, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(18, 'Danh sách', 'list', '0', 'danh_sach', 14, 'vn', 1, 1, '2019-07-10 00:03:04', NULL),
	(19, 'Thêm mới', 'add', '0', 'them', 13, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(20, 'Chỉnh sửa', 'edit', '0', 'sua', 13, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(21, 'Xóa', 'delete', '0', 'xoa', 13, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(22, 'Danh sách', 'list', '0', 'danh_sach', 13, 'vn', 1, 1, '2021-06-07 00:03:04', NULL),
	(23, 'Quản lý Trang', 'page', '0', 'quan_ly_bai_viet', 0, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(28, 'Thêm mới', 'add', '0', 'them', 23, 'vn', 0, 1, '2019-07-10 00:03:04', NULL),
	(29, 'Chỉnh sửa', 'edit', '0', 'sua', 23, 'vn', 0, 0, '2021-04-14 14:33:24', NULL),
	(31, 'Danh sách', 'list', '0', 'danh_sach', 23, 'vn', 1, 1, '2021-06-07 00:03:04', NULL),
	(32, 'Xóa', 'delete', '0', 'xoa', 23, 'vn', 0, 0, '2021-04-14 14:33:24', NULL);

-- Dumping structure for table nhnho4u0_nhomhanoi.language
DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `lang_id` int NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(10) NOT NULL,
  `lang_name` text NOT NULL,
  `lang_order` int NOT NULL DEFAULT '0',
  `lang_flag` text NOT NULL,
  `lang_theme` tinyint(1) DEFAULT '1',
  `lang_post` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`lang_id`),
  KEY `lang_theme` (`lang_theme`),
  KEY `lang_post` (`lang_post`),
  KEY `lang_order` (`lang_order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table nhnho4u0_nhomhanoi.language: ~3 rows (approximately)
INSERT IGNORE INTO `language` (`lang_id`, `lang_code`, `lang_name`, `lang_order`, `lang_flag`, `lang_theme`, `lang_post`) VALUES
	(1, 'en', 'English', 0, 'gb-eng.svg', 0, 0),
	(2, 'kr', '대한민국\r\n', 1, 'kr.svg', 0, 0),
	(3, 'vn', 'Việt Nam', 2, 'vn.svg', 1, 1);

-- Dumping structure for table nhnho4u0_nhomhanoi.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`(191)),
  KEY `token` (`token`(191)),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhnho4u0_nhomhanoi.password_resets: ~0 rows (approximately)

-- Dumping structure for table nhnho4u0_nhomhanoi.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `title` (`title`(191)),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table nhnho4u0_nhomhanoi.roles: ~6 rows (approximately)
INSERT IGNORE INTO `roles` (`id`, `title`, `status`) VALUES
	(0, 'Admin', 1),
	(1, 'Moderator', 1),
	(2, 'Employee', 1),
	(3, 'Saler', 1),
	(4, 'Content Manager', 1),
	(5, 'Normal User', 1);

-- Dumping structure for table nhnho4u0_nhomhanoi.site_comment
DROP TABLE IF EXISTS `site_comment`;
CREATE TABLE IF NOT EXISTS `site_comment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` enum('public','private','delete') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'public',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `name` (`name`),
  KEY `post_id` (`post_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table nhnho4u0_nhomhanoi.site_comment: ~2 rows (approximately)
INSERT IGNORE INTO `site_comment` (`id`, `post_id`, `name`, `email`, `content`, `status`, `created_at`, `updated_at`) VALUES
	(1, 33, 'Bình', 'ngcaobinh1992@gmail.com', 'ản phẩm rất tốt. Mình sẽ liên hệ phía công ty để đặt hàng', 'public', '2017-06-08 10:35:42', '2017-06-08 10:35:42'),
	(2, 33, 'Minh Nguyễn', 'minhnt@gmail.com', 'Sản phẩm rất tốt. Sẽ tiếp tục ủng hộ quý công ty', 'public', '2017-04-11 07:35:42', '2017-04-11 07:35:42');

-- Dumping structure for table nhnho4u0_nhomhanoi.site_configs
DROP TABLE IF EXISTS `site_configs`;
CREATE TABLE IF NOT EXISTS `site_configs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `zalo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hotline` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `google_map` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `twitter` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `showroom` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `factory` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `google_plus` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zalo` (`zalo`),
  KEY `facebook` (`facebook`),
  KEY `hotline` (`hotline`),
  KEY `email` (`email`),
  KEY `twitter` (`twitter`),
  KEY `google_plus` (`google_plus`),
  KEY `pinterest` (`pinterest`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table nhnho4u0_nhomhanoi.site_configs: ~0 rows (approximately)
INSERT IGNORE INTO `site_configs` (`id`, `zalo`, `facebook`, `hotline`, `address`, `email`, `google_map`, `twitter`, `showroom`, `factory`, `google_plus`, `pinterest`) VALUES
	(1, NULL, 'NhomHaNoi', '0969297874', 'Số 18 ngõ 45 Đường Vũ Đức Thận, Phường Việt Hưng, Quận Long Biên, TP. Hà Nội', 'phanphoinhomhn@gmail.com', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.419453074772!2d105.88969991429826!3d21.055902892228453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a99b8bb84e67%3A0x76a816e956f5781b!2zMTggTmfDtSA0NSwgVmnhu4d0IEjGsG5nLCBMb25nIEJpw6puLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2sus!4v1631202085627!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>', NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table nhnho4u0_nhomhanoi.site_post
DROP TABLE IF EXISTS `site_post`;
CREATE TABLE IF NOT EXISTS `site_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hot` tinyint(1) NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `content` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `featured_image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `thump_image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `type` enum('product','new','category','page','post') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'post',
  `status` enum('public','preview','delete') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'public',
  `translate` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'vn',
  `lang` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'vn',
  `view` int NOT NULL DEFAULT '0',
  `tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `order` int DEFAULT '0',
  `parent` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`) USING BTREE,
  KEY `lang` (`lang`),
  KEY `status` (`status`),
  KEY `type` (`type`),
  KEY `parent` (`parent`) USING BTREE,
  KEY `created_date` (`created_at`),
  KEY `updated_date` (`updated_at`),
  KEY `hot` (`hot`),
  KEY `translate` (`translate`),
  KEY `title` (`title`),
  KEY `view` (`view`),
  KEY `tags` (`tags`),
  KEY `order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table nhnho4u0_nhomhanoi.site_post: ~34 rows (approximately)
INSERT IGNORE INTO `site_post` (`id`, `title`, `slug`, `hot`, `description`, `content`, `featured_image`, `thump_image`, `type`, `status`, `translate`, `lang`, `view`, `tags`, `order`, `parent`, `created_at`, `updated_at`) VALUES
	(1, 'NHÔM VIỆT PHÁP', 'nhom-viet-phap', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 6, NULL, 0, 25, '2021-09-07 17:00:00', '2022-08-15 21:16:40'),
	(2, 'NHÔM XINGFA', 'nhom-xingfa', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 27, NULL, 1, 25, '2021-09-07 17:00:00', '2022-08-15 21:16:38'),
	(3, 'NHÔM BMA', 'nhom-bma', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 2, NULL, 0, 25, '2021-09-07 17:00:00', '2021-10-14 22:11:42'),
	(4, 'CỬA NHÔM VIỆT PHÁP', 'cua-nhom-viet-phap', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 9, NULL, 0, 25, '2021-09-07 17:00:00', '2024-03-16 08:01:25'),
	(5, 'Cửa đi mở quay Việt Pháp hệ 450', 'cua-di-mo-quay-viet-phap-he-450', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 11, NULL, 0, 4, '2021-09-07 17:00:00', '2024-03-16 08:01:31'),
	(6, 'Cửa sổ mở quay, hất Việt Pháp hệ 4400', 'cua-so-mo-quay-hat-viet-phap-he-4400', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 4, NULL, 0, 2, '2021-09-07 17:00:00', '2022-03-04 07:45:24'),
	(7, 'Cửa sổ lùa Việt Pháp hệ 2600', 'cua-so-lua-viet-phap-he-2600', 0, NULL, NULL, '/public/media/products/thanh-nhom-1.jpg', '/public/media/products/thanh-nhom-1.jpg', 'product', 'public', 'vn', 'vn', 24, NULL, NULL, 4, '2021-09-07 17:00:00', '2022-03-31 09:26:41'),
	(8, 'Cửa sổ lùa Việt Pháp hệ 48', 'cua-so-lua-viet-phap-he-48', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 2, NULL, 0, 4, '2021-09-07 17:00:00', '2021-10-14 22:11:00'),
	(9, 'CỬA NHÔM XINGFA', 'cua-nhom-xingfa', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 2, NULL, 0, 25, '2021-09-07 17:00:00', '2021-10-14 22:10:54'),
	(10, 'Cửa sổ mở quay, hất Xingfa hệ 55', 'cua-so-mo-quay-hat-xingfa-he-55', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 0, NULL, 0, 10, '2021-09-07 17:00:00', '2021-09-07 17:00:00'),
	(11, 'Cửa đi mở quay Xingfa hệ 55', 'cua-di-mo-quay-xingfa-he-55', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 0, NULL, 0, 10, '2021-09-07 17:00:00', '2021-09-07 17:00:00'),
	(12, 'Cửa sổ lùa Xingfa hệ 2001', 'cua-so-lua-xingfa-he-2001', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 0, NULL, 0, 10, '2021-09-07 17:00:00', '2021-09-07 17:00:00'),
	(13, 'Cửa xếp trượt Xingfa hệ 1500', 'cua-xep-truot-xingfa-he-1500', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 0, NULL, 0, 10, '2021-09-07 17:00:00', '2021-09-07 17:00:00'),
	(14, 'CỬA NHÔM BMA', 'cua-nhom-bma', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 6, NULL, 0, 25, '2021-09-07 17:00:00', '2024-03-16 08:01:12'),
	(15, 'HỆ MẶT DỰNG', 'he-mat-dung', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 2, NULL, 0, 25, '2021-09-07 17:00:00', '2021-10-14 22:11:47'),
	(16, 'NHÔM CÔNG NGHIỆP', 'nhom-cong-nghiep', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 3, NULL, 0, 25, '2021-09-07 17:00:00', '2021-10-14 22:10:58'),
	(17, 'NAN CỬA CUỐN', 'nan-cua-cuon', 0, NULL, NULL, '/public/media/avatars/176015011_1165839160534269_4911247829720177260_n.jpg', '/public/media/avatars/176015011_1165839160534269_4911247829720177260_n.jpg', 'category', 'public', 'vn', 'vn', 2, NULL, 0, 25, '2021-09-07 17:00:00', '2021-10-14 22:10:35'),
	(18, 'Khuyến mại', 'khuyen-mai', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 7, NULL, 0, 0, '2021-09-07 17:00:00', '2024-03-16 08:02:14'),
	(19, 'Tin tức', 'tin-tuc', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 16, NULL, 0, 0, '2021-09-07 17:00:00', '2024-03-16 08:00:47'),
	(21, 'ĐIỀU KHOẢN DỊCH VỤ', 'dieu-khoan-dich-vu', 0, NULL, '<p style="text-align: justify;">Khi quý khách truy cập vào trang web của chúng tôi có nghĩa là quý khách đồng ý với các điều khoản này. Trang web có quyền thay đổi, chỉnh sửa, thêm hoặc lược bỏ bất kỳ phần nào trong Quy định và Điều kiện sử dụng, vào bất cứ lúc nào. Các thay đổi có hiệu lực ngay khi được đăng trên trang web mà không cần thông báo trước. Và khi quý khách tiếp tục sử dụng trang web, sau khi các thay đổi về quy định và điều kiện được đăng tải, có nghĩa là quý khách chấp nhận với những thay đổi đó.</p>\r\n<p style="text-align: justify;">Quý khách vui lòng kiểm tra thường xuyên để cập nhật những thay đổi của chúng tôi.</p>\r\n<p style="text-align: justify;"><strong>1. Hướng dẫn sử dụng web</strong></p>\r\n<p style="text-align: justify;">- Khi vào web của chúng tôi, người dùng tối thiểu phải 18 tuổi hoặc truy cập dưới sự giám sát của cha mẹ hay người giám hộ hợp pháp.</p>\r\n<p style="text-align: justify;">- Chúng tôi cấp giấy phép sử dụng để bạn có thể mua sắm trên web trong khuôn khổ điều khoản và điều kiện sử dụng đã đề ra.</p>\r\n<p style="text-align: justify;">- Nghiêm cấm sử dụng bất kỳ phần nào của trang web này với mục đích thương mại hoặc nhân danh bất kỳ đối tác thứ ba nào nếu không được chúng tôi cho phép bằng văn bản. Nếu vi phạm bất cứ điều nào trong đây, chúng tôi sẽ hủy giấy phép của bạn mà không cần báo trước.</p>\r\n<p style="text-align: justify;">- Trang web này chỉ dùng để cung cấp thông tin sản phẩm chứ chúng tôi không phải nhà sản xuất nên những nhận xét hiển thị trên web là ý kiến cá nhân của khách hàng, không phải của chúng tôi.</p>\r\n<p style="text-align: justify;">- Quý khách phải đăng ký tài khoản với thông tin xác thực về bản thân và phải cập nhật nếu có bất kỳ thay đổi nào. Mỗi người truy cập phải có trách nhiệm với mật khẩu, tài khoản và hoạt động của mình trên web. Hơn nữa, quý khách phải thông báo cho chúng tôi biết khi tài khoản bị truy cập trái phép. Chúng tôi không chịu bất kỳ trách nhiệm nào, dù trực tiếp hay gián tiếp, đối với những thiệt hại hoặc mất mát gây ra do quý khách không tuân thủ quy định.</p>\r\n<p style="text-align: justify;">- Trong suốt quá trình đăng ký, quý khách đồng ý nhận email quảng cáo từ website. Sau đó, nếu không muốn tiếp tục nhận mail, quý khách có thể từ chối bằng cách nhấp vào đường link ở dưới cùng trong mọi email quảng cáo.</p>\r\n<p style="text-align: justify;"><strong>2. Chấp nhận đơn hàng và giá cả</strong></p>\r\n<p style="text-align: justify;">- Chúng tôi có quyền từ chối hoặc hủy đơn hàng của quý khách vì bất kỳ lý do gì vào bất kỳ lúc nào. Chúng tôi có thể hỏi thêm về số điện thoại và địa chỉ trước khi nhận đơn hàng.</p>\r\n<p style="text-align: justify;">- Chúng tôi cam kết sẽ cung cấp thông tin giá cả chính xác nhất cho người tiêu dùng. Tuy nhiên, đôi lúc vẫn có sai sót xảy ra, ví dụ như trường hợp giá sản phẩm không hiển thị chính xác trên trang web hoặc sai giá, tùy theo từng trường hợp chúng tôi sẽ liên hệ hướng dẫn hoặc thông báo hủy đơn hàng đó cho quý khách. Chúng tôi cũng có quyền từ chối hoặc hủy bỏ bất kỳ đơn hàng nào dù đơn hàng đó đã hay chưa được xác nhận hoặc đã bị thanh toán.</p>\r\n<p style="text-align: justify;"><strong>3. Thương hiệu và bản quyền</strong></p>\r\n<p style="text-align: justify;">- Mọi quyền sở hữu trí tuệ (đã đăng ký hoặc chưa đăng ký), nội dung thông tin và tất cả các thiết kế, văn bản, đồ họa, phần mềm, hình ảnh, video, âm nhạc, âm thanh, biên dịch phần mềm, mã nguồn và phần mềm cơ bản đều là tài sản của chúng tôi. Toàn bộ nội dung của trang web được bảo vệ bởi luật bản quyền của Việt Nam và các công ước quốc tế. Bản quyền đã được bảo lưu.</p>\r\n<p style="text-align: justify;"><strong>4. Quyền pháp lý</strong></p>\r\n<p style="text-align: justify;">- Các điều kiện, điều khoản và nội dung của trang web này được điều chỉnh bởi luật pháp Việt Nam và Tòa án có thẩm quyền tại Việt Nam sẽ giải quyết bất kỳ tranh chấp nào phát sinh từ việc sử dụng trái phép trang web này.</p>\r\n<p style="text-align: justify;"><strong>5. Quy định về bảo mật</strong></p>\r\n<p style="text-align: justify;">- Trang web của chúng tôi coi trọng việc bảo mật thông tin và sử dụng các biện pháp tốt nhất bảo vệ thông tin và việc thanh toán của quý khách. Thông tin của quý khách trong quá trình thanh toán sẽ được mã hóa để đảm bảo an toàn. Sau khi quý khách hoàn thành quá trình đặt hàng, quý khách sẽ thoát khỏi chế độ an toàn.</p>\r\n<p style="text-align: justify;">- Quý khách không được sử dụng bất kỳ chương trình, công cụ hay hình thức nào khác để can thiệp vào hệ thống hay làm thay đổi cấu trúc dữ liệu. Trang web cũng nghiêm cấm việc phát tán, truyền bá hay cổ vũ cho bất kỳ hoạt động nào nhằm can thiệp, phá hoại hay xâm nhập vào dữ liệu của hệ thống. Cá nhân hay tổ chức vi phạm sẽ bị tước bỏ mọi quyền lợi cũng như sẽ bị truy tố trước pháp luật nếu cần thiết.</p>\r\n<p style="text-align: justify;">- Mọi thông tin giao dịch sẽ được bảo mật nhưng trong trường hợp cơ quan pháp luật yêu cầu, chúng tôi sẽ buộc phải cung cấp những thông tin này cho các cơ quan pháp luật.</p>\r\n<p style="text-align: justify;"><strong>6. Thay đổi, hủy bỏ giao dịch tại website</strong></p>\r\n<p style="text-align: justify;">Trong mọi trường hợp, khách hàng đều có quyền chấm dứt giao dịch nếu đã thực hiện các biện pháp sau đây:</p>\r\n<p style="text-align: justify;">- Thông báo cho chúng tôi về việc hủy giao dịch qua đường dây nóng 0914 342 628</p>\r\n<p style="text-align: justify;">- Trả lại hàng hoá đã nhận nhưng chưa sử dụng hoặc hưởng bất kỳ lợi ích nào từ hàng hóa đó (theo quy định của chính sách đổi trả hàng).</p>', NULL, NULL, 'page', 'public', 'vn', 'vn', 7, NULL, NULL, 0, '2021-09-07 17:00:00', '2022-03-31 09:33:32'),
	(22, 'CHÍNH SÁCH', 'chinh-sach', 0, NULL, '<p style="text-align: justify;">Cám ơn quý khách đã quan tâm và truy cập vào website. Chúng tôi tôn trọng và cam kết sẽ bảo mật những thông tin mang tính riêng tư của Quý khách.</p>\r\n\r\n<p style="text-align: justify;">Chính sách bảo mật sẽ giải thích cách chúng tôi tiếp nhận, sử dụng và (trong trường hợp nào đó) tiết lộ thông tin cá nhân của Quý khách.</p>\r\n\r\n<p style="text-align: justify;">Bảo vệ dữ liệu cá nhân và gây dựng được niềm tin cho quý khách là vấn đề rất quan trọng với chúng tôi. Vì vậy, chúng tôi sẽ dùng tên và các thông tin khác liên quan đến quý khách tuân thủ theo nội dung của Chính sách bảo mật. Chúng tôi chỉ thu thập những thông tin cần thiết liên quan đến giao dịch mua bán.</p>\r\n\r\n<p style="text-align: justify;">Chúng tôi sẽ giữ thông tin của khách hàng trong thời gian luật pháp quy định hoặc cho mục đích nào đó. Quý khách có thể truy cập vào website và trình duyệt mà không cần phải cung cấp chi tiết cá nhân. Lúc đó, Quý khách đang ẩn danh và chúng tôi không thể biết bạn là ai nếu Quý khách không đăng nhập vào tài khoản của mình.</p>\r\n\r\n<p style="text-align: justify;"><strong>1. Thu thập thông tin cá nhân</strong></p>\r\n\r\n<p style="text-align: justify;">- Chúng tôi thu thập, lưu trữ và xử lý thông tin của bạn cho quá trình mua hàng và cho những thông báo sau này liên quan đến đơn hàng, và để cung cấp dịch vụ, bao gồm một số thông tin cá nhân: danh hiệu, tên, giới tính, ngày sinh, email, địa chỉ, địa chỉ giao hàng, số điện thoại, fax, chi tiết thanh toán, chi tiết thanh toán bằng thẻ hoặc chi tiết tài khoản ngân hàng.</p>\r\n\r\n<p style="text-align: justify;">- Chúng tôi sẽ dùng thông tin quý khách đã cung cấp để xử lý đơn đặt hàng, cung cấp các dịch vụ và thông tin yêu cầu thông qua website và theo yêu cầu của bạn.</p>\r\n\r\n<p style="text-align: justify;">- Hơn nữa, chúng tôi sẽ sử dụng các thông tin đó để quản lý tài khoản của bạn; xác minh và thực hiện giao dịch trực tuyến, nhận diện khách vào web, nghiên cứu nhân khẩu học, gửi thông tin bao gồm thông tin sản phẩm và dịch vụ. Nếu quý khách không muốn nhận bất cứ thông tin tiếp thị của chúng tôi thì có thể từ chối bất cứ lúc nào.</p>\r\n\r\n<p style="text-align: justify;">- Chúng tôi có thể chuyển tên và địa chỉ cho bên thứ ba để họ giao hàng cho bạn (ví dụ cho bên chuyển phát nhanh hoặc nhà cung cấp).</p>\r\n\r\n<p style="text-align: justify;">- Chi tiết đơn đặt hàng của bạn được chúng tôi lưu giữ nhưng vì lí do bảo mật nên chúng tôi không công khai trực tiếp được. Tuy nhiên, quý khách có thể tiếp cận thông tin bằng cách đăng nhập tài khoản trên web. Tại đây, quý khách sẽ thấy chi tiết đơn đặt hàng của mình, những sản phẩm đã nhận và những sản phẩm đã gửi và chi tiết email, ngân hàng và bản tin mà bạn đặt theo dõi dài hạn.</p>\r\n\r\n<p style="text-align: justify;">- Quý khách cam kết bảo mật dữ liệu cá nhân và không được phép tiết lộ cho bên thứ ba. Chúng tôi không chịu bất kỳ trách nhiệm nào cho việc dùng sai mật khẩu nếu đây không phải lỗi của chúng tôi.</p>\r\n\r\n<p style="text-align: justify;">- Chúng tôi có thể dùng thông tin cá nhân của bạn để nghiên cứu thị trường. mọi thông tin chi tiết sẽ được ẩn và chỉ được dùng để thống kê. Quý khách có thể từ chối không tham gia bất cứ lúc nào.</p>\r\n\r\n<p style="text-align: justify;"><strong>2. Bảo mật</strong></p>\r\n\r\n<p style="text-align: justify;">- Chúng tôi có biện pháp thích hợp về kỹ thuật và an ninh để ngăn chặn truy cập trái phép hoặc trái pháp luật hoặc mất mát hoặc tiêu hủy hoặc thiệt hại cho thông tin của bạn.</p>\r\n\r\n<p style="text-align: justify;">- Chúng tôi khuyên quý khách không nên đưa thông tin chi tiết về việc thanh toán với bất kỳ ai bằng e-mail, chúng tôi không chịu trách nhiệm về những mất mát quý khách có thể gánh chịu trong việc trao đổi thông tin của quý khách qua internet hoặc email.</p>\r\n\r\n<p style="text-align: justify;">- Quý khách tuyệt đối không sử dụng bất kỳ chương trình, công cụ hay hình thức nào khác để can thiệp vào hệ thống hay làm thay đổi cấu trúc dữ liệu. Nghiêm cấm việc phát tán, truyền bá hay cổ vũ cho bất kỳ hoạt động nào nhằm can thiệp, phá hoại hay xâm nhập vào dữ liệu của hệ thống website. Mọi vi phạm sẽ bị tước bỏ mọi quyền lợi cũng như sẽ bị truy tố trước pháp luật nếu cần thiết.</p>\r\n\r\n<p style="text-align: justify;">- Mọi thông tin giao dịch sẽ được bảo mật nhưng trong trường hợp cơ quan pháp luật yêu cầu, chúng tôi sẽ buộc phải cung cấp những thông tin này cho các cơ quan pháp luật.</p>\r\n\r\n<p style="text-align: justify;">Các điều kiện, điều khoản và nội dung của trang web này được điều chỉnh bởi luật pháp Việt Nam và tòa án Việt Nam có thẩm quyền xem xét.</p>\r\n\r\n<p style="text-align: justify;"><strong>3. Quyền lợi khách hàng</strong></p>\r\n\r\n<p style="text-align: justify;">- Quý khách có quyền yêu cầu truy cập vào dữ liệu cá nhân của mình, có quyền yêu cầu chúng tôi sửa lại những sai sót trong dữ liệu của bạn mà không mất phí. Bất cứ lúc nào bạn cũng có quyền yêu cầu chúng tôi ngưng sử dụng dữ liệu cá nhân của bạn cho mục đích tiếp thị.</p>', NULL, NULL, 'page', 'public', 'vn', 'vn', 3, NULL, 0, 0, '2021-09-07 17:00:00', '2021-10-15 09:14:49'),
	(24, 'Nhôm Việt Pháp', 'thanh-nhom-viet-phap', 0, '<p>+ Thanh profile: nh&ocirc;m Xingfa hệ 55 nhập khẩu</p>\r\n<p>+ Độ d&agrave;y nh&ocirc;m: thanh cửa v&agrave; khu&ocirc;n bao d&agrave;y 1.4mm (&plusmn; 5%)</p>\r\n<p>+ M&agrave;u sắc: trắng sứ, ghi, caf&eacute;, v&acirc;n gỗ</p>\r\n<p>+ K&iacute;ch thước: sản xuất v&agrave; lắp gh&eacute;p theo k&iacute;ch thước thực tế c&ocirc;ng tr&igrave;nh</p>\r\n<p>+ K&iacute;nh: an to&agrave;n c&oacute; độ d&agrave;y từ 6.38 mm</p>\r\n<p>+ Phụ kiện: nhập khẩu đồng bộ ch&iacute;nh h&atilde;ng</p>', '<p>Được sản tại nh&agrave; m&aacute;y Nh&ocirc;m Việt Ph&aacute;p đường Đ&agrave;o Cam Mộc, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội. Sản phẩm ch&iacute;nh h&atilde;ng của C&ocirc;ng Ty Cổ Phần Nh&ocirc;m Việt Ph&aacute;p H&agrave; Nội. Mặt cắt của nh&ocirc;m c&oacute; nhiều r&atilde;nh, g&acirc;n, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ kh&iacute;t khi đ&oacute;ng mở c&aacute;nh với khung cửa, được thiết kế nhằm mục đ&iacute;ch đạt hiệu quả c&aacute;ch &acirc;m, c&aacute;ch nhiệt cao nhất, vượt xa c&aacute;c loại cửa l&agrave;m từ những vật liệu truyền thống như gỗ, khung sắt,... BẢNG TỈ TRỌNG NH&Ocirc;M VIỆT PH&Aacute;P</p>', 'public/img/cua-di-4-canh-mo-xf-he-55-fix.png', 'public/img/kho-nguyen-lieu.jpg', 'product', 'public', 'vn', 'vn', 34, NULL, NULL, 2, '2021-09-07 17:00:00', '2022-04-03 18:57:11'),
	(25, 'Tất cả sản phẩm', 'san-pham', 0, NULL, NULL, NULL, NULL, 'category', 'public', 'vn', 'vn', 14, NULL, 0, 0, '2021-09-07 17:00:00', '2024-03-16 08:01:08'),
	(29, 'Thanh Nhôm Công nghiệp', 'thanh-nhom-cong-nghiep', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', NULL, 'product', 'public', 'vn', 'vn', 5, NULL, 0, 5, '2021-09-07 17:00:00', '2024-03-16 08:01:38'),
	(30, 'Thanh Nhôm Công nghiệp 1', 'thanh-nhom-cong-nghiep-1', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', NULL, 'product', 'public', 'vn', 'vn', 13, NULL, 0, 5, '2021-09-07 17:00:00', '2022-03-07 09:40:59'),
	(31, 'Thanh Nhôm Công nghiệp 2', 'thanh-nhom-cong-nghiep-2', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', NULL, 'product', 'public', 'vn', 'vn', 2, NULL, 0, 5, '2021-09-07 17:00:00', '2022-01-27 09:24:30'),
	(32, 'Thanh Nhôm Công nghiệp 5', 'thanh-nhom-cong-nghiep-5', 0, '<p>+ Thanh profile: nh&ocirc;m Xingfa hệ 55 nhập khẩu + Độ d&agrave;y nh&ocirc;m: thanh cửa v&agrave; khu&ocirc;n bao d&agrave;y 1.4mm (&plusmn; 5%) + M&agrave;u sắc: trắng sứ, ghi, caf&eacute;, v&acirc;n gỗ + K&iacute;ch thước: sản xuất v&agrave; lắp gh&eacute;p theo k&iacute;ch thước thực tế c&ocirc;ng tr&igrave;nh + K&iacute;nh: an to&agrave;n c&oacute; độ d&agrave;y từ 6.38 mm + Phụ kiện: nhập khẩu đồng bộ ch&iacute;nh h&atilde;ng</p>', '<p>Được sản tại nh&agrave; m&aacute;y Nh&ocirc;m Việt Ph&aacute;p đường Đ&agrave;o Cam Mộc, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội. Sản phẩm ch&iacute;nh h&atilde;ng của C&ocirc;ng Ty Cổ Phần Nh&ocirc;m Việt Ph&aacute;p H&agrave; Nội. Mặt cắt của nh&ocirc;m c&oacute; nhiều r&atilde;nh, g&acirc;n, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ kh&iacute;t khi đ&oacute;ng mở c&aacute;nh với khung cửa, được thiết kế nhằm mục đ&iacute;ch đạt hiệu quả c&aacute;ch &acirc;m, c&aacute;ch nhiệt cao nhất, vượt xa c&aacute;c loại cửa l&agrave;m từ những vật liệu truyền thống như gỗ, khung sắt,... BẢNG TỈ TRỌNG NH&Ocirc;M VIỆT PH&Aacute;P</p>', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', '/public/media/avatars/16.jpg', 'product', 'public', 'vn', 'vn', 60, NULL, NULL, 4, '2021-09-07 17:00:00', '2022-03-14 09:39:09'),
	(34, 'Giới thiệu', 'gioi-thieu', 0, NULL, 'Lời đầu tiên, Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội xin gửi tới Quý khách hàng lời chúc Sức khỏe, Hạnh phúc, Thành công và lời chào trân trọng nhất!\r\nKính thưa Quý khách hàng!\r\nTrong suốt thời gian hoạt động vừa qua, nhôm Việt Pháp Hà Nội đã tạo dựng cho mình một thương hiệu có uy tín tại thị trường Việt Nam và một số nước Châu Á. Sản phẩm hệ nhôm Xingfa, Việt Pháp được Nhôm Việt Pháp Hà Nội thiết kế, đăng kí độc quyền sở hữu trí tuệ và sản xuất trên dây chuyền hiện đại theo tiêu chuẩn quản lý chất lượng ISO 9001 – 2008 và được chứng nhận hợp quy của Bộ xây dựng. Phân phối trên toàn quốc.\r\nĐặc điểm nổi trội của cửa hệ nhôm Xingfa, Việt Pháp:\r\n-    Tiết kiệm vốn đầu tư, tối ưu hóa khi cắt ráp.\r\n-    Sử dụng ít định hình, rút ngắn được thời gian gia công cũng như lắp đặt.\r\n-    Lắp ráp bằng máy ép góc hoặc dung ke nhảy vô cùng tiện dụng.\r\n-    Độ dày đảm bảo từ 1.1 mm hoặc 1.4 mm\r\n-    Được thiết kế tối ưu chống mưa và nước tạt, không tạo ra nhiều khe hở trên sản phẩm. Thi công chính xác, nhanh gọn, đơn giản. Có đường phào trang trí mang lại vẻ đẹp cho sản phẩm. Thiết kế thông minh ở phần chân tiết kiệm bơm keo so với hệ cũ, giảm giá thành của sản phẩm nhưng hiệu quả mang lại không hề nhỏ, cũng như thời gian thi công rất ngắn và nhanh gọn. Có độ dày hơn trọng lượng tính trên m2 nhẹ hơn các sản phẩm trên thị trường. Phần chân chịu lực đã được cải thiện, có thêm ke chống cong vênh cho sản phẩm. Kính được bắt sâu vào sản phẩm sẽ không bị lắc nên kích thước cửa cánh được dãn rộng tạo độ thoáng cho cửa mà vẫn đảm bảo sự cứng vững cho sản phẩm.\r\n-    Hệ nhôm Xingfa, Việt Pháp của Công ty Cổ phần Nhôm Việt Pháp Hà Nội rất đa dạng và phong phú với kích thước khách nhau và màu sắc đa dạng như màu trắng sứ, màu ghi, màu cà phê, màu vân gỗ…đảm bảo đáp ứng được tất cả nhu cầu của khách hàng trên thị trường hiện nay, khách hàng có thể đến trược tiếp công ty chúng tôi để lựa chọn cho mình những sản phẩm tốt nhất, phù hợp với nhu cầu sử dụng và thẩm mỹ cao, cam kết sản phẩm có chất lượng cao với giá thành thấp hơn các sản phẩm cùng loại trên thị trường hiện nay.\r\nCông ty Cổ phần Nhôm Việt Pháp Hà Nội chúng tôi cam kết sẽ mang lại cho khách hàng những sản phẩm tốt nhất, dịch vụ tốt nhất, chu đáo và tận tình nhất.\r\n\r\nMọi ý kiến đóng góp và phản hồi của Quý khách hàng về chất lượng sản phẩm cũng như dịch vụ xin vui lòng liên hệ:\r\nCông ty Cổ Phần Nhôm Việt Pháp Hà Nội :\r\nĐịa chỉ: Đội 9, Ngọc Hồi - Thanh Trì - Hà Nội.\r\nNhà máy: Đường Đào Cam Mộc - Việt Hùng - Đông Anh - Hà Nội\r\nHotline : 0966065986 (Ms. Hiểu) \r\nEmail: nhomvietphaphanoi@gmail.com ', NULL, NULL, 'page', 'public', 'vn', 'vn', 10, NULL, NULL, 0, '2021-09-07 17:00:00', '2024-03-16 08:00:28'),
	(58, 'Cửa sổ lùa Việt Pháp hệ 2600', 'cua-so-lua-viet-phap-he-2600-1', 0, NULL, NULL, NULL, NULL, 'product', 'public', 'vn', 'vn', 7, NULL, NULL, 4, '2021-09-07 17:00:00', '2022-02-09 05:25:15'),
	(59, 'Nhôm Việt Pháp', 'thanh-nhom-viet-phap-2', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-4-canh-mo-xf-he-55-fix.png', 'public/img/kho-nguyen-lieu.jpg', 'product', 'public', 'vn', 'vn', 6, NULL, 0, 0, '2021-09-07 17:00:00', '2022-03-08 10:19:51'),
	(60, 'Thanh Nhôm Công nghiệp', 'thanh-nhom-cong-nghiep-3', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', NULL, 'product', 'public', 'vn', 'vn', 3, NULL, 0, 5, '2021-09-07 17:00:00', '2021-10-15 09:14:46'),
	(61, 'Thanh Nhôm Công nghiệp 1', 'thanh-nhom-cong-nghiep-1-4', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', NULL, 'product', 'public', 'vn', 'vn', 24, NULL, 0, 5, '2021-09-07 17:00:00', '2022-02-09 02:32:41'),
	(62, 'Thanh Nhôm Công nghiệp 2', 'thanh-nhom-cong-nghiep-2-5', 0, '+ Thanh profile: nhôm Xingfa hệ 55 nhập khẩu\r\n+ Độ dày nhôm: thanh cửa và khuôn bao dày 1.4mm (± 5%)\r\n+ Màu sắc: trắng sứ, ghi, café, vân gỗ\r\n+ Kích thước: sản xuất và lắp ghép theo kích thước thực tế công trình\r\n+ Kính: an toàn có độ dày từ 6.38 mm \r\n+ Phụ kiện: nhập khẩu đồng bộ chính hãng', 'Được sản tại nhà máy Nhôm Việt Pháp đường Đào Cam Mộc, Việt Hùng, Đông Anh, Hà Nội. Sản phẩm chính hãng của Công Ty Cổ Phần Nhôm Việt Pháp Hà Nội.\r\n\r\nMặt cắt của nhôm có nhiều rãnh, gân, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ khít khi đóng mở cánh với khung cửa, được thiết kế nhằm mục đích đạt hiệu quả cách âm, cách nhiệt cao nhất, vượt xa các loại cửa làm từ những vật liệu truyền thống như gỗ, khung sắt,...\r\n\r\nBẢNG TỈ TRỌNG NHÔM VIỆT PHÁP', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', NULL, 'product', 'public', 'vn', 'vn', 2, NULL, 0, 5, '2021-09-07 17:00:00', '2024-03-16 08:15:40'),
	(63, 'Thanh Nhôm Công nghiệp 5', 'thanh-nhom-cong-nghiep-5-6', 0, '<p>+ Thanh profile: nh&ocirc;m Xingfa hệ 55 nhập khẩu + Độ d&agrave;y nh&ocirc;m: thanh cửa v&agrave; khu&ocirc;n bao d&agrave;y 1.4mm (&plusmn; 5%) + M&agrave;u sắc: trắng sứ, ghi, caf&eacute;, v&acirc;n gỗ + K&iacute;ch thước: sản xuất v&agrave; lắp gh&eacute;p theo k&iacute;ch thước thực tế c&ocirc;ng tr&igrave;nh + K&iacute;nh: an to&agrave;n c&oacute; độ d&agrave;y từ 6.38 mm + Phụ kiện: nhập khẩu đồng bộ ch&iacute;nh h&atilde;ng</p>', '<p>Được sản tại nh&agrave; m&aacute;y Nh&ocirc;m Việt Ph&aacute;p đường Đ&agrave;o Cam Mộc, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội. Sản phẩm ch&iacute;nh h&atilde;ng của C&ocirc;ng Ty Cổ Phần Nh&ocirc;m Việt Ph&aacute;p H&agrave; Nội. Mặt cắt của nh&ocirc;m c&oacute; nhiều r&atilde;nh, g&acirc;n, nếp, được thiết kế để tăng độ cứng, khả năng chống lực vặn xoắn vừa tạo độ kh&iacute;t khi đ&oacute;ng mở c&aacute;nh với khung cửa, được thiết kế nhằm mục đ&iacute;ch đạt hiệu quả c&aacute;ch &acirc;m, c&aacute;ch nhiệt cao nhất, vượt xa c&aacute;c loại cửa l&agrave;m từ những vật liệu truyền thống như gỗ, khung sắt,... BẢNG TỈ TRỌNG NH&Ocirc;M VIỆT PH&Aacute;P</p>', 'public/img/cua-di-mo-quay-2-canh-xingfa-he-55.png', '/public/media/avatars/16.jpg', 'product', 'public', 'vn', 'vn', 35, NULL, NULL, 4, '2021-09-07 17:00:00', '2021-10-14 22:10:37');

-- Dumping structure for table nhnho4u0_nhomhanoi.site_product
DROP TABLE IF EXISTS `site_product`;
CREATE TABLE IF NOT EXISTS `site_product` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `sold` int NOT NULL DEFAULT '0',
  `sale` float unsigned NOT NULL DEFAULT '0',
  `origin_price` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`) USING BTREE,
  KEY `quantity` (`quantity`),
  KEY `sale` (`sale`),
  KEY `origin_price` (`origin_price`),
  KEY `sold` (`sold`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table nhnho4u0_nhomhanoi.site_product: ~4 rows (approximately)
INSERT IGNORE INTO `site_product` (`id`, `post_id`, `quantity`, `sold`, `sale`, `origin_price`) VALUES
	(1, 32, 1, 0, 15.7, 50000),
	(2, 7, 15, 0, 0, 110000),
	(3, 58, 0, 0, 0, 34000),
	(4, 24, 10, 0, 0, 50000);

-- Dumping structure for table nhnho4u0_nhomhanoi.site_slider
DROP TABLE IF EXISTS `site_slider`;
CREATE TABLE IF NOT EXISTS `site_slider` (
  `post_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `thumb` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  KEY `post_id` (`post_id`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table nhnho4u0_nhomhanoi.site_slider: ~10 rows (approximately)
INSERT IGNORE INTO `site_slider` (`post_id`, `image`, `thumb`, `order`) VALUES
	('0', '/public/media/trang-chu/slide1.jpg', NULL, 0),
	('0', '/public/media/trang-chu/slide2.jpg', NULL, 0),
	('0', '/public/media/trang-chu/slide3.jpg', NULL, 0),
	('7', 'public/media/products/thanh-nhom-1.jpg', 'public/media/.tmb/products/thanh-nhom-1.jpg', 0),
	('7', 'public/media/products/thanh-nhom-3.jpg', 'public/media/.tmb/products/thanh-nhom-3.jpg', 0),
	('7', 'public/media/products/thanh-nhom.jpg', 'public/media/.tmb/products/thanh-nhom.jpg', 0),
	('7', 'public/media/products/slide1.jpg', 'public/media/.tmb/products/slide1.jpg', 0),
	('32', 'public/media/products/thanh-nhom-1.jpg', 'public/media/.tmb/products/thanh-nhom-1.jpg', 0),
	('32', 'public/media/products/thanh-nhom-3.jpg', 'public/media/.tmb/products/thanh-nhom-3.jpg', 0),
	('32', 'public/media/products/thanh-nhom.jpg', 'public/media/.tmb/products/thanh-nhom.jpg', 0);

-- Dumping structure for table nhnho4u0_nhomhanoi.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` enum('male','female','intersex','unknown') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'unknown',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `role` int DEFAULT '1',
  `lang` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'vn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(191)),
  KEY `email` (`email`(191)),
  KEY `avatar` (`avatar`(191)),
  KEY `password` (`password`(191)),
  KEY `lang` (`lang`),
  KEY `role` (`role`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `remember_token` (`remember_token`),
  KEY `email_verified_at` (`email_verified_at`),
  KEY `gender` (`gender`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table nhnho4u0_nhomhanoi.users: ~5 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `gender`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `status`, `role`, `lang`, `created_at`, `updated_at`) VALUES
	(1, 'CMS Admin', 'unknown', 'admin@admin', NULL, NULL, '$2b$10$1M4Vym/k7aOCiDGqSlWy3OZmRYnqiiShx6uVpZO.YKLJ8Vv/kjsR6', 'EWQkipPLupnqw8IXB5OKRHHEkphDSGqVVpkYrr3RbH4TLMCCPhMlJzUnFPpv', 1, 0, 'vn', NULL, '2021-05-31 10:08:04'),
	(2, 'CMS Report', 'unknown', 'report@example', 'public/img/monkey-astronaut.png', NULL, '$2b$10$o.27NHFNyDl6bbtlzgOgXuQCJ2XbVy31gRT/jLXBj9WSI8mn71iuW', NULL, 1, 0, 'vn', NULL, '2021-05-31 10:08:04'),
	(56, 'Content Manager', 'intersex', 'ngcaobinh1992@gmail.com', '', NULL, '$2y$10$St16PLKkygpIDeRqd0iIpu8D9zmNQmsvOwqgitcsW35eSW2WJW/Ae', '9DBVBBogTbH1HeTjsQCRylZdw73iLKWBZRXE02SgAt2Cw9xwvzXHVNYacIbn', 1, 4, 'vn', '2021-05-31 10:38:01', '2021-05-31 10:38:01'),
	(61, 'Bình Nguyễn', 'unknown', 'ngcaobinh93@yahoo.com.vn', NULL, NULL, '$2y$10$0R14WX8plvZ3GSoSNr8TruaqLeKVGCUmv45A7ZitPQqQENdF.pR0q', NULL, 0, 1, 'vn', '2022-03-01 07:49:31', '2022-03-01 07:49:31'),
	(64, 'Bình nguyễn 1', 'male', 'ngcaobinh92@yahoo.com.vn', 'http://nhomhanoi.com.test/public/media/items/tenor.gif', NULL, '$2y$10$8injiSUMFnyXedP/wV9voOVlpfiZXLCEoAVwSuJqfCRX1B5jByOyO', 'VT0kavWvOLPvFOtSRxjZcueGq2Sio9Z55kWgieB5Kj0XDvJv5qcYT0SpD6S7', 1, 0, 'vn', '2022-03-01 08:43:44', '2022-03-04 02:49:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

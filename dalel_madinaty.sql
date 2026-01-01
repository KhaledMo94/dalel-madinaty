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

-- Dumping structure for table dalel_madinaty.amenities
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.amenities: ~0 rows (approximately)
INSERT INTO `amenities` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "لا حيوانات", "en": "no animal"}', '{"en": null}', NULL, '2025-12-31 12:12:33', '2025-12-31 12:12:33');

-- Dumping structure for table dalel_madinaty.amenity_categories
CREATE TABLE IF NOT EXISTS `amenity_categories` (
  `amenity_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  KEY `amenity_categories_amenity_id_foreign` (`amenity_id`),
  KEY `amenity_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `amenity_categories_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `amenity_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.amenity_categories: ~2 rows (approximately)
INSERT INTO `amenity_categories` (`amenity_id`, `category_id`) VALUES
	(1, 2);

-- Dumping structure for table dalel_madinaty.amenity_listings
CREATE TABLE IF NOT EXISTS `amenity_listings` (
  `amenity_id` bigint unsigned NOT NULL,
  `listing_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`amenity_id`,`listing_id`),
  KEY `amenity_listings_listing_id_foreign` (`listing_id`),
  CONSTRAINT `amenity_listings_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `amenity_listings_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.amenity_listings: ~0 rows (approximately)
INSERT INTO `amenity_listings` (`amenity_id`, `listing_id`) VALUES
	(1, 1);

-- Dumping structure for table dalel_madinaty.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `city_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_city_id_foreign` (`city_id`),
  CONSTRAINT `areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.areas: ~2 rows (approximately)
INSERT INTO `areas` (`id`, `name`, `description`, `city_id`, `created_at`, `updated_at`) VALUES
	(2, '{"ar": "Moises Schaden", "en": "Abe Leuschke"}', '{"ar": "Repudiandae repudiandae quidem sunt molestiae cum.", "en": "Magnam molestias sequi deserunt maxime natus expedita quod."}', 1, '2025-12-30 15:23:29', '2025-12-30 15:23:29'),
	(3, '{"ar": "Price Jakubowski", "en": "Jeffery Windler"}', '{"ar": "Laudantium quos deleniti.", "en": "Quibusdam numquam vitae aliquam commodi labore voluptas dignissimos quas laboriosam."}', 1, '2025-12-30 15:23:35', '2025-12-30 15:23:35'),
	(4, '{"ar": "Verlie Wyman", "en": "Willy Fay"}', '{"ar": "Sequi amet quasi ipsam accusantium rerum fuga voluptate qui quisquam.", "en": "Minus quibusdam ut veritatis est culpa qui inventore blanditiis."}', 1, '2025-12-30 15:23:43', '2025-12-30 15:23:43');

-- Dumping structure for table dalel_madinaty.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` json DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `listing_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_listing_id_foreign` (`listing_id`),
  CONSTRAINT `banners_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.banners: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.cache: ~2 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('dalel_madinaty_cache_avatar_013145d8a0da07c83cfe7a85f38856cf', 's:2486:"data:image/png;base64,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";', 1767292306),
	('dalel_madinaty_cache_avatar_ca508c052fee23e6a2cd58ce9fc99a32', 's:3962:"data:image/png;base64,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";', 1767292095),
	('dalel_madinaty_cache_avatar_d62076f5c4e700522f1785092a756c8b', 's:3134:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAIzklEQVR4nO2de0wc1xXGPxb2DSzYGDtxEtev2Bg/iXdhwY4j1yWkiePKTaMqjeK2aZ3IadqoiiJValWrTZU2bpNWSqIqVaVUaaWmtVw7dhKHNIoBszyMsQ02hoJNMQFjHgbbARZ2d+gfeCi7e2d2Z+bO7AXuT0KCOTP3Hs6359zH7M4mTUxMgMMOKYl2QCm7i7MVv4IOlfYm6eGLHiSxnCFqgh8vrIrElCB6ChALVgRiQpBEChFJooVJmCAsiSBFIsQxXJCZIEQkRgpjMqojYGaKARjrtyEZMlOFIKF3tugqyGwSIhK9hNFFkNksRCS0hTF0DOHEhmqGzKXMiIRWplDLkLksBkDv/6ciyFwXQ4RGHDQLwsUIR2s8NAnCxSCjJS6qBeFiyKM2PqoE4WLEh5o4KRaEi6EMpfHiC0PGiHthyDNDO/EsHnmGMEZcgvDsoEM8ceQZwhgxBeHZQZdY8eQZwhiygvDs0Ae5uEoKwsXQF6n48pLFGERBeHYYAynOPEMYgwvCGFF7WUrK1d7nX0XJzm/Hda4gCAiM+zE6OozBgR709Xah/VIj/nPxNM6fq0QgMKbIcS3+VHx2CK+/8qymvnY9tg979u6PeV5by1m89Hyx7DnT97gM+8COyWSC1eaA1eZARuYCLF2xDp7CEgDA+Lgfp6qO4/jRd3Chwae7L3nuL8NkSoYghFS3UXj/oxQ9+j9hJStRg7nFYkPRtq/hl789jF8c+BeWLF2ja3/OVBfWbihSff38rDuwcnUeNX+mx525MWTthiK8+kYpdj22T9d+PN4S1dd6dcoOgEFBAMBstmDP3v3Y9+PXdevDU/RV1dcWbt1J0ZNwmBREZEfJt/D9H/xal7azFtyJZSvWK74uc/5C3JuzWQePJpka1GmPHx3tF/GzF3eFHXM6XUhzzcPiu5Zj3catcHtLkJaeKdvOQ49+F63N9Tjx73/QdA8A4PY+iMttDYquKdjyCEwm+q/j3cXZE4dKe5N0yxAhFMQXt4bCfq71dKCt5QzKPj2IN373IzzzZB7ee/cAQqGgbFvfe+4VuDKyVPvS23OFeDxfRdkilatQKIjB69cUt0UioSXL7x/Ge+8ewMs/fQKjo19InudwpuHxJ19U3c+FxipiwL60LBcLFt4ddzuujCzkrC2IOn7+XCUG+q6q9m86TIwh506fwB9/Lx/w7cXfRGpahqr2bTYn6qpLiTYls62CLQ8Ty5Wv/H1YbXZVvkXChCDA5Or5dM0nknarzYGibbsk7XLY7U7U+D4i2pSULe/W6OluKBRE9ckPYLM7VfkWiQlgZ3f32OE/ydrdKtcOdkcaGurLMOYfibLlrM2Hw5kes4209HnIXe+NOn6hoQq3bl6H1ao9Q3YXZ08wkyHAZOm63t8jaV+lcrppszsRDAZw9vSJKFtycgrcBfJ7TcBkJiUnR+80VVW8DwBUBAEYKlkirS31kjZnqgsLFy1R3KZY32urjhPt8WQeaXYlCAKqT35wuw+HYr9IMCfIpVb5dUH2ovhnRSI222R9r6suhSAIUfZN7u1ISTFLXu9wpmPdpq1Rxy+er8aNoX6YzVbFPknBnCCDA9IlCwAyMrMVtylmyK2b19HcVBtlt9tTsT5vm+T1UuWqsuwIAMBsmcWCjIzckrWrKQ0Wi23q91M+ctmSm/7GKldms0WxT1IwJ8jY2KisPSlJ+Yddk5NTpq6Tmv66vQ8Sj9sd5OxpbqrF0GDvbZ/ohZE5QZwxpqCBcXV3FsWS09Pdjs+vtEbZM+ctxIpVm6KOe7wlxAyoKj869XuSid6zA9gTJNUlax8evqG5j1MSsy3SIpG0GBQEAb7b013aMCdI9qJ7ZO009oykpr/5heGC2GxObNz8QNR5rc31GBygs5kYCXOC3Jtzn6RNEARc7b6suY+WplMYGuyLOn7XPSux6M6lU39vLigOmxCIVJYf0eyDFEwJYrM5sVzmptHV7ssYHZHeFVZCXQ15szG/8KGp370SdwarK45R8YEEU4I88JXHZae1jWdOUutLahxx334njMVqR557e5S9tbke/X1d1PyIxAQk/sGPAGA2W7Fz9zOy59T4PqTW39m6E8TNxtVrPEhLn4f7PDuILw5fuT6DOTCpAzMZ8vS+X+GOxcsk7b09V9BQX0atv0BgDOfqy6OOm0wmeLwlKLyfXK58FUeJx2nBhCB79u5H8cNPyZ5z+J9vgvbD1qTK1rYd30CeZ0fU8baWs+i71knVh0gS+qjxnNx8PPGdnyB3faHseZ0dLfj42DvU+6+rmdxsjLwLKPUmOr3WHtPRTZAUswVZCxZP/W212ZGalglXRhZW53qwbuMWLF+5IWY7gcA4/vCb56hnBwDcGOpHa3M9Vq2J7z7L9NW5XkwJcqi0N4nmncO7l6zC2387o6kNQRDw1msvKH6rjhJqfB/GJUh7WyOu9XTo5oc4sWJiDCERCgXx5msvoOzTg7r2IzWORKL3YC7CpCD9fd34+Utfx2elf9e9r67ONlztir36N6JcAYwJMuYfwZGDb+GHTxehqbHKsH6l9rZE/nv5Arq7LhniS5ggiVogdna04K9/fhnPPrUZf3l7P/z+YUP7r60k3yMR8emcHYZ/YEcQBASD4xjzj2JosBcDfd34vLMV7ZfOo/FMha5bEfHQ3FSLmzcGkO6aT7RXGTDdFSE+nomV92nNBSKrElNjCIcLwhxEQVjY/Z0LkOLMM4QxJAXhWaIvUvGVzRAuij7IxZWXLMaIKQjPErrEiifPEMaISxCeJXTgD1KegSj+Diq+z6UcJRWGZwhjKBaEjyfKUBovVRnCRYkPNXFSXbK4KPKojY+mMYSLQkZLXDQP6lyUcLTGg8osi4syCY04UJv2znVRaP3//Ou7NcK/vnuWo0uGiMzmTNGrROsqiMhsEkbvsdIQQURmsjBGTVoMHUNm6kzMSL8NzZDpzIRsScQLKGGCTIclcRKdxUwIIpJIYRIthAhTgkSip0CsCBAJ04KQUCMSq8En8T/CQDcMq1r3jwAAAABJRU5ErkJggg==";', 1767193534),
	('dalel_madinaty_cache_spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:12:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:10:"categories";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:8:"listings";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:5:"users";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:6:"cities";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:7:"banners";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:9:"amenities";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:13:"notifications";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:6:"offers";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:10:"commenters";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:7:"reviews";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:10;a:3:{s:1:"a";i:11;s:1:"b";s:5:"areas";s:1:"c";s:3:"web";}i:11;a:3:{s:1:"a";i:12;s:1:"b";s:7:"options";s:1:"c";s:3:"web";}}s:5:"roles";a:1:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:11:"super-admin";s:1:"c";s:3:"web";}}}', 1767292206);

-- Dumping structure for table dalel_madinaty.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.cache_locks: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `main_category_id` bigint unsigned DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_main_category_id_foreign` (`main_category_id`),
  CONSTRAINT `categories_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `main_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `main_category_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(2, '{"ar": "مشاوي", "en": "Grills"}', '{"ar": "Minima ducimus aperiam facere soluta natus asperiores est.", "en": "Delectus reiciendis alias necessitatibus impedit quae placeat itaque."}', 3, 'categories/lDSrrHWTaZ8z4kRGHdgcaKlSF1ecC6yPO4EOvObd.png', 'active', '2025-12-30 14:50:51', '2025-12-30 14:53:42'),
	(3, '{"ar": "اسماك", "en": "sea food"}', '{"ar": null}', 3, 'categories/uPE5i0KmgZlqaI07aRSYlXTn15fD5q7Qc66ERmHX.png', 'active', '2025-12-30 14:54:46', '2025-12-30 14:54:46');

-- Dumping structure for table dalel_madinaty.category_option
CREATE TABLE IF NOT EXISTS `category_option` (
  `category_id` bigint unsigned NOT NULL,
  `option_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`category_id`,`option_id`),
  KEY `category_option_option_id_foreign` (`option_id`),
  CONSTRAINT `category_option_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_option_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.category_option: ~4 rows (approximately)
INSERT INTO `category_option` (`category_id`, `option_id`) VALUES
	(2, 1),
	(3, 1),
	(2, 2),
	(2, 3);

-- Dumping structure for table dalel_madinaty.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.cities: ~2 rows (approximately)
INSERT INTO `cities` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "القاهرة", "en": "Cairo"}', '{"ar": null}', 'cities/VLi5TJLvBYawPtpdPmSxKVCDvnBksAlbANehtwAw.jpg', '2025-12-30 15:03:50', '2025-12-30 15:04:25');

-- Dumping structure for table dalel_madinaty.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_listing_id_foreign` (`listing_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.comments: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.general_settings
CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.general_settings: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.jobs: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.job_batches: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.listings
CREATE TABLE IF NOT EXISTS `listings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `image` text COLLATE utf8mb4_unicode_ci,
  `banner_image` text COLLATE utf8mb4_unicode_ci,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fb_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tt_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listings_category_id_foreign` (`category_id`),
  CONSTRAINT `listings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.listings: ~0 rows (approximately)
INSERT INTO `listings` (`id`, `name`, `description`, `category_id`, `status`, `image`, `banner_image`, `latitude`, `longitude`, `file`, `created_at`, `updated_at`, `fb_link`, `insta_link`, `tt_link`) VALUES
	(1, '{"ar": "Samara Rath", "en": "Zakary Macejkovic"}', '{"ar": "Impedit ipsum nulla sapiente.", "en": "Modi ab ducimus ipsa quo quibusdam recusandae voluptatum tempora architecto."}', 2, 'active', 'listings/JvsILS0iHw6NR9qMgtQYUcKkv28saHZve55GqMmJ.jpg', 'listings/3XZvB2oJuL7RGCnxxLzCESfMhGXXCzmfppBOp1YR.jpg', 32.1234, 32.1234, 'listings/mEbv9mXLGWh8IChCh9gO3XIM9JL6R4fylrKaIMme.pdf', '2025-12-31 12:47:42', '2025-12-31 12:51:51', 'https://www.facebook.com/123', 'https://www.instagram.com/123', 'https://www.tiktok.com/123');

-- Dumping structure for table dalel_madinaty.listing_branches
CREATE TABLE IF NOT EXISTS `listing_branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint unsigned NOT NULL,
  `address` json NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_alt` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `area_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_branches_listing_id_foreign` (`listing_id`),
  KEY `listing_branches_area_id_foreign` (`area_id`),
  CONSTRAINT `listing_branches_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `listing_branches_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.listing_branches: ~2 rows (approximately)
INSERT INTO `listing_branches` (`id`, `listing_id`, `address`, `phone`, `phone_alt`, `latitude`, `longitude`, `area_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '{"ar": "815 Schaefer Lock", "en": "85028 Adah Curve"}', '885-232-5146', '504-428-0534', 30.1234, 30.1234, 2, '2025-12-31 14:06:35', '2025-12-31 14:06:35'),
	(2, 1, '{"ar": "815 Schaefer Lockdas", "en": "85028 Adah Curveferwfa"}', '885-232-5146', '504-428-0534', 30.1237, 30.1237, 3, '2025-12-31 14:11:06', '2025-12-31 14:14:47');

-- Dumping structure for table dalel_madinaty.listing_images
CREATE TABLE IF NOT EXISTS `listing_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint unsigned NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_images_listing_id_foreign` (`listing_id`),
  CONSTRAINT `listing_images_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.listing_images: ~1 rows (approximately)
INSERT INTO `listing_images` (`id`, `listing_id`, `image`, `created_at`, `updated_at`) VALUES
	(3, 1, 'listings/images/SoUL7vPZZVbM8tL5m3LeAJSekXG0iPlHrlBs3KYF.png', '2025-12-31 12:47:42', '2025-12-31 12:47:42');

-- Dumping structure for table dalel_madinaty.listing_option_value
CREATE TABLE IF NOT EXISTS `listing_option_value` (
  `listing_id` bigint unsigned NOT NULL,
  `option_value_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`listing_id`,`option_value_id`),
  KEY `listing_option_value_option_value_id_foreign` (`option_value_id`),
  CONSTRAINT `listing_option_value_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `listing_option_value_option_value_id_foreign` FOREIGN KEY (`option_value_id`) REFERENCES `option_values` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.listing_option_value: ~4 rows (approximately)
INSERT INTO `listing_option_value` (`listing_id`, `option_value_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4);

-- Dumping structure for table dalel_madinaty.listing_users
CREATE TABLE IF NOT EXISTS `listing_users` (
  `listing_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`listing_id`,`user_id`),
  KEY `listing_users_user_id_foreign` (`user_id`),
  CONSTRAINT `listing_users_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `listing_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.listing_users: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.main_categories
CREATE TABLE IF NOT EXISTS `main_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.main_categories: ~0 rows (approximately)
INSERT INTO `main_categories` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(3, '{"ar": "مطاعم", "en": "Restaurant"}', '{"ar": null}', 'categories/B47XyOExQ3FDwt0zeRJAfWqAI6wC6MN1O3VxAzVI.png', 'active', '2025-12-30 14:27:57', '2025-12-30 14:27:57');

-- Dumping structure for table dalel_madinaty.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.migrations: ~1 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_06_10_123508_create_personal_access_tokens_table', 1),
	(5, '2025_06_10_123743_add_phone_column_to_users_table', 1),
	(6, '2025_06_10_150001_create_permission_tables', 1),
	(7, '2025_06_11_102247_add_notification_columns_to_users_table', 1),
	(8, '2025_06_13_122833_create_main_categories_table', 1),
	(9, '2025_06_14_093139_create_categories_table', 1),
	(10, '2025_06_14_131336_create_listings_table', 1),
	(11, '2025_06_15_122123_create_amenities_table', 1),
	(12, '2025_06_15_122750_create_amenity_listings_table', 1),
	(13, '2025_06_19_093553_create_cities_table', 1),
	(14, '2025_06_19_102356_create_areas_table', 1),
	(15, '2025_06_19_153600_create_banners_table', 1),
	(16, '2025_07_16_085604_add_phone_otp_column_to_users_table', 1),
	(17, '2025_08_06_084552_create_listing_branches_table', 1),
	(18, '2025_08_26_170044_create_amenity_categories_table', 1),
	(19, '2025_08_26_180159_create_listing_users_table', 1),
	(20, '2025_08_31_095544_create_offers_table', 1),
	(21, '2025_09_10_110213_add_social_links_column_to_listings_table', 1),
	(22, '2025_09_28_162928_create_general_settings_table', 1),
	(23, '2025_12_30_115935_create_ratings_table', 1),
	(24, '2025_12_30_121009_create_listing_images_table', 1),
	(25, '2025_12_30_125207_create_options_table', 1),
	(26, '2025_12_30_125405_create_option_values_table', 1),
	(27, '2025_12_30_132243_create_category_option_table', 1),
	(28, '2025_12_30_135816_create_listing_option_values_table', 1),
	(29, '2025_12_31_171237_create_comments_table', 2),
	(30, '2025_12_31_174233_add_commenter_id_to_users_table', 3);

-- Dumping structure for table dalel_madinaty.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.model_has_permissions: ~0 rows (approximately)
INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
	(2, 'App\\Models\\User', 4),
	(4, 'App\\Models\\User', 4),
	(9, 'App\\Models\\User', 4),
	(10, 'App\\Models\\User', 4),
	(11, 'App\\Models\\User', 4),
	(12, 'App\\Models\\User', 4);

-- Dumping structure for table dalel_madinaty.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.model_has_roles: ~0 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 4);

-- Dumping structure for table dalel_madinaty.offers
CREATE TABLE IF NOT EXISTS `offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `listing_id` bigint unsigned NOT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_listing_id_foreign` (`listing_id`),
  CONSTRAINT `offers_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.offers: ~1 rows (approximately)
INSERT INTO `offers` (`id`, `image`, `content`, `listing_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
	(1, 'offers/0EAq01AYkAJ1g0cFdOcYxAZdtME2c9w7ZCSGBaOf.png', '{"ar": "Aliquam maxime quidem aperiam sint sit magni.", "en": "Doloribus dolor illum incidunt quisquam autem."}', 1, '2025-12-22 04:48:00', '2026-03-30 13:56:00', '2025-12-31 14:29:13', '2025-12-31 14:30:42');

-- Dumping structure for table dalel_madinaty.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.options: ~3 rows (approximately)
INSERT INTO `options` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "Aron Champlin", "en": "Gerardo Becker"}', '{"ar": "Similique ea corrupti ipsa voluptate nam repellendus.", "en": "Voluptate fugit velit ex laborum repudiandae nisi eos ducimus."}', '2025-12-30 15:31:13', '2025-12-30 15:31:13'),
	(2, '{"ar": "Tiara Terry", "en": "Stan Beahan"}', '{"ar": "Error dicta reprehenderit inventore repellat impedit atque perferendis quidem qui.", "en": "Quo eos quo consequatur labore harum earum."}', '2025-12-31 09:34:50', '2025-12-31 09:34:50'),
	(3, '{"ar": "Kailyn Bergstrom", "en": "Johnathon Graham"}', '{"ar": "Esse aut sunt.", "en": "Occaecati ipsa ducimus neque aperiam aliquid."}', '2025-12-31 09:34:59', '2025-12-31 09:34:59');

-- Dumping structure for table dalel_madinaty.option_values
CREATE TABLE IF NOT EXISTS `option_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option_id` bigint unsigned NOT NULL,
  `name` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_values_option_id_foreign` (`option_id`),
  CONSTRAINT `option_values_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.option_values: ~5 rows (approximately)
INSERT INTO `option_values` (`id`, `option_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 1, '{"ar": "Aliyah O\'Reilly", "en": "Abel Kuphal"}', '2025-12-30 15:31:33', '2025-12-30 15:31:33'),
	(2, 2, '{"ar": "Shawn Dooley-Ritchie", "en": "Wava Streich"}', '2025-12-30 15:31:49', '2025-12-31 09:38:29'),
	(3, 1, '{"ar": "Carlie Christiansen", "en": "Mariah Koelpin"}', '2025-12-31 09:38:43', '2025-12-31 09:38:43'),
	(4, 3, '{"ar": "Akeem Dickinson", "en": "Harrison Oberbrunner"}', '2025-12-31 09:39:05', '2025-12-31 09:39:05'),
	(5, 1, '{"ar": "Velda Hermann", "en": "Eriberto Windler"}', '2025-12-31 09:39:55', '2025-12-31 09:39:55');

-- Dumping structure for table dalel_madinaty.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.permissions: ~12 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'categories', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(2, 'listings', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(3, 'users', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(4, 'cities', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(5, 'banners', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(6, 'amenities', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(7, 'notifications', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(8, 'offers', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(9, 'commenters', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(10, 'reviews', 'web', '2025-12-30 12:57:54', '2025-12-30 12:57:54'),
	(11, 'areas', 'web', '2025-12-31 16:22:34', '2025-12-31 16:22:34'),
	(12, 'options', 'web', '2025-12-31 16:22:34', '2025-12-31 16:22:34');

-- Dumping structure for table dalel_madinaty.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `listing_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_listing_id_foreign` (`listing_id`),
  CONSTRAINT `ratings_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.ratings: ~0 rows (approximately)

-- Dumping structure for table dalel_madinaty.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super-admin', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53'),
	(2, 'admin', 'web', '2025-12-30 12:57:53', '2025-12-30 12:57:53');

-- Dumping structure for table dalel_madinaty.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.role_has_permissions: ~10 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1);

-- Dumping structure for table dalel_madinaty.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('M0bRr9tiTRdim4YsNjOK9DpAkAhhVIgExdhoEjI1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSTBOQTVCTEpCendZeFlkaFdDSFZtckxxQUtjZG5QeFdqeGR0Nld1cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9kYWxlbC1tYWRpbmF0eS50ZXN0L2FkbWluL3VzZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1767206737);

-- Dumping structure for table dalel_madinaty.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '+20',
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `commenter_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`country_code`,`phone_number`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_commenter_id_foreign` (`commenter_id`),
  CONSTRAINT `users_commenter_id_foreign` FOREIGN KEY (`commenter_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dalel_madinaty.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone_number`, `country_code`, `phone_verified_at`, `image`, `status`, `fcm_token`, `otp_code`, `otp_expires_at`, `commenter_id`) VALUES
	(1, 'Dalel Madinaty Admin', 'admin@dalelmadinaty.com', NULL, '$2y$12$cBuxfCt8FiTzEW.byTAtq.zh.0cv0r/e.uCIVNVCmwGas2BWo/FYK', NULL, '2025-12-30 12:57:53', '2025-12-30 13:05:34', '1111111111', '+20', '2025-12-30 12:57:53', 'users/6953ea3ed0731.png', 'active', NULL, NULL, NULL, NULL),
	(4, 'Hailee Gusikowski', 'your.email+fakedata51839@gmail.com', '2025-12-31 16:31:46', '$2y$12$KaWGqUSoN6Oz95eFgd5hmOGpVgQh.bIl/QLCHXHrh6wGg9Wf9cNlG', NULL, '2025-12-31 16:31:46', '2025-12-31 16:31:51', NULL, '+20', '2025-12-31 16:31:46', 'users/69556c1221983.png', 'active', NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

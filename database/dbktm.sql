-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 03:55 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dbktm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 6, '2025-04-15 14:49:37', '2025-04-15 14:49:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `price_at_time` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price_at_time`, `created_at`, `updated_at`) VALUES
(28, 5, 5, 5, 98000.00, '2025-04-15 15:19:24', '2025-04-15 15:21:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Honda', 'Honda là một hãng xe nổi tiếng của Nhật Bản, chuyên sản xuất ô tô, xe máy và động cơ. Được thành lập năm 1948, Honda nổi bật với sự bền bỉ, tiết kiệm nhiên liệu và công nghệ tiên tiến. Đây là hãng xe máy lớn nhất thế giới và cũng nằm trong top các hãng ô tô hàng đầu toàn cầu.', '2025-04-11 01:16:01', '2025-04-11 01:16:01'),
(2, 'Yamaha', 'Yamaha là một hãng xe nổi tiếng đến từ Nhật Bản, được thành lập vào năm 1955. Hãng chuyên sản xuất xe máy, mô tô thể thao và động cơ với thiết kế hiện đại, bền bỉ và tiết kiệm nhiên liệu. Yamaha được ưa chuộng rộng rãi tại Việt Nam nhờ các dòng xe như Exciter, Sirius, NVX và Grande, phù hợp với nhiều đối tượng người dùng. Slogan nổi bật của hãng là “Revs your Heart”, thể hiện tinh thần năng động và đam mê tốc độ.MotoGP HHH', '2025-04-11 05:50:00', '2025-04-11 07:13:25'),
(5, 'BMW', 'BMW (viết tắt của Bayerische Motoren Werke AG) là một hãng sản xuất ô tô và xe máy cao cấp đến từ Đức, được thành lập vào năm 1916. BMW nổi tiếng với thiết kế sang trọng, hiệu suất vận hành mạnh mẽ và công nghệ tiên tiến. Thương hiệu này được xem là biểu tượng của sự đẳng cấp, thể thao và tinh tế, với các dòng xe nổi bật như Series 3, Series 5, X5, và i8. Slogan quen thuộc của BMW là: \"The Ultimate Driving Machine\" – tạm dịch: \"Cỗ máy lái tối thượng\".', '2025-04-11 07:25:24', '2025-04-11 07:25:24'),
(6, 'Suzuki', 'Suzuki là một tập đoàn đa quốc gia của Nhật Bản, chuyên sản xuất ô tô, xe máy, động cơ và các sản phẩm công nghiệp nhẹ. Được thành lập vào năm 1909 bởi Michio Suzuki, hãng ban đầu sản xuất máy dệt trước khi chuyển sang lĩnh vực xe cơ giới. Suzuki nổi tiếng với các dòng xe nhỏ gọn, tiết kiệm nhiên liệu và độ bền cao, phù hợp với nhiều thị trường trên thế giới. Ngoài ra, hãng cũng là một trong những nhà sản xuất xe máy hàng đầu toàn cầu, có mặt tại hơn 190 quốc gia và vùng lãnh thổ.', '2025-04-12 07:17:59', '2025-04-12 07:17:59'),
(7, 'Ducati', 'Ducati là một hãng xe mô tô nổi tiếng của Ý, được thành lập vào năm 1926. Thương hiệu này nổi bật với các dòng xe mô tô hiệu suất cao, thiết kế thể thao và âm thanh động cơ đặc trưng. Ducati đặc biệt nổi tiếng trong giới đua xe, với nhiều thành tích ấn tượng tại các giải MotoGP và World Superbike. Các sản phẩm của Ducati không chỉ mạnh mẽ về hiệu năng mà còn mang đậm phong cách Ý, thu hút đông đảo người đam mê xe trên toàn thế giới.', '2025-04-12 07:19:04', '2025-04-12 07:19:04'),
(8, 'Aprilia', 'Aprilia là một hãng xe mô tô đến từ Ý, được thành lập sau Thế chiến thứ hai vào năm 1945. Ban đầu, hãng sản xuất xe đạp, sau đó chuyển sang mô tô và xe tay ga. Aprilia nổi tiếng với những mẫu xe thể thao nhỏ gọn, hiệu suất cao và thiết kế cá tính. Hãng cũng ghi dấu ấn mạnh mẽ trong các giải đua quốc tế như MotoGP và World Superbike, với nhiều danh hiệu vô địch. Aprilia hiện là một phần của tập đoàn Piaggio – một trong những nhà sản xuất xe hai bánh lớn nhất châu Âu.', '2025-04-12 07:19:44', '2025-04-12 07:19:44'),
(9, 'KTM', 'KTM là một hãng xe mô tô đến từ Áo, được thành lập vào năm 1953. Hãng nổi tiếng toàn cầu với các dòng xe địa hình (off-road), xe enduro và motocross mạnh mẽ, bền bỉ. Trong những năm gần đây, KTM cũng phát triển mạnh các dòng xe thể thao và naked bike như Duke và RC. Với khẩu hiệu \"Ready to Race\", KTM thể hiện rõ định hướng hiệu suất cao và tinh thần đua xe, đồng thời là một trong những thương hiệu dẫn đầu tại các giải đua như Dakar Rally và MotoGP.', '2025-04-12 07:20:41', '2025-04-12 07:20:41'),
(10, 'Kawasaki', 'Kawasaki là một hãng xe mô tô nổi tiếng của Nhật Bản, trực thuộc tập đoàn công nghiệp nặng Kawasaki Heavy Industries. Được thành lập từ đầu thế kỷ 20, Kawasaki bắt đầu sản xuất mô tô từ những năm 1950 và nhanh chóng khẳng định tên tuổi với các dòng xe mạnh mẽ, bền bỉ và thiết kế ấn tượng. Hãng nổi bật với các mẫu xe thể thao như Ninja, dòng cruiser Vulcan, và các dòng xe địa hình. Kawasaki cũng tham gia tích cực vào các giải đua mô tô thế giới, thể hiện tinh thần công nghệ và hiệu suất cao đặc trưng của thương hiệu.', '2025-04-12 07:21:29', '2025-04-12 07:21:29'),
(11, 'Danh mục được sửa mới', 'nội dung được sửa mới', '2025-04-15 14:25:33', '2025-04-15 14:32:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_04_08_065802_create_users_table', 1),
(4, '2025_04_08_071508_create_categories_table', 1),
(5, '2025_04_08_071744_create_products_table', 1),
(6, '2025_04_08_074031_create_carts_table', 1),
(7, '2025_04_08_074939_create_cart__items_table', 1),
(8, '2025_04_08_081213_create_orders_table', 1),
(9, '2025_04_08_081521_create_order__items_table', 1),
(10, '2025_04_08_114347_create_likes_table', 1),
(11, '2025_04_08_115443_create_comments_table', 1),
(12, '2025_04_09_005934_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_order` datetime NOT NULL DEFAULT '2025-04-08 13:51:02',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_address` varchar(255) NOT NULL,
  `status` enum('pending','processing','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` enum('cod','momo','bank_transfer') NOT NULL DEFAULT 'cod',
  `payment_status` enum('unpaid','paid','failed') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date_order`, `total_amount`, `shipping_address`, `status`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(21, 6, '2025-04-15 21:50:10', 98000.00, 'hòa ninh, hòa vang, đà nẵng', 'cancelled', 'cod', 'unpaid', '2025-04-15 14:50:10', '2025-04-15 15:05:21'),
(22, 6, '2025-04-15 21:50:40', 45000.00, 'hòa ninh, hòa vang, đà nẵng', 'completed', 'cod', 'unpaid', '2025-04-15 14:50:40', '2025-04-15 14:53:43'),
(23, 6, '2025-04-15 21:50:59', 80000.00, 'hòa ninh, hòa vang, đà nẵng', 'cancelled', 'cod', 'unpaid', '2025-04-15 14:50:59', '2025-04-15 14:55:41'),
(24, 6, '2025-04-15 21:51:26', 55000.00, 'hòa ninh, hòa vang, đà nẵng', 'pending', 'momo', 'unpaid', '2025-04-15 14:51:26', '2025-04-15 14:57:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(8, 21, 5, 1, 98000.00, '2025-04-15 14:50:10', '2025-04-15 14:50:10'),
(9, 22, 6, 1, 45000.00, '2025-04-15 14:50:40', '2025-04-15 14:50:40'),
(10, 23, 10, 2, 40000.00, '2025-04-15 14:50:59', '2025-04-15 14:50:59'),
(11, 24, 11, 1, 55000.00, '2025-04-15 14:51:26', '2025-04-15 14:51:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT 0,
  `top` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `sale_price`, `new`, `top`, `image`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'CBR1000RR SP2', 'chưa có mô tả', 50000.00, 45000.00, 1, 0, '1744389188_cbr1000rr-sp2.jpg', 'active', 1, '2025-04-11 08:38:50', '2025-04-11 09:33:08'),
(3, 'S1000RR', 'chưa có mô tả', 50000.00, 45000.00, 0, 1, '1744389409_s1000rr.jpg', 'active', 5, '2025-04-11 09:36:49', '2025-04-13 00:15:53'),
(5, 'Ninja H2R', 'chưa có mô tả', 100000.00, 98000.00, 1, 1, '1744467773_ninja_h2r.jpg', 'active', 10, '2025-04-12 07:22:53', '2025-04-13 00:15:38'),
(6, 'Ninja H2SX', 'chưa có mô tả', 50000.00, 45000.00, 1, 0, '1744467843_ninja_h2_sx.jpg', 'active', 10, '2025-04-12 07:24:03', '2025-04-12 07:24:03'),
(7, 'R1M', 'chưa có mô tả', 60000.00, 55000.00, 1, 1, '1744467895_r1m.jpg', 'active', 2, '2025-04-12 07:24:55', '2025-04-12 07:24:55'),
(8, 'ZH2', 'chưa có mô tả', 50000.00, 48000.00, 0, 1, '1744467935_zh2.jpg', 'active', 10, '2025-04-12 07:25:35', '2025-04-13 00:15:28'),
(9, 'ZX10R', 'chưa có mô tả', 50000.00, 45000.00, 1, 1, '1744467974_zx10r.jpg', 'active', 10, '2025-04-12 07:26:14', '2025-04-12 07:26:14'),
(10, 'R6', 'chưa có mô tả', 40000.00, 0.00, 1, 0, '1744468037_r6.png', 'active', 2, '2025-04-12 07:27:17', '2025-04-13 00:15:18'),
(11, 'RSV4', 'chưa có mô tả', 55000.00, 0.00, 0, 1, '1744468086_rsv4.jpg', 'active', 8, '2025-04-12 07:28:06', '2025-04-12 07:28:06'),
(12, 'Duke 1290', 'chưa có mô tả', 45000.00, 0.00, 0, 1, '1744468157_duke1290.jpg', 'active', 9, '2025-04-12 07:29:17', '2025-04-12 07:29:17'),
(13, 'Superleggera', 'chưa có mô tả', 300000.00, 295000.00, 1, 0, '1744468212_SuperleggeraV4.jpg', 'active', 7, '2025-04-12 07:30:12', '2025-04-13 00:15:09'),
(14, 'S1000R', 'chưa có mô tả', 45000.00, 0.00, 0, 0, '1744468252_s1000r.jpg', 'active', 5, '2025-04-12 07:30:52', '2025-04-12 07:30:52'),
(15, 'GSXR1000', 'chưa có mô tả', 50000.00, 45000.00, 0, 0, '1744468324_gsxr1000.jpg', 'active', 6, '2025-04-12 07:32:04', '2025-04-12 07:32:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1QwSUqkt47hrvhF7Dn4bblL8NL0ttkTjXgWBwpXt', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidEZ3N2xtblpLSVJ6WGlQZk45bkE3TzFueFBpTDcyZHZERmNHZHFaaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9nZXRQcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1744756146),
('4rwgLGDUOZ6bafDF2mkTTjElgp5Jg5f9LeNdzmMM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDM3SmJkcEZxRFA0eTNYeTdaM3dPSHdXeUdjQUVBZTFzdGxtM0JPSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9fZGV0YWlscy85Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1744765962);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `phone`, `address`, `avatar`, `gender`, `date_of_birth`, `role`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin123@gmail.com', '$2y$12$iU67wGxWmIbuxL64V23rjeXM5j4jONZxAA7fzvadFVMRIeQ/djMV6', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-04-11 00:59:43', '2025-04-11 00:59:43'),
(6, 'phihung', 'hung1102@gmail.com', '$2y$12$2fnKObZhASQ/gpi8H7cqdODS8bFFtw83rFSVGZktdBZUatRvpeuTa', 'Nguyễn Phi Hùng', '0817423628', 'hòa ninh, hòa vang, đà nẵng', NULL, 'male', NULL, 3, '2025-04-15 14:06:33', '2025-04-15 14:50:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart__items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart__items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order__items_order_id_foreign` (`order_id`),
  ADD KEY `order__items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart__items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart__items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order__items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order__items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

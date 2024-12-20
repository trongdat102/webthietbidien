-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 06, 2024 lúc 03:41 PM
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
-- Cơ sở dữ liệu: `shopthietbidien`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_11_064721_create_tbl_admin_table', 1),
(6, '2024_10_11_073729_create_tbl_category_product', 2),
(7, '2024_10_11_081055_create_tbl_category_product', 3),
(8, '2024_10_12_093205_create_tbl_brand_product', 4),
(9, '2024_10_14_032707_create_tbl_provider_product', 5),
(10, '2024_10_14_133412_create_tbl_product', 6),
(11, '2024_10_16_024432_create_tbl_product', 7),
(12, '2024_10_24_104007_tbl_customer', 8),
(13, '2024_10_24_115513_tbl_shipping', 8),
(14, '2024_10_26_081900_tbl_payment', 8),
(15, '2024_10_26_082000_tbl_order', 8),
(16, '2024_10_26_082052_tbl_order_details', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
(1, 'dat@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dat', '0832128289', '2024-10-11 07:08:08', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_desc` text NOT NULL,
  `brand_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_desc`, `brand_status`, `created_at`, `updated_at`) VALUES
(8, 'PANASONIC', 'PANASONIC', 0, NULL, NULL),
(9, 'Schneider', 'Schneider', 0, NULL, NULL),
(11, 'LIOA', 'LIOA', 0, NULL, NULL),
(12, 'LS', 'LS', 0, NULL, NULL),
(13, 'SIMON', 'SIMON', 0, NULL, NULL),
(14, 'SINO', 'SINO', 0, NULL, NULL),
(15, 'Bticino', 'Bticino', 0, NULL, NULL),
(16, 'Vinakip', 'Vinakip', 0, NULL, NULL),
(17, 'Kottmann', 'Kottmann', 0, NULL, NULL),
(18, 'Goldcup', 'Goldcup', 0, NULL, NULL),
(19, 'Cadisun', 'Cadisun', 0, NULL, NULL),
(20, 'FSL', 'FSL', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` text NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_desc`, `category_status`, `created_at`, `updated_at`) VALUES
(10, 'Công tắc - ổ cắm', 'Công tắc - ổ cắm', 0, NULL, NULL),
(11, 'Thiết bị đóng cắt', 'Thiết bị đóng cắt', 0, NULL, NULL),
(12, 'Phích cắm', 'Phích cắm', 0, NULL, NULL),
(13, 'Dây điện và các phụ kiện khác', 'Dây điện và các phụ kiện khác', 0, NULL, NULL),
(14, 'Đèn chiếu sáng không gian', 'Đèn chiếu sáng không gian', 0, NULL, NULL),
(15, 'Đèn chiếu sáng trang trí', 'Đèn chiếu sáng trang trí', 0, NULL, NULL),
(16, 'Tủ điện', 'Tủ điện', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `created_at`, `updated_at`) VALUES
(1, 'Comestic V', 'dat@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0832128289', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `order_status` int(20) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `order_destroy` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `shipping_id`, `order_status`, `order_code`, `order_date`, `order_destroy`, `created_at`, `updated_at`) VALUES
(34, 1, 26, 1, 'faece', '0', '123', '2024-11-02 09:28:12', NULL),
(36, 1, 41, 5, '3130d', '2024-11-03', NULL, '2024-11-03 11:39:39', NULL),
(39, 1, 44, 3, '2d197', '2024-11-04', NULL, '2024-11-03 17:32:39', NULL),
(40, 1, 45, 4, '2e02b', '2024-11-04', 'ship lâu', '2024-11-03 17:52:28', NULL),
(41, 1, 46, 3, 'c64d0', '2024-11-04', 'thích thì hủy', '2024-11-03 17:56:38', NULL),
(42, 1, 47, 5, 'a9fd7', '2024-11-04', NULL, '2024-11-04 03:32:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_sales_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `order_code`, `product_id`, `product_name`, `product_price`, `product_sales_quantity`, `created_at`, `updated_at`) VALUES
(12, 'c51ad', 5, 'Phím che trơn 1M Bticino - HC4950', '36820', 3, NULL, NULL),
(13, 'c51ad', 33, 'Đèn âm trần vuông ML501-5W Maxlight', '98000', 4, NULL, NULL),
(14, 'c51ad', 34, 'Đèn âm trần Led 6018 - 12W (3 màu)', '150000', 4, NULL, NULL),
(15, 'c51ad', 35, 'Đèn âm trần 6018 - 12W (1 màu)', '100000', 2, NULL, NULL),
(16, 'adafb', 5, 'Phím che trơn 1M Bticino - HC4950', '36820', 3, NULL, NULL),
(17, 'adafb', 33, 'Đèn âm trần vuông ML501-5W Maxlight', '98000', 4, NULL, NULL),
(18, 'adafb', 34, 'Đèn âm trần Led 6018 - 12W (3 màu)', '150000', 4, NULL, NULL),
(19, 'adafb', 35, 'Đèn âm trần 6018 - 12W (1 màu)', '100000', 2, NULL, NULL),
(50, '7cb7c', 5, 'Phím che trơn 1M Bticino - HC4950', '36820', 3, NULL, NULL),
(51, '7cb7c', 33, 'Đèn âm trần vuông ML501-5W Maxlight', '98000', 4, NULL, NULL),
(52, '7cb7c', 34, 'Đèn âm trần Led 6018 - 12W (3 màu)', '150000', 4, NULL, NULL),
(53, '7cb7c', 35, 'Đèn âm trần 6018 - 12W (1 màu)', '100000', 2, NULL, NULL),
(65, 'd549e', 6, 'Hạt tivi RJ11- Biticino - HC/L/4258/11N', '464240', 10, NULL, NULL),
(66, 'd549e', 5, 'Phím che trơn 1M Bticino - HC4950', '36820', 2, NULL, NULL),
(67, 'd549e', 8, 'Khung đỡ mặt 3M Acelus Biticino - H4703', '50330', 1, NULL, NULL),
(68, 'd549e', 27, 'ĐÈN LED BULB 50W AK', '100000', 1, NULL, NULL),
(69, 'd549e', 31, 'Bóng Led MR16 5W - FSL', '52800', 1, NULL, NULL),
(70, 'd549e', 34, 'Đèn âm trần Led 6018 - 12W (3 màu)', '150000', 4, NULL, NULL),
(71, 'd549e', 22, 'Dây đơn VCSF Cadisun 1 x 0,75', '2523', 1, NULL, NULL),
(72, 'd549e', 29, 'Bóng Bulb Led 4W G45/E27 - FSL', '45000', 1, NULL, NULL),
(73, 'd549e', 26, 'Cáp treo CV 1x70 Goldcup (lõi cứng)', '178732', 1, NULL, NULL),
(74, 'd549e', 40, 'Vỏ tủ điện ngoài trời LiOA JL-00C', '154000', 1, NULL, NULL),
(75, 'faece', 7, 'Ổ cắm đôi 3 chấu Bticino - HC4185', '519260', 5, NULL, NULL),
(76, 'faece', 6, 'Hạt tivi RJ11- Biticino - HC/L/4258/11N', '464240', 5, NULL, NULL),
(77, '088d0', 40, 'Vỏ tủ điện ngoài trời LiOA JL-00C', '154000', 5, NULL, NULL),
(78, '3130d', 27, 'ĐÈN LED BULB 50W AK', '100000', 1, NULL, NULL),
(79, '0adac', 17, 'Ổ cắm có dây 6 ổ 3 chấu Panasonic - WCHG2836', '799000', 5, NULL, NULL),
(80, '0adac', 18, 'Ổ cắm liền dây 6 lỗ LIOA - 6D52N/WN', '172500', 6, NULL, NULL),
(81, '00928', 41, 'Hộp chứa 3 át MCB nổi 4CC3 Sino', '38000', 1, NULL, NULL),
(82, '00928', 40, 'Vỏ tủ điện ngoài trời LiOA JL-00C', '154000', 1, NULL, NULL),
(83, '00928', 31, 'Bóng Led MR16 5W - FSL', '52800', 1, NULL, NULL),
(84, '2d197', 5, 'Phím che trơn 1M Bticino - HC4950', '36820', 2, NULL, NULL),
(85, '2d197', 22, 'Dây đơn VCSF Cadisun 1 x 0,75', '2523', 3, NULL, NULL),
(86, '2d197', 21, 'Dây tiếp địa Cadisun 1 x 6', '17622', 1, NULL, NULL),
(87, '2e02b', 10, 'Contactor 32A Schneider - LC1D32Q7', '1072170', 3, NULL, NULL),
(88, '2e02b', 11, 'Contactor 40A 220V Schneider - LC1D40AM7', '1956240', 1, NULL, NULL),
(89, '2e02b', 12, 'Aptomat MCB BKN 3P 63A LS', '196080', 1, NULL, NULL),
(90, 'c64d0', 5, 'Phím che trơn 1M Bticino - HC4950', '36820', 1, NULL, NULL),
(91, 'c64d0', 8, 'Khung đỡ mặt 3M Acelus Biticino - H4703', '50330', 1, NULL, NULL),
(92, 'c64d0', 6, 'Hạt tivi RJ11- Biticino - HC/L/4258/11N', '464240', 4, NULL, NULL),
(93, 'a9fd7', 28, 'ĐÈN LED BULB DOB 40W (DOB-LB-40-T5)', '136230', 1, NULL, NULL),
(94, 'a9fd7', 20, 'Ổ cắm điện chống sét lan truyền APC PM53-VN Schneider', '800000', 1, NULL, NULL),
(95, 'a9fd7', 19, 'Ổ cắm liền dây 4 lỗ Lioa - 4D32N', '104000', 1, NULL, NULL),
(96, 'a9fd7', 17, 'Ổ cắm có dây 6 ổ 3 chấu Panasonic - WCHG2836', '799000', 1, NULL, NULL),
(97, 'a9fd7', 18, 'Ổ cắm liền dây 6 lỗ LIOA - 6D52N/WN', '172500', 1, NULL, NULL),
(98, 'a9fd7', 41, 'Hộp chứa 3 át MCB nổi 4CC3 Sino', '38000', 1, NULL, NULL),
(99, 'a9fd7', 42, 'Hộp chứa 6 át MCB nổi 4CC6 Sino', '55000', 1, NULL, NULL),
(100, 'a9fd7', 40, 'Vỏ tủ điện ngoài trời LiOA JL-00C', '154000', 1, NULL, NULL),
(101, 'a9fd7', 11, 'Contactor 40A 220V Schneider - LC1D40AM7', '1956240', 1, NULL, NULL),
(102, 'a9fd7', 12, 'Aptomat MCB BKN 3P 63A LS', '196080', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Đang chờ xử lý', NULL, NULL),
(2, '1', 'Đang chờ xử lý', NULL, NULL),
(3, '1', 'Đang chờ xử lý', NULL, NULL),
(4, '1', 'Đang chờ xử lý', NULL, NULL),
(5, '1', 'Đang chờ xử lý', NULL, NULL),
(6, '1', 'Đang chờ xử lý', NULL, NULL),
(7, '1', 'Đang chờ xử lý', NULL, NULL),
(8, '2', 'Đang chờ xử lý', NULL, NULL),
(9, '2', 'Đang chờ xử lý', NULL, NULL),
(10, '2', 'Đang chờ xử lý', NULL, NULL),
(11, '2', 'Đang chờ xử lý', NULL, NULL),
(12, '2', 'Đang chờ xử lý', NULL, NULL),
(13, '2', 'Đang chờ xử lý', NULL, NULL),
(14, '2', 'Đang chờ xử lý', NULL, NULL),
(15, '2', 'Đang chờ xử lý', NULL, NULL),
(16, '2', 'Đang chờ xử lý', NULL, NULL),
(17, '2', 'Đang chờ xử lý', NULL, NULL),
(18, '2', 'Đang chờ xử lý', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` varchar(50) NOT NULL,
  `product_sold` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_content` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_name`, `product_quantity`, `product_sold`, `brand_id`, `provider_id`, `product_desc`, `product_content`, `product_price`, `product_image`, `product_status`, `created_at`, `updated_at`) VALUES
(5, 10, 'Phím che trơn 1M Bticino - HC4950', '51', 67, 15, 6, 'Phím che trơn 1M Bticino - HC4950', '>', '36820', 'Phím che trơn 1M Bticino - HC4950.jpg', 0, NULL, NULL),
(6, 10, 'Hạt tivi RJ11- Biticino - HC/L/4258/11N', '14', 36, 15, 6, 'Hạt tivi RJ11- Biticino - HC/L/4258/11N', '', '464240', 'Hạt tivi RJ11- Biticino.jpg', 0, NULL, NULL),
(7, 10, 'Ổ cắm đôi 3 chấu Bticino - HC4185', '95', 5, 15, 6, 'Ổ cắm đôi 3 chấu Bticino - HC4185', '', '519260', 'Ổ cắm đôi 3 chấu Bticino - HC4185.jpg', 0, NULL, NULL),
(8, 10, 'Khung đỡ mặt 3M Acelus Biticino - H4703', '195', 5, 15, 6, 'Khung đỡ mặt 3M Acelus Biticino - H4703', '', '50330', 'Khung đỡ mặt 3M Acelus Biticino - H4703.jpg', 0, NULL, NULL),
(9, 10, 'Mặt 3M kính xanh - HA4803VSA', '40', 0, 15, 6, 'Mặt 3M kính xanh - HA4803VSA', '', '1121470', 'Mặt 3M kính xanh - HA4803VSA.jpg', 0, NULL, NULL),
(10, 11, 'Contactor 32A Schneider - LC1D32Q7', '80', 0, 9, 5, 'Contactor 32A Schneider - LC1D32Q7', '- Mã hàng: LC1D32AQ7\r\n- Số cực: 3P\r\n- Dòng điện định mức: 40A\r\n- Công suất định mức: 15kW\r\n- Tiếp điểm phụ: N/O + N/C\r\n- Điện áp: 380VAC\r\n- Tiêu chuẩn: IEC 60947\r\n\r\n', '1072170', 'Contactor 32A Schneider - LC1D32Q7.jpg', 0, NULL, NULL),
(11, 11, 'Contactor 40A 220V Schneider - LC1D40AM7', '98', 2, 9, 5, 'Contactor 40A 220V Schneider - LC1D40AM7', '- Mã hàng: LC1D40AM7\r\n- Số cực: 3P\r\n- Dòng điện định mức: 40A\r\n- Công suất định mức: 18.5kW\r\n- Tiếp điểm phụ: N/O + N/C\r\n- Điện áp: 220VAC\r\n- Tiêu chuẩn: IEC 60947', '1956240', 'Contactor 40A 220V Schneider - LC1D40AM7.jpg', 0, NULL, NULL),
(12, 11, 'Aptomat MCB BKN 3P 63A LS', '48', 52, 12, 3, 'Aptomat MCB BKN 3P 63A LS', 'Số cực: 3\r\nDòng định mức In (A): 63A\r\nDòng rò (mA): –\r\nDòng ngắn mạch Icu (kA): 6kA\r\nĐiện áp làm việc định mức Ue (V): –\r\nĐiện áp cách điện định mức Ui (V): (1 pole) 230/400VAC 50/60Hz\r\nĐiện áp chịu xung định mức Uimp: 6kV\r\nPhụ kiện: Shuntrip, tiếp điểm phụ, tiếp điểm cảnh báo,cáp điện\r\nTiêu chuẩn: IEC 60898', '196080', 'Aptomat MCB BKN 3P 63A LS.jpg', 0, NULL, NULL),
(13, 11, 'Aptomat MCB BKN 3P 16A LS', '70', 0, 12, 5, 'Aptomat MCB BKN 3P 16A LS', 'Số cực: 3\r\nDòng định mức In (A): 16A\r\nDòng rò (mA): –\r\nDòng ngắn mạch Icu (kA): 6kA\r\nĐiện áp làm việc định mức Ue (V): –\r\nĐiện áp cách điện định mức Ui (V): (1 pole) 230/400VAC 50/60Hz\r\nĐiện áp chịu xung định mức Uimp: 6kV\r\nPhụ kiện: Shuntrip, tiếp điểm phụ, tiếp điểm cảnh báo,cáp điện\r\nTiêu chuẩn: IEC 60898', '192660', 'Aptomat MCB BKN 3P 16A LS.jpg', 0, NULL, NULL),
(14, 11, 'Cầu dao điện đảo chiều 2 pha 100A/600V - Vinakip', '100', 0, 16, 4, 'Cầu dao điện đảo chiều 2 pha 100A/600V - Vinakip', 'Loại càu dao: Cầu dao 2 chiều, Cầu dao đảo.\r\nĐiện áp danh định: 100A - 600 V ~\r\nSố cực: 2 cực\r\nÁp dụng tiêu chuẩn: Đối với gam dòng Iđm > 63 A: TCVN 6592-3 (IEC 60947-3), Đối với gam dòng Iđm ≤ 63 A: TCVN 6480-1 (IEC 60669-1)\r\nCông dụng: Đảo chiều nguồn điện\r\nỨng dụng: Để lắp đặt trong nhà hoặc có mái che.', '325000', 'Cầu dao điện đảo chiều 2 pha 100A600V.jpg', 0, NULL, NULL),
(15, 11, 'Cầu dao điện đảo chiều 3 pha 60A/600V - Vinakip', '100', 0, 16, 1, 'Cầu dao điện đảo chiều 3 pha 60A/600V - Vinakip', 'Loại càu dao: Cầu dao 2 chiều, Cầu dao đảo.\r\nĐiện áp danh định: 60A - 600 V ~\r\nSố cực: 3 cực\r\nÁp dụng tiêu chuẩn: Đối với gam dòng Iđm > 63 A: TCVN 6592-3 (IEC 60947-3), Đối với gam dòng Iđm ≤ 63 A: TCVN 6480-1 (IEC 60669-1)\r\nCông dụng: Đảo chiều nguồn điện\r\nỨng dụng: Để lắp đặt trong nhà hoặc có mái che.', '200000', 'Cầu dao điện đảo chiều 3 pha 60A600V - Vinakip.jpg', 0, NULL, NULL),
(16, 12, 'Ổ cắm dây 3 ổ 3 chấu Panasonic - WCHG24332W', '100', 0, 8, 4, 'Ổ cắm dây 3 ổ 3 chấu Panasonic - WCHG24332W', 'Mã sản phẩm: WCHG24332W\r\nXuất xứ: Thái Lan\r\nĐiện áp: 220-250V\r\nDòng điện định mức: 16A\r\nMàu sắc: Trắng\r\nChiều dài dây: 3m\r\nTiêu chuẩn: TIS Nhật Bản', '440000 ', 'Ổ cắm dây 3 ổ 3 chấu Panasonic - WCHG24332W.jpg', 0, NULL, NULL),
(17, 12, 'Ổ cắm có dây 6 ổ 3 chấu Panasonic - WCHG2836', '88', 12, 8, 4, 'Ổ cắm có dây 6 ổ 3 chấu Panasonic - WCHG2836', 'Mã sản phẩm: WCHG2836\r\nXuất xứ:Thái Lan\r\nĐiện áp:220-250V\r\nDòng điện định mức: 16A\r\nMàu sắc: Trắng\r\nChiều dài dây: 3m\r\nTiêu chuẩn: TIS Nhật Bản', '799000', 'Ổ cắm có dây 6 ổ 3 chấu Panasonic - WCHG2836.jpg', 0, NULL, NULL),
(18, 12, 'Ổ cắm liền dây 6 lỗ LIOA - 6D52N/WN', '86', 14, 11, 1, 'Ổ cắm liền dây 6 lỗ LIOA - 6D52N/WN', 'Model: 6D52N/WN\r\nSố ổ cắm: 06 ổ 3 chấu đa năng\r\nMàu sắc: Vỏ ổ cắm màu đen, ổ cắm mầu xanh, đỏ vàng…..\r\nChiều dài dây: 5m\r\nTiết diện dây: 2×0.75mm\r\nSố lõi dây: 02 Lõi\r\nCông suất tối đa: 2200W\r\nDòng cực đại: 10A\r\nBảo vệ: CB chống quá tải\r\nSố công tắc: 02 Cái\r\nPhích cắm tương ứng: Cắm được hầu hết tất cả các loại phích cắm trên thế giới', '172500', 'Ổ cắm liền dây 6 lỗ LIOA - 6D52NWN.jpg', 0, NULL, NULL),
(19, 12, 'Ổ cắm liền dây 4 lỗ Lioa - 4D32N', '98', 2, 11, 1, 'Ổ cắm liền dây 4 lỗ Lioa - 4D32N', 'Model: 4D32N\r\nSố ổ cắm: 04 ổ 3 chấu đa năng\r\nMàu sắc: Vỏ ổ cắm màu đen, ổ cắm mầu xanh, đỏ vàng…..\r\nChiều dài dây: 3m\r\nTiết diện dây: 2×0.75mm\r\nSố lõi dây: 02 Lõi\r\nCông suất tối đa: 2200W\r\nDòng cực đại: 10A\r\nBảo vệ: CB chống quá tải\r\nSố công tắc: 01 Cái\r\nPhích cắm tương ứng: Cắm được hầu hết tất cả các loại phích cắm trên thế giới', '104000', 'Ổ cắm liền dây 4 lỗ Lioa - 4D32N.jpg', 0, NULL, NULL),
(20, 12, 'Ổ cắm điện chống sét lan truyền APC PM53-VN Schneider', '98', 2, 9, 5, 'Ổ cắm điện chống sét lan truyền APC PM53-VN Schneider', 'Số lượng cổng: 5 cổng 3 chấu\r\nChuẩn kết nối: NEMA Universal\r\nĐiện áp định danh: 220V / 230V / 240V\r\nCông suất: 2500W\r\nTần số: 50/60Hz\r\nChuẩn kết nối: NEMA 5-15P\r\nChiều dài dây nguồn: 3m\r\nDòng điện ngõ vào cực đại cho phép: 10A', '800000', 'Ổ cắm điện chống sét lan truyền APC PM53-VN Schneider.jpg', 0, NULL, NULL),
(21, 13, 'Dây tiếp địa Cadisun 1 x 6', '109', -9, 19, 7, 'Dây tiếp địa Cadisun 1 x 6', '', '17622', 'Dây tiếp địa Cadisun 1 x 6.jpg', 0, NULL, NULL),
(22, 13, 'Dây đơn VCSF Cadisun 1 x 0,75', '121', -21, 19, 7, 'Dây đơn VCSF Cadisun 1 x 0,75', '', '2523', 'Dây đơn VCSF Cadisun 1 x 0,75.jpg', 0, NULL, NULL),
(23, 13, 'Dây đôi VCTFK Cadisun 2 x 0,75', '100', 0, 19, 7, 'Dây đôi VCTFK Cadisun 2 x 0,75', '', '5669', 'Dây đôi VCTFK Cadisun 2 x 0,75.jpg', 0, NULL, NULL),
(24, 13, 'Cáp mềm CV 1x25 Goldcup', '100', 0, 18, 7, 'Cáp mềm CV 1x25 Goldcup', '- Kết cấu:\r\n+ Lõi dẫn điện/Conductor: Đồng/Copper\r\n+ Lớp cách điện/Insulation: PVC\r\n- Dây điện 1 lõi ruột mềm bọc cách điện PVC 450/750V - Cu/PVC thuộc sản phẩm dây điện dân dụng.\r\n- Dây điện 1 lõi ruột mềm bọc cách điện PVC 450/750V - Cu/PVC có kết cấu gồm 02 lớp như trên.\r\n- Dây được ứng dụng để lắp đặt trong hệ thống điện của các ngôi nhà nói riêng và các công trình xây dựng nói chung như trường học, bệnh viện, văn phòng…', '68812', 'Cáp mềm CV 1x25 Goldcup.jpg', 0, NULL, NULL),
(25, 13, 'Cáp mềm CV 1x10 Goldcup', '100', 0, 18, 7, 'Cáp mềm CV 1x10 Goldcup', '-Kết cấu: \r\n+ Lõi dẫn điện/Conductor: Đồng/Copper\r\n+ Lớp cách điện/Insulation: PVC\r\n- Dây điện 1 lõi ruột mềm bọc cách điện PVC 450/750V - Cu/PVC thuộc sản phẩm dây điện dân dụng.\r\n- Dây điện 1 lõi ruột mềm bọc cách điện PVC 450/750V - Cu/PVC có kết cấu gồm 02 lớp như trên.\r\n- Dây được ứng dụng để lắp đặt trong hệ thống điện của các ngôi nhà nói riêng và các công trình xây dựng nói chung như trường học, bệnh viện, văn phòng…', '29398', 'Cáp mềm CV 1x10 Goldcup.jpg', 0, NULL, NULL),
(26, 13, 'Cáp treo CV 1x70 Goldcup (lõi cứng)', '94', 6, 16, 7, 'Cáp treo CV 1x70 Goldcup (lõi cứng)', '- Kết cấu:\r\n+ Lõi dẫn điện/Conductor: Đồng/Copper\r\n+ Lớp cách điện/Insulation: PVC\r\n- Dây điện 1 lõi bọc cách điện PVC 450/750V - Cu/PVC thuộc sản phẩm dây điện dân dụng.\r\n- Dây điện 1 lõi bọc cách điện PVC 450/750V - Cu/PVC có kết cấu gồm 02 lớp như trên.\r\n- Dây được ứng dụng để lắp đặt trong hệ thống điện của các ngôi nhà nói riêng và các công trình xây dựng nói chung như trường học, bệnh viện, văn phòng…', '178732', 'Cáp treo CV 1x70 Goldcup (lõi cứng).jpg', 0, NULL, NULL),
(27, 14, 'ĐÈN LED BULB 50W AK', '93', 7, 8, 4, 'ĐÈN LED BULB 50W AK', '- Công suất: 50W\r\n- Ánh sáng: Trắng\r\n- Chỉ số hoàn màu:  >=  80 RA\r\n- Điện áp vào:  220V – 50Hz  \r\n- Đuôi đèn:  E27\r\n- Tản nhiệt:  Rãnh nhôm cao cấp\r\n- Tuổi thọ:  20.000 giờ\r\n- Chất liệu:  Nhựa, inox, nhôm\r\n- Thiết kế:  Kín nước', '100000', 'ĐÈN LED BULB 50W AK.jpg', 0, NULL, NULL),
(28, 14, 'ĐÈN LED BULB DOB 40W (DOB-LB-40-T5)', '98', 2, 8, 4, 'ĐÈN LED BULB DOB 40W (DOB-LB-40-T5)', '- Đạt tiêu chuẩn IP44 trống bụi, côn trùng và nước mưa. Có thể sử dụng ngoài trời với đui đèn chống nước\r\n- Đèn áp dụng công nghệ DOB và chipled led cao cấp có quang hiệu đạt 120 Lm/W giúp tiết kiệm điện tối ưu\r\n- Hệ số hoàn màu CRI cao vượt trội (CRI > 90) cho màu sắc ánh sáng trung thực, giúp bảo vệ mắt và chống cận thị\r\n- Toàn bộ đèn Bulb DOB được bảo hành 2 năm đổi mới trên toàn quốc.', '136230', 'ĐÈN LED BULB DOB 40W (DOB-LB-40-T5).jpg', 0, NULL, NULL),
(29, 14, 'Bóng Bulb Led 4W G45/E27 - FSL', '94', 6, 20, 8, 'Bóng Bulb Led 4W G45/E27 - FSL', 'Bóng đèn LED dây tóc EDISON lấy cảm hứng từ đèn sợi đốt cổ điển nhưng sử dụng các chip LED làm nguồn sáng giống với các sợi dây tóc trong khi tiết kiệm điện tới 90%.  Chúng là kết hợp giữa hiện đại và cổ điển với công nghệ LED mới nhất để mang đến một trải nghiệm ánh sáng hoàn toàn mới. Các nhà thiết kế ánh sáng tạo ra các bóng đèn độc đáo này nhằm đáp ứng nhu cầu ngày càng tăng về hiệu quả năng lượng, chất lượng ánh sáng cũng như thẩm mỹ. \r\nKết nối chip hiệu suất cao cũng như mối hàn giữa các sợi và dây tiếp xúc đảm bảo bóng đèn dây tóc LED của FSL có hiệu quả năng lượng tuyệt vời. Thiết kế cho phép nhiệt sinh ra từ các chip được làm mát nhanh chóng, cho phép bóng đèn hoạt động an toàn và lâu dài. Vỏ bóng thủy tinh là một vỏ bọc lý tưởng mang lại tính thẩm mỹ cổ điển của bóng đèn Edison cũng như độ truyền ánh sáng cao và tản nhiệt tốt.', '45000', 'Bóng Bulb Led 4W G45E27 - FSL.jpg', 0, NULL, NULL),
(30, 14, 'Bóng bulb nhót C38GJ-5W E14 FSL', '100', 0, 20, 8, 'Bóng bulb nhót C38GJ-5W E14 FSL', '- Công suất : 3W/5W\r\n- Điện áp: AC 220 - 240V\r\n- Đui đèn: E24\r\n- Nhiệt độ màu : 3000K / 4000K / 6500K\r\n- Quang thông: 240/400 lumen\r\n- Kích thước : 35 x 125/38 x 108mm\r\n- Tuổi thọ : >20.000 giờ', '49200 ', 'Bóng bulb nhót C38GJ-5W E14 FSL.jpg', 0, NULL, NULL),
(31, 14, 'Bóng Led MR16 5W - FSL', '91', 9, 20, 8, 'Bóng Led MR16 5W - FSL', '– Tiết kiệm điện năng khi sử dụng bóng chén halogen thông thường: Bóng LED chân ghim  MR16 4,5W có độ sáng tương đương bóng chén halogen công suất 25W\r\n– Tuổi thọ cao, giảm thiểu thay thế thiết bị chiếu sáng\r\n– Không có thủy ngân, chì, kim loại nặng hay những chất có hại tới sức khỏe con người\r\n– Tỏa nhiệt của đèn là thấp hơn rất nhiều so với đèn thông thường\r\n– Thân thiện với môi trường', '52800 ', 'Bóng Led MR16 5W - FSL.jpg', 0, NULL, NULL),
(32, 14, 'Bóng bulb led 7W FSL (AS vàng)', '100', 0, 20, 8, 'Bóng bulb led 7W FSL (AS vàng)', '– Vật liệu chế tạo đèn không chưa các chất thủy ngân, photpho và tạp chất khác gây tác hại cho sức khỏe con người, thân thiện với môi trường.\r\n– Hiệu suất phát sáng cao 75 ~ 85 Lm/W\r\n– Hiệu quả năng lượng từ 75% ~ 80% điện năng đảm bảo chất lượng nguồn sáng.\r\n– Độ ẩm làm việc phù hợp từ 10 % – 90%\r\n– Hệ số công suất đạt 0,5\r\n– Cấp độ bảo vệ: IP20\r\n– Tuổi thọ tương đương 15.000 h', '39000', 'Bóng bulb led 7W FSL (AS vàng).jpg', 0, NULL, NULL),
(33, 15, 'Đèn âm trần vuông ML501-5W Maxlight', '80', 20, 8, 4, 'Đèn âm trần vuông ML501-5W Maxlight', '- Mã sản phẩm; ML501\r\n- Công suất: 20W\r\n- Lỗ khoét: 8 x 8 cm\r\n- Màu sắc: 2 màu: Trắng / Đen\r\n- Ánh sáng: 3000K - 6000K\r\n- Kích thước: 10 x 10 x 2 cm\r\n- Tuổi thọ: 25.000 giờ\r\n- Điện áp: 85 - 265\r\n\r\n ', '98000', 'Đèn âm trần vuông ML501-5W Maxlight.jpg', 0, NULL, NULL),
(34, 15, 'Đèn âm trần Led 6018 - 12W (3 màu)', '56', 44, 8, 4, 'Đèn âm trần Led 6018 - 12W (3 màu)', '- Mã sản phẩm: 6018\r\n- Công suất: 9W\r\n- Đường kính: D90\r\n- 3 Chế độ ánh sáng: Trắng / Vàng / Trung tính\r\n- Nhiệt độ màu: 6000K / 3000K / 4000K\r\n- Chất liệu đèn: Hợp kim + kính meka\r\n- Điện áp: 220V', '150000', 'Đèn âm trần Led 6018 - 12W (3 màu).jpg', 0, NULL, NULL),
(35, 15, 'Đèn âm trần 6018 - 12W (1 màu)', '90', 10, 8, 4, 'Đèn âm trần 6018 - 12W (1 màu)', '- Mã sản phẩm: 6018\r\n- Công suất: 12W\r\n- Đường kính: D110\r\n- 1 Chế độ ánh sáng: Trắng / Vàng \r\n- Nhiệt độ màu: 6000K / 3000K / 4000K\r\n- Chất liệu đèn: Hợp kim + kính meka\r\n- Điện áp: 220V', '100000', 'Đèn âm trần 6018 - 12W (1 màu).jpg', 0, NULL, NULL),
(36, 15, 'Đèn bàn học 71567 Philips', '100', 0, 8, 4, 'Đèn bàn học 71567 Philips', '1. Đèn bàn Philips 71567 Green được thiết kế với kích thước nhỏ gọn và tiện dụng cho người dùng hiện nay là 317x155x410mm, thích hợp để bàn mà bạn không cần phải sợ chiếm quá nhiều diện tích.\r\n2. Được thiết kế với đuôi đèn E27, tiện lợi cho quá trình lắp đặt thay thế cũng như sử dụng bởi đuôi đèn rất phổ biến và đã quá thân thuộc với người dùng hiện nay trên thị trường.\r\n3. Đèn bàn Philips 71567 Green sử dụng mức công suất tối đa là 11W và hoạt động tốt nhất trong dải điện áp từ 220-240V. Tùy theo diện tích không gian cũng như nhu cầu sử dụng mà bạn có thể lựa chọn mức công suất phù hợp nhất.\r\n4. Đèn bàn Philips 71567 Green được sản xuất từ chất liệu nhựa cao cấp, mang đến cho người dùng vẻ đẹp thẩm mỹ cao cũng như giúp kéo dài thời gian sử dụng bóng đèn để bạn có thể tha hồ sử dụng trong một thời gian dài mà không cần phải lo lắng thay thế thường xuyên sản phẩm mới.', '40000', 'Đèn bàn học 71567 Philips.jpg', 0, NULL, NULL),
(37, 15, 'Đèn soi tranh LED 2 bóng 8285', '100', 0, 9, 5, 'Đèn soi tranh LED 2 bóng 8285', '', '150000', 'Đèn soi tranh LED 2 bóng 8285.jpg', 0, NULL, NULL),
(38, 15, 'Đèn soi tranh LED 3 bóng 8285', '100', 0, 9, 8, 'Đèn soi tranh LED 3 bóng 8285', '>', '225000', 'Đèn soi tranh LED 3 bóng 8285.jpg', 0, NULL, NULL),
(39, 15, 'Đèn soi tranh LED 6 bóng 8896', '100', 0, 9, 5, 'Đèn soi tranh LED 6 bóng 8896', '>', '450000', 'Đèn soi tranh LED 6 bóng 8896.jpg', 0, NULL, NULL),
(40, 16, 'Vỏ tủ điện ngoài trời LiOA JL-00C', '89', 11, 11, 1, 'Vỏ tủ điện ngoài trời LiOA JL-00C', 'Tủ điện trong nhà và ngoài trời LiOA JL-00C hay còn gọi là Hộp kỹ thuật LiOA JL-00C. Đây là sản phẩm do LiOA sản xuất, giúp bảo vệ các thiết bị điện được lắp đặt ngoài trời. Có tác dụng chống mưa gió, đảm bảo tuổi thọ của thiết bị điện và đảm bảo an toàn khi sử dụng.\r\nTủ điện ngoài trời Lioa JL-00C được sản xuất trên dây chuyền hiện đại với nhựa ABS bền bỉ, chịu được va đập. Đồng thời được thiết kế kín nước 100% khi lắp đặt ngoài trời nên được các chuyên gia tin dùng.\r\nBên cạnh việc dùng ngoài trời, hộp kỹ thuật điện Lioa còn được sử dụng để lắp thiết bị điện trong môi trường ẩm, ăn mòn. Hộp có thiết kế hình hộp chữ nhật, có ron cao su chống nước và thanh ray lắp CB.\r\nHộp kỹ thuật LIOA có 2 loại với kích thước 180x140mm mã hàng là LiOA JL-00B và 235 x 178mm với mã JL-00C.>', '154000', 'Vỏ tủ điện ngoài trời LiOA JL-00C.jpg', 0, NULL, NULL),
(41, 16, 'Hộp chứa 3 át MCB nổi 4CC3 Sino', '95', 5, 14, 7, 'Hộp chứa 3 át MCB nổi 4CC3 Sino', 'Hộp chứa MCB gắn nổi hộp chứa bảo vệ MCB từ bên ngoài, cung cấp đầy đủ các loại thiết bị điện và phụ kiện: hộp chứa MCB các loại, số lượng từ 1 - 3 MCB, hộp cầu dao an toàn, bảo vệ cầu dao từ các tác động bên ngoài>', '38000', 'Hộp chứa 3 át MCB nổi 4CC3 Sino.jpg', 0, NULL, NULL),
(42, 16, 'Hộp chứa 6 át MCB nổi 4CC6 Sino', '98', 2, 14, 4, 'Hộp chứa 6 át MCB nổi 4CC6 Sino', 'Hộp chứa MCB gắn nổi hộp chứa bảo vệ MCB từ bên ngoài, cung cấp đầy đủ các loại thiết bị điện và phụ kiện: hộp chứa MCB các loại, số lượng từ 1 - 6 MCB, hộp cầu dao an toàn, bảo vệ cầu dao từ các tác động bên ngoài>', '55000', 'Hộp chứa 6 át MCB nổi 4CC6 Sino.jpg', 0, NULL, NULL),
(44, 16, 'Tủ điện âm tường Sino E4FC8/12LA', '100', 0, 14, 6, 'Tủ điện âm tường Sino E4FC8/12LA', 'Tủ điện âm tường E4FC8/12LA mặt nhựa ABS, nắp che Polycarbonnate dùng chứa MCB, RCCB, RCBO. Tủ có đế nhựa chứa 8 – 12 Module được lắp đặt và sử dụng rất phổ biến.>', '180000', 'Tủ điện âm tường Sino E4FC812LA.jpg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_provider_product`
--

CREATE TABLE `tbl_provider_product` (
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `provider_desc` text NOT NULL,
  `provider_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_provider_product`
--

INSERT INTO `tbl_provider_product` (`provider_id`, `provider_name`, `provider_desc`, `provider_status`, `created_at`, `updated_at`) VALUES
(1, 'LIOA', 'LIOA', 0, NULL, NULL),
(3, 'LS', 'LS', 0, NULL, NULL),
(4, 'PANASONIC', 'PANASONIC', 0, NULL, NULL),
(5, 'SCHNEIDER', 'SCHNEIDER', 0, NULL, NULL),
(6, 'Bticino', 'Bticino', 0, NULL, NULL),
(7, 'Cadisun', 'Cadisun', 0, NULL, NULL),
(8, 'FSL', 'FSL', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_email` varchar(255) NOT NULL,
  `shipping_notes` text NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `shipping_name`, `shipping_address`, `shipping_phone`, `shipping_email`, `shipping_notes`, `shipping_method`, `created_at`, `updated_at`) VALUES
(12, 'Trong Dat', 'VN', '0101010011', 'dat456@gmail.com', 'Ship', 0, NULL, NULL),
(13, 'Trong Dat', 'VN', '0101010011', 'dat456@gmail.com', 'Ship', 0, NULL, NULL),
(21, 'a', 'a', 'a', 'dat@gmail.com', 'a', 0, NULL, NULL),
(25, 'Nguyễn Trọng Đạt', 'Cát Bi', '0832128289', 'dat.trong.1002@gmail.com', 'Ship hỏa tốc', 0, NULL, NULL),
(26, 'Nguyễn Trọng Đạt', 'Cát Bi', '0832128289', 'dat.trong.1002@gmail.com', 'Ship trong ngày', 0, NULL, NULL),
(27, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'Đơn hàng mới', 0, NULL, NULL),
(28, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(29, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(30, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(31, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(32, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(33, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(34, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(35, 'Nguyễn Trọng Đạt', '123/HaiPhong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(36, 'Nguyễn Trọng Đạt', '123/HaiPhong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(37, 'Nguyễn Trọng Đạt', '123/HaiPhong', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(38, 'Nguyễn Trọng Đạt', 'Cát Bi', '0832128289', 'dat.trong.1002@gmail.com', '1213', 1, NULL, NULL),
(39, '12312312', '1233123', '123123', '3123123', '123123123123', 0, NULL, NULL),
(40, 'Nguyễn Trọng Đạt', '123/HaiPhong', '0832128289', 'dat.trong.1002@gmail.com', '123', 0, NULL, NULL),
(41, 'Nguyễn Trọng Đạt', 'Cát Bi', '0832128289', 'dat.trong.1002@gmail.com', 'mới', 0, NULL, NULL),
(42, 'Nguyễn Trọng Đạt', '123/HaiPhong', '0832128289', 'dat.trong.1002@gmail.com', '123', 0, NULL, NULL),
(43, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'Ship nhanh', 0, NULL, NULL),
(44, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'Ship', 0, NULL, NULL),
(45, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'ship nhanh', 0, NULL, NULL),
(46, 'Nguyễn Trọng Đạt', 'Hai Phong', '0832128289', 'dat.trong.1002@gmail.com', 'ship tận cửa', 0, NULL, NULL),
(47, 'Trong Dat', '123/HaiPhong', '01212131313', 'myphamhanghai@gmail.com', '123', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_statistical`
--

CREATE TABLE `tbl_statistical` (
  `id_statistical` int(11) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `sales` varchar(200) NOT NULL,
  `profit` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_statistical`
--

INSERT INTO `tbl_statistical` (`id_statistical`, `order_date`, `sales`, `profit`, `quantity`, `total_order`) VALUES
(1, '2020-11-08', '20000000', '7000000', 90, 10),
(2, '2020-11-07', '68000000', '9000000', 60, 8),
(3, '2020-11-06', '30000000', '3000000', 45, 7),
(4, '2020-11-05', '45000000', '3800000', 30, 9),
(5, '2020-11-04', '30000000', '1500000', 15, 12),
(6, '2020-11-03', '8000000', '700000', 65, 30),
(7, '2020-11-02', '28000000', '23000000', 32, 20),
(8, '2020-11-01', '25000000', '20000000', 7, 6),
(9, '2020-10-31', '36000000', '28000000', 40, 15),
(10, '2020-10-30', '50000000', '13000000', 89, 19),
(11, '2020-10-29', '20000000', '15000000', 63, 11),
(12, '2020-10-28', '25000000', '16000000', 94, 14),
(13, '2020-10-27', '32000000', '17000000', 16, 10),
(14, '2020-10-26', '33000000', '19000000', 14, 5),
(15, '2020-10-25', '36000000', '18000000', 22, 12),
(16, '2020-10-24', '34000000', '20000000', 33, 20),
(17, '2020-10-23', '25000000', '16000000', 94, 14),
(18, '2020-10-22', '12000000', '7000000', 16, 10),
(19, '2020-10-21', '63000000', '19000000', 14, 5),
(20, '2020-10-20', '66000000', '18000000', 22, 12),
(21, '2020-10-19', '74000000', '20000000', 33, 20),
(22, '2020-10-18', '63000000', '19000000', 14, 5),
(23, '2020-10-17', '66000000', '18000000', 23, 12),
(24, '2020-10-16', '74000000', '20000000', 32, 20),
(25, '2020-10-15', '63000000', '19000000', 14, 5),
(26, '2020-10-14', '66000000', '18000000', 23, 12),
(27, '2020-10-13', '74000000', '20000000', 33, 20),
(28, '2020-10-12', '66000000', '18000000', 23, 12),
(29, '2020-10-11', '74000000', '20000000', 10, 20),
(30, '2020-10-10', '63000000', '19000000', 14, 5),
(31, '2020-10-09', '66000000', '18000000', 23, 12),
(32, '2020-10-08', '74000000', '20000000', 15, 20),
(33, '2020-10-07', '66000000', '18000000', 23, 12),
(34, '2020-10-06', '74000000', '20000000', 30, 22),
(35, '2020-10-05', '66000000', '18000000', 23, 12),
(36, '2020-10-04', '74000000', '20000000', 32, 20),
(37, '2020-10-03', '63000000', '19000000', 14, 5),
(38, '2020-10-02', '66000000', '18000000', 23, 12),
(39, '2020-10-01', '74000000', '20000000', 32, 20),
(40, '2020-09-30', '63000000', '19000000', 14, 5),
(41, '2020-09-29', '66000000', '18000000', 23, 12),
(42, '2020-09-28', '74000000', '20000000', 15, 20),
(43, '2020-09-27', '66000000', '18000000', 23, 12),
(44, '2020-09-26', '74000000', '20000000', 30, 22),
(45, '2020-09-25', '66000000', '18000000', 23, 12),
(46, '2020-09-24', '74000000', '20000000', 32, 20),
(47, '2020-09-23', '63000000', '19000000', 14, 5),
(48, '2020-09-22', '66000000', '18000000', 23, 12),
(49, '2020-09-21', '74000000', '20000000', 32, 20),
(50, '2020-09-20', '63000000', '19000000', 14, 5),
(51, '2020-09-19', '66000000', '18000000', 23, 12),
(52, '2020-09-18', '74000000', '20000000', 15, 20),
(53, '2020-09-17', '66000000', '18000000', 23, 12),
(54, '2020-09-16', '74000000', '20000000', 30, 22),
(55, '2020-09-15', '66000000', '18000000', 23, 12),
(56, '2020-09-14', '74000000', '20000000', 32, 20),
(57, '2020-09-13', '63000000', '19000000', 14, 5),
(58, '2020-09-12', '66000000', '18000000', 23, 12),
(59, '2020-09-11', '74000000', '20000000', 32, 20),
(60, '2020-09-10', '63000000', '19000000', 14, 5),
(61, '2020-09-09', '66000000', '18000000', 23, 12),
(62, '2020-09-08', '74000000', '20000000', 15, 20),
(63, '2020-09-07', '66000000', '18000000', 23, 12),
(64, '2020-09-06', '74000000', '20000000', 30, 22),
(65, '2020-09-05', '66000000', '18000000', 23, 12),
(66, '2020-09-04', '74000000', '20000000', 32, 20),
(67, '2020-09-03', '63000000', '19000000', 14, 5),
(68, '2020-09-02', '66000000', '18000000', 23, 12),
(69, '2020-09-01', '74000000', '20000000', 32, 20),
(70, '2024-11-03', '10160000', '10155000', 23, 5),
(71, '0', '5899425', '5889425', 23, 10),
(72, '2024-11-04', '18626100', '0', 70, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Chỉ mục cho bảng `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_provider_product`
--
ALTER TABLE `tbl_provider_product`
  ADD PRIMARY KEY (`provider_id`);

--
-- Chỉ mục cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Chỉ mục cho bảng `tbl_statistical`
--
ALTER TABLE `tbl_statistical`
  ADD PRIMARY KEY (`id_statistical`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `tbl_provider_product`
--
ALTER TABLE `tbl_provider_product`
  MODIFY `provider_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `tbl_statistical`
--
ALTER TABLE `tbl_statistical`
  MODIFY `id_statistical` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

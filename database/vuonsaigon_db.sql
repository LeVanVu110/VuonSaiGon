-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 08:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuonsaigon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `image`) VALUES
(1, 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Banner-1-1375x440-1.png'),
(2, 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Banner-2-1375x440-1.png'),
(3, 'https://vuonsaigon.vn/wp-content/uploads/2023/08/baner-web-ke-trong-rau.png'),
(4, 'https://vuonsaigon.vn/wp-content/uploads/2022/06/hang-rao-nha-khach.jpg'),
(5, 'https://vuonsaigon.vn/wp-content/uploads/2023/08/cac-loai-dat-orgamix.png'),
(6, 'https://vuonsaigon.vn/wp-content/uploads/2020/05/ke-trong-rau-lap-ghep-thong-minh-6.jpg'),
(7, 'https://vuonsaigon.vn/wp-content/uploads/2022/06/bichchaughep-2.jpg'),
(8, 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Banner-vien-nen-xo-dua-1590-x-520.png'),
(9, 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Banner-rau-giong-1590-x-520.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `sort_order`, `description`, `image_url`) VALUES
(1, 'HÀNG RÀO NHỰA', 'hang-rao-nhua', NULL, 0, 'Tất cả các mẫu hàng rào nhựa, từ hàng rào trang trí cố định cho đến hàng rào dẻo linh hoạt. Sản phẩm chất liệu nhựa tổng hợp, chống tia UV, bền màu, giúp tô điểm cho sân vườn và lối đi nhà bạn.', 'https://vuonsaigon.vn/wp-content/uploads/2025/08/hang-rao-nhua-banner-tong.jpg'),
(2, 'KHUYẾN MÃI & VOUCHER 2024', 'khuyen-mai-voucher', NULL, 0, 'Tổng hợp các chương trình khuyến mãi, Flash Sale, và các loại Voucher giảm giá đặc biệt trong năm 2024. Đừng bỏ lỡ cơ hội mua sắm vật tư nông nghiệp với giá tốt nhất!', 'https://vuonsaigon.vn/wp-content/uploads/2024/12/banner-khuyen-mai-voucher-2024-tong.jpg'),
(3, 'SỎI TRANG TRÍ', 'soi-trang-tri', NULL, 0, NULL, NULL),
(4, 'THÁP TRỒNG – TRỤ TRỒNG – VƯỜN TƯỜNG', 'thap-trong-vuon-tuong', NULL, 0, NULL, NULL),
(5, 'ĐẤT SẠCH VÀ GIÁ THỂ', 'dat-sach-va-gia-the', NULL, 0, 'Tất cả các loại đất, giá thể, và vật liệu cải tạo đất được chọn lọc kỹ lưỡng, giúp cây trồng của bạn có môi trường phát triển tối ưu.', 'https://vuonsaigon.vn/wp-content/uploads/2023/09/gia-the-trong-cay.png'),
(6, 'THIẾT BỊ – HỆ THỐNG TƯỚI TỰ ĐỘNG', 'thiet-bi-tuoi-tu-dong', NULL, 0, NULL, NULL),
(7, 'DỤNG CỤ TRANG TRÍ SÂN VƯỜN', 'dung-cu-trang-tri-san-vuon', NULL, 0, NULL, NULL),
(8, 'ỐNG THÉP BỌC NHỰA – DAIM JAPAN', 'ong-thep-boc-nhua', NULL, 0, NULL, NULL),
(9, 'THỦY SINH VÀ CÁ CẢNH', 'thuy-sinh-va-ca-canh', NULL, 0, NULL, NULL),
(10, 'CHẬU TRỒNG CÂY', 'chau-trong-cay', NULL, 0, NULL, NULL),
(11, 'CÂY GIỐNG VÀ HOA CHẬU', 'cay-giong-va-hoa-chau', NULL, 0, NULL, NULL),
(12, 'DỤNG CỤ LÀM VƯỜN', 'dung-cu-lam-vuon', NULL, 0, NULL, NULL),
(13, 'HẠT GIỐNG RAU HOA', 'hat-giong-rau-hoa', NULL, 0, NULL, NULL),
(14, 'PHÂN BÓN', 'phan-bon', NULL, 0, NULL, NULL),
(15, 'VẬT TƯ TRỒNG LAN', 'vat-tu-trong-lan', NULL, 0, NULL, NULL),
(16, 'NHÀ KÍNH – NHÀ MÀNG', 'nha-kinh-nha-mang', NULL, 0, NULL, NULL),
(17, 'THUỐC BẢO VỆ THỰC VẬT', 'thuoc-bao-ve-thuc-vat', NULL, 0, NULL, NULL),
(18, 'COMBO TIỆN ÍCH', 'combo-tien-ich', NULL, 0, NULL, NULL),
(19, 'DỤNG CỤ VÀ VẬT TƯ KHÁC', 'dung-cu-va-vat-tu-khac', NULL, 0, NULL, NULL),
(20, 'Đất sạch trồng cây', 'dat-sach-trong-cay', 5, 0, 'Những sản phẩm đất sạch dinh dưỡng trồng cây tại Vườn Sài Gòn sẽ là sự lựa chọn tuyệt vời, đảm bảo cho khu vườn của bạn có được cây tốt, kiểng xanh, hoa thơm và trái ngọt. Thành phần đất sạch đã được xử lý nấm bệnh và có sẵn phân bón cung cấp chất dinh dưỡng cần.', 'https://vuonsaigon.vn/wp-content/uploads/2023/09/dat-sach-trong-cay.png'),
(21, 'Giá thể trồng cây', 'gia-the-trong-cay', 5, 0, NULL, NULL),
(22, 'Phụ kiện tưới', 'phu-kien-tuoi', 6, 0, NULL, NULL),
(23, 'Ống dẫn PE các kích thước', 'ong-dan-pe', 6, 0, NULL, NULL),
(24, 'Đầu (Pet) phun tưới', 'dau-phun-tuoi', 6, 0, NULL, NULL),
(25, 'Chậu hàng rào nhựa', 'chau-hang-rao-nhua', 10, 0, NULL, NULL),
(26, 'Chậu trồng cây ăn trái', 'chau-trong-cay-an-trai', 10, 0, NULL, NULL),
(27, 'Chậu trồng bonsai', 'chau-trong-bonsai', 10, 0, NULL, NULL),
(28, 'Chậu trồng lan', 'chau-trong-lan', 10, 0, NULL, NULL),
(29, 'Chậu gốm, chậu sành, chậu xi măng', 'chau-gom-sanh-xi-mang', 10, 0, NULL, NULL),
(30, 'Chậu kẹp, treo, móc lan can', 'chau-kep-treo-lan-can', 10, 0, NULL, NULL),
(31, 'Kệ trồng', 'ke-trong', 10, 0, NULL, NULL),
(32, 'Chậu tự dưỡng', 'chau-tu-duong', 10, 0, NULL, NULL),
(33, 'Chậu chữ nhật', 'chau-chu-nhat', 10, 0, NULL, NULL),
(34, 'Khay chậu trồng rau', 'khay-chau-trong-rau', 10, 0, NULL, NULL),
(35, 'Chậu treo', 'chau-treo-con', 10, 0, NULL, NULL),
(36, 'Chậu ốp tường', 'chau-op-tuong', 10, 0, NULL, NULL),
(37, 'Chậu trồng hoa hồng', 'chau-trong-hoa-hong', 10, 0, NULL, NULL),
(38, 'Chậu vuông', 'chau-vuong', 10, 0, NULL, NULL),
(39, 'Chậu tròn', 'chau-tron', 10, 0, NULL, NULL),
(40, 'Chậu loại khác', 'chau-loai-khac', 10, 0, NULL, NULL),
(41, 'Cây ăn trái', 'cay-an-trai', 11, 0, NULL, NULL),
(42, 'Cây con rau củ', 'cay-con-rau-cu', 11, 0, NULL, NULL),
(43, 'Cây có hoa – chậu hoa treo', 'cay-co-hoa-chau-treo', 11, 0, NULL, NULL),
(44, 'Chậu rau gia vị, rau thơm, củ quả', 'chau-rau-gia-vi', 11, 0, NULL, NULL),
(45, 'Dụng cụ tưới', 'dung-cu-tuoi', 12, 0, NULL, NULL),
(46, 'Dụng cụ cắt tỉa', 'dung-cu-cat-tia', 12, 0, NULL, NULL),
(47, 'Dụng cụ làm đất', 'dung-cu-lam-dat', 12, 0, NULL, NULL),
(48, 'Cột, cố định, đánh dấu', 'cot-co-dinh-danh-dau', 12, 0, NULL, NULL),
(49, 'Dụng cụ và vật tư', 'dung-cu-va-vat-tu', 12, 0, NULL, NULL),
(50, 'Thiết bị động, đo lường', 'thiet-bi-dong-do-luong', 12, 0, NULL, NULL),
(51, 'Giàn leo, cổng vòm', 'gian-leo-cong-vom', 12, 0, NULL, NULL),
(52, 'Dụng cụ và vật tư khác', 'dung-cu-va-vat-tu-khac-con', 12, 0, NULL, NULL),
(53, 'Hạt giống rau', 'hat-giong-rau', 13, 0, NULL, NULL),
(54, 'Hạt giống rau mầm', 'hat-giong-rau-mam', 13, 0, NULL, NULL),
(55, 'Hạt giống hoa', 'hat-giong-hoa', 13, 0, NULL, NULL),
(56, 'Phân Bón Hữu Cơ', 'phan-bon-huu-co', 14, 0, NULL, NULL),
(57, 'Phân bón Vô Cơ', 'phan-bon-vo-co', 14, 0, NULL, NULL),
(58, 'Vi sinh, Tricho', 'vi-sinh-tricho', 14, 0, NULL, NULL),
(59, 'Kích rễ, kích kie', 'kich-re-kich-kie', 15, 0, NULL, NULL),
(60, 'Giá thể trồng lan', 'gia-the-trong-lan', 15, 0, NULL, NULL),
(61, 'Phân bón cho lan', 'phan-bon-cho-lan', 15, 0, NULL, NULL),
(62, 'Thuốc trừ sâu bệnh cho lan', 'thuoc-tru-sau-benh-cho-lan', 15, 0, NULL, NULL),
(63, 'Chậu trồng lan', 'chau-trong-lan-con', 15, 0, NULL, NULL),
(64, 'Thủy canh', 'thuy-canh', 16, 0, NULL, NULL),
(65, 'Vật tư nhà kính', 'vat-tu-nha-kinh', 16, 0, NULL, NULL),
(66, 'Thuốc trừ nấm bệnh', 'thuoc-tru-nam-benh', 17, 0, NULL, NULL),
(67, 'Thuốc trừ sâu bọ, côn trùng', 'thuoc-tru-sau-bo', 17, 0, NULL, NULL),
(68, 'Kích thích sinh trưởng', 'kich-thich-sinh-truong', 17, 0, NULL, NULL),
(69, 'Kích rễ – Keiki', 'kich-re-keiki', 17, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories_post`
--

CREATE TABLE `categories_post` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_post`
--

INSERT INTO `categories_post` (`cat_id`, `name`, `slug`, `sort_order`) VALUES
(1, 'Kỹ thuật nông nghiệp', 'ky-thuat-nong-nghiep', 10),
(2, 'Hoạt động công ty', 'hoat-dong-cong-ty', 20),
(3, 'Phong thủy', 'phong-thuy', 30),
(4, 'Sức khỏe', 'suc-khoe', 40),
(5, 'Thủy sinh', 'thuy-sinh', 50),
(6, 'cá cảnh', 'ca-canh', 60),
(7, 'Blog', 'blog', 70);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(5, 1),
(5, 2),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 27),
(10, 10),
(13, 3),
(13, 4),
(14, 5),
(14, 9),
(14, 24),
(15, 9),
(15, 21),
(15, 25),
(18, 4),
(18, 6),
(18, 7),
(18, 8),
(20, 1),
(20, 2),
(20, 19),
(20, 27),
(21, 13),
(21, 14),
(21, 15),
(21, 16),
(21, 17),
(21, 18),
(21, 21),
(21, 25),
(30, 10),
(53, 3),
(56, 9),
(56, 24),
(57, 5),
(60, 21);

-- --------------------------------------------------------

--
-- Table structure for table `flash_sale_events`
--

CREATE TABLE `flash_sale_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flash_sale_events`
--

INSERT INTO `flash_sale_events` (`id`, `name`, `start_time`, `end_time`, `is_active`) VALUES
(1, 'Sự kiện Sale Khởi động', '2025-12-11 10:33:20', '2025-12-12 10:33:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `slug`, `image`, `summary`, `content`, `author`, `created_at`) VALUES
(1, 'Kỹ thuật trồng hoa triều chuông khoe sắc đúng dịp Tết Nguyên Đán', 'ky-thuat-trong-hoa-trieu-chuong-tet', 'https://vuonsaigon.vn/wp-content/uploads/2025/11/Ky-thuat-trong-hoa-trieu-chuong-khoe-sac-dung-dip-Tet-nguyen-dan-4-510x321.png', 'Hướng dẫn chi tiết từ A-Z cách chăm sóc hoa triều chuông ra hoa rực rỡ đúng dịp Tết Âm Lịch.', 'Đây là nội dung đầy đủ của bài viết về kỹ thuật trồng hoa triều chuông...', 'Thùy Hoa', '2025-12-08 10:00:00'),
(2, 'HOA TRIỀU CHUÔNG LÀ GÌ? Ý NGHĨA PHONG THỦY HOA TRIỀU CHUÔNG', 'hoa-trieu-chuong-la-gi-phong-thuy', 'https://vuonsaigon.vn/wp-content/uploads/2025/11/y-nghia-hoa-trieu-chuong-510x321.png', 'Tìm hiểu về nguồn gốc, đặc điểm và ý nghĩa phong thủy của loài hoa triều chuông rực rỡ.', 'Đây là nội dung đầy đủ của bài viết về ý nghĩa phong thủy hoa triều chuông...', 'Thùy Hoa', '2025-12-06 14:30:00'),
(3, 'Lá ổi có tác dụng gì? 15 tác dụng của lá ổi đối với sức khỏe', 'la-oi-co-tac-dung-gi-suc-khoe', 'https://vuonsaigon.vn/wp-content/uploads/2025/11/La-oi-co-tac-dung-gi-15-tac-dung-cua-la-oi-doi-voi-suc-khoe-510x321.png', 'Khám phá 15 lợi ích tuyệt vời từ lá ổi, một loại lá quen thuộc nhưng chứa nhiều công dụng bất ngờ.', 'Đây là nội dung đầy đủ của bài viết về 15 tác dụng của lá ổi...', 'Thùy Hoa', '2025-12-04 09:15:00'),
(25, 'Sử dụng sỏi trong trang trí hồ cá và hồ thủy sinh', 'su-dung-soi-trang-tri-ho-ca-thuy-sinh', 'https://vuonsaigon.vn/wp-content/uploads/2023/09/su-dung-soi-trang-tri-ho-ca-va-ho-thuy-sinh-2-510x321.png', 'Hướng dẫn cách chọn và sử dụng các loại sỏi để trang trí hồ cá, hồ thủy sinh một cách tự nhiên và đẹp mắt.', 'Nội dung chi tiết về sỏi trang trí...', 'Thuy Hoa', '2023-09-21 08:00:00'),
(26, 'Thiết kế và trang trí bể cá cảnh', 'thiet-ke-trang-tri-be-ca-canh', 'https://vuonsaigon.vn/wp-content/uploads/2023/07/Hoai-1-1-510x321.png', 'Các yếu tố quan trọng cần xem xét khi thiết kế và trang trí một bể cá cảnh đẹp mắt, phù hợp với không gian.', 'Nội dung chi tiết về thiết kế bể cá...', 'maietar', '2023-08-07 12:30:00'),
(27, 'Loại cá phổ biến và phù hợp cho bể cá cảnh nhỏ', 'loai-ca-phu-hop-be-nho', 'https://vuonsaigon.vn/wp-content/uploads/2023/07/Han-1-510x321.png\r\n', 'Gợi ý những loài cá cảnh dễ nuôi, có kích thước nhỏ gọn, thích hợp cho các bể cá mini và mới bắt đầu.', 'Nội dung chi tiết về các loại cá phổ biến...', 'maietar', '2023-08-05 16:00:00'),
(28, 'Cách xử lý các vấn đề sức khỏe của cá cảnh', 'ky-thuat-nuoi-cay-thuy-sinh-khong-co2', 'https://vuonsaigon.vn/wp-content/uploads/2023/07/Mai-1-510x321.png', 'Cách chọn loại cây và phương pháp chăm sóc bể thủy sinh đơn giản mà không cần hệ thống CO2 phức tạp.', 'Nội dung chi tiết về kỹ thuật nuôi cây thủy sinh...', 'Thuy Hoa', '2023-11-01 15:00:00'),
(29, 'Vườn Sài Gòn tham dự hội chợ hoa tết 2019', 'vuon-sai-gon-tham-du-hoi-cho-hoa-tet-2019', 'https://vuonsaigon.vn/wp-content/uploads/2020/02/cho-hoa-lang-hoa-go-vap2-510x340.jpg', 'Tổng hợp các hoạt động và hình ảnh Vườn Sài Gòn tại hội chợ hoa Xuân 2019.', 'Nội dung chi tiết về hoạt động tham gia hội chợ hoa tết 2019...', 'Định Trần', '2020-02-13 11:00:00'),
(35, 'Ưu và nhược điểm của phương pháp thủy canh hồi lưu trong nông nghiệp', 'uu-nhuoc-diem-thuy-canh-hoi-luu-trong-nong-nghiep', 'https://vuonsaigon.vn/wp-content/uploads/2024/08/uu-va-nhuoc-diem-cua-thuy-canh-hoi-luu-510x321.png', 'Phân tích chi tiết về phương pháp canh tác thủy canh hồi lưu và các vấn đề phong thủy có thể gặp phải.', 'Nội dung chi tiết về thủy canh hồi lưu...', 'Thuy Hoa', '2024-08-15 08:00:00'),
(36, '5 bí quyết chọn hoa chậu trang trí tết 2023 rực rỡ, bền đẹp', '5-bi-quyet-chon-hoa-chau-trang-tri-tet', 'https://vuonsaigon.vn/wp-content/uploads/2023/01/5-bi-quyet-chon-chau-trang-tri-tet-2023-ruc-ro-4-510x268.png', 'Bí quyết chọn hoa hợp phong thủy, màu sắc mang lại may mắn và cách chăm sóc để hoa bền đẹp trong dịp Tết.', 'Nội dung chi tiết về chọn hoa tết...', 'Thuy Hoa', '2023-01-14 10:30:00'),
(37, 'Cây hoa trà my đón tết – mùa xuân sẽ lan tỏa khắp nhà bạn.', 'cay-hoa-tra-my-don-tet', 'https://vuonsaigon.vn/wp-content/uploads/2019/12/hoa-tra-my-510x268.png', 'Ý nghĩa phong thủy, cách trồng và chăm sóc cây hoa trà my, loài hoa mang lại sự may mắn, thịnh vượng dịp Tết.', 'Nội dung chi tiết về cây hoa trà my...', 'Mai Thanh', '2022-08-26 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `post_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`post_id`, `cat_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(3, 3),
(25, 5),
(25, 6),
(25, 7),
(26, 5),
(26, 6),
(26, 7),
(27, 5),
(27, 6),
(27, 7),
(28, 5),
(28, 6),
(28, 7),
(29, 2),
(29, 7),
(35, 3),
(35, 7),
(36, 1),
(36, 3),
(36, 7),
(37, 3),
(37, 7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount_price` decimal(10,0) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `state` enum('còn hàng','hết hàng','sắp tới') NOT NULL DEFAULT 'còn hàng',
  `image_url` varchar(255) DEFAULT NULL,
  `is_sale` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `discount_price`, `description`, `quantity`, `state`, `image_url`, `is_sale`) VALUES
(1, 'Đất sạch trồng cây và giá thể', 176000, 167000, 'Hỗn hợp đất sạch và giá thể chất lượng cao, cung cấp dưỡng chất cần thiết, giúp cây phát triển khỏe mạnh ngay lập tức. Thích hợp cho mọi loại cây trồng chậu.', 120, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/03/Dat-sach-trong-cay-va-gia-the.jpg', 1),
(2, 'Đất sạch Newzita Soil New Mix', 136000, 129000, 'Công thức đất sạch Newzita mới, giàu vi sinh và mùn hữu cơ. Đảm bảo độ tơi xốp, thoát nước tốt và giữ ẩm vừa phải. Lý tưởng cho việc trồng rau và hoa.', 80, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/02/newzita-soil-new-mix.png', 1),
(3, 'Hạt giống Bí dĩa bay', 50000, 40000, 'Giống bí dĩa bay (Pattypan Squash) năng suất cao, quả có hình dáng độc đáo, hương vị thơm ngon. Thích hợp trồng chậu hoặc vườn.', 50, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/04/hat-giong-bi-dia-bay-1.png', 1),
(4, 'Combo trồng rau mầm', 67000, 36000, 'Combo đầy đủ dụng cụ và giá thể (bã mía và vỏ trấu) để tự trồng rau mầm sạch tại nhà. Nhanh thu hoạch, an toàn tuyệt đối.', 250, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/06/hinh-bia-combo-trong-rau-mam-bang-ba-mia-va-vo-trau.png', 1),
(5, 'Phân bón cây ăn trái', 519000, 493000, 'Phân bón chuyên dụng cho cây ăn trái, cung cấp Kali và Photpho dồi dào, giúp kích thích ra hoa, đậu quả và tăng độ ngọt của trái cây.', 45, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2020/07/phan-bon-cay-an-trai.png', 1),
(6, 'Combo chăm sóc hoa hồng', 175000, 160000, 'Bộ sản phẩm chuyên biệt bao gồm thuốc trừ nấm, bọ trĩ và phân bón vi lượng, giúp hoa hồng phát triển mạnh, ra hoa to và lâu tàn.', 15, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/03/combo-cham-soc-hoa-hong-o-giai-doan-phat-trien-1.png', 1),
(7, 'Combo chăm sóc mai', 180000, 150000, 'Combo chăm sóc Mai Vàng trước Tết, bao gồm phân bón kích thích nụ hoa, thuốc dưỡng rễ và phòng trừ sâu bệnh. Giúp hoa nở đúng dịp.', 30, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/11/combo-cham-soc-mai-truoc-tet-2.png', 1),
(8, 'Combo chăm sóc cây cảnh', 140000, 120000, 'Bộ combo cơ bản cho cây cảnh tại nhà, bao gồm B1, phân NPK và thuốc trừ nấm phổ rộng.', 75, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2020/05/combo-cham-soc-cay-canh-tai-nha-1.png', 1),
(9, 'Sinh khối trùn quế', 45000, 35000, 'Sinh khối trùn quế tươi, chứa trứng và trùn con, dùng để nhân giống trùn quế hoặc làm phân bón hữu cơ cải tạo đất lâu năm.', 200, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2021/11/sinh-khoi-trun-que-6.png', 1),
(10, 'Chậu khung sắt lan can', 80000, 65000, 'Chậu trồng cây kèm khung sắt treo lan can, tiết kiệm không gian. Chất liệu nhựa bền, chống tia UV.', 0, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2019/04/chau-khung-sat-lan-can.png', 1),
(11, 'Combo trồng cà chua', 130000, 110000, 'Combo trồng cà chua F1, bao gồm hạt giống, đất dinh dưỡng chuyên biệt và phân bón hữu cơ. Đảm bảo thu hoạch cà chua tươi ngon.', 40, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2020/02/combo-trong-ca-chua.png', 1),
(12, 'Giá thể trồng cây', 60000, 50000, 'Giá thể tơi xốp, thoát nước cực tốt, thành phần chủ yếu là tro trấu, xơ dừa đã xử lý và một phần đất thịt nhỏ. Phù hợp cho ươm cây con.', 90, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2020/10/Dat-sach-trong-cay-va-gia-the.png', 1),
(13, 'Vỏ trấu và bã mía ép bánh', 12000, 12000, 'Vỏ trấu & bã mía ép bánh Orgamix – với tỷ lệ chuẩn 50% trấu – 50% bã mía, giàu đạm, lân, kali tự nhiên – là giải pháp tuyệt vời giúp cây khỏe, đất tơi, vườn xanh bền vững.\r\nsrc=\"https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-768x768.png\"\r\n1. Vỏ trấu & bã mía ép bánh sự kết hợp hoàn hảo từ thiên nhiên\r\nSản phẩm được phối trộn và ép bánh từ vỏ trấu sạch và bã mía nguyên chất, không sử dụng hóa chất hay phụ gia độc hại.\r\nsrc=\"https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-3-768x768.png\" Vỏ trấu: Giúp đất thông thoáng, tăng độ tơi xốp, tạo điều kiện cho rễ cây phát triển mạnh.\r\n\r\nBã mía: Giàu chất hữu cơ, đặc biệt là đạm (N), lân (P), kali (K) tự nhiên – ba nguyên tố quan trọng nhất giúp cây sinh trưởng toàn diện.\r\n\r\nNhờ sự kết hợp này, Orgamix cho ra đời một loại giá thể hữu cơ cao cấp, đáp ứng đầy đủ các nhu cầu từ cải tạo đất đến nuôi dưỡng cây trồng. \r\n2. Công dụng nổi bật của vỏ trấu & bã mía\r\nCải tạo đất trồng: Làm tơi đất, hạn chế nén chặt, giúp rễ phát triển sâu và khỏe.\r\n\r\nGiữ ẩm lâu dài: Giảm công tưới, đặc biệt hiệu quả trong mùa nắng nóng.\r\n\r\nTăng độ mùn, bổ sung hữu cơ: Giúp đất giàu dinh dưỡng, lâu bạc màu.\r\n\r\nThân thiện môi trường: Hoàn toàn không chứa chất hóa học hay tạp chất độc hại.\r\nsrc=\"https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-1-768x768.png\"\r\n3. Vỏ trấu & bã mía ép bánh Orgamix sử dụng đơn giản\r\nChỉ cần bóp nhẹ là bung tơi xốp.\r\n\r\nTrộn vào đất trồng cùng xơ dừa, phân hữu cơ hoặc đất sạch.\r\n\r\nHoặc dùng để ủ phân compost, thúc đẩy quá trình phân hủy và gia tăng giá trị dinh dưỡng cho phân bón.\r\nsrc=\"https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-4-768x768.png\"\r\n4. Phù hợp mọi mô hình trồng trọt\r\nTrồng rau sạch, hoa kiểng, cây ăn trái, bonsai, cây công nghiệp.\r\n\r\nDùng cho vườn tại nhà, chậu cây, nhà lưới, hoặc trang trại chuyên canh.\r\n\r\nThích hợp cho cả nông dân chuyên nghiệp và người mới bắt đầu làm vườn.\r\nsrc=\"https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-2-768x768.png\"\r\n3. Nên mua vỏ trấu & bã mía ép bánh Orgamix ở đâu?\r\nsrc=\"https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-6-768x512.png\"Tại HCM, bạn có thể đến Siêu Thị Vật tư nông nghiệp Vườn Sài Gòn để mua vỏ trấu và bã mía ép bánh Orgamix.\r\nNgoài ra bạn có thể đặt hàng trực tiếp tại website, hoặc liên hệ Hotline/Zalo 0909 1234 09 để được tư vấn thêm thông tin về sản phẩm.', 300, 'hết hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-5-247x296.png', 0),
(14, 'Phân bò ép bánh', 15000, 14000, 'Phân bò đã ủ hoai mục, được ép bánh, không mùi, sạch sẽ. Giàu đạm và các chất cần thiết cho giai đoạn tăng trưởng của cây.', 0, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/phan-bo-ep-banh-247x296.png', 0),
(15, 'Bã mía ép bánh', 10000, 10000, 'Bã mía nguyên chất ép bánh, giá thể nhẹ, giữ ẩm tốt, đặc biệt dùng cho các loại lan và cây cảnh cần độ ẩm cao.', 450, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/ba-mia-ep-banh-4-247x296.png', 0),
(16, 'Vỏ đậu phộng ép bánh', 14000, 14000, 'Giá thể từ vỏ đậu phộng, giúp cải thiện cấu trúc đất, tăng độ thông thoáng và ngăn ngừa nấm mốc.', 210, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-dau-phong-ep-banh-247x296.png', 0),
(17, 'Xơ dừa ép bánh', 18000, 16000, 'Xơ dừa đã xử lý sạch chát tannin và muối, ép thành bánh nhỏ gọn, giữ nước gấp nhiều lần thể tích, rất tiện lợi.', 10, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/xo-dua-ep-banh-1-247x296.png', 0),
(18, 'Giá thể ép bánh đa năng', 25000, 25000, 'Giá thể tổng hợp, dễ dàng vận chuyển và lưu trữ. Chỉ cần ngâm nước là có ngay khối lượng giá thể lớn để trồng cây.', 60, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/gia-the-ep-banh-1-247x296.png', 0),
(19, 'Đất sạch Orgamix Light Soil', 45000, 45000, 'Đất nhẹ, chuyên dùng cho các chậu cây lớn hoặc trồng trên ban công, sân thượng. Đảm bảo cây không bị úng nước.', 180, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2024/01/dat-sach-trong-mai-bonsai-cay-kieng-orgamix-light-soil-2-247x296.png', 0),
(20, 'Đệm giá thể trồng rau mầm', 8000, 8000, 'Đệm trồng rau mầm tiện lợi, không cần đất, chỉ cần tưới nước. Giúp rau mầm sạch và dễ thu hoạch.', 500, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/11/dem-gia-the-trong-rau-mam-247x296.png', 0),
(21, 'Đất sét nung Akadama', 35000, 32000, 'Đất sét Akadama nhập khẩu, loại cứng, giữ nước và thoát nước cân bằng. Chuyên dùng để trộn giá thể trồng Bonsai, Sen Đá, và các loại cây cần đất thông thoáng.', 25, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/06/dat-set-nung-1kadama-1-247x296.png', 0),
(22, 'Orgamix Bazan trồng hoa', 55000, 55000, 'Đất đỏ Bazan giàu chất dinh dưỡng tự nhiên, đặc biệt tốt cho các loại hoa màu và cây lâu năm. Kích thích màu sắc hoa rực rỡ.', 70, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/04/orgamix-bazan-trong-hoa-va-cay-an-trai-1-247x296.png', 0),
(23, 'Đất sạch Newzita Soil', 40000, 40000, 'Phiên bản tiêu chuẩn của đất Newzita, đã qua xử lý nấm bệnh. Dùng trực tiếp không cần trộn thêm giá thể.', 110, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/02/newzita-soil-new-mix-247x296.png', 0),
(24, 'Sinh khối trùn quế', 30000, 30000, 'Phân trùn quế nguyên chất, giàu axit Humic và Fulvic, giúp cây hấp thụ dinh dưỡng tối đa. Tuyệt đối an toàn cho cây và người dùng.', 280, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2021/11/sinh-khoi-trun-que-6-247x296.png', 0),
(25, 'Đất nung sỏi nhẹ', 22000, 22000, 'Sỏi nhẹ nung (đất sét nung), dùng để lót đáy chậu chống úng, trang trí bề mặt hoặc làm giá thể bán thủy canh.', 35, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2021/05/dat-nung-soi-nhe-247x296.png', 0),
(26, 'Đất đỏ Bazan Orgamix Plus', 60000, 58000, 'Phiên bản Orgamix Bazan được tăng cường thêm các loại giá thể cao cấp, giữ chất lâu hơn và chống nén chặt đất.', 15, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2020/11/dat-do-badan-orgamix-plus-vang.png', 0),
(27, 'Đất sạch Orgamix 3 in 1', 50000, 50000, 'Sự kết hợp hoàn hảo của 3 loại vật liệu trồng cây: đất, giá thể và phân hữu cơ, phù hợp cho người mới bắt đầu.', 160, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2020/10/orgamix-3-in-1-247x296.png', 0),
(28, 'Hàng rào nhựa 30x30cm (có chân cắm) – Hàng rào trang trí', 21000, 19000, 'Hàng rào nhựa cố định, có chân cắm sẵn, dễ dàng lắp đặt. Lý tưởng để phân chia bồn hoa và lối đi.', 150, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Hang-rao-nhua-trang-tri-5-3.png', 1),
(29, 'Hàng rào nhựa 30x30cm (không chân cắm)', 21000, 21000, 'Tấm hàng rào nhựa trang trí, không có chân cắm, thích hợp gắn cố định vào chậu hoặc tường. Độ bền cao.', 120, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Hang-rao-nhua-trang-tri-7-1.png', 0),
(30, 'Hàng rào nhựa 50x30cm (không chân cắm) – Hàng rào trang trí', 29000, 27000, 'Hàng rào nhựa kích thước lớn hơn, dùng để bao quanh các gốc cây lớn hoặc khu vực rộng. Thiết kế đẹp mắt.', 90, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2023/08/Hang-rao-nhua-trang-tri-17.png', 1),
(31, 'Hàng rào nhựa dẻo hình cánh bướm trang trí sân vườn & lối đi', 44000, 39000, 'Hàng rào dẻo, linh hoạt uốn cong theo mọi địa hình. Phù hợp cho việc trang trí tạm thời hoặc các đường cong phức tạp.', 200, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/05/hang-rao-nhua-deo-hinh-canh-buom-1.png', 1),
(32, 'Voucher Giảm 10% (Áp dụng cho đơn hàng > 500K)', 500000, 50000, 'Voucher điện tử có mã, giảm ngay 10% tổng giá trị đơn hàng, áp dụng cho các đơn hàng có giá trị từ 500.000đ trở lên. Hạn sử dụng: 31/12/2024.', 500, 'hết hàng', 'https://vuonsaigon.vn/wp-content/uploads/2022/08/khuyen-mai-freeship-247x296.png', 1),
(33, 'Combo Đất + Giá thể + Phân bón (Giảm 25%)', 250000, 187500, 'Combo tiết kiệm cho người mới bắt đầu. Bao gồm Đất sạch Newzita, Giá thể xơ dừa và Phân bón hữu cơ tan chậm. Giảm giá 25% so với mua lẻ.', 85, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/08/dung-cu-duc-lo-trong-cay.png', 1),
(34, 'Đèn LED trồng cây T5 12W (Flash Sale)', 150000, 99000, 'Đèn LED quang phổ đầy đủ, công suất 12W, chuyên dùng kích thích ra hoa và tăng trưởng cho cây trồng trong nhà hoặc khu vực thiếu sáng. Giảm sốc trong tuần lễ khuyến mãi.', 40, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2024/09/phan-trun-que-vien-nen-sfarm-chuyen-cho-lan-3.png', 1),
(35, 'Phân Bò Ép Bánh Orgamix – Đã xử lý, không hôi, 100% hữu cơ', 209000, 174000, 'Voucher điện tử có mã, giảm ngay 10% tổng giá trị đơn hàng, áp dụng cho các đơn hàng có giá trị từ 500.000đ trở lên. Hạn sử dụng: 31/12/2024.', 500, 'còn hàng', 'https://vuonsaigon.vn/wp-content/uploads/2025/04/phan-bo-ep-banh.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_specs`
--

CREATE TABLE `product_specs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `spec_key` varchar(100) NOT NULL,
  `spec_value` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_specs`
--

INSERT INTO `product_specs` (`id`, `product_id`, `spec_key`, `spec_value`, `sort_order`) VALUES
(6, 13, 'Giá bán lẻ', 'Khổ 4m x 1m tối giá 90,000đ', 10),
(7, 13, 'Giá sỉ', 'Liên hệ', 20),
(8, 13, 'Kích thước cuộn', 'Khổ ngang 4m x Dài 100m -> 1 cuộn 400m²', 30),
(9, 13, 'Trọng lượng', '70kg – 73 kg/Cuộn', 40),
(10, 13, 'Định lượng', '1m² khoảng 200g', 50);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `youtube_id` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `youtube_id`, `title`, `image`, `url`) VALUES
(1, 'VUIPoh_cJhM', '[Tiêu đề đang cập nhật 1]', 'https://img.youtube.com/vi/VUIPoh_cJhM/hqdefault.jpg', 'https://youtu.be/VUIPoh_cJhM'),
(2, 'ccDH9hB3kZw', '[Tiêu đề đang cập nhật 2]', 'https://img.youtube.com/vi/ccDH9hB3kZw/hqdefault.jpg', 'https://youtu.be/ccDH9hB3kZw'),
(3, '1AqlY0hDM8o', '[Tiêu đề đang cập nhật 3]', 'https://img.youtube.com/vi/1AqlY0hDM8o/hqdefault.jpg', 'https://youtu.be/1AqlY0hDM8o'),
(4, 'c7-InP4qaeI', '[Tiêu đề đang cập nhật 4]', 'https://img.youtube.com/vi/c7-InP4qaeI/hqdefault.jpg', 'https://youtu.be/c7-InP4qaeI'),
(5, '7hPfr-9jvls', '[Tiêu đề đang cập nhật 5]', 'https://img.youtube.com/vi/7hPfr-9jvls/hqdefault.jpg', 'https://youtu.be/7hPfr-9jvls'),
(6, 'th5pFfdI6h4', '[Tiêu đề đang cập nhật 6]', 'https://img.youtube.com/vi/th5pFfdI6h4/hqdefault.jpg', 'https://youtu.be/th5pFfdI6h4'),
(7, '573kJAvqs_8', '[Tiêu đề đang cập nhật 7]', 'https://img.youtube.com/vi/573kJAvqs_8/hqdefault.jpg', 'https://youtu.be/573kJAvqs_8'),
(8, 'dc5NnVT9yKA', '[Tiêu đề đang cập nhật 8]', 'https://img.youtube.com/vi/dc5NnVT9yKA/hqdefault.jpg', 'https://youtu.be/dc5NnVT9yKA'),
(9, '7KzFRyDizOQ', '', 'https://i.ytimg.com/vi/7KzFRyDizOQ/sddefault.jpg', ''),
(12, 'TpL3uvSgfJQ', '', 'https://i.ytimg.com/vi/TpL3uvSgfJQ/sddefault.jpg', ''),
(13, '2DUZP_qFAgg', '', 'https://i.ytimg.com/vi/2DUZP_qFAgg/sddefault.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `categories_post`
--
ALTER TABLE `categories_post`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`category_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `flash_sale_events`
--
ALTER TABLE `flash_sale_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`post_id`,`cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD UNIQUE KEY `youtube_id` (`youtube_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `categories_post`
--
ALTER TABLE `categories_post`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flash_sale_events`
--
ALTER TABLE `flash_sale_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_specs`
--
ALTER TABLE `product_specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD CONSTRAINT `post_categories_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_categories_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categories_post` (`cat_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD CONSTRAINT `product_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

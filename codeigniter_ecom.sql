-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 10, 2024 lúc 04:55 PM
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
-- Cơ sở dữ liệu: `codeigniter_ecom`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `title`, `slug`, `description`, `image`, `status`) VALUES
(10, 'Demo Brand', 'demo-brand', 'test', '1710388504test3.jpg', 1),
(11, 'Test Brand', 'test-brand', 'demo', '1711009829image-dia-chi-nha-hang-viet-nam-tai-thanh-pho-denver-165081024359416.jpg', 1),
(12, 'Sam sung', 'sam-sung', 'Xấu', '1712367137810.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `status`, `image`, `slug`) VALUES
(7, 'Test Cate', 'demo', 1, '1711010879image-dia-chi-nha-hang-viet-nam-tai-thanh-pho-denver-165081024359416.jpg', 'test-category'),
(8, 'Demo2', 'demo', 1, '1711010899test3.jpg', 'teelab');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `dated` varchar(20) DEFAULT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `status`, `product_id`, `dated`, `stars`) VALUES
(2, 'Huy dz vl', 'huy0.808203@gmail.com', 'Good performmance, high quality', 1, 22, '2024-04-05 15:18:13', 0),
(7, 'huy dz vl', 'huy0.808203@gmail.com', 'must try', 1, 22, '2024-04-05 15:18:13', 0),
(9, 'demo ', 'test', 'san pham tot', 1, 22, '2024-04-05 16:09:11', 5),
(10, 'test 2 ', '1', 'san pham rat te khong xung dang su dung', 1, 22, '2024-04-05 16:10:38', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `address`, `note`) VALUES
(1, 'Quang Huy', 'huy@gmail.com', '0983612720', 'tay son', '1'),
(2, 'Son Flower Knows', 'lionwannafly@gmail.com', '0983612720', 'tay son', '12123'),
(3, 'Quang Huy', 'huy0.808203@gmail.com', '0983612720', 'tay son', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `token` varchar(10) NOT NULL,
  `date_created` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `address`, `token`, `date_created`, `status`) VALUES
(11, 'kingvem', 'lionwannafly@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0983612720', 'tay son', '3367', '2024-03-26 09:35:13', 1),
(12, 'Son Flower Knows', '12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0983612720', 'tay son', '5320', '2024-03-26 10:07:12', 1),
(13, 'Thanh Long', 'supersayxe@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '12345678', 'hoang mai', '4400', '2024-03-28 10:52:50', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `partnerCode` varchar(50) NOT NULL,
  `orderId` varchar(50) NOT NULL,
  `requestId` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `orderInfo` varchar(50) NOT NULL,
  `orderType` varchar(50) NOT NULL,
  `transId` varchar(50) NOT NULL,
  `payType` varchar(50) NOT NULL,
  `signature` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `momo`
--

INSERT INTO `momo` (`id`, `partnerCode`, `orderId`, `requestId`, `amount`, `orderInfo`, `orderType`, `transId`, `payType`, `signature`) VALUES
(1, 'MOMOBKUN20180529', '1712649158', '1712649158', '430000', 'Thanh toán qua MoMo', 'momo_wallet', '4018733529', 'napas', '4d75a9f8af67f313fe304cfbe874b9aebf83a376119610dfbf'),
(2, 'MOMOBKUN20180529', '1712649532', '1712649532', '430000', 'Thanh toán qua MoMo', 'momo_wallet', '4018733702', 'napas', '61f9fb14f358ec1a44621226ea943c25c728c880b0f76c7ddd'),
(3, 'MOMOBKUN20180529', '1712649750', '1712649750', '430000', 'Thanh toán qua MoMo', 'momo_wallet', '4018788598', 'napas', '89aa2b934c39dfa44daa08d35de66ac96054fd5d5035e729b8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `ship_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `status`, `ship_id`) VALUES
(19, '9935', 1, 19),
(20, '2766', 1, 20),
(21, '158', 1, 21),
(22, '6104', 2, 22),
(23, '5665', 1, 23),
(24, '2005', 1, 24),
(25, '4177', 1, 25),
(26, '8831', 1, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_code` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_code`, `product_id`, `quantity`) VALUES
(15, '9935', 21, 1),
(16, '9935', 22, 1),
(17, '9935', 27, 1),
(18, '2766', 21, 5),
(19, '2766', 22, 7),
(20, '158', 22, 5),
(21, '158', 21, 3),
(22, '6104', 21, 1),
(23, '6104', 26, 5),
(24, '6104', 22, 2),
(25, '5665', 21, 2),
(26, '5665', 26, 1),
(27, '5665', 22, 1),
(28, '5665', 28, 1),
(29, '4177', 21, 1),
(30, '4177', 22, 100),
(31, '8831', 21, 1),
(32, '8831', 22, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `slug`, `quantity`, `description`, `image`, `category_id`, `brand_id`, `status`) VALUES
(21, 'Mo hinh dep vl', 100000, 'mo-hinh-dep-vl', 15, 'demo', '1711010933wpp2.jpg', 7, 10, '1'),
(22, 'Son', 30000, 'son-moi', 5, '4', '1711010953son-hoa-biet.jpg', 8, 11, '1'),
(24, 'Cuoi cc', 400000, 'teelab', 10, 'demo', '1711015804test1.jpg', 8, 10, '1'),
(26, 'phan trang di ma', 100000, 'phan-trang-di-ma', 5, 'demo', '1711098964image-dia-chi-nha-hang-viet-nam-tai-thanh-pho-denver-165081024359416.jpg', 7, 11, '1'),
(27, 'Mo hinh 2', 100000, 'mo-hinh-2', 5, 'demo', '1711336899wpp.jpg', 8, 10, '1'),
(28, 'Samsung Galaxy S23', 20000000, 'samsung-galaxy-s23', 5, 'Flagship Samsung 2023', '1711910724810.jpg', 8, 11, '1'),
(29, 'Sam sung ZFlod', 20000000, 'sam-sung-zflod', 3, 'Xấu', '1712367176810.jpg', 8, 12, '1'),
(30, 'Huawei', 23000000, 'huawei', 2, 'mota', '1712370431Screenshot-2024-03-29-141954.png', 8, 11, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `phone`, `address`, `email`, `method`) VALUES
(1, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(2, 'demo', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(3, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(4, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(5, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(6, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(7, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(8, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(9, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(10, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(11, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(12, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(13, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(14, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(15, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(16, 'Quang Huy', '0983612720', 'tay son', 'admin@gmail.com', 'cod'),
(17, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(18, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(19, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'cod'),
(20, 'Quang Huy', '0983612720', 'tay son', 'huy0.808203@gmail.com', 'cod'),
(21, 'Quang Huy', '0983612720', 'tay son', 'huy@gmail.com', 'vnpay'),
(22, 'kingvem', '0983612720', 'tay son', 'huy0.808203@gmail.com', 'cod'),
(23, 'Quang Huy', '0983612720', 'tay son', 'huy123@gmail.com', 'cod'),
(24, 'Quang Huy', '0983612720', 'tay son', 'huy123@gmail.com', 'cod'),
(25, 'Son Flower Knows', '0983612720', 'tay son', 'huy123@gmail.com', 'cod'),
(26, 'kingvem', '0983612720', 'tay son', 'lionwannafly@gmail.com', 'cod');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `status`, `image`) VALUES
(3, '3', '3', 1, '1711615628test1.jpg'),
(4, '2', '2', 1, '1711615843tải-xuống.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(2, 'lion', 'lionwannafly@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'lionwannafly@gmail.com', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

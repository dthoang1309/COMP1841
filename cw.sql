-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 13, 2026 lúc 03:26 PM
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
-- Cơ sở dữ liệu: `cw`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `username`, `message`, `created_at`, `reply`, `replied_at`) VALUES
(1, NULL, 'sâsasasasa', '2026-03-27 15:30:48', 'oko', '2026-04-03 16:28:15'),
(3, NULL, 'sasasa', '2026-04-03 16:19:06', NULL, NULL),
(5, 'Anna', 'Hello', '2026-04-13 16:17:25', 'Haha', '2026-04-13 16:17:48'),
(6, 'Jim', 'Hello', '2026-04-13 17:30:17', 'Hello', '2026-04-13 17:32:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `film`
--

INSERT INTO `film` (`id`, `title`, `image`, `user_id`) VALUES
(3, 'The Godfather', '1776074443_1774002246_The Godfather.jpg', NULL),
(4, 'The Dark Knight', 'The Dark Knight.jpg', NULL),
(5, 'Avengers: Endgame', 'Avengers.jpg', NULL),
(6, 'Interstellar', 'Interstellar.jpg', NULL),
(20, 'The Shawshank Redemption', 'The Shawshank Redemption.jpg', NULL),
(21, 'Titanic', '1776083721_Titanic.jpg', 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `reviewtext` text NOT NULL,
  `reviewdate` date NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `filmid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `review`
--

INSERT INTO `review` (`id`, `reviewtext`, `reviewdate`, `userid`, `filmid`) VALUES
(3, 'good film', '2026-02-27', 1, 3),
(4, 'Marvel masterpiece', '2026-02-27', 3, 4),
(5, 'supriesd', '2026-02-27', 2, 5),
(20, 'xx', '2026-03-20', 1, 3),
(21, 'sâsa', '2026-04-03', 1, 3),
(22, 'Very Good', '2026-04-13', 1, 20),
(23, 'Wondeful!!!!', '2026-04-13', 1, 6),
(24, 'So good, hehe', '2026-04-13', 19, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `role`, `password`) VALUES
(1, 'JohnHenderson', 'John@gmail.com', 'admin', '123'),
(2, 'David', 'David@gmail.com', 'user', '123'),
(3, 'Anna', 'Anna@gmail.com', 'user', '123'),
(16, 'james', 'james@gmail.com', 'user', '123'),
(17, 'lucas', 'lucas@gmail.com', 'user', '123'),
(19, 'Jim', 'jim@gmail.com', 'user', '$2y$10$Rhci1tlixCWhVuzyHkDXyuJBkP/RCQv5rUlLDO.b97h6rIE/YQjBG'),
(20, 'Kevin', 'kevin@gmail.com', NULL, NULL),
(21, 'John', 'John123@gmail.com', 'admin', '$2y$10$fSrvjj6pSsVj7E56QLFnNOIfZJ0BCsDwScu72JrOWXuLIRtzo3RlO');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_film_user` (`user_id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`userid`),
  ADD KEY `fk_film` (`filmid`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `fk_film_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_film` FOREIGN KEY (`filmid`) REFERENCES `film` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

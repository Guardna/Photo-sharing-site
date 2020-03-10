-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2019 at 05:44 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sphps`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(255) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `path`, `mname`) VALUES
(1, 'home', 'Home'),
(2, 'author', 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(255) NOT NULL,
  `original` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `small` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `medium` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `original`, `small`, `medium`) VALUES
(10, 'assets/images/posts/1559838708movie02.jpg', 'assets/images/posts/new_1559838708movie02.jpg', 'assets/images/posts/med_1559838708movie02.jpg'),
(11, 'assets/images/posts/15605688408.jpg', 'assets/images/posts/new_15605688408.jpg', 'assets/images/posts/med_15605688408.jpg'),
(12, 'assets/images/posts/1560568868images.jpg', 'assets/images/posts/new_1560568868images.jpg', 'assets/images/posts/med_1560568868images.jpg'),
(13, 'assets/images/posts/1560568878maxresdefault.jpg', 'assets/images/posts/new_1560568878maxresdefault.jpg', 'assets/images/posts/med_1560568878maxresdefault.jpg'),
(14, 'assets/images/posts/1560568890nature-2-26-17.jpg', 'assets/images/posts/new_1560568890nature-2-26-17.jpg', 'assets/images/posts/med_1560568890nature-2-26-17.jpg'),
(15, 'assets/images/posts/1560568899pexels-photo.jpg', 'assets/images/posts/new_1560568899pexels-photo.jpg', 'assets/images/posts/med_1560568899pexels-photo.jpg'),
(16, 'assets/images/posts/1560568908pexels-photo-207962.jpeg', 'assets/images/posts/new_1560568908pexels-photo-207962.jpeg', 'assets/images/posts/med_1560568908pexels-photo-207962.jpeg'),
(17, 'assets/images/posts/1560568922pexels-photo-236047.jpeg', 'assets/images/posts/new_1560568922pexels-photo-236047.jpeg', 'assets/images/posts/med_1560568922pexels-photo-236047.jpeg'),
(18, 'assets/images/posts/1560568932pexels-photo-248797.jpeg', 'assets/images/posts/new_1560568932pexels-photo-248797.jpeg', 'assets/images/posts/med_1560568932pexels-photo-248797.jpeg'),
(19, 'assets/images/posts/1560568943pexels-photo-459225.jpeg', 'assets/images/posts/new_1560568943pexels-photo-459225.jpeg', 'assets/images/posts/med_1560568943pexels-photo-459225.jpeg'),
(20, 'assets/images/posts/1560568959pexels-photo-371589.jpeg', 'assets/images/posts/new_1560568959pexels-photo-371589.jpeg', 'assets/images/posts/med_1560568959pexels-photo-371589.jpeg'),
(21, 'assets/images/posts/1560569016DJI_0208-Edit-2-Edit-Edit-L.jpg', 'assets/images/posts/new_1560569016DJI_0208-Edit-2-Edit-Edit-L.jpg', 'assets/images/posts/med_1560569016DJI_0208-Edit-2-Edit-Edit-L.jpg'),
(22, 'assets/images/posts/1560569029download.jpg', 'assets/images/posts/new_1560569029download.jpg', 'assets/images/posts/med_1560569029download.jpg'),
(23, 'assets/images/posts/1560372768carousel_bg_1.jpg', 'assets/images/posts/new_1560372768carousel_bg_1.jpg', 'assets/images/posts/med_1560372768carousel_bg_1.jpg'),
(24, 'assets/images/posts/156037812406.jpg', 'assets/images/posts/new_156037812406.jpg', 'assets/images/posts/med_156037812406.jpg'),
(25, 'assets/images/posts/156046280506.jpg', 'assets/images/posts/new_156046280506.jpg', 'assets/images/posts/med_156046280506.jpg'),
(26, 'assets/images/posts/1560569053Kolumbien_Mario_Laserna1.jpg', 'assets/images/posts/new_1560569053Kolumbien_Mario_Laserna1.jpg', 'assets/images/posts/med_1560569053Kolumbien_Mario_Laserna1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descriptions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_time` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo_id` int(255) NOT NULL,
  `user_ids` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `descriptions`, `post_time`, `photo_id`, `user_ids`) VALUES
(10, 'sadsad', 'asdasd', '15-06-2019 05:20:39', 11, 1),
(11, 'sadsa', 'adsd', '15-06-2019 05:21:08', 12, 17),
(12, 'sadsad', 'asdsa', '15-06-2019 05:21:18', 13, 1),
(13, 'asdsad', 'asdsad', '15-06-2019 05:21:30', 14, 17),
(14, 'asdasd', 'adsad', '15-06-2019 05:21:39', 15, 1),
(15, 'sadsad', 'asdas', '15-06-2019 05:21:48', 16, 1),
(16, 'wwws', 'asdsa', '15-06-2019 05:22:01', 17, 17),
(17, 'aaaa', 'sssa', '15-06-2019 05:22:12', 18, 1),
(18, 'sdsaa', 'asaaa', '15-06-2019 05:22:23', 19, 17),
(19, 'asass', 'ssss', '15-06-2019 05:22:39', 20, 1),
(20, 'ssss', 'sss', '15-06-2019 05:23:36', 21, 17),
(25, 'Asdsadsa', 'aaa', '15-06-2019 05:24:13', 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(100) NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `userphoto`
--

CREATE TABLE `userphoto` (
  `id` int(255) NOT NULL,
  `original` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `small` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userphoto`
--

INSERT INTO `userphoto` (`id`, `original`, `small`) VALUES
(1, 'assets/images/users/default_user.png', 'assets/images/users/default_user.png'),
(13, 'assets/images/users/1560353517me.jpg', 'assets/images/users/new_1560353517me.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pic_id` int(255) NOT NULL,
  `role_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `username`, `email`, `pass`, `pic_id`, `role_id`) VALUES
(1, 'Stefan Popovic', 'Admin', 'admin@gmail.com', '2e33a9b0b06aa0a01ede70995674ee23', 13, 1),
(17, 'Korisnik Korisnik', 'Korisnik', 'korisnik@gmail.com', 'd7e9276b8f896de9fb13769f5a03910b', 13, 2),
(18, 'User User', 'User', 'user@gmail.com', '8189d5d4551ef7c14034917663cdedf7', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `user_ids` (`user_ids`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userphoto`
--
ALTER TABLE `userphoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pic_id` (`pic_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userphoto`
--
ALTER TABLE `userphoto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_ids`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`pic_id`) REFERENCES `userphoto` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

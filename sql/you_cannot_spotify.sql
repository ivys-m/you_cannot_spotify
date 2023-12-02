-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 09:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `you_cannot_spotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `id` int(11) NOT NULL,
  `fk_playlist_id` int(11) NOT NULL,
  `fk_song_id` int(11) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`id`, `fk_playlist_id`, `fk_song_id`, `active`) VALUES
(1, 1, 1, b'1'),
(2, 1, 3, b'1'),
(3, 1, 2, b'1'),
(4, 1, 4, b'1'),
(5, 1, 5, b'1'),
(6, 1, 6, b'1'),
(7, 1, 9, b'1'),
(8, 1, 10, b'1'),
(9, 1, 11, b'1'),
(10, 1, 13, b'1'),
(11, 1, 14, b'1'),
(12, 1, 15, b'1'),
(13, 1, 17, b'1'),
(14, 1, 18, b'1'),
(15, 1, 19, b'1'),
(16, 1, 12, b'1'),
(17, 1, 16, b'1'),
(18, 1, 7, b'1'),
(19, 1, 8, b'1'),
(20, 1, 21, b'1'),
(21, 1, 20, b'1'),
(22, 1, 22, b'1'),
(28, 4, 25, b'1'),
(29, 4, 23, b'1'),
(30, 4, 26, b'0'),
(31, 4, 27, b'1'),
(32, 4, 28, b'1'),
(33, 4, 29, b'1'),
(34, 4, 30, b'1'),
(35, 4, 31, b'1'),
(36, 4, 32, b'1'),
(37, 4, 33, b'1'),
(38, 4, 34, b'1'),
(39, 4, 35, b'1'),
(40, 4, 36, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `date_of_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_user_id_created_by` int(11) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `picture_path`, `date_of_creation`, `fk_user_id_created_by`, `active`) VALUES
(1, '5BIA Kennedy 23_24', 'db/playlists/pictures/default.png', '2023-12-02 18:00:15', 100, b'1'),
(4, 'gay pride parade', 'db/playlists/pictures/picture_656b8d769e863.1701547382.jpg', '2023-12-02 21:03:02', 100, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_playlist_id` int(11) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`id`, `fk_user_id`, `fk_playlist_id`, `active`) VALUES
(1, 100, 1, b'1'),
(5, 100, 4, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `song_path` varchar(255) NOT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `date_of_upload` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_user_id_uploaded_by` int(11) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `name`, `song_path`, `picture_path`, `date_of_upload`, `fk_user_id_uploaded_by`, `active`) VALUES
(1, 'Figli d\'arte', 'db/songs/audio/audio_656b7d2b6bfda.1701543211.mp3', 'db/songs/pictures/picture_656b7d2b6627e.1701543211.jpg', '2023-12-02 17:19:10', 3, b'1'),
(2, 'Annunciatemi al Pubblico', 'db/songs/audio/audio_656b7d3d48f2c.1701543229.mp3', 'db/songs/pictures/picture_656b7d3d43523.1701543229.jpg', '2023-12-02 17:19:57', 3, b'1'),
(3, 'Changes', 'db/songs/audio/audio_656b7d6309cb5.1701543267.mp3', 'db/songs/pictures/picture_656b7d6308b41.1701543267.jpg', '2023-12-02 17:21:59', 4, b'1'),
(4, 'Welcome To The Jungle', 'db/songs/audio/audio_656b7ce18360f.1701543137.mp3', 'db/songs/pictures/picture_656b7ce17f5a3.1701543137.jpeg', '2023-12-02 17:23:51', 5, b'1'),
(5, 'Dearly Beloved', 'db/songs/audio/audio_656b7d8bd82f4.1701543307.mp3', 'db/songs/pictures/picture_656b7d8bd4028.1701543307.jpg', '2023-12-02 17:25:05', 6, b'1'),
(6, 'Bohemian Rhapsody', 'db/songs/audio/audio_656b7dae215a6.1701543342.mp3', 'db/songs/pictures/picture_656b7dae1d1da.1701543342.jpg', '2023-12-02 17:26:41', 7, b'1'),
(7, 'Another One Bites The Dust', 'db/songs/audio/audio_656b7dbf4f80b.1701543359.mp3', 'db/songs/pictures/picture_656b7dbf4866e.1701543359.jpg', '2023-12-02 17:27:39', 7, b'1'),
(8, 'Killer Queen', 'db/songs/audio/audio_656b7dcd00452.1701543373.mp3', 'db/songs/pictures/picture_656b7dcce67b5.1701543372.JPG', '2023-12-02 17:29:43', 7, b'1'),
(9, 'Ghe Sboro', 'db/songs/audio/audio_656b7e159fc45.1701543445.mp3', 'db/songs/pictures/picture_656b7e159a228.1701543445.jpeg', '2023-12-02 17:31:21', 8, b'1'),
(10, 'Banii', 'db/songs/audio/audio_656b7ecb4fe33.1701543627.mp3', 'db/songs/pictures/picture_656b7ecb4a688.1701543627.jpg', '2023-12-02 17:32:23', 9, b'1'),
(11, 'Visiera A Becco', 'db/songs/audio/audio_656b7efa999b4.1701543674.mp3', 'db/songs/pictures/picture_656b7efa953bd.1701543674.jpeg', '2023-12-02 17:34:03', 10, b'1'),
(12, 'Lingerie', 'db/songs/audio/audio_656b7f09e1b0c.1701543689.mp3', 'db/songs/pictures/picture_656b7f09dbf71.1701543689.jpeg', '2023-12-02 17:34:58', 10, b'1'),
(13, 'Tunak Tunak Tun', 'db/songs/audio/audio_656b7f424d64e.1701543746.mp3', 'db/songs/pictures/picture_656b7f4247248.1701543746.jpg', '2023-12-02 17:39:47', 11, b'1'),
(14, 'Psychosocial', 'db/songs/audio/audio_656b7f5d0c941.1701543773.mp3', 'db/songs/pictures/picture_656b7f5d07d12.1701543773.jpg', '2023-12-02 17:41:24', 12, b'1'),
(15, 'Never Love Again', 'db/songs/audio/audio_656b7fa380f45.1701543843.mp3', 'db/songs/pictures/picture_656b7fa37c806.1701543843.jpg', '2023-12-02 17:44:36', 13, b'1'),
(16, 'Bitch Please II', 'db/songs/audio/audio_656b7faeb9bd1.1701543854.mp3', 'db/songs/pictures/picture_656b7faeb56ac.1701543854.jpg', '2023-12-02 17:45:22', 13, b'1'),
(17, 'Chop Suey!', 'db/songs/audio/audio_656b7fd4b857a.1701543892.mp3', 'db/songs/pictures/picture_656b7fd4b424c.1701543892.jpg', '2023-12-02 17:46:26', 14, b'1'),
(18, 'Paramedici (1_3)', 'db/songs/audio/audio_656b800c655ae.1701543948.mp3', 'db/songs/pictures/picture_656b800c64481.1701543948.jpg', '2023-12-02 17:48:58', 15, b'1'),
(19, 'Morto Mai (Piano solo)', 'db/songs/audio/audio_656b802ea43c5.1701543982.mp3', 'db/songs/pictures/picture_656b802ea01fc.1701543982.png', '2023-12-02 17:50:56', 16, b'1'),
(20, 'Guardando la Luna (Napoli RMX)', 'db/songs/audio/audio_656b80757d7c1.1701544053.mp3', 'db/songs/pictures/picture_656b80757990d.1701544053.jpg', '2023-12-02 17:52:19', 17, b'1'),
(21, 'L\'Inverno', 'db/songs/audio/audio_656b8054c2ed7.1701544020.mp3', 'db/songs/pictures/picture_656b8054bbb9e.1701544020.jpg', '2023-12-02 17:53:54', 18, b'1'),
(22, 'I\'m Your Treasure Box You have found Captain Marine in the treasure chest.', 'db/songs/audio/audio_656b809837dbd.1701544088.mp3', 'db/songs/pictures/picture_656b809833ba4.1701544088.jpg', '2023-12-02 17:58:28', 19, b'1'),
(23, 'FUCKMYLIFE666', 'db/songs/audio/audio_656b92363f2ca.1701548598.mp3', 'db/songs/pictures/picture_656b92363eec3.1701548598.jpg', '2023-12-02 21:23:18', 102, b'1'),
(25, 'Transgender Dysphoria Blues', 'db/songs/audio/audio_656b928395ce0.1701548675.mp3', 'db/songs/pictures/picture_656b9283959df.1701548675.jpg', '2023-12-02 21:24:35', 102, b'1'),
(26, 'True Trans Soul Rebel', 'db/songs/audio/audio_656b92f3c33ec.1701548787.mp3', 'db/songs/pictures/picture_656b92f3c30be.1701548787.jpg', '2023-12-02 21:26:27', 102, b'0'),
(27, 'True Trans Soul Rebel', 'db/songs/audio/audio_656b9350318ad.1701548880.mp3', 'db/songs/pictures/picture_656b9350315da.1701548880.jpg', '2023-12-02 21:28:00', 102, b'1'),
(28, 'Born This Way', 'db/songs/audio/audio_656b93dc817dd.1701549020.mp3', 'db/songs/pictures/picture_656b93dc8143d.1701549020.jpg', '2023-12-02 21:30:20', 103, b'1'),
(29, 'I Want To Break Free', 'db/songs/audio/audio_656b9416244e2.1701549078.mp3', 'db/songs/pictures/picture_656b9416241f4.1701549078.jpg', '2023-12-02 21:31:18', 7, b'1'),
(30, 'Bicycle Race', 'db/songs/audio/audio_656b948a01c77.1701549194.mp3', 'db/songs/pictures/picture_656b947148923.1701549169.jpg', '2023-12-02 21:32:49', 7, b'1'),
(31, 'I Kissed A Girl', 'db/songs/audio/audio_656b955e68310.1701549406.mp3', 'db/songs/pictures/picture_656b94d0c2301.1701549264.png', '2023-12-02 21:34:24', 104, b'1'),
(32, 'Girls Like Girls', 'db/songs/audio/audio_656b95c7c668e.1701549511.mp3', 'db/songs/pictures/picture_656b95c7c62c0.1701549511.jpg', '2023-12-02 21:38:31', 105, b'1'),
(33, 'Trans Girls Need Guns', 'db/songs/audio/audio_656b960a74dd0.1701549578.mp3', 'db/songs/pictures/picture_656b960a74a01.1701549578.jpeg', '2023-12-02 21:39:38', 106, b'1'),
(34, 'Girls', 'db/songs/audio/audio_656b9643b47e9.1701549635.mp3', 'db/songs/pictures/picture_656b9643b442a.1701549635.jpg', '2023-12-02 21:40:35', 107, b'1'),
(35, 'Girls/Girls/Boys', 'db/songs/audio/audio_656b96969a2fd.1701549718.mp3', 'db/songs/pictures/picture_656b969699ee5.1701549718.png', '2023-12-02 21:41:58', 108, b'1'),
(36, 'YMCA', 'db/songs/audio/audio_656b96e6c97c5.1701549798.mp3', 'db/songs/pictures/picture_656b96e6c9463.1701549798.jpeg', '2023-12-02 21:43:18', 109, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `profile_picture_path` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'standard',
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_of_creation`, `profile_picture_path`, `type`, `active`) VALUES
(3, 'Caparezza', 'adc66747020aa48ad87305a5814ffa04', 'user1@mail.com', '2023-12-02 17:18:16', NULL, 'Artist', b'1'),
(4, '2Pac', '0f82983e3dd52ca55e7d21966d437014', 'user2@mail.com', '2023-12-02 17:21:42', NULL, 'Artist', b'1'),
(5, 'Guns N\' Roses', '8ef9ae32e7b1351f139e074c18df9371', 'user3@mail.com', '2023-12-02 17:23:31', NULL, 'Artist', b'1'),
(6, 'Yoko Shimomura', '7f878e68fc1300c46a548255e31578f6', 'user4@mail.com', '2023-12-02 17:24:35', NULL, 'Artist', b'1'),
(7, 'Queen', '72545f3f86fad045a26ed54abd2bbb9f', 'user5@mail.com', '2023-12-02 17:26:03', NULL, 'Artist', b'1'),
(8, 'Rumatera', '8047b8977c468249a82ffbe296fc226e', 'user6@mail.com', '2023-12-02 17:30:37', NULL, 'Artist', b'1'),
(9, 'Tzanca Uruganu', 'a3bc242465f3263458dd217e009e469d', 'user7@mail.com', '2023-12-02 17:31:47', NULL, 'Artist', b'1'),
(10, 'Sfera Ebbasta', '77aaba3a49e674d6622503222afc2d1f', 'user8@mail.mail', '2023-12-02 17:33:19', NULL, 'Artist', b'1'),
(11, 'Daler Mehndi', '8524e0802c0b894b444752c265d9d1b0', 'user9@mail.com', '2023-12-02 17:39:11', NULL, 'Artist', b'1'),
(12, 'Slipknot', 'f34c903e17cfeea18e499d4627eeb3ec', 'user10@mail.com', '2023-12-02 17:41:10', NULL, 'Artist', b'1'),
(13, 'Eminem', '26b637ed41273425be243e8d42e5b461', 'user12@mail.com', '2023-12-02 17:43:44', NULL, 'Artist', b'1'),
(14, 'System Of A Dawn', '009f25a425c179da52a4f69b60bf81fc', 'user13@mail.com', '2023-12-02 17:45:54', NULL, 'Artist', b'1'),
(15, 'Artie 5ive', '30056e1cab7a61d256fc8edd970d14f5', 'user14@mail.com', '2023-12-02 17:47:10', NULL, 'Artist', b'1'),
(16, 'Lazza', 'e5721642a527be55c5caae6fe66060c0', 'user15@mail.com', '2023-12-02 17:49:25', NULL, 'Artist', b'1'),
(17, 'Clementino', '6661dfe2008d642087572de0acbfc09e', 'user16@mail.com', '2023-12-02 17:51:56', NULL, 'Artist', b'1'),
(18, 'Antonio Vivaldi', '15607a23632c7b2c8018fb4fbb50c66a', 'user17@mail.com', '2023-12-02 17:53:03', NULL, 'Artist', b'1'),
(19, '宝生マリン', 'b329f324cc17d6221a385ea1afb3a289', 'user18@mail.com', '2023-12-02 17:55:28', NULL, 'Artist', b'1'),
(100, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@admin.admin', '2023-12-02 17:58:58', NULL, 'Artist', b'1'),
(102, 'Against Me', '36a383994590c1a836800f68a08d00ba', 'user19@mail.com', '2023-12-02 21:22:38', NULL, 'Artist', b'1'),
(103, 'Lady Gaga', '811584043b844704c9bb9a6e99dd05d3', 'user20@mail.com', '2023-12-02 21:29:50', NULL, 'Artist', b'1'),
(104, 'Katy Perry', '72653eebc70ae85b3d34c8e90f6b679b', 'user21@mail.com', '2023-12-02 21:33:52', NULL, 'Artist', b'1'),
(105, 'Hayley Kiyoko', 'd6d3b08e4affed587dfbec86112bb3a5', 'user22@mail.com', '2023-12-02 21:38:03', NULL, 'Artist', b'1'),
(106, 'Flummox', '4a4c6aa3da54a3a2dab0306339742e2c', 'user23@mail.com', '2023-12-02 21:39:01', NULL, 'Artist', b'1'),
(107, 'Girl In Red', '28ca53d2b7bb4aa13549b4022c79dca1', 'user24@mail.com', '2023-12-02 21:40:11', NULL, 'Artist', b'1'),
(108, 'Panic! At the Disco', 'c1a9a474d030d4706c8346a0d15a48a5', 'user25@mail.com', '2023-12-02 21:41:17', NULL, 'Artist', b'1'),
(109, 'Village People', '813f8ce580f276558ce9e5093468b1ab', 'user26@mail.com', '2023-12-02 21:43:08', NULL, 'Artist', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_playlist_id` (`fk_playlist_id`),
  ADD KEY `fk_song_id` (`fk_song_id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_created_by` (`fk_user_id_created_by`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_playlist_id` (`fk_playlist_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_uploaded_by` (`fk_user_id_uploaded_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contains`
--
ALTER TABLE `contains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`fk_playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`fk_song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`fk_user_id_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saved`
--
ALTER TABLE `saved`
  ADD CONSTRAINT `saved_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saved_ibfk_2` FOREIGN KEY (`fk_playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`fk_user_id_uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

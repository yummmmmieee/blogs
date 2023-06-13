-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 04:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4bblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posting`
--

CREATE TABLE `blog_posting` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_posting`
--

INSERT INTO `blog_posting` (`post_id`, `post_title`, `post_content`, `created_at`, `u_id`) VALUES
(54, ' Unleashing Your Creative Potential', 'Creativity is a powerful force that resides within each and every one of us. It\'s the ability to think outside the box, to imagine, to innovate, and to bring something new and unique into existence. Whether you\'re an artist, a writer, a musician, or simply someone seeking to tap into their creative side, unleashing your creative potential can be a life-changing experience. In this blog post, we\'ll explore seven steps that can help you ignite your inner genius and unlock the limitless possibilities of your imagination.', '2023-06-13 14:03:58', 13),
(55, 'The Power of Gratitude', 'In a world that often moves at a rapid pace, it\'s easy to overlook the small blessings and moments of joy that surround us. Gratitude is a transformative practice that can shift our perspective, enhance our well-being, and cultivate a life of appreciation and abundance. In this blog post, we will delve into the power of gratitude, explore its numerous benefits, and provide practical tips on how to incorporate gratitude into our daily lives.', '2023-06-13 14:04:56', 13),
(56, 'The Art of Self-Compassion', 'In a world that often emphasizes self-improvement and achievement, we tend to be our own harshest critics. However, cultivating self-compassion is a vital practice that can transform our relationship with ourselves and bring about profound emotional healing and personal growth. In this blog post, we will explore the art of self-compassion, delve into its benefits, and provide practical strategies to nurture a kind and empowered inner dialogue.', '2023-06-13 14:05:56', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(13, 'Yumie', 'Cabato', 'cabatoyumie@gmail.com', '$2y$10$TT9FhrLni1LdmmCWfoGysu6FdhP8KYzeFupR4tz450s6gPwtNmaIi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posting`
--
ALTER TABLE `blog_posting`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posting`
--
ALTER TABLE `blog_posting`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

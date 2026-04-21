-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 03:27 PM
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
-- Database: `soon_delete`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `meta_desc` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `featured_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `author`, `body`, `excerpt`, `category`, `status`, `meta_desc`, `tags`, `views`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 'Getting Started with PHP & MySQL', 'getting-started-php-mysql', 'Admin User', '<h2>Introduction</h2><p>In this tutorial, we\'ll walk through how to connect a PHP application to a MySQL database using PDO.</p><h3>Why PDO?</h3><p>PDO (PHP Data Objects) provides a lightweight, consistent interface for accessing databases. It supports multiple database types and offers protection against SQL injection through prepared statements.</p><h2>Prerequisites</h2><ul><li>PHP 7.0 or higher</li><li>MySQL Server</li><li>Basic PHP knowledge</li></ul><h2>Getting Started</h2><p>Let\'s begin by creating a simple database connection...</p>', 'A beginner\'s guide to connecting PHP with a MySQL database using PDO.', 'Tutorial', 'published', 'Learn to connect PHP with MySQL in this beginner-friendly tutorial on PDO.', 'php, mysql, database, pdo', 1250, '', '2026-03-23 10:22:43', '2026-03-23 10:22:43'),
(2, '10 CSS Tips Every Developer Should Know', '10-css-tips-developers', 'Admin User', '<h2>CSS Best Practices</h2><p>Cascading Style Sheets can sometimes feel unpredictable. Here are 10 practical tips to help you write cleaner and more efficient stylesheets.</p><h3>Tip 1: Use CSS Variables</h3><p>CSS custom properties (variables) allow you to define reusable values...</p><h3>Tip 2: Mobile-First Design</h3><p>Start with mobile styles and add complexity for larger screens...</p>', 'Practical tricks to write cleaner, more efficient stylesheets.', 'Frontend', 'published', '10 practical CSS tricks for cleaner, more efficient stylesheets.', 'css, frontend, tips, best-practices', 892, '', '2026-03-23 10:22:43', '2026-03-23 10:22:43'),
(3, 'Understanding RESTful APIs', 'understanding-restful-apis', 'Admin User', '<h2>What is REST?</h2><p>REST (Representational State Transfer) is an architectural style for distributed hypermedia systems. It defines a set of principles for creating web services.</p><h2>Core Principles</h2><p>REST APIs use HTTP methods to perform operations on resources...</p>', 'What REST is and how to design clean API endpoints.', 'Backend', 'draft', 'A comprehensive guide to understanding and designing RESTful APIs.', 'api, rest, backend, http', 456, '', '2026-03-23 10:22:43', '2026-03-23 10:22:43'),
(4, 'Database Optimization Strategies', 'database-optimization-strategies', 'Admin User', '<h2>Why Optimize?</h2><p>Database performance is crucial for application speed and user experience. Poor optimization can lead to slow queries, high server load, and unhappy users.</p><h2>Indexing</h2><p>Proper indexing is one of the most important optimization techniques...</p>', 'Learn advanced techniques to optimize your database queries.', 'Database', 'published', 'Database optimization strategies for better performance and scalability.', 'database, optimization, sql, performance', 673, '', '2026-03-23 10:22:43', '2026-03-23 10:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT 2 COMMENT '1 = Administrator, 2 = Moderator',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@blogcms.com', '$2y$10$YIjlrTyKvLcb7G5.2KhBLeXvQzcJDlvUq2vxkv8N8f7zLJ5OAz5eW', 'admin_token_12345', 1, '2026-03-23 10:22:43', '2026-03-23 10:22:43'),
(2, 'Jon', 'test@example.us', '$2y$10$/v.T2vz24r5PDXQZtCEh8O8SDyIsgF4zcjGkU/EQOotkGKXrbBZyu', '402e8584212962db658c4c441d78623d', 2, '2026-03-23 10:24:23', '2026-03-23 10:24:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

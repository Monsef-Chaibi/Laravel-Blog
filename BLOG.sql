-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2025 at 02:01 PM
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
-- Database: `BLOG`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_social_media`
--

CREATE TABLE `blog_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url_facebook` varchar(255) DEFAULT NULL,
  `url_instagram` varchar(255) DEFAULT NULL,
  `url_youtube` varchar(255) DEFAULT NULL,
  `url_twitter` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `markable_type` varchar(255) NOT NULL,
  `markable_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 1000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'Technology', 1000, '2025-01-03 16:37:59', '2025-01-03 16:37:59'),
(2, 'Lifestyle', 1000, '2025-01-03 16:38:17', '2025-01-03 16:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `reply_comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_12_152221_create_password_resets_table', 1),
(6, '2023_05_12_192120_create_users_verify_table', 1),
(7, '2023_05_16_132706_add_role_column_to_users_table', 1),
(8, '2023_05_16_161947_create_settings_table', 1),
(9, '2023_05_17_000917_create_blog_social_media_table', 1),
(10, '2023_05_18_224904_create_categories_table', 1),
(11, '2023_05_18_224937_create_sub_categories_table', 1),
(12, '2023_05_19_145921_create_posts_table', 1),
(13, '2023_05_22_011944_create_update_posts_table', 1),
(14, '2023_05_25_181432_create_comments_table', 1),
(15, '2023_05_26_000611_create_comment_replies_table', 1),
(16, '2023_05_29_162830_create_bookmarks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('xr.monsef@gmail.com', 'dsPUPvmUhSIq44wI13EuAmmBf0drzfkO4TtAo6Qn57OP9w2m7TEtIkNP4KW8rwON', '2025-01-03 18:47:37'),
('xr.monsef@gmail.com', 'P2YYCkqXyO3mKoecXLDEOIUY12pO96h3KGYMceHJUoKjbxwVLzYrFJxUMEKVErLX', '2025-01-03 18:47:52'),
('xr.monsef@gmail.com', 'NxEarhaywJV91WNMxR57TR9Y4uThNTMewcRxCSBbAbkQtZE8KrR6wD5t8csTZhA9', '2025-01-03 18:48:00'),
('xr.monsef@gmail.com', 'H1VGkTa8L6BYWXme0tyA7H4ZZSYtwnYJzsmlO1RI3L6ax9gHlAXMmX6DYCH9CNhQ', '2025-01-03 20:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_content` text DEFAULT NULL,
  `post_tags` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `post_title`, `post_slug`, `post_content`, `post_tags`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'The Future of AI: Trends to Watch in 2024', 'the-future-of-ai-trends-to-watch-in-2024', '<p>Artificial Intelligence is rapidly evolving, and 2024 promises significant advancements. From generative AI models that create stunning artwork to AI-driven healthcare solutions that save lives, the future is bright. Industries like finance, retail, and education are adopting AI to optimize operations. This post explores top trends such as AI-powered robotics, edge AI, and explainable AI. We&rsquo;ll also discuss the increasing focus on green AI to reduce environmental impact. Stay ahead of the curve by understanding what&rsquo;s next in the AI revolution.</p>\r\n\r\n<p>&quot;</p>\r\n\r\n<p>&quot;</p>', 'AI,Technology Trends,Artificial Intelligence', '1735926556_f.jpg', '2025-01-03 16:43:19', '2025-01-03 16:49:16'),
(2, 2, 1, 'Ethical Concerns in AI Development', 'ethical-concerns-in-ai-development', '<h2>As AI becomes more integrated into our lives, ethical concerns are on the rise. Issues like data privacy, algorithmic bias, and job displacement need urgent attention. This post highlights real-world examples of biased AI systems and explores the challenges of creating transparent algorithms. Governments and tech companies are now prioritizing regulations to ensure responsible AI development. Learn how ethical frameworks can guide the future of AI.<br />\r\n&nbsp;</h2>', 'AI,Data Privacy,Algorithm Bias', '1735926743_t.jpg', '2025-01-03 16:52:23', '2025-01-03 16:52:23'),
(3, 2, 2, 'Top 5 Must-Have Gadgets for Tech Enthusiasts', 'top-5-must-have-gadgets-for-tech-enthusiasts', '<h2>Whether you&#39;re a tech enthusiast or just love exploring new gadgets, 2024 offers an exciting lineup. From foldable smartphones to noise-canceling earbuds, there&rsquo;s something for everyone. This post highlights the latest devices like the Apple Vision Pro, Samsung Galaxy Z Fold 5, and DJI Mini 4 Pro drone. We&rsquo;ll dive into their features, pricing, and why they&rsquo;re worth the hype. Stay updated with the coolest gadgets on the market.<br />\r\n&nbsp;</h2>', 'Gadgets,Tech Trends,Must-Have Devices,Consumer Tech', '1735926870_techgifts-2048px-0719-2x1-1.webp', '2025-01-03 16:54:30', '2025-01-03 16:54:30'),
(4, 2, 2, 'How to Choose the Perfect Laptop for Your Needs', 'how-to-choose-the-perfect-laptop-for-your-needs', '<h2>Choosing the right laptop can be overwhelming, given the wide range of options. This post breaks down key factors to consider, such as performance, portability, battery life, and budget. Whether you&#39;re a gamer, a student, or a professional, we&rsquo;ll help you find the best laptop. Explore top recommendations for different use cases and learn how to make an informed decision.<br />\r\n&nbsp;</h2>', 'Laptop Guide,Tech Tips,Laptops', '1735926962_the-ultimate-guide-to-choosing-the-perfect-laptop-for-your-needs.jpg', '2025-01-03 16:56:02', '2025-01-03 16:56:02'),
(5, 2, 3, '10 Simple Habits for a Healthier Life', '10-simple-habits-for-a-healthier-life', '<h2>Adopting healthy habits can transform your life. This post provides practical tips like drinking more water, exercising regularly, and getting adequate sleep. We&rsquo;ll also explore the importance of mindfulness and maintaining a balanced diet. These simple yet effective changes can boost your energy levels, improve mental clarity, and enhance overall well-being. Start your journey to a healthier life today!</h2>', NULL, '1735927092_Untitled-design-3.png', '2025-01-03 16:58:12', '2025-01-03 16:58:12'),
(6, 2, 4, 'Top 10 Budget-Friendly Travel Destinations in 2024', 'top-10-budget-friendly-travel-destinations-in-2024', '<p>Traveling doesn&rsquo;t have to break the bank. This post explores affordable travel destinations like Bali, Budapest, and Morocco. We&rsquo;ll provide tips on finding cheap flights, budget-friendly accommodations, and local attractions. Whether you&rsquo;re a solo traveler or planning a family vacation, discover how to travel smart without compromising on experiences.</p>', 'Budget Travel,Affordable Destinations', '1735927171_maxresdefault.jpg', '2025-01-03 16:59:31', '2025-01-03 16:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_name` varchar(255) DEFAULT NULL,
  `blog_email` varchar(255) DEFAULT NULL,
  `blog_description` text DEFAULT NULL,
  `blog_logo` varchar(255) DEFAULT NULL,
  `blog_favicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `blog_name`, `blog_email`, `blog_description`, `blog_logo`, `blog_favicon`, `created_at`, `updated_at`) VALUES
(1, 'Monsef Blog', 'admin@gmail.com', 'admin', 'uploads/logo/1735927508_796_blog_logo.png', 'uploads/logo/1735927508_796_blog_logo.png', '2025-01-03 16:20:55', '2025-01-03 17:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_category` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 100000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `subcategory_name`, `slug`, `parent_category`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'Artificial Intelligence', 'artificial-intelligence', '1', 100000, '2025-01-03 16:38:39', '2025-01-03 16:38:39'),
(2, 'Gadgets & Devices', 'gadgets-devices', '1', 100000, '2025-01-03 16:39:00', '2025-01-03 16:39:00'),
(3, 'Health & Wellness', 'health-wellness', '2', 100000, '2025-01-03 16:39:24', '2025-01-03 16:39:24'),
(4, 'Travel & Adventure', 'travel-adventure', '2', 100000, '2025-01-03 16:39:35', '2025-01-03 16:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'uploads/profile/default_profile_picture.jpg',
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT '2025-01-03 15:06:59',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `blocked` int(11) NOT NULL DEFAULT 0,
  `direct_publish` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('author','admin') NOT NULL DEFAULT 'author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `bio`, `picture`, `country`, `state`, `join_date`, `email_verified_at`, `password`, `blocked`, `direct_publish`, `remember_token`, `created_at`, `updated_at`, `is_email_verified`, `role`) VALUES
(1, 'Golden Ortiz V', 'xr.monsef@gmail.com', 'bpagac', NULL, 'uploads/profile/default_profile_picture.png', NULL, NULL, '2025-01-03 15:06:59', '2025-01-03 16:20:55', '$2y$10$sdEDg1oPnL4.OgeM4pln1.OdSN5.72VzaVBwoLsZlxBvtKdu7SkQa', 0, 0, '76QouOqLpZ', '2025-01-03 16:20:55', '2025-01-03 16:20:55', 0, 'author'),
(2, NULL, 'admin@gmail.com', 'admin', NULL, 'uploads/profile/profile.png', NULL, NULL, '2025-01-03 15:06:59', NULL, '$2y$10$Biots44LTDjRzfXRHFGjCutii8stoDQhK7XzXQw/OZffbBaLK3vWm', 0, 0, 'FUwHeIL02br5c9Im5VzcOjZC8Mp4NcukFWOu9QZ364oTWHMLzOsIjFIr4Ath', '2025-01-03 16:34:39', '2025-01-03 16:34:39', 1, 'admin'),
(4, NULL, 'adminw@gmail.com', '32452345', NULL, 'uploads/profile/default_profile_picture.jpg', NULL, NULL, '2025-01-03 15:06:59', NULL, '$2y$10$rebKCfFo9USLBWxO4Dz1JObS7IdoNCQiK5FYXxoxgfpDY3nwxpVaq', 0, 0, NULL, '2025-06-05 09:09:56', '2025-06-05 09:09:56', 0, 'author'),
(6, NULL, 'ch.monsef1@gmail.com', 'monsef', NULL, 'uploads/profile/default_profile_picture.jpg', NULL, NULL, '2025-01-03 15:06:59', NULL, '$2y$10$0AsNJXHBmSLpTmUqo8nz8ue8vc60UF4.XxwboR2mCqE2uLxl4mwHq', 0, 0, NULL, '2025-06-05 09:25:29', '2025-06-05 09:25:29', 0, 'author');

-- --------------------------------------------------------

--
-- Table structure for table `users_verify`
--

CREATE TABLE `users_verify` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_verify`
--

INSERT INTO `users_verify` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(2, 'EE8ZPeC0ivmvIdBFhS5VKkLADJKtPC0zX0ya47r55HLB5P9R1VqQQVJALgWeW5yq', '2025-01-03 16:34:39', '2025-01-03 16:34:39'),
(3, 'XqJd6zrMHb04XXmiTCX6uH7OQeiQvUsKZJXR8tRNAmmpKsKkAi8MHO1uT77JnObr', '2025-06-05 09:07:23', '2025-06-05 09:07:23'),
(4, 'Nr9VRLn5IxCJSVQTwgHUPuY9NUCFBCK4V46S82MdDqXoXB0ainXKthRNJmS2FeDV', '2025-06-05 09:09:56', '2025-06-05 09:09:56'),
(5, 'Bns8CgdhWtMbaHexYtjyuGVTDGpmO0djoIHRhAMf5JK74kGnz7Cp0xrl2zYndBqm', '2025-06-05 09:20:46', '2025-06-05 09:20:46'),
(6, 'kXaqgDKFz9rPn7xWtL0LZiYFXBqPK8kigMo6akxKn4NXNCUNYaejgBGOytO0Heaa', '2025-06-05 09:25:29', '2025-06-05 09:25:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_social_media`
--
ALTER TABLE `blog_social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarks_markable_type_markable_id_index` (`markable_type`,`markable_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_social_media`
--
ALTER TABLE `blog_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

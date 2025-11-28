-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 09:30 PM
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
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `issuing_organization` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'award',
  `view_type` enum('link','image') NOT NULL DEFAULT 'link',
  `credential_url` varchar(255) DEFAULT NULL,
  `certificate_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `name`, `issuing_organization`, `issue_date`, `icon`, `view_type`, `credential_url`, `certificate_image`, `created_at`, `updated_at`) VALUES
(1, 'AWS Certified Developer', 'Amazon Web Services', '2020-05-10', 'award', 'link', 'https://aws.amazon.com/certification/', NULL, '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(2, 'Certified Data Scientist', 'Data Science Institute', '2021-08-22', 'bar-chart-2', 'image', NULL, '/images/certificates/data-scientist.jpg', '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(3, 'AWS Certified Developer', 'Amazon Web Services', '2020-05-10', 'award', 'link', 'https://aws.amazon.com/certification/', NULL, '2025-11-28 05:17:23', '2025-11-28 05:17:23'),
(4, 'Certified Data Scientist  dhfah', 'Data Science Institute', '2021-08-22', 'bar-chart-2', 'link', NULL, '/images/certificates/data-scientist.jpg', '2025-11-28 05:17:24', '2025-11-28 05:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `display_email` varchar(255) DEFAULT NULL,
  `heading_text` varchar(255) DEFAULT NULL,
  `subtext` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_email`, `display_email`, `heading_text`, `subtext`, `created_at`, `updated_at`, `linkedin_url`, `github_url`) VALUES
(1, 'pawankshetri11@gmail.com', 'pawankshetri11@gmail.com', 'Get In Touch', 'Let\'s connect! Whether it\'s about a project, opportunity, or just to say hi.', '2025-11-28 05:50:47', '2025-11-28 05:51:35', 'https://linkedin.com/in/pawankshetri', 'https://github.com/pawankshetri11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `degree` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT 0,
  `location` varchar(255) DEFAULT NULL,
  `icon_style` varchar(255) NOT NULL DEFAULT 'graduation-cap',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `degree`, `institution`, `start_date`, `end_date`, `is_present`, `location`, `icon_style`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Master\'s of Computer Application', 'Graphic Era Deemed to be University', '2025-08-01', '2027-06-30', 1, 'Dehradun, IN', 'grad-cap', 'Focusing on advanced Computer Applications and software development methodologies.', '2025-11-28 05:16:38', '2025-11-28 05:40:41'),
(4, 'BCA - Data Science', 'Dev Bhoomi Uttarakhand University', '2022-08-01', '2025-05-31', 0, 'Dehradun, IN', 'book-open-check', 'Specialized in Data Science fundamentals, analytics, and database management systems.', '2025-11-28 05:16:38', '2025-11-28 05:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `logo` varchar(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `display_type` enum('responsibilities','description') NOT NULL DEFAULT 'responsibilities',
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `position`, `company`, `logo`, `start_date`, `end_date`, `description`, `location`, `responsibilities`, `technologies`, `display_type`, `roles`, `created_at`, `updated_at`) VALUES
(2, 'WordPress & Shopify Developer', 'White Key Pro Commercio', NULL, '2025-06-01', '2025-08-31', 'Developed custom Shopify themes and managed e-commerce product catalogs. Collaborated with design teams to implement pixel-perfect UI components. Maintained legacy WordPress sites and implemented security patches.', 'On-site', 'Developed custom Shopify themes and managed e-commerce product catalogs.\nCollaborated with design teams to implement pixel-perfect UI components.\nMaintained legacy WordPress sites and implemented security patches.', 'Shopify Liquid,E-commerce', 'responsibilities', NULL, '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(3, 'Chief Operating Officer / Co-Founder', 'Dev To Dsa', NULL, '2025-01-01', '2025-06-30', 'Led daily operations and strategic planning, scaling the platform to over 5,000 active users. Conceptualized the platform vision and developed the initial MVP.', 'Remote', 'Led daily operations and strategic planning, scaling the platform to over 5,000 active users.\nConceptualized the platform vision and developed the initial MVP. Focused on early-stage product market fit.', 'Operations,Strategy,Product,Startup', 'responsibilities', '[{\"title\":\"Chief Operating Officer\",\"start_date\":\"2025-02-01\",\"end_date\":\"2025-06-30\",\"description\":\"Led daily operations and strategic planning, scaling the platform to over 5,000 active users.\",\"skills\":[\"Operations\",\"Strategy\"]},{\"title\":\"Co-Founder\",\"start_date\":\"2025-01-01\",\"end_date\":\"2025-05-31\",\"description\":\"Conceptualized the platform vision and developed the initial MVP. Focused on early-stage product market fit.\",\"skills\":[\"Product\",\"Startup\"]}]', '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(9, 'WordPress Developer', 'Capital Street FX', NULL, '2025-07-15', NULL, NULL, 'Remote', 'Developed custom Shopify themes and managed e-commerce product catalogs.\nCollaborated with design teams to implement pixel-perfect UI components.\nMaintained legacy WordPress sites and implemented security patches.', 'PHP, PHOTOSHOP', 'responsibilities', NULL, '2025-11-28 09:21:52', '2025-11-28 09:21:52');

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
-- Table structure for table `heros`
--

CREATE TABLE `heros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `greeting` varchar(255) NOT NULL DEFAULT 'Hi, I''m',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `animation_label_1` varchar(255) DEFAULT NULL,
  `animation_label_2` varchar(255) DEFAULT NULL,
  `animation_label_3` varchar(255) DEFAULT NULL,
  `animation_label_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `heros`
--

INSERT INTO `heros` (`id`, `title`, `subtitle`, `description`, `image`, `created_at`, `updated_at`, `greeting`, `first_name`, `last_name`, `github_url`, `linkedin_url`, `email`, `animation_label_1`, `animation_label_2`, `animation_label_3`, `animation_label_4`) VALUES
(1, 'Data Analyst | Full Stack Developer', 'Data.', 'Turning complex datasets into actionable insights, and building robust, scalable web applications from the ground up.', NULL, '2025-11-28 05:08:41', '2025-11-28 05:37:08', 'Hi, I\'m', 'Pawan', 'Kshetri', 'https://github.com/pawankshetri11', 'https://linkedin.com/in/pawankshetri', 'pawankshetri11@gmail.com', 'Data Analysis', 'Frontend Dev', 'API Development', 'Database Design'),
(2, 'Data Analyst | Full Stack Developer', 'Data.', 'Turning complex datasets into actionable insights, and building robust, scalable web applications from the ground up.', NULL, '2025-11-28 05:16:19', '2025-11-28 05:16:19', 'Hi, I\'m', 'Pawan', 'Kshetri', 'https://github.com/pawankshetri', 'https://linkedin.com/in/pawan', 'contact@pawan.dev', 'Data Analysis', 'Frontend Dev', 'API Development', 'Database Design');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `key_metrics`
--

CREATE TABLE `key_metrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `key_metrics`
--

INSERT INTO `key_metrics` (`id`, `value`, `label`, `order`, `created_at`, `updated_at`) VALUES
(1, '4+', 'Years Experience', 0, '2025-11-28 05:08:41', '2025-11-28 05:42:47'),
(2, '45+', 'Projects Completed', 1, '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(3, '9+', 'Core Technologies', 2, '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(4, '100%', 'Data-Driven', 3, '2025-11-28 05:08:41', '2025-11-28 05:08:41');

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
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2025_11_25_110423_create_heros_table', 1),
(21, '2025_11_25_110508_create_abouts_table', 1),
(22, '2025_11_25_110539_create_educations_table', 1),
(23, '2025_11_25_110612_create_projects_table', 1),
(24, '2025_11_25_110647_create_skills_table', 1),
(25, '2025_11_25_110714_create_tech_stacks_table', 1),
(26, '2025_11_25_110743_create_experiences_table', 1),
(27, '2025_11_25_110814_create_contacts_table', 1),
(28, '2025_11_25_161650_add_fields_to_projects_table', 1),
(29, '2025_11_26_050021_create_certificates_table', 1),
(30, '2025_11_26_094408_add_logo_to_skills_table', 1),
(31, '2025_11_26_100848_create_key_metrics_table', 1),
(32, '2025_11_26_102813_add_additional_fields_to_heros_table', 1),
(33, '2025_11_27_044613_add_fields_to_experiences_table', 2),
(34, '2025_11_27_051012_add_roles_to_experiences_table', 2),
(35, '2025_11_27_054113_make_position_nullable_in_experiences_table', 2),
(36, '2025_11_27_054642_make_start_date_nullable_in_experiences_table', 2),
(37, '2025_11_27_061131_add_display_type_to_experiences_table', 2),
(38, '2025_11_27_070159_add_logo_to_experiences_table', 2),
(39, '2025_11_27_100000_create_contact_messages_table', 2),
(40, '2025_11_27_165237_add_fields_to_contacts_table', 3),
(41, '2025_11_27_165557_add_social_links_to_contacts_table', 3),
(42, '2025_11_28_050120_create_skill_categories_table', 3),
(43, '2025_11_28_050159_add_category_id_to_skills_table', 3),
(44, '2025_11_28_052809_migrate_existing_skills_to_categories', 3),
(45, '2025_11_28_054859_add_icon_to_skill_categories_table', 3),
(46, '2025_11_28_104251_create_project_categories_table', 4),
(47, '2025_11_28_104441_add_category_id_to_projects_table', 5);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `live_url` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `content`, `image`, `published_at`, `created_at`, `updated_at`, `description`, `technologies`, `github_url`, `live_url`, `category_id`) VALUES
(1, 'Smart Mood Enhancer', 'smart-mood-enhancer', 'A comprehensive AI-powered application that uses machine learning algorithms to detect user mood patterns and provide personalized recommendations for content, activities, and interventions.', NULL, '2025-11-28 05:15:53', '2025-11-28 05:15:53', '2025-11-28 05:15:53', 'An AI-based system that analyzes user emotions and recommends personalized content to improve mental well-being.', 'Python, ML, AI', 'https://github.com/pawankshetri/smart-mood-enhancer', 'https://smartmood.demo.com', 5),
(2, 'School ERP System', 'school-erp-system', 'Complete school management system with student information, attendance tracking, grade management, faculty profiles, and administrative reporting features.', NULL, '2025-11-28 05:15:53', '2025-11-28 05:15:53', '2025-11-28 12:46:54', 'A comprehensive ERP system for educational institutions, managing student records, attendance, grades, and faculty.', 'Python, SQL, Wew', 'https://github.com/pawankshetri/school-erp', 'https://school-erp.demo.com', 7),
(3, 'Sales & Inventory System', 'sales-inventory-system', 'Advanced inventory management system with sales tracking, automated reporting, stock alerts, and comprehensive analytics dashboard.', NULL, '2025-11-28 05:15:53', '2025-11-28 05:15:53', '2025-11-28 05:15:53', 'A complete inventory and sales tracking system with real-time analytics, stock management, and automated reporting.', 'Python, SQL, Power BI', 'https://github.com/pawankshetri/sales-inventory', 'https://inventory.demo.com', 8);

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#3B82F6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES
(5, 'Web Development', 'web-development', 'Full-stack web applications and websites', '#3b82f6', '2025-11-28 10:46:32', '2025-11-28 11:45:18'),
(7, 'Data Analysis', 'data-analysis', 'Data visualization and analytics projects', '#F59E0B', '2025-11-28 10:46:32', '2025-11-28 10:46:32'),
(8, 'Game Development', 'game-development', 'Interactive games and gaming applications', '#10B981', '2025-11-28 10:46:32', '2025-11-28 10:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kiJmjPJoCzXNq0dZlhRC7oTkyF6Zq639xAlQjb1v', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRFBnV0dKNXJOaGJXTFJ2V0JrRVV6ZDBkTDU3Q1NlZllXbHFlb1NtSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1764361566);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `level`, `created_at`, `updated_at`, `logo`, `category_id`) VALUES
(2, 'React', 90, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 1),
(3, 'Node.js', 80, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 2),
(4, 'PostgreSQL', 75, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 3),
(5, 'MongoDB', 70, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 3),
(7, 'Docker', 70, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 4),
(8, 'Git', 85, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 4),
(9, 'Machine Learning', 75, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 5),
(10, 'Data Analysis', 80, '2025-11-28 05:19:04', '2025-11-28 05:19:04', NULL, 5),
(11, 'Pk2', 2, '2025-11-28 10:32:08', '2025-11-28 10:32:08', 'logos/RHGdTMtbtwfDMSZHfpYqM8jWpFWdp14afb1jCj2b.svg', 1),
(12, 'Pk3', 3, '2025-11-28 13:48:55', '2025-11-28 13:48:55', 'logos/bb5usGtHHy57oCCX0lk7cEpkoMeqi1jYWMK6Xrz0.svg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skill_categories`
--

CREATE TABLE `skill_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'layers'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill_categories`
--

INSERT INTO `skill_categories` (`id`, `name`, `created_at`, `updated_at`, `icon`) VALUES
(1, 'Frontend Development', '2025-11-28 05:11:32', '2025-11-28 05:11:32', 'layers'),
(2, 'Backend Development', '2025-11-28 05:11:32', '2025-11-28 05:11:32', 'layers'),
(3, 'Database', '2025-11-28 05:11:32', '2025-11-28 05:11:32', 'layers'),
(4, 'Tools & Cloud', '2025-11-28 05:11:32', '2025-11-28 13:53:22', 'cloud'),
(5, 'Data Science', '2025-11-28 05:11:32', '2025-11-28 05:11:32', 'layers'),
(7, 'jh', '2025-11-28 14:06:31', '2025-11-28 14:06:31', 'cpu');

-- --------------------------------------------------------

--
-- Table structure for table `tech_stacks`
--

CREATE TABLE `tech_stacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-11-28 05:08:40', '$2y$12$EN2JsMW6W1Ck0O6rZX/I4eICI7W2CcSP3YRtPv38Q9sBiPM5vhhu6', 'irQYhqJTJm', '2025-11-28 05:08:41', '2025-11-28 05:08:41'),
(2, 'Admin', 'pawankshetri11@gmail.com', '2025-11-28 05:08:41', '$2y$12$k6GQe3JS/43xzXXBuwG/ZOKBgFj2ZnRstlqw4nFqPvvmyN28Q6Jqa', NULL, '2025-11-28 05:08:41', '2025-11-28 05:08:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `heros`
--
ALTER TABLE `heros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_metrics`
--
ALTER TABLE `key_metrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`),
  ADD KEY `projects_category_id_foreign` (`category_id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_category_id_foreign` (`category_id`);

--
-- Indexes for table `skill_categories`
--
ALTER TABLE `skill_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_stacks`
--
ALTER TABLE `tech_stacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heros`
--
ALTER TABLE `heros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `key_metrics`
--
ALTER TABLE `key_metrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `skill_categories`
--
ALTER TABLE `skill_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tech_stacks`
--
ALTER TABLE `tech_stacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `project_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `skill_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

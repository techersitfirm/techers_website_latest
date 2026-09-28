-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2026 at 08:48 PM
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
-- Database: `techers`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `intro_image` varchar(255) DEFAULT NULL,
  `blog_date` date NOT NULL,
  `views_count` int(11) NOT NULL DEFAULT 0,
  `popular_tags` text DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `page_id`, `title`, `slug`, `description`, `intro_image`, `blog_date`, `views_count`, `popular_tags`, `author`, `created_by`, `is_delete`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 21, 'The Importance of Regular Eye Exams', 'the-importance-of-regular-eye-exams', '<p>&lt;section&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"container\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"row gx-5\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"col-lg-8\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"blog-read\"&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your eyes are one of the most important parts of your health, yet regular eye exams are often overlooked.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Comprehensive eye checkups not only detect vision problems early but can also reveal signs of underlying health conditions such as diabetes or high blood pressure.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; By scheduling routine visits with your optometrist, you can safeguard your vision and overall well-being.</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Here are the key reasons why regular eye exams are essential for every age group:</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ol class=\"ol-style-1\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Early Detection of Eye Diseases&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Conditions like glaucoma, cataracts, and macular degeneration often develop silently.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Regular exams help catch them early, when treatment is most effective.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Monitoring Vision Changes&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Even small vision changes can affect daily life.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your optometrist can update your glasses or contact prescription to keep your vision clear and comfortable.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Protecting Children’s Eye Health&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Children may struggle in school due to undetected vision issues.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Regular exams ensure they see clearly for learning and development.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Supporting Healthy Aging&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; As we age, our risk of eye disease increases.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Routine checkups can help maintain independence and quality of life by preventing vision loss.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Detecting Other Health Conditions&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Eye doctors can spot early signs of diabetes, hypertension, and even high cholesterol during an exam,</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; often before other symptoms appear.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Preventing Digital Eye Strain&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; With more screen time, many people experience headaches and tired eyes.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Exams can provide solutions like blue-light protection lenses.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Peace of Mind&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Knowing your vision and eye health are well cared for reduces anxiety and helps you plan ahead with confidence.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/ol&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/blog/1.webp\"</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;class=\"w-100 rounded-1\" alt=\"Eye exam image\"&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"spacer-single\"&gt;&lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div id=\"blog-comment\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Comments (5)&lt;/h4&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"spacer-half\"&gt;&lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ol&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"avatar\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/testimonial/1.webp\" alt=\"\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment-info\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_name\"&gt;Merrill Rayos&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_date id-color\"&gt;2 days ago&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_reply\"&gt;&lt;a href=\"#\"&gt;Reply&lt;/a&gt;&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"clearfix\"&gt;&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Very informative! I skipped exams for years, but after reading this I booked an appointment. Eye health really should be a priority.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ol&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"avatar\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/testimonial/2.webp\" alt=\"\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment-info\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_name\"&gt;Jackqueline Sprang&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_date id-color\"&gt;2 days ago&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_reply\"&gt;&lt;a href=\"#\"&gt;Reply&lt;/a&gt;&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"clearfix\"&gt;&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Same here. My optometrist found early signs of glaucoma that I didn’t even notice. Regular checkups really do make a difference.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/ol&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"avatar\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/testimonial/3.webp\" alt=\"\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment-info\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_name\"&gt;Sanford Crowley&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_date id-color\"&gt;2 days ago&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_reply\"&gt;&lt;a href=\"#\"&gt;Reply&lt;/a&gt;&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"clearfix\"&gt;&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; I used to think exams were only for people with poor eyesight, but I learned they can reveal other health problems too. Great article!</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ol&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"avatar\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/testimonial/4.webp\" alt=\"\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment-info\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_name\"&gt;Lyndon Pocekay&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_date id-color\"&gt;2 days ago&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_reply\"&gt;&lt;a href=\"#\"&gt;Reply&lt;/a&gt;&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"clearfix\"&gt;&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Absolutely! My doctor noticed high blood pressure during an eye exam. It’s amazing what they can find beyond just vision.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/ol&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"avatar\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/testimonial/5.webp\" alt=\"\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment-info\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_name\"&gt;Aleen Crigger&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_date id-color\"&gt;2 days ago&lt;/span&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;span class=\"c_reply\"&gt;&lt;a href=\"#\"&gt;Reply&lt;/a&gt;&lt;/span&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"clearfix\"&gt;&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thank you for sharing this. I’ve been putting off scheduling an appointment, but now I see how important it is. Will book mine soon.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/ol&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"spacer-single\"&gt;&lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div id=\"comment-form-wrapper\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Leave a Comment&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"comment_form_holder\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;form id=\"contact_form\" name=\"form1\" class=\"form-border\" method=\"post\" action=\"#\"&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;label&gt;Name&lt;/label&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type=\"text\" name=\"name\" id=\"name\" class=\"form-control\"&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;label&gt;Email &lt;span class=\"req\"&gt;*&lt;/span&gt;&lt;/label&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type=\"text\" name=\"email\" id=\"email\" class=\"form-control\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div id=\"error_email\" class=\"error\"&gt;Please check your email&lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;label&gt;Message &lt;span class=\"req\"&gt;*&lt;/span&gt;&lt;/label&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;textarea cols=\"10\" rows=\"10\" name=\"message\" id=\"message\" class=\"form-control\"&gt;&lt;/textarea&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div id=\"error_message\" class=\"error\"&gt;Please check your message&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div id=\"mail_success\" class=\"success\"&gt;Thank you. Your message has been sent.&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div id=\"mail_failed\" class=\"error\"&gt;Error, email not sent&lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;p id=\"btnsubmit\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type=\"submit\" id=\"send\" value=\"Send\" class=\"btn-main\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/p&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/form&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"col-lg-4\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"widget widget-post\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Popular Posts&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ul class=\"de-bloglist-type-1\"&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;?php</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $popular = [</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [\"1.webp\", \"Managing Digital Eye Strain\", \"10 Jan 2025\"],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [\"2.webp\", \"Understanding Cataracts and Treatment Options\", \"22 Feb 2025\"],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [\"3.webp\", \"Protecting Children’s Vision at School\", \"05 Mar 2025\"],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [\"4.webp\", \"Top Foods for Healthy Eyes\", \"12 Mar 2025\"],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [\"5.webp\", \"How to Choose the Right Glasses\", \"28 Apr 2025\"],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [\"6.webp\", \"The Role of Eye Exams in Overall Health\", \"03 May 2025\"],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ];</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; foreach ($popular as $p):</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ?&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"d-image\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;img src=\"&lt;?php echo BASE_URL; ?&gt;/assets/frontend/images/blog/&lt;?php echo e($p[0]); ?&gt;\" alt=\"\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"d-content\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;a href=\"#\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;&lt;?php echo e($p[1]); ?&gt;&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/a&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"d-date\"&gt;&lt;?php echo e($p[2]); ?&gt;&lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;?php endforeach; ?&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/ul&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class=\"widget widget_tags\"&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;h4&gt;Popular Tags&lt;/h4&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ul&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Eye Exams&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Vision Care&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Optometry&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Children’s Eye Health&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Cataracts&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Glaucoma&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Healthy Eyes&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Digital Eye Strain&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Glasses&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Contact Lenses&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Eye Nutrition&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;li&gt;&lt;a href=\"#link\"&gt;Preventive Care&lt;/a&gt;&lt;/li&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/ul&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p><br>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p><p>&nbsp; &nbsp; &lt;/section&gt;</p>', '1764246239_1.webp', '2025-09-01', 45, NULL, NULL, NULL, 1, 0, '2025-11-27 17:53:59', '2026-09-21 01:07:34'),
(14, 86, 'title', 'title', '<p>this is description.</p>', 'blogs/blog_460637_580912506985900.jpg', '2026-09-16', 0, '', '', 3, 0, 1, '2026-09-21 01:20:26', '2026-09-21 02:34:19');
INSERT INTO `blogs` (`id`, `page_id`, `title`, `slug`, `description`, `intro_image`, `blog_date`, `views_count`, `popular_tags`, `author`, `created_by`, `is_delete`, `is_active`, `created_at`, `updated_at`) VALUES
(15, 87, 'Ferox Films AI: The Complete AI Filmmaking Platform for Modern Content Creators', 'ferox-films-ai-the-complete-ai-filmmaking-platform-for-modern-content-creators', '<p><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">The world of content creation is evolving rapidly, and artificial intelligence is transforming the way videos are planned, produced, and delivered. From marketing campaigns and product advertisements to social media content and cinematic storytelling, AI-powered filmmaking platforms are helping creators produce high-quality videos faster than ever before.\r\nAmong these innovative platforms, Ferox Films AI stands out as a comprehensive AI filmmaking solution designed for content creators, filmmakers, agencies, brands, and businesses looking to streamline video production without compromising creativity.\r\nIn this guide, we\'ll explore the key features, benefits, and use cases of Ferox Films AI, and explain why it is becoming a preferred choice for modern AI-assisted filmmaking.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">What is Ferox Films AI?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nFerox Films AI is an AI-powered filmmaking platform that combines advanced artificial intelligence with creative storytelling to simplify the entire video production process. Instead of relying solely on traditional filming methods, creators can use AI-driven tools to accelerate ideation, script development, visual generation, editing, and production workflows.\r\n\r\nWhether you\'re creating\r\n● Commercial advertisements\r\n● Product videos\r\n● Social media campaigns\r\n● Brand storytelling\r\n● Promotional films\r\n● Educational content\r\n● Corporate presentations\r\n● Creative short films\r\nFerox Films AI helps reduce production time while maintaining professional-quality output.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Why AI Filmmaking is Transforming Content Creation</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nTraditional filmmaking often requires significant investments in equipment, production teams, editing software, and post-production resources. AI is changing this landscape by automating repetitive tasks and assisting creators throughout the production process.\r\n\r\nModern AI filmmaking platforms help users:\r\n● Produce videos faster\r\n● Reduce production costs\r\n● Improve creative efficiency\r\n● Generate cinematic visuals\r\n● Experiment with multiple concepts\r\n● Scale content production\r\n● Deliver consistent branding across projects\r\n\r\nFor businesses, this means quicker marketing campaigns. For creators, it means more time to focus on storytelling rather than technical production challenges.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Key Features of Ferox Films AI</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">1. AI-Powered Video Creation</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nOne of the platform\'s standout capabilities is AI-assisted video generation. Users can transform ideas into engaging visual content with significantly less manual effort.\r\nThis feature helps creators accelerate production while maintaining creative control over the final output.\r\n\r\nBenefits include:\r\n● Faster content creation\r\n● Professional-quality visuals\r\n● Reduced production timelines\r\n● Efficient creative workflows\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">2. Cinematic Storytelling</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nCompelling stories are at the heart of successful videos. Ferox Films AI supports creators by helping organize narratives into engaging visual experiences.\r\nThis enables creators to focus on:\r\n● Story development\r\n● Scene planning\r\n● Narrative flow\r\n● Visual consistency\r\n● Audience engagement\r\nThe result is cinematic content that communicates messages more effectively.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">3. AI-Assisted Script Development</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nDeveloping scripts can be one of the most time-consuming stages of video production. AI-assisted scripting helps creators quickly generate ideas, improve dialogue, structure scenes, and refine storytelling.\r\n\r\nThis feature is especially valuable for:\r\n● Marketing agencies\r\n● YouTube creators\r\n● Business presentations\r\n● Educational videos\r\n● Product explainers\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">4. High-Quality Visual Generation</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nModern audiences expect visually appealing content. Ferox Films AI supports the creation of polished visuals suitable for digital marketing, social media, and professional presentations.\r\nCreators can generate content that aligns with their brand identity while maintaining a cinematic look and feel.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">5. Efficient Video Editing Workflow</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nVideo editing often consumes the largest portion of production time. AI-powered editing features help automate repetitive editing tasks, allowing creators to complete projects more efficiently.\r\n\r\nEditing assistance may include:\r\n● Scene organization\r\n● Clip sequencing\r\n● Visual enhancements\r\n● Workflow optimization\r\n● Faster revisions\r\nThis allows creators to focus on creative decisions rather than manual editing.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">6. Brand-Friendly Content Creation</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nBusinesses need consistent visual branding across campaigns. Ferox Films AI helps maintain professional consistency throughout video production.\r\n\r\nThis is especially useful for:\r\n● Corporate marketing\r\n● Product launches\r\n● Brand awareness campaigns\r\n● Social media marketing\r\n● Digital advertising\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">7. Faster Production for Marketing Teams</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nMarketing teams often need to publish content quickly across multiple platforms. AI-assisted production enables faster turnaround times while maintaining quality standards.\r\n\r\nTeams can produce:\r\n● Product videos\r\n● Promotional campaigns\r\n● Event highlights\r\n● Customer testimonials\r\n● Brand commercials\r\n● Social media advertisements\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">8. Creative Collaboration</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nLarge projects involve multiple stakeholders, including marketers, designers, editors, and decision-makers.\r\nA centralized workflow improves collaboration by making it easier to manage creative assets, review projects, and streamline production.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Who Can Benefit from Ferox Films AI?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nFerox Films AI serves a wide range of industries and professionals.\r\nDigital Marketing Agencies\r\nProduce client campaigns faster while reducing production costs.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Content Creators</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nCreate engaging YouTube videos, Instagram Reels, TikTok content, and educational videos with greater efficiency.\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Businesses</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nDevelop professional marketing videos, promotional campaigns, and corporate presentations.\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">E-commerce Brands</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nGenerate product demonstrations and promotional videos that help improve customer engagement.\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Startups</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nLaunch marketing campaigns without investing heavily in traditional production teams.\r\nEducational Institutions\r\nDevelop learning materials, explainer videos, and training content with AI-assisted workflows.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Advantages of Using Ferox Films AI</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nBusinesses and creators can benefit from:\r\n● Faster production cycles\r\n● Reduced video creation costs\r\n● Improved creative efficiency\r\n● Professional-quality output\r\n● Scalable content creation\r\n● Consistent branding\r\n● Streamlined workflows\r\n● Better audience engagement\r\n● AI-assisted creativity\r\n● Support for diverse content formats\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Why Modern Content Creators Are Embracing AI</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nAI is no longer replacing creativity—it is enhancing it.\r\nInstead of spending countless hours on repetitive production tasks, creators can focus on:\r\n● Creative direction\r\n● Storytelling\r\n● Audience engagement\r\n● Marketing strategy\r\n● Brand communication\r\n● Content innovation\r\n\r\nAI becomes a creative assistant that helps bring ideas to life more efficiently.\r\n\r\nBest Use Cases\r\nFerox Films AI is well-suited for:\r\n● Brand commercials\r\n● Product launch videos\r\n● Explainer videos\r\n● Educational tutorials\r\n● Corporate communication\r\n● Social media campaigns\r\n● Short films\r\n● Promotional videos\r\n● Event marketing\r\n● Digital advertisements\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Frequently Asked Questions</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">What is Ferox Films AI?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nFerox Films AI is an AI-powered filmmaking platform designed to help creators, businesses, and agencies streamline video production with intelligent tools that support storytelling, visual creation, and efficient content workflows.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Is Ferox Films AI suitable for beginners?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nYes. The platform is designed for both beginners and experienced creators, offering tools that simplify complex filmmaking processes while still allowing creative flexibility.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Can businesses use Ferox Films AI for marketing?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nAbsolutely. Businesses can use the platform to create promotional videos, product showcases, social media campaigns, corporate presentations, and branded marketing content more efficiently.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">What industries benefit most from AI filmmaking?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nIndustries such as marketing, e-commerce, education, entertainment, real estate, healthcare, technology, and corporate communications can all benefit from AI-assisted video production.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Why is AI filmmaking becoming popular?</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nAI filmmaking reduces production time, lowers costs, improves efficiency, and enables creators to produce high-quality visual content at scale while maintaining creative control.\r\n\r\n</span><span style=\"font-weight: bolder; color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">Final Thoughts</span><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\">\r\nAs demand for video content continues to grow, creators and businesses need faster, smarter, and more scalable production methods. Ferox Films AI addresses these challenges by combining artificial intelligence with creative filmmaking workflows, enabling users to produce engaging videos more efficiently.\r\nWhether you\'re a solo creator, digital marketing agency, startup, or enterprise, adopting AI-assisted filmmaking can help you streamline production, reduce turnaround times, and focus on what matters most—telling compelling stories that connect with your audience.\r\nBy integrating intelligent workflows with cinematic creativity, Ferox Films AI represents a modern approach to content creation that supports the evolving needs of today\'s digital landscape.\r\n</span></p><div><span style=\"color: rgb(69, 69, 69); font-family: Livvic, sans-serif; text-align: justify; white-space: pre-line;\"><br></span></div>', 'blogs/blog_844257_580890482676000.jpg', '2026-09-21', 0, '', '', 3, 0, 1, '2026-09-21 02:33:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(1234) NOT NULL,
  `job_location` varchar(1234) NOT NULL,
  `qualification` varchar(1234) NOT NULL,
  `job_brief` text NOT NULL,
  `roll_skill` varchar(1234) NOT NULL,
  `image` varchar(1234) NOT NULL,
  `job_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `perks_benefits` varchar(1234) NOT NULL,
  `requirements` varchar(1234) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `job_location`, `qualification`, `job_brief`, `roll_skill`, `image`, `job_date`, `perks_benefits`, `requirements`, `status`) VALUES
(55, 'Business Development Trainee', 'Meerut', 'Graduation / MBA', 'This Job includes carrying out daily activities of generating business for the company via calls and developing an array of customers in the industry serving by the company. You must show your interpersonal skills to bring more business to the company. Techers always appreciate performance and your work for the company\'s betterment is always rewarded.', '* Sales and Negotiation Skills.* Ability to convert leads into potential Customers.* Relationship Building skills.* Knowledge of Ms-Office Suite is a Big Advantage.* Excellent communication skills.', '', '2025-04-24 01:30:00', '* Five Days Working.* Fixed Day Shift.* Fixed Sat-Sun off.* Performance-based Incentives.* Scope of Learning new things.', '', 1),
(58, 'Sales Executive', 'Meerut', 'Graduation / MBA', 'We are looking for a competitive and trustworthy Sales Executive to help us build up our business activities Sales Executive responsibilities include discovering and pursuing new sales prospects, negotiating deals and maintaining customer satisfaction If you have excellent communication skills and feel comfortable reaching out to potential customers to demonstrate our services and products through email and phone, weâ€™d like to meet you Ultimately, youâ€™ll help us meet and surpass business expectations and contribute to our companyâ€™s rapid and sustainable growth', '* Proven experience as a Sales Executive or relevant role.\r\n* Proficiency in EnglishExcellent knowledge of MS Office.\r\n* Hands-on experience with CRM software is a plus.\r\n* Thorough understanding of marketing and negotiating techniques.\r\n* Fast learner with and passion for sales.\r\n* Self-motivated with a results-driven approach.\r\n* Aptitude in delivering attractive presentations.\r\n', 'sales.png', '2024-06-13 05:53:27', '* Five Days Working.\r\n* Fixed Day Shift.\r\n* Fixed Sat-Sun off.\r\n* Performance-based Incentives.\r\n* Scope of Learning new things.', '* Fresher and Experience both are eligible.\r\n* Any Graduated & Post Graduated can apply.\r\n* Exceptional Communication interpersonal and Negotiation skill.\r\n* Ability to articulate product details effectively to client.\r\n* Strong analytical and problem solving.\r\n* Proficiency in English and Hindi.\r\n', 1),
(59, 'SEO Intern ', 'Meerut', 'Gradation / Digital Marketing Certificate.', 'We are looking for an SEO intern who can work on website ranking and manage all search engine optimization activities.\r\nAs an SEO intern, you will be working in close coordination with the marketing team in order to drive organic traffic to a website. It also includes handling all SEO activities, namely content strategy, link building, quality backlinks, and keyword strategy, to help in listing websites on various search engine platforms.\r\n', '* Google Analytics.\r\n* Google Search Console (Google Web Master).\r\n* Keyword Research.\r\n* On-Page SEO.\r\n* Off-Page SEO.\r\n* SEO Tools.\r\n', 'We Are.jpg', '2024-07-15 02:33:41', '* Five Days Working.\r\n* Fixed Day Shift.\r\n* Fixed Sat-Sun off.\r\n* Performance-based Incentives.\r\n* Scope of Learning new things.', '* Digital marketing certificate holder from a recognized institute.\r\n* Excellent communication skills.\r\n* Effective writing skills.\r\n* Basic understanding of SEO concepts.\r\n* Analytical approach to every detail.\r\n* Ability to work in a fast-paced environment.\r\n', 1),
(60, 'Quality Analyst Intern', 'Meerut', 'BSc in Computer Science, Engineering in CS/IT / BCA.', 'We are currently looking for a QA tester to assess software and website quality through\r\nmanual testing. Your key task will include finding and reporting bugs and technical glitches.\r\nThis position requires you to be attentive to every detail and have excellent communication\r\nskills. If you are also able to implement test cases and are meticulous about quality, Overall,\r\nyou will make sure that our products, applications, and systems work seamlessly and\r\ncorrectly.', '*Analyze and review system requirements.\r\n* Collaborate with QA engineers in order to formulate proper strategies and test plans.\r\n* Implement manual test cases and examine the results.\r\n* Prepare logs to document testing phases and defects.\r\n* Report and raise bugs and errors with the development teams.\r\n* Help troubleshoot issues.\r\n* Conduct post-implementation testing.', 'We Are 1.jpg', '2024-06-04 01:30:00', '* Five Days Working.\r\n* Fixed Day Shift.\r\n* Fixed Sat-Sun off.\r\n* Performance-based Incentives.\r\n* Scope of Learning new things.', '* Knowledge of quality assurance testing or a similar role.\r\n* Knowledge of Agile frameworks and regression testing is a big advantage.\r\n* Ability to write a document for troubleshooting errors.\r\n* Attention to every minute detail.\r\n* Analytical mindset and problem-solving approach.', 0),
(61, 'Web Developer Intern', 'Meerut', 'B.C.A , B.Sc. / B.Tech or BE in computer science, IT, or a related field.\r\n', 'We are seeking a talented and keen learner for the position of web developer who will be responsible for coding, an innovative approach to designing, and the user-friendly layout of clientsâ€™ websites. This role primarily involves developing a website from scratch and applying aesthetic features and functionality to it.', '* Proven working experience in web programming\r\n* Efficient programming and knowledge of modern HTML and CSS.\r\n* Deep understanding of any of the programming languages: PHP, ASP.NET, JavaScript.\r\n* A proper familiarity with the concept of how web applications work, including security, session management, and best development practices.\r\n* Sufficient knowledge of relational database systems, Oops concepts, and web application development.\r\n* Familiarity with the concept of knowledge of the SEO process\r\n* Robust organizational skills to handle multiple tasks within the stipulated time and be capable of working with his own acumen as per the client\'s budget.\r\n* Ability to perform in a learning environment.\r\n', 'website post.png', '2024-06-05 23:47:00', '* Five Days Working.\r\n* Fixed Day Shift.\r\n* Fixed Sat-Sun off.\r\n* Performance-based Incentives.\r\n* Scope of Learning new things.\r\n', '* Knowledge of a well-designed, testable, and efficient code editor.\r\n* Write code for website layout and user interface by using standard HTML and CSS , JavaScript practices.\r\n* Integrate and migrate data from numerous back-end services and databases.\r\n* Collect and filter specific requirements and needs based on technical specifications.\r\n* Create and maintain software documentation.\r\n* Stay updated and familiar with emerging technologies, industry trends, and tools, and apply them to web development.\r\n', 1),
(62, 'Web Developer Intern', 'Meerut', 'B.C.A , B.Sc. / B.Tech or BE in computer science, IT, or a related field.', 'We are seeking a talented and keen learner for the position of web developer who will be responsible for coding, an innovative approach to designing, and the user-friendly layout of clientsâ€™ websites. This role primarily involves developing a website from scratch and applying aesthetic features and functionality to it.', '* Proven working experience in web programming\r\n* Efficient programming and knowledge of modern HTML and CSS.\r\n* Deep understanding of any of the programming languages: PHP, ASP.NET, JavaScript.\r\n* A proper familiarity with the concept of how web applications work, including security, session management, and best development practices.\r\n* Sufficient knowledge of relational database systems, Oops concepts, and web application development.\r\n* Familiarity with the concept of knowledge of the SEO process\r\n* Robust organizational skills to handle multiple tasks within the stipulated time and be capable of working with his own acumen as per the client\'s budget.\r\n* Ability to perform in a learning environment.', 'website post (1).png', '2024-06-05 01:30:00', '* Five Days Working.\r\n* Fixed Day Shift.\r\n* Fixed Sat-Sun off.\r\n* Performance-based Incentives.\r\n* Scope of Learning new things.', '* Knowledge of a well-designed, testable, and efficient code editor.\r\n* Write code for website layout and user interface by using standard HTML and CSS , JavaScript practices.\r\n* Integrate and migrate data from numerous back-end services and databases.\r\n* Collect and filter specific requirements and needs based on technical specifications.\r\n* Create and maintain software documentation.\r\n* Stay updated and familiar with emerging technologies, industry trends, and tools, and apply them to web development.', 0),
(63, 'Sales Executive', 'Meerut', 'Graduation / MBA', 'We are looking for a competitive and trustworthy Sales Executive to help us build up our business activities Sales Executive responsibilities include discovering and pursuing new sales prospects, negotiating deals and maintaining customer satisfaction If you have excellent communication skills and feel comfortable reaching out to potential customers to demonstrate our services and products through email and phone, weâ€™d like to meet you Ultimately, youâ€™ll help us meet and surpass business expectations and contribute to our companyâ€™s rapid and sustainable growth', '* Proven experience as a Sales Executive or relevant role.\r\n* Proficiency in EnglishExcellent knowledge of MS Office.\r\n* Hands-on experience with CRM software is a plus.\r\n* Thorough understanding of marketing and negotiating techniques.\r\n* Fast learner with and passion for sales.\r\n* Self-motivated with a results-driven approach.\r\n* Aptitude in delivering attractive presentations.', 'sales.png', '2025-04-24 01:00:52', '* Five Days Working.\r\n* Fixed Day Shift.\r\n* Fixed Sat-Sun off.\r\n* Performance-based Incentives.\r\n* Scope of Learning new things.', '*  Experience .\r\n* Intrested in Field work.\r\n* Any Graduated & Post Graduated can apply.\r\n* Exceptional Communication interpersonal and Negotiation skill.\r\n* Ability to articulate product details effectively to client.\r\n* Strong analytical and problem solving.\r\n* Proficiency in English and Hindi.', 1),
(64, 'Tele caller Executive', 'Meerut', '12th grade or higher educationFluent verbal communication skillsBasic computer skillsExcellent Writing SkillsFreshers can also apply.', 'The tele caller position is open for immediate hiring at Techers, and if you have the passion to apply your communication skills to effectively drive and make a positive impact leading to boosting the companyâ€™s business, then we want to hear from you. This position is solely for female candidates.\r\n', 'Strong Convincing Skills \r\nKnowing all the details of the product or service offerings.\r\nKeep a consistent check on the lists of individual contact details.\r\nMeet the desired tasks within the stipulated time.\r\nStay updated with market trends to better serve customers.\r\nAbility to bring in the confidence of the potential leads\r\nAbility to meticulously listen to customers queries and provide effective solutions.\r\nBuild and maintain positive relationships with future prospects', 'jobs/job_240889_639318701862700.png', '2026-09-21 18:30:00', '* Fixed Day Shift.\r\n* Fixed off on every Sunday\r\n* Performance-based incentives.\r\n* Opportunity to learn and become acquainted with the real-world corporate culture.', 'Making calls to potential customers\r\nExplaining company services and products\r\nMaintaining daily call records\r\nSubmitting daily progress reports\r\nMaintain data of the potential lead.\r\nProviding Support to Existing Customers\r\nMaintain good and professional contact with the clients.\r\nFamiliarity with the usage of MS- Excel\r\nKnowledge of Social Media', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_page_tbl`
--

CREATE TABLE `master_page_tbl` (
  `Id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `header_heading` varchar(255) DEFAULT NULL,
  `header_sub_heading` varchar(255) DEFAULT NULL,
  `meta_tag` varchar(100) DEFAULT NULL,
  `meta_keyword` varchar(100) DEFAULT NULL,
  `seo_title` varchar(150) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_canonical` varchar(255) DEFAULT NULL,
  `seo_robots` varchar(50) DEFAULT NULL,
  `og_title` varchar(150) DEFAULT NULL,
  `og_description` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `faq_scripts` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_child` tinyint(1) NOT NULL DEFAULT 0,
  `modify_by` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_page_tbl`
--

INSERT INTO `master_page_tbl` (`Id`, `name`, `slug`, `title`, `header_heading`, `header_sub_heading`, `meta_tag`, `meta_keyword`, `seo_title`, `seo_description`, `seo_canonical`, `seo_robots`, `og_title`, `og_description`, `og_image`, `faq_scripts`, `is_active`, `is_child`, `modify_by`, `created_at`, `updated_at`) VALUES
(1, 'home', 'home', 'Home', '', '', '', '', '', '', '', '', '', '', '', '<script type=\"application/ld+json\">\r\n{\r\n  \"@context\": \"https://schema.org\",\r\n  \"@type\": \"MedicalOrganization\",\r\n  \"name\": \"techers Clinics\",\r\n  \"alternateName\": \"techers Eye Hospital\",\r\n  \"url\": \"https://www.techers.com/\",\r\n  \"logo\": \"https://www.techers.com/assets/frontend/images/logo-dark.png\",\r\n  \"image\": \"https://www.techers.com/assets/frontend/images/background/5.png\",\r\n  \"description\": \"Super-speciality eye care clinic offering advanced ophthalmology services including refractive surgery, cataract, retina, glaucoma, cornea, oculoplasty, neuro-ophthalmology and pediatric eye care.\",\r\n  \"foundingDate\": \"1989\",\r\n  \"founders\": [\r\n    {\r\n      \"@type\": \"Person\",\r\n      \"name\": \"Dr. Prakhyat Roop\",\r\n      \"description\": \"Founder and internationally recognised ophthalmic surgeon with US patents and awards in cataract & refractive surgery.\"\r\n    }\r\n  ],\r\n  \"address\": {\r\n    \"@type\": \"PostalAddress\",\r\n    \"streetAddress\": \"Roop Netrayala Building, Opp. NAS College, EK Road\",\r\n    \"addressLocality\": \"Meerut\",\r\n    \"addressRegion\": \"Uttar Pradesh\",\r\n    \"postalCode\": \"250001\",\r\n    \"addressCountry\": \"IN\"\r\n  },\r\n  \"telephone\": \"+918588870093\",\r\n  \"email\": \"info.techers@gmail.com\",\r\n  \"openingHoursSpecification\": [\r\n    {\r\n      \"@type\": \"OpeningHoursSpecification\",\r\n      \"dayOfWeek\": [\r\n        \"Monday\",\r\n        \"Tuesday\",\r\n        \"Wednesday\",\r\n        \"Thursday\",\r\n        \"Friday\"\r\n      ],\r\n      \"opens\": \"08:00\",\r\n      \"closes\": \"19:00\"\r\n    },\r\n    {\r\n      \"@type\": \"OpeningHoursSpecification\",\r\n      \"dayOfWeek\": \"Saturday\",\r\n      \"opens\": \"08:00\",\r\n      \"closes\": \"17:00\"\r\n    }\r\n  ],\r\n  \"medicalSpecialty\": [\r\n    \"Ophthalmology\",\r\n    \"RefractiveSurgery\",\r\n    \"RetinaCare\",\r\n    \"GlaucomaTreatment\",\r\n    \"CorneaTreatment\",\r\n    \"Oculoplasty\",\r\n    \"NeuroOphthalmology\",\r\n    \"PediatricOphthalmology\"\r\n  ],\r\n  \"parentOrganization\": {\r\n    \"@type\": \"Organization\",\r\n    \"name\": \"techers Clinics\"\r\n  },\r\n  \"hasOfferCatalog\": {\r\n    \"@type\": \"OfferCatalog\",\r\n    \"name\": \"Eye Care Services\",\r\n    \"itemListElement\": [\r\n      {\r\n        \"@type\": \"OfferCatalog\",\r\n        \"name\": \"Refractive Surgery\",\r\n        \"itemListElement\": [\r\n          {\r\n            \"@type\": \"Offer\",\r\n            \"name\": \"SmartLASIK & SmartSurfACE\"\r\n          },\r\n          {\r\n            \"@type\": \"Offer\",\r\n            \"name\": \"CLEAR Corneal Lenticule Extraction (KLex) surgery\"\r\n          },\r\n          {\r\n            \"@type\": \"Offer\",\r\n            \"name\": \"ICL / IPCL Phakic Lens Implants\"\r\n          }\r\n        ]\r\n      },\r\n      {\r\n        \"@type\": \"OfferCatalog\",\r\n        \"name\": \"Retina Services\",\r\n        \"itemListElement\": [\r\n          {\r\n            \"@type\": \"Offer\",\r\n            \"name\": \"Retina Diagnostics & Imaging\"\r\n          },\r\n          {\r\n            \"@type\": \"Offer\",\r\n            \"name\": \"Retinal Laser Treatments\"\r\n          },\r\n          {\r\n            \"@type\": \"Offer\",\r\n            \"name\": \"Vitrectomy Surgery\"\r\n          }\r\n        ]\r\n      },\r\n      {\r\n        \"@type\": \"Offer\",\r\n        \"name\": \"Cataract & Lens Surgery\"\r\n      },\r\n      {\r\n        \"@type\": \"Offer\",\r\n        \"name\": \"Glaucoma Diagnosis & Management\"\r\n      },\r\n      {\r\n        \"@type\": \"Offer\",\r\n        \"name\": \"Corneal & Ocular Surface Care\"\r\n      },\r\n      {\r\n        \"@type\": \"Offer\",\r\n        \"name\": \"Oculoplasty & Squint Correction\"\r\n      }\r\n    ]\r\n  },\r\n  \"aggregateRating\": {\r\n    \"@type\": \"AggregateRating\",\r\n    \"ratingValue\": \"5.0\",\r\n    \"reviewCount\": \"5419+\"\r\n  }\r\n}\r\n</script>\r\n', 1, 0, 0, NULL, '2026-02-06 02:08:04'),
(86, 'title', 'title', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 3, '2026-09-21 01:20:26', '2026-09-21 02:34:19'),
(87, 'Ferox Films AI: The Complete AI Filmmaking Platfor', 'ferox-films-ai-the-complete-ai-filmmaking-platform-for-modern-content-creators', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 3, '2026-09-21 02:33:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_post`
--

CREATE TABLE `master_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_post`
--

INSERT INTO `master_post` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 1, '2026-08-25 19:41:39', NULL),
(2, 'HR Executive', 1, '2026-08-25 19:41:39', NULL),
(3, 'Senior Quality Analyst', 1, '2026-08-25 19:41:39', NULL),
(4, 'Graphic Designer', 1, '2026-08-25 19:41:39', NULL),
(5, 'Jr. Quality Analyst', 1, '2026-08-25 19:41:39', NULL),
(6, 'Brand and Sales Associate', 1, '2026-08-25 19:41:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_state`
--

CREATE TABLE `master_state` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_state`
--

INSERT INTO `master_state` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', 1, '2026-08-25 19:42:26', NULL),
(2, 'Arunachal Pradesh', 1, '2026-08-25 19:42:26', NULL),
(3, 'Assam', 1, '2026-08-25 19:42:26', NULL),
(4, 'Bihar', 1, '2026-08-25 19:42:26', NULL),
(5, 'Chhattisgarh', 1, '2026-08-25 19:42:26', NULL),
(6, 'Goa', 1, '2026-08-25 19:42:26', NULL),
(7, 'Gujarat', 1, '2026-08-25 19:42:26', NULL),
(8, 'Haryana', 1, '2026-08-25 19:42:26', NULL),
(9, 'Himachal Pradesh', 1, '2026-08-25 19:42:26', NULL),
(10, 'Jharkhand', 1, '2026-08-25 19:42:26', NULL),
(11, 'Karnataka', 1, '2026-08-25 19:42:26', NULL),
(12, 'Kerala', 1, '2026-08-25 19:42:26', NULL),
(13, 'Madhya Pradesh', 1, '2026-08-25 19:42:26', NULL),
(14, 'Maharashtra', 1, '2026-08-25 19:42:26', NULL),
(15, 'Manipur', 1, '2026-08-25 19:42:26', NULL),
(16, 'Meghalaya', 1, '2026-08-25 19:42:26', NULL),
(17, 'Mizoram', 1, '2026-08-25 19:42:26', NULL),
(18, 'Nagaland', 1, '2026-08-25 19:42:26', NULL),
(19, 'Odisha', 1, '2026-08-25 19:42:26', NULL),
(20, 'Punjab', 1, '2026-08-25 19:42:26', NULL),
(21, 'Rajasthan', 1, '2026-08-25 19:42:26', NULL),
(22, 'Sikkim', 1, '2026-08-25 19:42:26', NULL),
(23, 'Tamil Nadu', 1, '2026-08-25 19:42:26', NULL),
(24, 'Telangana', 1, '2026-08-25 19:42:26', NULL),
(25, 'Tripura', 1, '2026-08-25 19:42:26', NULL),
(26, 'Uttar Pradesh', 1, '2026-08-25 19:42:26', NULL),
(27, 'Uttarakhand', 1, '2026-08-25 19:42:26', NULL),
(28, 'West Bengal', 1, '2026-08-25 19:42:26', NULL),
(29, 'Andaman and Nicobar Islands', 1, '2026-08-25 19:42:26', NULL),
(30, 'Chandigarh', 1, '2026-08-25 19:42:26', NULL),
(31, 'Dadra and Nagar Haveli and Daman and Diu', 1, '2026-08-25 19:42:26', NULL),
(32, 'Delhi', 1, '2026-08-25 19:42:26', NULL),
(33, 'Jammu and Kashmir', 1, '2026-08-25 19:42:26', NULL),
(34, 'Ladakh', 1, '2026-08-25 19:42:26', NULL),
(35, 'Lakshadweep', 1, '2026-08-25 19:42:26', NULL),
(36, 'Puducherry', 1, '2026-08-25 19:42:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'Team Dashboard', 'team.dashboard', 'Access the team dashboard', 1, '2026-09-03 14:22:35', '2026-09-04 14:57:57'),
(2, 'Team Management', 'Manage Team Members', 'team.manage', 'Create, edit and manage team members', 1, '2026-09-03 14:22:35', NULL),
(3, 'Attendance Management', 'Attendance Management', 'attendance.manage', 'Manage attendance records', 1, '2026-09-03 14:22:35', '2026-09-03 14:39:01'),
(4, 'Salary Management', 'Salary Management', 'salary.manage', 'Manage salary records', 1, '2026-09-03 14:22:35', NULL),
(5, 'User Management', 'User Management', 'user.manage', 'Manage users and user types', 1, '2026-09-03 14:22:35', NULL),
(6, 'Permission Management', 'Permission Management', 'permission.manage', 'Manage permission definitions', 1, '2026-09-03 14:22:35', '2026-09-04 14:57:57'),
(7, 'Dashboard', 'HR Dashboard', 'hr.dashboard', 'Access the HR dashboard', 1, '2026-09-04 14:57:57', NULL),
(8, 'Dashboard', 'Account Dashboard', 'account.dashboard', 'Access the account dashboard', 1, '2026-09-04 14:57:57', NULL),
(9, 'Dashboard', 'SEO Dashboard', 'seo.dashboard', 'Access the SEO dashboard', 1, '2026-09-04 14:57:57', NULL),
(10, 'Team Management', 'View Team Members', 'team.view', 'View team members', 1, '2026-09-04 14:57:57', NULL),
(11, 'Team Management', 'Create Team Members', 'team.create', 'Create team members', 1, '2026-09-04 14:57:57', NULL),
(12, 'Team Management', 'Edit Team Members', 'team.edit', 'Edit team members', 1, '2026-09-04 14:57:57', NULL),
(13, 'Team Management', 'Remove Team Members', 'team.remove', 'Activate or deactivate team members', 1, '2026-09-04 14:57:57', NULL),
(14, 'SEO Management', 'SEO Pages', 'seo.pages.manage', 'Manage SEO pages', 1, '2026-09-04 14:57:57', NULL),
(15, 'User Management', 'View Users', 'user.view', 'View user access details', 1, '2026-09-04 14:57:57', NULL),
(16, 'User Management', 'Manage User Types', 'user-type.manage', 'Manage user types and default access', 1, '2026-09-04 14:57:57', NULL),
(17, 'Permission Management', 'Assign User Permissions', 'permission.assign', 'Manage add-on and revoked user access', 1, '2026-09-04 14:57:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ID` int(11) NOT NULL,
  `name` varchar(1200) NOT NULL,
  `project_type` varchar(1200) NOT NULL,
  `ProfilePic` varchar(1200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `link` varchar(1234) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ID`, `name`, `project_type`, `ProfilePic`, `status`, `link`) VALUES
(2, 'Name', 'Type', 'projects/project_151691_640173756742900.jpg', 0, 'http://techers.co.in'),
(3, 'The Kitchen Hotspot', 'Food Ordering Portal', 'projects/project_591383_640249513261000.jpg', 1, 'https://techers.co.in/');

-- --------------------------------------------------------

--
-- Table structure for table `techers_testimonial`
--

CREATE TABLE `techers_testimonial` (
  `ID` int(11) NOT NULL,
  `name` varchar(1200) NOT NULL,
  `type` varchar(1200) NOT NULL,
  `ProfilePic` varchar(1200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `content` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `techers_testimonial`
--

INSERT INTO `techers_testimonial` (`ID`, `name`, `type`, `ProfilePic`, `status`, `content`) VALUES
(2, 'Sanyam Jain', 'Happy Client', 'testimonials/testimonial-20260921160644-b7488738.png', 1, 'They are best in their work. And the rate is too cheap. Quality of work is superb. Always deliver the work on time. I must recommend everyone to take their services.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_unique_id` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `show_on_website` tinyint(4) NOT NULL DEFAULT 0,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `last_login_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_unique_id`, `name`, `email`, `mobile`, `password`, `user_type_id`, `profile_pic`, `post_id`, `show_on_website`, `address`, `city`, `state_id`, `country`, `instagram`, `facebook`, `linkedin`, `is_active`, `created_by`, `created_at`, `updated_at`, `is_deleted`, `last_login_at`, `updated_by`) VALUES
(3, 'USR-SEED-SUPER', 'Super Admin', 'superadmin@techers.local', '9000000001', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-04 14:57:57', '2026-09-22 21:55:23', 0, '2026-09-22 16:25:23', NULL),
(4, 'USR-SEED-TEAM', 'Team User', 'team@techers.local', '9000000002', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-04 14:57:57', '2026-09-06 08:53:49', 0, '2026-09-06 03:23:49', NULL),
(5, 'USR-SEED-HR', 'HR User', 'hr@techers.local', '9000000003', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-04 14:57:57', '2026-09-22 22:03:58', 0, '2026-09-22 16:33:58', NULL),
(6, 'USR-SEED-ACCOUNT', 'Account User', 'account@techers.local', '9000000004', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-04 14:57:57', '2026-09-22 22:04:30', 0, '2026-09-22 16:34:30', NULL),
(7, 'USR-SEED-SEO', 'SEO Manager', 'seo@techers.local', '9000000005', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 5, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-04 14:57:57', '2026-09-22 22:03:23', 0, '2026-09-22 16:33:23', NULL),
(8, 'USR-SEED-ACCOUNT2', 'Account User', 'account2@techers.local', '9000000024', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 4, NULL, 2, 0, 'sddddddddddddddd', '', 0, '', NULL, NULL, NULL, 1, NULL, '2026-09-04 14:57:57', '2026-09-22 22:05:49', 0, '2026-09-22 16:35:49', 3),
(9, 'USR-2609-1665B0', 'Hemant', 'hemant@techers.com', '8888888888', '$2y$10$.FdrLZT7II7s9ICf4qXQCuRr3VGFjGfNtVxfViie0GApp8hpBzAXq', 5, 'teams/team_992218_1823136481367300.png', 6, 1, '', '', 0, 'India', NULL, NULL, NULL, 1, 3, '2026-09-06 13:01:40', '2026-09-07 21:20:54', 0, '2026-09-07 15:50:54', NULL),
(10, 'USR-2609-4E4DB4', 'updated jjjj', 'dsfsd@sdsd.com', '8743978797', '$2y$10$ALaEgpqccLcQ1.Mu2ZrKuOwYwJZ1mdpKlh7nmTFX/UDkA0mIbdSha', 1, 'teams/team_534831_1825038680232300.png', 6, 1, 'addddd', 'ssssss', 26, 'India', 'https://www.instagram.com/acuravision_clinics?igsh=NGtuZmt2ZTE5Ymwz', 'https://www.facebook.com/share/1DHbeGGEgB/', 'https://www.linkedin.com/feed/', 0, 3, '2026-09-06 13:28:41', '2026-09-19 17:19:45', 0, '2026-09-19 11:49:45', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `access_type` enum('default','addon','revoked') NOT NULL DEFAULT 'addon',
  `activated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `permission_id`, `access_type`, `activated_at`, `expires_at`, `is_active`, `assigned_by`, `removed_at`, `removed_by`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 'addon', '2026-09-03 00:00:00', NULL, 0, 1, '2026-09-03 14:53:01', 1, '2026-09-03 14:52:52', '2026-09-03 14:53:01'),
(7, 6, 8, 'revoked', '2026-09-06 10:16:18', NULL, 1, 3, NULL, NULL, '2026-09-06 10:16:18', NULL),
(8, 6, 2, 'addon', '2026-09-06 00:00:00', NULL, 1, 3, NULL, NULL, '2026-09-06 10:17:31', NULL),
(9, 6, 11, 'addon', '2026-09-06 00:00:00', '2026-09-16 23:59:59', 0, 3, '2026-09-06 10:39:03', 3, '2026-09-06 10:18:56', '2026-09-06 10:39:03'),
(10, 6, 11, 'addon', '2026-09-06 00:00:00', NULL, 0, 3, '2026-09-06 10:34:19', 3, '2026-09-06 10:29:51', '2026-09-06 10:34:19'),
(11, 6, 11, 'revoked', '2026-09-06 10:39:09', NULL, 1, 3, NULL, NULL, '2026-09-06 10:39:09', NULL),
(12, 8, 2, 'addon', '2026-09-06 00:00:00', '2026-09-30 23:59:59', 1, 3, NULL, NULL, '2026-09-06 11:33:19', '2026-09-06 11:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Team', 'team', 'Default team user access', 1, '2026-09-03 14:22:35', '2026-09-04 14:57:56'),
(2, 'Super Admin', 'super-admin', 'Access to all pages', 1, '2026-09-04 14:57:56', NULL),
(3, 'HR', 'hr', 'Team and attendance access', 1, '2026-09-03 14:22:35', '2026-09-04 14:57:56'),
(4, 'Account', 'account', 'Salary access', 1, '2026-09-04 14:57:56', NULL),
(5, 'SEO Manager', 'seo-manager', 'SEO page access', 1, '2026-09-04 14:57:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type_permissions`
--

CREATE TABLE `user_type_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type_permissions`
--

INSERT INTO `user_type_permissions` (`id`, `user_type_id`, `permission_id`, `is_active`, `assigned_by`, `removed_at`, `removed_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, '2026-09-03 14:22:35', '2026-09-06 11:30:29'),
(3, 3, 3, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(4, 3, 7, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(5, 3, 11, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(6, 3, 12, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(7, 3, 13, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(8, 3, 10, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(10, 4, 8, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(11, 4, 4, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(13, 5, 9, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(14, 5, 14, 1, NULL, NULL, NULL, '2026-09-04 14:57:57', NULL),
(16, 1, 4, 1, NULL, NULL, NULL, '2026-09-06 11:30:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_page_tbl`
--
ALTER TABLE `master_page_tbl`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `master_post`
--
ALTER TABLE `master_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_master_post_name` (`name`);

--
-- Indexes for table `master_state`
--
ALTER TABLE `master_state`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_master_state_name` (`name`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `techers_testimonial`
--
ALTER TABLE `techers_testimonial`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_users_user_unique_id` (`user_unique_id`),
  ADD UNIQUE KEY `uk_users_email` (`email`),
  ADD UNIQUE KEY `uq_users_email` (`email`),
  ADD UNIQUE KEY `uq_users_mobile` (`mobile`),
  ADD KEY `idx_users_user_type_id` (`user_type_id`),
  ADD KEY `idx_users_post_id` (`post_id`),
  ADD KEY `idx_users_state_id` (`state_id`),
  ADD KEY `idx_users_created_by` (`created_by`),
  ADD KEY `idx_users_is_active` (`is_active`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_permissions_user` (`user_id`),
  ADD KEY `idx_user_permissions_permission` (`permission_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uq_user_types_slug` (`slug`);

--
-- Indexes for table `user_type_permissions`
--
ALTER TABLE `user_type_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_type_permission` (`user_type_id`,`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `master_page_tbl`
--
ALTER TABLE `master_page_tbl`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `master_post`
--
ALTER TABLE `master_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_state`
--
ALTER TABLE `master_state`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `techers_testimonial`
--
ALTER TABLE `techers_testimonial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_type_permissions`
--
ALTER TABLE `user_type_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

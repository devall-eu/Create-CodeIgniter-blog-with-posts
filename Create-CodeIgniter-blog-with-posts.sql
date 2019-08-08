-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `marks` mediumtext,
  `picture` varchar(128) DEFAULT NULL,
  `short_content` text NOT NULL,
  `content` longtext,
  `added` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` tinyint(4) NOT NULL DEFAULT '0',
  `pending` tinyint(4) NOT NULL DEFAULT '0',
  `public` tinyint(4) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `category_blog` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `full_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`,`user`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `blog_user_idx` (`user`) USING BTREE;

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `category_category_parent_idx` (`parent_id`);

ALTER TABLE `category_blog`
  ADD PRIMARY KEY (`id`,`category`,`blog`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `category_blog_category_idx` (`category`) USING BTREE,
  ADD KEY `category_blog_blog_idx` (`blog`) USING BTREE;

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `category_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `blog`
  ADD CONSTRAINT `post_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `category`
  ADD CONSTRAINT `category_category_parent` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `category_blog`
  ADD CONSTRAINT `category_post_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `category_post_post` FOREIGN KEY (`blog`) REFERENCES `blog` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
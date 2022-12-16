DROP DATABASE IF EXISTS `project`;
CREATE DATABASE  IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `project`;

-- create users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
    `id` int PRIMARY KEY AUTO_INCREMENT UNSIGNED,
    `username` varchar(120) CHARACTER SET utf8 NOT NULL,
    `email` varchar(120) CHARACTER SET utf8  NOT NULL,
    `password` varchar(255) CHARACTER SET utf8 NOT NULL,
    `permission` enum('user','admin') NOT NULL DEFAULT 'user',
    `verify_token` varchar(255) DEFAULT NULL,
    `is_active` tinyint(4) not NULL DEFAULT 0,
    `forgot_token` varchar(255) DEFAULT NULL,
    `forgot_token_expire` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;

-- create categories table
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`(
    `id` int PRIMARY KEY AUTO_INCREMENT UNSIGNED,
    `name` varchar(120) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;


-- create news table
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `news`(
    `id` int PRIMARY KEY NOT NULL UNSIGNED,
    `title` varchar(120) NOT NULL,
    `summary` text CHARACTER SET utf8 NOT NULL,
    `body` text  CHARACTER SET utf8  NOT NULL,
    `view` int NOT NULL DEFAULT 0,
    `user_id` int UNSIGNED NOT NULL,
    `cat_id` int UNSIGNED NOT NULL,
    `image` text CHARACTER SET utf8 NOT NULL,
    `status` enum('disable','enable') NOT NULL DEFAULT 'disable',
    `selected` tinyint(4) NOT NULL DEFAULT 0, -- 1=>select 2=>no select
    `breaking_news` tinyint(4) NOT NULL DEFAULT 0, -- 1=>no breaking news 2=>breaking news
    `published_at` datetime NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;



-- create comments table
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`(
    `id` int PRIMARY KEY AUTO_INCREMENT UNSIGNED,
    `user_id` int UNSIGNED NOT NULL,
    `post_id` int UNSIGNED NOT NULL,
    `comment` text CHARACTER SET utf8 NOT NULL,
    `status` enum('unseen','seen','approved') NOT NULL DEFAULT 'unseen',
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;

-- create banners table
DROP TABLE IF EXISTS `barnners`;
CREATE TABLE `banners`(
    `id` int PRIMARY KEY AUTO_INCREMENT UNSIGNED,
    `image` text CHARACTER SET utf8 NOT NULL,
    `url` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;

-- create menus table
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`(
    `menuId` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(120) CHARACTER SET utf8 COLLATE utf8-general-ci NOT NULL,
    `url` varchar(255) NOT NULL,
    `parent_id` int UNSIGNED DEFAULT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;

-- create websetting table
DROP TABLE IF EXISTS `websetting`;
CREATE TABLE `websetting`(
    `id` int PRIMARY KEY AUTO_INCREMENT UNSIGNED,
    `title` text CHARACTER SET utf8 DEFAULT NULL,
    `description` text CHARACTER SET utf8 DEFAULT NULL,
    `keywords` text CHARACTER SET utf8 DEFAULT NULL,
    `logo` text CHARACTER SET utf8 DEFAULT NUL,
    `icon`text CHARACTER SET utf8 DEFAULT NUL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL
)ENGINE=InnoDB;


-- indexes for users table
ALTER TABLE `users`
ADD UNIQUE KEY `email` (`email`);

-- indexes for news table
ALTER TABLE `news`
ADD KEY `cat_id` (`cat_id`),
ADD KEY `user_id` (`user_id`);

-- indexes for comments table
ALTER TABLE `comments`
ADD KEY `aricle_id` (`news_id`),
ADD KEY `user_id` (`user_id`);

-- indexes for menus table
ALTER TABLE `menus`
ADD KEY `parent_id` (`parent_id`);


-- constraints for news table
ALTER TABLE `news`
ADD CONSTRAINT `news_fk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `news_fk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;


-- constraints for comments table
ALTER TABLE `comments`
ADD CONSTRAINT `comments_fk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`newsId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_fk_2` FOREIGN KEY (`news_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- constraints for menus table
ALTER TABLE `menus`
ADD CONSTRAINT `menus_fk_1` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`menuId`) ON DELETE CASCADE ON UPDATE CASCADE;




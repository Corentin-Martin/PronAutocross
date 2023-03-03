-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `pronautocross`;
CREATE DATABASE `pronautocross` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pronautocross`;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `number` tinyint(3) NOT NULL,
  `vehicle` varchar(80) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `rate` decimal(22,0) DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `entry-list`;
CREATE TABLE `entry-list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `race_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `race_id` (`race_id`),
  KEY `category_id` (`category_id`),
  KEY `driver_id` (`driver_id`),
  CONSTRAINT `entry-list_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  CONSTRAINT `entry-list_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `entry-list_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `participation`;
CREATE TABLE `participation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maxi-sprint` int(10) unsigned NOT NULL,
  `tourisme-cup` int(10) unsigned NOT NULL,
  `sprint-girls` int(10) unsigned NOT NULL,
  `buggy-cup` int(10) unsigned NOT NULL,
  `junior-sprint` int(10) unsigned NOT NULL,
  `maxi-tourisme` int(10) unsigned NOT NULL,
  `buggy-1600` int(10) unsigned NOT NULL,
  `super-sprint` int(10) unsigned NOT NULL,
  `super-buggy` int(10) unsigned NOT NULL,
  `bonus1` char(3) NOT NULL,
  `bonus2` char(3) NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `verification_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maxi-sprint` (`maxi-sprint`),
  KEY `tourisme-cup` (`tourisme-cup`),
  KEY `sprint-girls` (`sprint-girls`),
  KEY `buggy-cup` (`buggy-cup`),
  KEY `junior-sprint` (`junior-sprint`),
  KEY `maxi-tourisme` (`maxi-tourisme`),
  KEY `buggy-1600` (`buggy-1600`),
  KEY `super-sprint` (`super-sprint`),
  KEY `super-buggy` (`super-buggy`),
  KEY `race_id` (`race_id`),
  KEY `player_id` (`player_id`),
  KEY `verification_id` (`verification_id`),
  CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`maxi-sprint`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_10` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  CONSTRAINT `participation_ibfk_11` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`),
  CONSTRAINT `participation_ibfk_12` FOREIGN KEY (`verification_id`) REFERENCES `verification` (`id`),
  CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`tourisme-cup`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_3` FOREIGN KEY (`sprint-girls`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_4` FOREIGN KEY (`buggy-cup`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_5` FOREIGN KEY (`junior-sprint`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_6` FOREIGN KEY (`maxi-tourisme`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_7` FOREIGN KEY (`buggy-1600`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_8` FOREIGN KEY (`super-sprint`) REFERENCES `driver` (`id`),
  CONSTRAINT `participation_ibfk_9` FOREIGN KEY (`super-buggy`) REFERENCES `driver` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `points` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maxi-sprint` varchar(255) NOT NULL,
  `tourisme-cup` varchar(255) NOT NULL,
  `sprint-girls` varchar(255) NOT NULL,
  `buggy-cup` varchar(255) NOT NULL,
  `junior-sprint` varchar(255) NOT NULL,
  `maxi-tourisme` varchar(255) NOT NULL,
  `buggy-1600` varchar(255) NOT NULL,
  `super-sprint` varchar(255) NOT NULL,
  `super-buggy` varchar(255) NOT NULL,
  `bonus1` varchar(255) NOT NULL,
  `bonus2` varchar(255) NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `race_id` (`race_id`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `race`;
CREATE TABLE `race` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `poster` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `score`;
CREATE TABLE `score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maxi-sprint` tinyint(2) NOT NULL DEFAULT 0,
  `tourisme-cup` tinyint(2) NOT NULL DEFAULT 0,
  `sprint-girls` tinyint(2) NOT NULL DEFAULT 0,
  `buggy-cup` tinyint(2) NOT NULL DEFAULT 0,
  `junior-sprint` tinyint(2) NOT NULL DEFAULT 0,
  `maxi-tourisme` tinyint(2) NOT NULL DEFAULT 0,
  `buggy-1600` tinyint(2) NOT NULL DEFAULT 0,
  `super-sprint` tinyint(2) NOT NULL DEFAULT 0,
  `super-buggy` tinyint(2) NOT NULL DEFAULT 0,
  `bonus1` tinyint(2) NOT NULL DEFAULT 0,
  `bonus2` tinyint(2) NOT NULL DEFAULT 0,
  `total` tinyint(3) NOT NULL DEFAULT 0,
  `race_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `participation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `race_id` (`race_id`),
  KEY `player_id` (`player_id`),
  KEY `participation_id` (`participation_id`),
  CONSTRAINT `score_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  CONSTRAINT `score_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`),
  CONSTRAINT `score_ibfk_3` FOREIGN KEY (`participation_id`) REFERENCES `participation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `verification`;
CREATE TABLE `verification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maxi-sprint` int(10) unsigned NOT NULL,
  `tourisme-cup` int(10) unsigned NOT NULL,
  `sprint-girls` int(10) unsigned NOT NULL,
  `buggy-cup` int(10) unsigned NOT NULL,
  `junior-sprint` int(10) unsigned NOT NULL,
  `maxi-tourisme` int(10) unsigned NOT NULL,
  `buggy-1600` int(10) unsigned NOT NULL,
  `super-sprint` int(10) unsigned NOT NULL,
  `super-buggy` int(10) unsigned NOT NULL,
  `bonus1` char(3) NOT NULL,
  `bonus2` char(3) NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `maxi-sprint` (`maxi-sprint`),
  KEY `tourisme-cup` (`tourisme-cup`),
  KEY `sprint-girls` (`sprint-girls`),
  KEY `buggy-cup` (`buggy-cup`),
  KEY `junior-sprint` (`junior-sprint`),
  KEY `maxi-tourisme` (`maxi-tourisme`),
  KEY `buggy-1600` (`buggy-1600`),
  KEY `super-sprint` (`super-sprint`),
  KEY `super-buggy` (`super-buggy`),
  KEY `race_id` (`race_id`),
  CONSTRAINT `verification_ibfk_1` FOREIGN KEY (`maxi-sprint`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_10` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  CONSTRAINT `verification_ibfk_2` FOREIGN KEY (`tourisme-cup`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_3` FOREIGN KEY (`sprint-girls`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_4` FOREIGN KEY (`buggy-cup`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_5` FOREIGN KEY (`junior-sprint`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_6` FOREIGN KEY (`maxi-tourisme`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_7` FOREIGN KEY (`buggy-1600`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_8` FOREIGN KEY (`super-sprint`) REFERENCES `driver` (`id`),
  CONSTRAINT `verification_ibfk_9` FOREIGN KEY (`super-buggy`) REFERENCES `driver` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2023-03-02 15:46:42
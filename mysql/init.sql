# init.sql
CREATE DATABASE IF NOT EXISTS restaurants;

USE restaurants;

CREATE TABLE `restaurant` (
	`id` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`cuisine` varchar(255) NOT NULL,
	`opening_hours` varchar(255) NOT NULL,
	`rating` varchar(255) NOT NULL,
	`location` varchar(255) NOT NULL,
	`description` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

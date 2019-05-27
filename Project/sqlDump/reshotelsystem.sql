# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.14-MariaDB)
# Database: reshotelsystem
# Generation Time: 2019-05-27 10:53:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table guests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guests`;

CREATE TABLE `guests` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `cellphone` varchar(20) NOT NULL,
  `home_address` text NOT NULL,
  `country` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table reservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `room_id` int(3) NOT NULL,
  `guest_id` int(3) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `amount_charged` decimal(7,0) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `adult_count` int(3) NOT NULL,
  `child_count` int(3) NOT NULL,
  `room_number` int(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `number_of_rooms` int(3) DEFAULT NULL,
  `price` decimal(6,0) NOT NULL,
  `adult_max_capacity` int(3) NOT NULL,
  `child_max_capacity` int(3) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;

INSERT INTO `rooms` (`id`, `name`, `description`, `number_of_rooms`, `price`, `adult_max_capacity`, `child_max_capacity`, `created_at`, `updated_at`)
VALUES
	(1,'Single Room','Bright, modern and contemporary, our standard rooms provide chic urban design in the heart of Thamel, Kathmandu. Whether you are in town for business, pleasure or a bit of both, these spacious rooms offer an ideal base for any visit to Nepal. Each room includes en-suite bathroom, LCD satellite equipped TV and in-room safe and is equipped with complimentary high speed Internet access, perfect for sending emails or uploading the days photos. With so much to do and see, Kathmandu really has got something for everyone to enjoy. Naturally many people enjoying many different things gives rise to many differing schedules. So whether you are a night owl or an early bird, we offer a 24-hour room service menu to ensure you never have to face anything on an empty stomach. \n\nStandard rooms come with for different types of beds, single beds, double / twin beds and king beds.\\n\\nStandard rooms include:\\n\\nFree Wi-Fi, En-suite bathroom/shower, LCD TV with satellite channels, In-room safe, Mineral water, 24 hour room service menu,&#39;, 3, &#39;600&#39;, 2, 1, &#39;2016-09-20 19:33:21&#39;, &#39;2',2,600,2,1,'2016-09-21 07:39:01','2016-09-21 07:39:01'),
	(2,'Deluxe Room','Bright, modern and contemporary, our deluxe rooms provide chic urban design in the heart of Thamel, Kathmandu. Whether youÃ¢â‚¬â„¢re in town for business, pleasure or a bit of both, these spacious rooms offer an ideal base for any visit to Nepal. Each room includes en-suite bathroom, LCD satellite equipped TV and in-room safe and is equipped with complimentary high speed Internet access, perfect for sending emails or uploading the days photos. With so much to do and see, Kathmandu really has got something for everyone to enjoy. Naturally many people enjoying many different things gives rise to many differing schedules. So whether youÃ¢â‚¬â„¢re a night owl or an early bird, we offer a 24-hour room service menu to ensure you never have to face anything on an empty stomach. \n\nDeluxe rooms come with for different types of beds, single beds, double / twin beds and king beds.\\n\\nStandard rooms include:\\n\\nFree Wi-Fi, En-suite bathroom/shower, LCD TV with satellite channels, In-room safe, Mineral water, 24 hour room service menu',3,1000,2,2,'2016-09-21 07:40:25','2016-09-21 07:40:25');

/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table uploads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `uploads`;

CREATE TABLE `uploads` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(3) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `size` varchar(80) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;

INSERT INTO `uploads` (`id`, `room_id`, `name`, `size`, `type`, `created_at`, `updated_at`)
VALUES
	(1,1,'RGH20-King-Twin-600x600.jpg','image/jpeg','58911','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(2,1,'standard.jpg','image/jpeg','82637','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(3,1,'standard1.jpg','image/jpeg','258207','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(4,1,'twins-room-Standard1.jpg','image/jpeg','18305','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(5,2,'asten-hotels-golden-key-room-deluxe-main.jpg','image/jpeg','104142','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(6,2,'deluxe.jpg','image/jpeg','261130','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(7,2,'deluxe1.jpg','image/jpeg','227480','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(8,2,'responsive-web-design-westminster-indigo-hotel-00040-deluxe-room.jpg','image/jpeg','67138','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(9,2,'vypis-asten-hotels-savoy-spindleruv-mlyn-pokoj-deluxe.jpg','image/jpeg','100240','2016-09-21 22:20:45','2016-09-21 22:20:45'),
	(10,2,'the-rooms-queen-deluxe.jpg','image/jpeg','147482','2016-09-21 22:20:45','2016-09-21 22:20:45');

/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `email` varchar(80) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`)
VALUES
	(1,'Solomon','sol@yahoo.com','$2y$10$JYG0nn7LLBQfABtcUBmOBe0wtnwkNQqb.7Z5/lGAhRbc69XHUdwW2','2016-09-21 22:20:45','2016-09-21 22:20:45');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

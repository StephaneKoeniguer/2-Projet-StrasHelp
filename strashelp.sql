# ************************************************************
# Sequel Ace SQL dump
# Version 20046
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.31)
# Database: strashelp
# Generation Time: 2023-05-04 19:48:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table association
# ------------------------------------------------------------

DROP TABLE IF EXISTS `association`;

CREATE TABLE `association` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `address` varchar(255) DEFAULT NULL,
  `dateCreate` date DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `credit` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `association_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `association` WRITE;
/*!40000 ALTER TABLE `association` DISABLE KEYS */;

INSERT INTO `association` (`id`, `name`, `description`, `address`, `dateCreate`, `phone`, `email`, `credit`, `user_id`, `password`, `type`)
VALUES
	(3,'John','hi','67800',NULL,'0607080905','c@g.c',NULL,NULL,'azerty1',0),
	(4,'John','hi','67800',NULL,'0607080905','c@g.c',NULL,NULL,'azerty3',0),
	(5,'Cedric','hgvjhbl','68270',NULL,'0908070605','h@j.i',NULL,NULL,'azerty7',0),
	(6,'Andressa','hgvjhbl','68270',NULL,'0908070605','h@j.i',NULL,NULL,'',0),
	(7,'Judith','hi','67210',NULL,'0809050403','h@l.m',NULL,NULL,'azertyui@',0),
	(8,'Judith','hi','67210',NULL,'0809050403','h@l.m',NULL,NULL,'azertyui@',0),
	(9,'Kais','Coucou','67800','2023-04-28','0675654534','kais@gmail.com',NULL,NULL,'kais@123',0),
	(10,'Kassim','Petit thé','67800','2023-04-20','0708060403','kassim@hello.fr',NULL,NULL,'Halouf67!!',0),
	(11,'Fouad','hi','1 B RUE DES VOSGES','2023-05-01','0678565815','liondor67@gmail.com',NULL,NULL,'azeryui',0),
	(12,'Fouad','hi','1 B RUE DES VOSGES','2023-05-02','0678565815','liondor67@gmail.com',NULL,NULL,'azertyqs2',0),
	(13,'yavuz','Hello','67000','2023-05-01','0509080706','yavuz@g.c',NULL,NULL,'yavuz123',0),
	(14,'John','hi','67800','2023-05-02','0809080908','c@f.g',NULL,NULL,'$2y$10$9.kVXNDZGDzZ472Qb4zpueDE1E34cTW3W6sP1xk5Q/0XfK6QTT4bO',0);

/*!40000 ALTER TABLE `association` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categorie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;

INSERT INTO `categorie` (`id`, `description`)
VALUES
	(1,'Bricolage'),
	(2,'Cuisine'),
	(3,'Informatique'),
	(4,'Education'),
	(5,'Sport');

/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table note
# ------------------------------------------------------------

DROP TABLE IF EXISTS `note`;

CREATE TABLE `note` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `date` date DEFAULT NULL,
  `note` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `offre_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `offre_id` (`offre_id`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;

INSERT INTO `note` (`id`, `date`, `note`, `user_id`, `offre_id`)
VALUES
	(53,'2023-05-03',1,2,1),
	(54,'2023-05-03',5,2,3),
	(55,'2023-05-03',5,1,2),
	(56,'2023-05-03',5,1,10),
	(57,'2023-05-04',4,2,6),
	(58,'2023-05-04',3,2,10),
	(59,'2023-05-04',3,1,4),
	(60,'2023-05-04',5,2,5),
	(61,'2023-05-04',4,2,8);

/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table offre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offre`;

CREATE TABLE `offre` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `availability` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `categorie_id` int NOT NULL,
  `phone` text,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `offre_ibfk_3` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `offre` WRITE;
/*!40000 ALTER TABLE `offre` DISABLE KEYS */;

INSERT INTO `offre` (`id`, `title`, `description`, `availability`, `area`, `user_id`, `categorie_id`, `phone`)
VALUES
	(1,'Dev','Cours de php pour les nuls','Semaine','Paris',1,3,''),
	(2,'Cours de cuisine','Tartiflette à volonté','Week-end','Strasbourg',2,2,''),
	(3,'Cours de langue','English for noob','Semaine','Nice',3,4,''),
	(4,'Yoga','Cours de yoga a domicile','Semaine','Strasbourg',4,5,NULL),
	(5,'Design','UI / UX','Semaine','Paris',5,3,NULL),
	(6,'Pétanque','Pétanque et pastis','Week-end','Nice',1,5,NULL),
	(7,'Plomberie','Plombier pas cher mais pas cher du tout','Week-end','Meinau',2,1,NULL),
	(8,'Menuiserie','lit sur mesure','Semaine','Neudorf',3,1,NULL),
	(9,'Ping-Pong','Cours sans raquette','Week-end','Strasbourg',4,5,NULL),
	(10,'Parachutisme','Attention à l\'attérissage','Semaine','Strasbourg',5,2,'');

/*!40000 ALTER TABLE `offre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table particulier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `particulier`;

CREATE TABLE `particulier` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `credit` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `particulier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `particulier` WRITE;
/*!40000 ALTER TABLE `particulier` DISABLE KEYS */;

INSERT INTO `particulier` (`id`, `name`, `description`, `phone`, `email`, `credit`, `user_id`, `password`, `address`, `type`)
VALUES
	(2,'Fouad','Hello','678565815','liondor67@gmail.com',NULL,NULL,'qwerty123@&','1 B RUE DES VOSGES',0),
	(3,'Sinkham','Beau gosse','607050403','d@f.g',NULL,NULL,'foufou1208','67300',0),
	(4,'Kheira','Good baby','102030405','kheira@coucou.hi',NULL,NULL,'Licorne67@','23 B rue des petits champs 67300 Schiltigheim',0),
	(5,'Khalil','J\'adore les sushis','703090601','khalil@foot.baby',NULL,NULL,'footix@&é123456','Chez moi',0),
	(6,'Stephane','hi','908090807','g@h.c',NULL,NULL,'azerty123456','67100',0),
	(7,'John','It\'s me','388280908','john@g.c',NULL,NULL,'coucou123','67600',0),
	(8,'John','It\'s me','388280908','john@g.c',NULL,NULL,'coucou123','67600',0);

/*!40000 ALTER TABLE `particulier` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `login`, `password`)
VALUES
	(1,'yavuz','d4e520d9130bddccba586603dd622562'),
	(2,'stephane','f7885ad36a637f4a1212716eb9cdcff2'),
	(3,'cedric','c4de7df1bafd6d9b8f5d35d4328c93b0'),
	(4,'andressa','29a5641eaa0c01abe5749608c8232806'),
	(5,'fouad','a8ecea6c4e7d71454687bbd4c13f6945');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

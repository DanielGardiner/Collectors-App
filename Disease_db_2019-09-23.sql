# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.27)
# Database: Disease_db
# Generation Time: 2019-09-23 16:01:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table disease_table
# ------------------------------------------------------------

CREATE TABLE `disease_table` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Organism` varchar(255) NOT NULL DEFAULT '',
  `Incubation_usual` varchar(255) DEFAULT NULL,
  `Incubation_range` varchar(255) DEFAULT NULL,
  `Symptoms` varchar(255) DEFAULT '',
  `Severity` varchar(255) DEFAULT '',
  `Avg_annual_incidence` int(11) DEFAULT NULL,
  `Img_location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `disease_table` WRITE;
/*!40000 ALTER TABLE `disease_table` DISABLE KEYS */;

INSERT INTO `disease_table` (`id`, `Organism`, `Incubation_usual`, `Incubation_range`, `Symptoms`, `Severity`, `Avg_annual_incidence`, `Img_location`)
VALUES
	(1,'Campylobacter','2-5 days','1 - 10 days','Diarrhoea often with blood, abdominal pain with or without fever','Usually lasts 2-7 days',47600,'figures/img_campylobacter.jpg'),
	(2,'Rotavirus','1-3 days','1 - 3 days','Watery diarrhoea, fever, vomiting with or without respiratory symptoms','Usually lasts a few days, but occasionally severe',15800,'figures/img_rotavirus.jpg'),
	(3,'Salmonella','12 - 36 hours','6 - 72 hours','Diarrhoea often with feverm may be myalgia, abdominal pain, headache','Can be severe, lasts several days to 3 weeks',15100,'figures/img_Salmonella.jpg'),
	(4,'Cryptosporidium','6 - 13 days','1 - 28 days','Diarrhoea, bloating and abdominal pain common','Self-limiting but lasts up to 4 weeks',4270,'figures/img_cryptosporidium.jpg'),
	(5,'E. coli O157','3 - 4 days','1 - 9 days','Diarrhoea, blood not uncommon','Variable, may be very severe, e.g. hemolytic uremic syndrome (HUS)\n',680,'figures/img_ecolio157.jpg');

/*!40000 ALTER TABLE `disease_table` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

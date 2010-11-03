-- MySQL dump 10.11
--
-- Host: localhost    Database: incroatia
-- ------------------------------------------------------
-- Server version	5.0.75-0ubuntu10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `_languages`
--

DROP TABLE IF EXISTS `_languages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `_languages` (
  `id` int(11) NOT NULL auto_increment,
  `link` varchar(7) collate utf8_slovenian_ci NOT NULL,
  `name` varchar(255) collate utf8_slovenian_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `_languages`
--

LOCK TABLES `_languages` WRITE;
/*!40000 ALTER TABLE `_languages` DISABLE KEYS */;
INSERT INTO `_languages` VALUES (1,'en','English');
/*!40000 ALTER TABLE `_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_users`
--

DROP TABLE IF EXISTS `_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) collate utf8_slovenian_ci NOT NULL,
  `password` varchar(100) collate utf8_slovenian_ci NOT NULL,
  `key` varchar(100) collate utf8_slovenian_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `_users`
--

LOCK TABLES `_users` WRITE;
/*!40000 ALTER TABLE `_users` DISABLE KEYS */;
INSERT INTO `_users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','26a8dfc99c97a720ebc608bd0542773a'),(2,'tpiha','21232f297a57a5a743894a0e4a801fc3','25446f65028e1f611cd06f88de2db4b9'),(3,'test','21232f297a57a5a743894a0e4a801fc3','655e3224e0fb3639a4287768770aad95');
/*!40000 ALTER TABLE `_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_categories`
--

DROP TABLE IF EXISTS `en_categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `en_categories` (
  `id` int(8) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_slovenian_ci NOT NULL,
  `link` varchar(100) collate utf8_slovenian_ci NOT NULL,
  `url` varchar(250) collate utf8_slovenian_ci NOT NULL,
  `published` tinyint(4) NOT NULL default '1',
  `orderid` smallint(6) NOT NULL default '0',
  `parentid` int(8) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_categories`
--

LOCK TABLES `en_categories` WRITE;
/*!40000 ALTER TABLE `en_categories` DISABLE KEYS */;
INSERT INTO `en_categories` VALUES (1,'Main menu','mainmenu','',1,0,0),(2,'Submenu','submenu','',1,1,0),(3,'Submenu 1','submenu1','',1,2,0),(4,'In Croatia','home','',1,0,1),(12,'About','about','',1,0,3),(13,'Archive','archive','',0,1,3),(14,'Contact','contact','',1,2,3),(15,'Sitemap','sitemap','',1,3,3),(16,'Hotels','hotels','',1,2,1),(17,'Apartments','apartments','',1,3,1),(18,'Villas','villas','',1,4,1),(19,'Submenu 2','submenu2','',1,3,0),(20,'Dubrovnik','dubrovnik','',1,0,26),(21,'Other','other','',1,6,0),(22,'Dubrovnic','dubrovnic','',1,0,21),(23,'Boxes','boxes','',0,7,0),(24,'Advertising','advertising','',0,0,23),(25,'Quote','quote','',0,1,23),(26,'Galleries','galleries','',1,1,2),(27,'Motovun','motovun','',1,2,26),(28,'Split','split','',1,3,26),(29,'Trogir','trogir','',1,4,26),(30,'Zadar','zadar','',1,1,26),(31,'Submenu 3','submenu3','',1,4,0),(32,'Submenu 4','submenu4','',1,5,0),(33,'Lorem ipsum dolor sit amet, consectetuer','lorem1','http://www.incroatia.org/',1,0,31),(34,'Lorem ipsum dolor sit amet, consectetuer','lorem2','http://www.incroatia.org/',1,0,32);
/*!40000 ALTER TABLE `en_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_comments`
--

DROP TABLE IF EXISTS `en_comments`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `en_comments` (
  `id` int(11) NOT NULL auto_increment,
  `module` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `module_item` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `name` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `body` text collate utf8_slovenian_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_comments`
--

LOCK TABLES `en_comments` WRITE;
/*!40000 ALTER TABLE `en_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `en_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_content`
--

DROP TABLE IF EXISTS `en_content`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `en_content` (
  `id` int(11) NOT NULL auto_increment,
  `link` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `name` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `body` longtext collate utf8_slovenian_ci NOT NULL,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `time` datetime NOT NULL,
  `time_published` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `description` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `keywords` varchar(255) collate utf8_slovenian_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_content`
--

LOCK TABLES `en_content` WRITE;
/*!40000 ALTER TABLE `en_content` DISABLE KEYS */;
INSERT INTO `en_content` VALUES (1,'home','Croatian travel and vacations portal','       <p><strong>In Croatia</strong> is Croatian portal for foreign travelers, guests in our country. Welcome!</p><p>Croatia is a Central European country at the crossroads of Pannonian Plain, Southeast Europe, and the Mediterranean Sea. Its southern and western flanks border the Adriatic Sea.</p><p>Tourism is very important part of Croatian economy and Croatia is one of most important tourist centers on Mediterranean. Beautiful sea and coast, mysterious old cities, a lot of untouched nature, gorgeous women, really nice people and much, much more definitely won\'t leave anybody unsatisfied.<br /></p>       ','2009-06-08 18:23:59','2009-03-03 12:15:00','0000-00-00 00:00:00',0,'',''),(6,'about','About','          <p><span style=\"font-weight: bold;\">In Croatia</span> is Croatian informational portal in English for foreign tourists interested in our beautiful country.<br /></p><p>Our mission is to inform you (tourist) about Croatia no matter what type of interest you might have. We will do our best to cover as much themes as we can. Content will consist of pictures, videos and texts categorized by type and city.<br /></p><p>Our goals:</p><ul style=\"float: left; left: 30px; position: relative; font-weight: bold;\"><li>photos</li><li>videos</li><li>texts</li><li>cities</li><li>beaches</li><li>night life</li><li>education</li></ul>             ','2009-07-28 02:54:47','0000-00-00 00:00:00','2009-04-20 05:03:21',1,'',''),(7,'hotels','Hotels','<p><span style=\"font-weight: bold;\">Hotels Croatia</span> is under construction.</p>  ','2009-04-20 23:19:06','1970-01-01 12:00:00','2009-04-21 01:19:06',1,'',''),(8,'apartments','Apartments','<p><span style=\"font-weight: bold;\">Apartments Croatia</span> is under construction.</p>  ','2009-04-20 23:20:24','1970-01-01 12:00:00','2009-04-21 01:20:24',1,'',''),(9,'villas','Villas','<p><span style=\"font-weight: bold;\">Villas Croatia</span> is under construction.</p>  ','2009-04-20 23:21:25','1970-01-01 12:00:00','2009-04-21 01:21:25',1,'',''),(10,'dubrovnik','Dubrovnik','              <p><span style=\"font-weight: bold;\">Dubrovnik Croatia</span> is under construction.   </p> ','2009-04-29 02:48:03','2009-04-21 01:00:00','2009-04-21 04:20:45',1,'',''),(11,'dubrovnic','Dubrovnic / Dubrovnik','                <p><span style=\"font-weight: bold;\">Dubrovnic</span> is common mistake in typing name of Croatian city Dubrovnik, but we have the right section for you - <a href=\"http://travel.incroatia.org/dubrovnik/\">Dubrovnik</a>.  </p>                ','2009-05-18 21:34:27','2009-05-18 12:00:00','2009-05-18 23:06:39',1,'',''),(12,'advertising','Advertising','<div id=\"ad\"><p>Advertising</p></div><div id=\"shortnews\"><div class=\"news\"><h3><a href=\"http://www.incroatia.org/\">In Croatia is under construction.</a></h3><p>Please visit us later or contact us through contact form (in footer).</p></div><h3><a href=\"http://www.incroatia.org/\">This is a place for an ad</a></h3><p>Aliquam lacus massa, pellentesque sit amet, feugiat et, cursus volutpat, massa. Integer nibh. Maecenas mattis ipsum a felis.</p></div>','2009-07-27 23:14:41','2009-07-28 12:00:00','2009-07-28 01:10:14',1,'',''),(13,'quote','Quote','<p>Greetings from the beauty and sunshine of Dubrovnik, the \"jewel of the Dalmatian coast\". There\'s no doubt that this is one of the most beautiful places I\'ve seen in my life. Especially the Old Town, which was preserved and restored through the fighting and siege of the early nineties and stretches out with a sea of pink roofs over the brilliant blue water. <strong>(Canadian tourist)</strong></p>','2009-07-27 23:15:46','2009-07-28 12:00:00','2009-07-28 01:15:46',1,'','');
/*!40000 ALTER TABLE `en_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_galleries`
--

DROP TABLE IF EXISTS `en_galleries`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `en_galleries` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `link` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `description` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `keywords` varchar(255) collate utf8_slovenian_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_galleries`
--

LOCK TABLES `en_galleries` WRITE;
/*!40000 ALTER TABLE `en_galleries` DISABLE KEYS */;
INSERT INTO `en_galleries` VALUES (10,'Dubrovnik','dubrovnik','fsda',''),(11,'Motovun','motovun','Photo galleries of Motovun',''),(12,'Split','split','Photo gallery of Split',''),(13,'Trogir','trogir','Photo gallery of Trogir',''),(14,'Zadar','zadar','Photo gallery of Zadar','');
/*!40000 ALTER TABLE `en_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_images`
--

DROP TABLE IF EXISTS `en_images`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `en_images` (
  `id` int(11) NOT NULL auto_increment,
  `gallery_id` int(11) NOT NULL,
  `name` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `link` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `description` text collate utf8_slovenian_ci NOT NULL,
  `orderid` int(11) NOT NULL,
  `meta_description` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `meta_keywords` varchar(255) collate utf8_slovenian_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_images`
--

LOCK TABLES `en_images` WRITE;
/*!40000 ALTER TABLE `en_images` DISABLE KEYS */;
INSERT INTO `en_images` VALUES (6,10,'Slika1','slika1','',0,'',''),(7,10,'Photo 2','photo2','',1,'',''),(8,10,'Photo 3','photo3','',2,'',''),(10,10,'Photo 4','photo4','',3,'',''),(12,10,'Photo 5','photo5','',4,'',''),(13,10,'Photo 6','photo6','',5,'',''),(14,10,'Photo 7','photo7','',6,'',''),(15,10,'Photo 8','photo8','',7,'',''),(16,11,'Motovun 1','motovun1','',0,'',''),(17,11,'Motovun 2','motovun2','',1,'',''),(18,11,'Motovun 3','motovun3','',2,'',''),(19,11,'Motovun 4','motovun4','',3,'',''),(20,11,'Motovun 5','motovun5','',4,'',''),(21,11,'Motovun 6','motovun6','',5,'',''),(22,12,'Split 1','split1','',0,'',''),(23,12,'Split 2','split2','',1,'',''),(24,12,'Split 3','split3','',2,'',''),(25,13,'Trogir 1','trogir1','',0,'',''),(26,13,'Trogir 2','trogir2','',1,'',''),(27,14,'Zadar 1','zadar1','',0,'',''),(28,14,'Zadar 2','zadar2','',1,'',''),(29,14,'Zadar 3','zadar3','',2,'',''),(30,14,'Zadar 4','zadar4','',3,'',''),(31,14,'Zadar 5','zadar5','',4,'',''),(32,14,'Zadar 6','zadar6','',5,'',''),(33,14,'Zadar 7','zadar7','',6,'',''),(34,14,'Zadar 8','zadar8','',7,'',''),(35,14,'Zadar 9','zadar9','',8,'',''),(36,14,'Zadar 10','zadar10','',9,'',''),(37,14,'Zadar 11','zadar11','',10,'',''),(38,14,'Zadar 12','zadar12','',11,'',''),(39,14,'Zadar 13','zadar13','',12,'',''),(40,14,'Zadar 14','zadar14','',13,'',''),(41,14,'Zadar 15','zadar15','',14,'','');
/*!40000 ALTER TABLE `en_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_settings`
--

DROP TABLE IF EXISTS `en_settings`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `en_settings` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `value` varchar(255) collate utf8_slovenian_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_settings`
--

LOCK TABLES `en_settings` WRITE;
/*!40000 ALTER TABLE `en_settings` DISABLE KEYS */;
INSERT INTO `en_settings` VALUES (1,'tools','0'),(2,'caching','0'),(3,'title','In Croatia'),(4,'keywords','in, croatia, travel, tourism, hotels, apartments, vacations, holidays'),(5,'description','In Croatia is Croatian portal for foreign travelers dedicated to vacations and holidays in Croatia'),(6,'admin_title','In Croatia - admin panel'),(7,'default_uri','home'),(8,'contact_mail','info@incroatia.org'),(9,'contact_subject','In Croatia contact form'),(10,'default_time','1240277194');
/*!40000 ALTER TABLE `en_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-08-04 23:53:11

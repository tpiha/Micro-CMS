-- MySQL dump 10.11
--
-- Host: localhost    Database: test
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `_users`
--

LOCK TABLES `_users` WRITE;
/*!40000 ALTER TABLE `_users` DISABLE KEYS */;
INSERT INTO `_users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','6c31e8f71dc14fe5a9b37d328e321756');
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
  `description` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `keywords` varchar(255) collate utf8_slovenian_ci NOT NULL,
  `published` tinyint(4) NOT NULL default '1',
  `orderid` smallint(6) NOT NULL default '0',
  `parentid` int(8) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_categories`
--

LOCK TABLES `en_categories` WRITE;
/*!40000 ALTER TABLE `en_categories` DISABLE KEYS */;
INSERT INTO `en_categories` VALUES (1,'Main menu','main-menu','','','',1,0,0),(2,'Submenu','submenu','','','',1,1,0),(3,'Home','home','','Micro CMS / Welcome to 1.0 beta 1','welcome, to, 1.0, beta, 1',1,0,1),(4,'Archive','archive','','','',1,2,1),(5,'Archived page 1','archived-page-1','','Archived page 1','archived, page, 1',1,0,4),(6,'Contact','contact','','','',1,3,1),(7,'Sitemap','sitemap','','','',1,4,1),(8,'Test page 1','test-page-1','','Test page 1','test, page, 1',1,0,2),(9,'Test page 2','test-page-2','','Test page 2','test, page, 2',1,1,2),(10,'Test page 3','test-page-3','','Test page 3','test, page, 3',1,2,2),(13,'Galleries','galleries','','Galleries','galleries',1,1,1),(15,'Test gallery 1','test-gallery-1','','Test gallery 1','test, gallery, 1',1,0,13);
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
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
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_content`
--

LOCK TABLES `en_content` WRITE;
/*!40000 ALTER TABLE `en_content` DISABLE KEYS */;
INSERT INTO `en_content` VALUES (1,'home','Welcome to 1.0 beta 1','           <p>Welcome to Micro CMS homepage!</p><p>Micro CMS is small and friendly, but also modern CMS and MVC framework written in PHP. It\'s main task is easier PHP web pages and applications development with no compromise in simplicity, performance, SEO and features. It\'s free, licensed under LGPL license and ready for mobile platforms.<br /></p><p>If this is your first contact with Micro CMS, check out our <a href=\"http://microcms.kset.org/dokuwiki/\" target=\"_blank\">wiki</a> page or dynamically generated library <a href=\"http://microcms.kset.org/documentation/docs/\">reference</a>.</p><p>If you want to try it, please do so <a href=\"admin/\">here</a>. Default username and password are both \'<span style=\"font-weight: bold;\">admin</span>\'.</p>           ','2009-07-27 17:59:16','2009-03-03 12:15:00','0000-00-00 00:00:00',0),(2,'archived-page-1','Archived page 1',' <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>','2009-03-06 02:36:53','2009-04-03 09:00:00','2009-03-06 03:34:12',1),(3,'test-page-1','Test page 1','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<br /></p>  ','2009-03-06 02:37:03','2009-06-03 09:00:00','2009-03-06 03:32:06',1),(4,'test-page-2','Test page 2',' <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<br /></p>   ','2009-03-06 02:37:08','2009-06-03 09:00:00','2009-03-06 03:33:01',1),(5,'test-page-3','Test page 3',' <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>','2009-03-06 02:37:13','2009-06-03 09:00:00','2009-03-06 03:33:26',1);
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
  `description` text collate utf8_slovenian_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_galleries`
--

LOCK TABLES `en_galleries` WRITE;
/*!40000 ALTER TABLE `en_galleries` DISABLE KEYS */;
INSERT INTO `en_galleries` VALUES (8,'Test gallery 1','test-gallery-1','');
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
  PRIMARY KEY  (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_images`
--

LOCK TABLES `en_images` WRITE;
/*!40000 ALTER TABLE `en_images` DISABLE KEYS */;
INSERT INTO `en_images` VALUES (1,8,'African family','african-family','',0,'',''),(2,8,'Micro CMS','micro-cms','',1,'','');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `en_settings`
--

LOCK TABLES `en_settings` WRITE;
/*!40000 ALTER TABLE `en_settings` DISABLE KEYS */;
INSERT INTO `en_settings` VALUES (1,'tools','1'),(2,'caching','0'),(3,'title','Micro CMS'),(4,'keywords','micro, cms, lightweight, mobile, open, source, free'),(5,'description','Free lightweight CMS ready for mobile platforms'),(6,'admin_title','Micro CMS - admin panel'),(7,'default_uri','home'),(8,'contact_mail','example@example.com'),(9,'contact_subject','Micro CMS contact form');
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

-- Dump completed on 2009-07-27 18:09:22

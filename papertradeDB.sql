-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: c9
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolios` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `portfolio_name` varchar(255) NOT NULL,
  `portfolio_description` text NOT NULL,
  `current_cap` decimal(65,0) DEFAULT NULL,
  `beginning_cap` decimal(65,0) DEFAULT NULL,
  `last_trade` int(11) DEFAULT NULL,
  `starting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `commision_bool` tinyint(1) NOT NULL DEFAULT '0',
  `commision` decimal(65,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,'34534534','345345',-13225061,54555,24,'2016-02-11 12:03:22',0,0,0),(10,'asdfasdf','34543534rtfrsd',5,5,NULL,'2016-02-10 18:18:59',1,0,0),(11,';ksdjf',';lkjdf;kj',1343254,1343254,NULL,'2016-02-11 01:26:38',0,0,0),(17,'56','4564545',6456456456,6456456456,NULL,'2016-03-12 04:32:08',2,0,0),(18,'test commish','l;kj',100,100,33,'2016-03-16 19:01:14',1,1,10);
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (3,'asdf','asdfasdf'),(4,'asdf','asdfasdf'),(5,'Another TEST','fuck you flsdkjaflksjdgk;jasdkjgsdfnglksjdflsdfasdf'),(6,'Post Title','asdfasdfasdf'),(9,'Post Title',''),(10,'Post Title',''),(11,'Post Title',''),(12,'Post Title','asdfasdf');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trades`
--

DROP TABLE IF EXISTS `trades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trades` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `symbol` varchar(10) DEFAULT NULL,
  `purchase_time` datetime NOT NULL,
  `purchase_price` float DEFAULT NULL,
  `shares` int(10) NOT NULL,
  `sale_time` datetime DEFAULT NULL,
  `sale_price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `portfolio_id` (`portfolio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trades`
--

LOCK TABLES `trades` WRITE;
/*!40000 ALTER TABLE `trades` DISABLE KEYS */;
INSERT INTO `trades` VALUES (1,1,1,'AAPL','2016-02-01 09:35:59',234,234,'2016-02-18 12:14:28',98),(3,1,1,'AAPL','2016-02-01 09:35:59',234,234,'2016-02-18 12:14:31',98),(7,0,1,'GE','2016-02-14 14:03:53',28,2,'2016-02-16 17:24:27',29),(8,0,1,'TSLA','2016-02-16 13:59:51',151,6,'2016-02-19 12:08:45',167),(9,0,1,'LUV','2016-02-16 14:10:04',36,234,'2016-03-01 17:23:08',42.74),(10,0,1,'UWTI','2016-02-19 03:40:54',2,1000,'2016-03-01 17:23:11',1.89),(11,0,1,'TSLA','2016-02-19 03:41:21',167,1000,'2016-02-19 03:50:20',167),(12,0,1,'AAPL','2016-02-19 03:41:52',96,100000,'2016-02-19 12:08:48',96),(13,0,1,'GE','2016-02-19 03:45:52',29,54364,'2016-02-19 03:50:09',29),(14,0,1,'GE','2016-02-19 03:47:42',29,54364,'2016-02-19 03:49:47',29),(15,0,1,'GE','2016-02-19 03:48:11',29,1234,'2016-02-19 03:48:41',29),(16,0,1,'GE','2016-02-19 03:48:24',29,1234,'2016-02-19 03:48:39',29),(17,0,12,'GE','2016-02-26 16:01:21',30,20,NULL,NULL),(18,0,12,'GE','2016-02-26 16:01:45',30,100,NULL,NULL),(19,0,12,'GE','2016-02-26 16:24:12',29.48,345,'2016-02-26 16:24:40',29.48),(20,0,12,'AAPL','2016-02-26 16:24:26',97.64,45,'2016-02-26 16:24:38',97.64),(21,0,12,'GE','2016-02-26 18:10:06',29.54,546,NULL,NULL),(22,0,1,'AAPL','2016-03-13 13:26:46',102.26,456,NULL,NULL),(23,0,1,'AAPL','2016-03-13 13:27:51',102.26,65,NULL,NULL),(24,0,1,'GE','2016-03-13 13:28:01',30.34,324234,NULL,NULL),(25,1,18,'GE','2016-03-16 16:21:40',30.155,1,'2016-03-16 16:21:52',30.1535),(26,1,18,'GE','2016-03-16 16:26:37',30.155,1,'2016-03-16 16:26:47',30.16),(27,1,18,'GE','2016-03-16 16:27:36',30.16,1,'2016-03-16 16:27:44',30.16),(28,1,18,'GE','2016-03-16 16:28:53',30.1475,1,'2016-03-16 16:29:05',30.1475),(29,1,18,'GE','2016-03-16 16:29:47',30.13,1,'2016-03-16 16:30:13',30.13),(30,1,18,'GE','2016-03-16 16:30:26',30.148,1,'2016-03-16 16:30:46',30.148),(31,1,18,'GE','2016-03-16 16:32:58',30.1432,1,'2016-03-16 16:33:54',30.1432),(32,1,18,'GE','2016-03-16 16:34:11',30.15,1,'2016-03-16 16:36:10',30.155),(33,1,18,'GE','2016-03-16 16:37:02',30.14,1,'2016-03-16 16:37:13',30.14);
/*!40000 ALTER TABLE `trades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,'coawole2pDWZzxK32jMYee',1268889823,1458162011,1,'Admin','istrator','ADMIN','0'),(2,'10.240.0.189',NULL,'$2y$08$OsGxIzPr.yZh1WkaSLhhyOuv/UrxcZCJDdXGSdFbVotMS6Q7R.hai',NULL,'info@radical-design.us',NULL,NULL,NULL,NULL,1454416892,NULL,1,'Chris','Uberti','lkj','234325235');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(2,1,2),(3,2,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-19 11:53:30

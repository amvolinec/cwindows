-- MySQL dump 10.13  Distrib 8.0.19, for osx10.15 (x86_64)
--
-- Host: localhost    Database: axure
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,1,8,NULL,'manager_id','Manager',1,NULL,1,1,'{\"belongsTo\": \"App\\\\User\", \"fieldName\":\"managers\", \"fieldToShow\": \"name\"}','2020-09-21 14:02:54','2020-09-21 14:47:21'),(2,1,1,NULL,'delivery_address','Delivery Address',1,'\'\'',1,1,'','2020-09-21 14:02:54','2020-09-21 17:51:13'),(3,1,6,NULL,'version','Version',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(4,1,8,NULL,'profile_id','Profile',1,NULL,1,1,'{\"belongsTo\": \"App\\\\Profile\", \"fieldName\":\"profiles\", \"fieldToShow\": \"name\"}','2020-09-21 14:02:54','2020-09-21 14:48:49'),(5,1,1,NULL,'materials','Materials',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 15:23:11'),(6,1,1,NULL,'colors','Colors',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 15:23:11'),(7,1,1,NULL,'squaring','Squaring',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 17:50:28'),(8,1,13,NULL,'meters','Meters',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(10,1,13,NULL,'total_with_vat','Total With VAT',1,NULL,1,1,'{\"parameters\": \"11,2\"}','2020-09-21 14:02:54','2020-09-21 17:50:28'),(11,1,13,NULL,'cost','Cost',1,NULL,1,1,'{\"parameters\": \"11,2\"}','2020-09-21 14:02:54','2020-09-21 17:50:28'),(12,1,13,NULL,'expenses','Expenses',1,NULL,1,1,'{\"parameters\": \"11,2\"}','2020-09-21 14:02:54','2020-09-21 17:50:28'),(14,1,5,NULL,'comments','Comments',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(15,1,6,NULL,'state','State',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(16,1,8,NULL,'offer_id','Offer',1,NULL,1,1,'{\"belongsTo\": \"App\\\\Offer\", \"fieldName\":\"offers\", \"fieldToShow\": \"title\"}','2020-09-21 14:56:38','2020-09-21 14:57:14'),(17,1,13,NULL,'total','Total',1,NULL,1,1,'{\"parameters\": \"11,2\"}','2020-09-21 16:43:40','2020-09-21 17:50:39'),(18,2,1,NULL,'name','Name',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(19,2,1,NULL,'code','Code',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(20,2,1,NULL,'vat_code','Vat Code',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:55'),(21,2,1,NULL,'address','Address',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(22,2,1,NULL,'phone','Phone',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(23,2,1,NULL,'account','Account',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(24,2,1,NULL,'email','Email',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(25,2,1,NULL,'web','Web',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 05:13:12'),(26,2,1,NULL,'file_name','Logo Name',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 07:24:32'),(27,2,20,NULL,'file_uri','Logo',1,NULL,1,1,'','2020-10-06 05:13:12','2020-10-06 07:24:32'),(28,3,1,NULL,'country','Country',1,NULL,1,1,'','2020-10-06 07:12:48','2020-10-06 07:12:48'),(29,3,1,NULL,'currency','Currency',1,NULL,1,1,'','2020-10-06 07:12:48','2020-10-06 07:12:48'),(30,3,1,NULL,'code','Code',1,NULL,1,1,'','2020-10-06 07:12:48','2020-10-06 07:12:48'),(31,3,1,NULL,'symbol','Symbol',1,NULL,1,1,'','2020-10-06 07:12:48','2020-10-06 07:12:48'),(32,2,8,NULL,'currency_id','Currency',1,NULL,1,1,'{\"belongsTo\": \"App\\\\Currency\", \"fieldName\":\"currency\", \"fieldToShow\": \"currency\"}','2020-10-06 07:24:32','2020-10-06 07:31:36');
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'tenders',NULL,'tender','Tender',1,1,1,1,0,'2020-09-21 14:02:54','2020-09-21 14:57:37'),(2,'settings',NULL,'setting','Setting',0,0,0,1,0,'2020-10-06 05:13:12','2020-10-06 10:55:25'),(3,'currencies',NULL,'currency','Currency',1,1,1,1,0,'2020-10-06 07:12:48','2020-10-06 07:12:48');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'axure'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-06 16:55:52

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
-- Dumping data for table `relations`
--

LOCK TABLES `relations` WRITE;
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `table_files`
--

LOCK TABLES `table_files` WRITE;
/*!40000 ALTER TABLE `table_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,1,8,NULL,'manager_id','Manager',1,NULL,1,1,'{\"belongsTo\": \"App\\\\User\", \"fieldName\":\"users\", \"fieldToShow\": \"name\"}','2020-09-21 14:02:54','2020-09-21 14:04:04'),(2,1,1,NULL,'address','Address',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(3,1,6,NULL,'version','Version',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(4,1,8,NULL,'profile_id','Profile',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(5,1,1,NULL,'wood','Wood',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(6,1,1,NULL,'color','Color',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(7,1,13,NULL,'area','Area',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(8,1,13,NULL,'meters','Meters',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(10,1,13,NULL,'total','Total',1,NULL,1,1,'{\"parameters\": \"8,2\"}','2020-09-21 14:02:54','2020-09-21 14:04:04'),(11,1,13,NULL,'cost','Cost',1,NULL,1,1,'{\"parameters\": \"8,2\"}','2020-09-21 14:02:54','2020-09-21 14:04:04'),(12,1,13,NULL,'expenses','Expenses',1,NULL,1,1,'{\"parameters\": \"8,2\"}','2020-09-21 14:02:54','2020-09-21 14:04:04'),(14,1,5,NULL,'comments','Comments',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54'),(15,1,6,NULL,'state','State',1,NULL,1,1,'','2020-09-21 14:02:54','2020-09-21 14:02:54');
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'string','text',NULL,NULL),(2,'integer','number',NULL,NULL),(3,'boolean','checkbox',NULL,NULL),(4,'dateTime','datetime',NULL,NULL),(5,'text','textarea',NULL,NULL),(6,'unsignedSmallInteger','number',NULL,NULL),(7,'unsignedBigInteger','number',NULL,NULL),(8,'unsignedBigInteger','select',NULL,NULL),(9,'bigInteger','number',NULL,NULL),(10,'char','text',NULL,NULL),(11,'date','date',NULL,NULL),(12,'decimal','number',NULL,NULL),(13,'decimal','decimal',NULL,NULL),(14,'float','number',NULL,NULL),(15,'json','textarea',NULL,NULL),(16,'jsonb','textarea',NULL,NULL),(17,'longText','textarea',NULL,NULL),(18,'smallInteger','number',NULL,NULL),(19,'softDeletes','datetime',NULL,NULL),(20,'string','file',NULL,NULL);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'tenders',NULL,'tender','Tender',1,1,1,1,0,'2020-09-21 14:02:54','2020-09-21 14:02:54');
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

-- Dump completed on 2020-09-21 20:42:01

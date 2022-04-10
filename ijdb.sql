-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ijokes
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Belinda','belinda@gmail.com','1234'),(9,'Betty Ablorh','betty.ablorh23@gmail.com','$2y$10$MSV.Ertpe.J2kJXWwvCznuW4R7yjKZu05Y8jLu5Gw1Cmc8z6P8B5O'),(10,'Nii','nii23@gmail.com','$2y$10$nqCC4l0WYZ1wNRWeqERthuZZd4qxqhrnurHwMmzDFJNIPvNWaEXJ6'),(11,'bet','betty.ablorh@gmail.com','$2y$10$tSjUwJzlalVFkuaSj6jGu.nxNujwrVHCEOQwi.ZQgcYoSAm5RlCJC'),(12,'nii','nii@gmail.com','$2y$10$Txqw5f.GTrRUSGSIRPi2hONFbh.wPDjcZlhwAvcJqEiMCi9yP0Ss.');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'School'),(3,'hee');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_joke`
--

DROP TABLE IF EXISTS `category_joke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_joke` (
  `jokeid` int NOT NULL,
  `catid` int NOT NULL,
  PRIMARY KEY (`jokeid`,`catid`),
  KEY `composite` (`jokeid`,`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_joke`
--

LOCK TABLES `category_joke` WRITE;
/*!40000 ALTER TABLE `category_joke` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_joke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorys_table`
--

DROP TABLE IF EXISTS `categorys_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorys_table` (
  `jokeId` int NOT NULL,
  `catId` int NOT NULL,
  PRIMARY KEY (`jokeId`,`catId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorys_table`
--

LOCK TABLES `categorys_table` WRITE;
/*!40000 ALTER TABLE `categorys_table` DISABLE KEYS */;
INSERT INTO `categorys_table` VALUES (118,2),(118,3),(119,3),(120,3),(121,2),(121,3);
/*!40000 ALTER TABLE `categorys_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favjoke`
--

DROP TABLE IF EXISTS `favjoke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favjoke` (
  `id` int NOT NULL AUTO_INCREMENT,
  `joketext` varchar(255) DEFAULT NULL,
  `authorid` int NOT NULL,
  PRIMARY KEY (`id`,`authorid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favjoke`
--

LOCK TABLES `favjoke` WRITE;
/*!40000 ALTER TABLE `favjoke` DISABLE KEYS */;
INSERT INTO `favjoke` VALUES (1,'Developers always give dry jokes',11),(1,'Developers always give dry jokes',12),(9,'hello I am not funny',11),(11,'hello joke not funnys the',11),(11,'In the day an engineerss the',12);
/*!40000 ALTER TABLE `favjoke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jokecategory`
--

DROP TABLE IF EXISTS `jokecategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jokecategory` (
  `jokeid` int NOT NULL,
  `categoryid` int NOT NULL,
  PRIMARY KEY (`jokeid`,`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jokecategory`
--

LOCK TABLES `jokecategory` WRITE;
/*!40000 ALTER TABLE `jokecategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `jokecategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jokes`
--

DROP TABLE IF EXISTS `jokes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jokes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `joketext` varchar(255) DEFAULT NULL,
  `jokedate` varchar(45) DEFAULT NULL,
  `authorid` int NOT NULL,
  PRIMARY KEY (`id`,`authorid`),
  KEY `authorid` (`authorid`),
  CONSTRAINT `fk_joke_author` FOREIGN KEY (`authorid`) REFERENCES `author` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jokes`
--

LOCK TABLES `jokes` WRITE;
/*!40000 ALTER TABLE `jokes` DISABLE KEYS */;
INSERT INTO `jokes` VALUES (6,'In the day an engineerss the','2022-01-26',11),(39,'Developers always give dry jokes','2021-12-27',1),(51,'Hello world devs are not funny','2022-01-03',1),(87,'hello I am not funny','2022-09-01',9),(114,'        School','2022-02-02',11),(118,'        ken','2022-02-02',11),(119,'        not','2022-02-02',11),(120,'        not','2022-02-02',11);
/*!40000 ALTER TABLE `jokes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-02 22:39:12

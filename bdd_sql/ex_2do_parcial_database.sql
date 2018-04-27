CREATE DATABASE  IF NOT EXISTS `CURP` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `CURP`;
-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: CURP
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `entidad_federativa`
--

DROP TABLE IF EXISTS `entidad_federativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidad_federativa` (
  `siglas` varchar(2) NOT NULL,
  `name_ent` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`siglas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidad_federativa`
--

LOCK TABLES `entidad_federativa` WRITE;
/*!40000 ALTER TABLE `entidad_federativa` DISABLE KEYS */;
INSERT INTO `entidad_federativa` VALUES ('AS','AGUASCALIENTES'),('BC','BAJA CALIFORNIA'),('BS','BAJA CALIFORNIA SUR'),('CC','CAMPECHE'),('CH','CHIHUAHUA'),('CL','COAHUILA'),('CM','COLIMA'),('CS','CHIAPAS'),('DF','DISTRITO FEDERAL'),('DG','DURANGO'),('GR','GUERRERO'),('GT','GUANAJUATO'),('HG','HIDALGO'),('JC','JALISCO'),('MC','MEXICO'),('MN','MICHOACAN'),('MS','MORELOS'),('NL','NUEVO LEON'),('NT','NAYARIT'),('OC','OAXACA'),('PL','PUEBLA'),('QR','QUINTANA ROO'),('QT','QUERETARO'),('SL','SINALOA'),('SP','SAN LUIS POTOSI'),('SR','SONORA'),('TC','TABASCO'),('TL','TLAXCALA'),('TS','TAMAULIPAS'),('VZ','VERACRUZ'),('YN','YUCATAN'),('ZS','ZACATECAS');
/*!40000 ALTER TABLE `entidad_federativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `lastnamem` varchar(30) DEFAULT NULL,
  `lastnamep` varchar(30) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `ent_fed` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `ent_fed` (`ent_fed`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ent_fed`) REFERENCES `entidad_federativa` (`siglas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'JUAN GUSTAVO','GARCÍA','SALAS',1,'johnsalaslp@gmail.com','1994-09-24','AS'),(2,'ILSE ADRIANA','SAUCEDO','SOTO',0,'ilsead_94@hotmail.com','1994-08-26','AS');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'CURP'
--

--
-- Dumping routines for database 'CURP'
--
/*!50003 DROP PROCEDURE IF EXISTS `getCURP` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCURP`(email varchar(30))
begin
	select 
		firstname, 
        lastnamep, 
        lastnamem, 
        concat(
			date_format(users.birthdate, '%y%m%d'),
			replace(replace(users.gender, 1, 'H'), 0, 'M'),
			users.ent_fed
		) as part_curp, 
        '0' as not_copy, 
        '9' as digit_compr from users
	where users.email=email;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-24 13:43:36

-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sis_registro
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `responsable_area` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_area` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_area` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Recursos Humanos','Sofia Condori','Gestionar documentos del personal para una administración eficiente',1),(2,'SIE','Carmen Rosa','Centralizar informes clave para decisiones estratégicas.',1),(3,'Seguimiento Urbano','Alvaro Ramos','Controlar proyectos y permisos en entornos urbanos.',1),(4,'Seguimiento Rural','Fernando Flores','Administrar registros agrícolas y rurales con facilidad.\n\n',1),(5,'Participación Social','Carlos Perez','Comunicación activa con la comunidad para colaboración.\r\n\r\n\r\n\r\n\r\n',1);
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_doc` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `hojaderuta` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `remitente_doc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `archivo_doc` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_doc`),
  KEY `area_id` (`area_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salidadoc`
--

DROP TABLE IF EXISTS `salidadoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salidadoc` (
  `id_salida` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `destinatario_salida` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_salida` datetime NOT NULL,
  PRIMARY KEY (`id_salida`),
  KEY `usuario_id` (`usuario_id`),
  KEY `doc_id` (`doc_id`),
  CONSTRAINT `salidadoc_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `salidadoc_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `documento` (`id_doc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salidadoc`
--

LOCK TABLES `salidadoc` WRITE;
/*!40000 ALTER TABLE `salidadoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `salidadoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuario` (
  `id_tu` int(11) NOT NULL AUTO_INCREMENT,
  `rol_tu` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_tu` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_tu` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_tu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` VALUES (1,'Administrador','Encargado de la administración integral del sistema. Tiene acceso total y puede gestionar todas las funciones. ',1);
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres_usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos_usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ci_usuario` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `email_usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password_usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_usuario` int(10) NOT NULL,
  `tu_id` int(11) NOT NULL,
  `estado_usuario` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_usuario`),
  KEY `tu_id` (`tu_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tu_id`) REFERENCES `tipousuario` (`id_tu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Camila','Salinas','98745874','camila@gmail.com','admin',68547844,1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-30 15:27:06

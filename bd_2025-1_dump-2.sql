-- MySQL dump 10.13  Distrib 8.4.6, for Linux (x86_64)
--
-- Host: 192.168.1.200    Database: evaluaciondocenteM
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Temporary view structure for view `alumnostotalenc`
--

DROP TABLE IF EXISTS `alumnostotalenc`;
/*!50001 DROP VIEW IF EXISTS `alumnostotalenc`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `alumnostotalenc` AS SELECT 
 1 AS `matricula`,
 1 AS `grupo`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `consultarealizadas`
--

DROP TABLE IF EXISTS `consultarealizadas`;
/*!50001 DROP VIEW IF EXISTS `consultarealizadas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `consultarealizadas` AS SELECT 
 1 AS `status`,
 1 AS `genero`,
 1 AS `carrera`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `datosprofmat`
--

DROP TABLE IF EXISTS `datosprofmat`;
/*!50001 DROP VIEW IF EXISTS `datosprofmat`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `datosprofmat` AS SELECT 
 1 AS `claveMat`,
 1 AS `mmateria`,
 1 AS `mprofesor`,
 1 AS `idG`,
 1 AS `claveProf`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `encuesta`
--

DROP TABLE IF EXISTS `encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuesta` (
  `idE` int NOT NULL DEFAULT '0',
  `periodo` varchar(11) DEFAULT NULL,
  `ns` tinyint DEFAULT NULL,
  PRIMARY KEY (`idE`),
  CONSTRAINT `encuesta_ibfk_1_textoExt` FOREIGN KEY (`idE`) REFERENCES `encuestapregunta` (`idE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuesta`
--

LOCK TABLES `encuesta` WRITE;
/*!40000 ALTER TABLE `encuesta` DISABLE KEYS */;
INSERT INTO `encuesta` VALUES (1,'2024',NULL),(2,'2025-1',NULL),(3,'2025-1',NULL),(4,'2025-1',NULL),(5,'2024',NULL),(6,'2025-1',NULL),(7,'2025-1',NULL),(8,'2025-1',NULL),(9,'2024',NULL),(10,'2025-1',NULL),(11,'2025-1',NULL),(12,'2025-1',NULL),(13,'2024',NULL),(14,'2025-1',NULL),(15,'2025-1',NULL),(16,'2025-1',NULL),(17,'2024',NULL),(18,'2025-1',NULL),(19,'2025-1',NULL),(20,'2025-1',NULL),(21,'2024',NULL),(22,'2025-1',NULL),(23,'2025-1',NULL),(24,'2025-1',NULL),(25,'2024',NULL),(26,'2025-1',NULL),(27,'2025-1',NULL),(28,'2024',NULL),(29,'2025-1',NULL),(30,'2025-1',NULL),(31,'2024',NULL),(32,'2025-1',NULL),(33,'2025-1',NULL),(34,'2025-1',NULL),(35,'2024',NULL),(36,'2025-1',NULL),(37,'2025-1',NULL),(38,'2025-1',NULL),(39,'2024',NULL),(40,'2025-1',NULL),(41,'2025-1',NULL),(42,'2024',NULL),(43,'2025-1',NULL),(44,'2025-1',NULL),(45,'2025-1',NULL),(46,'2024',NULL),(47,'2025-1',NULL),(48,'2025-1',NULL),(49,'2025-1',NULL),(50,'2024',NULL),(51,'2024',NULL),(52,'2025-1',NULL),(53,'2025-1',NULL),(54,'2024',NULL),(55,'2025-1',NULL),(56,'2025-1',NULL),(57,'2024',NULL);
/*!40000 ALTER TABLE `encuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuestaconteo`
--

DROP TABLE IF EXISTS `encuestaconteo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuestaconteo` (
  `idE` int NOT NULL AUTO_INCREMENT,
  `periodo` varchar(11) DEFAULT NULL,
  `claveProf` int DEFAULT NULL,
  PRIMARY KEY (`idE`),
  KEY `claveProf` (`claveProf`),
  CONSTRAINT `encuestaconteo_ibfk_1` FOREIGN KEY (`claveProf`) REFERENCES `profesor` (`claveProf`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestaconteo`
--

LOCK TABLES `encuestaconteo` WRITE;
/*!40000 ALTER TABLE `encuestaconteo` DISABLE KEYS */;
INSERT INTO `encuestaconteo` VALUES (1,'2025-1',88),(2,'2025-1',651),(3,'2025-1',973),(4,'2025-1',1006),(5,'2025-1',88),(6,'2025-1',651),(7,'2025-1',973),(8,'2025-1',1006),(9,'2025-1',88),(10,'2025-1',651),(11,'2025-1',973),(12,'2025-1',1006),(13,'2025-1',88),(14,'2025-1',651),(15,'2025-1',973),(16,'2025-1',1006),(17,'2025-1',88),(18,'2025-1',651),(19,'2025-1',973),(20,'2025-1',1006),(21,'2025-1',88),(22,'2025-1',651),(23,'2025-1',973),(24,'2025-1',1006),(25,'2025-1',67),(26,'2025-1',88),(27,'2025-1',651),(28,'2025-1',67),(29,'2025-1',88),(30,'2025-1',651),(31,'2025-1',88),(32,'2025-1',651),(33,'2025-1',973),(34,'2025-1',1006),(35,'2025-1',88),(36,'2025-1',651),(37,'2025-1',973),(38,'2025-1',1006),(39,'2025-1',67),(40,'2025-1',88),(41,'2025-1',651),(42,'2025-1',88),(43,'2025-1',651),(44,'2025-1',973),(45,'2025-1',1006),(46,'2025-1',88),(47,'2025-1',651),(48,'2025-1',973),(49,'2025-1',1006),(50,'2025-1',272),(51,'2025-1',272),(52,'2025-1',649),(53,'2025-1',761),(54,'2025-1',272),(55,'2025-1',649),(56,'2025-1',761),(57,'2025-1',272);
/*!40000 ALTER TABLE `encuestaconteo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuestado`
--

DROP TABLE IF EXISTS `encuestado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuestado` (
  `matricula` varchar(9) NOT NULL DEFAULT '',
  `status` char(1) DEFAULT NULL,
  `genero` varchar(255) NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestado`
--

LOCK TABLES `encuestado` WRITE;
/*!40000 ALTER TABLE `encuestado` DISABLE KEYS */;
INSERT INTO `encuestado` VALUES ('20141360','N','M'),('248020001','N','M'),('248020002','R','F'),('248020003','R','M'),('248020004','R','F'),('248020006','R','M'),('248020008','R','M'),('248020009','N','M'),('248020010','R','M'),('248020011','R','F'),('248020012','N','M'),('248020013','R','M'),('248020014','R','M'),('248020015','R','M'),('253014002','R','M'),('253014003','R','M'),('253014004','N','M'),('253014005','N','M'),('253014006','R','F'),('398010037','R','M'),('398010042','N','F'),('498020048','N','F'),('598010056','N','M'),('598010058','R','F'),('598020063','R','F'),('698010068','R','F');
/*!40000 ALTER TABLE `encuestado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuestadogrupo`
--

DROP TABLE IF EXISTS `encuestadogrupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuestadogrupo` (
  `matricula` varchar(9) NOT NULL DEFAULT '',
  `idG` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `genero` varchar(4) NOT NULL,
  PRIMARY KEY (`matricula`,`idG`),
  KEY `idG` (`idG`),
  CONSTRAINT `encuestadogrupo_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `encuestado` (`matricula`),
  CONSTRAINT `encuestadogrupo_ibfk_2` FOREIGN KEY (`idG`) REFERENCES `grupo` (`idG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestadogrupo`
--

LOCK TABLES `encuestadogrupo` WRITE;
/*!40000 ALTER TABLE `encuestadogrupo` DISABLE KEYS */;
INSERT INTO `encuestadogrupo` VALUES ('20141360','MAESII-IV','M'),('248020001','MAESII-II','M'),('248020002','MAESII-II','F'),('248020003','MAESII-II','M'),('248020004','MAESII-II','F'),('248020006','MAESII-II','M'),('248020008','MAESII-II','M'),('248020009','MAESII-II','M'),('248020010','MAESII-II','M'),('248020011','MAESII-II','F'),('248020012','MAESII-II','M'),('248020013','MAESII-II','M'),('248020014','MAESII-II','M'),('248020015','MAESII-II','M'),('253014002','MAESII-I','M'),('253014003','MAESII-I','M'),('253014004','MAESII-I','M'),('253014005','MAESII-I','M'),('253014006','MAESII-I','F'),('398010037','MAESII-IV','M'),('398010042','MAESII-II','F'),('498020048','MAESII-IV','F'),('598010056','MAESII-IV','M'),('598010058','MAESII-III','F'),('598020063','MAESII-IV','F'),('698010068','MAESII-III','F');
/*!40000 ALTER TABLE `encuestadogrupo` ENABLE KEYS */;
UNLOCK TABLES;

---
--- Estructura generada manualmente para tabla `encuestacomentario`
---

DROP TABLE IF EXISTS `encuestacomentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuestacomentario`(
  `idE` int NOT NULL DEFAULT '0',
  `comentario` varchar(240) DEFAULT NULL,
  CONSTRAINT `encuestacomentario_idefk` FOREIGN KEY (`idE`) REFERENCES `encuestapregunta`(`idE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

---
--- Fin estrictura `encuestacomentario`
---

--
-- Table structure for table `encuestapregunta`
--

DROP TABLE IF EXISTS `encuestapregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuestapregunta` (
  `idE` int NOT NULL DEFAULT '0',
  `numP` int NOT NULL DEFAULT '0',
  `evaluacion` int DEFAULT NULL,
  PRIMARY KEY (`idE`,`numP`),
  KEY `numP` (`numP`),
  CONSTRAINT `encuestapregunta_ibfk_2` FOREIGN KEY (`numP`) REFERENCES `pregunta` (`numP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestapregunta`
--

LOCK TABLES `encuestapregunta` WRITE;
/*!40000 ALTER TABLE `encuestapregunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuestapregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `gpm`
--

DROP TABLE IF EXISTS `gpm`;
/*!50001 DROP VIEW IF EXISTS `gpm`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `gpm` AS SELECT 
 1 AS `nombre`,
 1 AS `Materia`,
 1 AS `claveProf`,
 1 AS `idG`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupo` (
  `idG` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `carrera` varchar(255) NOT NULL,
  PRIMARY KEY (`idG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES ('MAESII-I','M. I. I.'),('MAESII-II','M. I. I.'),('MAESII-III','M. I. I.'),('MAESII-IV','M. I. I.');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupoprofesor`
--

DROP TABLE IF EXISTS `grupoprofesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupoprofesor` (
  `idG` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `claveProf` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idG`,`claveProf`),
  KEY `claveProf` (`claveProf`),
  CONSTRAINT `grupoprofesor_ibfk_1` FOREIGN KEY (`idG`) REFERENCES `grupo` (`idG`),
  CONSTRAINT `grupoprofesor_ibfk_2` FOREIGN KEY (`claveProf`) REFERENCES `profesor` (`claveProf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupoprofesor`
--

LOCK TABLES `grupoprofesor` WRITE;
/*!40000 ALTER TABLE `grupoprofesor` DISABLE KEYS */;
INSERT INTO `grupoprofesor` VALUES ('MAESII-I',67),('MAESII-I',88),('MAESII-II',88),('MAESII-III',272),('MAESII-IV',272),('MAESII-III',282),('MAESII-IV',282),('MAESII-III',424),('MAESII-III',426),('MAESII-III',474),('MAESII-III',475),('MAESII-IV',649),('MAESII-II',651),('MAESII-IV',761),('MAESII-II',973),('MAESII-II',1006);
/*!40000 ALTER TABLE `grupoprofesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupoprofesormateria`
--

DROP TABLE IF EXISTS `grupoprofesormateria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupoprofesormateria` (
  `idG` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `claveProf` int NOT NULL DEFAULT '0',
  `claveMat` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`idG`,`claveProf`,`claveMat`),
  KEY `claveProf` (`claveProf`),
  KEY `claveMat` (`claveMat`),
  CONSTRAINT `grupoprofesormateria_ibfk_1` FOREIGN KEY (`idG`) REFERENCES `grupo` (`idG`),
  CONSTRAINT `grupoprofesormateria_ibfk_2` FOREIGN KEY (`claveProf`) REFERENCES `profesor` (`claveProf`),
  CONSTRAINT `grupoprofesormateria_ibfk_3` FOREIGN KEY (`claveMat`) REFERENCES `materia` (`claveMat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupoprofesormateria`
--

LOCK TABLES `grupoprofesormateria` WRITE;
/*!40000 ALTER TABLE `grupoprofesormateria` DISABLE KEYS */;
INSERT INTO `grupoprofesormateria` VALUES ('MAESII-I',67,'MAESII14002'),('MAESII-I',88,'MAESII14003'),('MAESII-II',88,'MAESII14006'),('MAESII-III',272,'MAESII14007'),('MAESII-IV',272,'MAESII14010'),('MAESII-IV',649,'MAESII14011'),('MAESII-I',651,'MAESII14001'),('MAESII-II',651,'MAESII14004'),('MAESII-IV',761,'MAESII1401'),('MAESII-II',973,'MAESII14016'),('MAESII-II',1006,'MAESII14005');
/*!40000 ALTER TABLE `grupoprofesormateria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materia` (
  `claveMat` varchar(20) NOT NULL DEFAULT '',
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`claveMat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES ('MAESII14001','Estadística'),('MAESII14002','Análisis Económico'),('MAESII14003','Administración de la Producción y las Empresas'),('MAESII14004','Investigación de Operaciones'),('MAESII14005','Ingeniería de la calidad'),('MAESII14006','Seminario 1'),('MAESII14007','Técnicas para el mejoramiento de la calidad'),('MAESII14008','Tópicos selectos de la calidad'),('MAESII14009','Seminario 2'),('MAESII1401','Sistemas de medición y análisis de incertidumbre'),('MAESII14010','Planificación y control de sistemas de calidad'),('MAESII14011','Seminario 3'),('MAESII14016','Simulación'),('MAESII1402','Tesis');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiagrupo`
--

DROP TABLE IF EXISTS `materiagrupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiagrupo` (
  `claveMat` varchar(20) NOT NULL DEFAULT '',
  `idG` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`claveMat`,`idG`),
  KEY `idG` (`idG`),
  CONSTRAINT `materiagrupo_ibfk_1` FOREIGN KEY (`idG`) REFERENCES `grupo` (`idG`),
  CONSTRAINT `materiagrupo_ibfk_2` FOREIGN KEY (`claveMat`) REFERENCES `materia` (`claveMat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiagrupo`
--

LOCK TABLES `materiagrupo` WRITE;
/*!40000 ALTER TABLE `materiagrupo` DISABLE KEYS */;
INSERT INTO `materiagrupo` VALUES ('MAESII14001','MAESII-I'),('MAESII14002','MAESII-I'),('MAESII14003','MAESII-I'),('MAESII14004','MAESII-II'),('MAESII14005','MAESII-II'),('MAESII14006','MAESII-II'),('MAESII14016','MAESII-II'),('MAESII14007','MAESII-III'),('MAESII14008','MAESII-III'),('MAESII14009','MAESII-III'),('MAESII1401','MAESII-IV'),('MAESII14010','MAESII-IV'),('MAESII14011','MAESII-IV'),('MAESII1402','MAESII-IV');
/*!40000 ALTER TABLE `materiagrupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pregunta` (
  `numP` int NOT NULL DEFAULT '0',
  `preg` varchar(200) DEFAULT NULL,
  `secc` tinyint DEFAULT NULL,
  PRIMARY KEY (`numP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES
(1,'Da a conocer el programa de estudios de la materia.',1),
(2,'Explica los objetos del curso.',1),
(3,'Explica claramente la metodología de trabajo durante el curso.',1),
(4,'Explica claramente los criterios de evaluación que se utilizarán durante el curso.',1),
(5,'Explica la utilidad de los contenidos teóricos y prácticos para la actividad profesional.',1),
(6,'Explora los conocimientos previos de los estudiantes.',2),
(7,'Establece relaciones entre conocimientos previos y nuevos.',2),
(8,'Estimular la búsqueda de conocimientos de manera independiente.',2),
(9,'Promueve el desarrollo de habilidades de pensamiento (análisis, síntesis, comparación, clasificación, pensamiento crítico, pensamiento divergente).',2),
(10,'Propiciar el aprender a aprender.',2),
(11,'Utilizar métodos que favorezcan el aprendizaje acordes con los intereses del grupo.',2),
(12,'Propiciar un ambiente de confianza.',2),
(13,'Impulsar el trabajo colaborativo.',2),
(14,'Promover el interés de los estudiantes por la materia.',2),
(15,'Relacionar los contenidos de la materia con otras materias.',3),
(16,'Relacionar los contenidos de la materia con el perfil de egreso.',3),
(17,'Presentar los contenidos en forma organizada y con una secuencia lógica.',3),
(18,'Vincular la teoría con la práctica profesional, usando ejemplos reales para la comprensión de los contenidos de la materia.',3),
(19,'Resolver dudas sobre los contenidos de la materia.',3),
(20,'Promover los valores del TecNM.',4),
(21,'Relacionar la clase con el desarrollo sustentable.',4),
(22,'Utilizar diferentes formas de evaluación.',5),
(23,'Analizar con el grupo los resultados de las evaluaciones.',5),
(24,'Proponer nuevas acciones a partir de los logros y dificultades detectadas.',5),
(25,'Evaluar los contenidos del curso.',5),
(26,'Escriba alguna sugerencia.',9);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesor` (
  `claveProf` int NOT NULL DEFAULT '0',
  `nombre` varchar(60) DEFAULT NULL,
  `genero` varchar(255) NOT NULL,
  PRIMARY KEY (`claveProf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (67,'ROSALÍO MARTÍN MARÍN FERNÁNDEZ','M'),(88,'ALICIA VILLALBA GONZÁLEZ','F'),(272,'LAURA LEONOR MIRA SEGURA','F'),(282,'ROBERTO CASTRO LÓPEZ','M'),(424,'LEONARDO DAVID CRUZ DIOSDADO','M'),(426,'JUAN CARLOS NAVARRETE NARVAEZ','M'),(474,'MARCO ANTONIO ACOSTA MENDIZABAL','M'),(475,'VALENTIN INOCENTE JIMENEZ JARQUIN','M'),(649,'MAURICIO CHAVEZ PICHARDO','M'),(651,'LEOBARDO MORALES RUIZ','M'),(761,'DANIEL MARTÍNEZ CARBAJAL','M'),(973,'RAMÓN EDUARDO MARTÍNEZ GRIMALDO','M'),(1006,'MARIA DEL SOCORRO RIVERA CASALES','F');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesorencuesta`
--

DROP TABLE IF EXISTS `profesorencuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesorencuesta` (
  `claveProf` int NOT NULL DEFAULT '0',
  `idE` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`claveProf`,`idE`),
  KEY `idE` (`idE`),
  CONSTRAINT `profesorencuesta_ibfk_1` FOREIGN KEY (`claveProf`) REFERENCES `profesor` (`claveProf`),
  CONSTRAINT `profesorencuesta_ibfk_2` FOREIGN KEY (`idE`) REFERENCES `encuesta` (`idE`),
  CONSTRAINT `profesorencuestaFKEncuestaconteo` FOREIGN KEY (`idE`) REFERENCES `encuestaconteo` (`idE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Dumping data for table `profesorencuesta`
--

LOCK TABLES `profesorencuesta` WRITE;
/*!40000 ALTER TABLE `profesorencuesta` DISABLE KEYS */;
INSERT INTO `profesorencuesta` VALUES (88,1),(651,2),(973,3),(1006,4),(88,5),(651,6),(973,7),(1006,8),(88,9),(651,10),(973,11),(1006,12),(88,13),(651,14),(973,15),(1006,16),(88,17),(651,18),(973,19),(1006,20),(88,21),(651,22),(973,23),(1006,24),(67,25),(88,26),(651,27),(67,28),(88,29),(651,30),(88,31),(651,32),(973,33),(1006,34),(88,35),(651,36),(973,37),(1006,38),(67,39),(88,40),(651,41),(88,42),(651,43),(973,44),(1006,45),(88,46),(651,47),(973,48),(1006,49),(272,50),(272,51),(649,52),(761,53),(272,54),(649,55),(761,56),(272,57);
/*!40000 ALTER TABLE `profesorencuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'evaluaciondocenteM'
--

--
-- Final view structure for view `alumnostotalenc`
--

/*!50001 DROP VIEW IF EXISTS `alumnostotalenc`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `alumnostotalenc` AS select `eg`.`matricula` AS `matricula`,`eg`.`idG` AS `grupo`,`e`.`status` AS `estado` from (`encuestadogrupo` `eg` join `encuestado` `e` on((`eg`.`matricula` = `e`.`matricula`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `consultarealizadas`
--

/*!50001 DROP VIEW IF EXISTS `consultarealizadas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `consultarealizadas` AS select `e`.`status` AS `status`,`e`.`genero` AS `genero`,`g`.`carrera` AS `carrera` from ((`encuestado` `e` join `encuestadogrupo` `eg` on((`e`.`matricula` = `eg`.`matricula`))) join `grupo` `g` on((`eg`.`idG` = `g`.`idG`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `datosprofmat`
--

/*!50001 DROP VIEW IF EXISTS `datosprofmat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `datosprofmat` AS select `m`.`claveMat` AS `claveMat`,`m`.`nombre` AS `mmateria`,`p`.`nombre` AS `mprofesor`,`gpm`.`idG` AS `idG`,`p`.`claveProf` AS `claveProf` from ((`profesor` `p` join `grupoprofesormateria` `gpm` on((`p`.`claveProf` = `gpm`.`claveProf`))) join `materia` `m` on((`gpm`.`claveMat` = `m`.`claveMat`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `gpm`
--

/*!50001 DROP VIEW IF EXISTS `gpm`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `gpm` AS select `p`.`nombre` AS `nombre`,`m`.`nombre` AS `Materia`,`gpm`.`claveProf` AS `claveProf`,`g`.`idG` AS `idG` from (((`grupoprofesormateria` `gpm` join `grupo` `g` on((`g`.`idG` = `gpm`.`idG`))) join `materia` `m` on((`m`.`claveMat` = `gpm`.`claveMat`))) join `profesor` `p` on((`p`.`claveProf` = `gpm`.`claveProf`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-21 15:39:34

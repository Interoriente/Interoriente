-- MySQL dump 10.19  Distrib 10.2.44-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: interori_interoriente
-- ------------------------------------------------------
-- Server version	10.2.44-MariaDB-cll-lve

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
-- Table structure for table `tblCarrito`
--

DROP TABLE IF EXISTS `tblCarrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCarrito` (
  `idPublicacionCarrito` int(11) NOT NULL,
  `docIdentidadCarrito` varchar(10) CHARACTER SET latin1 NOT NULL,
  `cantidadCarrito` int(11) NOT NULL,
  PRIMARY KEY (`idPublicacionCarrito`,`docIdentidadCarrito`),
  KEY `idPublicacionCarrito` (`idPublicacionCarrito`),
  KEY `Fk_tblCarrito_tblUsuario` (`docIdentidadCarrito`),
  CONSTRAINT `Fk_tblCarrito_tblPublicacion` FOREIGN KEY (`idPublicacionCarrito`) REFERENCES `tblPublicacion` (`idPublicacion`),
  CONSTRAINT `Fk_tblCarrito_tblUsuario` FOREIGN KEY (`docIdentidadCarrito`) REFERENCES `tblUsuario` (`documentoIdentidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCarrito`
--

LOCK TABLES `tblCarrito` WRITE;
/*!40000 ALTER TABLE `tblCarrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblCarrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCategoria`
--

DROP TABLE IF EXISTS `tblCategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCategoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagenCategoria` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCategoria`
--

LOCK TABLES `tblCategoria` WRITE;
/*!40000 ALTER TABLE `tblCategoria` DISABLE KEYS */;
INSERT INTO `tblCategoria` (`idCategoria`, `nombreCategoria`, `imagenCategoria`) VALUES (1,'Deportes y Fitness','fitness.jpg'),(3,'Accesorios para vehiculos','accesoriosVe.jpg'),(5,'Hogar','hogar.jpg'),(7,'Oficinas e Industria','oficina.jpg'),(8,'Productos Sustentables','comida.jpg'),(9,'Tecnología','tecnologia.jpg'),(10,'Herramientas','herramientas.jpg');
/*!40000 ALTER TABLE `tblCategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCiudad`
--

DROP TABLE IF EXISTS `tblCiudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCiudad` (
  `idCiudad` varchar(6) CHARACTER SET latin1 NOT NULL,
  `nombreCiudad` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idCiudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCiudad`
--

LOCK TABLES `tblCiudad` WRITE;
/*!40000 ALTER TABLE `tblCiudad` DISABLE KEYS */;
INSERT INTO `tblCiudad` (`idCiudad`, `nombreCiudad`) VALUES ('05002','Abejorral'),('05021','Alejandría'),('05055','Argelia'),('05148','Carmen de Viboral'),('05197','Cocorná'),('05206','Concepción'),('05313','Granada'),('05318','Guarne'),('05321','Guatapé'),('05376','La Ceja'),('05400','La Unión'),('05440','Marinilla'),('05441','El Peñol'),('05483','Nariño'),('05607','El Retiro'),('05615','Rionegro'),('05649','San Carlos'),('05652','San Francisco'),('05660','San Luís'),('05667','San Rafael'),('05674','San Vicente'),('05697','El Santuario'),('05756','Sonsón');
/*!40000 ALTER TABLE `tblCiudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDirecciones`
--

DROP TABLE IF EXISTS `tblDirecciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDirecciones` (
  `idDireccion` int(11) NOT NULL AUTO_INCREMENT,
  `docIdentidadDireccion` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nombreDireccion` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `descripcionDireccion` varchar(70) CHARACTER SET latin1 DEFAULT NULL,
  `ciudadDireccion` varchar(6) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idDireccion`),
  KEY `Fk_tblDirecciones_tblUsuario` (`docIdentidadDireccion`),
  KEY `Fk_tblDirecciones_tblCiudad` (`ciudadDireccion`),
  CONSTRAINT `Fk_tblDirecciones_tblCiudad` FOREIGN KEY (`ciudadDireccion`) REFERENCES `tblCiudad` (`idCiudad`),
  CONSTRAINT `Fk_tblDirecciones_tblUsuario` FOREIGN KEY (`docIdentidadDireccion`) REFERENCES `tblUsuario` (`documentoIdentidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDirecciones`
--

LOCK TABLES `tblDirecciones` WRITE;
/*!40000 ALTER TABLE `tblDirecciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDirecciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblFactura`
--

DROP TABLE IF EXISTS `tblFactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblFactura` (
  `numeroFactura` int(11) NOT NULL AUTO_INCREMENT,
  `docIdentidadFactura` varchar(10) CHARACTER SET latin1 NOT NULL,
  `fechaFactura` date NOT NULL,
  `direccionFactura` varchar(30) CHARACTER SET latin1 NOT NULL,
  `emailFactura` varchar(60) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`numeroFactura`),
  KEY `Fk_tblFactura_tblUsuario` (`docIdentidadFactura`),
  CONSTRAINT `Fk_tblFactura_tblUsuario` FOREIGN KEY (`docIdentidadFactura`) REFERENCES `tblUsuario` (`documentoIdentidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblFactura`
--

LOCK TABLES `tblFactura` WRITE;
/*!40000 ALTER TABLE `tblFactura` DISABLE KEYS */;
INSERT INTO `tblFactura` (`numeroFactura`, `docIdentidadFactura`, `fechaFactura`, `direccionFactura`, `emailFactura`) VALUES (1,'1007382009','2022-06-01','','Cargando...');
/*!40000 ALTER TABLE `tblFactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblFacturaPublicacion`
--

DROP TABLE IF EXISTS `tblFacturaPublicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblFacturaPublicacion` (
  `numFacturaPublicacion` int(11) NOT NULL,
  `idPublicacionFactura` int(11) NOT NULL,
  `cantidadFacturaPublicacion` int(10) NOT NULL,
  PRIMARY KEY (`numFacturaPublicacion`,`idPublicacionFactura`),
  KEY `Fk_tblFacturaPublicacion_tblPublicacion` (`idPublicacionFactura`),
  CONSTRAINT `Fk_tblFacturaPublicacion_tblFactura` FOREIGN KEY (`numFacturaPublicacion`) REFERENCES `tblFactura` (`numeroFactura`),
  CONSTRAINT `Fk_tblFacturaPublicacion_tblPublicacion` FOREIGN KEY (`idPublicacionFactura`) REFERENCES `tblPublicacion` (`idPublicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblFacturaPublicacion`
--

LOCK TABLES `tblFacturaPublicacion` WRITE;
/*!40000 ALTER TABLE `tblFacturaPublicacion` DISABLE KEYS */;
INSERT INTO `tblFacturaPublicacion` (`numFacturaPublicacion`, `idPublicacionFactura`, `cantidadFacturaPublicacion`) VALUES (1,1,2);
/*!40000 ALTER TABLE `tblFacturaPublicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblImagenes`
--

DROP TABLE IF EXISTS `tblImagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblImagenes` (
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `urlImagen` varchar(2000) CHARACTER SET latin1 NOT NULL,
  `publicacionImagen` int(11) NOT NULL,
  PRIMARY KEY (`idImagen`),
  KEY `FK_tblImagenes_tblPublicacion` (`publicacionImagen`),
  CONSTRAINT `FK_tblImagenes_tblPublicacion` FOREIGN KEY (`publicacionImagen`) REFERENCES `tblPublicacion` (`idPublicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblImagenes`
--

LOCK TABLES `tblImagenes` WRITE;
/*!40000 ALTER TABLE `tblImagenes` DISABLE KEYS */;
INSERT INTO `tblImagenes` (`idImagen`, `urlImagen`, `publicacionImagen`) VALUES (1,'../assets/img/publicaciones/id1_2021-11-15.png',1),(2,'../assets/img/publicaciones/id2_2021-11-15 (6).png',2);
/*!40000 ALTER TABLE `tblImagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblLinks`
--

DROP TABLE IF EXISTS `tblLinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblLinks` (
  `id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `url` varchar(450) CHARACTER SET latin1 NOT NULL,
  `categoria` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Fk_tblLinks_tblCategoria` (`categoria`),
  CONSTRAINT `Fk_tblLinks_tblCategoria` FOREIGN KEY (`categoria`) REFERENCES `tblCategoria` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblLinks`
--

LOCK TABLES `tblLinks` WRITE;
/*!40000 ALTER TABLE `tblLinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblLinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPublicacion`
--

DROP TABLE IF EXISTS `tblPublicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPublicacion` (
  `idPublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePublicacion` varchar(500) CHARACTER SET latin1 NOT NULL,
  `docIdentidadPublicacion` varchar(10) CHARACTER SET latin1 NOT NULL,
  `descripcionPublicacion` varchar(10000) CHARACTER SET latin1 NOT NULL,
  `costoPublicacion` int(10) NOT NULL,
  `puntuacionPublicacion` int(10) DEFAULT NULL,
  `cantidadPublicacion` int(5) NOT NULL,
  `stockMinPublicacion` int(5) NOT NULL,
  `categoriaPublicacion` int(11) NOT NULL,
  `validacionPublicacion` tinyint(1) NOT NULL,
  `urlData` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idPublicacion`),
  KEY `Fk_tblPublicacion_tblusuario` (`docIdentidadPublicacion`),
  KEY `Fk_tblPublicacion_tblcategoria` (`categoriaPublicacion`),
  KEY `FK_tblPublicacion_tblLinks` (`urlData`),
  CONSTRAINT `FK_tblPublicacion_tblLinks` FOREIGN KEY (`urlData`) REFERENCES `tblLinks` (`id`),
  CONSTRAINT `Fk_tblPublicacion_tblcategoria` FOREIGN KEY (`categoriaPublicacion`) REFERENCES `tblCategoria` (`idCategoria`),
  CONSTRAINT `Fk_tblPublicacion_tblusuario` FOREIGN KEY (`docIdentidadPublicacion`) REFERENCES `tblUsuario` (`documentoIdentidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPublicacion`
--

LOCK TABLES `tblPublicacion` WRITE;
/*!40000 ALTER TABLE `tblPublicacion` DISABLE KEYS */;
INSERT INTO `tblPublicacion` (`idPublicacion`, `nombrePublicacion`, `docIdentidadPublicacion`, `descripcionPublicacion`, `costoPublicacion`, `puntuacionPublicacion`, `cantidadPublicacion`, `stockMinPublicacion`, `categoriaPublicacion`, `validacionPublicacion`, `urlData`) VALUES (1,'Computador portátil','1007382009','Un buen computador',2560000,NULL,233,50,9,1,NULL),(2,'Pedro','1007382009','Un buen computador',11123,NULL,45622,45,7,1,NULL);
/*!40000 ALTER TABLE `tblPublicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblRol`
--

DROP TABLE IF EXISTS `tblRol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(25) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblRol`
--

LOCK TABLES `tblRol` WRITE;
/*!40000 ALTER TABLE `tblRol` DISABLE KEYS */;
INSERT INTO `tblRol` (`idRol`, `nombreRol`) VALUES (1,'Comprador/Proveedor'),(2,'Empleado'),(3,'Administrador'),(4,'Comprador/proveedor');
/*!40000 ALTER TABLE `tblRol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUsuario`
--

DROP TABLE IF EXISTS `tblUsuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUsuario` (
  `documentoIdentidad` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nombresUsuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `apellidoUsuario` varchar(60) CHARACTER SET latin1 NOT NULL,
  `telefonomovilUsuario` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `emailUsuario` varchar(60) CHARACTER SET latin1 NOT NULL,
  `contrasenaUsuario` varchar(250) CHARACTER SET latin1 NOT NULL,
  `descripcionUsuario` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `estadoUsuario` tinyint(1) NOT NULL,
  `imagenUsuario` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`documentoIdentidad`),
  KEY `Fk_tblusuario_tblHash` (`contrasenaUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUsuario`
--

LOCK TABLES `tblUsuario` WRITE;
/*!40000 ALTER TABLE `tblUsuario` DISABLE KEYS */;
INSERT INTO `tblUsuario` (`documentoIdentidad`, `nombresUsuario`, `apellidoUsuario`, `telefonomovilUsuario`, `emailUsuario`, `contrasenaUsuario`, `descripcionUsuario`, `estadoUsuario`, `imagenUsuario`) VALUES ('1007382006','Santiago','Gómez Duque',NULL,'rubenduque276@gmail.com','6cd9b13688d09af0f851df94ccffaa47df22d73d',NULL,1,'https://lh3.googleusercontent.com/a-/AOh14GhVJx2hYoo5U6bZA8yWseu499HkggL0GKX4bjZ2=s96-c'),('1007382009','SANTIAGO','GOMEZ DUQUE',NULL,'sgomez9002@misena.edu.co','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,1,'https://lh3.googleusercontent.com/a-/AOh14Gi4drFhWu2c7UQSl1gk4wdHzfpon0GfQkt-4bv-=s96-c'),('1007382124','Wilinton','Castaño Cifuentes',NULL,'wilintonsw@gmail.com','8cb2237d0679ca88db6464eac60da96345513964',NULL,1,'imagenes/NO_borrar.png');
/*!40000 ALTER TABLE `tblUsuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUsuarioRol`
--

DROP TABLE IF EXISTS `tblUsuarioRol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUsuarioRol` (
  `idUsuarioRol` int(11) NOT NULL,
  `docIdentidadUsuarioRol` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idUsuarioRol`,`docIdentidadUsuarioRol`),
  KEY `Fk_tblUsuarioRol_tblUsuario` (`docIdentidadUsuarioRol`),
  KEY `idUsuarioRol` (`idUsuarioRol`),
  CONSTRAINT `FK_tblUsuarioRol_tblRol` FOREIGN KEY (`idUsuarioRol`) REFERENCES `tblRol` (`idRol`),
  CONSTRAINT `Fk_tblUsuarioRol_tblUsuario` FOREIGN KEY (`docIdentidadUsuarioRol`) REFERENCES `tblUsuario` (`documentoIdentidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUsuarioRol`
--

LOCK TABLES `tblUsuarioRol` WRITE;
/*!40000 ALTER TABLE `tblUsuarioRol` DISABLE KEYS */;
INSERT INTO `tblUsuarioRol` (`idUsuarioRol`, `docIdentidadUsuarioRol`) VALUES (1,'1007382006'),(1,'1007382009'),(1,'1007382124'),(3,'1007382009');
/*!40000 ALTER TABLE `tblUsuarioRol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'interori_interoriente'
--

--
-- Dumping routines for database 'interori_interoriente'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_activarPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_activarPublicacion`(IN `p_id` INT(11), IN `p_estado` TINYINT(1))
UPDATE tblPublicacion 
            SET validacionPublicacion = p_estado 
            WHERE idPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_activarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_activarUsuario`(IN `p_id` VARCHAR(10), IN `p_estado` TINYINT(1))
UPDATE tblUsuario 
            SET estadoUsuario = p_estado  
            WHERE documentoIdentidad = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_actualizarCarrito`(IN `p_cantidad` INT(11), IN `p_idPublicacion` INT(11), IN `p_idUsuario` VARCHAR(10))
UPDATE tblCarrito AS CA
SET CA.cantidadCarrito = p_cantidad
WHERE CA.idPublicacionCarrito = p_idPublicacion AND CA.docIdentidadCarrito = p_idUsuario ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizarCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_actualizarCuenta`(IN `p_celular` VARCHAR(20), IN `p_correo` VARCHAR(60), IN `p_archivo` VARCHAR(200), IN `p_id` VARCHAR(10))
UPDATE tblUsuario SET telefonomovilUsuario=p_celular,emailUsuario=p_correo,
                                imagenUsuario=p_archivo WHERE documentoIdentidad= p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizarDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_actualizarDireccion`(IN `p_nombre` VARCHAR(20), IN `p_direccion` VARCHAR(60), IN `p_ciudad` VARCHAR(6), IN `p_id` INT(11))
UPDATE tblDirecciones 
SET nombreDireccion = p_nombre,descripcionDireccion = p_direccion, 
ciudadDireccion = p_ciudad
WHERE idDireccion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizarExistencia` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_actualizarExistencia`(IN `p_id` INT(11), IN `p_cantidad` INT(10))
UPDATE tblPublicacion
        SET cantidadPublicacion = (cantidadPublicacion-$cantidad)
        WHERE idPublicacion =p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizarPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_actualizarPublicacion`(IN `p_nombre` VARCHAR(500), IN `p_descripcion` VARCHAR(10000), IN `p_costo` INT(10), IN `p_stock` INT(5), IN `p_id` INT(11))
UPDATE tblPublicacion 
            SET nombrePublicacion=p_nombre,descripcionPublicacion=p_descripcion,costoPublicacion=p_costo,cantidadPublicacion=p_stock 
            WHERE idPublicacion=p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_addCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_addCarrito`(IN `p_id` INT(11))
SELECT PU.idPublicacion as 'id', 
PU.nombrePublicacion as 'titulo', 
PU.costoPublicacion as 'costo', IMG.urlImagen AS 'img'
FROM tblPublicacion AS PU INNER JOIN tblImagenes AS IMG ON PU.idPublicacion = IMG.publicacionImagen
WHERE idPublicacion = (p_id)
GROUP BY PU.idPublicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_agregarDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_agregarDireccion`(IN `p_id` VARCHAR(10), IN `p_nombre` VARCHAR(20), IN `p_direccion` VARCHAR(70), IN `p_ciudad` VARCHAR(6))
INSERT INTO tblDirecciones
(docIdentidadDireccion,nombreDireccion,descripcionDireccion,ciudadDireccion) 
VALUES (p_id,p_nombre,p_direccion,p_ciudad) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_almacenarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_almacenarCarrito`(IN `p_id` INT(11), IN `p_documento` VARCHAR(10), IN `p_cantidad` INT(11))
INSERT INTO tblCarrito 
      (idPublicacionCarrito, docIdentidadCarrito, cantidadCarrito)
      VALUES(p_id, p_documento, p_cantidad) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_borrarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_borrarCarrito`(IN `p_id` INT(11), IN `p_documento` VARCHAR(10))
DELETE FROM tblCarrito 
WHERE idPublicacionCarrito = p_id
AND docIdentidadCarrito = p_documento ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_busquedaPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_busquedaPublicacion`(IN `p_keyword_t` VARCHAR(70), IN `p_keyword_d` VARCHAR(70))
    NO SQL
SELECT PU.nombrePublicacion AS 'Titulo', PU.idPublicacion AS 'Id', PU.costoPublicacion AS 'Precio', IMG.urlImagen AS 'Img' FROM tblPublicacion AS PU
INNER JOIN tblImagenes AS IMG 
ON PU.idPublicacion = IMG.publicacionImagen
WHERE PU.validacionPublicacion=1 and PU.nombrePublicacion REGEXP p_keyword_t OR PU.descripcionPublicacion REGEXP p_keyword_d 
GROUP BY PU.idPublicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_busquedas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_busquedas`(IN `p_keyword` VARCHAR(70))
SELECT PU.nombrePublicacion AS 'Titulo', PU.idPublicacion AS 'Id' FROM tblPublicacion AS PU
WHERE PU.nombrePublicacion REGEXP p_keyword and PU.validacionPublicacion=1 LIMIT 10 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_contadorStock` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_contadorStock`(IN `p_id` VARCHAR(10))
SELECT PU.nombrePublicacion, PU.cantidadPublicacion, PU.stockMinPublicacion
FROM tblPublicacion as PU
Where PU.cantidadPublicacion<=stockMinPublicacion  and PU.docIdentidadPublicacion=p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_contadorUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_contadorUsuarios`()
SELECT count(US.documentoIdentidad) as 'Contador'
from tblUsuario as US ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cuerpoFactura` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_cuerpoFactura`(IN `p_id` VARCHAR(10), IN `p_numero` INT(11))
SELECT PU.nombrePublicacion,PU.costoPublicacion,FP.cantidadFacturaPublicacion, FP.cantidadFacturaPublicacion*PU.costoPublicacion as pagar
      FROM tblFactura as FA
      INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numeroFactura
      INNER JOIN tblUsuario AS US ON FA.docIdentidadFactura=US.documentoIdentidad
      INNER JOIN tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
      WHERE US.documentoIdentidad=p_id AND FA.numeroFactura=p_numero
      ORDER BY PU.nombrePublicacion ASC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_desactivarPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_desactivarPublicacion`(IN `p_id` INT(11), IN `p_estado` TINYINT(1))
UPDATE tblPublicacion 
            SET validacionPublicacion = p_estado  
            WHERE idPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_desactivarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_desactivarUsuario`(IN `p_id` VARCHAR(10), IN `p_estado` TINYINT(1))
UPDATE tblUsuario 
            SET estadoUsuario = p_estado  
            WHERE documentoIdentidad = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminarDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_eliminarDireccion`(IN `p_id` INT(11))
DELETE FROM tblDirecciones WHERE idDireccion=p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminarImagenPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_eliminarImagenPublicacion`(IN `p_id` INT(11))
DELETE FROM tblImagenes 
            WHERE publicacionImagen = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminarPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_eliminarPublicacion`(IN `p_id` INT(11))
DELETE FROM tblPublicacion 
            WHERE idPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_encabezadoFactura` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_encabezadoFactura`(IN `p_id` VARCHAR(10), IN `p_numero` INT(11))
SELECT US.descripcionUsuario,FA.direccionFactura,
      FA.emailFactura,US.telefonoMovilUsuario,
      FA.numeroFactura,DATE_FORMAT(FA.fechaFactura, '%d/%m/%Y') as fecha, 
      DATE_FORMAT(FA.fechaFactura,'%H:%i:%s') as  hora,
      US.documentoIdentidad,concat(US.nombresUsuario,' ',US.apellidoUsuario) as Cliente 
      FROM tblUsuario AS US
      INNER JOIN tblFactura AS FA ON FA.docIdentidadFactura=US.documentoIdentidad
      WHERE US.documentoIdentidad=p_id AND FA.numeroFactura=p_numero ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_facturasCreadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_facturasCreadas`(IN `p_id` VARCHAR(10))
SELECT US.telefonoMovilUsuario as 'telefono',FA.numeroFactura,FA.fechaFactura,
      FA.direccionFactura,FA.emailFactura,COUNT(FP.numFacturaPublicacion) AS 'Contador',
      SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion)+(SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion)*0.19) AS 'Costo'
      FROM tblFactura as FA
      INNER JOIN tblFacturaPublicacion as FP
      ON FP.numFacturaPublicacion=FA.numeroFactura
      INNER JOIN tblPublicacion as PU
      ON PU.idPublicacion=FP.idPublicacionFactura
      INNER JOIN tblUsuario as US
      ON US.documentoIdentidad=PU.docIdentidadPublicacion
      WHERE FA.docIdentidadFactura=p_id
      GROUP BY FA.numeroFactura
      ORDER BY FA.numeroFactura DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_filtroPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_filtroPublicacion`(IN `p_catalogo` INT(11))
SELECT IM.urlImagen,PU.nombrePublicacion, PU.costoPublicacion,PU.descripcionPublicacion, PU.idPublicacion
FROM tblPublicacion as PU
INNER JOIN tblImagenes as IM 
ON IM.publicacionImagen=PU.idPublicacion
WHERE PU.categoriaPublicacion=p_catalogo
GROUP BY PU.idPublicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getCarrito`(IN `p_id` VARCHAR(10))
SELECT CA.idPublicacionCarrito AS id, CA.cantidadCarrito AS cantidad, PU.costoPublicacion AS costo FROM tblCarrito AS CA
INNER JOIN tblPublicacion AS PU
ON PU.idPublicacion = CA.idPublicacionCarrito
WHERE CA.docIdentidadCarrito = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getCheckoutInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getCheckoutInfo`(IN `p_id` VARCHAR(10))
SELECT PU.nombrePublicacion AS 'Titulo', 
      PU.costoPublicacion AS 'costo', 
      CA.cantidadCarrito AS 'cantidad',
      SUM(CA.cantidadCarrito * PU.costoPublicacion) AS 'subtotal', 
      (SUM(CA.cantidadCarrito * PU.costoPublicacion) * 0.19) AS 'iva', 
      (SUM(CA.cantidadCarrito * PU.costoPublicacion) + 
      (SUM(CA.cantidadCarrito * PU.costoPublicacion) * 0.19)) AS 'total'
      FROM tblPublicacion AS PU 
      INNER JOIN tblCarrito AS CA 
      ON PU.idPublicacion = CA.idPublicacionCarrito
      INNER JOIN tblUsuario AS US 
      ON CA.docIdentidadCarrito = 		US.documentoIdentidad
      WHERE CA.docIdentidadCarrito = p_id
      GROUP BY PU.idPublicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getCiudades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getCiudades`()
SELECT idCiudad,
            nombreCiudad 
            FROM tblCiudad ORDER BY nombreCiudad ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getDirecciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getDirecciones`(IN `p_id` INT(11))
SELECT 
              DI.idDireccion, 
              DI.nombreDireccion,
              DI.descripcionDireccion,
              CI.nombreCiudad,
              CI.idCiudad 
              FROM tblDirecciones as DI
              INNER JOIN tblCiudad as CI ON DI.ciudadDireccion = CI.idCiudad
              WHERE docIdentidadDireccion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getImgCheckoutInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getImgCheckoutInfo`(IN `p_id` INT(11))
Select IM.urlImagen
FROM tblImagenes as IM
Inner Join tblPublicacion as PU On PU.idPublicacion=IM.publicacionImagen
INNER JOin tblCarrito as CA On CA.idPublicacionCarrito=PU.idPublicacion
WHERE CA.docIdentidadCarrito = p_id
GROUP BY PU.idPublicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getPublicaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getPublicaciones`()
SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
PU.costoPublicacion
FROM tblPublicacion as PU
INNER JOIN tblImagenes as IMG 
ON PU.idPublicacion = IMG.publicacionImagen
WHERE PU.validacionPublicacion='1'
GROUP BY PU.idPublicacion
ORDER BY rand()
LIMIT 20 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getRoles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getRoles`(IN `p_id` VARCHAR(10))
SELECT RO.nombreRol, UR.idUsuarioRol
            FROM tblUsuarioRol AS UR
            INNER JOIN tblRol AS RO ON RO.idRol = UR.idUsuarioRol
            WHERE docIdentidadUsuarioRol = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getUserData` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getUserData`(IN `p_id` VARCHAR(10))
SELECT *
                FROM tblUsuario AS US
                INNER JOIN tblUsuarioRol AS UR 
                ON UR.docIdentidadUsuarioRol = US.documentoIdentidad
                WHERE US.documentoIdentidad = p_id AND US.estadoUsuario = '1' ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_getUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_getUsuarios`(IN `p_id` VARCHAR(10))
SELECT US.nombresUsuario,US.apellidoUsuario,US.documentoIdentidad,
US.telefonomovilUsuario,US.emailUsuario,
US.estadoUsuario
            FROM tblUsuario AS US
            WHERE documentoIdentidad <> p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_guardarRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_guardarRol`(IN `p_id_rol` INT(11), IN `p_id` VARCHAR(10))
INSERT INTO tblUsuarioRol 
(idUsuarioRol,docIdentidadUsuarioRol)VALUES (p_id_rol,p_id) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_imagenInsertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_imagenInsertar`(IN `p_url` VARCHAR(20000), IN `p_publicacion` INT(11))
INSERT INTO tblImagenes (urlImagen, publicacionImagen)
VALUES (p_url,p_publicacion) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_iniciarSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_iniciarSesion`(IN `p_id` VARCHAR(60), IN `p_contrasena` VARCHAR(250), IN `p_estado` TINYINT(1))
SELECT documentoIdentidad
FROM tblUsuario 
WHERE documentoIdentidad = p_id OR emailUsuario = p_id
AND contrasenaUsuario = p_contrasena AND estadoUsuario = p_estado ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insertarFactura` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_insertarFactura`(IN `p_id` VARCHAR(10), IN `p_direccion` VARCHAR(30), IN `p_correo` VARCHAR(60))
INSERT INTO tblFactura (docIdentidadFactura,fechaFactura,direccionFactura,emailFactura)
VALUES (p_id,CURRENT_TIMESTAMP,p_direccion,p_correo) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insertarFacturaPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_insertarFacturaPublicacion`(IN `p_numero` INT(11), IN `p_id` INT(11), IN `p_cantidad` INT(10))
INSERT INTO tblFacturaPublicacion
VALUES (p_numero, p_id, p_cantidad) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_loginGoogle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_loginGoogle`(IN `p_correo` VARCHAR(60))
SELECT US.documentoIdentidad,US.emailUsuario,UR.idUsuarioRol
FROM tblUsuario as US
INNER JOIN tblUsuarioRol as UR ON US.documentoIdentidad = UR.docIdentidadUsuarioRol
WHERE emailUsuario=p_correo ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarAdministradores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarAdministradores`()
Select US.documentoIdentidad,US.nombresUsuario,US.apellidoUsuario,US.telefonomovilUsuario,US.emailUsuario, US.estadoUsuario
From tblUsuario as US 
INNER JOIN tblUsuarioRol as UR ON US.documentoIdentidad=UR.docIdentidadUsuarioRol
WHERE US.documentoIdentidad<>123456789 and UR.idUsuarioRol=3
ORDER BY US.estadoUsuario DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarCategorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarCategorias`()
SELECT * 
            FROM tblCategoria 
            ORDER BY nombreCategoria ASC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarEstados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarEstados`()
SELECT * 
            FROM tblEstadoArticulo 
            ORDER BY nombreEstadoArticulo ASC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarIdCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarIdCarrito`(IN `p_id` VARCHAR(10))
SELECT idPublicacionCarrito as 'idPu',
cantidadCarrito as 'cantidad' 
FROM tblCarrito
WHERE docIdentidadCarrito = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarImgPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarImgPublicacion`(IN `p_id` INT(11))
SELECT IM.urlImagen
FROM tblImagenes as IM
INNER JOIN tblPublicacion as PU ON PU.idPublicacion=IM.publicacionImagen
WHERE PU.idPublicacion=p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarPublicacionesDashboard` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarPublicacionesDashboard`(IN `p_id` INT(11))
SELECT IMG.urlImagen, PU.idPublicacion,PU.nombrePublicacion, PU.costoPublicacion,PU.descripcionPublicacion,PU.cantidadPublicacion
FROM tblPublicacion as PU
INNER JOIN tblImagenes 
as IMG ON PU.idPublicacion = IMG.publicacionImagen
WHERE docIdentidadPublicacion = p_id
GROUP BY PU.idPublicacion
ORDER BY nombrePublicacion asc
Limit 30 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarPublicacionIndex` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarPublicacionIndex`(IN `p_id` INT(11))
    NO SQL
SELECT PU.idPublicacion,PU.cantidadPublicacion,US.telefonoMovilUsuario as 'telefono', PU.nombrePublicacion,PU.costoPublicacion,PU.descripcionPublicacion,US.nombresUsuario,US.descripcionUsuario,US.imagenUsuario
FROM tblPublicacion as PU
INNER JOIN tblUsuario as US
ON US.documentoIdentidad=PU.docIdentidadPublicacion
WHERE PU.idPublicacion=p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarTodasPublicaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarTodasPublicaciones`()
SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
            PU.costoPublicacion,PU.cantidadPublicacion,PU.validacionPublicacion
            FROM tblPublicacion as PU
            INNER JOIN tblImagenes as IMG 
            ON PU.idPublicacion = IMG.publicacionImagen
            GROUP BY PU.idPublicacion
HAVING validacionPublicacion=0
            ORDER BY nombrePublicacion ASC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mostrarUsuarioQueMasCompran` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_mostrarUsuarioQueMasCompran`()
select US.documentoIdentidad,US.nombresUsuario,US.apellidoUsuario, count(PU.idPublicacion) as 'Cantidad',SUM(FP.cantidadFacturaPublicacion*PU.costoPublicacion)+(SUM(FP.cantidadFacturaPublicacion*PU.costoPublicacion)*0.19) as 'Total'
From tblUsuario as US
Inner join tblFactura As FA ON FA.docIdentidadFactura=US.documentoIdentidad
Inner Join tblFacturaPublicacion as FP ON FP.numFacturaPublicacion=FA.numeroFactura
Inner Join tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
GROUP By US.documentoIdentidad
Order By Total desc
Limit 5 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_noValidadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_noValidadas`(IN `p_id` VARCHAR(10))
SELECT nombrePublicacion
FROM tblPublicacion 
WHERE validacionPublicacion = 0 AND docIdentidadPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_noValidadasAdmin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_noValidadasAdmin`()
SELECT nombrePublicacion
FROM tblPublicacion 
WHERE validacionPublicacion = 0 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_prueba` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_prueba`()
SELECT * FROM tblUsuarioRol ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_publicacionCrear` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_publicacionCrear`(IN `p_nombre` VARCHAR(500), IN `p_descripcion` VARCHAR(10000), IN `p_costo` INT(10), IN `p_cantidad` INT(5), IN `p_stock` INT(5), IN `p_categoria` INT(11), IN `p_documento` VARCHAR(10), IN `p_verificacion` TINYINT(1))
INSERT 
            INTO tblPublicacion 
            (nombrePublicacion,docIdentidadPublicacion,
            descripcionPublicacion,costoPublicacion,cantidadPublicacion,
            stockMinPublicacion,categoriaPublicacion,validacionPublicacion)
            VALUES (p_nombre,p_documento,p_descripcion,p_costo,p_cantidad,p_stock,p_categoria,p_verificacion) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_publicacionesExitosasFechas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_publicacionesExitosasFechas`(IN `p_id` VARCHAR(10), IN `p_fechaIni` DATE, IN `p_fechaFin` DATE)
SELECT PU.idPublicacion AS 'Id', PU.nombrePublicacion AS 'Titulo', 
SUM(FP.cantidadFacturaPublicacion) AS 'CantidadVentas', PU.cantidadPublicacion AS 'Cantidad', PU.stockMinPublicacion, 
SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS "VlrVentas" FROM tblPublicacion as PU 
INNER JOIN tblFacturaPublicacion as FP ON FP.idPublicacionFactura = PU.idPublicacion 
INNER JOIN tblFactura as FA ON FA.numeroFactura=FP.numFacturaPublicacion
WHERE PU.docIdentidadPublicacion = p_id 
AND FA.fechaFactura BETWEEN p_fechaIni
AND p_fechaFin GROUP BY PU.idPublicacion 
ORDER BY CantidadVentas DESC
LIMIT 5 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_publicacionesMasExitosas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_publicacionesMasExitosas`(IN `p_id` VARCHAR(10))
SELECT PU.idPublicacion AS 'Id', PU.nombrePublicacion AS 'Titulo', 
SUM(FP.cantidadFacturaPublicacion) AS 'CantidadVentas', 
PU.cantidadPublicacion AS 'Cantidad', PU.stockMinPublicacion, 
SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS "VlrVentas" 
FROM tblPublicacion as PU 
INNER JOIN tblFacturaPublicacion as FP 
ON FP.idPublicacionFactura = PU.idPublicacion 
WHERE PU.docIdentidadPublicacion = p_id 
GROUP BY PU.idPublicacion ORDER BY CantidadVentas DESC LIMIT 5 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_registrarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_registrarUsuario`(IN `p_id` VARCHAR(10), IN `p_nombre` VARCHAR(50), IN `p_apellido` VARCHAR(60), IN `p_correo` VARCHAR(60), IN `p_contrasena` VARCHAR(250), IN `p_estado` TINYINT(1), IN `p_imagen` VARCHAR(200))
INSERT INTO tblUsuario 
(documentoIdentidad,nombresUsuario, apellidoUsuario, 
emailUsuario,contrasenaUsuario,estadoUsuario,imagenUsuario)
VALUES (p_id,p_nombre,p_apellido,p_correo,p_contrasena,p_estado,p_imagen) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_rolUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_rolUsuario`(IN `p_id` VARCHAR(10))
SELECT idUsuarioRol 
FROM tblUsuarioRol 
WHERE docIdentidadUsuarioRol = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_totalGeneral` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_totalGeneral`(IN `p_id` VARCHAR(10))
SELECT SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
FROM tblPublicacion as PU
INNER JOIN tblFacturaPublicacion AS FP 
ON PU.idPublicacion = FP.idPublicacionFactura
WHERE PU.docIdentidadPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_totalGeneralFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_totalGeneralFecha`(IN `p_id` VARCHAR(10), IN `p_fechaIni` DATE, IN `p_fechaFin` DATE)
SELECT SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
FROM tblPublicacion as PU
INNER JOIN tblFacturaPublicacion AS FP
ON PU.idPublicacion = FP.idPublicacionFactura
INNER JOIN tblFactura as FA 
ON FA.numeroFactura=FP.numFacturaPublicacion

WHERE PU.docIdentidadPublicacion = p_id AND FA.fechaFactura BETWEEN p_fechaIni AND p_fechaFin ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_totalMensual` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_totalMensual`(IN `p_id` VARCHAR(10))
SELECT SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)+SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19 AS "Total" FROM tblFactura AS FA
INNER JOIN tblFacturaPublicacion AS FP
ON FP.numFacturaPublicacion = FA.numeroFactura
INNER JOIN tblPublicacion AS PU 
ON PU.idPublicacion = FP.idPublicacionFactura
WHERE MONTH(FA.fechaFactura) = MONTH(CURRENT_DATE) AND YEAR(FA.fechaFactura) = YEAR(CURRENT_DATE)
AND PU.docIdentidadPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_totalMensualAdmin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_totalMensualAdmin`()
SELECT round(SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)+SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19) AS "Total" FROM tblFactura AS FA
INNER JOIN tblFacturaPublicacion AS FP
ON FP.numFacturaPublicacion = FA.numeroFactura
INNER JOIN tblPublicacion AS PU 
ON PU.idPublicacion = FP.idPublicacionFactura
WHERE MONTH(FA.fechaFactura) = MONTH(CURRENT_DATE) AND YEAR(FA.fechaFactura) = YEAR(CURRENT_DATE) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_totalMesPasado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_totalMesPasado`(IN `p_id` VARCHAR(10))
SELECT SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)+SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19 AS "Total" 
FROM tblFactura AS FA 
INNER JOIN tblFacturaPublicacion AS FP 
ON FP.numFacturaPublicacion = FA.numeroFactura 
INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura 
WHERE MONTH(FA.fechaFactura) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH)) AND YEAR(FA.fechaFactura) = YEAR(CURRENT_DATE) AND PU.docIdentidadPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ultimoIdPublicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ultimoIdPublicacion`()
    NO SQL
SELECT MAX(idPublicacion)
FROM tblPublicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ultimoNumFactura` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ultimoNumFactura`()
SELECT MAX(numeroFactura) as 'numeroFactura'
FROM tblFactura ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_UsuariosQueMasCompranFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_UsuariosQueMasCompranFecha`(IN `p_fechaIni` DATE, IN `p_fechaFin` DATE)
select US.documentoIdentidad,US.nombresUsuario,US.apellidoUsuario, count(PU.idPublicacion) as 'Cantidad',SUM(FP.cantidadFacturaPublicacion*PU.costoPublicacion)+(SUM(FP.cantidadFacturaPublicacion*PU.costoPublicacion)*0.19) as 'Total'
From tblUsuario as US
Inner join tblFactura As FA ON FA.docIdentidadFactura=US.documentoIdentidad
Inner Join tblFacturaPublicacion as FP ON FP.numFacturaPublicacion=FA.numeroFactura
Inner Join tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
WHERE FA.fechaFactura BETWEEN p_fechaIni AND p_fechaFin
GROUP By US.documentoIdentidad
Order By Total desc
Limit 5 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_validacionCorreoDocumento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_validacionCorreoDocumento`(IN `p_correo` VARCHAR(60), IN `p_id` VARCHAR(10))
SELECT *
FROM tblUsuario 
WHERE emailUsuario = p_correo OR documentoIdentidad = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_validarDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_validarDireccion`(IN `p_id` VARCHAR(10))
SELECT DI.idDireccion as 'id', DI.nombreDireccion as 'nombreDireccion', 
      DI.descripcionDireccion as 'direccion', US.emailUsuario as 'correo'
      FROM tblDirecciones as DI INNER JOIN tblUsuario as US 
      ON US.documentoIdentidad = DI.docIdentidadDireccion
      WHERE DI.docIdentidadDireccion =p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ventasAnuales` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ventasAnuales`(IN `p_id` VARCHAR(10))
SELECT MONTH(FA.fechaFactura) AS 'Mes',SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion)+ROUND(SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19) AS 'Total' 
FROM tblFactura AS FA INNER JOIN tblFacturaPublicacion AS FP ON FP.numFacturaPublicacion = FA.numeroFactura INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura WHERE YEAR(FA.fechaFactura) = YEAR(CURDATE()) AND docIdentidadPublicacion = p_id GROUP BY MONTH(FA.fechaFactura) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ventasAnualesAdmin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ventasAnualesAdmin`()
SELECT MONTH(FA.fechaFactura) AS 'Mes',SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion)+ROUND(SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19) AS 'Total' 
FROM tblFactura AS FA INNER JOIN tblFacturaPublicacion AS FP ON FP.numFacturaPublicacion = FA.numeroFactura INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura WHERE YEAR(FA.fechaFactura) = YEAR(CURDATE()) 
GROUP BY MONTH(FA.fechaFactura) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ventasHoy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ventasHoy`(IN `p_id` VARCHAR(10))
SELECT COUNT(FP.idPublicacionFactura) 'No_ventas',SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)+SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19 AS 'Total' FROM tblFactura as FA INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numeroFactura INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura WHERE FA.fechaFactura = CURDATE() AND PU.docIdentidadPublicacion = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ventasHoyAdmin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ventasHoyAdmin`()
SELECT COUNT(FP.idPublicacionFactura) 'No_ventas',SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)+SUM(PU.costoPublicacion * FP.cantidadFacturaPublicacion)*0.19 AS 'Total' FROM tblFactura as FA INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numeroFactura INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura 
WHERE FA.fechaFactura = CURDATE() ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ventasPorDia` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ventasPorDia`(IN `p_id` VARCHAR(10))
SELECT DAY(FA.fechaFactura) as 'Dia', COUNT(FA.numeroFactura) as 'Total'
FROM tblFactura as FA
INNER JOIN tblFacturaPublicacion as FP
ON FP.numFacturaPublicacion=FA.numeroFactura
INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura 
WHERE FA.fechaFactura BETWEEN DATE_SUB(NOW(),INTERVAL 7 DAY) 
AND NOW() AND PU.docIdentidadPublicacion = p_id
GROUP BY DAY(FA.fechaFactura)
ORDER BY FA.fechaFactura ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ventasPorDiaAdmin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_ventasPorDiaAdmin`()
SELECT DAY(FA.fechaFactura) as 'Dia', COUNT(FA.numeroFactura) as 'Total'
FROM tblFactura as FA
INNER JOIN tblFacturaPublicacion as FP
ON FP.numFacturaPublicacion=FA.numeroFactura
INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura 
WHERE FA.fechaFactura BETWEEN DATE_SUB(NOW(),INTERVAL 7 DAY) 
AND NOW()
GROUP BY DAY(FA.fechaFactura)
ORDER BY FA.fechaFactura ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_verificarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_verificarCarrito`(IN `p_id` VARCHAR(10))
SELECT COUNT(CA.docIdentidadCarrito) AS Cantidad FROM tblCarrito AS CA
WHERE CA.docIdentidadCarrito = p_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_verificarCompra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `sp_verificarCompra`(IN `p_id` VARCHAR(10))
SELECT idPublicacionCarrito
FROM tblCarrito
WHERE docIdentidadCarrito = p_id ;;
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

-- Dump completed on 2022-08-03  8:36:42

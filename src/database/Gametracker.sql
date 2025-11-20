-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: gametracker
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `coleccion`
--

DROP TABLE IF EXISTS `coleccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coleccion` (
  `coleccion_id` int NOT NULL AUTO_INCREMENT,
  `coleccion_nombre` varchar(100) NOT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`coleccion_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `coleccion_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion`
--

LOCK TABLES `coleccion` WRITE;
/*!40000 ALTER TABLE `coleccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `coleccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleccion_juego`
--

DROP TABLE IF EXISTS `coleccion_juego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coleccion_juego` (
  `coleccion_id` int NOT NULL,
  `juego_id` int NOT NULL,
  PRIMARY KEY (`coleccion_id`,`juego_id`),
  KEY `juego_id` (`juego_id`),
  CONSTRAINT `coleccion_juego_ibfk_1` FOREIGN KEY (`coleccion_id`) REFERENCES `coleccion` (`coleccion_id`) ON DELETE CASCADE,
  CONSTRAINT `coleccion_juego_ibfk_2` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`juego_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion_juego`
--

LOCK TABLES `coleccion_juego` WRITE;
/*!40000 ALTER TABLE `coleccion_juego` DISABLE KEYS */;
/*!40000 ALTER TABLE `coleccion_juego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario` (
  `comen_id` int NOT NULL AUTO_INCREMENT,
  `juego_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `comen_descripcion` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comen_id`),
  KEY `juego_id` (`juego_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`juego_id`) ON DELETE CASCADE,
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editor`
--

DROP TABLE IF EXISTS `editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editor` (
  `editor_id` int NOT NULL AUTO_INCREMENT,
  `editor_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`editor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editor`
--

LOCK TABLES `editor` WRITE;
/*!40000 ALTER TABLE `editor` DISABLE KEYS */;
/*!40000 ALTER TABLE `editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero` (
  `gen_id` int NOT NULL AUTO_INCREMENT,
  `gen_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Acción'),(2,'Aventura'),(3,'RPG'),(4,'Shooter'),(5,'Estrategia'),(6,'Carreras'),(7,'Peleas'),(8,'Deportes'),(9,'Puzzle'),(10,'Terror'),(11,'Supervivencia'),(12,'Sandbox'),(13,'Metroidvania'),(14,'Roguelike'),(15,'MMORPG'),(16,'Simulación'),(17,'Battle Royale'),(18,'Plataformas'),(19,'RTS'),(20,'Táctico'),(21,'Stealth'),(22,'Mundo Abierto'),(23,'Hack and Slash'),(24,'Novela Visual');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `juego`
--

DROP TABLE IF EXISTS `juego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `juego` (
  `juego_id` int NOT NULL AUTO_INCREMENT,
  `juego_nombre` varchar(255) NOT NULL,
  `juego_descripcion` text NOT NULL,
  `juego_fecha_lanzamiento` date DEFAULT NULL,
  `plataf_id` int DEFAULT NULL,
  `gen_id` int DEFAULT NULL,
  `public_id` int DEFAULT NULL,
  `modjuego_id` int DEFAULT NULL,
  `persp_id` int DEFAULT NULL,
  `tema_id` int DEFAULT NULL,
  `cover_img_id` int DEFAULT NULL,
  PRIMARY KEY (`juego_id`),
  KEY `plataf_id` (`plataf_id`),
  KEY `gen_id` (`gen_id`),
  KEY `public_id` (`public_id`),
  KEY `modjuego_id` (`modjuego_id`),
  KEY `persp_id` (`persp_id`),
  KEY `tema_id` (`tema_id`),
  KEY `fk_cover_img` (`cover_img_id`),
  CONSTRAINT `fk_cover_img` FOREIGN KEY (`cover_img_id`) REFERENCES `juego_imagen` (`img_id`) ON DELETE SET NULL,
  CONSTRAINT `juego_ibfk_1` FOREIGN KEY (`plataf_id`) REFERENCES `plataforma` (`plataf_id`) ON DELETE SET NULL,
  CONSTRAINT `juego_ibfk_2` FOREIGN KEY (`gen_id`) REFERENCES `genero` (`gen_id`) ON DELETE SET NULL,
  CONSTRAINT `juego_ibfk_3` FOREIGN KEY (`public_id`) REFERENCES `publicador` (`public_id`) ON DELETE SET NULL,
  CONSTRAINT `juego_ibfk_4` FOREIGN KEY (`modjuego_id`) REFERENCES `modojuego` (`modjuego_id`) ON DELETE SET NULL,
  CONSTRAINT `juego_ibfk_5` FOREIGN KEY (`persp_id`) REFERENCES `perspectiva` (`persp_id`) ON DELETE SET NULL,
  CONSTRAINT `juego_ibfk_6` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`tema_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juego`
--

LOCK TABLES `juego` WRITE;
/*!40000 ALTER TABLE `juego` DISABLE KEYS */;
INSERT INTO `juego` VALUES (1,'Minecraft','Construye y explora mundos generados proceduralmente.','2011-11-18',1,17,NULL,1,1,6,NULL),(2,'Grand Theft Auto V','Mundo abierto criminal con historia y multiplayer.','2013-09-17',1,2,NULL,4,1,1,NULL),(3,'The Witcher 3: Wild Hunt','RPG de mundo abierto centrado en Geralt de Rivia.','2015-05-19',1,3,6,1,1,6,NULL),(4,'The Legend of Zelda: Breath of the Wild','Aventura épica en mundo abierto.','2017-03-03',15,2,NULL,1,1,1,NULL),(5,'Red Dead Redemption 2','Western narrativo en mundo abierto.','2018-10-26',1,2,NULL,1,1,4,NULL),(6,'God of War','Reinvento narrativo de Kratos en mitología nórdica.','2018-04-20',5,1,4,1,1,4,NULL),(7,'Fortnite','Battle royale, construcción y eventos live.','2017-07-21',1,16,NULL,4,1,2,NULL),(8,'Overwatch','Hero shooter por equipos.','2016-05-24',1,4,NULL,2,1,3,NULL),(9,'Apex Legends','Battle royale heroico, squads de 3.','2019-02-04',1,16,NULL,4,1,1,NULL),(10,'Call of Duty: Modern Warfare','Shooter militar moderno.','2019-10-25',1,4,NULL,4,1,4,NULL),(11,'Counter-Strike: Global Offensive','FPS competitivo por equipos.','2012-08-21',1,4,NULL,4,1,4,NULL),(12,'League of Legends','MOBA competitivo por equipos.','2009-10-27',1,22,NULL,4,1,2,NULL),(13,'Dota 2','MOBA competitivo de Valve.','2013-07-09',1,22,NULL,4,1,2,NULL),(14,'Among Us','Party social deduction.','2018-06-15',20,24,NULL,4,2,8,NULL),(15,'Cyberpunk 2077','RPG futurista en Night City.','2020-12-10',1,3,6,1,1,6,NULL),(16,'Horizon Zero Dawn','Acción-aventura con máquinas y mundo abierto.','2017-02-28',5,17,NULL,1,1,6,NULL),(17,'GTA IV','Open world narrativo de Vito/Cole.','2008-04-29',1,2,NULL,1,1,1,NULL),(18,'Skyrim','RPG épico en mundo abierto.','2011-11-11',1,3,NULL,1,1,6,NULL),(19,'Fall Guys','Party royale competitivo.','2020-08-04',1,24,NULL,4,2,24,NULL),(20,'Animal Crossing: New Horizons','Sim social y vida en isla.','2020-03-20',15,25,5,1,2,5,NULL),(21,'Stardew Valley','Simulación de granja y relaciones.','2016-02-26',1,5,5,1,3,5,NULL),(22,'Hades','Roguelike con narrativa y combate pulido.','2020-09-17',1,23,NULL,1,2,6,NULL),(23,'Celeste','Plataformas y narrativa introspectiva.','2018-01-25',1,6,3,1,2,3,NULL),(24,'Hollow Knight','Metroidvania exploratorio y desafiante.','2017-02-24',15,13,2,1,2,2,NULL),(25,'Undertale','RPG con decisiones morales y humor.','2015-09-15',1,19,8,1,2,8,NULL),(26,'Dark Souls III','RPG de acción desafiante.','2016-03-24',1,23,NULL,1,1,2,NULL),(27,'Dark Souls','RPG de acción - origen de la saga.','2011-09-22',1,23,NULL,1,1,2,NULL),(28,'Bloodborne','Acción gótica y lore críptico.','2015-03-24',5,12,NULL,1,1,2,NULL),(29,'Sekiro: Shadows Die Twice','Acción desafiante con enfoque en parry.','2019-03-22',5,1,NULL,1,1,2,NULL),(30,'Doom Eternal','FPS frenético y vertiginoso.','2020-03-20',1,4,NULL,1,1,2,NULL),(31,'Doom (2016)','Reboot del clásico shooter.','2016-05-13',1,4,NULL,1,1,2,NULL),(32,'Portal 2','Puzzles en un mundo de pruebas y humor.','2011-04-19',1,11,2,1,2,1,NULL),(33,'Portal','Puzzles con física y sarcasmo robótico.','2007-10-10',1,11,2,1,2,1,NULL),(34,'Half-Life 2','FPS narrativo clásico.','2004-11-16',1,4,2,1,1,4,NULL),(35,'Half-Life','Revolucionario FPS narrativo.','1998-11-19',1,4,2,1,1,4,NULL),(36,'Bioshock Infinite','Shooter narrativo con giro.','2013-03-26',1,12,NULL,1,2,6,NULL),(37,'Bioshock','FPS con ambientación art-deco y horror.','2007-08-21',1,12,NULL,1,2,6,NULL),(38,'Mass Effect 2','RPG espacial con decisiones.','2010-01-26',1,3,NULL,1,1,6,NULL),(39,'Mass Effect','RPG espacial épico.','2007-11-20',1,3,NULL,1,1,6,NULL),(40,'Resident Evil 2 (remake)','Survival horror moderno.','2019-01-25',1,12,NULL,1,2,12,NULL),(41,'Resident Evil 4','Survival horror y acción.','2005-01-11',3,12,NULL,1,1,12,NULL),(42,'Resident Evil 7','Survival horror en primera persona.','2017-01-24',1,12,NULL,1,1,12,NULL),(43,'Resident Evil Village','Continuación de RE7.','2021-05-07',1,12,NULL,1,1,12,NULL),(44,'Monster Hunter: World','Caza cooperativa y ecosistemas.','2018-01-26',1,7,NULL,2,1,6,NULL),(45,'Monster Hunter Rise','Caza con ritmo japonés.','2021-03-26',15,7,NULL,2,1,6,NULL),(46,'Persona 5','JRPG estilizado con stealth social.','2016-09-15',5,3,NULL,1,2,3,NULL),(47,'Persona 4 Golden','JRPG con parte social y misterio.','2012-06-14',17,3,NULL,1,2,3,NULL),(48,'Nier: Automata','Acción-RPG filosófico y robótico.','2017-03-07',1,3,NULL,1,1,6,NULL),(49,'Metal Gear Solid V: The Phantom Pain','Sigilo y mundo abierto.','2015-09-01',1,21,NULL,1,1,4,NULL),(50,'Metal Gear Solid 3: Snake Eater','Sigilo con trama política.','2004-11-17',2,21,NULL,1,1,4,NULL),(51,'Journey','Aventura emocional en desierto.','2012-03-13',22,25,NULL,1,2,1,NULL),(52,'The Last of Us','Aventura narrativa postapocalíptica.','2013-06-14',5,12,NULL,1,1,4,NULL),(53,'The Last of Us Part II','Secuela con debate y mecánicas pulidas.','2020-06-19',5,12,NULL,1,1,4,NULL),(54,'Uncharted 4','Aventura acción cinematográfica.','2016-05-10',5,2,NULL,1,1,4,NULL),(55,'Uncharted 2','Aventura acción clásica.','2009-10-13',2,2,NULL,1,1,4,NULL),(56,'Shadow of the Colossus','Exploración y combate contra gigantes.','2005-10-18',11,2,NULL,1,2,2,NULL),(57,'Spelunky 2','Roguelike plataformas de precisión.','2020-09-15',1,23,NULL,1,2,23,NULL),(58,'Spelunky','Plataformas roguelike original.','2008-12-21',1,23,NULL,1,2,23,NULL),(59,'Terraria','Sandbox 2D con exploración y construcción.','2011-05-16',1,25,NULL,2,2,5,NULL),(60,'DOOM (1993)','Clásico FPS arcade.','1993-12-10',1,4,NULL,1,1,2,NULL),(61,'Baldur\'s Gate 3','RPG moderno con profundidad narrativa.','2023-08-03',1,3,NULL,1,2,6,NULL),(62,'Divinity: Original Sin 2','RPG táctico con co-op.','2017-09-14',1,3,NULL,2,2,6,NULL),(63,'Disco Elysium','RPG narrativo con enfoque en diálogo.','2019-10-15',1,25,NULL,1,2,6,NULL),(64,'NieR Replicant ver.1.22474487139','Remake emocional del JRPG.','2021-04-23',1,3,NULL,1,2,6,NULL),(65,'Prince of Persia: Sands of Time','Aventura plataforma y puzzles.','2003-11-04',2,2,NULL,1,2,4,NULL),(66,'Portal Knights','Action-RPG sandbox cooperativo.','2017-05-18',1,25,NULL,2,2,5,NULL),(67,'Little Nightmares','Plataformas/terror con estética.','2017-04-28',1,12,NULL,1,2,12,NULL),(68,'Little Nightmares II','Secuela con diseño atmosférico.','2021-02-11',1,12,NULL,1,2,12,NULL),(69,'Dead Cells','Roguelite acción con combate fluido.','2018-08-07',1,23,NULL,1,2,23,NULL),(70,'Slay the Spire','Deckbuilder roguelite.','2017-01-23',1,23,NULL,1,3,23,NULL),(71,'FTL: Faster Than Light','Sim táctico espacial roguelike.','2012-09-14',1,23,NULL,1,3,23,NULL),(72,'Papers, Please','Sim de inspector de fronteras.','2013-08-08',22,26,NULL,1,2,8,NULL),(73,'The Sims 4','Simulación social y construcción.','2014-09-02',1,25,NULL,1,2,5,NULL),(74,'The Sims 3','Simulación social y expansión.','2009-06-02',1,25,NULL,1,2,5,NULL),(75,'The Sims 2','Sim clásico con genealogías.','2004-09-14',1,25,NULL,1,2,5,NULL),(76,'Age of Empires II','RTS histórico y competitivo.','1999-09-30',1,8,NULL,4,3,7,NULL),(77,'Civilization VI','Turn-based strategy grand strategy.','2016-10-21',1,8,NULL,1,3,7,NULL),(78,'Civilization V','Estrategia por turnos clásica moderna.','2010-09-21',1,8,NULL,1,3,7,NULL),(79,'XCOM 2','Tactics por turnos con gestión.','2016-02-05',1,8,NULL,1,3,7,NULL),(80,'XCOM: Enemy Unknown','Turnos y estrategia moderna.','2012-10-09',1,8,NULL,1,3,7,NULL),(81,'Fallout 4','RPG postapocalíptico con crafting.','2015-11-10',1,3,NULL,1,1,6,NULL),(82,'Fallout: New Vegas','RPG con decisiones morales fuertes.','2010-10-19',1,3,NULL,1,1,6,NULL),(83,'Fallout 3','RPG postapocalíptico clásico.','2008-10-28',1,3,NULL,1,1,6,NULL),(84,'Metro Exodus','Shooter atmosférico y supervivencia.','2019-02-15',1,4,NULL,1,1,2,NULL),(85,'Metro 2033','FPS postapocalíptico con horror.','2010-03-16',1,4,NULL,1,1,2,NULL),(86,'The Outer Worlds','RPG espacial con sátira.','2019-10-25',1,3,NULL,1,1,6,NULL),(87,'No Man\'s Sky','Exploración espacial procedural.','2016-08-09',1,17,NULL,2,1,5,NULL),(88,'Sea of Thieves','Aventura cooperativa pirata.','2018-03-20',1,2,NULL,2,2,5,NULL),(89,'Subnautica','Exploración submarina y supervivencia.','2018-01-23',1,7,NULL,1,2,5,NULL),(90,'Kerbal Space Program','Sim construcción espacial y física.','2015-04-27',1,7,NULL,1,3,7,NULL),(91,'StarCraft II','RTS competitivo sci-fi.','2010-07-27',1,22,NULL,4,3,7,NULL),(92,'StarCraft','RTS clásico sci-fi.','1998-03-31',1,22,NULL,4,3,7,NULL),(93,'Diablo III','Action RPG loot-driven.','2012-05-15',1,4,NULL,1,1,4,NULL),(94,'Diablo II','Clásico ARPG con runes y loot.','2000-06-29',1,4,NULL,1,1,4,NULL),(95,'Path of Exile','ARPG free-to-play con profundidad.','2013-10-23',1,23,NULL,4,1,23,NULL),(96,'Runescape','MMO clásico con economía y quests.','2001-01-04',25,22,NULL,4,1,23,NULL),(97,'Elden Ring','RPG de mundo abierto y lore.','2022-02-25',1,23,NULL,1,1,6,NULL),(98,'Dark Souls II','Secuela del RPG desafiante.','2014-03-11',1,23,NULL,1,1,2,NULL),(99,'Dragon Age: Inquisition','RPG con toma de decisiones.','2014-11-18',1,3,NULL,1,1,6,NULL),(100,'Dragon Age: Origins','RPG clásico de BioWare.','2009-11-03',1,3,NULL,1,1,6,NULL),(101,'The Binding of Isaac','Roguelike shooter con ítems.','2011-09-27',1,23,NULL,1,2,23,NULL),(102,'The Binding of Isaac: Rebirth','Revisión del roguelike con contenido.','2014-11-04',1,23,NULL,1,2,23,NULL),(103,'Cuphead','Run & gun retro con arte clásico.','2017-09-29',1,23,7,1,2,7,NULL),(104,'Ori and the Blind Forest','Plataformas emotivas y exploración.','2015-03-11',1,13,NULL,1,2,6,NULL),(105,'Ori and the Will of the Wisps','Secuela con combate refinado.','2020-03-11',1,13,NULL,1,2,6,NULL),(106,'Rocket League','Fútbol con autos y físicas arcade.','2015-07-07',1,9,NULL,2,2,9,NULL),(107,'Trials Rising','Carreras de trial stunt.','2019-02-26',1,10,NULL,2,2,9,NULL),(108,'Forza Horizon 4','Open world racing UK seasons.','2018-10-02',9,10,NULL,1,2,9,NULL),(109,'Forza Horizon 5','Open world racing Mexico.','2021-11-09',10,10,NULL,1,2,9,NULL),(110,'Gran Turismo 7','Sim racing tradicional.','2022-03-04',6,10,NULL,1,2,9,NULL),(111,'FIFA 21','Fútbol sim anual.','2020-10-09',1,9,NULL,4,1,9,NULL),(112,'FIFA 22','Fútbol sim con mejoras.','2021-10-01',1,9,NULL,4,1,9,NULL),(113,'Madden NFL 22','Fútbol americano anual.','2021-08-20',1,9,NULL,4,1,9,NULL),(114,'NBA 2K21','Basket sim anual.','2020-09-04',1,9,NULL,4,1,9,NULL),(115,'Persona 3 Portable','JRPG con componente social.','2009-11-01',16,3,NULL,1,2,3,NULL),(116,'Fire Emblem: Three Houses','Tactics + life sim.','2019-07-26',15,22,NULL,1,2,3,NULL),(117,'Animal Crossing: New Leaf','Sim de vida en pueblo.','2012-11-08',17,25,NULL,5,2,5,NULL),(118,'Mario Kart 8 Deluxe','Arcade racing family-party.','2017-04-28',15,10,NULL,5,2,9,NULL),(119,'Super Mario Odyssey','Plataformas 3D creativo.','2017-10-27',15,6,NULL,1,2,1,NULL),(120,'Super Mario Galaxy','Plataformas 3D espacial.','2007-11-12',13,6,NULL,1,2,1,NULL),(121,'Super Mario 64','Plataformas 3D pionero.','1996-06-23',11,6,NULL,1,2,1,NULL),(122,'Super Smash Bros. Ultimate','Fighting party con roster enorme.','2018-12-07',15,20,NULL,5,2,4,NULL),(123,'Street Fighter V','Fighting competitivo.','2016-02-16',1,20,NULL,4,2,4,NULL),(124,'Mortal Kombat 11','Fighting oscuro y cinematográfico.','2019-04-23',1,20,NULL,4,2,4,NULL),(125,'Tekken 7','Fighting técnico y competitivo.','2017-06-02',1,20,NULL,4,2,4,NULL),(126,'SoulCalibur VI','Fighting con armas.','2018-10-18',1,20,NULL,4,2,4,NULL),(127,'Splatoon 2','Shooter familiar y colorido.','2017-07-21',15,5,NULL,2,2,5,NULL),(128,'Metroid Dread','Metroid clásico con ritmo.','2021-10-08',15,13,NULL,1,2,2,NULL),(129,'Metroid Prime Remastered','Remaster del clásico FPS aventura.','2023-02-08',15,13,NULL,1,2,2,NULL),(130,'Ratchet & Clank: Rift Apart','Plataformas/acción con raytracing.','2021-06-11',6,2,NULL,1,2,1,NULL),(131,'Dishonored 2','Stealth + poderes en mundo abierto.','2016-11-11',1,21,NULL,1,2,4,NULL),(132,'Dishonored','Stealth y poderes en ciudad.','2012-10-09',1,21,NULL,1,2,4,NULL),(133,'Bioshock 2','FPS con ambientación y narrativa.','2010-02-09',1,12,NULL,1,2,6,NULL),(134,'The Last Guardian','Aventura puzzle con criatura gigante.','2016-12-06',5,2,NULL,1,2,1,NULL),(135,'Journey to the Savage Planet','Aventura colorida y humor.','2020-01-28',1,25,NULL,2,2,5,NULL),(136,'Sifu','Beat em up con enfoque en artes marciales.','2022-02-08',1,20,NULL,1,2,4,NULL),(137,'Returnal','Roguelike shooter atmosférico.','2021-04-30',6,23,NULL,1,1,23,NULL),(138,'Ghost of Tsushima','Aventura samurái cinematográfica.','2020-07-17',5,2,NULL,1,1,4,NULL),(139,'Tony Hawk\'s Pro Skater 1+2','Remake skate con nostalgia.','2020-09-04',1,9,NULL,1,2,9,NULL),(140,'Hotline Miami','Top-down action ultra rápido.','2012-10-23',1,23,NULL,1,2,23,NULL),(141,'Hotline Miami 2','Secuela estilo ultra violenta.','2015-03-10',1,23,NULL,1,2,23,NULL),(142,'Dead Space (2008)','Survival horror espacial.','2008-10-13',1,12,NULL,1,2,12,NULL),(143,'Dead Space 2','Survival horror con más acción.','2011-01-25',1,12,NULL,1,2,12,NULL),(144,'Amnesia: The Dark Descent','Horror psicológico en primera persona.','2010-09-08',1,12,NULL,1,2,12,NULL),(145,'Outlast','Survival horror en asilo.','2013-09-04',1,12,NULL,1,2,12,NULL),(146,'Phasmophobia','Horror cooperativo investigativo.','2020-09-18',20,12,NULL,2,2,12,NULL),(147,'The Forest','Supervivencia con horror y crafting.','2014-04-30',1,7,NULL,2,2,5,NULL),(148,'Green Hell','Supervivencia realista en selva.','2019-09-28',1,7,NULL,1,2,5,NULL),(149,'Rust','Supervivencia multiplayer y crafting.','2013-12-11',1,7,NULL,2,2,5,NULL),(150,'ARK: Survival Evolved','Supervivencia vs dinosaurios.','2017-08-29',1,7,NULL,2,2,5,NULL),(151,'Left 4 Dead 2','Co-op zombie shooter.','2009-11-17',1,12,NULL,2,2,12,NULL),(152,'Left 4 Dead','Co-op zombie campaign.','2008-11-17',1,12,NULL,2,2,12,NULL),(153,'Team Fortress 2','Class-based multiplayer shooter.','2007-10-10',1,22,NULL,2,2,2,NULL),(154,'Paladins','Hero shooter free-to-play.','2016-05-08',1,2,NULL,2,2,2,NULL),(155,'Gears 5','Shooter TPS con campaña.','2019-09-10',9,4,NULL,2,1,4,NULL),(156,'Gears of War 4','TPS con horda y campaña.','2016-10-11',9,4,NULL,2,1,4,NULL),(157,'Watch Dogs 2','Open world hacking and humor.','2016-11-29',1,2,NULL,1,2,4,NULL),(158,'Watch Dogs: Legion','Hacking con múltiples personajes.','2020-10-29',1,2,NULL,1,2,4,NULL),(159,'Dishonored: Death of the Outsider','Standalone stealth expansion.','2017-09-15',1,21,NULL,1,2,4,NULL),(160,'The Witness','Puzzles island con filosofía.','2016-01-26',1,11,NULL,1,2,1,NULL),(161,'The Talos Principle','Puzzles filosóficos y narrativa.','2014-12-11',1,11,NULL,1,2,1,NULL);
/*!40000 ALTER TABLE `juego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `juego_imagen`
--

DROP TABLE IF EXISTS `juego_imagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `juego_imagen` (
  `img_id` int NOT NULL AUTO_INCREMENT,
  `juego_id` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `alt_text` varchar(100) DEFAULT NULL,
  `is_cover` tinyint(1) DEFAULT '0',
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`img_id`),
  KEY `juego_id` (`juego_id`),
  CONSTRAINT `juego_imagen_ibfk_1` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`juego_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juego_imagen`
--

LOCK TABLES `juego_imagen` WRITE;
/*!40000 ALTER TABLE `juego_imagen` DISABLE KEYS */;
INSERT INTO `juego_imagen` VALUES (1,1,'https://images.igdb.com/igdb/image/upload/t_cover_big/co8fu7.webp','Portada del juego 1',1,'2025-11-19 22:13:16'),(2,2,'https://images.igdb.com/igdb/image/upload/t_cover_big/co9751.webp','Portada del juego 2',1,'2025-11-19 22:13:16'),(3,3,'https://images.igdb.com/igdb/image/upload/t_cover_big/coaarl.webp','Portada del juego 3',1,'2025-11-19 22:13:16'),(4,4,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3p2d.png','Portada del juego 4',1,'2025-11-19 22:13:16'),(5,5,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1q1f.png','Portada del juego 5',1,'2025-11-19 22:13:16'),(6,6,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3ddb.png','Portada del juego 6',1,'2025-11-19 22:13:16'),(7,7,'https://images.igdb.com/igdb/image/upload/t_cover_small/co5ztm.png','Portada del juego 7',1,'2025-11-19 22:13:16'),(8,8,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rcb.png','Portada del juego 8',1,'2025-11-19 22:13:16'),(9,9,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2z99.png','Portada del juego 9',1,'2025-11-19 22:13:16'),(10,10,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rsg.png','Portada del juego 10',1,'2025-11-19 22:13:16'),(11,11,'https://images.igdb.com/igdb/image/upload/t_cover_small/coa5ab.png','Portada del juego 11',1,'2025-11-19 22:13:16'),(12,12,'https://images.igdb.com/igdb/image/upload/t_cover_small/coabh7.png','Portada del juego 12',1,'2025-11-19 22:13:16'),(13,13,'https://images.igdb.com/igdb/image/upload/t_cover_small/co6ene.png','Portada del juego 13',1,'2025-11-19 22:13:16'),(14,14,'https://images.igdb.com/igdb/image/upload/t_cover_small/co6kqt.png','Portada del juego 14',1,'2025-11-19 22:13:16'),(15,15,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaih8.png','Portada del juego 15',1,'2025-11-19 22:13:16'),(16,16,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2una.png','Portada del juego 16',1,'2025-11-19 22:13:16'),(17,17,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2lbv.png','Portada del juego 17',1,'2025-11-19 22:13:16'),(18,18,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1tnw.png','Portada del juego 18',1,'2025-11-19 22:13:16'),(19,19,'https://images.igdb.com/igdb/image/upload/t_cover_small/coa7cs.png','Portada del juego 19',1,'2025-11-19 22:13:16'),(20,20,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3wls.png','Portada del juego 20',1,'2025-11-19 22:13:16'),(21,21,'https://images.igdb.com/igdb/image/upload/t_cover_small/coa93h.png','Portada del juego 21',1,'2025-11-19 22:13:16'),(22,22,'https://images.igdb.com/igdb/image/upload/t_cover_small/co4rs3.png','Portada del juego 22',1,'2025-11-19 22:13:16'),(23,23,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3byy.png','Portada del juego 23',1,'2025-11-19 22:13:16'),(24,24,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaes9.png','Portada del juego 24',1,'2025-11-19 22:13:16'),(25,25,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2855.png','Portada del juego 25',1,'2025-11-19 22:13:16'),(26,26,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaavt.png','Portada del juego 26',1,'2025-11-19 22:13:16'),(27,27,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1x78.png','Portada del juego 27',1,'2025-11-19 22:13:16'),(28,28,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rba.png','Portada del juego 28',1,'2025-11-19 22:13:16'),(29,29,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2a23.png','Portada del juego 29',1,'2025-11-19 22:13:16'),(30,30,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3p5n.png','Portada del juego 30',1,'2025-11-19 22:13:16'),(31,31,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1nc7.png','Portada del juego 31',1,'2025-11-19 22:13:16'),(32,32,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rs4.png','Portada del juego 32',1,'2025-11-19 22:13:16'),(33,33,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1x7d.png','Portada del juego 33',1,'2025-11-19 22:13:16'),(34,34,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1nmw.png','Portada del juego 34',1,'2025-11-19 22:13:16'),(35,35,'https://images.igdb.com/igdb/image/upload/t_cover_small/co7zzj.png','Portada del juego 35',1,'2025-11-19 22:13:16'),(36,36,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2n12.png','Portada del juego 36',1,'2025-11-19 22:13:16'),(37,37,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2mli.png','Portada del juego 37',1,'2025-11-19 22:13:16'),(38,38,'https://images.igdb.com/igdb/image/upload/t_cover_small/co20ac.png','Portada del juego 38',1,'2025-11-19 22:13:16'),(39,39,'https://images.igdb.com/igdb/image/upload/t_cover_small/co7c1f.png','Portada del juego 39',1,'2025-11-19 22:13:16'),(40,40,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1ir3.png','Portada del juego 40',1,'2025-11-19 22:13:16'),(41,41,'https://images.igdb.com/igdb/image/upload/t_cover_small/co6bo0.png','Portada del juego 41',1,'2025-11-19 22:13:16'),(42,42,'https://images.igdb.com/igdb/image/upload/t_cover_small/co8uu1.png','Portada del juego 42',1,'2025-11-19 22:13:16'),(43,43,'https://images.igdb.com/igdb/image/upload/t_cover_small/coab9q.png','Portada del juego 43',1,'2025-11-19 22:13:16'),(44,44,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rst.png','Portada del juego 44',1,'2025-11-19 22:13:16'),(45,45,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3uzk.png','Portada del juego 45',1,'2025-11-19 22:13:16'),(46,46,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1r76.png','Portada del juego 46',1,'2025-11-19 22:13:16'),(47,47,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1n1x.png','Portada del juego 47',1,'2025-11-19 22:13:16'),(48,48,'https://images.igdb.com/igdb/image/upload/t_cover_small/co5pcj.png','Portada del juego 48',1,'2025-11-19 22:13:16'),(49,49,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1v85.png','Portada del juego 49',1,'2025-11-19 22:13:16'),(50,50,'https://images.igdb.com/igdb/image/upload/t_cover_small/co5ei5.png','Portada del juego 50',1,'2025-11-19 22:13:16'),(51,51,'https://images.igdb.com/igdb/image/upload/t_cover_small/co8oq0.png','Portada del juego 51',1,'2025-11-19 22:13:51'),(52,52,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1r7f.png','Portada del juego 52',1,'2025-11-19 22:13:51'),(53,53,'https://images.igdb.com/igdb/image/upload/t_cover_small/co5ziw.png','Portada del juego 53',1,'2025-11-19 22:13:51'),(54,54,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1r7h.png','Portada del juego 54',1,'2025-11-19 22:13:51'),(55,55,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1tnb.png','Portada del juego 55',1,'2025-11-19 22:13:51'),(56,56,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2ijk.png','Portada del juego 56',1,'2025-11-19 22:13:51'),(57,57,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2f66.png','Portada del juego 57',1,'2025-11-19 22:13:51'),(58,58,'https://images.igdb.com/igdb/image/upload/t_cover_small/co47m4.png','Portada del juego 58',1,'2025-11-19 22:13:51'),(59,59,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaamg.png','Portada del juego 59',1,'2025-11-19 22:13:51'),(60,60,'https://images.igdb.com/igdb/image/upload/t_cover_small/co6vy5.png','Portada del juego 60',1,'2025-11-19 22:13:51'),(61,61,'https://images.igdb.com/igdb/image/upload/t_cover_small/co670h.png','Portada del juego 61',1,'2025-11-19 22:13:51'),(62,62,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1y5v.png','Portada del juego 62',1,'2025-11-19 22:13:51'),(63,63,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2ip6.png','Portada del juego 63',1,'2025-11-19 22:13:51'),(64,64,'https://images.igdb.com/igdb/image/upload/t_cover_small/co5h0n.png','Portada del juego 64',1,'2025-11-19 22:13:51'),(65,65,'https://images.igdb.com/igdb/image/upload/t_cover_small/co4t8l.png','Portada del juego 65',1,'2025-11-19 22:13:51'),(66,66,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2jjh.png','Portada del juego 66',1,'2025-11-19 22:13:51'),(67,67,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rdi.png','Portada del juego 67',1,'2025-11-19 22:13:51'),(68,68,'https://images.igdb.com/igdb/image/upload/t_cover_small/coa17l.png','Portada del juego 68',1,'2025-11-19 22:13:51'),(69,69,'https://images.igdb.com/igdb/image/upload/t_cover_small/co7jfv.png','Portada del juego 69',1,'2025-11-19 22:13:51'),(70,70,'https://images.igdb.com/igdb/image/upload/t_cover_small/co82c5.png','Portada del juego 70',1,'2025-11-19 22:13:51'),(71,71,'https://images.igdb.com/igdb/image/upload/t_cover_small/co9chw.png','Portada del juego 71',1,'2025-11-19 22:13:51'),(72,72,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1vep.png','Portada del juego 72',1,'2025-11-19 22:13:51'),(73,73,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3h3l.png','Portada del juego 73',1,'2025-11-19 22:13:51'),(74,74,'https://images.igdb.com/igdb/image/upload/t_cover_small/co99qs.png','Portada del juego 74',1,'2025-11-19 22:13:51'),(75,75,'https://images.igdb.com/igdb/image/upload/t_cover_small/co8j4e.png','Portada del juego 75',1,'2025-11-19 22:13:51'),(76,76,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1xy6.png','Portada del juego 76',1,'2025-11-19 22:13:51'),(77,77,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaaqr.png','Portada del juego 77',1,'2025-11-19 22:13:51'),(78,78,'https://images.igdb.com/igdb/image/upload/t_cover_small/co20up.png','Portada del juego 78',1,'2025-11-19 22:13:51'),(79,79,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1mvj.png','Portada del juego 79',1,'2025-11-19 22:13:51'),(80,80,'https://images.igdb.com/igdb/image/upload/t_cover_small/co29i2.png','Portada del juego 80',1,'2025-11-19 22:13:51'),(81,81,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1yc6.png','Portada del juego 81',1,'2025-11-19 22:13:51'),(82,82,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1u60.png','Portada del juego 82',1,'2025-11-19 22:13:51'),(83,83,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1ycw.png','Portada del juego 83',1,'2025-11-19 22:13:51'),(84,84,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaroh.png','Portada del juego 84',1,'2025-11-19 22:13:51'),(85,85,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1rd6.png','Portada del juego 85',1,'2025-11-19 22:13:51'),(86,86,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2eew.png','Portada del juego 86',1,'2025-11-19 22:13:51'),(87,87,'https://images.igdb.com/igdb/image/upload/t_cover_small/co8j4g.png','Portada del juego 87',1,'2025-11-19 22:13:51'),(88,88,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2558.png','Portada del juego 88',1,'2025-11-19 22:13:51'),(89,89,'https://images.igdb.com/igdb/image/upload/t_cover_small/coa938.png','Portada del juego 89',1,'2025-11-19 22:13:51'),(90,90,'https://images.igdb.com/igdb/image/upload/t_cover_small/co26n5.png','Portada del juego 90',1,'2025-11-19 22:13:51'),(91,91,'https://images.igdb.com/igdb/image/upload/t_cover_small/co49zh.png','Portada del juego 91',1,'2025-11-19 22:13:51'),(92,92,'https://images.igdb.com/igdb/image/upload/t_cover_big/co9n6m.webp','Portada del juego 92',1,'2025-11-19 22:13:51'),(93,93,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2l1u.png','Portada del juego 93',1,'2025-11-19 22:13:51'),(94,94,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3gfq.png','Portada del juego 94',1,'2025-11-19 22:13:51'),(95,95,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1n6w.png','Portada del juego 95',1,'2025-11-19 22:13:51'),(96,96,'https://images.igdb.com/igdb/image/upload/t_cover_small/co68u4.png','Portada del juego 96',1,'2025-11-19 22:13:51'),(97,97,'https://images.igdb.com/igdb/image/upload/t_cover_small/co4jni.png','Portada del juego 97',1,'2025-11-19 22:13:51'),(98,98,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2eoo.png','Portada del juego 98',1,'2025-11-19 22:13:51'),(99,99,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2mvy.png','Portada del juego 99',1,'2025-11-19 22:13:51'),(100,100,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2mvs.png','Portada del juego 100',1,'2025-11-19 22:13:51'),(101,101,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2558.png','Portada del juego 101',1,'2025-11-19 22:14:52'),(102,102,'https://images.igdb.com/igdb/image/upload/t_cover_small/coa938.png','Portada del juego 102',1,'2025-11-19 22:14:52'),(103,103,'https://images.igdb.com/igdb/image/upload/t_cover_small/co26n5.png','Portada del juego 103',1,'2025-11-19 22:14:52'),(104,104,'https://images.igdb.com/igdb/image/upload/t_cover_small/co49zh.png','Portada del juego 104',1,'2025-11-19 22:14:52'),(105,105,'https://images.igdb.com/igdb/image/upload/t_cover_big/co9n6m.webp','Portada del juego 105',1,'2025-11-19 22:14:52'),(106,106,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2l1u.png','Portada del juego 106',1,'2025-11-19 22:14:52'),(107,107,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3gfq.png','Portada del juego 107',1,'2025-11-19 22:14:52'),(108,108,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1n6w.png','Portada del juego 108',1,'2025-11-19 22:14:52'),(109,109,'https://images.igdb.com/igdb/image/upload/t_cover_small/co68u4.png','Portada del juego 109',1,'2025-11-19 22:14:52'),(110,110,'https://images.igdb.com/igdb/image/upload/t_cover_small/co4jni.png','Portada del juego 110',1,'2025-11-19 22:14:52'),(111,111,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2eoo.png','Portada del juego 111',1,'2025-11-19 22:14:52'),(112,112,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2mvy.png','Portada del juego 112',1,'2025-11-19 22:14:52'),(113,113,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2mvs.png','Portada del juego 113',1,'2025-11-19 22:14:52'),(114,114,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1qll.png','Portada del juego 114',1,'2025-11-19 22:14:52'),(115,115,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaare.png','Portada del juego 115',1,'2025-11-19 22:14:52'),(116,116,'https://images.igdb.com/igdb/image/upload/t_cover_small/co65ip.png','Portada del juego 116',1,'2025-11-19 22:14:52'),(117,117,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1y41.png','Portada del juego 117',1,'2025-11-19 22:14:52'),(118,118,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2e1l.png','Portada del juego 118',1,'2025-11-19 22:14:52'),(119,119,'https://images.igdb.com/igdb/image/upload/t_cover_small/coaiyq.png','Portada del juego 119',1,'2025-11-19 22:14:52'),(120,120,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2697.png','Portada del juego 120',1,'2025-11-19 22:14:52'),(121,121,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2e1a.png','Portada del juego 121',1,'2025-11-19 22:14:52'),(122,122,'https://images.igdb.com/igdb/image/upload/t_cover_big/co3ofx.webp','Portada del juego 122',1,'2025-11-19 22:14:52'),(123,123,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2g84.png','Portada del juego 123',1,'2025-11-19 22:14:52'),(124,124,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3wm2.png','Portada del juego 124',1,'2025-11-19 22:14:52'),(125,125,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3dsm.png','Portada del juego 125',1,'2025-11-19 22:14:52'),(126,126,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3a7l.png','Portada del juego 126',1,'2025-11-19 22:14:52'),(127,127,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2eck.png','Portada del juego 127',1,'2025-11-19 22:14:52'),(128,128,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1n1z.png','Portada del juego 128',1,'2025-11-19 22:14:52'),(129,129,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1n8t.png','Portada del juego 129',1,'2025-11-19 22:14:52'),(130,130,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3whp.png','Portada del juego 130',1,'2025-11-19 22:14:52'),(131,131,'https://images.igdb.com/igdb/image/upload/t_cover_small/co213p.png','Portada del juego 131',1,'2025-11-19 22:14:52'),(132,132,'https://images.igdb.com/igdb/image/upload/t_cover_small/co63jd.png','Portada del juego 132',1,'2025-11-19 22:14:52'),(133,133,'https://images.igdb.com/igdb/image/upload/t_cover_small/co5wv7.png','Portada del juego 133',1,'2025-11-19 22:14:52'),(134,134,'https://images.igdb.com/igdb/image/upload/t_cover_big/co721v.webp','Portada del juego 134',1,'2025-11-19 22:14:52'),(135,135,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2255.png','Portada del juego 135',1,'2025-11-19 22:14:52'),(136,136,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1pka.png','Portada del juego 136',1,'2025-11-19 22:14:52'),(137,137,'https://images.igdb.com/igdb/image/upload/t_cover_small/co20mh.png','Portada del juego 137',1,'2025-11-19 22:14:52'),(138,138,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1w4f.png','Portada del juego 138',1,'2025-11-19 22:14:52'),(139,139,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1x6j.png','Portada del juego 139',1,'2025-11-19 22:14:52'),(140,140,'https://images.igdb.com/igdb/image/upload/t_cover_small/co6dn3.png','Portada del juego 140',1,'2025-11-19 22:14:52'),(141,141,'https://images.igdb.com/igdb/image/upload/t_cover_small/co935n.png','Portada del juego 141',1,'2025-11-19 22:14:52'),(142,142,'https://images.igdb.com/igdb/image/upload/t_cover_small/co658o.png','Portada del juego 142',1,'2025-11-19 22:14:52'),(143,143,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2str.png','Portada del juego 143',1,'2025-11-19 22:14:52'),(144,144,'https://images.igdb.com/igdb/image/upload/t_cover_small/co9e29.png','Portada del juego 144',1,'2025-11-19 22:14:52'),(145,145,'https://images.igdb.com/igdb/image/upload/t_cover_small/coabgu.png','Portada del juego 145',1,'2025-11-19 22:14:52'),(146,146,'https://images.igdb.com/igdb/image/upload/t_cover_small/co2mlj.png','Portada del juego 146',1,'2025-11-19 22:14:52'),(147,147,'https://images.igdb.com/igdb/image/upload/t_cover_small/co271e.png','Portada del juego 147',1,'2025-11-19 22:14:52'),(148,148,'https://images.igdb.com/igdb/image/upload/t_cover_small/co1pkf.png','Portada del juego 148',1,'2025-11-19 22:14:52'),(149,149,'https://images.igdb.com/igdb/image/upload/t_cover_small/co4h5s.png','Portada del juego 149',1,'2025-11-19 22:14:52'),(150,150,'https://images.igdb.com/igdb/image/upload/t_cover_small/co3wc1.png','Portada del juego 150',1,'2025-11-19 22:14:52');
/*!40000 ALTER TABLE `juego_imagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista`
--

DROP TABLE IF EXISTS `lista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista` (
  `lista_id` int NOT NULL AUTO_INCREMENT,
  `lista_nombre` varchar(255) NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`lista_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista`
--

LOCK TABLES `lista` WRITE;
/*!40000 ALTER TABLE `lista` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_juego`
--

DROP TABLE IF EXISTS `lista_juego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_juego` (
  `lista_id` int NOT NULL,
  `juego_id` int NOT NULL,
  PRIMARY KEY (`lista_id`,`juego_id`),
  KEY `juego_id` (`juego_id`),
  CONSTRAINT `lista_juego_ibfk_1` FOREIGN KEY (`lista_id`) REFERENCES `lista` (`lista_id`) ON DELETE CASCADE,
  CONSTRAINT `lista_juego_ibfk_2` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`juego_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_juego`
--

LOCK TABLES `lista_juego` WRITE;
/*!40000 ALTER TABLE `lista_juego` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_juego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modojuego`
--

DROP TABLE IF EXISTS `modojuego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modojuego` (
  `modjuego_id` int NOT NULL AUTO_INCREMENT,
  `modjuego_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`modjuego_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modojuego`
--

LOCK TABLES `modojuego` WRITE;
/*!40000 ALTER TABLE `modojuego` DISABLE KEYS */;
INSERT INTO `modojuego` VALUES (1,'Singleplayer'),(2,'Multiplayer'),(3,'Cooperativo'),(4,'Online'),(5,'Local Coop'),(6,'Battle Royale'),(7,'PvP'),(8,'PvE'),(9,'Campaña'),(10,'Sandbox Libre');
/*!40000 ALTER TABLE `modojuego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `palabraclave`
--

DROP TABLE IF EXISTS `palabraclave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `palabraclave` (
  `palabclave_id` int NOT NULL AUTO_INCREMENT,
  `palabclave_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`palabclave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `palabraclave`
--

LOCK TABLES `palabraclave` WRITE;
/*!40000 ALTER TABLE `palabraclave` DISABLE KEYS */;
/*!40000 ALTER TABLE `palabraclave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perspectiva`
--

DROP TABLE IF EXISTS `perspectiva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perspectiva` (
  `persp_id` int NOT NULL AUTO_INCREMENT,
  `persp_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`persp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perspectiva`
--

LOCK TABLES `perspectiva` WRITE;
/*!40000 ALTER TABLE `perspectiva` DISABLE KEYS */;
INSERT INTO `perspectiva` VALUES (1,'Primera Persona (FPS)'),(2,'Tercera Persona (TPS)'),(3,'2D Lateral'),(4,'Top-Down'),(5,'Isométrica'),(6,'VR'),(7,'Cámara fija'),(8,'2.5D'),(9,'Pseudo-3D'),(10,'Vista Libre');
/*!40000 ALTER TABLE `perspectiva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plataforma`
--

DROP TABLE IF EXISTS `plataforma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plataforma` (
  `plataf_id` int NOT NULL AUTO_INCREMENT,
  `plataf_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`plataf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plataforma`
--

LOCK TABLES `plataforma` WRITE;
/*!40000 ALTER TABLE `plataforma` DISABLE KEYS */;
INSERT INTO `plataforma` VALUES (1,'PC'),(2,'PlayStation 1'),(3,'PlayStation 2'),(4,'PlayStation 3'),(5,'PlayStation 4'),(6,'PlayStation 5'),(7,'Xbox'),(8,'Xbox 360'),(9,'Xbox One'),(10,'Xbox Series X/S'),(11,'Nintendo Switch'),(12,'Wii'),(13,'Wii U'),(14,'GameCube'),(15,'Nintendo DS'),(16,'Nintendo 3DS'),(17,'PSP'),(18,'PS Vita'),(19,'Android'),(20,'iOS'),(21,'Steam Deck'),(22,'Linux');
/*!40000 ALTER TABLE `plataforma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicador`
--

DROP TABLE IF EXISTS `publicador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publicador` (
  `public_id` int NOT NULL AUTO_INCREMENT,
  `public_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`public_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicador`
--

LOCK TABLES `publicador` WRITE;
/*!40000 ALTER TABLE `publicador` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tema`
--

DROP TABLE IF EXISTS `tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tema` (
  `tema_id` int NOT NULL AUTO_INCREMENT,
  `tema_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`tema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema`
--

LOCK TABLES `tema` WRITE;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(100) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_password` varchar(255) NOT NULL,
  `usuario_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_email` (`usuario_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'naliashy','nat@gmail.com','123456',1),(2,'naliashy','n@gmail.com','$2y$10$4FK7j1FT1FMkpgezZiKK7ujEoA1lUYpFpZ0edzvSXJRnQFJ5SKNmW',1);
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

-- Dump completed on 2025-11-19 17:16:47

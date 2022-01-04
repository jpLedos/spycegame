-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: spygames
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryId` int NOT NULL,
  `isDead` tinyint(1) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `isConform` tinyint(1) NOT NULL DEFAULT (0),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES (3,'Bourne','Jason','Amnesique',164,0,'2016-08-10',1),(4,'Coplan','Francis ','FX-18',9,0,'1942-06-15',1),(5,'jones','sans','major J',220,0,'1975-08-12',1),(6,'Amos','Samuel Wenceslas ','Colonel Amos',231,0,'1958-09-15',1),(19,'l&#039;artiste','jean','muet',9,0,'2000-01-01',1),(22,'ledos','jean-pierre','jepele',75,0,'2022-01-03',1),(24,'Alleline','Percy','La Taupe',107,0,'1971-08-03',1),(25,'Bond','James','006',228,0,'1950-01-04',1);
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents_specialities`
--

DROP TABLE IF EXISTS `agents_specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents_specialities` (
  `agentId` int NOT NULL,
  `specialityId` int NOT NULL,
  PRIMARY KEY (`agentId`,`specialityId`),
  KEY `fk_specialityId` (`specialityId`),
  CONSTRAINT `fk_agentId` FOREIGN KEY (`agentId`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_specialityId` FOREIGN KEY (`specialityId`) REFERENCES `specialities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents_specialities`
--

LOCK TABLES `agents_specialities` WRITE;
/*!40000 ALTER TABLE `agents_specialities` DISABLE KEYS */;
INSERT INTO `agents_specialities` VALUES (3,1),(4,1),(5,1),(25,1),(3,2),(4,2),(6,2),(3,3),(5,3),(22,4),(3,6),(5,6),(6,6),(25,6),(5,13),(25,13),(4,18),(19,18),(25,18),(3,19),(6,19),(24,25),(25,25),(19,28);
/*!40000 ALTER TABLE `agents_specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryId` int NOT NULL,
  `isDead` tinyint(1) NOT NULL,
  `dateOfBirth` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'LAVISSE','J-Batiste','le JB ',140,0,'1980-01-22'),(4,'Chevalier','chris','cc',75,0,'1980-10-15'),(5,'Barnowsky','Betty ','Beth',231,0,'1988-12-01'),(13,'d&#039;artagnan','Charles','TOUSPOURUN',75,1,'1612-06-15'),(14,'ataturk','robert','ataturk',220,0,'2021-12-02'),(15,'lee','Bruce','kungFou',100,0,'1940-11-27'),(16,'Rostropovitch','Mstislav','Violon',9,0,'1927-11-11'),(17,'Norodom ','Sihanouk','khmer Red',35,0,'1985-01-05'),(18,' L. Jackson','Samuel','SLJ1980',228,0,'1954-12-18');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alpha3` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AFG','Afghanistan'),(2,'ALB','Albanie'),(3,'ATA','Antarctique'),(4,'DZA','Algérie'),(5,'ASM','Samoa Américaines'),(6,'AND','Andorre'),(7,'AGO','Angola'),(8,'ATG','Antigua-et-Barbuda'),(9,'AZE','Azerbaïdjan'),(10,'ARG','Argentine'),(11,'AUS','Australie'),(12,'AUT','Autriche'),(13,'BHS','Bahamas'),(14,'BHR','Bahreïn'),(15,'BGD','Bangladesh'),(16,'ARM','Arménie'),(17,'BRB','Barbade'),(18,'BEL','Belgique'),(19,'BMU','Bermudes'),(20,'BTN','Bhoutan'),(21,'BOL','Bolivie'),(22,'BIH','Bosnie-Herzégovine'),(23,'BWA','Botswana'),(24,'BVT','Île Bouvet'),(25,'BRA','Brésil'),(26,'BLZ','Belize'),(27,'IOT','Territoire Britannique de l\'Océan Indien'),(28,'SLB','Îles Salomon'),(29,'VGB','Îles Vierges Britanniques'),(30,'BRN','Brunéi Darussalam'),(31,'BGR','Bulgarie'),(32,'MMR','Myanmar'),(33,'BDI','Burundi'),(34,'BLR','Bélarus'),(35,'KHM','Cambodge'),(36,'CMR','Cameroun'),(37,'CAN','Canada'),(38,'CPV','Cap-vert'),(39,'CYM','Îles Caïmanes'),(40,'CAF','République Centrafricaine'),(41,'LKA','Sri Lanka'),(42,'TCD','Tchad'),(43,'CHL','Chili'),(44,'CHN','Chine'),(45,'TWN','Taïwan'),(46,'CXR','Île Christmas'),(47,'CCK','Îles Cocos (Keeling)'),(48,'COL','Colombie'),(49,'COM','Comores'),(50,'MYT','Mayotte'),(51,'COG','République du Congo'),(52,'COD','République Démocratique du Congo'),(53,'COK','Îles Cook'),(54,'CRI','Costa Rica'),(55,'HRV','Croatie'),(56,'CUB','Cuba'),(57,'CYP','Chypre'),(58,'CZE','République Tchèque'),(59,'BEN','Bénin'),(60,'DNK','Danemark'),(61,'DMA','Dominique'),(62,'DOM','République Dominicaine'),(63,'ECU','Équateur'),(64,'SLV','El Salvador'),(65,'GNQ','Guinée Équatoriale'),(66,'ETH','Éthiopie'),(67,'ERI','Érythrée'),(68,'EST','Estonie'),(69,'FRO','Îles Féroé'),(70,'FLK','Îles (malvinas) Falkland'),(71,'SGS','Géorgie du Sud et les Îles Sandwich du Sud'),(72,'FJI','Fidji'),(73,'FIN','Finlande'),(74,'ALA','Îles Åland'),(75,'FRA','France'),(76,'GUF','Guyane Française'),(77,'PYF','Polynésie Française'),(78,'ATF','Terres Australes Françaises'),(79,'DJI','Djibouti'),(80,'GAB','Gabon'),(81,'GEO','Géorgie'),(82,'GMB','Gambie'),(83,'PSE','Territoire Palestinien Occupé'),(84,'DEU','Allemagne'),(85,'GHA','Ghana'),(86,'GIB','Gibraltar'),(87,'KIR','Kiribati'),(88,'GRC','Grèce'),(89,'GRL','Groenland'),(90,'GRD','Grenade'),(91,'GLP','Guadeloupe'),(92,'GUM','Guam'),(93,'GTM','Guatemala'),(94,'GIN','Guinée'),(95,'GUY','Guyana'),(96,'HTI','Haïti'),(97,'HMD','Îles Heard et Mcdonald'),(98,'VAT','Saint-Siège (état de la Cité du Vatican)'),(99,'HND','Honduras'),(100,'HKG','Hong-Kong'),(101,'HUN','Hongrie'),(102,'ISL','Islande'),(103,'IND','Inde'),(104,'IDN','Indonésie'),(105,'IRN','République Islamique d\'Iran'),(106,'IRQ','Iraq'),(107,'IRL','Irlande'),(108,'ISR','Israël'),(109,'ITA','Italie'),(110,'CIV','Côte d\'Ivoire'),(111,'JAM','Jamaïque'),(112,'JPN','Japon'),(113,'KAZ','Kazakhstan'),(114,'JOR','Jordanie'),(115,'KEN','Kenya'),(116,'PRK','République Populaire Démocratique de Corée'),(117,'KOR','République de Corée'),(118,'KWT','Koweït'),(119,'KGZ','Kirghizistan'),(120,'LAO','République Démocratique Populaire Lao'),(121,'LBN','Liban'),(122,'LSO','Lesotho'),(123,'LVA','Lettonie'),(124,'LBR','Libéria'),(125,'LBY','Jamahiriya Arabe Libyenne'),(126,'LIE','Liechtenstein'),(127,'LTU','Lituanie'),(128,'LUX','Luxembourg'),(129,'MAC','Macao'),(130,'MDG','Madagascar'),(131,'MWI','Malawi'),(132,'MYS','Malaisie'),(133,'MDV','Maldives'),(134,'MLI','Mali'),(135,'MLT','Malte'),(136,'MTQ','Martinique'),(137,'MRT','Mauritanie'),(138,'MUS','Maurice'),(139,'MEX','Mexique'),(140,'MCO','Monaco'),(141,'MNG','Mongolie'),(142,'MDA','République de Moldova'),(143,'MSR','Montserrat'),(144,'MAR','Maroc'),(145,'MOZ','Mozambique'),(146,'OMN','Oman'),(147,'NAM','Namibie'),(148,'NRU','Nauru'),(149,'NPL','Népal'),(150,'NLD','Pays-Bas'),(151,'ANT','Antilles Néerlandaises'),(152,'ABW','Aruba'),(153,'NCL','Nouvelle-Calédonie'),(154,'VUT','Vanuatu'),(155,'NZL','Nouvelle-Zélande'),(156,'NIC','Nicaragua'),(157,'NER','Niger'),(158,'NGA','Nigéria'),(159,'NIU','Niué'),(160,'NFK','Île Norfolk'),(161,'NOR','Norvège'),(162,'MNP','Îles Mariannes du Nord'),(163,'UMI','Îles Mineures Éloignées des États-Unis'),(164,'FSM','États Fédérés de Micronésie'),(165,'MHL','Îles Marshall'),(166,'PLW','Palaos'),(167,'PAK','Pakistan'),(168,'PAN','Panama'),(169,'PNG','Papouasie-Nouvelle-Guinée'),(170,'PRY','Paraguay'),(171,'PER','Pérou'),(172,'PHL','Philippines'),(173,'PCN','Pitcairn'),(174,'POL','Pologne'),(175,'PRT','Portugal'),(176,'GNB','Guinée-Bissau'),(177,'TLS','Timor-Leste'),(178,'PRI','Porto Rico'),(179,'QAT','Qatar'),(180,'REU','Réunion'),(181,'ROU','Roumanie'),(182,'RUS','Fédération de Russie'),(183,'RWA','Rwanda'),(184,'SHN','Sainte-Hélène'),(185,'KNA','Saint-Kitts-et-Nevis'),(186,'AIA','Anguilla'),(187,'LCA','Sainte-Lucie'),(188,'SPM','Saint-Pierre-et-Miquelon'),(189,'VCT','Saint-Vincent-et-les Grenadines'),(190,'SMR','Saint-Marin'),(191,'STP','Sao Tomé-et-Principe'),(192,'SAU','Arabie Saoudite'),(193,'SEN','Sénégal'),(194,'SYC','Seychelles'),(195,'SLE','Sierra Leone'),(196,'SGP','Singapour'),(197,'SVK','Slovaquie'),(198,'VNM','Viet Nam'),(199,'SVN','Slovénie'),(200,'SOM','Somalie'),(201,'ZAF','Afrique du Sud'),(202,'ZWE','Zimbabwe'),(203,'ESP','Espagne'),(204,'ESH','Sahara Occidental'),(205,'SDN','Soudan'),(206,'SUR','Suriname'),(207,'SJM','Svalbard etÎle Jan Mayen'),(208,'SWZ','Swaziland'),(209,'SWE','Suède'),(210,'CHE','Suisse'),(211,'SYR','République Arabe Syrienne'),(212,'TJK','Tadjikistan'),(213,'THA','Thaïlande'),(214,'TGO','Togo'),(215,'TKL','Tokelau'),(216,'TON','Tonga'),(217,'TTO','Trinité-et-Tobago'),(218,'ARE','Émirats Arabes Unis'),(219,'TUN','Tunisie'),(220,'TUR','Turquie'),(221,'TKM','Turkménistan'),(222,'TCA','Îles Turks et Caïques'),(223,'TUV','Tuvalu'),(224,'UGA','Ouganda'),(225,'UKR','Ukraine'),(226,'MKD','L\'ex-République Yougoslave de Macédoine'),(227,'EGY','Égypte'),(228,'GBR','Royaume-Uni'),(229,'IMN','Île de Man'),(230,'TZA','République-Unie de Tanzanie'),(231,'USA','États-Unis'),(232,'VIR','Îles Vierges des États-Unis'),(233,'BFA','Burkina Faso'),(234,'URY','Uruguay'),(235,'UZB','Ouzbékistan'),(236,'VEN','Venezuela'),(237,'WLF','Wallis et Futuna'),(238,'WSM','Samoa'),(239,'YEM','Yémen'),(240,'SCG','Serbie-et-Monténégro'),(241,'ZMB','Zambie');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hideaways`
--

DROP TABLE IF EXISTS `hideaways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hideaways` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryId` int NOT NULL,
  `hideawayTypeId` int NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_hidaway_type_id` (`hideawayTypeId`),
  CONSTRAINT `FK_hidaway_type_id` FOREIGN KEY (`hideawayTypeId`) REFERENCES `hideawaytypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hideaways`
--

LOCK TABLES `hideaways` WRITE;
/*!40000 ALTER TABLE `hideaways` DISABLE KEYS */;
INSERT INTO `hideaways` VALUES (1,'BLUEMOSC',220,6,'place sainte-sophie'),(2,'Palio',109,3,'Piaza del campo'),(4,'auberge',93,6,' ru barbe, sao paulo'),(24,'pj',9,3,'36 quai des Orfevres ,PAris &#039; 7500'),(25,'Temple street',100,3,'Golden Bauhinia Square'),(26,'delices de HK',100,2,'Nem2202'),(28,'Piccadilly Circus',228,3,'12 Piccadilly place,London'),(29,'taxi NY',231,6,'mobile in NY'),(30,'Abbaye',75,5,'MSM 50 '),(31,'fastfood',84,6,'mobile');
/*!40000 ALTER TABLE `hideaways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hideawaytypes`
--

DROP TABLE IF EXISTS `hideawaytypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hideawaytypes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hideawaytypes`
--

LOCK TABLES `hideawaytypes` WRITE;
/*!40000 ALTER TABLE `hideawaytypes` DISABLE KEYS */;
INSERT INTO `hideawaytypes` VALUES (1,'gare'),(2,'villa'),(3,'appartement'),(4,'grenier'),(5,'Eglise'),(6,'Camion');
/*!40000 ALTER TABLE `hideawaytypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions`
--

DROP TABLE IF EXISTS `missions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryId` int NOT NULL,
  `typeId` int NOT NULL,
  `statutId` int NOT NULL,
  `specialityId` int NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `isConform` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_statut_id` (`statutId`),
  KEY `FK_type_id` (`typeId`),
  KEY `FK_country_id` (`countryId`),
  KEY `fk_speciality_Id` (`specialityId`),
  CONSTRAINT `fk_speciality_Id` FOREIGN KEY (`specialityId`) REFERENCES `specialities` (`id`),
  CONSTRAINT `FK_statut_id` FOREIGN KEY (`statutId`) REFERENCES `statuts` (`id`),
  CONSTRAINT `FK_type_id` FOREIGN KEY (`typeId`) REFERENCES `types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions`
--

LOCK TABLES `missions` WRITE;
/*!40000 ALTER TABLE `missions` DISABLE KEYS */;
INSERT INTO `missions` VALUES (1,'Boum à ISTAMBOUL','Destabilisation du gouvernement ','BOUMISTAN',220,5,1,1,'2022-12-08','2023-12-04',1),(2,'Save Angkor Wat','Empêcher la destruction terroristes des temples d&#039;Angkor ','SAW2020',35,1,3,1,'2021-12-01','2021-12-31',1),(6,'Dossier Kennedy','remise en cause du rapport de la commission Warren. implication de la CIA dans l &#039;assassinat','JFK deleted',21,2,1,1,'1967-05-12','1967-12-26',0),(7,'Coup d&#039;État en Azerbaïdjan ','prise de pouvoir au yemen! assassinat à l&#039;explosif. ','SANAA1986',9,5,1,6,'1986-06-01','2019-02-01',1),(9,'Malaise a honk kong','Amener une situation de révolte au sein de la population','HKFF',100,5,1,1,'2021-11-09','2022-04-22',0),(12,'Meurtre sur le rocher','Le prince mange une soupe empoisonnée','Monaco2022',140,2,2,4,'2022-01-03','2022-01-31',1),(13,'Mont st Michel','Faire sauter le Mont-Saint-Michel pour reconcilier les normands et les bretons','ARMAGEDON',75,5,3,19,'2022-04-04','2022-09-30',1),(14,'Soleil noir','assassinat du président William Sheridan','BlackSun',231,2,2,6,'2021-09-07','2022-05-11',1),(16,'Fin du monde','sauver le monde d&#039;un complot.','Kingsman',228,1,4,18,'2022-01-01','2023-01-01',1);
/*!40000 ALTER TABLE `missions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions_agents`
--

DROP TABLE IF EXISTS `missions_agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missions_agents` (
  `missionId` int NOT NULL,
  `agentId` int NOT NULL,
  PRIMARY KEY (`missionId`,`agentId`),
  KEY `agentId` (`agentId`),
  CONSTRAINT `missions_agents_ibfk_1` FOREIGN KEY (`missionId`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `missions_agents_ibfk_2` FOREIGN KEY (`agentId`) REFERENCES `agents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions_agents`
--

LOCK TABLES `missions_agents` WRITE;
/*!40000 ALTER TABLE `missions_agents` DISABLE KEYS */;
INSERT INTO `missions_agents` VALUES (1,3),(6,3),(14,3),(2,4),(1,5),(2,5),(1,6),(7,6),(13,6),(12,22),(9,24),(6,25),(16,25);
/*!40000 ALTER TABLE `missions_agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions_contacts`
--

DROP TABLE IF EXISTS `missions_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missions_contacts` (
  `missionId` int NOT NULL,
  `contactId` int NOT NULL,
  PRIMARY KEY (`missionId`,`contactId`),
  KEY `contactId` (`contactId`),
  CONSTRAINT `missions_contacts_ibfk_1` FOREIGN KEY (`missionId`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `missions_contacts_ibfk_2` FOREIGN KEY (`contactId`) REFERENCES `contacts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions_contacts`
--

LOCK TABLES `missions_contacts` WRITE;
/*!40000 ALTER TABLE `missions_contacts` DISABLE KEYS */;
INSERT INTO `missions_contacts` VALUES (12,1),(14,5),(13,13),(1,14),(9,15),(7,16),(2,17),(16,18);
/*!40000 ALTER TABLE `missions_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions_hideaways`
--

DROP TABLE IF EXISTS `missions_hideaways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missions_hideaways` (
  `missionId` int NOT NULL,
  `hideawayId` int NOT NULL,
  PRIMARY KEY (`missionId`,`hideawayId`),
  KEY `hideawayId` (`hideawayId`),
  CONSTRAINT `missions_hideaways_ibfk_1` FOREIGN KEY (`missionId`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `missions_hideaways_ibfk_2` FOREIGN KEY (`hideawayId`) REFERENCES `hideaways` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions_hideaways`
--

LOCK TABLES `missions_hideaways` WRITE;
/*!40000 ALTER TABLE `missions_hideaways` DISABLE KEYS */;
INSERT INTO `missions_hideaways` VALUES (1,1),(7,24),(9,25),(9,26),(14,29),(13,30);
/*!40000 ALTER TABLE `missions_hideaways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions_targets`
--

DROP TABLE IF EXISTS `missions_targets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missions_targets` (
  `missionId` int NOT NULL,
  `targetId` int NOT NULL,
  PRIMARY KEY (`missionId`,`targetId`),
  KEY `FK_targetId` (`targetId`),
  CONSTRAINT `FK_missionId` FOREIGN KEY (`missionId`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_targetId` FOREIGN KEY (`targetId`) REFERENCES `targets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions_targets`
--

LOCK TABLES `missions_targets` WRITE;
/*!40000 ALTER TABLE `missions_targets` DISABLE KEYS */;
INSERT INTO `missions_targets` VALUES (1,1),(16,1),(9,15),(1,20),(7,20),(7,21),(9,21),(12,22),(13,23),(14,24),(2,25),(6,26);
/*!40000 ALTER TABLE `missions_targets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialities`
--

DROP TABLE IF EXISTS `specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specialities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `speciality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialities`
--

LOCK TABLES `specialities` WRITE;
/*!40000 ALTER TABLE `specialities` DISABLE KEYS */;
INSERT INTO `specialities` VALUES (1,'arts  martiaux'),(2,'Deguisements'),(3,'armes blanches'),(4,'Poisons'),(6,'Sniper'),(12,'Medium'),(13,'Seduction'),(18,'Mentaliste'),(19,'Explosifs'),(25,'Polyglotte'),(28,'test');
/*!40000 ALTER TABLE `specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuts`
--

DROP TABLE IF EXISTS `statuts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuts`
--

LOCK TABLES `statuts` WRITE;
/*!40000 ALTER TABLE `statuts` DISABLE KEYS */;
INSERT INTO `statuts` VALUES (1,'En preparation'),(2,'en cours'),(3,'Terminé'),(4,'Echec');
/*!40000 ALTER TABLE `statuts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `targets`
--

DROP TABLE IF EXISTS `targets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `targets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryId` int NOT NULL,
  `isDead` tinyint(1) NOT NULL,
  `dateOfBirth` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `targets`
--

LOCK TABLES `targets` WRITE;
/*!40000 ALTER TABLE `targets` DISABLE KEYS */;
INSERT INTO `targets` VALUES (1,'Poutine','Wladimir','VLAD',113,0,'1952-10-07'),(2,'Biden','Joe !!','Sleepy Joe',46,0,'1942-11-20'),(4,'ElisabethII','elizabeth','the Queen',228,0,'1926-04-21'),(15,'JF','Kennedy','JFK',231,1,'1917-05-29'),(19,'ledos','jean-pierre','6A20354758969',4,0,'2021-12-25'),(20,'l&#039;assassin','paul','PLA02',15,0,'2001-11-29'),(21,'Wong ','Kar-wai','WKW00',100,0,'1972-06-12'),(22,'Reigner','Albert','SAS',140,0,'1958-03-14'),(23,'l&#039;Archange','Michel','MTSM5000',75,0,'0725-06-15'),(24,'Sheridan','William ','WS2022',231,0,'1963-08-01'),(25,'Kang',' Kek Ieu','KKL2020',35,1,'1942-01-13'),(26,'benoit XVI','Benoit','Le pape',10,0,'1927-04-16');
/*!40000 ALTER TABLE `targets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Surveillances'),(2,'Assassinat'),(3,'Infiltration'),(4,'Exfiltration'),(5,'Destabilisation');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@ad.com','$2y$10$ZYeI41XD3p81XIr0IbIlHOT5WNVg1BPGlo/CBHwbPwrRo3C5MZLBC');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-04 20:02:19

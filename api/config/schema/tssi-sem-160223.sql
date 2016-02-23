/*
SQLyog Ultimate v9.10 
MySQL - 5.6.17 : Database - tssi_sem_160126
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `province` char(3) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `address` varchar(140) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`student_id`,`type`,`country`,`province`,`city`,`barangay`,`address`,`created`,`modified`) values (1,25,'current','PH','BAN','Balanga City','121','3124124','2016-02-04 09:01:33','2016-02-04 09:01:33'),(2,25,'permanent','PH','BAN','Balanga City','121','3124124','2016-02-04 09:01:33','2016-02-04 09:01:33'),(3,26,'current','PH','MNL','Makati  City','Sample','123456 Address','2016-02-04 09:04:14','2016-02-04 09:04:14'),(4,26,'permanent','PH','MNL','Makati  City','Sample','123456 Address','2016-02-04 09:04:14','2016-02-04 09:04:14'),(5,27,'current','PH','BTG','Balayan','Sample','123543','2016-02-10 04:30:38','2016-02-10 04:30:38'),(6,27,'permanent','PH','BTG','Balayan','Sample','123543','2016-02-10 04:30:38','2016-02-10 04:30:38');

/*Table structure for table `assessment_adjustments` */

DROP TABLE IF EXISTS `assessment_adjustments`;

CREATE TABLE `assessment_adjustments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assessment_id` int(11) DEFAULT NULL,
  `item_code` char(3) DEFAULT NULL,
  `flag` char(1) DEFAULT '+',
  `amount` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assessment_adjustments` */

/*Table structure for table `assessment_fees` */

DROP TABLE IF EXISTS `assessment_fees`;

CREATE TABLE `assessment_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assessment_id` int(11) DEFAULT NULL,
  `fee_id` char(3) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `adjust_amount` decimal(10,2) DEFAULT '0.00',
  `paid_amount` decimal(10,2) DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assessment_fees` */

/*Table structure for table `assessment_schedules` */

DROP TABLE IF EXISTS `assessment_schedules`;

CREATE TABLE `assessment_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assessment_id` int(11) DEFAULT NULL,
  `bill_month` char(8) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assessment_schedules` */

/*Table structure for table `assessments` */

DROP TABLE IF EXISTS `assessments`;

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `sy` year(4) DEFAULT NULL,
  `section_id` int(4) DEFAULT NULL,
  `tuition_id` char(7) DEFAULT NULL,
  `scheme_id` char(4) DEFAULT NULL,
  `gross_amount` decimal(10,2) DEFAULT NULL,
  `charge_amount` decimal(10,2) DEFAULT '0.00',
  `discount_amount` decimal(10,2) DEFAULT '0.00',
  `paid_amount` decimal(10,2) DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assessments` */

/*Table structure for table `barangays` */

DROP TABLE IF EXISTS `barangays`;

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL COMMENT 'Is Show On Drop Down',
  `zip_code` char(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `barangays` */

insert  into `barangays`(`id`,`name`,`city_id`,`is_active`,`zip_code`) values (1,'1st to 7th Ave. West',955,1,'1405'),(2,'Amparo Subdivision',955,1,'1425'),(3,'Baesa',955,1,'1401'),(4,'Bagong Silang',955,1,'1428'),(5,'Bagumbong/Pag-asa',955,1,'1421'),(6,'Bankers Village',955,1,'1426'),(7,'Capitol Parkland Subd.',955,1,'1424'),(8,'Fish Market',955,1,'1411'),(9,'Grace Park East',955,1,'1403'),(10,'Grace Park West',955,1,'1406'),(11,'Isla de Cocomo',955,1,'1412'),(12,'Kaloocan City CPO',955,1,'1400'),(13,'Kanluran Village',955,1,'1409'),(14,'Kapitbahayan East',955,1,'1413'),(15,'Kaybiga/Deparo',955,1,'1420'),(16,'Lilles Ville Subd.',955,1,'1423'),(17,'Maypajo',955,1,'1410'),(18,'Novaliches North',955,1,'1422'),(19,'San Jose',955,1,'1404'),(20,'Sangandaan',955,1,'1408'),(21,'Sta. Quiteria',955,1,'1402'),(22,'Tala Leprosarium',955,1,'1427'),(23,'University Hills',955,1,'1407'),(24,'Victory Heights',955,1,'1427'),(25,'Almanza',957,1,'1750'),(26,'Angela Village',957,1,'1749'),(28,'Cut-cut',957,1,'1743'),(29,'Gatchalian Subd.',957,1,'1745'),(30,'Las Pinas CPO',957,1,'1740'),(31,'Manila Doctor\'s Village',957,1,'1748'),(32,'Manuyo',957,1,'1744'),(33,'Pulang Lupa',957,1,'1742'),(34,'Remarville Subd.',957,1,'1741'),(35,'Soldiers Hills Subd.',957,1,'1752'),(36,'T. S. Cruz Subd.',957,1,'1751'),(37,'Talon Moonwalk',957,1,'1747'),(38,'Verdant Acres Subd.',957,1,'1746'),(39,'Zapote',957,1,'1742'),(40,'Acacia',959,1,'1474'),(41,'Araneta Subdivision',959,1,'1476'),(42,'Dampalit',959,1,'1480'),(43,'Flores',959,1,'1471'),(44,'Kaunlaran Village',959,1,'1409'),(45,'Longos',959,1,'1472'),(46,'Malabon',959,1,'1470'),(47,'Maysilo',959,1,'1477'),(48,'Muzon',959,1,'1479'),(49,'Potrero',959,1,'1475'),(50,'Santolan',959,1,'1478'),(51,'Tonsuya',959,1,'1473'),(52,'East Edsa',960,1,'1554'),(53,'Greenhills South',960,1,'1556'),(54,'Mandaluyong CPO',960,1,'1550'),(55,'National Center for Mental Health ',960,1,'1553'),(56,'Shaw Boulevard',960,1,'1552'),(57,'Vergara',960,1,'1551'),(58,'Wack Wack Golf Club',960,1,'1555'),(59,'Bagong Nayon',961,NULL,'1820'),(60,'Barangka',961,NULL,'1803'),(61,'Cogeo',961,NULL,'1820'),(62,'Conception 1',961,NULL,'1807'),(63,'Conception 2',961,NULL,'1811'),(64,'Cupang',961,NULL,'1820'),(65,'Industrial Valley',961,NULL,'1802'),(66,'J de la Pena',961,NULL,'1804'),(67,'Langhaya',961,NULL,'1820'),(68,'Malanday',961,NULL,'1805'),(69,'Mambagat',961,NULL,'1820'),(70,'Marikina CPO',961,NULL,'1800'),(71,'Marikina Heights',961,NULL,'1810'),(72,'Mayamot',961,NULL,'1820'),(73,'Nangka',961,NULL,'1808'),(74,'North/West of Marikina River',961,NULL,'1806'),(75,'Parang',961,NULL,'1809'),(76,'San Roque-Calumpang',961,NULL,'1801'),(77,'Tañong',961,NULL,'1803'),(78,'Ayala-Paseo de Roxas',958,1,'1226'),(79,'Bangkal',958,1,'1233'),(80,'Bel-air',958,1,'1209'),(81,'Buendia Ave',958,1,'1200'),(82,'Cembo',958,1,'1214'),(83,'Comembo',958,1,'1217'),(84,'Dasmarinas Village North',958,1,'1221'),(85,'Dasmarinas Village South',958,1,'1222'),(86,'Forbes Park North',958,1,'1219'),(87,'Forbes Park South',958,1,'1220'),(88,'Fort Bonifacio (Camp)',958,1,'1201'),(89,'Fort Bonifacio Naval Stn.',958,1,'1202'),(90,'Greenbelt',958,1,'1228'),(91,'Guadalupe Nuevo',958,1,'1212'),(92,'Guadalupe Viejo',958,1,'1211'),(93,'Kasilawan',958,1,'1206'),(94,'La Paz',958,1,'1204'),(95,'Legaspi Village',958,1,'1229'),(96,'Magallanes Village',958,1,'1232'),(97,'Makati Commercial Ctr.',958,1,'1224'),(98,'Makati CPO',958,1,'1200'),(99,'Olympia & Carmona',958,1,'1207'),(100,'Palanan',958,1,'1235'),(101,'Pasong Tamo & Ecology Vill',958,1,'1231'),(102,'Pembo',958,1,'1218'),(103,'Pinagkaisahan-Pitogo',958,1,'1213'),(104,'Pio del Pilar',958,1,'1230'),(105,'Poblacion',958,1,'1210'),(106,'Rembo (East)',958,1,'1216'),(107,'Rembo (West)',958,1,'1215'),(108,'Rizal',958,1,'1208'),(109,'Salcedo Village',958,1,'1227'),(110,'San Antonio Village',958,1,'1203'),(111,'San Isidro',958,1,'1234'),(112,'San Lorenzo Village',958,1,'1223'),(113,'Santiago',958,1,'1208'),(114,'Singkamas',958,1,'1204'),(115,'Sta. Cruz',958,1,'1205'),(116,'Tejeros',958,1,'1204'),(117,'Urdaneta Village',958,1,'1225'),(118,'Valenzuela',958,1,'1208'),(119,'Binondo',956,1,'1006'),(120,'Intramuros',956,1,'1002'),(121,'Malate',956,1,'1004'),(122,'Manila CPO - Ermita',956,1,'1000'),(123,'Paco',956,1,'1007'),(124,'Pandacan',956,1,'1011'),(125,'Port Area (South)',956,1,'1018'),(126,'Quiapo',956,1,'1001'),(127,'Sampaloc East',956,1,'1008'),(128,'Sampaloc West',956,1,'1015'),(129,'San Andres Bukid',956,1,'1017'),(130,'San Miguel',956,1,'1005'),(131,'San Nicolas',956,1,'1010'),(132,'Sta. Ana',956,1,'1009'),(133,'Sta. Cruz North',956,1,'1014'),(134,'Sta. Cruz South',956,1,'1003'),(135,'Sta. Mesa',956,1,'1016'),(136,'Tondo North',956,1,'1013'),(137,'Tondo South',956,1,'1012'),(138,'Ayala Alabang P.O. Boxes',962,NULL,'1799'),(139,'Ayala Alabang Subd.',962,NULL,'1780'),(140,'Bayanan/Putatan',962,NULL,'1772'),(141,'Bule/Cupang',962,NULL,'1771'),(142,'Filinvest Corporate City',962,NULL,'1781'),(143,'Muntinlupa CPO',962,NULL,'1770'),(144,'Pearl Heights',962,NULL,'1775'),(145,'Pleasant Village',962,NULL,'1777'),(146,'Poblacion',962,NULL,'1776'),(147,'Susana Heights',962,NULL,'1774'),(148,'Tunasan',962,NULL,'1773'),(149,'Fish Market',963,NULL,'1411'),(150,'Isla de Cocomo',963,NULL,'1412'),(151,'Kapitbahayan East',963,NULL,'1413'),(152,'Kaunlaran Village',963,NULL,'1409'),(153,'Navotas',963,NULL,'1485'),(154,'Tangos',963,NULL,'1489'),(155,'Tanza',963,NULL,'1490'),(156,'Domestic Airport P.O.',965,NULL,'1301'),(157,'Mall of Asia Complex (MOA)',965,NULL,'1300'),(158,'Manila Bay Reclamation',965,NULL,'1308'),(159,'Pasay City CPO - Malibay',965,NULL,'1300'),(160,'PICC Reclamation Area',965,NULL,'1307'),(161,'San Isidro',965,NULL,'1306'),(162,'San Jose',965,NULL,'1305'),(163,'San Rafael',965,NULL,'1302'),(164,'San Roque',965,NULL,'1303'),(165,'Sta. Clara',965,NULL,'1304'),(166,'Villamor Airbase',965,NULL,'1309'),(167,'Aguho',967,NULL,'1620'),(168,'Sta. Ana',967,NULL,'1621'),(169,'Aeropark Subdivision',964,NULL,'1714'),(170,'Baclaran',964,NULL,'1702'),(171,'Better Living Subd.',964,NULL,'1711'),(172,'BF Homes 1',964,NULL,'1720'),(173,'BF Homes 2',964,NULL,'1718'),(174,'Executive Heights Subd.',964,NULL,'1710'),(175,'Ireneville 1 & 3',964,NULL,'1719'),(176,'Ireneville 2',964,NULL,'1714'),(177,'Manila Memorial Park',964,NULL,'1717'),(178,'Marina Subd. (Reclamation)',964,NULL,'1703'),(179,'Maywood 1',964,NULL,'1719'),(180,'Maywood 2',964,NULL,'1716'),(181,'Mervile Park Subd.',964,NULL,'1709'),(182,'Miramar Subd.',964,NULL,'1712'),(183,'Moonwalk Subdivision',964,NULL,'1709'),(184,'Multinational Subd.',964,NULL,'1708'),(185,'NAIA (Airport)',964,NULL,'1705'),(186,'Parañaque CPO',964,NULL,'1700'),(187,'Pulo',964,NULL,'1706'),(188,'San Antonio Valley 1',964,NULL,'1715'),(189,'San Antonio Valley 11 & 12',964,NULL,'1707'),(190,'Santo Niño',964,NULL,'1704'),(191,'South Admiral Village',964,NULL,'1709'),(192,'Tambo',964,NULL,'1701'),(193,'United Paranaque Subd.',964,NULL,'1713'),(194,'Caniogan',966,NULL,'1606'),(195,'Green Park',966,NULL,'1612'),(196,'Kapitolio',966,NULL,'1603'),(197,'Manggahan',966,NULL,'1611'),(198,'Maybunga',966,NULL,'1607'),(199,'Ortigas PO',966,NULL,'1605'),(200,'Pasig CPO',966,NULL,'1600'),(201,'Pinagbuhatan',966,NULL,'1602'),(202,'Rosario',966,NULL,'1609'),(203,'San Joaquin',966,NULL,'1601'),(204,'Santolan',966,NULL,'1610'),(205,'Sta. Lucia',966,NULL,'1608'),(206,'Ugong',966,NULL,'1604'),(207,'Alicia',968,NULL,'1105'),(208,'Amihan',968,NULL,'1102'),(209,'Apolonio Samson',968,NULL,'1106'),(210,'Baesa',968,NULL,'1106'),(211,'Bagbag',968,NULL,'1116'),(212,'Bagong bayan',968,NULL,'1110'),(213,'Bagong Buhay',968,NULL,'1109'),(214,'Bagong Lipunan',968,NULL,'1111'),(215,'Bagong Pag-asa',968,NULL,'1105'),(216,'Bagong Silangan',968,NULL,'1119'),(217,'Bahay Toro',968,NULL,'1106'),(218,'Balingasa',968,NULL,'1115'),(219,'Balintawak',968,NULL,'1106'),(220,'Balumbato',968,NULL,'1106'),(221,'Batasan Hills',968,NULL,'1126'),(222,'Bayanihan',968,NULL,'1109'),(223,'BF Homes',968,NULL,'1120'),(224,'Blue Ridge',968,NULL,'1109'),(225,'Botocan',968,NULL,'1101'),(226,'Bungad',968,NULL,'1105'),(227,'Camp Aguinaldo',968,NULL,'1110'),(228,'Capitol Hills/Park',968,NULL,'1126'),(229,'Capri',968,NULL,'1117'),(230,'Central',968,NULL,'1100'),(231,'Claro',968,NULL,'1102'),(232,'Commonwealth',968,NULL,'1121'),(233,'Crame',968,NULL,'1111'),(234,'Cubao',968,NULL,'1109'),(235,'Culiat',968,NULL,'1128'),(236,'Damar',968,NULL,'1115'),(237,'Damayan',968,NULL,'1104'),(238,'Damayan Lagi',968,NULL,'1112'),(239,'Damong Maliit',968,NULL,'1123'),(240,'Del Monte',968,NULL,'1105'),(241,'Diliman',968,NULL,'1101'),(242,'Dioquino Zobel',968,NULL,'1109'),(243,'Don Manuel',968,NULL,'1113'),(244,'Dona Aurora',968,NULL,'1113'),(245,'Dona Faustina Subd.',968,NULL,'1125'),(246,'Doña Imelda',968,NULL,'1113'),(247,'Dona Josefa',968,NULL,'1113'),(248,'Duyan-Duyan',968,NULL,'1102'),(249,'E. Rodriguez',968,NULL,'1102'),(250,'Escopa',968,NULL,'1109'),(251,'Fairview',968,NULL,'1118'),(252,'Fairview North',968,NULL,'1121'),(253,'Fairview South',968,NULL,'1122'),(254,'Gintong Silahis',968,NULL,'1114'),(255,'Gulod',968,NULL,'1117'),(256,'Holy Spirit',968,NULL,'1127'),(257,'Horseshoe',968,NULL,'1112'),(258,'Immaculate Conception',968,NULL,'1111'),(259,'Kaligayahan',968,NULL,'1124'),(260,'Kalusugan',968,NULL,'1112'),(261,'Kamias',968,NULL,'1102'),(262,'Kamuning',968,NULL,'1103'),(263,'Katipunan',968,NULL,'1105'),(264,'Kaunlaran',968,NULL,'1111'),(265,'Kristong Hari',968,NULL,'1112'),(266,'Krus na Ligas',968,NULL,'1101'),(267,'La Loma',968,NULL,'1114'),(268,'Laging Handa',968,NULL,'1103'),(269,'Libis',968,NULL,'1110'),(270,'Lourdes',968,NULL,'1114'),(271,'Loyola Heights',968,NULL,'1108'),(272,'Maharlica',968,NULL,'1114'),(273,'Malaya',968,NULL,'1101'),(274,'Mangga',968,NULL,'1109'),(275,'Manresa',968,NULL,'1115'),(276,'Mariana',968,NULL,'1112'),(277,'Mariblo',968,NULL,'1104'),(278,'Marilag',968,NULL,'1109'),(279,'Masagana',968,NULL,'1109'),(280,'Masambong',968,NULL,'1105'),(281,'Matalahib',968,NULL,'1114'),(282,'Matandang Balara',968,NULL,'1119'),(283,'Milagrosa',968,NULL,'1109'),(284,'Nagkaisang Nayaon',968,NULL,'1125'),(285,'Nayon Kaunlaran',968,NULL,'1104'),(286,'New Era',968,NULL,'1107'),(287,'Novaliches Town Proper',968,NULL,'1123'),(288,'Obrero',968,NULL,'1103'),(289,'Old Capitol Site',968,NULL,'1101'),(290,'Pag-Ibig sa Nayon',968,NULL,'1115'),(291,'Paligsahan',968,NULL,'1103'),(292,'Paltok',968,NULL,'1105'),(293,'Pansol',968,NULL,'1108'),(294,'Paraiso',968,NULL,'1104'),(295,'Parang Bundok',968,NULL,'1114'),(296,'Pasong Putik',968,NULL,'1118'),(297,'Pasong Tamo',968,NULL,'1107'),(298,'Payatas',968,NULL,'1119'),(299,'Phil-Am / Philam',968,NULL,'1104'),(300,'Pinagkaisahan',968,NULL,'1111'),(301,'Piñahan',968,NULL,'1100'),(302,'Project 4',968,NULL,'1109'),(303,'Project 6',968,NULL,'1100'),(304,'Project 7',968,NULL,'1105'),(305,'Project 8',968,NULL,'1106'),(306,'Quezon City CPO',968,NULL,'1100'),(307,'Quirino District/Project 2 & 3',968,NULL,'1102'),(308,'Ramon Magsaysay',968,NULL,'1105'),(309,'Roxas District',968,NULL,'1103'),(310,'Sacred Heart',968,NULL,'1103'),(311,'Salvacion',968,NULL,'1114'),(312,'San Agustin',968,NULL,'1117'),(313,'San Antonio',968,NULL,'1105'),(314,'San Bartolome',968,NULL,'1116'),(315,'San Isidro',968,NULL,'1113'),(316,'San Isidro Labrador',968,NULL,'1114'),(317,'San Jose',968,NULL,'1115'),(318,'San Martin de Porres',968,NULL,'1111'),(319,'San Roque',968,NULL,'1109'),(320,'San Vicente',968,NULL,'1101'),(321,'Sangandaan',968,NULL,'1116'),(322,'Santa Cruz',968,NULL,'1104'),(323,'Santa Lucia',968,NULL,'1117'),(324,'Santa Monica',968,NULL,'1117'),(325,'Santa Teresita',968,NULL,'1114'),(326,'Santo Nino',968,NULL,'1113'),(327,'Santol',968,NULL,'1113'),(328,'Sauyo',968,NULL,'1116'),(329,'Sienna',968,NULL,'1114'),(330,'Sikatuna Village',968,NULL,'1101'),(331,'Silangan',968,NULL,'1102'),(332,'Socorro',968,NULL,'1109'),(333,'South Triangle',968,NULL,'1103'),(334,'St. Ignatius',968,NULL,'1110'),(335,'St. Peter',968,NULL,'1114'),(336,'Sto. Cristo',968,NULL,'1105'),(337,'Tagumpay',968,NULL,'1109'),(338,'Talampas',968,NULL,'1110'),(339,'Talayan',968,NULL,'1104'),(340,'Talipapa',968,NULL,'1116'),(341,'Tandang Sora',968,NULL,'1116'),(342,'Tatalon',968,NULL,'1113'),(343,'Teachers Village',968,NULL,'1101'),(344,'Ugong Norte',968,NULL,'1110'),(345,'Unang Sigaw',968,NULL,'1106'),(346,'University of the Philippines',968,NULL,'1101'),(347,'UP Village',968,NULL,'1101'),(348,'Valencia',968,NULL,'1112'),(349,'Vasra',968,NULL,'1128'),(350,'Veterans Village',968,NULL,'1105'),(351,'Villa Maria Clara',968,NULL,'1109'),(352,'Violago Homes',968,NULL,'1120'),(353,'West Triangle',968,NULL,'1104'),(354,'White Plains',968,NULL,'1110'),(355,'Asian Development Bank',969,NULL,'401.'),(356,'Bible Church on the Air',969,NULL,'420.'),(357,'Eisenhower-Crame',969,NULL,'1504'),(358,'Greenhills North',969,NULL,'1503'),(359,'Greenhills PO',969,NULL,'1502'),(360,'Int\'l Correspondence School',969,NULL,'400.'),(361,'Radio Bible Class',969,NULL,'410.'),(362,'San Juan CPO',969,NULL,'1500'),(363,'Bay Breeze Village',970,NULL,'1636'),(364,'Bicutan',970,NULL,'1631'),(365,'Ligid',970,NULL,'1638'),(366,'Lower Bicutan',970,NULL,'1632'),(367,'Nichols-Mckinley',970,NULL,'1634'),(368,'Tukukan',970,NULL,'1637'),(369,'Upper Bicutan',970,NULL,'1633'),(370,'Western Bicutan',970,NULL,'1630'),(371,'Arkong Bato',971,NULL,'1444'),(372,'Balangkas, Caloong',971,NULL,'1445'),(373,'Dalandan West, Canumay',971,NULL,'1443'),(374,'East Canumay',971,NULL,'1447'),(375,'Far Eastern Broadcasting',971,NULL,'560.'),(376,'Feblas Col. of Bible',971,NULL,'550.'),(377,'Fortune Village',971,NULL,'1442'),(378,'Gen. T de Leon',971,NULL,'1442'),(379,'Karuhatan',971,NULL,'1441'),(380,'Lawang Bato',971,NULL,'1447'),(381,'Lingunan',971,NULL,'1446'),(382,'Mabolo',971,NULL,'1444'),(383,'Malanday',971,NULL,'1444'),(384,'Mapulang Lupa',971,NULL,'1448'),(385,'Paseo de Blas',971,NULL,'1442'),(386,'Pasolo',971,NULL,'1444'),(387,'Polo ',971,NULL,'1444'),(388,'Punturin',971,NULL,'1447'),(389,'Rincon ',971,NULL,'1444'),(390,'Valenzuela CPO, Malinta',971,NULL,'1440'),(391,'Valenzuela P.O. Boxes',971,NULL,'1496');

/*Table structure for table `billing_periods` */

DROP TABLE IF EXISTS `billing_periods`;

CREATE TABLE `billing_periods` (
  `id` char(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `payment_frequency` int(4) DEFAULT NULL,
  `bill_month_start` int(2) DEFAULT NULL,
  `bill_cutoff_date` int(2) DEFAULT NULL,
  `bill_cycle_increment` varchar(20) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `billing_periods` */

insert  into `billing_periods`(`id`,`name`,`payment_frequency`,`bill_month_start`,`bill_cutoff_date`,`bill_cycle_increment`,`order`,`created`,`modified`) values ('LSEV','Less: Educ Voucher',9,7,5,'+1 month',4,'2016-02-10 04:27:58','2016-02-10 04:27:58'),('MO9X','Monthly for 9 months',9,7,5,'+1 month',3,'2016-02-05 08:13:35','2016-02-05 08:13:39'),('SEM2','Second Semester',1,10,5,'+0 day',2,'2016-02-05 08:13:16','2016-02-05 08:16:01'),('UPEN','Upon Enrollment',1,6,5,'+0 day',1,'2016-02-05 08:13:02','2016-02-05 08:16:01');

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(3) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `province_id` char(3) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL COMMENT 'Is Show On Drop Down',
  `zip_code` char(4) DEFAULT NULL,
  `area_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`province_id`,`is_active`,`zip_code`,`area_code`) values (1,'Bangued','ABR',1,'2800',74),(2,'Boliney','ABR',1,'2815',74),(3,'Bucay','ABR',1,'2805',74),(4,'Bucloc','ABR',1,'2817',74),(5,'Daguioman','ABR',1,'2816',74),(6,'Danglas','ABR',1,'2825',74),(7,'Dolores','ABR',1,'2801',74),(8,'La Paz','ABR',1,'2826',74),(9,'Lacub','ABR',1,'2821',74),(10,'Lagangilang','ABR',1,'2802',74),(11,'Lagayan','ABR',1,'2824',74),(12,'Langiden','ABR',1,'2807',74),(13,'Licuan-Baay','ABR',1,'2819',74),(14,'Luba','ABR',1,'2813',74),(15,'Malibcong','ABR',1,'2820',74),(16,'Manabo','ABR',1,'2810',74),(17,'Peñarrubia','ABR',1,'2804',74),(18,'Pidigan','ABR',1,'2806',74),(19,'Pilar','ABR',1,'2812',74),(20,'Sallapadan','ABR',1,'2818',74),(21,'San Isidro','ABR',1,'2809',74),(22,'San Juan','ABR',1,'2823',74),(23,'San Quintin','ABR',1,'2808',74),(24,'Tayum','ABR',1,'2803',74),(25,'Tineg','ABR',1,'2822',74),(26,'Tubo','ABR',1,'2814',74),(27,'Villaviciosa','ABR',1,'2811',74),(28,'Buenavista','AGN',1,'8601',85),(29,'Butuan City','AGN',1,'8600',85),(30,'Cabadbaran City','AGN',1,'8605',85),(31,'Carmen','AGN',1,'8603',85),(32,'Jabonga','AGN',1,'8607',85),(33,'Kitcharao','AGN',1,'8609',85),(34,'Las Nieves','AGN',1,'8610',85),(35,'Magallanes','AGN',1,'8604',85),(36,'Nasipit','AGN',1,'8602',85),(37,'Remedios T. Romualdez','AGN',1,'8611',85),(38,'Santiago','AGN',1,'8608',85),(39,'Tubay','AGN',1,'8606',85),(40,'Bayugan City','AGS',1,'8502',85),(41,'Bunawan','AGS',1,'8506',85),(42,'Esperanza','AGS',1,'8513',85),(43,'La Paz','AGS',1,'8508',85),(44,'Loreto','AGS',1,'8507',85),(45,'Prosperidad','AGS',1,'8500',85),(46,'Rosario','AGS',1,'8504',85),(47,'San Francisco','AGS',1,'8501',85),(48,'San Luis','AGS',1,'8511',85),(49,'Santa Josefa','AGS',1,'8512',85),(50,'Sibagat','AGS',1,'8503',85),(51,'Talacogon','AGS',1,'8510',85),(52,'Trento','AGS',1,'8505',85),(53,'Veruela','AGS',1,'8509',85),(54,'Altavas','AKL',1,'5616',36),(55,'Balete','AKL',1,'5614',36),(56,'Banga','AKL',1,'5601',36),(57,'Batan','AKL',1,'5615',36),(58,'Buruanga','AKL',1,'5609',36),(59,'Ibajay','AKL',1,'5613',36),(60,'Kalibo','AKL',1,'5600',36),(61,'Lezo','AKL',1,'5605',36),(62,'Libacao','AKL',1,'5602',36),(63,'Madalag','AKL',1,'5603',36),(64,'Makato','AKL',1,'5611',36),(65,'Malay','AKL',1,'5608',36),(66,'Malinao','AKL',1,'5606',36),(67,'Nabas','AKL',1,'5607',36),(68,'New Washington','AKL',1,'5610',36),(69,'Numancia','AKL',1,'5604',36),(70,'Tangalan','AKL',1,'5612',36),(71,'Bacacay','ALB',1,'4509',52),(72,'Camalig','ALB',1,'4502',52),(73,'Daraga (Locsin)','ALB',1,'4501',52),(74,'Guinobatan','ALB',1,'4503',52),(75,'Jovellar','ALB',1,'4515',52),(76,'Legazpi City','ALB',1,'4500',52),(77,'Libon','ALB',1,'4507',52),(78,'Ligao City','ALB',1,'4504',52),(79,'Malilipot','ALB',1,'4510',52),(80,'Malinao','ALB',1,'4512',52),(81,'Manito','ALB',1,'4514',52),(82,'Oas','ALB',1,'4504',52),(83,'Pio Duran','ALB',1,'4516',52),(84,'Polangui','ALB',1,'4506',52),(85,'Rapu-Rapu','ALB',1,'4517',52),(86,'Santo Domingo','ALB',1,'4508',52),(87,'Tabaco City','ALB',1,'4511',52),(88,'Tiwi','ALB',1,'4513',52),(89,'Anini-y','ANT',1,'5717',36),(90,'Barbaza','ANT',1,'5706',36),(91,'Belison','ANT',1,'5701',36),(92,'Bugasong','ANT',1,'5704',36),(93,'Caluya','ANT',1,'5711',36),(94,'Culasi','ANT',1,'5708',36),(95,'Hamtic','ANT',1,'5715',36),(96,'Laua-an/Lawa-an','ANT',1,'5705',36),(97,'Libertad','ANT',1,'5710',36),(98,'Pandan','ANT',1,'5712',36),(99,'Patnongon','ANT',1,'5702',36),(100,'San Jose','ANT',1,'5700',36),(101,'San Remigio','ANT',1,'5714',36),(102,'Sebaste','ANT',1,'5709',36),(103,'Sibalom','ANT',1,'5713',36),(104,'Tibiao','ANT',1,'5707',36),(105,'Tobias Fornier (Dao)','ANT',1,'5716',36),(106,'Valderrama','ANT',1,'5703',36),(107,'Calanasan','APA',1,'3814',74),(108,'Conner','APA',1,'3807',74),(109,'Flora','APA',1,'3807',74),(110,'Kabugao','APA',1,'3809',74),(111,'Luna','APA',1,'3813',74),(112,'Pudtol','APA',1,'3812',74),(113,'Santa Marcela','APA',1,'3811',74),(114,'Baler','AUR',1,'3200',42),(115,'Casiguran','AUR',1,'3204',42),(116,'Dilasag','AUR',1,'3205',42),(117,'Dinalungan','AUR',1,'3206',42),(118,'Dingalan','AUR',1,'3207',42),(119,'Dipaculao','AUR',1,'3203',42),(120,'Maria Aurora','AUR',1,'3202',42),(121,'San Luis','AUR',1,'3201',42),(122,'Akbar','BAS',1,'7306',62),(123,'Al-Barka','BAS',1,'7304',62),(124,'Hadji Mohammad Aju','BAS',1,'7306',62),(125,'Isabela City','BAS',1,'7300',62),(126,'Lamitan City','BAS',1,'7302',62),(127,'Lantawan','BAS',1,'7301',62),(128,'Maluso','BAS',1,'7303',62),(129,'Sumisip','BAS',1,'7305',62),(130,'Tipo-Tipo','BAS',1,'7304',62),(131,'Tuburan','BAS',1,'7306',62),(132,'Ungkaya Pukan','BAS',1,'7304',62),(133,'Abucay','BAN',1,'2114',47),(134,'Bagac','BAN',1,'2107',47),(135,'Balanga City','BAN',1,'2100',47),(136,'Dinalupihan','BAN',1,'2110',47),(137,'Hermosa','BAN',1,'2111',47),(138,'Limay','BAN',1,'2103',47),(139,'Mariveles','BAN',1,'2105',47),(140,'Morong','BAN',1,'2108',47),(141,'Orani','BAN',1,'2112',47),(142,'Orion','BAN',1,'2102',47),(143,'Pilar','BAN',1,'2101',47),(144,'Samal','BAN',1,'2113',47),(145,'Basco','BTN',1,'3900',78),(146,'Itbayat','BTN',1,'3905',78),(147,'Ivana','BTN',1,'3902',78),(148,'Mahatao','BTN',1,'3901',78),(149,'Sabtang','BTN',1,'3904',78),(150,'Uyugan','BTN',1,'3903',78),(151,'Agoncillo','BTG',1,'4211',43),(152,'Alitagtag','BTG',1,'4205',43),(153,'Balayan','BTG',1,'4213',43),(154,'Balete','BTG',1,'4219',43),(155,'Batangas City','BTG',1,'4200',43),(156,'Bauan','BTG',1,'4201',43),(157,'Calaca','BTG',1,'4212',43),(158,'Calatagan','BTG',1,'4215',43),(159,'Cuenca','BTG',1,'4222',43),(160,'Ibaan','BTG',1,'4230',43),(161,'Laurel','BTG',1,'4221',43),(162,'Lemery','BTG',1,'4209',43),(163,'Lian','BTG',1,'4216',43),(164,'Lipa City','BTG',1,'4217',43),(165,'Lobo','BTG',1,'4229',43),(166,'Mabini','BTG',1,'4202',43),(167,'Malvar','BTG',1,'4233',43),(168,'Mataas na Kahoy','BTG',1,'4223',43),(169,'Nasugbu','BTG',1,'4231',43),(170,'Padre Garcia','BTG',1,'4224',43),(171,'Rosario','BTG',1,'4225',43),(172,'San Jose','BTG',1,'4227',43),(173,'San Juan','BTG',1,'4226',43),(174,'San Luis','BTG',1,'4210',43),(175,'San Nicolas','BTG',1,'4207',43),(176,'San Pascual','BTG',1,'4204',43),(177,'Santa Teresita','BTG',1,'4206',43),(178,'Santo Tomas','BTG',1,'4234',43),(179,'Taal','BTG',1,'4208',43),(180,'Talisay','BTG',1,'4220',43),(181,'Tanauan City','BTG',1,'4232',43),(182,'Taysan','BTG',1,'4228',43),(183,'Tingloy','BTG',1,'4203',43),(184,'Tuy','BTG',1,'4214',43),(185,'Atok','BEN',1,'2612',74),(186,'Baguio City','BEN',1,'2600',74),(187,'Bakun','BEN',1,'2610',74),(188,'Bokod','BEN',1,'2605',74),(189,'Buguias','BEN',1,'2607',74),(190,'Itogon','BEN',1,'2604',74),(191,'Kabayan','BEN',1,'2606',74),(192,'Kapangan','BEN',1,'2613',74),(193,'Kibungan','BEN',1,'2611',74),(194,'La Trinidad','BEN',1,'2601',74),(195,'Mankayan','BEN',1,'2608',74),(196,'Sablan','BEN',1,'2614',74),(197,'Tuba','BEN',1,'2603',74),(198,'Tublay','BEN',1,'2615',74),(199,'Almeria','BIL',1,'6544',53),(200,'Biliran','BIL',1,'6549',53),(201,'Cabucgayan','BIL',1,'6550',53),(202,'Caibiran','BIL',1,'6548',53),(203,'Culaba','BIL',1,'6547',53),(204,'Kawayan','BIL',1,'6545',53),(205,'Maripipi','BIL',1,'6546',53),(206,'Naval','BIL',1,'6543',53),(207,'Alburquerque','BOH',1,'6302',38),(208,'Alicia','BOH',1,'6314',38),(209,'Anda','BOH',1,'6311',38),(210,'Antequera','BOH',1,'6335',38),(211,'Baclayon','BOH',1,'6301',38),(212,'Balilihan','BOH',1,'6342',38),(213,'Batuan','BOH',1,'6318',38),(214,'Bien Unido','BOH',1,'6326',38),(215,'Bilar','BOH',1,'6317',38),(216,'Buenavista','BOH',1,'6333',38),(217,'Calape','BOH',1,'6328',38),(218,'Candijay','BOH',1,'6312',38),(219,'Carmen','BOH',1,'6319',38),(220,'Catigbian','BOH',1,'6343',38),(221,'Clarin','BOH',1,'6330',38),(222,'Corella','BOH',1,'6337',38),(223,'Cortes','BOH',1,'6341',38),(224,'Dagohoy','BOH',1,'6322',38),(225,'Danao','BOH',1,'6344',38),(226,'Dauis','BOH',1,'6339',38),(227,'Dimiao','BOH',1,'6305',38),(228,'Duero','BOH',1,'6309',38),(229,'Garcia Hernandez','BOH',1,'6307',38),(230,'Guindulman','BOH',1,'6310',38),(231,'Inabanga','BOH',1,'6332',38),(232,'Jagna','BOH',1,'6308',38),(233,'Jetafe','BOH',1,'6334',38),(234,'Lila','BOH',1,'6304',38),(235,'Loay','BOH',1,'6303',38),(236,'Loboc','BOH',1,'6316',38),(237,'Loon','BOH',1,'6327',38),(238,'Mabini','BOH',1,'6313',38),(239,'Maribojoc','BOH',1,'6336',38),(240,'Panglao','BOH',1,'6340',38),(241,'Pilar','BOH',1,'6321',38),(242,'Pres. Carlos P. Garcia','BOH',1,'6346',38),(243,'Sagbayan','BOH',1,'6331',38),(244,'San Isidro','BOH',1,'6345',38),(245,'San Miguel','BOH',1,'6323',38),(246,'Sevilla','BOH',1,'6347',38),(247,'Sierra Bullones','BOH',1,'6320',38),(248,'Sikatuna','BOH',1,'6338',38),(249,'Tagbilaran City','BOH',1,'6300',38),(250,'Talibon','BOH',1,'6325',38),(251,'Trinidad','BOH',1,'6324',38),(252,'Tubigon','BOH',1,'6329',38),(253,'Ubay','BOH',1,'6315',38),(254,'Valencia','BOH',1,'6306',38),(255,'Baungon','BUK',1,'8707',88),(256,'Cabanglasan','BUK',1,'8721',88),(257,'Damulog','BUK',1,'8721',88),(258,'Dangcagan','BUK',1,'8719',88),(259,'Don Carlos','BUK',1,'8712',88),(260,'Impasug-Ong','BUK',1,'8702',88),(261,'Kadingilan','BUK',1,'8713',88),(262,'Kalilangan','BUK',1,'8718',88),(263,'Kibawe','BUK',1,'8720',88),(264,'Kitaotao','BUK',1,'8716',88),(265,'Lantapan','BUK',1,'8722',88),(266,'Libona','BUK',1,'8706',88),(267,'Malaybalay City','BUK',1,'8700',88),(268,'Malitbog','BUK',1,'8704',88),(269,'Manolo Fortich','BUK',1,'8703',88),(270,'Maramag','BUK',1,'8714',88),(271,'Pangantucan','BUK',1,'8717',88),(272,'Quezon','BUK',1,'8715',88),(273,'San Fernando','BUK',1,'8711',88),(274,'Sumilao','BUK',1,'8701',88),(275,'Talakag','BUK',1,'8708',88),(276,'Valencia City','BUK',1,'8709',88),(277,'Angat','BUL',1,'3012',44),(278,'Balagtas','BUL',1,'3016',44),(279,'Baliuag','BUL',1,'3006',44),(280,'Bocaue','BUL',1,'3018',44),(281,'Bulacan','BUL',1,'3017',44),(282,'Bustos','BUL',1,'3007',44),(283,'Calumpit','BUL',1,'3003',44),(284,'Doña Remedios Trinidad','BUL',1,'3009',44),(285,'Guiguinto','BUL',1,'3015',44),(286,'Hagonoy','BUL',1,'3002',44),(287,'Malolos City','BUL',1,'3000',44),(288,'Marilao','BUL',1,'3019',44),(289,'Meycauayan City','BUL',1,'3020',44),(290,'Norzagaray','BUL',1,'3013',44),(291,'Obando','BUL',1,'3021',44),(292,'Pandi','BUL',1,'3014',44),(293,'Paombong','BUL',1,'3001',44),(294,'Plaridel','BUL',1,'3004',44),(295,'Pulilan','BUL',1,'3005',44),(296,'San Ildefonso','BUL',1,'3010',44),(297,'San Jose del Monte City','BUL',1,'3023',44),(298,'San Miguel','BUL',1,'3011',44),(299,'San Rafael','BUL',1,'3008',44),(300,'Santa Maria','BUL',1,'3022',44),(301,'Abulug','CAG',1,'3517',78),(302,'Alcala','CAG',1,'3506',78),(303,'Allacapan','CAG',1,'3523',78),(304,'Amulung','CAG',1,'3505',78),(305,'Aparri','CAG',1,'3515',78),(306,'Baggao','CAG',1,'3506',78),(307,'Ballesteros','CAG',1,'3516',78),(308,'Buguey','CAG',1,'3511',78),(309,'Calayan','CAG',1,'3520',78),(310,'Camalaniugan','CAG',1,'3510',78),(311,'Claveria','CAG',1,'3519',78),(312,'Enrile','CAG',1,'3501',78),(313,'Gattaran','CAG',1,'3508',78),(314,'Gonzaga','CAG',1,'3511',78),(315,'Iguig','CAG',1,'3504',78),(316,'Lal-Lo','CAG',1,'3509',78),(317,'Lasam','CAG',1,'3524',78),(318,'Pamplona','CAG',1,'3522',78),(319,'Peñablanca','CAG',1,'3502',78),(320,'Piat','CAG',1,'3527',78),(321,'Rizal','CAG',1,'3526',78),(322,'Sanchez-Mira','CAG',1,'3518',78),(323,'Santa Ana','CAG',1,'3514',78),(324,'Santa Praxedes','CAG',1,'3521',78),(325,'Santa Teresita','CAG',1,'3512',78),(326,'Santo Niño','CAG',1,'3525',78),(327,'Solana','CAG',1,'3503',78),(328,'Tuao','CAG',1,'3528',78),(329,'Tuguegarao City','CAG',1,'3500',78),(330,'Basud','CAN',1,'4608',54),(331,'Capalonga','CAN',1,'4606',54),(332,'Daet','CAN',1,'4600',54),(333,'Jose Panganiban','CAN',1,'4606',54),(334,'Labo','CAN',1,'4604',54),(335,'Mercedes','CAN',1,'4601',54),(336,'Paracale','CAN',1,'4605',54),(337,'San Lorenzo Ruiz','CAN',1,'4610',54),(338,'San Vicente','CAN',1,'4609',54),(339,'Santa Elena','CAN',1,'4611',54),(340,'Talisay','CAN',1,'4602',54),(341,'Vinzons','CAN',1,'4603',54),(342,'Baao','CAS',1,'4432',54),(343,'Balatan','CAS',1,'4436',54),(344,'Bato','CAS',1,'4435',54),(345,'Bombon','CAS',1,'4404',54),(346,'Buhi','CAS',1,'4433',54),(347,'Bula','CAS',1,'4430',54),(348,'Cabusao','CAS',1,'4406',54),(349,'Calabanga','CAS',1,'4405',54),(350,'Camaligan','CAS',1,'4401',54),(351,'Canaman','CAS',1,'4402',54),(352,'Caramoan','CAS',1,'4429',54),(353,'Del Gallego','CAS',1,'4411',54),(354,'Gainza','CAS',1,'4412',54),(355,'Garchitorena','CAS',1,'4428',54),(356,'Goa','CAS',1,'4422',54),(357,'Iriga City','CAS',1,'4431',54),(358,'Lagonoy','CAS',1,'4425',54),(359,'Libmanan','CAS',1,'4407',54),(360,'Lupi','CAS',1,'4409',54),(361,'Magarao','CAS',1,'4403',54),(362,'Milaor','CAS',1,'4413',54),(363,'Minalabac','CAS',1,'4414',54),(364,'Nabua','CAS',1,'4434',54),(365,'Naga City','CAS',1,'4400',54),(366,'Ocampo','CAS',1,'4419',54),(367,'Pamplona','CAS',1,'4416',54),(368,'Pasacao','CAS',1,'4417',54),(369,'Pili','CAS',1,'4418',54),(370,'Presentacion','CAS',1,'4424',54),(371,'Ragay','CAS',1,'4410',54),(372,'Sagñay','CAS',1,'4421',54),(373,'San Fernando','CAS',1,'4415',54),(374,'San Jose','CAS',1,'4423',54),(375,'Sipocot','CAS',1,'4408',54),(376,'Siruma','CAS',1,'4427',54),(377,'Tigaon','CAS',1,'4420',54),(378,'Tinambac','CAS',1,'4426',54),(379,'Catarman','CAM',1,'9104',88),(380,'Guinsiliban','CAM',1,'9102',88),(381,'Mahinog','CAM',1,'9101',88),(382,'Mambajao','CAM',1,'9100',88),(383,'Sagay','CAM',1,'9103',88),(384,'Cuartero','CAP',1,'5811',36),(385,'Dao','CAP',1,'5810',36),(386,'Dumalag','CAP',1,'5813',36),(387,'Dumarao','CAP',1,'5812',36),(388,'Ivisan','CAP',1,'5805',36),(389,'Jamindan','CAP',1,'5808',36),(390,'Ma-ayon','CAP',1,'5809',36),(391,'Mambusao','CAP',1,'5807',36),(392,'Panay','CAP',1,'5801',36),(393,'Panitan','CAP',1,'5815',36),(394,'Pilar','CAP',1,'5804',36),(395,'Pontevedra','CAP',1,'5802',36),(396,'President Roxas','CAP',1,'5803',36),(397,'Roxas City','CAP',1,'5800',36),(398,'Sapi-an','CAP',1,'5816',36),(399,'Sigma','CAP',1,'5802',36),(400,'Tapaz','CAP',1,'5814',36),(401,'Bagamanoc','CAT',1,'4807',52),(402,'Baras','CAT',1,'4803',52),(403,'Bato','CAT',1,'4801',52),(404,'Caramoran','CAT',1,'4808',52),(405,'Gigmoto','CAT',1,'4804',52),(406,'Pandan','CAT',1,'4809',52),(407,'Panganiban','CAT',1,'4806',52),(408,'San Andres','CAT',1,'4810',52),(409,'San Miguel','CAT',1,'4802',52),(410,'Viga','CAT',1,'4805',52),(411,'Virac','CAT',1,'4800',52),(412,'Alfonso','CAV',1,'4123',46),(413,'Amadeo','CAV',1,'4119',46),(414,'Bacoor','CAV',1,'4102',46),(415,'Carmona','CAV',1,'4116',46),(416,'Cavite City','CAV',1,'4100',46),(417,'Dasmariñas','CAV',1,'4114',46),(418,'Gen. Emilio Aguinaldo','CAV',1,'4124',46),(419,'Gen. Mariano Alvarez','CAV',1,'4117',46),(420,'Gen. Trias','CAV',1,'4107',46),(421,'Imus','CAV',1,'4103',46),(422,'Indang','CAV',1,'4122',46),(423,'Kawit','CAV',1,'4104',46),(424,'Magallanes','CAV',1,'4113',46),(425,'Maragondon','CAV',1,'4112',46),(426,'Mendez','CAV',1,'4121',46),(427,'Naic','CAV',1,'4110',46),(428,'Noveleta','CAV',1,'4105',46),(429,'Rosario','CAV',1,'4106',46),(430,'Silang','CAV',1,'4118',46),(431,'Tagaytay City','CAV',1,'4120',46),(432,'Tanza','CAV',1,'4108',46),(433,'Ternate','CAV',1,'4111',46),(434,'Trece Martires City','CAV',1,'4109',46),(435,'Alcantara','CEB',1,'6033',32),(436,'Alcoy','CEB',1,'6023',32),(437,'Alegria','CEB',1,'6030',32),(438,'Aloguinsan','CEB',1,'6040',32),(439,'Argao City','CEB',1,'6021',32),(440,'Asturias','CEB',1,'6042',32),(441,'Badian','CEB',1,'6031',32),(442,'Balamban','CEB',1,'6041',32),(443,'Bantayan','CEB',1,'6042',32),(444,'Barili','CEB',1,'6036',32),(445,'Bogo City','CEB',1,'6010',32),(446,'Boljoon','CEB',1,'6024',32),(447,'Borbon','CEB',1,'6008',32),(448,'Carcar City','CEB',1,'6019',32),(449,'Carmen','CEB',1,'6005',32),(450,'Catmon','CEB',1,'6006',32),(451,'Cebu City','CEB',1,'6000',32),(452,'Compostela','CEB',1,'6003',32),(453,'Consolacion','CEB',1,'6001',32),(454,'Cordoba','CEB',1,'6017',32),(455,'Daanbantayan','CEB',1,'6013',32),(456,'Dalaguete','CEB',1,'6022',32),(457,'Danao City','CEB',1,'6004',32),(458,'Dumanjug','CEB',1,'6035',32),(459,'Ginatilan','CEB',1,'6026',32),(460,'Lapu-Lapu City','CEB',1,'6015',32),(461,'Liloan','CEB',1,'6002',32),(462,'Madridejos','CEB',1,'6053',32),(463,'Malabuyoc','CEB',1,'6029',32),(464,'Mandaue City','CEB',1,'6014',32),(465,'Medellin','CEB',1,'6012',32),(466,'Minglanilla','CEB',1,'6046',32),(467,'Moalboal','CEB',1,'6032',32),(468,'Naga City','CEB',1,'6037',32),(469,'Oslob','CEB',1,'6025',32),(470,'Pilar','CEB',1,'6048',32),(471,'Pinamungahan','CEB',1,'6039',32),(472,'Poro','CEB',1,'6049',32),(473,'Ronda','CEB',1,'6034',32),(474,'Samboan','CEB',1,'6027',32),(475,'San Fernando','CEB',1,'6018',32),(476,'San Francisco','CEB',1,'6050',32),(477,'San Remigio','CEB',1,'6011',32),(478,'Santa Fe','CEB',1,'6047',32),(479,'Santander','CEB',1,'6026',32),(480,'Sibonga','CEB',1,'6020',32),(481,'Sogod','CEB',1,'6007',32),(482,'Tabogon','CEB',1,'6009',32),(483,'Tabuelan','CEB',1,'6044',32),(484,'Talisay City','CEB',1,'6045',32),(485,'Toledo City','CEB',1,'6038',32),(486,'Tuburan','CEB',1,'6043',32),(487,'Tudela','CEB',1,'6051',32),(488,'Compostela','COM',1,'8803',NULL),(489,'Laak','COM',1,'8810',NULL),(490,'Mabini','COM',1,'8807',NULL),(491,'Maco','COM',1,'8806',NULL),(492,'Maragusan','COM',1,'8808',NULL),(493,'Mawab','COM',1,'8802',NULL),(494,'Monkayo','COM',1,'8805',NULL),(495,'Montevista','COM',1,'8801',NULL),(496,'Nabunturan','COM',1,'8800',NULL),(497,'New Bataan','COM',1,'8804',NULL),(498,'Pantukan','COM',1,'8809',NULL),(499,'Alamada','NCO',1,'9413',64),(500,'Aleosan','NCO',1,'9415',64),(501,'Antipas','NCO',1,'9414',64),(502,'Arakan','NCO',1,'9417',64),(503,'Banisilan','NCO',1,'9416',64),(504,'Carmen','NCO',1,'9408',64),(505,'Kabacan','NCO',1,'9407',64),(506,'Kidapawan City','NCO',1,'9400',64),(507,'Libungan','NCO',1,'9411',64),(508,'Magpet','NCO',1,'9404',64),(509,'Makilala','NCO',1,'9401',64),(510,'Matalam','NCO',1,'9406',64),(511,'Midsayap','NCO',1,'9410',64),(512,'M Lang','NCO',1,'9402',64),(513,'Pigkawayan','NCO',1,'9412',64),(514,'Pikit','NCO',1,'9409',64),(515,'President Roxas','NCO',1,'9405',64),(516,'Tulunan','NCO',1,'9403',65),(517,'Asuncion','DAV',1,'8102',84),(518,'Braulio E. Dujali','DAV',1,'8100',84),(519,'Carmen','DAV',1,'8101',84),(520,'Island Garden City of Samal','DAV',1,'8119',84),(521,'Kapalong','DAV',1,'8113',84),(522,'New Corella','DAV',1,'8104',84),(523,'Panabo City','DAV',1,'8105',84),(524,'San Isidro','DAV',1,'8100',84),(525,'Santo Tomas','DAV',1,'8112',84),(526,'Tagum City','DAV',1,'8100',84),(527,'Talaingod','DAV',1,'8100',84),(528,'Bansalan','DAS',1,'8005',82),(529,'Davao City','DAS',1,'8000',82),(530,'Digos City','DAS',1,'8002',82),(531,'Don Marcelino','DAS',1,'8013',82),(532,'Hagonoy','DAS',1,'8006',82),(533,'Jose Abad Santos','DAS',1,'8014',82),(534,'Kiblawan','DAS',1,'8008',82),(535,'Magsaysay','DAS',1,'8004',82),(536,'Malalag','DAS',1,'8010',82),(537,'Malita','DAS',1,'8012',82),(538,'Matanao','DAS',1,'8003',82),(539,'Padada','DAS',1,'8007',82),(540,'Santa Cruz','DAS',1,'8001',82),(541,'Santa Maria','DAS',1,'8011',82),(542,'Sarangani','DAS',1,'8015',82),(543,'Sulop','DAS',1,'8009',82),(544,'Baganga','DAO',1,'8204',87),(545,'Banaybanay','DAO',1,'8208',87),(546,'Boston','DAO',1,'8206',87),(547,'Caraga','DAO',1,'8203',87),(548,'Cateel','DAO',1,'8205',87),(549,'Governor Generoso','DAO',1,'8210',87),(550,'Lupon','DAO',1,'8207',87),(551,'Manay','DAO',1,'8202',87),(552,'Mati City','DAO',1,'8200',87),(553,'San Isidro','DAO',1,'8209',87),(554,'Tarragona','DAO',1,'8201',87),(555,'Basilisia (Rizal)','DIN',1,'8413',86),(556,'Cagdianao','DIN',1,'8411',86),(557,'Dinagat','DIN',1,'8412',86),(558,'Libjo (Albor)','DIN',1,'8414',86),(559,'Loreto','DIN',1,'8415',86),(560,'San Jose','DIN',1,'8427',86),(561,'Tubajon','DIN',1,'8426',86),(562,'Arteche','EAS',1,'6822',55),(563,'Balangiga','EAS',1,'6812',55),(564,'Balangkayan','EAS',1,'6801',55),(565,'Borongan City','EAS',1,'6800',55),(566,'Can-avid','EAS',1,'6806',55),(567,'Dolores','EAS',1,'6817',55),(568,'General MacArthur','EAS',1,'6805',55),(569,'Giporlos','EAS',1,'6811',55),(570,'Guiuan','EAS',1,'6809',55),(571,'Hernani','EAS',1,'6804',55),(572,'Jipapad','EAS',1,'6819',55),(573,'Lawaan','EAS',1,'6813',55),(574,'Llorente','EAS',1,'6803',55),(575,'Maslog','EAS',1,'6820',55),(576,'Maydolong','EAS',1,'6802',55),(577,'Mercedes','EAS',1,'6808',55),(578,'Oras','EAS',1,'6818',55),(579,'Quinapondan','EAS',1,'6810',55),(580,'Salcedo','EAS',1,'6807',55),(581,'San Julian','EAS',1,'6814',55),(582,'San Policarpo','EAS',1,'6821',55),(583,'Sulat','EAS',1,'6815',55),(584,'Taft','EAS',1,'6816',55),(585,'Buenavista','GUI',1,'5044',33),(586,'Jordan','GUI',1,'5045',33),(587,'Nueva Valencia','GUI',1,'5046',33),(588,'San Lorenzo','GUI',1,'5047',33),(589,'Sibunag','GUI',1,'5048',33),(590,'Aguinaldo','IFU',1,'3606',74),(591,'Alfonso Lista','IFU',1,'3608',74),(592,'Asipulo','IFU',1,'3610',74),(593,'Banaue','IFU',1,'3601',74),(594,'Hingyon','IFU',1,'3607',74),(595,'Hungduan','IFU',1,'3603',74),(596,'Kiangan','IFU',1,'3604',74),(597,'Lagawe','IFU',1,'3600',74),(598,'Lamut','IFU',1,'3605',74),(599,'Mayoyao','IFU',1,'3602',74),(600,'Tinoc','IFU',1,'3609',74),(601,'Ajuy','ILI',1,'5012',33),(602,'Alimodian','ILI',1,'5028',33),(603,'Anilao','ILI',1,'5009',33),(604,'Badiangan','ILI',1,'5033',33),(605,'Balasan','ILI',1,'5018',33),(606,'Banate','ILI',1,'5010',33),(607,'Barotac Nuevo','ILI',1,'5007',33),(608,'Barotac Viejo','ILI',1,'5011',33),(609,'Batad','ILI',1,'5016',33),(610,'Bingawan','ILI',1,'5041',33),(611,'Cabatuan','ILI',1,'5031',33),(612,'Calinog','ILI',1,'5040',33),(613,'Carles','ILI',1,'5019',33),(614,'Concepcion','ILI',1,'5013',33),(615,'Dingle','ILI',1,'5035',33),(616,'Dueñas','ILI',1,'5038',33),(617,'Dumangas','ILI',1,'5006',33),(618,'Estancia','ILI',1,'5017',33),(619,'Guimbal','ILI',1,'5022',33),(620,'Igbaras','ILI',1,'5029',33),(621,'Iloilo City','ILI',1,'5000',33),(622,'Janiuay','ILI',1,'5034',33),(623,'Lambunao','ILI',1,'5042',33),(624,'Leganes','ILI',1,'5003',33),(625,'Lemery','ILI',1,'5043',33),(626,'Leon','ILI',1,'5026',33),(627,'Maasin','ILI',1,'5030',33),(628,'Miagao','ILI',1,'5023',33),(629,'Mina','ILI',1,'5032',33),(630,'New Lucena','ILI',1,'5005',33),(631,'Oton','ILI',1,'5020',33),(632,'Passi City','ILI',1,'5037',33),(633,'Pavia','ILI',1,'5001',33),(634,'Pototan','ILI',1,'5008',33),(635,'San Dionisio','ILI',1,'5015',33),(636,'San Enrique','ILI',1,'5036',33),(637,'San Joaquin','ILI',1,'5024',33),(638,'San Miguel','ILI',1,'5025',33),(639,'San Rafael','ILI',1,'5039',33),(640,'Santa Barbara','ILI',1,'5002',33),(641,'Sara','ILI',1,'5014',33),(642,'Tigbauan','ILI',1,'5021',33),(643,'Tubungan','ILI',1,'5027',33),(644,'Zarraga','ILI',1,'5004',33),(645,'Adams','ILN',1,'2922',77),(646,'Bacarra','ILN',1,'2916',77),(647,'Badoc','ILN',1,'2904',77),(648,'Bangui','ILN',1,'2920',77),(649,'Banna','ILN',1,'2908',77),(650,'Batac City','ILN',1,'2906',77),(651,'Burgos','ILN',1,'2918',77),(652,'Carasi','ILN',1,'2911',77),(653,'Currimao','ILN',1,'2903',77),(654,'Dingras','ILN',1,'2913',77),(655,'Dumalneg','ILN',1,'2921',77),(656,'Laoag City','ILN',1,'2900',77),(657,'Marcos','ILN',1,'2907',77),(658,'Nueva Era','ILN',1,'2909',77),(659,'Pagudpud','ILN',1,'2919',77),(660,'Paoay','ILN',1,'2902',77),(661,'Pasuquin','ILN',1,'2917',77),(662,'Piddig','ILN',1,'2912',77),(663,'Pinili','ILN',1,'2905',77),(664,'San Nicolas','ILN',1,'2901',77),(665,'Sarrat','ILN',1,'2914',77),(666,'Solsona','ILN',1,'2910',77),(667,'Vintar','ILN',1,'2915',77),(668,'Alilem','ILS',1,'2716',77),(669,'Banayoyo','ILS',1,'2708',77),(670,'Bantay','ILS',1,'2727',77),(671,'Burgos','ILS',1,'2724',77),(672,'Cabugao','ILS',1,'2732',77),(673,'Candon City','ILS',1,'2710',77),(674,'Caoayan','ILS',1,'2702',77),(675,'Cervantes','ILS',1,'2718',77),(676,'Galimuyod','ILS',1,'2709',77),(677,'Gregorio Del Pilar','ILS',1,'2720',77),(678,'Lidlidda','ILS',1,'2723',77),(679,'Magsingal','ILS',1,'2730',77),(680,'Nagbukel','ILS',1,'2725',77),(681,'Narvacan','ILS',1,'2704',77),(682,'Quirino','ILS',1,'2721',77),(683,'Salcedo','ILS',1,'2711',77),(684,'San Emilio','ILS',1,'2722',77),(685,'San Esteban','ILS',1,'2706',77),(686,'San Ildefonso','ILS',1,'2728',77),(687,'San Juan','ILS',1,'2731',77),(688,'San Vicente','ILS',1,'2726',77),(689,'Santa Catalina','ILS',1,'2701',77),(690,'Santa Cruz','ILS',1,'2713',77),(691,'Santa Lucia','ILS',1,'2712',77),(692,'Santa Maria','ILS',1,'2705',77),(693,'Santa','ILS',1,'2703',77),(694,'Santiago','ILS',1,'2707',77),(695,'Santo Domingo','ILS',1,'2729',77),(696,'Sigay','ILS',1,'2719',77),(697,'Sinait','ILS',1,'2733',77),(698,'Sugpon','ILS',1,'2717',77),(699,'Suyo','ILS',1,'2715',77),(700,'Tagudin','ILS',1,'2714',77),(701,'Vigan City','ILS',1,'2700',77),(702,'Alicia','ISA',1,'3306',78),(703,'Angadanan','ISA',1,'3307',78),(704,'Aurora','ISA',1,'3316',78),(705,'Benito Soliven','ISA',1,'3331',78),(706,'Burgos','ISA',1,'3322',78),(707,'Cabagan','ISA',1,'3328',78),(708,'Cabatuan','ISA',1,'3315',78),(709,'Cauayan City','ISA',1,'3305',78),(710,'Cordon','ISA',1,'3312',78),(711,'Delfin Albano','ISA',1,'3326',78),(712,'Dinapigue','ISA',1,'3336',78),(713,'Divilacan','ISA',1,'3335',78),(714,'Echague','ISA',1,'3309',78),(715,'Gamu','ISA',1,'3301',78),(716,'Ilagan','ISA',1,'3300',78),(717,'Jones','ISA',1,'3313',78),(718,'Luna','ISA',1,'3304',78),(719,'Maconacon','ISA',1,'3333',78),(720,'Mallig','ISA',1,'3323',78),(721,'Naguilian','ISA',1,'3302',78),(722,'Palanan','ISA',1,'3334',78),(723,'Quezon','ISA',1,'3324',78),(724,'Quirino','ISA',1,'3321',78),(725,'Ramon','ISA',1,'3319',78),(726,'Reina Mercedes','ISA',1,'3303',78),(727,'Roxas','ISA',1,'3320',78),(728,'San Agustin','ISA',1,'3314',78),(729,'San Guillermo','ISA',1,'3308',78),(730,'San Isidro','ISA',1,'3310',78),(731,'San Manuel','ISA',1,'3317',78),(732,'San Mariano','ISA',1,'3332',78),(733,'San Mateo','ISA',1,'3318',78),(734,'San Pablo','ISA',1,'3329',78),(735,'Santa Maria','ISA',1,'3330',78),(736,'Santiago City','ISA',1,'3311',78),(737,'Santo Tomas','ISA',1,'3327',78),(738,'Tumauini','ISA',1,'3325',78),(739,'Balbalan','KAL',1,'3801',74),(740,'Lubuagan','KAL',1,'3802',74),(741,'Pasil','KAL',1,'3803',74),(742,'Pinukpuk','KAL',1,'3806',74),(743,'Liwan (Rizal)','KAL',1,'3808',74),(744,'Tabuk City','KAL',1,'3800',74),(745,'Tanudan','KAL',1,'3805',74),(746,'Tinglayan','KAL',1,'3804',74),(747,'Agoo','LUN',1,'2504',72),(748,'Aringay','LUN',1,'2503',72),(749,'Bacnotan','LUN',1,'2515',72),(750,'Bagulin','LUN',1,'2512',72),(751,'Balaoan','LUN',1,'2517',72),(752,'Bangar','LUN',1,'2519',72),(753,'Bauang','LUN',1,'2501',72),(754,'Burgos','LUN',1,'2510',72),(755,'Caba','LUN',1,'2502',72),(756,'Luna','LUN',1,'2518',72),(757,'Naguilian','LUN',1,'2511',72),(758,'Pugo','LUN',1,'2508',72),(759,'Rosario','LUN',1,'2506',72),(760,'San Fernando City','LUN',1,'2500',72),(761,'San Gabriel','LUN',1,'2513',72),(762,'San Juan','LUN',1,'2514',72),(763,'Santo Tomas','LUN',1,'2505',72),(764,'Santol','LUN',1,'2516',72),(765,'Sudipen','LUN',1,'2520',72),(766,'Tubao','LUN',1,'2509',72),(767,'Alaminos','LAG',1,'4001',49),(768,'Bay','LAG',1,'4033',49),(769,'Biñan','LAG',1,'4024',49),(770,'Cabuyao','LAG',1,'4025',49),(771,'Calamba City','LAG',1,'4027',49),(772,'Calauan','LAG',1,'4012',49),(773,'Cavinti','LAG',1,'4013',49),(774,'Famy','LAG',1,'4021',49),(775,'Kalayaan','LAG',1,'4015',49),(776,'Liliw','LAG',1,'4004',49),(777,'Los Baños','LAG',1,'4030',49),(778,'Luisiana','LAG',1,'4032',49),(779,'Lumban','LAG',1,'4014',49),(780,'Mabitac','LAG',1,'4020',49),(781,'Magdalena','LAG',1,'4007',49),(782,'Majayjay','LAG',1,'4005',49),(783,'Nagcarlan','LAG',1,'4002',49),(784,'Paete','LAG',1,'4016',49),(785,'Pagsanjan','LAG',1,'4008',49),(786,'Pakil','LAG',1,'4017',49),(787,'Pangil','LAG',1,'4018',49),(788,'Pila','LAG',1,'4010',49),(789,'Rizal','LAG',1,'4003',49),(790,'San Pablo City','LAG',1,'4000',49),(791,'San Pedro','LAG',1,'4023',2),(792,'Santa Cruz','LAG',1,'4009',49),(793,'Santa Maria','LAG',1,'4022',49),(794,'Santa Rosa City','LAG',1,'4026',49),(795,'Siniloan','LAG',1,'4019',49),(796,'Victoria','LAG',1,'4011',49),(797,'Bacolod','LAN',1,'9205',63),(798,'Baloi','LAN',1,'9217',63),(799,'Baroy','LAN',1,'9210',63),(800,'Iligan City','LAN',1,'9200',63),(801,'Kapatagan','LAN',1,'9214',63),(802,'Kauswagan','LAN',1,'9202',63),(803,'Kolambugan','LAN',1,'9207',63),(804,'Lala','LAN',1,'9211',63),(805,'Linamon','LAN',1,'9201',63),(806,'Magsaysay','LAN',1,'9221',63),(807,'Maigo','LAN',1,'9206',63),(808,'Matungao','LAN',1,'9203',63),(809,'Munai','LAN',1,'9219',63),(810,'Nunungan','LAN',1,'9216',63),(811,'Pantao Ragat','LAN',1,'9208',63),(812,'Pantar','LAN',1,'9218',63),(813,'Poona Piagapo','LAN',1,'9204',63),(814,'Salvador','LAN',1,'9212',63),(815,'Sapad','LAN',1,'9213',63),(816,'Sultan Naga Dimaporo','LAN',1,'9215',63),(817,'Tagoloan','LAN',1,'9222',63),(818,'Tangcal','LAN',1,'9220',63),(819,'Tubod','LAN',1,'9209',63),(820,'Bacolod-Kalawi','LAS',1,'9316',63),(821,'Balabagan','LAS',1,'9302',63),(822,'Balindong','LAS',1,'9318',63),(823,'Bayang','LAS',1,'9309',63),(824,'Binidayan','LAS',1,'9310',63),(825,'Buadiposo-Buntong','LAS',1,'9714',63),(826,'Bubong','LAS',1,'9708',63),(827,'Bumbaran','LAS',1,'9320',63),(828,'Butig','LAS',1,'9305',63),(829,'Calanogas','LAS',1,'9319',63),(830,'Ditsaan-Ramain','LAS',1,'9713',63),(831,'Ganassi','LAS',1,'9311',63),(832,'Kapai','LAS',1,'9709',63),(833,'Kapatagan','LAS',1,'9700',63),(834,'Lumba-Bayabao','LAS',1,'9703',63),(835,'Lumbaca-Unayan','LAS',1,'9708',63),(836,'Lumbatan','LAS',1,'9307',63),(837,'Lumbayanague','LAS',1,'9306',63),(838,'Madalum','LAS',1,'9315',63),(839,'Madamba','LAS',1,'9314',63),(840,'Maguing','LAS',1,'9715',63),(841,'Malabang','LAS',1,'9300',63),(842,'Marantao','LAS',1,NULL,NULL),(843,'Marawi City','LAS',1,NULL,NULL),(844,'Marogong','LAS',1,'9303',63),(845,'Masiu','LAS',1,NULL,NULL),(846,'Mulondo','LAS',1,NULL,NULL),(847,'Pagayawan','LAS',1,'9312',63),(848,'Piagapo','LAS',1,NULL,NULL),(849,'Picong','LAS',1,NULL,NULL),(850,'Poona Bayabao','LAS',1,NULL,NULL),(851,'Pualas','LAS',1,'9313',63),(852,'Saguiaran','LAS',1,NULL,NULL),(853,'Sultan Dumalondong','LAS',1,NULL,NULL),(854,'Tagoloan Ii','LAS',1,'9321',63),(855,'Tamparan','LAS',1,NULL,NULL),(856,'Taraka','LAS',1,NULL,NULL),(857,'Tubaran','LAS',1,'9304',63),(858,'Tugaya','LAS',1,'9317',63),(859,'Wao','LAS',1,'9716',63),(860,'Abuyog','LEY',1,'6510',53),(861,'Alangalang','LEY',1,'6517',53),(862,'Albuera','LEY',1,'6542',53),(863,'Babatngon','LEY',1,'6520',53),(864,'Barugo','LEY',1,'6519',53),(865,'Bato','LEY',1,'6525',53),(866,'Baybay City','LEY',1,'6521',53),(867,'Burauen','LEY',1,'6516',53),(868,'Calubian','LEY',1,'6534',53),(869,'Capoocan','LEY',1,'6530',53),(870,'Carigara','LEY',1,'6529',53),(871,'Dagami','LEY',1,'6515',53),(872,'Dulag','LEY',1,'6505',53),(873,'Hilongos','LEY',1,'6524',53),(874,'Hindang','LEY',1,'6523',53),(875,'Inopacan','LEY',1,'6522',53),(876,'Isabel','LEY',1,'6539',53),(877,'Jaro','LEY',1,'6527',53),(878,'Javier','LEY',1,'6511',53),(879,'Julita','LEY',1,'6506',53),(880,'Kananga','LEY',1,'6531',53),(881,'La Paz','LEY',1,'6508',53),(882,'Leyte','LEY',1,'6533',53),(883,'Macarthur','LEY',1,'6509',53),(884,'Mahaplag','LEY',1,'6512',53),(885,'Matag-ob','LEY',1,'6532',53),(886,'Matalom','LEY',1,'6526',53),(887,'Mayorga','LEY',1,'6507',53),(888,'Merida','LEY',1,'6540',53),(889,'Ormoc City','LEY',1,'6541',53),(890,'Palo','LEY',1,'6501',53),(891,'Palompon','LEY',1,'6538',53),(892,'Pastrana','LEY',1,'6514',53),(893,'San Isidro','LEY',1,'6535',53),(894,'San Miguel','LEY',1,'6518',53),(895,'Santa Fe','LEY',1,'6513',53),(896,'Tabango','LEY',1,'6536',53),(897,'Tabontabon','LEY',1,'6504',53),(898,'Tacloban City','LEY',1,'6500',53),(899,'Tanauan','LEY',1,'6502',53),(900,'Tolosa','LEY',1,'6503',53),(901,'Tunga','LEY',1,'6528',53),(902,'Villaba','LEY',1,'6537',53),(903,'Ampatuan','MAG',1,'9609',64),(904,'Buluan','MAG',1,'9616',64),(905,'Cotabato City','MAG',1,'9600',64),(906,'Datu Abdullah Sangki','MAG',1,'9609',64),(907,'Datu Anggal Midtimbang','MAG',1,'9617',64),(908,'Datu Paglas','MAG',1,'9617',64),(909,'Datu Piang','MAG',1,'9607',64),(910,'Datu Saudi-Ampatuan','MAG',1,'9607',64),(911,'Datu Unsay','MAG',1,'9608',64),(912,'Gen. S. K. Pendatun','MAG',1,'9618',64),(913,'Guindulungan','MAG',1,'9612',64),(914,'Mamasapano','MAG',1,'9608',64),(915,'Mangudadatu','MAG',1,'9616',64),(916,'Pagagawan','MAG',1,'9600',64),(917,'Pagalungan','MAG',1,'9610',64),(918,'Paglat','MAG',1,'9618',64),(919,'Pandag','MAG',1,'9616',64),(920,'Rajah Buayan','MAG',1,'9611',64),(921,'Shariff Aguak','MAG',1,'9608',64),(922,'South Upi','MAG',1,'9603',64),(923,'Sultan sa Barongis','MAG',1,'9611',64),(924,'Talayan','MAG',1,'9612',64),(925,'Talitay','MAG',1,'9600',64),(926,'Boac','MAD',1,'4900',42),(927,'Buenavista','MAD',1,'4904',42),(928,'Gasan','MAD',1,'4905',42),(929,'Mogpog','MAD',1,'4901',42),(930,'Santa Cruz','MAD',1,'4902',42),(931,'Torrijos','MAD',1,'4903',42),(932,'Aroroy','MAS',1,'5414',56),(933,'Baleno','MAS',1,'5413',56),(934,'Balud','MAS',1,'5412',56),(935,'Batuan','MAS',1,'5415',56),(936,'Buenavista','MAS',1,'5421',56),(937,'Cataingan','MAS',1,'5405',56),(938,'Cawayan','MAS',1,'5405',56),(939,'Claveria','MAS',1,'5419',56),(940,'Dimasalang','MAS',1,'5403',56),(941,'Esperanza','MAS',1,'5407',56),(942,'Mandaon','MAS',1,'5411',56),(943,'Masbate City','MAS',1,'5400',56),(944,'Milagros','MAS',1,'5410',56),(945,'Mobo','MAS',1,'5401',56),(946,'Monreal','MAS',1,'5418',56),(947,'Palanas','MAS',1,'5404',56),(948,'Pio V. Corpuz','MAS',1,'5406',56),(949,'Placer','MAS',1,'5408',56),(950,'San Fernando','MAS',1,'5416',56),(951,'San Jacinto','MAS',1,'5417',56),(952,'San Pascual','MAS',1,'5420',56),(953,'Uson','MAS',1,'5402',56),(955,'Caloocan  City','MNL',1,NULL,2),(956,'City of Manila','MNL',1,NULL,2),(957,'Las Piñas  City','MNL',1,NULL,2),(958,'Makati  City','MNL',1,NULL,2),(959,'Malabon  City','MNL',1,NULL,2),(960,'Mandaluyong  City','MNL',1,NULL,2),(961,'Marikina  City','MNL',1,NULL,2),(962,'Muntinlupa  City','MNL',1,NULL,2),(963,'Navotas  City','MNL',1,NULL,2),(964,'Parañaque  City','MNL',1,NULL,2),(965,'Pasay  City','MNL',1,NULL,2),(966,'Pasig  City','MNL',1,NULL,2),(967,'Pateros','MNL',1,NULL,2),(968,'Quezon City','MNL',1,NULL,2),(969,'San Juan','MNL',1,NULL,2),(970,'Taguig','MNL',1,NULL,2),(971,'Valenzuela','MNL',1,NULL,2),(972,'Aloran','MSC',1,'7206',88),(973,'Baliangao','MSC',1,'7211',88),(974,'Bonifacio','MSC',1,'7215',88),(975,'Calamba','MSC',1,'7210',88),(976,'Clarin','MSC',1,'7201',88),(977,'Concepcion','MSC',1,'7213',88),(978,'Don Victoriano Chiongbian','MSC',1,'7200',88),(979,'Jimenez','MSC',1,'7204',88),(980,'Lopez Jaena','MSC',1,'7208',88),(981,'Oroquieta City','MSC',1,'7207',88),(982,'Ozamis City','MSC',1,'7200',88),(983,'Panaon','MSC',1,'7205',88),(984,'Plaridel','MSC',1,'7209',88),(985,'Sapang Dalaga','MSC',1,'7212',88),(986,'Sinacaban','MSC',1,'7203',88),(987,'Tangub City','MSC',1,'7214',88),(988,'Tudela','MSC',1,'7202',88),(989,'Alubijid','MSR',1,'9018',88),(990,'Balingasag','MSR',1,'9005',88),(991,'Balingoan','MSR',1,'9011',88),(992,'Binuangan','MSR',1,'9008',88),(993,'Cagayan de Oro City','MSR',1,'9000',88),(994,'Claveria','MSR',1,'9004',88),(995,'El Salvador City','MSR',1,'9017',88),(996,'Gingoog City','MSR',1,'9014',88),(997,'Gitagum','MSR',1,'9020',88),(998,'Initao','MSR',1,'9022',88),(999,'Jasaan','MSR',1,'9003',88),(1000,'Kinoguitan','MSR',1,'9010',88),(1001,'Lagonglong','MSR',1,'9006',88),(1002,'Laguindingan','MSR',1,'9019',88),(1003,'Libertad','MSR',1,'9021',88),(1004,'Lugait','MSR',1,'9025',88),(1005,'Magsaysay','MSR',1,'9015',88),(1006,'Manticao','MSR',1,'9024',88),(1007,'Medina','MSR',1,'9013',88),(1008,'Naawan','MSR',1,'9023',88),(1009,'Opol','MSR',1,'9016',88),(1010,'Salay','MSR',1,'9007',88),(1011,'Sugbongcogon','MSR',1,'9009',88),(1012,'Tagoloan','MSR',1,'9001',88),(1013,'Talisayan','MSR',1,'9012',88),(1014,'Villanueva','MSR',1,'9002',88),(1015,'Barlig','MOU',1,'2623',74),(1016,'Bauko','MOU',1,'2621',74),(1017,'Besao','MOU',1,'2618',74),(1018,'Bontoc','MOU',1,'2616',74),(1019,'Natonin','MOU',1,'2624',74),(1020,'Paracelis','MOU',1,'2625',74),(1021,'Sabangan','MOU',1,'2622',74),(1022,'Sadanga','MOU',1,'2617',74),(1023,'Sagada','MOU',1,'2619',74),(1024,'Tadian','MOU',1,'2620',74),(1025,'Bacolod City','NEC',1,'6100',34),(1026,'Bago City','NEC',1,'6101',34),(1027,'Binalbagan','NEC',1,'6107',34),(1028,'Cadiz City','NEC',1,'6121',34),(1029,'Calatrava','NEC',1,'6126',34),(1030,'Candoni','NEC',1,'6110',34),(1031,'Cauayan','NEC',1,'6112',34),(1032,'Enrique B. Magalona','NEC',1,'6118',34),(1033,'Escalante City','NEC',1,'6124',34),(1034,'Himamaylan City','NEC',1,'6108',34),(1035,'Hinigaran','NEC',1,'6106',34),(1036,'Hinoba-an','NEC',1,'6114',34),(1037,'Ilog','NEC',1,'6109',34),(1038,'Isabela','NEC',1,'6128',34),(1039,'Kabankalan City','NEC',1,'6100',34),(1040,'La Carlota City','NEC',1,'6130',34),(1041,'La Castellana','NEC',1,'6131',34),(1042,'Manapla','NEC',1,'6120',34),(1043,'Moises Padilla','NEC',1,'6132',34),(1044,'Murcia','NEC',1,'6129',34),(1045,'Pontevedra','NEC',1,'6105',34),(1046,'Pulupandan','NEC',1,'6102',34),(1047,'Sagay City','NEC',1,'6122',34),(1048,'Salvador Benedicto','NEC',1,'6117',34),(1049,'San Carlos City','NEC',1,'6127',34),(1050,'San Enrique','NEC',1,'6104',34),(1051,'Silay City','NEC',1,'6116',34),(1052,'Sipalay City','NEC',1,'6113',34),(1053,'Talisay City','NEC',1,'6115',34),(1054,'Toboso','NEC',1,'6125',34),(1055,'Valladolid','NEC',1,'6103',34),(1056,'Victorias City','NEC',1,'6119',34),(1057,'Amlan','NER',1,'6203',35),(1058,'Ayungon','NER',1,'6210',35),(1059,'Bacong','NER',1,'6216',35),(1060,'Bais  City','NER',1,'6206',35),(1061,'Basay','NER',1,'6222',35),(1062,'Bayawan  City','NER',1,'6221',35),(1063,'Bindoy','NER',1,'6209',35),(1064,'Canlaon  City','NER',1,'6223',35),(1065,'Dauin','NER',1,'6217',35),(1066,'Dumaguete  City','NER',1,'6200',35),(1067,'Guihulngan  City','NER',1,'6214',35),(1068,'Jimalalud','NER',1,'6212',35),(1069,'La Libertad','NER',1,'6213',35),(1070,'Mabinay','NER',1,'6208',35),(1071,'Manjuyod','NER',1,'6208',35),(1072,'Pamplona','NER',1,'6205',35),(1073,'San Jose','NER',1,'6202',35),(1074,'Santa Catalina','NER',1,'6220',35),(1075,'Siaton','NER',1,'6219',35),(1076,'Sibulan','NER',1,'6201',35),(1077,'Tanjay City','NER',1,'6204',35),(1078,'Tayasan','NER',1,'6211',35),(1079,'Valencia','NER',1,'6215',35),(1080,'Vallehermoso','NER',1,'6224',35),(1081,'Zamboanguita','NER',1,'6218',35),(1082,'Allen','NSA',1,'6405',55),(1083,'Biri','NSA',1,'6410',55),(1084,'Bobon','NSA',1,'6401',55),(1085,'Capul','NSA',1,'6408',55),(1086,'Catarman','NSA',1,'6400',55),(1087,'Catubig','NSA',1,'6418',55),(1088,'Gamay','NSA',1,'6422',55),(1089,'Laoang','NSA',1,'6411',55),(1090,'Lapinig','NSA',1,'6423',55),(1091,'Las Navas','NSA',1,'6420',55),(1092,'Lavezares','NSA',1,'6404',55),(1093,'Lope de Vega','NSA',1,'6403',55),(1094,'Mapanas','NSA',1,'6412',55),(1095,'Mondragon','NSA',1,'6417',55),(1096,'Palapag','NSA',1,'6421',55),(1097,'Pambujan','NSA',1,'6413',55),(1098,'Rosario','NSA',1,'6416',55),(1099,'San Antonio','NSA',1,'6407',55),(1100,'San Isidro','NSA',1,'6409',55),(1101,'San Jose','NSA',1,'6402',55),(1102,'San Roque','NSA',1,'6415',55),(1103,'San Vicente','NSA',1,'6419',55),(1104,'Silvino Lobos','NSA',1,'6414',55),(1105,'Victoria','NSA',1,'6406',55),(1106,'Aliaga','NUE',1,'3111',44),(1107,'Bongabon','NUE',1,'3128',44),(1108,'Cabanatuan City','NUE',1,'3100',44),(1109,'Cabiao','NUE',1,'3107',44),(1110,'Carranglan','NUE',1,'3123',44),(1111,'Cuyapo','NUE',1,'3117',44),(1112,'Gabaldon','NUE',1,'3131',44),(1113,'Gapan City','NUE',1,'3105',44),(1114,'General Mamerto Natividad','NUE',1,'3125',44),(1115,'General Tinio','NUE',1,'3104',44),(1116,'Guimba','NUE',1,'3115',44),(1117,'Jaen','NUE',1,'3109',44),(1118,'Laur','NUE',1,'3129',44),(1119,'Licab','NUE',1,'3112',44),(1120,'Llanera','NUE',1,'3126',44),(1121,'Lupao','NUE',1,'3122',44),(1122,'Nampicuan','NUE',1,'3116',44),(1123,'Palayan City','NUE',1,'3132',44),(1124,'Pantabangan','NUE',1,'3124',44),(1125,'Peñaranda','NUE',1,'3103',44),(1126,'Quezon','NUE',1,'3113',44),(1127,'Rizal','NUE',1,'3127',44),(1128,'San Antonio','NUE',1,'3108',44),(1129,'San Isidro','NUE',1,'3106',44),(1130,'San Jose City','NUE',1,'3121',44),(1131,'San Leonardo','NUE',1,'3102',44),(1132,'Santa Rosa','NUE',1,'3101',44),(1133,'Santo Domingo','NUE',1,'3133',44),(1134,'Science City of Muñoz','NUE',1,'3119',44),(1135,'Talavera','NUE',1,'3114',44),(1136,'Talugtug','NUE',1,'3118',44),(1137,'Zaragoza','NUE',1,'3110',44),(1138,'Alfonso Castaneda','NUV',1,'3714',78),(1139,'Ambaguio','NUV',1,'3701',78),(1140,'Aritao','NUV',1,'3704',78),(1141,'Bagabag','NUV',1,'3711',78),(1142,'Bambang','NUV',1,'3702',78),(1143,'Bayombong','NUV',1,'3700',78),(1144,'Diadi','NUV',1,'3712',78),(1145,'Dupax del Norte','NUV',1,'3706',78),(1146,'Dupax del Sur','NUV',1,'3707',78),(1147,'Kasibu','NUV',1,'3703',78),(1148,'Kayapa','NUV',1,'3708',78),(1149,'Quezon','NUV',1,'3713',78),(1150,'Santa Fe','NUV',1,'3705',78),(1151,'Solano','NUV',1,'3709',78),(1152,'Villaverde','NUV',1,'3710',78),(1153,'Abra de Ilog','MDC',1,'5108',43),(1154,'Calintaan','MDC',1,'5102',43),(1155,'Looc','MDC',1,'5111',43),(1156,'Lubang','MDC',1,'5109',43),(1157,'Magsaysay','MDC',1,'5101',43),(1158,'Mamburao','MDC',1,'5106',43),(1159,'Paluan','MDC',1,'5107',43),(1160,'Rizal','MDC',1,'5103',43),(1161,'Sablayan','MDC',1,'5104',43),(1162,'San Jose','MDC',1,'5100',43),(1163,'Santa Cruz','MDC',1,'5105',43),(1164,'Baco','MDR',1,'5201',43),(1165,'Bansud','MDR',1,'5210',43),(1166,'Bongabong','MDR',1,'5211',43),(1167,'Bulalacao','MDR',1,'5214',43),(1168,'Calapan City','MDR',1,'5200',43),(1169,'Gloria','MDR',1,'5209',43),(1170,'Mansalay','MDR',1,'5208',43),(1171,'Naujan','MDR',1,'5204',43),(1172,'Pinamalayan','MDR',1,'5208',43),(1173,'Pola','MDR',1,'5206',43),(1174,'Puerto Galera','MDR',1,'5203',43),(1175,'Roxas','MDR',1,'5212',43),(1176,'San Teodoro','MDR',1,'5202',43),(1177,'Socorro','MDR',1,'5207',43),(1178,'Victoria','MDR',1,'5205',43),(1179,'Aborlan','PLW',1,'5302',48),(1180,'Agutaya','PLW',1,'5320',48),(1181,'Araceli','PLW',1,'5311',48),(1182,'Balabac','PLW',1,'5307',48),(1183,'Bataraza','PLW',1,'5306',48),(1184,'Brooke Point','PLW',1,'5305',48),(1185,'Busuanga','PLW',1,'5317',48),(1186,'Cagayancillo','PLW',1,'5321',48),(1187,'Coron','PLW',1,'5316',48),(1188,'Culion','PLW',1,'5315',48),(1189,'Cuyo','PLW',1,'5318',48),(1190,'Dumaran','PLW',1,'5310',48),(1191,'El Nido','PLW',1,'5313',48),(1192,'Kalayaan','PLW',1,'5322',48),(1193,'Linapacan','PLW',1,'5314',48),(1194,'Magsaysay','PLW',1,'5319',48),(1195,'Narra','PLW',1,'5303',48),(1196,'Puerto Princesa City','PLW',1,'5300',48),(1197,'Quezon','PLW',1,'5304',48),(1198,'Rizal','PLW',1,'5300',48),(1199,'Roxas','PLW',1,'5308',48),(1200,'San Vicente','PLW',1,'5309',48),(1201,'Sofronio Española','PLW',1,'5301',48),(1202,'Taytay','PLW',1,'5312',48),(1203,'Angeles City','PAM',1,'2009',45),(1204,'Apalit','PAM',1,'2016',45),(1205,'Arayat','PAM',1,'2012',45),(1206,'Bacolor','PAM',1,'2001',45),(1207,'Candaba','PAM',1,'2013',45),(1208,'City of San Fernando','PAM',1,'2000',45),(1209,'Floridablanca','PAM',1,'2006',45),(1210,'Guagua','PAM',1,'2003',45),(1211,'Lubao','PAM',1,'2005',45),(1212,'Mabalacat','PAM',1,'2010',45),(1213,'Macabebe','PAM',1,'2018',45),(1214,'Magalang','PAM',1,'2011',45),(1215,'Masantol','PAM',1,'2017',45),(1216,'Mexico','PAM',1,'2021',45),(1217,'Minalin','PAM',1,'2019',45),(1218,'Porac','PAM',1,'2008',45),(1219,'San Luis','PAM',1,'2014',45),(1220,'San Simon','PAM',1,'2015',45),(1221,'Santa Ana','PAM',1,'2022',45),(1222,'Santa Rita','PAM',1,'2002',45),(1223,'Santo Tomas','PAM',1,'2020',45),(1224,'Sasmuan','PAM',1,'2004',45),(1225,'Agno','PAN',1,'2408',75),(1226,'Aguilar','PAN',1,'2415',75),(1227,'Alaminos City','PAN',1,'2404',75),(1228,'Alcala','PAN',1,'2425',75),(1229,'Anda','PAN',1,'2405',75),(1230,'Asingan','PAN',1,'2439',75),(1231,'Balungao','PAN',1,'2442',75),(1232,'Bani','PAN',1,'2407',75),(1233,'Basista','PAN',1,'2422',75),(1234,'Bautista','PAN',1,'2424',75),(1235,'Bayambang','PAN',1,'2423',75),(1236,'Binalonan','PAN',1,'2436',75),(1237,'Binmaley','PAN',1,'2417',75),(1238,'Bolinao','PAN',1,'2406',75),(1239,'Bugallon','PAN',1,'2416',75),(1240,'Burgos','PAN',1,'2410',75),(1241,'Calasiao','PAN',1,'2418',75),(1242,'Dagupan City','PAN',1,'2400',75),(1243,'Dasol','PAN',1,'2411',75),(1244,'Infanta','PAN',1,'2412',75),(1245,'Labrador','PAN',1,'2402',75),(1246,'Laoac','PAN',1,'2437',75),(1247,'Lingayen','PAN',1,'2401',75),(1248,'Mabini','PAN',1,'2409',75),(1249,'Malasiqui','PAN',1,'2421',75),(1250,'Manaoag','PAN',1,'2430',75),(1251,'Mangaldan','PAN',1,'2432',75),(1252,'Mangatarem','PAN',1,'2413',75),(1253,'Mapandan','PAN',1,'2429',75),(1254,'Natividad','PAN',1,'2446',75),(1255,'Pozzorubio','PAN',1,'2435',75),(1256,'Rosales','PAN',1,'2441',75),(1257,'San Carlos City','PAN',1,'2420',75),(1258,'San Fabian','PAN',1,'2433',75),(1259,'San Jacinto','PAN',1,'2431',75),(1260,'San Manuel','PAN',1,'2438',75),(1261,'San Nicolas','PAN',1,'2447',75),(1262,'San Quintin','PAN',1,'2444',75),(1263,'Santa Barbara','PAN',1,'2419',75),(1264,'Santa Maria','PAN',1,'2440',75),(1265,'Santo Tomas','PAN',1,'2426',75),(1266,'Sison','PAN',1,'2434',75),(1267,'Sual','PAN',1,'2403',75),(1268,'Tayug','PAN',1,'2445',75),(1269,'Umingan','PAN',1,'2443',75),(1270,'Urbiztondo','PAN',1,'2414',75),(1271,'Urdaneta City','PAN',1,'2428',75),(1272,'Villasis','PAN',1,'2427',75),(1273,'Agdangan','QUE',1,'4304',42),(1274,'Alabat','QUE',1,'4333',42),(1275,'Atimonan','QUE',1,'4331',42),(1276,'Buenavista','QUE',1,'4320',42),(1277,'Burdeos','QUE',1,'4340',42),(1278,'Calauag','QUE',1,'4318',42),(1279,'Candelaria','QUE',1,'4323',42),(1280,'Catanauan','QUE',1,'4311',42),(1281,'Dolores','QUE',1,'4326',42),(1282,'General Luna','QUE',1,'4310',42),(1283,'General Nakar','QUE',1,'4338',42),(1284,'Guinayangan','QUE',1,'4319',42),(1285,'Gumaca','QUE',1,'4306',42),(1286,'Infanta','QUE',1,'4336',42),(1287,'Jomalig','QUE',1,'4342',42),(1288,'Lopez','QUE',1,'4316',42),(1289,'Lucban','QUE',1,'4328',42),(1290,'Lucena City','QUE',1,'4301',42),(1291,'Macalelon','QUE',1,'4309',42),(1292,'Mauban','QUE',1,'4330',42),(1293,'Mulanay','QUE',1,'4312',42),(1294,'Padre Burgos','QUE',1,'4303',42),(1295,'Pagbilao','QUE',1,'4302',42),(1296,'Panukulan','QUE',1,'4337',42),(1297,'Patnanungan','QUE',1,'4341',42),(1298,'Perez','QUE',1,'4334',42),(1299,'Pitogo','QUE',1,'4308',42),(1300,'Plaridel','QUE',1,'4306',42),(1301,'Polillo','QUE',1,'4339',42),(1302,'Quezon','QUE',1,'4332',42),(1303,'Real','QUE',1,'4335',42),(1304,'Sampaloc','QUE',1,'4329',42),(1305,'San Andres','QUE',1,'4314',42),(1306,'San Antonio','QUE',1,'4324',42),(1307,'San Francisco','QUE',1,'4315',42),(1308,'San Narciso','QUE',1,'4313',42),(1309,'Sariaya','QUE',1,'4322',42),(1310,'Tagkawayan','QUE',1,'4321',42),(1311,'Tayabas City','QUE',1,'4327',42),(1312,'Tiaong','QUE',1,'4325',42),(1313,'Unisan','QUE',1,'4305',42),(1314,'Aglipay','QUI',1,'3403',78),(1315,'Cabarroguis','QUI',1,'3400',78),(1316,'Diffun','QUI',1,'3401',78),(1317,'Maddela','QUI',1,'3404',78),(1318,'Nagtipunan','QUI',1,'3405',78),(1319,'Saguday','QUI',1,'3402',78),(1320,'Angono','RIZ',1,'1930',2),(1321,'Antipolo City','RIZ',1,'1870',2),(1322,'Baras','RIZ',1,'1970',2),(1323,'Binangonan','RIZ',1,'1940',2),(1324,'Cainta','RIZ',1,'1900',2),(1325,'Cardona','RIZ',1,'1950',2),(1326,'Jalajala','RIZ',1,'1990',2),(1327,'Morong','RIZ',1,'1960',2),(1328,'Pililla','RIZ',1,'1910',2),(1329,'Montalban (Rodriguez)','RIZ',1,'1860',2),(1330,'San Mateo','RIZ',1,'1850',2),(1331,'Tanay','RIZ',1,'1980',2),(1332,'Taytay','RIZ',1,'1920',2),(1333,'Teresa','RIZ',1,'1880',2),(1334,'Alcantara','ROM',1,'5509',42),(1335,'Banton','ROM',1,'5515',42),(1336,'Cajidiocan','ROM',1,'5512',42),(1337,'Calatrava','ROM',1,'5503',42),(1338,'Concepcion','ROM',1,'5516',42),(1339,'Corcuera','ROM',1,'5514',42),(1340,'Ferrol','ROM',1,'5506',42),(1341,'Looc','ROM',1,'5507',42),(1342,'Magdiwang','ROM',1,'5511',42),(1343,'Odiongan','ROM',1,'5505',42),(1344,'Romblon','ROM',1,'5500',42),(1345,'San Agustin','ROM',1,'5501',42),(1346,'San Andres','ROM',1,'5504',42),(1347,'San Fernando','ROM',1,'5513',42),(1348,'San Jose','ROM',1,'5510',42),(1349,'Santa Fe','ROM',1,'5508',42),(1350,'Santa Maria','ROM',1,'5502',42),(1351,'Almagro','WSA',1,'6724',55),(1352,'Basey','WSA',1,'6720',55),(1353,'Calbayog City','WSA',1,'6710',55),(1354,'Calbiga','WSA',1,'6715',55),(1355,'Catbalogan City','WSA',1,'6700',55),(1356,'Daram','WSA',1,'6722',55),(1357,'Gandara','WSA',1,'6706',55),(1358,'Hinabangan','WSA',1,'6713',55),(1359,'Jiabong','WSA',1,'6701',55),(1360,'Marabut','WSA',1,'6721',55),(1361,'Matuguinao','WSA',1,'6708',55),(1362,'Motiong','WSA',1,'6702',55),(1363,'Pagsanghan','WSA',1,'6705',55),(1364,'Paranas','WSA',1,'6703',55),(1365,'Pinabacdao','WSA',1,'6716',55),(1366,'San Jorge','WSA',1,'6707',55),(1367,'San Jose De Buan','WSA',1,'6723',55),(1368,'San Sebastian','WSA',1,'6714',55),(1369,'Santa Margarita','WSA',1,'6709',55),(1370,'Santa Rita','WSA',1,'6718',55),(1371,'Santo Niño','WSA',1,'6711',55),(1372,'Tagapul-an','WSA',1,'6712',55),(1373,'Talalora','WSA',1,'6719',55),(1374,'Tarangnan','WSA',1,'6704',55),(1375,'Villareal','WSA',1,'6717',55),(1376,'Zumarraga','WSA',1,'6725',55),(1377,'Alabel','SAR',1,'9501',83),(1378,'Glan','SAR',1,'9517',83),(1379,'Kiamba','SAR',1,'9514',83),(1380,'Maasim','SAR',1,'9502',83),(1381,'Maitum','SAR',1,'9515',83),(1382,'Malapatan','SAR',1,'9516',83),(1383,'Malungon','SAR',1,'9503',83),(1384,'Barira','MAG',1,'9614',64),(1385,'Buldon','MAG',1,'9615',64),(1386,'Datu Blah T. Sinsuat','MAG',1,'9602',64),(1387,'Datu Odin Sinsuat','MAG',1,'9601',64),(1388,'Kabuntulan/Northern Kabuntalan','MAG',1,'9606',64),(1389,'Matanog','MAG',1,'9613',64),(1390,'Parang','MAG',1,'9604',64),(1391,'Sultan Kudarat','MAG',1,'9605',64),(1392,'Sultan Mastura','MAG',1,'9605',64),(1393,'Upi/Datu Blah T. Sinsuat','MAG',1,'9602',64),(1394,'Enrique Villanueva','SIG',1,'6230',35),(1395,'Larena','SIG',1,'6226',35),(1396,'Lazi','SIG',1,'6228',35),(1397,'Maria','SIG',1,'6229',35),(1398,'San Juan','SIG',1,'6227',35),(1399,'Siquijor','SIG',1,'6225',35),(1400,'Barcelona','SOR',1,'4712',56),(1401,'Bulan','SOR',1,'4706',56),(1402,'Bulusan','SOR',1,'4704',56),(1403,'Casiguran','SOR',1,'4702',56),(1404,'Castilla','SOR',1,'4713',56),(1405,'Donsol','SOR',1,'4715',56),(1406,'Gubat','SOR',1,'4710',56),(1407,'Irosin','SOR',1,'4707',56),(1408,'Juban','SOR',1,'4703',56),(1409,'Magallanes','SOR',1,'4705',56),(1410,'Matnog','SOR',1,'4708',56),(1411,'Pilar','SOR',1,'4714',56),(1412,'Prieto Diaz','SOR',1,'4711',56),(1413,'Santa Magdalena','SOR',1,'4709',56),(1414,'Sorsogon City','SOR',1,'4700',56),(1415,'Banga','SCO',1,'9511',83),(1416,'General Santos City','SCO',1,'9500',83),(1417,'Koronadal City','SCO',1,'9506',83),(1418,'Lake Sebu','SCO',1,'9512',83),(1419,'Norala','SCO',1,'9508',83),(1420,'Polomolok','SCO',1,'9504',83),(1421,'Santo Niño','SCO',1,'9509',83),(1422,'Surallah','SCO',1,'9512',83),(1423,'Tampakan','SCO',1,'9507',83),(1424,'Tantangan','SCO',1,'9510',83),(1425,'T Boli','SCO',1,'9513',83),(1426,'Tupi','SCO',1,'9505',83),(1427,'Anahawan','SLE',1,'6610',53),(1428,'Bontoc','SLE',1,'6604',53),(1429,'Hinunangan','SLE',1,'6608',53),(1430,'Hinundayan','SLE',1,'6609',53),(1431,'Libagon','SLE',1,'6615',53),(1432,'Liloan','SLE',1,'6612',53),(1433,'Limasawa','SLE',1,'6618',53),(1434,'Maasin CIty','SLE',1,'6600',53),(1435,'Macrohon','SLE',1,'6601',53),(1436,'Malitbog','SLE',1,'6603',53),(1437,'Padre Burgos','SLE',1,'6602',53),(1438,'Pintuyan','SLE',1,'6614',53),(1439,'Saint Bernard','SLE',1,'6616',53),(1440,'San Francisco','SLE',1,'6613',53),(1441,'San Juan','SLE',1,'6611',53),(1442,'San Ricardo','SLE',1,'6617',53),(1443,'Silago','SLE',1,'6607',53),(1444,'Sogod','SLE',1,'6606',53),(1445,'Tomas Oppus','SLE',1,'6605',53),(1446,'Bagumbayan','SUK',1,'9810',64),(1447,'Columbio','SUK',1,'9801',64),(1448,'Esperanza','SUK',1,'9806',64),(1449,'Isulan','SUK',1,'9805',64),(1450,'Kalamansig','SUK',1,'9808',64),(1451,'Lambayong','SUK',1,'9802',64),(1452,'Lebak','SUK',1,'9807',64),(1453,'Lutayan','SUK',1,'9803',64),(1454,'Palimbang','SUK',1,'9809',64),(1455,'President Quirino','SUK',1,'9804',64),(1456,'Sen. Ninoy Aquino','SUK',1,'9811',64),(1457,'Tacurong City','SUK',1,'9800',64),(1458,'Hadji Panglima Tahil','SLU',1,'7407',68),(1459,'Indanan','SLU',1,'7407',68),(1460,'Jolo','SLU',1,'7400',68),(1461,'Kalingalan Caluang','SLU',1,'7416',68),(1462,'Lugus','SLU',1,'7411',68),(1463,'Luuk','SLU',1,'7404',68),(1464,'Maimbung','SLU',1,'7409',68),(1465,'OLD Panamao','SLU',1,'7402',68),(1466,'Omar','SLU',1,'7404',68),(1467,'Pandami','SLU',1,'7400',68),(1468,'Panglima Estino','SLU',1,'7415',68),(1469,'Pangutaran','SLU',1,'7414',68),(1470,'Parang','SLU',1,'7408',68),(1471,'Pata','SLU',1,'7405',68),(1472,'Patikul','SLU',1,'7401',68),(1473,'Siasi','SLU',1,'7412',68),(1474,'Talipao','SLU',1,'7403',68),(1475,'Tapul','SLU',1,'7410',68),(1476,'Tongkil','SLU',1,'7406',68),(1477,'Alegria','SUN',1,'8425',86),(1478,'Bacuag','SUN',1,'8408',86),(1479,'Burgos','SUN',1,'8424',86),(1480,'Claver','SUN',1,'8410',86),(1481,'Dapa','SUN',1,'8417',86),(1482,'Del Carmen','SUN',1,'8418',86),(1483,'General Luna','SUN',1,'8419',86),(1484,'Gigaquit','SUN',1,'8409',86),(1485,'Mainit','SUN',1,'8407',86),(1486,'Malimono','SUN',1,'8402',86),(1487,'Pilar','SUN',1,'8420',86),(1488,'Placer','SUN',1,'8405',86),(1489,'San Benito','SUN',1,'8423',86),(1490,'San Francisco','SUN',1,'8401',86),(1491,'San Isidro','SUN',1,'8421',86),(1492,'Santa Monica','SUN',1,'8422',86),(1493,'Sison','SUN',1,'8404',86),(1494,'Socorro','SUN',1,'8416',86),(1495,'Surigao City','SUN',1,'8400',86),(1496,'Tagana-an','SUN',1,'8403',86),(1497,'Tubod','SUN',1,'8406',86),(1498,'Barobo','SUR',1,'8309',86),(1499,'Bayabas','SUR',1,'8303',86),(1500,'Bislig CIty','SUR',1,'8311',86),(1501,'Cagwait','SUR',1,'8311',86),(1502,'Cantilan','SUR',1,'8317',86),(1503,'Carmen','SUR',1,'8315',86),(1504,'Carrascal','SUR',1,'8318',86),(1505,'Cortes','SUR',1,'8313',86),(1506,'Hinatuan','SUR',1,'8310',86),(1507,'Lanuza','SUR',1,'8314',86),(1508,'Lianga','SUR',1,'8307',86),(1509,'Lingig','SUR',1,'8312',86),(1510,'Madrid','SUR',1,'8316',86),(1511,'Marihatag','SUR',1,'8306',86),(1512,'San Agustin','SUR',1,'8305',86),(1513,'San Miguel','SUR',1,'8301',86),(1514,'Tagbina','SUR',1,'8308',86),(1515,'Tago','SUR',1,'8302',86),(1516,'Tandag CIty','SUR',1,'8300',86),(1517,'Anao','TAR',1,'2310',45),(1518,'Bamban','TAR',1,'2317',45),(1519,'Camiling','TAR',1,'2306',45),(1520,'Capas','TAR',1,'2315',45),(1521,'Concepcion','TAR',1,'2316',45),(1522,'Gerona','TAR',1,'2302',45),(1523,'La Paz','TAR',1,'2314',45),(1524,'Mayantoc','TAR',1,'2304',45),(1525,'Moncada','TAR',1,'2308',45),(1526,'Paniqui','TAR',1,'2307',45),(1527,'Pura','TAR',1,'2312',45),(1528,'Ramos','TAR',1,'2311',45),(1529,'San Clemente','TAR',1,'2305',45),(1530,'San Jose','TAR',1,'2318',45),(1531,'San Manuel','TAR',1,'2309',45),(1532,'Santa Ignacia','TAR',1,'2303',45),(1533,'Tarlac City','TAR',1,'2300',45),(1534,'Victoria','TAR',1,'2313',45),(1535,'Bongao','TAW',1,'7500',68),(1536,'Languyan','TAW',1,'7509',68),(1537,'Mapun','TAW',1,'7508',68),(1538,'Panglima Sugala','TAW',1,'7501',68),(1539,'Sapa-Sapa','TAW',1,'7503',68),(1540,'Sibutu','TAW',1,'7501',68),(1541,'Simunul','TAW',1,'7505',68),(1542,'Sitangkai','TAW',1,'7506',68),(1543,'South Ubian','TAW',1,'7504',68),(1544,'Tandubas','TAW',1,'7502',68),(1545,'Turtle Islands','TAW',1,'7507',68),(1546,'Botolan','ZMB',1,'2202',47),(1547,'Cabangan','ZMB',1,'2203',47),(1548,'Candelaria','ZMB',1,'2212',47),(1549,'Castillejos','ZMB',1,'2208',47),(1550,'Iba','ZMB',1,'2201',47),(1551,'Masinloc','ZMB',1,'2211',47),(1552,'Olongapo City','ZMB',1,'2200',47),(1553,'Palauig','ZMB',1,'2210',47),(1554,'San Antonio','ZMB',1,'2206',47),(1555,'San Felipe','ZMB',1,'2204',47),(1556,'San Marcelino','ZMB',1,'2207',47),(1557,'San Narciso','ZMB',1,'2205',47),(1558,'Santa Cruz','ZMB',1,'2213',47),(1559,'Subic','ZMB',1,'2209',47),(1560,'Bacungan','ZAN',1,'7100',65),(1561,'Baliguian','ZAN',1,'7123',65),(1562,'Dapitan City','ZAN',1,'7101',65),(1563,'Dipolog CIty','ZAN',1,'7100',65),(1564,'Godod','ZAN',1,'7100',65),(1565,'Gutalac','ZAN',1,'7108',65),(1566,'Jose Dalman','ZAN',1,'7111',65),(1567,'Kalawit','ZAN',1,'7124',65),(1568,'Katipunan','ZAN',1,'7109',65),(1569,'La Libertad','ZAN',1,'7119',65),(1570,'Labason','ZAN',1,'7119',65),(1571,'Liloy','ZAN',1,'7115',65),(1572,'Manukan','ZAN',1,'7110',65),(1573,'Mutia','ZAN',1,'7107',65),(1574,'PIñan','ZAN',1,'7105',65),(1575,'Polanco','ZAN',1,'7106',65),(1576,'Pres. Manuel A. Roxas','ZAN',1,'7104',65),(1577,'Rizal','ZAN',1,'7104',65),(1578,'Salug','ZAN',1,'7114',65),(1579,'Sergio Osmeña Sr.','ZAN',1,'7108',65),(1580,'Siayan','ZAN',1,'7113',65),(1581,'Sibuco','ZAN',1,'7122',65),(1582,'Sibutad','ZAN',1,'7103',65),(1583,'Sindangan','ZAN',1,'7112',65),(1584,'Siocon','ZAN',1,'7120',65),(1585,'Sirawai','ZAN',1,'7121',65),(1586,'Tampilisan','ZAN',1,'7116',65),(1587,'Aurora','ZAS',1,'7020',62),(1588,'Bayog','ZAS',1,'7011',62),(1589,'Dimataling','ZAS',1,'7032',62),(1590,'Dinas','ZAS',1,'7030',62),(1591,'Dumalinao','ZAS',1,'7015',62),(1592,'Dumingag','ZAS',1,'7028',62),(1593,'Guipos','ZAS',1,'7042',62),(1594,'Josefina','ZAS',1,'7027',62),(1595,'Kumalarang','ZAS',1,'7013',62),(1596,'Labangan','ZAS',1,'7017',62),(1597,'Lakewood','ZAS',1,'7014',62),(1598,'Lapuyan','ZAS',1,'7037',62),(1599,'Mahayag','ZAS',1,'7026',62),(1600,'Margosatubig','ZAS',1,'7024',62),(1601,'Midsalip','ZAS',1,'7021',62),(1602,'Molave','ZAS',1,'7023',62),(1603,'Pagadian City','ZAS',1,'7016',62),(1604,'Pitogo','ZAS',1,'7033',62),(1605,'Ramon Magsaysay','ZAS',1,'7024',62),(1606,'San Miguel','ZAS',1,'7002',62),(1607,'San Pablo','ZAS',1,'7031',62),(1608,'Sominot','ZAS',1,'7022',62),(1609,'Tabina','ZAS',1,'7034',62),(1610,'Tambulig','ZAS',1,'7025',62),(1611,'Tigbao','ZAS',1,'7043',62),(1612,'Tukuran','ZAS',1,'7019',62),(1613,'Vincenzo A. Sagun','ZAS',1,'7036',62),(1614,'Zamboanga City','ZAS',1,'7000',62),(1615,'Alicia','ZSI',1,'7040',62),(1616,'Buug','ZSI',1,'7009',62),(1617,'Diplahan','ZSI',1,'7039',62),(1618,'Imelda','ZSI',1,'7007',62),(1619,'Ipil','ZSI',1,'7001',62),(1620,'Kabasalan','ZSI',1,'7005',62),(1621,'Mabuhay','ZSI',1,'7010',62),(1622,'Malangas','ZSI',1,'7038',62),(1623,'Naga','ZSI',1,'7004',62),(1624,'Olutanga','ZSI',1,'7041',62),(1625,'Payao','ZSI',1,'7008',62),(1626,'Roseller Lim','ZSI',1,'7002',62),(1627,'Siay','ZSI',1,'7006',62),(1628,'Talusan','ZSI',1,'7012',62),(1629,'Titay','ZSI',1,'7003',62),(1630,'Tungawan','ZSI',1,'7018',62),(1631,'Isabela de Basilan','BAS',1,'7300',62),(1632,'Bataan Export Processing Zone (BEPZ) Mariveles','BAN',1,'2106',47),(1633,'Lamao','BAN',1,'2104',47),(1634,'Refugee Processing Center (Morong)','BAN',1,'2109',47),(1635,'Fernando Air Base','BTG',1,'4218',43),(1636,'Lepanto','BEN',1,'2609',74),(1637,'Philippine Military Academy (PMA)','BEN',1,'2602',74),(1638,'Carlos P. Garcia (Dao)','BOH',1,'6346',38),(1639,'Kabanglasan','BUK',1,'8723',88),(1640,'Musuan','BUK',1,'8710',88),(1641,'Philips','BUK',1,'8705',88),(1642,'Sapang Palay','BUL',1,'3024',44),(1643,'Imelda','CAN',1,'4610',54),(1644,'Tulay na Lupa','CAN',1,'4612',54),(1645,'Cavite Naval Base','CAV',1,'4101',46),(1646,'Corregidor','CAV',1,'4125',46),(1647,'Dasmarinias ResettlementArea','CAV',1,'4115',46),(1648,'Mactan Airport','CEB',1,'6016',32),(1649,'Babak','DAV',1,'8118',84),(1650,'Kaputian','DAV',1,'8120',84),(1651,'Samal','DAV',1,'8119',84),(1652,'San Mariano','DAV',1,'8116',84),(1653,'San Vicente','DAV',1,'8103',84),(1654,'Potia','IFU',1,'3608',74),(1655,'Espiritu','ILN',1,'2908',77),(1656,'San Miguel (Callang)','ISA',1,'3317',78),(1657,'Damortis','LUN',1,'2507',72),(1658,'Botocan','LAG',1,'4006',49),(1659,'Camp Vicente Lim','LAG',1,'4029',49),(1660,'Canlubang','LAG',1,'4028',49),(1661,'College Los Banos','LAG',1,'4031',49),(1662,'Karomatan','LAN',1,'9215',63),(1663,'Bacolod Grande','LAS',1,'9316',63),(1664,'Macador Andong','LAS',1,'9308',63),(1665,'Sultan Gumander','LAS',1,'9303',63),(1666,'Buadiposo Buntong','LAS',1,'9714',63),(1667,'Bubong','LAS',1,'9708',63),(1668,'Kapal','LAS',1,'9709',63),(1669,'Lumba Bayabao','LAS',1,'9703',63),(1670,'Maguing','LAS',1,'9715',63),(1671,'Marangtao','LAS',1,'9711',63),(1672,'Marawi City','LAS',1,'9700',63),(1673,'Masio','LAS',1,'9706',63),(1674,'Mulondo','LAS',1,'9702',63),(1675,'Piagapo','LAS',1,'9710',63),(1676,'Poona Bayabao','LAS',1,'9705',63),(1677,'Ramain-Ditsaan','LAS',1,'9713',63),(1678,'Saguiaran','LAS',1,'9701',63),(1679,'Tamparan','LAS',1,'9704',63),(1680,'Taraka','LAS',1,'9712',63),(1681,'Barira','MAG',1,'9614',64),(1682,'Buldon','MAG',1,'9615',64),(1683,'Datu Odin Sinsuat (Dinaig)','MAG',1,'9601',64),(1684,'Kabuntulan','MAG',1,'9606',64),(1685,'Maganoy','MAG',1,'9608',64),(1686,'Matanog','MAG',1,'9613',64),(1687,'Parang','MAG',1,'9604',64),(1688,'Sultan Kudarat','MAG',1,'9605',64),(1689,'Sultan Sa Barongis','MAG',1,'9611',64),(1690,'Upi','MAG',1,'9602',64),(1691,'Tilik','MDC',1,'5110',43),(1692,'Kauayan','NEC',1,'6112',34),(1693,'Paraiso (Fabrica)','NEC',1,'6123',34),(1694,'Pontevedra','NEC',1,'6105',34),(1695,'Silay Hawaiian Central','NEC',1,'6117',34),(1696,'Sta. Catalina','NER',1,'6220',35),(1697,'La Navas','NSA',1,'6420',55),(1698,'Central Luzon StateUniversity (CLSU)','NUE',1,'3120',44),(1699,'Fort Magsaysay','NUE',1,'3130',44),(1700,'Munoz','NUE',1,'3119',44),(1701,'Iwahig Penal Colony','PLW',1,'5301',48),(1702,'Taytay','PLW',1,'5312',48),(1703,'Basa Air Base','PAM',1,'2007',45),(1704,'Hondagua','QUE',1,'4317',42),(1705,'Quezon Capitol','QUE',1,'4300',42),(1706,'Imelda','ROM',1,'5502',42),(1707,'Wright','WSA',1,'6703',55),(1708,'Bacon','SOR',1,'4701',56),(1709,'St. Bernard','SLE',1,'6616',53),(1710,'Mariano Marcos','SUK',1,'9802',64),(1711,'Marungas','SLU',1,'7413',68),(1712,'Basilisa (Rizal)','SUN',1,'8413',86),(1713,'Cagdianao','SUN',1,'8411',86),(1714,'Dinagat','SUN',1,'8412',86),(1715,'Libjo (Albor)','SUN',1,'8414',86),(1716,'Loreto','SUN',1,'8415',86),(1717,'San Jose','SUN',1,'8427',86),(1718,'Tubajon','SUN',1,'8426',86),(1719,'San Miguel','TAR',1,'2301',45),(1720,'Balimbing','TAW',1,'7501',68),(1721,'Cagayan de Sulu','TAW',1,'7508',68),(1722,'Labason','ZAN',1,'7117',65),(1723,'Roxas','ZAN',1,'7102',65),(1724,'Don Mariano Marcos','ZAS',1,'7022',62),(1725,'Margo Sa Tubig','ZAS',1,'7035',62),(1726,'San Miguel','ZAS',1,'7029',62);

/*Table structure for table `citizenships` */

DROP TABLE IF EXISTS `citizenships`;

CREATE TABLE `citizenships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `citizenships` */

insert  into `citizenships`(`id`,`name`,`order`,`created`,`modified`) values (11,'Filipino',2,'2016-02-03 08:06:42','2016-02-05 07:08:15'),(12,'Korean',1,'2016-02-03 08:06:45','2016-02-05 07:08:15'),(19,'Japanese',3,'2016-02-04 07:10:09','2016-02-05 07:08:15');

/*Table structure for table `contact_numbers` */

DROP TABLE IF EXISTS `contact_numbers`;

CREATE TABLE `contact_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `number` varchar(12) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `contact_numbers` */

insert  into `contact_numbers`(`id`,`student_id`,`type`,`number`,`created`,`modified`) values (1,24,'landline','15464','2016-02-04 08:58:58','2016-02-04 08:58:58'),(2,24,'mobile','546464','2016-02-04 08:58:58','2016-02-04 08:58:58'),(3,25,'landline','12312','2016-02-04 09:01:33','2016-02-04 09:01:33'),(4,25,'mobile','31231','2016-02-04 09:01:33','2016-02-04 09:01:33'),(5,26,'landline','123456','2016-02-04 09:04:14','2016-02-04 09:04:14'),(6,26,'mobile','1263459687','2016-02-04 09:04:14','2016-02-04 09:04:14'),(7,27,'landline','123456','2016-02-10 04:30:38','2016-02-10 04:30:38'),(8,27,'mobile','123645654','2016-02-10 04:30:38','2016-02-10 04:30:38');

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` char(2) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `call_code` int(2) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `countries` */

insert  into `countries`(`id`,`name`,`call_code`,`order`) values ('PH','Philippines',63,1),('US','United States of America',1,2);

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` char(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(140) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `fees_applicable` varchar(140) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `discounts` */

insert  into `discounts`(`id`,`name`,`description`,`type`,`amount`,`fees_applicable`,`created`,`modified`) values ('DSCA','Discount A','Full Scholarship','percent','100.00','all','2016-02-05 01:04:10','2016-02-05 01:04:10'),('DSCB','Discount B','50% Off','percent','50.00','TUI,MSC','2016-02-05 01:04:31','2016-02-05 01:04:31');

/*Table structure for table `educ_levels` */

DROP TABLE IF EXISTS `educ_levels`;

CREATE TABLE `educ_levels` (
  `id` char(2) NOT NULL,
  `name` varchar(15) DEFAULT NULL,
  `alias` varchar(5) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `educ_levels` */

insert  into `educ_levels`(`id`,`name`,`alias`,`order`,`created`,`modified`) values ('GS','Grade School','GS',2,'2016-01-26 07:25:41','2016-01-27 01:22:50'),('HS','High School','HS',3,'2016-01-26 07:25:56','2016-01-27 01:22:54'),('PS','Preschool','PS',1,'2016-01-26 07:25:49','2016-01-27 01:22:58'),('SH','Senior High','SH',4,'2016-02-04 08:20:11','2016-02-04 08:20:11');

/*Table structure for table `families` */

DROP TABLE IF EXISTS `families`;

CREATE TABLE `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` char(11) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `name` varchar(140) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `families` */

insert  into `families`(`id`,`student_id`,`type`,`name`,`occupation`,`created`,`modified`) values (1,'21','Parent','Fe','tr','2016-02-04 08:54:42','2016-02-04 08:54:42'),(2,'22','Parent','Fe','tr','2016-02-04 08:56:50','2016-02-04 08:56:50'),(3,'24','Parent','Fe','tr','2016-02-04 08:58:58','2016-02-04 08:58:58'),(4,'25','Gaurdian','2','sfs','2016-02-04 09:01:33','2016-02-04 09:01:33'),(5,'26','Parent','Fe Alaras','Teacher','2016-02-04 09:04:14','2016-02-04 09:04:14'),(6,'27','Parent','Fe','Teacher','2016-02-10 04:30:38','2016-02-10 04:30:38');

/*Table structure for table `fee_breakdowns` */

DROP TABLE IF EXISTS `fee_breakdowns`;

CREATE TABLE `fee_breakdowns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tuition_id` char(7) DEFAULT NULL,
  `fee_id` char(3) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `fee_breakdowns` */

insert  into `fee_breakdowns`(`id`,`tuition_id`,`fee_id`,`amount`,`order`) values (29,'G7REG16','MDF','157.50',2),(30,'G7REG16','LFT','465.00',3),(31,'G7REG16','LIB','157.50',4),(32,'G7REG16','ATH','355.00',6),(33,'G7REG16','GUI','165.00',7),(34,'G7REG16','COM','2950.00',11),(35,'G7REG16','ENG','1500.00',12),(36,'G7REG16','VOC','355.00',5),(37,'G7REG16','GOV','75.00',9),(38,'G7REG16','DEV','1400.00',10),(39,'G7REG16','TST','320.00',8),(40,'G7REG16','TTP','337.50',13),(41,'G7REG16','ORG','225.00',14),(42,'G7REG16','INS','165.00',15),(43,'G7REG16','IDL','315.00',16),(44,'G7REG16','ECA','120.00',17),(45,'G7REG16','PEU','562.50',18),(46,'G7REG16','PTA','105.00',19),(47,'G7REG16','MAG','845.00',20),(49,'G7REG16','TUI','8215.00',1),(50,'G7REG16','SHB','180.00',21);

/*Table structure for table `fees` */

DROP TABLE IF EXISTS `fees`;

CREATE TABLE `fees` (
  `id` char(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fees` */

insert  into `fees`(`id`,`name`,`order`,`created`,`modified`) values ('ATH','Athletics',8,'2016-02-05 00:37:06','2016-02-05 07:09:11'),('BSP','BSP/GSP',11,'2016-02-05 00:37:54','2016-02-05 07:09:11'),('CLA','Class Picture',14,'2016-02-05 00:38:29','2016-02-05 07:09:11'),('COM','Computer Fee',21,'2016-02-05 00:39:52','2016-02-05 07:09:11'),('DEV','Development Fee',25,'2016-02-18 08:39:39','2016-02-18 08:39:39'),('ECA','ECA Fee',27,'2016-02-18 08:44:03','2016-02-18 08:44:03'),('ENG','Energy Fee',20,'2016-02-05 00:39:45','2016-02-05 07:09:11'),('GOV','Government Char',24,'2016-02-18 08:39:28','2016-02-18 08:39:28'),('GRA','Graduation Fee',18,'2016-02-05 00:39:27','2016-02-05 07:09:11'),('GUI','Guidance',5,'2016-02-05 00:36:45','2016-02-05 07:09:11'),('IDL','ID Lamination',12,'2016-02-05 00:38:04','2016-02-05 07:09:11'),('INM','Instructional Material',15,'2016-02-05 00:38:47','2016-02-05 07:09:11'),('INS','Insurance',6,'2016-02-05 00:36:51','2016-02-05 07:09:11'),('LFS','Laboratory Fee - Science',10,'2016-02-05 00:37:38','2016-02-05 07:09:11'),('LFT','Laboratory Fee - TLE',9,'2016-02-05 00:37:24','2016-02-05 07:09:11'),('LIB','Library',7,'2016-02-05 00:36:59','2016-02-05 07:09:11'),('MAG','Supplementary Magazine',30,'2016-02-18 08:44:46','2016-02-18 08:44:46'),('MDF','Medical / Dental',4,'2016-02-05 00:36:35','2016-02-05 07:09:11'),('MSC','Miscllaneous',2,'2016-02-05 02:41:39','2016-02-05 07:09:11'),('ORG','School Organization',16,'2016-02-05 00:39:03','2016-02-05 07:09:11'),('PEU','MAPEH Uniform',28,'2016-02-18 08:44:20','2016-02-18 08:44:20'),('PTA','PTA',29,'2016-02-18 08:44:35','2016-02-18 08:44:35'),('REC','Recollection',17,'2016-02-05 00:39:14','2016-02-05 07:09:11'),('REG','Registration',3,'2016-02-05 00:36:19','2016-02-05 07:09:11'),('REP','Report Card',13,'2016-02-05 00:38:16','2016-02-05 07:09:11'),('SHB','Student Handbook',31,'2016-02-18 08:44:56','2016-02-18 08:44:56'),('TST','Testing Fee',23,'2016-02-18 08:39:11','2016-02-18 08:39:11'),('TTP','Test Papers',26,'2016-02-18 08:39:56','2016-02-18 08:39:56'),('TUI','Tuition Fee',1,'2016-02-05 00:35:56','2016-02-05 07:09:11'),('VOC','Vocational Fee',22,'2016-02-18 08:39:01','2016-02-18 08:39:01'),('YRB','Yearbook',19,'2016-02-05 00:39:35','2016-02-05 07:09:11');

/*Table structure for table `maintenance_lists` */

DROP TABLE IF EXISTS `maintenance_lists`;

CREATE TABLE `maintenance_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(140) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `maintenance_lists` */

insert  into `maintenance_lists`(`id`,`name`,`description`,`path`,`order`,`created`,`modified`) values (2,'Year Level','List of Year Levels','year_levels',6,'2016-02-03 06:08:19','2016-02-05 07:59:18'),(4,'Religion','List of Religions','religions',7,'2016-02-03 06:08:44','2016-02-05 07:59:18'),(5,'Citizenship','List of Citizenships','citizenships',8,'2016-02-03 06:09:03','2016-02-05 07:59:18'),(13,'Department','List of Departments','educ_levels',9,'2016-02-04 08:19:56','2016-02-05 07:59:18'),(14,'Country','List of Countries','countries',10,'2016-02-04 08:21:40','2016-02-05 07:59:18'),(15,'Province','List of Provinces','provinces',12,'2016-02-04 08:25:03','2016-02-05 07:59:18'),(16,'Barangay','List of Barangays','barangays',11,'2016-02-04 08:30:35','2016-02-05 07:59:18'),(17,'List','List of Maintenance','maintenance_lists',5,'2016-02-04 08:35:53','2016-02-05 07:59:18'),(22,'Fee','List of Fees','fees',4,'2016-02-05 00:35:46','2016-02-05 07:59:18'),(23,'Discount','List of Discounts','discounts',3,'2016-02-05 01:01:44','2016-02-05 07:59:18'),(24,'Payment Scheme','List of Payment Schemes','schemes',2,'2016-02-05 01:02:07','2016-02-05 07:59:18'),(26,'Section','List of Sections','sections',1,'2016-02-05 04:14:01','2016-02-05 07:59:18'),(27,'Billing Period','List of Billing Periods','billing_periods',NULL,'2016-02-05 08:12:29','2016-02-05 08:12:29'),(28,'Program','List of Programs','programs',NULL,'2016-02-18 07:51:13','2016-02-18 07:51:13');

/*Table structure for table `payment_scheme_schedules` */

DROP TABLE IF EXISTS `payment_scheme_schedules`;

CREATE TABLE `payment_scheme_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_scheme_id` char(7) DEFAULT NULL,
  `billing_period_id` char(4) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `due_dates` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `payment_scheme_schedules` */

insert  into `payment_scheme_schedules`(`id`,`payment_scheme_id`,`billing_period_id`,`amount`,`due_dates`) values (1,'G7RE16A','UPEN','18700.00','2016-06-05'),(3,'G7RE16S','UPEN','10000.00','2016-06-05'),(4,'G7RE16M','UPEN','9970.00','2016-06-05'),(5,'G7RE16E','UPEN','10870.00','2016-06-05'),(6,'G7RE16S','SEM2','8600.00','2016-10-05'),(7,'G7RE16M','MO9X','1000.00','2016-07-05,2016-08-05,2016-09-05,2016-10-05,2016-11-05,2016-12-05,2017-01-05,2017-02-05,2017-03-05'),(9,'G7RE16E','MO9X','985.00','2016-07-05,2016-08-05,2016-09-05,2016-10-05,2016-11-05,2016-12-05,2017-01-05,2017-02-05,2017-03-05');

/*Table structure for table `payment_schemes` */

DROP TABLE IF EXISTS `payment_schemes`;

CREATE TABLE `payment_schemes` (
  `id` char(7) NOT NULL,
  `tuition_id` char(7) DEFAULT NULL,
  `scheme_id` char(4) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `variance_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment_schemes` */

insert  into `payment_schemes`(`id`,`tuition_id`,`scheme_id`,`order`,`total_amount`,`variance_amount`) values ('G7RE16A','G7REG16','ANNL',1,'18700.00','-270.00'),('G7RE16E','G7REG16','EASY',4,'19735.00','765.00'),('G7RE16M','G7REG16','MNTH',3,'18970.00','0.00'),('G7RE16S','G7REG16','SEMI',2,'18600.00','-370.00');

/*Table structure for table `programs` */

DROP TABLE IF EXISTS `programs`;

CREATE TABLE `programs` (
  `id` char(3) DEFAULT NULL,
  `code` varchar(2) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `programs` */

insert  into `programs`(`id`,`code`,`name`,`description`,`order`,`created`,`modified`) values ('REG','RE','Regular','Regular',1,'2016-02-18 07:51:50','2016-02-18 07:53:32'),('PIL','PL','Pilot','Pilot',2,'2016-02-18 07:52:00','2016-02-18 07:53:32'),('SCI','SC','Science','Science',3,'2016-02-18 07:52:12','2016-02-18 07:53:32'),('STM','ST','STEM','Science, Technology, Engineering & Mathematics',4,'2016-02-18 07:52:41','2016-02-18 07:53:32');

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` char(3) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `country_id` char(2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL COMMENT 'Is Show On Drop Down',
  `order` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `provinces` */

insert  into `provinces`(`id`,`name`,`country_id`,`is_active`,`order`) values ('ABR','Abra','PH',1,2),('AGN','Agusan del Norte','PH',1,3),('AGS','Agusan del Sur','PH',1,4),('AKL','Aklan','PH',1,5),('ALB','Albay','PH',1,6),('ANT','Antique','PH',1,7),('APA','Apayao','PH',1,8),('AUR','Aurora','PH',1,9),('BAS','Basilan','PH',1,10),('BAN','Bataan','PH',1,11),('BTN','Batanes','PH',1,12),('BTG','Batangas','PH',1,13),('BEN','Benguet','PH',1,14),('BIL','Biliran','PH',1,15),('BOH','Bohol','PH',1,16),('BUK','Bukidnon','PH',1,17),('BUL','Bulacan','PH',1,18),('CAG','Cagayan','PH',1,19),('CAN','Camarines Norte','PH',1,20),('CAS','Camarines Sur','PH',1,21),('CAM','Camiguin','PH',1,22),('CAP','Capiz','PH',1,23),('CAT','Catanduanes','PH',1,24),('CAV','Cavite','PH',1,25),('CEB','Cebu','PH',1,26),('COM','Compostella Valley','PH',1,27),('NCO','Cotabato','PH',1,28),('DAV','Davao del Norte','PH',1,29),('DAS','Davao del Sur','PH',1,30),('DAO','Davao Oriental','PH',1,31),('DIN','Dinagat Islands','PH',1,32),('EAS','Eastern Samar','PH',1,33),('GUI','Guimaras','PH',1,34),('IFU','Ifugao','PH',1,35),('ILI','Ilo-ilo','PH',1,36),('ILN','Ilocos Norte','PH',1,37),('ILS','Ilocos Sur','PH',1,38),('ISA','Isabela','PH',1,39),('KAL','Kalinga','PH',1,40),('LUN','La Union','PH',1,41),('LAG','Laguna','PH',1,42),('LAN','Lanao del Norte','PH',1,43),('LAS','Lanao del Sur','PH',1,44),('LEY','Leyte','PH',1,45),('MAG','Magindanao','PH',1,67),('MAD','Marinduque','PH',1,46),('MNL','Metro Manila','PH',1,1),('MAS','Masbate','PH',1,47),('MSC','Misamis Occidental','PH',1,48),('MSR','Misamis Oriental','PH',1,49),('MOU','Mountain Province','PH',1,50),('NEC','Negros Occidental','PH',1,51),('NER','Negros Oriental','PH',1,52),('NSA','Northern Samar','PH',1,53),('NUE','Nueva Ecija','PH',1,54),('NUV','Nueva Vizcaya','PH',1,55),('MDC','Mindoro Occidental','PH',1,56),('MDR','Mindoro Oriental','PH',1,57),('PLW','Palawan','PH',1,58),('PAM','Pampanga','PH',1,59),('PAN','Pangasinan','PH',1,60),('QUE','Quezon','PH',1,61),('QUI','Quirino','PH',1,62),('RIZ','Rizal','PH',1,63),('ROM','Romblon','PH',1,64),('WSA','Western Samar','PH',1,65),('SAR','Saranggani','PH',1,66),('SIG','Siquijor','PH',1,68),('SOR','Sorsogon','PH',1,69),('SCO','South Cotabato','PH',1,70),('SLE','Southern Leyte','PH',1,71),('SUK','Sultan Kudarat','PH',1,72),('SLU','Sulu','PH',1,73),('SUN','Surigao del Norte','PH',1,74),('SUR','Surigao del Sur','PH',1,75),('TAR','Tarlac','PH',1,76),('TAW','Tawi - Tawi','PH',1,77),('ZMB','Zambales','PH',1,78),('ZAN','Zamboanga del Norte','PH',1,79),('ZAS','Zamboanga del Sur','PH',1,80),('ZSI','Zamboanga Sibugay','PH',1,81);

/*Table structure for table `religions` */

DROP TABLE IF EXISTS `religions`;

CREATE TABLE `religions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `religions` */

insert  into `religions`(`id`,`name`,`order`,`created`,`modified`) values (3,'Roman Catholic',2,'2016-02-04 07:14:52','2016-02-04 08:28:41'),(4,'Iglesia ni Cristo',1,'2016-02-04 07:15:01','2016-02-04 08:28:41');

/*Table structure for table `schemes` */

DROP TABLE IF EXISTS `schemes`;

CREATE TABLE `schemes` (
  `id` char(4) NOT NULL,
  `code` char(1) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `payment_frequency` int(2) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `schemes` */

insert  into `schemes`(`id`,`code`,`name`,`payment_frequency`,`order`,`created`,`modified`) values ('ANNL','A','Annual',1,1,'2016-02-05 01:02:32','2016-02-05 08:42:37'),('EASY','E','Easy',10,4,'2016-02-05 01:03:17','2016-02-05 08:42:37'),('MNTH','M','Monthly',10,3,'2016-02-05 01:03:08','2016-02-05 08:42:37'),('SEMI','S','Semi Annual',2,2,'2016-02-05 01:02:42','2016-02-05 08:42:37');

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_level_id` char(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `program_id` varchar(3) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sections` */

insert  into `sections`(`id`,`year_level_id`,`name`,`program_id`,`order`,`created`,`modified`) values (3,'G7','Emerald','REG',1,'2016-02-22 04:59:02','2016-02-22 04:59:08');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `educ_level_id` char(2) DEFAULT NULL,
  `year_level_id` char(2) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `suffix_name` varchar(10) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(140) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `citizenship` varchar(20) DEFAULT NULL,
  `prev_school` varchar(140) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`id`,`educ_level_id`,`year_level_id`,`first_name`,`middle_name`,`last_name`,`suffix_name`,`gender`,`birthday`,`birthplace`,`religion`,`citizenship`,`prev_school`,`created`,`modified`) values (26,'HS','G7','Kristian Dave','Arroyo','Alaras','Jr','M','0000-00-00','Balayan, Batangas','Roman Catholic','Filipino','Sample school','2016-02-04 09:04:14','2016-02-04 09:04:14'),(27,'HS','G7','Dave','Arroyo','Alaras','Jr','M','0000-00-00','Sample','Iglesia ni Cristo','Korean','Sample','2016-02-10 04:30:38','2016-02-10 04:30:38');

/*Table structure for table `system_defaults` */

DROP TABLE IF EXISTS `system_defaults`;

CREATE TABLE `system_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` char(15) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `system_defaults` */

insert  into `system_defaults`(`id`,`key`,`value`) values (1,'SCHOOL_NAME','DAVE UNIVERSITY'),(2,'SCHOOL_ALIAS','DU'),(3,'SCHOOL_LOGO','logo.jpg'),(4,'SCHOOL_ADDRESS','STO.TOMAS BATANGAS'),(5,'START_SY','2013'),(6,'ACTIVE_SY','2016'),(7,'PERIODS','[{\"id\":1,\"name\":\"First Grading\",\"alias\":\"1st\"},{\"id\":2,\"name\":\"Second Grading\",\"alias\":\"2nd\"},{\"id\":3,\"name\":\"Third Grading\",\"alias\":\"3rd\"},{\"id\":4,\"name\":\"Fourth Grading\",\"alias\":\"4th\"}]'),(8,'SPL_TRNX','{\"INTEREST\":{\"code\":\"INT\",\"flag\":\"+\"},\"DISCOUNT\":{\"code\":\"DSC\",\"flag\":\"-\"},\"CHARGE\":{\"code\":\"CHG\",\"flag\":\"+\"},\"PAYMENT\":{\"code\":\"PAY\",\"flag\":\"-\"}}');

/*Table structure for table `tuition_discounts` */

DROP TABLE IF EXISTS `tuition_discounts`;

CREATE TABLE `tuition_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tuition_id` char(7) DEFAULT NULL,
  `discount_id` char(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tuition_discounts` */

insert  into `tuition_discounts`(`id`,`tuition_id`,`discount_id`) values (1,'G7REG16','DSCA'),(2,'G7REG16','DSCB');

/*Table structure for table `tuitions` */

DROP TABLE IF EXISTS `tuitions`;

CREATE TABLE `tuitions` (
  `id` char(7) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `sy` year(4) DEFAULT NULL,
  `year_level_id` char(2) DEFAULT NULL,
  `program_id` char(3) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tuitions` */

insert  into `tuitions`(`id`,`name`,`description`,`sy`,`year_level_id`,`program_id`,`amount`,`created`,`modified`) values ('G7REG16','G7 Tuition Fee','Grade 7 Tuition',2016,'G7','REG','18970.00','2016-02-05 01:06:25','2016-02-22 06:11:16');

/*Table structure for table `year_levels` */

DROP TABLE IF EXISTS `year_levels`;

CREATE TABLE `year_levels` (
  `id` char(2) NOT NULL,
  `educ_level_id` char(2) DEFAULT NULL,
  `name` varchar(15) DEFAULT NULL,
  `alias` varchar(5) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `year_levels` */

insert  into `year_levels`(`id`,`educ_level_id`,`name`,`alias`,`order`,`created`,`modified`) values ('G1','GS','Grade 1','G1',1,'2016-01-26 07:26:09','2016-02-04 07:18:08'),('G2','GS','Grade 2','G2',2,'2016-01-27 17:32:25','2016-02-04 07:18:09'),('G3','GS','Grade 3','G3',3,'2016-01-26 07:26:37','2016-02-04 07:18:09'),('G4','GS','Grade 4','G4',4,'2016-01-26 07:27:29','2016-02-04 07:18:09'),('G5','GS','Grade 5','G5',5,'2016-01-26 07:27:48','2016-02-04 07:18:09'),('G6','GS','Grade 6','G6',6,'2016-01-26 07:28:40','2016-02-04 07:18:09'),('G7','HS','Grade 7','G7',7,'2016-01-26 07:28:50','2016-02-04 07:18:09'),('G8','HS','Grade 8','G8',8,'2016-01-26 07:29:01','2016-02-04 07:18:09'),('G9','HS','Grade 9','G9',9,'2016-01-26 07:29:16','2016-02-04 07:18:09'),('GX','HS','Grade 10','G10',10,'2016-01-26 07:29:26','2016-02-04 07:18:09'),('GY','SH','Grade 11','G11',11,'2016-02-04 07:46:28','2016-02-04 07:46:28'),('GZ','SH','Grade 12','G12',12,'2016-02-04 07:46:53','2016-02-04 07:46:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

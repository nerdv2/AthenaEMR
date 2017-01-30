/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.15-log : Database - project_athena_emr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`project_athena_emr` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `project_athena_emr`;

/*Table structure for table `clinic` */

DROP TABLE IF EXISTS `clinic`;

CREATE TABLE `clinic` (
  `clinic_id` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tariff` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`clinic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clinic` */

insert  into `clinic`(`clinic_id`,`name`,`tariff`,`created_at`,`updated_at`) values ('DIV-0000','General',50000,'2017-01-21 19:26:21',NULL),('DIV-0001','Dentist',75000,'2017-01-21 19:26:31',NULL);

/*Table structure for table `doctor` */

DROP TABLE IF EXISTS `doctor`;

CREATE TABLE `doctor` (
  `doctor_id` varchar(10) NOT NULL,
  `clinic_id` varchar(8) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `clinic_id` (`clinic_id`),
  CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `doctor` */

insert  into `doctor`(`doctor_id`,`clinic_id`,`name`,`gender`,`dob`,`address`,`phone`,`photo`,`created_at`,`updated_at`) values ('DOC-0000','DIV-0000','Drs. Annisa Baharmin','female','1992-11-13','<p>Home Address</p>','','','2017-01-21 19:26:48',NULL),('DOC-0001','DIV-0001','Dr. Sukarman Nugraha','male','1973-02-11','<p>Home Address</p>','','','2017-01-21 19:27:03',NULL);

/*Table structure for table `lab` */

DROP TABLE IF EXISTS `lab`;

CREATE TABLE `lab` (
  `lab_id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tariff` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`lab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lab` */

insert  into `lab`(`lab_id`,`name`,`tariff`,`created_at`,`updated_at`) values ('LAB-0000','Blood Testing',50000,'2017-01-30 17:39:23',NULL);

/*Table structure for table `lab_result` */

DROP TABLE IF EXISTS `lab_result`;

CREATE TABLE `lab_result` (
  `result_id` varchar(25) NOT NULL,
  `worker_id` varchar(10) DEFAULT NULL,
  `result_data` text NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `worker_id` (`worker_id`),
  CONSTRAINT `lab_result_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lab_result` */

insert  into `lab_result`(`result_id`,`worker_id`,`result_data`,`time`) values ('RES-300117-0000','WRK-0002','<table style=\"width: 950px;\">\r\n<tbody>\r\n<tr class=\"heading\" style=\"height: 14px;\">\r\n<td style=\"width: 200px; height: 14px;\">Test Name</td>\r\n<td style=\"width: 200px; height: 14px;\">Result</td>\r\n<td style=\"width: 50px; height: 14px;\">Flag</td>\r\n<td style=\"width: 100px; height: 14px;\">Unit</td>\r\n<td style=\"width: 200px; height: 14px;\">Ref. Value</td>\r\n<td style=\"width: 200px; height: 14px;\">Method</td>\r\n</tr>\r\n<tr style=\"height: 15px;\">\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;Hemoglobin</td>\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;812</td>\r\n<td style=\"width: 50px; height: 15px;\">&nbsp;</td>\r\n<td style=\"width: 100px; height: 15px;\">&nbsp;ms/G</td>\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;1002</td>\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>','2017-01-30');

/*Table structure for table `medical_record` */

DROP TABLE IF EXISTS `medical_record`;

CREATE TABLE `medical_record` (
  `record_id` varchar(20) NOT NULL,
  `doctor_id` varchar(10) DEFAULT NULL,
  `register_id` varchar(15) DEFAULT NULL,
  `patient_id` varchar(15) DEFAULT NULL,
  `time` date NOT NULL,
  `lab_id` varchar(18) DEFAULT NULL,
  `result_id` varchar(25) DEFAULT NULL,
  `prescription_id` varchar(18) DEFAULT NULL,
  `complaint` text NOT NULL,
  `symptoms` text NOT NULL,
  `diagnosis` text NOT NULL,
  `handling` text,
  PRIMARY KEY (`record_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `register_id` (`register_id`),
  KEY `patient_id` (`patient_id`),
  KEY `lab_id` (`lab_id`),
  KEY `result_id` (`result_id`),
  KEY `prescription_id` (`prescription_id`),
  CONSTRAINT `medical_record_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_2` FOREIGN KEY (`register_id`) REFERENCES `registration` (`register_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_4` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`lab_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_5` FOREIGN KEY (`result_id`) REFERENCES `lab_result` (`result_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_6` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `medical_record` */

insert  into `medical_record`(`record_id`,`doctor_id`,`register_id`,`patient_id`,`time`,`lab_id`,`result_id`,`prescription_id`,`complaint`,`symptoms`,`diagnosis`,`handling`) values ('REC-230117-0000','DOC-0000','REG-210117-0000','USR-000000','2017-01-23','LAB-0000','RES-300117-0000','PSC-300117-0000','<p>Complaints</p>','<p>Symptoms</p>','<p>Diagnosis</p>','<p>Handling</p>');

/*Table structure for table `medicine` */

DROP TABLE IF EXISTS `medicine`;

CREATE TABLE `medicine` (
  `medicine_id` varchar(10) NOT NULL,
  `type_id` varchar(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`medicine_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `medicine_type` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `medicine` */

insert  into `medicine`(`medicine_id`,`type_id`,`name`,`description`,`price`,`amount`,`created_at`,`updated_at`) values ('MED-0000','TYP-0000','Abrosive','<p>Description</p>',90000,98,'2017-01-30 17:45:38',NULL),('MED-0001','TYP-0000','Avioux','<p>Description</p>',10000,15,'2017-01-30 17:52:54',NULL);

/*Table structure for table `medicine_type` */

DROP TABLE IF EXISTS `medicine_type`;

CREATE TABLE `medicine_type` (
  `type_id` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `medicine_type` */

insert  into `medicine_type`(`type_id`,`name`,`created_at`,`updated_at`) values ('TYP-0000','Alcohol','2017-01-30 17:45:09',NULL);

/*Table structure for table `patient` */

DROP TABLE IF EXISTS `patient`;

CREATE TABLE `patient` (
  `patient_id` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `patient` */

insert  into `patient`(`patient_id`,`name`,`dob`,`gender`,`address`,`phone`,`created_at`,`updated_at`) values ('USR-000000','Dana Abraham','1997-06-19','female','<p>Home Address</p>','','2017-01-21 19:29:09',NULL);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` varchar(15) NOT NULL,
  `register_id` varchar(15) DEFAULT NULL,
  `worker_id` varchar(10) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `time` date NOT NULL,
  `info` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `worker_id` (`worker_id`),
  KEY `payment_ibfk_1` (`register_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `registration` (`register_id`) ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

insert  into `payment`(`payment_id`,`register_id`,`worker_id`,`type`,`amount`,`time`,`info`) values ('PAY-210117-0000','REG-210117-0000','WRK-0000','lab',65000,'2017-01-21','new');

/*Table structure for table `prescription` */

DROP TABLE IF EXISTS `prescription`;

CREATE TABLE `prescription` (
  `prescription_id` varchar(18) NOT NULL,
  `record_id` varchar(20) DEFAULT NULL,
  `worker_id` varchar(10) DEFAULT NULL,
  `time` date NOT NULL,
  `description` text,
  PRIMARY KEY (`prescription_id`),
  KEY `worker_id` (`worker_id`),
  KEY `record_id` (`record_id`),
  CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `medical_record` (`record_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prescription` */

insert  into `prescription`(`prescription_id`,`record_id`,`worker_id`,`time`,`description`) values ('PSC-300117-0000','REC-230117-0000','WRK-0003','2017-01-30','<p>Info</p>');

/*Table structure for table `prescription_detail` */

DROP TABLE IF EXISTS `prescription_detail`;

CREATE TABLE `prescription_detail` (
  `prescription_id` varchar(18) NOT NULL,
  `medicine_id` varchar(10) DEFAULT NULL,
  `dosage` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `usage` text NOT NULL,
  KEY `prescription_id` (`prescription_id`),
  KEY `medicine_id` (`medicine_id`),
  CONSTRAINT `prescription_detail_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prescription_detail_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prescription_detail` */

insert  into `prescription_detail`(`prescription_id`,`medicine_id`,`dosage`,`amount`,`total`,`usage`) values ('PSC-300117-0000','MED-0000','450 gram per day.',2,2,'<p>Usage Info</p>');

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `register_id` varchar(15) NOT NULL,
  `worker_id` varchar(10) DEFAULT NULL,
  `patient_id` varchar(15) DEFAULT NULL,
  `clinic_id` varchar(8) DEFAULT NULL,
  `doctor_id` varchar(10) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `time` date NOT NULL,
  `entry_no` int(11) DEFAULT NULL,
  `patient_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`register_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `registration` */

insert  into `registration`(`register_id`,`worker_id`,`patient_id`,`clinic_id`,`doctor_id`,`category`,`time`,`entry_no`,`patient_type`) values ('REG-210117-0000','WRK-0000','USR-000000','DIV-0000','DOC-0000','clinic','2017-01-21',0,0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `doctor_id` varchar(10) DEFAULT NULL,
  `worker_id` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `worker_id` (`worker_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password_hash`,`status`,`doctor_id`,`worker_id`,`created_at`,`updated_at`) values (12,'admin','$2a$08$BKODr0AWOSfxCob9M4ilIuJ1unzm2OMzad9.2svo1g13mcn3PkfCK','admin',NULL,NULL,'2017-01-21 11:06:56',NULL),(13,'register','$2y$10$w.f.YdmHNcMYAHTwRmk7nu9nr.Y/xl6kWH51J0BlZgoizXFMbAXV.','registration',NULL,NULL,'2017-01-23 08:07:27',NULL),(14,'laboratorium','$2y$10$qwCbIMFGi1tEHqDuRR6ekeBLwxzWBEJYWduOk8FT1unhWTQtiB41u','lab',NULL,NULL,'2017-01-23 08:08:25',NULL),(15,'payment','$2y$10$oUy9Izyym.YU3B04AqTDR.FxguUuapjqaWcmujTc/vgThJ2YH8gl6','payment',NULL,NULL,'2017-01-23 08:09:25',NULL),(16,'pharmacist','$2y$10$pCCwAKcAdkxpItV/l1yuWORWVeYhVEgdptJhP5QDINavI.lWwkC7u','pharmacist',NULL,NULL,'2017-01-23 08:09:49',NULL),(17,'doctor','$2y$10$ldfpGwtpBGBRkETR74sBf.IiccIV5tPgSaPG6gGoxqjWGekv0UDMm','doctor',NULL,NULL,'2017-01-23 08:10:10',NULL),(18,'dianyuliana','$2y$10$tMAsD6oqM1BDVNwyNbclL.5qDIvlaFOWfx.OdcRM8gUAYTbFyfyXu','registration',NULL,'WRK-0000','2017-01-30 23:00:36',NULL),(19,'gemawardian','$2y$10$Ne1D54/sklynTCWMtcaQ7eSBM9F0Nev0nT06PU9FwSNNhTeO/W0WS','payment',NULL,'WRK-0001','2017-01-30 23:06:49',NULL),(20,'iandamien','$2y$10$xLRJLNKbJDfPaw9ANPG2i.NY1xxAxDKJ6WIu1DfHj3yQzHfUq9iGC','pharmacist',NULL,'WRK-0003','2017-01-30 23:09:34',NULL),(21,'brianrobinson','$2y$10$KrniVWCkkZyljs5a/iQx8OxTFXsl1SdqQfk/Hf/ecsWn0Ly4Up8FO','lab',NULL,'WRK-0002','2017-01-30 23:11:52',NULL);

/*Table structure for table `worker` */

DROP TABLE IF EXISTS `worker`;

CREATE TABLE `worker` (
  `worker_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `role` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `worker` */

insert  into `worker`(`worker_id`,`name`,`gender`,`role`,`dob`,`address`,`photo`,`created_at`,`updated_at`) values ('WRK-0000','Dian Yuliana','female','registration','1997-06-19','<p>Jl. Sukagalih Gg.H.Gozali</p>','','2017-01-21 19:25:42','2017-01-21 19:25:58'),('WRK-0001','Gema Aji Wardian','male','payment','1990-05-22','<p>Home Address</p>','','2017-01-21 19:28:40',NULL),('WRK-0002','Brian Robinson','male','lab','1983-12-22','<p>Home Address</p>','','2017-01-30 17:38:55',NULL),('WRK-0003','Ian Damien','male','pharmacist','1996-07-11','<p>Home Address</p>','','2017-01-30 17:44:58',NULL);

/* Trigger structure for table `prescription_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_stock` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update_stock` AFTER INSERT ON `prescription_detail` FOR EACH ROW BEGIN
	UPDATE medicine set amount=(medicine.`amount` - new.amount) where medicine_id = NEW.medicine_id;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `getInvoice` */

/*!50003 DROP PROCEDURE IF EXISTS  `getInvoice` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getInvoice`(IN iddata VARCHAR(255))
BEGIN
	SELECT payment.*, patient.`patient_id`, patient.`name`
	FROM payment, registration, patient WHERE payment.`register_id` = registration.`register_id` AND
	registration.`patient_id` = patient.`patient_id` AND payment.`payment_id` = iddata;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getLabResult` */

/*!50003 DROP PROCEDURE IF EXISTS  `getLabResult` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getLabResult`(IN iddata VARCHAR(255))
BEGIN
	SELECT lab_result.*,patient.`patient_id` , patient.`name`  FROM lab_result, worker, medical_record, patient
	WHERE medical_record.`result_id` = lab_result.`result_id` AND lab_result.`worker_id` = worker.`worker_id`
	AND patient.`patient_id` = medical_record.`patient_id` AND lab_result.`result_id` = iddata;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getPatientMonth` */

/*!50003 DROP PROCEDURE IF EXISTS  `getPatientMonth` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getPatientMonth`(IN startdate VARCHAR(255), IN enddate VARCHAR(255), 
    IN iddata2 VARCHAR(255))
BEGIN
SELECT registration.`time` AS "Date", patient.`name` AS "Name", doctor.`name` AS "doctor_name" FROM registration, patient, doctor
WHERE registration.`patient_id` = patient.`patient_id` AND doctor.`doctor_id` = registration.`doctor_id`
AND registration.`doctor_id` = iddata2
AND DATE_FORMAT(registration.time, "%m-%Y") >= startdate AND DATE_FORMAT(registration.time, "%m-%Y") <= enddate GROUP BY patient.`name`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getRecordMonth` */

/*!50003 DROP PROCEDURE IF EXISTS  `getRecordMonth` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getRecordMonth`(IN iddata VARCHAR(255), IN startdate VARCHAR(255), IN enddate VARCHAR(255))
BEGIN
	SELECT medical_record.`record_id`,
	medical_record.`doctor_id`,
	doctor.`name` AS "doctor_name",
	medical_record.`register_id`,
	medical_record.`patient_id`,
	patient.`name` AS "patient_name",
	medical_record.`time`,
	medical_record.`lab_id`,
	medical_record.`result_id`,
	medical_record.`prescription_id`,
	medical_record.`complaint`,
	medical_record.`symptoms`,
	medical_record.`diagnosis`,
	medical_record.`handling`
FROM medical_record, patient, doctor
WHERE medical_record.`patient_id` = iddata AND medical_record.`patient_id` = patient.`patient_id` 
AND doctor.`doctor_id` = medical_record.`doctor_id` AND DATE_FORMAT(medical_record.time, "%m-%Y") >= startdate 
AND DATE_FORMAT(medical_record.time, "%m-%Y") <= enddate;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getRegistrationMonth` */

/*!50003 DROP PROCEDURE IF EXISTS  `getRegistrationMonth` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getRegistrationMonth`(IN startdate VARCHAR(255), IN enddate VARCHAR(255))
BEGIN
	SELECT registration.* FROM registration 
	WHERE DATE_FORMAT(registration.time, "%m-%Y") >= startdate AND DATE_FORMAT(registration.time, "%m-%Y") <= enddate;
    END */$$
DELIMITER ;

/*Table structure for table `getregistertoday` */

DROP TABLE IF EXISTS `getregistertoday`;

/*!50001 DROP VIEW IF EXISTS `getregistertoday` */;
/*!50001 DROP TABLE IF EXISTS `getregistertoday` */;

/*!50001 CREATE TABLE  `getregistertoday`(
 `register_id` varchar(15) ,
 `worker_id` varchar(10) ,
 `patient_id` varchar(15) ,
 `clinic_id` varchar(8) ,
 `doctor_id` varchar(10) ,
 `category` varchar(100) ,
 `time` date ,
 `entry_no` int(11) 
)*/;

/*View structure for view getregistertoday */

/*!50001 DROP TABLE IF EXISTS `getregistertoday` */;
/*!50001 DROP VIEW IF EXISTS `getregistertoday` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getregistertoday` AS (select `registration`.`register_id` AS `register_id`,`registration`.`worker_id` AS `worker_id`,`registration`.`patient_id` AS `patient_id`,`registration`.`clinic_id` AS `clinic_id`,`registration`.`doctor_id` AS `doctor_id`,`registration`.`category` AS `category`,`registration`.`time` AS `time`,`registration`.`entry_no` AS `entry_no` from `registration` where (cast(`registration`.`time` as date) = cast(curdate() as date))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

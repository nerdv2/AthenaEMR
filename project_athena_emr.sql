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

insert  into `clinic`(`clinic_id`,`name`,`tariff`,`created_at`,`updated_at`) values ('DIV-0000','Dentist',45000,'2017-01-18 11:50:12','2017-01-18 11:50:41'),('DIV-0001','General',50000,'2017-01-18 11:50:52',NULL);

/*Table structure for table `doctor` */

DROP TABLE IF EXISTS `doctor`;

CREATE TABLE `doctor` (
  `doctor_id` varchar(10) NOT NULL,
  `clinic_id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `id_poli` (`clinic_id`),
  CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `doctor` */

insert  into `doctor`(`doctor_id`,`clinic_id`,`name`,`gender`,`dob`,`address`,`phone`,`photo`,`created_at`,`updated_at`) values ('DOC-0000','DIV-0000','Dr. Sukarman Nugraha','male','1988-01-11','<p>Jl. Pahlawan No. 12, Bandung, Indonesia.</p>','082257846988','','2017-01-18 11:51:41',NULL),('DOC-0001','DIV-0001','Drs. Annisa Baharmin','female','1990-05-22','<p>Jl. Jakarta No. 82 Bandung, Indonesia</p>','08218242574','','2017-01-18 11:53:39',NULL);

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

insert  into `lab`(`lab_id`,`name`,`tariff`,`created_at`,`updated_at`) values ('LAB-0000','XRay',50000,'2017-01-18 12:47:34',NULL),('LAB-0001','Blood Test',70000,'2017-01-18 12:47:50','2017-01-18 12:47:57');

/*Table structure for table `lab_result` */

DROP TABLE IF EXISTS `lab_result`;

CREATE TABLE `lab_result` (
  `result_id` varchar(25) NOT NULL,
  `worker_id` varchar(10) NOT NULL,
  `result_data` text NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `id_petugas` (`worker_id`),
  CONSTRAINT `lab_result_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lab_result` */

insert  into `lab_result`(`result_id`,`worker_id`,`result_data`,`time`) values ('RES-190117-0000','WRK-0000','<table style=\"width: 950px;\">\r\n<tbody>\r\n<tr class=\"heading\" style=\"height: 14px;\">\r\n<td style=\"width: 200px; height: 14px;\">Test Name</td>\r\n<td style=\"width: 200px; height: 14px;\">Result</td>\r\n<td style=\"width: 50px; height: 14px;\">Flag</td>\r\n<td style=\"width: 100px; height: 14px;\">Unit</td>\r\n<td style=\"width: 200px; height: 14px;\">Ref. Value</td>\r\n<td style=\"width: 200px; height: 14px;\">Method</td>\r\n</tr>\r\n<tr style=\"height: 15px;\">\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;TEST</td>\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;1</td>\r\n<td style=\"width: 50px; height: 15px;\">&nbsp;x</td>\r\n<td style=\"width: 100px; height: 15px;\">&nbsp;31</td>\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;xxa</td>\r\n<td style=\"width: 200px; height: 15px;\">&nbsp;31</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>','2017-01-19');

/*Table structure for table `medical_record` */

DROP TABLE IF EXISTS `medical_record`;

CREATE TABLE `medical_record` (
  `record_id` varchar(20) NOT NULL,
  `doctor_id` varchar(10) NOT NULL,
  `register_id` varchar(15) DEFAULT NULL,
  `patient_id` varchar(15) NOT NULL,
  `time` date NOT NULL,
  `lab_id` varchar(18) DEFAULT NULL,
  `result_id` varchar(25) DEFAULT NULL,
  `prescription_id` varchar(18) DEFAULT NULL,
  `complaint` text NOT NULL,
  `symptoms` text NOT NULL,
  `diagnosis` text NOT NULL,
  `handling` text,
  PRIMARY KEY (`record_id`),
  KEY `id_dokter` (`doctor_id`),
  KEY `id_daftar` (`register_id`),
  KEY `id_pasien` (`patient_id`),
  KEY `id_hasil` (`result_id`),
  KEY `id_resep` (`prescription_id`),
  KEY `id_lab` (`lab_id`),
  CONSTRAINT `medical_record_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_2` FOREIGN KEY (`register_id`) REFERENCES `registration` (`register_id`) ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_4` FOREIGN KEY (`result_id`) REFERENCES `lab_result` (`result_id`) ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_5` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`) ON UPDATE CASCADE,
  CONSTRAINT `medical_record_ibfk_6` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`lab_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `medical_record` */

insert  into `medical_record`(`record_id`,`doctor_id`,`register_id`,`patient_id`,`time`,`lab_id`,`result_id`,`prescription_id`,`complaint`,`symptoms`,`diagnosis`,`handling`) values ('REC-190117-0000','DOC-0001','REG-180117-0000','USR-000000','2017-01-19','LAB-0000','RES-190117-0000','PSC-190117-0000','<p>Complaints</p>','<p>Symptoms</p>','<p>Diagnosis</p>','<p>Handling</p>');

/*Table structure for table `medicine` */

DROP TABLE IF EXISTS `medicine`;

CREATE TABLE `medicine` (
  `medicine_id` varchar(10) NOT NULL,
  `type_id` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`medicine_id`),
  KEY `id_jenis` (`type_id`),
  CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `medicine_type` (`type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `medicine` */

insert  into `medicine`(`medicine_id`,`type_id`,`name`,`description`,`price`,`amount`,`created_at`,`updated_at`) values ('MED-0000','TYP-0000','Bloodlust','<p>Clean surface of skins</p>',40000,20,'2017-01-18 13:08:58',NULL);

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

insert  into `medicine_type`(`type_id`,`name`,`created_at`,`updated_at`) values ('TYP-0000','Antiseptic','2017-01-18 13:07:41',NULL),('TYP-0001','Bandages','2017-01-18 13:07:58',NULL);

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

insert  into `patient`(`patient_id`,`name`,`dob`,`gender`,`address`,`phone`,`created_at`,`updated_at`) values ('USR-000000','Dana Abraham','1997-12-02','female','<p>Jl. Suparman No. 41</p>','','2017-01-18 12:04:05',NULL);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` varchar(15) NOT NULL,
  `register_id` varchar(15) NOT NULL,
  `worker_id` varchar(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `id_daftar` (`register_id`),
  KEY `id_petugas` (`worker_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `registration` (`register_id`) ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

insert  into `payment`(`payment_id`,`register_id`,`worker_id`,`type`,`amount`,`time`) values ('PAY-180117-0000','REG-180117-0000','WRK-0000','clinic',50000,'2017-01-18');

/*Table structure for table `prescription` */

DROP TABLE IF EXISTS `prescription`;

CREATE TABLE `prescription` (
  `prescription_id` varchar(18) NOT NULL,
  `record_id` varchar(20) NOT NULL,
  `worker_id` varchar(10) NOT NULL,
  `time` date NOT NULL,
  `description` text,
  PRIMARY KEY (`prescription_id`),
  KEY `id_petugas` (`worker_id`),
  KEY `resep_ibfk_1` (`record_id`),
  CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`record_id`) REFERENCES `medical_record` (`record_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prescription` */

insert  into `prescription`(`prescription_id`,`record_id`,`worker_id`,`time`,`description`) values ('PSC-190117-0000','REC-190117-0000','WRK-0000','2017-01-19','<p>Info</p>');

/*Table structure for table `prescription_detail` */

DROP TABLE IF EXISTS `prescription_detail`;

CREATE TABLE `prescription_detail` (
  `prescription_id` varchar(18) NOT NULL,
  `medicine_id` varchar(10) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `usage` text NOT NULL,
  KEY `id_obat` (`medicine_id`),
  KEY `id_resep` (`prescription_id`),
  CONSTRAINT `prescription_detail_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `prescription_detail_ibfk_2` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prescription_detail` */

insert  into `prescription_detail`(`prescription_id`,`medicine_id`,`dosage`,`amount`,`total`,`usage`) values ('PSC-190117-0000','MED-0000','1',2,3,'<p>Usage Info</p>');

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `register_id` varchar(15) NOT NULL,
  `worker_id` varchar(10) NOT NULL,
  `patient_id` varchar(15) NOT NULL,
  `clinic_id` varchar(8) DEFAULT NULL,
  `doctor_id` varchar(10) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `time` date NOT NULL,
  `entry_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`register_id`),
  KEY `id_pasien` (`patient_id`),
  KEY `id_petugas` (`worker_id`),
  KEY `id_poli` (`clinic_id`),
  KEY `id_dokter` (`doctor_id`),
  CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON UPDATE CASCADE,
  CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON UPDATE CASCADE,
  CONSTRAINT `registration_ibfk_3` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON UPDATE CASCADE,
  CONSTRAINT `registration_ibfk_4` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `registration` */

insert  into `registration`(`register_id`,`worker_id`,`patient_id`,`clinic_id`,`doctor_id`,`category`,`time`,`entry_no`) values ('REG-180117-0000','WRK-0000','USR-000000','DIV-0001','DOC-0001','clinic','2017-01-18',0),('REG-180117-0001','WRK-0000','USR-000000','DIV-0000','DOC-0001','clinic','2017-01-18',1);

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
  KEY `id_dokter` (`doctor_id`),
  KEY `id_petugas` (`worker_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password_hash`,`status`,`doctor_id`,`worker_id`,`created_at`,`updated_at`) values (1,'admin','$2a$06$6MQPW/i7LqJmGIQ5sL3LIeitYVCNvd7D9p7m.A5qJLV/Z6t5PzvY2','admin',NULL,NULL,'2017-01-17 17:08:11',NULL),(9,'administrator','$2y$10$Wqjfbypqeb1Qw5OfSBDNEesGPleD1QZasADkUztDNqcsfmmpkPOmG','admin',NULL,NULL,'2017-01-18 13:56:41',NULL),(10,'register','$2y$10$dm.FBWYOkW5J9RC7g9Drt.gsA/T6GupRK0JFdkyoIRgEe1LfSdmBi','registration',NULL,'WRK-0001','2017-01-18 13:57:00',NULL),(11,'doctor','$2y$10$ceetmI2DLP6E.ljWrXMqV.LpQ1k3RwPsdWMe3Pl7vW8PP4dE/d8.O','doctor','DOC-0001',NULL,'2017-01-18 13:57:23',NULL);

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

insert  into `worker`(`worker_id`,`name`,`gender`,`role`,`dob`,`address`,`photo`,`created_at`,`updated_at`) values ('WRK-0000','Gema Aji Wardian','male','lab','1992-11-13','<p>Jl. Sukagalih Gg.H.Gozali No.74</p>','','2017-01-18 11:39:48',NULL),('WRK-0001','Dian Yuliana','female','registration','1973-02-11','<p>Bandung, Jawa Barat, Indonesia</p>','','2017-01-18 11:44:43',NULL);

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

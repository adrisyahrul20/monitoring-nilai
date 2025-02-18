CREATE DATABASE  IF NOT EXISTS `ta_monitoring_nilai` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ta_monitoring_nilai`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: ta_monitoring_nilai
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guru`
--

DROP TABLE IF EXISTS `guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guru` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `templahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgllahir` date NOT NULL,
  `jk` enum('lk','pr','nd') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nd',
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `nohp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guru_nip_unique` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guru`
--

LOCK TABLES `guru` WRITE;
/*!40000 ALTER TABLE `guru` DISABLE KEYS */;
INSERT INTO `guru` VALUES (1,'701.1107.009','Suryani','Padang','1997-12-26','pr','Jalan Khatib Sulaiman, No.20','082132326565','suryani@mail.com','2025-02-09 01:44:46','2025-02-09 01:44:46'),(2,'701.1107.008','Jhoni Mahendra','Solok','1993-06-25','lk','Jalan Maluku No.321','081352654585','jhonyespapa@mail.com','2025-02-09 01:45:44','2025-02-09 01:45:44'),(3,'701.1107.007','Indah Maryati','Batusangkar','1997-07-19','pr','Jalan Duren No.31','083172564585','indahmaryati@mail.com','2025-02-09 01:46:55','2025-02-09 01:46:55'),(5,'701.1107.002','Gatot Subroto','Padang','1992-11-29','lk','Jalan Maluku No 5','081372353654','okajani@mail.com','2025-02-08 08:33:27','2025-02-09 02:46:39'),(6,'701.1107.001','Mawardi Hakiem','Batu Sangkar','1997-04-20','lk','Jalan Godok','081372335646','suryani@mail.com','2025-02-08 09:13:24','2025-02-09 02:46:25'),(7,'701.1107.004','Sumiarti Wardinah','Palangkaraya','1991-02-02','pr','Jalan Sudirman No.27','085346568596','sumiarti@mail.com','2025-02-09 02:48:40','2025-02-09 02:48:40'),(8,'701.1107.005','Rahma Santika','Lintau','1996-10-11','pr','Jalan Semangka 60','085345656595','rahmasantika@gmail.com','2025-02-09 02:49:56','2025-02-09 02:49:56'),(9,'701.1107.006','Rahayu Ningsih','Pariaman','1998-09-28','pr','Jalan Situbondo No 72','085236568590','rahayu20@gmail.com','2025-02-09 02:51:25','2025-02-09 02:51:25'),(11,'701.1107.003','Suwondo Yusuf','Padang','1996-10-18','lk','Jalan Suramadu 001','081372335394','jaylani@mail.com','2025-02-08 08:17:27','2025-02-09 02:47:03');
/*!40000 ALTER TABLE `guru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kdkls` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_kelas` int NOT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jmlbangku` int NOT NULL,
  `idguru` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kelas_kdkls_unique` (`kdkls`),
  KEY `kelas_idguru_foreign` (`idguru`),
  CONSTRAINT `kelas_idguru_foreign` FOREIGN KEY (`idguru`) REFERENCES `guru` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (1,'10A',1,NULL,33,3,'2025-02-09 01:48:18','2025-02-09 12:44:34'),(2,'11A',2,'Biologi',24,11,'2025-02-09 01:48:50','2025-02-09 12:44:50'),(3,'12A',3,'Biologi',24,2,'2025-02-09 01:49:38','2025-02-09 12:43:52'),(4,'10B',1,NULL,24,7,'2025-02-09 01:49:59','2025-02-09 12:44:41'),(5,'11B',2,'Fisika',24,9,'2025-02-09 01:50:21','2025-02-09 12:44:57'),(6,'12B',3,'Fisika',24,1,'2025-02-09 01:50:37','2025-02-09 12:44:14');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mata_pelajaran`
--

DROP TABLE IF EXISTS `mata_pelajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mata_pelajaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kdmapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmmapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idguru` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mata_pelajaran_kdmapel_unique` (`kdmapel`),
  KEY `mata_pelajaran_idguru_foreign` (`idguru`),
  CONSTRAINT `mata_pelajaran_idguru_foreign` FOREIGN KEY (`idguru`) REFERENCES `guru` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_pelajaran`
--

LOCK TABLES `mata_pelajaran` WRITE;
/*!40000 ALTER TABLE `mata_pelajaran` DISABLE KEYS */;
INSERT INTO `mata_pelajaran` VALUES (1,'PAI','Pendidikan Agama dan Budi Pekerti',1,'2025-02-09 01:54:38','2025-02-09 12:53:05'),(2,'PP','Pendidikan Pancasila',2,'2025-02-09 01:53:52','2025-02-09 12:53:22'),(3,'BID','Bahasa Indonesia',3,'2025-02-09 01:53:52','2025-02-09 12:53:22'),(4,'MTK','Matematika',5,'2025-02-09 12:53:58','2025-02-09 12:53:58'),(5,'FSK','Fisika',5,'2025-02-09 12:54:09','2025-02-09 12:54:15'),(6,'KMA','Kimia',6,'2025-02-09 12:54:27','2025-02-09 12:54:27'),(7,'BIO','Biologi',6,'2025-02-09 12:54:46','2025-02-09 12:54:46'),(8,'EKM','Ekonomi',7,'2025-02-09 12:55:14','2025-02-09 12:55:14'),(9,'SSG','Sosiologi',8,'2025-02-09 12:55:29','2025-02-09 12:55:29'),(10,'GG','Geografi',8,'2025-02-09 12:55:43','2025-02-09 12:55:43'),(11,'SJ','Sejarah',8,'2025-02-09 12:56:04','2025-02-09 12:56:04'),(12,'BIG','Bahasa Inggris',2,'2025-02-09 12:56:29','2025-02-09 12:56:29'),(13,'PJ','PJOK',11,'2025-02-09 12:58:00','2025-02-09 12:58:00'),(14,'IFK','Informatika',9,'2025-02-09 12:58:16','2025-02-09 12:58:16'),(15,'SB','Seni Budaya',3,'2025-02-09 12:58:32','2025-02-09 12:58:32'),(16,'BAM','Muatan Lokal: BAM',1,'2025-02-09 12:58:51','2025-02-09 12:58:51');
/*!40000 ALTER TABLE `mata_pelajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'2025_02_08_203833_create_guru_table',1),(4,'2025_02_08_204453_create_mata_pelajaran_table',1),(5,'2025_02_08_204933_create_kelas_table',1),(6,'2025_02_09_075233_create_siswa_table',1),(7,'2025_02_09_095301_create_monitoring_nilai_table',1),(8,'2025_02_09_095251_create_nilai_siswa_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_nilai`
--

DROP TABLE IF EXISTS `monitoring_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idmtpelajaran` bigint unsigned DEFAULT NULL,
  `idsiswa` bigint unsigned DEFAULT NULL,
  `semester` enum('ganjil','genap') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ganjil',
  `nilai` decimal(5,1) NOT NULL DEFAULT '0.0',
  `capaian` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monitoring_nilai_idmtpelajaran_foreign` (`idmtpelajaran`),
  KEY `monitoring_nilai_idsiswa_foreign` (`idsiswa`),
  CONSTRAINT `monitoring_nilai_idmtpelajaran_foreign` FOREIGN KEY (`idmtpelajaran`) REFERENCES `mata_pelajaran` (`id`) ON DELETE SET NULL,
  CONSTRAINT `monitoring_nilai_idsiswa_foreign` FOREIGN KEY (`idsiswa`) REFERENCES `siswa` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=329 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_nilai`
--

LOCK TABLES `monitoring_nilai` WRITE;
/*!40000 ALTER TABLE `monitoring_nilai` DISABLE KEYS */;
INSERT INTO `monitoring_nilai` VALUES (41,1,4,'ganjil',90.0,'Sudah Menguasai dalam memahami materi Kompetensi kebaikan Qs.AL Maidah 46, dan Etos Kerja Qs.At-Taubah 105 serta Syu\'ubul Iman dan Cabang-Cabang Iman','2025-02-09 15:27:25','2025-02-09 15:27:25'),(42,2,4,'ganjil',93.0,'Sudah Menguasai dalam Menerapkan Materi   Pancasila sebagai Dasar Negara','2025-02-09 15:27:25','2025-02-09 15:27:25'),(43,3,4,'ganjil',84.0,'Sudah Menguasai  Materi Laporan Hasil Observasi','2025-02-09 15:27:25','2025-02-09 15:27:25'),(44,4,4,'ganjil',90.0,'Perlu latihan dalam menguasai materi yang berkaitan dengan bilangan berpangkat, barisan dan deret','2025-02-09 15:27:25','2025-02-09 15:27:25'),(45,5,4,'ganjil',75.0,'Perlu latihan hakikat dan peran ilmu fisika serta pengukuran kerja ilmiah','2025-02-09 15:27:25','2025-02-09 15:27:25'),(46,6,4,'ganjil',81.0,'Sudah menguasai  dalam memahami rumus kimia, tata nama, dan persamaan reaksi','2025-02-09 15:27:25','2025-02-09 15:27:25'),(47,7,4,'ganjil',76.0,'Perlu latihan dalam memahami materi klasifikasi makhluk hidup','2025-02-09 15:27:25','2025-02-09 15:27:25'),(48,8,4,'ganjil',85.0,'Sudah menguasai materi Konsep Ilmu Ekonomi, Kelangkaan, Kebutuhan, Biaya Peluang, dan Skala Prioritas.','2025-02-09 15:27:25','2025-02-09 15:27:25'),(49,9,4,'ganjil',90.0,'Sudah menguasai materi fungsi sosiologi sebagai ilmu yang mengkaji tentang masyarakat','2025-02-09 15:27:25','2025-02-09 15:27:25'),(50,10,4,'ganjil',87.0,'Sudah Menguasai dalam Menerapkan Materi  Pengantar Ilmu Geografi dan Pemataan','2025-02-09 15:27:25','2025-02-09 15:27:25'),(51,11,4,'ganjil',87.0,'Sudah menguasai materi pengantar ilmu sejarah','2025-02-09 15:27:25','2025-02-09 15:27:25'),(52,12,4,'ganjil',90.0,'Sudah menguasai materi Greeting dan Narrative Text','2025-02-09 15:27:25','2025-02-09 15:27:25'),(53,13,4,'ganjil',87.0,'Sudah menguasai materi pengantar ilmu sejarah','2025-02-09 15:27:25','2025-02-09 15:27:25'),(54,14,4,'ganjil',85.0,'Peserta didik mampu memahami peran sistem operasi dan mekanisme internal yang terjadi pada interaksi antara perangkat keras perangkat lunak, dan pengguna','2025-02-09 15:27:25','2025-02-09 15:27:25'),(55,15,4,'ganjil',95.0,'Sudah Mahir dalam Menciptakan gerak tari Tradisi','2025-02-09 15:27:25','2025-02-09 15:27:25'),(56,16,4,'ganjil',85.0,'Perlu latihan untuk memahami materi Nilai dasar adat minang kabau dan sumpah sati bukit marapalam','2025-02-09 15:27:25','2025-02-09 15:27:25'),(57,1,2,'ganjil',80.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(58,2,2,'ganjil',80.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(59,3,2,'ganjil',80.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(60,4,2,'ganjil',95.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(61,5,2,'ganjil',95.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(62,6,2,'ganjil',95.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(63,7,2,'ganjil',90.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(64,8,2,'ganjil',80.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(65,9,2,'ganjil',60.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(66,10,2,'ganjil',50.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(67,11,2,'ganjil',80.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(68,12,2,'ganjil',90.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(69,13,2,'ganjil',90.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(70,14,2,'ganjil',100.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(71,15,2,'ganjil',95.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(72,16,2,'ganjil',60.0,NULL,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(73,1,1,'ganjil',82.0,'apa aja bole s','2025-02-12 09:29:25','2025-02-17 12:04:44'),(74,2,1,'ganjil',90.0,'Bercanda','2025-02-12 09:29:25','2025-02-17 12:04:44'),(75,3,1,'ganjil',75.0,'Sepuluh','2025-02-12 09:29:25','2025-02-17 12:04:44'),(76,4,1,'ganjil',90.0,'Berisik','2025-02-12 09:29:25','2025-02-17 12:04:44'),(77,5,1,'ganjil',77.0,'Berak','2025-02-12 09:29:25','2025-02-17 12:04:44'),(78,6,1,'ganjil',83.0,'Bercanda aha','2025-02-12 09:29:25','2025-02-17 12:04:44'),(79,7,1,'ganjil',89.0,'Bercanda aga','2025-02-12 09:29:25','2025-02-17 12:04:44'),(80,8,1,'ganjil',90.0,'asd','2025-02-12 09:29:25','2025-02-17 12:04:44'),(81,9,1,'ganjil',72.0,'asd','2025-02-12 09:29:25','2025-02-17 12:04:44'),(82,10,1,'ganjil',90.0,NULL,'2025-02-12 09:29:25','2025-02-17 12:04:44'),(83,11,1,'ganjil',75.0,NULL,'2025-02-12 09:29:25','2025-02-17 12:04:44'),(84,12,1,'ganjil',80.0,NULL,'2025-02-12 09:29:25','2025-02-17 12:04:44'),(85,13,1,'ganjil',80.0,'asdasd','2025-02-12 09:29:25','2025-02-17 12:04:44'),(86,14,1,'ganjil',75.0,'asdas','2025-02-12 09:29:25','2025-02-17 12:04:44'),(87,15,1,'ganjil',90.0,'asdas','2025-02-12 09:29:25','2025-02-17 12:04:44'),(88,16,1,'ganjil',90.0,'s','2025-02-12 09:29:25','2025-02-17 12:04:44'),(89,1,5,'ganjil',95.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(90,2,5,'ganjil',95.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(91,3,5,'ganjil',95.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(92,4,5,'ganjil',75.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(93,5,5,'ganjil',79.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(94,6,5,'ganjil',80.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(95,7,5,'ganjil',90.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(96,8,5,'ganjil',75.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(97,9,5,'ganjil',95.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(98,10,5,'ganjil',90.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(99,11,5,'ganjil',90.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(100,12,5,'ganjil',85.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(101,13,5,'ganjil',75.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(102,14,5,'ganjil',90.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(103,15,5,'ganjil',90.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(104,16,5,'ganjil',78.0,NULL,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(105,1,6,'ganjil',75.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(106,2,6,'ganjil',78.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(107,3,6,'ganjil',72.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(108,4,6,'ganjil',86.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(109,5,6,'ganjil',85.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(110,6,6,'ganjil',86.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(111,7,6,'ganjil',90.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(112,8,6,'ganjil',90.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(113,9,6,'ganjil',78.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(114,10,6,'ganjil',75.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(115,11,6,'ganjil',85.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(116,12,6,'ganjil',99.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(117,13,6,'ganjil',75.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(118,14,6,'ganjil',80.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(119,15,6,'ganjil',90.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(120,16,6,'ganjil',80.0,NULL,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(121,1,7,'ganjil',90.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(122,2,7,'ganjil',85.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(123,3,7,'ganjil',85.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(124,4,7,'ganjil',90.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(125,5,7,'ganjil',92.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(126,6,7,'ganjil',75.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(127,7,7,'ganjil',90.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(128,8,7,'ganjil',85.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(129,9,7,'ganjil',90.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(130,10,7,'ganjil',90.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(131,11,7,'ganjil',82.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(132,12,7,'ganjil',85.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(133,13,7,'ganjil',82.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(134,14,7,'ganjil',95.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(135,15,7,'ganjil',78.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(136,16,7,'ganjil',82.0,NULL,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(137,1,8,'ganjil',80.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(138,2,8,'ganjil',86.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(139,3,8,'ganjil',65.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(140,4,8,'ganjil',80.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(141,5,8,'ganjil',90.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(142,6,8,'ganjil',85.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(143,7,8,'ganjil',96.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(144,8,8,'ganjil',96.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(145,9,8,'ganjil',90.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(146,10,8,'ganjil',55.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(147,11,8,'ganjil',60.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(148,12,8,'ganjil',80.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(149,13,8,'ganjil',85.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(150,14,8,'ganjil',82.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(151,15,8,'ganjil',83.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(152,16,8,'ganjil',84.0,NULL,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(153,1,9,'ganjil',85.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(154,2,9,'ganjil',86.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(155,3,9,'ganjil',82.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(156,4,9,'ganjil',90.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(157,5,9,'ganjil',92.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(158,6,9,'ganjil',95.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(159,7,9,'ganjil',80.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(160,8,9,'ganjil',82.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(161,9,9,'ganjil',86.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(162,10,9,'ganjil',85.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(163,11,9,'ganjil',83.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(164,12,9,'ganjil',84.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(165,13,9,'ganjil',85.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(166,14,9,'ganjil',82.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(167,15,9,'ganjil',86.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(168,16,9,'ganjil',90.0,NULL,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(169,1,10,'ganjil',82.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(170,2,10,'ganjil',92.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(171,3,10,'ganjil',85.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(172,4,10,'ganjil',96.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(173,5,10,'ganjil',92.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(174,6,10,'ganjil',95.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(175,7,10,'ganjil',96.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(176,8,10,'ganjil',92.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(177,9,10,'ganjil',85.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(178,10,10,'ganjil',86.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(179,11,10,'ganjil',89.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(180,12,10,'ganjil',90.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(181,13,10,'ganjil',85.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(182,14,10,'ganjil',83.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(183,15,10,'ganjil',90.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(184,16,10,'ganjil',85.0,NULL,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(185,1,11,'ganjil',90.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(186,2,11,'ganjil',85.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(187,3,11,'ganjil',60.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(188,4,11,'ganjil',85.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(189,5,11,'ganjil',75.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(190,6,11,'ganjil',96.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(191,7,11,'ganjil',93.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(192,8,11,'ganjil',92.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(193,9,11,'ganjil',98.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(194,10,11,'ganjil',95.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(195,11,11,'ganjil',90.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(196,12,11,'ganjil',85.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(197,13,11,'ganjil',89.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(198,14,11,'ganjil',96.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(199,15,11,'ganjil',94.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(200,16,11,'ganjil',80.0,NULL,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(201,1,12,'ganjil',85.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(202,2,12,'ganjil',82.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(203,3,12,'ganjil',90.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(204,4,12,'ganjil',80.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(205,5,12,'ganjil',85.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(206,6,12,'ganjil',75.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(207,7,12,'ganjil',96.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(208,8,12,'ganjil',85.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(209,9,12,'ganjil',90.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(210,10,12,'ganjil',80.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(211,11,12,'ganjil',82.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(212,12,12,'ganjil',90.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(213,13,12,'ganjil',83.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(214,14,12,'ganjil',90.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(215,15,12,'ganjil',85.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(216,16,12,'ganjil',90.0,NULL,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(217,1,13,'ganjil',90.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(218,2,13,'ganjil',90.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(219,3,13,'ganjil',90.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(220,4,13,'ganjil',82.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(221,5,13,'ganjil',82.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(222,6,13,'ganjil',86.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(223,7,13,'ganjil',86.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(224,8,13,'ganjil',85.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(225,9,13,'ganjil',85.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(226,10,13,'ganjil',85.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(227,11,13,'ganjil',90.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(228,12,13,'ganjil',80.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(229,13,13,'ganjil',75.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(230,14,13,'ganjil',85.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(231,15,13,'ganjil',80.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(232,16,13,'ganjil',90.0,NULL,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(233,1,14,'ganjil',85.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(234,2,14,'ganjil',90.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(235,3,14,'ganjil',85.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(236,4,14,'ganjil',90.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(237,5,14,'ganjil',85.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(238,6,14,'ganjil',95.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(239,7,14,'ganjil',95.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(240,8,14,'ganjil',85.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(241,9,14,'ganjil',82.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(242,10,14,'ganjil',92.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(243,11,14,'ganjil',82.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(244,12,14,'ganjil',83.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(245,13,14,'ganjil',90.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(246,14,14,'ganjil',81.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(247,15,14,'ganjil',90.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(248,16,14,'ganjil',80.0,NULL,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(249,1,15,'ganjil',80.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(250,2,15,'ganjil',90.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(251,3,15,'ganjil',85.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(252,4,15,'ganjil',96.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(253,5,15,'ganjil',89.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(254,6,15,'ganjil',86.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(255,7,15,'ganjil',83.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(256,8,15,'ganjil',85.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(257,9,15,'ganjil',82.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(258,10,15,'ganjil',79.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(259,11,15,'ganjil',80.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(260,12,15,'ganjil',81.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(261,13,15,'ganjil',83.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(262,14,15,'ganjil',82.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(263,15,15,'ganjil',90.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(264,16,15,'ganjil',80.0,NULL,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(265,1,16,'ganjil',90.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(266,2,16,'ganjil',80.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(267,3,16,'ganjil',85.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(268,4,16,'ganjil',85.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(269,5,16,'ganjil',82.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(270,6,16,'ganjil',83.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(271,7,16,'ganjil',73.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(272,8,16,'ganjil',95.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(273,9,16,'ganjil',85.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(274,10,16,'ganjil',73.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(275,11,16,'ganjil',90.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(276,12,16,'ganjil',92.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(277,13,16,'ganjil',93.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(278,14,16,'ganjil',96.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(279,15,16,'ganjil',85.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(280,16,16,'ganjil',81.0,NULL,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(281,1,17,'ganjil',85.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(282,2,17,'ganjil',74.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(283,3,17,'ganjil',85.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(284,4,17,'ganjil',96.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(285,5,17,'ganjil',96.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(286,6,17,'ganjil',93.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(287,7,17,'ganjil',92.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(288,8,17,'ganjil',81.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(289,9,17,'ganjil',82.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(290,10,17,'ganjil',80.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(291,11,17,'ganjil',85.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(292,12,17,'ganjil',90.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(293,13,17,'ganjil',86.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(294,14,17,'ganjil',96.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(295,15,17,'ganjil',80.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(296,16,17,'ganjil',90.0,NULL,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(297,1,18,'ganjil',90.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(298,2,18,'ganjil',85.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(299,3,18,'ganjil',85.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(300,4,18,'ganjil',82.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(301,5,18,'ganjil',93.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(302,6,18,'ganjil',92.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(303,7,18,'ganjil',96.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(304,8,18,'ganjil',92.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(305,9,18,'ganjil',99.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(306,10,18,'ganjil',85.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(307,11,18,'ganjil',89.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(308,12,18,'ganjil',88.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(309,13,18,'ganjil',78.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(310,14,18,'ganjil',70.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(311,15,18,'ganjil',60.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(312,16,18,'ganjil',90.0,NULL,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(313,1,30,'ganjil',20.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(314,2,30,'ganjil',80.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(315,3,30,'ganjil',50.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(316,4,30,'ganjil',60.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(317,5,30,'ganjil',70.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(318,6,30,'ganjil',75.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(319,7,30,'ganjil',80.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(320,8,30,'ganjil',90.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(321,9,30,'ganjil',50.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(322,10,30,'ganjil',60.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(323,11,30,'ganjil',50.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(324,12,30,'ganjil',55.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(325,13,30,'ganjil',66.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(326,14,30,'ganjil',75.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(327,15,30,'ganjil',85.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15'),(328,16,30,'ganjil',95.0,NULL,'2025-02-17 12:50:15','2025-02-17 12:50:15');
/*!40000 ALTER TABLE `monitoring_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilai_siswa`
--

DROP TABLE IF EXISTS `nilai_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nilai_siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idsiswa` bigint unsigned DEFAULT NULL,
  `tingkat_kelas` int NOT NULL,
  `ganjil` tinyint(1) NOT NULL DEFAULT '0',
  `genap` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_siswa_idsiswa_foreign` (`idsiswa`),
  CONSTRAINT `nilai_siswa_idsiswa_foreign` FOREIGN KEY (`idsiswa`) REFERENCES `siswa` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai_siswa`
--

LOCK TABLES `nilai_siswa` WRITE;
/*!40000 ALTER TABLE `nilai_siswa` DISABLE KEYS */;
INSERT INTO `nilai_siswa` VALUES (3,4,1,1,0,'2025-02-09 15:27:25','2025-02-09 15:27:25'),(4,2,1,1,0,'2025-02-12 09:04:25','2025-02-12 09:04:25'),(5,1,1,1,0,'2025-02-12 09:29:25','2025-02-12 09:29:25'),(6,5,1,1,0,'2025-02-12 09:30:11','2025-02-12 09:30:11'),(7,6,1,1,0,'2025-02-12 09:31:09','2025-02-12 09:31:09'),(8,7,1,1,0,'2025-02-12 09:32:01','2025-02-12 09:32:01'),(9,8,1,1,0,'2025-02-12 09:33:30','2025-02-12 09:33:30'),(10,9,1,1,0,'2025-02-12 09:34:10','2025-02-12 09:34:10'),(11,10,1,1,0,'2025-02-12 09:34:37','2025-02-12 09:34:37'),(12,11,1,1,0,'2025-02-12 09:35:04','2025-02-12 09:35:04'),(13,12,1,1,0,'2025-02-12 09:35:57','2025-02-12 09:35:57'),(14,13,1,1,0,'2025-02-12 09:36:41','2025-02-12 09:36:41'),(15,14,1,1,0,'2025-02-12 09:59:06','2025-02-12 09:59:06'),(16,15,1,1,0,'2025-02-12 11:13:54','2025-02-12 11:13:54'),(17,16,1,1,0,'2025-02-12 11:14:26','2025-02-12 11:14:26'),(18,17,1,1,0,'2025-02-12 11:15:02','2025-02-12 11:15:02'),(19,18,1,1,0,'2025-02-12 11:15:31','2025-02-12 11:15:31'),(20,30,1,1,0,'2025-02-17 12:50:15','2025-02-17 12:50:15');
/*!40000 ALTER TABLE `nilai_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('wCWWniV07Jr7etXPVOs5x4UXobQKefvDF8CNUqkV',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVRpV2JhNHZIcktUdDNHNnFlUWZBQXdaa0RXTDZ1WXgxSlE5V3NPNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9uaWxhaSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1739885501);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `templahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgllahir` date NOT NULL,
  `jk` enum('lk','pr','nd') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nd',
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `idkelas` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`),
  KEY `siswa_idkelas_foreign` (`idkelas`),
  CONSTRAINT `siswa_idkelas_foreign` FOREIGN KEY (`idkelas`) REFERENCES `kelas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` VALUES (1,'6058','BINTANG FEBRIADI','Solok','2004-11-27','lk','Jalan Sudirman No.105',1,'2025-02-09 02:23:33','2025-02-09 13:03:26'),(2,'6057','AURA YUNDRA PUTRI','Padang','2003-12-21','pr','Jalan Wonosobo 205',1,'2025-02-09 03:11:12','2025-02-09 13:03:10'),(4,'6056','ASSYIFA FAZWINA AZ-ZAHRA','Jakarta','2003-10-30','pr','Jalan Sudirman 22',1,'2025-02-09 03:14:23','2025-02-09 15:36:03'),(5,'6055','ABDUL MUIS','Padang','2004-11-30','lk','Jalan Handayani 29',1,'2025-02-09 03:19:18','2025-02-09 13:01:42'),(6,'6059','CHELSI OLIVIA','Solok','2004-12-08','pr',NULL,1,'2025-02-09 13:04:30','2025-02-09 13:04:30'),(7,'6060','DAVA NOVRIADI','Padang','2004-12-06','lk',NULL,1,'2025-02-09 13:05:08','2025-02-09 13:05:08'),(8,'6061','DEAYU RAMADHANI','Padang','2004-06-09','pr',NULL,1,'2025-02-09 13:05:44','2025-02-09 13:05:44'),(9,'6062','DINI','Solok','2004-10-05','pr',NULL,1,'2025-02-09 13:06:05','2025-02-09 13:06:05'),(10,'6063','EMILLA DWI GUSRA','Payakumbuh','2004-07-08','pr',NULL,1,'2025-02-09 13:06:28','2025-02-09 13:06:28'),(11,'6064','FAHRI MUHAMMAD M.','Bukittinggi','2004-08-18','lk',NULL,1,'2025-02-09 13:07:05','2025-02-09 13:07:05'),(12,'6065','FAHZA PUTRI RAHMADANI','Solok','2004-09-10','pr',NULL,1,'2025-02-09 13:07:33','2025-02-09 13:07:33'),(13,'6066','FAZURA DWI AFNI','Padang','2004-03-03','pr',NULL,1,'2025-02-09 13:07:58','2025-02-09 13:07:58'),(14,'6067','FERDY ADRIANSYAH','Pariaman','2004-02-11','lk',NULL,1,'2025-02-09 13:08:24','2025-02-09 13:08:24'),(15,'6068','GALIF PERDANA PUTRA','Padang','2004-09-22','lk',NULL,1,'2025-02-09 13:08:47','2025-02-09 13:08:47'),(16,'6069','GEISHA INDAH ASHIFA','Jakarta','2004-08-12','pr',NULL,1,'2025-02-09 13:09:21','2025-02-09 13:09:21'),(17,'6070','HANIFA SOLFIANTI','Bandung','2004-07-02','pr',NULL,1,'2025-02-09 13:09:45','2025-02-09 13:09:45'),(18,'6071','IRSYADUL FATHA','Pasaman','2004-06-11','lk',NULL,1,'2025-02-09 13:10:04','2025-02-09 13:10:04'),(19,'6072','JULIA PUTRI','Bukittinggi','2004-06-11','pr',NULL,1,'2025-02-09 13:10:30','2025-02-09 13:10:30'),(20,'6073','KEISYA YOLANDA PUTRI','Solok','2004-10-13','pr',NULL,1,'2025-02-09 13:11:27','2025-02-09 13:11:27'),(21,'6074','KIVO SOFI YANDA','Batu Sangkar','2004-08-20','lk',NULL,1,'2025-02-09 13:11:59','2025-02-09 13:11:59'),(22,'6075','LATIFA ARIE FAEDAH','Maninjau','2004-09-09','pr',NULL,1,'2025-02-09 13:12:27','2025-02-09 13:12:27'),(23,'6076','MAI GEZA PUTRA','Payakumbuh','2004-05-13','lk',NULL,1,'2025-02-09 13:12:48','2025-02-09 13:12:48'),(24,'6077','MARDE NATHA','Bali','2004-01-10','lk',NULL,1,'2025-02-09 13:13:11','2025-02-09 13:13:11'),(25,'6078','MUHAMMAD MARVEL','Surabaya','2004-09-20','lk',NULL,1,'2025-02-09 13:14:01','2025-02-09 13:14:01'),(26,'6079','MUTIARA KARINA','Banjarmasin','2004-05-07','pr',NULL,1,'2025-02-09 13:14:59','2025-02-09 13:14:59'),(27,'6086','NABILA RAHMADHANI','Painan','2004-06-10','pr',NULL,1,'2025-02-09 13:15:26','2025-02-09 13:15:26'),(28,'6080','NATASHA MARDIANI','Pasaman','2004-06-18','pr',NULL,1,'2025-02-09 13:15:45','2025-02-09 13:15:45'),(29,'6081','RAFLI','Padang','2004-06-11','lk',NULL,1,'2025-02-09 13:16:12','2025-02-09 13:16:12'),(30,'6342','SUCI NOVI NUGRAINI','Padang','2004-04-16','pr',NULL,1,'2025-02-09 13:16:30','2025-02-09 14:01:03'),(31,'6082','SUCI RAHMADANI','Bukittinggi','2004-05-13','pr',NULL,1,'2025-02-09 13:16:52','2025-02-09 13:16:52'),(32,'6083','SYAFIRA PUTRI BETARI','Solok','2004-04-16','pr',NULL,1,'2025-02-09 13:17:12','2025-02-09 13:17:12'),(33,'6084','TEGAR NAN TEGUH','Payakumbuh','2004-08-12','lk',NULL,1,'2025-02-09 13:17:35','2025-02-09 13:17:35'),(34,'6085','ZAHRA FERRYANETHY','Medan','2004-04-28','pr',NULL,1,'2025-02-09 13:18:12','2025-02-09 13:18:12');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa','kepsek') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `idsiswa` bigint unsigned DEFAULT NULL,
  `idkelas` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_idsiswa_foreign` (`idsiswa`),
  KEY `users_idkelas_foreign_idx` (`idkelas`),
  CONSTRAINT `users_idkelas_foreign` FOREIGN KEY (`idkelas`) REFERENCES `kelas` (`id`),
  CONSTRAINT `users_idsiswa_foreign` FOREIGN KEY (`idsiswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','administrator@mail.com','$2y$12$Mx8L8VoSoHdgGjVbLnhP0.e8BjmUD/OZk/uepTg9L1t.9U2SCpi9O','admin',NULL,NULL,'2025-02-17 08:43:12','2025-02-17 08:43:12'),(2,'Guru Walas','guruwalas@mail.com','$2y$12$KTwy5qzhqAXFM1WA0VANX.Ys76XIh/U.pUqupDjwYMdE97uRVwrye','guru',NULL,1,'2025-02-17 08:43:12','2025-02-18 06:19:23'),(3,'Kepala Sekolah','kepsek@mail.com','$2y$12$i02l3IKx.evsyVIGfV6gce8g6xY6ZtntYN0.J3XNqEod35XZtkfjq','kepsek',NULL,NULL,'2025-02-17 08:43:12','2025-02-17 08:43:12'),(4,'hasanudin','hasanudin@mail.com','$2y$12$kuz41qFqyksVYXo1o.5COegntpgvaCXM2ZGgIn0yEJIpTvQV1.gXi','siswa',4,NULL,'2025-02-17 08:51:32','2025-02-17 08:51:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ta_monitoring_nilai'
--

--
-- Dumping routines for database 'ta_monitoring_nilai'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-18 20:34:23

-- MySQL dump 10.13  Distrib 8.4.7, for macos15.7 (arm64)
--
-- Host: localhost    Database: projects_electro_pi_technical_assessment
-- ------------------------------------------------------
-- Server version	9.5.0

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '2cc28320-75e2-11ee-94a1-5e494526e46d:1-3896502,
34da99d2-0e10-11ef-b192-7e5c00e742b5:1-546787788,
3f25873b-899b-11f0-8feb-c673adb5516a:1-59976086,
44179617-0597-11f0-8a78-f2ee11f9bb19:1-59728581,
47479a2d-d099-11ee-a467-d21daaf42f5a:1-646939904,
5fa1c4a2-b385-11f0-ac56-4695795dd240:1-18796299,
78d64d80-b9b9-11f0-ac62-5b9f0d61c1a4:1-1254046,
96a1d50e-df15-11ef-ab1f-866c8069bdc0:1-21951824,
ac78e793-3eca-11ef-b40a-da5ba47ccecf:1-264667043,
c3e4b3d4-8192-11ef-b986-ca75845d1110:1-26797765';

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_07_31_132522_create_personal_access_tokens_table',1),(5,'2026_07_31_144738_create_projects_table',1),(6,'2026_07_31_190925_create_tasks_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','completed','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_user_id_foreign` (`user_id`),
  CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,1,'Website Redesign','Odit commodi voluptatum id temporibus ut officia omnis. Reprehenderit nisi in et qui. Consequatur facilis at odit atque molestiae. Facilis deleniti ut nihil.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(2,1,'Mobile App Launch','Consectetur cumque non aut aut quod tempore deserunt nihil. Eum quidem molestiae autem incidunt ullam et. Repudiandae voluptate labore maiores quod quia et rem. Nemo ut nisi aut.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(3,1,'Q1 Marketing Campaign','Doloremque vitae quis dolor ut aut. Velit quibusdam quam voluptatem. Voluptatibus magni alias voluptatem quos cumque.','completed',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(4,1,'Legacy System Migration','Natus et aperiam aspernatur. Aut occaecati iusto quaerat ut nulla. Aspernatur omnis occaecati similique assumenda consequatur. Animi cumque aut dolor.','archived',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(5,2,'API Integration Platform','Eaque non repellat eum et et. Quo tempore aut ut. Laborum ut facere repellat beatae qui molestias facilis.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(6,2,'Customer Support Portal','Hic voluptas aliquid aut aut facere nihil. Animi id modi ut sunt aperiam aspernatur.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(7,2,'Internal Tooling Revamp','Ab rem quaerat libero dolorem sunt. Ducimus quia assumenda officia ipsum occaecati. Iure tempore a consequatur at quae distinctio ea magnam. Minima et non debitis quidem unde eum blanditiis.','completed',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(8,3,'Corrupti ut quae.','Ad omnis amet voluptas corrupti sint et eum. Debitis nobis ab dolorum ea molestias. Quo aperiam blanditiis sint. Eveniet ea reiciendis animi ratione.','archived',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(9,4,'Incidunt qui.','Quam nam sit alias quas et nihil saepe. Blanditiis facilis minima ad dignissimos aut cupiditate. Et est libero consequatur rerum. Sit ea totam libero iure quia distinctio ab consequuntur.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(10,5,'Ab id aut.','Culpa molestias sit et sit libero. Nam fugiat voluptatem dolores velit. Nihil eligendi et voluptate voluptate fugit ipsam.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(11,6,'Sed dolore nobis veritatis.','Placeat ducimus omnis maiores repudiandae. Voluptatem corrupti facere ipsum animi eos occaecati dolorem blanditiis. Sint fuga sequi tempora sint temporibus.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(12,7,'Soluta nihil et.','Pariatur quisquam eligendi labore error asperiores quia aliquam ad. Maxime possimus tempore beatae sed officia vitae sunt. Molestiae ex consequuntur quam aliquid.','archived',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(13,8,'Odio itaque et quia.','Sapiente quae possimus vel perspiciatis quo. Voluptatem aut assumenda sint qui voluptatem. Non et nihil harum.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(14,9,'Aliquid praesentium recusandae minus.','Rerum illum sequi distinctio illum facere et ullam est. Ut ratione et dolor qui ut blanditiis labore. Aperiam libero rerum magni nisi. Aut modi blanditiis rerum.','archived',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(15,10,'Culpa tempore nobis.','Aspernatur repellendus quidem error voluptatem. Maiores fugit ut nesciunt tenetur non praesentium harum. In unde quia tempore ut dolor voluptas. Consequuntur iusto voluptas voluptate nihil rerum minus qui sed.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(16,11,'Ducimus voluptas tempore a.','Laboriosam tempora sed eveniet odio eos. Ut consequuntur sit porro aperiam officia perferendis. Similique architecto similique pariatur ex ipsa at omnis. Et ducimus eum placeat ut nobis.','completed',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(17,12,'Dolor occaecati.','Omnis eos molestias qui provident facilis. Quod dolores quo provident nihil quibusdam. Et autem est id voluptate perspiciatis rerum ut.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(18,13,'Necessitatibus ipsam aliquam repellat aut.','Aut nihil ut autem itaque vel. Qui adipisci sed libero quas nemo in. Porro et non doloremque eos corrupti.','completed',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(19,14,'Libero doloribus aliquid fugit iusto.','Explicabo beatae et suscipit consequatur blanditiis est quas. In dolor a quisquam cumque praesentium. Consequatur sequi veritatis eum praesentium sed pariatur. Voluptatem voluptas non ut architecto voluptatem nihil ut. Sint tenetur et quod.','archived',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(20,15,'Exercitationem commodi voluptatum aliquid.','Expedita omnis atque beatae possimus distinctio. Quis enim consequatur tempora id est saepe dolores. Ipsa fugiat tempora placeat. Magnam ad saepe voluptas et ab iure et. Illum est voluptates nemo dignissimos.','archived',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(21,16,'Magni quia explicabo unde.','Dicta atque doloribus et ut aspernatur voluptatem nihil. Aut animi exercitationem provident explicabo placeat ducimus voluptatem. Ut cupiditate laudantium commodi et aspernatur autem.','active',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(22,17,'Odit harum necessitatibus.','Totam veniam accusantium voluptas. Explicabo sapiente eligendi est consequatur. Totam eos soluta ducimus accusamus sed magni blanditiis odit.','completed',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `status` enum('todo','in_progress','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `due_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,'Finish the design mockups','Omnis earum eligendi ducimus voluptatem dolor repellendus et. Quos quam animi aut sunt est repellendus enim. Et dolorem error dignissimos veniam officia voluptatem voluptatem qui. Perferendis voluptatem consequatur et fugiat corporis.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(2,1,'Fix the login page bug','Aspernatur quis omnis enim quia et. Aut nihil sint natus. Consequatur blanditiis eaque voluptas rerum numquam quas harum. Expedita eaque velit asperiores aut nesciunt harum.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(3,1,'Write API documentation','Asperiores qui et et qui debitis alias. Omnis animi quam aliquam et. Dolores ut voluptas ut aut error necessitatibus voluptatem.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(4,1,'Plan next sprint','Laboriosam dolores fugit illo voluptatem est odio sed. Omnis corporis quae reiciendis reprehenderit. Facilis at atque esse non dignissimos.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(5,1,'Repellat tempora suscipit deleniti et et voluptatum veniam ad.','In distinctio commodi perferendis minima est. Deleniti ut quos magnam repellendus quibusdam minima consequatur. Qui in at ut. Quod voluptatem enim sint id quasi.','low','todo','2027-02-18',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(6,1,'Vitae ducimus veniam voluptatum mollitia.','Error occaecati nemo laborum ducimus itaque ut. Aliquid non deserunt in suscipit corrupti. Minus blanditiis perferendis consequatur qui perspiciatis.','high','todo','2026-12-29',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(7,1,'Dolore sunt eum aut aut eveniet magni.','Ut officiis voluptas qui quidem laboriosam quibusdam et libero. Sunt nihil rerum unde exercitationem ut voluptate earum. Id autem sed unde voluptas.','low','in_progress','2027-05-24',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(8,2,'Finish the design mockups','Eligendi voluptas autem deserunt tenetur. Aspernatur porro nihil excepturi ut ut ratione delectus quia. Sed saepe culpa ipsa saepe.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(9,2,'Fix the login page bug','Quo aut fugiat error. Ut nam dolores esse eligendi et consequuntur. Dignissimos debitis cum nam aut corrupti tempore. Ut fugit natus nemo eum quia soluta ab et.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(10,2,'Write API documentation','Eaque provident ad libero. Voluptas totam impedit neque corporis odit nemo sint. Velit nesciunt hic at non tempore. Natus dolore sapiente repudiandae explicabo ab quo non. Voluptas dolorem sit earum exercitationem pariatur quia.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(11,2,'Plan next sprint','Assumenda omnis animi aut mollitia reprehenderit. Sint voluptas exercitationem minima commodi ex.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(12,2,'Velit aut adipisci animi qui ex iste.','Consequuntur architecto deserunt eos molestiae. Accusamus delectus nostrum maxime velit. Et praesentium dolores adipisci at minus. Vel explicabo illo quo aspernatur distinctio eaque mollitia. Qui quaerat cupiditate est aut incidunt.','low','todo','2026-09-23',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(13,2,'Vero qui occaecati enim.','Quae in velit non sunt id sunt. At recusandae recusandae repellendus qui facere sint. Consectetur iure sapiente illum aut.','medium','done','2027-07-26',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(14,2,'Debitis totam eveniet recusandae in iusto.','Omnis ut necessitatibus quae pariatur amet qui quas. Cupiditate blanditiis ut quibusdam sint nesciunt. Molestiae delectus reiciendis ullam asperiores et asperiores voluptatem. Magnam magnam rem numquam qui dolore rerum.','low','in_progress','2026-10-18',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(15,3,'Finish the design mockups','Est veniam itaque blanditiis a est reiciendis. Amet nulla numquam et numquam magni blanditiis eos architecto. Quisquam sed rerum odit fugiat quam sit. Earum sit in dolorem praesentium sed et est.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(16,3,'Fix the login page bug','Consequatur ipsam repellat et enim qui. Omnis laboriosam est expedita repudiandae accusamus. Et et iure non illum inventore vitae ipsum similique.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(17,3,'Write API documentation','Quis quia quam aperiam incidunt sed vitae animi. Provident magnam nobis omnis. Et id nihil numquam pariatur consequatur. Laboriosam aut voluptas deserunt soluta ea omnis.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(18,3,'Plan next sprint','Similique doloremque totam beatae aperiam fugiat. Nobis eligendi accusamus voluptatem laboriosam. Sit consectetur vero occaecati sit rem. Magni dolores voluptatem possimus totam quia voluptatem.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(19,3,'Aut esse quod dolorem placeat libero.','Quia et voluptas eveniet perspiciatis saepe iusto aut beatae. Natus eligendi tempora pariatur illum.','low','todo','2027-03-06',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(20,3,'Quaerat consequatur alias dignissimos assumenda autem.','Est recusandae qui praesentium velit molestias. Assumenda vitae incidunt voluptatem ut culpa numquam totam. A dolorem nobis deserunt est nobis et.','low','todo','2027-02-21',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(21,3,'Sed harum numquam similique eius.','Reprehenderit enim exercitationem consequuntur sed saepe sunt amet. Nemo sed pariatur quos ex. Aspernatur quia dolorem culpa esse mollitia. Et voluptatem vero qui eum accusamus eius dolores.','low','done','2027-04-24',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(22,4,'Finish the design mockups','Ad est aliquid accusamus est quia et animi commodi. Reiciendis provident sit rerum. Aut consequatur explicabo aut corrupti et est.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(23,4,'Fix the login page bug','Consectetur sed quia ipsam iste accusantium. Tempore eum nesciunt ea perspiciatis aut.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(24,4,'Write API documentation','Consequuntur quis suscipit sequi odio non exercitationem eaque quaerat. Ex rerum possimus sed doloribus distinctio voluptatem. Aut odit blanditiis sunt libero aperiam distinctio facere.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(25,4,'Plan next sprint','Culpa quos quia nobis consequatur aspernatur. Natus cumque dolorem aut pariatur libero aut. Sed accusantium qui molestiae esse.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(26,4,'Consequuntur dolor sed asperiores et fugit ea necessitatibus.','Et ipsam sunt rerum velit nostrum repellendus laborum et. Velit aut magni voluptas quo voluptas. Consectetur assumenda omnis provident.','low','done','2027-04-01',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(27,4,'Repudiandae aut ut sapiente cupiditate aut tempora porro in.','Ut est tempora unde et accusamus. Est voluptatem voluptatem et aut quam voluptas consequatur. At eius nam quis odit adipisci.','high','todo','2027-04-12',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(28,4,'Nostrum odio magni officia.','Ut non consequatur odit fugiat doloremque rerum. Aliquid temporibus voluptas repellat et qui sed placeat. Tempore praesentium qui iste laboriosam exercitationem voluptate. Ut voluptas aspernatur ut laboriosam minima. Assumenda eligendi impedit omnis sed.','high','done','2027-04-28',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(29,5,'Finish the design mockups','Delectus distinctio ex sint ipsam. Eos iusto est pariatur rerum eum eaque. Repellat error veritatis eaque voluptatem non. Nulla in omnis molestiae commodi tempora optio reprehenderit.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(30,5,'Fix the login page bug','Non quis corporis animi officiis. Sit ipsa id nemo neque et itaque. Distinctio velit quaerat ut.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(31,5,'Write API documentation','Sunt doloribus soluta voluptatum. Voluptatem fugiat quas provident. Consequuntur ad dolores non.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(32,5,'Plan next sprint','Sint libero enim ut. Rerum id quia voluptatem nesciunt exercitationem quis officiis. Repellat sit dolor officia voluptas voluptatibus qui.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(33,5,'Deleniti porro qui maxime nulla magnam fugiat quas repudiandae.','Quis velit et aut assumenda consequatur quia. Libero et quidem unde eum corporis dolorum eos. Ipsum rerum minima mollitia velit.','medium','todo','2027-01-29',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(34,5,'Fuga officiis non quaerat dolore veritatis aliquam et ut.','Minus aut et quo ut qui. Soluta cumque dolor ea quisquam ipsa. Dolorem sapiente dolor et reiciendis mollitia ducimus.','high','todo','2027-01-15',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(35,5,'Eaque praesentium inventore corporis dolor eos.','Libero ipsa cum quod eligendi natus nisi. Et eos iste dolore fugit consequatur nemo. Atque autem nulla quia quibusdam.','high','done','2026-08-03',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(36,6,'Finish the design mockups','Vel cupiditate pariatur repellendus laboriosam reprehenderit sunt. Sint aut quos laudantium dicta voluptates hic quia. Nihil voluptate incidunt sed vel veritatis sunt. Tempore qui eligendi cupiditate animi. Eligendi consectetur temporibus nihil ipsam est rerum ex.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(37,6,'Fix the login page bug','Voluptatem est aut vitae id. Modi placeat quo nesciunt delectus at. Qui dolorum ea omnis ut est. Dolore dolores repudiandae veniam aspernatur doloribus sed exercitationem voluptatem.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(38,6,'Write API documentation','Accusamus architecto earum modi aut. Voluptate consequatur repellat aut doloribus amet. Cum et dolorem eligendi accusamus.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(39,6,'Plan next sprint','Illo excepturi id sed et esse consequatur facilis qui. In eius et optio praesentium dolorem dolor. Consequatur blanditiis quod reiciendis velit aut et.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(40,6,'Maxime voluptatum deleniti ipsa ab.','Ex pariatur illum saepe. Est mollitia laborum nisi totam amet qui est. Et eos perspiciatis quae natus excepturi temporibus commodi. Autem et perferendis eum quibusdam ut.','low','done','2026-11-01',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(41,6,'Facere doloribus consequatur corporis quae cum quidem.','Quibusdam odio eos veniam fuga. Fugit aspernatur vel nihil adipisci quidem ratione. Et autem iusto itaque ut.','high','todo','2027-03-15',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(42,6,'Praesentium nulla ut mollitia distinctio.','Minima voluptatem ut numquam praesentium incidunt qui non. Odio pariatur beatae non totam perspiciatis dicta numquam et. Est harum accusamus perspiciatis natus quia necessitatibus. Quos et voluptates ea repellendus qui.','medium','in_progress','2027-07-28',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(43,7,'Finish the design mockups','Error ea et reprehenderit porro fuga. Aut enim omnis et fuga eius illo.','high','done','2026-07-27',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(44,7,'Fix the login page bug','Minima illum accusantium nobis. Velit eaque et laborum et dolorem et. Commodi qui voluptas in occaecati voluptatem.','high','in_progress','2026-08-04',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(45,7,'Write API documentation','Et voluptas rem quo ullam doloribus doloribus aut. Impedit sed quam veritatis fuga qui.','medium','todo','2026-07-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(46,7,'Plan next sprint','Animi aut sed eos voluptatem quis quam. Porro odit qui voluptate voluptatem asperiores atque. Ut odio sunt tempora eum sequi et aperiam. Porro sunt suscipit architecto dolores.','low','todo',NULL,NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(47,7,'Debitis quidem et aut voluptas accusantium odit doloribus.','Molestiae deserunt voluptatem atque consequuntur quia consequatur laborum. Quasi voluptas repudiandae voluptas aspernatur. Odit doloremque recusandae eum natus eum id animi doloribus. Nobis quas est nihil quam.','low','todo','2027-07-31',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(48,7,'Impedit a laboriosam sunt laborum non.','Quis recusandae recusandae suscipit quasi sit cumque. Illo natus aut itaque voluptatem iusto voluptatum nihil. Dolorum aperiam saepe repellat. Et in facilis id non ut.','high','in_progress','2027-03-19',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(49,7,'Adipisci debitis numquam rem asperiores eaque qui.','Aliquam tenetur aut aut aspernatur qui omnis at. Voluptate voluptatem et consectetur. Dolore reiciendis suscipit ipsa. Animi eius quis consequatur odit.','high','in_progress','2026-10-09',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(50,13,'Aliquid pariatur amet magnam soluta voluptatem sequi temporibus saepe.','Et aut eos sint eligendi. Excepturi ut quos voluptates nemo deleniti possimus voluptas. Vel debitis soluta quos in hic voluptatem.','low','done','2027-06-25',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(51,14,'Fugiat et dolor illum sunt modi dolorum quia.','Voluptas facilis possimus autem ratione eveniet. Et fugit reprehenderit aspernatur qui doloribus. Iusto quisquam debitis necessitatibus.','low','todo','2026-09-10',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(52,15,'Provident quia quasi expedita repellat.','Repellat maxime non ipsam velit. Doloremque hic aliquam facilis. Laborum accusamus quasi dolor dignissimos impedit officia commodi. Sit consequatur qui et est odio minima.','high','done','2027-01-30',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(53,16,'Ipsum non natus iste optio.','Iste doloremque enim eos voluptates sint. Et voluptatem est quo est aliquam est. Nisi non nemo consequatur eveniet. Quaerat ipsum sit quia blanditiis.','high','todo','2027-01-22',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(54,17,'Sint quia odit corporis debitis.','Saepe libero a minus et quo est vero. Sit consequatur dolorum excepturi aliquid ut non. Ullam quas quam est. Cupiditate fuga quidem nobis ipsam et et corrupti.','high','done','2026-12-25',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(55,18,'Rerum unde assumenda consequatur natus.','Et asperiores voluptates quo pariatur. Sed eos similique est reiciendis dolorem. Consectetur quaerat magnam voluptates et.','medium','done','2027-07-09',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(56,19,'Quasi magnam consequuntur dolore dolorem qui corrupti.','Occaecati et saepe sit recusandae. Repellendus non explicabo nobis autem dolor. Quia et est in officia autem quia dignissimos aut. Culpa voluptatum accusantium optio voluptates ipsum.','low','todo','2027-07-26',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(57,20,'Amet cupiditate quia est.','Rerum molestiae impedit est illum ipsum quis. Quaerat non natus et magni. Ea enim nostrum culpa veritatis odio ullam non. Sit enim fugit molestiae rerum consequatur vero voluptatibus incidunt.','medium','todo','2027-06-01',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(58,21,'Architecto iure aliquid et iusto ab similique eum.','Dolore voluptates officiis consequatur qui. Laudantium nulla velit aut aut expedita consequatur dolorum architecto. Sit numquam commodi explicabo doloribus assumenda in.','medium','done','2026-09-09',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20'),(59,22,'Voluptate distinctio omnis iste alias aspernatur suscipit et.','Eaque est recusandae nesciunt nesciunt qui dolor. Facere est explicabo iure accusantium dolor commodi quis. Odit et repellendus voluptatem rerum ullam doloremque laboriosam.','medium','in_progress','2027-05-07',NULL,'2026-08-01 09:11:20','2026-08-01 09:11:20');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','CXfGOl8lBx','2026-08-01 09:11:20','2026-08-01 09:11:20'),(2,'Second User','test2@example.com','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','dqDxGK2qSu','2026-08-01 09:11:20','2026-08-01 09:11:20'),(3,'Zachery Nienow','gibson.emmitt@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','Vo1eDedvOX','2026-08-01 09:11:20','2026-08-01 09:11:20'),(4,'Deon Grant','zschamberger@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','RzkUHoMM8s','2026-08-01 09:11:20','2026-08-01 09:11:20'),(5,'Roberta Boehm','prosacco.shanelle@example.com','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','SYP8zLkOLt','2026-08-01 09:11:20','2026-08-01 09:11:20'),(6,'Minerva Stiedemann','savion.prohaska@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','IWXS4F7HUl','2026-08-01 09:11:20','2026-08-01 09:11:20'),(7,'Mara Graham PhD','may13@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','8RJDKD4jwX','2026-08-01 09:11:20','2026-08-01 09:11:20'),(8,'Tamia Murray','ekris@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','819rErPiRp','2026-08-01 09:11:20','2026-08-01 09:11:20'),(9,'Prof. Trey Streich','gleason.rico@example.org','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','qhHFl9ifQk','2026-08-01 09:11:20','2026-08-01 09:11:20'),(10,'Dr. Avery Ledner V','reanna.metz@example.com','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','MlIE1cJjgq','2026-08-01 09:11:20','2026-08-01 09:11:20'),(11,'Mr. Jermain Hauck II','hoeger.hubert@example.com','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','w0ZKYLsbdk','2026-08-01 09:11:20','2026-08-01 09:11:20'),(12,'Cletus McDermott','schowalter.tad@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','e66l1L5QCc','2026-08-01 09:11:20','2026-08-01 09:11:20'),(13,'Margie Hills','upfeffer@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','UunVqm01gF','2026-08-01 09:11:20','2026-08-01 09:11:20'),(14,'Prof. Drew Bartoletti PhD','nikki65@example.org','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','QWpSyGBCxv','2026-08-01 09:11:20','2026-08-01 09:11:20'),(15,'Lucie Kirlin','dgerlach@example.net','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','94nhRJKPb7','2026-08-01 09:11:20','2026-08-01 09:11:20'),(16,'Dr. Liliana Thompson','kuphal.doug@example.org','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','4GaM5bGLPK','2026-08-01 09:11:20','2026-08-01 09:11:20'),(17,'Ms. Aiyana Hills PhD','fmedhurst@example.org','2026-08-01 09:11:20','$2y$12$/yBDDrr7CrJXSYBselI12uAeFwFPDI.tTY2sWrbC9v1vU3CTaAQj6','MW363jEvnz','2026-08-01 09:11:20','2026-08-01 09:11:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'projects_electro_pi_technical_assessment'
--
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-01 15:12:20

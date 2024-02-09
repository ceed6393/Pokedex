-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour pokesymfo
CREATE DATABASE IF NOT EXISTS `pokesymfo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pokesymfo`;

-- Listage de la structure de table pokesymfo. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table pokesymfo.doctrine_migration_versions : ~11 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240116204342', '2024-01-16 20:44:57', 171),
	('DoctrineMigrations\\Version20240116223418', '2024-01-16 22:35:27', 24),
	('DoctrineMigrations\\Version20240118150255', '2024-01-18 15:03:08', 20),
	('DoctrineMigrations\\Version20240118155104', '2024-01-18 15:51:15', 44),
	('DoctrineMigrations\\Version20240118180608', '2024-01-18 18:06:27', 33),
	('DoctrineMigrations\\Version20240118202343', '2024-01-18 20:23:51', 24),
	('DoctrineMigrations\\Version20240118204356', '2024-01-18 20:44:02', 18),
	('DoctrineMigrations\\Version20240118204929', '2024-01-18 20:49:35', 11),
	('DoctrineMigrations\\Version20240119084901', '2024-01-19 08:49:06', 15),
	('DoctrineMigrations\\Version20240120185305', '2024-01-20 18:53:19', 47),
	('DoctrineMigrations\\Version20240120190921', '2024-01-20 19:09:28', 18);

-- Listage de la structure de table pokesymfo. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table pokesymfo.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table pokesymfo. pokemon
CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attaque` int NOT NULL,
  `defense` int NOT NULL,
  `point_de_vie` int NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table pokesymfo.pokemon : ~2 rows (environ)
INSERT INTO `pokemon` (`id`, `nom`, `description`, `attaque`, `defense`, `point_de_vie`, `picture`) VALUES
	(23, 'Mewtow', 'pokémon de type psychic', 20, 20, 20, 'mewtow-65ad5e9f2941d.jpg'),
	(24, 'Salamèche', 'pokémon de type feu', 20, 40, 20, 'salameche-65ad5ee551905.jpg'),
	(25, 'Herbizarre', 'pokémon de type plante', 15, 45, 65, 'herbizarre-65a7b7ddde585-65c603d75301b.jpg'),
	(26, 'Florizarre', 'pokémon de type plante', 87, 45, 65, 'florizarre-65a7b7fd9b2f0-65c603f5e016d.jpg'),
	(27, 'Reptincel', 'pokémon de type feu', 87, 65, 54, 'reptincel-65a7b8fa0f482-65c60421daa60.jpg'),
	(28, 'Mew', 'pokémon de type psy', 75, 65, 45, 'mew-65a7bae7d71ce-65c6043d4d3bc.jpg'),
	(29, 'Pikachu', 'pokémon de type électrique', 32, 45, 21, 'pikachu-65a7ba3ccf17f-65c60468a5550.jpg'),
	(30, 'Raichu', 'pokémon de type électrique', 54, 65, 78, 'Raichu-65a7ba516b64f-65c604860e819.jpg');

-- Listage de la structure de table pokesymfo. pokemon_type
CREATE TABLE IF NOT EXISTS `pokemon_type` (
  `pokemon_id` int NOT NULL,
  `type_id` int NOT NULL,
  PRIMARY KEY (`pokemon_id`,`type_id`),
  KEY `IDX_B077296A2FE71C3E` (`pokemon_id`),
  KEY `IDX_B077296AC54C8C93` (`type_id`),
  CONSTRAINT `FK_B077296A2FE71C3E` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B077296AC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table pokesymfo.pokemon_type : ~2 rows (environ)
INSERT INTO `pokemon_type` (`pokemon_id`, `type_id`) VALUES
	(23, 35),
	(24, 32),
	(25, 31),
	(26, 31),
	(27, 32),
	(28, 35),
	(29, 34),
	(30, 34);

-- Listage de la structure de table pokesymfo. type
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table pokesymfo.type : ~10 rows (environ)
INSERT INTO `type` (`id`, `libelle`, `color`) VALUES
	(31, 'plante', 'green'),
	(32, 'feu', 'red'),
	(33, 'eau', 'blue'),
	(34, 'electrique', 'yellow'),
	(35, 'psy', 'pink'),
	(36, 'poison', 'purple'),
	(37, 'sol', 'grey'),
	(38, 'normal', 'white'),
	(39, 'insecte', 'brown'),
	(40, 'spectre', 'black');

-- Listage de la structure de table pokesymfo. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table pokesymfo.user : ~0 rows (environ)
INSERT INTO `user` (`id`, `email`, `password`, `roles`, `firstname`, `lastname`, `is_verified`) VALUES
	(9, 'user@user.fr', '$2y$13$0GmcLxuSDEtObZc0/lxhZ.YSvDkWant7kLpzaBWBdUa6OBQ6rrP92', '[]', 'Florian', 'Delaunay', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

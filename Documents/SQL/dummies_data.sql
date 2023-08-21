-- --------------------------------------------------------
-- Hôte:                         web24.swisscenter.com
-- Version du serveur:           8.0.33-cll-lve - MySQL Community Server - GPL
-- SE du serveur:                Linux
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table forum_gmo_tpi.categories : ~6 rows (environ)
INSERT INTO `categories` (`id`, `name`, `icone`) VALUES
	(1, 'Nature', 'https://is4-ssl.mzstatic.com/image/thumb/Purple49/v4/a2/3c/54/a23c544d-a53c-5094-338a-0ee73f5a0430/source/256x256bb.jpg'),
	(2, 'Sport', 'https://s3.eu-west-3.amazonaws.com/sport-finder.image/images/cache/squared_thumbnail/sport/football.jpeg'),
	(3, 'Actualité', 'https://pbs.twimg.com/profile_images/558585770517073921/Lsow0Mkz_400x400.jpeg'),
	(4, 'Films', 'https://htpratique.com/wp-content/uploads/2021/12/Popcorn-Time-applications-pour-regarder-des-films-gratuitement.png'),
	(5, 'Jeux vidéo', 'https://aidal.fr/wp-content/uploads/2021/02/gamepad.png'),
	(6, 'Voyages', 'https://cdn-icons-png.flaticon.com/128/5086/5086785.png');

-- Listage des données de la table forum_gmo_tpi.posts : ~0 rows (environ)
INSERT INTO `posts` (`id`, `description`, `creationdate`, `media`, `blocked`, `Subject_id`, `replyingto`) VALUES
	(1, 'Coucou, oui c\'est tout à fait normal bien qu\'embêtant...', '2023-06-02', './uploads/posts_media/img/02-06-23-12-00-51.jpg', 0, 1, 'Marylène');

-- Listage des données de la table forum_gmo_tpi.subjects : ~0 rows (environ)
INSERT INTO `subjects` (`id`, `description`, `creationdate`, `media`, `title`, `blocked`, `archived`, `Category_id`, `User_id`, `update`) VALUES
	(1, 'Est-ce que cela est normal ??\r\nDevrai-je m\'inquiéter pour mon chat ?', '2023-06-02', './uploads/subjects_media/img/02-06-23-11-56-30.jpg', 'Chat perds ses poils', 0, 0, 1, 2, '2023-06-02 10:00:51'),
	(2, 'Mon chien aussi à commencé à perdre ses poils et il a froid, que faire ?', '2023-06-02', './uploads/subjects_media/img/02-06-23-11-57-25.jpg', 'Chien perds ses poils', 0, 0, 1, 2, '2023-06-02 09:57:25'),
	(3, 'J\'ai de grosses courbatures après le sport, est-ce normal ?', '2023-06-02', './uploads/subjects_media/videos/02-06-23-11-58-17.mp4', 'Douleur aux muscles', 0, 0, 2, 2, '2023-06-02 09:58:17');

-- Listage des données de la table forum_gmo_tpi.users : ~5 rows (environ)
INSERT INTO `users` (`id`, `email`, `username`, `picture`, `password`, `confirmed`, `administrator`, `token`, `blocked`, `creationdate`) VALUES
	(1, 'administrateur@tpi.test', 'Administrateur', './uploads/profile_pictures/02-06-23-11-47-44.png', '$2y$10$Ln7IM0sNouyvkyVEQ..4o.s9TuSdrCNyIoHOrzzue.oH7j3V8oJTm', 1, 1, 'ffa4b1e607685a10759f', 0, '2023-06-02'),
	(2, 'marylene@tpi.test', 'Marylène', './uploads/profile_pictures/02-06-23-11-52-33.png', '$2y$10$QVq5Vxqi66GBvKEnyQvgGet7EZ4WyuXdRzEOckm0FKgr6fNFK7qum', 1, 0, 'bfb3c72ea1b04c3600c3', 0, '2023-06-02'),
	(3, 'dihna@tpi.test', 'Dihna', './uploads/profile_pictures/02-06-23-11-53-21.jpg', '$2y$10$wsfNIyf7yHMMbrn5QMQlyuCe8iTFrnnfpo736nStx55sM1mUkwQzC', 1, 0, 'd188ae58255f6b9ab486', 1, '2023-06-02'),
	(4, 'stephanie@tpi.test', 'Stéphanie', './uploads/profile_pictures/02-06-23-11-54-04.jpg', '$2y$10$SIeskns0Btws7jSn8qYkleNsFq3URefh6G9vR2I4M7MZZhPasoKp2', 0, 0, '213101f8d5e1ebef4c8a', 0, '2023-06-02'),
	(5, 'sylvyia@tpi.test', 'Sylvia', './uploads/profile_pictures/02-06-23-12-00-03.png', '$2y$10$9e7StIeeYnVmrwjn3Y2rE.OZXXEWUSznueGHRPREw5rd.5Z5WchGi', 1, 0, 'd547783361753cea1007', 0, '2023-06-02');

-- Listage des données de la table forum_gmo_tpi.users_reply_posts : ~0 rows (environ)
INSERT INTO `users_reply_posts` (`id`, `User_id`, `Post_id`) VALUES
	(1, 5, 1);

-- Listage des données de la table forum_gmo_tpi.users_subscribe_subjects : ~3 rows (environ)
INSERT INTO `users_subscribe_subjects` (`id`, `User_id`, `Subject_id`) VALUES
	(1, 5, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

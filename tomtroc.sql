-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 juin 2024 à 14:09
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `availability` enum('Disponible','Non dispo.') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Disponible',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `user_id`, `title`, `author`, `image`, `description`, `availability`) VALUES
(1, 6, 'Le Silmarillion', 'J.R.R. Tolkien', 'uploads/book_covers/le_silmarillion.jpg', '\"Le Silmarillion\" de J.R.R. Tolkien est une œuvre monumentale qui s\'inscrit comme un préquel essentiel à \"Le Seigneur des Anneaux\". Ce livre est un recueil de mythes et de légendes de la Terre du Milieu, offrant une profondeur historique et une richesse culturelle sans pareilles. Il se divise en plusieurs sections, chaque partie racontant des événements distincts mais interconnectés, de la création du monde à la fin du Premier Âge. L\'écriture est dense et poétique, rappelant les épopées anciennes. Les personnages, bien que nombreux, sont soigneusement développés, chacun avec son propre arc narratif et ses motivations. Toutefois, la complexité et la structure fragmentée peuvent rebuter certains lecteurs, surtout ceux habitués à des récits plus linéaires. Pour les passionnés de fantasy et de l\'univers de Tolkien, \"Le Silmarillion\" est une lecture incontournable qui enrichit considérablement la compréhension de ses autres œuvres. Cependant, il demande une attention particulière et une certaine patience pour pleinement apprécier ses subtilités. ', 'Disponible'),
(2, 6, 'Le Trône de Fer : ', 'George R.R. Martin', 'img\\books\\le_trone_de_fer_1.jpg', '\"Le Trône de Fer\", premier tome de la série éponyme de George R.R. Martin, plonge le lecteur dans un univers médiéval-fantastique complexe et impitoyable. L\'intrigue tourne autour de la lutte pour le pouvoir entre plusieurs grandes maisons nobles, chacune avec ses propres ambitions, secrets et alliances. Martin excelle dans la création de personnages multifacettes, dont les motivations et les actions sont souvent imprévisibles. L\'écriture est immersive, décrivant avec précision les paysages, les coutumes et les batailles. Le livre se distingue par sa capacité à mélanger politique, intrigue et éléments surnaturels, tout en maintenant un rythme soutenu. Cependant, la densité de l\'histoire et le grand nombre de personnages peuvent être déroutants pour certains lecteurs, surtout ceux qui ne sont pas familiers avec ce type de récit. Malgré cela, \"Le Trône de Fer\" est un chef-d\'œuvre de la fantasy moderne, posant les bases d\'une saga épique qui captivera les lecteurs jusqu\'à la dernière page.\r\n', 'Disponible'),
(3, 6, 'Le Trône de Fer : \"Le Donjon Rouge\"', 'George R.R. Martin', 'img\\books\\le_trone_de_fer_2.jpg', '\"Le Donjon Rouge\", deuxième tome de la série \"Le Trône de Fer\", continue de développer les intrigues et les rivalités entre les différentes maisons de Westeros. George R.R. Martin approfondit les arcs narratifs de ses personnages principaux, tout en introduisant de nouvelles figures et en élargissant l\'univers. Ce tome se distingue par son intensité dramatique, avec des retournements de situation et des trahisons qui tiennent le lecteur en haleine. L\'accent est mis sur les machinations politiques et les luttes de pouvoir, renforçant l\'atmosphère de tension et d\'incertitude. La richesse des détails et la complexité des relations entre les personnages sont impressionnantes, mais peuvent aussi rendre la lecture exigeante. Le style de Martin, toujours aussi descriptif et évocateur, parvient à immerger le lecteur dans ce monde impitoyable. \"Le Donjon Rouge\" est une suite captivante qui consolide les fondations posées par le premier tome, promettant des développements encore plus spectaculaires à venir.', 'Disponible'),
(4, 6, 'Le Trône de Fer : \"La Bataille des Rois\"', 'George R.R. Martin', 'img\\books\\le_trone_de_fer_3.jpg', '\"La Bataille des Rois\", troisième tome de la série \"Le Trône de Fer\", intensifie les conflits et les intrigues qui déchirent Westeros. George R.R. Martin continue d\'explorer les ambitions et les motivations de ses personnages, tout en introduisant des développements surprenants qui maintiennent un suspense constant. Ce tome est marqué par des batailles épiques et des événements décisifs qui modifient radicalement la dynamique des pouvoirs en place. L\'écriture reste fidèle au style détaillé et immersif de Martin, offrant des descriptions vivantes et des dialogues percutants. La complexité de l\'intrigue et la multitude de personnages peuvent sembler écrasantes, mais elles ajoutent une profondeur et une richesse qui récompensent le lecteur attentif. \"La Bataille des Rois\" est un chapitre crucial de la saga, renforçant la réputation de Martin comme maître de la fantasy épique et laissant présager des développements encore plus intrigants dans les tomes suivants.', 'Disponible'),
(5, 6, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', 'img\\books\\le_seigneur_des_anneaux.jpg', '\"Le Seigneur des Anneaux\" de J.R.R. Tolkien est sans doute l\'une des œuvres les plus influentes et emblématiques de la littérature fantastique. Cette trilogie, composée de \"La Communauté de l\'Anneau\", \"Les Deux Tours\" et \"Le Retour du Roi\", raconte l\'épopée de Frodon Sacquet et de la Fraternité de l\'Anneau dans leur quête pour détruire l\'Anneau Unique. Le monde de la Terre du Milieu, avec ses différentes races, cultures et langues, est décrit avec une minutie et une profondeur sans égales. Les thèmes de l\'amitié, du courage, de la corruption et de la rédemption sont explorés avec une grande sensibilité. L\'écriture de Tolkien, riche et lyrique, peut parfois sembler archaïque, mais elle contribue à l\'atmosphère mythique du récit. Les personnages, bien que stéréotypés dans leur représentation du bien et du mal, sont attachants et bien développés. \"Le Seigneur des Anneaux\" est un monument de la fantasy, offrant une aventure épique et intemporelle qui continue de captiver des générations de lecteurs.', 'Disponible'),
(6, 6, 'Harry Potter et l\'Ordre du Phénix', 'J.K. Rowling', 'img\\books\\harry_potter_5.jpg', '\"Harry Potter et l\'Ordre du Phénix\", cinquième tome de la saga de J.K. Rowling, marque un tournant sombre et mature dans l\'histoire. Harry, désormais adolescent, doit faire face à la montée en puissance de Voldemort, à l\'injustice du Ministère de la Magie et aux défis émotionnels de son âge. Ce tome se distingue par son exploration des thèmes de la résistance et de la rébellion, incarnés par la création de l\'Ordre du Phénix et de l\'Armée de Dumbledore. L\'introduction de Dolores Ombrage, avec son régime tyrannique à Poudlard, ajoute une nouvelle dimension de conflit. Le développement des personnages est plus profond, révélant leurs vulnérabilités et leurs forces. Cependant, le ton plus sombre et l\'augmentation de la longueur du livre peuvent rendre la lecture plus exigeante. Malgré cela, \"Harry Potter et l\'Ordre du Phénix\" est un chapitre crucial et captivant de la saga, offrant des moments de tension intense et des révélations importantes.', 'Disponible'),
(7, 6, 'Harry Potter et le Prince de Sang-Mêlé', 'J.K. Rowling', 'img\\books\\harry_potter_6.jpg', '\"Harry Potter et le Prince de Sang-Mêlé\", sixième tome de la série de J.K. Rowling, approfondit les mystères entourant Voldemort et prépare le terrain pour la conclusion épique de la saga. Le livre se concentre sur les origines du Seigneur des Ténèbres, avec Harry et Dumbledore explorant des souvenirs clés pour comprendre et déjouer ses plans. Ce tome est marqué par un mélange de moments légers, grâce aux intrigues amoureuses et à l\'humour typiquement présent à Poudlard, et de moments sombres, avec la révélation des Horcruxes et la mort tragique de Dumbledore. La narration est plus mature, reflétant la croissance des personnages principaux. Les relations et les dynamiques entre les personnages sont approfondies, offrant des développements émotionnels significatifs. \"Harry Potter et le Prince de Sang-Mêlé\" est un livre essentiel qui tisse habilement les fils de l\'intrigue et prépare le lecteur à l\'apogée de la série dans le tome suivant.', 'Disponible'),
(8, 6, 'Harry Potter et les Reliques de la Mort', 'J.K. Rowling', 'img\\books\\harry_potter_7.jpg', '\"Harry Potter et les Reliques de la Mort\", septième et dernier tome de la saga de J.K. Rowling, offre une conclusion épique et satisfaisante à l\'histoire. Loin de la sécurité de Poudlard, Harry, Hermione et Ron sont en fuite, cherchant à détruire les Horcruxes de Voldemort. Le livre est rempli de moments de tension, de batailles épiques et de sacrifices héroïques. La quête des Reliques de la Mort ajoute une nouvelle dimension mythique à l\'histoire, enrichissant l\'intrigue. Rowling excelle à lier tous les éléments de la série, apportant des réponses aux questions laissées en suspens et concluant les arcs narratifs de manière cohérente et émotive. La maturité des personnages et la gravité des événements sont palpables, rendant ce dernier tome particulièrement poignant. \"Harry Potter et les Reliques de la Mort\" est une conclusion magistrale qui récompense les lecteurs de longue date avec une fin à la fois déchirante et triomphante, confirmant le statut de la saga comme un classique moderne de la littérature jeunesse.', 'Disponible'),
(10, 6, 'Le Trône de Fer :', 'George R.R. Martin ', 'img\\books\\le_trone_de_fer_4.jpg', 'Le quatrième tome de la saga épique de George R.R. Martin, \"Le Trône de Fer\", continue à tisser les intrigues complexes et les destins entremêlés de Westeros. Après la mort de plusieurs rois, les Sept Royaumes sont plus que jamais plongés dans le chaos. À Port-Réal, Cersei Lannister tente de consolider son pouvoir en tant que régente de son jeune fils, le roi Tommen, tout en faisant face à des complots internes et à la menace croissante des Tyrell. Pendant ce temps, Jon Snow, maintenant Lord Commandant de la Garde de Nuit, doit naviguer dans des alliances délicates avec les Sauvageons et préparer la défense contre les forces surnaturelles de l\'Au-delà. Sur les terres de Dorne, la vengeance et la justice se heurtent avec la montée des Aspics des Sables, les filles de feu Oberyn Martell. Dans ce tome, Martin approfondit les motivations et les luttes internes de ses personnages, offrant un tableau riche et sombre des luttes pour le pouvoir.', 'Non dispo.'),
(11, 10, 'The Witcher : ', 'Andrzej Sapkowski', 'img\\books\\the_witcher_1.jpg', '\"Le Dernier Vœu\" est le premier tome de la saga \"The Witcher\", introduisant Geralt de Riv, un sorceleur, un chasseur de monstres mutant doté de pouvoirs surnaturels. Ce recueil de nouvelles explore les aventures de Geralt, ses combats contre des créatures mythiques, et les dilemmes moraux auxquels il est confronté. Dans un monde où les frontières entre le bien et le mal sont floues, Geralt rencontre des personnages tels que Yennefer, une puissante magicienne, et Jaskier, un barde excentrique. Chaque histoire révèle davantage sur la nature complexe de Geralt, ses luttes internes et sa quête de son propre code d\'honneur dans un monde souvent cruel et injuste. \"Le Dernier Vœu\" pose les bases de l\'univers riche et fascinant de The Witcher, mélangeant habilement fantasy, action et réflexion philosophique.', 'Disponible'),
(12, 10, 'The Witcher : \"L\'Épée de la Providence\"', 'Andrzej Sapkowski', 'img\\books\\the_witcher_2.jpg', '\"L\'Épée de la Providence\" continue les aventures de Geralt de Riv dans un recueil de nouvelles où le chasseur de monstres explore encore plus profondément les mystères et les dangers du monde qui l\'entoure. Geralt est confronté à des créatures redoutables, des sorcières et des forces surnaturelles tout en naviguant dans des conflits humains souvent aussi dangereux. Le thème de la destinée joue un rôle central, notamment avec l\'introduction de Ciri, une jeune fille qui est liée à Geralt par une prophétie ancienne. Chaque nouvelle dans ce tome explore la complexité des choix moraux et éthiques de Geralt, tout en développant les relations entre les personnages principaux. \"L\'Épée de la Providence\" est un mélange captivant de folklore, de mythologie et de fantasy moderne.', 'Disponible'),
(13, 10, 'The Witcher : \"Le Sang des Elfes\"', 'Andrzej Sapkowski', 'img\\books\\the_witcher_3.jpg', '\"Le Sang des Elfes\" marque le début des romans de la saga \"The Witcher\", se concentrant sur l\'histoire de Ciri, la jeune héritière du trône de Cintra, et son lien avec Geralt de Riv. Après avoir été secourue par Geralt, Ciri commence sa formation à Kaer Morhen, la forteresse des sorceleurs, où elle apprend à se battre et à maîtriser ses capacités naissantes. Le monde est en proie à des guerres et des tensions politiques, et Ciri devient une cible pour diverses factions cherchant à exploiter ses pouvoirs et son héritage royal. Geralt, avec l\'aide de la magicienne Yennefer, doit protéger Ciri et l\'aider à comprendre son rôle dans un monde en mutation. \"Le Sang des Elfes\" développe les thèmes de la destinée, de la famille et de la survie, tout en offrant une aventure épique remplie de magie et de mystère.', 'Disponible'),
(14, 10, 'The Witcher : \"Le Temps du Mépris\"', 'Andrzej Sapkowski', 'img\\books\\the_witcher_4.jpg', '\"Le Temps du Mépris\" poursuit la saga de \"The Witcher\" avec un récit intense de complots politiques, de guerres et de luttes personnelles. Ciri continue son apprentissage sous la tutelle de Yennefer, tandis que Geralt se retrouve plongé dans des intrigues dangereuses entre les royaumes et les mages. Les tensions entre les royaumes humains et les forces elfiques et non humaines atteignent leur paroxysme, entraînant des batailles et des alliances inattendues. Ciri, maintenant consciente de son héritage et de ses pouvoirs, doit naviguer dans un monde où elle est à la fois chasseuse et chassée. Le récit explore les thèmes de la trahison, de la loyauté et de la survie dans un monde où la ligne entre le bien et le mal est toujours floue. \"Le Temps du Mépris\" est une continuation épique qui approfondit les relations entre les personnages et l\'univers complexe créé par Sapkowski.', 'Disponible'),
(16, 10, 'Le Trône de Fer : \"Une Danse avec les Dragons\"', 'George R.R. Martin', 'img\\books\\le_trone_de_fer_5.jpg', '\"Une Danse avec les Dragons\" est le cinquième tome de la série \"Le Trône de Fer\", où les conflits politiques et personnels atteignent des sommets dramatiques. Le Nord est en ruines après la trahison des Bolton et la chute de Winterfell. Jon Snow, à la tête de la Garde de Nuit, tente de gérer les tensions entre ses hommes et les Sauvageons tout en se préparant à une menace encore plus grande : les Marcheurs Blancs. À Meereen, Daenerys Targaryen lutte pour maintenir l\'ordre et la paix, mais ses dragons deviennent de plus en plus difficiles à contrôler. Tyrion Lannister, après avoir fui Westeros, se retrouve dans une quête désespérée pour trouver sa place et éventuellement se joindre à la cause de Daenerys. Pendant ce temps, des complots se forment dans l\'ombre, de nouveaux prétendants au trône émergent, et les alliances sont forgées et brisées dans une danse mortelle pour le pouvoir. George R.R. Martin offre un récit dense et captivant, rempli de surprises et de retournements de situation.', 'Non dispo.'),
(26, 6, 'Twilight : Tentation', 'Stephenie Meyer', 'img\\books\\twilight_2.jpg', 'Livre à supprimer', 'Disponible');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `recipient_id` int NOT NULL,
  `content` text NOT NULL,
  `sent_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `recipient_id` (`recipient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `recipient_id`, `content`, `sent_date`) VALUES
(118, 6, 10, 'Salut ! ', '2024-06-25 08:51:29'),
(120, 6, 6, 'Test', '2024-06-26 08:00:49'),
(122, 25, 6, 'Salut ! ', '2024-06-27 12:35:34'),
(123, 6, 25, 'Hey !', '2024-06-27 12:36:01'),
(124, 6, 25, 'Dernier envoyé', '2024-06-27 12:41:04'),
(113, 6, 10, 'test', '2024-06-25 07:58:20'),
(112, 6, 6, 'Test', '2024-06-25 07:52:14');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `profile_image`, `registration_date`) VALUES
(10, 'User', 'user@user.com', '$2y$10$Le35UQSIqhcNfT6cvzMYJegqKaAfjHaJG.OEP0NmvS8k58qodbySi', 'Dark-side-of-the-Rabit.jpg', '2024-06-10 08:06:22'),
(11, 'Test', 'test@test.com', '$2y$10$3FM8FDTuPtql5jo1wlWXieSBpFQevCSbcUMzmnbiDkpnZQvzhL/Du', NULL, '2024-06-12 09:56:23'),
(6, 'Admin', 'admin@admin.com', '$2y$10$wiqAzhMX92jiVBbRAQVCfO6tSyuClbWCp7K0c4rrdJQq.3yNOyQh6', 'HK.jpg', '2024-06-04 14:09:52'),
(25, 'Demo1', 'demo@demo.com', '$2y$10$06eXuCrmAZ/1LJpglxj.sO/DOtMlP7cH6gIPslsjpvREXEKuJ78iS', 'wp5469350-hollow-knight-phone-hd-wallpapers.jpg', '2024-06-27 12:34:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

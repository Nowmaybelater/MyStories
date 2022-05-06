-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 02:58 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystories`
--

-- --------------------------------------------------------

--
-- Table structure for table `advancement`
--

CREATE TABLE `advancement` (
  `id_usr` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `jour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id_chapter` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `chapterContent` longtext NOT NULL,
  `choice1` mediumtext DEFAULT NULL,
  `choice2` mediumtext DEFAULT NULL,
  `choice3` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id_chapter`, `id_story`, `numChapter`, `chapterContent`, `choice1`, `choice2`, `choice3`) VALUES
(1, 1, 1, 'Aujourd’hui, comme tous les lundis, dès la sortie de la classe, je cours vers le parc avec mes copains pour y retrouver monsieur Charles. Monsieur Charles est un vieil homme qui aime passer du temps au parc, pour lire le journal, et qui aime inventer des histoires rien que pour nous. J’essaye d’arriver le premier pour pouvoir choisir l’histoire qu’il va nous conter. Moi, je choisis toujours des histoires de détectives... Vite je dois me dépêcher...', 'Page suivante', NULL, NULL),
(2, 1, 2, 'Nous voilà arrivés au parc. On repère toujours monsieur Charles de loin grâce à son grand panier rouge. Mais ce soir, le banc vert sur lequel monsieur Charles s’assoit est vide. Surpris qu’il soit absent, nous partons à sa recherche dans le parc...', 'Nous partons vers le grand arbre ', 'Nous partons vers le petit ruisseau ', 'Nous partons vers l’entrée du parc '),
(3, 1, 3, 'Parfois, il nous arrive de nous installer près du grand arbre avec monsieur Charles pour écouter ses histoires. Il aurait pu s’y trouver, mais nous avons beau chercher, nous ne le trouvons toujours pas. Nous décidons de retourner vers le banc vert, dans l’espoir que monsieur Charles ait juste été en retard, et qu’il soit arrivé pendant que nous le cherchions près de l’arbre.', 'Page suivante', NULL, NULL),
(4, 1, 4, 'Il n’y a personne du côté du petit ruisseau. Nous décidons de retourner vers le banc vert. Pour aller plus vite nous décidons de revenir par le petit talus. Peut-être finirons nous par croiser Monsieur Charles. ', 'Page suivante', NULL, NULL),
(5, 1, 5, 'Nous nous asseyons sur le banc et attendons un peu. Nous en profitons pour manger note goûter, mais même après ça, personne ne vient. Pour la première fois, nous n’aurons pas d’histoire ce soir....', 'Nous décidons de rentrer à la maison.', 'Nous décidons de chercher encore un peu dans le parc. ', NULL),
(6, 1, 6, 'Arrivés à l’entrée du parc, nous voyons un petit monsieur avec un manteau gris. C’est lui !!! Nous l’appelons « Monsieur Charles !!! » Mais il ne se retourne pas. Alors que nous arrivons à sa hauteur, nous nous apercevons que ce n’est pas lui... nous décidons de retourner vers le banc vert.', 'Page suivante', NULL, NULL),
(7, 1, 7, 'Nous nous dirigeons vers la sortie du parc. Tout à coup Fabien crie : « Regardez, regardez, c’est le panier de monsieur Charles ! ». Il pointait du doigt une dame qui portait le panier rouge de notre ami. Mais que faisait-elle avec ce panier ? Tout ceci est bien mystérieux.', 'On suit la dame. ', 'On va jouer à la maison. ', NULL),
(8, 1, 8, 'Nous rentrons tous à la maison. Nous reviendrons lundi prochain pour voir s’il sera là...', 'Page suivante', NULL, NULL),
(9, 1, 9, 'Nous suivons la dame. Lucie a un peu peur, mais je l’encourage : nous devons savoir ce qui est arrivé à monsieur Charles. Nous courons jusqu’à la grille.', 'Aller au chapitre 10', 'Aller au chapitre 11', NULL),
(10, 1, 10, 'Nous voyons la dame entrer dans un immeuble. Nous la suivons encore... Mais pour entrer dans l’immeuble, il nous faut trouver le code de la porte d’entrée !!! Je me rappelle avoir vu le code à quatre chiffres sur les clefs de monsieur Charles : je suis certain que c’est 1556 ! Mais Fabien, lui, est persuadé qu’il s’agit de 1665. Il faut que nous essayons. ', 'Si vous pensez que le code est 1556', 'Si vous pensez que le code est 1665', NULL),
(11, 1, 11, 'J’ai cassé le lacet de ma chaussure. Je ne peux plus continuer l’enquête. Je rentre à la maison.', 'Page suivante', NULL, NULL),
(12, 1, 12, 'Nous entrons dans l’immeuble. Tout est sombre. « Chut ! » chuchote David. Nous écoutons... Mais il n’y a aucun bruit... Lucie dit alors « cherchons des indices ».', 'Nous allons voir au 1er étage. ', 'Nous allons voir au 2ème étage. ', 'Nous allons voir au 3ème étage. '),
(13, 1, 13, 'Nous essayons le code, mais la porte refuse de s’ouvrir. L’idée de Fabien n’était pas la bonne, mais peut-être que l’autre code fonctionnera. Il faut que nous essayions. ', 'Page suivante', NULL, NULL),
(14, 1, 14, 'Nous voilà au 1er étage. Attention, un gros chien vient sur nous ! Il n’a pas l’air très gentil. Vite retournons au rez-de-chaussée !!!', 'Page suivante', NULL, NULL),
(15, 1, 15, 'Nous sommes au 2ème étage. Il n’y a aucun bruit. Nous retournons au rez-de-chaussée.', 'Page suivante', NULL, NULL),
(16, 1, 16, 'Nous arrivons au 3ème étage. Il n’y a personne.', 'Page suivante', NULL, NULL),
(17, 1, 17, 'Nous nous asseyons sur les marches. Lucie voulait rentrer à la maison et David disait que monsieur Charles était peut-être arrivé au parc. Tout à coup, nous entendons du bruit dans l’escalier !!!', 'On se cache derrière un poteau.', 'On va voir qui c’est. ', ''),
(18, 1, 18, 'C’est un monsieur qui nous dit : « Vous n’avez rien à faire là. Rentrez chez vous !!! ».', 'Page suivante', NULL, NULL),
(19, 1, 19, 'Cachés derrière un poteau, nous pouvons apercevoir la dame bizarre sur un palier. Avant de sortir, nous l’entendons dire : « Ne bougez pas monsieur Charles !!! Je reviens tout de suite ». La dame sort de l’immeuble.', 'Nous allons chercher un policier pour qu’il arrête la dame. ', 'Nous allons vite voir d’où venait la voix de Monsieur Charles. ', NULL),
(20, 1, 20, 'Nous montons les escaliers à toute vitesse.', 'Page suivante', NULL, NULL),
(21, 1, 21, 'Nous trouvons un policier dans la rue qui nous dit : « Voyons les enfants, restons sérieux... Je ne mets pas les gens en prison comme ça... ». Nous retournons dans les escaliers.', 'Page suivante', NULL, NULL),
(22, 1, 22, 'Nous appelons « Monsieur Charles, monsieur Charles !!! ». Monsieur Charles nous attend tranquillement sur le palier. Il nous dit bonjour et nous demande ce que nous faisons ici. Nous lui racontons alors notre histoire de détectives. Mais voilà que monsieur Charles se met à rire :\n« Mais Rose est mon aide-ménagère ! quand je suis malade, je prête mon panier pour qu’elle aille faire mes courses. »\nNous avons tous bien rigolé et nous avons eu droit à une très belle histoire comme tous les lundis soir.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id_usr` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `choice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id_story` int(11) DEFAULT NULL,
  `Chapter` int(11) DEFAULT NULL,
  `Previous_Chapter` int(11) DEFAULT NULL,
  `Previous_Choice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id_story`, `Chapter`, `Previous_Chapter`, `Previous_Choice`) VALUES
(1, 2, 1, 1),
(1, 3, 2, 1),
(1, 4, 2, 2),
(1, 6, 2, 3),
(1, 5, 3, 1),
(1, 5, 4, 1),
(1, 7, 5, 1),
(1, 2, 5, 2),
(1, 5, 6, 1),
(1, 9, 7, 1),
(1, 8, 7, 2),
(1, 1, 8, 1),
(1, 10, 9, 1),
(1, 11, 9, 2),
(1, 12, 10, 1),
(1, 13, 10, 2),
(1, 1, 11, 1),
(1, 14, 12, 1),
(1, 15, 12, 2),
(1, 16, 12, 3),
(1, 12, 13, 1),
(1, 12, 14, 1),
(1, 12, 15, 1),
(1, 17, 16, 1),
(1, 19, 17, 1),
(1, 18, 19, 2),
(1, 19, 18, 1),
(1, 21, 19, 1),
(1, 20, 19, 2),
(1, 22, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `player_points`
--

CREATE TABLE `player_points` (
  `id_user` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `death` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id_story` int(11) DEFAULT NULL,
  `chapter` int(11) DEFAULT NULL,
  `numChoice` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `death` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id_story`, `chapter`, `numChoice`, `points`, `death`) VALUES
(1, 2, 2, 1, 0),
(1, 8, 1, 0, 1),
(1, 9, 2, 1, 0),
(1, 10, 2, 1, 0),
(1, 11, 1, 0, 1),
(1, 17, 2, 1, 0),
(1, 18, 1, 0, 1),
(1, 19, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `id_story` int(11) DEFAULT NULL,
  `played` int(11) DEFAULT NULL,
  `death` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id_story` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `nbChapters` int(11) DEFAULT NULL,
  `finished` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hide` tinyint(1) NOT NULL,
  `summary` mediumtext NOT NULL,
  `nbrPoints` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id_story`, `title`, `author`, `nbChapters`, `finished`, `date`, `hide`, `summary`, `nbrPoints`) VALUES
(1, 'Les détectives', 'correcteur_admin', 22, 0, '2022-05-03', 0, 'Comme tous les lundis après les cours, vous et vos amis courrez en direction du parc pour y retrouver Monsieur Charles, un vieil homme qui n’est jamais à court d’histoires. Comme tous les lundis, vous pourrez prendre votre goûter en écoutant les aventures décrites par ce conteur hors-pair. Mais aujourd’hui, on a beau être lundi, Monsieur Charles n’est pas là. A vous d’élucider le mystère entourant la disparition du vieil homme…', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_usr` int(11) NOT NULL,
  `login_usr` varchar(30) DEFAULT NULL,
  `password_usr` varchar(30) DEFAULT NULL,
  `acces` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_usr`, `login_usr`, `password_usr`, `acces`) VALUES
(1, 'correcteur', 'mdp_correcteur_1234', 'classique'),
(2, 'correcteur_admin', 'mdp_correcteur_1234', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advancement`
--
ALTER TABLE `advancement`
  ADD KEY `id_story` (`id_story`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `id_story` (`id_story`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id_story`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id_chapter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id_story` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advancement`
--
ALTER TABLE `advancement`
  ADD CONSTRAINT `advancement_ibfk_2` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`);

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

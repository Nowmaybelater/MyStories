-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 mai 2022 à 08:45
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `mystories`
--

-- --------------------------------------------------------

--
-- Structure de la table `advancement`
--

CREATE TABLE `advancement` (
  `id_advancement` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `jour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
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
-- Déchargement des données de la table `chapters`
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
(22, 1, 22, 'Nous appelons « Monsieur Charles, monsieur Charles !!! ». Monsieur Charles nous attend tranquillement sur le palier. Il nous dit bonjour et nous demande ce que nous faisons ici. Nous lui racontons alors notre histoire de détectives. Mais voilà que monsieur Charles se met à rire :\r\n« Mais Rose est mon aide-ménagère ! quand je suis malade, je prête mon panier pour qu’elle aille faire mes courses. »\r\nNous avons tous bien rigolé et nous avons eu droit à une très belle histoire comme tous les lundis soir.', 'FIN', NULL, NULL),
(26, 4, 1, 'Vous êtes le Capitaine Nightshade, à la tête de l’équipage de pirates le plus craint de l’histoire. A bord du Half-Moon, un navire plus imposant encore que ceux de la flotte royale, vous sillonnez les mers à la recherche des trésors les plus précieux. Vous êtes réputé pour être cruel et sans pitié. Alors pourquoi diable la personne avec qui vous aviez rendez-vous n’est-elle toujours pas là ? Cela fait près de deux heures que vous attendez sur cette île perdue, et toujours aucun navire à l’horizon. Pour la énième fois, vous relisez la mystérieuse lettre qui s’est matérialisée la veille sur le pont de votre navire. \r\n« Si vous voulez devenir le pirate le plus riche de l’histoire, rendez-vous demain sur la plage de l’île Maudite, à l’Est, à l’heure où le soleil sera à son zénith. Venez seul.\r\nE.F»\r\nPour quelle raison quelqu’un détenant les informations sur la localisation d’un immense trésor désirerait-il le partager avec vous, la personne la plus cupide que le monde n’ait jamais porté ? Décidemment, cette histoire semble louche, sans compter qu’il vous a fallu redoubler d’efforts pour convaincre votre équipage de rester à bord du Half-Moon. Pourtant, c’est justement cette cupidité qui vous pousse à attendre quelques minutes de plus.\r\n', 'Page suivante', NULL, NULL),
(27, 4, 2, 'Alors que vous alliez perdre patience, d’énormes nuages noirs s’accumulent dans le ciel avec un grondement sinistre. Un craquement menaçant résonne dans votre dos. Vous faites immédiatement volte-face, apercevant une silhouette se matérialiser à l’orée de la jungle. ', 'Vous lancez impulsivement votre dague en direction de l’intrus ', 'Sur vos gardes, vous gardez votre calme jusqu’à ce l’intrus révèle son visage ', NULL),
(28, 4, 3, 'Sans que vous ne l’ayez vu venir, votre dague revient vers vous avec encore plus de force que celle que vous lui aviez donnée. Le métal érafle votre bras, déchirant le tissu de votre vêtement, puis l’arme s’enfonce jusqu’à la lame dans le tronc d’un arbre à plusieurs mètres de là. \r\n–Votre impulsivité vous tuera, capitaine Nightshade. \r\nVous pansez grossièrement la blessure avec un pan de votre chemise déchirée. En ripostant de la sorte, votre adversaire vient d’établir un rapport de force que vous brûlez déjà d’inverser. ', 'Page suivante', NULL, NULL),
(29, 4, 4, 'Devant vous se tient une jeune femme à la beauté froide et sévère, une femme dont le visage ne vous est pas inconnu. Eleena Fade est la magicienne la plus puissante du royaume. Appartenant autrefois à la cour, elle fut bannie pour trahison et personne n’entendit plus parler d’elle. Jusqu’à aujourd’hui. \r\n–J’aurai dû me douter que vous seriez derrière tout cela, Eleena. \r\n–C’était sans compter sur mes intentions de ne vous révéler mon identité qu’au dernier moment, déclare froidement la magicienne.\r\n', 'Page suivante', NULL, NULL),
(30, 4, 5, '–Trêves de bavardages. Pourquoi m’avoir fait venir ici si vous disposez de toutes les informations nécessaires à la récupération de ce trésor ? \r\n–Question légitime. Ne croyez pas que je n’ai pas déjà tenté de dérober ce trésor par mes propres moyens. Mais il semble que la personne qui a scellé ce trésor avait une dent contre mon peuple. Seul un être au sang humain peut ouvrir le coffre. Et pour venir à bout des pièges de cette île, il faut quelqu’un qui ne craigne pas la mort, quelqu’un pour qui l’or est une motivation suffisante. \r\n–Je vois. Et quels sont les arrangements auxquels vous avez pensé ? déclarez-vous d’un ton acerbe.\r\n–Les richesses qui composent ce trésor dépassent l’entendement, croyez-moi. Mais il n’y a en réalité qu’une seule pièce de ce trésor que je convoite : le joyau de la reine. Il a été dérobé il y a des siècles, et si je le rapporte à la cour…\r\n–Vos péchés seront effacés, terminez-vous à la place d’Eleena, dont les paroles vous semblent empreintes d’une tristesse sincère. Et vous promettez que tout le reste nous reviendra, à mon équipage et à moi ? \r\n–C’est une promesse, lâche la magicienne d’un ton grinçant, une main tendue dans votre direction. \r\n', 'Vous acceptez le marché que vous propose Eleena Fade ', 'Cette femme a trahi le roi, qui l’empêcherait de vous trahir également ? Vous refusez le marché.', NULL),
(31, 4, 6, 'Vous serrez la main de la jeune femme : marché conclu. \r\n–Vous aurez besoin de cela si vous voulez vous en sortir vivant, explique Eleena Fade en vous tendant un épais carnet de cuir. N’oubliez pas que cette île est maudite : si j’ai réussi à m’en sortir après avoir collecté toutes ces informations, c’est uniquement grâce à mes dons de magicienne. Dons dont vous ne disposez évidemment pas. Soyez prudent, et suivez mes instructions à la lettre. Je compte sur vous Nightshade. \r\nSur ces paroles ni vraiment rassurantes ni vraiment encourageantes, la magicienne se volatilisa. \r\n', 'FIN', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `choices`
--

CREATE TABLE `choices` (
  `id_choice` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `choice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE `links` (
  `id_link` int(11) NOT NULL,
  `id_story` int(11) DEFAULT NULL,
  `Chapter` int(11) DEFAULT NULL,
  `Previous_Chapter` int(11) DEFAULT NULL,
  `Previous_Choice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `links`
--

INSERT INTO `links` (`id_link`, `id_story`, `Chapter`, `Previous_Chapter`, `Previous_Choice`) VALUES
(2, 1, 3, 2, 1),
(3, 1, 4, 2, 2),
(4, 1, 6, 2, 3),
(5, 1, 5, 3, 1),
(6, 1, 5, 4, 1),
(7, 1, 7, 5, 1),
(8, 1, 2, 5, 2),
(9, 1, 5, 6, 1),
(10, 1, 9, 7, 1),
(11, 1, 8, 7, 2),
(12, 1, 1, 8, 1),
(13, 1, 10, 9, 1),
(14, 1, 11, 9, 2),
(15, 1, 12, 10, 1),
(16, 1, 13, 10, 2),
(17, 1, 1, 11, 1),
(18, 1, 14, 12, 1),
(19, 1, 15, 12, 2),
(20, 1, 16, 12, 3),
(21, 1, 12, 13, 1),
(22, 1, 12, 14, 1),
(23, 1, 12, 15, 1),
(24, 1, 17, 16, 1),
(25, 1, 19, 17, 1),
(26, 1, 18, 17, 2),
(27, 1, 1, 18, 1),
(28, 1, 21, 19, 1),
(29, 1, 20, 19, 2),
(30, 1, 22, 20, 1),
(31, 1, 22, 21, 1),
(32, 4, 2, 1, 1),
(33, 4, 3, 2, 1),
(34, 4, 4, 2, 2),
(35, 4, 4, 3, 1),
(36, 4, 5, 4, 1),
(37, 4, 6, 5, 1),
(38, 4, 1, 5, 2),
(54, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `player_points`
--

CREATE TABLE `player_points` (
  `id_pts_player` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `death` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE `points` (
  `id_pts` int(11) NOT NULL,
  `id_story` int(11) DEFAULT NULL,
  `chapter` int(11) DEFAULT NULL,
  `numChoice` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `death` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id_pts`, `id_story`, `chapter`, `numChoice`, `points`, `death`) VALUES
(1, 1, 2, 2, 1, 0),
(2, 1, 8, 1, 0, 1),
(3, 1, 9, 2, 1, 0),
(4, 1, 10, 2, 1, 0),
(5, 1, 11, 1, 0, 1),
(6, 1, 17, 2, 1, 0),
(7, 1, 18, 1, 0, 1),
(8, 1, 19, 1, 1, 0),
(9, 4, 2, 1, 1, 0),
(10, 4, 5, 2, 0, 1),
(11, 1, 5, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stats`
--

CREATE TABLE `stats` (
  `id_stats` int(11) NOT NULL,
  `id_story` int(11) DEFAULT NULL,
  `played` int(11) DEFAULT NULL,
  `death` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `stats`
--

INSERT INTO `stats` (`id_stats`, `id_story`, `played`, `death`, `points`) VALUES
(1, 1, 14, 3, 19),
(2, 4, 3, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stories`
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
-- Déchargement des données de la table `stories`
--

INSERT INTO `stories` (`id_story`, `title`, `author`, `nbChapters`, `finished`, `date`, `hide`, `summary`, `nbrPoints`) VALUES
(1, 'Les détectives', 'correcteur_admin', 22, 1, '2022-05-11', 0, 'Comme tous les lundis après les cours, vous et vos amis courrez en direction du parc pour y retrouver Monsieur Charles, un vieil homme qui n’est jamais à court d’histoires. Comme tous les lundis, vous pourrez prendre votre goûter en écoutant les aventures décrites par ce conteur hors-pair. Mais aujourd’hui, on a beau être lundi, Monsieur Charles n’est pas là. A vous d’élucider le mystère entourant la disparition du vieil homme…', 5),
(4, 'L’île Maudite', 'correcteur_admin2', 6, 0, '2022-05-11', 0, 'Vous êtes le capitaine de l’équipage de pirates le plus redouté de l’histoire, et vous ne refusez jamais une aventure, surtout lorsqu’à la clef de celle-ci se trouve le plus gros butin qu’on puisse imaginer. Mais parviendrez-vous à déjouer tous les pièges de l’île Maudite et à vous en sortir sain et sauf ? ', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_usr` int(11) NOT NULL,
  `login_usr` varchar(30) DEFAULT NULL,
  `password_usr` varchar(30) DEFAULT NULL,
  `acces` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_usr`, `login_usr`, `password_usr`, `acces`) VALUES
(1, 'correcteur', 'mdp_correcteur_1234', 'classique'),
(2, 'correcteur_admin', 'mdp_correcteur_1234', 'admin'),
(4, 'correcteur_admin2', 'mdp_correcteur_1234', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advancement`
--
ALTER TABLE `advancement`
  ADD PRIMARY KEY (`id_advancement`),
  ADD KEY `advancement_ibfk_1` (`id_story`),
  ADD KEY `advancement_ibfk_2` (`id_usr`);

--
-- Index pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id_choice`),
  ADD KEY `id_story` (`id_story`),
  ADD KEY `id_usr` (`id_usr`);

--
-- Index pour la table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id_link`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `player_points`
--
ALTER TABLE `player_points`
  ADD PRIMARY KEY (`id_pts_player`),
  ADD KEY `id_story` (`id_story`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id_pts`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id_stats`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id_story`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advancement`
--
ALTER TABLE `advancement`
  MODIFY `id_advancement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id_chapter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `choices`
--
ALTER TABLE `choices`
  MODIFY `id_choice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `player_points`
--
ALTER TABLE `player_points`
  MODIFY `id_pts_player` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `points`
--
ALTER TABLE `points`
  MODIFY `id_pts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `stats`
--
ALTER TABLE `stats`
  MODIFY `id_stats` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stories`
--
ALTER TABLE `stories`
  MODIFY `id_story` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advancement`
--
ALTER TABLE `advancement`
  ADD CONSTRAINT `advancement_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `advancement_ibfk_2` FOREIGN KEY (`id_usr`) REFERENCES `user` (`id_usr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `choices_ibfk_2` FOREIGN KEY (`id_usr`) REFERENCES `user` (`id_usr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `player_points`
--
ALTER TABLE `player_points`
  ADD CONSTRAINT `player_points_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `player_points_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_usr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `stats_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
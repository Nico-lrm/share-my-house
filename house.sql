-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 14 avr. 2022 à 12:05
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `house`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id_conversation` int NOT NULL,
  `id_user_1` int NOT NULL,
  `id_user_2` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id_conversation`, `id_user_1`, `id_user_2`) VALUES
(1, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int NOT NULL,
  `code_postal` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ville` varchar(121) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pays` varchar(121) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `nb_lit` int DEFAULT NULL,
  `nb_sdb` int DEFAULT NULL,
  `prix_nuit` int NOT NULL,
  `haveWifi` tinyint(1) DEFAULT NULL,
  `havePiscine` tinyint(1) DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `id_user` int NOT NULL,
  `desc_log` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `superficie` int NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `code_postal`, `ville`, `pays`, `nb_lit`, `nb_sdb`, `prix_nuit`, `haveWifi`, `havePiscine`, `type_id`, `id_user`, `desc_log`, `superficie`, `visible`, `title`) VALUES
(1, '452', 'Athènes', 'Grèce', 2, 1, 85, 1, 0, 2, 2, 'Voici la 3ème annonce', 62, 1, 'ApptTest'),
(2, '69384', 'Lyon', 'France', 5, 2, 130, 1, 0, 1, 1, 'Maison fraîchement rénovée, située en plein coeur du 4ème arrondissement de Lyon.', 150, 1, 'Maisonnette sympatique');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id_message` int NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_conversation` int NOT NULL,
  `id_user` int NOT NULL,
  `date_message` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id_message`, `content`, `id_conversation`, `id_user`, `date_message`) VALUES
(1, 'Bonjour, j\'aurais quelques questions à propos de votre logement =) ', 1, 3, '2022-04-13 13:25:52'),
(2, 'Bonjour monsieur. \nJe suis à votre totale écoute.', 1, 2, '2022-04-13 13:27:04');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id_note` int NOT NULL,
  `valeur` int NOT NULL,
  `commentaire` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_user_note` int NOT NULL,
  `id_user_noteur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id_note`, `valeur`, `commentaire`, `id_user_note`, `id_user_noteur`) VALUES
(1, 4, 'Personne très agréable !', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `note_logement`
--

CREATE TABLE `note_logement` (
  `id_note` int NOT NULL,
  `valeur` int NOT NULL,
  `commentaire` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_user` int NOT NULL,
  `id_logement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `photo_logement`
--

CREATE TABLE `photo_logement` (
  `id_photo` int NOT NULL,
  `nom_photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `id_logement` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `photo_logement`
--

INSERT INTO `photo_logement` (`id_photo`, `nom_photo`, `id_logement`) VALUES
(1, 'athenes1.jpg', 1),
(2, 'athenes2.png', 1),
(3, 'athenes3.jpeg', 1),
(10, 'lyon1.jpeg', 2),
(11, 'lyon2.jpeg', 2),
(12, 'lyon3.jpeg', 2),
(13, 'lyon4.jpeg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int NOT NULL,
  `id_logement` int NOT NULL,
  `id_user_reserv` int NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_logement`, `id_user_reserv`, `date_debut`, `date_fin`) VALUES
(3, 1, 1, '2022-04-27', '2022-04-30');

-- --------------------------------------------------------

--
-- Structure de la table `type_logement`
--

CREATE TABLE `type_logement` (
  `id` int NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `type_logement`
--

INSERT INTO `type_logement` (`id`, `nom`) VALUES
(1, 'Maison'),
(2, 'Appartement'),
(3, 'Châlet');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `role` set('admin','user') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pays` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `name`, `birthday`, `email`, `password`, `photo`, `role`, `pays`, `ville`) VALUES
(1, 'Nicolas', 'LORMIER', '1997-11-24', 'lormiernicolas60@outlook.fr', '$2y$10$vlt/NDs1Rkt5B9Zr9xrFa.xxcz/N6ndknuCX9Is3xZ8dcDnaBTVny', 'placeholder.jpeg', 'admin', 'France', 'Amiens'),
(2, 'Coralie', 'MAINGE', '1999-09-14', 'hakenhollow@gmail.com', '$2y$10$zR.MHLETlXP/AfmSdA9v3.nZSXMIn3ZTXWX51EysposFSwKFVRui.', 'maison1.jpeg', 'admin', 'France', 'Amiens'),
(3, 'Alexandre', 'Delavaquerie', '2001-09-22', 'alexandre.delavaquerie@gmail.com', '$2y$10$MEgoWTBF1zV.mUWpgH9BFukrwxaRNB3.0zJ6TL0dm4DG5CG7gJm5i', NULL, 'admin', 'France', 'Amiens'),
(4, 'maxime', 'PHILIPPE', '2001-09-13', 'maxime.philippe7@orange.fr', '$2y$10$4f3N7roBijZ8XxGJu.ir/uBxYSY7MLqICac6GuoSl0eOzSzcfVPPy', NULL, 'admin', 'france', 'amienss'),
(5, 'UPJV', 'Fac', '1969-03-27', 'upjv@u-picardie.fr', '$2y$10$P9aZireEGM/OSi5nEDdMnOY1m9ANmVfz6aPxnVu7It3nEEG6pGNXW', 'upjv.jpeg', 'user', 'France', 'Amiens');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id_conversation`);

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`),
  ADD KEY `type_id` (`type_id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`);

--
-- Index pour la table `note_logement`
--
ALTER TABLE `note_logement`
  ADD PRIMARY KEY (`id_note`);

--
-- Index pour la table `photo_logement`
--
ALTER TABLE `photo_logement`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_logement` (`id_logement`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`);

--
-- Index pour la table `type_logement`
--
ALTER TABLE `type_logement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id_conversation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id_message` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `note_logement`
--
ALTER TABLE `note_logement`
  MODIFY `id_note` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `photo_logement`
--
ALTER TABLE `photo_logement`
  MODIFY `id_photo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_logement`
--
ALTER TABLE `type_logement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `logement`
--
ALTER TABLE `logement`
  ADD CONSTRAINT `logement_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_logement` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

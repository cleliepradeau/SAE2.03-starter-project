-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 18 avr. 2025 à 09:37
-- Version du serveur : 10.11.11-MariaDB-0+deb12u1
-- Version de PHP : 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pradeau49`
--

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Drame'),
(4, 'Science-fiction'),
(5, 'Animation'),
(6, 'Thriller'),
(7, 'Horreur'),
(8, 'Aventure'),
(9, 'Fantaisie'),
(10, 'Documentaire');

-- --------------------------------------------------------

--
-- Structure de la table `Favoris`
--

CREATE TABLE `Favoris` (
  `id_movie` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Favoris`
--

INSERT INTO `Favoris` (`id_movie`, `id_profile`, `id`) VALUES
(95, 3, 30),
(12, 3, 33);

-- --------------------------------------------------------

--
-- Structure de la table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL,
  `miseenavant` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Movie`
--

INSERT INTO `Movie` (`id`, `name`, `year`, `length`, `description`, `director`, `id_category`, `image`, `trailer`, `min_age`, `miseenavant`) VALUES
(7, 'Interstellar', 2014, 169, 'Un groupe d\'explorateurs voyage à travers un trou de ver pour sauver l\'humanité.', 'Christopher Nolan', 4, 'interstellar.jpg', 'https://www.youtube.com/embed/VaOijhK3CRU?si=76Ke4uw4LYjuLuQ6', 12, 0),
(12, 'La Liste de Schindler', 1993, 195, 'Un industriel allemand sauve des milliers de Juifs pendant l\'Holocauste.', 'Steven Spielberg', 3, 'schindler.webp', 'https://www.youtube.com/embed/ONWtyxzl-GE?si=xC3ASGGPy5Ib-aPn', 16, 1),
(17, 'Your Name', 2016, 107, 'Deux adolescents échangent leurs corps de manière mystérieuse.', 'Makoto Shinkai', 5, 'your_name.jpg', 'https://www.youtube.com/embed/AROOK45LXXg?si=aUQyGk2VMCb_ToUL', 10, 0),
(27, 'Le Bon, la Brute et le Truand', 1966, 161, 'Trois hommes se lancent à la recherche d\'un trésor caché.', 'Sergio Leone', 8, 'bon_brute_truand.jpg', 'https://www.youtube.com/embed/WA1hCZFOPqs?si=TwNZAoM4oj4KpGja', 12, 0),
(51, 'ON FAIT DES CRÊPES', 2025, 69, 'Les crêpes d\'NRJGAB', 'NRJGAB', 9, 'les_crepes.png', 'https://player.twitch.tv/?video=2389255121&parent=mmi.unilim.fr', 18, 1),
(52, 'Le Chant du loup', 2019, 115, 'Un jeune homme a le don rare de reconnaître chaque son qu\'il entend. À bord d\'un sous-marin nucléaire français, tout repose sur lui, l\'Oreille d\'Or. Réputé infaillible, il commet pourtant une erreur qui met l\'équipage en danger de mort. Il veut retrouver la confiance de ses camarades, mais sa quête les entraîne dans une situation encore plus dramatique. Dans le monde de la dissuasion nucléaire et de la désinformation, ils se retrouvent tous pris au piège d\'un engrenage incontrôlable.', 'Antonin Baudry', 6, 'le_chant_du_loup.jpg', 'https://www.youtube.com/embed/0-LTTNiGgUA?si=VQHbyDrhHHAy8rhZ', 12, 0),
(54, 'Raiponce', 2010, 100, 'Flynn Rider, un bandit recherché, s’allie avec Raiponce, une jeune fille aux cheveux magiques, pour s’échapper de sa tour où elle est enfermée.', 'Nathan Greno, Byron Howard', 5, 'raiponce.jpg', 'https://www.youtube.com/embed/O_fxAwUcEkA?si=ndJQoWvd40rwac2G', 3, 1),
(59, 'Le Roi Lion', 1994, 88, 'Un jeune lion nommé Simba doit retrouver son destin et devenir le roi de la savane.', 'Roger Allers, Rob Minkoff', 5, 'image_le_roi_lion.jpg', 'https://www.youtube.com/embed/tvvQitXftGk?si=LF1GIikhHdZMBm-M', 3, 0),
(60, 'Titanic', 1997, 195, 'Un drame romantique se déroule à bord du célèbre paquebot, le Titanic, qui sombre dans l\'océan Atlantique.', 'James Cameron', 3, 'image_titanic.jpg', 'https://www.youtube.com/embed/Quf4qIkD3KY?si=5-1mYe98xkqth2jC', 12, 0),
(61, 'Avatar', 2009, 162, 'Dans un futur lointain, un ancien soldat est envoyé sur une planète lointaine où il prend une nouvelle identité.', 'James Cameron', 4, 'image_avatar.jpg', 'https://www.youtube.com/embed/5PSNL1qE6VY?si=EUNRCc-bbRsfa6-N', 10, 0),
(86, 'Coco', 2017, 105, 'Miguel rêve de devenir musicien et plonge dans le monde des ancêtres.', 'Lee Unkrich', 5, 'coco.jpg', 'https://www.youtube.com/embed/Rvr68u6k5sI', 6, 0),
(87, 'Soul', 2020, 100, 'Un musicien de jazz vit une aventure entre la vie et l’au-delà.', 'Pete Docter', 5, 'soul.jpg', 'https://www.youtube.com/embed/xOsLIiBStEs', 8, 0),
(88, 'Encanto', 2021, 102, 'Dans une famille magique, Mirabel cherche sa place.', 'Byron Howard', 5, 'encanto.jpg', 'https://www.youtube.com/embed/CaimKeDcudo', 6, 0),
(89, 'Luca', 2021, 95, 'Deux jeunes monstres marins vivent un été inoubliable en Italie.', 'Enrico Casarosa', 5, 'luca.jpg', 'https://www.youtube.com/embed/mYfJxlgR2jw', 6, 0),
(90, 'Don\'t Look Up', 2021, 138, 'Deux astronomes tentent d\'avertir l’humanité d’un astéroïde.', 'Adam McKay', 2, 'dont-look-up.jpg', 'https://www.youtube.com/embed/RbIxYm3mKzI', 13, 0),
(91, 'The Conjuring', 2013, 112, 'Des enquêteurs du paranormal affrontent une présence maléfique dans une maison hantée.', 'James Wan', 4, 'the-conjuring.jpg', 'https://www.youtube.com/embed/k10ETZ41q5o', 16, 0),
(92, 'Ça', 2017, 135, 'Un groupe d’enfants affronte une entité maléfique prenant la forme d’un clown terrifiant.', 'Andrés Muschietti', 4, 'ca.jpg', 'https://www.youtube.com/embed/xKJmEC5ieOk', 16, 0),
(93, 'Kaizen', 2024, 98, 'Un entrepreneur japonais en crise découvre la philosophie du Kaizen et transforme sa vie.', 'Takeshi Tanaka', 6, 'kaizen.jpg', 'https://www.youtube.com/embed/fake-kaizen-trailer', 10, 0),
(94, 'Mufasa: The Lion King', 2024, 120, 'Un retour sur les origines de Mufasa, le roi légendaire de la savane.', 'Barry Jenkins', 5, 'mufasa.jpg', 'https://www.youtube.com/embed/dHDgx1FDGvY', 6, 0),
(95, 'The Amazing Spider-Man', 2012, 136, 'Peter Parker découvre ses pouvoirs d’araignée et affronte le Lézard, une menace née de la science.', 'Marc Webb', 1, 'the-amazing-spiderman.jpg', 'https://www.youtube.com/embed/-tnxzJ0SSOw', 10, 0),
(96, 'Cars', 2006, 117, 'Flash McQueen, une voiture de course ambitieuse, découvre la vraie valeur de l’amitié dans une petite ville oubliée.', 'John Lasseter', 5, 'cars.jpg', 'https://www.youtube.com/embed/SbXIj2T-_uk', 6, 0),
(97, 'Fast & Furious 9', 2021, 143, 'Dom affronte son frère dans une course explosive pour sauver le monde.', 'Justin Lin', 1, 'fast9.jpg', 'https://www.youtube.com/embed/aSiDu3Ywi8E', 12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Profile`
--

CREATE TABLE `Profile` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Profile`
--

INSERT INTO `Profile` (`id`, `nom`, `image`, `date_naissance`) VALUES
(3, 'Clélie', 'pp.jpg', '2006-03-23'),
(6, 'Enfant', 'nrjgab.png', '2017-02-09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Favoris`
--
ALTER TABLE `Favoris`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `Profile`
--
ALTER TABLE `Profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Favoris`
--
ALTER TABLE `Favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `Profile`
--
ALTER TABLE `Profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

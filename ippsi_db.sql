-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  sam. 17 nov. 2018 à 11:04
-- Version du serveur :  10.3.10-MariaDB-1:10.3.10+maria~bionic
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ippsi_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `image`, `title`, `content`, `author`) VALUES
(1, 'upload/ecrire-article-blog.jpg', 'Post 1', '### **Lorem ipsum dolor sit amet, consectetur adipiscing elit.**\n\n **Ut ut mauris et urna lacinia mattis.** Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit.', 1),
(2, 'upload/ecrire-article-blog.jpg', 'Post 2 ', '### Curabitur nibh velit, finibus tempus auctor id, \n\n**sollicitudin eu eros.** In augue ipsum, mollis vel auctor nec, lacinia sed eros. Donec laoreet quam a euismod euismod. Cras maximus mauris at leo pharetra maximus. Quisque vel tempus elit, nec efficitur mi. Curabitur vulputate lobortis volutpat.', 1),
(3, 'upload/ecrire-article-blog.jpg', 'Poste 3', '### Ut euismod leo sit amet justo interdum consequat. \n\n**Morbi eget urna nec risus** rutrum fermentum sed sit amet est. Cras dapibus orci tortor, ac dictum nibh scelerisque non. Suspendisse vel ex finibus tellus accumsan efficitur. Etiam arcu dolor, vulputate at felis eget, aliquam aliquam sapien. Curabitur ut lacus auctor, condimentum felis nec, pellentesque ante. Etiam pharetra felis sit amet nunc tincidunt eleifend. Sed consequat massa in ante lobortis, eu hendrerit sapien iaculis.', 1),
(4, 'upload/ecrire-article-blog.jpg', 'Post 4', '### Sed quam massa, vestibulum nec fermentum id, convallis ac leo. \n\n**Praesent congue,** lorem vitae pellentesque finibus, neque dui fringilla enim, vel accumsan mauris orci eget ligula. Nunc venenatis suscipit mi non iaculis. Phasellus eleifend, elit vel vehicula maximus, lectus quam pellentesque nulla, id elementum lacus ante eget nunc. Nam placerat ex vel lacus iaculis ultrices. Maecenas porttitor tortor ut nulla vehicula, quis efficitur ligula feugiat. Morbi eget turpis lacus. Ut et scelerisque urna, in auctor orci.', 1),
(5, 'upload/ecrire-article-blog.jpg', 'Post 5', '### **Vivamus vitae hendrerit risus.** \n\nEtiam molestie velit blandit libero luctus, id pretium risus pulvinar. Donec finibus consequat ex, at cursus enim dignissim vitae. Vestibulum a enim auctor, tempor orci dapibus, iaculis lacus. ***Quisque pellentesque purus sit amet risus egestas tristique in in sem.*** Curabitur ut orci fringilla, molestie nulla et, posuere tortor. Nullam elit risus, ullamcorper sed urna sed, blandit sagittis nulla. Suspendisse in eros ut nisi commodo eleifend sed et felis. Aenean arcu ante, condimentum vitae dolor sed, cursus porttitor risus. Fusce molestie purus massa, vitae auctor justo scelerisque sit amet. In viverra sed erat non elementum. Integer aliquet tincidunt augue. Maecenas eu arcu at arcu pretium rutrum. Ut vitae malesuada nibh, eget auctor mauris. Aliquam sollicitudin elit in urna finibus, a tincidunt mi gravida.', 1),
(6, 'upload/ecrire-article-blog.jpg', 'Post 6', '#### **Lorem ipsum dolor sit amet, consectetur adipiscing elit.**\n\nUt ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit. \n\n![](https://i.imgur.com/ybW9DA0.png)', 1),
(7, 'upload/ecrire-article-blog.jpg', 'Post 7', '#### Teuismod leo sit amet justo interdum consequat.\n\n *Morbi eget urna nec risus rutrum fermentum sed sit amet est. Cras dapibus orci tortor, ac dictum nibh scelerisque non. Suspendisse vel ex finibus tellus accumsan efficitur. Etiam arcu dolor*, vulputate at felis eget, **aliquam aliquam sapien.** Curabitur ut lacus auctor, condimentum felis nec, pellentesque ante. Etiam pharetra felis sit amet nunc tincidunt eleifend. Sed consequat massa in ante lobortis, eu hendrerit sapien iaculis. Sed quam massa, vestibulum nec fermentum id, convallis ac leo. Praesent congue, lorem vitae pellentesque finibus, neque dui fringilla enim, vel accumsan mauris orci eget ligula.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `id_article`, `username`, `content`) VALUES
(1, 7, 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet.'),
(2, 7, 'test', 'Morbi eget urna nec risus rutrum fermentum sed sit amet est. Cras dapibus orci tortor, ac dictum nibh scelerisque non. Suspendisse vel ex finibus tellus accumsan efficitur. Etiam arcu dolor, '),
(3, 6, 'test', 'Morbi eget urna nec risus rutrum fermentum sed sit amet est. Cras dapibus orci tortor, ac dictum nibh scelerisque non. Suspendisse vel ex finibus tellus accumsan efficitur. Etiam arcu dolor, '),
(4, 5, 'test', 'Morbi eget urna nec risus rutrum fermentum sed sit amet est. Cras dapibus orci tortor, ac dictum nibh scelerisque non. Suspendisse vel ex finibus tellus accumsan efficitur. Etiam arcu dolor, '),
(5, 1, 'test', 'Morbi eget urna nec risus rutrum fermentum sed sit amet est. Cras dapibus orci tortor, ac dictum nibh scelerisque non. Suspendisse vel ex finibus tellus accumsan efficitur. Etiam arcu dolor, '),
(6, 7, 'Non loged user', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nUt ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit.'),
(7, 7, 'Non loged user', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nUt ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit.'),
(8, 6, 'Non loged user', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nUt ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit.'),
(9, 5, 'Non loged user', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nUt ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit.'),
(10, 3, 'Non loged user', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nUt ut mauris et urna lacinia mattis. Sed tristique, orci nec ornare eleifend, tortor lacus ullamcorper ligula, ultricies dignissim nunc risus sit amet risus. Suspendisse pharetra scelerisque sapien ac porta. Aliquam iaculis auctor velit, in ultrices metus dignissim sit amet. In quis tristique ex, non sagittis eros. Morbi venenatis risus nec dui aliquet, sit amet facilisis odio blandit.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'test', '$2y$09$Rw9ye59y/dGQYHRoR5q0c.Li0JyfNq56a9USTPgG5AJFZK8JO.Ycq');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author` (`author`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article` (`id_article`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

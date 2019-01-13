-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 03 juin 2018 à 13:04
-- Version du serveur :  5.7.22
-- Version de PHP :  7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `42music`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'all'),
(2, 'piano'),
(3, 'guitar'),
(4, 'keyboard'),
(5, 'drums'),
(6, 'strings'),
(7, 'wind');

-- --------------------------------------------------------

--
-- Structure de la table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `ID_category` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category_product`
--

INSERT INTO `category_product` (`id`, `ID_category`, `ID_product`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 1),
(4, 1, 2),
(5, 7, 2),
(6, 1, 3),
(7, 3, 3),
(8, 1, 4),
(9, 5, 4),
(10, 1, 5),
(11, 6, 5),
(12, 1, 6),
(13, 2, 6),
(14, 1, 7),
(15, 4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `order_archive`
--

CREATE TABLE `order_archive` (
  `id` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `order_archive`
--

INSERT INTO `order_archive` (`id`, `ID_user`, `price`) VALUES
(1, 3, 10400),
(2, 2, 5018000);

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `ID_order` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `order_product`
--

INSERT INTO `order_product` (`id`, `ID_order`, `ID_product`, `amount`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 4, 1),
(4, 2, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `img`) VALUES
(1, 'Alesis Recital Pro', 400, 'http://www.rock.ma/10077-thickbox_default/alesis-recital-pro.jpg'),
(2, 'Yamaha YCL-650II', 10000, 'https://www.woodbrass.com/images/SQUARE400/woodbrass/YAMAHA+YCL650II.JPG'),
(3, 'Fender Stratocaster', 1000, 'https://d1aeri3ty3izns.cloudfront.net/media/26/269364/1200/preview.jpg'),
(4, 'Ludwig', 5000000, 'https://media.musiciansfriend.com/is/image/MMGS7/Junior-Outfit-Drum-Set-Blue/447702000004000-00-500x500.jpg'),
(5, 'Basswood', 200, 'https://cdn.shopify.com/s/files/1/1710/1447/products/Violin9.jpeg?v=1521557750'),
(6, 'Roland Grand Piano', 18000, 'https://d1aeri3ty3izns.cloudfront.net/media/12/120144/1200/preview.jpg'),
(7, 'Yamaha Y40', 150, 'https://media.cultura.com/media/catalog/product/cache/1/image/1000x1000/9df78eab33525d08d6e5fb8d27136e95/c/l/clavier-arrangeur-61-touches-385-sonorites-100-styles-usb-to-host-4957812527354_0.jpg?t=1509500344');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `admin`, `email`, `passwd`, `name`, `first_name`, `adress`, `zip`, `city`) VALUES
(1, 1, 'samuel.vigouroux.o@gmail.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 'Vigouroux-Obadia', 'Samuel', '3 rue Berzelius', 75017, 'Paris'),
(2, 0, 'test@test.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 'test', 'test', 'test', 0, 'test'),
(3, 0, 'random@random.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 'random', 'random', 'random', 66666, 'random');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_archive`
--
ALTER TABLE `order_archive`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `order_archive`
--
ALTER TABLE `order_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

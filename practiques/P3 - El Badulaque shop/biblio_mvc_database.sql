-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2018 at 11:40 AM
-- Server version: 5.7.22
-- PHP Version: 7.2.5-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `compres`
--

CREATE TABLE `compres` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL COMMENT 'ES FOREIGN KEY',
  `data_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compres`
--

INSERT INTO `compres` (`id`, `id_client`, `data_compra`) VALUES
(1, 15, '2018-05-14'),
(2, 15, '2018-05-15'),
(3, 15, '2018-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `llibres`
--

CREATE TABLE `llibres` (
  `id` int(11) NOT NULL,
  `titol` varchar(50) DEFAULT NULL,
  `descripcio` varchar(1000) NOT NULL,
  `cleanurl` varchar(200) NOT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `comprat` char(1) DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `autor` varchar(40) DEFAULT NULL,
  `imatge` varchar(200) DEFAULT NULL,
  `preu` float NOT NULL,
  `genere` enum('infantil','ficcio','idiomes','assaig','comic') NOT NULL,
  `editorial` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `llibres`
--

INSERT INTO `llibres` (`id`, `titol`, `descripcio`, `cleanurl`, `ISBN`, `comprat`, `data_entrada`, `autor`, `imatge`, `preu`, `genere`, `editorial`) VALUES
(51, 'Detectives Salvajes', 'Dos jóvenes poetas latinoamericanos, Arturo Belano y Ulises Lima, emprenden una aventura que transcurrirá durante varias décadas y cruzará distintos países. Símbolo de la rebeldía y la necesidad de ruptura con la realidad establecida, sus vidas representan los anhelos de toda una generación. La búsqueda en 1975 de la misteriosa escritora mexicana Cesárea Tinajero, desaparecida y olvidada en los años posteriores a la revolución, sirve de inicio a un viaje sin descanso marcado por el amor, la muerte, el deseo de libertad, el humor y la literatura.\r\n\r\nEn esta novela está esbozado, como si de un juego de cajas chinas se tratara, todo el deslumbrante universo literario y personal de Roberto Bolaño.', 'detectivessalvajes', NULL, NULL, '2017-12-15', 'Roberto Bolaño', 'Detectives Salvajes.jpeg', 8, 'ficcio', NULL),
(52, 'La pista de hielo', 'Tres voces dan tres vidas al relato del crimen acaecido en La pista de hielo: la de Gaspar, chileno con pretensiones de escritor; la de Remo, mexicano aspirante a poeta que ocupa sus noches como vigilante de un cámping, y la de Enric, político catalán embelesado por una bella y veleidosa patinadora.\r\n\r\nLos testimonios de cada uno de ellos se entrecruzan y pugnan para hacerse con una verdad a la que solamente el lector, como un detective cada vez más salvaje que debe lidiar con el peso de la investigación, tiene acceso.', '', NULL, NULL, '2017-12-06', 'Roberto Bolaño', 'La pista de hielo.jpeg', 10, 'ficcio', NULL),
(53, 'Carmen', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2017-12-06', 'Nieves Herrero', 'Carmen.jpg', 12, 'ficcio', NULL),
(55, 'Diario de Greg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2017-12-06', 'Jeff Kinney', 'Diario de Greg.jpg', 9, 'infantil', NULL),
(56, 'IMPERIOFOBIA Y LA LEYENDA NEGRA', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2017-12-06', 'MARIA ELVIRA ROCA BAREA', 'IMPERIOFOBIA Y LA LEYENDA NEGRA.jpg', 24, 'ficcio', NULL),
(57, 'EL JARAMA', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2017-12-06', 'RAFAEL SANCHEZ FERLOSIO', 'EL JARAMA.jpg', 10, 'ficcio', NULL),
(58, 'DINOSARIUM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2017-12-06', 'CHRIS WORMELL', 'DINOSARIUM.jpg', 25, 'infantil', NULL),
(59, 'Sociedad del Espectáculo', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-03', 'Guy Debord', 'Sociedad del Espectáculo.jpg', 15, 'assaig', NULL),
(60, 'Inteligencia Emocional', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-03', 'Daniel Goleman', 'Inteligencia Emocional.jpg', 25, 'assaig', NULL),
(61, 'antimanual de Filosofia', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-03', 'Michel Onfray', 'antimanual de Filosofia.jpg', 12, 'assaig', NULL),
(62, 'Elogio de la amistad', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-03', 'Jose Maria Gimferrer', 'Elogio de la amistad.jpg', 35, 'assaig', NULL),
(63, 'Aprenda un idioma en 7 dias', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-04', 'Ramon Campayo', '', 11.4, 'idiomes', NULL),
(64, 'Como aprender idiomas sin ir a clase', 'Especialmente escrito para aquellas personas que quieren o necesitan aprender un idioma de una vez por todas, sin complicaciones, y no tienen tiempo ni dinero para asistir a una academia de idiomas.\r\n\r\nEl autor describe, de forma fácil y amena, los métodos y trucos que él mismo ha utilizado para aprender tres idiomas por su cuenta.\r\nAnaliza por separado y explica cómo trabajar cada una de las cuatro destrezas básicas en el aprendizaje de una lengua: escuchar, hablar, leer y escribir.', '', NULL, NULL, '2018-01-04', 'Roberto Escudero', 'Como aprender idiomas sin ir a clase.jpg', 10, 'idiomes', NULL),
(65, 'Las aventuras del Capitán Calzocillos', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-04', 'Dav Pilkey', 'Las aventuras del Capitán Calzocillos.jpg', 12.5, 'comic', NULL),
(66, 'Star Wars nº 01 (estándar)', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-04', 'Jason Aaron', 'Star Wars nº 01 (estándar).jpg', 7.5, 'comic', NULL),
(67, 'El caballero errante', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', NULL, NULL, '2018-01-04', 'George RR Martin', 'El caballero errante.jpg', 12.3, 'comic', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `llibres_comprats`
--

CREATE TABLE `llibres_comprats` (
  `id_compra` int(11) NOT NULL,
  `id_llibre` int(11) NOT NULL,
  `unitats` int(11) NOT NULL DEFAULT '1',
  `preu` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `llibres_comprats`
--

INSERT INTO `llibres_comprats` (`id_compra`, `id_llibre`, `unitats`, `preu`) VALUES
(1, 55, 1, 9),
(2, 51, 2, 8),
(2, 58, 6, 25),
(2, 62, 1, 35),
(3, 52, 1, 10),
(3, 55, 2, 9),
(3, 57, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `usuaris`
--

CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `tipus_usuari` set('administrador','client') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom`, `password`, `tipus_usuari`) VALUES
(3, 'admin', '$1$7rM10nWP$3s3PzodF/uLKt7qIoF2si0', 'administrador'),
(15, 'toni', '$1$12345678$EbMhxGXgd0B9Ep2NTZLMx0', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compres`
--
ALTER TABLE `compres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compres_ibfk_1` (`id_client`);

--
-- Indexes for table `llibres`
--
ALTER TABLE `llibres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleanurl` (`cleanurl`);

--
-- Indexes for table `llibres_comprats`
--
ALTER TABLE `llibres_comprats`
  ADD PRIMARY KEY (`id_compra`,`id_llibre`),
  ADD KEY `id_llibre` (`id_llibre`);

--
-- Indexes for table `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compres`
--
ALTER TABLE `compres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `llibres`
--
ALTER TABLE `llibres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `compres`
--
ALTER TABLE `compres`
  ADD CONSTRAINT `compres_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `llibres_comprats`
--
ALTER TABLE `llibres_comprats`
  ADD CONSTRAINT `llibres_comprats_ibfk_2` FOREIGN KEY (`id_compra`) REFERENCES `compres` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

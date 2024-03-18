-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 21-01-2024 a las 11:16:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goierriazoka`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balorazioa`
--

DROP TABLE IF EXISTS `balorazioa`;
CREATE TABLE `balorazioa` (
  `id` int(11) NOT NULL,
  `ziklo_id` int(11) NOT NULL,
  `erabiltzaile_id` int(11) NOT NULL,
  `balorazioa` smallint(6) NOT NULL,
  `zuzen_erantzun` tinyint(4) NOT NULL,
  `valid` tinyint(1) DEFAULT 0,
  `teacher` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Balorazioen media atera behar bada, ez kontatu 0 daukatenak.';

--
-- Volcado de datos para la tabla `balorazioa`
--

INSERT INTO `balorazioa` (`id`, `ziklo_id`, `erabiltzaile_id`, `balorazioa`, `zuzen_erantzun`, `valid`, `teacher`) VALUES
(1, 3, 1, 5, 1, 0, 1),
(2, 3, 1, 0, 0, 0, 0),
(3, 3, 2, 5, 0, 1, 0),
(4, 3, 3, 4, 1, 1, 0),
(5, 3, 4, 5, 1, 1, 1),
(6, 3, 5, 5, 1, 0, 1),
(7, 4, 4, 2, 1, 1, 1),
(8, 4, 6, 5, 0, 1, 0),
(9, 4, 2, 5, 0, 1, 0),
(10, 4, 7, 5, 1, 1, 0),
(11, 7, 7, 4, 0, 1, 0),
(12, 8, 1, 5, 1, 1, 1),
(13, 8, 7, 4, 1, 1, 0),
(14, 8, 6, 5, 0, 1, 0),
(15, 8, 6, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `erabiltzaileak`
--

DROP TABLE IF EXISTS `erabiltzaileak`;
CREATE TABLE `erabiltzaileak` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `erabiltzaileak`
--

INSERT INTO `erabiltzaileak` (`id`, `email`) VALUES
(1, 'amadinabeitia'),
(2, 'ben_ger_igl'),
(3, 'and_mur_arr'),
(4, 'eormazabal'),
(5, 'eormazabala'),
(6, 'gor_bar_are'),
(7, 'ame_amo_ipe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zikloak`
--

DROP TABLE IF EXISTS `zikloak`;
CREATE TABLE `zikloak` (
  `id` int(11) NOT NULL,
  `izena` varchar(255) NOT NULL,
  `laburbildura` varchar(250) NOT NULL,
  `bideo_esteka` varchar(250) DEFAULT NULL,
  `web_esteka` varchar(250) DEFAULT NULL,
  `deskripzioa` varchar(250) DEFAULT NULL,
  `galdera` varchar(255) NOT NULL,
  `erantzun_zuzena` int(11) NOT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zikloak`
--

INSERT INTO `zikloak` (`id`, `izena`, `laburbildura`, `bideo_esteka`, `web_esteka`, `deskripzioa`, `galdera`, `erantzun_zuzena`, `option1`, `option2`, `option3`) VALUES
(1, 'Web garapena', '1WG3', 'https://www.youtube.com/embed/EZDVhEEWoJs?si=gig6rc09buNLIIch', 'https://www.goierrieskola.eus/es/oferta_educativa/tecnico-superior-en-desarrollo-de-aplicaciones-web/', 'Gure proiektua...', '1WG3ren galdera: Gure galdera hau pixka bat luzea egin nahi dut nola geratzen den ikusteko. Ea argi geratzen den.', 1, '1WG3 - Aukera 1 da zeren eta lorem ipsum bat bi hiru lau.1WG3 - Aukera 1 da zeren eta lorem ipsum bat bi hiru lau.1WG3 - Aukera 1 da zeren eta lorem ipsum bat bi hiru lau.', '1WG3 - Aukera 2 1WG3 - Aukera 21WG3 - Aukera 21WG3 - Aukera 21WG3 - Aukera 21WG3 - Aukera 21WG3 - Aukera 21WG3 - Aukera 21WG3 - Aukera 2', '1WG3 - Aukera 3'),
(2, '1AF3', '1AF3', 'https://www.youtube.com/embed/EZDVhEEWoJs?si=gig6rc09buNLIIch', 'https://www.goierrieskola.eus/es/oferta_educativa/tecnico-superior-en-administracion-y-finanzas/', 'Gure proiektua...', '1AF3ren galdera: Gure galdera...', 2, '1AF3 - Aukera 1', '1AF3 - Aukera 2', '1AF3 - Aukera 3'),
(3, '1AR3', '1AR3', 'https://www.youtube.com/embed/EZDVhEEWoJs?si=gig6r...', 'https://www.goierrieskola.eus/es/oferta_educativa/tecnico-superior-en-automatizacion-y-robotica-industrial/', 'Gure proiektua...', '1AR3ren galdera: Gure galdera...', 3, '1AR3 - Aukera 1', '1AR3 - Aukera 2', '1AR3 - Aukera 3'),
(4, '1DF3', '1DF3', 'https://www.youtube.com/embed/EZDVhEEWoJs?si=gig6r...', 'htttps://..', 'Gure proiektua...', '1DF3ren galdera: Gure galdera...', 1, '1DF3 - Aukera 1', '1DF3 - Aukera 2', '1DF3 - Aukera 3'),
(5, '1FM3A', '1FM3A', 'https://www.youtube.com/embed/D72-30THK-M?si=lwACYMH06R-f41vR', 'https://www.goierrieskola.eus/es/oferta_educativa/tecnico-superior-en-programacion-de-la-produccion-en-fabricacion-en-mecanica/', 'Gure proiektua...', '1FM3Aren galdera: Gure galdera...', 2, '1FM3A - Aukera 1', '1FM3A - Aukera 2', '1FM3A - Aukera 3'),
(6, '1FM3B', '1FM3B', 'https://www.youtube.com/embed/D72-30THK-M?si=lwACYMH06R-f41vR', 'https://www.goierrieskola.eus/es/oferta_educativa/tecnico-superior-en-programacion-de-la-produccion-en-fabricacion-en-mecanica/', 'Gure proiektua...', '1FM3Bren galdera: Gure galdera...', 3, '1FM3B - Aukera 1', '1FM3B - Aukera 2', '1FM3B - Aukera 3'),
(7, '1ME2', '1ME2', 'https://www.youtube.com/embed/D72-30THK-M?si=lwACYMH06R-f41vR', 'htttps://..', 'Gure proiektua...', '1ME2ren galdera: Gure galdera...', 1, '1ME2 - Aukera 1', '1ME2 - Aukera 2', '1ME2 - Aukera 3'),
(8, 'Multiplataforma garapena', '1MG3', 'https://www.youtube.com/embed/D72-30THK-M?si=lwACYMH06R-f41vR', 'https://www.goierrieskola.eus/es/oferta_educativa/tecnico-superior-en-desarrollo-de-aplicaciones-web/', 'Gure proiektua...', '1MG3ren galdera: Gure galdera...', 2, '1MG3 - Aukera 1', '1MG3 - Aukera 2', '1MG3 - Aukera 3'),
(9, '1MK2', '1MK2', 'https://www.youtube.com/embed/HPPw5E3Sds4?si=U5VcYWFxQMh4fc8q', 'htttps://..', 'Gure proiektua...', '1MK2ren galdera: Gure galdera...', 3, '1MK2 - Aukera 1', '1MK2 - Aukera 2', '1MK2 - Aukera 3'),
(10, '1MK3', '1MK3', 'https://www.youtube.com/embed/HPPw5E3Sds4?si=U5VcYWFxQMh4fc8q', 'htttps://..', 'Gure proiektua...', '1MK3ren galdera: Gure galdera...', 1, '1MK3 - Aukera 1', '1MK3 - Aukera 2', '1MK3 - Aukera 3'),
(11, '1PA2', '1PA2', 'https://www.youtube.com/embed/HPPw5E3Sds4?si=U5VcYWFxQMh4fc8q', 'htttps://..', 'Gure proiektua...', '1PA2ren galdera: Gure galdera...', 2, '1PA2 - Aukera 1', '1PA2 - Aukera 2', '1PA2 - Aukera 3'),
(12, '1SG2', '1SG2', 'https://www.youtube.com/embed/HPPw5E3Sds4?si=U5VcYWFxQMh4fc8q', 'htttps://..', 'Gure proiektua...', '1SG2ren galdera: Gure galdera...', 3, '1SG2 - Aukera 1', '1SG2 - Aukera 2', '1SG2 - Aukera 3'),
(13, '2AF3', '2AF3', 'https://www.youtube.com/embed/FqKU3B_O2rc?si=fbQhqGQyTCNCVIO8', 'htttps://..', 'Gure proiektua...', '2AF3ren galdera: Gure galdera...', 1, '2AF3 - Aukera 1', '2AF3 - Aukera 2', '2AF3 - Aukera 3'),
(14, '2AR3', '2AR3', 'https://www.youtube.com/embed/FqKU3B_O2rc?si=fbQhqGQyTCNCVIO8', 'htttps://..', 'Gure proiektua...', '2AR3ren galdera: Gure galdera...', 2, '2AR3 - Aukera 1', '2AR3 - Aukera 2', '2AR3 - Aukera 3'),
(15, '2DF3', '2DF3', 'https://www.youtube.com/embed/FqKU3B_O2rc?si=fbQhqGQyTCNCVIO8', 'htttps://..', 'Gure proiektua...', '2DF3ren galdera: Gure galdera...', 3, '2DF3 - Aukera 1', '2DF3 - Aukera 2', '2DF3 - Aukera 3'),
(16, '2FM3A', '2FM3A', 'https://www.youtube.com/embed/FqKU3B_O2rc?si=fbQhqGQyTCNCVIO8', 'htttps://..', 'Gure proiektua...', '2FM3Aren galdera: Gure galdera...', 1, '2FM3A - Aukera 1', '2FM3A - Aukera 2', '2FM3A - Aukera 3'),
(17, '2FM3B', '2FM3B', 'https://www.youtube.com/embed/FqKU3B_O2rc?si=fbQhqGQyTCNCVIO8', 'htttps://..', 'Gure proiektua...', '2FM3Bren galdera: Gure galdera...', 2, '2FM3B - Aukera 1', '2FM3B - Aukera 2', '2FM3B - Aukera 3'),
(18, '2ME2', '2ME2', 'https://www.youtube.com/embed/wX_P5LrFRlg?si=yvw0zXukSdFJVNB5', 'htttps://..', 'Gure proiektua...', '2ME2ren galdera: Gure galdera...', 3, '2ME2 - Aukera 1', '2ME2 - Aukera 2', '2ME2 - Aukera 3'),
(19, '2MK2', '2MK2', 'https://www.youtube.com/embed/wX_P5LrFRlg?si=yvw0zXukSdFJVNB5', 'htttps://..', 'Gure proiektua...', '2MK2ren galdera: Gure galdera...', 1, '2MK2 - Aukera 1', '2MK2 - Aukera 2', '2MK2 - Aukera 3'),
(20, '2MK3', '2MK3', 'https://www.youtube.com/embed/wX_P5LrFRlg?si=yvw0zXukSdFJVNB5', 'htttps://..', 'Gure proiektua...', '2MK3ren galdera: Gure galdera...', 2, '2MK3 - Aukera 1', '2MK3 - Aukera 2', '2MK3 - Aukera 3'),
(21, '2PA2', '2PA2', 'https://www.youtube.com/embed/wX_P5LrFRlg?si=yvw0zXukSdFJVNB5', 'htttps://..', 'Gure proiektua...', '2PA2ren galdera: Gure galdera...', 3, '2PA2 - Aukera 1', '2PA2 - Aukera 2', '2PA2 - Aukera 3'),
(22, '2SG2', '2SG2', 'https://www.youtube.com/embed/wX_P5LrFRlg?si=yvw0zXukSdFJVNB5', 'htttps://..', 'Gure proiektua...', '2SG2ren galdera: Gure galdera...', 1, '2SG2 - Aukera 1', '2SG2 - Aukera 2', '2SG2 - Aukera 3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `balorazioa`
--
ALTER TABLE `balorazioa`
  ADD PRIMARY KEY (`id`,`ziklo_id`,`erabiltzaile_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `erabiltzaileak`
--
ALTER TABLE `erabiltzaileak`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zikloak`
--
ALTER TABLE `zikloak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `balorazioa`
--
ALTER TABLE `balorazioa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `erabiltzaileak`
--
ALTER TABLE `erabiltzaileak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `zikloak`
--
ALTER TABLE `zikloak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

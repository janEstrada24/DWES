-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-12-2022 a las 23:14:20
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dwes_janestrada_concurs_gossos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases`
--

CREATE TABLE `fases` (
  `id` int(11) NOT NULL,
  `dataInici` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fases`
--

INSERT INTO `fases` (`id`, `dataInici`, `dataFinal`) VALUES
(1, '2023-01-01', '2023-02-01'),
(2, '2023-02-02', '2023-03-01'),
(3, '2023-03-02', '2023-04-01'),
(4, '2023-04-02', '2023-05-01'),
(5, '2023-05-02', '2023-06-01'),
(6, '2023-06-02', '2023-07-01'),
(7, '2023-07-02', '2023-08-01'),
(8, '2023-08-02', '2023-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gossos`
--

CREATE TABLE `gossos` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `amo` varchar(30) DEFAULT NULL,
  `imatge` varchar(30) DEFAULT NULL,
  `raca` varchar(30) DEFAULT NULL,
  `vots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gossos`
--

INSERT INTO `gossos` (`id`, `nom`, `amo`, `imatge`, `raca`, `vots`) VALUES
(1, 'Musclo', 'Joan Pere Arnau', 'img/g1.png', 'Husky Siberià', 0),
(2, 'Jingo', 'Paula Mercader Colomer', 'img/g2.png', 'Chow Chow', 0),
(3, 'Xuia', 'Pau Falguera Medina', 'img/g3.png', 'Sabueso Espanol', 0),
(4, 'Bruc', 'Jaume Dou Lopez', 'img/g4.png', 'Pastor Alemany', 0),
(5, 'Mango', 'Maria Barranco Pujiula', 'img/g5.png', 'Fox Terrier', 0),
(6, 'Fluski', 'Marta Verdaguer Prat', 'img/g6.png', 'Bichon Maltes', 0),
(7, 'Fonoll', 'Jan Estrada Solano', 'img/g7.png', 'Golden Retriever', 0),
(8, 'Swing', 'Aleix Pujol Fernandez', 'img/g8.png', 'Dobermann', 0),
(9, 'Coloma', 'Ferran Ricart Boada', 'img/g9.png', 'San Bernardo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `nom` varchar(20) NOT NULL,
  `contrasenya` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`nom`, `contrasenya`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fases`
--
ALTER TABLE `fases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gossos`
--
ALTER TABLE `gossos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`nom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `gossos`
--
ALTER TABLE `gossos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2023 a las 16:26:12
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
-- Base de datos: `reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `asiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`id`, `idusuario`, `asiento`, `estado`, `fecha`) VALUES
(1, 1, 22, 0, '2023-11-30'),
(2, 2, 18, 0, '2023-11-29'),
(3, 1, 16, 0, '2023-11-29'),
(4, 3, 5, 0, '2023-11-29'),
(5, 4, 6, 0, '2023-11-30'),
(6, 1, 2, 0, '2023-11-30'),
(7, 2, 10, 0, '2023-11-28'),
(8, 5, 3, 0, '2023-11-30'),
(9, 5, 3, 0, '2023-11-28'),
(10, 1, 12, 0, '2023-11-30'),
(11, 1, 10, 0, '2023-12-01'),
(12, 1, 11, 0, '2023-12-06'),
(13, 3, 5, 0, '2023-12-05'),
(14, 1, 1, 0, '2023-12-07'),
(15, 3, 2, 0, '2023-12-07'),
(16, 2, 3, 0, '2023-12-07'),
(17, 4, 9, 0, '2023-12-07'),
(18, 5, 12, 0, '2023-12-07'),
(19, 3, 2, 0, '2023-12-12'),
(20, 2, 9, 0, '2023-12-10'),
(21, 2, 9, 0, '2023-12-12'),
(22, 4, 6, 0, '2023-12-12'),
(23, 5, 7, 0, '2023-12-12'),
(24, 1, 18, 0, '2023-12-12'),
(25, 1, 2, 0, '2023-12-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `email` varchar(120) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `pass`, `email`, `fecha`) VALUES
(1, 'sebastian', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'seba@mail.com', '2023-11-24'),
(2, 'mario', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'mario@mail.com', '2023-11-24'),
(3, 'lucas', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'lucas@mail.com', '2023-11-27'),
(4, 'ada', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ada@mail.com', '2023-11-27'),
(5, 'fabri', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'faubri@mail.com', '2023-11-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

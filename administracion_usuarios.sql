-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2022 a las 07:56:13
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `administracion_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `id_acta` int(4) NOT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `fecha_acta` varchar(20) DEFAULT NULL,
  `descripcion_acta` varchar(500) DEFAULT NULL,
  `responsable_acta` varchar(100) DEFAULT NULL,
  `programa_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta`
--

INSERT INTO `acta` (`id_acta`, `asunto`, `fecha_acta`, `descripcion_acta`, `responsable_acta`, `programa_id`) VALUES
(3, 'ddkdkdkdkkddmmm', '2022-07-07', 'jsjskksdlldldld', 'ldldldll', 1),
(5, 'Diplomado', '2022-07-14', 'Arreglar asunto', 'Carlos', 2),
(6, 'Diplomado', '2022-07-16', 'Hola como estas', 'Ese man', 1),
(7, 'kfkkkkkkkkk', '2022-07-16', 'dkdkdjfj', 'jdkkdd', 2),
(8, 'kflflfld', '2022-07-20', 'dkdkdjfjkdsñsñs', 'jdkkdddkddllsñññsñ', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compromisos`
--

CREATE TABLE `compromisos` (
  `id_compromiso` int(4) NOT NULL,
  `descripcion_compromiso` varchar(500) DEFAULT NULL,
  `fecha_inicio` varchar(20) DEFAULT NULL,
  `fecha_final` varchar(20) DEFAULT NULL,
  `responsable_compromiso` varchar(20) DEFAULT NULL,
  `acta_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compromisos`
--

INSERT INTO `compromisos` (`id_compromiso`, `descripcion_compromiso`, `fecha_inicio`, `fecha_final`, `responsable_compromiso`, `acta_id`) VALUES
(4, 'jfkflflfl', '2022-07-08', '2022-07-21', 'klflflflf', 5),
(5, 'kdkdkdkd', '2022-07-08', '2022-07-22', 'kdkdkdld', 8),
(6, 'hola como estas', '2022-07-16', '2022-07-24', 'hellow how are you', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(4) NOT NULL,
  `nombre_programa` varchar(100) DEFAULT NULL,
  `facultad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `nombre_programa`, `facultad`) VALUES
(1, 'Ingenieria de Sistemas', 'Facultad de Ingenierias'),
(2, 'Ingenieria Industrial', 'Facultad de Ingenierias'),
(3, 'Ingenieria de Alimentos', 'Facultad de Ingenierias'),
(4, 'Ingenieria Agronomica', 'Facultad de Ingenierias'),
(5, 'Ingenieria Ambiental', 'Facultad de Ingenierias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `identificacion` int(20) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tipo_user` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `programa` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`identificacion`, `nombres`, `apellidos`, `email`, `tipo_user`, `username`, `password`, `programa`, `activo`) VALUES
(1003177448, 'Jose Alberto', 'De Hoyos Dominguez', 'josealbertodhd@gmail.com', 'Administrativo', 'Jdehoyosdomingues48', '616715', 'Ingenieria de Sistemas', 0),
(2147483647, 'Jose Alberto', 'De Hoyos Dominguez', 'josealbertodhd@gmail.com', 'Administrativo', 'userJose', '$2y$10$ckfnK5JimCSAC9Y.mkfkh.dh2YACyBY3kbyed8Qn6K7UV/O7JgtBC', 'Ingenieria de Sistemas', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`id_acta`);

--
-- Indices de la tabla `compromisos`
--
ALTER TABLE `compromisos`
  ADD PRIMARY KEY (`id_compromiso`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta`
--
ALTER TABLE `acta`
  MODIFY `id_acta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compromisos`
--
ALTER TABLE `compromisos`
  MODIFY `id_compromiso` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

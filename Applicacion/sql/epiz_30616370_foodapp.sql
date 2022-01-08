-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql310.epizy.com
-- Tiempo de generación: 06-01-2022 a las 17:41:39
-- Versión del servidor: 5.7.36-39
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epiz_30616370_foodapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicaplato`
--

CREATE TABLE `caracteristicaplato` (
  `idCaracteristica` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(60) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `caracteristicaplato`
--

INSERT INTO `caracteristicaplato` (`idCaracteristica`, `nombre`, `descripcion`) VALUES
(1, 'Gluten', 'El plato contiene gluten y/o derivados'),
(2, 'Picante', 'El plato contiene picante'),
(3, 'Vegano', 'El plato es apto para veganos'),
(4, 'Azucar', 'El plato tiene alto contenido de azucar'),
(5, 'Sal', 'El plato tiene alto contenido de sodio'),
(7, 'Lacteos', 'El plato contiene lacteos y/o derivados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicasitio`
--

CREATE TABLE `caracteristicasitio` (
  `idCaracteristica` int(10) NOT NULL,
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(60) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `caracteristicasitio`
--

INSERT INTO `caracteristicasitio` (`idCaracteristica`, `nombre`, `descripcion`) VALUES
(1, 'wifi', 'Si el local tiene wifi'),
(2, 'wheelchair', 'Si el local es accesible'),
(3, 'aireacondicionado', 'Si el local tiene aire acondicionado'),
(4, 'estacionamiento', 'Si el local tiene estacionamiento'),
(5, 'tv', 'Si el local tiene tv'),
(6, 'juegos', 'Si el local tiene juegos para niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`) VALUES
(1, 'Parrilla'),
(2, 'Pizzeria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariositios`
--

CREATE TABLE `comentariositios` (
  `idComentario` int(11) NOT NULL,
  `idSitio` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `mail` text COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valoracionSabor` int(11) NOT NULL,
  `valoracionPrecio` int(11) NOT NULL,
  `valoracionAmbiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `comentariositios`
--

INSERT INTO `comentariositios` (`idComentario`, `idSitio`, `nombre`, `mail`, `descripcion`, `fecha`, `valoracionSabor`, `valoracionPrecio`, `valoracionAmbiente`) VALUES
(1, 1, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(2, 1, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(3, 2, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(4, 1, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(5, 1, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(6, 1, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(7, 1, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(8, 1, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(9, 1, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(10, 1, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(11, 2, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(12, 2, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(13, 2, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(14, 2, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(15, 2, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(16, 2, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(17, 2, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(18, 2, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(19, 2, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(20, 2, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(21, 3, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(22, 3, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(23, 3, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(24, 3, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(25, 3, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(26, 3, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(27, 3, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(28, 3, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(29, 3, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(30, 3, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(31, 4, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(32, 4, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(33, 4, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(34, 4, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(35, 4, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(36, 4, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(37, 4, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(38, 4, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(39, 4, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(40, 4, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(41, 5, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(42, 5, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(43, 5, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(44, 5, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(45, 5, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(46, 5, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(47, 5, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(48, 5, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(49, 5, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(50, 5, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(61, 6, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(62, 6, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(63, 6, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(64, 6, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(65, 6, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(66, 6, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(67, 6, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(68, 6, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(69, 6, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(70, 6, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(71, 7, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06 03:00:00', 1, 1, 3),
(72, 7, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02 03:00:00', 1, 3, 2),
(73, 7, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12 03:00:00', 4, 4, 4),
(74, 7, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 3, 3, 3),
(75, 7, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 2, 2, 2),
(76, 7, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 4, 4, 4),
(77, 7, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 5, 5),
(78, 7, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 5, 2, 2),
(79, 7, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1),
(80, 7, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06 03:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `idConsulta` int(11) NOT NULL,
  `mail` text COLLATE latin1_spanish_ci NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `apellido` text COLLATE latin1_spanish_ci NOT NULL,
  `mensaje` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` bigint(20) UNSIGNED NOT NULL,
  `idSitio` int(11) NOT NULL,
  `idDia` int(11) NOT NULL,
  `HDesde` int(11) NOT NULL,
  `HHasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `idSitio`, `idDia`, `HDesde`, `HHasta`) VALUES
(1, 1, 5, 19, 23),
(2, 1, 6, 19, 23),
(3, 1, 7, 11, 15),
(4, 2, 6, 10, 20),
(5, 2, 7, 10, 20),
(6, 3, 1, 11, 23),
(7, 3, 2, 11, 23),
(8, 3, 3, 11, 23),
(9, 3, 4, 11, 23),
(10, 3, 5, 10, 23),
(11, 4, 2, 19, 23),
(12, 4, 3, 19, 23),
(13, 4, 4, 10, 20),
(14, 4, 5, 11, 15),
(15, 4, 6, 10, 20),
(16, 5, 7, 19, 23),
(17, 5, 1, 19, 23),
(18, 5, 2, 10, 20),
(19, 5, 3, 11, 15),
(20, 5, 4, 10, 20),
(21, 6, 1, 19, 23),
(22, 6, 2, 19, 23),
(23, 6, 3, 10, 20),
(24, 6, 4, 11, 15),
(25, 6, 5, 10, 20),
(26, 7, 3, 19, 23),
(27, 7, 4, 19, 23),
(28, 7, 5, 10, 20),
(29, 7, 6, 11, 15),
(30, 7, 7, 10, 20),
(31, 8, 1, 12, 16),
(32, 8, 2, 12, 16),
(33, 8, 3, 12, 16),
(34, 8, 4, 12, 16),
(35, 8, 5, 12, 16),
(36, 8, 6, 12, 16),
(37, 8, 7, 12, 16),
(38, 9, 1, 10, 18),
(39, 9, 2, 10, 18),
(40, 9, 3, 10, 18),
(41, 9, 4, 10, 18),
(42, 9, 5, 10, 18),
(43, 9, 6, 10, 18),
(44, 10, 4, 9, 23),
(45, 10, 5, 9, 23),
(46, 10, 6, 9, 23),
(47, 10, 7, 9, 23),
(48, 11, 4, 18, 23),
(49, 11, 5, 18, 23),
(50, 11, 6, 18, 23),
(51, 11, 7, 18, 23),
(52, 12, 1, 12, 16),
(53, 12, 2, 12, 16),
(54, 12, 3, 12, 16),
(55, 12, 4, 12, 16),
(56, 12, 5, 12, 16),
(57, 12, 6, 12, 16),
(58, 12, 7, 12, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesplatos`
--

CREATE TABLE `imagenesplatos` (
  `idImagen` bigint(20) UNSIGNED NOT NULL,
  `idPlato` int(11) NOT NULL,
  `path` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `imagenesplatos`
--

INSERT INTO `imagenesplatos` (`idImagen`, `idPlato`, `path`) VALUES
(1, 1, '/private/plates/1/empanadas.jpg'),
(2, 2, '/private/plates/1/ravioles.jpg'),
(3, 3, '/private/plates/1/pollo.jpg'),
(4, 4, '/private/plates/1/flan.jpg'),
(5, 5, '/private/plates/2/empanadas.jpg'),
(6, 6, '/private/plates/2/ravioles.jpg'),
(7, 7, '/private/plates/2/pollo.jpg'),
(8, 8, '/private/plates/2/flan.jpg'),
(9, 9, '/private/plates/3/empanadas.jpg'),
(10, 10, '/private/plates/3/pollo.jpg'),
(11, 11, '/private/plates/3/ravioles.jpg'),
(12, 12, '/private/plates/3/flan.jpg'),
(13, 13, '/private/plates/4/empanadas.jpg'),
(14, 14, '/private/plates/4/pollo.jpg'),
(15, 15, '/private/plates/4/ravioles.jpg'),
(16, 16, '/private/plates/4/flan.jpg'),
(17, 17, '/private/plates/5/empanadas.jpg'),
(18, 18, '/private/plates/5/pollo.jpg'),
(19, 19, '/private/plates/5/ravioles.jpg'),
(20, 20, '/private/plates/5/flan.jpg'),
(21, 21, '/private/plates/6/empanadas.jpg'),
(22, 22, '/private/plates/6/pollo.jpg'),
(23, 23, '/private/plates/6/ravioles.jpg'),
(24, 24, '/private/plates/6/flan.jpg'),
(25, 25, '/private/plates/7/empanadas.jpg'),
(26, 26, '/private/plates/7/pollo.jpg'),
(27, 27, '/private/plates/7/ravioles.jpg'),
(28, 28, '/private/plates/7/flan.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenessitios`
--

CREATE TABLE `imagenessitios` (
  `idImagen` bigint(20) UNSIGNED NOT NULL,
  `idSitio` int(11) NOT NULL,
  `path` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `imagenessitios`
--

INSERT INTO `imagenessitios` (`idImagen`, `idSitio`, `path`) VALUES
(1, 1, '/private/sites/1/1.jpg'),
(2, 2, '/private/sites/2/40.jpg'),
(3, 1, '/private/sites/1/2.jpg'),
(4, 2, '/private/sites/2/25.jpg'),
(5, 3, '/private/sites/3/1.jpg'),
(6, 4, '/private/sites/4/1.jpg'),
(7, 5, '/private/sites/5/1.jpg'),
(8, 6, '/private/sites/6/1.jpg'),
(9, 7, '/private/sites/7/1.jpg'),
(10, 8, '/private/sites/8//portada establo.png'),
(11, 8, '/private/sites/8//unnamed.png'),
(12, 9, '/private/sites/9//07.jpg'),
(13, 9, '/private/sites/9//01.jpg'),
(14, 10, '/private/sites/10//01.jpg'),
(15, 10, '/private/sites/10//07.jpg'),
(16, 11, '/private/sites/11//Cerveceria-lujan-1-patio.jpg'),
(17, 11, '/private/sites/11//IMG-20210830-WA0216-barra-fondo-patio-SI-scaled.jpeg'),
(18, 12, '/private/sites/12//02.png'),
(19, 12, '/private/sites/12//01.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infonutricional`
--

CREATE TABLE `infonutricional` (
  `idInfo` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `infonutricional`
--

INSERT INTO `infonutricional` (`idInfo`, `nombre`) VALUES
(1, 'Peso'),
(2, 'Energia'),
(3, 'Carbohidratos'),
(4, 'Proteina'),
(5, 'Grasas'),
(6, 'Sodio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacaractplato`
--

CREATE TABLE `listacaractplato` (
  `idListaCaract` bigint(20) UNSIGNED NOT NULL,
  `idPlato` int(11) NOT NULL,
  `idCaract` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `listacaractplato`
--

INSERT INTO `listacaractplato` (`idListaCaract`, `idPlato`, `idCaract`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 4),
(5, 5, 1),
(6, 6, 1),
(7, 7, 5),
(8, 8, 1),
(9, 9, 2),
(10, 10, 1),
(11, 11, 3),
(12, 12, 2),
(13, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacaractsitio`
--

CREATE TABLE `listacaractsitio` (
  `idListaCaract` bigint(20) UNSIGNED NOT NULL,
  `idSitio` int(11) NOT NULL,
  `idCaract` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `listacaractsitio`
--

INSERT INTO `listacaractsitio` (`idListaCaract`, `idSitio`, `idCaract`) VALUES
(7, 3, 1),
(13, 4, 1),
(20, 5, 1),
(26, 6, 1),
(33, 7, 1),
(39, 8, 1),
(43, 9, 1),
(50, 11, 1),
(54, 12, 1),
(1, 2, 2),
(8, 3, 2),
(14, 4, 2),
(21, 5, 2),
(27, 6, 2),
(34, 7, 2),
(44, 9, 2),
(51, 11, 2),
(55, 12, 2),
(2, 1, 3),
(3, 2, 3),
(9, 3, 3),
(15, 4, 3),
(22, 5, 3),
(28, 6, 3),
(35, 7, 3),
(40, 8, 3),
(45, 9, 3),
(46, 10, 3),
(52, 11, 3),
(56, 12, 3),
(4, 2, 4),
(10, 3, 4),
(16, 4, 4),
(23, 5, 4),
(29, 6, 4),
(36, 7, 4),
(41, 8, 4),
(47, 10, 4),
(53, 11, 4),
(57, 12, 4),
(5, 1, 5),
(11, 3, 5),
(17, 4, 5),
(24, 5, 5),
(30, 6, 5),
(37, 7, 5),
(42, 8, 5),
(48, 10, 5),
(58, 12, 5),
(6, 2, 6),
(12, 3, 6),
(19, 4, 6),
(25, 5, 6),
(31, 6, 6),
(38, 7, 6),
(49, 10, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `idPlato` int(11) NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `precio` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `idSitio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`idPlato`, `nombre`, `descripcion`, `precio`, `idSitio`) VALUES
(1, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 1),
(2, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 1),
(3, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 1),
(4, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 1),
(5, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 2),
(6, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 2),
(7, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 2),
(8, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 2),
(9, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 3),
(10, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 3),
(11, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 3),
(12, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 3),
(13, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 4),
(14, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 4),
(15, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 4),
(16, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 4),
(17, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 5),
(18, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 5),
(19, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 5),
(20, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 5),
(21, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 6),
(22, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 6),
(23, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 6),
(24, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 6),
(25, 'Empanadas de carne', 'Una empanada es una fina masa de pan, masa quebrada u hojaldre rellena con una preparación salada o dulce y cocida al horno o frita. El relleno puede incluir carnes rojas o blancas, pescado, verduras o fruta.', '0', 7),
(26, 'Pollo al horno ', 'El pollo asado, rostizado, en brasas o a la brasa es un plato genérico elaborado con un pollo expuesto directamente al fuego, que puede provenir de un hogar casero, hasta el asador profesional rotatorio.', '0', 7),
(27, 'Ravioles', 'Ravioli es el nombre de un tipo de pasta italiana rellena con diferentes ingredientes, generalmente replegada en forma cuadrada. Se acompañan de algún tipo de salsa, en especial de tomate, tucos, pesto o cremas.', '0', 7),
(28, 'Queremos Flan', 'El flan, también llamado quesillo, es un postre hecho con una natilla que se prepara con huevos enteros, leche y azúcar, que luego es refrigerada para obtener una textura cremosa y gelatinosa.', '0', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semanasdias`
--

CREATE TABLE `semanasdias` (
  `idDia` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `semanasdias`
--

INSERT INTO `semanasdias` (`idDia`, `nombre`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE `sitios` (
  `idSitio` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `telefono` text COLLATE latin1_spanish_ci NOT NULL,
  `sitioWeb` text COLLATE latin1_spanish_ci NOT NULL,
  `valoracionPrecio` int(11) DEFAULT NULL,
  `valoracionAmbiente` int(11) DEFAULT NULL,
  `valoracionSabor` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sitios`
--

INSERT INTO `sitios` (`idSitio`, `nombre`, `descripcion`, `telefono`, `sitioWeb`, `valoracionPrecio`, `valoracionAmbiente`, `valoracionSabor`, `idUsuario`, `idCategoria`) VALUES
(1, 'La Protegida', 'Durante el siglo XIX, los vecinos de Navarro contaban con varios servicos de diligencias que unía a éste con la gran aldea de Buenos Aires y con pueblo y parajes vecinos. En épocas en que los caminos eran sólo huellas, aquellas diligencias sirvieron al transporte de correspondencia, encomiendas y pasajeros, convirtiéndose en indispensables actores de desarrollo para los incipientes vecindarios afincados en el medio de la inhóspita pampa. \"LA PROTEGIDA\" era una de aquellas compañias de diligencias, que en el siglo XIX trasnportaba sus cargas desde Buenos Aires a Navarro. Ya avanzado el siglo XX , a principios de la década del 70, en la ciudad de Navarro cerraba definitivamente el almacén de ramos generales del \"Turco Emilio\".Este señero almacén, fundado en 1926 por el inmigrante sirio-libanés Abdul \"Emilio\" Mustafá, había cumplido un importante ciclo en la historia comercial de la comunidad, pero superado por nuevos pautas económicas cesó en su actividad, alquilando su edificio para sucesivos y diferentes emprendimientos comerciales.......Coincidente con ese tiempo, un joven de -por entonces- 15 años, comienzó a interesarse por objetos antiguos y artículos de viejos almacenes y pulpería de su pueblo; iniciando así, una colección que perdura hasta estos días. Hoy, estas tres historias independientes se conjugan y de la fusión de aquel viejo edificio del almacén del \"Turco\" Emilio más la copiosa colección lograda en más de 35 años por aquel jóven y el nombre de aquella legendaria diligencia surge a nosotros el \"Almacén Museo LA PROTEGIDA\" como un símbolo de buena combinación de Turismo, Gastronomía y Cultura regional.', '+549 2324 580678 ', 'consultas@laprotegida.com', 0, 0, 0, 1, 1),
(2, 'La Lechuza', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(3, 'Brook', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(4, 'Paprika', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(5, 'Cuando quieras', 'Cuando Quieras nació en el año 2006 con un deseo: crear helados que les haga sentir felicidad y hacerlos sonreír.\r\n\r\nLa vida está hecha de momentos compartidos y queremos que nuestros productos los acompañen en su mesa en todos sus festejos y reuniones. Para lograrlo, elaboramos helados con pasión, amor, profesionalismo y productos de la mejor calidad.\r\n\r\nSomos una Pyme que creamos una pareja de apasionados emprendedores que comenzamos nuestros sueños allá por el 99 y hoy somos una hermosa familia con tres preciosos hijos, pero también llamamos hijos a nuestras sucursales, así que somos una familia muy numerosa.\r\n\r\nNo fue fácil el inicio, fuimos aprendiendo mucho y también de ustedes, nuestros clientes, por eso les agradecemos estos catorce años de acompañamiento y que constantemente mejorando para brindarles lo mejor.', '+549 2272 40326 ', 'https://www.cuandoquierashelados.com.ar/', 0, 0, 0, 1, 1),
(6, 'Restaurante Buenos Aires', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(7, 'Pizzeria la Trentina', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(8, 'El Establo', 'El Establo es un restaurante con parrilla y asador criollo pionero en su estilo tradicional que abrió sus puertas en Luján hace 23 años. Tanto sus dueños como el personal trabajan cada día para que sus comensales puedan disfrutar de la mejor opción en la zona. Es por eso que, si bien el énfasis está puesto en servir las mejores carnes, achuras y embutidos de gran calidad, también El Establo ofrece nuevas propuestas gastronómicas y se adapta a las preferencias o necesidades de cada cliente.', '02323 43-0320', 'cdac@mail.com', NULL, NULL, NULL, 1, 1),
(9, 'Restaurant 1800', 'Esta casa fue construida antes de 1741. Esta señalada en el original de la traza del plano del pueblo de Lujan. Queda probado que en el año 1741 el gobernador Salcedo incio gestión de la designación del pueblo o Villa del Lujan, respondiendo a las solicitudes del vecindario que deseaba agruparse para defenderse mejor de las invasiones indígenas y de salteadores desertores que asolaban la campana y para tal fin obtuvo el acuerdo de la propietaria de estas tierras donde se determinó el trazado e hizo donación de las tierras necesarias para el poblado y una manzana para una plaza frente a la capilla. En 1755 por Real Cedula se le da el nombre de Villa de Lujan al caserio, estaba defendida por una compañía de milicianos llamados Blandegues, que tenían asiento en esta casa, su objetivo principal era la defensa contra los indios, prestar guardias a las carretas en las expediciones a las salinas y perseguir a los cuatreros y desertores que deambulaban por la zona. La puerta principal de la casa se hallaba sobre la calle Rivadavia, allí en el techo, aun se observa intacta una puerta trapa para acceder y así defenderse de los malones y bandas de asaltantes. Las paredes interiores están revocadas en adobe. En 1875, cuando se procede a un nuevo trazado de la Villa, la casa quedo 90 cm dentro del terreno y a puerta se ubico en la ochava. Para esta época existía en el lugar una casa de citas donde se divertían los lugareños. La municipalidad ordeno su clausura.', '02323-433080', 'cdac@mail.com', NULL, NULL, NULL, 1, 1),
(10, 'Futomaki', 'Futomaki es un espacio al mejor estilo japonés que mantiene el equilibrio entre oriente y occidente, respetando la cultura japonesa y tomando en cuenta las costumbres de nuestro paladar.\r\n\r\nAbrimos nuestras puertas el 20 de Julio de 2006, acercando sabores orientales a la zona Oeste del Gran Buenos Aires. Luego de dos años inauguramos un nuevo local en la ciudad de Luján, siendo una de los pocos emprendimientos gastronómicos de la zona.\r\n\r\nDurante el año operamos dos puntos de venta de temporada, uno en Las Leñas, Mendoza y otro en Garopaba, Brasil.', '02323-438197', 'cdac@mail.com', NULL, NULL, NULL, 1, 1),
(11, ' 1516 Cervecería', 'El 23 de abril del año 1516, durante un encuentro de nobleza bávara en la ciudad de Ingoldstadt, junto al río Danubio, el duque Guillermo IV de Babiera promulgó la primer ley de pureza de la cerveza, para regular su producción. Dicha ley establece que la cerveza debe ser elaborada en base a tres ingredientes: agua, cebada y lúpulo. Se cree que es la ley más antigua en el ámbito del derecho de alimentos. La ley en su creación no mencionaba la levadura, que es esencial para el proceso de fermentación y fue descubierta en 1880 por Luis Pasteur. Antes de conocer el mecanismo de fermentación, los cerveceros usualmente tomaban el sedimento de una fermentación una serie de vasijas y en el proceso aparecía “por sí sola” la levadura. Se dice que la principal motivación que tuvo Guillermo IV para promulgar la ley se debía a que tenía el monopolio de la cebada; de esta manera, al no poder comprarle a nadie más un ingrediente básico para la elaboración, no solo aumento sus ventas sino también el precio ya que no tenia otros competidores de cereales.', '11.3698.1845', 'lujan@1516cervecerialujan.com', NULL, NULL, NULL, 1, 1),
(12, 'Berto - Cocina de Autor', 'Detené tu tiempo es el concepto que acompaña a Berto, un restaurant de cocina de autor concebido para ir a disfrutar, sin pensar en otra cosa que vivir el momento.\r\nEn Berto hacemos gastronomía con mucha dedicación, nuestra cocina es el lugar donde logramos que cada producto que usamos nos dé lo mejor de sí, combinándolos a nuestra manera de ver y entender la cocina.\r\n\r\nEn nuestra carta apreciaran sabores muy marcados, combinaciones pensadas, mucha elaboración usando técnicas tanto modernas como clásicas, donde cada uno de nuestros platos lleva nuestra firma, nuestro propio estilo.\r\nContamos con una justa variedad de principales y postres los cuales cambiamos estacionalmente y otros van quedando como clásicos!\r\n\r\nEn la cortesía de la casa, ofrecemos una variedad de elaboraciones de diferentes productos de estación para que degusten de algo casero y rico.\r\nAcompañamos nuestra propuesta con una carta de vinos jóvenes y seleccionados de primera calidad.\r\n\r\nCon respecto a la atención ofrecemos un servicio cálido y personalizado acorde a nuestra gastronomía.\r\n\r\nTodo esto es logrado gracias al gran equipo que está detrás de cada detalle, siendo críticos, teniendo en claro su objetivo y aprendiendo todos los días un poco más de nuestra pasión.', '02323-421106', 'reservas@berto.com.ar', NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `idUbicacion` int(11) NOT NULL,
  `idSitio` int(11) NOT NULL,
  `direccion` text COLLATE latin1_spanish_ci NOT NULL,
  `ciudad` text COLLATE latin1_spanish_ci NOT NULL,
  `provincia` text COLLATE latin1_spanish_ci NOT NULL,
  `X` text COLLATE latin1_spanish_ci NOT NULL,
  `Y` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`idUbicacion`, `idSitio`, `direccion`, `ciudad`, `provincia`, `X`, `Y`) VALUES
(1, 1, 'Calle 19 esquina 30', 'Navarro ', 'Buenos Aires', '-35.00033238593366', '-59.272647442288545'),
(2, 2, 'Cuartel V', 'Navarro ', 'Buenos Aires', '-35.071894', '-59.296785'),
(3, 3, 'Calle 16 894', 'Navarro ', 'Buenos Aires', '-35.0064567', '-59.2699105'),
(4, 4, 'Calle 109 102', 'Navarro', 'Buenos Aires', '-35.0067437', '-59.2783453'),
(5, 5, 'Calle 7 esquina 26', 'Navarro ', 'Buenos Aires', '-35.0045029', '-59.2798072'),
(6, 6, 'Calle 19 esquina 30', 'Navarro ', 'Buenos Aires', '-35.0046192', '-59.2767539'),
(7, 7, 'Calle 109 e/ 22 y 24 N 17', 'Navarro ', 'Buenos Aires', '-35.0053804', '-59.2780874'),
(8, 8, 'Av. Ntra. Sra de Luján y Rotonda (ex) Ruta 7', 'Luján', 'Buenos Aires', '-34.5553055', '-59.1186489'),
(9, 9, ' Rivadavia 705', 'Lujan', 'Buenos Aires', '-34.5583653', '-59.1165272'),
(10, 10, 'Francia 604', 'Luján', 'Buenos Aires', '-34.5600821', '-59.1194878'),
(11, 11, 'Mariano Moreno 1274', 'Luján ', 'Buenos Aires', '-34.5683842', '-59.1149776'),
(12, 12, 'Av. Humberto Primo 1113', 'Luján', 'Buenos Aires', '-34.5636841', '-59.118971');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `mail` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `nombreUsuario` text COLLATE latin1_spanish_ci NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `apellido` text COLLATE latin1_spanish_ci NOT NULL,
  `direccion` text COLLATE latin1_spanish_ci,
  `pais` text COLLATE latin1_spanish_ci NOT NULL,
  `telefono` text COLLATE latin1_spanish_ci NOT NULL,
  `password` text COLLATE latin1_spanish_ci NOT NULL,
  `fotoPerfil` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `mail`, `nombreUsuario`, `nombre`, `apellido`, `direccion`, `pais`, `telefono`, `password`, `fotoPerfil`) VALUES
(1, 'costaivan34@gmail.com', 'costaivan34', 'Iván', 'Costa', 'Calle 123, enmicasa', 'Argentina', '0', '25f9e794323b453885f5181f1b624d0b', '/private/users/costaivan34@gmail.com/perfil.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valornutricional`
--

CREATE TABLE `valornutricional` (
  `idValor` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `idInfo` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `valornutricional`
--

INSERT INTO `valornutricional` (`idValor`, `idPlato`, `idInfo`, `valor`) VALUES
(1, 1, 2, 1102),
(2, 1, 3, 20),
(3, 1, 5, 17),
(4, 1, 1, 60),
(5, 1, 4, 6),
(6, 1, 6, 193),
(7, 2, 2, 1102),
(8, 2, 3, 20),
(9, 2, 5, 17),
(10, 2, 1, 60),
(11, 2, 4, 6),
(12, 2, 6, 193),
(13, 3, 2, 1102),
(14, 3, 3, 20),
(15, 3, 5, 17),
(16, 3, 1, 60),
(17, 3, 4, 6),
(18, 3, 6, 193),
(19, 4, 2, 1102),
(19, 5, 4, 6),
(20, 4, 3, 20),
(21, 4, 5, 17),
(22, 4, 1, 60),
(23, 4, 4, 6),
(24, 4, 6, 193),
(25, 5, 2, 1102),
(26, 5, 3, 20),
(27, 5, 5, 17),
(28, 5, 1, 60),
(30, 5, 6, 193),
(31, 6, 2, 1102),
(32, 6, 3, 20),
(33, 6, 5, 17),
(34, 6, 1, 60),
(35, 6, 4, 6),
(36, 6, 6, 193),
(37, 7, 2, 1102),
(38, 7, 3, 20),
(39, 7, 5, 17),
(40, 7, 1, 60),
(41, 7, 4, 6),
(42, 7, 6, 193),
(43, 8, 2, 1102),
(44, 8, 3, 20),
(45, 8, 5, 17),
(46, 8, 1, 60),
(47, 8, 4, 6),
(48, 8, 6, 193),
(49, 9, 2, 1102),
(50, 9, 3, 20),
(51, 9, 5, 17),
(52, 9, 1, 60),
(53, 9, 4, 6),
(54, 9, 6, 193),
(55, 10, 2, 1102),
(56, 10, 3, 20),
(57, 10, 5, 17),
(58, 10, 1, 60),
(59, 10, 4, 6),
(60, 10, 6, 193),
(61, 11, 2, 1102),
(62, 11, 3, 20),
(63, 11, 5, 17),
(64, 11, 1, 60),
(65, 11, 4, 6),
(66, 11, 6, 193),
(67, 12, 2, 1102),
(68, 12, 3, 20),
(69, 12, 5, 17),
(70, 12, 1, 60),
(71, 12, 4, 6),
(72, 12, 6, 193),
(73, 12, 2, 1102),
(74, 12, 3, 20),
(75, 12, 5, 17),
(76, 12, 1, 60),
(77, 12, 4, 6),
(78, 12, 6, 193);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicaplato`
--
ALTER TABLE `caracteristicaplato`
  ADD PRIMARY KEY (`idCaracteristica`);

--
-- Indices de la tabla `caracteristicasitio`
--
ALTER TABLE `caracteristicasitio`
  ADD PRIMARY KEY (`idCaracteristica`),
  ADD KEY `idCaracteristica` (`idCaracteristica`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `comentariositios`
--
ALTER TABLE `comentariositios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `comentariositios_ibfk_1` (`idSitio`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`idConsulta`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`,`idSitio`),
  ADD KEY `idPlato` (`idSitio`),
  ADD KEY `horario_ibfk_2` (`idDia`);

--
-- Indices de la tabla `imagenesplatos`
--
ALTER TABLE `imagenesplatos`
  ADD PRIMARY KEY (`idImagen`,`idPlato`),
  ADD UNIQUE KEY `idImagen` (`idImagen`),
  ADD KEY `idPlato` (`idPlato`);

--
-- Indices de la tabla `imagenessitios`
--
ALTER TABLE `imagenessitios`
  ADD PRIMARY KEY (`idImagen`,`idSitio`),
  ADD UNIQUE KEY `idImagen` (`idImagen`),
  ADD KEY `idSitio` (`idSitio`);

--
-- Indices de la tabla `infonutricional`
--
ALTER TABLE `infonutricional`
  ADD PRIMARY KEY (`idInfo`);

--
-- Indices de la tabla `listacaractplato`
--
ALTER TABLE `listacaractplato`
  ADD PRIMARY KEY (`idCaract`,`idPlato`),
  ADD UNIQUE KEY `idListaCaract` (`idListaCaract`),
  ADD KEY `idPlato` (`idPlato`),
  ADD KEY `listacaractplato_ibfk_222` (`idCaract`);

--
-- Indices de la tabla `listacaractsitio`
--
ALTER TABLE `listacaractsitio`
  ADD PRIMARY KEY (`idListaCaract`,`idSitio`),
  ADD UNIQUE KEY `idListaCaract` (`idListaCaract`),
  ADD KEY `idSitio` (`idSitio`),
  ADD KEY `idCaract` (`idCaract`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`idPlato`),
  ADD KEY `idSitio` (`idSitio`);

--
-- Indices de la tabla `semanasdias`
--
ALTER TABLE `semanasdias`
  ADD PRIMARY KEY (`idDia`);

--
-- Indices de la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD PRIMARY KEY (`idSitio`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `categorias_ibfk_1` (`idCategoria`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`idUbicacion`,`idSitio`),
  ADD KEY `idSitio` (`idSitio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `valornutricional`
--
ALTER TABLE `valornutricional`
  ADD PRIMARY KEY (`idValor`,`idPlato`),
  ADD KEY `idPlato` (`idPlato`),
  ADD KEY `valornutricional_ibfk_1` (`idInfo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicaplato`
--
ALTER TABLE `caracteristicaplato`
  MODIFY `idCaracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `caracteristicasitio`
--
ALTER TABLE `caracteristicasitio`
  MODIFY `idCaracteristica` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentariositios`
--
ALTER TABLE `comentariositios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `idConsulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `imagenesplatos`
--
ALTER TABLE `imagenesplatos`
  MODIFY `idImagen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `imagenessitios`
--
ALTER TABLE `imagenessitios`
  MODIFY `idImagen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `infonutricional`
--
ALTER TABLE `infonutricional`
  MODIFY `idInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `listacaractplato`
--
ALTER TABLE `listacaractplato`
  MODIFY `idListaCaract` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `listacaractsitio`
--
ALTER TABLE `listacaractsitio`
  MODIFY `idListaCaract` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `idPlato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `sitios`
--
ALTER TABLE `sitios`
  MODIFY `idSitio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `idUbicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `valornutricional`
--
ALTER TABLE `valornutricional`
  MODIFY `idValor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

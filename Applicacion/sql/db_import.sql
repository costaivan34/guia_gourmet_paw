-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2021 a las 22:09:12
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foodapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicaplato`
--

CREATE TABLE `caracteristicaplato` (
  `idCaracteristica` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
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
  `nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
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
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
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
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `mail` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `valoracionSabor` int(11) NOT NULL,
  `valoracionPrecio` int(11) NOT NULL,
  `valoracionAmbiente` int(11) NOT NULL
)  ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Disparadores `comentariositios`
--
DELIMITER $$
CREATE TRIGGER `upd_comentarios_bi` BEFORE INSERT ON `comentariositios` FOR EACH ROW set NEW.fecha = NOW()
$$
DELIMITER ;

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



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesplatos`
--

CREATE TABLE `imagenesplatos` (
  `idImagen` bigint(20) UNSIGNED NOT NULL,
  `idPlato` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `path` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `imagenesplatos`
--

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



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infonutricional`
--

CREATE TABLE `infonutricional` (
  `idInfo` int(11) NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
-- --------------------------------------------------------
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacaractsitio`
--

CREATE TABLE `listacaractsitio` (
  `idListaCaract` bigint(20) UNSIGNED NOT NULL,
  `idSitio` int(11) NOT NULL,
  `idCaract` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `idPlato` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `precio` text COLLATE latin1_spanish_ci NOT NULL,
  `idSitio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
  `valoracionPrecio` int(11) NOT NULL,
  `valoracionAmbiente` int(11) NOT NULL,
  `valoracionSabor` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `mail` varchar(60) COLLATE latin1_spanish_ci NOT NULL UNIQUE,
  `nombreUsuario` text COLLATE latin1_spanish_ci NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `apellido` text COLLATE latin1_spanish_ci NOT NULL,
  `direccion` text COLLATE latin1_spanish_ci NOT NULL,
  `pais` text COLLATE latin1_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `password` text COLLATE latin1_spanish_ci NOT NULL,
  `fotoPerfil` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
  ADD PRIMARY KEY (`idListaCaract`,`idPlato`),
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
  ADD PRIMARY KEY (`idUsuario`);

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
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `idConsulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenesplatos`
--
ALTER TABLE `imagenesplatos`
  MODIFY `idImagen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagenessitios`
--
ALTER TABLE `imagenessitios`
  MODIFY `idImagen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `infonutricional`
--
ALTER TABLE `infonutricional`
  MODIFY `idInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `listacaractplato`
--
ALTER TABLE `listacaractplato`
  MODIFY `idListaCaract` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `listacaractsitio`
--
ALTER TABLE `listacaractsitio`
  MODIFY `idListaCaract` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `idPlato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `semanasdias`
--
ALTER TABLE `semanasdias`
  MODIFY `idDia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sitios`
--
ALTER TABLE `sitios`
  MODIFY `idSitio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `idUbicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `valornutricional`
--
ALTER TABLE `valornutricional`
  MODIFY `idValor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentariositios`
--
ALTER TABLE `comentariositios`
  ADD CONSTRAINT `comentariositios_ibfk_1` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`),
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`idDia`) REFERENCES `semanasdias` (`idDia`);

--
-- Filtros para la tabla `imagenesplatos`
--
ALTER TABLE `imagenesplatos`
  ADD CONSTRAINT `imagenesplatos_ibfk_1` FOREIGN KEY (`idPlato`) REFERENCES `platos` (`idPlato`);

--
-- Filtros para la tabla `imagenessitios`
--
ALTER TABLE `imagenessitios`
  ADD CONSTRAINT `imagenessitios_ibfk_1` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`);

--
-- Filtros para la tabla `listacaractplato`
--
ALTER TABLE `listacaractplato`
  ADD CONSTRAINT `listacaractplato_ibfk_2` FOREIGN KEY (`idPlato`) REFERENCES `platos` (`idPlato`),
  ADD CONSTRAINT `listacaractplato_ibfk_222` FOREIGN KEY (`idCaract`) REFERENCES `caracteristicaplato` (`idCaracteristica`);

--
-- Filtros para la tabla `listacaractsitio`
--
ALTER TABLE `listacaractsitio`
  ADD CONSTRAINT `listacaractsitio_ibfk_2` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`),
  ADD CONSTRAINT `listacaractsitio_ibfk_4` FOREIGN KEY (`idCaract`) REFERENCES `caracteristicasitio` (`idCaracteristica`);

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`);

--
-- Filtros para la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `sitios_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `Ubicacion_ibfk_1` FOREIGN KEY (`idSitio`) REFERENCES `sitios` (`idSitio`);

--
-- Filtros para la tabla `valornutricional`
--
ALTER TABLE `valornutricional`
  ADD CONSTRAINT `valornutricional_ibfk_1` FOREIGN KEY (`idInfo`) REFERENCES `infonutricional` (`idInfo`),
  ADD CONSTRAINT `valornutricional_ibfk_2` FOREIGN KEY (`idPlato`) REFERENCES `platos` (`idPlato`);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

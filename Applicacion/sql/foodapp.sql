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
CREATE SCHEMA foodapp;
--
-- Estructura de tabla para la tabla `caracteristicaplato`
--
USE foodapp;
CREATE TABLE `caracteristicaplato` (
  `idCaracteristica` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentariositios`
--

INSERT INTO `comentariositios` (`idComentario`, `idSitio`, `nombre`, `mail`, `descripcion`, `fecha`, `valoracionSabor`, `valoracionPrecio`, `valoracionAmbiente`) VALUES
(1, 1, 'carlos', '', 'muy lindo lugar', '2021-02-02', 1, 1, 3),
(2, 1, 'asdasd', '', 'asdadasd', '2021-02-02', 1, 3, 2),
(3, 2, 'Susana', '', 'que lindo dia de campo pasamos con los chicos', '2021-02-12', 4, 4, 4),
(4, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'zxczxczxczxc', '0000-00-00', 3, 3, 3),
(5, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'qwerqewrqwrqwr', '0000-00-00', 2, 2, 2),
(6, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'aaaaaaaaaaaa', '0000-00-00', 4, 4, 4),
(7, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'FFFFFFFFFFFFFFFFFFFFFFFF', '0000-00-00', 5, 5, 5),
(8, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'ggggggggggg', '0000-00-00', 5, 2, 2),
(9, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'ccccccccccccccccc', '0000-00-00', 1, 1, 1),
(10, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'wwwwwwwwwwwwwwwww', '0000-00-00', 1, 1, 1),
(11, 1, '', '', 'pepepepeppeepeppepepe', '2021-02-19', 5, 5, 5),
(12, 1, 'IvÃ¡n Costa', 'costaivan34@gmail.co', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2021-02-19', 3, 3, 3);

--
-- Disparadores `comentariositios`
--
DELIMITER $$
CREATE TRIGGER `upd_comentarios_bi` BEFORE INSERT ON `comentariositios` FOR EACH ROW set NEW.fecha = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(11) NOT NULL,
  `idSitio` int(11) NOT NULL,
  `idDia` int(11) NOT NULL,
  `HDesde` int(11) NOT NULL,
  `HHasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `idSitio`, `idDia`, `HDesde`, `HHasta`) VALUES
(1, 1, 5, 19, 23),
(2, 1, 6, 19, 23),
(2, 2, 6, 10, 20),
(3, 1, 8, 11, 15),
(3, 2, 8, 10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesplatos`
--

CREATE TABLE `imagenesplatos` (
  `idImagen` bigint(20) UNSIGNED NOT NULL,
  `idPlato` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenesplatos`
--

INSERT INTO `imagenesplatos` (`idImagen`, `idPlato`, `nombre`, `path`) VALUES
(1, 11, 0, '/private/2/platos/empanadas.jpg'),
(2, 13, 0, '/private/2/platos/ravioles.jpg'),
(3, 12, 0, '/private/2/platos/pollo.jpg'),
(4, 14, 0, '/private/2/platos/flan.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenessitios`
--

CREATE TABLE `imagenessitios` (
  `idImagen` int(11) NOT NULL,
  `idSitio` int(11) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenessitios`
--

INSERT INTO `imagenessitios` (`idImagen`, `idSitio`, `path`) VALUES
(1, 1, '/private/1/1.jpg'),
(1, 2, '/private/2/40.jpg'),
(2, 1, '/private/1/2.jpg'),
(2, 2, '/private/2/25.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infonutricional`
--

CREATE TABLE `infonutricional` (
  `idInfo` int(11) NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `idListaCaract` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `idCaract` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacaractsitio`
--

CREATE TABLE `listacaractsitio` (
  `idListaCaract` int(11) NOT NULL,
  `idSitio` int(11) NOT NULL,
  `idCaract` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `listacaractsitio`
--

INSERT INTO `listacaractsitio` (`idListaCaract`, `idSitio`, `idCaract`) VALUES
(4, 2, 2),
(2, 1, 3),
(5, 2, 3),
(0, 2, 4),
(1, 1, 5),
(6, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `idPlato` int(11) NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idSitio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`idPlato`, `nombre`, `descripcion`, `precio`, `idSitio`) VALUES
(1, 'Empanadas', 'Miren, la historia dice muchas cosas de ésta semana de Mayo, que no era posible que vendieran paraguas, que las escarapelas no se podían sostener porque no se había inventado el alfiler, etc, etc.\r\n\r\nPero si hay algo que no vamos a cuestionar jamás, es que había empanadas, y que eran de carne. Punto señores!\r\n\r\nEs que la empanada, y sobre todo la de carne, es algo en lo que siempre se puede confiar. ¿O me van a decir que cuando llegan de trabajar tarde, y saben que no tienen nada en la heladera, lo primero que se les pasa por la cabeza no es una empanada?\r\n\r\nNo me mientan! Seguro tienen algún lugar de paso donde pueden comprar 3 empanadas!\r\n\r\nUna de carne, una de jamón y queso, y una de verdura (o humita) para hacernos los sanos. El clásico.', '60', 1),
(2, 'sorentinos', 'aaaaaaaaaaaaaaa', '5', 1),
(3, 'asado', '', '', 1),
(4, 'a', '', '', 1),
(5, 'b', '', '', 1),
(6, 'c', '', '', 1),
(7, 'd', '', '', 1),
(8, 'e', '', '', 1),
(9, 'f', '', '', 1),
(10, 'g', '', '', 1),
(11, 'Empanadas de carne', 'Las empanadas de carne mas ricas de todo el condado, no deje de probarlas. Elaborada con ingredientes organicos y de primera calidad', '0', 2),
(12, 'Pollo al horno ', 'Nuestro plato fuerte, Pollo al horno de \"barro\" con papas y batatas. Disfrute del mas rico pollo de campo, criados en nuestra granja organica.', '0', 2),
(13, 'Ravioles', 'Ravioles caseros de verdura con tuco. Plato grande para compartir. Elaborados con las acelgas de la huerta de josecito.', '0', 2),
(14, 'Queremos Flan', 'Flan con dulce de leche elaborado con huevos fresco de campo y dulce de leche de elaboracion propia.', '0', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semanasdias`
--

CREATE TABLE `semanasdias` (
  `idDia` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE `sitios` (
  `idSitio` int(11) NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `telefono` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `sitioWeb` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `valoracionPrecio` int(11) NOT NULL,
  `valoracionAmbiente` int(11) NOT NULL,
  `valoracionSabor` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sitios`
--

INSERT INTO `sitios` (`idSitio`, `nombre`, `descripcion`, `telefono`, `sitioWeb`, `valoracionPrecio`, `valoracionAmbiente`, `valoracionSabor`, `idUsuario`, `idCategoria`) VALUES
(1, 'La Protegida', 'Durante el siglo XIX, los vecinos de Navarro contaban con varios servicos de diligencias que unÃ­a a Ã©ste con la gran aldea de Buenos Aires y con pueblo y parajes vecinos. En Ã©pocas en que los caminos eran sÃ³lo huellas, aquellas diligencias sirvieron al transporte de correspondencia, encomiendas y pasajeros, convirtiÃ©ndose en indispensables actores de desarrollo para los incipientes vecindarios afincados en el medio de la inhÃ³spita pampa. \"LA PROTEGIDA\" era una de aquellas compaÃ±ias de diligencias, que en el siglo XIX trasnportaba sus cargas desde Buenos Aires a Navarro...\r\n...Ya avanzado el siglo XX , a principios de la dÃ©cada del 70, en la ciudad de Navarro cerraba definitivamente el almacÃ©n de ramos generales del Turco Emilio.\r\nEste seÃ±ero almacÃ©n, fundado en 1926 por el inmigrante sirio-libanÃ©s Abdul Emilio MustafÃ¡, habÃ­a cumplido un importante ciclo en la historia comercial de la comunidad, pero superado por nuevos pautas econÃ³micas cesÃ³ en su actividad, alquilando su edificio para sucesivos y diferentes emprendimientos comerciales....\r\n...Coincidente con ese tiempo, un joven de -por entonces- 15 aÃ±os, comienzÃ³ a interesarse por objetos antiguos y artÃ­culos de viejos almacenes y pulperÃ­a de su pueblo; iniciando asÃ­, una colecciÃ³n que perdura hasta estos dÃ­as. Hoy, estas tres historias independientes se conjugan y de la fusiÃ³n de aquel viejo edificio del almacÃ©n del Turco Emilio mÃ¡s la copiosa colecciÃ³n lograda en mÃ¡s de 35 aÃ±os por aquel jÃ³ven y el nombre de aquella legendaria diligencia surge a nosotros el AlmacÃ©n Museo LA PROTEGIDA como un sÃ­mbolo de buena combinaciÃ³n de Turismo, GastronomÃ­a y Cultura regional.', '+549 2324 580678 ', 'consultas@laprotegida.com', 0, 0, 0, 1, 1),
(2, 'La Lechuza ', 'Este AlmacÃ©n de campo devenido en restaurant, es un lugar en el que no encontrarÃ¡ lujos, ni recetas gourmets, ni mozos profesionales.\r\n\r\nSi encontrarÃ¡ gente cÃ¡lida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO.\r\n\r\nEncontrarÃ¡ mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeÃ±o y original salÃ³n del almacÃ©n o en otro sector que se asemeja a un jardÃ­n de invierno.\r\n\r\nLos dÃ­as de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el dÃ­a al aire libre Afuera hay cancha de tejo, hamacas, voley y fÃºtbol reducido. TambiÃ©n reposeras para antes y despuÃ©s del almuerzo.\r\n\r\nEl servicio que desde hace mÃ s de treinta aÃ±os brinda LA LECHUZA consiste en un solo y Ãºnico menÃº, una recepciÃ³n con aperitivos que ud puede servirse a â€œgusto del consumidorâ€ en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algÃºn chorizo, salame o longaniza, es aparte).\r\n\r\nLuego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompaÃ±ado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino Â¾ y soda a canilla libre durante el almuerzo.\r\n\r\nLuego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposiciÃ³n una canasta con pasteles, un termo con cafÃ© y otro con mate cocido. Los domingos difÃ­cilmente falte alguna guitarra y algÃºn cantor que amenizarÃ¡ la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.\r\n\r\nEl sistema de cobro es como se hacÃ­a con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `idUbicacion` int(11) NOT NULL,
  `idSitio` int(11) NOT NULL,
  `direccion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ciudad` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `provincia` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `X` text NOT NULL,
  `Y` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`idUbicacion`, `idSitio`, `direccion`, `ciudad`, `provincia`, `X`, `Y`) VALUES
(1, 1, 'Calle 19 esquina 30', 'Navarro ', 'Buenos Aires', '-35.00033238593366', '-59.272647442288545'),
(2, 2, 'Cuartel V', 'Navarro', 'Buenos Aires', '-35.071894', '-59.296785');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `mail` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombreUsuario` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `direccion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `pais` text NOT NULL,
  `telefono` int(11) NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fotoPerfil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `mail`, `nombreUsuario`, `nombre`, `apellido`, `direccion`, `pais`, `telefono`, `password`, `fotoPerfil`) VALUES
(1, 'costaivan34@gmail.com', 'costaivan34', 'Iván', 'Costa', 'Calle 123, enmicasa', 'Argentina', 0, '81dc9bdb52d04dc20036dbd8313ed055', '/private/usuarios/1/perfil.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valornutricional`
--

CREATE TABLE `valornutricional` (
  `idValor` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `idInfo` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valornutricional`
--

INSERT INTO `valornutricional` (`idValor`, `idPlato`, `idInfo`, `valor`) VALUES
(1, 11, 2, 1102),
(2, 11, 3, 20),
(3, 11, 5, 17),
(4, 11, 1, 60),
(5, 11, 4, 6),
(6, 11, 6, 193);

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
  ADD KEY `idPlato` (`idPlato`),
  ADD KEY `listacaractplato_ibfk_222` (`idCaract`);

--
-- Indices de la tabla `listacaractsitio`
--
ALTER TABLE `listacaractsitio`
  ADD PRIMARY KEY (`idListaCaract`,`idSitio`),
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
  ADD PRIMARY KEY (`idUsuario`,`mail`);

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
-- AUTO_INCREMENT de la tabla `imagenesplatos`
--
ALTER TABLE `imagenesplatos`
  MODIFY `idImagen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `infonutricional`
--
ALTER TABLE `infonutricional`
  MODIFY `idInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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

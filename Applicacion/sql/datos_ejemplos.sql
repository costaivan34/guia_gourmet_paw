-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2021 a las 01:04:48
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";
SET NAMES utf8;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foodapp`
--

--
-- Volcado de datos para la tabla `sitios`
--

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO `usuarios` (`idUsuario`, `mail`, `nombreUsuario`, `nombre`, `apellido`, `direccion`, `pais`, `telefono`, `password`, `fotoPerfil`) VALUES
(1, 'costaivan34@gmail.com', 'costaivan34', 'Iván', 'Costa', 'Calle 123, enmicasa', 'Argentina', 0, '25f9e794323b453885f5181f1b624d0b', '/private/users/costaivan34@gmail.com/perfil.jpg');


INSERT INTO `sitios` (`idSitio`, `nombre`, `descripcion`, `telefono`, `sitioWeb`, `valoracionPrecio`, `valoracionAmbiente`, `valoracionSabor`, `idUsuario`, `idCategoria`) VALUES
(1, 'La Protegida', 'Durante el siglo XIX, los vecinos de Navarro contaban con varios servicos de diligencias que unía a éste con la gran aldea de Buenos Aires y con pueblo y parajes vecinos. En épocas en que los caminos eran sólo huellas, aquellas diligencias sirvieron al transporte de correspondencia, encomiendas y pasajeros, convirtiéndose en indispensables actores de desarrollo para los incipientes vecindarios afincados en el medio de la inhóspita pampa. "LA PROTEGIDA" era una de aquellas compañias de diligencias, que en el siglo XIX trasnportaba sus cargas desde Buenos Aires a Navarro. Ya avanzado el siglo XX , a principios de la década del 70, en la ciudad de Navarro cerraba definitivamente el almacén de ramos generales del "Turco Emilio".Este señero almacén, fundado en 1926 por el inmigrante sirio-libanés Abdul "Emilio" Mustafá, había cumplido un importante ciclo en la historia comercial de la comunidad, pero superado por nuevos pautas económicas cesó en su actividad, alquilando su edificio para sucesivos y diferentes emprendimientos comerciales.......Coincidente con ese tiempo, un joven de -por entonces- 15 años, comienzó a interesarse por objetos antiguos y artículos de viejos almacenes y pulpería de su pueblo; iniciando así, una colección que perdura hasta estos días. Hoy, estas tres historias independientes se conjugan y de la fusión de aquel viejo edificio del almacén del "Turco" Emilio más la copiosa colección lograda en más de 35 años por aquel jóven y el nombre de aquella legendaria diligencia surge a nosotros el "Almacén Museo LA PROTEGIDA" como un símbolo de buena combinación de Turismo, Gastronomía y Cultura regional.', '+549 2324 580678 ', 'consultas@laprotegida.com', 0, 0, 0, 1, 1),
(2, 'La Lechuza', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(3, 'Brook', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(4, 'Paprika', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(5, 'Cuando quieras', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(6, 'Restaurante Buenos Aires', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1),
(7, 'Pizzeria la Trentina', 'Este Almacén de campo devenido en restaurant, es un lugar en el que no encontrará lujos, ni recetas gourmets, ni mozos profesionales. Si encontrará gente cálida, comida casera y sencillez PARA PASAR UN DIA DE CAMPO EN SERIO. Encontrará mesas con tablones y bancos de madera, un quincho con piso de tierra como los antes. Tiene tres sectores para ubicarse, en el quincho, afuera, en el pequeño y original salón del almacén o en otro sector que se asemeja a un jardín de invierno. Los días de solcito, se arman las mesas en el parque y se puede disfrutar del almuerzo y el día al aire libre Afuera hay cancha de tejo, hamacas, voley y fútbol reducido. También reposeras para antes y después del almuerzo. El servicio que desde hace màs de treinta años brinda LA LECHUZA consiste en un solo y único menú, una recepción con aperitivos que ud puede servirse a “gusto del consumidor” en el bebedero (kiosco de dulces y fiambres donde si se agrega la picada de algún chorizo, salame o longaniza, es aparte). Luego, el almuerzo propiamente dicho consta de empanadas, pollo al horno de barro con papas y batatas, ravioles caseros y el popular flan casero con dulce de leche. Todo en fuentes y a tenedor libre acompañado de galleta de campo. Tambien incluye bebidas gaseosas, cerveza, vino ¾ y soda a canilla libre durante el almuerzo. Luego del almuerzo, de las 15 Hs. en adelante en el parque se pone a disposición una canasta con pasteles, un termo con café y otro con mate cocido. Los domingos difícilmente falte alguna guitarra y algún cantor que amenizará la tarde Este emprendimiento de la familia Rivas esta a cargo de Oscar, su esposa Eli y sigue rondando las empanadas y los ravioles la legendaria Chola.El sistema de cobro es como se hacía con los tamberos: por cabeza (Precios con bebidas incluidas)', '+549 2227 41 1397', 'lalechuzadenavarro@hotmail.com', 0, 0, 0, 1, 1);



--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`idUbicacion`, `idSitio`, `direccion`, `ciudad`, `provincia`, `X`, `Y`) VALUES
(1, 1, 'Calle 19 esquina 30', 'Navarro ', 'Buenos Aires', '-35.00033238593366', '-59.272647442288545'),
(2, 2, 'Cuartel V', 'Navarro ', 'Buenos Aires', '-35.071894', '-59.296785'),
(3, 3, 'Calle 16 894', 'Navarro ', 'Buenos Aires', '-35.0064567', '-59.2699105'),
(4, 4, 'Calle 109 102', 'Navarro', 'Buenos Aires', '-35.0067437', '-59.2783453'),
(5, 5, 'Calle 7 esquina 26', 'Navarro ', 'Buenos Aires', '-35.0045366', '-59.2807514'),
(6, 6, 'Calle 19 esquina 30', 'Navarro ', 'Buenos Aires', '-35.0046192', '-59.2767539'),
(7, 7, 'Calle 109 e/ 22 y 24 N 17', 'Navarro ', 'Buenos Aires', '-35.0053804', '-59.2780874');

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
(10,3, 5, 10, 23),

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
(30, 7, 7, 10, 20);
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
(9, 7, '/private/sites/7/1.jpg');


--
-- Volcado de datos para la tabla `listacaractsitio`
--

INSERT INTO `listacaractsitio` (`idListaCaract`, `idSitio`, `idCaract`) VALUES
(1, 2, 2),
(2, 1, 3),
(3, 2, 3),
(4, 2, 4),
(5, 1, 5),
(6, 2, 6),

(7, 3, 1),
(8, 3, 2),
(9, 3, 3),
(10, 3, 4),
(11, 3, 5),
(12, 3, 6),

(13, 4, 1),
(14, 4, 2),
(15, 4, 3),
(16, 4, 4),
(17, 4, 5),
(19, 4, 6),

(20, 5, 1),
(21, 5, 2),
(22, 5, 3),
(23, 5, 4),
(24, 5, 5),
(25, 5, 6),

(26, 6, 1),
(27, 6, 2),
(28, 6, 3),
(29, 6, 4),
(30, 6, 5),
(31, 6, 6),

(33, 7, 1),
(34, 7, 2),
(35, 7, 3),
(36, 7, 4),
(37, 7, 5),
(38, 7, 6);


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


--
-- Volcado de datos para la tabla `comentariositios`
--
--
INSERT INTO `comentariositios` (`idComentario`, `idSitio`, `nombre`, `mail`, `descripcion`, `fecha`, `valoracionSabor`, `valoracionPrecio`, `valoracionAmbiente`) VALUES
(1, 1, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(2, 1, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(3, 2, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(4, 1, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(5, 1, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(6, 1, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(7, 1, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(8, 1, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(9, 1, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(10, 1, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1),

(11, 2, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(12, 2, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(13, 2, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(14, 2, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(15, 2, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(16, 2, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(17, 2, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(18, 2, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(19, 2, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(20,2, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1),

(21, 3, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(22, 3, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(23, 3, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(24, 3, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(25, 3, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(26, 3, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(27, 3, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(28, 3, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(29, 3, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(30, 3, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1),

(31, 4, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(32, 4, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(33, 4, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(34, 4, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(35, 4, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(36, 4, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(37, 4, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(38, 4, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(39, 4, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(40,4, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1),

(41, 5, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(42, 5, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(43, 5, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(44, 5, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(45, 5, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(46, 5, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(47, 5, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(48, 5, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(49, 5, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(50, 5, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1),

(61, 6, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(62, 6, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(63, 6, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(64, 6, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(65, 6, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(66, 6, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(67, 6, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(68, 6, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(69, 6, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(70, 6, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1),

(71, 7, 'Carlos', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam.', '2021-06-06', 1, 1, 3),
(72, 7, 'Abigail', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-02', 1, 3, 2),
(73, 7, 'Susana', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-02-12', 4, 4, 4),
(74, 7, 'Aurora', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 3, 3, 3),
(75, 7, 'Gaspar', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 2, 2, 2),
(76, 7, 'Ivan ', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 4, 4, 4),
(77, 7, 'Renato', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 5, 5, 5),
(78, 7, 'Carina', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 5, 2, 2),
(79, 7, 'Ludmila', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam', '2021-06-06', 1, 1, 1),
(80, 7, 'Felipe', '', 'Et iure eius vel rerum fuga id eligendi harum vel ratione numquam',  '2021-06-06', 1, 1, 1);

--
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
(20, 4, 3, 20),
(21, 4, 5, 17),
(22, 4, 1, 60),
(23, 4, 4, 6),
(24, 4, 6, 193),
(25, 5, 2, 1102),
(26, 5, 3, 20),
(27, 5, 5, 17),
(28, 5, 1, 60),
(19, 5, 4, 6),
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
(56,10, 3, 20),
(57, 10, 5, 17),
(58, 10, 1, 60),
(59, 10, 4, 6),
(60, 10, 6, 193),



(61, 11, 2, 1102),
(62, 11, 3, 20),
(63, 11, 5, 17),
(64, 11, 1, 60),
(65,11, 4, 6),
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
--
-- Volcado de datos para la tabla `listacaractplato`
--
INSERT INTO `listacaractplato`(`idListaCaract`,`idPlato`, `idCaract`) VALUES 
(1,1,1),
(2,2,2),
(3,3,1),
(4,4,4),
(5,5,1),
(6,6,1),
(7,7,5),
(8,8,1),
(9,9,2),
(10,10,1),
(11,11,3),
(12,12,2),
(13,13,1);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

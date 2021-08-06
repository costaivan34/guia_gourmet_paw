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
SET time_zone = "+00:00";


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
(1, 'costaivan34@gmail.com', 'costaivan34', 'Iván', 'Costa', 'Calle 123, enmicasa', 'Argentina', 0, '81dc9bdb52d04dc20036dbd8313ed055', '/private/users/costaivan34@gmail.com/perfil.jpg');


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

INSERT INTO `imagenesplatos` (`idImagen`, `idPlato`, `nombre`, `path`) VALUES
(1, 1, 0, '/private/plates/1/empanadas.jpg'),
(2, 2, 0, '/private/plates/1/ravioles.jpg'),
(3, 3, 0, '/private/plates/1/pollo.jpg'),
(4, 4, 0, '/private/plates/1/flan.jpg'),
(5, 5, 0, '/private/plates/2/empanadas.jpg'),
(6, 6, 0, '/private/plates/2/ravioles.jpg'),
(7, 7, 0, '/private/plates/2/pollo.jpg'),
(8, 8, 0, '/private/plates/2/flan.jpg'),
(9, 9, 0, '/private/plates/3/empanadas.jpg'),
(10, 10, 0, '/private/plates/3/ravioles.jpg'),
(11, 11, 0, '/private/plates/3/pollo.jpg'),
(12, 12, 0, '/private/plates/3/flan.jpg'),
(13, 13, 0, '/private/plates/4/empanadas.jpg'),
(14, 14, 0, '/private/plates/4/ravioles.jpg'),
(15, 15, 0, '/private/plates/4/pollo.jpg'),
(16, 16, 0, '/private/plates/4/flan.jpg'),
(17, 17, 0, '/private/plates/5/empanadas.jpg'),
(18, 18, 0, '/private/plates/5/ravioles.jpg'),
(19, 19, 0, '/private/plates/5/pollo.jpg'),
(20, 20, 0, '/private/plates/5/flan.jpg'),
(21, 21, 0, '/private/plates/6/empanadas.jpg'),
(22, 22, 0, '/private/plates/6/ravioles.jpg'),
(23, 23, 0, '/private/plates/6/pollo.jpg'),
(24, 24, 0, '/private/plates/6/flan.jpg'),
(25, 25, 0, '/private/plates/7/empanadas.jpg'),
(26, 26, 0, '/private/plates/7/ravioles.jpg'),
(27, 27, 0, '/private/plates/7/pollo.jpg'),
(28, 28, 0, '/private/plates/7/flan.jpg');


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

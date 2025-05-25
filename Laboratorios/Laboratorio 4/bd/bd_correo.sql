-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2025 a las 04:48:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_correo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE `correos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `receptor` varchar(100) DEFAULT NULL,
  `asunto` varchar(200) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `mensaje` text DEFAULT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `borrador` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`id`, `usuario_id`, `receptor`, `asunto`, `fecha`, `mensaje`, `leido`, `borrador`) VALUES
(1, 2, 'admin@sis256.edu', 'Mensaje 1', '2025-05-25 02:36:51', 'Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. Este es un mensaje de prueba con mucho contenido. ', 0, 0),
(2, 2, 'admin@sis256.edu', 'Mensaje 2', '2025-05-25 02:36:51', 'Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. Contenido extenso para pruebas del sistema. ', 0, 0),
(3, 2, 'admin@sis256.edu', 'Mensaje 3', '2025-05-25 02:36:51', 'Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. Este texto sirve para poblar la base de datos. ', 1, 0),
(4, 2, 'admin@sis256.edu', 'Mensaje 4', '2025-05-25 02:36:51', 'Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. Datos adicionales para el sistema de mensajería. ', 0, 0),
(5, 2, 'admin@sis256.edu', 'Mensaje 5', '2025-05-25 02:36:51', 'Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. Este correo contiene información importante. ', 0, 0),
(6, 1, 'usuario@sis256.edu', 'Respuesta 1', '2025-05-25 02:36:51', 'Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. Mensaje para el usuario con bastante contenido. ', 0, 0),
(7, 1, 'usuario@sis256.edu', 'Respuesta 2', '2025-05-25 02:36:51', 'Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. Correo con contenido simulado para testeo. ', 1, 0),
(8, 1, 'usuario@sis256.edu', 'Respuesta 3', '2025-05-25 02:36:51', 'Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. Este correo electrónico es parte de una prueba. ', 0, 0),
(9, 1, 'usuario@sis256.edu', 'Respuesta 4', '2025-05-25 02:36:51', 'Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. Aquí se inserta una gran cantidad de texto. ', 1, 0),
(10, 1, 'usuario@sis256.edu', 'Respuesta 5', '2025-05-25 02:36:51', 'Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. Mensaje generado automáticamente para pruebas. ', 0, 0),
(11, 2, 'admin@sis256.edu', 'Borrador 1', '2025-05-25 02:36:51', 'Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. Este es un borrador sin enviar. ', 0, 1),
(12, 2, 'admin@sis256.edu', 'Borrador 2', '2025-05-25 02:36:51', 'Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. Otro mensaje en borrador. ', 0, 1),
(13, 2, 'usuario@sis256.edu', 'Borrador 3', '2025-05-25 02:36:51', 'Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. Borrador para otro usuario. ', 0, 1),
(14, 1, 'usuario@sis256.edu', 'Borrador Admin 1', '2025-05-25 02:36:51', 'Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. Borrador del administrador. ', 0, 1),
(15, 1, 'usuario@sis256.edu', 'Borrador Admin 2', '2025-05-25 02:36:51', 'Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. Otro borrador del admin. ', 0, 1),
(16, 1, 'usuario@sis256.edu', 'Aviso 1', '2025-05-25 02:40:19', 'aviso', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `nivel` tinyint(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `password`, `nombre`, `nivel`, `estado`) VALUES
(1, 'admin@sis256.edu', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrador', 1, 1),
(2, 'usuario@sis256.edu', 'b665e217b51994789b02b1838e730d6b93baa30f', 'usuario', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `correos`
--
ALTER TABLE `correos`
  ADD CONSTRAINT `correos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

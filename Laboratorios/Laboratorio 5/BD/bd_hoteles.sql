-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2025 a las 18:04:43
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
-- Base de datos: `bd_hoteles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotografias_habitacion`
--

CREATE TABLE `fotografias_habitacion` (
  `id` int(11) NOT NULL,
  `habitacion_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `activa` tinyint(4) DEFAULT 1,
  `orden` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotografias_habitacion`
--

INSERT INTO `fotografias_habitacion` (`id`, `habitacion_id`, `nombre`, `fotografia`, `tipo`, `activa`, `orden`) VALUES
(1, 1, 'Individual - Vista Principal', 'hab101_1.jpg', 'principal', 1, 1),
(2, 1, 'Individual - Baño', 'hab101_2.jpg', 'baño', 1, 2),
(3, 2, 'Individual - Vista Principal', 'hab102_1.jpg', 'principal', 1, 1),
(4, 2, 'Individual - Baño', 'hab102_2.jpg', 'baño', 1, 2),
(5, 3, 'Doble - Vista Principal', 'hab201_1.jpg', 'principal', 1, 1),
(6, 3, 'Doble - Vista Exterior', 'hab201_2.jpg', 'vista', 1, 2),
(7, 3, 'Doble - Baño', 'hab201_3.jpg', 'baño', 1, 3),
(8, 4, 'Doble - Vista Principal', 'hab202_1.jpg', 'principal', 1, 1),
(9, 4, 'Doble - Vista Exterior', 'hab202_2.jpg', 'vista', 1, 2),
(10, 4, 'Doble - Baño', 'hab202_3.jpg', 'baño', 1, 3),
(11, 5, 'Suite - Vista Principal', 'suite301_1.jpg', 'principal', 1, 1),
(12, 5, 'Suite - Sala de Estar', 'suite301_2.jpg', 'sala', 1, 2),
(13, 5, 'Suite - Dormitorio', 'suite301_3.jpg', 'dormitorio', 1, 3),
(14, 5, 'Suite - Baño Principal', 'suite301_4.jpg', 'baño', 1, 4),
(15, 6, 'Familiar - Vista Principal', 'hab401_1.jpg', 'principal', 1, 1),
(16, 6, 'Familiar - Área de Camas', 'hab401_2.jpg', 'dormitorio', 1, 2),
(17, 6, 'Familiar - Baño', 'hab401_3.jpg', 'baño', 1, 3),
(18, 6, 'Familiar - Vista Exterior', 'hab401_4.jpg', 'vista', 1, 4),
(19, 7, 'Individual - Vista Principal', 'norte_hab101_1.jpg', 'principal', 1, 1),
(20, 7, 'Individual - Baño', 'norte_hab101_2.jpg', 'baño', 1, 2),
(21, 8, 'Doble - Vista Principal', 'norte_hab201_1.jpg', 'principal', 1, 1),
(22, 8, 'Doble - Vista a la Ciudad', 'norte_hab201_2.jpg', 'vista', 1, 2),
(23, 8, 'Doble - Baño', 'norte_hab201_3.jpg', 'baño', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `tipo_habitacion_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `piso` tinyint(4) DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT 1,
  `precio` decimal(10,2) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `superficie` decimal(5,2) DEFAULT NULL,
  `nro_camas` tinyint(4) DEFAULT NULL,
  `capacidad_maxima` tinyint(4) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `tipo_habitacion_id`, `nombre`, `numero`, `piso`, `disponible`, `precio`, `sucursal_id`, `superficie`, `nro_camas`, `capacidad_maxima`, `descripcion`) VALUES
(1, 1, 'Individual', '101', 1, 1, 150.00, 1, 15.50, 1, 1, 'Habitación individual con una cama simple'),
(2, 1, 'Individual', '102', 1, 1, 150.00, 1, 15.50, 1, 1, 'Habitación individual con una cama simple'),
(3, 2, 'Doble', '201', 2, 1, 250.00, 1, 25.00, 1, 2, 'Habitación doble con cama matrimonial'),
(4, 2, 'Doble', '202', 2, 0, 250.00, 1, 25.00, 1, 2, 'Habitación doble con cama matrimonial'),
(5, 3, 'Ejecutiva', '301', 3, 1, 450.00, 1, 45.00, 2, 4, 'Suite con sala de estar y dos camas'),
(6, 4, 'Multiple', '401', 4, 1, 350.00, 1, 35.00, 3, 6, 'Habitación familiar con múltiples camas'),
(7, 1, 'Individual', '101', 1, 1, 140.00, 2, 15.50, 1, 1, 'Habitación individual con una cama simple'),
(8, 2, 'Doble', '201', 2, 1, 240.00, 2, 25.00, 1, 2, 'Habitación doble con cama matrimonial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 0,
  `fecha_pago` timestamp NOT NULL DEFAULT current_timestamp(),
  `referencia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `reserva_id`, `monto`, `metodo_pago`, `estado`, `fecha_pago`, `referencia`) VALUES
(1, 1, 300.00, 'Tarjeta de Credito', 1, '2025-06-11 16:04:20', 'TXN123456789'),
(2, 2, 625.00, 'Transferencia', 1, '2025-06-11 16:04:20', 'TRANS987654321'),
(3, 2, 625.00, 'Efectivo', 0, '2025-06-11 16:04:20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `habitacion_id` int(11) DEFAULT NULL,
  `fecha_reserva` date DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `huespedes` tinyint(4) DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `habitacion_id`, `fecha_reserva`, `fecha_ingreso`, `fecha_salida`, `huespedes`, `precio_total`, `observaciones`, `estado`) VALUES
(1, 2, 1, '2025-06-10', '2025-06-15', '2025-06-17', 1, 300.00, 'Cliente frecuente', 1),
(2, 2, 3, '2025-06-12', '2025-06-20', '2025-06-25', 2, 1250.00, 'Luna de miel', 1),
(3, 2, 6, '2025-06-15', '2025-07-01', '2025-07-05', 4, 1400.00, 'Familia con niños', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `direccion`, `ciudad`, `telefono`, `email`, `activo`) VALUES
(1, 'Hotel Central', 'Av. Principal 123', 'Sucre', '46421000', 'central@hotel.com', 1),
(2, 'Hotel Norte', 'Calle Norte 456', 'La Paz', '22220000', 'norte@hotel.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id`, `nombre`, `activo`) VALUES
(1, 'Individual', 1),
(2, 'Doble', 1),
(3, 'Suite', 1),
(4, 'Familiar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nombre_completo` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `nivel` tinyint(4) DEFAULT 0,
  `activo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `password`, `nombre_completo`, `telefono`, `nivel`, `activo`) VALUES
(1, 'admin@sis256.edu', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrador', '70123456', 1, 1),
(2, 'usuario@sis256.edu', 'b665e217b51994789b02b1838e730d6b93baa30f', 'usuario', '70123457', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotografias_habitacion`
--
ALTER TABLE `fotografias_habitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `habitacion_id` (`habitacion_id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_habitacion_numero` (`sucursal_id`,`numero`),
  ADD KEY `tipo_habitacion_id` (`tipo_habitacion_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `habitacion_id` (`habitacion_id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
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
-- AUTO_INCREMENT de la tabla `fotografias_habitacion`
--
ALTER TABLE `fotografias_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotografias_habitacion`
--
ALTER TABLE `fotografias_habitacion`
  ADD CONSTRAINT `fotografias_habitacion_ibfk_1` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`tipo_habitacion_id`) REFERENCES `tipo_habitacion` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `habitaciones_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

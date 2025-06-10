-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 22:27:30
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
-- Base de datos: `venta_cocinas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `nombre`, `email`, `mensaje`, `fecha`) VALUES
(1, 'jhonnatan', 'DAVIDRICO1003@GMAIL.COM', 'es estupendo cada producto de mejo fascinado\r\n', '2025-04-30 21:16:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) NOT NULL DEFAULT 'cocina'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `ubicacion`, `imagen`, `categoria`) VALUES
(1, 'Cocina Compacta', 'Ideal para pequeños equipos de albañiles.', 450.00, 'Bogotá Centro', 'cocina1.jpg', 'cocina'),
(2, 'Cocina Premium', 'Espaciosa y con estanterías metálicas.', 1200.00, 'Zona Industrial', 'cocina2.jpg', 'cocina'),
(3, 'Cocina Móvil', 'Con ruedas para movilizar en obra.', 800.00, 'Suba', 'cocina3.jpg', 'cocina'),
(4, 'Cocina con Almacenaje', 'Incluye armarios resistentes.', 950.00, 'Usaquén', 'cocina4.jpg', 'cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `clave`, `rol`) VALUES
(1, 'administrador', 'davidrico1003@gmail.com', '$2y$10$6jXJ0N3Mn/mTQo5MW9xx6e/MGSqkvk.MQ1RYRcDZAQKY6mGrpjpsy', 'admin'),
(2, 'usuario', 'jhonnatanmartinez23@gmail.com', '$2y$10$c7aXWsJ6zejnDUA2goNSvu6oq4YzPUA38ypa7K4OMVDnIznISRKj6', 'usuario'),
(8, 'admin1', 'admin@gmail.com', '$2y$10$cy4qLlBZrF9sDrnuCBgPB.WcgBLiT1hvgUxyEe/Hd0bEfXxQISZx2', 'usuario'),
(9, 'administrador1', 'davidrico22@gmail.com', '$2y$10$2UisSMgiIHCpCn0W7TZ05eoS/dMOnu/2chS6HxIKgUoZY2VjwsYUC', 'usuario'),
(10, 'eltu', 'test@gmail.com', '$2y$10$ZfHqpvsvQfOWLV8Oo/TwzOehE/g.b6tor39W9nUpIdw5Jx2HZunqG', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2022 a las 22:12:45
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `id_orden` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `id_mesa` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `mesa_calificacion` int(11) NOT NULL,
  `restaurante_calificacion` int(11) NOT NULL,
  `mozo_calificacion` int(11) NOT NULL,
  `cocinero_calificacion` int(11) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  `promedio_calificacion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `id_orden`, `id_mesa`, `mesa_calificacion`, `restaurante_calificacion`, `mozo_calificacion`, `cocinero_calificacion`, `comentario`, `promedio_calificacion`) VALUES
(1, 'SD003', 'MS001', 8, 8, 10, 9, 'Que sabroso la carne de caballo,  como siempre!', 8.75),
(2, 'SD003', 'MS001', 8, 8, 10, 9, 'Que sabroso la piquiña !', 8.75),
(18, 'SD003', 'MS001', 8, 8, 10, 9, 'Que sabroso la piquiña !', 8.75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `logins`
--

INSERT INTO `logins` (`id`, `id_usuario`, `nombre_usuario`, `fecha_login`) VALUES
(32, 0, 'modificado_log', '2022-11-27 18:38:52'),
(34, 4, 'cocinero1', '2022-11-12 00:00:00'),
(35, 3, 'socio2', '2022-11-12 00:00:00'),
(36, 3, 'socio2', '2022-11-12 00:00:00'),
(37, 3, 'socio2', '2022-11-12 00:00:00'),
(38, 3, 'socio2', '2022-11-13 00:00:00'),
(39, 3, 'socio2', '2022-11-18 00:00:00'),
(40, 9, 'mozo1', '2022-11-18 00:00:00'),
(41, 9, 'mozo1', '2022-11-18 00:00:00'),
(42, 9, 'mozo1', '2022-11-18 00:00:00'),
(43, 3, 'socio2', '2022-11-19 00:00:00'),
(44, 9, 'mozo1', '2022-11-19 00:00:00'),
(45, 9, 'mozo1', '2022-11-19 00:00:00'),
(46, 3, 'socio2', '2022-11-19 00:00:00'),
(47, 7, 'cervecero', '2022-11-19 00:00:00'),
(48, 15, 'cocinero2', '2022-11-19 00:00:00'),
(49, 6, 'bartender1', '2022-11-19 00:00:00'),
(50, 3, 'socio2', '2022-11-19 00:00:00'),
(51, 9, 'mozo1', '2022-11-19 00:00:00'),
(52, 9, 'mozo1', '2022-11-19 00:00:00'),
(53, 3, 'socio2', '2022-11-19 00:00:00'),
(54, 9, 'mozo1', '2022-11-19 00:00:00'),
(55, 3, 'socio2', '2022-11-26 00:00:00'),
(56, 15, 'cocinero2', '2022-11-26 00:00:00'),
(57, 6, 'bartender1', '2022-11-26 00:00:00'),
(58, 9, 'mozo1', '2022-11-26 00:00:00'),
(59, 3, 'socio2', '2022-11-26 00:00:00'),
(60, 3, 'socio2', '2022-11-27 00:00:00'),
(61, 9, 'mozo1', '2022-11-27 12:08:04'),
(62, 7, 'cervecero', '2022-11-27 13:23:01'),
(63, 15, 'cocinero2', '2022-11-27 13:24:41'),
(64, 3, 'socio2', '2022-11-27 18:38:52'),
(65, 3, 'socio2', '2022-11-27 18:39:44'),
(66, 3, 'socio2', '2022-11-27 18:40:19'),
(67, 3, 'socio2', '2022-11-27 18:56:36'),
(68, 9, 'mozo1', '2022-11-27 18:56:40'),
(69, 7, 'cervecero', '2022-11-27 18:56:44'),
(70, 15, 'cocinero2', '2022-11-27 18:56:46'),
(71, 6, 'bartender1', '2022-11-27 18:56:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `prefix` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'MS',
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_personal` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`prefix`, `id`, `id_personal`, `estado`) VALUES
('MS', 001, 9, 'cerrada'),
('MS', 002, 4, 'con cliente comiendo'),
('MS', 003, 4, 'con cliente comiendo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `prefix` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'SD',
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_mesa` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Pendiente',
  `nombre_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`prefix`, `id`, `id_mesa`, `estado`, `nombre_cliente`, `imagen`, `costo`) VALUES
('SD', 003, 'MS001', 'servido', 'Maria', 'Orden_003.png', 100.5),
('SD', 004, 'MS001', 'servido', 'Maria', NULL, 730),
('SD', 005, 'MS001', 'servido', 'Maria', NULL, 730),
('SD', 006, 'MS004', 'servido', 'Maria', NULL, 730),
('SD', 007, 'MS004', 'servido', 'Maria', NULL, 730),
('SD', 008, 'MS003', 'servido', 'Maria', NULL, 730),
('SD', 009, 'MS002', 'servido', 'Maria', NULL, 730),
('SD', 010, 'ME003', 'servido', 'manuel', 'Orden_10.png', 22),
('SD', 011, 'ME003', 'servido', 'manuel', 'Orden_11.png', 22),
('SD', 012, 'MS001', 'servido', 'Pedro', 'Orden_012.png', 730);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `area` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `id_orden_asociada` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `tiempo_inicial` timestamp NOT NULL DEFAULT current_timestamp(),
  `tiempo_entrega` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `area`, `id_orden_asociada`, `estado`, `descripcion`, `tipo`, `precio`, `tiempo_inicial`, `tiempo_entrega`) VALUES
(33, 'cocina', 'SD003', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-18 03:00:00', '2022-11-26 06:31:30'),
(34, 'cocina', 'SD003', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-18 03:00:00', '2022-11-26 06:31:30'),
(35, 'cocina', 'SD003', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-18 03:00:00', '2022-11-26 06:31:30'),
(36, 'Barra de choperas', 'SD003', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-18 03:00:00', '2022-11-19 18:50:06'),
(37, 'Barra de tragos', 'SD003', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-18 03:00:00', '2022-11-26 06:33:36'),
(38, 'cocina', 'SD004', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-19 18:13:40', '2022-11-27 22:52:52'),
(39, 'cocina', 'SD004', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:13:40', '2022-11-27 22:52:52'),
(40, 'cocina', 'SD004', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:13:40', '2022-11-27 22:52:52'),
(41, 'Barra de choperas', 'SD004', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-19 18:13:40', '2022-11-27 22:51:29'),
(42, 'Barra de tragos', 'SD004', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-19 18:13:40', '2022-11-26 06:33:36'),
(43, 'cocina', 'SD005', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-19 18:14:38', '2022-11-27 22:52:52'),
(44, 'cocina', 'SD005', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:14:38', '2022-11-27 22:52:52'),
(45, 'cocina', 'SD005', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:14:38', '2022-11-27 22:52:52'),
(46, 'Barra de choperas', 'SD005', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-19 18:14:38', '2022-11-27 22:51:29'),
(47, 'Barra de tragos', 'SD005', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-19 18:14:38', '2022-11-26 06:33:36'),
(48, 'cocina', 'SD006', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-19 18:18:01', '2022-11-27 22:52:52'),
(49, 'cocina', 'SD006', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:18:01', '2022-11-27 22:52:52'),
(50, 'cocina', 'SD006', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:18:01', '2022-11-27 22:52:52'),
(51, 'Barra de choperas', 'SD006', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-19 18:18:01', '2022-11-27 22:51:29'),
(52, 'Barra de tragos', 'SD006', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-19 18:18:01', '2022-11-26 06:33:36'),
(53, 'cocina', 'SD007', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-19 18:18:42', '2022-11-27 22:52:52'),
(54, 'cocina', 'SD007', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:18:42', '2022-11-27 22:52:52'),
(55, 'cocina', 'SD007', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:18:42', '2022-11-27 22:52:52'),
(56, 'Barra de choperas', 'SD007', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-19 18:18:42', '2022-11-27 22:51:29'),
(57, 'Barra de tragos', 'SD007', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-19 18:18:42', '2022-11-26 06:33:36'),
(58, 'cocina', 'SD008', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-19 18:19:57', '2022-11-27 22:52:52'),
(59, 'cocina', 'SD008', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:19:57', '2022-11-27 22:52:52'),
(60, 'cocina', 'SD008', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:19:57', '2022-11-27 22:52:52'),
(61, 'Barra de choperas', 'SD008', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-19 18:19:57', '2022-11-27 22:51:29'),
(62, 'Barra de tragos', 'SD008', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-19 18:19:57', '2022-11-26 06:33:36'),
(63, 'cocina', 'SD009', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-19 18:23:46', NULL),
(64, 'cocina', 'SD009', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:23:46', NULL),
(65, 'cocina', 'SD009', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-19 18:23:46', NULL),
(66, 'Barra de choperas', 'SD009', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-19 18:23:46', NULL),
(67, 'Barra de tragos', 'SD009', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-19 18:23:46', '2022-11-26 06:33:36'),
(68, 'cerveceria', '15', 'cancelado', 'Una excelente cerveza', 'cerveza', 200, '2022-11-27 16:12:54', '0000-00-00 00:00:00'),
(69, 'cocina', 'SD012', 'Listo para servir', 'millanesa de caballo', 'cocinero', 200, '2022-11-27 17:57:29', '2022-11-27 22:52:52'),
(70, 'cocina', 'SD012', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-27 17:57:29', '2022-11-27 22:52:52'),
(71, 'cocina', 'SD012', 'Listo para servir', 'hamburguesa de garbanzo', 'cocinero', 200, '2022-11-27 17:57:29', '2022-11-27 22:52:52'),
(72, 'Barra de choperas', 'SD012', 'Listo para servir', 'corona', 'cervecero', 50, '2022-11-27 17:57:29', '2022-11-27 22:51:29'),
(73, 'Barra de tragos', 'SD012', 'Listo para servir', 'daikiri', 'bartender', 80, '2022-11-27 17:57:29', '2022-11-27 22:55:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t1`
--

CREATE TABLE `t1` (
  `pedidosListos` bigint(21) NOT NULL,
  `id_orden_asociada` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t1`
--

INSERT INTO `t1` (`pedidosListos`, `id_orden_asociada`) VALUES
(5, 'SD003'),
(1, 'SD004'),
(1, 'SD005'),
(1, 'SD006'),
(1, 'SD007'),
(1, 'SD008'),
(1, 'SD009');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_alta` date NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `clave`, `nombre`, `tipo`, `fecha_alta`, `fecha_baja`) VALUES
(3, 'socio2', '$2y$10$R7alFG9ZDXSsipK9YRSJvOaf11tqVlrjz3D.Mzm/8oJtcNkFQs47C', 'eduardo', 'administrador', '2022-11-11', NULL),
(4, 'eduardoModificado', '$2y$10$rHtjtvBWwUcTExg0j66FdeOsdGjQ/OmFgPIYoaaqfuRJcrD4lVJCy', 'modificado', 'administrador', '2022-11-10', '0000-00-00'),
(6, 'bartender1', '$2y$10$EBrcr9WtqHlhXl6dQey1ceBPw4xG5O4P/wHpSUrGHPUAyY3DJXKEa', 'dionisios', 'bartender', '2022-11-11', NULL),
(7, 'cervecero', '$2y$10$vZTTkQIiAGwJPIUExnkACuucxCeZlP4b47AEsndlg7aA.KT1dBXg2', 'cervero', 'cervecero', '2022-11-11', NULL),
(9, 'mozo1', '$2y$10$yMwV0GWZGDGs.1s42XTkZuN9soIbnLDbEsu7tBdeqIAhzAbXMJDKa', 'penelope', 'mozo', '2022-11-11', NULL),
(11, 'mozo1414', '$2y$10$odDTk.o3SI4my3c.mauBuuwbwBcz4w96o.Stj2m3a09j9slooG7Au', 'penelope', 'mozo454', '2022-11-11', NULL),
(12, 'qweqwerwe', '$2y$10$N4YkfFTVcmPLM3lIJn5HsOjQDBYfnVfQgI1pXxX.Pmlwj2ei0o3PC', 'penelope', 'mozo', '2022-11-11', NULL),
(15, 'cocinero2', '$2y$10$bfdjvqJ5fpZKI.w6YWREb.BJg0t9xC0BAyJ38huKcnpH.Nag6W.lq', 'adrian', 'cocinero', '2022-11-11', NULL),
(17, 'cocinero3', '$2y$10$kiB6Yxb/qPos/s6kCXz1JeDsLCPTTMcSqA/LMJyzRP87O5PVpYEbm', 'adriana', 'cocinero', '2022-11-12', NULL),
(18, 'cocinero4', '$2y$10$I3mVbn2/75nA4Jd3pVuUeuky1eFXVL5ovrZWDNIjMm60n8VSRZU4W', 'paula', 'cocinero', '2022-11-12', NULL),
(19, 'cocinero5', '$2y$10$xdD3qnA/MlaxoIu9mhVyKeMu3BCbkAouTd69UJ6RyVPs/fE/cPU46', 'paulina', 'cocinero', '2022-11-12', NULL),
(20, 'cocinero6', '$2y$10$KB6yV6/HzarOeP02frHFHeFupj4c2NMLBQ/4s1jQJaOUKAn3g1Jq.', 'paulina', 'cocinero', '2022-11-12', NULL),
(21, 'cocinero7', '$2y$10$ohOWjiW7a1DkkMt2sdEhNeQwAiwhX4FhcJ/UmCW9abfwLXOuwNI6W', 'paulina', 'cocinero', '2022-11-12', NULL),
(23, 'Modificado', '$2y$10$d6O.0/83l9KUwCilvpGf1.ySGYPS8j9RCtDR6jO6yCNT0SZDNe3HW', 'modificado', 'administrador', '2022-11-10', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prefix` (`prefix`,`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prefix` (`prefix`,`id`);

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
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

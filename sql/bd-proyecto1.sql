-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2020 a las 02:09:44
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd-proyecto1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `rut_persona` int(9) NOT NULL,
  `clave` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo_cuenta` enum('alumno','administrador','docente','administrativa','invitado','auxiliar de aseo','mantencion') COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_qr` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `ultima_conexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`rut_persona`, `clave`, `correo`, `telefono`, `direccion`, `fecha_nacimiento`, `tipo_cuenta`, `codigo_qr`, `ultima_conexion`) VALUES
(112223334, '81dc9bdb52d04dc20036dbd8313ed055', 'correo@correo.cl', 12345678, 'calle 1', '2020-11-28', 'administrador', '1', '2020-12-17 15:25:52'),
(123456780, '81dc9bdb52d04dc20036dbd8313ed055', 'hola@gmail.com', 123456789, 'mi casa', '2020-12-01', 'invitado', '3', '2020-12-16 00:17:40'),
(123456789, '81dc9bdb52d04dc20036', 'hola@gmail.com', 123456789, 'hola', '2020-12-11', 'invitado', '3', NULL),
(556667778, '1234', 'correo@correo.cl', 12345678, 'calle 2', '2020-11-28', 'alumno', '2', NULL),
(987654321, '81dc9bdb52d04dc20036dbd8313ed055', 'hola@gmail.com', 985414042, 'hola', '2020-12-18', 'invitado', '3', '2020-12-17 15:28:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE `edificio` (
  `id_edificio` int(11) NOT NULL,
  `nombre_edificio` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `aforo_total` int(5) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `aforo_permitido` int(3) NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`id_edificio`, `nombre_edificio`, `aforo_total`, `descripcion`, `aforo_permitido`, `fecha_ingreso`, `fecha_modificacion`, `latitud`, `longitud`) VALUES
(14, 'PRUEBA', 10, '', 20, '2020-12-14 17:02:29', NULL, 0, 0),
(20, 'Escuela de periodismo', 1000, '', 20, '2020-12-27 21:10:34', NULL, 0, 0),
(21, 'Facultad de ciencias', 1000, '', 20, '2020-12-27 21:12:34', NULL, 0, 0),
(22, 'Facultad de ciencias económica', 1000, '', 20, '2020-12-27 21:12:34', NULL, 0, 0),
(23, 'Facultad de educación', 1000, '', 20, '2020-12-27 21:13:50', NULL, 0, 0),
(24, 'Facultad de ingeniería', 1000, '', 20, '2020-12-27 21:13:50', NULL, 0, 0),
(25, 'Facultad de medicina', 1000, '', 20, '2020-12-27 21:15:09', NULL, 0, 0),
(26, 'Instituto de Teología', 1000, '', 20, '2020-12-27 21:15:09', NULL, 0, 0),
(27, 'Kinesiología ', 1000, '', 20, '2020-12-27 21:15:26', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `max_desplazamiento`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `max_desplazamiento` (
`id_edificio` int(11)
,`prueba_max` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `id_oficina` int(11) NOT NULL,
  `id_edificio` int(11) NOT NULL,
  `rut_persona` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permanecer`
--

CREATE TABLE `permanecer` (
  `id_permanecer` int(11) NOT NULL,
  `rut_persona` int(11) NOT NULL,
  `id_edificio` int(11) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `fecha_salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permanecer`
--

INSERT INTO `permanecer` (`id_permanecer`, `rut_persona`, `id_edificio`, `fecha_entrada`, `fecha_salida`) VALUES
(48, 12345678, 14, '2020-12-10 15:18:26', '2020-12-10 15:24:27'),
(49, 112223334, 14, '2020-12-10 15:23:38', '2020-12-10 15:23:43'),
(50, 112223334, 14, '2020-12-10 15:23:49', '2020-12-10 15:24:15'),
(51, 112223334, 14, '2020-12-10 15:24:21', '2020-12-10 15:25:32'),
(52, 12345678, 14, '2020-12-10 15:24:33', NULL),
(53, 44444444, 14, '2020-12-12 21:03:29', '2020-12-12 21:03:34'),
(54, 44444444, 14, '2020-12-12 21:03:39', '2020-12-12 21:04:52'),
(55, 44444444, 14, '2020-12-12 21:05:14', '2020-12-12 21:05:19'),
(56, 112223334, 14, '2020-12-12 21:20:00', '2020-12-12 21:25:17'),
(57, 112223334, 14, '2020-12-12 21:25:22', '2020-12-12 21:36:48'),
(58, 112223334, 14, '2020-12-12 21:37:36', '2020-12-12 21:37:48'),
(59, 112223334, 14, '2020-12-12 21:43:07', '2020-12-12 21:46:49'),
(60, 112223334, 14, '2020-12-12 21:46:58', '2020-12-12 22:22:47'),
(61, 112223334, 14, '2020-12-12 22:22:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `rut_persona` int(9) NOT NULL,
  `nombre_persona` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`rut_persona`, `nombre_persona`) VALUES
(11111111, 'Pepe Lota'),
(12345678, 'Jean Trozo'),
(22222222, 'Pepe Tenis'),
(33333333, 'Pepe Voley'),
(44444444, 'Pepe Basket'),
(112223334, 'Juan Perez'),
(123456780, 'Jean Perez'),
(123456789, 'hola'),
(556667778, 'Rodolfo Rodriguez'),
(987654321, 'carlos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_oficina`
--

CREATE TABLE `personal_oficina` (
  `rut_persona` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `personal_oficina`
--

INSERT INTO `personal_oficina` (`rut_persona`) VALUES
(112223334);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_requerido`
--

CREATE TABLE `personal_requerido` (
  `rut_persona` int(9) NOT NULL,
  `rol_personal_requerido` enum('mantencion','seguridad','auxiliar de aseo','') COLLATE utf8_spanish2_ci NOT NULL,
  `id_edificio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `personal_requerido`
--

INSERT INTO `personal_requerido` (`rut_persona`, `rol_personal_requerido`, `id_edificio`) VALUES
(12345678, 'auxiliar de aseo', 14);

-- --------------------------------------------------------

--
-- Estructura para la vista `max_desplazamiento`
--
DROP TABLE IF EXISTS `max_desplazamiento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max_desplazamiento`  AS  (select `max_f`.`id_edificio` AS `id_edificio`,max(`max_f`.`mayor_d`) AS `prueba_max` from (select count(`permanecer`.`fecha_entrada`) AS `mayor_d`,`permanecer`.`id_edificio` AS `id_edificio` from (`permanecer` join `edificio` on(`permanecer`.`id_edificio` = `edificio`.`id_edificio`)) group by hour(`permanecer`.`fecha_entrada`)) `max_f` group by `max_f`.`id_edificio` desc) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`rut_persona`);

--
-- Indices de la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`id_edificio`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`id_oficina`),
  ADD KEY `id_edificio` (`id_edificio`),
  ADD KEY `rut_persona` (`rut_persona`);

--
-- Indices de la tabla `permanecer`
--
ALTER TABLE `permanecer`
  ADD PRIMARY KEY (`id_permanecer`),
  ADD KEY `rut_persona` (`rut_persona`),
  ADD KEY `id_edificio` (`id_edificio`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`rut_persona`);

--
-- Indices de la tabla `personal_oficina`
--
ALTER TABLE `personal_oficina`
  ADD PRIMARY KEY (`rut_persona`);

--
-- Indices de la tabla `personal_requerido`
--
ALTER TABLE `personal_requerido`
  ADD PRIMARY KEY (`rut_persona`),
  ADD KEY `id_edificio` (`id_edificio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `id_edificio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permanecer`
--
ALTER TABLE `permanecer`
  MODIFY `id_permanecer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD CONSTRAINT `oficina_ibfk_1` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oficina_ibfk_2` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permanecer`
--
ALTER TABLE `permanecer`
  ADD CONSTRAINT `permanecer_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personal_oficina`
--
ALTER TABLE `personal_oficina`
  ADD CONSTRAINT `personal_oficina_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal_requerido`
--
ALTER TABLE `personal_requerido`
  ADD CONSTRAINT `personal_requerido_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_requerido_ibfk_2` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

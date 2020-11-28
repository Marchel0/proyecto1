-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2020 a las 00:15:42
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
  `rut_usuario` int(9) NOT NULL,
  `clave` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimineto` date NOT NULL,
  `tipo_cuenta` enum('alumno','administrador','docente','administrativa','invitado','auxiliar de aseo','mantencion') COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_qr` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE `edificio` (
  `id_edificio` int(11) NOT NULL,
  `nombre_edificio` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `aforo_total` int(5) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `id_oficina` int(11) NOT NULL,
  `id_edificio` int(11) NOT NULL,
  `rut_persona` int(9) NOT NULL
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
  `fecha_salida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `rut_persona` int(9) NOT NULL,
  `nombre_persona` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_oficina`
--

CREATE TABLE `personal_oficina` (
  `rut_persona` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_requerido`
--

CREATE TABLE `personal_requerido` (
  `rut_persona` int(9) NOT NULL,
  `rol_personal_requerido` enum('mantencion','seguridad','auxiliar de aseo','') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`rut_usuario`);

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
  ADD PRIMARY KEY (`rut_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `id_edificio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permanecer`
--
ALTER TABLE `permanecer`
  MODIFY `id_permanecer` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`rut_usuario`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `permanecer_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permanecer_ibfk_2` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personal_oficina`
--
ALTER TABLE `personal_oficina`
  ADD CONSTRAINT `personal_oficina_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal_requerido`
--
ALTER TABLE `personal_requerido`
  ADD CONSTRAINT `personal_requerido_ibfk_1` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

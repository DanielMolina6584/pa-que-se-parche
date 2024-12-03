-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2024 a las 20:35:17
-- Versión del servidor: 10.11.6-MariaDB-0+deb12u1
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pa_que_se_parche`
--


--
-- Estructura de tabla para la tabla `consolas`
--

CREATE TABLE `consolas` (
  `id` bigint(20) NOT NULL,
  `nombre` text NOT NULL,
  `marca` text NOT NULL,
  `estado` int(11) NOT NULL,
  `sala_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `horarios_disponibilidades`
--

CREATE TABLE `horarios_disponibilidades` (
  `id` bigint(20) NOT NULL,
  `consola_id` bigint(20) DEFAULT NULL,
  `sala_id` bigint(20) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_permisos`
--

CREATE TABLE `menu_permisos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo` text NOT NULL,
  `usuario_empresarial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_horas_juego`
--

CREATE TABLE `precios_horas_juego` (
  `id` bigint(20) NOT NULL,
  `consola_id` bigint(20) DEFAULT NULL,
  `precio_por_hora` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_clientes`
--

CREATE TABLE `registro_clientes` (
  `id` bigint(20) NOT NULL,
  `cliente_id` bigint(20) DEFAULT NULL,
  `horario_id` bigint(20) DEFAULT NULL,
  `consola_usada_id` bigint(20) DEFAULT NULL,
  `precio_a_pagar` decimal(10,2) NOT NULL,
  `pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas_de_juego`
--

CREATE TABLE `salas_de_juego` (
  `id` bigint(20) NOT NULL,
  `nombre` text NOT NULL,
  `ubicacion` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salas_de_juego`
--

INSERT INTO `salas_de_juego` (`id`, `nombre`, `ubicacion`, `estado`) VALUES
(1, 'lo mas agogo', 'vip', 1),
(2, 'piras', 'general', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_clientes`
--

CREATE TABLE `usuarios_clientes` (
  `id` bigint(20) NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `id` bigint(20) NOT NULL,
  `titulo` text NOT NULL,
  `genero` text NOT NULL,
  `consola_id` bigint(20) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Indices de la tabla `consolas`
--
ALTER TABLE `consolas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios_disponibilidades`
--
ALTER TABLE `horarios_disponibilidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consola_id` (`consola_id`),
  ADD KEY `sala_id` (`sala_id`);
--

-- Indices de la tabla `menu_permisos`
--
ALTER TABLE `menu_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios_horas_juego`
--
ALTER TABLE `precios_horas_juego`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consola_id` (`consola_id`);

--
-- Indices de la tabla `registro_clientes`
--
ALTER TABLE `registro_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `horario_id` (`horario_id`),
  ADD KEY `consola_usada_id` (`consola_usada_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas_de_juego`
--
ALTER TABLE `salas_de_juego`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_clientes`
--
ALTER TABLE `usuarios_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indices de la tabla `usuarios_empresariales`
--
ALTER TABLE `usuarios_empresariales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consola_id` (`consola_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consolas`
--
ALTER TABLE `consolas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;


-- AUTO_INCREMENT de la tabla `horarios_disponibilidades`
--
ALTER TABLE `horarios_disponibilidades`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu_permisos`
--
ALTER TABLE `menu_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios_horas_juego`
--
ALTER TABLE `precios_horas_juego`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_clientes`
--
ALTER TABLE `registro_clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salas_de_juego`
--
ALTER TABLE `salas_de_juego`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_clientes`
--
ALTER TABLE `usuarios_clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_empresariales`
--
ALTER TABLE `usuarios_empresariales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horarios_disponibilidades`
--
ALTER TABLE `horarios_disponibilidades`
  ADD CONSTRAINT `horarios_disponibilidades_ibfk_1` FOREIGN KEY (`consola_id`) REFERENCES `consolas` (`id`),
  ADD CONSTRAINT `horarios_disponibilidades_ibfk_2` FOREIGN KEY (`sala_id`) REFERENCES `salas_de_juego` (`id`);

--
-- Filtros para la tabla `precios_horas_juego`
--
ALTER TABLE `precios_horas_juego`
  ADD CONSTRAINT `precios_horas_juego_ibfk_1` FOREIGN KEY (`consola_id`) REFERENCES `consolas` (`id`);

--
-- Filtros para la tabla `registro_clientes`
--
ALTER TABLE `registro_clientes`
  ADD CONSTRAINT `registro_clientes_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios_clientes` (`id`),
  ADD CONSTRAINT `registro_clientes_ibfk_2` FOREIGN KEY (`horario_id`) REFERENCES `horarios_disponibilidades` (`id`),
  ADD CONSTRAINT `registro_clientes_ibfk_3` FOREIGN KEY (`consola_usada_id`) REFERENCES `consolas` (`id`);

--
-- Filtros para la tabla `usuarios_empresariales`
--
ALTER TABLE `usuarios_empresariales`
  ADD CONSTRAINT `usuarios_empresariales_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD CONSTRAINT `videojuegos_ibfk_1` FOREIGN KEY (`consola_id`) REFERENCES `consolas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

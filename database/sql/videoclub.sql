-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2023 a las 16:26:26
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id` int(11) NOT NULL,
  `cliente_dato_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`id`, `cliente_dato_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 13, '2023-01-31 14:41:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_datos`
--

CREATE TABLE `clientes_datos` (
  `id` int(11) NOT NULL,
  `cliente_dato_num_identificacion` varchar(20) NOT NULL,
  `cliente_dato_nombres` varchar(60) NOT NULL,
  `cliente_dato_apellidos` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes_datos`
--

INSERT INTO `clientes_datos` (`id`, `cliente_dato_num_identificacion`, `cliente_dato_nombres`, `cliente_dato_apellidos`, `created_at`, `updated_at`) VALUES
(13, '12346789', 'ulo', 'chavez', '2023-01-31 14:39:38', '2023-01-31 14:39:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas_datos`
--

CREATE TABLE `peliculas_datos` (
  `id` int(11) NOT NULL,
  `pelicula_dato_nombre` varchar(260) NOT NULL,
  `pelicula_dato_sinopsis` text NOT NULL,
  `pelicula_dato_precio_unitario` float(100,2) NOT NULL,
  `pelicula_dato_fecha_estreno` date NOT NULL,
  `pelicula_tipo_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas_datos`
--

INSERT INTO `peliculas_datos` (`id`, `pelicula_dato_nombre`, `pelicula_dato_sinopsis`, `pelicula_dato_precio_unitario`, `pelicula_dato_fecha_estreno`, `pelicula_tipo_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'uno', 'uno dos tres', 2000.00, '2023-01-30', 4, '2023-01-31 04:44:31', NULL, NULL),
(11, 'dos', 'dos tres cuatro', 5000.00, '2023-01-31', 4, '2023-01-31 13:16:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas_datos_alquileres`
--

CREATE TABLE `peliculas_datos_alquileres` (
  `id` int(11) NOT NULL,
  `alquiler_id` int(11) NOT NULL,
  `pelicula_dato_id` int(11) NOT NULL,
  `pelicula_dato_alquiler_fecha_inicio` date NOT NULL,
  `pelicula_dato_alquiler_fecha_fin` date NOT NULL,
  `pelicula_dato_alquiler_valor_pagar` float(100,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas_datos_alquileres`
--

INSERT INTO `peliculas_datos_alquileres` (`id`, `alquiler_id`, `pelicula_dato_id`, `pelicula_dato_alquiler_fecha_inicio`, `pelicula_dato_alquiler_fecha_fin`, `pelicula_dato_alquiler_valor_pagar`, `created_at`, `updated_at`) VALUES
(24, 10, 10, '2023-01-31', '2023-02-01', 2000.00, '2023-01-31 14:41:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas_generos`
--

CREATE TABLE `peliculas_generos` (
  `id` int(11) NOT NULL,
  `pelicula_genero_nombre` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas_generos`
--

INSERT INTO `peliculas_generos` (`id`, `pelicula_genero_nombre`, `created_at`, `updated_at`) VALUES
(13, 'Infantil', '2023-01-31 04:43:18', NULL),
(14, 'Romantico', '2023-01-31 04:43:38', NULL),
(15, 'Accion', '2023-01-31 13:18:54', NULL),
(16, 'Suspenso', '2023-01-31 13:19:08', '2023-01-31 13:19:53'),
(17, 'Ficcion', '2023-01-31 13:19:41', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas_generos_datos`
--

CREATE TABLE `peliculas_generos_datos` (
  `id` int(11) NOT NULL,
  `pelicula_dato_id` int(11) NOT NULL,
  `pelicula_genero_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas_generos_datos`
--

INSERT INTO `peliculas_generos_datos` (`id`, `pelicula_dato_id`, `pelicula_genero_id`, `created_at`, `updated_at`) VALUES
(35, 10, 13, '2023-01-31 04:44:32', NULL),
(36, 10, 14, '2023-01-31 04:44:32', NULL),
(37, 11, 13, '2023-01-31 13:16:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas_tipos`
--

CREATE TABLE `peliculas_tipos` (
  `id` int(11) NOT NULL,
  `pelicula_tipo_nombre` varchar(40) NOT NULL,
  `pelicula_tipo_dia_adicional_desde` int(4) NOT NULL,
  `pelicula_tipo_porcent_dia_adicional` int(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas_tipos`
--

INSERT INTO `peliculas_tipos` (`id`, `pelicula_tipo_nombre`, `pelicula_tipo_dia_adicional_desde`, `pelicula_tipo_porcent_dia_adicional`, `created_at`, `updated_at`) VALUES
(3, 'Nuevos lanzamientos', 0, 0, '2023-01-30 19:42:24', '2023-01-30 19:42:26'),
(4, 'Películas normales', 3, 15, '2023-01-30 19:33:09', NULL),
(5, 'Películas viejas', 5, 10, '2023-01-30 19:30:36', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_dato_id` (`cliente_dato_id`);

--
-- Indices de la tabla `clientes_datos`
--
ALTER TABLE `clientes_datos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cliente_dato_num_identificacion` (`cliente_dato_num_identificacion`);

--
-- Indices de la tabla `peliculas_datos`
--
ALTER TABLE `peliculas_datos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelicula_tipo_id` (`pelicula_tipo_id`);

--
-- Indices de la tabla `peliculas_datos_alquileres`
--
ALTER TABLE `peliculas_datos_alquileres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelicula_dato_id` (`pelicula_dato_id`),
  ADD KEY `alquiler_id` (`alquiler_id`);

--
-- Indices de la tabla `peliculas_generos`
--
ALTER TABLE `peliculas_generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas_generos_datos`
--
ALTER TABLE `peliculas_generos_datos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelicula_dato_id` (`pelicula_dato_id`),
  ADD KEY `pelicula_genero_id` (`pelicula_genero_id`);

--
-- Indices de la tabla `peliculas_tipos`
--
ALTER TABLE `peliculas_tipos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clientes_datos`
--
ALTER TABLE `clientes_datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `peliculas_datos`
--
ALTER TABLE `peliculas_datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `peliculas_datos_alquileres`
--
ALTER TABLE `peliculas_datos_alquileres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `peliculas_generos`
--
ALTER TABLE `peliculas_generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `peliculas_generos_datos`
--
ALTER TABLE `peliculas_generos_datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `peliculas_tipos`
--
ALTER TABLE `peliculas_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`cliente_dato_id`) REFERENCES `clientes_datos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `peliculas_datos`
--
ALTER TABLE `peliculas_datos`
  ADD CONSTRAINT `peliculas_datos_ibfk_1` FOREIGN KEY (`pelicula_tipo_id`) REFERENCES `peliculas_tipos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `peliculas_datos_alquileres`
--
ALTER TABLE `peliculas_datos_alquileres`
  ADD CONSTRAINT `peliculas_datos_alquileres_ibfk_1` FOREIGN KEY (`pelicula_dato_id`) REFERENCES `peliculas_datos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peliculas_datos_alquileres_ibfk_2` FOREIGN KEY (`alquiler_id`) REFERENCES `alquileres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `peliculas_generos_datos`
--
ALTER TABLE `peliculas_generos_datos`
  ADD CONSTRAINT `peliculas_generos_datos_ibfk_1` FOREIGN KEY (`pelicula_dato_id`) REFERENCES `peliculas_datos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peliculas_generos_datos_ibfk_2` FOREIGN KEY (`pelicula_genero_id`) REFERENCES `peliculas_generos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

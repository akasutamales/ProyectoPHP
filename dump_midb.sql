-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2020 a las 00:23:20
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `midb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camas`
--

CREATE TABLE `camas` (
  `id` int(11) NOT NULL,
  `disponible` bit(1) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `habitacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `camas`
--

INSERT INTO `camas` (`id`, `disponible`, `codigo`, `habitacion_id`) VALUES
(1, b'0', 'B', 1),
(4, b'0', 'A', 2),
(5, b'0', 'B', 2),
(6, b'0', 'C', 2),
(7, b'0', 'C10', 1),
(10, b'1', 'C1', 5),
(11, b'0', 'C2', 5),
(12, b'1', 'C3', 5),
(13, b'1', 'C4', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `disponibles` int(11) NOT NULL,
  `asignados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `codigo`, `disponibles`, `asignados`) VALUES
(1, 'Ventilador', 5, 0),
(2, 'Tomógrafo', 1, 2),
(3, 'marcapasos', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `codigo`) VALUES
(1, '10'),
(2, '20'),
(5, 'H1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `diagnostico` varchar(45) NOT NULL,
  `prioridad` varchar(10) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estadia` int(11) NOT NULL,
  `cama_id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `cedula`, `nombre`, `diagnostico`, `prioridad`, `fecha_ingreso`, `estadia`, `cama_id`, `medico_id`) VALUES
(2, '123', 'Daniel Beltran', 'Enfermo', 'Alta', '2020-12-31', 2, 4, 4),
(3, '123', 'Francisco', 'COVID', 'baja', '2019-12-31', 3, 1, 3),
(4, '300', 'Diego', 'enfermedad leve', 'media', '2021-02-04', 4, 6, 3),
(5, '500', 'Ana', 'leve', 'baja', '2020-06-19', 3, 5, 3),
(6, '500', 'Diana', 'tos seca', 'media', '2020-06-04', 5, 7, 4),
(7, '500', 'Laura', 'grave', 'Alta', '2019-12-31', 3, 11, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `unidad_medida` varchar(45) NOT NULL,
  `cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `nombre`, `unidad_medida`, `cantidad`) VALUES
(1, 'tapabocas', 'unidades', 13),
(2, 'suero', 'ml', 2000),
(3, 'Jeringa', 'unidades', 4),
(4, 'curita', 'unidades', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `aprobado` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `cantidad`, `equipo_id`, `aprobado`, `paciente_id`, `medico_id`, `fecha`) VALUES
(2, 0, 3, -1, 4, 3, '2020-06-03 16:41:44'),
(7, 0, 2, 1, 4, 3, '2020-06-03 16:48:48'),
(9, 2, 2, 1, 2, 4, '2020-06-03 16:54:41'),
(10, 2, 1, 0, 7, 6, '2020-06-03 16:59:12'),
(11, 1, 1, 0, 3, 3, '2020-06-03 17:17:22'),
(12, 1, 1, 0, 4, 3, '2020-06-03 17:17:30'),
(13, 1, 3, 1, 5, 3, '2020-06-03 17:17:41'),
(14, 2, 1, 0, 6, 4, '2020-06-03 17:17:59'),
(15, 1, 1, 0, 2, 4, '2020-06-03 17:18:09'),
(16, 1, 3, 1, 7, 6, '2020-06-03 17:21:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `email`, `rol`, `nombre`) VALUES
(1, 'admin', '$6$rounds=5000$unsaltcheveredee$hYpT7h1xPk5zOSEdGr7M7jIaA7kj78DmgI0nEkoz/tD5ooQ/JHcDTiHd5Fzey7O4c8eCjeqaZVPmeWjJaMEiL/', 'akasutamales@gmail.com', 'Admin', 'Akasutamales'),
(3, 'camilin', '$6$rounds=5000$unsaltcheveredee$xLSSFRbaKMSw6V/2gTncrtTcbkrAR7x2IrFSR39eVMs4m1wSglD7OhBWnhW6v2YfGxTYPiOGNf8z1jy/U7kxs1', 'akasutamales@gmail.com', 'Medico', 'Camilo Moreno'),
(4, 'danilo', '$6$rounds=5000$unsaltcheveredee$xLSSFRbaKMSw6V/2gTncrtTcbkrAR7x2IrFSR39eVMs4m1wSglD7OhBWnhW6v2YfGxTYPiOGNf8z1jy/U7kxs1', 'akasutamales@gmail.com', 'Medico', 'Daniel Beltrán'),
(5, 'andres', '$6$rounds=5000$unsaltcheveredee$hYpT7h1xPk5zOSEdGr7M7jIaA7kj78DmgI0nEkoz/tD5ooQ/JHcDTiHd5Fzey7O4c8eCjeqaZVPmeWjJaMEiL/', 'akasutamales@gmail.com', 'Admin', 'Andrés L'),
(6, 'vale', '$6$rounds=5000$unsaltcheveredee$hYpT7h1xPk5zOSEdGr7M7jIaA7kj78DmgI0nEkoz/tD5ooQ/JHcDTiHd5Fzey7O4c8eCjeqaZVPmeWjJaMEiL/', 'akasutamales@gmail.com', 'Medico', 'Valentina'),
(7, 'admin2', '$6$rounds=5000$unsaltcheveredee$hYpT7h1xPk5zOSEdGr7M7jIaA7kj78DmgI0nEkoz/tD5ooQ/JHcDTiHd5Fzey7O4c8eCjeqaZVPmeWjJaMEiL/', 'akasutamales@gmail.com', 'Admin', 'Camilo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camas`
--
ALTER TABLE `camas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkIdx_34` (`habitacion_id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkIdx_24` (`cama_id`),
  ADD KEY `fkIdx_95` (`medico_id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkIdx_75` (`equipo_id`),
  ADD KEY `fkIdx_85` (`paciente_id`),
  ADD KEY `fkIdx_98` (`medico_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camas`
--
ALTER TABLE `camas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camas`
--
ALTER TABLE `camas`
  ADD CONSTRAINT `FK_34` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `FK_24` FOREIGN KEY (`cama_id`) REFERENCES `camas` (`id`),
  ADD CONSTRAINT `FK_95` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `FK_75` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `FK_85` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `FK_98` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

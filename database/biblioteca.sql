-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2023 a las 09:45:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `nombre_alumno` text NOT NULL,
  `semestre` int(11) NOT NULL,
  `estado_alumno` enum('Activo','Baja') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `matricula`, `nombre_alumno`, `semestre`, `estado_alumno`) VALUES
(1, 19180054, 'Arturo Salas Hernandez', 6, 'Activo'),
(2, 19180010, 'Jorge Villarreal Vélez', 1, 'Activo'),
(14, 12345679, 'Julián Gomez Pérez', 1, 'Activo'),
(17, 19183344, 'Ramón Dante Fernández', 1, 'Activo'),
(19, 15120143, 'Jesús Macedo López', 1, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text NOT NULL,
  `descripcion_categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'Cuentos', 'Libros que cuentan historias de diferentes tipos ambientados en diferentes lugares'),
(2, 'Poemas', 'Libros que almacenan gran variedad de poemas y liricas'),
(3, 'Informativos', 'Libros que contienen amplia informacion de aprendizaje de multiples temas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL,
  `nombre_editorial` text NOT NULL,
  `pais_editorial` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id_editorial`, `nombre_editorial`, `pais_editorial`) VALUES
(1, 'Marcombo', 'Brazil'),
(2, 'Alfa Omega', 'Mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo_libro` text NOT NULL,
  `id_editorial` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `unidades_totales` int(4) NOT NULL DEFAULT 1,
  `unidades_restantes` int(11) NOT NULL,
  `imagen_portada` text NOT NULL DEFAULT 'portada_default.png',
  `descripcion` text NOT NULL,
  `estado_libro` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo_libro`, `id_editorial`, `id_categoria`, `unidades_totales`, `unidades_restantes`, `imagen_portada`, `descripcion`, `estado_libro`) VALUES
(14, 'El principito Vol. 1', 1, 3, 4, 0, 'Captura de pantalla (110)_6523b4dba2ee8.png', 'Libro en buenas condiciones', 'Activo'),
(19, 'Poemas Edgar Alan Poet', 2, 2, 4, 0, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(20, 'El principito Vol. 2', 1, 1, 2, 0, 'Captura de pantalla (20)_6529f6be36e96.png', 'Libro en buena condición', 'Activo'),
(21, 'Prueba', 2, 2, 2, 0, 'Captura de pantalla (119)_652b546dd8497.png', 'Libro en buena condición', 'Activo'),
(22, 'Prueba2', 1, 1, 3, 0, 'portada_default.png', 'Rallado de la portada', 'Inactivo'),
(23, 'jnafskasfmkl', 1, 1, 20, 0, 'Captura de pantalla (111)_652b584d69c86.png', 'Libro en buena condición', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `unidades_prestamo` int(4) NOT NULL,
  `fecha_prestamo` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado_prestamo` enum('Pendiente','Entregado') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_alumno`, `id_libro`, `unidades_prestamo`, `fecha_prestamo`, `fecha_entrega`, `id_usuario`, `estado_prestamo`) VALUES
(11, 1, 14, 1, '2023-10-15 01:33:45', '2023-10-15', 1, 'Pendiente'),
(12, 14, 19, 2, '2023-10-15 01:48:09', '2023-10-15', 1, 'Pendiente'),
(13, 2, 19, 1, '2023-10-15 02:09:18', '2023-10-15', 1, 'Entregado'),
(14, 2, 14, 1, '2023-10-15 02:15:15', '2023-10-15', 1, 'Pendiente'),
(15, 17, 20, 23, '2023-10-15 02:18:11', '2023-10-29', 1, 'Entregado'),
(16, 1, 23, 4, '2023-10-15 03:12:11', '2023-10-25', 1, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `rol_usuario` enum('Admin','Usuario') NOT NULL DEFAULT 'Usuario',
  `usuario` text NOT NULL,
  `contrasenia` text NOT NULL,
  `nombre_usuario` text NOT NULL,
  `telefono_usuario` varchar(18) NOT NULL,
  `correo_usuario` text NOT NULL,
  `creacion_cuenta` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_usuario` enum('Activo','Suspendido') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol_usuario`, `usuario`, `contrasenia`, `nombre_usuario`, `telefono_usuario`, `correo_usuario`, `creacion_cuenta`, `estado_usuario`) VALUES
(1, 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Yatzamil Román Ángeles', '924 143 5497', 'admin@gmail.com', '2023-10-06 23:02:18', 'Activo'),
(5, 'Usuario', 'Marcos', 'dfadc855249b015fd2bb015c0b099b2189c58748', 'Marcos Osorio Juáres', '(924) 342-5347', 'marcos12@gmail.com', '2023-10-08 05:35:13', 'Activo'),
(23, 'Usuario', 'arturo15', '65e313615c709400f57b2c19b11931eabffd8cf6', 'Arturo salas hernandez', '(111) 111-1111', 'correo@gmail.com', '2023-10-14 19:17:19', 'Activo'),
(26, 'Usuario', 'NuevoUser', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'Prueba', '(923) 435-4675', 'nuevo@gmail.com', '2023-10-14 20:33:31', 'Activo'),
(28, 'Usuario', 'Arturo20', 'dce3b12e8d1767cf1416c2f73b7d0f83c5ed5976', 'SALAS HERNANDEZ ARTURO', '(924) 143-5497', 'salashernandez@gmail.com', '2023-10-15 03:09:04', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD KEY `id_editorial` (`id_editorial`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_libro` (`id_libro`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_editorial`) REFERENCES `editoriales` (`id_editorial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

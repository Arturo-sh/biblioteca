-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2023 a las 09:58:10
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
(1, 19180054, 'Arturo Salas Hernandez', 1, 'Activo'),
(2, 19180010, 'Jorge Villarreal Vélez', 5, 'Activo'),
(3, 19180056, 'Daniela Mendez Gutierrez', 4, 'Activo'),
(4, 19180059, 'Mario Mendoza Arias', 1, 'Activo'),
(5, 19180045, 'Carlos Gutierrez Lopez', 4, 'Activo'),
(6, 87654321, 'Claudia Chavez Fernandez', 2, 'Activo'),
(7, 19180051, 'Prueba edit', 6, 'Activo'),
(8, 19180023, 'Lucia Canseco Gomez', 2, 'Activo'),
(9, 19103412, 'Monica Escamilla Morales', 6, 'Activo'),
(10, 1100110, 'Facundo Montes Alemán', 1, 'Activo'),
(11, 24356786, '', 1, 'Activo'),
(12, 23456754, 'Alejandro', 1, 'Activo'),
(13, 32435674, 'Melany Moscada Zamora', 1, 'Activo'),
(14, 12345678, 'Julian Gomez Perez', 1, 'Baja'),
(16, 20242627, 'Alejandra Villarreal Vélez', 6, 'Activo'),
(17, 19183344, 'Ramon Dante Fernandez', 2, 'Activo');

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
  `imagen_portada` text NOT NULL DEFAULT 'portada_default.png',
  `descripcion` text NOT NULL,
  `estado_libro` enum('Activo','Suspendido') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo_libro`, `id_editorial`, `id_categoria`, `unidades_totales`, `imagen_portada`, `descripcion`, `estado_libro`) VALUES
(1, 'Programacion En Java 8', 2, 3, 2, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(2, 'Mitos y leyendas', 1, 1, 3, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(3, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(4, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(5, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(6, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(7, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(8, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(9, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(10, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(11, 'Programacion en C#', 2, 3, 4, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(12, 'El principito', 2, 2, 10, 'portada_default.png', 'Libro en buenas condiciones', 'Activo'),
(14, 'Prueba de insercion de libro 1', 1, 3, 4, 'Captura de pantalla (110)_6523b4dba2ee8.png', 'Libro en buenas condiciones', 'Suspendido'),
(15, 'Poemas Edgar Alan Poe', 1, 2, 1, 'Captura de pantalla (15)_65247c1eb2b09.png', 'Libro en buena condición', 'Activo'),
(16, 'Prueba', 1, 1, 3, 'Captura de pantalla (1)_6524b29a8bff8.png', 'Libro en buena condición', 'Activo');

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
  `detalles_entrega` text NOT NULL DEFAULT 'Pendiente',
  `estado_prestamo` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_alumno`, `id_libro`, `unidades_prestamo`, `fecha_prestamo`, `fecha_entrega`, `id_usuario`, `detalles_entrega`, `estado_prestamo`) VALUES
(1, 4, 2, 4, '2023-10-10 00:10:17', '2023-10-27', 1, 'Pendiente', 'Activo'),
(2, 2, 2, 1, '2023-10-10 00:10:17', '2023-10-07', 2, 'Pendiente', 'Activo'),
(3, 5, 2, 4, '2023-10-10 00:10:17', '2023-10-10', 1, 'Pendiente', 'Activo');

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
(2, 'Usuario', 'ArturoPrueba', 'e8bc682de39f8160e26870ce75968bfd56ccc87b', 'Jose Carlos Mendoza Cardenas', '(924) 143-5498', 'arturo@gmail.com', '2023-10-07 23:40:43', 'Activo'),
(4, 'Usuario', 'Alejandro', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', 'Alejandro Martinez Echeverria', '235 354 5623', 'alejandro@gmail.com', '2023-10-08 02:49:56', 'Activo'),
(5, 'Usuario', 'Marcos', 'dfadc855249b015fd2bb015c0b099b2189c58748', 'Marcos Osorio Juárez', '(924) 342-5347', 'marcos12@gmail.com', '2023-10-08 05:35:13', 'Activo'),
(6, 'Usuario', 'Teodoro', '145a1a1bf4a6e67317c10fc6bde8be3502ac95eb', 'Teodoro Jimenez Mancera', '924 435 2352', 'teodoro@gmail.com', '2023-10-08 07:26:59', 'Activo'),
(7, 'Usuario', 'Gael', 'e7582b9507331a5564b63863c9f53d17cb7fc228', 'Gael Fonseca Uribe', '924 356 2355', 'gael@gmail.com', '2023-10-08 07:28:14', 'Activo'),
(8, 'Usuario', 'Admins', 'c5a2dc3dcb24a8c9c790110e437b2a1960cba13e', 'Arturo Saslas Hernandez', '', 'correo@gmail.com', '2023-10-08 22:40:45', 'Activo'),
(9, 'Usuario', 'administrador', '9dbf7c1488382487931d10235fc84a74bff5d2f4', 's', '', '', '2023-10-09 03:38:23', 'Activo'),
(10, 'Usuario', 'prueba', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'prueba', '', '', '2023-10-09 03:40:23', 'Activo'),
(11, 'Usuario', 'nuevaPrueba', 'af7d6e49fba82594f23ef5a2db30cdec7bb4f90c', 'prueba ssd', '', '', '2023-10-09 03:46:17', 'Activo'),
(12, 'Usuario', 'qwertyui', '8df9b22644c33d73ee63af25d7a727b72ff30e70', 'ertyui', '', '', '2023-10-09 03:50:04', 'Activo'),
(13, 'Usuario', 'prueba2', 'd8c7468774962290ed594c33e79c2c219b2c2f42', 'prueba insercion divida', 'No definido', 'prueba@gmail.com', '2023-10-09 04:15:46', 'Activo'),
(14, 'Usuario', 'prueba3', 'ee5ed95c37d99b7a07981ce3bda95ad246d784e5', 'prueba insercion divida dos', '(924) 143-5499', 'No definido', '2023-10-09 04:16:25', 'Activo'),
(15, 'Usuario', 'nuevoU', '27e947077092f91aea86a2e1e830e83237b9fe44', 'nuevo', '(924) 143-5498', '', '2023-10-09 04:21:51', 'Activo');

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
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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

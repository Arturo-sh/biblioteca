-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2023 a las 17:58:10
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
(1, 19180054, 'Jorge Martínez García', 3, 'Activo'),
(2, 19180010, 'Jorge Villarreal Vélez', 3, 'Activo'),
(14, 12345679, 'Julián Osorio Pérez', 3, 'Activo'),
(17, 19183344, 'Ramón Dante Fernández', 4, 'Baja'),
(19, 15120143, 'Jesús Macedo López', 1, 'Baja'),
(20, 19180090, 'Pedro Casas Montreal', 1, 'Baja'),
(21, 19180023, 'Prueba Alumno siete', 1, 'Baja'),
(22, 19180023, 'Prueba Alumno siete', 3, 'Activo'),
(23, 19180023, 'Prueba Alumno siete', 3, 'Activo'),
(24, 19822412, 'Prueba', 6, 'Baja'),
(25, 19283124, 'Horge', 6, 'Baja'),
(26, 19189943, 'Pedro Hernandez Montiel', 6, 'Baja'),
(27, 18190054, 'Arturo Hernandez Salas', 1, 'Baja'),
(28, 2147483647, 'Aldair Mendoza Fernández', 1, 'Baja'),
(29, 32545634, 'Jose Martinez Garcia', 1, 'Baja'),
(30, 19180010, 'Jose López Contreras', 2, 'Baja'),
(31, 19880422, 'Nuevo Alumno Prueba 1', 2, 'Baja');

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
  `estado_libro` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo_libro`, `id_editorial`, `id_categoria`, `unidades_totales`, `imagen_portada`, `descripcion`, `estado_libro`) VALUES
(14, 'El principito Vol. 1', 1, 3, 3, 'IMG_20210215_103615_652da3168a528.jpg', 'Libro en buenas condiciones', 'Activo'),
(19, 'Poemas Edgar Alan Poet', 2, 2, 4, 'Captura de pantalla (1)_652da2c024bf0.png', 'Libro en buena condición', 'Activo'),
(20, 'El principito Vol. 2', 1, 1, 2, 'IMG_20210324_163134_65312876ce8df.jpg', 'Libro en buena condición', 'Activo'),
(21, 'Prueba', 2, 2, 2, 'Captura de pantalla (119)_652b546dd8497.png', 'Libro en buena condición', 'Activo'),
(22, 'Prueba2', 1, 1, 3000, 'IMG_20210324_163134_653128ac9230f.jpg', 'Rallado de la portada', 'Inactivo'),
(23, 'Cuentos de méxico', 2, 1, 3, 'Captura de pantalla (111)_652b584d69c86.png', 'Libros con ralladuras en la portada', 'Activo'),
(24, 'Aprende a programar en PHP', 1, 3, 2, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(25, 'Don quijote de la mancha', 2, 2, 4, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(27, 'Poemas Edgar Alan Poet', 2, 2, 202, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(28, 'insert', 2, 1, 234, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(29, 'Prueba22', 1, 1, 3, 'Captura de pantalla (3)_65413426198cd.png', 'Rallado de la portada', 'Activo'),
(30, 'insert', 2, 1, 234, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(31, 'Prueba2', 1, 1, 3, 'Captura de pantalla (3)_6541343318d4f.png', 'Rallado de la portada', 'Activo'),
(33, 'prueba', 2, 3, 2, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(34, 'adsdf', 1, 3, 4, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(35, 'Poemas Edgar Alan Poets', 1, 1, 2023, 'portada_default.png', 'Modificado', 'Activo'),
(36, 'Poemas Edgar Alan Poet', 1, 1, 2, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(37, 'Poemas Edgar Alan Poets', 1, 1, 2, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(38, 'Prueba', 1, 2, 3, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(39, 'Prueba insercion', 1, 2, 3, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(40, 'Prueba libro', 1, 1, 3, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(41, 'Prueba libro d', 1, 1, 3, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(42, 'Coca cola', 1, 1, 3, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(43, 'Coca cola', 1, 1, 3, 'portada_default.png', 'Libro en buena condición', 'Activo'),
(44, 'Prueba', 1, 2, 2, 'Captura de pantalla (2)_653082079fa40.png', 'Breve', 'Activo'),
(45, 'Prueba insercion de libro', 2, 3, 200, 'Captura de pantalla (8)_6530827159bf4.png', 'Captura 8', 'Activo'),
(46, 'Nuevo libro', 2, 2, 15, 'Captura de pantalla (12)_65308314eb576.png', 'Captura 12', 'Activo'),
(47, 'Prueba 29', 1, 1, 29, 'Captura de pantalla (5)_653096ec41cf2.png', 'Captura 5', 'Activo'),
(48, 'Prueba de insercion 30', 2, 3, 30, 'Captura de pantalla (96)_65348411342fd.png', 'Captura 8', 'Activo'),
(49, 'Registro 31', 1, 1, 31, '798f290997c158b81a68d69cf52ee4e7_653098d119243.jpg', 'Libro rallado en la pagina 31', 'Activo'),
(50, 'Libro 32 editado', 1, 3, 32, 'portada_default.png', 'Libro en buen estado 32', 'Inactivo'),
(51, 'Prueba 33', 1, 3, 33, 'IMG_20210324_163134_6531282ff2b71.jpg', 'Libro de prueba n 33', 'Activo'),
(52, 'Nuevo Livro', 2, 3, 5, 'Captura de pantalla (121)_653483e931896.png', 'Captura 121', 'Activo'),
(53, 'Nuevo Libro 34 Update', 1, 3, 35, 'Captura de pantalla (131)_65410e87c5cd2.png', 'Se rallo la pasta', 'Inactivo'),
(54, 'Nuevo Libro Para Prestamos De La Biblioteca 24 De Febrero', 1, 1, 10, 'Captura de pantalla (131)_654184385e29e.png', 'Libro recien llegado', 'Activo'),
(55, 'Esta es una prueba de libro con nombre largo para ver el resultado en la seccion de prestamo', 2, 1, 20, 'Captura de pantalla (4)_654185280d3e1.png', 'Excelente', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `unidades_prestamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_transaccion`, `id_libro`, `unidades_prestamo`) VALUES
(86, 27, 14, 1),
(87, 28, 14, 1),
(88, 29, 54, 2),
(90, 31, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_prestamo`
--

CREATE TABLE `transaccion_prestamo` (
  `id_transaccion` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_prestamo` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` date NOT NULL,
  `estado_prestamo` enum('Pendiente','Entregado') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_prestamo`
--

INSERT INTO `transaccion_prestamo` (`id_transaccion`, `id_alumno`, `id_usuario`, `fecha_prestamo`, `fecha_entrega`, `estado_prestamo`) VALUES
(27, 1, 1, '2023-10-31 22:44:25', '2023-10-31', 'Pendiente'),
(28, 1, 1, '2023-10-31 22:46:07', '2023-10-31', 'Pendiente'),
(29, 27, 1, '2023-10-31 22:49:29', '2023-11-01', 'Pendiente'),
(31, 1, 1, '2023-10-31 16:30:44', '2023-11-01', 'Pendiente');

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
(5, 'Admin', 'Marcos', 'dfadc855249b015fd2bb015c0b099b2189c58748', 'Marcos Garcia Juárez', '(924) 342-5347', 'marcos12@gmail.com', '2023-10-08 05:35:13', 'Activo'),
(23, 'Usuario', 'arturo15', '65e313615c709400f57b2c19b11931eabffd8cf6', 'Arturo salas hernandez', '(111) 111-1111', 'correo@gmail.com', '2023-10-14 19:17:19', 'Activo'),
(28, 'Admin', 'Arturo1512', 'e8bc682de39f8160e26870ce75968bfd56ccc87b', 'SALAS HERNANDEZ ARTURO', '(924) 143-5497', 'salashernandez@gmail.com', '2023-10-15 03:09:04', 'Suspendido'),
(32, 'Usuario', 'Arturo902', 'e8bc682de39f8160e26870ce75968bfd56ccc87b', 'Arturo Mancera Gomez', '(354) 657-7653', 'correo@gmail.com', '2023-10-17 01:05:43', 'Activo'),
(33, 'Usuario', 'qwerty', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'qwerty', '(345) 432-2435', 'correo@gmail.com', '2023-10-17 01:10:29', 'Activo'),
(34, 'Usuario', 'admins', '78220db283035fcb69a4281adbc00e17d0018a71', 'asdfsdf', '(434) 522-4635', 'correo@gmail.com', '2023-10-17 01:39:14', 'Activo'),
(35, 'Usuario', 'prueba', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'Prueba Insercion Ajax', '(924) 723-6122', 'ajax@gmail.com', '2023-10-17 01:41:25', 'Activo'),
(36, 'Usuario', 'mei100', '88bad360bf302e910256cbc1aa8473ae4af25ab4', 'Mei', '(824) 356-4743', 'correo@gmail.com', '2023-10-17 01:45:40', 'Activo'),
(38, 'Usuario', 'Marcos', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Marcos Osorio Juáres', '(924) 342-5347', 'marcos12@gmail.com', '2023-10-17 01:55:45', 'Activo'),
(39, 'Usuario', 'PruebaUsuario13', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Prueba insercion de usuario', '(945) 364-7585', 'Acorreo@gmail.com', '2023-10-17 01:55:51', 'Activo'),
(40, 'Usuario', 'preuba', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'prueba de insercion', '(923) 435-4677', 'admin@gmail.com', '2023-10-17 02:07:44', 'Activo'),
(41, 'Admin', 'Prueba', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'Prueba de insercion', '(923) 435-4677', 'admin@gmail.com', '2023-10-17 02:08:16', 'Activo'),
(42, 'Usuario', 'NuevoUsuario', '5043f762841a8c17c7385efd931b64d46ce0b044', 'Nuevo Usuario de prueba', '(924) 356-7585', 'nuevoPrueba@gmail.com', '2023-10-17 02:34:59', 'Activo'),
(49, 'Usuario', 'Nuevo19', '74ee05eda008abd1a76ee10f8492a559dc11f4b1', 'Nuevo Usuario 19', '(123) 424-3314', 'correo19@gmail.com', '2023-10-17 04:11:02', 'Activo'),
(50, 'Admin', 'Prueba167', '612c44c535dfd0b25d398ca3cc23db9119098a06', 'Prueba de registro 167', '(161) 616-1617', 'prueba167@gmail.com', '2023-10-17 04:16:26', 'Activo'),
(51, 'Admin', 'admins', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'prueba', '(234) 331-3234', 'correo@gmail.com', '2023-10-17 04:18:17', 'Activo'),
(55, 'Admin', 'NuevoUser20', '5043f762841a8c17c7385efd931b64d46ce0b044', 'Nuevo 20', '(924) 536-2311', 'cooreo@gmail.com', '2023-10-17 08:04:26', 'Suspendido'),
(57, 'Usuario', 'adminsar', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '(324) 352-3123', 'admin@gmail.com', '2023-10-17 08:15:23', 'Activo'),
(59, 'Admin', 'Ale2024', '2f98fc393008fea0cfac0b59a294657e6b1a5024', 'Alejandra Villarreal Vélez', '(924) 455-2334', 'aleVillarreal@gmail.com', '2023-10-18 20:46:45', 'Activo'),
(60, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-18 21:07:08', 'Activo'),
(61, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-18 21:07:16', 'Activo'),
(62, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-18 21:07:28', 'Activo'),
(63, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-18 21:08:28', 'Activo'),
(64, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-18 21:14:03', 'Activo'),
(65, 'Usuario', 'NuevoUser233', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'Pedro Casto jimenez', '(243) 625-4632', 'coorreo@gmal.com', '2023-10-19 00:20:30', 'Activo'),
(66, 'Usuario', 'Nuevo27', '3f7f1d4c3d1fbe5018c042d4498fea6e69f0ff88', 'Nuevo registro 27', '(923) 834-7748', 'correo27@gmail.com', '2023-10-19 02:42:59', 'Activo'),
(68, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-19 03:36:16', 'Activo'),
(69, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-19 03:42:45', 'Activo'),
(70, 'Usuario', 'Prueba30', 'b68ac55b2c59c71399ddb3329fc916d041a6c04c', 'Registro de prueba 30', '(433) 243-5235', 'prueba30@gmail.com', '2023-10-19 23:21:17', 'Activo'),
(71, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-19 23:30:34', 'Activo'),
(72, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-19 23:36:25', 'Activo'),
(73, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-19 23:36:34', 'Activo'),
(74, 'Usuario', '', 'aff024fe4ab0fece4091de044c58c9ae4233383a', '', '', '', '2023-10-20 01:09:42', 'Activo'),
(75, 'Usuario', 's', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '2023-10-20 01:11:22', 'Activo'),
(76, 'Admin', 'Usuario36', 'e72dde61f4095b352d67b1ecab11b1111b52652a', 'Usuario prueba 36', '(345) 465-7875', 'correo@gmail.com', '2023-10-22 02:06:02', 'Suspendido'),
(77, 'Admin', 'NuevoUsuario37', 'a90c8b09a681c6a15acfc99f9cc63f522cf2c3ab', 'Nuevo Usuario 37', '(923) 487-3699', 'correoUsuario37@gmail.com', '2023-10-31 13:44:25', 'Activo'),
(79, 'Usuario', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '2023-10-31 16:48:57', 'Activo');

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
  ADD KEY `id_libro` (`id_libro`),
  ADD KEY `prestamos_ibfk_1` (`id_transaccion`);

--
-- Indices de la tabla `transaccion_prestamo`
--
ALTER TABLE `transaccion_prestamo`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_alumno` (`id_alumno`),
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
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `transaccion_prestamo`
--
ALTER TABLE `transaccion_prestamo`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_transaccion`) REFERENCES `transaccion_prestamo` (`id_transaccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion_prestamo`
--
ALTER TABLE `transaccion_prestamo`
  ADD CONSTRAINT `transaccion_prestamo_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaccion_prestamo_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

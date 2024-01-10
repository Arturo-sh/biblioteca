-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2024 a las 09:13:20
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `matricula` varchar(11) NOT NULL,
  `nombre_alumno` text NOT NULL,
  `semestre` int(11) NOT NULL,
  `estado_alumno` enum('Activo','Baja') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `matricula`, `nombre_alumno`, `semestre`, `estado_alumno`) VALUES
(1, 'C136001', 'AGUILAR MULATO ARLETTE', 1, 'Activo'),
(2, 'C136002', 'BARRIENTOS TOGA DANIEL ARMANDO', 1, 'Activo'),
(3, 'C136003', 'BAUTISTA ALVARADO VANESA', 1, 'Activo'),
(4, 'C136004', 'CARBAJAL CECILIO ALIZON MICHELL', 1, 'Activo'),
(5, 'C136005', 'DOMINGUEZ TLAPA YAMILETH', 1, 'Activo'),
(6, 'C136006', 'GOMEZ GONZALEZ ISMAEL', 1, 'Activo'),
(7, 'C136007', 'GONZALES PARRA VALENTIN', 1, 'Activo'),
(8, 'C136008', 'ISABEL AGUILAR LEONARDO', 1, 'Activo'),
(9, 'C136009', 'MACEDO HERNANDEZ JOSHELYN', 1, 'Activo'),
(10, 'C136010', 'MULATO MENDEZ GISELLE', 1, 'Activo'),
(11, 'C136011', 'PACHECO ANGEL HEIDI', 1, 'Activo'),
(12, 'C136012', 'PARRA MONTILLO JOEL', 1, 'Activo'),
(13, 'c136013', 'RAMOS GUZMAN DANIEL', 1, 'Activo'),
(14, 'C136014', 'RAMOS GUZMAN DAVID', 1, 'Activo'),
(15, 'C136015', 'SALAS SALAZAR KARINA AYLIN', 1, 'Activo'),
(16, 'C136016', 'SANTIAGO GUTIERRES BRAYAN', 1, 'Activo'),
(17, 'C136017', 'SANTIAGO PEREZ EFRAIN', 1, 'Activo'),
(18, 'C136018', 'CHAMA ARENAL JESUS', 3, 'Activo'),
(19, 'C136019', 'DOMINGUEZ FACUNDO DANNA KRISCEL', 3, 'Activo'),
(20, 'C135474', 'GUZMAN RAMIREZ MARGARITA', 3, 'Activo'),
(21, 'C136020', 'HERNANDEZ BAUTISTA KEVIN', 3, 'Activo'),
(22, 'C136021', 'JIMENEZ SANTIAGO MAYRIN', 3, 'Activo'),
(23, 'C136022', 'PACHECO JESUS ALBERTO', 3, 'Activo'),
(24, 'C136023', 'PACHECO-GALLARDO CESAR', 3, 'Activo'),
(25, 'C136024', 'PEREZ CHAMA JOVANNI', 3, 'Activo'),
(26, 'C136025', 'ROJAS HERNANDEZ ALAN', 3, 'Activo'),
(27, 'C136026', 'SANCHEZ SALGADO ANDIE JULISSA', 3, 'Activo'),
(28, 'C136027', 'SANTIAGO PEREZ ERIC', 3, 'Activo'),
(29, 'C136028', 'SANTIAGO PEREZ NERI', 3, 'Activo'),
(30, 'C136029', 'SANTIAGO TINOCO MARELI', 3, 'Activo'),
(31, 'C136030', 'XALATE VILLANUEVA TANIA JAQUELIN', 3, 'Activo'),
(32, 'C136031', 'DOMINGUEZ TLAPA HEIDY JOSSELYN', 5, 'Activo'),
(33, 'C136032', 'FELIPE REYES AURELIO', 5, 'Activo'),
(34, 'C136033', 'MOLINA DEL ANGEL ALIN AMARIS', 5, 'Activo'),
(35, 'C136034', 'MULATO LIZZETTE', 5, 'Activo'),
(36, 'C136035', 'PACHECO PEREZ OSCAR GIOVANNI', 5, 'Activo'),
(37, 'C136036', 'PARRA MONTILLO ROBERTO', 5, 'Activo'),
(38, 'C136037', 'SALAZAR LOPEZ LITZY', 5, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text NOT NULL,
  `descripcion_categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'Sin categoría', ''),
(2, 'Cuento', ''),
(3, 'Novela', ''),
(4, 'Enciclopedia', ''),
(5, 'Literatura', ''),
(6, 'Biografía', ''),
(7, 'Didáctico', ''),
(8, 'Antología', ''),
(9, 'Tragedia amorosa', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL,
  `nombre_editorial` text NOT NULL,
  `pais_editorial` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id_editorial`, `nombre_editorial`, `pais_editorial`) VALUES
(1, 'Ediciones Leyenda, S.A. de C.V.', 'México'),
(2, 'Editorial Planeta Mexicana, S.A. de C.V.', 'México'),
(3, 'Editores Mexicanos Unidos, S.A.', ''),
(4, 'San Pablo', ''),
(5, 'Editorial Everest Mexicana', 'México'),
(6, 'Gema Editores', ''),
(7, 'Editorial Porrúa', ''),
(8, 'Rezza Editores S.A. de C.V.', ''),
(9, 'Norma Ediciones', ''),
(10, 'Alfatématica S.A. de C.V.', ''),
(11, 'Grupo Anaya', ''),
(12, 'Scholastic México, S.A. de C.V.', 'México'),
(13, 'Editorial Gustavo Casasola S.A. de C.V.', ''),
(14, 'Anness Publishing Limited', ''),
(15, 'Editorial Las Ánimas S.A. de C.V.', ''),
(16, 'Editorial OCEANO', 'España'),
(17, 'Compañía Editorial Ultra, S.A. de C.V.', ''),
(18, 'Trilce Ediciones, S.A. de C.V.', ''),
(19, 'Desconocida', ''),
(20, 'Fondo de cultura económica', ''),
(21, 'Editorial REYMO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo_libro` text NOT NULL,
  `autor` text NOT NULL,
  `id_editorial` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `unidades_totales` int(4) NOT NULL DEFAULT 1,
  `imagen_portada` text NOT NULL DEFAULT 'portada_default.png',
  `descripcion` text NOT NULL,
  `estado_libro` enum('Activo','Suspendido') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo_libro`, `autor`, `id_editorial`, `id_categoria`, `unidades_totales`, `imagen_portada`, `descripcion`, `estado_libro`) VALUES
(1, 'Lazarillo de Tormes', 'Anónimo', 3, 3, 1, 'portada_default.png', '', 'Activo'),
(2, 'EL LAZARILLO DE TORMES', 'Anónimo', 1, 3, 1, 'portada_default.png', '', 'Activo'),
(3, 'HOMBRE CONSCIENTE', 'John Gray', 2, 1, 1, 'portada_default.png', '', 'Activo'),
(4, 'El coraje de ser POSITIVO', 'Patricia G. Wenzel', 4, 1, 1, 'portada_default.png', '', 'Activo'),
(5, 'Antonio en el país del silencio', 'Mercedes Neuschäfer-Carlón', 5, 5, 1, 'portada_default.png', '', 'Activo'),
(6, 'EL VIEJO Y EL MAR', 'Ernest Hemingway', 3, 3, 1, 'portada_default.png', '', 'Activo'),
(7, 'El conflicto de los siglos', 'Elena G. de White', 6, 1, 1, 'portada_default.png', '', 'Activo'),
(8, 'EL PRINCIPITO', 'Antoine de Saint-Exupéry', 7, 2, 1, 'portada_default.png', '', 'Activo'),
(9, 'Multiconsulta REZZA 8 en uno', 'Rezza Editores', 8, 4, 1, 'portada_default.png', '', 'Activo'),
(10, 'ROMEO Y JULIETA', 'William Shakespeare', 9, 9, 1, 'portada_default.png', '', 'Activo'),
(11, 'VISUAL ENCICLOPEDIA AUTODIDACTA ESTUDIANTIL', 'Alfatématica S.A. de C.V.', 10, 4, 3, 'portada_default.png', '', 'Activo'),
(12, 'Cuentos de las 1001 noches', 'Juan Tébar', 11, 2, 1, 'portada_default.png', '', 'Activo'),
(13, 'LOS PUEBLOS DE MÉXICO, CON LINKS DE INTERNET', 'Gillian Doherty, Anna Clyabourne', 12, 7, 1, 'portada_default.png', '', 'Activo'),
(14, 'MARÍA ENRIQUETA para jóvenes, Infancia y adolescencia', 'Felipe Garrido', 13, 8, 1, 'portada_default.png', '', 'Activo'),
(15, 'UN VIAJE A... EL IMPERIO ROMANO', 'Philip Steele', 14, 7, 1, 'portada_default.png', '', 'Activo'),
(16, 'Primero las bases: Biografía de Adolfo Ruiz Cortines', 'Esperanza Toral Freyre', 15, 6, 1, 'portada_default.png', '', 'Activo'),
(17, 'Gran Libro de Preguntas y Respuestas', 'Grupo OCEANO', 16, 1, 1, 'portada_default.png', '', 'Activo'),
(18, 'El Periquillo Sarniento, sus extraordinarias venturas y desventuras', 'Felipe Garrido', 17, 3, 1, 'portada_default.png', '', 'Activo'),
(19, 'RULFO X, una vida gráfica', 'Óscar Pantoja &amp; Felipe Camargo', 18, 6, 1, 'portada_default.png', '', 'Activo'),
(20, 'CULTURA Y TRADICIÓN EN EL NORESTE DE MÉXICO', 'Consejo Nacional del Fomento Educativo', 19, 1, 1, 'portada_default.png', '', 'Activo'),
(21, 'Cuento negro para una negra noche', 'Houghton Miffin Co.', 20, 5, 1, 'portada_default.png', '', 'Activo'),
(22, 'ENCICLOPEDIA TEMÁTICA ILUSTRADA FULL COLOR', 'Editorial REYMO', 21, 4, 1, 'portada_default.png', '', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `unidades_prestamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `rol_usuario` enum('Admin','Usuario') NOT NULL DEFAULT 'Admin',
  `usuario` text NOT NULL,
  `contrasenia` text NOT NULL,
  `nombre_usuario` text NOT NULL,
  `telefono_usuario` varchar(18) NOT NULL,
  `correo_usuario` text NOT NULL,
  `creacion_cuenta` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_usuario` enum('Activo','Suspendido') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol_usuario`, `usuario`, `contrasenia`, `nombre_usuario`, `telefono_usuario`, `correo_usuario`, `creacion_cuenta`, `estado_usuario`) VALUES
(1, 'Admin', 'teba24', '$2y$10$J87lU56I.bVRsmjVtwX12.2GTAtvGuRIMcxIEikzJGX9sF9myLJym', 'Telebachillerato 24', '(000) 000-0000', 'No registrado', '2023-11-10 14:00:00', 'Activo');

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
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transaccion_prestamo`
--
ALTER TABLE `transaccion_prestamo`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

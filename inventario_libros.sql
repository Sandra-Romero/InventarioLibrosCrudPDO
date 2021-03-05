-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-09-2020 a las 09:07:45
-- Versión del servidor: 10.4.13-MariaDB-1:10.4.13+maria~bionic
-- Versión de PHP: 7.2.31-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_libros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `codigoAutor` varchar(10) NOT NULL,
  `nombreAutor` varchar(150) NOT NULL,
  `nacionalidad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`codigoAutor`, `nombreAutor`, `nacionalidad`) VALUES
('001', 'Alfredo Espino ', 'Salvadoreño '),
('002', 'Maria ', 'Guatemalteca'),
('003', 'Rosa López', 'Hondureña'),
('004', 'Oscar ', 'Salvadoreño '),
('005', 'Michael', 'Estadounidence');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `codigoEditorial` varchar(10) NOT NULL,
  `nombreEditorial` varchar(150) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`codigoEditorial`, `nombreEditorial`, `contacto`, `telefono`) VALUES
('001', 'Libro de Historias', 'Historiasreales@gmail.com', '78787883'),
('002', 'Filosofía', 'filosofia@gmail.com', '26578976'),
('003', 'Libro de Historias Reales', 'historias@gmail.com', '454545'),
('004', 'cuentos', 'editorial@gmail.com', '26252425'),
('005', 'novelas fantasticas', 'novelasfantasticas1@gmail.com', '7878788');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `idGenero` int(11) NOT NULL,
  `nombreGenero` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`idGenero`, `nombreGenero`, `descripcion`) VALUES
(1, 'Novela Fantasticas ', 'La narrativa basado sobre todo en los elementos de fantasía'),
(2, 'Historias', 'Historias basado en hechos reales'),
(3, 'Cuento ', 'cuentoss'),
(4, 'filosofía', 'filosofía'),
(5, 'finanzas', 'finanzas ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `codigoLibro` varchar(10) NOT NULL,
  `nombreLibro` varchar(100) NOT NULL,
  `existencias` int(11) NOT NULL,
  `precio` double(18,2) NOT NULL,
  `codigoAutor` varchar(10) NOT NULL,
  `codigoEditorial` varchar(10) NOT NULL,
  `idGenero` int(11) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`codigoLibro`, `nombreLibro`, `existencias`, `precio`, `codigoAutor`, `codigoEditorial`, `idGenero`, `descripcion`) VALUES
('001', 'historia', 17, 12.00, '001', '003', 2, 'Historias basado en hechos reales'),
('002', 'cuentos 001', 14, 8.00, '003', '005', 3, 'Cuentos'),
('003', 'recetas', 23, 6.00, '004', '005', 5, 'recetas de cocina'),
('004', 'Libro de Filosofía', 11, 8.00, '005', '005', 5, 'Conjunto de reflexiones sobre la esencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `idMovimientos` varchar(10) NOT NULL,
  `accion` varchar(150) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `codigoLibro` varchar(10) NOT NULL,
  `nombreLibro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`idMovimientos`, `accion`, `cantidad`, `fecha`, `codigoLibro`, `nombreLibro`) VALUES
('1', 'salida', '2', '2020-09-12', '002', 'cuentos'),
('2', 'salida', '3', '2020-09-12', '003', 'Novelas fantasticas'),
('3', 'entrada', '3', '2020-09-12', '001', 'historia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`codigoAutor`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`codigoEditorial`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`codigoLibro`),
  ADD KEY `codigoAutor` (`codigoAutor`),
  ADD KEY `codigoEditorial` (`codigoEditorial`),
  ADD KEY `idGenero` (`idGenero`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`idMovimientos`),
  ADD KEY `codigoLibro` (`codigoLibro`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`codigoAutor`) REFERENCES `autores` (`codigoAutor`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`codigoEditorial`) REFERENCES `editoriales` (`codigoEditorial`),
  ADD CONSTRAINT `libros_ibfk_3` FOREIGN KEY (`idGenero`) REFERENCES `generos` (`idGenero`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`codigoLibro`) REFERENCES `libros` (`codigoLibro`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

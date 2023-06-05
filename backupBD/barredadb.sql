-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2023 a las 05:51:52
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barredadb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_dFactura` (IN `venta_renglon` INT, IN `idFactura` INT, IN `venta_articulo` INT, IN `venta_cantidad` INT, IN `venta_precio` INT)   INSERT INTO `detalle_factura`(`dfact_renglon`, `fact_id`, `art_id`, `dfact_cantidad`, `dfact_precio`) VALUES (venta_renglon,idFactura,venta_articulo,venta_cantidad,venta_precio)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrar_Facturas` ()   SELECT factura.fact_id ,factura.fact_fecha ,sum(dfact_precio) as precioTotal from detalle_factura 
INNER JOIN factura on detalle_factura.fact_id = factura.fact_id  GROUP BY fact_id ORDER BY fact_id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrar_Gastos` ()   SELECT
  ROW_NUMBER() OVER (ORDER BY gas_id) AS numeracion,
  gas_id,
  gas_proveedor,
  gas_fecha,
  gas_concepto,
  gas_total
FROM
  Gastos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `precioTotal_Factura` (IN `idFactura` INT)   select sum(df.dfact_precio) as total from detalle_factura as df where df.fact_id = idFactura$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restar_stock` (IN `idarticulo` INT(20), IN `cantidad` INT(20))   UPDATE articulos SET articulos.art_stock = articulos.art_stock-cantidad where articulos.art_id = idarticulo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ver_factura` (IN `idFactura` INT(20))   select df.dfact_renglon as nroRenglon, art.art_nom as articulo, df.dfact_cantidad as cantidad, df.dfact_precio as precioFinal , art.art_precio as precioUnitario , fact.fact_fecha as fecha from detalle_factura as df 
inner JOIN articulos as art on df.art_id = art.art_id
INNER JOIN factura as fact on df.fact_id = fact.fact_id WHERE fact.fact_id = idFactura order by nroRenglon asc$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `art_id` int(20) NOT NULL,
  `art_cod` varchar(20) NOT NULL,
  `art_nom` varchar(255) NOT NULL,
  `art_desc` varchar(255) NOT NULL,
  `art_precio` float NOT NULL,
  `art_stock` int(20) NOT NULL,
  `art_costo` int(20) NOT NULL,
  `art_vendible` varchar(1) NOT NULL DEFAULT 'S',
  `art_deshabilitado` varchar(1) DEFAULT NULL,
  `art_categoria` int(20) DEFAULT NULL,
  `art_materiales` varchar(50) NOT NULL,
  `art_notas` text NOT NULL
) ;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`art_id`, `art_cod`, `art_nom`, `art_desc`, `art_precio`, `art_stock`, `art_costo`, `art_vendible`, `art_deshabilitado`, `art_categoria`, `art_materiales`, `art_notas`) VALUES
(77, 'aaa', 'aasdasd', 'asdasd', 424, 17, 424, '', '', 2, 'asdasda', ''),
(78, 'vvv', 'fsafdas', 'asdasd', 14214, 4214, 424, '', '', 2, 'asdasd', ''),
(79, 'ggg', 'asdasd', 'asdasd', 4214, 20, 4124, '', '', 2, 'asdasd', ''),
(80, 'hhhh', 'ggdf', 'asdasd', 2424, 24, 424, '', '', 2, 'gggg', ''),
(81, 'asvv', 'Una silla super comoda para que te sientes', 'asdasd', 424, 603, 4242, '', '', 1, 'asdasd', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `art_imagenes`
--

CREATE TABLE `art_imagenes` (
  `art_id` int(11) NOT NULL,
  `ruta_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cat_id` int(20) NOT NULL,
  `cat_nom` varchar(25) NOT NULL,
  `cat_obs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_id`, `cat_nom`, `cat_obs`) VALUES
(1, 'Sillas', '---'),
(2, 'Materas', '---'),
(3, 'Mesas', '---'),
(4, 'Percheros', '---'),
(7, 'Llaveros', '---'),
(8, 'Estanterias', '---'),
(11, 'Descuentos', NULL),
(12, 'Marcos', NULL),
(14, 'Tablas y Cuencos', 'tablas de picar y de asado, cuencos para servir'),
(15, 'Pinos Navidad', 'Tamaños varios'),
(26, 'Navidad', 'cosas de navidad'),
(27, 'cosas de navidad', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `dfact_renglon` int(11) NOT NULL,
  `fact_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `dfact_cantidad` int(11) NOT NULL,
  `dfact_precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `fact_id` int(11) NOT NULL,
  `fact_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `gas_id` int(20) NOT NULL,
  `gas_fecha` date NOT NULL,
  `gas_proveedor` varchar(50) NOT NULL,
  `gas_concepto` varchar(50) DEFAULT NULL,
  `gas_cantidad` int(20) NOT NULL,
  `gas_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`gas_id`, `gas_fecha`, `gas_proveedor`, `gas_concepto`, `gas_cantidad`, `gas_total`) VALUES
(31, '2023-06-02', 'asdasd', 'asdasdsadsad', 4, 12414),
(32, '2023-06-03', 'asdasd', 'asdasd', 4214, 24124),
(33, '2023-06-03', 'asdasd', 'asdasd', 424, 4524),
(34, '2023-06-03', 'sdafas', 'gfgasd', 4, 24124),
(35, '2023-06-03', 'asdasd', 'asdasd', 24, 21442),
(36, '0000-00-00', 'Proveedor C', 'Publicidad', 0, 300),
(37, '0000-00-00', 'asdasd', 'asdasd', 0, 55),
(38, '0000-00-00', 'dfgdfg', 'asdas', 0, 1000),
(39, '0000-00-00', 'asdasd', 'asda', 0, 444),
(40, '0000-00-00', 'asdasd', 'asdasd', 0, 4124120),
(41, '2023-06-04', 'mi madre', 'le puse ggdf', 0, 10000),
(42, '2023-06-04', 'dasd', '    s', 0, 1244),
(43, '2023-06-04', 'asdoa', 'ssoda', 0, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usu_contraseña` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usu_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nombre`, `usu_contraseña`, `usu_rol`) VALUES
(1, 'id19677335_admin', 'admin', 1),
(2, 'seba', 'seba', 1),
(3, 'emilia', 'emilia', 1),
(4, 'gaston', 'gaston', 1),
(5, 'jero', 'jero', 1),
(6, 'juanpablo', 'juanpablo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`art_id`),
  ADD UNIQUE KEY `art_cod` (`art_cod`),
  ADD UNIQUE KEY `art_cod_2` (`art_cod`),
  ADD UNIQUE KEY `art_cod_3` (`art_cod`),
  ADD KEY `art_categoria` (`art_categoria`);

--
-- Indices de la tabla `art_imagenes`
--
ALTER TABLE `art_imagenes`
  ADD KEY `art_id` (`art_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD KEY `fact_id` (`fact_id`,`art_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`fact_id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`gas_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `art_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `fact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `gas_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`art_categoria`) REFERENCES `categorias` (`cat_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `art_imagenes`
--
ALTER TABLE `art_imagenes`
  ADD CONSTRAINT `art_imagenes_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `articulos` (`art_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_3` FOREIGN KEY (`fact_id`) REFERENCES `factura` (`fact_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

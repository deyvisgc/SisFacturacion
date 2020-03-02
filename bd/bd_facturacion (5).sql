-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2020 a las 00:09:32
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_facturacion`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addcarIngreso` (IN `var_id_Producto` INT, IN `var_cantidad` INT, IN `var_vendedor` INT, IN `var_precio` DOUBLE, IN `var_provedor` INT)  BEGIN
DECLARE IGV double;
DECLARE subtotal double;

set subtotal =(SELECT ROUND(var_precio *var_cantidad, 4) as suma);
set IGV := (SELECT ROUND(subtotal*0.18, 4));

INSERT INTO temcarrito
(
 temcarrito.Cantidad,
 temcarrito.id_Producto,
 temcarrito.usuario_id_usuario,
 temcarrito.Subtotal,
 temcarrito.Igv,
 temcarrito.Precio_Compra,
 temcarrito.id_Proveedor,
 temcarrito.Fecha_Carrito
)VALUES(
    var_cantidad,
    var_id_Producto,
    var_vendedor,
    subtotal,
    IGV,
    var_precio,
    var_provedor,
    CURDATE()
 );
 
 SELECT SUM(temcarrito.Subtotal) as subtotal,COUNT(temcarrito.id_Tem_Carito) count from temcarrito WHERE temcarrito.usuario_id_usuario=var_vendedor;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addventa` (IN `varid_Persona` INT)  NO SQL
BEGIN
DECLARE ven_total double(15,4);
DECLARE ven_Cantidad int;
DECLARE ven_total_igv double(15,4);
DECLARE ven_igv double(15,4);
DECLARE var_id_Producto int;
DECLARE ven_subtotal double(15,4);

SELECT 
temcarrito.id_Producto,
temcarrito.Cantidad,
temcarrito.Subtotal,
temcarrito.Igv
INTO var_id_Producto, ven_Cantidad,ven_subtotal, ven_igv
from temcarrito WHERE temcarrito.id_Persona=varid_Persona;
SELECT var_id_Producto;

INSERT INTO venta(
    venta.idPersona,
    venta.cantidad,
    venta.Subtotal,
    venta.subtotal_Igv,
    venta.Fecha_venta
)

VALUES(varid_Persona,ven_Cantidad,ven_subtotal,ven_igv,now());
SELECT * from venta WHERE venta.idPersona=varid_Persona;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCarrito` (IN `var_idVendedor` INT)  NO SQL
BEGIN
SELECT
temcarrito.Cantidad,
productos.Nombre_Productos,
temcarrito.id_Persona,
temcarrito.Precio_Compra,
temcarrito.Igv,
temcarrito.Subtotal,
temcarrito.id_Producto,
temcarrito.id_Proveedor,
subcon.sumsubtotal,
empresas.Razon_social_Empre,
temcarrito.id_Tem_Carito
from (SELECT ROUND(SUM(temcarrito.Subtotal),4)  as sumsubtotal from temcarrito WHERE temcarrito.usuario_id_usuario=var_idVendedor) as subcon,
temcarrito,productos,empresas
WHERE temcarrito.id_Producto=productos.idProductos and temcarrito.usuario_id_usuario=var_idVendedor and temcarrito.id_Proveedor=empresas.Id_Empresas_Empre
GROUP BY 
 temcarrito.Cantidad,
 productos.Nombre_Productos,
 temcarrito.id_Persona,
temcarrito.Precio_Compra,
temcarrito.Igv,
temcarrito.Subtotal,
empresas.Razon_social_Empre,
temcarrito.id_Producto,temcarrito.id_Tem_Carito ORDER BY temcarrito.id_Tem_Carito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCarritoIngresos` (IN `var_id_Proveedor` INT)  NO SQL
BEGIN
 SELECT
temcarrito.Cantidad,
productos.Nombre_Productos,
temcarrito.id_Persona,
temcarrito.Precio_pro,
temcarrito.Igv,
temcarrito.Subtotal,
temcarrito.id_Producto,
temcarrito.id_Proveedor,
subcon.sumsubtotal,
temcarrito.id_Tem_Carito
from (SELECT ROUND(SUM(temcarrito.Subtotal),4)  as sumsubtotal from temcarrito WHERE temcarrito.id_Proveedor=var_id_Proveedor) as subcon,

temcarrito,productos
WHERE temcarrito.id_Producto=productos.idProductos and temcarrito.id_Proveedor=var_id_Proveedor
GROUP BY 
 temcarrito.Cantidad,
 productos.Nombre_Productos,
 temcarrito.id_Persona,
temcarrito.Precio_pro,
temcarrito.Igv,
temcarrito.Subtotal,
temcarrito.id_Producto,temcarrito.id_Tem_Carito ORDER BY temcarrito.id_Tem_Carito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ingreso_registrar` (IN `var_id_usuario` INT, IN `var_monto_efectivo` DOUBLE(15,4), IN `var_monto_credito` DOUBLE(15,4), IN `var_monto_debito` DOUBLE(15,4), IN `var_vuelto` DOUBLE(15,4), IN `tipo_pago` INT, IN `tipo_comprovante` INT, IN `n_venta` VARCHAR(50))  BEGIN
DECLARE var_subtotal double(15,4);
DECLARE var_Cantidad int;
DECLARE var_precio double(15,4);
DECLARE var_sum_total_entrante double(15,4);
DECLARE var_total  double (15,4);
DECLARE var_Igv double (15,4);
DECLARE var_id_Ingreso int;
DECLARE var_id_caja int;
DECLARE var_idProducto int;
DECLARE var_Fecha_ingreso date;
DECLARE var_id_proveedor int;
DECLARE var_id_detalle_ingreso int;
DECLARE var_cantidad_comprobante int;
DECLARE done INT DEFAULT FALSE;
DECLARE cursor_temp CURSOR FOR

SELECT 
 temcarrito.id_Producto,
 temcarrito.Cantidad,
 temcarrito.Precio_pro,
 temcarrito.Fecha_Carrito,
 temcarrito.id_Proveedor
from temcarrito WHERE temcarrito.usuario_id_usuario=var_id_usuario;

   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
SELECT 
  IFNULL(SUM(temcarrito.Subtotal),0) subtotal into var_subtotal from  temcarrito 
WHERE temcarrito.usuario_id_usuario=var_id_usuario ;

set var_Igv:=var_subtotal*0.18;
set var_total:=var_subtotal+var_Igv;
set var_sum_total_entrante:=var_monto_efectivo+var_monto_credito+var_monto_debito;
SET var_id_caja=1;
        
INSERT INTO 
   ingresos(
    Ingre_Subtotal,
    Ingre_IGV,
    Ingre_Precio,
    Ingre_monto_efectivo,
    Ingre_monto_debito,
    Ingre_monto_credito,
    Usuario_id_Usuarios,
    Id_Caja,
    Ingre_Fecha,
    Ingre_Estado,
     n_ventas
   )
    VALUES (
        var_subtotal,
        var_Igv,
        var_precio,
        var_monto_efectivo,
        var_monto_debito,
        var_monto_credito,
        var_id_usuario,
        var_id_caja,
        NOW(),
        1,
       n_venta);
     SET var_id_Ingreso = LAST_INSERT_ID();
       OPEN cursor_temp;
        read_loop: LOOP
        FETCH cursor_temp INTO var_idProducto,var_Cantidad,var_precio,var_Fecha_ingreso,var_id_proveedor;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
 INSERT INTO detalle_ingreso
 (   Ingre_Deta_Cantidad,
     Ingre_Deta_Total,
     productos_idProductos,
     Ingresos_Id_Ingresos,
     Ingre_vuelto,
     fecha_Ingreso,
     id_proveedor,
     id_tipo_Comprobante,
     id_tipo_pago
 ) 
     VALUES(
     var_Cantidad,
     var_total,
     var_idProducto,
     var_id_Ingreso,
     var_vuelto,
     var_Fecha_ingreso,
     var_id_proveedor,
     tipo_comprovante,
     tipo_pago
     );
     SET var_id_detalle_ingreso:=LAST_INSERT_ID();
       END LOOP;
    CLOSE cursor_temp;
    IF(var_id_detalle_ingreso !='') THEN
       DELETE FROM temcarrito WHERE temcarrito.usuario_id_usuario=var_id_usuario; 
       SELECT tipo_comprobante.cantidad into var_cantidad_comprobante from tipo_comprobante WHERE tipo_comprobante.id=tipo_comprovante;
       UPDATE tipo_comprobante SET tipo_comprobante.cantidad=var_cantidad_comprobante+1 WHERE tipo_comprobante.id=tipo_comprovante;
    end IF;
   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectCarrito` (IN `var_id_persona` INT)  NO SQL
SELECT temcarrito.Cantidad,temcarrito.Subtotal,temcarrito.Igv,temcarrito.Precio_pro,productos.Nombre_Productos,imagenes.ruta_imagen,countador.conta,productos.modelo_producto,countador.subt,temcarrito.id_Producto,temcarrito.id_Persona
from (
    SELECT COUNT(temcarrito.id_Tem_Carito) as conta,SUM(temcarrito.Subtotal) as subt
    from temcarrito,productos WHERE temcarrito.id_Producto=productos.idProductos and temcarrito.id_Persona=var_id_persona ) as countador,
    
temcarrito,productos,imagenes WHERE temcarrito.id_Producto=productos.idProductos and productos.Imagenes_idImagenes=imagenes.idImagenes and temcarrito.id_Persona=var_id_persona
GROUP BY 
temcarrito.Cantidad,temcarrito.Subtotal,temcarrito.Igv,temcarrito.Precio_pro,productos.Nombre_Productos,imagenes.ruta_imagen,productos.modelo_producto,temcarrito.id_Producto,temcarrito.id_Persona$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCantidad` (IN `var_Cantidad` INT, IN `var_IdCarrito` INT, IN `var_IdVendedor` INT)  NO SQL
BEGIN
DECLARE varprecio double;
DECLARE var_subtotal double;
DECLARE var_Igv double;

SELECT temcarrito.Precio_Compra INTO varprecio from temcarrito WHERE temcarrito.usuario_id_usuario=var_IdVendedor and temcarrito.id_Tem_Carito=var_IdCarrito;
SET var_subtotal:=var_Cantidad*varprecio;
SET var_Igv:=var_subtotal*0.18;
UPDATE temcarrito SET Cantidad=var_Cantidad, Subtotal=var_subtotal , Igv=var_Igv WHERE usuario_id_usuario=var_IdVendedor and id_Tem_Carito=var_IdCarrito;
call GetCarrito(var_IdVendedor);
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `detalleingreso` () RETURNS INT(11) BEGIN
DECLARE varid_producto INT;

 SELECT productos.idProductos into varid_producto
 from detalle_ingreso,ingresos,productos,empresas WHERE detalle_ingreso.Ingresos_Id_Ingresos=ingresos.Id_Ingresos and detalle_ingreso.productos_idProductos=productos.idProductos and detalle_ingreso.id_proveedor=empresas.Id_Empresas_Empre and ingresos.Usuario_id_Usuarios=1;
  RETURN varid_producto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id_Accesorios` int(11) NOT NULL,
  `nombre_accesorio` varchar(50) NOT NULL,
  `precio_acc` double NOT NULL,
  `modelo_acc` varchar(50) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `esta_acce` int(11) NOT NULL,
  `cantidad_acc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id_Accesorios`, `nombre_accesorio`, `precio_acc`, `modelo_acc`, `id_imagen`, `esta_acce`, `cantidad_acc`) VALUES
(11, 'accesorio2', 34, 'dsds', 26, 1, 5),
(12, 'Accesorio1', 12, 'abcdf', 27, 1, 12),
(13, 'Accesorio3', 12.45, 'baño-azul', 28, 1, 2),
(14, 'Accesorio4', 234.4, 'mezcladoras-23', 29, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acesorio_producto`
--

CREATE TABLE `acesorio_producto` (
  `id_Acceso_Prod` int(11) NOT NULL,
  `id_accesorio` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acesorio_producto`
--

INSERT INTO `acesorio_producto` (`id_Acceso_Prod`, `id_accesorio`, `id_producto`) VALUES
(86, 12, 9),
(87, 13, 10),
(89, 11, 12),
(92, 14, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `idAlmacen` int(11) NOT NULL,
  `Cantidad_Alma` int(11) DEFAULT NULL,
  `codigo_almacen` varchar(45) DEFAULT NULL,
  `Cantidad_Minima` int(11) DEFAULT NULL,
  `Cantidad_Maxima` varchar(45) DEFAULT NULL,
  `productos_idProductos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idCaja` int(11) NOT NULL,
  `caj_descripcion` varchar(200) DEFAULT NULL,
  `caj_codigo` varchar(50) DEFAULT NULL,
  `caj_abierta` varchar(10) DEFAULT NULL,
  `est_id_estado` int(11) DEFAULT NULL,
  `usuarios_idusuarios` int(11) NOT NULL,
  `Monto_Caja_final` double DEFAULT NULL,
  `monto_Caja_Inicial` double(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `Nombre_Categoria` varchar(45) DEFAULT NULL,
  `Estado_categoria` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `Nombre_Categoria`, `Estado_categoria`) VALUES
(1, 'tanques', 1),
(2, 'Termas', 1),
(3, 'Pegamento', 1),
(4, 'caño', 1),
(9, 'mezcladoras', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `Iddetalle_Ingreso` int(11) NOT NULL,
  `Ingre_Deta_Cantidad` int(11) DEFAULT NULL,
  `Ingre_Deta_Total` double DEFAULT NULL,
  `productos_idProductos` int(11) NOT NULL,
  `Ingresos_Id_Ingresos` int(11) NOT NULL,
  `Ingre_vuelto` double(15,4) NOT NULL,
  `fecha_Ingreso` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipo_Comprobante` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`Iddetalle_Ingreso`, `Ingre_Deta_Cantidad`, `Ingre_Deta_Total`, `productos_idProductos`, `Ingresos_Id_Ingresos`, `Ingre_vuelto`, `fecha_Ingreso`, `id_proveedor`, `id_tipo_Comprobante`, `id_tipo_pago`) VALUES
(37, 4, 310.7176, 11, 30, 9.2824, '2020-02-29', 4, 1, 3),
(38, 4, 310.7176, 12, 30, 9.2824, '2020-02-29', 7, 1, 3),
(39, 4, 162.84, 9, 31, 37.1600, '2020-02-29', 4, 1, 3),
(40, 3, 233.0382, 11, 32, 66.9618, '2020-02-29', 4, 1, 3),
(41, 3, 233.0382, 12, 32, 66.9618, '2020-02-29', 5, 1, 3),
(42, 3, 160.8222, 11, 33, 39.1778, '2020-02-29', 4, 2, 3),
(43, 3, 364.3722, 11, 34, 35.6278, '2020-02-29', 7, 1, 3),
(44, 5, 364.3722, 9, 34, 35.6278, '2020-02-29', 7, 1, 3),
(45, 4, 162.84, 9, 36, 37.1600, '2020-02-29', 5, 1, 3),
(46, 4, 214.4296, 11, 37, 25.5704, '2020-02-29', 4, 2, 3),
(47, 4, 162.84, 9, 38, 37.1600, '2020-02-29', 5, 1, 3),
(48, 4, 214.4296, 11, 39, 0.5704, '2020-02-29', 4, 1, 3);

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `UpdaIngreStock` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN
 UPDATE productos SET Stock_Productos=Stock_Productos + NEW.Ingre_Deta_Cantidad WHERE productos.idProductos=NEW.productos_idProductos;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `totalIGV` double DEFAULT NULL,
  `Descripcion_Venta` varchar(300) DEFAULT NULL,
  `venta_idventa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `Id_Empresas_Empre` int(11) NOT NULL,
  `Razon_social_Empre` varchar(200) NOT NULL,
  `Provincia_Empre` varchar(50) DEFAULT NULL,
  `Distrito_Empre` varchar(50) DEFAULT NULL,
  `Departamento_Empre` varchar(50) DEFAULT NULL,
  `Ruc_Empre` varchar(50) NOT NULL,
  `Direccion_Empre` varchar(200) NOT NULL,
  `telefono_Empre` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `gmail_Empre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`Id_Empresas_Empre`, `Razon_social_Empre`, `Provincia_Empre`, `Distrito_Empre`, `Departamento_Empre`, `Ruc_Empre`, `Direccion_Empre`, `telefono_Empre`, `Id_Usuario`, `gmail_Empre`) VALUES
(4, 'Hermanos Garciasdsdsdsdsdsds', 'Lima', 'Lima', 'lima', '123456789', 'Lima', 123456789, NULL, 'hermanos@gmail.com'),
(5, 'Hermanos Cercados', 'Lima', 'Lima', 'lima', '3344345', 'Lima', 123456789, NULL, 'hermanosCerca@gmail.com'),
(7, 'Hermanos Cardenas', 'Lima', 'Lima', 'lima', '3344344445', 'Lima', 444433444, NULL, 'hermanosCercwwa@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagenes` int(11) NOT NULL,
  `ruta_imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagenes`, `ruta_imagen`) VALUES
(13, '11174-Rotoplas-tanque-de-Agua-1100L-Negro - copia.png'),
(14, 'valvula esferica_media.jpg'),
(15, 'ceramitech-chemayolic-pegamento-extra-fuerte-blanco.jpg'),
(16, 'espejo-baño2 - copia.jpg'),
(26, 'tapa6.jpg'),
(27, 'lavaplatos_80x50.jpg'),
(28, 'sanitario_lavaratiro_Azul.jpg'),
(29, 'gtiferia_canilla_mezcladora_pared-exterior.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `Id_Ingresos` int(11) NOT NULL,
  `Ingre_Subtotal` double DEFAULT NULL,
  `Ingre_IGV` double DEFAULT NULL,
  `Ingre_Precio` double DEFAULT NULL,
  `Ingre_Fecha` date DEFAULT NULL,
  `Ingre_monto_efectivo` double DEFAULT NULL,
  `Ingre_monto_debito` double DEFAULT NULL,
  `Ingre_monto_credito` double DEFAULT NULL,
  `Ingre_Estado` int(11) DEFAULT NULL,
  `Usuario_id_Usuarios` int(11) NOT NULL,
  `Id_Caja` int(11) NOT NULL,
  `n_ventas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`Id_Ingresos`, `Ingre_Subtotal`, `Ingre_IGV`, `Ingre_Precio`, `Ingre_Fecha`, `Ingre_monto_efectivo`, `Ingre_monto_debito`, `Ingre_monto_credito`, `Ingre_Estado`, `Usuario_id_Usuarios`, `Id_Caja`, `n_ventas`) VALUES
(30, 263.32, 47.3976, NULL, '2020-02-29', 320, 0, 0, 1, 1, 1, '000003'),
(31, 138, 24.84, NULL, '2020-02-29', 200, 0, 0, 1, 1, 1, '000004'),
(32, 197.49, 35.5482, NULL, '2020-02-29', 300, 0, 0, 1, 1, 1, '000005'),
(33, 136.29, 24.5322, NULL, '2020-02-29', 200, 0, 0, 1, 1, 1, '000002'),
(34, 308.79, 55.5822, NULL, '2020-02-29', 400, 0, 0, 1, 1, 1, '000002'),
(35, 0, 0, NULL, '2020-02-29', 400, 0, 0, 1, 1, 1, '000006'),
(36, 138, 24.84, NULL, '2020-02-29', 200, 0, 0, 1, 1, 1, '000007'),
(37, 181.72, 32.7096, NULL, '2020-02-29', 240, 0, 0, 1, 1, 1, '000003'),
(38, 138, 24.84, NULL, '2020-02-29', 200, 0, 0, 1, 1, 1, '000008'),
(39, 181.72, 32.7096, NULL, '2020-02-29', 215, 0, 0, 1, 1, 1, '000009');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `idOfertas` int(11) NOT NULL,
  `nombre_oferta` varchar(45) DEFAULT NULL,
  `precio_oferta` varchar(45) DEFAULT NULL,
  `Productos_idProductos` int(11) NOT NULL,
  `Imagen_Oferta` varchar(200) NOT NULL,
  `fecha_ini_oferta` date NOT NULL,
  `fecha_fin_oferta` date NOT NULL,
  `Descripcion_oferta` varchar(150) NOT NULL,
  `estado_oferta` int(11) NOT NULL,
  `rango` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`idOfertas`, `nombre_oferta`, `precio_oferta`, `Productos_idProductos`, `Imagen_Oferta`, `fecha_ini_oferta`, `fecha_fin_oferta`, `Descripcion_oferta`, `estado_oferta`, `rango`) VALUES
(1, 'Combotanquet', '12.45', 9, 'Rotoplas-tanque.png', '2019-11-06', '2020-03-19', 'esta bueno', 1, 1),
(2, 'conbowater', '123', 11, 'urinario_Campusblanco.jpg', '2020-01-30', '2020-04-12', 'esta buenaaa', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_Persona` int(11) NOT NULL,
  `nombre_per` varchar(50) NOT NULL,
  `apellidos_per` varchar(50) NOT NULL,
  `telefono_per` int(11) NOT NULL,
  `dni_per` int(11) NOT NULL,
  `gmail` varchar(200) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `id_Privilegios` int(11) NOT NULL,
  `nombre_Privi` varchar(100) NOT NULL,
  `ruta_Privi` varchar(100) NOT NULL,
  `grupo_Privi` varchar(100) NOT NULL,
  `icon_privi` varchar(100) NOT NULL,
  `estado_Privi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `Nombre_Productos` varchar(45) DEFAULT NULL,
  `Precio_Productos` double DEFAULT NULL,
  `descripcion_Productos` varchar(200) DEFAULT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  `Imagenes_idImagenes` int(11) NOT NULL,
  `Stock_Productos` int(11) NOT NULL,
  `Estado_Producto` int(11) NOT NULL,
  `modelo_producto` varchar(100) NOT NULL,
  `codigo_Producto` varchar(100) NOT NULL,
  `precio_compra` double(15,4) NOT NULL,
  `precio_venta` double(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `Nombre_Productos`, `Precio_Productos`, `descripcion_Productos`, `categoria_idcategoria`, `Imagenes_idImagenes`, `Stock_Productos`, `Estado_Producto`, `modelo_producto`, `codigo_Producto`, `precio_compra`, `precio_venta`) VALUES
(9, 'Tanque de agua Negro 1100 litros', 12, 'Es un tanque para el ahorro de agua', 2, 13, 64, 1, 'Tanque de agua Negro 1100 litros', '', 34.5000, 45.3000),
(10, 'caño', 12, 'dddddd', 4, 14, 29, 1, 'lps', '', 30.5000, 34.4500),
(11, 'semento', 12.3, 'dddddddd', 9, 15, 76, 1, 'cemntoa1', '', 45.4300, 50.0000),
(12, 'Espejo', 12.34, 'es para mirarse bebi', 1, 16, 31, 1, 'aldj4', '', 20.4000, 30.0000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `estado_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `estado_rol`) VALUES
(1, 'Vendedor', 1),
(2, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_privilegios`
--

CREATE TABLE `rol_privilegios` (
  `Id_Privilegios` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_Privilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idservicios` int(11) NOT NULL,
  `descrip_servici` varchar(250) DEFAULT NULL,
  `imagen_servicios` varchar(250) DEFAULT NULL,
  `Precio_servicio` varchar(45) DEFAULT NULL,
  `Hora_servicio` varchar(45) DEFAULT NULL,
  `id_Tipo_ser` int(11) DEFAULT NULL,
  `id_tipo_persona` int(11) NOT NULL,
  `rango` int(11) NOT NULL,
  `estado_servi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temcarrito`
--

CREATE TABLE `temcarrito` (
  `id_Tem_Carito` int(11) NOT NULL,
  `id_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `id_Persona` int(11) DEFAULT NULL,
  `Subtotal` double(15,2) NOT NULL,
  `Igv` double(15,2) NOT NULL,
  `Precio_pro` double(15,2) NOT NULL,
  `Fecha_Carrito` date NOT NULL,
  `id_Proveedor` int(11) DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `Precio_Compra` double(15,4) NOT NULL,
  `Precio_Venta` double(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE `tipo_comprobante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `igv` int(11) DEFAULT NULL,
  `serie` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id`, `nombre`, `cantidad`, `igv`, `serie`) VALUES
(1, 'Factura', 9, 0, '001'),
(2, 'Boleta', 3, 0, '001'),
(3, 'Ticket', 0, 0, '001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_persona`
--

CREATE TABLE `tipo_persona` (
  `id_tipo_persona` int(11) NOT NULL,
  `id_Empresas` int(11) NOT NULL,
  `type_Nombre` int(11) NOT NULL COMMENT '1:proveedor ; 2:cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_persona`
--

INSERT INTO `tipo_persona` (`id_tipo_persona`, `id_Empresas`, `type_Nombre`) VALUES
(1, 7, 1),
(2, 5, 1),
(3, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id_tipo_servicio` int(11) NOT NULL,
  `nombre_tipo_servicio` varchar(50) NOT NULL,
  `estado_tipo_Servi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id_tipo_servicio`, `nombre_tipo_servicio`, `estado_tipo_Servi`) VALUES
(1, 'Reparacion', 1),
(2, 'Instalacion de tanques', 1),
(3, 'isntalacion de estructuras ', 1),
(4, 'Instalacion de sisternas', 1),
(5, 'Mobilidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `Id_Rol` int(10) DEFAULT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `password` varchar(300) NOT NULL,
  `user_foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Subtotal` double DEFAULT NULL,
  `subtotal_Igv` double DEFAULT NULL,
  `Fecha_venta` date DEFAULT NULL,
  `tipo_documento` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id_Accesorios`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `acesorio_producto`
--
ALTER TABLE `acesorio_producto`
  ADD PRIMARY KEY (`id_Acceso_Prod`),
  ADD KEY `id_accesorio` (`id_accesorio`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`idAlmacen`),
  ADD KEY `fk_Almacen_productos1_idx` (`productos_idProductos`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCaja`),
  ADD KEY `fk_Caja_usuarios1_idx` (`usuarios_idusuarios`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`Iddetalle_Ingreso`),
  ADD KEY `fk_detalle_Ingreso_productos1_idx` (`productos_idProductos`),
  ADD KEY `fk_detalle_Ingreso_Ingresos1_idx` (`Ingresos_Id_Ingresos`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_venta1_idx` (`venta_idventa`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`Id_Empresas_Empre`),
  ADD UNIQUE KEY `gmail_Empre` (`gmail_Empre`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagenes`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`Id_Ingresos`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`idOfertas`),
  ADD KEY `fk_Ofertas_Productos1_idx` (`Productos_idProductos`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_Persona`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id_Privilegios`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`),
  ADD KEY `fk_Productos_categoria_idx` (`categoria_idcategoria`),
  ADD KEY `fk_Productos_Imagenes1_idx` (`Imagenes_idImagenes`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_privilegios`
--
ALTER TABLE `rol_privilegios`
  ADD PRIMARY KEY (`Id_Privilegios`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_Privilegio` (`id_Privilegio`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservicios`),
  ADD KEY `id_tipo_persona` (`id_tipo_persona`),
  ADD KEY `id_Tipo_ser` (`id_Tipo_ser`);

--
-- Indices de la tabla `temcarrito`
--
ALTER TABLE `temcarrito`
  ADD PRIMARY KEY (`id_Tem_Carito`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  ADD PRIMARY KEY (`id_tipo_persona`),
  ADD KEY `FK_id_Empresa` (`id_Empresas`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id_tipo_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `idPersona_2` (`idPersona`),
  ADD KEY `Id_Rol` (`Id_Rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id_Accesorios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `acesorio_producto`
--
ALTER TABLE `acesorio_producto`
  MODIFY `id_Acceso_Prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `idAlmacen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idCaja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `Iddetalle_Ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `Id_Empresas_Empre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `Id_Ingresos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `idOfertas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_Persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id_Privilegios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol_privilegios`
--
ALTER TABLE `rol_privilegios`
  MODIFY `Id_Privilegios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idservicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `temcarrito`
--
ALTER TABLE `temcarrito`
  MODIFY `id_Tem_Carito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  MODIFY `id_tipo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id_tipo_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `fk_idimagen` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`idImagenes`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `acesorio_producto`
--
ALTER TABLE `acesorio_producto`
  ADD CONSTRAINT `fk_id_Accesorio` FOREIGN KEY (`id_accesorio`) REFERENCES `accesorios` (`id_Accesorios`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_Producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`idProductos`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `fk_Almacen_productos1` FOREIGN KEY (`productos_idProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `fk_Caja_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_Ingreso_Ingresos1` FOREIGN KEY (`Ingresos_Id_Ingresos`) REFERENCES `ingresos` (`Id_Ingresos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Ingreso_productos1` FOREIGN KEY (`productos_idProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_venta1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `Id_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`idusuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `fk_Ofertas_Productos1` FOREIGN KEY (`Productos_idProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Imagenes1` FOREIGN KEY (`Imagenes_idImagenes`) REFERENCES `imagenes` (`idImagenes`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Productos_categoria` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_privilegios`
--
ALTER TABLE `rol_privilegios`
  ADD CONSTRAINT `Fk_Privilegios` FOREIGN KEY (`Id_Privilegios`) REFERENCES `privilegios` (`id_Privilegios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_idrol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `fk_id_Tipo_ser` FOREIGN KEY (`id_Tipo_ser`) REFERENCES `tipo_servicio` (`id_tipo_servicio`),
  ADD CONSTRAINT `fk_idpersona` FOREIGN KEY (`id_tipo_persona`) REFERENCES `persona` (`id_Persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  ADD CONSTRAINT `FK_id_Empresa` FOREIGN KEY (`id_Empresas`) REFERENCES `empresas` (`Id_Empresas_Empre`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Id_Rol` FOREIGN KEY (`Id_Rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `idPersona_2` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id_Persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

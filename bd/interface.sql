-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2023 a las 13:27:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `interface`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `carrito_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `comprado` bit(1) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carritos`
--

INSERT INTO `carritos` (`carrito_id`, `usuario_id`, `comprado`, `fecha_creacion`) VALUES
(1, 6, b'0', '2023-11-25 14:27:15'),
(2, 7, b'0', '2023-11-25 14:29:42'),
(3, 0, b'0', '2023-11-25 16:12:59'),
(4, 7, b'0', '2023-11-25 16:16:39'),
(5, 6, b'0', '2023-11-25 16:18:05'),
(6, 6, b'0', '2023-11-25 16:20:14'),
(7, 6, b'0', '2023-11-25 16:21:31'),
(8, 6, b'0', '2023-11-25 16:26:07'),
(9, 6, b'0', '2023-11-25 16:26:46'),
(10, 6, b'0', '2023-11-25 16:28:42'),
(11, 6, b'1', '2023-11-25 16:28:48'),
(12, 1, b'0', '2023-11-25 16:30:25'),
(13, 1, b'0', '2023-11-25 16:30:34'),
(14, 1, b'0', '2023-11-25 16:37:27'),
(15, 1, b'0', '2023-11-25 16:38:28'),
(16, 1, b'0', '2023-11-25 16:42:03'),
(17, 1, b'0', '2023-11-25 16:50:45'),
(18, 1, b'1', '2023-11-25 16:53:19'),
(19, 2, b'0', '2023-11-25 16:53:55'),
(20, 2, b'0', '2023-11-25 18:07:28'),
(21, 2, b'0', '2023-11-25 18:07:45'),
(22, 2, b'1', '2023-12-01 12:37:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `disponibles` int(100) DEFAULT NULL,
  `fechaalta` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `imagen`, `precio`, `rate`, `activo`, `categoria`, `disponibles`, `fechaalta`) VALUES
(1, 'Laptop Huaweii', 'Potente laptop para tus necesidades informáticas', 'laptop.jpg', 999.99, 5, 1, 'Laptops', 0, '2023-08-02'),
(2, 'Mouse', 'Mouse ergonómico y preciso para tu computadora', 'mouse.jpg', 19.99, 3, 1, 'Accesorios', 0, '2023-10-13'),
(3, 'Teclado', 'Teclado mecánico con retroiluminación LED', 'teclado.jpg', 49.99, 2, 1, 'Accesorios', 2, '2023-12-07'),
(4, 'Laptop Acer Aspire', 'Potente laptop para trabajo y entretenimiento', 'acer_aspire.jpg', 899.99, 2, 1, 'Laptops', 50, '2023-12-01'),
(5, 'Smartphone Samsung Galaxy S20', 'Teléfono inteligente con cámara de alta resolución', 'samsung_s20.jpg', 799.99, 5, 1, 'Smartphones', 30, '2023-01-02'),
(6, 'Tableta Apple iPad Pro', 'Tableta profesional con pantalla retina', 'ipad_pro.jpg', 1299.99, 5, 1, 'Tabletas', 20, '2023-01-03'),
(7, 'Cámara Canon EOS 5D Mark IV', 'Cámara DSLR de alta gama para fotógrafos profesionales', 'canon_eos_5d.jpg', 2499.99, 1, 1, 'Cámaras', 15, '2023-01-04'),
(8, 'Auriculares Sony WH-1000XM4', 'Auriculares con cancelación de ruido de alta calidad', 'sony_wh1000xm4.jpg', 349.99, 5, 1, 'Auriculares', 40, '2023-01-05'),
(9, 'Monitor LG UltraWide', 'Monitor panorámico para una experiencia inmersiva', 'lg_ultrawide.jpg', 549.99, 0, 1, 'Monitores', 25, '2023-01-06'),
(10, 'Teclado mecánico Corsair K95 RGB', 'Teclado mecánico para jugadores exigentes', 'corsair_k95.jpg', 179.99, 5, 1, 'Periféricos', 35, '2023-01-07'),
(11, 'Mouse Logitech MX Master 3', 'Ratón inalámbrico para productividad', 'logitech_mx_master.jpg', 99.99, 5, 1, 'Periféricos', 45, '2023-01-08'),
(12, 'Impresora HP LaserJet Pro', 'Impresora láser para impresiones de alta calidad', 'hp_laserjet.jpg', 299.99, 4, 1, 'Impresoras', 20, '2023-01-09'),
(13, 'Router ASUS RT-AX88U', 'Router Wi-Fi 6 para conexiones rápidas y estables', 'asus_rt_ax88u.jpg', 249.99, 5, 1, 'Redes', 30, '2023-01-10'),
(14, 'Altavoces Bose SoundLink Revolve+', 'Altavoces Bluetooth con sonido envolvente', 'bose_soundlink.jpg', 199.99, 5, 1, 'Audio', 15, '2023-01-11'),
(15, 'Disco Duro Externo WD My Passport', 'Almacenamiento portátil de alta capacidad', 'wd_my_passport.jpg', 129.99, 5, 1, 'Almacenamiento', 25, '2023-01-12'),
(16, 'Tarjeta gráfica NVIDIA GeForce RTX 3080', 'Tarjeta gráfica de última generación para juegos', 'nvidia_rtx_3080.jpg', 699.99, 5, 1, 'Componentes', 10, '2023-01-13'),
(17, 'Proyector Epson Home Cinema 5050UB', 'Proyector 4K para cine en casa', 'epson_5050ub.jpg', 1999.99, 5, 1, 'Proyectores', 10, '2023-01-14'),
(18, 'Batería externa Anker PowerCore', 'Batería portátil de alta capacidad para dispositivos móviles', 'anker_powercore.jpg', 49.99, 2, 1, 'Accesorios', 50, '2023-01-15'),
(19, 'Teclado y mouse inalámbricos Logitech MK270', 'Conjunto de teclado y mouse para uso diario', 'logitech_mk270.jpg', 29.99, 4, 1, 'Periféricos', 30, '2023-01-16'),
(20, 'Smartwatch Garmin Forerunner 945', 'Reloj inteligente para deportes y seguimiento de actividad', 'garmin_forerunner.jpg', 499.99, 1, 1, 'Wearables', 20, '2023-01-17'),
(21, 'Auriculares inalámbricos Apple AirPods Pro', 'Auriculares con cancelación de ruido y sonido envolvente', 'airpods_pro.jpg', 249.99, 3, 1, 'Auriculares', 40, '2023-01-18'),
(22, 'Cámara de seguridad Arlo Pro 3', 'Cámara de seguridad inalámbrica para el hogar', 'arlo_pro_3.jpg', 299.99, 5, 1, 'Cámaras', 15, '2023-01-19'),
(23, 'Monitor gaming ASUS ROG Swift PG279Q', 'Monitor de alta frecuencia de actualización para juegos', 'asus_rog_swift.jpg', 699.99, 2, 1, 'Monitores', 20, '2023-01-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_en_carrito`
--

CREATE TABLE `productos_en_carrito` (
  `id` int(11) NOT NULL,
  `carrito_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_en_carrito`
--

INSERT INTO `productos_en_carrito` (`id`, `carrito_id`, `producto_id`, `cantidad`, `eliminado`) VALUES
(1, 12, 3, 5, 1),
(2, 13, 2, 1, 0),
(3, 14, 2, 1, 0),
(4, 15, 2, 2, 0),
(5, 16, 2, 8, 0),
(6, 17, 2, 2, 0),
(7, 19, 1, 1, 0),
(8, 19, 3, 2, 1),
(9, 20, 1, 4, 0),
(10, 21, 3, 1, 1),
(11, 21, 3, 1, 1),
(12, 21, 3, 1, 0),
(13, 22, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `birthdate` date NOT NULL,
  `genre` bit(1) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `lastname`, `email`, `user_password`, `birthdate`, `genre`, `activo`) VALUES
(1, 'kender', 'mtz', 'kenderwhere@gmail.com', 'Admin123!', '1997-12-12', b'1', 0),
(2, 'kender', 'michell', 'kenderwh@gmail.com', 'Admin123!', '1997-12-12', b'1', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`carrito_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_en_carrito`
--
ALTER TABLE `productos_en_carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrito_id` (`carrito_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `carrito_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos_en_carrito`
--
ALTER TABLE `productos_en_carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos_en_carrito`
--
ALTER TABLE `productos_en_carrito`
  ADD CONSTRAINT `productos_en_carrito_ibfk_1` FOREIGN KEY (`carrito_id`) REFERENCES `carritos` (`carrito_id`),
  ADD CONSTRAINT `productos_en_carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

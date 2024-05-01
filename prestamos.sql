-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2024 a las 01:26:19
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pamela-proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`admin_id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin1@example.com'),
(2, 'admin2', 'password2', 'admin2@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`department_id`, `department_name`) VALUES
(1, 'La Libertad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prestamo`
--

CREATE TABLE `detalle_prestamo` (
  `det_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_prestamo`
--

INSERT INTO `detalle_prestamo` (`det_id`, `loan_id`, `days`, `amount`, `total`) VALUES
(1, 1, 15, '150.00', '154.11'),
(2, 1, 20, '150.00', '155.49'),
(3, 1, 25, '150.00', '156.86'),
(4, 1, 15, '200.00', '205.49'),
(5, 1, 20, '200.00', '207.32'),
(6, 1, 25, '200.00', '209.15'),
(7, 1, 30, '200.00', '210.98'),
(8, 1, 30, '400.00', '421.96');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

CREATE TABLE `distrito` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `province_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`district_id`, `district_name`, `province_id`) VALUES
(1, 'Trujillo', 1),
(2, 'La Esperanza', 1),
(26, 'Chugay', 9),
(28, 'Virú', 10),
(29, 'Chao', 10),
(30, 'Guadalupito', 10),
(34, 'Ascope', 2),
(35, 'Casa Grande', 2),
(36, 'Chicama', 2),
(37, 'Bolívar', 3),
(38, 'Bambamarca', 3),
(39, 'Uchumarca', 3),
(40, 'Chepén', 4),
(41, 'Pacanga', 4),
(42, 'Pueblo Nuevo', 4),
(43, 'Julcán', 5),
(44, 'Calamarca', 5),
(45, 'Carabamba', 5),
(46, 'Otuzco', 6),
(47, 'Agallpampa', 6),
(48, 'Charat', 6),
(49, 'Pacasmayo', 7),
(50, 'Guadalupe', 7),
(51, 'San José', 7),
(52, 'Pataz', 8),
(53, 'Buldibuyo', 8),
(54, 'Pampas', 8),
(55, 'Huamachuco', 9),
(56, 'Chugay', 9),
(57, 'Marcabal', 9),
(58, 'Virú', 10),
(59, 'Chao', 10),
(60, 'Guadalupito', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inversionista`
--

CREATE TABLE `inversionista` (
  `investor_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `district_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inversionista`
--

INSERT INTO `inversionista` (`investor_id`, `admin_id`, `district_id`, `province_id`, `department_id`, `username`, `password`, `email`, `state`) VALUES
(1, 1, 59, 10, 1, 'jefe', 'Pa$$w0rd!', 'quqerit@mailinator.com', 1),
(2, 1, 1, 1, 1, 'inv', 'inv', 'inv2@example.com', 1),
(3, 1, 54, 8, 1, 'fanab', 'Pa$$w0rd!', 'menalufy@mailinator.com', 1),
(4, 1, 47, 6, 1, 'fysacyvu', 'Pa$$w0rd!', 'cytedebo@mailinator.com', 0),
(5, 1, 29, 10, 1, 'mukaluxy', 'Pa$$w0rd!', 'bifimohaj@mailinator.com', 1),
(6, 1, 37, 3, 1, 'inv2', 'inv2', 'quqerit@mailinator.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefe_prestamista`
--

CREATE TABLE `jefe_prestamista` (
  `leader_id` int(11) NOT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `district_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jefe_prestamista`
--

INSERT INTO `jefe_prestamista` (`leader_id`, `investor_id`, `phone`, `dni`, `district_id`, `province_id`, `department_id`, `state`, `username`, `password`, `email`) VALUES
(1, 1, '', '', 0, 2, 1, 1, 'jefe', 'jefe', 'jefe1@example.com'),
(2, 2, '', '', 35, 2, 1, 1, 'jefe', 'jefe2', 'jefe2@example.com'),
(3, 1, '+1 (566) 111-8205', 'Autem sint', 35, 2, 1, 0, 'gedony', 'Pa$$w0rd!', 'tawydob@mailinator.com'),
(4, 1, '+1 (322) 228-4968', 'Laboris pa', 59, 10, 1, 0, 'hiii', 'Pa$$w0rd!', 'quqerit@mailinator.com'),
(5, 2, '+1 (765) 393-6551', 'Ducimus re', 37, 3, 1, 1, 'jefe2', 'jefe2', 'qewuc@mailinator.com'),
(6, 6, '+1 (822) 453-6526', 'Vel autem ', 35, 2, 1, 1, 'jefessss', 'Pa$$w0rd!', 'cataq@mailinator.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_diarios`
--

CREATE TABLE `pagos_diarios` (
  `pay_id` int(11) NOT NULL,
  `borrower_det_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamista`
--

CREATE TABLE `prestamista` (
  `lender_id` int(11) NOT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `dni` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamista`
--

INSERT INTO `prestamista` (`lender_id`, `leader_id`, `phone`, `dni`, `district_id`, `province_id`, `department_id`, `state`, `username`, `password`, `email`) VALUES
(1, 1, 'treterter', '25427453', 1, 1, 1, 1, 'prestamista', 'prestamista', 'prestamista1@example.com'),
(2, 2, '64564564', '6456456', 1, 1, 1, 1, 'prestamista2', 'password2', 'prestamista2@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `loan_id` int(11) NOT NULL,
  `lender_id` int(11) DEFAULT NULL,
  `date_register` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`loan_id`, `lender_id`, `date_register`) VALUES
(1, 1, '2024-04-20 00:00:00'),
(2, 2, '2024-04-21 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestatario`
--

CREATE TABLE `prestatario` (
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `dni` varchar(100) NOT NULL,
  `province_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `loan_amount` decimal(10,2) DEFAULT NULL,
  `loan_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestatario`
--

INSERT INTO `prestatario` (`borrower_id`, `lender_id`, `phone`, `dni`, `province_id`, `department_id`, `state`, `username`, `password`, `email`, `district_id`, `loan_amount`, `loan_date`) VALUES
(1, 1, '', '', 0, 0, 1, 'prestatario1', 'password1', 'prestatario1@example.com', 1, '1000.00', '2024-04-25'),
(2, 2, '', '', 0, 0, 1, 'prestatario2', 'password2', 'prestatario2@example.com', 2, '2000.00', '2024-04-26'),
(3, 1, '+1 (842) 883-7326', 'Eu quo non aspernatu', 2, 1, 1, 'holis', 'Pa$$w0rd!', 'sijaxd@mailinator.com', 34, NULL, NULL),
(4, 1, '+1 (583) 964-2195', 'Inventore enim illum', 7, 1, 1, 'zuwivukuf', 'Pa$$w0rd!', 'gocakunov@mailinator.com', 49, NULL, NULL),
(5, 1, '+1 (209) 995-1196', 'Aut dolore autem sed', 4, 1, 0, 'qevawi', 'Pa$$w0rd!', 'rohicevin@mailinator.com', 40, NULL, NULL),
(6, 1, '+1 (408) 934-5855', 'Excepturi quis nesci', 1, 1, 1, 'prestatario', 'prestatario', 'digamehyzi@mailinator.com', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestatario_prestamo`
--

CREATE TABLE `prestatario_prestamo` (
  `bor_det_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `det_loan_id` int(11) NOT NULL,
  `state` varchar(20) NOT NULL DEFAULT 'PENDIENTE',
  `date_init` date NOT NULL,
  `date_finish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestatario_prestamo`
--

INSERT INTO `prestatario_prestamo` (`bor_det_id`, `borrower_id`, `det_loan_id`, `state`, `date_init`, `date_finish`) VALUES
(1, 6, 6, 'PENDIENTE', '0000-00-00', '0000-00-00'),
(2, 6, 6, 'PENDIENTE', '0000-00-00', '0000-00-00'),
(3, 6, 6, 'PENDIENTE', '0000-00-00', '0000-00-00'),
(4, 6, 6, 'PENDIENTE', '0000-00-00', '0000-00-00'),
(5, 6, 4, 'PENDIENTE', '2024-05-01', '2024-05-15'),
(6, 6, 4, 'PENDIENTE', '2024-05-01', '2024-05-15'),
(7, 6, 4, 'PENDIENTE', '2024-05-01', '2024-05-15'),
(8, 6, 4, 'PENDIENTE', '2024-05-01', '2024-05-15'),
(9, 6, 5, 'PENDIENTE', '2024-05-17', '2024-06-05'),
(10, 6, 5, 'PENDIENTE', '2024-05-17', '2024-06-05'),
(11, 6, 6, 'PENDIENTE', '2024-05-31', '2024-06-24'),
(12, 6, 6, 'PENDIENTE', '2024-05-31', '2024-06-24'),
(13, 6, 8, 'PENDIENTE', '2024-05-09', '2024-06-07'),
(14, 6, 6, 'PENDIENTE', '2024-05-02', '2024-05-26'),
(15, 6, 6, 'PENDIENTE', '2024-05-02', '2024-05-26'),
(16, 6, 1, 'PENDIENTE', '2024-05-11', '2024-05-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`province_id`, `province_name`, `department_id`) VALUES
(1, 'Trujillo', 1),
(2, 'Ascope', 1),
(3, 'Bolívar', 1),
(4, 'Chepén', 1),
(5, 'Julcán', 1),
(6, 'Otuzco', 1),
(7, 'Pacasmayo', 1),
(8, 'Pataz', 1),
(9, 'Sánchez Carrión', 1),
(10, 'Virú', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`department_id`);

--
-- Indices de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD PRIMARY KEY (`det_id`),
  ADD KEY `loan_id` (`loan_id`);

--
-- Indices de la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`district_id`);

--
-- Indices de la tabla `inversionista`
--
ALTER TABLE `inversionista`
  ADD PRIMARY KEY (`investor_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `district_id` (`district_id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indices de la tabla `jefe_prestamista`
--
ALTER TABLE `jefe_prestamista`
  ADD PRIMARY KEY (`leader_id`),
  ADD KEY `investor_id` (`investor_id`);

--
-- Indices de la tabla `pagos_diarios`
--
ALTER TABLE `pagos_diarios`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `borrower_det_id` (`borrower_det_id`);

--
-- Indices de la tabla `prestamista`
--
ALTER TABLE `prestamista`
  ADD PRIMARY KEY (`lender_id`),
  ADD KEY `leader_id` (`leader_id`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indices de la tabla `prestatario`
--
ALTER TABLE `prestatario`
  ADD PRIMARY KEY (`borrower_id`),
  ADD KEY `lender_id` (`lender_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indices de la tabla `prestatario_prestamo`
--
ALTER TABLE `prestatario_prestamo`
  ADD PRIMARY KEY (`bor_det_id`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `det_loan_id` (`det_loan_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`province_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  MODIFY `det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `inversionista`
--
ALTER TABLE `inversionista`
  MODIFY `investor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `jefe_prestamista`
--
ALTER TABLE `jefe_prestamista`
  MODIFY `leader_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pagos_diarios`
--
ALTER TABLE `pagos_diarios`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamista`
--
ALTER TABLE `prestamista`
  MODIFY `lender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prestatario`
--
ALTER TABLE `prestatario`
  MODIFY `borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestatario_prestamo`
--
ALTER TABLE `prestatario_prestamo`
  MODIFY `bor_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inversionista`
--
ALTER TABLE `inversionista`
  ADD CONSTRAINT `inversionista_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `administrador` (`admin_id`);

--
-- Filtros para la tabla `jefe_prestamista`
--
ALTER TABLE `jefe_prestamista`
  ADD CONSTRAINT `jefe_prestamista_ibfk_1` FOREIGN KEY (`investor_id`) REFERENCES `inversionista` (`investor_id`);

--
-- Filtros para la tabla `prestamista`
--
ALTER TABLE `prestamista`
  ADD CONSTRAINT `prestamista_ibfk_1` FOREIGN KEY (`leader_id`) REFERENCES `jefe_prestamista` (`leader_id`);

--
-- Filtros para la tabla `prestatario`
--
ALTER TABLE `prestatario`
  ADD CONSTRAINT `prestatario_ibfk_1` FOREIGN KEY (`lender_id`) REFERENCES `prestamista` (`lender_id`),
  ADD CONSTRAINT `prestatario_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `distrito` (`district_id`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departamento` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

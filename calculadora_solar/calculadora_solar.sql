-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/02/2025 às 01:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `calculadora_solar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bateriasolar`
--

CREATE TABLE `bateriasolar` (
  `sku` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `tensao_nominal_1` int(11) DEFAULT NULL,
  `tensao_nominal_2` int(11) DEFAULT NULL,
  `tensao_nominal_3` int(11) DEFAULT NULL,
  `tensao_nominal_4` int(11) DEFAULT NULL,
  `capacidade_ah` int(11) DEFAULT NULL,
  `descarregar_ate` decimal(3,1) DEFAULT NULL,
  `rendimento` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bateriasolar`
--

INSERT INTO `bateriasolar` (`sku`, `modelo`, `tensao_nominal_1`, `tensao_nominal_2`, `tensao_nominal_3`, `tensao_nominal_4`, `capacidade_ah`, `descarregar_ate`, `rendimento`) VALUES
(24231, 'BATERIA SOLAR 12-150AH ELO SOLAR', 12, 24, 36, 48, 150, 0.8, 0.9),
(27548, 'BATERIA ESTACIONARIA 12V 60AH INTELBRAS', 12, 24, 36, 48, 60, 0.3, 0.9),
(27612, 'BATERIA ESTACIONARIA 12V 45AH INTELBRAS', 12, 24, 36, 48, 45, 0.3, 0.9),
(27919, 'BATERIA SELADA SOLAR 12V 220AH MOURA', 12, 24, 36, 48, 220, 0.8, 0.9),
(28887, 'BATERIA ESTACIONARIA 12V 45AH MOURA', 12, 24, 36, 48, 45, 0.3, 0.9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `controladorcarga`
--

CREATE TABLE `controladorcarga` (
  `sku` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `tensao_nominal_1` int(11) DEFAULT NULL,
  `tensao_nominal_2` int(11) DEFAULT NULL,
  `tensao_nominal_3` int(11) DEFAULT NULL,
  `tensao_circuito_aberto_max` int(11) DEFAULT NULL,
  `corrente_carga_nominal` int(11) DEFAULT NULL,
  `eficiencia` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `controladorcarga`
--

INSERT INTO `controladorcarga` (`sku`, `modelo`, `tensao_nominal_1`, `tensao_nominal_2`, `tensao_nominal_3`, `tensao_circuito_aberto_max`, `corrente_carga_nominal`, `eficiencia`) VALUES
(22776, 'CONTROLADOR DE CARGA EPEVER MPPT 20A', 12, 24, NULL, 92, 20, 0.98),
(22777, 'CONTROLADOR DE CARGA EPEVER MPPT 30A', 12, 24, NULL, 92, 30, 0.98),
(22778, 'CONTROLADOR DE CARGA EPEVER MPPT 40A', 12, 24, 48, 138, 40, 0.98),
(22779, 'CONTROLADOR DE CARGA EPEVER MPPT 40A', 12, 24, 48, 138, 40, 0.98),
(22780, 'CONTROLADOR DE CARGA EPEVER MPPT 50A', 12, 24, 48, 138, 50, 0.98),
(22781, 'CONTROLADOR DE CARGA EPEVER MPPT 60A', 12, 24, 48, 180, 60, 0.98),
(22782, 'CONTROLADOR DE CARGA EPEVER MPPT 60A', 12, 24, 48, 180, 60, 0.98);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inversorsolar`
--

CREATE TABLE `inversorsolar` (
  `sku` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `potencia_nominal` int(11) DEFAULT NULL,
  `potencia_trabalho` int(11) DEFAULT NULL,
  `tensao_entrada` int(11) DEFAULT NULL,
  `tensao_saida` int(11) DEFAULT NULL,
  `eficiencia` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `inversorsolar`
--

INSERT INTO `inversorsolar` (`sku`, `modelo`, `potencia_nominal`, `potencia_trabalho`, `tensao_entrada`, `tensao_saida`, `eficiencia`) VALUES
(22768, 'INVERSOR SENOIDAL 350W 12V/110V IP350-11 EPEVER', 350, 280, 12, 127, 0.91),
(23132, 'INVERSOR DE TENSÃO ONDA SENOIDAL 1500W ISV 1501 INTELBRAS', 1500, 1500, 24, 127, 0.85),
(23133, 'INVERSOR DE TENSÃO SENOIDAL 750W ISV 751 INTELBRAS', 750, 750, 24, 127, 0.85),
(25378, 'INVERSOR SENOIDAL 1000W 24V/110V IP1000-21-PLUS(T) EPEVER', 1000, 1000, 24, 127, 0.91),
(25379, 'INVERSOR SENOIDAL 2000W 24V/220V IP2000-22-PLUS(T) EPEVER', 2000, 2000, 24, 220, 0.91),
(25380, 'INVERSOR SENOIDAL 2000W 24V/110V IP2000-21-PLUS(T) EPEVER', 2000, 2000, 24, 127, 0.91),
(25381, 'INVERSOR SENOIDAL 4000W 48V/220V IP4000-42-PLUS(T) EPEVER', 4000, 4000, 48, 220, 0.91),
(25382, 'INVERSOR SENOIDAL 4000W 48V/110V IP4000-41-PLUS(T) EPEVER', 4000, 4000, 48, 127, 0.88);

-- --------------------------------------------------------

--
-- Estrutura para tabela `placasolar`
--

CREATE TABLE `placasolar` (
  `sku` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `potencia_max` int(11) DEFAULT NULL,
  `tensao_circuito` decimal(4,1) DEFAULT NULL,
  `corrente_curto` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `placasolar`
--

INSERT INTO `placasolar` (`sku`, `modelo`, `potencia_max`, `tensao_circuito`, `corrente_curto`) VALUES
(18450, 'MODULO FOTOVOLTAICO INTELBRAS 160W', 160, 21.6, 9.25),
(20745, 'PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 440W', 440, 48.7, 11.48),
(22444, 'PAINEL FOTOVOLTAICO MONOCRISTALINO SUNOVA 450W', 450, 50.4, 11.47),
(22473, 'PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 500W', 500, 45.5, 13.72),
(26035, 'PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 550W', 550, 49.6, 14.00),
(26386, 'PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 575W', 575, 51.3, 14.29),
(26863, 'PAINEL FOTOVOLTAICO MONOCRISTALINO JA SOLAR 550W', 550, 49.9, 14.00),
(28824, 'PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 555W', 555, 49.9, 14.00),
(28864, 'PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 555W', 555, 50.3, 13.96);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bateriasolar`
--
ALTER TABLE `bateriasolar`
  ADD PRIMARY KEY (`sku`);

--
-- Índices de tabela `controladorcarga`
--
ALTER TABLE `controladorcarga`
  ADD PRIMARY KEY (`sku`);

--
-- Índices de tabela `inversorsolar`
--
ALTER TABLE `inversorsolar`
  ADD PRIMARY KEY (`sku`);

--
-- Índices de tabela `placasolar`
--
ALTER TABLE `placasolar`
  ADD PRIMARY KEY (`sku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

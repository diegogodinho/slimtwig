-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2018 at 03:40 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diego`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(4000) NOT NULL,
  `email` varchar(4000) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `tipopessoa` bit(1) NOT NULL DEFAULT b'1',
  `identidade` varchar(20) DEFAULT NULL,
  `sexo` bit(1) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `telefonecel` varchar(50) DEFAULT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  `estadocivil` varchar(100) DEFAULT NULL,
  `idusuariocriacao` int(11) NOT NULL,
  `idendereco` int(4) DEFAULT NULL,
  `observacao` varchar(4000) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) NOT NULL,
  `physicaldirectory` varchar(4000) NOT NULL,
  `urlrelative` varchar(4000) NOT NULL,
  `isWaterMark` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `name`, `physicaldirectory`, `urlrelative`, `isWaterMark`) VALUES
(166, '236a9e42b993c4b5.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\236a9e42b993c4b5.png', 'http://localhost:8080/slimtwig/uploads/236a9e42b993c4b5.png', b'0'),
(163, '68013c10d06c67ba.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\68013c10d06c67ba.png', 'http://localhost:8080/slimtwig/uploads/68013c10d06c67ba.png', b'0'),
(164, '80c0d8abbf96eb66.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\80c0d8abbf96eb66.png', 'http://localhost:8080/slimtwig/uploads/80c0d8abbf96eb66.png', b'0'),
(161, 'fbb6e784ace61849.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\fbb6e784ace61849.png', 'http://localhost:8080/slimtwig/uploads/fbb6e784ace61849.png', b'1'),
(162, 'd19a9f4fd4433b7e.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\d19a9f4fd4433b7e.png', 'http://localhost:8080/slimtwig/uploads/d19a9f4fd4433b7e.png', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(4000) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `active`) VALUES
(1, 'Esquadrias de aluminio', b'1'),
(6, 'Gargem Livre, demarcada', b'1'),
(5, 'Piso em ceramica', b'1'),
(14, 'Aceita financiamento', b'1'),
(7, 'Vaga Livre, demarcada e coberta', b'1'),
(8, 'Sol da manha', b'1'),
(9, 'Agua individual', b'1'),
(10, 'Medidor de agua individual', b'1'),
(11, 'Não possui vaga de garagem', b'1'),
(12, 'Armário embutido', b'1'),
(13, 'Jardim', b'1'),
(15, 'Sol da manhã', b'1'),
(16, 'Varanda', b'1'),
(17, 'Armário cozinha', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `login` varchar(400) NOT NULL,
  `senha` varchar(4000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `created_at`, `updated_at`, `ativo`) VALUES
(1, 'Diego', 'diego@diego.com', 'diego', '$2y$10$lZKrq2ztkiOmk.i.0JSmV.Sa/4/b1Et9PZ1LOz86EZVHbmi3HveIu', '2018-06-12 12:34:51', '2018-06-12 11:34:51', b'1'),
(32, 'Test', 'test@test.com', 'test', '$2y$10$Q6OMwN8sIsZVH3l0R4RkOORUuQ9rWpK03Xg49xCCY95KLkdiPqUFK', '2018-06-12 11:16:42', '2018-06-12 10:16:42', b'0'),
(33, 'Thiago', 'thiago@vitalimobiliaria.com.br', 'thiago', '$2y$10$663CqQhQu0KD/t92w7mnHezQ1YEk4.df7FleMbOniXe0c3S/F7dN6', '2018-06-12 10:58:13', '2018-06-12 09:58:13', b'1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2018 at 03:33 PM
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
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cidade`
--

INSERT INTO `cidade` (`id`, `nome`, `estado_id`) VALUES
(1, 'Rio de Janeiro', 2),
(2, 'Belo Horizonte', 1),
(3, 'Contagem', 1),
(4, 'Betim', 1);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `sigla` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `nome`, `sigla`) VALUES
(1, 'Minas Gerais', 'MG'),
(2, 'Rio de Janeiro', 'RJ');

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
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `name`, `physicaldirectory`, `urlrelative`, `isWaterMark`) VALUES
(161, 'fbb6e784ace61849.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\fbb6e784ace61849.png', 'http://localhost:8080/slimtwig/uploads/fbb6e784ace61849.png', b'1'),
(195, 'd9f942f3d8860c31.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\d9f942f3d8860c31.png', 'http://localhost:8080/slimtwig/uploads/d9f942f3d8860c31.png', b'0'),
(211, '46ba2ce45266ce8b.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\46ba2ce45266ce8b.png', 'http://localhost:8080/slimtwig/uploads/46ba2ce45266ce8b.png', b'0'),
(212, '754b2de5e5fef9af.png', 'C:\\wamp64\\www\\slimtwig/uploads/754b2de5e5fef9af.png', 'http://localhost:8080/slimtwig/uploads/754b2de5e5fef9af.png', b'0'),
(213, '202903872bbd9c35.png', 'C:\\wamp64\\www\\slimtwig/uploads/202903872bbd9c35.png', 'http://localhost:8080/slimtwig/uploads/202903872bbd9c35.png', b'0'),
(214, '2fd9802c5292e6d1.png', 'C:\\wamp64\\www\\slimtwig/uploads/2fd9802c5292e6d1.png', 'http://localhost:8080/slimtwig/uploads/2fd9802c5292e6d1.png', b'0'),
(215, 'd2fb05fd79b6400a.png', 'C:\\wamp64\\www\\slimtwig/uploads/d2fb05fd79b6400a.png', 'http://localhost:8080/slimtwig/uploads/d2fb05fd79b6400a.png', b'0'),
(216, '06de03f2981c6765.png', 'C:\\wamp64\\www\\slimtwig/uploads/06de03f2981c6765.png', 'http://localhost:8080/slimtwig/uploads/06de03f2981c6765.png', b'0'),
(217, '70441a98351eff65.png', 'C:\\wamp64\\www\\slimtwig/uploads/70441a98351eff65.png', 'http://localhost:8080/slimtwig/uploads/70441a98351eff65.png', b'0'),
(218, 'fb1c02778894bb28.png', 'C:\\wamp64\\www\\slimtwig/uploads/fb1c02778894bb28.png', 'http://localhost:8080/slimtwig/uploads/fb1c02778894bb28.png', b'0'),
(219, '6fbe8058b0ac4a99.png', 'C:\\wamp64\\www\\slimtwig/uploads/6fbe8058b0ac4a99.png', 'http://localhost:8080/slimtwig/uploads/6fbe8058b0ac4a99.png', b'0'),
(220, '14aa2d53128922b6.png', 'C:\\wamp64\\www\\slimtwig/uploads/14aa2d53128922b6.png', 'http://localhost:8080/slimtwig/uploads/14aa2d53128922b6.png', b'0'),
(221, '00f906074743469a.png', 'C:\\wamp64\\www\\slimtwig/uploads/00f906074743469a.png', 'http://localhost:8080/slimtwig/uploads/00f906074743469a.png', b'0'),
(222, '8dbcfd0c38e7c52c.png', 'C:\\wamp64\\www\\slimtwig/uploads/8dbcfd0c38e7c52c.png', 'http://localhost:8080/slimtwig/uploads/8dbcfd0c38e7c52c.png', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`id`, `nome`) VALUES
(1, 'Administradores'),
(2, 'Gestores');

-- --------------------------------------------------------

--
-- Table structure for table `itemimovel`
--

DROP TABLE IF EXISTS `itemimovel`;
CREATE TABLE IF NOT EXISTS `itemimovel` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nome` varchar(4000) NOT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  `possuiqtde` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemimovel`
--

INSERT INTO `itemimovel` (`id`, `nome`, `ativo`, `possuiqtde`) VALUES
(1, 'Esquadrias de aluminio', b'1', b'0'),
(6, 'Gargem Livre, demarcada', b'1', b'0'),
(5, 'Piso em ceramica', b'1', b'0'),
(14, 'Aceita financiamento', b'1', b'0'),
(7, 'Vaga Livre, demarcada e coberta', b'1', b'0'),
(8, 'Sol da manha', b'1', b'0'),
(9, 'Agua individual', b'1', b'0'),
(10, 'Medidor de agua individual', b'1', b'0'),
(11, 'Não possui vaga de garagem', b'1', b'0'),
(12, 'Armário embutido', b'1', b'0'),
(13, 'Jardim', b'1', b'0'),
(15, 'Sol da manhã', b'1', b'0'),
(16, 'Varanda', b'1', b'1'),
(17, 'Ar condicionado central', b'1', b'1');

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
-- Table structure for table `tipoimovel`
--

DROP TABLE IF EXISTS `tipoimovel`;
CREATE TABLE IF NOT EXISTS `tipoimovel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipoimovel`
--

INSERT INTO `tipoimovel` (`id`, `nome`, `ativo`) VALUES
(1, 'Apart Hotel', b'1'),
(2, 'Apartamento', b'1'),
(3, 'Apartamento com area privativa', b'1'),
(4, 'Area comercial', b'1'),
(5, 'Casa', b'1'),
(6, 'Casa comercial', b'1'),
(7, 'Casa geminada', b'1'),
(8, 'Casa geminada coletiva', b'1'),
(9, 'Cobertura', b'1'),
(10, 'Cobertura triplex', b'1'),
(11, 'Estacionamento', b'1'),
(12, 'Flat', b'1'),
(13, 'Galpão', b'1'),
(14, 'Loja', b'1'),
(15, 'Lote', b'1'),
(16, 'Predio comercial', b'1'),
(17, 'Sala', b'0');

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
  `grupo_id` int(11) DEFAULT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  `foto_id` int(11) DEFAULT NULL,
  `tipousuario` int(2) NOT NULL DEFAULT '1',
  `cpf` varchar(20) NOT NULL,
  `identidade` varchar(20) NOT NULL,
  `datanascimento` date DEFAULT NULL,
  `creci` varchar(50) DEFAULT NULL,
  `dataadmissao` date DEFAULT NULL,
  `datademissao` date DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `telefonecel` varchar(20) DEFAULT NULL,
  `observacoes` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idfoto` (`foto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `grupo_id`, `ativo`, `foto_id`, `tipousuario`, `cpf`, `identidade`, `datanascimento`, `creci`, `dataadmissao`, `datademissao`, `telefone`, `telefonecel`, `observacoes`, `created_at`, `updated_at`) VALUES
(1, 'Diego', 'diego@diego.com', 'diego', '$2y$10$rLLSnN1Aeog1VPJw90PHzebCsXyCoe06SIpvdA4KPSotXi8syJFr.', 2, b'1', 212, 0, '07641813607', 'MG11627842', '1987-08-27', '', NULL, NULL, '', '', '', '0000-00-00 00:00:00', '2018-06-18 14:21:20'),
(33, 'Thiago', 'thiago@vitalimobiliaria.com.br', 'thiago', '$2y$10$UmmDsl2UjfFhoRLfVrr79.DRz1Ilrenl2s5HrbCWCLCFm5iP3x2c.', NULL, b'1', 211, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2018-06-15 14:01:08'),
(47, 'denise', 'denise@denise.com', 'denise', '$2y$10$4HraA8pdmFUL2tZvTMGb6OJgPnoCTV2g6gX8CLNxwcGUOel/iGDlS', 1, b'1', 219, 1, '07641813607', 'mg11627842', NULL, 'test', '2018-05-22', NULL, '3136572043', '3196842278', 'test', '2018-06-18 09:57:19', '2018-06-18 09:57:19'),
(48, 'dieguito', 'dieguito@dieguito.com', 'dieguito', '$2y$10$1ZBegVrs6b2Y5.FT6xcI/ehFrJriMLx1Pn9m6kZQZwo7SN40HXxK.', 1, b'1', 220, 1, '07641813607', 'mg11627842', '1987-08-27', 'test', '2018-05-22', NULL, '3196842278', '3196842278', 'dieguitodieguitodieguito', '2018-06-18 10:06:59', '2018-06-18 10:06:59'),
(49, 'jesus', 'jesus@jesus.comn', 'jesus', '$2y$10$IJ9fXQVI5wz/LEHcxmbu3eIhCLcMKeHCV6Nn8kDRSQ98DCe.WzsmS', 1, b'1', 0, 1, '07641813607', 'mg11627842', '1987-08-27', 'test', '2018-05-22', NULL, '3136572043', '3136572043', 'test', '2018-06-18 10:27:29', '2018-06-18 10:27:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

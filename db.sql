-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 28, 2018 at 11:57 AM
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
-- Table structure for table `acaofuncionalidade`
--

DROP TABLE IF EXISTS `acaofuncionalidade`;
CREATE TABLE IF NOT EXISTS `acaofuncionalidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `url` varchar(4000) NOT NULL,
  `metodo` varchar(400) NOT NULL,
  `funcionalidade_id` int(11) NOT NULL,
  `precisadepermissao` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acaofuncionalidade`
--

INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`, `precisadepermissao`) VALUES
(1, 'home', '/restrict', 'get,post', 8, b'0'),
(2, 'home', '/restrict/logout', 'get,post', 8, b'0'),
(3, 'Salvar fotos de Perfil', '/restrict/foto/usuario/save', 'get,post', 8, b'0'),
(4, 'Exibir', '/restrict/usuario', 'get,post', 8, b'1'),
(5, 'Incluir', '/restrict/usuario/new', 'get,post', 8, b'1'),
(6, 'Editar', '/restrict/usuario/{id}', 'get,post', 8, b'1'),
(7, 'Ativar', '/restrict/usuario/actdeact/{id}', 'post', 8, b'1'),
(8, 'Editar Profile', '/restrict/usuario/profile', 'get,post', 8, b'0'),
(9, 'Exibir', '/restrict/tipoimovel', 'get,post', 2, b'1'),
(10, 'Incluir', '/restrict/tipoimovel/new', 'get,post', 2, b'1'),
(11, 'Editar', '/restrict/tipoimovel/{id}', 'get,post', 2, b'1'),
(12, 'Ativar', '/restrict/tipoimovel/actdeact/{id}', 'post', 2, b'1'),
(13, 'Exibir', '/restrict/itemimovel', 'get,post', 3, b'1'),
(14, 'Incluir', '/restrict/itemimovel/new', 'get,post', 3, b'1'),
(15, 'Editar', '/restrict/itemimovel/{id}', 'get,post', 3, b'1'),
(16, 'Ativar', '/restrict/itemimovel/actdeact/{id}', 'post', 3, b'1'),
(17, 'Exibir', '/restrict/estado', 'get,post', 4, b'1'),
(18, 'Incluir', '/restrict/estado/new', 'get,post', 4, b'1'),
(19, 'Editar', '/restrict/estado/{id}', 'get,post', 4, b'1'),
(20, 'Ativar', '/restrict/estado/actdeact/{id}', 'post', 4, b'1'),
(21, 'Exibir', '/restrict/cidade', 'get,post', 5, b'1'),
(22, 'Incluir', '/restrict/cidade/new', 'get,post', 5, b'1'),
(23, 'Editar', '/restrict/cidade/{id}', 'get,post', 5, b'1'),
(24, 'Ativar', '/restrict/cidade/actdeact/{id}', 'post', 5, b'1'),
(25, 'Exibir Drop Cidade', '/restrict/cidade/getcidadedropdown', 'post', 5, b'0'),
(26, 'Exibir', '/restrict/bairro', 'get,post', 6, b'1'),
(27, 'Incluir', '/restrict/bairro/new', 'get,post', 6, b'1'),
(28, 'Editar', '/restrict/bairro/{id}', 'get,post', 6, b'1'),
(29, 'Ativar', '/restrict/bairro/actdeact/{id}', 'post', 6, b'1'),
(30, 'Exibir Drop Bairro', '/restrict/bairro/getcidadedropdown', 'post', 6, b'0'),
(31, 'Exibir', '/restrict/grupo', 'get,post', 9, b'1'),
(32, 'Incluir', '/restrict/grupo/new', 'get,post', 9, b'1'),
(33, 'Editar', '/restrict/grupo/{id}', 'get,post', 9, b'1'),
(34, 'Ativar', '/restrict/grupo/actdeact/{id}', 'post', 9, b'1'),
(35, 'Exibir', '/restrict/construtora', 'get,post', 10, b'1'),
(36, 'Incluir', '/restrict/construtora/new', 'get,post', 10, b'1'),
(37, 'Editar', '/restrict/construtora/{id}', 'get,post', 10, b'1'),
(38, 'Ativar', '/restrict/construtora/actdeact/{id}', 'post', 10, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `bairro`
--

DROP TABLE IF EXISTS `bairro`;
CREATE TABLE IF NOT EXISTS `bairro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=640 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bairro`
--

INSERT INTO `bairro` (`id`, `nome`, `cidade_id`) VALUES
(639, 'Parque Recreio', 8),
(638, 'Castelo', 6);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cidade`
--

INSERT INTO `cidade` (`id`, `nome`, `estado_id`) VALUES
(9, 'Mateus Leme', 15),
(8, 'Contagem', 15),
(7, 'Betim', 15),
(6, 'Belo Horizonte', 15);

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
-- Table structure for table `construtora`
--

DROP TABLE IF EXISTS `construtora`;
CREATE TABLE IF NOT EXISTS `construtora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(4000) NOT NULL,
  `bairro_id` int(11) DEFAULT NULL,
  `endereco` varchar(4000) DEFAULT NULL,
  `complemento` varchar(4000) DEFAULT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `construtora`
--

INSERT INTO `construtora` (`id`, `nome`, `bairro_id`, `endereco`, `complemento`, `ativo`) VALUES
(1, 'mrv', 638, 'Av dos engenheiros 190', '', b'1'),
(2, 'Test', 639, 'Rua lisboa 190 parque recreio contagem', '', b'0');

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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `nome`, `sigla`) VALUES
(4, 'Alagoas', 'AL'),
(3, 'Acre', 'AC'),
(5, 'Amapá', 'AP'),
(6, 'Amazonas', 'AM'),
(7, 'Bahia', 'BA'),
(8, 'Ceará', 'CE'),
(9, 'Distrito Federal', 'DF'),
(10, 'Espírito Santo', 'ES'),
(11, 'Goiás', 'GO'),
(12, 'Maranhão', 'MA'),
(13, 'Mato Grosso', 'MT'),
(14, 'Mato Grosso do Sul', 'MS'),
(15, 'Minas Gerais', 'MG'),
(16, 'Pará', 'PA'),
(17, 'Paraíba', 'PB'),
(18, 'Paraná', 'PR'),
(19, 'Pernambuco', 'PE'),
(20, 'Piauí', 'PI'),
(21, 'Rio de Janeiro', 'RJ'),
(22, 'Rio Grande do Norte', 'RN'),
(23, 'Rio Grande do Sul', 'RS'),
(24, 'Rondônia', 'RO'),
(25, 'Roraima', 'RR'),
(26, 'Santa Catarina', 'SC'),
(27, 'São Paulo', 'SP'),
(28, 'Sergipe', 'SE'),
(29, 'Tocantins', 'TO');

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
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `name`, `physicaldirectory`, `urlrelative`, `isWaterMark`) VALUES
(161, 'fbb6e784ace61849.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\fbb6e784ace61849.png', 'http://localhost:8080/slimtwig/uploads/fbb6e784ace61849.png', b'1'),
(195, 'd9f942f3d8860c31.png', 'C:\\wamp64\\www\\slimtwig\\uploads\\d9f942f3d8860c31.png', 'http://localhost:8080/slimtwig/uploads/d9f942f3d8860c31.png', b'0'),
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
(222, '8dbcfd0c38e7c52c.png', 'C:\\wamp64\\www\\slimtwig/uploads/8dbcfd0c38e7c52c.png', 'http://localhost:8080/slimtwig/uploads/8dbcfd0c38e7c52c.png', b'0'),
(223, 'e7bce073c0a45734.png', 'C:\\wamp64\\www\\slimtwig/uploads/e7bce073c0a45734.png', 'http://localhost:8080/slimtwig/uploads/e7bce073c0a45734.png', b'0'),
(224, 'd24d8036882b22c6.png', 'C:\\wamp64\\www\\slimtwig/uploads/d24d8036882b22c6.png', 'http://localhost:8080/slimtwig/uploads/d24d8036882b22c6.png', b'0'),
(225, '7b5173aff6db36f1.png', 'C:\\wamp64\\www\\slimtwig/uploads/7b5173aff6db36f1.png', 'http://localhost:8080/slimtwig/uploads/7b5173aff6db36f1.png', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `funcionalidade`
--

DROP TABLE IF EXISTS `funcionalidade`;
CREATE TABLE IF NOT EXISTS `funcionalidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `pai_id` int(2) DEFAULT NULL,
  `acessar` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `funcionalidade`
--

INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES
(1, 'Cadastros Basicos', NULL, b'1'),
(2, 'Tipo de Imovel', 1, b'1'),
(3, 'Item de Imovel', 1, b'1'),
(4, 'Estado', 1, b'1'),
(5, 'Cidade', 1, b'1'),
(6, 'Bairro', 1, b'1'),
(10, 'Construtora', 1, b'1'),
(7, 'Seguranca', NULL, b'1'),
(8, 'Cadastros de Usuarios', 7, b'1'),
(9, 'Grupos e Permissoes', 7, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
(17, 'Ar condicionado central', b'1', b'1'),
(18, 'Test', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `acaofuncionalidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissao`
--

INSERT INTO `permissao` (`id`, `grupo_id`, `usuario_id`, `acaofuncionalidade_id`) VALUES
(1, 2, NULL, 12),
(2, 2, NULL, 9),
(3, 2, NULL, 10),
(4, 2, NULL, 16),
(5, 2, NULL, 13),
(6, 2, NULL, 14),
(7, 2, NULL, 20),
(8, 2, NULL, 17),
(9, 2, NULL, 18),
(10, 2, NULL, 24),
(11, 2, NULL, 21),
(12, 2, NULL, 22),
(13, 2, NULL, 29),
(14, 2, NULL, 26),
(15, 2, NULL, 27),
(16, 2, NULL, 7),
(17, 2, NULL, 4),
(18, 2, NULL, 5),
(19, 2, NULL, 34),
(20, 2, NULL, 31),
(21, 2, NULL, 32),
(22, 2, NULL, 38),
(23, 2, NULL, 35),
(24, 2, NULL, 36);

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
(17, 'Sala', b'0'),
(18, 'Test', b'0');

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
  `bairro_id` int(11) DEFAULT NULL,
  `endereco` varchar(4000) DEFAULT NULL,
  `numero` varchar(400) DEFAULT NULL,
  `complemento` varchar(4000) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idfoto` (`foto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `grupo_id`, `ativo`, `foto_id`, `tipousuario`, `cpf`, `identidade`, `datanascimento`, `creci`, `dataadmissao`, `datademissao`, `telefone`, `telefonecel`, `observacoes`, `bairro_id`, `endereco`, `numero`, `complemento`, `created_at`, `updated_at`) VALUES
(1, 'Diego', 'diego@diego.com', 'diego', '$2y$10$rLLSnN1Aeog1VPJw90PHzebCsXyCoe06SIpvdA4KPSotXi8syJFr.', 2, b'1', 212, 3, '07641813607', 'MG-11.627.842', NULL, '', NULL, NULL, '', '', 'Ola Teste', NULL, 'Rua Lisboa 190, Parque Recreio', '190', '', '0000-00-00 00:00:00', '2018-06-20 09:12:13'),
(2, 'Thiago', 'thiago@vitalimobiliaria.com.br', 'thiago', '$2y$10$NGjc4OuHftvjZ1WQZjDEJet60xXIjfsCjgTczu/kCS1.N1Ihon2bi', 2, b'1', 225, 0, '99999999999', 'kk-00.000.000', '1984-05-26', '', NULL, NULL, '', '', '', 639, '', '', '', '0000-00-00 00:00:00', '2018-06-28 10:38:09'),
(53, 'test', 'aaaa@aaa.com', 'aaa', '$2y$10$o53Ud9Ey.jAXbKkm.IOkW.CpTkJaBTAuUY3yZkSawdUmRR6uzBQRi', NULL, b'0', 0, 1, '21321321213', 'da-12.321.332', NULL, '', NULL, NULL, '3221332132', '', '', NULL, '', '', '', '2018-06-28 10:27:31', '2018-06-28 10:27:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

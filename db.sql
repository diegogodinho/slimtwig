-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2017 at 01:23 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3142383_diego`
--

-- --------------------------------------------------------

--
-- Table structure for table `awnser`
--

CREATE TABLE `awnser` (
  `id` int(11) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `question_id` int(11) NOT NULL,
  `right_awnser` bit(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awnser`
--

INSERT INTO `awnser` (`id`, `description`, `question_id`, `right_awnser`, `created_at`, `updated_at`) VALUES
(8, '1', 3, b'0', '2017-10-12 11:58:57', '2017-10-12 11:58:57'),
(9, '5', 3, b'1', '2017-10-12 11:58:57', '2017-10-12 11:58:57'),
(10, '3', 3, b'0', '2017-10-12 11:58:57', '2017-10-12 11:58:57'),
(11, '4', 3, b'0', '2017-10-12 11:58:57', '2017-10-12 11:58:57'),
(12, 'Flamengo', 4, b'0', '2017-10-12 12:00:06', '2017-10-12 12:00:06'),
(13, 'Corinthians', 4, b'0', '2017-10-12 12:00:07', '2017-10-12 12:00:07'),
(14, 'Vasco', 4, b'0', '2017-10-12 12:00:07', '2017-10-12 12:00:07'),
(15, 'Palmeiras', 4, b'1', '2017-10-12 12:00:07', '2017-10-12 12:00:07'),
(16, '3', 5, b'0', '2017-10-12 12:01:02', '2017-10-12 12:01:02'),
(17, '4', 5, b'1', '2017-10-12 12:01:02', '2017-10-12 12:01:02'),
(18, '1', 5, b'0', '2017-10-12 12:01:02', '2017-10-12 12:01:02'),
(19, '2', 5, b'0', '2017-10-12 12:01:02', '2017-10-12 12:01:02'),
(41, 'Jorge Wágner', 7, b'0', '2017-10-17 12:40:39', '2017-10-17 12:40:39'),
(42, 'Gil', 7, b'1', '2017-10-17 12:40:39', '2017-10-17 12:40:39'),
(43, 'Liédson', 7, b'0', '2017-10-17 12:40:21', '2017-10-17 12:40:21'),
(44, 'Leandro', 7, b'0', '2017-10-17 12:40:21', '2017-10-17 12:40:21'),
(45, 'Cléber', 7, b'0', '2017-10-17 12:40:21', '2017-10-17 12:40:21'),
(46, 'Santo André', 8, b'0', '2017-10-17 12:42:24', '2017-10-17 12:42:24'),
(47, 'Brasiliense', 8, b'1', '2017-10-17 12:42:24', '2017-10-17 12:42:24'),
(48, 'Paulista de Jundiaí', 8, b'0', '2017-10-17 12:42:00', '2017-10-17 12:42:00'),
(49, 'Brasil de Pelotas', 8, b'0', '2017-10-17 12:42:00', '2017-10-17 12:42:00'),
(50, 'Brasília', 8, b'0', '2017-10-17 12:42:00', '2017-10-17 12:42:00'),
(51, 'Itália', 9, b'0', '2017-10-17 12:44:41', '2017-10-17 12:44:41'),
(52, 'Brasil', 9, b'0', '2017-10-17 12:44:41', '2017-10-17 12:44:41'),
(53, 'México', 9, b'0', '2017-10-17 12:44:41', '2017-10-17 12:44:41'),
(54, 'Estados Unidos', 9, b'1', '2017-10-17 12:44:41', '2017-10-17 12:44:41'),
(55, 'França', 9, b'0', '2017-10-17 12:44:41', '2017-10-17 12:44:41'),
(56, 'Stoichkov e Klinsmann', 10, b'0', '2017-10-17 12:45:31', '2017-10-17 12:45:31'),
(57, 'Romário e Bebeto', 10, b'0', '2017-10-17 12:45:56', '2017-10-17 12:45:56'),
(58, 'Salenko e Stoichkov', 10, b'1', '2017-10-17 12:45:56', '2017-10-17 12:45:56'),
(59, 'Klinsmann e Salenko', 10, b'0', '2017-10-17 12:45:31', '2017-10-17 12:45:31'),
(60, 'Salenko e Romário', 10, b'0', '2017-10-17 12:45:31', '2017-10-17 12:45:31'),
(61, 'Dunga', 11, b'1', '2017-10-17 12:46:50', '2017-10-17 12:46:50'),
(62, 'Branco', 11, b'0', '2017-10-17 12:46:50', '2017-10-17 12:46:50'),
(63, 'Romário', 11, b'0', '2017-10-17 12:46:50', '2017-10-17 12:46:50'),
(64, 'Márcio Santos', 11, b'0', '2017-10-17 12:46:50', '2017-10-17 12:46:50'),
(65, 'Jorginho', 11, b'0', '2017-10-17 12:46:50', '2017-10-17 12:46:50'),
(66, 'Kuki', 12, b'0', '2017-10-17 12:50:05', '2017-10-17 12:50:05'),
(67, 'Baiano', 12, b'0', '2017-10-17 12:50:05', '2017-10-17 12:50:05'),
(68, 'Fernando Cavalheira', 12, b'1', '2017-10-17 12:50:06', '2017-10-17 12:50:06'),
(69, 'Bita', 12, b'0', '2017-10-17 12:50:06', '2017-10-17 12:50:06'),
(70, 'Nivaldo', 12, b'0', '2017-10-17 12:50:06', '2017-10-17 12:50:06'),
(71, '12 x 0 (1937)', 13, b'0', '2017-10-17 12:53:39', '2017-10-17 12:53:39'),
(72, '7 x 2 (1989)', 13, b'0', '2017-10-17 12:53:23', '2017-10-17 12:53:23'),
(73, '6 x 0 (1968)', 13, b'0', '2017-10-17 12:53:23', '2017-10-17 12:53:23'),
(74, '8 x 1 (1935)', 13, b'1', '2017-10-17 12:53:39', '2017-10-17 12:53:39'),
(75, '5 x 1 (1965)', 13, b'0', '2017-10-17 12:53:23', '2017-10-17 12:53:23'),
(76, 'Os alemães', 14, b'0', '2017-10-17 12:55:31', '2017-10-17 12:55:31'),
(77, 'Os portugueses', 14, b'0', '2017-10-17 12:55:31', '2017-10-17 12:55:31'),
(78, 'Os espanhóis', 14, b'0', '2017-10-17 12:55:31', '2017-10-17 12:55:31'),
(79, 'Os ingleses', 14, b'1', '2017-10-17 12:55:31', '2017-10-17 12:55:31'),
(80, 'Os franceses', 14, b'0', '2017-10-17 12:55:31', '2017-10-17 12:55:31'),
(86, 'Remo', 20, b'0', '2017-10-17 13:43:15', '2017-10-17 13:43:15'),
(87, 'Nacional-AM', 20, b'0', '2017-10-17 13:43:16', '2017-10-17 13:43:16'),
(88, 'Paysandu', 20, b'1', '2017-10-17 13:43:16', '2017-10-17 13:43:16'),
(89, 'Águia de Marabá', 20, b'0', '2017-10-17 13:43:16', '2017-10-17 13:43:16'),
(90, 'Rio Branco-AC', 20, b'0', '2017-10-17 13:43:16', '2017-10-17 13:43:16'),
(91, 'Fluminense', 21, b'1', '2017-10-17 13:52:05', '2017-10-17 13:52:05'),
(92, 'Corinthians', 21, b'0', '2017-10-17 13:52:05', '2017-10-17 13:52:05'),
(93, 'Palmeiras', 21, b'0', '2017-10-17 13:52:05', '2017-10-17 13:52:05'),
(94, 'Atlético Mineiro', 21, b'0', '2017-10-17 13:52:05', '2017-10-17 13:52:05'),
(95, 'Internacional', 21, b'0', '2017-10-17 13:52:05', '2017-10-17 13:52:05'),
(96, '2 gols', 22, b'0', '2017-10-18 08:47:50', '2017-10-18 08:47:50'),
(97, '5 gols', 22, b'0', '2017-10-18 08:47:22', '2017-10-18 08:47:22'),
(98, '7 gols', 22, b'0', '2017-10-18 08:47:22', '2017-10-18 08:47:22'),
(99, '10 gols', 22, b'0', '2017-10-18 08:47:22', '2017-10-18 08:47:22'),
(100, '11 gols', 22, b'1', '2017-10-18 08:47:50', '2017-10-18 08:47:50'),
(101, '01/12/2008 - Contra o flamengo.', 23, b'0', '2017-10-18 08:49:11', '2017-10-18 08:49:11'),
(102, '08/12/2013 - Contra o Atlético-pr.', 23, b'0', '2017-10-18 08:49:11', '2017-10-18 08:49:11'),
(103, '09/12/2009 - Contra o Sport.', 23, b'0', '2017-10-18 08:49:11', '2017-10-18 08:49:11'),
(104, '07/12/2008 - Contra o Vitória.', 23, b'1', '2017-10-18 08:49:11', '2017-10-18 08:49:11'),
(105, 'Nenhuma das alternativas.', 23, b'0', '2017-10-18 08:49:11', '2017-10-18 08:49:11'),
(106, 'Dimba-31 gols pelo Goiás em 2003.', 24, b'0', '2017-10-18 08:52:04', '2017-10-18 08:52:04'),
(107, 'Washington-34 gols pelo Atlético-PR em 2004.', 24, b'1', '2017-10-18 08:52:04', '2017-10-18 08:52:04'),
(108, 'Edmundo-29 gols pelo Vasco em 1997.', 24, b'0', '2017-10-18 08:52:04', '2017-10-18 08:52:04'),
(109, 'Jonas-23 gols pelo Grêmio em 2010.', 24, b'0', '2017-10-18 08:52:04', '2017-10-18 08:52:04'),
(110, 'Serginho Chulapa-22 gols pelo Santos em 1983.', 24, b'0', '2017-10-18 08:52:04', '2017-10-18 08:52:04'),
(111, 'Santos', 25, b'0', '2017-10-18 08:53:58', '2017-10-18 08:53:58'),
(112, 'Palmeiras', 25, b'1', '2017-10-18 08:53:58', '2017-10-18 08:53:58'),
(113, 'Vasco', 25, b'0', '2017-10-18 08:53:58', '2017-10-18 08:53:58'),
(114, 'Cruzeiro', 25, b'0', '2017-10-18 08:53:58', '2017-10-18 08:53:58'),
(115, '4 vezes', 26, b'0', '2017-10-18 08:55:12', '2017-10-18 08:55:12'),
(116, '5 vezes', 26, b'0', '2017-10-18 08:55:12', '2017-10-18 08:55:12'),
(117, '6 vezes', 26, b'1', '2017-10-18 08:55:12', '2017-10-18 08:55:12'),
(118, '7 vezes', 26, b'0', '2017-10-18 08:55:12', '2017-10-18 08:55:12'),
(119, '1991', 27, b'0', '2017-10-18 09:39:58', '2017-10-18 09:39:58'),
(120, '1999', 27, b'0', '2017-10-18 09:39:58', '2017-10-18 09:39:58'),
(121, '2003', 27, b'1', '2017-10-18 09:39:58', '2017-10-18 09:39:58'),
(122, '2008', 27, b'0', '2017-10-18 09:39:58', '2017-10-18 09:39:58'),
(123, '2011', 27, b'0', '2017-10-18 09:39:58', '2017-10-18 09:39:58'),
(125, '1958 e 1988', 29, b'0', '2017-10-18 11:59:23', '2017-10-18 11:59:23'),
(126, '1975 e 1982', 29, b'0', '2017-10-18 11:59:23', '2017-10-18 11:59:23'),
(127, '1959 e 1988', 29, b'1', '2017-10-18 11:59:23', '2017-10-18 11:59:23'),
(128, '1939 e 1985', 29, b'0', '2017-10-18 11:59:23', '2017-10-18 11:59:23'),
(129, '1955 e 2001', 29, b'0', '2017-10-18 11:59:23', '2017-10-18 11:59:23'),
(130, 'Carlito', 30, b'1', '2017-10-18 12:00:38', '2017-10-18 12:00:38'),
(131, 'Douglas', 30, b'0', '2017-10-18 12:00:38', '2017-10-18 12:00:38'),
(132, 'Hamilton', 30, b'0', '2017-10-18 12:00:38', '2017-10-18 12:00:38'),
(133, 'Osni', 30, b'0', '2017-10-18 12:00:38', '2017-10-18 12:00:38'),
(134, 'Nonato', 30, b'0', '2017-10-18 12:00:38', '2017-10-18 12:00:38'),
(135, 'Réver', 31, b'0', '2017-10-18 12:03:32', '2017-10-18 12:03:32'),
(136, 'Jô', 31, b'0', '2017-10-18 12:03:32', '2017-10-18 12:03:32'),
(137, 'Ronaldinho', 31, b'0', '2017-10-18 12:03:32', '2017-10-18 12:03:32'),
(138, 'Léo Silva', 31, b'1', '2017-10-18 12:03:32', '2017-10-18 12:03:32'),
(139, 'Marcos Rocha', 31, b'0', '2017-10-18 12:03:32', '2017-10-18 12:03:32'),
(140, '4x1', 32, b'0', '2017-10-18 12:06:50', '2017-10-18 12:06:50'),
(141, '3x0', 32, b'0', '2017-10-18 12:06:50', '2017-10-18 12:06:50'),
(142, '4x0', 32, b'1', '2017-10-18 12:06:50', '2017-10-18 12:06:50'),
(143, '5x1', 32, b'0', '2017-10-18 12:06:50', '2017-10-18 12:06:50'),
(144, 'Ézio', 33, b'0', '2017-10-18 12:10:29', '2017-10-18 12:10:29'),
(145, 'Waldo', 33, b'1', '2017-10-18 12:10:29', '2017-10-18 12:10:29'),
(146, 'Orlando Pingo de Ouro', 33, b'0', '2017-10-18 12:10:29', '2017-10-18 12:10:29'),
(147, 'Telê', 33, b'0', '2017-10-18 12:10:29', '2017-10-18 12:10:29'),
(148, 'Magno Alves', 33, b'0', '2017-10-18 12:10:29', '2017-10-18 12:10:29'),
(149, 'Libertad e Boca Juniors', 34, b'1', '2017-10-18 12:11:28', '2017-10-18 12:11:28'),
(150, 'LDU e Boca Juniors', 34, b'0', '2017-10-18 12:11:28', '2017-10-18 12:11:28'),
(151, 'LDU e Arsenal', 34, b'0', '2017-10-18 12:11:28', '2017-10-18 12:11:28'),
(152, 'Libertad e LDU', 34, b'0', '2017-10-18 12:11:28', '2017-10-18 12:11:28'),
(153, 'Boca Juniors e Arsenal', 34, b'0', '2017-10-18 12:11:28', '2017-10-18 12:11:28'),
(154, '2000', 35, b'0', '2017-10-18 12:28:20', '2017-10-18 12:28:20'),
(155, '1901', 35, b'0', '2017-10-18 12:28:20', '2017-10-18 12:28:20'),
(156, '1910', 35, b'0', '2017-10-18 12:28:20', '2017-10-18 12:28:20'),
(157, '1909', 35, b'1', '2017-10-18 12:28:20', '2017-10-18 12:28:20'),
(158, '1954', 35, b'0', '2017-10-18 12:28:20', '2017-10-18 12:28:20'),
(159, 'Porco', 36, b'0', '2017-10-18 12:29:07', '2017-10-18 12:29:07'),
(160, 'Verdão', 36, b'1', '2017-10-18 12:29:07', '2017-10-18 12:29:07'),
(161, 'Furacão', 36, b'0', '2017-10-18 12:29:07', '2017-10-18 12:29:07'),
(162, 'Preto e vermelho', 37, b'0', '2017-10-18 12:29:53', '2017-10-18 12:29:53'),
(163, 'Branco e Preto', 37, b'0', '2017-10-18 12:29:53', '2017-10-18 12:29:53'),
(164, 'Azul e Vermelho', 37, b'0', '2017-10-18 12:29:53', '2017-10-18 12:29:53'),
(165, 'Branco e Verde', 37, b'1', '2017-10-18 12:29:53', '2017-10-18 12:29:53'),
(166, 'Morumbi', 38, b'0', '2017-10-18 12:30:23', '2017-10-18 12:30:23'),
(167, 'Couto Pereira', 38, b'1', '2017-10-18 12:30:23', '2017-10-18 12:30:23'),
(168, 'Arena da baixada', 38, b'0', '2017-10-18 12:30:23', '2017-10-18 12:30:23'),
(169, '1985', 39, b'1', '2017-10-18 12:31:08', '2017-10-18 12:31:08'),
(170, '1999', 39, b'0', '2017-10-18 12:31:08', '2017-10-18 12:31:08'),
(171, '1998', 39, b'0', '2017-10-18 12:31:08', '2017-10-18 12:31:08'),
(172, '1978', 39, b'0', '2017-10-18 12:31:08', '2017-10-18 12:31:08'),
(173, 'Albeneir', 40, b'0', '2017-10-18 12:32:43', '2017-10-18 12:32:43'),
(174, 'Calico', 40, b'0', '2017-10-18 12:32:43', '2017-10-18 12:32:43'),
(175, 'China', 40, b'1', '2017-10-18 12:32:43', '2017-10-18 12:32:43'),
(176, 'Peçanha', 40, b'0', '2017-10-18 12:32:43', '2017-10-18 12:32:43'),
(177, 'Perivaldo', 40, b'0', '2017-10-18 12:32:43', '2017-10-18 12:32:43'),
(178, 'Libertadores', 41, b'0', '2017-10-18 12:33:36', '2017-10-18 12:33:36'),
(179, 'Sul-americana', 41, b'0', '2017-10-18 12:33:36', '2017-10-18 12:33:36'),
(180, 'Copa América', 41, b'0', '2017-10-18 12:33:36', '2017-10-18 12:33:36'),
(181, 'Torneio sul-minas', 41, b'0', '2017-10-18 12:33:36', '2017-10-18 12:33:36'),
(182, 'Mercosul', 41, b'1', '2017-10-18 12:33:36', '2017-10-18 12:33:36'),
(183, 'Avaí', 42, b'0', '2017-10-18 12:34:40', '2017-10-18 12:34:40'),
(184, 'Joinville', 42, b'0', '2017-10-18 12:34:40', '2017-10-18 12:34:40'),
(185, 'Atlético - SC', 42, b'1', '2017-10-18 12:34:40', '2017-10-18 12:34:40'),
(186, 'Lages - SC', 42, b'0', '2017-10-18 12:34:40', '2017-10-18 12:34:40'),
(187, 'Xanxere - SC', 42, b'0', '2017-10-18 12:34:41', '2017-10-18 12:34:41'),
(188, 'Preto', 43, b'0', '2017-10-18 12:35:59', '2017-10-18 12:35:59'),
(189, 'Preto e Branco', 43, b'1', '2017-10-18 12:35:59', '2017-10-18 12:35:59'),
(190, 'Branco e Verde', 43, b'0', '2017-10-18 12:35:59', '2017-10-18 12:35:59'),
(191, 'Preto Branco e Verde', 43, b'0', '2017-10-18 12:35:59', '2017-10-18 12:35:59'),
(192, 'Preto e verde', 43, b'0', '2017-10-18 12:35:59', '2017-10-18 12:35:59'),
(193, 'Fortaleza Futebol Clube', 44, b'0', '2017-10-18 12:37:40', '2017-10-18 12:37:40'),
(194, 'Fortaleza Futebol de Regatas', 44, b'0', '2017-10-18 12:37:40', '2017-10-18 12:37:40'),
(195, 'Fortaleza Esporte Clube', 44, b'1', '2017-10-18 12:37:40', '2017-10-18 12:37:40'),
(196, 'Sporting Fortaleza Clube', 44, b'0', '2017-10-18 12:37:40', '2017-10-18 12:37:40'),
(197, 'Fortaleza Clube de Regatas', 44, b'0', '2017-10-18 12:37:40', '2017-10-18 12:37:40'),
(198, 'Vovozetes', 45, b'0', '2017-10-18 12:39:18', '2017-10-18 12:39:18'),
(199, 'Leoninas', 45, b'1', '2017-10-18 12:39:18', '2017-10-18 12:39:18'),
(200, 'Baleias', 45, b'0', '2017-10-18 12:39:18', '2017-10-18 12:39:18'),
(201, 'Sereias da Barra', 45, b'0', '2017-10-18 12:39:18', '2017-10-18 12:39:18'),
(202, 'Tricoles do Pici', 45, b'0', '2017-10-18 12:39:18', '2017-10-18 12:39:18'),
(203, 'Ceará', 46, b'1', '2017-10-18 12:40:46', '2017-10-18 12:40:46'),
(204, 'Santa Cruz', 46, b'0', '2017-10-18 12:40:46', '2017-10-18 12:40:46'),
(205, 'Ferroviário', 46, b'0', '2017-10-18 12:40:46', '2017-10-18 12:40:46'),
(206, 'Horizonte', 46, b'0', '2017-10-18 12:40:46', '2017-10-18 12:40:46'),
(207, 'Santa Cruz', 46, b'0', '2017-10-18 12:40:46', '2017-10-18 12:40:46'),
(208, 'Real Madrid, Milan e Liverpool', 47, b'0', '2017-10-18 12:48:39', '2017-10-18 12:48:39'),
(209, 'Barcelona, Inter de Milão e Liverpool', 47, b'0', '2017-10-18 12:48:39', '2017-10-18 12:48:39'),
(210, 'Real Madrid, Milan e Manchester United', 47, b'0', '2017-10-18 12:48:39', '2017-10-18 12:48:39'),
(211, 'Real Madrid, Inter de Milão e Manchester United', 47, b'0', '2017-10-18 12:48:39', '2017-10-18 12:48:39'),
(212, 'Barcelona, Milan e Liverpool', 47, b'1', '2017-10-18 12:48:39', '2017-10-18 12:48:39'),
(213, 'Thiago Neves', 48, b'0', '2017-10-18 12:50:35', '2017-10-18 12:50:35'),
(214, 'Thiago Silva', 48, b'0', '2017-10-18 12:50:35', '2017-10-18 12:50:35'),
(215, 'Washington', 48, b'1', '2017-10-18 12:50:35', '2017-10-18 12:50:35'),
(216, 'Dodô', 48, b'0', '2017-10-18 12:50:35', '2017-10-18 12:50:35'),
(217, 'Leandro Amaral', 48, b'0', '2017-10-18 12:50:35', '2017-10-18 12:50:35'),
(218, '25 de janeiro de 1930', 49, b'0', '2017-10-18 12:52:02', '2017-10-18 12:52:02'),
(219, '16 de dezembro de 1935', 49, b'0', '2017-10-18 12:52:02', '2017-10-18 12:52:02'),
(220, '25 de janeiro de 1935', 49, b'0', '2017-10-18 12:52:02', '2017-10-18 12:52:02'),
(221, '16 de dezembro de 1930', 49, b'1', '2017-10-18 12:52:02', '2017-10-18 12:52:02'),
(222, '25 de dezembro de 1935', 49, b'0', '2017-10-18 12:52:02', '2017-10-18 12:52:02'),
(223, '1', 50, b'0', '2017-10-18 13:01:32', '2017-10-18 13:01:32'),
(224, '2', 50, b'1', '2017-10-18 13:01:32', '2017-10-18 13:01:32'),
(225, '3', 50, b'0', '2017-10-18 13:01:32', '2017-10-18 13:01:32'),
(226, '4', 50, b'0', '2017-10-18 13:01:32', '2017-10-18 13:01:32'),
(227, 'Nunca foi campeão', 50, b'0', '2017-10-18 13:01:32', '2017-10-18 13:01:32'),
(228, '1281', 51, b'0', '2017-10-18 13:02:39', '2017-10-18 13:02:39'),
(229, '1282', 51, b'0', '2017-10-18 13:02:39', '2017-10-18 13:02:39'),
(230, '1283', 51, b'0', '2017-10-18 13:02:39', '2017-10-18 13:02:39'),
(231, '1091', 51, b'1', '2017-10-18 13:02:39', '2017-10-18 13:02:39'),
(232, '1092', 51, b'0', '2017-10-18 13:02:39', '2017-10-18 13:02:39'),
(233, 'Pepe', 52, b'0', '2017-10-18 13:03:38', '2017-10-18 13:03:38'),
(234, 'Serginho Chulapa', 52, b'0', '2017-10-18 13:03:38', '2017-10-18 13:03:38'),
(235, 'Toninho Guerreiro', 52, b'0', '2017-10-18 13:03:38', '2017-10-18 13:03:38'),
(236, 'Giovanni', 52, b'1', '2017-10-18 13:03:39', '2017-10-18 13:03:39'),
(237, 'Tite', 52, b'0', '2017-10-18 13:03:39', '2017-10-18 13:03:39'),
(238, '1910', 53, b'0', '2017-10-18 13:04:56', '2017-10-18 13:04:56'),
(239, '1914', 53, b'0', '2017-10-18 13:04:56', '2017-10-18 13:04:56'),
(240, '1912', 53, b'1', '2017-10-18 13:04:56', '2017-10-18 13:04:56'),
(241, '1916', 53, b'0', '2017-10-18 13:04:56', '2017-10-18 13:04:56'),
(242, '1918', 53, b'0', '2017-10-18 13:04:57', '2017-10-18 13:04:57'),
(243, 'Inter', 54, b'0', '2017-10-18 13:10:51', '2017-10-18 13:10:51'),
(244, 'Hamburgo', 54, b'0', '2017-10-18 13:10:51', '2017-10-18 13:10:51'),
(245, 'Ajax', 54, b'0', '2017-10-18 13:10:51', '2017-10-18 13:10:51'),
(246, 'Real Madrid', 54, b'0', '2017-10-18 13:10:51', '2017-10-18 13:10:51'),
(247, 'Barcelona', 54, b'1', '2017-10-18 13:10:51', '2017-10-18 13:10:51'),
(248, 'Azul, branca e rosa', 55, b'0', '2017-10-18 13:11:57', '2017-10-18 13:11:57'),
(249, 'Preta, verde e dourado', 55, b'0', '2017-10-18 13:11:57', '2017-10-18 13:11:57'),
(250, 'Cinza, verde e azul', 55, b'0', '2017-10-18 13:11:57', '2017-10-18 13:11:57'),
(251, 'Azul, preta e branca', 55, b'1', '2017-10-18 13:11:57', '2017-10-18 13:11:57'),
(252, 'Amarelo, verde e azul', 55, b'0', '2017-10-18 13:11:57', '2017-10-18 13:11:57'),
(253, 'Danrlei', 56, b'0', '2017-10-18 13:12:56', '2017-10-18 13:12:56'),
(254, 'Victor', 56, b'0', '2017-10-18 13:12:56', '2017-10-18 13:12:56'),
(255, 'Mazaropi', 56, b'1', '2017-10-18 13:12:56', '2017-10-18 13:12:56'),
(256, 'Stein', 56, b'0', '2017-10-18 13:12:56', '2017-10-18 13:12:56'),
(257, 'Taffarel', 56, b'0', '2017-10-18 13:12:56', '2017-10-18 13:12:56'),
(258, '1903', 57, b'0', '2017-10-18 14:43:44', '2017-10-18 14:43:44'),
(259, '1904', 57, b'0', '2017-10-18 14:43:44', '2017-10-18 14:43:44'),
(260, '1908', 57, b'0', '2017-10-18 14:43:44', '2017-10-18 14:43:44'),
(261, '1909', 57, b'1', '2017-10-18 14:43:44', '2017-10-18 14:43:44'),
(262, 'Sul-Americana', 58, b'0', '2017-10-18 14:44:43', '2017-10-18 14:44:43'),
(263, 'Mundial de Clubes da FIFA', 58, b'1', '2017-10-18 14:45:19', '2017-10-18 14:45:19'),
(264, 'Libertadores da América', 58, b'0', '2017-10-18 14:45:19', '2017-10-18 14:45:19'),
(265, 'Copa Suruga Bank', 58, b'0', '2017-10-18 14:44:43', '2017-10-18 14:44:43'),
(266, 'Beira-Rio', 59, b'0', '2017-10-18 14:46:33', '2017-10-18 14:46:33'),
(267, 'Beira-Mar', 59, b'0', '2017-10-18 14:46:33', '2017-10-18 14:46:33'),
(268, 'Estádio dos Eucaliptos', 59, b'1', '2017-10-18 14:46:33', '2017-10-18 14:46:33'),
(269, 'Estádio das Laranjeiras', 59, b'0', '2017-10-18 14:46:33', '2017-10-18 14:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_description` varchar(200) DEFAULT NULL,
  `difficulty` int(11) NOT NULL,
  `enable` bit(1) NOT NULL,
  `DescriptionRigthAwnser` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `description`, `user_id`, `created_at`, `updated_at`, `short_description`, `difficulty`, `enable`, `DescriptionRigthAwnser`) VALUES
(3, 'Quantas vezes o Gremio foi campeao da Copa do Brasil?', 1, '2017-10-20 11:21:57', '2017-10-20 11:21:57', 'Gremio Copa do Brasil', 1, b'1', 'O Gremio se sagrou campeao em 1989(Contra o Sport Recife), 1994(Contra o Ceara), 1997(Contra o Flamengo),2001(Contra o Corinthinas) e 2016( Contra o Atletico Mineiro)'),
(4, 'Qual e o time Brasileiro que mais ganhou o Campeonato Brasileiro?', 1, '2017-10-20 11:24:47', '2017-10-20 11:24:47', 'Camp Brasileiro Maior Campeao', 2, b'0', 'Ao todo sao 9 titulos.\nCampeao nos anos: 1960, 1967,1967,1969, 1972, 1973, 1993, 1994 e 2016.'),
(5, 'Quantas vezes o time do Cruzeiro faturou o campeonato Brasileiro?', 1, '2017-10-20 11:25:51', '2017-10-20 11:25:51', 'Cruzeiro Camp Brasileiro', 2, b'1', 'Campeao nos anos: 1966, 2003, 2013 e 2014.'),
(7, 'Quem foi o autor do milésimo gol do Corinthians em campeonatos Brasileiros?', 1, '2017-10-20 11:28:09', '2017-10-20 11:28:09', 'Corinthians Camp Brasileiro', 5, b'1', 'Gil marcou o milésimo gol do Corinthians em campeonatos Brasileiros.'),
(8, 'No ano de 2002 o Corinthians sagrou-se campeão da Copa do Brasil, qual time disputou a final contra o Timão?', 1, '2017-10-20 11:28:44', '2017-10-20 11:28:44', 'Corinthians Copa Do Brasil', 3, b'1', 'Foi contra o \"azarão\" Brasiliense'),
(9, 'Qual foi o país-sede da Copa do Mundo de 1994?', 1, '2017-10-20 11:29:28', '2017-10-20 11:29:28', 'Qual foi o país-sede da Copa do Mundo de 1994?', 1, b'1', 'O país-sede da Copa do Mundo de 1994 foi Estados Unidos.'),
(10, 'Quem foi os artilheiros da Copa do Mundo de 1994?', 1, '2017-10-20 11:29:47', '2017-10-20 11:29:47', 'Quem foi os artilheiros da Copa do Mundo de 1994?', 4, b'1', 'Os artilheiros foram Stoichkov e Salenko com 6 gols'),
(11, 'Quem era o capitão da Seleção Brasileira na Copa de 1994?', 1, '2017-10-20 11:30:52', '2017-10-20 11:30:52', 'Quem era o capitão da Seleção Brasileira na Copa de 1994?', 1, b'1', 'O capitão da Seleção Brasileira se chama Dunga'),
(12, 'Quem foi o maior goleador do Náutico em Campeonatos Pernambucanos?', 1, '2017-10-20 11:31:32', '2017-10-20 11:31:32', 'Nautico Pernambucano', 4, b'1', 'Ele foi artilheiro com 139 gols.'),
(13, 'Qual a maior goleada aplicada pelo Náutico ao seu rival rubro-negro?', 1, '2017-10-20 11:32:44', '2017-10-20 11:32:44', 'Qual a maior goleada aplicada pelo Náutico ao seu rival rubro-negro?', 5, b'1', '8 x 1 (1935)'),
(14, 'Que povo europeu foi responsável por fundar o Clube Náutico Capibaribe?', 1, '2017-10-20 11:34:31', '2017-10-20 11:34:31', 'Que povo europeu foi responsável por fundar o Clube Náutico Capibaribe?', 3, b'1', ''),
(20, 'Qual foi o único clube da região Norte a representar o Brasil na Libertadores?', 1, '2017-10-20 11:34:21', '2017-10-20 11:34:21', 'Qual foi o único clube da região Norte a representar o Brasil na Libertadores?', 4, b'1', 'O Paysandu foi o único clube do Norte a ir para Libertadores, em 2003.'),
(21, 'Qual desses times nunca foi campeão da Libertadores?', 1, '2017-10-20 11:35:10', '2017-10-20 11:35:10', 'Qual desses times nunca foi campeão da Libertadores?', 2, b'1', 'O Fluminense nunca ganhou a taça Libertadores, chegando perto em 2008 quando perdeu nos pênaltis para o LDU.'),
(22, 'Com quantos gols, o atacante Edmilson foi o artilheiro do campeonato carioca de 2014?', 1, '2017-10-20 11:35:52', '2017-10-20 11:35:52', 'Com quantos gols, o atacante Edmilson foi o artilheiro do campeonato carioca de 2014?', 5, b'1', 'Edmilson foi o artilheiro isolado do campeonato carioca de 2014, marcando 11 gols.'),
(23, 'Qual foi a data do primeiro rebaixamento do Vasco?', 1, '2017-10-20 11:36:37', '2017-10-20 11:36:37', 'Qual foi a data do primeiro rebaixamento do Vasco?', 3, b'1', 'O Vasco foi rebaixado pela primeira vez no dia 07/12/2008 contra o Vitória em São Januário com o placar de 2x0 para o time baiano, o Vasco foi rebaixado para a série b do campeonato brasileiro de 2009.'),
(24, 'Qual o artilheiro com mais gols em uma única temporada do Campeonato Brasileiro? (Até 2016)', 1, '2017-10-20 12:54:05', '2017-10-20 12:54:05', 'Qual o artilheiro com mais gols em uma única temporada do Campeonato Brasileiro? (Até 2016)', 1, b'1', 'Washington tem o posto de maior artilheiro em uma temporada do campeonato, ele fez 34 gols pelo Atlético-PR em 2004, ano em que o clube foi Vice-campeão.'),
(25, 'Qual foi o primeiro time a ser bicampeão do Brasileirão (a partir de 1971)?', 1, '2017-10-20 12:54:56', '2017-10-20 12:54:56', 'Qual foi o primeiro time a ser bicampeão do Brasileirão (a partir de 1971)?', 4, b'1', 'Em 1972-1973'),
(26, 'Quantas vezes o Santos foi vice campeão Brasileiro?', 1, '2017-10-18 08:55:12', '2017-10-18 08:55:12', 'Quantas vezes o Santos foi vice campeão Brasileiro?', 3, b'1', NULL),
(27, 'A partir de que ano o Brasileirão começou a ser disputado por pontos corridos?', 1, '2017-10-20 12:56:24', '2017-10-20 12:56:24', 'A partir de que ano o Brasileirão começou a ser disputado por pontos corridos?', 3, b'1', 'A partir de 2003 o Brasileirão começou a ser disputado por pontos corridos, campeonato esse que o Cruzeiro faturou!'),
(29, 'Em quais anos o Bahia foi campeão nacional ?', 1, '2017-10-18 11:59:46', '2017-10-18 11:59:46', 'Em quais anos o Bahia foi campeão nacional ?', 3, b'1', NULL),
(30, 'Quem é o maior artilheiro da história do Bahia?', 1, '2017-10-18 12:00:38', '2017-10-18 12:00:38', 'Quem é o maior artilheiro da história do Bahia?', 4, b'1', NULL),
(31, 'Na libertadores 2013 o Tijuana teve um pênalti aos 46 minutos do 2º tempo. Quem fez o pênalti?', 1, '2017-10-18 12:12:39', '2017-10-18 12:12:39', '(Atletico MG) Na libertadores 2013 o Tijuana teve um pênalti aos 46 minutos do 2º tempo. Quem fez o pênalti?', 4, b'1', NULL),
(32, 'Em 2002 o Galo goleou o Palmeiras por qual placar?', 1, '2017-10-18 12:08:20', '2017-10-18 12:08:20', 'Atletico.Em 2002 o Galo goleou o Palmeiras por qual placar?', 4, b'1', NULL),
(33, 'Quem é o maior artilheiro da história do Flu?', 1, '2017-10-20 12:58:25', '2017-10-20 12:58:25', 'Fluminense. Quem é o maior artilheiro da história do Flu?', 4, b'1', 'Waldo fez 314 gols em 403 jogos com a camisa do Fluminense.'),
(34, 'Que times eliminaram o Fluminense das Libertadores de 2011 e 2012, respectivamente?', 1, '2017-10-20 13:00:22', '2017-10-20 13:00:22', 'Que times eliminaram o Fluminense das Libertadores de 2011 e 2012, respectivamente?', 3, b'1', 'Libertad eliminou o Fluminense das Oitavas-de-Final da Libertadores 2011 e o Boca Juniors eliminou o Tricolor nas Quartas-de-final da Libertadores 2012.'),
(35, 'Que ano o Coritiba Foi criado?', 1, '2017-10-18 12:28:20', '2017-10-18 12:28:20', 'Que ano o Coritiba Foi criado?', 4, b'1', NULL),
(36, 'Qual o apelido do Coritiba?', 1, '2017-10-18 12:29:07', '2017-10-18 12:29:07', 'Qual o apelido do Coritiba?', 2, b'1', NULL),
(37, 'Qual é a cor do uniforme do Coritiba?', 1, '2017-10-18 12:29:53', '2017-10-18 12:29:53', 'Qual é a cor do uniforme do Coritiba?', 1, b'1', NULL),
(38, 'Qual é o nome do estádio do Coritiba?', 1, '2017-10-18 12:30:23', '2017-10-18 12:30:23', 'Qual é o nome do estádio do Coritiba?', 2, b'1', NULL),
(39, 'Que ano o Coritiba foi Campeão Brasileiro ?', 1, '2017-10-20 13:04:33', '2017-10-20 13:04:33', 'Que ano o Coritiba foi Campeão Brasileiro ?', 4, b'1', 'Coritiba ganhou seu primeiro título brasileiro em 1985 e se tornou o primeiro time paranaense a ter essa conquista.'),
(40, 'Qual o foi o primeiro jogador com passagem no Figueirense a servir a seleção brasileira?', 1, '2017-10-20 13:10:45', '2017-10-20 13:10:45', 'Qual o foi o primeiro jogador com passagem no Figueirense a servir a seleção brasileira?', 5, b'1', 'O goleiro china foi o primeiro a ser convocado.'),
(41, 'Qual o titulo internacional que o Figueirense possui?', 1, '2017-10-18 12:33:36', '2017-10-18 12:33:36', 'Qual o titulo internacional que o Figueirense possui?', 3, b'1', NULL),
(42, 'O jogo de estreia no estádio Orlando Scarpelli foi contra quem?', 1, '2017-10-18 12:34:40', '2017-10-18 12:34:40', 'O jogo de estreia no estádio Orlando Scarpelli foi contra quem?', 4, b'1', NULL),
(43, 'Qual a(as) cor(es) tradicionais do Figueirense?', 1, '2017-10-20 13:12:14', '2017-10-20 13:12:14', 'Qual a(as) cor(es) tradicionais do Figueirense?', 2, b'1', 'Alvinegro.'),
(44, 'Qual é o nome todo do time Fortaleza?', 1, '2017-10-18 12:37:40', '2017-10-18 12:37:40', 'Qual é o nome todo do time Fortaleza?', 3, b'1', NULL),
(45, 'Como é o nome das lideres de torcida do Fortaleza?', 1, '2017-10-18 12:39:17', '2017-10-18 12:39:17', 'Como é o nome das lideres de torcida do Fortaleza?', 4, b'1', NULL),
(46, 'Quem é o maior rival do Fortaleza?', 1, '2017-10-18 12:40:46', '2017-10-18 12:40:46', 'Quem é o maior rival do Fortaleza?', 2, b'1', NULL),
(47, 'Quais foram os adversários do São Paulo nos Mundiais em que o São Paulo foi campeão?', 1, '2017-10-18 12:48:39', '2017-10-18 12:48:39', 'Quais foram os adversários do São Paulo nos Mundiais em que o São Paulo foi campeão?', 5, b'1', NULL),
(48, 'Quem fez o gol no último minuto que eliminou o São Paulo da Libertadores 2008?', 1, '2017-10-18 12:50:35', '2017-10-18 12:50:35', 'Quem fez o gol no último minuto que eliminou o São Paulo da Libertadores 2008?', 3, b'1', NULL),
(49, 'Em que dia, mês e ano o São Paulo foi refundado?', 1, '2017-10-18 12:52:02', '2017-10-18 12:52:02', 'Em que dia, mês e ano o São Paulo foi refundado?', 5, b'1', NULL),
(50, 'Quantas vezes o Santos foi campeão da libertadores da américa?', 1, '2017-10-20 13:14:11', '2017-10-20 13:14:11', 'Quantas vezes o Santos foi campeão da libertadores da américa?', 3, b'1', 'Foi campeão em 1962 e 1963'),
(51, 'Quantos gols Pelé, maior artilheiro da história do Santos FC,fez pelo clube praiano?', 1, '2017-10-20 13:15:18', '2017-10-20 13:15:18', 'Quantos gols Pelé, maior artilheiro da história do Santos FC,fez pelo clube praiano?', 4, b'1', 'Pelé fez 1091 gols pelo Santos FC, em toda sua hisória no clube.'),
(52, 'Quais desses artilheiros do Santos fez menos de cem gols pelo clube?', 1, '2017-10-20 13:15:49', '2017-10-20 13:15:49', 'Quais desses artilheiros do Santos fez menos de cem gols pelo clube?', 2, b'1', 'Giovanni, craque da década de 90, fez 69 gols pela camisa do peixe.'),
(53, 'Qual o ano de fundação do clube praiano Santos FC?', 1, '2017-10-20 13:14:51', '2017-10-20 13:14:51', 'Qual o ano de fundação do clube praiano Santos FC?', 1, b'1', 'O clube Santos FC foi fundado em 14 de abril de 1912.'),
(54, 'Sobre que time o grêmio ganhou o mundial?', 1, '2017-10-18 13:10:51', '2017-10-18 13:10:51', 'Sobre que time o grêmio ganhou o mundial?', 2, b'1', NULL),
(55, 'Quais são as cores cores da camisa do Grêmio?', 1, '2017-10-18 13:11:57', '2017-10-18 13:11:57', 'Quais são as cores cores da camisa do Grêmio?', 2, b'1', NULL),
(56, 'Qual o nome do goleiro do Grêmio na conquista do Mundial?', 1, '2017-10-18 13:12:55', '2017-10-18 13:12:55', 'Qual o nome do goleiro do Grêmio na conquista do Mundial?', 4, b'1', NULL),
(57, 'Em que ano o Inter foi fundado?', 1, '2017-10-20 13:17:04', '2017-10-20 13:17:04', 'Em que ano o Inter foi fundado?', 4, b'1', 'Em 1909 os Poppe convocaram um grupo de estudantes e comerciários de Porto Alegre para uma reunião, marcada para o dia 4 de abril de 1909, com o objetivo de fundar um novo clube de futebol.'),
(58, 'Que título importante para a história do Inter foi conquistado em 2006?', 1, '2017-10-20 13:17:25', '2017-10-20 13:17:25', 'Que título importante para a história do Inter foi conquistado em 2006?', 3, b'1', 'O ano de 2006 ficará marcado na memória de todos os colorados como aquele em que o Inter viveu a maior glória de sua quase centenária existência. Nesse ano o Internacional sagrou-se campeão do Mundial de Clubes da FIFA.'),
(59, 'Qual o nome do primeiro estádio do Inter?', 1, '2017-10-20 13:17:40', '2017-10-20 13:17:40', 'Qual o nome do primeiro estádio do Inter?', 4, b'1', 'O Estádio dos Eucaliptos foi a primeira casa colorada.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `login` varchar(400) NOT NULL,
  `password` varchar(4000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `login`, `password`, `created_at`, `updated_at`) VALUES
(1, 'diego', 'diego@diego.com', 'diego', '$2y$10$tOJtTS1aT.LuqRuEKPRk2OLY8kCZP53cv18QCSuabUBLTQ2OkKdoi', '2017-10-09 15:45:25', '2017-10-09 15:45:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awnser`
--
ALTER TABLE `awnser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awnser`
--
ALTER TABLE `awnser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `awnser`
--
ALTER TABLE `awnser`
  ADD CONSTRAINT `awnser_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
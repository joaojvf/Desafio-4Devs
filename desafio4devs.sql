-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 31-Jul-2018 às 14:04
-- Versão do servidor: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desafio4devs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `data_avaliacao` date NOT NULL,
  `nps` double DEFAULT NULL,
  PRIMARY KEY (`data_avaliacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`data_avaliacao`, `nps`) VALUES
('2018-10-01', 100),
('2018-09-01', 50),
('2018-08-02', 100),
('2018-07-01', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(150) NOT NULL,
  `nome_responsavel` varchar(150) NOT NULL,
  `categoria` varchar(10) DEFAULT NULL,
  `data_registro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome_cliente`, `nome_responsavel`, `categoria`, `data_registro`) VALUES
(60, 'Testador 10', 'Cicrano', 'Promotor', '2018-07-31'),
(59, 'Testador 9', 'Fulano', 'Neutro', '2018-07-31'),
(56, 'Testador 6', 'Fulano', 'Neutro', '2018-07-31'),
(57, 'Testador 7', 'Ciclano', 'Neutro', '2018-07-31'),
(58, 'Testador 8', 'Cicrano', 'Promotor', '2018-07-31'),
(55, 'Testador 5', 'Ciclano', 'Neutro', '2018-07-31'),
(54, 'Testador 4', 'Fulano', 'Promotor', '2018-07-31'),
(53, 'Testador 3', 'Cicrano', 'Promotor', '2018-07-31'),
(52, 'Testador 2', 'Fulano', 'Detrator', '2018-07-31'),
(51, 'Testador 1', 'Ciclano', 'Detrator', '2018-07-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_avaliacoes`
--

DROP TABLE IF EXISTS `clientes_avaliacoes`;
CREATE TABLE IF NOT EXISTS `clientes_avaliacoes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data_avaliacao` date NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `resp_num` int(2) DEFAULT NULL,
  `resp_text` text,
  PRIMARY KEY (`id`),
  KEY `nome_cliente` (`nome_cliente`) USING BTREE,
  KEY `fk_avaliacoes` (`data_avaliacao`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes_avaliacoes`
--

INSERT INTO `clientes_avaliacoes` (`id`, `data_avaliacao`, `nome_cliente`, `resp_num`, `resp_text`) VALUES
(125, '2018-10-01', 'Testador 10', 10, ''),
(124, '2018-09-01', 'Testador 8', 9, 'teste'),
(123, '2018-09-01', 'Testador 9', 8, 'teste'),
(122, '2018-08-02', 'Testador 4', 10, ''),
(121, '2018-08-02', 'Testador 3', 10, 'Teste'),
(120, '2018-07-01', 'Testador 2', 0, 'teste'),
(119, '2018-07-01', 'Testador 1', 0, 'teste');

--
-- Acionadores `clientes_avaliacoes`
--
DROP TRIGGER IF EXISTS `insereCategoria`;
DELIMITER $$
CREATE TRIGGER `insereCategoria` BEFORE UPDATE ON `clientes_avaliacoes` FOR EACH ROW BEGIN
        IF NEW.resp_num <=6 THEN
            UPDATE clientes AS c SET categoria = 'Detrator' WHERE c.nome_cliente = NEW.nome_cliente;
        ELSEIF NEW.resp_num <=8 THEN
            UPDATE clientes AS c SET categoria = 'Neutro' WHERE c.nome_cliente = NEW.nome_cliente;    
        ELSEIF NEW.resp_num <=10 THEN
            UPDATE clientes AS c SET categoria = 'Promotor' WHERE c.nome_cliente = NEW.nome_cliente;
        ELSE 
            UPDATE clientes SET categoria = 'Erro' WHERE nome_cliente = NEW.nome_cliente;
        END IF;

    END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

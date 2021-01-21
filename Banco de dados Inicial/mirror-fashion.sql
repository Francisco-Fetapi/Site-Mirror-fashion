-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Ago-2020 às 01:05
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mirror-fashion`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `data_de_nascimento` date NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `genero` text COLLATE utf8_unicode_ci NOT NULL,
  `palavra_passe` text COLLATE utf8_unicode_ci NOT NULL,
  `num_tel` int(11) NOT NULL,
  `foto` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `data_de_nascimento`, `email`, `genero`, `palavra_passe`, `num_tel`, `foto`) VALUES
(7, 'JÃºlia Fuayenda', '1984-11-13', 'email@gmail.com', 'F', 'Jesus', 934567891, 'foto7.jpg'),
(8, 'Francisco Fetapi', '2020-08-16', 'email@gmail.com', 'M', 'Jesus', 912349848, 'user.jpg'),
(9, 'Alicia Cambambi', '1991-11-13', 'email@gmail.com', 'M', 'Jesus', 912345678, 'user.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `conteudo` text COLLATE utf8_unicode_ci NOT NULL,
  `data_hora` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_reacoes`
--

CREATE TABLE `comentarios_reacoes` (
  `id` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desejos`
--

CREATE TABLE `desejos` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preco` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `data` date DEFAULT NULL,
  `vendas` int(11) DEFAULT NULL,
  `foto` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `descricao`, `data`, `vendas`, `foto`) VALUES
(1, 'Fuzzy Cardigan', '4800,00 KZ', 'Esse &eacute; o melhor casaco de Cardig&atilde; que voc&ecirc; j&aacute; viu. Excelente material italiano com estampa desenhada pelos artes&atilde;os da comunidade de Krotor nas ilhas gregas. Compre j&aacute; e receba hoje mesmo pela nossa entrega ajato.', '2013-09-01', 3, 'foto1'),
(2, 'Camiseta Ecko Caveira Bad to The Bone', '2750,00 KZ', 'Camiseta confort&aacute;vel ideal para eventos casuais!<br><br>\n\nCamiseta manga curta, gola redonda. Possui estampa de Caveira e descritivo frontal e lisa nas costas.', '2013-10-01', 0, 'foto2'),
(3, 'Cardigan Thelure Basic', '3200,00 KZ', 'Cardigan em &oacute;timo caimento. Ideal fazer sobreposi&ccedil;&atilde;o quando a temperatura cair um pouco.\n<br><br>\nMedidas Modelo:<br>\nAltura: 1,76cm<br>\nPeso: 55Kg<br>\nCintura: 69 cm<br>\nBusto: 89 cm<br>\nQuadril: 93 cm<br>\nCal&ccedil;ado: 38<br>\nManequim: 38<br>\nModelo veste: P.', '2013-09-29', 0, 'foto3'),
(4, 'Casaco Winter', '2300,00 KZ', 'Jaqueta confeccionada em couro ecol&oacute;gico, em tintura vermelha, abotoamento na gola. Fechamento em z&iacute;per. Ideal para compor looks contempor&acirc;neos casuais.\n', '2013-09-20', 0, 'foto4'),
(5, 'Sport Top', '3400,00 KZ', 'Camisa em Algod&atilde;o estampada ideal para uma mulher cl&aacute;ssica, manga longa com abotoamento, fechamento frontal em bot&otilde;es, bolso frontal, barras arredondadas.', '2013-09-27', 0, 'foto5'),
(6, 'Top Basic', '1950,00 KZ', 'Blusa multicolorida com decote em V, a manga longa faz dela uma pe&ccedil;a perfeita para uma ocasi&atilde;o de trabalho. As combina&ccedil;&otilde;es de cores d&atilde;o um toque atual a pe&ccedil;a.', '2013-09-01', 0, 'foto6'),
(7, 'Camiseta Gwol', '3800,00 KZ', 'Camiseta em modelagem reta, mangas curtas e decote canoa. Possui bordados de fios metalizados nos ombros com tem&aacute;tica militar e bras&atilde;o bordado estilizado com canutilhos, mi&ccedil;angas e strass na altura do busto. Ideal para compor looks estilosos e despojados.', '2013-09-01', 0, 'foto7'),
(8, 'Camiseta Tiup', '5100,00 KZ', 'Regata b&aacute;sica em seda. Combina&ccedil;&atilde;o perfeita com cal&ccedil;as jeans, shorts ou saias. Modelagem evas&ecirc;. Combine com acess&oacute;rios, como colares e pulseiras.', '2014-09-03', 0, 'foto8'),
(9, 'Camisa Squares', '4200,00 KZ', 'Camisa em tecido mega confort&aacute;vel. Gola fechada esporte, abotoamento frontal com tira de vista. Mangas compridas com abotoamento duplo. Estampa tropical. Caimento perfeito com cal&ccedil;as jeans.', '2013-09-18', 0, 'foto9'),
(10, 'Top in Slub', '2200,00 KZ', 'Esse &eacute; o melhor casaco de Cardig&atilde; que voc&ecirc; j&aacute; viu. Excelente material italiano com estampa desenhada pelos artes&atilde;os da comunidade de Krotor nas ilhas gregas. Compre j&aacute; e receba hoje mesmo pela nossa entrega ajato.', '2014-09-03', 0, 'foto10'),
(11, 'Shorts Lez a Lez Towel', '6500,00 KZ', 'Sport deluxe &eacute; a tend&ecirc;ncia quent&iacute;ssima deste ver&atilde;o, as roupas s&atilde;o feitas de tecidos inteligentes, formas articuladas e fits inspirados nos esportes de rua. Shorts com modelagem boxer, tecido com toque atoalhado e cord&otilde;es decorativos com ponteiras de metal. Ideal para compor looks charmosos e aut&ecirc;nticos.\n', '2013-09-02', 0, 'foto11'),
(12, 'Camisa Richards Sam', '3700,00 KZ', 'Em 1974 a Richards lan&ccedil;ou no Brasil um novo conceito de roupas, associado a um estilo de vida original, informal e requintado. Qualidade, conforto e exclusividade s&atilde;o compromissos t&atilde;o importantes, a ponto de lan&ccedil;ar doze cole&ccedil;&otilde;es por ano com edi&ccedil;&otilde;es limitadas. Camisa de seda lisa, mangas longas c/ abotoamento nos punhos e ajuste por bot&atilde;o e fechamento frontal por bot&otilde;es. Perfeito para compor looks charmosos e aut&ecirc;nticos.', '2013-10-07', 0, 'foto12'),
(13, 'Blusa Lez a Lez Feel Sft I', '4150,00 KZ', 'Blusa manga longa, decote redondo com fechamento em spikes dando estilo Rocker a pe&ccedil;a! Possui detalhe de bolso lateral na altura do peito e manga 3/4.', '2013-09-03', 0, 'foto13'),
(14, 'Camisa Lez a Lez Tec Ray Sixty III', '5400,00 KZ', 'Camisa manga longa, gola esporte com fechamento aboto&aacute;vel em spikes. Possui costas com recortes modelagem nadador e barra mullet.', '2013-09-04', 0, 'foto14'),
(15, 'Vestido Thelure Alu', '7200,00 KZ', 'Aspecto rom&acirc;ntico, al&ccedil;as finas duplas e mangas com babados que caem nos ombros. Possui bot&otilde;es forrados na parte frontal, el&aacute;stico drapeado na altura do quadril. De perfeito caimento, ideal para usar em passeios informais.', '2014-09-11', 0, 'foto15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data` date NOT NULL,
  `cor` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tamanho` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarios_reacoes`
--
ALTER TABLE `comentarios_reacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desejos`
--
ALTER TABLE `desejos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comentarios_reacoes`
--
ALTER TABLE `comentarios_reacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `desejos`
--
ALTER TABLE `desejos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

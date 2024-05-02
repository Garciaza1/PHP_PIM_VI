-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/05/2024 às 16:01
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
-- Banco de dados: `pim_vi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `CPF` varchar(60) NOT NULL,
  `RG` varchar(60) NOT NULL,
  `telefone` varchar(60) NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `CPF`, `RG`, `telefone`, `endereco`, `created_at`) VALUES
(1, 'juca', 'juca@gmail.com', '11111111111', '1111111111', '1145678990', 'Rua Georgina Bocchiglieri', '2024-04-27 16:17:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(70) NOT NULL,
  `cod` varchar(60) NOT NULL,
  `fabricante` varchar(60) NOT NULL,
  `categoria` varchar(60) NOT NULL,
  `quantidade` varchar(60) NOT NULL,
  `valor` varchar(60) NOT NULL,
  `plataforma` varchar(60) DEFAULT NULL,
  `garantia` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `cod`, `fabricante`, `categoria`, `quantidade`, `valor`, `plataforma`, `garantia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'metal gear', 'jogo', '7yh0454y7hu6h79w46h9', 'kojima', 'games', '1', '79', 'xbox-microsoft', '12', '2024-04-25 15:50:54', '2024-04-29 20:32:54', '0000-00-00 00:00:00'),
(2, 'modern warefare III', 'guerra', '93470945utqhtg8h5', 'DICE', 'Jogos', '1', '148.90', 'todas', '24', '2024-04-25 16:42:30', '2024-04-29 21:41:52', '0000-00-00 00:00:00'),
(8, 'metal gear', 'jogo', 'rtsq45y\\ew5yu6ew567', 'kojima', 'Jogos', '1', '45', 'xbox-microsoft', '24', '2024-04-25 16:59:58', NULL, '2024-04-27 12:12:32'),
(9, 'metal gear', 'jogo', 'rtsq45y\\ew5yu6ew56s', 'kojima', 'Games', '1', '78', 'xbox-microsoft', '12', '2024-04-27 12:56:54', NULL, '2024-04-27 13:05:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gustavo Garcia', 'gustavogarcia56336@gmail.com', '12345678', 'Normal', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `cod_prod` varchar(120) NOT NULL,
  `valor` double NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `categoria` varchar(60) NOT NULL,
  `quantidade` int(60) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `sts_pay` varchar(60) DEFAULT NULL,
  `sts_sell` varchar(60) DEFAULT NULL,
  `mtd_pay` varchar(60) NOT NULL,
  `CEP` int(60) NOT NULL,
  `CPF` varchar(255) NOT NULL,
  `num_residencia` int(11) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id`, `cod_prod`, `valor`, `id_produto`, `id_vendedor`, `id_cliente`, `categoria`, `quantidade`, `endereco`, `created_at`, `sts_pay`, `sts_sell`, `mtd_pay`, `CEP`, `CPF`, `num_residencia`, `updated_at`, `deleted_at`) VALUES
(1, '7yh0454y7hu6h79w46h9', 79, 1, 1, 1, 'games', 1, 'Rua Georgina Lavrada, 99 São Paulo, SP', '2024-04-29 21:24:51', 'Confirmado', 'Confirmado', 'Boleto', 4835, '11111111111', 46, '', ''),
(2, '93470945utqhtg8h5', 148.9, 2, 1, 1, 'Jogos', 1, 'Rua Georgina Bocchiglieri', '2024-04-29 21:28:06', 'Confirmado', 'Confirmado', 'Credito', 4835, '11111111111', 12, '', ''),
(3, '93470945utqhtg8h5', 148.9, 2, 1, 1, 'Jogos', 0, 'Rua Georgina Bocchiglieri', '2024-04-29 21:41:52', 'Confirmado', 'Confirmado', 'Debito', 4835, '11111111111', 34, '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

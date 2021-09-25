-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Set-2021 às 06:56
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `foco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(75) NOT NULL,
  `login` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cancelamentos`
--

CREATE TABLE `cancelamentos` (
  `cancelamento_id` int(75) NOT NULL,
  `cancelamento_reserva_id` int(75) NOT NULL,
  `cancelamento_cliente_id` int(75) NOT NULL,
  `cancelamento_motivo` varchar(2500) NOT NULL,
  `cancelamento_status` set('aguardando','aprovado','reprovado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cliente_nome` varchar(100) NOT NULL,
  `cliente_cpf` varchar(20) NOT NULL,
  `cliente_email` varchar(150) NOT NULL,
  `cliente_senha` varchar(255) NOT NULL,
  `cliente_telefone` varchar(85) NOT NULL,
  `cliente_status` set('ativo','inativo') NOT NULL,
  `cliente_creditos` decimal(10,2) DEFAULT NULL,
  `cliente_debitos` decimal(10,2) DEFAULT NULL,
  `cliente_email_verificado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_cartao`
--

CREATE TABLE `cliente_cartao` (
  `cartao_id` int(75) NOT NULL,
  `cartao_cliente` varchar(150) NOT NULL,
  `cartao_titular` varchar(90) NOT NULL,
  `cartao_bandeira` varchar(70) NOT NULL,
  `cartao_numero` varchar(70) NOT NULL,
  `cartao_validade` varchar(70) NOT NULL,
  `cartao_cvv` varchar(70) NOT NULL,
  `cartao_endereco` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `nome_hotel` varchar(80) NOT NULL,
  `moeda_padrao` varchar(75) NOT NULL,
  `request` set('interno','externo') NOT NULL,
  `tipo_consulta` set('fileget','curl') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `nome_hotel`, `moeda_padrao`, `request`, `tipo_consulta`) VALUES
(1, 'Foco Multi-Midia Hotel', 'BRL', 'interno', 'fileget');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(75) NOT NULL,
  `reserva_id` int(75) NOT NULL,
  `reserva_cliente` varchar(75) NOT NULL,
  `reserva_tipo_quarto` varchar(75) NOT NULL,
  `reserva_criacao` datetime NOT NULL,
  `reserva_fonte` varchar(95) NOT NULL,
  `adultos` int(75) NOT NULL,
  `kids` int(75) NOT NULL,
  `chegada` date NOT NULL,
  `saida` date NOT NULL,
  `status` set('pendente','recuperada','confirmada','cancelada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `suites`
--

CREATE TABLE `suites` (
  `id` int(11) NOT NULL,
  `quarto_nome` varchar(150) NOT NULL,
  `valor_diaria` decimal(10,2) NOT NULL,
  `status` set('ativo','inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `suites`
--

INSERT INTO `suites` (`id`, `quarto_nome`, `valor_diaria`, `status`) VALUES
(202207306, 'Presidencial', '450.00', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cancelamentos`
--
ALTER TABLE `cancelamentos`
  ADD PRIMARY KEY (`cancelamento_id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente_cartao`
--
ALTER TABLE `cliente_cartao`
  ADD PRIMARY KEY (`cartao_id`);

--
-- Índices para tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `suites`
--
ALTER TABLE `suites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(75) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cancelamentos`
--
ALTER TABLE `cancelamentos`
  MODIFY `cancelamento_id` int(75) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente_cartao`
--
ALTER TABLE `cliente_cartao`
  MODIFY `cartao_id` int(75) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(75) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `suites`
--
ALTER TABLE `suites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

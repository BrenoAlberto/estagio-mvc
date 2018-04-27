-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Abr-2018 às 11:28
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testebreno`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `telefone_cliente` varchar(13) NOT NULL,
  `senha_cliente` varchar(255) NOT NULL,
  `data_nasc_cliente` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `senha_cliente`, `data_nasc_cliente`) VALUES
(5, 'Tes', 'Ola@Hotmail.com.br', '(44)4444-4444', '$2y$10$ScH050eXlrpyyDaeJPg9IeLrtop2UaEdn85o1g8xESR16Q83mazcW', '2013-07-13'),
(6, 'Teste', 'teste@teste.com', '(31)3131-3131', '$2y$10$1UfppPcuB1VtokfWwX/vCeFE9yoxG3YBk1TGhKNjCmvA.DxxMoK12', '1999-07-13'),
(7, 'Breno', 'brenolive@Hotmail.com.br', '(31)3131-3131', '$2y$10$cLV0Kl9au.2V8nRWb2DOp.U8.u8quWCRqpDh5nGMtcq6ZTQVdji5C', '1999-07-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

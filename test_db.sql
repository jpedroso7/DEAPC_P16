-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Maio-2024 às 11:56
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `test_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `description`, `image_path`) VALUES
(1, 'Grecia', 'Voo c/ 7 noites incluídas', '../assets/images/grecia2.jpg'),
(2, 'Brasil', 'Voo c/ 7 noites incluídas', '../assets/images/brasil2.jpg'),
(3, 'Paraguai', 'Voo c/ 7 noites incluídas', '../assets/images/paraguai.jpg'),
(4, 'Noruega', 'Voo c/ 7 noites incluídas', '../assets/images/noruega.jpg'),
(5, 'Marrocos', 'Voo c/ 7 noites incluídas', '../assets/images/marrocos.jpg'),
(6, 'Japao', 'Voo c/ 7 noites incluídas', '../assets/images/japao.jpg'),
(25, 'Açores', 'Voo c/ maço de tabaco e fino incluido', '../assets/images/Açores.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `user_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `viagem_id` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `reviews`
--

INSERT INTO `reviews` (`id`, `review_text`, `rating`, `user_name`, `user_id`, `viagem_id`, `destination_name`) VALUES
(1, '', 4, 'elias', 4, 82, 'Grecia'),
(2, '', 3, 'elias', 4, 82, 'Grecia'),
(3, 'DO CRLLLL', 5, 'daniel', 5, 84, 'Paraguai'),
(4, 'Neste artigo, veremos como colocar um texto em itálico usando CSS. Para colocar o texto em itálico em qualquer página da web, a propriedade CSS font-style é usada. Temos uma variedade de opções para defini-lo como texto em itálico.\r\n\r\nnormal: é o estilo de fonte normal. É igual a 400, o valor numérico padrão para negrito.\r\nnegrito : é o estilo de fonte em negrito. É o mesmo que 700.\r\nitálico: é o estilo de fonte cursivo.', 5, 'daniel', 5, 85, 'Açores'),
(5, '', 4, 'daniel', 5, 86, 'Japao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `role`) VALUES
(4, 'elias', '123', 'elias', 'user'),
(5, 'daniel', '123', 'Daniel', 'user'),
(7, 'admin', 'admin', 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagens`
--

CREATE TABLE `viagens` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `departure_airport` varchar(255) DEFAULT NULL,
  `num_people` int(11) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `destination_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `viagens`
--

INSERT INTO `viagens` (`id`, `destination_id`, `departure_airport`, `num_people`, `hotel`, `price`, `user_id`, `destination_name`, `user_name`) VALUES
(82, 1, 'lisbon', 1, '0', 800.00, 4, 'Grecia', 'elias'),
(83, 2, 'Lisbon', 1, '0', 800.00, 5, 'Brasil', 'daniel'),
(84, 3, 'Lisbon', 4, '0', 1450.00, 5, 'Paraguai', 'daniel'),
(85, 25, 'algarve', 1, '0', 900.00, 5, 'Açores', 'daniel'),
(86, 6, 'Lisbon', 1, '0', 800.00, 5, 'Japao', 'daniel');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `viagem_id` (`viagem_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `viagens`
--
ALTER TABLE `viagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_id` (`destination_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`viagem_id`) REFERENCES `viagens` (`id`);

--
-- Limitadores para a tabela `viagens`
--
ALTER TABLE `viagens`
  ADD CONSTRAINT `viagens_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`),
  ADD CONSTRAINT `viagens_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 12:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `only_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT 'img/product.png',
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `preco`, `imagem`, `descricao`) VALUES
(2, 'BMW M4 Miniatura', 'carros', 15.50, 'img/bmw.jpg', 'Escala 1:24, metal die-cast.'),
(3, 'iPhone 15 Pro', 'celulares', 999.00, 'img/iphone.jpg', 'Titânio e chip A17 Pro.'),
(4, 'Teclados gamer ', 'Gamer', 87.69, 'img/teclados.jpg', 'Teclados Gamer\r\nCom cores rgb, estaticas e teclas leves,\r\nwirreless e carregamento magnetico'),
(5, 'Cadeira gamer', 'Gamer', 1499.99, 'img/cadeira.jpg', 'Cadeira game confortavel  fofa  com cores lindas melhor para o seu setup'),
(6, 'Nike TN air', 'vestuario', 800.00, 'img/nike.jpg', 'Design iconico \r\n,   \r\n\"Triple Black\" com amortecimento\r\n\r\nAir visivel Estilo Urbano e maximo conforto'),
(7, 'Camiseta Tommy Hilfiger Marinho', 'vestuario', 559.99, 'img/camisola.jpg', 'Classico com capuz, bolsos canguru e logo bordado.\r\ncongorto e estilo casual premium'),
(8, 'Puma Suede XL', 'vestuario', 1600.00, 'img/puma.jpg', ' Versão robusta em camurça preta com cadarços largos. Atitude streetwear em um clássico'),
(9, 'Adidas Spezial Bege', 'vestuario', 1299.99, 'img/adidas.jpg', 'Visual retro em camurcas com solado de goma, sofisticacao e versatilidade em tons neutros.'),
(10, 'Jeans wide Lesg Escura', 'vestuario', 559.99, 'img/calcas-f.jpg', 'Cintura alta e corte amplo. Elegancia moderna que valoriza a silhueta.'),
(11, 'Camiseta TOMMY HILFIGER Marinho Preta ', 'vestuario', 350.00, 'img/camisa1.jpg', 'Peca essencial em algodao macio com estamap \"Est.1985\". Ajuste perfeito para o dia a dia.'),
(13, 'Jeans Mom ligth wash', 'vestuario', 650.00, 'img/calsa-jeans.jpg', 'Lavagem clara e cintura alta com toque rero. O classico dos anos 90 para looks despojados calcados.'),
(15, 'Baby look vermelha', 'vestuario', 250.00, 'img/camiseta.jpg', 'Modelagem femenina ajustada, gola redonda e cor vibrante. basica indispensavel.'),
(17, 'Camiseta nike sport black', 'vestuario', 160.00, 'img/nike3.jpg', 'Tecido leve e respiravel com tecnologia de secagem rapida. ideal para treinos e alta performace.');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `usuario`, `senha`, `criado_em`, `foto`) VALUES
(1, 'Edzyn', 'edmilsontivsane28@gmail.com', '', '$2y$10$TC6BEe4H1ud0ySRqY1WcBuiyEsCZv1yFCcnJDUS9Sjo6vUn2LapPa', '2026-01-30 10:26:00', 'default.png'),
(2, 'edmilson', 'edzyntivane@gmail.com', 'edzyntivane', '$2y$10$jg5wyUcY.bExAsHHnRj6GeRpchnYXbk5CRzx1CX94V3qN8B5CBjsm', '2026-01-30 18:09:19', 'default.png'),
(3, 'jose', 'jose@gmail.com', 'jose', '$2y$10$CCaQaTdpElu1qxeSAih0AO.PJS3zkgccap8GeTwVz6jCWdX22d31G', '2026-01-30 21:26:55', 'default.png'),
(4, 'admin', 'admin@gmail.com', 'admin', '$2y$10$7BMoKGDFjGfZz71r36iM4uREMeNMozMiDjseUiIXnk89Ci0gSBdK.', '2026-01-30 22:49:50', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

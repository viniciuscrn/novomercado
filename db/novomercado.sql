
--
-- Banco de dados: `novomercado`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(20) PRIMARY KEY AUTO_INCREMENT,
  `descricao` varchar(300) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantestoque` int(10) DEFAULT NULL
);

CREATE TABLE `usuario` (
  `idusuario` int(11) PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(300) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(45) NOT NULL,
  `privilegio` int(2) NOT NULL
);

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `usuario`, `email`, `senha`, `privilegio`) VALUES
(1, 'Vinicius Marques de Oliveira', 'vinicius', 'viniciuscrn@gmail.com', 'd9c030c9b6218410c498363f62e92e83a440e3cc', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `dia` date DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `usuario_idusuario` int(11),
  FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`)
);


CREATE TABLE `cliente` (
  `id` int(4) PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `data` varchar(20) DEFAULT NULL,
  `obs` text,
  `saldo` decimal(8,2) NOT NULL DEFAULT '0.00'
);
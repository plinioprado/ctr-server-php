-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: 179.188.16.163
-- Generation Time: Aug 28, 2017 at 10:18 PM
-- Server version: 5.6.35-81.0-log
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tws003`
--

-- --------------------------------------------------------

--
-- Table structure for table `Acc`
--

CREATE TABLE `Acc` (
  `Cod` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Name15` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Dc` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Obs` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Active` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Acc`
--

INSERT INTO `Acc` (`Cod`, `Name`, `Name15`, `Dc`, `Obs`, `Active`) VALUES
('1', 'Ativo', '', 'D', 'Db2', 'Sim'),
('11', 'Circulante', '', 'D', '', 'Sim'),
('111', 'Caixa e Bancos', '', 'D', '', 'Sim'),
('111001', 'Caixa ', 'Caixa', 'D', '', 'Sim'),
('111002', 'C.C.Bradesco', 'Bradesco', 'D', '', 'Sim'),
('111101', 'Caixa - Rc a compensar', '', 'D', '', 'Sim'),
('111102', 'C.C.Bradesco - Rc a compensar', '', 'D', '', 'Sim'),
('111201', 'Caixa - Pg a compensar', '', 'D', '', 'Sim'),
('111202', 'C.C.Bradesco - Pg a compensar', '', 'D', '', 'Sim'),
('112', 'Aplicações curto prazo', '', 'D', '', 'Sim'),
('112001', 'Aplicação Automática Bradesco', '', 'D', '', 'Sim'),
('113', 'Duplicatas a receber', '', 'D', '', 'Sim'),
('113001', 'Duplicatas a receber', '', 'D', '', 'Sim'),
('114', 'Adiantamentos pagos', '', 'D', '', 'Sim'),
('114001', 'Adiantamentos pagos', '', 'D', '', 'Sim'),
('115', 'Tributos  e encargos a recuperar', '', 'D', '', 'Sim'),
('115001', 'Pis a recuperar', '', 'D', '', 'Sim'),
('115002', 'Cofins a recuperar', '', 'D', '', 'Sim'),
('115003', 'IR a recuperar', '', 'D', '', 'Sim'),
('115004', 'CSLL a recuperar', '', 'D', '', 'Sim'),
('115005', 'ISS a recuperar', '', 'D', '', 'Sim'),
('116', 'Estoques', '', 'D', '', 'Sim'),
('116001', 'Estoque de produtos', '', 'D', '', 'Sim'),
('118', 'Outros títulos a receber', '', 'D', '', 'Sim'),
('118001', 'Outros títulos a receber', '', 'D', '', 'Sim'),
('119', 'Outros', '', 'D', '', 'Sim'),
('12', 'Realizável a longo prazo', '', 'D', '', 'Sim'),
('121', 'Aplicações de longo prazo', '', 'D', '', 'Sim'),
('121001', 'Aplicações vinculadas', '', 'D', '', 'Sim'),
('129', 'Outros', '', 'D', '', 'Sim'),
('129001', 'Outros', '', 'D', '', 'Sim'),
('13', 'Imobilizado', '', 'D', '', 'Sim'),
('131', 'Ativos Fixos', '', 'D', '', 'Sim'),
('131001', 'Máquinas e equipamentos', '', 'D', '', 'Sim'),
('131002', 'Móveis', '', 'D', '', 'Sim'),
('132', 'Despesas Pré operacionais', '', 'D', '', 'Sim'),
('132001', 'Despesas pré operacionais', '', 'D', '', 'Sim'),
('133', 'Depreciação acumulada', '', 'D', '', 'Sim'),
('133001', 'Depreciação acumulada', '', 'D', '', 'Sim'),
('2', 'Passivo', '', 'C', '', 'Sim'),
('21', 'Circulante', '', 'C', '', 'Sim'),
('211', 'Empréstimos curto prazo', '', 'C', '', 'Sim'),
('211001', 'Conta Garantida Bradesco', '', 'C', '', 'Sim'),
('211002', 'Empréstimo Capital de Giro Bradesco', '', 'C', '', 'Sim'),
('212', 'Fornecedores a pagar', '', 'C', '', 'Sim'),
('212001', 'Fornecedores a pagar', '', 'C', '', 'Sim'),
('213', 'Tributos a pagar', '', 'C', '', 'Sim'),
('213001', 'Pis a pagar', '', 'C', '', 'Sim'),
('213002', 'Cofins a pagar', '', 'C', '', 'Sim'),
('213003', 'IR a pagar', '', 'C', '', 'Sim'),
('213004', 'CSLL a pagar', '', 'C', '', 'Sim'),
('213005', 'ISS a pagar', '', 'C', '', 'Sim'),
('214', 'Pessoal e encargos a pagar', '', 'C', '', 'Sim'),
('214001', 'Pro labore a pagar', '', 'C', '', 'Sim'),
('214002', 'INSS a pagar', '', 'C', '', 'Sim'),
('215', 'Adiantamentos recebidos', '', 'C', '', 'Sim'),
('215001', 'Adiantamentos recebidos', '', 'C', '', 'Sim'),
('218', 'Outros títulos a pagar', '', 'C', '', 'Sim'),
('218001', 'Outros títulos a pagar', '', 'C', '', 'Sim'),
('219', 'Outros', '', 'C', '', 'Sim'),
('219100', 'Retenções s/Vendas', '', 'D', '', 'Sim'),
('219101', 'Irrf retido s/Vendas', '', 'D', '', 'Sim'),
('219102', 'Pis retido s/Vendas', '', 'D', '', 'Sim'),
('219103', 'Cofins retido s/Vendas', '', 'D', '', 'Sim'),
('219104', 'Csll retida s/Vendas', '', 'C', '', 'Sim'),
('219105', 'Iss retido s/Vendas', '', 'D', '', 'Sim'),
('219106', 'Inss retido s/Vendas', '', 'D', '', 'Sim'),
('22', 'Exigível a longo prazo', '', 'C', '', 'Sim'),
('221', 'Empréstimos e financ. de longo prazo', '', 'C', '', 'Sim'),
('221001', 'Mútuo Aldo Donaldo', '', 'C', '', 'Sim'),
('229', 'Outros', '', 'C', '', 'Sim'),
('229001', 'Outras obrigações de longo prazo', '', 'C', '', 'Sim'),
('23', 'Patrimônio Líquido', '', 'C', '', 'Sim'),
('231', 'Capital Social', '', 'C', '', 'Sim'),
('231001', 'Capital Social de José Silveira', '', 'C', '', 'Sim'),
('231002', 'Capital Social de Maria Silveira', '', 'C', '', 'Sim'),
('232', 'Reservas', '', 'C', '', 'Sim'),
('232001', 'Resultado de exercícios anteriores', '', 'C', '', 'Sim'),
('233', 'AFAC', '', 'C', '', 'Sim'),
('233001', 'AFAC', '', 'C', '', 'Sim'),
('3', 'Receitas', '', 'C', '', 'Sim'),
('31', 'Receita de Vendas', '', 'C', '', 'Sim'),
('311', 'Venda de serviços', '', 'C', '', 'Sim'),
('311001', 'Venda de serviços', '', 'C', '', 'Sim'),
('312', 'Venda de produtos', '', 'C', '', 'Sim'),
('313', 'Tributos sobre Vendas', '', 'C', '', 'Sim'),
('313001', 'Pis sobre vendas', '', 'C', '', 'Sim'),
('313002', 'Cofins sobre vendas', '', 'C', '', 'Sim'),
('313003', 'IR solbre vendas', '', 'C', '', 'Sim'),
('313004', 'CSLL sobre vendas', '', 'C', '', 'Sim'),
('313005', 'ISS sobre vendas', '', 'C', '', 'Sim'),
('314', 'Devoluções e abatimentos', '', 'C', '', 'Sim'),
('315', 'Comissões de venda', '', 'C', '', 'Sim'),
('32', 'Outras receitas operacionais', '', 'C', '', 'Sim'),
('321', 'Recuperaçõa de despesas', '', 'C', '', 'Sim'),
('322', 'Outras receitas operacionais', '', 'C', '', 'Sim'),
('33', 'Receitas Financeiras', '', 'C', '', 'Sim'),
('331', 'Juros e encargos s/contas a receber', '', 'C', '', 'Sim'),
('331001', 'Juros e encargos s/contas a receber', '', 'C', '', 'Sim'),
('332', 'Juros e encargos s/aplicações', '', 'C', '', 'Sim'),
('332001', 'Juros e encargos s/aplicações', '', 'C', '', 'Sim'),
('339', 'Outras receitas financeiras', '', 'C', '', 'Sim'),
('34', 'Receitas Não operacionais', '', 'C', '', 'Sim'),
('341', 'Outras', '', 'C', '', 'Sim'),
('4', 'Custos e despesas', '', 'C', '', 'Sim'),
('41', 'Custos', '', 'C', '', 'Sim'),
('411', 'Custo de serviços vendidos', '', 'C', '', 'Sim'),
('411001', 'Custo de serviços vendidos', '', 'C', '', 'Sim'),
('412', 'Custo de produtos vendidos', '', 'C', '', 'Sim'),
('42', 'Despesas operacionais', '', 'C', '', 'Sim'),
('421', 'Comerciais', '', 'C', '', 'Sim'),
('422', 'Pessoal', '', 'C', '', 'Sim'),
('422001', 'Pro-labore', '', 'C', '', 'Sim'),
('422002', 'Salários', '', 'C', '', 'Sim'),
('422003', 'Estagiários', '', 'C', '', 'Sim'),
('422101', 'INSS', '', 'C', '', 'Sim'),
('422102', 'Seguros', '', 'C', '', 'Sim'),
('423', 'Administrativas', '', 'C', '', 'Sim'),
('423001', 'Desp. Aluguel e condomínio', '', 'C', '', 'Sim'),
('423002', 'Desp. Agua e Luz', '', 'C', '', 'Sim'),
('423003', 'Desp. Telefonia e telecomunicações', '', 'C', '', 'Sim'),
('423004', 'Desp. Serviços de Limpeza', '', 'C', '', 'Sim'),
('423005', 'Desp. Serviços de Informática', '', 'C', '', 'Sim'),
('423006', 'Desp. Serviços de Advocacia', '', 'C', '', 'Sim'),
('423007', 'Desp. Serviços de Contabilidade', '', 'C', '', 'Sim'),
('423008', 'Desp. Serviços Bancários', '', 'C', '', 'Sim'),
('423009', 'Desp. Seguros', '', 'C', '', 'Sim'),
('423010', 'Desp. Materiais de escritório e limpeza', '', 'C', '', 'Sim'),
('423011', 'Desp. Alimentação e transporte', '', 'C', '', 'Sim'),
('423012', 'Desp. Fretes e malotes', '', 'C', '', 'Sim'),
('423013', 'Desp. Administrativas Outras', '', 'C', '', 'Sim'),
('424', 'Tributárias', '', 'C', '', 'Sim'),
('424001', 'Desp. Taxas e Impostos', '', 'C', '', 'Sim'),
('429', 'Outras Despesas operacionais', '', 'C', '', 'Sim'),
('43', 'Despesas Financeiras', '', 'C', '', 'Sim'),
('431', 'Juros e encargos s/contas a pagar', '', 'C', '', 'Sim'),
('431001', 'Juros de Mora sobre Tíutlo a pagar', '', 'C', '', 'Sim'),
('432', 'Juros e encargos s/financiamentos', '', 'C', '', 'Sim'),
('432001', 'Juros e encargos s/Financiamento', '', 'C', '', 'Sim'),
('44', 'Despesas não operacionais', '', 'C', '', 'Sim'),
('441', 'Depreciação e amortização', '', 'C', '', 'Sim'),
('442', 'Resultado na venda de imobilizado', '', 'C', '', 'Sim'),
('443', 'Outras despesas não operacionais', '', 'C', '', 'Sim'),
('45', 'Tributos sobre Lucro real', '', 'C', '', 'Sim'),
('451', 'IR sobre Lucro real', '', 'C', '', 'Sim'),
('452', 'CSLL sobre Lucro real', '', 'C', '', 'Sim'),
('453', 'Outros', '', 'C', '', 'Sim'),
('8', 'Ajustes', '', 'C', '', 'Sim'),
('81', 'Ajuste de Saldo inicial', '', 'C', '', 'Sim'),
('811', 'Ajuste de Saldo inicial', '', 'C', '', 'Sim'),
('811001', 'Ajuste de Saldo inicial', '', 'C', '', 'Sim');

-- --------------------------------------------------------

--
-- Table structure for table `AccBan`
--

CREATE TABLE `AccBan` (
  `Cod` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Ba` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Ag` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Cc` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AccBan`
--

INSERT INTO `AccBan` (`Cod`, `Ba`, `Ag`, `Cc`) VALUES
('111001', '000', '', ''),
('111002', '237', '0134', '999999');

-- --------------------------------------------------------

--
-- Table structure for table `Ban`
--

CREATE TABLE `Ban` (
  `Cod` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `CpCod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `CpName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndLog` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndCep` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndMun` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndUf` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Ban`
--

INSERT INTO `Ban` (`Cod`, `Name`, `Active`, `CpCod`, `CpName`, `CpEndLog`, `CpEndCep`, `CpEndMun`, `CpEndUf`) VALUES
('000', 'Carteira', 1, '', '', '', '', '', ''),
('001', 'Brasil', 0, '00000000000191', 'Banco do Brasil S.A.', 'Saun Quadra 5 Lote B.15.o andar', '70040250', 'Brasilia', 'DF'),
('007', 'Bndes', 0, '\'33657248000189', 'BNDES-Banco Nac.Des.Social', 'Av Republica do Chile, 100', '20031917', 'Rio de Janeiro', 'RJ'),
('033', 'Santander', 0, '90400888000142', 'Banco Santander (Brasil) S.A. ', 'Av.Pres.J.Kubitschek, 2041, E2255 Bl.A', '4543011', 'São Paulo', 'SP'),
('208', 'Pactual', 0, '303062941000145', 'Banco BTG Pactual S.A.', 'Praia De Botafogo, 501/ 50. a', '22250040', 'Rio de Janeiro', 'RJ'),
('237', 'Bradesco', 1, '60746948000112', 'Banco Bradesco S.A.', 'Cidade de Deus, s/n, Vila Yara', '6029900', 'Osasco', 'SP'),
('341', 'Itau', 1, '60872504000123', 'Itaú Unibanco S.A.', 'Pca Alfredo Egydio Souza Aranha, 100', '4344902', 'São Paulo', 'SP'),
('399', 'Hsbc', 1, '01701201000189', 'Hsbc Bank Brasil S.A.', 'Travessa Oliveira Bello, 34 - 4. Andar', '80020030', 'Curitiba', 'PR'),
('422', 'Safra', 0, '58160789000128', 'Banco Safra S.A. ', 'Av. Paulista, 2100', '01310930', 'São Paulo', 'SP'),
('745', 'Citibank', 0, '33479023000180', 'Banco Citibank S.A.', 'Av.Paulista, 2100, 2.o a', '1310930', 'São Paulo', 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `ban_acc`
--

CREATE TABLE `ban_acc` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `ba` varchar(3) NOT NULL,
  `ag` varchar(4) NOT NULL,
  `cc` varchar(15) NOT NULL,
  `contract` varchar(30) DEFAULT '',
  `signers` text NOT NULL,
  `limit_over` float NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ban_acc`
--

INSERT INTO `ban_acc` (`id`, `name`, `ba`, `ag`, `cc`, `contract`, `signers`, `limit_over`, `active`, `obs`) VALUES
(1, 'Caixa', '', '', '', '', '', 0, 1, ''),
(2, 'C.C.Bradesco', '237', '0134', '999999', '99999', 'joao@exemplo.com.br,maria@exemplo.com.br', 1000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `ban_mov`
--

CREATE TABLE `ban_mov` (
  `id` int(3) NOT NULL,
  `dt` date DEFAULT NULL,
  `seq` int(11) NOT NULL DEFAULT '0',
  `hist` varchar(60) DEFAULT '',
  `docto` varchar(7) DEFAULT '',
  `std` varchar(9) DEFAULT NULL,
  `cc` int(1) DEFAULT '1',
  `val` double DEFAULT '0',
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ban_mov`
--

INSERT INTO `ban_mov` (`id`, `dt`, `seq`, `hist`, `docto`, `std`, `cc`, `val`, `obs`) VALUES
(1, '2015-12-31', 1, 'Saldo Anterior', '', 'BanMan', 2, 0, ''),
(2, '2016-01-01', 1, 'Ted-Transf Elet Dispon Dest Plinio Prado', '999999', 'BanFex', 2, 10000, ''),
(3, '2016-01-01', 2, 'Pagto Eletron  Cobranca Computadores Datadata Ldta', '999999', 'BanIax', 2, -7000, ''),
(4, '2016-01-01', 3, 'Transf Cc Para Cc Pj Moveis Uno Ltda', '999999', 'BanIax', 2, -5000, ''),
(5, '2016-01-01', 4, 'Pagto Eletron  Cobranca Suporte Perma', '999999', 'BanOpx.Da', 2, -5631, ''),
(6, '2016-01-01', 5, 'Doc/Ted Internet', '999999', 'BanOpx.Da', 2, -5, ''),
(7, '2016-01-02', 1, 'Operacao Capital Giro', '999999', 'BanFfx', 2, 10000, ''),
(8, '2016-01-02', 2, 'Conta De Telefone Internet --Telefonica/Sp', '999999', 'BanOpx.Da', 2, -150, ''),
(9, '2016-01-02', 3, 'Conta De Luz Internet --Eletropaulo Metrop.', '999999', 'BanOpx.Da', 2, -100, ''),
(10, '2016-01-02', 4, 'Aplicacoes Em Papeis', '999999', 'BanIfx', 2, -2113, ''),
(11, '2016-01-03', 1, 'Resgate Mercado Aberto', '999999', 'BanIfu', 2, 1751, ''),
(12, '2016-01-03', 2, 'Ted-Transf Elet Dispon Dest.Cliente Alfa', '999999', 'BanOrx', 2, 1877, ''),
(13, '2016-01-04', 1, 'Cheque Compensado', '999999', 'BanOpx.Da', 2, -1200, ''),
(14, '2016-01-06', 1, 'Liquidacao De Cobranca', '999999', 'BanOrx', 2, 3000, ''),
(15, '2016-01-06', 2, 'Tarifa Registro Cobranca', '999999', 'BanOpx.Da', 2, -2, ''),
(16, '2016-01-07', 1, 'Dep Identificado Cheque 0000061452868000117', '999999', 'BanOrx', 2, 1200, ''),
(17, '2016-01-08', 1, 'Devol.Cheque Depositado* Chq.S/Fundos 1A.Apres.', '999999', 'BanOru', 2, -1200, ''),
(18, '2016-01-09', 1, 'Dep Identificado Cheque 0000061452868000118', '999999', 'BanOrx', 2, 1200, ''),
(19, '2016-01-15', 1, 'Operacao Capital Giro Contr 999999999 Parc 001/012', '999999', 'BanFfu', 2, -450, ''),
(20, '2016-01-31', 1, 'Pagto Eletron  Cobranca Graficas Superprint', '999999', 'BanOpx.Cg', 2, -500, ''),
(21, '2016-02-01', 1, 'Tarifa Bancaria Cesta Pj 3', '999999', 'BanOpx.Da', 2, -30, ''),
(22, '2016-02-01', 2, 'Encargos Limite De Cred', '999999', 'BanFfu', 2, -22, ''),
(23, '2016-02-01', 3, 'Encargos Limite De Cred Encargo - 07,46%', '999999', 'BanFfu', 2, -135, ''),
(24, '2016-02-01', 4, 'Ted-Transf Elet Dispon Dest Plinio Prado', '999999', 'BanOpx.Da', 2, -1100, ''),
(25, '2016-02-01', 5, 'Ted Devolvida*', '999999', 'BanOpx.Da', 2, 1100, ''),
(26, '2016-02-01', 6, 'Ted-Transf Elet Dispon Dest Plinio Prado', '999999', 'BanOpx.Da', 2, -1100, ''),
(27, '2016-02-01', 7, 'Doc/Ted Internet', '999999', 'BanOpx.Da', 2, -5, ''),
(28, '2016-02-01', 8, 'Doc/Ted Internet', '999999', 'BanOpx.Da', 2, -5, ''),
(29, '2016-02-01', 9, 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', 2, -39, ''),
(30, '2016-02-01', 10, 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', 2, -180, ''),
(31, '2016-02-01', 11, 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', 2, -90, ''),
(32, '2016-02-01', 12, 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', 2, -60, ''),
(33, '2016-02-01', 13, 'Pagto Eletronico Tributointernet --P.M Sao Paulo/Sp ', '999999', 'BanOpx.Rt', 2, -300, ''),
(34, '2016-02-01', 14, 'Pagto Eletronico Tributo Internet - Pess Gps 2100 ', '999999', 'BanOpx.Da', 2, -220, ''),
(35, '2016-01-20', 1, 'Recebimento em caixa não identificado', 'RC1', 'BanOrx', 1, 120, '');

-- --------------------------------------------------------

--
-- Table structure for table `ban_std`
--

CREATE TABLE `ban_std` (
  `cod` varchar(9) NOT NULL DEFAULT '',
  `name` varchar(30) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ban_std`
--

INSERT INTO `ban_std` (`cod`, `name`, `active`, `obs`) VALUES
('BanFdx', 'Distribuição resultado', 1, ''),
('BanFex', 'Aporte de capital', 1, ''),
('BanFfu', 'Repagamento captação', 1, ''),
('BanFfx', 'Captação financeira', 1, ''),
('BanIau', 'Rec.Invest.imobilizado', 1, ''),
('BanIax', 'Pag.Invest.imoblizado', 1, ''),
('BanIfu', 'Resgate aplicação', 1, ''),
('BanIfx', 'Aplicação financeira', 1, ''),
('BanMan', 'Ajuste Saldo', 1, ''),
('BanOni', 'Não identificado', 1, ''),
('BanOpu', 'Estorno Pag.Operacional', 1, ''),
('BanOpx', 'Pag.Operacional', 1, ''),
('BanOpx.Cg', 'Pag.Custos gerais', 1, ''),
('BanOpx.Cm', 'Pag.Custos material', 1, 'Inativo nesta versão'),
('BanOpx.Da', 'Pag.Desp.Administrativas', 1, ''),
('BanOpx.Dc', 'Pag.Desp.Comerciais', 1, ''),
('BanOpx.Dp', 'Pag.Desp.Pessoal', 1, ''),
('BanOpx.Dt', 'Pag.Desp.Tributárias', 1, ''),
('BanOpx.Rt', 'Pag.Tributos s/Venda', 1, ''),
('BanOru', 'Estorno Rec.Operacional', 1, ''),
('BanOrx', 'Rec.Operacional', 1, ''),
('RecAdd', 'Juros Rec.', 1, ''),
('RecBan', 'Recebimento', 1, ''),
('RecRei', 'Reembolso.Pag.', 1, ''),
('RecSub', 'Abatimento', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `CompanyCod` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CompanyName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `CompanyFullName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `AccBanMax` int(50) NOT NULL,
  `DtMin` date NOT NULL,
  `DtMax` date NOT NULL,
  `TraStdSub` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `CtrPag` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `CtrRec` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`CompanyCod`, `CompanyName`, `CompanyFullName`, `AccBanMax`, `DtMin`, `DtMax`, `TraStdSub`, `CtrPag`, `CtrRec`) VALUES
('11111111000111', 'ExemploServ', 'Exemplo Serviços Ltda', 2, '2016-01-01', '2016-12-31', 'Não', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Table structure for table `DocFin`
--

CREATE TABLE `DocFin` (
  `Cod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Dt` date NOT NULL,
  `Dc` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `Std` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Terms` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Acc` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CcAcc` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Val` double NOT NULL,
  `CpCod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `CpName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndLog` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndCep` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndMun` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CpEndUf` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `DocFin`
--

INSERT INTO `DocFin` (`Cod`, `Dt`, `Dc`, `Std`, `Terms`, `Acc`, `CcAcc`, `Val`, `CpCod`, `CpName`, `CpEndLog`, `CpEndCep`, `CpEndMun`, `CpEndUf`) VALUES
('CNE1', '2000-01-01', 'C', 'C.Social', 'Aporte', '231001', '111001', 5000, '11233455677', 'João Silveira', 'Alameda Lorena, 2222, ap.22, Jd.Paulista', '1424002', 'São Paulo', 'SP'),
('CNE2', '2000-01-01', 'C', 'C.Social', 'Aporte', '231002', '111001', 5000, '22344566788', 'Maria Silveira', 'Alameda Lorena, 2222, ap.22, Jd.Paulista', '1424002', 'São Paulo', 'SP'),
('CNF1.1/00', '2000-01-15', 'C', 'Mutuo', '24%a.a.', '221001', '111001', 10000, '555666777000122', 'Syspar Participações', 'Av.Paulista 1345, cl.67', '01311200', 'São Paulo', 'SP'),
('CNF2.1', '2000-01-01', 'C', 'C.Garantida', '10%a.m.', '211001', '111002', 20000, '', '', '', '', '', ''),
('CNF2.2/00', '2000-01-01', 'C', 'CG.Bradesco', '6%a.m./pg. 3 parcelas mens.', '211002', '111002', 12000, '', '', '', '', '', ''),
('CNI2.1', '2000-01-01', 'D', 'Apl.Automática', '95%CDI', '112001', '111002', 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `DocFinRec`
--

CREATE TABLE `DocFinRec` (
  `Cod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Seq` int(11) NOT NULL,
  `DtDue` date DEFAULT NULL,
  `Val` double NOT NULL,
  `ValDue` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `DocFinRec`
--

INSERT INTO `DocFinRec` (`Cod`, `Seq`, `DtDue`, `Val`, `ValDue`) VALUES
('CNE1', 1, '2000-01-10', 5000, 5000),
('CNE2', 1, '2000-01-10', 5000, 5000),
('CNF2.1', 1, NULL, 0, 0),
('CNF2.2/00', 1, '2000-02-02', 4000, 4377.25),
('CNF2.2/00', 2, '2000-03-02', 4000, 4377.25),
('CNF2.2/00', 3, '2000-04-02', 4000, 4377.25),
('CNI2.1', 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DocIns`
--

CREATE TABLE `DocIns` (
  `Cod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `PartCod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Descr` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `PartName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PartEndLog` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `PartEndCep` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `PartEndMun` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PartEndUf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Tra` int(11) DEFAULT NULL,
  `Dt` date DEFAULT NULL,
  `Val` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `DocIns`
--

INSERT INTO `DocIns` (`Cod`, `PartCod`, `Descr`, `PartName`, `PartEndLog`, `PartEndCep`, `PartEndMun`, `PartEndUf`, `Tra`, `Dt`, `Val`) VALUES
('CNB2', '60746948000112', 'Conta corrente', 'Banco Bradesco S.A.', 'Cidade de Deus, s/nº, Vila Yara', '06029900', 'Osasco', 'SP', NULL, '2000-01-01', 0),
('CNS1', '11233455677', 'Pro labore', 'João Silveira', 'Alameda Lorena, 2222, ap.22, Jd.Paulista', '01424002', 'São Paulo', 'SP', NULL, '2000-01-01', 1100),
('CNS1', '33444555000166', 'Aluguel sede', 'Cavalcanti Imóveis Ltda.', 'Av.Brasil, 1123, Jd.Paulista', '01430001', 'São Paulo', 'SP', NULL, '2000-01-01', 0),
('CNS2241833220', '2558157000162', 'Telefonia dados', 'Telefônica Brasil S.A.', 'Av.Engenheiro Luiz Carlos Berrini, 1376', '04571936', 'São Paulo', 'SP', NULL, '2000-01-01', 0),
('CNS51621771', '61695227000193', 'Energia', 'Eletropaulo Metropolitana S.A.', 'Av.Dr.Marcos P.Ulhoa Rodrigues,939', '06460040', 'São Paulo', 'SP', NULL, '2000-01-01', 0),
('GPS1/00', '16727230000197', 'INSS', 'Inst.Nacional do Seguro Social', 'Setor de Autarq.Sul,  Q.02, Bl.O, 10.o a', '70070946', 'Brasilia', 'DF', NULL, '2000-01-01', 0),
('NFM22211', '72381189000110', 'Computador', 'Dell Computadores Brasil Ltda.', 'Av. Industrial Belgraf, 400, Medianeira', '04571936', 'Eldorado do Sul', 'RS', 5, NULL, NULL),
('NFS1', '11111111000111', 'Venda', 'Alfa Serviços Ltda.', 'Rual Alfa, 111', '01222000', 'São Paulo', 'SP', 29, NULL, NULL),
('NFS101010', '2345678000102', 'Cus.impressao', 'AphaGraphics Centro', 'Rua 24 de Maio, 10, Centro', '01210000', 'São Paulo', 'SP', 39, NULL, NULL),
('NFS2', '33333333000133', 'Venda', 'Gama Com.e Indústrial Ltda.', 'Rua Gama, 333', '03456000', 'São Paulo', 'SP', 38, NULL, NULL),
('NFS555333', '20020020000101', 'Suporte TI', 'Suporte Perma Ltda.', 'Rua Lindolfo Alves, 854', '05662000', 'São Paulo', 'SP', 6, NULL, NULL),
('RCP1/00', '2223344400012', 'Móveis', 'Moveis Uno Ltda.', 'Av. Eusébio Matoso, 1231', '05423080', 'São Paulo', 'SP', 9, NULL, NULL),
('RCR1/00', '22222222000122', 'Adi.Venda', 'Beta Comercial Ltda.', 'Rual Beta 112', '02222000', 'São Paulo', 'SP', 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `DocRec`
--

CREATE TABLE `DocRec` (
  `Cod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `DocIns` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PartCod` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `InstrStd` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InstrCod` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `DtDue` date DEFAULT NULL,
  `Obs` varchar(90) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `DocRec`
--

INSERT INTO `DocRec` (`Cod`, `DocIns`, `PartCod`, `InstrStd`, `InstrCod`, `DtDue`, `Obs`) VALUES
('CNB2.1', 'CNB2', '60746948000112', 'DEB', '', NULL, ''),
('CNS1.1', 'CNS1', '11233455677', 'BOL', '03399.02066 43100.000058 42732.001021 2 53900000030975', NULL, ''),
('CNS1.1', 'CNS1', '33444555000166', 'CHE', 'Portador retira', '2000-01-31', ''),
('CNS2241833220.1', 'CNS2241833220', '2558157000162', 'DEB', '84690.0000015 75591.0291102 00305.130940 3 021611602182', '2000-01-15', ''),
('CNS51621771.1', 'CNS51621771', '61695227000193', 'BOL', '83670.0000018 03550.0481003 06090.698711 4 000132940479', '2000-01-15', ''),
('DM1.1', 'NFS1', '', 'BOL', '23790.13408 96049.000001 04009.024003 7 67150000060000', '2000-01-05', ''),
('DM1.2', 'NFS1', '', 'BOL', '23790.13408 96049.000001 04009.0240047 67150000060000', '2000-02-02', ''),
('DM101010.1', 'NFS101010', '2345678000102', 'TRA', '341/0334/22333.1', '2000-01-31', ''),
('DM2.1', 'NFS2', '', 'BOL', '23790.13408 96049.000001 04009.0240048 67150000060000', '2000-01-05', ''),
('DM22211.1', 'NFM22211', '72381189000110', 'BOL', '23792.37007 60002.295461 10002.999802 8 67120000003000', '2000-01-05', ''),
('DM555333.1', 'NFS555333', '20020020000101', 'BOL', '34191.75009 59474.378839 91149.750001 1 67260000133748', '2000-01-31', ''),
('GPS1/00.1', 'GPS1/00', '16727230000197', 'BOL', '2003/012000/11111111000111', '2000-02-20', ''),
('RCP1/00.1', 'RCP1/00', '2223344400012', 'TRA', '033/1111/888888', '2000-01-02', ''),
('RCR1/00.1', 'RCR1/00', '', 'TRA', '237/0134/999999', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `imp`
--

CREATE TABLE `imp` (
  `1` int(11) NOT NULL,
  `2` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `3` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `4` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `5` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `6` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `7` double NOT NULL,
  `8` double NOT NULL,
  `9` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `imp`
--

INSERT INTO `imp` (`1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`) VALUES
(1, '01/01/01', 'Saldo Anterior', '999999', 'BanMan', '2', 0, 0, 0),
(2, '01/01/01', 'Ted-Transf Elet Dispon Dest Plinio Prado', '999999', 'BanFex', '2', 10000, 0, 10000),
(3, '01/01/01', 'Pagto Eletron  Cobranca Computadores Datadata Ldta', '999999', 'BanIax', '2', 0, -7000, 3000),
(4, '01/01/01', 'Transf Cc Para Cc Pj Moveis Uno Ltda', '999999', 'BanIax', '2', 0, -5000, -2000),
(5, '01/01/01', 'Pagto Eletron  Cobranca Suporte Perma', '999999', 'BanOpx.Da', '2', 0, -5631, -7631),
(6, '01/01/01', 'Doc/Ted Internet', '999999', 'BanOpx.Da', '2', 0, -5, -7636),
(7, '01/02/01', 'Operacao Capital Giro', '999999', 'BanFfx', '2', 10000, 0, 2364),
(8, '01/02/01', 'Conta De Telefone Internet --Telefonica/Sp', '999999', 'BanOpx.Da', '2', 0, -150, 2214),
(9, '01/02/01', 'Conta De Luz Internet --Eletropaulo Metrop.', '999999', 'BanOpx.Da', '2', 0, -100, 2114),
(10, '01/02/01', 'Aplicacoes Em Papeis', '999999', 'BanIfx', '2', 0, -2113, 1),
(11, '01/03/01', 'Resgate Mercado Aberto', '999999', 'BanIfu', '2', 1751, 0, 1752),
(12, '01/03/01', 'Ted-Transf Elet Dispon Dest.Cliente Alfa', '999999', 'BanOrx', '2', 1877, 0, 3629),
(13, '01/04/01', 'Cheque Compensado', '999999', 'BanOpx.Da', '2', 0, -1200, 2429),
(14, '01/06/01', 'Liquidacao De Cobranca', '999999', 'BanOrx', '2', 3000, 0, 5429),
(15, '01/06/01', 'Tarifa Registro Cobranca', '999999', 'BanOpx.Da', '2', 0, -2, 5427),
(16, '01/07/01', 'Dep Identificado Cheque 0000061452868000117', '999999', 'BanOrx', '2', 1200, 0, 5427),
(17, '01/08/01', 'Devol.Cheque Depositado* Chq.S/Fundos 1A.Apres.', '999999', 'BanOru', '2', 0, -1200, 5427),
(18, '01/09/01', 'Dep Identificado Cheque 0000061452868000118', '999999', 'BanOrx', '2', 1200, 0, 5427),
(19, '01/15/01', 'Operacao Capital Giro Contr 999999999 Parc 001/012', '999999', 'BanFfu', '2', 0, -450, 5427),
(20, '01/31/01', 'Pagto Eletron  Cobranca Graficas Superprint', '999999', 'BanOpx.Cg', '2', 0, -500, 5427),
(21, '02/01/01', 'Tarifa Bancaria Cesta Pj 3', '999999', 'BanOpx.Da', '2', 0, -30, 4447),
(22, '02/01/01', 'Encargos Limite De Cred', '999999', 'BanFfu', '2', 0, -22, 4424),
(23, '02/01/01', 'Encargos Limite De Cred Encargo - 07,46%', '999999', 'BanFfu', '2', 0, -135, 4289),
(24, '02/01/01', 'Ted-Transf Elet Dispon Dest Plinio Prado', '999999', 'BanOpx.Da', '2', 0, -1100, 3189),
(25, '02/01/01', 'Ted Devolvida*', '999999', 'BanOpx.Da', '2', 1100, 0, 4289),
(26, '02/01/01', 'Ted-Transf Elet Dispon Dest Plinio Prado', '999999', 'BanOpx.Da', '2', 0, -1100, 3189),
(27, '02/01/01', 'Doc/Ted Internet', '999999', 'BanOpx.Da', '2', 0, -5, 3184),
(28, '02/01/01', 'Doc/Ted Internet', '999999', 'BanOpx.Da', '2', 0, -5, 3179),
(29, '02/01/01', 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', '2', 0, -39, 3140),
(30, '02/01/01', 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', '2', 0, -180, 2960),
(31, '02/01/01', 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', '2', 0, -90, 2870),
(32, '02/01/01', 'Pagto Eletronico Tributo Internet --Darf', '999999', 'BanOpx.Rt', '2', 0, -60, 2810),
(33, '02/01/01', 'Pagto Eletronico Tributointernet --P.M Sao Paulo/Sp ', '999999', 'BanOpx.Rt', '2', 0, -300, 2510),
(34, '02/01/01', 'Pagto Eletronico Tributo Internet - Pess Gps 2100 ', '999999', 'BanOpx.Da', '2', 0, -220, 2290);

-- --------------------------------------------------------

--
-- Table structure for table `pay_doc`
--

CREATE TABLE `pay_doc` (
  `cod` varchar(30) NOT NULL,
  `cpcod` varchar(15) NOT NULL,
  `cpname` varchar(40) NOT NULL,
  `dt` date DEFAULT NULL,
  `val` double NOT NULL DEFAULT '0',
  `std` varchar(9) NOT NULL,
  `doctxt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_docseq`
--

CREATE TABLE `pay_docseq` (
  `doc` varchar(30) NOT NULL DEFAULT '',
  `seq` int(11) NOT NULL DEFAULT '1',
  `dtdue` date NOT NULL DEFAULT '0000-00-00',
  `val` double NOT NULL DEFAULT '0',
  `colstd` enum('','TR','BL','DB','CH','DN') NOT NULL DEFAULT '',
  `colinstr` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_mov`
--

CREATE TABLE `pay_mov` (
  `doc` varchar(30) NOT NULL,
  `reccod` varchar(30) NOT NULL,
  `seq` int(11) NOT NULL,
  `bandt` date DEFAULT NULL,
  `bancc` int(11) NOT NULL DEFAULT '1',
  `banseq` int(11) NOT NULL,
  `std` varchar(6) NOT NULL DEFAULT '',
  `recdt` date NOT NULL,
  `val` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rec_doc`
--

CREATE TABLE `rec_doc` (
  `cod` varchar(30) NOT NULL,
  `cpcod` varchar(30) NOT NULL,
  `cpname` varchar(40) NOT NULL,
  `dt` date DEFAULT NULL,
  `val` double NOT NULL DEFAULT '0',
  `std` varchar(9) NOT NULL DEFAULT 'BanOrx',
  `doctxt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rec_doc`
--

INSERT INTO `rec_doc` (`cod`, `cpcod`, `cpname`, `dt`, `val`, `std`, `doctxt`) VALUES
('NFS1', '111111111000111', 'Alfa Ltda.', '2016-01-05', 3000, 'BanOrx', '');

-- --------------------------------------------------------

--
-- Table structure for table `rec_docseq`
--

CREATE TABLE `rec_docseq` (
  `doc` varchar(15) NOT NULL DEFAULT '',
  `seq` int(11) NOT NULL DEFAULT '1',
  `dtdue` date DEFAULT '0000-00-00',
  `val` double NOT NULL DEFAULT '0',
  `colstd` enum('','TR','BL','DB','CH','DN') NOT NULL DEFAULT '',
  `colinstr` varchar(120) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rec_docseq`
--

INSERT INTO `rec_docseq` (`doc`, `seq`, `dtdue`, `val`, `colstd`, `colinstr`) VALUES
('NFS1', 1, '2016-01-05', 3000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rec_mov`
--

CREATE TABLE `rec_mov` (
  `doc` varchar(30) NOT NULL,
  `reccod` varchar(30) NOT NULL,
  `seq` int(11) NOT NULL,
  `bandt` date DEFAULT NULL,
  `bancc` int(11) NOT NULL DEFAULT '1',
  `banseq` int(11) NOT NULL,
  `std` varchar(6) NOT NULL DEFAULT '',
  `recdt` date NOT NULL,
  `val` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rec_mov`
--

INSERT INTO `rec_mov` (`doc`, `reccod`, `seq`, `bandt`, `bancc`, `banseq`, `std`, `recdt`, `val`) VALUES
('2016-01-06.2.1', 'DM1.1', 1, '2016-01-06', 2, 1, 'RecBan', '2016-01-05', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `Tra`
--

CREATE TABLE `Tra` (
  `Id` int(11) NOT NULL,
  `Dt` date NOT NULL,
  `Hist` varchar(52) COLLATE utf8_unicode_ci NOT NULL,
  `Std` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Doc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Obs` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Tra`
--

INSERT INTO `Tra` (`Id`, `Dt`, `Hist`, `Std`, `Doc`, `Obs`) VALUES
(1, '2000-01-01', 'Aporte de capital João Silveira', 'riex', 'CNE1.1', ''),
(2, '2000-01-01', 'Aporte de capital - Maria Silveira', 'riex', 'CNE2.1', ''),
(3, '2000-01-01', 'Ted-Transf Elet Jose Silveira', 'bfex', 'EXT2.01012000.1', ''),
(4, '2000-01-01', 'Cancelado', 'manx', '4', ''),
(5, '2000-01-01', 'Compra Imobilizado - Computadores Dell', 'piix', 'NFM22211.72381189000110', ''),
(6, '2000-01-01', 'Despesa pré operacional - Suporte Perma', 'piix', 'NFS555333.20020020000101', ''),
(7, '2000-01-01', 'Pg.Compra Imobilizado - Computadores Dell', 'plix', 'TRA2.01012000.1', ''),
(8, '2000-01-01', 'Pagto Eletron  Cobranca Computadores Dell Ltda', 'biax', 'EXT2.01012000.2', ''),
(9, '2000-01-01', 'Adiantamento a fornecedor Imob. - Moveis Uno', 'paax', 'RCP1/00.2223344400012', ''),
(10, '2000-01-01', 'Pg.Adiantamento a fornecedor Imob. - Moveis Uno', 'plix', 'BOL2.01012000.1', ''),
(11, '2000-01-01', 'Transf Cc Para Cc Pj Moveis Uno Ltda', 'biax', 'EXT2.01012000.3', ''),
(12, '2000-01-01', 'Pg.Suporte Perma', 'plix', 'TRA2.01012000.2', ''),
(13, '2000-01-01', 'Pagto Eletron Cobranca Suporte Perma', 'biax', 'EXT2.01012000.4', ''),
(14, '2000-01-01', 'Doc/Ted Internet', 'bopx', 'EXT2.01012000.5', ''),
(15, '2000-01-01', 'Pg.Despesa bancária', 'piox', 'CNB2', ''),
(16, '2000-01-02', 'Captação - CG Bradesco', 'bffx', 'EXT2.02012000.1', ''),
(17, '2000-01-02', 'Ted-Transf Elet Maria Silveira', 'bfex', 'EXT2.02012000.2', ''),
(18, '2000-01-02', 'Cancelado', 'manx', '18', ''),
(19, '2000-01-02', 'Despesa administrativa - Aluguel', 'piox', 'CNS1.33444555000166', ''),
(20, '2000-01-02', 'Despesa administrativa - Telefonia', 'piox', 'CNS2241833220.2558157000162', ''),
(21, '2000-01-02', 'Despesa administrativa - Eletropaulo', 'piox', 'CNS51621771.61695227000193', ''),
(22, '2000-01-02', 'Pg.Aluguel via cheque', 'plox', 'CHE2.000001', ''),
(23, '2000-01-02', 'Pg.Telefonica via boleto', 'plox', 'BOL2.02012000.1', ''),
(24, '2000-01-02', 'Pg.Eletropaulo via boleto', 'plox', 'BOL2.02012000.2', ''),
(25, '2000-01-02', 'Comp.Pagamento - Eletropaulo', 'bopx', 'EXT2.02012000.3', ''),
(26, '2000-01-02', 'Comp.Pagamento - Telefonica', 'bopx', 'EXT2.02012000.4', ''),
(27, '2000-01-02', 'Aplicacoes Em Papeis', 'bifx', 'EXT2.02012000.5', ''),
(28, '2000-01-03', 'Resgate Mercado Aberto', 'bifu', 'EXT2.03012000.1', ''),
(29, '2000-01-03', 'Faturamento de Venda - NF1 Alfa Ltda', 'risx', 'NFS1', ''),
(30, '2000-01-03', 'Doc/Ted Internet', 'borx', 'EXT2.03012000.2', ''),
(31, '2000-01-03', 'Rec.adiantamento - Beta Ltda', 'borx', 'AC2.03012000.1', ''),
(32, '2000-01-04', 'Cheque Compensado', 'bopx', 'EXT2.04012000.1', ''),
(33, '2000-01-06', 'Liquidacao De Cobranca', 'borx', 'EXT2.06012000.1', ''),
(34, '2000-01-15', 'Cancelado', 'manx', '34', ''),
(35, '2000-01-06', 'Rec.Cliente - Alfa Ltda com juros', 'rbox', 'AC1.06012000.1', ''),
(36, '2000-01-06', 'Tarifa Registro Cobranca', 'bopx', 'EXT2.06012000.2', ''),
(37, '2000-01-06', 'Pg.Tarifa bancária', 'plox', 'DEB2.01022000.2', ''),
(38, '2000-01-20', 'Faturamento de Venda - NF2 Gama Ltda', 'risx', 'NFS2', ''),
(39, '2000-01-31', 'Custo  - AphaGraphics Centro', 'piox', 'NFS101010.2345678000102', ''),
(40, '2000-01-31', 'Despesa pessoal - Pro Labore', 'piox', 'CNS1.11233455677', ''),
(41, '2000-01-31', 'Pg.Alphagraphics', 'plox', 'BOL2.31012000.1', ''),
(42, '2000-01-31', 'Juros aplicação automática Bradesco', 'biix', 'BOL2.31012000.1', ''),
(43, '2000-02-01', 'Pagto Eletron Cobranca Alphagraphics', 'bopx', 'EXT2.01022000.1', ''),
(44, '2000-02-01', 'Tarifa Bancaria Cesta Pj 3', 'bopx', 'EXT2.01022000.2', ''),
(45, '2000-02-01', 'Despesa de tarifa bancária', 'piox', 'CNB2', ''),
(46, '2000-02-01', 'Cancelado', 'manx', '46', ''),
(47, '2000-02-01', 'Encargos Limite De Cred', 'bffu', 'EXT2.01022000.3', ''),
(48, '2000-02-01', 'Cancelado', 'manx', '48', ''),
(49, '2000-02-01', 'Pg.Pro Labore', 'plox', 'TRA2.01022000.1', ''),
(50, '2000-02-01', 'Doc/Ted Internet', 'bopx', 'EXT2.01022000.4', ''),
(51, '2000-02-01', 'Ted Devolvida*', 'bopu', 'EXT2.01022000.5', ''),
(52, '2000-02-01', 'Estorno de Pagamento  - Pro Labore', 'plou', 'TRA2.01022000.1', ''),
(53, '2000-02-01', 'Pg.Pro Labore reprocessado', 'plox', 'TRA2.01022000.2', ''),
(54, '2000-02-01', 'Doc/Ted Internet', 'bopx', 'EXT2.01022000.6', ''),
(55, '2000-02-01', 'Doc/Ted Internet', 'bopx', 'EXT2.01022000.7', ''),
(56, '2000-02-01', 'Pg.Despesa bancária', 'plox', 'DEBCNB2.1', ''),
(57, '2000-02-01', 'Despesa ISS', 'piox', 'GRP3/00', ''),
(58, '2000-02-01', 'Pg.ISS', 'plox', 'BOL2.01022000.1', ''),
(59, '2000-02-01', 'Pagto Eletronico Tributointernet --P.M Sao Paulo/Sp ', 'bopx', 'EXT2.01022000.8', ''),
(60, '2000-02-02', 'Operacao Capital Giro Contr 999999999 Parc 001/006', 'bffu', 'EXT2.02022000.1', '');

-- --------------------------------------------------------

--
-- Table structure for table `TraSeq`
--

CREATE TABLE `TraSeq` (
  `Id` int(11) NOT NULL,
  `Seq` int(11) NOT NULL,
  `Dc` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `Acc` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Cac` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `Val` double NOT NULL,
  `Docto` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `TraSeq`
--

INSERT INTO `TraSeq` (`Id`, `Seq`, `Dc`, `Acc`, `Cac`, `Val`, `Docto`) VALUES
(1, 1, 'C', '231001', '1', 5000, 'CNE1.1'),
(1, 2, 'D', '111102', '1', 5000, 'AC2.01012000.1'),
(2, 1, 'C', '231002', '1', 5000, 'CNE2.1'),
(2, 2, 'D', '111102', '1', 5000, 'AC2.02012000.1'),
(3, 1, 'D', '111002', '1', 5000, '999999'),
(3, 2, 'C', '111102', '1', 5000, 'AC2.01012000.1'),
(4, 1, 'D', '000000', '1', 0, ''),
(4, 2, 'C', '000000', '1', 0, ''),
(5, 1, 'D', '131001', '1', 7000, 'NFM22211.72381189000110'),
(5, 2, 'C', '212001', '1', 7000, 'DM22211.1.72381189000110'),
(6, 1, 'D', '132001', '1', 6000, 'NFS555333.20020020000101'),
(6, 2, 'C', '219102', '1', 39, ''),
(6, 3, 'C', '219103', '1', 180, ''),
(6, 4, 'C', '219101', '1', 90, ''),
(6, 5, 'C', '219104', '1', 60, ''),
(6, 6, 'C', '212001', '1', 5631, 'DM555333.1.20020020000101'),
(7, 1, 'C', '111202', '1', 7000, 'TRA2.01012000.1'),
(7, 2, 'D', '212001', '1', 7000, 'DM22211.1.72381189000110'),
(8, 1, 'C', '111002', '1', 7000, '999999'),
(8, 2, 'D', '111202', '1', 7000, 'TR2.01011000.1'),
(9, 1, 'D', '114001', '1', 5000, 'RCP1/00.1.2223344400012'),
(9, 2, 'C', '218001', '1', 5000, 'RCP1/00.1.2223344400012'),
(10, 1, 'C', '111202', '1', 5000, 'BOL2.01012000.1'),
(10, 2, 'D', '218001', '1', 5000, 'RCP1/00.1.2223344400012'),
(10, 3, 'D', '423008', '1', 5, 'CNB2.60746948000112'),
(10, 4, 'C', '111202', '1', 5, 'CNB2.1.60746948000112'),
(11, 1, 'C', '111002', '1', 5000, '999999'),
(11, 2, 'D', '111202', '1', 5000, 'BOL2.01012000.1'),
(12, 1, 'C', '111202', '1', 5631, 'TRA2.01012000.2'),
(12, 2, 'D', '212001', '1', 5631, 'DM555333.1.20020020000101'),
(13, 1, 'C', '111002', '1', 5631, '999999'),
(13, 2, 'D', '111202', '1', 5631, 'TRA2.01012000.2'),
(14, 1, 'C', '111002', '1', 5, '999999'),
(14, 2, 'D', '111202', '1', 5, 'CNB2.1.60746948000112'),
(15, 1, 'C', '423008', '1', 5, 'CNB2.60746948000112'),
(15, 2, 'D', '111202', '1', 5, 'CNB2.1.60746948000112'),
(16, 1, 'D', '111002', '1', 12000, '999999'),
(16, 2, 'C', '211002', '1', 4000, 'CNF2.2/00.1'),
(16, 3, 'C', '211002', '1', 4000, 'CNF2.2/00.2'),
(16, 4, 'C', '211002', '1', 4000, 'CNF2.2/00.3'),
(17, 1, 'D', '111002', '1', 5000, '999999'),
(17, 2, 'C', '111102', '1', 5000, 'AC2.02012000.1'),
(18, 1, 'D', '000000', '1', 0, ''),
(18, 2, 'C', '000000', '1', 0, ''),
(19, 1, 'D', '423001', '1', 1200, 'CNS1.33444555000166'),
(19, 2, 'C', '212001', '1', 1200, 'CNS1.1.33444555000166'),
(20, 1, 'D', '423003', '1', 150, 'CNS2241833220.2558157000162'),
(20, 2, 'C', '212001', '1', 150, 'CNS2241833220.1.2558157000162'),
(21, 1, 'D', '423002', '1', 100, 'CNS51621771.61695227000193'),
(21, 2, 'C', '212001', '1', 100, 'CNS51621771.1.61695227000193'),
(22, 1, 'C', '111202', '1', 1200, 'CHE2.000001'),
(22, 2, 'D', '212001', '1', 1200, 'CNS1.1.33444555000166'),
(23, 1, 'C', '111202', '1', 150, 'BOL2.02012000.1'),
(23, 2, 'D', '212001', '1', 150, 'CNS2241833220.1.2558157000162'),
(24, 1, 'C', '111202', '1', 100, 'BOL2.02012000.2'),
(24, 2, 'D', '212001', '1', 100, 'CNS51621771.1.61695227000193'),
(25, 1, 'C', '111002', '1', 100, '999999'),
(25, 2, 'D', '111202', '1', 100, 'BOL2.2012000.2'),
(26, 1, 'C', '111002', '1', 150, '999999'),
(26, 2, 'D', '111202', '1', 150, 'BOL2.02012000.1'),
(27, 1, 'C', '111002', '1', 2113, '999999'),
(27, 2, 'D', '112001', '1', 2113, 'CNI2.1.1'),
(28, 1, 'D', '111002', '1', 1755.5, '999999'),
(28, 2, 'C', '112001', '1', 1755.5, 'CNI2.1.1'),
(29, 1, 'C', '311001', '1', 6000, 'NFS1'),
(29, 2, 'D', '219001', '1', 90, 'NFS1'),
(29, 3, 'D', '219002', '1', 39, 'NFS1'),
(29, 4, 'D', '219003', '1', 180, 'NFS1'),
(29, 5, 'C', '219004', '1', 60, 'NFS1'),
(29, 6, 'D', '113001', '2', 2896.5, 'DM1.1'),
(29, 7, 'D', '113001', '1', 2896.5, 'DM1.2'),
(30, 1, 'D', '111002', '1', 1877, '999999'),
(30, 2, 'C', '111102', '1', 1877, 'AC2.03012000.1'),
(31, 1, 'D', '111102', '1', 1877, 'AC2.03012000.1'),
(31, 2, 'C', '215001', '1', 1877, 'RCR1/00.1'),
(32, 1, 'C', '111002', '1', 1200, '999999'),
(32, 2, 'D', '111202', '1', 1200, 'CHE2.000001'),
(33, 1, 'D', '111002', '1', 2918.5, '999999'),
(33, 2, 'C', '111102', '1', 2918.5, 'AC1.06012000.1'),
(34, 1, 'C', '000000', '1', 0, ''),
(34, 2, 'D', '000000', '1', 0, ''),
(35, 1, 'D', '111102', '1', 2918.5, 'AC1.06012000.1'),
(35, 2, 'C', '113001', '1', 2918.5, 'DM1.1'),
(35, 4, 'D', '113001', '1', 22, 'DM1.1'),
(35, 5, 'C', '331001', '1', 22, 'DM1.1'),
(35, 6, 'D', '111202', '1', 2, 'CNB2.1.60746948000112'),
(35, 7, 'C', '423008', '1', 2, 'CNB2.60746948000112'),
(36, 1, 'C', '111002', '1', 2, '999999'),
(36, 2, 'D', '111202', '1', 2, 'DEB2.01022000.2'),
(37, 1, 'C', '111202', '1', 2, 'DEB2.01022000.2'),
(37, 2, 'D', '211202', '1', 2, 'CNB2.1.60746948000112'),
(38, 1, 'C', '311001', '1', 500, 'NFS2'),
(38, 2, 'D', '113001', '1', 500, 'DM2.1'),
(39, 1, 'D', '411001', '1', 500, 'NFS101010.2345678000102'),
(39, 2, 'C', '212001', '1', 500, 'DM101010.1.2345678000102'),
(40, 1, 'D', '422001', '1', 1100, 'CNS1.11233455677'),
(40, 2, 'C', '214001', '1', 1100, 'CNS1.1.11233455677'),
(41, 1, 'C', '111202', '1', 500, 'BOL2.31012000.1'),
(41, 2, 'D', '212001', '1', 500, 'DM101010.1.2345678000102'),
(42, 1, 'D', '112001', '1', 5.5, 'CNI2.1.1'),
(42, 2, 'C', '332001', '1', 5.5, 'CNF2.1.1'),
(43, 1, 'C', '111002', '1', 500, '999999'),
(43, 2, 'D', '111202', '1', 500, 'BOL2.31012000.1'),
(44, 1, 'C', '111002', '1', 30, '999999'),
(44, 2, 'D', '111202', '1', 30, 'EXT2.01022000.2'),
(45, 1, 'D', '423008', '1', 30, 'CNB2.60746948000112'),
(45, 2, 'C', '111202', '1', 30, 'EXT2.01022000.2'),
(46, 1, 'C', '000000', '1', 0, ''),
(46, 2, 'D', '000000', '1', 0, ''),
(47, 1, 'C', '111002', '1', 22.95, '999999'),
(47, 2, 'D', '211001', '1', 22.95, 'CNF2.1.1'),
(47, 3, 'C', '211001', '1', 22.95, 'CNF2.1.1'),
(47, 4, 'D', '432001', '1', 22.95, 'CNF2.1.1'),
(48, 1, 'D', '000000', '1', 0, ''),
(48, 2, 'C', '000000', '1', 0, ''),
(49, 1, 'C', '111202', '1', 1100, 'TRA2.01022000.1'),
(49, 2, 'D', '214001', '1', 1100, 'CNS1.1.11233455677'),
(49, 3, 'D', '423008', '1', 5, 'CNB2.60746948000112'),
(49, 4, 'C', '111202', '1', 5, 'CNB2.1.60746948000112'),
(50, 1, 'C', '111002', '1', 1100, '999999'),
(50, 2, 'D', '111202', '1', 1100, 'TR2.01022000.1'),
(51, 1, 'D', '111002', '1', 1100, '999999'),
(51, 2, 'C', '111202', '1', 1100, 'TR2.01022000.1'),
(52, 1, 'D', '111202', '1', 1100, 'TR2.01022000.1'),
(52, 2, 'C', '214001', '1', 1100, 'CNS1.1.11233455677'),
(53, 1, 'C', '111202', '1', 1100, 'TRA2.01022000.2'),
(53, 2, 'D', '214001', '1', 1100, 'CNS1.1.11233455677'),
(53, 3, 'D', '423008', '1', 5, 'CNB2.60746948000112'),
(53, 4, 'C', '111202', '1', 5, 'CNB2.1.60746948000112'),
(54, 1, 'C', '111002', '1', 1100, '999999'),
(54, 2, 'D', '111202', '1', 1100, 'TR2.01022000.2'),
(55, 1, 'C', '111002', '1', 10, '999999'),
(55, 2, 'D', '111202', '1', 10, 'EXT2.01022000.7'),
(56, 1, 'C', '111202', '1', 10, 'DEBCNB2.1'),
(56, 2, 'D', '218001', '1', 10, 'CNB2.1.60746948000112'),
(57, 1, 'D', '313005', '1', 300, 'GRP3/00'),
(57, 2, 'C', '213005', '1', 300, 'GRP3/00.1'),
(58, 1, 'C', '111202', '1', 300, 'BOL2.01022000.1'),
(58, 2, 'D', '213005', '1', 300, 'GPS1/00.1.16727230000197'),
(59, 1, 'C', '111002', '1', 300, '999999'),
(59, 2, 'D', '111202', '1', 300, 'BOL2.01022000.1'),
(60, 1, 'C', '111002', '1', 4377.25, 'EXT02022000.1'),
(60, 2, 'C', '211001', '1', 377.25, 'CNF2.2/00.1'),
(60, 3, 'D', '432001', '1', 377.25, 'CNF2.2/00.1'),
(60, 4, 'D', '211001', '1', 4377.25, 'CNF2.2/00.1');

-- --------------------------------------------------------

--
-- Table structure for table `TraStd`
--

CREATE TABLE `TraStd` (
  `Cod` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Name` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Active` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Obs` varchar(46) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `TraStd`
--

INSERT INTO `TraStd` (`Cod`, `Name`, `Active`, `Obs`) VALUES
('bcnx', NULL, NULL, NULL),
('bdnx', NULL, NULL, NULL),
('bfdx', 'Db.Distribuição lucro', 'S', 'Base Mysql'),
('bfex', 'Cr.Aporte de capital', 'S', ''),
('bffu', 'Db.Repagamento', 'S', ''),
('bffx', 'Cr.Captação', 'S', ''),
('bfix', 'Juros financiamento', 'S', ''),
('biau', 'Cr.Rec.vd.imobilizado', 'S', ''),
('biax', 'Db.Pag.imoblizado', 'S', ''),
('bifu', 'Cr.Resgate', 'S', ''),
('bifx', 'Db.Aplicação', 'S', ''),
('biix', 'Juros aplicações', 'S', ''),
('bopu', 'Cr.Estorno Pag.Oper.', 'S', ''),
('bopx', 'Db.Pag.Operacional', 'S', ''),
('boru', 'Db.Estorno Rec.Oper.', 'S', ''),
('borx', 'Cr.Clientes', 'S', ''),
('man', 'Ajuste manual', 'S', ''),
('paax', 'Req.adiant.imob.', 'S', ''),
('paox', 'Req.adiant.oper.', 'S', ''),
('pidx', 'Dstribuição lucro', 'S', ''),
('piix', 'Compra imobilizado', 'S', ''),
('piox', 'Custo ou Desp.oper.', 'S', ''),
('plix', 'Pag.imobilizado', 'S', ''),
('plou', 'Estorno pag.operacional', 'S', ''),
('plox', 'Pag.operacional', 'S', ''),
('rbex', 'Rec.Aporte de capital', 'S', ''),
('rbou', 'Db.Estorno clientes', 'S', ''),
('rbox', 'Rec.clientes', 'S', ''),
('rieu', 'Redução de capital', 'N', 'Operação muito rara'),
('riex', 'Aporte capital', 'S', 'Legalmente chamada integralização de capital'),
('riox', 'Rec.operac.out', 'N', ''),
('risx', 'Venda serviços', 'S', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FullName` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Std` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Active` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Obs` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `FullName`, `Email`, `Pass`, `Std`, `Active`, `Obs`) VALUES
(1, 'João', 'João Silveira', 'joao@exemplo.com.br', '123456', 'guest', 'Sim', 'Base Mysql2'),
(2, 'Maria', 'Maria Silveira', 'maria@exemplo.com.br', '123456', 'guest', 'Sim', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Acc`
--
ALTER TABLE `Acc`
  ADD PRIMARY KEY (`Cod`);

--
-- Indexes for table `AccBan`
--
ALTER TABLE `AccBan`
  ADD PRIMARY KEY (`Cod`);

--
-- Indexes for table `Ban`
--
ALTER TABLE `Ban`
  ADD PRIMARY KEY (`Cod`);

--
-- Indexes for table `ban_acc`
--
ALTER TABLE `ban_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ban_mov`
--
ALTER TABLE `ban_mov`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ban_std`
--
ALTER TABLE `ban_std`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`CompanyCod`);

--
-- Indexes for table `DocFin`
--
ALTER TABLE `DocFin`
  ADD PRIMARY KEY (`Cod`);

--
-- Indexes for table `DocFinRec`
--
ALTER TABLE `DocFinRec`
  ADD PRIMARY KEY (`Cod`,`Seq`);

--
-- Indexes for table `DocIns`
--
ALTER TABLE `DocIns`
  ADD PRIMARY KEY (`Cod`,`PartCod`);

--
-- Indexes for table `DocRec`
--
ALTER TABLE `DocRec`
  ADD PRIMARY KEY (`Cod`,`PartCod`);

--
-- Indexes for table `pay_doc`
--
ALTER TABLE `pay_doc`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `pay_docseq`
--
ALTER TABLE `pay_docseq`
  ADD PRIMARY KEY (`doc`,`seq`);

--
-- Indexes for table `pay_mov`
--
ALTER TABLE `pay_mov`
  ADD PRIMARY KEY (`doc`,`reccod`,`seq`) USING BTREE;

--
-- Indexes for table `rec_doc`
--
ALTER TABLE `rec_doc`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `rec_docseq`
--
ALTER TABLE `rec_docseq`
  ADD PRIMARY KEY (`doc`,`seq`);

--
-- Indexes for table `rec_mov`
--
ALTER TABLE `rec_mov`
  ADD PRIMARY KEY (`doc`,`reccod`,`seq`) USING BTREE;

--
-- Indexes for table `Tra`
--
ALTER TABLE `Tra`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `TraSeq`
--
ALTER TABLE `TraSeq`
  ADD PRIMARY KEY (`Id`,`Seq`);

--
-- Indexes for table `TraStd`
--
ALTER TABLE `TraStd`
  ADD PRIMARY KEY (`Cod`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ban_mov`
--
ALTER TABLE `ban_mov`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

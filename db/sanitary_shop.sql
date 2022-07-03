CREATE DATABASE  IF NOT EXISTS `sanitary_shop` DEFAULT CHARACTER SET utf8;
USE `sanitary_shop`;
-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Lug 03, 2022 alle 18:49
-- Versione del server: 10.4.18-MariaDB
-- Versione PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanitary_shop`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account_clienti`
--

CREATE TABLE `account_clienti` (
  `NomeCompleto` varchar(50) NOT NULL,
  `NumeroTelefono` varchar(11) DEFAULT NULL,
  `IndirizzoSpedizione` varchar(70) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(70) NOT NULL,
  `CodCarta` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `account_clienti`
--

INSERT INTO `account_clienti` (`NomeCompleto`, `NumeroTelefono`, `IndirizzoSpedizione`, `Email`, `Password`, `CodCarta`) VALUES
('James Gutierrez', '03618906855', 'Via dell\'Università 50, Cesena', 'bancboy@att.net', '$2y$10$mmWQetKJddKXJZNILo74zOEQoaOAKvYAL29fKodczDllzIV1GDIU.', '180028166642366'),
('Michelle Adams', '03715967079', 'Via dell\'Università 50, Cesena', 'bescoto@icloud.com', '$2y$10$aaZjhaQVEeqAGAjFCq1wY.uncktneTLs8zoGO0nZlllukzVrGeDYy', '4917530565860111'),
('Christopher Pacheco', '03481750145', 'Via dell\'Università 50, Cesena', 'cantu@live.com', '$2y$10$tde2isdjTI9x.HXcDY1FDeTMdsPQ6FJvPXWxXb7uPCPJxvvIf55kG', '2714147157256183'),
('Sheryl Walker', '03155295575', 'Via dell\'Università 50, Cesena', 'claypool@icloud.com', '$2y$10$ZhVnBU./W.IqmrutN9cGfuMcps/ErXIrjf0j2TlTl4hQOFG1nYSgO', '4628441910773803'),
('John Spencer', '03635316785', 'Via dell\'Università 50, Cesena', 'henkp@optonline.net', '$2y$10$S3b3NUwreEF4XGXn/g/9o.Rg3Uhuj./m/yZHgn5VEML74rCxkwHAG', '2232378695843363'),
('Mario Rossi', '1234567895', 'Via dell\'Università 50 Cesena', 'hicox30076@lenfly.com', '$2y$10$lHeHy3w0T4gD2SHzf4as0.GpoTCiNCxY5znIcpiLR9YUi7N3Eo.f6', '123456789546213'),
('Juan Blair', '03527026670', 'Via dell\'Università 50, Cesena', 'itstatus@me.com', '$2y$10$XKcdl8TzTYWB5Nkp3eIe7.9FR2D80M2rZ7cenUFMtdKsdmmhaou8W', '3584413833287140'),
('Mary Lang', '03707494042', 'Via dell\'Università 50, Cesena', 'ivoibs@yahoo.ca', '$2y$10$Kmm29ki4ddf/kCHcGnfjkuxaM3/iUrdWe/FDBtdj/Ruksaw3BpEMS', '4195245272603166'),
('Gary Martinez', '03660260079', 'Via dell\'Università 50, Cesena', 'lipeng@me.com', '$2y$10$yIGUFpGfuhxqTWeAlNUcUObEJEGkcwklCXCapdYwTUX0tX3p1AvKK', '349712337499701'),
('Scott Parker', '03856608655', 'Via dell\'Università 50, Cesena', 'milton@mac.com', '$2y$10$RyZ7G9tlBP7SqapgLx6jo.am9w6EEqC/LXk6fS7W3j76odNjgokwG', '3509899310214494'),
('Gary Martinez', '03437356436', 'Via dell\'Università 50, Cesena', 'seemant@icloud.com', '$2y$10$w0w7sYPprgAXbgE2rRvqqu9YwwtFCeYIJUwf.ZFbRIV2juSaaGiNK', '349712337499701'),
('Cheryl Chambers', '03284254250', 'Via dell\'Università 50, Cesena', 'terjesa@hotmail.com', '$2y$10$jqXbre4CRlWZcoP2ZG9e4umHLhTsFRMomnSNxJX5VfYAJCHG25Hdy', '6011297221005776'),
('Colton Smith', '03520974083', 'Via dell\'Università 50, Cesena', 'timtroyr@msn.com', '$2y$10$w02OC1t.oV4Xpvz09nDpnOE2DSR4Wii07b18kPQFFahTeLjkjL3e6', '4564206495500'),
('Jeffrey Davenport', '03501200390', 'Via dell\'Università 50, Cesena', 'tskirvin@gmail.com', '$2y$10$5CCMp.7ZxtX1QY38WkvCtuCYHvSWYUvru4gIJ.9sftGWBU5qaMZX.', '4119011250192');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Email` varchar(50) NOT NULL,
  `CodProdotto` int(11) NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `Qta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`Email`, `CodProdotto`, `CodFornitore`, `Qta`) VALUES
('bancboy@att.net', 3, '09696404185', 1),
('hicox30076@lenfly.com', 3, '56227563472', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `carte_pagamento`
--

CREATE TABLE `carte_pagamento` (
  `CodCarta` varchar(16) NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `carte_pagamento`
--

INSERT INTO `carte_pagamento` (`CodCarta`, `NomeCompletoIntestatario`, `DataScadenza`) VALUES
('123456789546213', 'Mario Rossi', '2029-06-01'),
('180028166642366', 'James Gutierrez', '2001-03-26'),
('2232378695843363', 'John Spencer', '2001-08-22'),
('2714147157256183', 'Christopher Pacheco', '2001-06-23'),
('349712337499701', 'Gary Martinez', '2001-02-27'),
('3509899310214494', 'Scott Parker', '0000-00-00'),
('3584413833287140', 'Juan Blair', '2001-03-28'),
('4119011250192', 'Jeffrey Davenport', '2001-08-26'),
('4195245272603166', 'Mary Lang', '2001-06-27'),
('4564206495500', 'Colton Smith', '2001-11-30'),
('4628441910773803', 'Sheryl Walker', '2001-03-24'),
('4917530565860111', 'Michelle Adams', '2001-02-26'),
('6011297221005776', 'Cheryl Chambers', '2001-05-28');

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `CodCategoria` int(11) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `ColoreCategoria` varchar(6) NOT NULL,
  `ImgPath` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`CodCategoria`, `Nome`, `ColoreCategoria`, `ImgPath`) VALUES
(1, 'Prodotti Multiuso', '9DD5ED', 'categoryImgs/Superficie.png'),
(2, 'Prodotti Cucina', '249B06', 'categoryImgs/cucina.png'),
(3, 'Prodotti Bagno', 'E9BB00', 'categoryImgs/Bagno.png'),
(4, 'Altro', '06ACB8', 'categoryImgs/altro.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `dettaglio_ordini`
--

CREATE TABLE `dettaglio_ordini` (
  `CodProdotto` int(11) NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `CodOrdine` int(11) NOT NULL,
  `Qta` int(11) NOT NULL,
  `PrezzoVendita` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `dettaglio_ordini`
--

INSERT INTO `dettaglio_ordini` (`CodProdotto`, `CodFornitore`, `CodOrdine`, `Qta`, `PrezzoVendita`) VALUES
(1, '96086030852', 4, 1, '124.20'),
(1, '96086030852', 8, 1, '124.20'),
(1, '29299004756', 9, 1, '45.10'),
(1, '95589575658', 14, 1, '102.30'),
(1, '85942003447', 32, 1, '107.90'),
(2, '69065606033', 7, 1, '192.08'),
(2, '96086030852', 9, 1, '167.96'),
(2, '56227563472', 10, 1, '16.74'),
(2, '96086030852', 12, 1, '167.96'),
(3, '56227563472', 1, 1, '156.40'),
(3, '56227563472', 2, 1, '156.40'),
(3, '56227563472', 3, 1, '156.40'),
(3, '56227563472', 5, 1, '156.40'),
(3, '56227563472', 6, 1, '156.40'),
(3, '85942003447', 11, 3, '36.00'),
(3, '95589575658', 12, 1, '98.90'),
(3, '09696404185', 14, 3, '59.20'),
(3, '56227563472', 15, 1, '156.40'),
(3, '56227563472', 16, 1, '156.40'),
(3, '56227563472', 17, 1, '156.40'),
(3, '56227563472', 18, 1, '156.40'),
(3, '56227563472', 19, 1, '156.40'),
(3, '56227563472', 22, 1, '1.00'),
(3, '56227563472', 23, 1, '1.00'),
(3, '56227563472', 24, 1, '1.00'),
(3, '56227563472', 25, 1, '1.00'),
(3, '56227563472', 26, 1, '1.00'),
(3, '56227563472', 27, 1, '1.00'),
(3, '56227563472', 28, 1, '1.00'),
(3, '56227563472', 29, 1, '1.00'),
(3, '56227563472', 30, 1, '156.40'),
(3, '56227563472', 31, 1, '156.40'),
(3, '56227563472', 32, 2, '156.40'),
(3, '56227563472', 33, 17, '156.40'),
(3, '56227563472', 34, 15, '156.40'),
(3, '09696404185', 36, 1, '59.20'),
(3, '56227563472', 37, 1, '156.40'),
(4, '29299004756', 35, 1, '24.80'),
(8, '09696404185', 11, 6, '43.66'),
(9, '09696404185', 13, 1, '38.35');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche_cliente`
--

CREATE TABLE `notifiche_cliente` (
  `CodNotifica` int(11) NOT NULL,
  `TitoloNotifica` varchar(150) NOT NULL,
  `DescrizioneNotifica` varchar(300) NOT NULL,
  `Data` datetime NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CodOrdine` int(11) DEFAULT NULL,
  `CodProdotto` int(11) NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `Attiva` tinyint(4) NOT NULL DEFAULT 1,
  `Tipologia` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `notifiche_cliente`
--

INSERT INTO `notifiche_cliente` (`CodNotifica`, `TitoloNotifica`, `DescrizioneNotifica`, `Data`, `Email`, `CodOrdine`, `CodProdotto`, `CodFornitore`, `Attiva`, `Tipologia`) VALUES
(1, 'TEST', 'TEST', '2022-07-01 15:42:21', 'bancboy@att.net', NULL, 3, '56227563472', 0, ''),
(2, 'Prodotto 3 di nuovo disponibile', 'Salve il prodotto 3 è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-01 15:55:27', 'bancboy@att.net', NULL, 3, '56227563472', 0, ''),
(3, 'Prodotto 3 di nuovo disponibile', 'Salve il prodotto 3 è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-01 15:55:35', 'bancboy@att.net', NULL, 3, '56227563472', 0, ''),
(4, 'Prodotto Enjoymere di nuovo disponibile', 'Salve il prodotto Enjoymere è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-03 14:55:08', 'bancboy@att.net', NULL, 3, '56227563472', 0, 'refill'),
(5, 'Prodotto Enjoymere di nuovo disponibile', 'Salve il prodotto Enjoymere è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-03 16:53:59', 'bancboy@att.net', NULL, 3, '56227563472', 0, 'refill'),
(6, 'Prodotto Enjoymere di nuovo disponibile', 'Salve il prodotto Enjoymere è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-03 16:54:01', 'hicox30076@lenfly.com', NULL, 3, '56227563472', 1, 'refill'),
(7, 'Prodotto Enjoymere di nuovo disponibile', 'Salve il prodotto Enjoymere è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-03 18:17:55', 'bancboy@att.net', NULL, 3, '56227563472', 0, 'refill'),
(8, 'Prodotto Enjoymere di nuovo disponibile', 'Salve il prodotto Enjoymere è di nuovo disponibile, affrettati per non fartelo scappare', '2022-07-03 18:17:55', 'hicox30076@lenfly.com', NULL, 3, '56227563472', 1, 'refill');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche_venditore`
--

CREATE TABLE `notifiche_venditore` (
  `CodNotifica` int(11) NOT NULL,
  `TitoloNotifica` varchar(70) NOT NULL,
  `DescrizioneNotifica` varchar(300) NOT NULL,
  `CodProdotto` int(11) NOT NULL,
  `Data` date NOT NULL,
  `CodVenditore` varchar(20) NOT NULL,
  `Attiva` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `notifiche_venditore`
--

INSERT INTO `notifiche_venditore` (`CodNotifica`, `TitoloNotifica`, `DescrizioneNotifica`, `CodProdotto`, `Data`, `CodVenditore`, `Attiva`) VALUES
(6, 'Prodotto 3 esaurito', 'Prodotto 3 esaurito in data:2022-07-01', 3, '2022-07-01', '56227563472', 0),
(7, 'Prodotto 3 esaurito', 'Prodotto 3 esaurito in data:2022-07-01', 3, '2022-07-01', '56227563472', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `CodOrdine` int(11) NOT NULL,
  `DataOrdine` datetime NOT NULL,
  `ImportoTotale` decimal(8,2) NOT NULL,
  `ScontoTotale` decimal(8,2) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `IndirizzoConsegna` varchar(70) NOT NULL,
  `CodCarta` varchar(16) NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`CodOrdine`, `DataOrdine`, `ImportoTotale`, `ScontoTotale`, `Email`, `IndirizzoConsegna`, `CodCarta`, `NomeCompletoIntestatario`, `DataScadenza`) VALUES
(1, '2022-07-01 12:14:36', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(2, '2022-07-01 12:17:34', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(3, '2022-07-01 12:17:35', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(4, '2022-07-01 12:18:13', '230.00', '105.80', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(5, '2022-07-01 12:19:07', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(6, '2022-07-01 12:19:39', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(7, '2022-07-01 13:05:37', '196.00', '3.92', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(8, '2022-07-01 13:11:51', '230.00', '105.80', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(9, '2022-07-01 13:30:54', '357.00', '143.94', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(10, '2022-07-01 13:42:19', '31.00', '14.26', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(11, '2022-07-01 14:13:13', '552.00', '182.04', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(12, '2022-07-01 14:46:28', '477.00', '210.14', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(13, '2022-07-01 14:58:12', '59.00', '20.65', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(14, '2022-07-01 14:58:31', '332.00', '52.10', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(15, '2022-07-01 15:03:50', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(16, '2022-07-01 15:09:23', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(17, '2022-07-01 15:09:30', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(18, '2022-07-01 15:09:31', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(19, '2022-07-01 15:09:31', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(20, '2022-07-01 15:18:05', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(21, '2022-07-01 15:19:41', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(22, '2022-07-01 15:20:01', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(23, '2022-07-01 15:22:28', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(24, '2022-07-01 15:22:42', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(25, '2022-07-01 15:25:38', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(26, '2022-07-01 15:26:11', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(27, '2022-07-01 15:28:19', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(28, '2022-07-01 15:29:02', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(29, '2022-07-01 15:29:53', '230.00', '229.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(30, '2022-07-01 15:32:19', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(31, '2022-07-01 15:36:12', '230.00', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(32, '2022-07-03 17:24:32', '420.70', '205.30', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(33, '2022-07-03 17:33:04', '2658.80', '1251.20', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(34, '2022-07-03 17:50:27', '2346.00', '1104.00', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(35, '2022-07-03 18:04:27', '24.80', '6.20', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(36, '2022-07-03 18:06:39', '59.20', '14.80', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26'),
(37, '2022-07-03 18:18:42', '156.40', '73.60', 'bancboy@att.net', 'Via dell\'Università 50, Cesena', '180028166642366', 'James Gutierrez', '2001-03-26');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `CodProdotto` int(11) NOT NULL,
  `NomeProdotto` varchar(50) NOT NULL,
  `Descrizione` varchar(200) NOT NULL,
  `ImgPath` varchar(220) NOT NULL,
  `PrezzoUnitario` decimal(8,2) NOT NULL,
  `Sconto` int(11) NOT NULL DEFAULT 0,
  `QtaInMagazzino` int(11) NOT NULL,
  `MaxQtaMagazzino` int(11) NOT NULL,
  `InVendita` tinyint(1) NOT NULL,
  `CodCategoria` int(11) NOT NULL,
  `CodFornitore` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`CodProdotto`, `NomeProdotto`, `Descrizione`, `ImgPath`, `PrezzoUnitario`, `Sconto`, `QtaInMagazzino`, `MaxQtaMagazzino`, `InVendita`, `CodCategoria`, `CodFornitore`) VALUES
(1, 'Wittype', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/cucina.png', '74.00', 0, 265, 265, 1, 3, '09696404185'),
(1, 'SablinkScree', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/liquido-lavapiatti.png', '110.00', 59, 133, 134, 1, 1, '29299004756'),
(1, 'Scantera', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/detergente-universale.png', '65.00', 0, 435, 435, 1, 2, '41024606886'),
(1, 'Kuroravi', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/guanti.png', '31.00', 0, 200, 200, 1, 4, '56227563472'),
(1, 'Shoppel', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/cucina.png', '247.00', 7, 391, 391, 1, 4, '69065606033'),
(1, 'TruckSelf', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/guanti.png', '166.00', 35, 388, 389, 1, 1, '85942003447'),
(1, 'ReadApenguin', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/cucina.png', '110.00', 7, 116, 117, 1, 1, '95589575658'),
(1, 'Enjoymere', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/detergente-universale.png', '230.00', 46, 479, 481, 1, 2, '96086030852'),
(2, 'SunsetPink', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/guanti.png', '247.00', 0, 9, 9, 1, 1, '09696404185'),
(2, 'TruckSelf', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/detergente-universale.png', '10.00', 45, 493, 493, 1, 1, '29299004756'),
(2, 'SablinkScree', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/cucina.png', '31.00', 46, 149, 149, 1, 2, '56227563472'),
(2, 'Blowerih', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/guanti.png', '196.00', 2, 8, 9, 1, 3, '69065606033'),
(2, 'Chillee', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/cucina.png', '224.00', 46, 134, 134, 1, 3, '85942003447'),
(2, 'SablinkScree', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/Superficie.png', '10.00', 37, 252, 252, 1, 4, '95589575658'),
(2, 'Chillee', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/cucina.png', '247.00', 32, 389, 391, 1, 1, '96086030852'),
(3, 'Ravagar', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/liquido-lavapiatti.png', '74.00', 20, 385, 389, 1, 3, '09696404185'),
(3, 'Eatrolo', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/Superficie.png', '10.00', 37, 101, 101, 1, 4, '29299004756'),
(3, 'Enjoymere', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/liquido-lavapiatti.png', '230.00', 32, 148, 149, 1, 4, '56227563472'),
(3, 'Dipitype', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/liquido-lavapiatti.png', '230.00', 0, 16, 16, 1, 1, '69065606033'),
(3, 'Scantera', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/liquido-lavapiatti.png', '36.00', 0, 39, 42, 1, 2, '85942003447'),
(3, 'Dipitype', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/guanti.png', '230.00', 57, 388, 389, 1, 4, '95589575658'),
(4, 'Panterme', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/detergente-universale.png', '247.00', 7, 493, 493, 1, 4, '09696404185'),
(4, 'ReadApenguin', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/Superficie.png', '31.00', 20, 388, 389, 1, 4, '29299004756'),
(4, 'SunsetPink', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/cucina.png', '59.00', 37, 16, 16, 1, 4, '95589575658'),
(5, 'Blowerih', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/guanti.png', '110.00', 0, 389, 389, 1, 3, '09696404185'),
(5, 'Ravagar', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/Superficie.png', '166.00', 45, 134, 134, 1, 4, '29299004756'),
(6, 'Listfman', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/guanti.png', '59.00', 2, 389, 389, 1, 4, '09696404185'),
(7, 'TrickyCyber', 'Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.', 'productsImg/guanti.png', '143.00', 41, 9, 9, 1, 1, '09696404185'),
(8, 'Yuirm', 'Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.', 'productsImg/guanti.png', '74.00', 41, 487, 493, 1, 2, '09696404185'),
(9, 'Ravagar', 'Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!', 'productsImg/cucina.png', '59.00', 35, 390, 391, 1, 3, '09696404185');

-- --------------------------------------------------------

--
-- Struttura della tabella `stati_ordine`
--

CREATE TABLE `stati_ordine` (
  `CodStato` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `stati_ordine`
--

INSERT INTO `stati_ordine` (`CodStato`, `Nome`) VALUES
(1, 'ordinato'),
(2, 'spedito'),
(3, 'in consegna'),
(4, 'consegnato');

-- --------------------------------------------------------

--
-- Struttura della tabella `stato_attuale_ordine`
--

CREATE TABLE `stato_attuale_ordine` (
  `CodOrdine` int(11) NOT NULL,
  `CodProdotto` int(11) NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `CodStato` int(11) NOT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditori`
--

CREATE TABLE `venditori` (
  `NomeCompagnia` varchar(50) NOT NULL,
  `CodVenditore` varchar(20) NOT NULL,
  `NumeroTelefono` varchar(11) NOT NULL,
  `Ind_Via` varchar(70) NOT NULL,
  `Ind_Citta` varchar(30) NOT NULL,
  `Ind_Provincia` varchar(30) NOT NULL,
  `Ind_CAP` int(11) NOT NULL,
  `Ind_Paese` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `venditori`
--

INSERT INTO `venditori` (`NomeCompagnia`, `CodVenditore`, `NumeroTelefono`, `Ind_Via`, `Ind_Citta`, `Ind_Provincia`, `Ind_CAP`, `Ind_Paese`, `Email`, `Password`) VALUES
('Rise\'n Shine', '01085273853', '03257202891', 'Piazzetta Concordia 44', 'San Martino Sinzano', 'Parma', 43030, 'Italy', 'lipeng@me.com', '$2y$10$0zb.VJx15L1aDSvTPjvgve3UOZMdLNBvlsgTGhoxmDqvIkeYTjqgy'),
('The Cleaning Trust', '09696404185', '03257202891', 'Piazzetta Concordia 44', 'San Martino Sinzano', 'Parma', 43030, 'Italy', 'claypool@icloud.com', '$2y$10$fbdS04cysfuuuYkCcFkqS.Me57X07TqNJYmoA1pGks/1UMophSvOK'),
('Rise\'n Shine', '29299004756', '03815456912', 'Vico Giganti 29', 'Ruino', 'Pavia', 27040, 'Italy', 'tskirvin@gmail.com', '$2y$10$xIWpxNv4UwFT6SrqYUqTse3XYfdzKElhxHluGGZMHDrSHdNQC9SM.'),
('The Cleaning Crew', '41024606886', '01877871818', 'Via Moiariello 71', 'San Rocco Castagnaretta', 'Cuneo', 12010, 'Italy', 'henkp@optonline.net', '$2y$10$i9.iL56ZuXnkAUc58L9GeOcrRy25y7cvQu3iVkqtrMc3byAUgqJv.'),
('Prestige Cleaning', '44175830173', '01877871818', 'Via Moiariello 71', 'San Rocco Castagnaretta', 'Cuneo', 12010, 'Italy', 'milton@mac.com', '$2y$10$8Ydgf9gUoPYA2nP/Z4JXdetUijk9UOBd8hVDzjCfi3or1xOiZrYAy'),
('Xtreme Cleaners', '56227563472', '03257202891', 'Piazzetta Concordia 44', 'San Martino Sinzano', 'Parma', 43030, 'Italy', 'bancboy@att.net', '$2y$10$ujk/ruDnsUCrHioBFwXqAO5BwHUYlkcRdL08nwKExVQeq.WToX5qO'),
('Prestige Cleaning', '69065606033', '03257202891', 'Piazzetta Concordia 44', 'San Martino Sinzano', 'Parma', 43030, 'Italy', 'cantu@live.com', '$2y$10$Q372J3TB8lbrxaMnb2JmzukAv5cldzSmdmVRZv1XhXC6tzDkvkoBm'),
('Rainbow Cleaners', '85942003447', '01877871818', 'Via Moiariello 71', 'San Rocco Castagnaretta', 'Cuneo', 12010, 'Italy', 'terjesa@hotmail.com', '$2y$10$CMoe/KG1QpvJp4LisUqGV.ykWeumMfFzhqa0TCOGjAMSN5Kysu5Tq'),
('We’re a Lean Mean Cleaning Machine', '95589575658', '01877871818', 'Via Moiariello 71', 'San Rocco Castagnaretta', 'Cuneo', 12010, 'Italy', 'bescoto@icloud.com', '$2y$10$MAy8cd6YMyBxLAM5RYhO6u6E01VXn9rF94LlK.6pzs1YE1JHecA1S'),
('The Maid Brigade', '96086030852', '03531977957', 'Viale Augusto 48', 'Borgagne', 'Lecce', 73020, 'Italy', 'itstatus@me.com', '$2y$10$EVMKfABNyHRHZPBzs3u9seEBFVymBx1sX9GVzqrWEr5oeSUfQivOG');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account_clienti`
--
ALTER TABLE `account_clienti`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `FK_CodCarta` (`CodCarta`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Email`,`CodProdotto`,`CodFornitore`),
  ADD KEY `FK_CodProdottoCarrello` (`CodProdotto`),
  ADD KEY `FK_CodVenditoreCarrello` (`CodFornitore`);

--
-- Indici per le tabelle `carte_pagamento`
--
ALTER TABLE `carte_pagamento`
  ADD PRIMARY KEY (`CodCarta`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`CodCategoria`);

--
-- Indici per le tabelle `dettaglio_ordini`
--
ALTER TABLE `dettaglio_ordini`
  ADD PRIMARY KEY (`CodProdotto`,`CodOrdine`,`CodFornitore`),
  ADD KEY `FK_CodVenditoreOrdine` (`CodFornitore`),
  ADD KEY `FK_CodOrdine` (`CodOrdine`);

--
-- Indici per le tabelle `notifiche_cliente`
--
ALTER TABLE `notifiche_cliente`
  ADD PRIMARY KEY (`CodNotifica`,`Email`),
  ADD KEY `FK_EmailProprietario` (`Email`),
  ADD KEY `FK_OrdineNotifica` (`CodOrdine`),
  ADD KEY `FK_ProdottoNotifica` (`CodProdotto`),
  ADD KEY `FK_CodFornitreProdottoNotifica` (`CodFornitore`);

--
-- Indici per le tabelle `notifiche_venditore`
--
ALTER TABLE `notifiche_venditore`
  ADD PRIMARY KEY (`CodNotifica`,`CodVenditore`),
  ADD KEY `FK_CodProprietario` (`CodVenditore`),
  ADD KEY `FK_CodProdottoNotifica` (`CodProdotto`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`CodOrdine`),
  ADD KEY `FK_EmailCliente` (`Email`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`CodProdotto`,`CodFornitore`),
  ADD KEY `FK_VenditoreProdotto` (`CodFornitore`),
  ADD KEY `FK_CodCategoria` (`CodCategoria`);

--
-- Indici per le tabelle `stati_ordine`
--
ALTER TABLE `stati_ordine`
  ADD PRIMARY KEY (`CodStato`);

--
-- Indici per le tabelle `stato_attuale_ordine`
--
ALTER TABLE `stato_attuale_ordine`
  ADD PRIMARY KEY (`CodOrdine`,`CodProdotto`,`CodFornitore`,`CodStato`),
  ADD KEY `FK_Prodotto` (`CodProdotto`),
  ADD KEY `FK_Fornitore` (`CodFornitore`),
  ADD KEY `FK_Stato` (`CodStato`);

--
-- Indici per le tabelle `venditori`
--
ALTER TABLE `venditori`
  ADD PRIMARY KEY (`CodVenditore`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `CodCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `notifiche_cliente`
--
ALTER TABLE `notifiche_cliente`
  MODIFY `CodNotifica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `notifiche_venditore`
--
ALTER TABLE `notifiche_venditore`
  MODIFY `CodNotifica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `CodOrdine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `account_clienti`
--
ALTER TABLE `account_clienti`
  ADD CONSTRAINT `FK_CodCarta` FOREIGN KEY (`CodCarta`) REFERENCES `carte_pagamento` (`CodCarta`);

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FK_CodProdottoCarrello` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  ADD CONSTRAINT `FK_CodVenditoreCarrello` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`),
  ADD CONSTRAINT `FK_EmailClienteCarrello` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`);

--
-- Limiti per la tabella `dettaglio_ordini`
--
ALTER TABLE `dettaglio_ordini`
  ADD CONSTRAINT `FK_CodOrdine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`),
  ADD CONSTRAINT `FK_CodProdotto` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  ADD CONSTRAINT `FK_CodVenditoreOrdine` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`);

--
-- Limiti per la tabella `notifiche_cliente`
--
ALTER TABLE `notifiche_cliente`
  ADD CONSTRAINT `FK_CodFornitreProdottoNotifica` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`),
  ADD CONSTRAINT `FK_EmailProprietario` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`),
  ADD CONSTRAINT `FK_OrdineNotifica` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`),
  ADD CONSTRAINT `FK_ProdottoNotifica` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`);

--
-- Limiti per la tabella `notifiche_venditore`
--
ALTER TABLE `notifiche_venditore`
  ADD CONSTRAINT `FK_CodProdottoNotifica` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  ADD CONSTRAINT `FK_CodProprietario` FOREIGN KEY (`CodVenditore`) REFERENCES `venditori` (`CodVenditore`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `FK_EmailCliente` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`);

--
-- Limiti per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  ADD CONSTRAINT `FK_CodCategoria` FOREIGN KEY (`CodCategoria`) REFERENCES `categorie` (`CodCategoria`),
  ADD CONSTRAINT `FK_VenditoreProdotto` FOREIGN KEY (`CodFornitore`) REFERENCES `venditori` (`CodVenditore`);

--
-- Limiti per la tabella `stato_attuale_ordine`
--
ALTER TABLE `stato_attuale_ordine`
  ADD CONSTRAINT `FK_Fornitore` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`),
  ADD CONSTRAINT `FK_Ordine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`),
  ADD CONSTRAINT `FK_Prodotto` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  ADD CONSTRAINT `FK_Stato` FOREIGN KEY (`CodStato`) REFERENCES `stati_ordine` (`CodStato`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE DATABASE  IF NOT EXISTS `sanitary_shop` DEFAULT CHARACTER SET utf8;
USE `sanitary_shop`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sanitary_shop
-- ------------------------------------------------------
-- Server version	8.0.26

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS ;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION ;
SET NAMES utf8 ;
SET @OLD_TIME_ZONE=@@TIME_ZONE ;
SET TIME_ZONE='+00:00' ;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 ;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' ;
SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 ;

--
-- Table structure for table `account_clienti`
--

DROP TABLE IF EXISTS `account_clienti`;
CREATE TABLE `account_clienti` (
  `NomeCompleto` varchar(50) NOT NULL,
  `NumeroTelefono` varchar(11) DEFAULT NULL,
  `IndirizzoSpedizione` varchar(70) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(70) NOT NULL,
  `CodCarta` varchar(16) NOT NULL,
  PRIMARY KEY (`Email`),
  CONSTRAINT `FK_CodCarta` FOREIGN KEY (`CodCarta`) REFERENCES `carte_pagamento` (`CodCarta`)
) ENGINE=InnoDB;


--
-- Table structure for table `carrello`
--

DROP TABLE IF EXISTS `carrello`;
CREATE TABLE `carrello` (
  `Email` varchar(50) NOT NULL,
  `CodProdotto` int NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `Qta` int NOT NULL,
  PRIMARY KEY (`Email`, `CodProdotto`, `CodFornitore`),
  CONSTRAINT `FK_EmailClienteCarrello` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`),
  CONSTRAINT `FK_CodProdottoCarrello` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  CONSTRAINT `FK_CodVenditoreCarrello` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`)
) ENGINE=InnoDB;
--
-- Dumping data for table `carrello`
--

LOCK TABLES `carrello` WRITE;
UNLOCK TABLES;


--
-- Table structure for table `carte_pagamento`
--

DROP TABLE IF EXISTS `carte_pagamento`;
CREATE TABLE `carte_pagamento` (
  `CodCarta` varchar(16) NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` date NOT NULL,
  PRIMARY KEY (`CodCarta`)
) ENGINE=InnoDB;


--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `CodCategoria` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) NOT NULL,
  `ColoreCategoria` varchar(6) NOT NULL,
  `ImgPath` varchar(220) NOT NULL,
  PRIMARY KEY (`CodCategoria`)
) ENGINE=InnoDB;
--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
INSERT INTO `categorie` VALUES (1,'Prodotti Multiuso','9DD5ED', 'categoryImgs/Superficie.png'),(2,'Prodotti Cucina','249B06','categoryImgs/cucina.png'),(3,'Prodotti Bagno','E9BB00','categoryImgs/Bagno.png'),(4,'Altro','06ACB8','categoryImgs/altro.png');
UNLOCK TABLES;

--
-- Table structure for table `dettaglio_ordini`
--

DROP TABLE IF EXISTS `dettaglio_ordini`;
CREATE TABLE `dettaglio_ordini` (
  `CodProdotto` int NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `CodOrdine` int NOT NULL,
  `Qta` int NOT NULL,
  `PrezzoVendita` decimal(8,2) NOT NULL,
  PRIMARY KEY (`CodProdotto`,`CodOrdine`,`CodFornitore`),
  CONSTRAINT `FK_CodProdotto` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
    CONSTRAINT `FK_CodVenditoreOrdine` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`),
  CONSTRAINT `FK_CodOrdine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`)
) ENGINE=InnoDB;


--
-- Table structure for table `notifiche_cliente`
--

DROP TABLE IF EXISTS `notifiche_cliente`;
CREATE TABLE `notifiche_cliente` (
  `CodNotifica` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(150) NOT NULL,
  `DescrizioneNotifica` varchar(300) NOT NULL,
  `Data` datetime NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CodOrdine` int DEFAULT NULL,
  `CodProdotto` int NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  `Attiva` tinyint NOT NULL DEFAULT TRUE,
  `Tipologia` varchar(70) NOT NULL,
  PRIMARY KEY (`CodNotifica`,`Email`),
  CONSTRAINT `FK_EmailProprietario` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`),
  CONSTRAINT `FK_OrdineNotifica` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`),
  CONSTRAINT `FK_ProdottoNotifica` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  CONSTRAINT `FK_CodFornitreProdottoNotifica` FOREIGN KEY (`CodFornitore`) REFERENCES `prodotti` (`CodFornitore`)
) ENGINE=InnoDB;


--
-- Table structure for table `notifiche_venditore`
--

DROP TABLE IF EXISTS `notifiche_venditore`;
CREATE TABLE `notifiche_venditore` (
  `CodNotifica` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(70) NOT NULL,
  `DescrizioneNotifica` varchar(300) NOT NULL,
  `CodProdotto` int NOT NULL,
  `Data` date NOT NULL,
  `CodVenditore` varchar(20) NOT NULL,
  `Attiva` tinyint NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`CodNotifica`, `CodVenditore`),
  CONSTRAINT `FK_CodProprietario` FOREIGN KEY (`CodVenditore`) REFERENCES `venditori` (`CodVenditore`),
  CONSTRAINT `FK_CodProdottoNotifica` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`)
) ENGINE=InnoDB;


--
-- Table structure for table `ordini`
--

DROP TABLE IF EXISTS `ordini`;
CREATE TABLE `ordini` (
  `CodOrdine` int NOT NULL AUTO_INCREMENT,
  `DataOrdine` datetime NOT NULL,
  `ImportoTotale` decimal(8,2) NOT NULL,
  `ScontoTotale` decimal(8,2) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `IndirizzoConsegna` varchar(70) NOT NULL,
  `CodCarta` varchar(16) NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` date NOT NULL,
  PRIMARY KEY (`CodOrdine`),
  CONSTRAINT `FK_EmailCliente` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`)
) ENGINE=InnoDB;


--
-- Table structure for table `prodotti`
--

DROP TABLE IF EXISTS `prodotti`;
CREATE TABLE `prodotti` (
  `CodProdotto` int NOT NULL,
  `NomeProdotto` varchar(50) NOT NULL,
  `Descrizione` varchar(200) NOT NULL,
  `ImgPath` varchar(220) NOT NULL,
  `PrezzoUnitario` decimal(8,2) NOT NULL,
  `Sconto` int NOT NULL DEFAULT 0,
  `QtaInMagazzino` int NOT NULL,
  `MaxQtaMagazzino` int NOT NULL,
  `InVendita` tinyint(1) NOT NULL,
  `CodCategoria` int NOT NULL,
  `CodFornitore` varchar(20) NOT NULL,
  PRIMARY KEY (`CodProdotto`,`CodFornitore`),
  CONSTRAINT `FK_VenditoreProdotto` FOREIGN KEY (`CodFornitore`) REFERENCES `venditori` (`CodVenditore`),
  CONSTRAINT `FK_CodCategoria` FOREIGN KEY (`CodCategoria`) REFERENCES `categorie` (`CodCategoria`)
) ENGINE=InnoDB;


--
-- Table structure for table `venditori`
--

DROP TABLE IF EXISTS `venditori`;
CREATE TABLE `venditori` (
  `NomeCompagnia` varchar(50) NOT NULL,
  `CodVenditore` varchar(20) NOT NULL,
  `NumeroTelefono` varchar(11) NOT NULL,
  `Ind_Via` varchar(70) NOT NULL,
  `Ind_Citta` varchar(30) NOT NULL,
  `Ind_Provincia` varchar(30) NOT NULL,
  `Ind_CAP` int NOT NULL,
  `Ind_Paese` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(70) NOT NULL,
  PRIMARY KEY (`CodVenditore`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB;


SET TIME_ZONE=@OLD_TIME_ZONE;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
SET SQL_NOTES=@OLD_SQL_NOTES ;

-- Dump completed on 2021-12-21 12:49:20

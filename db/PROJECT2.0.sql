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
  `NumeroTelefono` int DEFAULT NULL,
  `Ind_Via` varchar(20) NOT NULL,
  `Ind_Citta` varchar(15) NOT NULL,
  `Ind_Provincia` varchar(20) NOT NULL,
  `Ind_CAP` int NOT NULL,
  `Ind_Paese` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `CodCarta` int NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB;
--
-- Dumping data for table `account_clienti`
--

LOCK TABLES `account_clienti` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `carte_pagamento`
--

DROP TABLE IF EXISTS `carte_pagamento`;
CREATE TABLE `carte_pagamento` (
  `CodCarta` int NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` date NOT NULL,
  PRIMARY KEY (`CodCarta`)
) ENGINE=InnoDB;
--
-- Dumping data for table `carte_pagamento`
--

LOCK TABLES `carte_pagamento` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `CodCategoria` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) NOT NULL,
  `ColoreCategoria` varchar(6) NOT NULL,
  PRIMARY KEY (`CodCategoria`)
) ENGINE=InnoDB;
--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
INSERT INTO `categorie` VALUES (1,'Prodotti Multiuso','06ACB8'),(2,'Prodotti Cucina','249B06'),(3,'Prodotti Bagno','E9BB00'),(4,'Altro','06ACB8');
UNLOCK TABLES;

--
-- Table structure for table `dettaglio_ordini`
--

DROP TABLE IF EXISTS `dettaglio_ordini`;
CREATE TABLE `dettaglio_ordini` (
  `CodProdotto` int NOT NULL,
  `CodOrdine` int NOT NULL,
  `Qta` int NOT NULL,
  `PrezzoRealeVendita` decimal(8,2) NOT NULL,
  PRIMARY KEY (`CodProdotto`,`CodOrdine`),
  CONSTRAINT `FK_CodProdotto` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  CONSTRAINT `FK_CodOrdine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`)
) ENGINE=InnoDB;

--
-- Dumping data for table `dettaglio_ordini`
--

LOCK TABLES `dettaglio_ordini` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `notifiche_cliente`
--

DROP TABLE IF EXISTS `notifiche_cliente`;
CREATE TABLE `notifiche_cliente` (
  `CodNotifica` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(70) NOT NULL,
  `ImgNotifica` blob,
  `Data` datetime NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`CodNotifica`),
  CONSTRAINT `FK_EmailProprietario` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`)
) ENGINE=InnoDB;


--
-- Dumping data for table `notifiche_cliente`
--

LOCK TABLES `notifiche_cliente` WRITE;

UNLOCK TABLES;

--
-- Table structure for table `notifiche_venditore`
--

DROP TABLE IF EXISTS `notifiche_venditore`;

CREATE TABLE `notifiche_venditore` (
  `CodNotifica` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(70) NOT NULL,
  `ImgNotifica` blob,
  `Data` date NOT NULL,
  `CodVenditore` int NOT NULL,
  PRIMARY KEY (`CodNotifica`),
  CONSTRAINT `FK_CodProprietario` FOREIGN KEY (`CodVenditore`) REFERENCES `venditori` (`CodVenditore`)
) ENGINE=InnoDB;


--
-- Dumping data for table `notifiche_venditore`
--

LOCK TABLES `notifiche_venditore` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `ordini`
--

DROP TABLE IF EXISTS `ordini`;
CREATE TABLE `ordini` (
  `CodOrdine` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(70) NOT NULL,
  `ImgNotifica` blob,
  `DataOrdine` datetime NOT NULL,
  `DataConsegna` datetime DEFAULT NULL,
  `ImportoTotale` decimal(8,2) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Ind_Consegna_Via` varchar(20) NOT NULL,
  `Ind_Consegna_Citta` varchar(15) NOT NULL,
  `Ind_Consegna_Prov` varchar(20) NOT NULL,
  `Ind_Consegna_CAP` int NOT NULL,
  `Ind_Consegna_Paese` varchar(15) NOT NULL,
  `CodCarta` int NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` datetime NOT NULL,
  PRIMARY KEY (`CodOrdine`),
  CONSTRAINT `FK_EmailCliente` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`)
) ENGINE=InnoDB;

--
-- Dumping data for table `ordini`
--

LOCK TABLES `ordini` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `prodotti`
--

DROP TABLE IF EXISTS `prodotti`;
CREATE TABLE `prodotti` (
  `CodProdotto` int NOT NULL AUTO_INCREMENT,
  `NomeProdotto` varchar(50) NOT NULL,
  `BreveDescrizione` varchar(60) NOT NULL,
  `Img` blob,
  `PrezzoUnitario` decimal(8,2) NOT NULL,
  `Sconto` int NOT NULL DEFAULT 0,
  `QtaInMagazzino` int NOT NULL,
  `MaxQtaMagazzino` int NOT NULL,
  `InVendita` tinyint(1) NOT NULL,
  `CodCategoria` int NOT NULL,
  `CodFornitore` int NOT NULL,
  PRIMARY KEY (`CodProdotto`),
  CONSTRAINT `FK_CodCategoria` FOREIGN KEY (`CodCategoria`) REFERENCES `categorie` (`CodCategoria`),
  CONSTRAINT `FK_CodFornitore` FOREIGN KEY (`CodFornitore`) REFERENCES `venditori` (`CodVenditore`)
) ENGINE=InnoDB;


--
-- Dumping data for table `prodotti`
--

LOCK TABLES `prodotti` WRITE;

UNLOCK TABLES;

--
-- Table structure for table `stati_ordine`
--

DROP TABLE IF EXISTS `stati_ordine`;

CREATE TABLE `stati_ordine` (
  `CodStato` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  PRIMARY KEY (`CodStato`)
) ENGINE=InnoDB;


--
-- Dumping data for table `stati_ordine`
--

LOCK TABLES `stati_ordine` WRITE;
INSERT INTO `stati_ordine` VALUES (1,'ordinato'),(2,'spedito'),(3,'in consegna'),(4,'consegnato');
UNLOCK TABLES;

--
-- Table structure for table `stato_attuale_ordine`
--

DROP TABLE IF EXISTS `stato_attuale_ordine`;
CREATE TABLE `stato_attuale_ordine` (
  `CodOrdine` int NOT NULL,
  `CodStato` int NOT NULL,
  `Data` datetime NOT NULL,
  PRIMARY KEY (`CodOrdine`),
  CONSTRAINT `FK_Ordine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`),
  CONSTRAINT `FK_Stato` FOREIGN KEY (`CodStato`) REFERENCES `stati_ordine` (`CodStato`)
) ENGINE=InnoDB;

--
-- Dumping data for table `stato_attuale_ordine`
--

LOCK TABLES `stato_attuale_ordine` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `venditori`
--

DROP TABLE IF EXISTS `venditori`;
CREATE TABLE `venditori` (
  `NomeCompagnia` varchar(50) NOT NULL,
  `CodVenditore` int NOT NULL,
  `NumeroTelefono` int NOT NULL,
  `Ind_Via` varchar(20) NOT NULL,
  `Ind_Citta` varchar(15) NOT NULL,
  `Ind_Provincia` varchar(20) NOT NULL,
  `Ind_CAP` int NOT NULL,
  `Ind_Paese` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`CodVenditore`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB;

--
-- Dumping data for table `venditori`
--

LOCK TABLES `venditori` WRITE;
UNLOCK TABLES;

SET TIME_ZONE=@OLD_TIME_ZONE;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
SET SQL_NOTES=@OLD_SQL_NOTES ;

-- Dump completed on 2021-12-21 12:49:20

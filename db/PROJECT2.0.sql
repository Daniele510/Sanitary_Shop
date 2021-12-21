CREATE DATABASE  IF NOT EXISTS `e-commerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `e-commerce`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: e-commerce
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_clienti`
--

DROP TABLE IF EXISTS `account_clienti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_clienti`
--

LOCK TABLES `account_clienti` WRITE;
/*!40000 ALTER TABLE `account_clienti` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_clienti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carte_pagamento`
--

DROP TABLE IF EXISTS `carte_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carte_pagamento` (
  `CodCarta` int NOT NULL,
  `NomeCompletoIntestatario` varchar(50) NOT NULL,
  `DataScadenza` date NOT NULL,
  PRIMARY KEY (`CodCarta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carte_pagamento`
--

LOCK TABLES `carte_pagamento` WRITE;
/*!40000 ALTER TABLE `carte_pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `carte_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie` (
  `CodCategoria` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) NOT NULL,
  PRIMARY KEY (`CodCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Prodotti Multiuso'),(2,'prodotti Cucina'),(3,'Prodotti Bagno'),(4,'Altro');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dettaglio_ordini`
--

DROP TABLE IF EXISTS `dettaglio_ordini`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dettaglio_ordini` (
  `CodProdotto` int NOT NULL,
  `CodOrdine` int NOT NULL,
  `Qta` int NOT NULL,
  `PrezzoRealeVendita` decimal(8,2) NOT NULL,
  PRIMARY KEY (`CodProdotto`,`CodOrdine`),
  CONSTRAINT `FK_CodProdotto` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotti` (`CodProdotto`),
  CONSTRAINT `FK_CodOrdine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dettaglio_ordini`
--

LOCK TABLES `dettaglio_ordini` WRITE;
/*!40000 ALTER TABLE `dettaglio_ordini` DISABLE KEYS */;
/*!40000 ALTER TABLE `dettaglio_ordini` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifiche_cliente`
--

DROP TABLE IF EXISTS `notifiche_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifiche_cliente` (
  `CodNotifica` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(70) NOT NULL,
  `ImgNotifica` blob,
  `Data` datetime NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`CodNotifica`),
  CONSTRAINT `FK_EmailProprietario` FOREIGN KEY (`Email`) REFERENCES `account_clienti` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifiche_cliente`
--

LOCK TABLES `notifiche_cliente` WRITE;
/*!40000 ALTER TABLE `notifiche_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifiche_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifiche_venditore`
--

DROP TABLE IF EXISTS `notifiche_venditore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifiche_venditore` (
  `CodNotifica` int NOT NULL AUTO_INCREMENT,
  `TitoloNotifica` varchar(70) NOT NULL,
  `ImgNotifica` blob,
  `Data` date NOT NULL,
  `CodVenditore` int NOT NULL,
  PRIMARY KEY (`CodNotifica`),
  CONSTRAINT `FK_CodProprietario` FOREIGN KEY (`CodVenditore`) REFERENCES `venditori` (`CodVenditore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifiche_venditore`
--

LOCK TABLES `notifiche_venditore` WRITE;
/*!40000 ALTER TABLE `notifiche_venditore` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifiche_venditore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordini`
--

DROP TABLE IF EXISTS `ordini`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordini`
--

LOCK TABLES `ordini` WRITE;
/*!40000 ALTER TABLE `ordini` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordini` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodotti`
--

DROP TABLE IF EXISTS `prodotti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prodotti` (
  `CodProdotto` int NOT NULL AUTO_INCREMENT,
  `NomeModello` varchar(50) NOT NULL,
  `Descrizione` varchar(150) NOT NULL,
  `BreveDescrizione` varchar(60) NOT NULL,
  `Img` blob,
  `PrezzoUnitarioDiVendita` decimal(8,2) NOT NULL,
  `Sconto` int DEFAULT NULL,
  `QtaInMagazzino` int NOT NULL,
  `MaxQtaMagazzino` int NOT NULL,
  `InVendita` tinyint(1) NOT NULL,
  `CodCategoria` int NOT NULL,
  `CodFornitore` int NOT NULL,
  PRIMARY KEY (`CodProdotto`),
  CONSTRAINT `FK_CodCategoria` FOREIGN KEY (`CodCategoria`) REFERENCES `categorie` (`CodCategoria`),
  CONSTRAINT `FK_CodFornitore` FOREIGN KEY (`CodFornitore`) REFERENCES `venditori` (`CodVenditore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotti`
--

LOCK TABLES `prodotti` WRITE;
/*!40000 ALTER TABLE `prodotti` DISABLE KEYS */;
/*!40000 ALTER TABLE `prodotti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stati_ordine`
--

DROP TABLE IF EXISTS `stati_ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stati_ordine` (
  `CodStato` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  PRIMARY KEY (`CodStato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stati_ordine`
--

LOCK TABLES `stati_ordine` WRITE;
/*!40000 ALTER TABLE `stati_ordine` DISABLE KEYS */;
INSERT INTO `stati_ordine` VALUES (1,'ordinato'),(2,'spedito'),(3,'in consegna'),(4,'consegnato');
/*!40000 ALTER TABLE `stati_ordine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stato_attuale_ordine`
--

DROP TABLE IF EXISTS `stato_attuale_ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stato_attuale_ordine` (
  `CodOrdine` int NOT NULL,
  `CodStato` int NOT NULL,
  `Data` datetime NOT NULL,
  PRIMARY KEY (`CodOrdine`),
  CONSTRAINT `FK_Ordine` FOREIGN KEY (`CodOrdine`) REFERENCES `ordini` (`CodOrdine`),
  CONSTRAINT `FK_Stato` FOREIGN KEY (`CodStato`) REFERENCES `stati_ordine` (`CodStato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stato_attuale_ordine`
--

LOCK TABLES `stato_attuale_ordine` WRITE;
/*!40000 ALTER TABLE `stato_attuale_ordine` DISABLE KEYS */;
/*!40000 ALTER TABLE `stato_attuale_ordine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venditori`
--

DROP TABLE IF EXISTS `venditori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venditori`
--

LOCK TABLES `venditori` WRITE;
/*!40000 ALTER TABLE `venditori` DISABLE KEYS */;
/*!40000 ALTER TABLE `venditori` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-21 12:49:20

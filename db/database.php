<?php

class DatabaseHelper
{

    private $db;

    public function __construct($servername, $email, $password, $dbname, $port = 3306)
    {
        $this->db = new mysqli($servername, $email, $password, $dbname, $port);
        if ($this->db->connect_error) {
            ('Connect failed: ' . $this->db->connect_error);
        }
    }

    public function getCategories()
    {
        $query = "SELECT CodCategoria, ImgPath, Nome as NomeCategoria, ColoreCategoria FROM categorie";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($id)
    {
        $query = "SELECT Nome as NomeCategoria, ColoreCategoria FROM categorie WHERE CodCategoria = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByCategory($idcategory)
    {
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, p.ImgPath FROM prodotti p, categorie c WHERE p.InVendita = true AND c.CodCategoria = ? AND c.CodCategoria = p.CodCategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idcategory);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomDiscountedProduct($n)
    {
        $query = "SELECT CodProdotto, NomeProdotto, Sconto, ImgPath FROM prodotti WHERE InVendita = true AND Sconto!=0 ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomProduct($n)
    {
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, ImgPath FROM prodotti WHERE InVendita = true ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id)
    {
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, ImgPath, Descrizione, QtaInMagazzino, MaxQtaMagazzino, c.Nome as NomeCategoria, NomeCompagnia as Fornitore FROM prodotti p, categorie c, venditori v WHERE CodProdotto = ? ANDp.CodCategoria = c.CodCategoria, AND p.CodFornitore = v.CodVenditore";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getPrdotuctBySeller($sellerid)
    {
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, ImgPath, BreveDescrizione FROM prodotti p, venditori v WHERE v.CodVenditore = ? AND v.CodVenditore = p.CodFornitore";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $sellerid);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByName($name)
    {
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, ImgPath, Nome as NomeCategoria, NomeCompagnia FROM prodotti p, venditori v, categorie c WHERE NomeProdotto = ? AND InVendita = true AND p.CodFornitore = v.CodVenditore AND p.CodCategoria = c.CodCategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function checkUserLogin($email)
    {
        $query = "SELECT Email, Password FROM account_clienti WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkCompanyLogin($email)
    {
        $query = "SELECT Email, Password FROM venditori WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNewUser($nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $psw, $codcarta, $nome_intestatario, $data_scadenza)
    {
        $query = "INSERT INTO carte_pagamento values(?,?,?) ON DUPLICATE KEY UPDATE NomeCompletoIntestatario = ?, DataScadenza = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issss', $codcarta, $nome_intestatario, $data_scadenza, $nome_intestatario, $data_scadenza);
        if ($stmt->execute()) {
            $query = "INSERT INTO account_clienti VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sisssisssi', $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $psw, $codcarta);
            return $stmt->execute();
        }
        return false;
    }

    public function insertNewCompany($nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $psw)
    {
        $query = "INSERT INTO venditori VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('siisssisss', $nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $psw);
        return $stmt->execute();
    }

    public function getUserInfo($email)
    {
        $query = "SELECT NomeCompleto, NumeroTelefono, Ind_Via, CONCAT_WS(' ', Ind_Citta, Ind_Provincia, Ind_CAP) as Ind_Citta, Ind_Paese, RIGHT(a.CodCarta,4) as CodCarta, NomeCompletoIntestatario, DataScadenza, (SELECT GROUP_CONCAT(TitoloNotifica,Data) FROM notifiche_cliente n WHERE n.Email = a.Email GROUP BY n.Email) as Notifiche FROM account_clienti a, carte_pagamento c WHERE Email = ? AND a.CodCarta = c.CodCarta";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserCartInfo($email)
    {
        $query = "SELECT c.CodCarta, NomeCompletoIntestatario as NomeIntestatario, DataScadenza FROM account_clienti a, carte_pagamento c WHERE Email = ? AND a.CodCarta = c.CodCarta";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserDeliveryInfo($email)
    {
        $query = "SELECT NomeCompleto, NumeroTelefono, Ind_Via, CONCAT_WS(' ', Ind_Citta, Ind_Provincia, Ind_CAP) as Ind_Citta, Ind_Paese FROM account_clienti WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUserDeliveryInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese)
    {
        $query = "UPDATE account_clienti SET NomeCompleto = ?, NumeroTelefono = ?, Ind_Via = ?, Ind_Citta = ?, Ind_Provincia = ?, Ind_CAP = ?, Ind_Paese = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sisssssi', $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email);
        return $stmt->execute();
    }

    public function updateUserCartInfo($email, $codcarta, $nome, $data_scadenza)
    {
        $query = "INSERT INTO carte_pagamento values(?,?,?) ON DUPLICATE KEY UPDATE NomeCompletoIntestatario = ?, DataScadenza = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issss', $codcarta, $nome, $data_scadenza, $nome, $data_scadenza);
        if ($stmt->execute()) {
            $query = "UPDATE account_clienti SET CodCarta = ? WHERE Email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('is', $codcarta, $email);
            if ($stmt->execute()) {
                $query = "DELETE FROM carte_pagamento WHERE CodCarta NOT IN (SELECT c.CodCarta FROM account_clienti a, carte_pagamento c WHERE c.CodCarta = a.CodCarta)";
                $stmt = $this->db->prepare($query);
                return $stmt->execute();
            }
        }
        return false;
    }

    public function getCompanyInfo($email)
    {
        $query = "SELECT NomeCompagnia, CodVenditore, NumeroTelefono, Ind_Via, CONCAT_WS(' ', Ind_Citta, Ind_Provincia, Ind_CAP) as Ind_Citta, Ind_Paese, (SELECT GROUP_CONCAT(TitoloNotifica,Data) FROM notifiche_venditore n WHERE n.CodVenditore = v.CodVenditore GROUP BY n.CodVenditore) as Notifiche FROM venditori v WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateCompanyInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese)
    {
        $query = "UPDATE venditori SET NomeCompagnia = ?, NumeroTelefono = ?, Ind_Via = ?, Ind_Citta = ?, Ind_Provincia = ?, Ind_CAP = ?, Ind_Paese = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sisssiss', $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email);
        return $stmt->execute();
    }
}

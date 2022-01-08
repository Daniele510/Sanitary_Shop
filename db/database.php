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

    public function checkLogin($email)
    {
        $query = "SELECT Email, Password, NomeCompleto FROM account_clienti WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertUser($nome, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $pass, $codcarta)
    {
        $query = "INSERT IGNORE INTO account_clienti VALUES (?,null,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssisssi', $nome, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $pass, $codcarta);
        return $stmt->execute();
    }
}

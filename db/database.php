<?php

class DatabaseHelper{

    private $db;

    public function __construct($servername, $email, $password, $dbname, $port = 3306){
        $this->db = new mysqli($servername, $email, $password, $dbname, $port);
        if ($this->db->connect_error) {
            ('Connect failed: ' . $this->db->connect_error);
        }
    }

    public function getCategories(){
        $query = "SELECT CodCategoria, ImgPath, Nome as NomeCategoria, ColoreCategoria FROM categorie";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($id){
        $query = "SELECT Nome as NomeCategoria, ColoreCategoria FROM categorie WHERE CodCategoria = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByCategory($idcategory){
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, p.ImgPath, QtaInMagazzino FROM prodotti p, categorie c WHERE p.InVendita = true AND c.CodCategoria = ? AND c.CodCategoria = p.CodCategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idcategory);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomDiscountedProduct($n){
        $query = "SELECT CodProdotto, NomeProdotto, Sconto, ImgPath FROM prodotti WHERE InVendita = true AND Sconto!=0 ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomProduct($n){
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario - (PrezzoUnitario*Sconto/100)) as Prezzo, ImgPath FROM prodotti WHERE InVendita = true ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id, $id_prod){
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario - (PrezzoUnitario * Sconto/100)) as Prezzo, p.ImgPath, Descrizione, QtaInMagazzino, MaxQtaMagazzino, c.Nome as NomeCategoria, CodFornitore, NomeCompagnia as Fornitore FROM prodotti p, categorie c, venditori v WHERE CodProdotto = ? AND p.CodCategoria = c.CodCategoria AND p.CodFornitore = v.CodVenditore AND CodFornitore = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id, $id_prod);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByFilters($filtri, $emailCompany = null){

        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, QtaInMagazzino, p.ImgPath, c.Nome as NomeCategoria, NomeCompagnia, p.CodFornitore FROM prodotti p, venditori v, categorie c WHERE NomeProdotto LIKE '%" . (isset($filtri["NomeProdotto"]) ? $filtri["NomeProdotto"] : "") . "%' AND InVendita = true AND p.CodFornitore = v.CodVenditore AND p.CodCategoria = c.CodCategoria";
        if(isset($emailCompany)){
            $query .= " AND v.Email = '" . $emailCompany . "'";
        }
        $filter = [];
        if(isset($filtri["NomeCompagnia"])){
            foreach($filtri["NomeCompagnia"] as $compagnia){
                array_push($filter, "NomeCompagnia = '" . $compagnia . "'");
            }
        }
        if(isset($filtri["NomeCategoria"])){
            foreach($filtri["NomeCategoria"] as $categoria){
                array_push($filter, "Nome = '" . $categoria . "'");
            }
        }
        if(count($filter)>0){
            $query .= " AND (" . implode(" OR ", $filter) . ")";
        }
        if(isset($filtri["Ordine"]) && strlen($filtri["Ordine"])>0){
            $query .= " ORDER BY " . $filtri["Ordine"];
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);

    }

    public function insertNewProduct($cod, $nome, $descr, $imgPath, $prezzo, $sconto, $maxQta, $email_venditore, $categoria, $inVendita, $codVenditore=null){
        // in caso di errore (chiavi o valori unici duplicati) ritornare falso
        try{
            if(isset($codVenditore)){
                $query = "INSERT INTO prodotti values(?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('issssiiiiis',$cod, $nome, $descr, $imgPath, $prezzo, $sconto, $maxQta, $maxQta, $inVendita, $categoria, $codVenditore);
            } else{
                $query = "INSERT INTO prodotti values(?,?,?,?,?,?,?,?,?,?,(SELECT CodVenditore FROM venditori WHERE Email = ?))";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('issssiiiiis',$cod, $nome, $descr, $imgPath, $prezzo, $sconto, $maxQta, $maxQta, $inVendita, $categoria, $email_venditore);
            }
            $stmt->execute();
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    // TODO: inserire gli attributi che si vogliono modificare
    public function updateProductInfo($cod, $nome, $descr, $imgPath, $prezzo, $sconto, $maxQta, $email_venditore, $categoria, $inVendita){
        // in caso di errore (chiavi o valori unici duplicati) ritornare falso
        $query = "UPDATE prodotti SET() WHERE Email = ?";
        // $stmt = $this->db->prepare($query);
        // $stmt->bind_param('issssiiiiis',$cod, $nome, $descr, $imgPath, $prezzo, $sconto, $maxQta,   $maxQta, $inVendita, $categoria, $email_venditore);
        // return $stmt->execute();
        return false;
    }

    public function checkUserLogin($email){
        $query = "SELECT Email, Password FROM account_clienti WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkCompanyLogin($email){
        $query = "SELECT Email, Password FROM venditori WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNewUser($nome, $num_telefono, $ind_via, $email, $psw, $codcarta, $nome_intestatario, $data_scadenza){
        // in caso di errore (chiavi o valori unici duplicati) termina la funzione ritornando falso
        try{
            $query = "INSERT INTO carte_pagamento values(?,?,?) ON DUPLICATE KEY UPDATE NomeCompletoIntestatario = ?, DataScadenza = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('issss', $codcarta, $nome_intestatario, $data_scadenza, $nome_intestatario, $data_scadenza);
            $stmt->execute();

            $query = "INSERT INTO account_clienti VALUES (?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssi', $nome, $num_telefono, $ind_via, $email, $psw, $codcarta);
            return $stmt->execute();
        }catch (Exception $e){
            return false;
        }
    }

    public function insertNewCompany($nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $psw){
        // in caso di errore (chiavi o valori unici duplicati) ritornare falso
        try{
            $query = "INSERT INTO venditori VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssssisss', $nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email, $psw);
            $stmt->execute();
            return true;
        } catch(Exception $e){
            return [false,$e];
        }
    }

    public function getUserInfo($email){
        $query = "SELECT NomeCompleto, NumeroTelefono, IndirizzoSpedizione, a.CodCarta, NomeCompletoIntestatario, MONTH(DataScadenza) as MeseScadenza, YEAR(DataScadenza) as AnnoScadenza, (SELECT GROUP_CONCAT(TitoloNotifica, Data, CodOrdine) FROM notifiche_cliente n WHERE n.Email = a.Email AND Attiva = true ORDER BY CodNotifica DESC) as Notifiche FROM account_clienti a, carte_pagamento c WHERE Email = ? AND a.CodCarta = c.CodCarta";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserNotificationCount($email){
        $query = "SELECT COUNT(*) as NumeroNotifiche FROM notifiche_cliente WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUserDeliveryInfo($email, $nome, $num_telefono, $ind_via){
        
        $query = "UPDATE account_clienti SET NomeCompleto = ?, NumeroTelefono = ?, IndirizzoSpedizione = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $nome, $num_telefono, $ind_via, $email);
        return $stmt->execute();
    }

    public function updateUserCartInfo($email, $codcarta, $nome, $data_scadenza){
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

    public function getCompanyInfo($email){
        $query = "SELECT NomeCompagnia, CodVenditore, NumeroTelefono, Ind_Via, CONCAT_WS(' ', Ind_Citta, Ind_Provincia, Ind_CAP) as Ind_Citta, Ind_Paese, (SELECT GROUP_CONCAT(TitoloNotifica,Data) FROM notifiche_venditore n WHERE n.CodVenditore = v.CodVenditore GROUP BY n.CodVenditore) as Notifiche FROM venditori v WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateCompanyInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese){
        $query = "UPDATE venditori SET NomeCompagnia = ?, NumeroTelefono = ?, Ind_Via = ?, Ind_Citta = ?, Ind_Provincia = ?, Ind_CAP = ?, Ind_Paese = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiss', $nome, $num_telefono, $ind_via, $ind_citta, $ind_prov, $ind_cap, $ind_paese, $email);
        return $stmt->execute();
    }

}

?>

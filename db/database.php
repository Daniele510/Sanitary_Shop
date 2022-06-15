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
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, PrezzoUnitario, p.ImgPath, QtaInMagazzino, CodFornitore FROM prodotti p, categorie c WHERE p.InVendita = true AND c.CodCategoria = ? AND c.CodCategoria = p.CodCategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idcategory);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomDiscountedProduct($n){
        $query = "SELECT CodProdotto, NomeProdotto, Sconto, ImgPath, CodFornitore FROM prodotti WHERE InVendita = true AND Sconto!=0 ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomProduct($n){
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario - (PrezzoUnitario*Sconto/100)) as Prezzo, ImgPath, CodFornitore FROM prodotti WHERE InVendita = true ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id, $id_prod, $email_venditore = null){
        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario - (PrezzoUnitario * Sconto/100)) as Prezzo, PrezzoUnitario, Sconto, p.ImgPath, Descrizione, QtaInMagazzino, MaxQtaMagazzino, InVendita, c.Nome as NomeCategoria, p.CodCategoria, CodFornitore, NomeCompagnia as Fornitore, v.NumeroTelefono, v.Email FROM prodotti p, categorie c, venditori v WHERE CodProdotto = ? AND p.CodCategoria = c.CodCategoria AND p.CodFornitore = v.CodVenditore";
        if(!empty($email_venditore)){
            $query .= " AND v.Email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('is', $id, $email_venditore);
        } else {
            $query .= " AND p.CodFornitore = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('is', $id, $id_prod);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByFilters($filtri, $emailCompany = null){

        $query = "SELECT CodProdotto, NomeProdotto, (PrezzoUnitario-(PrezzoUnitario*Sconto/100)) as Prezzo, PrezzoUnitario, QtaInMagazzino, p.ImgPath, c.Nome as NomeCategoria, NomeCompagnia, p.CodFornitore FROM prodotti p, venditori v, categorie c WHERE p.CodFornitore = v.CodVenditore AND p.CodCategoria = c.CodCategoria";

        // estendo la query aggiungendo delle clausole in AND in base ai filtri, e ciascuno aggiungo la sua tipologia e il suo valore a due array per fare infine il bind dei parametri della query
        $param["types"] = [];
        $param["values"] = [];
        if(isset($filtri["NomeProdotto"]) && strlen($filtri["NomeProdotto"])>0){
            $query .= " AND NomeProdotto LIKE CONCAT(?,'%')";
            array_push($param["types"], 's');
            array_push($param["values"], $filtri["NomeProdotto"]);
        }
        if(isset($emailCompany) && strlen($emailCompany)>0){
            $query .= " AND v.Email = ?";
            array_push($param["types"],'s');
            array_push($param["values"], $emailCompany);
        } else {
            $query .= " AND InVendita = true";
        }
        if(isset($filtri["IDCompagnia"]) && strlen($filtri["IDCompagnia"])>0){
            $query .= " AND v.CodVenditore = ?";
            array_push($param["types"], 's');
            array_push($param["values"], $filtri["IDCompagnia"]);
        }
        $filterCompany = [];
        if(isset($filtri["NomeCompagnia"])){
            foreach($filtri["NomeCompagnia"] as $compagnia){
                if(strlen($compagnia)>0){
                    array_push($filterCompany, "NomeCompagnia = ?");
                    array_push($param["types"], 's');
                    array_push($param["values"], $compagnia);
                }
            }
        }
        $filterCategory = [];
        if(isset($filtri["NomeCategoria"])){
            foreach($filtri["NomeCategoria"] as $categoria){
                if(strlen($categoria)>0){
                    array_push($filterCategory, "Nome = ?");
                    array_push($param["types"], 's');
                    array_push($param["values"], $categoria);
                }
            }
        }
        if(count($filterCompany)>0){
            $query .= " AND (" . implode(" OR ", $filterCompany) . ")";
        }
        if(count($filterCategory)>0){
            $query .= " AND (" . implode(" OR ", $filterCategory) . ")";
        }
        if(isset($filtri["Ordine"]) && strlen($filtri["Ordine"])>0){
            $query .= " ORDER BY " . $filtri["Ordine"];
        }
        $stmt = $this->db->prepare($query);
        if (count($param["types"]) == count($param["values"]) && count($param["types"]) > 0){
            $stmt->bind_param(implode($param["types"]), ...$param["values"]);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductIDInOrder(int $orderID) {
        $query = "SELECT CodProdotto FROM dettaglio_ordini WHERE CodOrdine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $orderID);
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

    public function updateProductInfo($cod, $descr, $imgPath, $prezzo, $sconto, $maxQta, $email_venditore, $inVendita){
        if(empty($imgPath)){
            $query = "UPDATE prodotti SET(Descrizione = ?, PrezzoUnitario = ?, Sconto = ?, MaxQtaMagazzino = ?, InVendita = ?) FROM prodotti p, venditori v WHERE v.Email = ? AND p.CodFornitore = v.CodVenditore";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('isiiiis', $cod, $descr, $prezzo, $sconto, $maxQta, $inVendita, $email_venditore);
        } else {
            $query = "UPDATE prodotti SET(Descrizione = ?, ImgPath = ?, PrezzoUnitario = ?, Sconto = ?, MaxQtaMagazzino = ?, InVendita = ?) FROM prodotti p, venditori v WHERE v.Email = ? AND p.CodFornitore = v.CodVenditore";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('issiiiis', $cod, $descr, $imgPath, $prezzo, $sconto, $maxQta, $inVendita, $email_venditore);
        }
        return $stmt->execute();
    }

    public function sendUserProductNotification($productID, $email_company, $type) {
        $clienti = "SELECT c.Email FROM carrello c, venditori v WHERE CodProdotto = ? AND v.Email = ? AND c.CodFornitore = v.CodVenditore";
        $stmt = $this->db->prepare($clienti);
        $stmt->bind_param('is', $productID, $email_company);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);

        $notifica = "INSERT INTO notifiche_cliente (TitoloNotifica, DescrizioneNotifica, Data, Email, CodProdotto, CodFornitore) VALUES(?, ?, NOW(), ?, ?, (SELECT CodVenditore FROM venditori WHERE Email = ?))";
        $stmt1 = $this->db->prepare($notifica);

        if(!empty($result)){
            foreach ($result["Email"] as $email) {
                if($type == "refill"){
                    $titolo = "Prodotto " . $productID . " di nuovo disponibile";
                    $descrizione = "Salve il prodotto " . $productID . " è di nuovo disponibile, affrettati per non fartelo scappare";
                } else if($type == "discount"){
                    $titolo = "Prodotto " . $productID . " ha ricevuto uno sconto del " . " , non perderlo";
                    $descrizione = "Salve il prodotto " . $productID . " ha ricevuto uno sconto del" . " , affrettati per non fartelo scappare";
                }
                // TODO: da scommentare se si vuole inviare anche email
                // mail($email, $titolo, $descrizione);
    
                $stmt1->bind_param("sssis", $titolo, $descrizione, $email, $productID, $email);
                $stmt1->execute();
            }
        }
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
        } catch (Exception $e){
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
        $query = "SELECT NomeCompleto, NumeroTelefono, IndirizzoSpedizione, a.CodCarta, NomeCompletoIntestatario, MONTH(DataScadenza) as MeseScadenza, YEAR(DataScadenza) as AnnoScadenza FROM account_clienti a, carte_pagamento c WHERE Email = ? AND a.CodCarta = c.CodCarta";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPreviewUserNotification($email, $all=false){
        $query = "SELECT TitoloNotifica, Data, CodOrdine, p.ImgPath FROM notifiche_cliente n, prodotti p WHERE n.Email = ? AND p.CodProdotto = n.CodProdotto";
        if (!$all) {
            $query .= " AND Attiva = true ORDER BY Data DESC";
        } else {
            $query .= " ORDER BY Data DESC";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserNotificationCount($email){
        $query = "SELECT COUNT(*) as NumeroNotifiche FROM notifiche_cliente WHERE Email = ? AND Attiva = true";
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

    public function updateUserCardInfo($email, $codcarta, $nome, $data_scadenza){
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

    public function getCompanyStats($company_email){
        // selezione num totale ordini
        $ordini = "SELECT COUNT(CodFornitore) as TotOrdini, SUM(Qta) as TotUnita, SUM(Qta*PrezzoVendita) as TotGuadagno FROM venditori v, dettaglio_ordini d WHERE v.Email = ? AND d.CodFornitore = v.CodVenditore";

        $stmt = $this->db->prepare($ordini);
        $stmt->bind_param('s', $company_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $totOrdini = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCompanyInfo($email){
        $query = "SELECT NomeCompagnia, CodVenditore, NumeroTelefono, Ind_Via, CONCAT_WS(' ', Ind_Citta, Ind_Provincia, Ind_CAP) AS Ind_Citta, Ind_Paese, Email FROM venditori v WHERE Email = ?";
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

    public function getPreviewCompanyNotification($email, $all=false){
        $query = "SELECT TitoloNotifica, Data, p.CodProdotto, p.ImgPath  FROM notifiche_venditore n, venditori v, prodotti p WHERE n.CodVenditore = v.CodVenditore AND Email = ? AND p.CodProdotto = n.CodProdotto";
        if (!$all) {
            $query .= " AND Attiva = true ORDER BY Data DESC";
        } else {
            $query .= " ORDER BY Data DESC";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCompanyNotificationCount($email){
        $query = "SELECT COUNT(*) as NumeroNotifiche FROM notifiche_venditore n, venditori v WHERE n.CodVenditore = v.CodVenditore AND Email = ? AND Attiva = true";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderStates(){
        $query = "SELECT CodStato FROM stati_ordine";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderUser($orderID){
        $query = "SELECT Email FROM ordini WHERE CodOrdine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $orderID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateOrderStateAndSendNotificationToUser($orderID, $stateID, $productID){
        $query = "SELECT CodStato FROM stato_attuale_ordine WHERE CodOrdine = ? AND CodProdotto = ? ORDER BY CodStato DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $orderID, $productID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        try{
            if (count($result)>0) {
                if (!in_array($stateID, $result) && ($stateID == reset($result) + 1)) {
                    // aggiornamento stato (inserimento in stato_attuale_ordine oppure update ordine)
                    $query = "INSERT INTO stato_attuale_ordine VALUES(?, ?, ? , NOW())";
                    $stmt = $this->db->prepare($query);
                    $stmt->bind_param('iii', $orderID, $productID, $stateID);
                     $stmt->execute();
                } else{
                    // se lo stato esiste già o si cerca di inserire uno stato non contiguo per l'ordine sotto osservazione ritorno false in modo da non inviare l'email all'utente
                    return false;
                }
            } else{
                // inserimento con stato ordine = 1 (ordinato)
                $query = "INSERT INTO stato_attuale_ordine VALUES(?, ?, ? , NOW())";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('iii', $orderID, $productID, 1);
            }
            // creazione notifica cliente
            $query = "INSERT INTO notifiche_cliente(TitoloNotifica, DescrizioneNotifica, Data, Email, CodOrdine, CodProdotto, Attiva) VALUES(?, CONCAT(?,(SELECT Nome FROM stati_ordine WHERE CodStato = ?)), NOW(),(SELECT Email FROM ordini WHERE CodOrdine = ?), ?, ?, true)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssiiii', "Stato del prodotto" . $productID . " appartenente all'ordine n°" . $orderID, "Salve lo stato del tuo ordine è: ", $stateID, $orderID, $orderID, $productID);
            return $stmt->execute();
        } catch (Exception $e){
            return false;
        }
    } 
    
    //Inserimento o aggiornamento di un prodotto nel carrello
    public function updateCartUserInfo($email, $id_prod, $id_forn, $quantità) {
        $query = "INSERT INTO carrello VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE Qta = Qta + ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sisi', $email, $id_prod, $id_forn, $quantità);
        return $stmt->execute();
    }
}

?>

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
        $query = "SELECT NomeCompleto, NumeroTelefono, IndirizzoSpedizione, a.CodCarta, NomeCompletoIntestatario, MONTH(DataScadenza) as MeseScadenza, YEAR(DataScadenza) as AnnoScadenza, DataScadenza FROM account_clienti a, carte_pagamento c WHERE Email = ? AND a.CodCarta = c.CodCarta";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
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
        $stmt->bind_param('sisii', $email, $id_prod, $id_forn, $quantità, $quantità);
        return $stmt->execute();
    }

    public function updateProductQuantity($email, $id_prod, $id_forn, $quantità) {
        $query = "UPDATE carrello SET Qta = ? where CodProdotto = ?  and CodFornitore = ? and Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iiss', $quantità, $id_prod, $id_forn, $email );
        return $stmt->execute();
    }

    public function getProductsFromUserCart($email) {
        $query = "SELECT c.CodProdotto, NomeProdotto, Qta, (PrezzoUnitario - (PrezzoUnitario * Sconto/100)) as Prezzo, PrezzoUnitario, QtaInMagazzino, MaxQtaMagazzino, p.ImgPath, c.CodFornitore FROM prodotti p, carrello c WHERE p.CodProdotto = c.CodProdotto AND p.CodFornitore = c.CodFornitore AND Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserCartInfo($email) {
        $query ="SELECT COUNT(*) as NumArticoli, ROUND(SUM(Qta*(PrezzoUnitario - (PrezzoUnitario * Sconto/100))),2) as Totale FROM prodotti p, carrello c WHERE p.CodProdotto = c.CodProdotto AND p.CodFornitore = c.CodFornitore AND Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductSellStats($id_prod, $email, $type, $last){
        $period = "";
        $group = "";
        switch ($type) {
            case 'week':
                $period = "DATE_ADD(NOW(), INTERVAL -(?-1) WEEK) AND NOW()";
                $group = " GROUP BY WEEK(Date)";
                break;
            case 'month':
                $period = "DATE_ADD(NOW(), INTERVAL -(?-1) MONTH) AND NOW()";
                $group = "GROUP BY MONTH(Date)";
                break;
            case 'year':
                $period = "DATE_ADD(NOW(), INTERVAL -(?-1) YEAR) AND NOW()";
                $group = "GROUP BY YEAR(Date) ORDER BY Date DESC";
                break;
            default:
                $period = "DATE_ADD(NOW(), INTERVAL -(?-1) DAY) AND NOW()";
                $group = " GROUP BY DAY(Date)";
                break;
        }
    
        $query = "SELECT SUM(CASE WHEN prodotti.NumProdottiVenduti IS NULL THEN 0 ELSE prodotti.NumProdottiVenduti END) NumProdottiVenduti, giorni.Date FROM
    
        (SELECT SUM(Qta) as NumProdottiVenduti, CAST(DataOrdine as Date) as DataOrdine FROM dettaglio_ordini d, ordini o WHERE CodProdotto = ? AND CodFornitore = (SELECT CodVenditore FROM venditori WHERE Email = ?) AND d.CodOrdine = o.CodOrdine) prodotti
        
        RIGHT JOIN
    
        (select CAST(a.Date as Date) Date from (
            select NOW() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
            from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 		union all select 6 union all select 7 union all select 8 union all select 9) as a
            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all 		select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all 		select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
        ) a where a.Date between " . $period . " order by a.Date) giorni ON (prodotti.DataOrdine = giorni.Date) 
        " . $group;
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isi', $id_prod, $email, $last);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPreviewUserNotification($email, $all=false, $time = null){

        $query = "SELECT CodNotifica, TitoloNotifica, Data, CodOrdine, p.ImgPath FROM notifiche_cliente n, prodotti p WHERE n.Email = ? AND p.CodProdotto = n.CodProdotto AND p.CodFornitore = n.CodFornitore";
        if(!empty($time)){
            $query .= " AND Data BETWEEN DATE_ADD(NOW(), INTERVAL -? SECOND) AND NOW()";
        } else {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $email);
        }
        if (!$all) {
            $query .= " AND Attiva = true ORDER BY Data DESC";
        } else {
            $query .= " ORDER BY Data DESC";
        }
        if(!empty($time)){
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sd', $email, $time);
        } else {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$email);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserNotificationByID($codNotifica, $email){
        $query = "SELECT DescrizioneNotifica, TitoloNotifica, Data, CodOrdine, CodProdotto, CodFornitore FROM notifiche_cliente WHERE Email = ? AND CodNotifica = ?";

        $query1 = "UPDATE notifiche_cliente SET Attiva = false WHERE Email = ? AND CodNotifica = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$email, $codNotifica);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt1 = $this->db->prepare($query1);
        $stmt1->bind_param('si',$email, $codNotifica);
        $stmt1->execute();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPreviewCompanyNotification($email, $all=false, $time = null){

        $query = "SELECT CodNotifica, TitoloNotifica, Data, p.CodProdotto, p.ImgPath  FROM notifiche_venditore n, venditori v, prodotti p WHERE Email = ? AND n.CodVenditore = v.CodVenditore AND p.CodProdotto = n.CodProdotto AND p.CodFornitore = v.CodVenditore";

        if(!empty($time)){
            $query .= " AND Data BETWEEN DATE_ADD(NOW(), INTERVAL -? SECOND) AND NOW()";   
        }
        if (!$all) {
            $query .= " AND Attiva = true ORDER BY Data DESC";
        } else {
            $query .= " ORDER BY Data DESC";
        }
        if(!empty($time)){
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sd', $email, $time);
        } else{
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $email);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCompanyNotificationByID($codNotifica, $email){

        $query = "SELECT DescrizioneNotifica, TitoloNotifica, Data, p.CodProdotto, NomeProdotto FROM notifiche_venditore n, prodotti p, venditori v WHERE v.Email = ? AND CodNotifica = ? AND v.CodVenditore = n.CodVenditore AND n.CodProdotto = p.CodProdotto AND v.CodVenditore = p.CodFornitore";

        $query1 = "UPDATE notifiche_venditore SET Attiva = false WHERE CodVenditore  = (SELECT CodVenditore FROM venditori WHERE Email = ?) AND CodNotifica = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$email, $codNotifica);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt1 = $this->db->prepare($query1);
        $stmt1->bind_param('si',$email, $codNotifica);
        $stmt1->execute();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPreviewUserOrders($email, $time = null) {
        $query = "SELECT CodOrdine, DataOrdine FROM ordini WHERE Email = ?";
        if(!empty($time)){
            $query .= " AND DataOrdine BETWEEN DATE_ADD(NOW(), INTERVAL -? SECOND) AND NOW()";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sd', $email, $time);
        } else{
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $email);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductAndStatesInOrderByID($codProdotto, $codFornitore, $codOrdine) {
        $query1 = "SELECT Nome as NomeStato, Data FROM stato_attuale_ordine sa, stati_ordine s WHERE CodOrdine = ? AND CodProdotto = ? AND CodFornitore = ? AND s.CodStato = sa.CodStato";
        $stmt = $this->db->prepare($query1);
        $stmt->bind_param('iis', $codOrdine, $codProdotto, $codFornitore);
        $stmt->execute();
        $result1 = $stmt->get_result();

        $query = "SELECT p.NomeProdotto, p.ImgPath, NomeCompagnia as Fornitore, c.Nome as NomeCategoria FROM dettaglio_ordini d, prodotti p, categorie c, ordini o, venditori v WHERE o.CodOrdine = ? AND p.CodProdotto = ? AND p.CodFornitore = ? AND o.CodOrdine = d.CodOrdine  AND p.CodProdotto = d.CodProdotto AND p.CodFornitore = d.CodFornitore AND v.CodVenditore = p.CodFornitore AND c.CodCategoria = p.CodCategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iis', $codOrdine, $codProdotto, $codFornitore);
        $stmt->execute();
        $result = $stmt->get_result();
        return ["prodotto" => $result->fetch_all(MYSQLI_ASSOC), "stati" => $result1->fetch_all(MYSQLI_ASSOC)];
    }

    public function getOrder($orderID){
        $query = "SELECT Email, DataOrdine, ImportoTotale as ImportoFinale, ScontoTotale, IndirizzoConsegna, CodCarta, NomeCompletoIntestatario, MONTH(DataScadenza) as MeseScadenza, YEAR(DataScadenza) as AnnoScadenza FROM ordini WHERE CodOrdine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $orderID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderDetails($codOrdine){

        $order = $this->getOrder($codOrdine);
        if(!empty($order)){
            
            $query = "SELECT d.CodProdotto, d.CodFornitore, Qta, PrezzoVendita, ImgPath, NomeProdotto FROM dettaglio_ordini d, prodotti p WHERE CodOrdine = ? AND d.CodProdotto = p.CodProdotto AND d.CodFornitore = p.CodFornitore";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $codOrdine);
            $stmt->execute();
            $result = $stmt->get_result();
            return ["lista-prodotti" => $result->fetch_all(MYSQLI_ASSOC), "dettagli-ordine" => $order[0]];
        }

        return [];
    }

    public function createOrder($array, $email, $prezzoSenzaSconto, $sconto) {
        try{
        $user = $this->getUserInfo($email)[0];
        $prezzoSenzaSconto = (string)$prezzoSenzaSconto;
        $sconto = (string)$sconto;
        $indirizzoConsegna = $user["IndirizzoSpedizione"];
        $codCarta = $user["CodCarta"];
        $nome = $user["NomeCompletoIntestatario"];
        $dataScadenza = $user["DataScadenza"];
        
        $query2= "SELECT CodOrdine from ordini order by CodOrdine desc limit 1";
        $stmt = $this->db->prepare($query2);
        $stmt->execute();
        $result = $stmt->get_result();
        $codOrder = $result->fetch_all(MYSQLI_ASSOC);
        if(!empty($codOrder)){
            $codOrder = $codOrder[0]["CodOrdine"] + 1;
        }else{
            $codOrder = 1;
        }

        $query="INSERT into ordini (CodOrdine, DataOrdine, ImportoTotale, ScontoTotale, Email, IndirizzoConsegna, CodCarta, NomeCompletoIntestatario, DataScadenza) values (?,now(),?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isssssss", $codOrder, $prezzoSenzaSconto, $sconto, $email, $indirizzoConsegna, $codCarta, $nome, $dataScadenza);
        if(!$stmt->execute()){
            return;
        }

        $updateQty="UPDATE prodotti SET QtaInMagazzino = QtaInMagazzino- ? where CodProdotto = ?  and CodFornitore = ?";
        $update= $this->db->prepare($updateQty);
        
        $insertDet="INSERT into (CodOrdine, CodFornitore, CodProdotto, Qta, PrezzoVendita) values (?,?,?,?,?) ON DUPLICATE KEY UPDATE Qta = ?";
        $insert=$this->db->prepare($insertDet);

        $qtaMagazzino = "SELECT QtaInMagazzino, v.Email FROM prodotti p, venditori v WHERE CodProdotto = ? AND p.CodFornitore = ? AND p.CodFornitore = v.CodVenditore";
        $stmt2 = $this->db->prepare($qtaMagazzino);
        
        $insertNotification="INSERT into notifiche_venditore (CodNotifica, TitoloNotifica, DescrizioneNotifica, CodProdotto, Data, CodVenditore) values ((SELECT CodNotifica from notifiche_veditore order by CodNotifica desc limit 1),?,?,?,now(),?)";
        $notificaton=$this->db->prepare($insertNotification);

        foreach($array as $value){
            $codProdotto = $value["CodProdotto"];
            $codFornitore = $value["CodFornitore"];
            $Qta = $value["Qta"];
            $Prezzo = $value["Prezzo"];

            $insert->bind_param("isiisi",$codOrder, $codFornitore, $codProdotto, $Qta, $Prezzo, $Qta);
            $insert->execute();

            $update->bind_param("iis", $Qta, $codProdotto, $codFornitore);
            $update->execute();

            $stmt2->bind_param("is", $codProdotto, $codFor);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $magazzino = $result->fetch_all(MYSQLI_ASSOC);

            if(!empty($magazzino) && $magazzino[0]["QtaInMagazzino"] == 0){
                $titolo = "Prodotto ". $codProdotto . " esaurito";
                $descrizione = "Prodotto ". $codProdotto . " esaurito in data:". date("Y-m-d");
                mail($magazzino[0]["Email"], $titolo, $descrizione);
                
                $notificaton->bind_param("ssis",$titolo, $descrizione, $codProdotto, $codVenditore);
                $notificaton->execute();
            }
        }
        return $codOrder;
    }catch(Exception $e){
        return $e;
    }
    }
}

?>

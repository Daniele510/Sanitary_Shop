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
        try{
        if(empty($imgPath)){
            $query = "UPDATE prodotti p JOIN venditori v ON p.CodFornitore = v.CodVenditore SET Descrizione = ?, PrezzoUnitario = ?, Sconto = ?, MaxQtaMagazzino = ?, InVendita = ? WHERE CodProdotto = ? AND v.Email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssiiiis', $descr, $prezzo, $sconto, $maxQta, $inVendita, $cod, $email_venditore);
        } else {
            $query = "UPDATE prodotti p JOIN venditori v ON p.CodFornitore = v.CodVenditore SET Descrizione = ?, ImgPath = ?, PrezzoUnitario = ?, Sconto = ?, MaxQtaMagazzino = ?, InVendita = ? WHERE CodProdotto = ? AND v.Email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssiiiis', $descr, $imgPath, $prezzo, $sconto, $maxQta, $inVendita,  $cod, $email_venditore);
        }
        return $stmt->execute();}
        catch(Exception $e){
            return $e;
        }
    }

    public function refillProduct($cod, $email_venditore) {
        $query = "UPDATE prodotti SET QtaInMagazzino = MaxQtaMagazzino WHERE CodProdotto = ? AND CodFornitore = (SELECT CodVenditore FROM venditori WHERE Email = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $cod, $email_venditore);
        $stmt->execute();
    }

    public function sendUserProductNotification($productID, $email_company, $type) {
        $clienti = "SELECT c.Email FROM carrello c, venditori v WHERE CodProdotto = ? AND v.Email = ? AND c.CodFornitore = v.CodVenditore";
        $stmt = $this->db->prepare($clienti);
        $stmt->bind_param('is', $productID, $email_company);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);

        $prod = $this->getProductById($productID, null, $email_company)[0];

        $notifica = "INSERT INTO notifiche_cliente (TitoloNotifica, DescrizioneNotifica, Data, Email, CodProdotto, CodFornitore, Tipologia) VALUES(?, ?, NOW(), ?, ?, (SELECT CodVenditore FROM venditori WHERE Email = ?), ?)";
        $stmt1 = $this->db->prepare($notifica);

        if(!empty($result)){
            foreach ($result as $value) {
                if($type == "refill"){
                    $titolo = "Prodotto " . $prod["NomeProdotto"] . " di nuovo disponibile";
                    $descrizione = "Salve il prodotto " . $prod["NomeProdotto"] . " ?? di nuovo disponibile, affrettati per non fartelo scappare";
                } else if($type == "discount"){
                    $titolo = "Prodotto " . $prod["NomeProdotto"] . " ha ricevuto uno sconto del " . $prod["Sconto"] . "%, non perderlo";
                    $descrizione = "Salve il prodotto " . $prod["NomeProdotto"] . " ha ricevuto uno sconto del " . $prod["Sconto"] . "%, affrettati per non fartelo scappare";
                }
                
                // mail($value["Email"], $titolo, $descrizione);
    
                $stmt1->bind_param("sssiss", $titolo, $descrizione, $value["Email"], $productID, $email_company, $type);
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
        return $result->fetch_all(MYSQLI_ASSOC);

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

    public function getOrderUser($orderID){
        $query = "SELECT Email FROM ordini WHERE CodOrdine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $orderID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    //Inserimento o aggiornamento di un prodotto nel carrello
    public function updateCartUserInfo($email, $id_prod, $id_forn, $quantit??) {
        $query = "INSERT INTO carrello VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE Qta = Qta + ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sisii', $email, $id_prod, $id_forn, $quantit??, $quantit??);
        return $stmt->execute();
    }

    public function updateProductQuantity($email, $id_prod, $id_forn, $quantit??) {
        $query = "UPDATE carrello SET Qta = ? where CodProdotto = ?  and CodFornitore = ? and Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iiss', $quantit??, $id_prod, $id_forn, $email );
        return $stmt->execute();
    }

    public function deleteProductFromCart($email, $id_prod, $id_forn) {
        $query = "DELETE FROM carrello where CodProdotto = ?  and CodFornitore = ? and Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iss', $id_prod, $id_forn, $email );
        return $stmt->execute();
    }

    public function deleteAllProductsFromCart($email) {
        $query = "DELETE FROM carrello where Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email );
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
    
        (SELECT SUM(Qta) as NumProdottiVenduti, CAST(DataOrdine as Date) as DataOrdine FROM dettaglio_ordini d, ordini o WHERE CodProdotto = ? AND CodFornitore = (SELECT CodVenditore FROM venditori WHERE Email = ?) AND d.CodOrdine = o.CodOrdine GROUP BY CAST(DataOrdine as Date)) prodotti
        
        RIGHT JOIN
    
        (select CAST(a.Date as Date) Date from (
            select NOW() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
            from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 		union all select 6 union all select 7 union all select 8 union all select 9) as a
            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all 		select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all 		select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
        ) a where a.Date between " . $period . " order by a.Date) giorni ON (prodotti.DataOrdine = giorni.Date) 
        " . $group. "ORDER BY giorni.Date";
    
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
            $query .= " AND Attiva = true ORDER BY CodNotifica DESC";
        } else {
            $query .= " ORDER BY CodNotifica DESC";
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
            $query .= " AND Attiva = true ORDER BY Data, CodNotifica DESC";
        } else {
            $query .= " ORDER BY Data, CodNotifica DESC";
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
            $query .= " AND DataOrdine BETWEEN DATE_ADD(NOW(), INTERVAL -? SECOND) AND NOW() ORDER BY DataOrdine DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sd', $email, $time);
        } else{
            $query .= " ORDER BY DataOrdine DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $email);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrder($orderID){
        $query = "SELECT Email, DataOrdine, ImportoTotale as ImportoConSconto, ScontoTotale, IndirizzoConsegna, CodCarta, NomeCompletoIntestatario, MONTH(DataScadenza) as MeseScadenza, YEAR(DataScadenza) as AnnoScadenza FROM ordini WHERE CodOrdine = ?";
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

    public function createOrder($array, $email, $prezzoConSconto, $sconto) {
        try{
            $user = $this->getUserInfo($email)[0];

            $email = $email;
            $prezzoConSconto = (string)$prezzoConSconto;
            $sconto = (string)$sconto;
            $indirizzoConsegna = $user["IndirizzoSpedizione"];
            $codCarta = $user["CodCarta"];
            $nome = $user["NomeCompletoIntestatario"];
            $scadenza = $user["DataScadenza"];

            $query = "SELECT CodOrdine FROM ordini WHERE Email = ? ORDER BY DataOrdine DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $codOrdine = $result[0]["CodOrdine"];

            $codOrdine = empty($codOrdine) ? 1 : $codOrdine + 1;
    
            $query = "INSERT INTO ordini(CodOrdine, DataOrdine, ImportoTotale, ScontoTotale, Email, IndirizzoConsegna, CodCarta, NomeCompletoIntestatario, DataScadenza) VALUES(?,NOW(), ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("isssssss", $codOrdine, $prezzoConSconto, $sconto, $email, $indirizzoConsegna, $codCarta, $nome, $scadenza);
            if(!$stmt->execute()){
                return;
            }

            // inserimento prodotto in dettaglio ordine
            $query = "INSERT INTO dettaglio_ordini(CodProdotto, CodFornitore, CodOrdine, Qta, PrezzoVendita) VALUES(?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE Qta = ?";
            $stmt = $this->db->prepare($query);
    
            // decremento qta in magazzino
            $update_qta = "UPDATE prodotti SET QtaInMagazzino = QtaInMagazzino - ? WHERE CodProdotto =  ? AND CodFornitore = ?";
            $stmt1 = $this->db->prepare($update_qta);
    
            $mail = "SELECT QtaInMagazzino, v.Email FROM prodotti p, venditori v WHERE CodProdotto = ? AND p.CodFornitore = ? AND p.CodFornitore = v.CodVenditore";
            $stmt2 = $this->db->prepare($mail);
    
            $notifica = "INSERT INTO notifiche_venditore (TitoloNotifica, DescrizioneNotifica, CodProdotto, Data, CodVenditore) VALUES(?, ?, ?, NOW(), ?)";
            $stmt3 = $this->db->prepare($notifica);
    
            foreach ($array as $prodotto) {
                $codProdotto = $prodotto["CodProdotto"];
                $codFor = $prodotto["CodFornitore"];
                $qta = $prodotto["Qta"];
                $prezzo = $prodotto["Prezzo"];
    
                $stmt->bind_param("isiisi", $codProdotto, $codFor, $codOrdine, $qta, $prezzo, $qta);
                $stmt->execute();
    
                $stmt1->bind_param("iis", $qta, $codProdotto, $codFor);
                $stmt1->execute();
    
                $stmt2->bind_param("is", $codProdotto, $codFor);
                $stmt2->execute();
                $result = $stmt2->get_result();
                $res = $result->fetch_all(MYSQLI_ASSOC);
    
                if(!empty($res) && $res[0]["QtaInMagazzino"] <= 0){
                    $titolo = "Prodotto ". $codProdotto . " esaurito";
                    $descrizione = "Prodotto ". $codProdotto . " esaurito in data:". date("Y-m-d");
                    // invio della mail e creazione notifica in caso le scorte in magazzino siano finite
                    // mail($result[0]["Email"], "Prodotto " . $codProdotto . " terminato", "Salve il prodotto " . $codProdotto . " ?? terminato in data " . date('Y-m-d'));
    
                    $stmt3->bind_param("ssis", $titolo, $descrizione, $codProdotto, $codFor);
                    $stmt3->execute();
                }
            }
            return $codOrdine;
    }catch(Exception $e){
        return $e;
    }
    }
}

?>

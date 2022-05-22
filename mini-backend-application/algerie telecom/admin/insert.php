<?php
  session_start(); 

    if (!isset($_SESSION['admin']) && $_SESSION['isAdmin'] != 'TRUE') {
        $_SESSION['ERROR'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout']) &&  $_SESSION['isAdmin'] == 'TRUE') {
        session_destroy();
        unset($_SESSION['admin']);
        unset($_SESSION['isAdmin']);
    unset($_SESSION['ADMIN_ID']);
        header("location: login.php");
    }

  $adminID = $_SESSION['ADMIN_ID'];
  unset($_SESSION['ERROR']);
?>

<?php include('db.php'); ?>
<?php 

if(isset($_POST["ajouter-client"])){
/************************   client id fiiiirst */
     $_SESSION["ERROR"] = false;
     $id = 0;
     $id_image = 0;
     $lnom="";
     $lprenom="";
     $lnaissance="";
     $lcarte_national="";
     $laddress="";
     $lemail="";
     $phone="";
     $lpaiement="";
     $lcapaciteFinanciere="";
     $ltypeTravaille="";
     $lusername="";
     $lpassword="";
     $lcreated_at="";
     $lpermission="";
     $limageProfile=0;
     $lidBank=0;
	 $email_auth='';
    /* client */
    $lnom=$_POST['nom'];
    $lprenom=$_POST['prenom'];
    $lnaissance=$_POST['naissance'];
    $lcarte_national=$_POST['carte_national'];
    $laddress=$_POST['address'];
    $lemail=$_POST['email'];
    $lphone=$_POST['phone'];
    $lpaiement="0";
    $lcapaciteFinanciere=$_POST['capaciteFinanciere'];
    $ltypeTravaille=$_POST['typeTravaille'];
	$email_auth=$_POST['auth'];
    /* client account */
    $lusername=$_POST['username'];
    $lpassword=$_POST['password'];    
    $lcreated_at=$_POST['created_at'];
    $lpermission=$_POST['permission'];
    $lidBank=$_POST['idBank'];
    $db_bank = mysqli_connect('localhost', 'root', 'mysql', 'algerieccp');
    $data = array();
    $sql_idbank = "SELECT `numero_check` FROM `bankccp`";
    $racords = mysqli_query($db_bank, $sql_idbank);
    $exsit = 0;
    $dejaExsiter = false;
    if($racords)
    {
        while($row = mysqli_fetch_array($racords))
        {
            $data[] = $row;
        }

        foreach($data as $idbank)
        {
            if($lidBank == $idbank["numero_check"])
            {
                $exsit = 1;
            }
        }
    }
    if($exsit == 0)
    {   
        $_SESSION["ERROR"] = "se compte n'existe plus";
        header("Location: ajouter-client.php");
        
    }else
    {
        $query2 = "SELECT * FROM clientaccount";
        $res = mysqli_query($db, $query2);
        $arr = array();
        if($res && mysqli_num_rows($res) > 0)
        {
            while($row = mysqli_fetch_array($res))
            {
                $arr[] = $row['idBank']; 
            }

            foreach($arr as $bankID)
            {
                echo $bankID." == ".$lidBank;
                if($bankID == $lidBank)
                {
                    $dejaExsiter = true;
                }
            }
        }
    
        if(!$dejaExsiter)
        {
            $lpassword = md5($lpassword);
            //SQL query:
        $sqlClientaccount = "INSERT INTO 
        clientaccount(username,password,created_at,permission,idBank,isReset) 
        VALUES ('$lusername', '$lpassword', '$lcreated_at', '$lpermission', '$lidBank', 'false')";

    $resultsClientAccount = mysqli_query($db, $sqlClientaccount);

    if ($resultsClientAccount) {
        $q = "SELECT id from clientaccount ORDER BY id ASC";
        $ids = mysqli_query($db, $q);
        $id_data = array();
        if($ids)
        {
            while($row = mysqli_fetch_array($ids))
            {
                $id_data [] = $row; 
            }
            $index = count($id_data) - 1;
            $id = (int)$id_data[$index]["id"];
            echo $id_data[$index]["id"];
            $sqlClient = "INSERT INTO 
            clients(id, prenom, nom, naissance, carte_national, address, email, phone, paiement, capaciteFinanciere, typeTravaille,auth) 
            VALUES ('$id','$lprenom', '$lnom', '$lnaissance', '$lcarte_national', '$laddress', '$lemail', '$lphone', '$lpaiement', '$lcapaciteFinanciere', '$ltypeTravaille','$email_auth')";
            $resultsClient = mysqli_query($db, $sqlClient);

            if ($resultsClient) {
        
                if(count($_FILES) > 0) {
                    $db = mysqli_connect("localhost", "root", "mysql", "algerietelecom");
                    if(is_uploaded_file($_FILES['imageProfile']['tmp_name'])) {
                        
                        echo $_FILES['imageProfile']['tmp_name'];

                        $imgData = addslashes(file_get_contents($_FILES['imageProfile']['tmp_name']));
                        $imageProperties = getimageSize($_FILES['imageProfile']['tmp_name']);
                        
                        $sq = "INSERT INTO profile_images(id, imageType ,imageData) 
                        VALUES('$id', '{$imageProperties['mime']}', '{$imgData}')";
                        $current_id = mysqli_query($db, $sq);
                        if($current_id){
                            $get_nombre_client = "SELECT nombreClient FROM statistique";
                            $r_nombre_client = mysqli_query($db, $get_nombre_client);
                            if($r_nombre_client){
                                while($row = mysqli_fetch_array($r_nombre_client)){
                                    $d_nombre_client = $row;
                                }
                                $nombre_client = $d_nombre_client[0]['nombreClient'] + 1;
                                $update_nombre_client = "UPDATE `statistique` SET `nombreClient`='$nombre_client'";
                                $r_update_nombre_client = mysqli_query($db, $update_nombre_client);
                                if($r_update_nombre_client){
                                    header('Location: index.php');
                                    $_SESSION["ERROR"] = false;
                                }else{
                                    echo "Error update nombre client ";
                                }
                            }else{
                                echo "ERROR get nombre client ";
                            }
                        }
                    }
                }
            } else {
            echo "Error 3: " . $sqlClient . "<br>" . mysqli_error($db);
            }

        }else
        {
            echo "Error 2: " . $q . "<br>" . mysqli_error($db);
        }
        
    } else {
    echo "Error 1: " . $resultsClientAccount . "<br>" . mysqli_error($db);
    }
        }else
        {
            $_SESSION["ERROR"] = "se compte deja exsiter dans la base des donneés";
            header("Location: ajouter-client.php");
        }}

}


if(isset($_POST["ajouter-product"])){

    $p_type = "";
    $p_nature = "";
    $p_nom = "";
    $p_prix = "";
    $p_description = "";
    $p_idphoto = "";
    $p_totalreveue = '0';
    $p_nombretotal = 0;
    $p_quantite = 0;
    $p_n_achats = 0;

    $p_type = $_POST['type'];
    $p_nature = $_POST['nature'];
    $p_nom = $_POST['nom'];
    $p_prix = $_POST['prix'];
    $p_description = $_POST['description'];
   
 

    //SQL query:
    $p_sqlProduct = "INSERT INTO
     `produits`(`nom`, `nature`, `description`, `type`, `totalreveue`, `nombretotal`, `quantite`, `n_achats`, `prix`) 
     VALUES ('$p_nom','$p_nature','$p_description','$p_type','$p_totalreveue','$p_nombretotal','$p_quantite','$p_n_achats','$p_prix')";

    $p_resultsProduvt = mysqli_query($db, $p_sqlProduct);

    if ($p_resultsProduvt) {
    
        $q = "SELECT id from produits ORDER BY id ASC";
        $ids = mysqli_query($db, $q);
        $id_data = array();
        if($ids)
        {
            while($row = mysqli_fetch_array($ids))
            {
                $id_data [] = $row; 
            }
            $index = count($id_data) - 1;
            $id = (int)$id_data[$index]["id"];
            echo $id_data[$index]["id"];

            if(count($_FILES) > 0) {

                if(is_uploaded_file($_FILES['idphoto']['tmp_name'])) {
                    echo $_FILES['idphoto']['tmp_name'];
    
                    $p_imgData = addslashes(file_get_contents($_FILES['idphoto']['tmp_name']));
                    $p_imageProperties = getimageSize($_FILES['idphoto']['tmp_name']);
                    
                    $sq = "INSERT INTO output_images(id, imageType ,imageData) 
                    VALUES('$id', '{$p_imageProperties['mime']}', '{$p_imgData}')";
                    $current_id = mysqli_query($db, $sq);
                    if($current_id){
                        $get_nombre_produit = "SELECT nombreProduit FROM statistique";
                        $r_nombre_produit = mysqli_query($db, $get_nombre_produit);
                        if($r_nombre_produit){
                            while($row = mysqli_fetch_array($r_nombre_produit)){
                                $d_nombre_produit = $row;
                            }
                            $nombre_produit = $d_nombre_produit[0]['nombreProduit'] + 1;
                            $update_nombre_produit = "UPDATE `statistique` SET `nombreProduit`='$nombre_produit'";
                            $r_update_nombre_produit = mysqli_query($db, $update_nombre_produit);
                            if($r_update_nombre_produit){
                                header('Location: produit.php');
                                // $get_quantite_produit = "SELECT quantite,nombretotal FROM produits";
                                // $r_quantite_produit = mysqli_query($db, $get_quantite_produit);
                                // if($r_quantite_produit){
                                //     while($row = mysqli_fetch_array($r_quantite_produit)){
                                //         $d_quantite_produit = $row;
                                //     }
                                //     $quantite_produit = $d_quantite_produit[0]['quantite'] + 1;
                                //     $nombretotal_produit = $d_quantite_produit[0]['nombretotal'] + 1;
                                //     $update_quantite_produit = "UPDATE `produits` SET `nombretotal`='$nombretotal_produit',`quantite`='$quantite_produit' ";
                                //     $r_update_quantitie_produit = mysqli_query($db, $update_quantite_produit);
                                //     if($r_update_quantitie_produit){
                                //         header('Location: produit.php');
                                //     }else{
                                //         echo "error update quantite";
                                //     }


                                // }
                            }else{
                                echo "Error update nombre produit ";
                            }
                        }else{
                            echo "ERROR get nombre produit ";
                        }
                    }else{
                        echo "Error 5";
                    }
                }else{
                    echo "Error 4";
                }
            }else{
                echo "Error 3";
            }
        }else{
            echo "Error 2";
        }
    }else{
        echo "Error 1";
    }
}

if(isset($_POST["ajouter-modem"])){

    $m_n_serie = 0;
    $m_idproduit = 0;
    $m_status = "";

    
    
    $m_n_serie = 0;
    $m_idproduit = $_POST['id'];
    $m_status = "Active";
    $m_quantite = $_POST['quantite'];

    $array_product = array();
    $get_nature_modem = "SELECT * FROM produits WHERE produits.id = '$m_idproduit'";
    $nature_modem = mysqli_query($db, $get_nature_modem);

    if($nature_modem){

        while($row = mysqli_fetch_array($nature_modem)){
            $array_product = $row;
        }
        $m_nature = $array_product['nature'];
        if($m_nature == "ADSL"){
            $nature = 'nombreModemAdsl';
        }else{
            $nature = 'nombreModem4G';
        }
    }else{
        $nature = 'nombreModemAdsl';
    }
    

    $d_nombre_modem = array();
    $get_nombre_modem = "SELECT * FROM statistique";
    $r_nombre_modem = mysqli_query($db, $get_nombre_modem);
    if($r_nombre_modem){
        while($row = mysqli_fetch_array($r_nombre_modem)){
            $d_nombre_modem = $row;
        }
        $modem = $d_nombre_modem[$nature] + $m_quantite;
        $nombre_modem = $d_nombre_modem['nombreModem'] + $m_quantite;
        $update_nombre_modem = "UPDATE `statistique` SET `nombreModem`='$nombre_modem', `$nature`='$modem'";
        $r_update_nombre_modem = mysqli_query($db, $update_nombre_modem);
        if($r_update_nombre_modem){
            for ($nombre_de_lignes = 1; $nombre_de_lignes <= $m_quantite; $nombre_de_lignes++)
            {
                //SQL query:
                $m_sqlProduct = "INSERT INTO `modem`(`idproduit`, `status`) VALUES ('$m_idproduit','$m_status')";
                $m_resultsProduvt = mysqli_query($db, $m_sqlProduct);
                if ($m_resultsProduvt) {
                    echo "inserer";
                    // header('Location: modem.php');
                 }else{
                     echo "error 0";
                 }
            }
            $d_quantite_produit = array();
            $get_quantite_produit = "SELECT quantite,nombretotal FROM produits WHERE produits.id = $m_idproduit";
            $r_quantite_produit = mysqli_query($db, $get_quantite_produit);
            if($r_quantite_produit){
                while($row = mysqli_fetch_array($r_quantite_produit)){
                    $d_quantite_produit = $row;
                }
                $quantite_produit = $d_quantite_produit['quantite'] + $m_quantite;
                $nombretotal_produit = $d_quantite_produit['nombretotal'] + $m_quantite;
                $update_quantite_produit = "UPDATE `produits` SET `nombretotal`='$nombretotal_produit',`quantite`='$quantite_produit' WHERE produits.id = $m_idproduit";
                $r_update_quantitie_produit = mysqli_query($db, $update_quantite_produit);
                if($r_update_quantitie_produit){
                    header('Location: modem.php');
                }else{
                    echo "error update quantite";
                }
            }
        }else{
            echo "Error update nombre produit ";
        }
    }else{
        echo "ERROR get nombre produit ";
    }

   
}

if(isset($_POST["ajouter-carte"])){

    $c_n_serie = 0;
    $c_idproduit = 0;
    $c_status = "";

    $c_n_serie = 0;
    $c_idproduit = $_POST['id'];
    $c_status = "Active";
    $c_quantite = $_POST['quantite'];

    $array_product = array();
    $get_nature_carte = "SELECT * FROM produits WHERE produits.id = '$c_idproduit'";
    $nature_carte = mysqli_query($db, $get_nature_carte);

    if($nature_carte){
        while($row = mysqli_fetch_array($nature_carte)){
            $array_product = $row;
        }
        $c_nature = $array_product['nature'];
        echo "nature: ".$array_product['nature'];
        if($c_nature == "ADSL"){
            $nature = 'nombreCarteAdsl';
        }else{
            $nature = 'nombreCarte4G';
        }
    }else{
        $nature = 'nombreCarteAdsl';
    }


    $d_nombre_carte = array();
    $get_nombre_carte = "SELECT * FROM statistique";
    $r_nombre_carte = mysqli_query($db, $get_nombre_carte);
    if($r_nombre_carte){
        while($row = mysqli_fetch_array($r_nombre_carte)){
            $d_nombre_carte = $row;
        }
        $carte = $d_nombre_carte[$nature] + $c_quantite;
        $nombre_carte = $d_nombre_carte['nombreCarte'] + $c_quantite;
        $update_nombre_carte = "UPDATE `statistique` SET `nombreCarte`='$nombre_carte', `$nature`='$carte'";
        $r_update_nombre_carte = mysqli_query($db, $update_nombre_carte);
        if($r_update_nombre_carte){
            for ($nombre_de_lignes = 1; $nombre_de_lignes <= $c_quantite; $nombre_de_lignes++)
            {
                $random_code = (string)rand(1000000000000000, 9999999999999999);
                echo " ".$random_code." ";
                //SQL query:
                $c_sqlProduct = "INSERT INTO `carte`(`code`,`idproduit`,`status`,`isChecked`) VALUES ('$random_code','$c_idproduit','$c_status','FALSE')";
                $c_resultsProduvt = mysqli_query($db, $c_sqlProduct);
                if ($c_resultsProduvt) {
                    // header('Location: carte.php');
                 }else{
                     echo "error 0";
                 }
            }
            $d_quantite_produit = array();
            $get_quantite_produit = "SELECT quantite,nombretotal FROM produits WHERE produits.id = $c_idproduit";
            $r_quantite_produit = mysqli_query($db, $get_quantite_produit);
            if($r_quantite_produit){
                while($row = mysqli_fetch_array($r_quantite_produit)){
                    $d_quantite_produit = $row;
                }
                $quantite_produit = $d_quantite_produit['quantite'] + $c_quantite;
                $nombretotal_produit = $d_quantite_produit['nombretotal'] + $c_quantite;
                $update_quantite_produit = "UPDATE `produits` SET `nombretotal`='$nombretotal_produit',`quantite`='$quantite_produit' WHERE produits.id = $c_idproduit";
                $r_update_quantitie_produit = mysqli_query($db, $update_quantite_produit);
                if($r_update_quantitie_produit){
                    header('Location: carte.php');
                }else{
                    echo "error update quantite";
                }
            }
        }else{
            echo "Error update nombre produit ";
        }
    }else{
        echo "ERROR get nombre produit ";
    }
}
?>
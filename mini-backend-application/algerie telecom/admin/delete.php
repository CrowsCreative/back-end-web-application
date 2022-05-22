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
 
if(isset($_POST["DELETE_client"]))
{
    $id = $_POST["DELETE_client"];
    $sqlReponse = "DELETE FROM reponse WHERE reponse.clientid = $id";
    $sqlMsg = "DELETE FROM message WHERE message.idpropritaire = $id";
    $sqlAchats = "DELETE FROM achats WHERE achats.idClient = $id";
    $sqlProfileImage = "DELETE FROM profile_images WHERE profile_images.id = $id";
    $sqlClient = "DELETE FROM clients WHERE clients.id = $id";
    $sqlDemande = "DELETE FROM demande WHERE demande.clientID = $id";
    $sqlClientAccount = "DELETE FROM clientaccount WHERE clientaccount.id = $id";

    
    
    $deletedReponseRacord = mysqli_query($db, $sqlReponse);
    
    if($deletedReponseRacord){
        $deletedMsgRacord = mysqli_query($db, $sqlMsg);
        if($deletedMsgRacord)
        {
            $deletedAchatsRacord = mysqli_query($db, $sqlAchats);
            if($deletedAchatsRacord)
            {
                $deletedProfileImagetRacord = mysqli_query($db, $sqlProfileImage);
                if($deletedProfileImagetRacord)
                {
                    $deletedClientRacord = mysqli_query($db, $sqlClient);
                    if($deletedClientRacord)
                    {
                        $deletedDemandeRacord = mysqli_query($db, $sqlDemande);
                        if($deletedDemandeRacord)
                        {
                            $deletedClientAccountRacord = mysqli_query($db, $sqlClientAccount);
                            if($deletedClientAccountRacord)
                            {
                                $get_nombre_client = "SELECT nombreClient FROM statistique";
                                $r_nombre_client = mysqli_query($db, $get_nombre_client);
                                if($r_nombre_client){
                                    while($row = mysqli_fetch_array($r_nombre_client)){
                                        $d_nombre_client = $row;
                                    }
                                    $nombre_client = $d_nombre_client[0]['nombreClient'] - 1;
                                    $update_nombre_client = "UPDATE `statistique` SET `nombreClient`='$nombre_client'";
                                    $r_update_nombre_client = mysqli_query($db, $update_nombre_client);
                                    if($r_update_nombre_client){
                                        header("Location: index.php");
                                    }else{
                                        echo "Error update nombre client ";
                                    }
                                }else{
                                    echo "ERROR get nombre client ";
                                }
                            }else{
                                echo "ERROR 6";
                            }
                        }else{
                            echo "ERROR 5";
                        }
                    }else{
                        echo "ERROR 4";
                    }
                }else{
                    echo "ERROR 3";
                }
            }else{
                echo "ERROR 2";
            }
        }else
        {
        echo "ERROR 1";
        }
    }
    else{
        //error
        echo "ERROR 0";
        echo $id;
    }
    
}

if(isset($_POST["DELETE_product"]))
{

    $id = $_POST["DELETE_product"];
    $sqlAchats = "DELETE FROM achats WHERE achats.idProduct = $id";
    $sqlCarte = "DELETE FROM carte WHERE carte.idProduit = $id";
    $sqlModem = "DELETE FROM modem WHERE modem.idProduit = $id";
    $sqlOutput_mage = "DELETE FROM output_images WHERE output_images.id = $id";
    $sqlProduits = "DELETE FROM produits WHERE produits.id = $id";


    $deletedAchats = mysqli_query($db, $sqlAchats);
    
    if($deletedAchats)
    {
        $deletedCarte = mysqli_query($db, $sqlCarte);
        if($deletedCarte)
        {
            $deletedModem = mysqli_query($db, $sqlModem);
            if($deletedModem)
            {
                $deletedOutput_image = mysqli_query($db, $sqlOutput_mage);
                if($deletedOutput_image)
                {
                    $deletedProduct = mysqli_query($db, $sqlProduits);
                        if($deletedProduct)
                        {
                            $get_nombre_produit = "SELECT nombreProduit FROM statistique";
                            $r_nombre_produit = mysqli_query($db, $get_nombre_produit);
                            if($r_nombre_produit){
                                while($row = mysqli_fetch_array($r_nombre_produit)){
                                    $d_nombre_produit = $row;
                                }
                                $nombre_produit = $d_nombre_produit[0]['nombreProduit'] - 1;
                                $update_nombre_produit = "UPDATE `statistique` SET `nombreProduit`='$nombre_produit'";
                                $r_update_nombre_produit = mysqli_query($db, $update_nombre_produit);
                                if($r_update_nombre_produit){
                                    header('Location: produit.php');
                                }else{
                                    echo "Error update nombre produit ";
                                }
                            }else{
                                echo "ERROR get nombre produit ";
                            }
                        }else{
                            echo "ERROR 5";
                        }
                }else{
                    echo "ERROR 3";
                }
            }else{
                echo "ERROR 2";
            }
        }else
        {
        echo "ERROR 1";
        }
    }
    else{
        //error
        echo "ERROR 0";
    }
}

if(isset($_POST["DELETE_modem"]))
{

    $n_seri = $_POST["DELETE_modem"];
    $id_produit = 0;
    $array_product = array();
    $get_nature_modem = "SELECT * FROM produits,modem WHERE produits.id = modem.idproduit AND modem.n_serie = '$n_seri'";
    $nature_modem = mysqli_query($db, $get_nature_modem);
    if($nature_modem){
        while($row = mysqli_fetch_array($nature_modem)){
            $array_product = $row;
        }
        $id_produit = $array_product['id'];
        $m_nature = $array_product['nature'];

        if($m_nature == "ADSL"){
            $nature = 'nombreModemAdsl';
        }else{
            $nature = 'nombreModem4G';
        }
    }else{
        $nature = 'nombreModemAdsl';
    }
    

    $sql = "DELETE FROM modem WHERE modem.n_serie = $n_seri";
    $deleted = mysqli_query($db, $sql);
    if($deleted){

        $d_nombre_modem = array();
        $get_nombre_modem = "SELECT * FROM statistique";
        $r_nombre_modem = mysqli_query($db, $get_nombre_modem);
        if($r_nombre_modem){
            while($row = mysqli_fetch_array($r_nombre_modem)){
                $d_nombre_modem = $row;
            }
            $modem = $d_nombre_modem[$nature] - 1;
            $nombreModem = $d_nombre_modem['nombreModem'] - 1;
            $update_nombre_modem = "UPDATE `statistique` SET $nature='$modem', `nombreModem`='$nombreModem'";
            $r_update_nombre_modem = mysqli_query($db, $update_nombre_modem);
            if($r_update_nombre_modem){
                $d_quantite_produit = array();
                $get_quantite_produit = "SELECT quantite,nombretotal FROM produits WHERE produits.id = '$array_product[0]'";
                $r_quantite_produit = mysqli_query($db, $get_quantite_produit);
                if($r_quantite_produit){
                    while($row = mysqli_fetch_array($r_quantite_produit)){
                        $d_quantite_produit = $row;
                    }
                    $quantite_produit = $d_quantite_produit['quantite'] - 1;
                    $nombretotal_produit = $d_quantite_produit['nombretotal'];
                    if($array_product['status'] == 'Active'){
                        $nombretotal_produit = $nombretotal_produit - 1;
                    }
                    $update_quantite_produit = "UPDATE `produits` SET `nombretotal`='$nombretotal_produit',`quantite`='$quantite_produit' WHERE produits.id = $array_product[0]";
                    $r_update_quantitie_produit = mysqli_query($db, $update_quantite_produit);
                    if($r_update_quantitie_produit){
                        header("Location: modem.php");
                    }else{
                        echo "error update quantite";
                    }
                }else{
                    echo " error get quantite,nombretotal from produis ";
                }
            }else{
                echo " error update statistique ";
            }
        }else{
            echo " get statistique feild ";
        }
    }else{
        echo "Error 0";
    }
}

if(isset($_POST["DELETE_carte"]))
{

    $n_seri = $_POST["DELETE_carte"];
    $id_produit = 0;
    $array_product = array();
    $get_nature_carte = "SELECT * FROM produits,carte WHERE produits.id = carte.idproduit AND carte.n_serie = '$n_seri'";
    $nature_carte = mysqli_query($db, $get_nature_carte);
    if($nature_carte){
        while($row = mysqli_fetch_array($nature_carte)){
            $array_product = $row;
        }
        $id_produit = $array_product['id'];
        $c_nature = $array_product['nature'];

        if($c_nature == "ADSL"){
            $nature = 'nombreCarteAdsl';
        }else{
            $nature = 'nombreCarte4G';
        }
    }else{
        $nature = 'nombreCarteAdsl';
    }


    $sql = "DELETE FROM carte WHERE carte.n_serie = $n_seri";
    $deleted = mysqli_query($db, $sql);
    if($deleted){
        $d_nombre_carte = array();
        $get_nombre_carte = "SELECT * FROM statistique";
        $r_nombre_carte = mysqli_query($db, $get_nombre_carte);
        if($r_nombre_carte){
            while($row = mysqli_fetch_array($r_nombre_carte)){
                $d_nombre_carte = $row;
            }
            $carte = $d_nombre_carte[$nature] - 1;
            $nombreCarte = $d_nombre_carte['nombreCarte'] - 1;
            $update_nombre_carte = "UPDATE `statistique` SET $nature='$carte', `nombreCarte`='$nombreCarte'";
            $r_update_nombre_carte = mysqli_query($db, $update_nombre_carte);
            if($r_update_nombre_carte){
                $d_quantite_produit = array();
                $get_quantite_produit = "SELECT quantite,nombretotal FROM produits WHERE produits.id = '$array_product[0]'";
                $r_quantite_produit = mysqli_query($db, $get_quantite_produit);
                if($r_quantite_produit){
                    while($row = mysqli_fetch_array($r_quantite_produit)){
                        $d_quantite_produit = $row;
                    }
                    $quantite_produit = $d_quantite_produit['quantite'] - 1;
                    $nombretotal_produit = $d_quantite_produit['nombretotal'];
                    if($array_product['status'] == 'Active'){
                        $nombretotal_produit = $nombretotal_produit - 1;
                    }
                    $update_quantite_produit = "UPDATE `produits` SET `nombretotal`='$nombretotal_produit',`quantite`='$quantite_produit' WHERE produits.id = $array_product[0]";
                    $r_update_quantitie_produit = mysqli_query($db, $update_quantite_produit);
                    if($r_update_quantitie_produit){
                        header("Location: carte.php");
                    }else{
                        echo "error update quantite";
                    }
                }else{
                    echo " error get quantite,nombretotal from produis ";
                }
            }else{
                echo " error update statistique ";
            }
        }else{
            echo " get statistique feild ";
        }
        header("Location: carte.php");
    }else{
        echo "Error 0";
    }
}

?>

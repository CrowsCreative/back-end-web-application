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

<?php include('db.php') ?>
<?php 
   

if(isset($_POST["update-client"])){
    
     $id = (int)$_POST["update-client"];
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
    /* client */
    $lnom=$_POST['nom'];
    $lprenom=$_POST['prenom'];
    $lnaissance=$_POST['naissance'];
    $lcarte_national=$_POST['carte_national'];
    $laddress=$_POST['address'];
    $lemail=$_POST['email'];
    $lphone=$_POST['phone'];
    //$lpaiement="0";
    $lcapaciteFinanciere=$_POST['capaciteFinanciere'];
    $ltypeTravaille=$_POST['typeTravaille'];
    
    /* client account */
    $lusername=$_POST['username'];
    $lpassword=$_POST['password'];    
    $lcreated_at=$_POST['created_at'];
    $lpermission=$_POST['permission'];
    $lidBank=$_POST['idBank'];
    $lpassword = md5($lpassword);
    $sql_clientaccount = "UPDATE `clientaccount` 
        SET `username`='$lusername',`password`='$lpassword',`created_at`='$lcreated_at',`permission`='$lpermission'
        WHERE id= $id";
    $correct_clientaccount = mysqli_query($db, $sql_clientaccount);
    if($correct_clientaccount){
        echo "first true =>";
        $sql_client = "UPDATE `clients` SET `prenom`='$lprenom',`nom`='$lnom',`naissance`='$lnaissance',`carte_national`='$lcarte_national', 
            `address`='$laddress',`email`='$lemail',`phone`='$lphone',`capaciteFinanciere`='$lcapaciteFinanciere',`typeTravaille`='$ltypeTravaille'
            WHERE id= '$id'";
        $correct_client = mysqli_query($db, $sql_client);
        if($correct_client){
            echo "secound true =>";
            if(count($_FILES) > 0) {
                $db = mysqli_connect("localhost", "root", "mysql", "algerietelecom");
                if(is_uploaded_file($_FILES['imageProfile']['tmp_name'])) {
                    
                    echo $_FILES['imageProfile']['tmp_name'];

                    $imgData = addslashes(file_get_contents($_FILES['imageProfile']['tmp_name']));
                    $imageProperties = getimageSize($_FILES['imageProfile']['tmp_name']);
                    
                    $sq = "UPDATE `profile_images` SET `Id`='$id',`imageType`='{$imageProperties['mime']}',`imageData`='{$imgData}' WHERE Id= '$id'";
                    $current_id = mysqli_query($db, $sq);
                    if($current_id){
                        header('Location: index.php');
                    }
                }
            }
        }else{
            echo "Error 2";
        }
    }else{
        echo "Error 1";
    }

}

if(isset($_POST["modifier-product"])){

    $id = (int)$_POST["modifier-product"];
    $p_type = "";
    $p_nature = "";
    $p_nom = "";
    $p_prix = "";
    $p_description = "";
    $p_idphoto = "";
    
    $p_type = $_POST['type'];
    $p_nature = $_POST['nature'];
    $p_nom = $_POST['nom'];
    $p_prix = (double)$_POST['prix'];
    $p_description = $_POST['description'];

    $data_produit = array();
    $sql_get_produit = "SELECT * FROM produits WHERE produits.id = '$id'";
    $correct_produit = mysqli_query($db, $sql_get_produit);
    if($correct_produit){
        while($row = mysqli_fetch_array($correct_produit)){
            $data_produit = $row;
        }
        $d_nombre_modem = array();
        $get_nombre_modem = "SELECT * FROM statistique";
        $r_nombre_modem = mysqli_query($db, $get_nombre_modem);
        if($r_nombre_modem){
            while($row = mysqli_fetch_array($r_nombre_modem)){
                $d_nombre_modem = $row;
            }
        }else{
            echo "error get data statistique";
        }
        $nombreModem = $d_nombre_modem['nombreModem'];
        $nombreCarte = $d_nombre_modem['nombreCarte'];
        $nombreModemAdsl = $d_nombre_modem['nombreModemAdsl'];
        $nombreModem4G = $d_nombre_modem['nombreModem4G'];
        $nombreCarteAdsl = $d_nombre_modem['nombreCarteAdsl'];
        $nombreCarte4G = $d_nombre_modem['nombreCarte4G'];
        if($data_produit["type"] != $p_type){
            if($p_type == 'carte'){//modem
                $nombreModem = $nombreModem - 1;
                $nombreCarte = $nombreCarte + 1;
                if($data_produit["nature"] != $p_nature){
                    if($p_nature == 'ADSL'){//modem ADSL
                        // $nombreCarte4G = $nombreCarte4G - 1;
                        $nombreCarteAdsl = $nombreCarteAdsl + 1;
                    }else{//modem 4G
                        $nombreCarte4G = $nombreCarte4G + 1;
                        // $nombreCarteAdsl = $nombreCarteAdsl - 1;
                    }
                }
            }else{//carte
                $nombreModem = $nombreModem + 1;
                $nombreCarte = $nombreCarte - 1;
                echo "$p_type ".$nombreModem." ".$nombreCarte;
                if($data_produit["nature"] != $p_nature){
                    if($p_nature == 'ADSL'){//modem ADSL
                        // $nombreModem4G = $nombreModem4G - 1;
                        $nombreModemAdsl = $nombreModemAdsl + 1;
                    }else{//modem 4G
                        $nombreModem4G = $nombreModem4G + 1;
                        // $nombreModemAdsl = $nombreModemAdsl - 1;
                    }
                }
            }
        }else{
            echo "same ";
            if($p_type == 'carte'){//modem
                echo "catre ";
                if($data_produit["nature"] != $p_nature){
                    if($p_nature == 'ADSL'){//modem ADSL
                        echo "ADSL ";

                        $nombreCarte4G = $nombreCarte4G - 1;
                        $nombreCarteAdsl = $nombreCarteAdsl + 1;
                    }else{//modem 4G
                        echo "4G ";

                        $nombreCarte4G = $nombreCarte4G + 1;
                        $nombreCarteAdsl = $nombreCarteAdsl - 1;
                    }
                }
            }else{
                if($data_produit["nature"] != $p_nature){
                    if($p_nature == 'ADSL'){//modem ADSL
                        $nombreModem4G = $nombreModem4G - 1;
                        $nombreModemAdsl = $nombreModemAdsl + 1;
                    }else{//modem 4G
                        $nombreModem4G = $nombreModem4G + 1;
                        $nombreModemAdsl = $nombreModemAdsl - 1;
                    }
                }
            }
        }
        echo $nombreCarte4G." ".$nombreCarteAdsl;
        $sql_update_statistique = "UPDATE `statistique` SET `nombreModem`= '$nombreModem', `nombreCarte`= '$nombreCarte', `nombreModemAdsl`='$nombreModemAdsl', `nombreModem4G`='$nombreModem4G', `nombreCarteAdsl`='$nombreCarteAdsl', `nombreCarte4G`='$nombreCarte4G' ";
        $updated_statistique = mysqli_query($db, $sql_update_statistique);
        if($updated_statistique){
            
        }else{
            echo "error update statistique";
        }
    }else{
        echo " error get product ";
    }

    
    $sql = "UPDATE `produits` 
        SET `nom`='$p_nom',`nature`='$p_nature',`description`='$p_description',`type`='$p_type',`prix`='$p_prix' 
        WHERE `id`='$id'";
    $correct = mysqli_query($db, $sql);
    if($correct){
        if(count($_FILES) > 0) {
            $db = mysqli_connect("localhost", "root", "mysql", "algerietelecom");
            if(is_uploaded_file($_FILES['idphoto']['tmp_name'])) {
                
                echo $_FILES['idphoto']['tmp_name'];

                $imgData = addslashes(file_get_contents($_FILES['idphoto']['tmp_name']));
                $imageProperties = getimageSize($_FILES['idphoto']['tmp_name']);
                
                $sq = "UPDATE `output_images` 
                    SET `imageType`='{$imageProperties['mime']}',`imageData`='{$imgData}' 
                    WHERE `Id`= '$id'";
                $current_id = mysqli_query($db, $sq);
                if($current_id){
                    header('Location: produit.php');
                }else{
                    echo "Error 3";
                }
            }else{
                echo "Error 2";
            }
        }else{
            echo "Error 1";
        }
    }else{
        echo "Error 0 ";
    }

}

if(isset($_POST["modifier-modem"])){

    $m_n_serie = (int)$_POST["modifier-modem"];
    $n_serie = $_POST['n_serie'];

    $sql = "UPDATE `modem` SET `n_serie`='$n_serie'  WHERE `n_serie`='$m_n_serie'";
    $correct = mysqli_query($db, $sql);
    if($correct){
        header("Location: modem.php");
    }else{
        echo "Error 0";
    }
}

if(isset($_POST["modifier-carte"])){

    $c_n_serie = (int)$_POST["modifier-carte"];
    $n_serie = $_POST['n_serie'];

    $sql = "UPDATE `carte` SET `n_serie`='$n_serie'  WHERE `n_serie`='$c_n_serie'";
    $correct = mysqli_query($db, $sql);
    if($correct){
        header("Location: carte.php");
    }else{
        echo "Error 0";
    }
}
?>
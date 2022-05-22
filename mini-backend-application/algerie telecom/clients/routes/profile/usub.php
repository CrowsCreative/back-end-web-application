<?php
  session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['ERROR'] = "You must log in first";
		header('location: ../login/login.php');
	}

	

  $clientID = $_SESSION['id'];
  unset($_SESSION['ERROR']);
  ?>
    <?php include("../../../server/firstdb.php"); ?>
<?php
if(isset($_POST["DELETE_client"]) && $_POST["DELETE_client"] == "DELETE")
{
    
    $sqlReponse = "DELETE FROM reponse WHERE reponse.clientid = $clientID";
    $sqlMsg = "DELETE FROM message WHERE message.idpropritaire = $clientID";
    $sqlAchats = "DELETE FROM achats WHERE achats.idClient = $clientID";
    $sqlProfileImage = "DELETE FROM profile_images WHERE profile_images.id = $clientID";
    $sqlClient = "DELETE FROM clients WHERE clients.id = $clientID";
    $sqlDemande = "DELETE FROM demande WHERE demande.clientID = $clientID";
    $sqlClientAccount = "DELETE FROM clientaccount WHERE clientaccount.id = $clientID";

    
    
    $deletedReponseRacord = mysqli_query($conn, $sqlReponse);
    
    if($deletedReponseRacord){
        $deletedMsgRacord = mysqli_query($conn, $sqlMsg);
        if($deletedMsgRacord)
        {
            $deletedAchatsRacord = mysqli_query($conn, $sqlAchats);
            if($deletedAchatsRacord)
            {
                $deletedProfileImagetRacord = mysqli_query($conn, $sqlProfileImage);
                if($deletedProfileImagetRacord)
                {
                    $deletedClientRacord = mysqli_query($conn, $sqlClient);
                    if($deletedClientRacord)
                    {
                        $deletedDemandeRacord = mysqli_query($conn, $sqlDemande);
                        if($deletedDemandeRacord)
                        {
                            $deletedClientAccountRacord = mysqli_query($conn, $sqlClientAccount);
                            if($deletedClientAccountRacord)
                            {
                                $get_nombre_client = "SELECT nombreClient FROM statistique";
                                $r_nombre_client = mysqli_query($conn, $get_nombre_client);
                                if($r_nombre_client){
                                    while($row = mysqli_fetch_array($r_nombre_client)){
                                        $d_nombre_client = $row;
                                    }
                                    $nombre_client = $d_nombre_client[0]['nombreClient'] - 1;
                                    $update_nombre_client = "UPDATE `statistique` SET `nombreClient`='$nombre_client'";
                                    $r_update_nombre_client = mysqli_query($conn, $update_nombre_client);
                                    if($r_update_nombre_client){
                                        
                                            session_destroy();
                                            unset($_SESSION['username']);
                                            unset($_SESSION['id']);
                                            header("location: ../login/login.php");
                                        
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

?>
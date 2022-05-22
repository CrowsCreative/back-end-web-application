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



$data = array();
 $sql = "SELECT * FROM message,clientaccount,clients WHERE clientaccount.id = clients.id AND clientaccount.id = message.idpropritaire";
$racords = mysqli_query($db, $sql);
if($racords)
{
    while($row = mysqli_fetch_array($racords))
    {
    $data[] = $row;   
    }

}else
{
    //error
}

if(isset($_POST["send-repond"]))
{
    $id = $_POST["send-repond"];
    $content = $_POST["repondre"];
    $envoyer_at = $_POST["created_at"];

    $sql_insert = "SELECT * FROM message WHERE message.id = ".$id;
    $r = mysqli_query($db, $sql_insert);
    if($r)
    {
        while($row = mysqli_fetch_array($r))
        {
        $d[] = $row;   
        }
        
        $clientid = $d[0]['idpropritaire'];
        $messageid = $d[0]['id'];
        $subject = $d[0]['suject'];

        $sql_send = "INSERT INTO `reponse`(`clientid`, `messageid`, `content`, `envoyez_at`, `subject`) 
            VALUES ('$clientid','$messageid','$content','$envoyer_at','$subject')";
        $send = mysqli_query($db, $sql_send);
        echo $send;
        if($send){
            header("Location: notification.php");
        }else{
            echo "error send reponse";
        }
    
    }else
    {
        //error
    }

}

if(isset($_POST["DELETE_message"]))
{

    $id = $_POST["DELETE_message"];

    $sql_delete_reponse = "DELETE FROM reponse WHERE reponse.messageid = $id";
    $reponse_deleted = mysqli_query($db, $sql_delete_reponse);

    if($reponse_deleted){

        $sql_delete_message = "DELETE FROM message WHERE message.id = $id";
        $message_deleted = mysqli_query($db, $sql_delete_message);
        if($message_deleted){
            header("Location: notification.php");
        }else{
            echo "NOt Deleted";
        }
    }else{
        echo "reponse not deleted";
    }

}

if(isset($_POST["DELETE_repondre"])){

    $id = $_POST["DELETE_repondre"];

    $sql_delete_reponse = "DELETE FROM reponse WHERE reponse.messageid = $id";
    $reponse_deleted = mysqli_query($db, $sql_delete_reponse);
    if($reponse_deleted){
        header("Location: notification.php");
    }else{
        echo "NOt Deleted";
    }
}


$phto_admin = array();
$sql_admin = "SELECT imageURL,nom,prenom FROM admin";
$set_photo = mysqli_query($db, $sql_admin);
if($set_photo){
    while($row = mysqli_fetch_array($set_photo))
    {
        $phto_admin[] = $row;   
    }
}
else{
    echo "photo does not loading";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon"  href="https://www.algerietelecom.dz/assets/front/img/favicon.png" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Notification</title>
</head>
<body>
    

    <div class="wrapper d-flex">

          <!-- Side bar -->
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-4">
                    <?php echo "<img src='".$phto_admin[0]["imageURL"]."' width=120 height=120 style='border-radius: 50%;'>";?>
                </a>
                <h2 class="text-center mb-5"><?= $phto_admin[0]["nom"]." ".$phto_admin[0]["prenom"]?></h2>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#clientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users"></i> CLIENT</a>
                        <ul class="collapse list-unstyled" id="clientSubmenu">
                        <li><a href="./index.php"><i class="fa fa-cogs"></i> GENERAL</a></li>
                        <li class="active"><a href="./notification.php"><i class="fa fa-bell"></i> NOTIFICATION</a></li>
                      </ul>
                    </li>
                    <li>
                        <a href="#produitSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-box-open"></i> PRODUIT</a>
                        <ul class="collapse list-unstyled" id="produitSubmenu">
                          <li><a href="./produit.php"><i class="fa fa-boxes"></i> ALL</a> </li>
                          <li><a href="./modem.php"><i class="fa fa-ethernet"></i> MODEM</a> </li>
                          <li><a href="./carte.php"><i class="fa fa-credit-card"></i> CARTE</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#parametreSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog"></i> PARAMETRE</a>
                        <ul class="collapse list-unstyled" id="parametreSubmenu">
                            <li><a href="./profile-admin.php"><i class="fa fa-user"></i> PROFILE</a></li>
                            <li><a href="./modifier-client.php?logout='1'"><i class="fa fa-sign-out-alt"></i> LOG OUT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Page Content  -->
        <div id="content" class="p-2 p-md-3 ">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light" aria-label="">
                <div class="container-fluid">
 
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navParametretSubmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paramètre</a>
                                    <div class="dropdown-menu" aria-labelledby="navParametretSubmenu">
                                        <a class="dropdown-item" href="./profile-admin.php">PROFILE</a>
                                        <a class="dropdown-item" href="./modifier-client.php?logout='1'">LOG OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="./notification.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 id="title-page"><i class="fa fa-angle-right"></i> <strong>Notification</strong></h1>

            <section class="content-page p-5">

                    <?php 
                    $index = 0;
                    foreach($data as $messageData)
                    {
                        $index = $index + 1;
                        echo "<div class='client-message'>";
                            echo "<div class='d-flex flex-column header'>";
                                echo "<div class='d-flex flex-row align-items-center justify-content-between'>";
                                    echo "<div class='d-flex flex-row align-items-center' >";
                                        echo "<p class='id'><strong>#".$messageData[1]."</strong></p>";
                                        echo "<p class='nom-prenom'>".$messageData['nom']." ".$messageData['prenom']."</p>";
                                    echo "</div>";
                                    echo "<p class='date'>".$messageData['envoyez_le']."</p>";
                                echo "</div>";
                                echo "<h2 class='id' style='margin-left: 20px;'>".$messageData['suject']."</h2>";
                            echo "<div class='messages mb-3'>";
                                echo "<form action='notification.php' method='POST'>";
                                echo "<p class='message'>".$messageData['contenue'];
                                    echo "<button type='submit' name='DELETE_message' value='".$messageData[0]."' class='delete' style='border-style: none;'><i class='fa fa-trash-alt fa-lg'></i></button>";
                                echo "</p>";
                                echo "</form>";
                            echo "</div>";

                            

                            $sql_reponse = "SELECT * FROM reponse,message WHERE message.idpropritaire = reponse.clientid AND message.id = reponse.messageid AND message.id = ".$messageData[0];
                            $reponse_exist = mysqli_query($db, $sql_reponse);
                            if($reponse_exist){
                                $data_reponde = array();
                                while($row = mysqli_fetch_array($reponse_exist))
                                {
                                    $data_reponde[] = $row;   
                                }
                                if($data_reponde[0]){
                                    echo "<div class='messages'>";
                                    echo "<form action='notification.php' method='POST'>";
                                        echo "<p class='message reponde'><span class='delete'><i class='fa fa-trash-alt fa-lg'></i></span>".$data_reponde[0]['content'];
                                            echo "<button type='submit' name='DELETE_repondre' value='".$messageData[0]."' class='delete' style='border-style: none;'><i class='fa fa-trash-alt fa-lg'></i></button>";
                                        echo "</p>";
                                    echo "</form>";
                                    echo "</div>";
                                    echo "</div>";
                                    
                                }else{
                                    echo "</div>";
                                    echo "<form class='repondre-form' action='notification.php' method='POST'>";
                                        echo "<input type='text' class='created_timing' name='created_at' value='' hidden>";
                                        echo "<label for='repondre'>réponde aux message</label>";
                                        echo "<textarea type='text' class='form-control' id='repondre' name='repondre' rows='2'></textarea>";
                                        echo "<button type='submit' class='btn btn-primary mt-2' name='send-repond' value='".$messageData[0]."'>send</button>";
                                    echo "</form>";
                                }
                                
                            }else{
                                echo "nothing";
                            }
                        echo "</div>";
                        echo "<hr>";
                    }
                        
                        
                    
                    ?>
                    <script>
                        const dates = document.querySelectorAll('.date');
                             
                              dates.forEach(date=>
                              {
                                const d = new Date();
                                date.innerText = d.toDateString();
                              });
                        const form = document.querySelectorAll('.created_timing');         
                        const date = new Date();
                        console.log(form);
                        form.forEach(input=>
                              {
                                const d = new Date();
                                input.setAttribute('value', String(d));
                                console.log(input.getAttribute('value'));
                              });
                        


                        
                    </script>
            </section>
        </div>


    </div>



    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <!-- <script src="./js/natification.js"></script> -->
    
</body>
</html>
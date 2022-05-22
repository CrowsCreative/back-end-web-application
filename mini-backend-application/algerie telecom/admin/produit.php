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
$sql = "SELECT * FROM produits";
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


$phto_admin = array();
$sql_admin = "SELECT imageURL FROM admin";
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


//image admin
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


//statistique
$data_staistique = array();
$sql_statistique = "SELECT * FROM statistique";
$get_statistique = mysqli_query($db, $sql_statistique);
if($get_statistique){
    while($row = mysqli_fetch_array($get_statistique))
    {
        $data_staistique[] = $row;   
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
    <link rel="stylesheet" href="./css/produit.css">
    <title>Produit</title>
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
                    <li>
                        <a href="#clientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users"></i> CLIENT</a>
                        <ul class="collapse list-unstyled" id="clientSubmenu">
                        <li><a href="./index.php"><i class="fa fa-cogs"></i> GENERAL</a></li>
                        <li><a href="./notification.php"><i class="fa fa-bell"></i> NOTIFICATION</a></li>
                      </ul>
                    </li>
                    <li class="active">
                        <a href="#produitSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-box-open"></i> PRODUIT</a>
                        <ul class="collapse list-unstyled" id="produitSubmenu">
                          <li class="active"><a href="./produit.php"><i class="fa fa-boxes"></i> ALL</a> </li>
                          <li><a href="./modem.php"><i class="fa fa-ethernet"></i> MODEM</a> </li>
                          <li><a href="./carte.php"><i class="fa fa-credit-card"></i> CARTE</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#parametreSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog"></i> PARAMETRE</a>
                        <ul class="collapse list-unstyled" id="parametreSubmenu">
                          <li><a href="./profile-admin.php"><i class="fa fa-user"></i> PROFILE</a> </li>
                          <li><a href="./produit.php?logout='1'"><i class="fa fa-sign-out-alt"></i> LOGOUT</a></li>
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
                                        <a class="dropdown-item" href="./produit.php?logout='1'">LOG OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="./notification.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Top cardes -->
            <div class="row justify-content-center">
                <div class="col-xs-11 col-md-5 mx-2 mb-3 px-4 py-3 cards card-1 d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <span><?= $data_staistique[0]['nombreModemAdsl']?></span>
                        <div>Total MODEM</div>
                    </div>
                    <div class="">
                        <h1><strong>ADSL</strong></h1>
                    </div>
                </div>
                <div class="col-xs-11 col-md-5  mx-2 mb-3 px-4 py-3 cards card-2 d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <span><?= $data_staistique[0]['nombreModem4G']?></span>
                        <div>total MODEM</div>
                    </div>
                    <div class="">
                        <h1><strong>4GLTE</strong></h1>
                    </div>
                </div>
                <div class="col-xs-11 col-md-5 mx-2 mb-3 px-4 py-3 cards card-3 d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <span><?= $data_staistique[0]['nombreCarteAdsl']?></span>
                        <div>Total CARTE</div>
                    </div>
                    <div class="">
                        <h1><strong>ADSL</strong></h1>
                    </div>
                </div>
                <div class="col-xs-11 col-md-5 mx-2 mb-3 px-4 py-3 cards card-4 d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <span><?= $data_staistique[0]['nombreCarte4G']?></span>
                        <div>total CARTE</div>
                    </div>
                    <div class="">
                        <h1><strong>4GLTE</strong></h1>
                    </div>
                </div>
            </div>

            <!-- tableau de touts produit -->
            <div class="list-client">
                <div class="col-md-12">
                    <div class="content-panel">
                        <h4 style="display: inline-block; color: #7289da;"><i class="fa fa-angle-right"></i> All Produit</h4>
                        <a href="./ajouter-produit.php" class="btn btn-success btn-md" style="float: right; margin-right: 10px;" title="ajouter produit">
                            <i class="fa fa-plus"></i>
                        </a>
                        <hr>
                        <div id="scrollContent">
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="fa fa-key"></i></th>
                                        <th scope="col"> Type</th>
                                        <th scope="col"> Nature</th>
                                        <th scope="col"> Nome</th>
                                        <th scope="col"> Prix(DA)</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="scrollContent">
                                    <?php 
                                    
                                    foreach($data as $productData)
                                    {

                                        echo "<tr>";
                                        echo "<th scope='row'>".$productData["id"]."</th>";
                                        echo "<td>".$productData["type"]."</td>";
                                        echo "<td>".$productData["nature"]."</td>";
                                        echo "<td>".$productData["nom"]."</td>";
                                        echo "<td>".$productData["prix"]."</td>";
                                        echo "<td style='float: right;width:135px;' class='d-flex flex-row justify-content-between'>";
                                            echo "<a href='./detail-produit.php?id=".$productData["id"]."' class='btn btn-success btn-sm' title='plus détail'><i class='fa fa-info-circle'></i></a>";
                                            echo "<a href='./modifier-produit.php?id=".$productData["id"]."' class='btn btn-primary btn-sm' title='modifier information client'><i class='fa fa-pencil-alt'></i></a>";
                                            echo "<form action='delete.php' method='POST'><button type='submit' name='DELETE_product' value='".$productData["id"]."' class='btn btn-danger btn-sm' title='supprimer client'><i class='fa fa-trash-alt'></i></button></from></td></tr>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                     
                                     
                                     ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

    </div>


    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/produit.js"></script>
</body>
</html>
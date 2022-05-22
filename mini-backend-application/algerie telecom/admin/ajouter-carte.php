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


$choose_nature = $_GET["nature"];


$data = array();
$sql = "SELECT DISTINCT * FROM produits WHERE produits.type = 'carte' AND produits.nature = '$choose_nature' AND produits.nature = '$choose_nature'";
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
    <title>Ajouter carte</title>
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
                          <li><a href="./produit.php"><i class="fa fa-boxes"></i> ALL</a> </li>
                          <li><a href="./modem.php"><i class="fa fa-ethernet"></i> MODEM</a> </li>
                          <li class="active"><a href="./carte.php"><i class="fa fa-credit-card"></i> CARTE</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#parametreSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog"></i> PARAMETRE</a>
                        <ul class="collapse list-unstyled" id="parametreSubmenu">
                          <li><a href="./profile-admin.php"><i class="fa fa-user"></i> PROFILE</a> </li>
                          <li><a href="ajouter-carte.php?logout='1'"><i class="fa fa-sign-out-alt"></i> LOGOUT</a></li>
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
                                        <a class="dropdown-item" href="ajouter-carte.php?logout='1'">LOG OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="./notification.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 id="title-page"><i class="fa fa-angle-right"></i> <strong>Ajouter Carte</strong></h1>


            <section class="content-page medem-content">
               <div class="d-flex flex-row justify-content-around">
                    <div class="modem-img-container">
                        <img src="./images/carte-idoom.jpg" alt="" width="350" height="300">
                    </div>
               </div>
                <form action="insert.php" method="POST">
                    <hr>
                    <h2>choisis un carte :</h2>
                    <div class="table-responsive px-3">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Nature</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                foreach($data as $carteData)
                                {

                                    echo "<tr>";
                                        echo "<th scope='row'><input class='form-check-input' type='radio' name='id' value='".$carteData["id"]."' > ".$carteData["id"]."</th>";
                                        echo "<td>".$carteData["type"]."</td>";
                                        echo "<td>".$carteData["nature"]."</td>";
                                        echo "<td>".$carteData["nom"]."</td>";
                                        echo "<td>".$carteData["prix"]."</td>";
                                    echo "</tr>";
                                }
                                ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputQuantite">quantité<span style="color: red;">*</span></label>
                            <input type="number" class="form-control" id="inputQuantite" name="quantite" value="1" min="1" required>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary mt-3" type="submit" name="ajouter-carte">générer</button>
                        </div>
                    </div>
                </form>

            </section>
           
        </div>
    </div>


    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>
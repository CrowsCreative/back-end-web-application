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
  
?>
<?php include('db.php') ?>
<?php

$db_bank = mysqli_connect('localhost', 'root', 'mysql', 'algerieccp');

$data = array();
 $sql_idbank = "SELECT `numero_check` FROM `bankccp`";
$racords = mysqli_query($db_bank, $sql_idbank);
if($racords)
{
    while($row = mysqli_fetch_array($racords))
    {
        $data[] = $row;   
    }
}else
{
    echo  "select idbank error";
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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon"  href="https://www.algerietelecom.dz/assets/front/img/favicon.png" />
    <title>Ajouter Client</title>
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
                        <li class="active"><a href="./index.php"><i class="fa fa-cogs"></i> GENERAL</a></li>
                        <li><a href="./notification.php"><i class="fa fa-bell"></i> NOTIFICATION</a></li>
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
                          <li><a href="./profile-admin.php"><i class="fa fa-user"></i> PROFILE</a> </li>
                          <li><a href="ajouter-client.php?logout='1'"><i class="fa fa-sign-out-alt"></i> LOGOUT</a></li>
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
                                      <a class="dropdown-item" href="ajouter-client.php?logout='1'">LOG OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="./notification.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 id="title-page"><i class="fa fa-angle-right"></i> <strong>Ajouter Client</strong></h1>

            <section class="content-page">
                
                <?php 
                if($_SESSION["ERROR"])
                {
                    echo "<div class='alert alert-danger'>";
                    echo $_SESSION["ERROR"];
                    echo "</div>";
                }
                ?>
                
                <form action="insert.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNom">nom</label>
                            <input type="text" class="form-control" id="inputNom" name="nom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPrenom">prenom</label>
                            <input type="text" class="form-control" id="inputPrenom" name="prenom" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputUsername">numero fixe</label>
                            <input type="text" class="form-control" id="inputUsername" name="username" maxlength="9" minlength="9" pattern="0[0-9]{8}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNaissance">date de naissance</label>
                            <input type="date" class="form-control" id="inputNaissance" name="naissance" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCarteNational">carte national</label>
                            <input type="text" class="form-control" id="inputCarteNational" name="carte_national" pattern="[0-9]{18}" minlength="18" maxlength="18" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputAddress">address</label>
                            <input type="text" class="form-control" id="inputAddress" name="address" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail">email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" required>
                        </div>
						 <div class="form-group col-md-6">
                            <label for="auth">email authentification</label>
                            <input type="text" class="form-control" id="auth" name="auth" required>
                        </div>
                        <div class="form-group col-md-9"style="margin-left:100px;">
                            <label for="inputPhone">phone number</label>
                            <input type="text" class="form-control" id="inputPhone" name="phone" maxlength="10" minlength="10" pattern="0[0-9]{9}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword">mot de pass</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputPassword" name="password" required>
                                <div class="input-group-prepend">
                                    <button class="password_visibility btn btn-outline-secondary" type="button">
                                        <span class="pass-icon" data-visible="hidden">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                        <span class="pass-icon d-none" data-visible="visible">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </button> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputConfirmPassword">verifier mot de pass</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputConfirmPassword" name="confirmPassword" required>
                                <div class="input-group-prepend">
                                    <button class="confirm-password_visibility btn btn-outline-secondary" type="button">
                                        <span class="pass-icon" data-visible="hidden">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                        <span class="pass-icon d-none" data-visible="visible">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCapaciteFinanciere">capacite financiere</label>
                            <input type="text" class="form-control" id="inputCapaciteFinanciere" name="capaciteFinanciere" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputTypeTravaille">type travaille</label>
                            <input type="text" class="form-control" id="inputTypeTravaille" name="typeTravaille" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputIdBank">id bank</label>
                            <input list="idBank" class="form-control" id="inputIdBank" name="idBank" minlength="10" maxlength="10" required>
                            <datalist id="idBank">
                                <option value="" selected disabled >choisis idBank</option>
                                <?php
                                    foreach($data as $idbank)
                                    {
                                        echo "<option value='".$idbank["numero_check"]."'>".$idbank["numero_check"]."</option>";
                                    }
                                ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPermission">permission</label>
                            <select class="form-control" id="inputPermission" name="permission">
                                <option value="" selected disabled >choisis permission</option>
                                <option value="CLIENT">CLIENT</option>
                                <option value="ADMIN">ADMIN</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCreated_at">Créé à</label>
                            <input type="text" class="form-control" id="inputCreated_at"   name="created_show" disabled>
                            <input type="text" name="created_at" value=""  hidden>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                             <label for="inputImageProfile">image prophile</label>
                             <input class="form-control-file" type="file" id="inputImageProfile" accept="image/png, image/jpeg" name="imageProfile" required>
                         </div>
                    </div>
                    
                    <button class="btn btn-primary mt-3" type="submit" name="ajouter-client">submit</button>
                </form>
            </section>

            
           
            
        </div> 
    </div>

    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/ajout-client.js"></script>
</body>
</html>

<?php unset($_SESSION['ERROR']); ?>
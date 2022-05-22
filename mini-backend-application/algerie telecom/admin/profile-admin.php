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

// $userID = $_GET["id"];

$data = array();
$sql = "SELECT * FROM admin";
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



// verify if password correct
if(isset($_POST["done-password"]))
{
    $this_password = $_POST['password'];

    $s = "SELECT password FROM admin";
    $verify = mysqli_query($db, $s);
    $pass_data = array();
    if(isset($verify)){
        while($row = mysqli_fetch_array($verify))
        {
            $pass_data [] = $row; 
        }
        
		if(md5($this_password) == $pass_data[0]['password']){
            header("Location: profile-admin-full.php");
        }else{
            //stay in same page
        }
    }else{
        //error

    }
}

if(isset($_POST["done-imageUrl"]))
{
    $imageUrl = $_POST["imageURL"];

    $sql_admin = "UPDATE `admin` SET `imageURL`='$imageUrl'  WHERE 1";
    $correct = mysqli_query($db, $sql_admin);
    if($correct){
        header("Location: profile-admin.php");
    }else{
        echo "Error 0";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon"  href="https://www.algerietelecom.dz/assets/front/img/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/profile-admin.css">
    <title>Profile</title>
</head>
<body>
    
    <div class="wrapper d-flex">

        <!-- Side bar -->
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-4">
                    <?php echo "<img src='".$data[0]["imageURL"]."' width=120 height=120 style='border-radius: 50%;'>";?>
                </a>
                <h2 class="text-center mb-5"><?= $data[0]["nom"]." ".$data[0]["prenom"]?></h2>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="#clientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users"></i> CLIENT</a>
                        <ul class="collapse list-unstyled" id="clientSubmenu">
                        <li><a href="./index.php"><i class="fa fa-cogs"></i> GENERAL</a></li>
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
                    <li class="active">
                        <a href="#parametreSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog"></i> PARAMETRE</a>
                        <ul class="collapse list-unstyled" id="parametreSubmenu">
                          <li class="active"><a href="./profile-admin.php"><i class="fa fa-user"></i> PROFILE</a> </li>
                          <li><a href="./profile-admin.php?logout='1'"><i class="fa fa-sign-out-alt"></i> LOGOUT</a></li>
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
                                <div class="dropdown active">
                                    <a class="nav-link dropdown-toggle" href="" id="navParametretSubmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paramètre</a>
                                    <div class="dropdown-menu" aria-labelledby="navParametretSubmenu">
                                        <a class="dropdown-item active" href="#">PROFILE</a>
                                        <a class="dropdown-item" href="./profile-admin.php?logout='1'">LOG OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="./notification.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <section class="content-page profile-admin">
                <div class="row row-1 mb-5 d-flex justify-content-center">
                    <div class="col-md-6 d-flex justify-content-lg-start justify-content-center align-items-center pl-5">
                        
                        <div class="img logo rounded-circle">
                            <?php echo "<img src='".$data[0]["imageURL"]."' width=200 height=200 style='border-radius: 50%;'>";?>
                            <label id="url-image"><i class="fa fa-pencil-alt fa-lg"></i></label>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center align-items-lg-start align-items-center">
                        <h1 class="display-4 mt-3 mt-md-0" style="text-align: center;"><strong><?php echo $data[0]['nom'] ." ". $data[0]['prenom']; ?></strong></h1>
                        <p><a><?php echo $data[0]['username']; ?></a> - Administrator</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 pl-5">
                        <h1><strong>Account</strong></h1>
                    </div>
                </div>
                <hr class="mb-5">
                <div class="row row-1 mb-3 ">
                    <div class="col-md-6 pl-md-5 d-flex justify-content-center justify-content-md-start">
                        <p><strong>ID</strong></p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <p><?php echo $data[0]['id']; ?></p>
                    </div>
                </div>
                <div class="row row-1 mb-3 ">
                    <div class="col-md-6 pl-md-5 d-flex justify-content-center justify-content-md-start">
                        <p><strong>Nom</strong></p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <p><?php echo $data[0]['nom']; ?></p>
                    </div>
                </div>
                <div class="row row-1 mb-3">
                    <div class="col-md-6 pl-md-5 d-flex justify-content-center justify-content-md-start">
                        <p><strong>Prenom</strong></p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <p><?php echo $data[0]['prenom']; ?></p>
                    </div>
                </div>
                <div class="row row-1 mb-3">
                    <div class="col-md-6 pl-md-5 d-flex justify-content-center justify-content-md-start">
                        <p><strong>Permission</strong></p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <p><?php echo $data[0]['permission']; ?></p>
                    </div>
                </div>
                <div class="row row-1 mb-3">
                    <div class="col-md-6 pl-md-5 d-flex justify-content-center justify-content-md-start">
                        <p><strong>Password</strong></p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <a href="#" id="show-password">Do you want to show your password?</a>
                    </div>
                </div>
            </section>



            <div class="popup-wrapper popup-wrapper-1">
                <div class="popup">
                    <div class="popup-close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="icon"><!-- Font Awesome Free 5.15.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) -->
                            <path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/>
                        </svg>
                    </div>
                    <div class="popup-content end-test-popup-content">
                        <form action="profile-admin.php" method="POST">
                            <label for="inputPassword">veuillez saisir votre mot de passe ici</label>
                            <input type="text" class="form-control" id="inputPassword" name="password" required>
                            <button class="btn btn-primary mt-2" id="done-password" name="done-password">Terminer</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="popup-wrapper popup-wrapper-2">
                <div class="popup">
                    <div class="popup-close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="icon"><!-- Font Awesome Free 5.15.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) -->
                            <path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/>
                        </svg>
                    </div>
                    <div class="popup-content end-test-popup-content">
                        <form action="profile-admin.php" method="POST">
                            <label for="inputImageURL">Entrer URL image:</label>
                            <input type="text" class="form-control" id="inputImageURL" name="imageURL" required>
                            <button class="btn btn-primary mt-2" id="done-imageUrl" name="done-imageUrl">Terminer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/profile-admin.js"></script>
</body>
</html>
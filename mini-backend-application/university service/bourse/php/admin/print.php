<?php
  session_start();

	if (!isset($_SESSION['admin'])) {
		$_SESSION['ERROR'] = "You must log in first";
		header('location: ./login.php');
	}

	if (isset($_GET['admin_out'])) {
		session_destroy();
		unset($_SESSION['admin']);
		header("location: ./login.php");
	}

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $conn=mysqli_connect("localhost","root","mysql","bourse");
        $q = "SELECT * FROM etudiants,formations WHERE etudiants.id = formations.id AND etudiants.id = '$id'";
        $r = mysqli_query($conn, $q);

        if($r)
        {
            while($row = mysqli_fetch_array($r))
            {
            $nom     = $row["nom"];
            $prenom  = $row["prenom"];
            $image   = $row["image"];
            $telephone = $row["telephone"];
            $address = $row["address"];
            $pays = $row["pays"];
            $compte = $row["banque"];
            $specialite = $row["specilite"];
            $info = $row["general"];
            $s1  = $row["s1"];
                             $s2 = $row["s2"];
                             $s3 = $row['s3'];
                             $s4 = $row['s4'];
                             $s5  = $row["s5"];
                             $s6 = $row["s6"];
                             $m1 = $row['m1'];
                             $m2 = $row['m2'];
                             $m3 = $row['m3'];
                             $m4 = $row['m4'];
                             $pfe= $row['pfe'];
                             $MG =  $row['MG'];
                             $MM =  $row['MM'];
                             $MME =  $row['MME'];
                             $auto_decision = $row["auto_decision"];
            }
        }
    }

  ?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>FSE - Bourse user</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5 mb-0">
            <div class="col d-flex flex-row justify-content-center">
                <picture>
                    <img src="../clients/image/<?php echo $image; ?>" style="transform: scale(0.4);" class="img-fluid img-thumbnail" alt="...">
                </picture>
            </div>
        </div>
        <div class="row" style="margin-top: -100px;">
            <div class="col d-flex flex-row justify-content-center">
               <h1><?php echo $nom." ".$prenom ?></h1>
            </div>
        </div>
        <div class="row">
        <h2>Les information:</h2>
        <hr class="bg-light">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6">
            <div class="border border-light bg-light p-2 rounded text-secondary">
                <p><strong>Telephone <i class="fa fa-phone-square" aria-hidden="true"></i> :</strong>&nbsp;<?php echo $telephone; ?></p>
                <p><strong>Address <i class="fa fa-location-arrow" aria-hidden="true"></i> :</strong>&nbsp;<?php echo $address; ?></p>
            </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6">
            <div class="border border-light bg-light p-2 rounded text-secondary">
                <p><strong>Pay <i class="fa fa-globe" aria-hidden="true"></i> :</strong>&nbsp; <?php echo $pays; ?></p>
                <p><strong>Compte <i class="fa fa-money" aria-hidden="true"></i> :</strong>&nbsp; <?php echo $compte; ?></p>
                <?php 
                $title = '';
                if($specialite == "BDD") { $title = "Base des données"; }
                else if($specialite == "DAW") { $title = "Developement application web"; }
                else if($specialite == "RS")  { $title = "Réseaux et securité"; }
                else { $title = "System d'information"; } ?>
                <p><strong>Specialité <i class="fa fa-graduation-cap" aria-hidden="true"></i> :</strong>&nbsp; <?php echo $title; ?></p>
            </div>
            </div>
            <div class="col-12 mt-5">
            <div class="border border-light bg-light p-2 rounded text-secondary">
                <p><strong>Information: <i class="fa fa-globe" aria-hidden="true"></i> :</strong></p>
                <?php echo $info; ?>
            </div>
            </div>
        </div>
        <br>
        <br>
        <hr>
        <!-- If user got License only print this only -->
        <div class="row">
        <h2>Formation License:</h2>
        <hr class="bg-light">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
                <p><strong>Semester 1:</strong>&nbsp;<?php echo $s1; ?> </p>
                <p><strong>Semester 2:</strong>&nbsp;<?php echo $s2; ?> </p>
            </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
            <p><strong>Semester 3:</strong>&nbsp;<?php echo $s3; ?> </p>
            <p><strong>Semester 4:</strong>&nbsp;<?php echo $s4; ?> </p>
            </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
            <p><strong>Semester 5:</strong>&nbsp;<?php echo $s5; ?> </p>
            <p><strong>Semester 6:</strong>&nbsp;<?php echo $s6; ?> </p>
            </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
            <p><strong>PFE note:</strong>&nbsp;<?php echo $pfe; ?></p>
            <p><strong>Moyenne general:</strong>&nbsp;<?php echo $MG; ?></p>
            </div>
            </div>
        </div>
        <br>
        <br>
        <hr>
            <!-- If user got License + Master print this too -->
        <div class="row">
        <h2>Formation Master:</h2>
        <hr class="bg-light">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
                <p><strong>Semester 1:</strong>&nbsp;<?php echo $m1; ?> </p>
                <p><strong>Semester 2:</strong>&nbsp;<?php echo $m2; ?></p>
            </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
            <p><strong>Semester 3:</strong>&nbsp;<?php echo $m3; ?> </p>
            <p><strong>Semester 4:</strong>&nbsp;<?php echo $m4; ?> </p>
            </div>
            </div>
        </div>
        <br>
        <br>
        <hr>
        <!-- Consultation -->
        <div class="row">
        <h2>Consultation condidat:</h2>
        <hr class="bg-light">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
                <ul>
                    <li><strong>Moynne general > 12:</strong>&nbsp;&nbsp;&nbsp;<?php if($MG > 12){ echo "<span class='badge bg-success rounded-pill text-white'><i class='fa fa-check-circle' aria-hidden='true'></i></span>";} else { echo "<span class='badge bg-danger rounded-pill text-white'><i class='fa fa-times-circle' aria-hidden='true'></i></span>"; } ?></li>
                    <li><strong>Meilleur Moyenne >= 13:</strong>&nbsp;&nbsp;&nbsp;<?php if($MM > 13){ echo "<span class='badge bg-success rounded-pill text-white'><i class='fa fa-check-circle' aria-hidden='true'></i></span>";} else { echo "<span class='badge bg-danger rounded-pill text-white'><i class='fa fa-times-circle' aria-hidden='true'></i></span>"; } ?></li>
                    <li><strong>Pas Moyenne Eliminatoir:</strong>&nbsp;&nbsp;&nbsp;<?php if($MME > 8.5){ echo "<span class='badge bg-success rounded-pill text-white'><i class='fa fa-check-circle' aria-hidden='true'></i></span>";} else { echo "<span class='badge bg-danger rounded-pill text-white'><i class='fa fa-times-circle' aria-hidden='true'></i></span>"; } ?></li>
                    <li><strong>Un des PFE >= 14:</strong>&nbsp;&nbsp;&nbsp;<?php if($pfe >= 14){ echo "<span class='badge bg-success rounded-pill text-white'><i class='fa fa-check-circle' aria-hidden='true'></i></span>";} else { echo "<span class='badge bg-danger rounded-pill text-white'><i class='fa fa-times-circle' aria-hidden='true'></i></span>"; } ?></li>
                </ul>
            </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 mb-4">
            <div class="border border-light bg-light p-2 rounded text-secondary">
            <p><strong>Decision final:</strong>&nbsp;&nbsp; <?php if($auto_decision == "accepted") { echo "<span class='badge bg-success rounded-pill text-white'>"; }else{ echo "<span class='badge bg-danger rounded-pill text-white'>"; }?><?php echo $auto_decision; ?></p>
            </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-row justify-content-center">
                <a href="./admin.php" style="text-decoration: none;">retour a la page ...</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
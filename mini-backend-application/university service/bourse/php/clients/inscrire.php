
<?php include('../../server/server.php');?>
<?php 
if (isset($_SESSION['username'])) {
		header('location: ./ajouter_bourse.php'); 
    } 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="https://www.univ-sba.dz/fse/wp-content/uploads/2019/07/cropped-LogoFSE-logo-32x32.png"
        sizes="32x32" />
    <link rel="icon" href="https://www.univ-sba.dz/fse/wp-content/uploads/2019/07/cropped-LogoFSE-logo-192x192.png"
        sizes="192x192" />
    <title>FSE &#8211; Service Bourse</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
   
        <div class="only-in-large hide-shape" id="shape"></div>
        <div class="only-in-large hide-shape" id="shape2"></div>
        <div class="only-in-large hide-shape" id="shape3"></div>
    

    <div class="container-fluid">

        <div class="row">
            <div
                class="col-12 mb-5 col-sm-12 col-md-5 d-md-none d-xl-none  d-xxl-none col-xl-5 col-xxl-5 d-flex flex-column align-items-center">
                <h1 style="color:whitesmoke;">FSE - Université Djilali liabes</h1>
                <h2><small style="color:yellowgreen;">Service Bourse</small></h2>
            </div>
            <div class="col-md-1 col-xl-1 col-xxl-1"></div>
            <div class="col-12 col-sm-12 col-md-5 col-xl-5 col-xxl-5">
                <div class="mb-5 d-none d-sm-none d-md-block d-xl-block d-xxl-block">
                    <h4 style="color:whitesmoke;">FSE - Université Djilali liabes</h4>
                    <h5><small style="color:yellowgreen;">- Service Bourse</small></h5>
                </div>

                <form class="row g-3 mt-5" action="./inscrire.php" method="POST">
                    
                    <h2 class="display-6 text-center m-0">Inscrivez vous</h2>
                    <p>
                        <label for="lab" class=" d-block">Votre Matricule:</label>
                    </p>
                    <div class="input-group mb-3">

                        <input type="text" name="matricule" class="form-control flat-field" id="matricule" value=""
                            placeholder="Remplir votre matricule" required>

                    </div>
                    <p>
                        <label for="lab" class=" d-block">Votre Credentials:</label>
                    </p>
                    <div class="input-group mb-3">
                        <span class="input-group-text spans">@</span>
                        <input type="email" class="form-control flat-field" name="email" id="email" value=""
                            placeholder="Remplir votre email" required>
                        <span class="input-group-text spans"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password" class="form-control flat-field" name="password" id="password" value=""
                            placeholder="Remplir votre mot de passe" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-app" type="submit" name="SIGNUP" value="SIGNUP">inscrivez vous</button>
                        <a class="btn btn-app-pass" style="text-decoration:none; color:white;"
                            href="./oublie_pass.php">Oublier votre mot de passe ?</a>
                    </div>
                    <?php if(count($errors) != 0)
                    { ?>
                    <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
                        <?php 
                            $i = 0;
                            while($i < count($errors))
                            {
                                echo "<p>".$errors[$i]."</p>";
                                $i++;                             
                            }
                        ?>
                    </div>
                    <?php } ?>
                </form>


            </div>

            <div class="col-md-1 col-xl-1 col-xxl-1"></div>
            <div
                class="d-none col-12 col-sm-6 col-md-5 d-md-block d-xl-block  d-xxl-block col-xl-5 col-xxl-5 d-flex flex-wrap">

                <img class="show" id="FSET" style="transform:scale(0.7);" src="../../images/LogoFSE-transparent.png"
                    alt="FSE-image-logo">
                <img class="hide" id="FSEC" style="transform:scale(0.7); display:none;" src="../../images/LogoFSE-2.png"
                    alt="FSE-image-logo">
            </div>
            <div class=" mt-5 col-12">
            </div>
            <div class=" mt-5 col-12">
            </div>
            <nav class="navbar fixed-bottom navbar-light" style="background-color: #36363680;">
                <div class="container-fluid">
                    <a class="navbar-brand" style="color: #ffffff; text-align:center;" href="../../index.html">
                        <strong>Reviendre a &nbsp;<span style="color: rgba(126, 239, 104, 1);">la page
                                principal.</span></strong>
                    </a>

                    <div class="d-flex align-items-center text-white">
                        <p style="margin-top: 20px;">Vous etes deja a member?</p> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="./login.php"><button class="btn btn-app" type="submit">rejoindre <i class="fa fa-sign-in"
                        aria-hidden="true"></i></button></a>
                    </div>
                </div>
            </nav>



        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="../../javascript/connecte.js"></script>
</body>

</html>
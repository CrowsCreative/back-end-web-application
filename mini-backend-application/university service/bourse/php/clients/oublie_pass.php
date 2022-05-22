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
    <link rel="stylesheet" href="../../css/login.css">
</head>

<body>
    <div class="container-fluid">

        <div class="row">
            <div
                class="col-12 mb-5 col-sm-12 col-md-5 d-md-none d-xl-none  d-xxl-none col-xl-5 col-xxl-5 d-flex flex-column align-items-center">
                <h1 style="color:#003150;">FSE - Université Djilali liabes</h1>
                <h2><small style="color:#3db166;">Service Bourse</small></h2>
            </div>
            <div class="col-md-2 col-xl-1 col-xxl-1"></div>
            <div class="col-12 col-sm-12 col-md-8 col-xl-5 col-xxl-5">
                <div class="mb-5 d-none d-sm-none d-md-block d-xl-block d-xxl-block">
                    <h4 style="color:#003150;">FSE - Université Djilali liabes</h4>
                    <h5><small style="color:#3db166;">- Service Bourse</small></h5>
                </div>

                <form class="row g-3 mt-5" action="./oublie_pass.php" method="POST">
                    
                    <h2 class="display-6 text-center m-0">Nouvelle mot de passe</h2>

                    <label for="code" class=" d-block">Donner le code:</label>
                    <div class="input-group mb-3">
                    
                        <input type="text" class="form-control flat-field" id="code" name="code" value=""
                            placeholder="Remplir votre Code de Setup" required>
                    </div>


                    <label for="password" class=" d-block">Donner nouvelle password:</label>
                    <div class="input-group mb-3">
                    
                    <span class="input-group-text spans"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password" class="form-control flat-field" id="password" name="password" value=""
                            placeholder="Remplir votre mot de passe" required>
                    </div>


                    <label for="password_confirme" class=" d-block">confirmez nouvelle password:</label> 
                    <div class="input-group mb-3">
                    
                    <span class="input-group-text spans"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password" class="form-control flat-field" id="password_confirme" name="password_confirme" value=""
                            placeholder="Remplir votre mot de passe" required>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-app" type="submit" name="PASSWORD" value="PASSWORD">envoyez</button>
                        <a class="btn btn-app-pass" style="text-decoration:none;"
                            href="./login.php">Rejoindre votre compte ?</a>
                    </div>

                    <?php if(count($errors_pass) != 0)
                    { ?>
                    <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
                        <?php 
                            $i = 0;
                            while($i < count($errors_pass))
                            {
                                echo "<p>".$errors_pass[$i]."</p>";
                                $i++;                             
                            }
                        ?>
                    </div>
                    <?php } ?>

                </form>


            </div>

            <div class="col-md-2 col-xl-1 col-xxl-1"></div>
            <div class="d-none col-12 col-sm-6 col-md-5 d-md-none d-xl-block d-xxl-block col-xl-5 col-xxl-5">
                <br>
                <br>
                <br>
                <br>
                <br>
                    <img src="../../images/pass.jpg" style="border-radius:50%; display:block; margin:0 auto;" width="350px" height="350px"  alt="picture of password reset">
            </div>
            <div class=" mt-5 col-12">
            </div>
            <div class=" mt-5 col-12">
            </div>
            <nav class="navbar fixed-bottom navbar-light" style="background-color: #003150;">
                <div class="container-fluid">
                    <a class="navbar-brand" style="color: #ffffff; text-align:center;" href="../../index.html">
                        <strong>Reviendre a &nbsp;<span style="color: #3db166;">la page
                                principal.</span></strong>
                    </a>

                    <div class="d-flex align-items-center text-white">
                        <p style="margin-top: 20px;">Vous etes pas a member?</p> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="./inscrire.php"><button class="btn btn-app" type="submit">Inscrivez vous <i class="fa fa-sign-in"
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
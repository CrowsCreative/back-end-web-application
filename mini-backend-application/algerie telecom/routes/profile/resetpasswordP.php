<?php
  session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['ERROR'] = "You must log in first";
		header('location: ../login/login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
    unset($_SESSION['id']);
		header("location: ../login/login.php");
	}

  $clientID = $_SESSION['id'];
  unset($_SESSION['ERROR']);
  ?>
<?php include("../../../server/firstdb.php"); ?>
<?php 

if(isset($_POST["submit"]))
{
    $password = $_POST["password1"];
    $confirmePassword = $_POST["password2"];

    if($password == $confirmePassword)
    {
        $password = md5($password);
        $sql = "UPDATE clientaccount SET password = '$password' WHERE id= '$clientID'";
        $correct = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on reset password<br/>" . mysqli_error($conn));
        if(isset($correct)) {
            $q = "UPDATE clientaccount SET isReset = 'true' WHERE id= '$clientID'";
            $reseted = mysqli_query($conn, $q) or die("<b>Error:</b> problem to set reset to true<br/>" . mysqli_error($conn));
            if($reseted)
            {
                $_SESSION["isReset"] = 'true';
                header("Location: profile.php");
            }
        }
    }

}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="./assets/stylesheet/app.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./assets/stylesheet/style.css">
    <title>Espace Client - Account</title>
    <style>
        body {
            font-family: "Oswald", "Helvetica Neue";
        }
        .success
{
border: 1px solid rgb(32, 180, 113);
box-shadow: 0 0 0 0.2rem rgb(32 180 113 / 25%);

}

.success:focus
{
border: 1px solid rgb(32, 180, 113);
box-shadow: 0 0 0 0.2rem rgb(32 180 113 / 25%);

}

.error
{
border: 1px solid orange;
box-shadow: 0 0 0 0.2rem rgb(255 165 0 / 25%);
}

.error:focus
{
border: 1px solid orange;
box-shadow: 0 0 0 0.2rem rgb(255 165 0 / 25%);
}

.unclick
{
    background-color: orange;
    color: white;
    padding-left: 1.5em;
    padding-right: 1.5em;
    
}

.unclick:hover
{
    background-color: orange;
    color: white;
    padding-left: 1.5em;
    padding-right: 1.5em;
    
}

.click
{
    background-color: #20b471;
    color: white;
    padding-left: 1.5em;
    padding-right: 1.5em;
    
}

.click:hover
{
    background-color: #00a959;
    color: white;
    padding-left: 1.5em;
    padding-right: 1.5em;
    
}
    </style>
</head>

<body class="bg-light">
    <div id="preloader"></div>
    <div id="circularMenu" class="circular-menu">

        <a class="floating-btn" id="f1">
            <i class="fa fa-plus"></i>
        </a>

        <menu class="items-wrapper">
            <a href="./userINF.php" class="menu-item fa fa-info-circle" data-toggle="tooltip" data-placement="left"
                title="Information personelle"></a>
            <a href="./carte.php" class="menu-item fa fa-credit-card" data-toggle="tooltip" data-placement="left"
                title="Voir la carte"></a>
            <a href="./contact.php" class="menu-item fas fa-comment-alt" data-toggle="tooltip" data-placement="left"
                title="Contact support"></a>
            <a href="#" class="menu-item fa fa-trash" data-toggle="modal" data-target="#exampleModal"
                data-toggle="tooltip" data-placement="left" title="Désabonement"></a>
        </menu>

    </div>


    <div id="circularMenu1" class="circular-menu circular-menu-left">

        <a class="floating-btn" id="f2">
            <i class="fa fa-bars"></i>
        </a>

        <menu class="items-wrapper">
            <a href="../../index.html" class="menu-item fa fa-home" data-toggle="tooltip" data-placement="right"
                title="Page d'accueil"></a>
            <a href="./purchase/purchase.php" class="menu-item fa fa-search" data-toggle="tooltip"
                data-placement="right" title="Page d'achat"></a>
            <a href="./profile.php" class="menu-item fa fa-id-card activation-circle-nav-navigation"
                data-toggle="tooltip" data-placement="right" title="Espace Client"></a>
            <a href="profile.php?logout='1'" class="menu-item fa fa-sign-out-alt" data-toggle="tooltip"
                data-placement="right" title="Déconnexion"></a>
        </menu>

    </div>
    <aside id="trash">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="background-color: transparent !important; outline: none;">
                            <img src="./assets/close.png" alt="close icon" style="width:1.5em; height: 1.5em;">
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Procedure du désabonement</h5>
                        <div>
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente
                                iure fuga consectetur facilis repudiandae minima nemo! Nesciunt, voluptates debitis.
                                Deserunt magni totam eveniet maiores ea similique natus nemo sunt repellendus!</p>
                        </div>
                        <form action="usub.php" method="POST">
                            <div class="form-group">
                                <p for="recipient-name">Ecrire <code style="color: #00a959">" supprimez mon compte
                                        "</code> pour terminer l'operation: </p>
                                <input type="text" class="form-control" id="recipient-name"
                                    pattern="supprimez mon compte" placeholder="supprimez mon compte" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="" data-dismiss="modal">Close</button>
                                <button type="submit" name="DELETE_client" value='DELETE' class="">Delete account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <section id="content">
        <div class="container">
            <div class="card o-hidden border-0 shadow my-5 ">
                <div class="card-header badge-primary">
                    <span class="d-xl-none date">date</span>
                    <span class="float-right">
                        <h2><span class="badge badge-clock clock"></span></h2>
                    </span>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-2"></div>
                            <div
                                class="col-lg-8 d-none d-sm-none d-md-flex d-lg-flex d-xl-flex justify-content-md-between justify-content-lg-between justify-content-xl-between">
                                <a id="item-nav-active" href="./profile.php"
                                    class="menu-item no-decoration text-center"><span id="nav-text">Espace
                                        client</span></a>
                                <a id="item-nav" href="./rechargement.php"
                                    class="menu-item no-decoration text-center"><span
                                        id="nav-text">Rechargement</span></a>
                                <a id="item-nav" href="./demande.php" class="menu-item no-decoration text-center"><span
                                        id="nav-text">Demande en
                                        ligne</span></a>
                                <a id="item-nav" href="./network.php" class="menu-item no-decoration text-center"><span
                                        id="nav-text">Notre
                                        réseaux</span></a>
                            </div>

                            <div class="col-lg-8 d-md-none">
                                <a class="btn btn-success d-md-none" data-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample"><i
                                        class="fa fa-bars"></i></a>
                                <div class="collapse" id="collapseExample">
                                    <a id="item-sm-nav-active" href="./profile.php"
                                        class="menu-item no-decoration text-center"><span id="nav-text">Espace
                                            client</span></a>
                                    <a id="item-sm-nav" href="./rechargement.php"
                                        class="menu-item no-decoration text-center "><span
                                            id="nav-text">Rechargement</span></a>
                                    <a id="item-sm-nav" href="./demande.php"
                                        class="menu-item no-decoration text-center "><span id="nav-text">Demande
                                            en ligne</span></a>
                                    <a id="item-sm-nav" href="./network.php"
                                        class="menu-item no-decoration text-center "><span id="nav-text">Notre
                                            réseaux</span></a>
                                </div>
                            </div>



                            <div class="col-lg-2"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="main">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <div class="card shadow rounded" style="width: 40rem;">
                            <div class="card-header">
                                Choissisez un mot de passe fort
                            </div>
                            <div class="card-body">
                                <div class="container" style="margin-top: -2.5em;">
                                <form action="resetpasswordP.php" method="POST">
                                <div class="form-group">
                                <label for="password1" style="margin-left:4px;">mot de passe:</label>
                                <input type="text" class="form-control" name="password1" id="password1" aria-describedby="passwordhelp" min-length="9" required>
                                <small id="passwordhelp" class="form-text text-muted">Votre mot de passe doit contient maj/min/num et caractere special avec longeur du 9.</small>
                            </div>
                            <div class="form-group">
                                <label for="password2" style="margin-left:4px;">confirmez mot de passe:</label>
                                <input type="text" class="form-control" name="password2" id="password2" aria-describedby="passwordhelp"  required>
                            </div>
                            <button type="submit" name="submit" id="submit" class="border-0 unclick" disabled>Modifier</button>
                                </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
const password1 = document.querySelector("#password1");
const password2 = document.querySelector("#password2");
const pattern = /(?=.*[A-Z])(?=.*[a-z])(?=.*[\d])(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?]).{9,}/g;
const submit = document.querySelector('#submit');
password1.addEventListener("keyup", (e)=>
{
    if(password1.value.match(pattern))
    {
        e.target.classList.add("success");
        e.target.classList.remove("error");
       
    }else
    {
      e.target.classList.add("error");
      e.target.classList.remove("success");
      
    }
    if(password1.value === password2.value)
    {
        submit.removeAttribute('disabled');
        submit.classList.remove("unclick");
        submit.classList.add("click");
    }
});

password2.addEventListener("keyup", (e)=>
{
    if(password2.value.match(pattern) && password1.value === password2.value)
    {
        e.target.classList.add("success");
        e.target.classList.remove("error");
        submit.removeAttribute('disabled');
        submit.classList.remove("unclick");
        submit.classList.add("click");
    }else
    {
      e.target.classList.add("error");
      e.target.classList.remove("success");
    }
});


    </script>
    <section id="footer">
        <div class="container-fluid badge-primary d-none d-lg-block">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-lg-4 d-flex flex-column justify-content-center" style="height: 10em;">
                        <h4>Navigation</h4>
                        <p><a class="no-decoration-simple" href="../../index.html">Page d'accueil</a></p>
                        <p><a class="no-decoration-simple" href="./carte.php">Page d'affichage du code</a></p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column justify-content-center" style="height: 10em;">
                        <h4>Resources</h4>
                        <p><a class="no-decoration-simple"
                                href="https://www.algerietelecom.dz/fr/particuliers">Particuliers</a></p>
                        <p><a class="no-decoration-simple"
                                href="https://www.algerietelecom.dz/fr/entreprises">Professionnels</a>
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column justify-content-center" style="height: 10em;">
                        <h4>Profile et operations</h4>
                        <p><a class="no-decoration-simple" href="./userINF.php" style="display: block !important;">Voir
                                vos informations</a></p>
                        <p><a class="no-decoration-simple" href="./contact.php" style="display: block !important;">Voir
                                vos contact</a></p>
                    </div>
                </div> <!-- third row-->
            </div>
        </div>
    </section>
    <section id="footer2">
        <div class="container-fluid badge-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex justify-content-center">

                        <img src="https://www.algerietelecom.dz/assets/front/img/logo.svg"
                            style="width: 9em; height: 9em;" alt="">

                    </div>
                    <div class="col-lg-4 text-center d-flex justify-content-center align-items-center">
                        <p style="margin-top: 2.5em;">Algérie Télécom &copy; e-commerce service 2021</p>
                    </div>
                    <div class="col-lg-1">

                    </div>
                    <div class="col-lg-2 d-flex justify-content-center align-items-center justify-content-lg-around align-items-lg-center"
                        style="margin-top: 1.2em;">
                        <a class="social linkedin mx-2 mx-lg-none  mb-3 mb-lg-0"
                            href="http://www.linkedin.com/company/algerie-telecom"><i class="fab fa-linkedin"></i></a>
                        <a class="social youtube mx-2 mx-lg-none  mb-3 mb-lg-0"
                            href="https://www.youtube.com/user/Tvalgerietelecom"><i class="fab fa-youtube"></i></a>
                        <a class="social discord mx-2 mx-lg-none  mb-3 mb-lg-0" href="https://discord.gg/csQcs7AJ"><i
                                class="fab fa-discord"></i></a>
                        <a class="instagram mx-2 mx-lg-none mb-3 mb-lg-0"
                            href="http://www.instagram.com/algerietelecom"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="col-lg-1">

                    </div>
                </div> <!-- third row-->
            </div>
        </div>
    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='../../js/jquery.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <!--script src="./dist/script.js" type="text/JavaScript"></script-->

    <script src='https://npmcdn.com/react@15.3.0/dist/react.min.js'></script>
    <script src='https://npmcdn.com/react-dom@15.3.0/dist/react-dom.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment-with-locales.min.js'></script>
    <script src="./assets/script/script.js"></script>
    <script type="text/javascript">
        $('.menu-item').tooltip()
    </script>
</body>

</html>
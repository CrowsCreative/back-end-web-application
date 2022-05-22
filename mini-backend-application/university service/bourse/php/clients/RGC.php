<?php
  session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['ERROR'] = "tu doit etre authentifier";
		header('location: ./login.php');
	}

	if (isset($_GET['logout_user'])) {
		session_destroy();
		unset($_SESSION['username']);
        unset($_SESSION['id']);
		header("location: ./login.php");
	}

    if (isset($_GET['delete_user'])) {
        //SQL DELETE (USER REQUEST ACCOUNT + BOURSE REQUEST)
		session_destroy();
		unset($_SESSION['username']);
        unset($_SESSION['id']);
		header("location: ./login.php");
	}

  $clientID = $_SESSION['id'];
  $errors_tag = array();
  $conn=mysqli_connect("localhost","root","mysql","bourse");
  if ($_POST['SAVE'] == 'SAVE' && isset($_POST['SAVE'])) {
    
    $tag  = mysqli_real_escape_string($conn, $_POST['tag']);
    if (empty($tag)) {
        array_push($errors_tag, "champ tag est obligatoire");
    }
    

    if (count($errors_tag) == 0) {

            
            $sql = "UPDATE compte SET `code` = '$tag' WHERE id='$clientID'";
            $updated = mysqli_query($conn, $sql);
            if($updated)
            {
            $_SESSION['code'] = $tag;
            header('location: ./ajouter_bourse.php');
            
            }else
            {
                array_push($errors_tag, "server error, veuillez resseyez plus tard!");
            }

        }}
  //unset($_SESSION['ERROR']);
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../css/owl.carousel.min.css">

    <link rel="stylesheet" href="../../css/animate.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../../css/box.css">

    <title>FSE - Service Bourse</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700,800');
        @import url('https://fonts.googleapis.com/css?family=Lobster');

        html {
            font-size: 70%;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.6rem;
            font-weight: 400;
        }

        h1 {
            margin-bottom: 0.5em;
            font-size: 3.6rem;
        }

        p {
            margin-bottom: 0.5em;
            font-size: 1.6rem;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 25px;
            border-radius: 4px;
        }

        .button-primary {
            position: relative;
            background-color: #003150;
            color: #003150;
            font-size: 1.8rem;
            font-weight: 700;
            transition: color 0.3s ease-in;
            z-index: 1;
        }

        .button-primary:hover {
            color: #003150;
            text-decoration: none;
        }

        .button-primary::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background-color: #003150;
            border-radius: 4px;
            opacity: 0;
            -webkit-transform: scaleX(0.8);
            -ms-transform: scaleX(0.8);
            transform: scaleX(0.8);
            transition: all 0.3s ease-in;
            z-index: -1;
        }

        .button-primary:hover::after {
            opacity: 1;
            -webkit-transform: scaleX(1);
            -ms-transform: scaleX(1);
            transform: scaleX(1);
        }

        .overlay::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background-color: #fff;
        }

        .header-area {
            position: relative;
            height: 30vh;
            background: none;
            background-attachment: fixed;
            background-position: center center;
            background-repeat: no-repear;
            background-size: cover;
        }

        .banner {
            display: flex;
            align-items: center;
            position: relative;
            height: 100%;
            color: #003150;
            text-align: center;
            z-index: 1;
        }

        .banner h1 {
            font-weight: 800;
        }

        .banner p {
            font-weight: 700;
        }

        .navbar {
            position: absolute;
            left: 0;
            top: 0;
            padding: 0;
            width: 100%;
            transition: background 0.6s ease-in;
            z-index: 99999;
        }

        .navbar .navbar-brand {
            font-family: 'consolas', cursive;
            font-size: 2.5rem;
            color: #003150;
        }

        .navbar .navbar-toggler {
            position: relative;
            height: 50px;
            width: 50px;
            border: none;
            cursor: pointer;
            outline: none;
        }

        .navbar .navbar-toggler .menu-icon-bar {
            position: absolute;
            left: 15px;
            right: 15px;
            height: 2px;
            background-color: #003150;
            opacity: 0;
            -webkit-transform: translateY(-1px);
            -ms-transform: translateY(-1px);
            transform: translateY(-1px);
            transition: all 0.3s ease-in;
        }

        .navbar .navbar-toggler .menu-icon-bar:first-child {
            opacity: 1;
            -webkit-transform: translateY(-1px) rotate(45deg);
            -ms-sform: translateY(-1px) rotate(45deg);
            transform: translateY(-1px) rotate(45deg);
        }

        .navbar .navbar-toggler .menu-icon-bar:last-child {
            opacity: 1;
            -webkit-transform: translateY(-1px) rotate(135deg);
            -ms-sform: translateY(-1px) rotate(135deg);
            transform: translateY(-1px) rotate(135deg);
        }

        .navbar .navbar-toggler.collapsed .menu-icon-bar {
            opacity: 1;
        }

        .navbar .navbar-toggler.collapsed .menu-icon-bar:first-child {
            -webkit-transform: translateY(-7px) rotate(0);
            -ms-sform: translateY(-7px) rotate(0);
            transform: translateY(-7px) rotate(0);
        }

        .navbar .navbar-toggler.collapsed .menu-icon-bar:last-child {
            -webkit-transform: translateY(5px) rotate(0);
            -ms-sform: translateY(5px) rotate(0);
            transform: translateY(5px) rotate(0);
        }

        .navbar-dark .navbar-nav .nav-link {
            position: relative;
            color: #003150;
            font-size: 1.6rem;

        }

        .navbar-dark .navbar-nav .nav-link:focus,
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:active {
            color: #003150;
        }

        .navbar .dropdown-menu {
            padding: 0;
            background-color: #003150;
            ;
        }

        .navbar .dropdown-menu .dropdown-item {
            position: relative;
            padding: 10px 20px;
            color: white;
            ;
            font-size: 1.4rem;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            transition: color 0.2s ease-in;
        }

        .navbar .dropdown-menu .dropdown-item:last-child {
            border-bottom: none;
        }

        .navbar .dropdown-menu .dropdown-item:hover {
            background: #003150;
            color: #3db166;
        }

        .navbar .dropdown-menu .dropdown-item::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            top: 0;
            width: 5px;
            background-color: #3db166;
            opacity: 0;
            transition: opacity 0.2s ease-in;
        }

        .navbar .dropdown-menu .dropdown-item:hover::before {
            opacity: 1;
        }

        .navbar.fixed-top {
            position: fixed;
            -webkit-animation: navbar-animation 0.6s;
            animation: navbar-animation 0.6s;
            background-color: rgba(255, 255, 255, 0.9);
            color: white;
        }

        .navbar.fixed-top.navbar-dark .navbar-nav .nav-link.active {
            color: #3db166;
        }

        .navbar.fixed-top.navbar-dark .navbar-nav .nav-link::after {
            background-color: #3db166;
        }

        .content {
            padding: 120px 0;
        }

        @media screen and (max-width: 768px) {
            .navbar-brand {
                margin-left: 20px;
            }

            .navbar-nav {
                padding: 0 20px;
                background: #fff;
            }

            .navbar.fixed-top .navbar-nav {
                background: #fff;
            }
        }

        @media screen and (min-width: 767px) {
            .banner {
                padding: 0 150px;
            }

            .banner h1 {
                font-size: 5rem;
            }

            .banner p {
                font-size: 2rem;
            }

            .navbar-dark .navbar-nav .nav-link {
                padding: 23px 15px;
            }

            .navbar-dark .navbar-nav .nav-link::after {
                content: '';
                position: absolute;
                bottom: 15px;
                left: 30%;
                right: 30%;
                height: 5px;
                background-color: #3db166;
                -webkit-transform: scaleX(0);
                -ms-transform: scaleX(0);
                transform: scaleX(0);
                transition: transform 0.1s ease-in;
            }

            .navbar-dark .navbar-nav .nav-link:hover::after {
                -webkit-transform: scaleX(1);
                -ms-transform: scaleX(1);
                transform: scaleX(1);
            }

            .dropdown-menu {
                min-width: 200px;
                -webkit-animation: dropdown-animation 0.3s;
                animation: dropdown-animation 0.3s;
                -webkit-transform-origin: top;
                -ms-transform-origin: top;
                transform-origin: top;
            }
        }

        @-webkit-keyframes navbar-animation {
            0% {
                opacity: 0;
                -webkit-transform: translateY(-100%);
                -ms-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                -ms-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes navbar-animation {
            0% {
                opacity: 0;
                -webkit-transform: translateY(-100%);
                -ms-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                -ms-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @-webkit-keyframes dropdown-animation {
            0% {
                -webkit-transform: scaleY(0);
                -ms-transform: scaleY(0);
                transform: scaleY(0);
            }

            75% {
                -webkit-transform: scaleY(1.1);
                -ms-transform: scaleY(1.1);
                transform: scaleY(1.1);
            }

            100% {
                -webkit-transform: scaleY(1);
                -ms-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        @keyframes dropdown-animation {
            0% {
                -webkit-transform: scaleY(0);
                -ms-transform: scaleY(0);
                transform: scaleY(0);
            }

            75% {
                -webkit-transform: scaleY(1.1);
                -ms-transform: scaleY(1.1);
                transform: scaleY(1.1);
            }

            100% {
                -webkit-transform: scaleY(1);
                -ms-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        .container-fluid {
            overflow: hidden;
            margin-top: 250px;
            background: #262626;
            color: #627482 !important;
            margin-bottom: 0;
            padding-bottom: 0
        }

        /* import local fonts */
@font-face {
    font-family: 'Aileron';
    src: url('./fonts/web-fonts/aileron_regular_macroman/Aileron-Regular-webfont.woff') format('woff');
}

@font-face {
    font-family: 'Aileron-light';
    src: url('./fonts/web-fonts/aileron_light_macroman/Aileron-Light-webfont.woff') format('woff');
}

@font-face {
    font-family: 'Aileron-heavy';
    src: url('./fonts/web-fonts/aileron_heavy_macroman/Aileron-Heavy-webfont.woff') format('woff');
}

@font-face {
    font-family: 'Aileron-bold';
    src: url('./fonts/web-fonts/aileron_bold_macroman/Aileron-Bold-webfont.woff') format('woff');
}

* {
    outline: none;
}



.container-generator {
    
    box-shadow: 0px 2px 10px #090913a6;
    padding: 20px;
    width: 550px;
    max-width: 100%;
}

.results-container {
    background-color:#3db16655;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    position: relative;
    font-size: 18px;
    letter-spacing: 1px;
    height: 50px;
    width: 100%;
}

.results-container .btn {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 40px;
    height: 40px;
    font-size: 20px;
}

.btn {
    border: none;
    background-color:#3db166;
    color: white;
    font-size: 16px;
    padding: 8px 12px;
    cursor: pointer;
    
}

.copy
{
    background-color:#262626;
    color:white;
}
.btn-large {
    display: block;
    width: 100%;
    transition: all 0.2s ease-in-out;
}
.btn-large:hover {
    background-color:#3db166;
    transform: scale(1.1);
    
}
.setting {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 15px 0;
}


   

.results-container #result {
    word-wrap: break-word;
    max-width: calc(100% - 40px);
    padding-left: 10px;
}
    </style>
</head>

<body>

    <header class="header-area overlay">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a href="#" style="color:#003150;" class="navbar-brand">
                    <strong>F.S.E</strong>


                    <small style="color: #3db166; display:block;">Departement Informatique</small></a>

                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                </button>

                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li><a href="./ajouter_bourse.php" class="nav-item nav-link">Account</a></li>
                        <li><a href="../../index.html" class="nav-item nav-link">University</a></li>
                        <li><a href="./RGC.php" class="nav-item nav-link">RCG</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-item nav-link" style="color:#003150; text-decoration:none"
                                data-toggle="dropdown">Action</a>
                            <div class="dropdown-menu">
                                <a href="ajouter_bourse.php?logout_user='1'" class="dropdown-item">Logout</a>
                                <a href="ajouter_bourse.php?delete_user='1'" class="dropdown-item">Delete account</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container d-flex flex-row justify-content-center">
        <form action="./RGC.php" method="POST">
        <div class="container-generator">        
        <div class="row ">
            <div class="col">
            <h2>Generez nouvelle code:</h2>
        <div class="results-container">
            <span id="result">

            </span>
            <button class="btn" id="clipboard" type="button">
                <i class="fas fa-clipboard-check"></i>
            </button>
        </div>
        <div class="settings">
            <div class="setting">
                <label for="length">Longeur mot de passe</label>&nbsp;&nbsp;&nbsp;
                <input type="number" id="length" name="length" min="5" max="20" value="7">
            </div>
            <div class="setting">
                <input class="regular-checkbox" type="checkbox" id="uppercase" checked hidden>
            </div>
            <div class="setting">
                <input class="regular-checkbox" type="checkbox" id="numbers" checked hidden>
            </div>
        </div>
        <input type="text" name="tag" id="tag" value="" hidden>
        <button class="btn btn-large" type="button">Generate password</button>
            </div>   
    </div>
    
            </div>
            <br>
            <br>
            <br>
            <center>
                <button class="btn btn-success" name="SAVE" value="SAVE">sauvgarder restoration</button>
            </center>
            </form>
        </div>
     
        <div class="container mt-5">
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col-4">
                <?php if(count($errors_tag) != 0)
                    { ?>
                    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                        <?php 
                            $i = 0;
                            while($i < count($errors_tag))
                            {
                                echo "<p>".$errors_tag[$i]."</p>";
                                $i++;                             
                            }
                            unset($errors_tag);
                        ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    
                </div>
            </div>
            
            </div>
    <div class="container-fluid pb-0 mb-0 justify-content-center text-light ">
        <footer>
            <div class="row my-5 justify-content-center py-5">
                <div class="col-11">
                    <div class="row ">
                        <div class="col-xl-8 col-md-4 col-sm-4 col-12 my-auto mx-auto a">
                            <img src="../../images/LogoFSE-transparent.png" width="25%" heigth="25%" alt="">
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                            <h6 class="mb-3 mb-lg-4 bold-text "><b>MENU</b></h6>
                            <ul class="list-unstyled">
                                <li><a href="#" style="color: white; text-decoration:none;">Account</a></li>
                                <li><a href="../../index.html"
                                        style="color: white; text-decoration:none;">University</a></li>
                                <li><a href="./rgc.php" style="color: white; text-decoration:none;">Generateur de
                                        code</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                            <h6 class="mb-3 mb-lg-4 text-muted bold-text mt-sm-0 mt-5"><b>ADDRESS</b></h6>
                            <p class="mb-1">Sidi bel abbes, maconnais cité miltaire 120</p>
                            <p>22000</p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-xl-8 col-md-4 col-sm-4 col-auto my-md-0 mt-5 order-sm-1 order-3 align-self-end">
                            <p class="social text-muted mb-0 pb-0 bold-text"> <span class="mx-2"><i
                                        class="fa fa-facebook" aria-hidden="true"></i></span> <span class="mx-2"><i
                                        class="fa fa-linkedin-square" aria-hidden="true"></i></span> <span
                                    class="mx-2"><i class="fa fa-twitter" aria-hidden="true"></i></span> <span
                                    class="mx-2"><i class="fa fa-instagram" aria-hidden="true"></i></span> </p><small
                                class="rights"><span>&#174;</span> Tout les droit sont reservez.</small>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-4 col-auto order-1 align-self-end ">
                            <h6 class="mt-55 mt-2 text-muted bold-text"><b>Amel dz</b></h6><small> <span><i
                                        class="fa fa-envelope" aria-hidden="true"></i></span> Amel@gmail.com</small>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-4 col-auto order-2 align-self-end mt-3 ">
                            <h6 class="text-muted bold-text"><b>Amel binome dz</b></h6><small><span><i
                                        class="fa fa-envelope" aria-hidden="true"></i></span>
                                AmelBinome@gmail.com</small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="../../javascript/rgc.js"></script>
    <script src="../../javascript/jquery-3.3.1.min.js"></script>
    <script src="../../javascript/popper.min.js"></script>
    <script src="../../javascript/bootstrap.min.js"></script>
    <script src="../../javascript/owl.carousel.min.js"></script>
    <script src="../../javascript/main.js"></script>
    <script>
        jQuery(function ($) {
            $(window).on('scroll', function () {
                if ($(this).scrollTop() >= 200) {
                    $('.navbar').addClass('fixed-top');
                } else if ($(this).scrollTop() == 0) {
                    $('.navbar').removeClass('fixed-top');
                }
            });

            function adjustNav() {
                var winWidth = $(window).width(),
                    dropdown = $('.dropdown'),
                    dropdownMenu = $('.dropdown-menu');

                if (winWidth >= 768) {
                    dropdown.on('mouseenter', function () {
                        $(this).addClass('show')
                            .children(dropdownMenu).addClass('show');
                    });

                    dropdown.on('mouseleave', function () {
                        $(this).removeClass('show')
                            .children(dropdownMenu).removeClass('show');
                    });
                } else {
                    dropdown.off('mouseenter mouseleave');
                }
            }

            $(window).on('resize', adjustNav);

            adjustNav();
        });
    </script>
</body>
</html>
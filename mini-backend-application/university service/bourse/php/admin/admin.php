<?php
  session_start();
  $conn=mysqli_connect("localhost","root","mysql","bourse");

	if (!isset($_SESSION['admin'])) {
		$_SESSION['ERROR'] = "You must log in first";
		header('location: ./login.php');
	}

	if (isset($_GET['admin_out'])) {
		session_destroy();
		unset($_SESSION['admin']);
		header("location: ./login.php");
	}

    if ($_POST['FALSE'] == 'FASLE' && isset($_POST['FALSE'])) {
		
        $identity = mysqli_real_escape_string($conn, $_POST['id']);
        $identity = intval($identity);

        $requestdb  = "UPDATE `etudiants` SET `status`='end' WHERE id='$identity'";
        $executereq =  mysqli_query($conn, $requestdb);
            
            if($executereq)
            {
                $requestdb2  = "UPDATE formations SET decision='refused' WHERE id=$identity";
                $executereq2 =  mysqli_query($conn, $requestdb2);
    
                if($executereq2){
                
                    header('Location: ./admin.php');
                }

    }}else if($_POST['TRUE'] == 'TRUE' && isset($_POST['TRUE']))
    {
        $identity = mysqli_real_escape_string($conn, $_POST['id']);
        $identity = intval($identity);

        $requestdb  = "UPDATE `etudiants` SET `status`='end' WHERE id='$identity'";
        $executereq =  mysqli_query($conn, $requestdb);
            
            if($executereq)
            {
                $requestdb2  = "UPDATE formations SET decision='accepted' WHERE id=$identity";
                $executereq2 =  mysqli_query($conn, $requestdb2);
    
                if($executereq2){
                
                    header('Location: ./admin.php');
                }

    }}
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,900&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="../../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../../css/owl.carousel.min.css">

    <link rel="stylesheet" href="../../css/animate.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../../css/box.css">

    <title>FSE - Admin Service Bourse</title>
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

        small {
            font-size: calc(12px + (15 - 12) * ((100vw - 360px) / (1600 - 360))) !important
        }

        .bold-text {
            color: #989c9e !important
        }

        .mt-55 {
            margin-top: calc(50px + (60 - 50) * ((100vw - 360px) / (1600 - 360))) !important
        }

        h3 {
            font-size: calc(34px + (40 - 34) * ((100vw - 360px) / (1600 - 360))) !important
        }


        h4 {
            font-size: calc(24px + (40 - 34) * ((80vw - 200px) / (1600 - 360))) !important;
            font-weight: 500;
            text-decoration: underline;
            color: #3db166;
        }

        .social {
            font-size: 21px !important
        }

        .rights {
            font-size: calc(10px + (12 - 10) * ((100vw - 360px) / (1600 - 360))) !important
        }

        .disappear {
            display: none;
        }

        .sh {
            animation: showing 0.9s;
            opacity: 100%;
        }


        @keyframes showing {
            0% {
                opacity: 0%;
            }

            100% {
                opacity: 100%;
            }
        }

.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
        .card {
            width: 450px;
            height: 250px;
            background-color: #fff;
            background: linear-gradient(#f8f8f8, #fff);
            box-shadow: 0 8px 16px -8px rgba(0, 0, 0, 0.4);
            border-radius: 6px;
            overflow: hidden;
            position: relative;
            margin: 1.5rem;
        }

        .card h1 {
            text-align: center;
        }

        .card .additional {
            position: absolute;
            width: 150px;
            height: 100%;
            background: linear-gradient(#dE685E, #EE786E);
            transition: width 0.4s;
            overflow: hidden;
            z-index: 2;
        }

        .card.green .additional {
            background: linear-gradient(#92bCa6, #A2CCB6);
        }


        .card:hover .additional {
            width: 100%;
            border-radius: 0 5px 5px 0;
        }

        .card .additional .user-card {
            width: 150px;
            height: 100%;
            position: relative;
            float: left;
        }

        .card .additional .user-card::after {
            content: "";
            display: block;
            position: absolute;
            top: 10%;
            right: -2px;
            height: 80%;
            border-left: 2px solid rgba(0, 0, 0, 0.025);
        }

        .card .additional .user-card .level,
        .card .additional .user-card .points {
            top: 15%;
            color: #fff;
            text-transform: uppercase;
            font-size: 0.75em;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.15);
            padding: 0.125rem 0.75rem;
            border-radius: 100px;
            white-space: nowrap;
        }

        .card .additional .user-card .points {
            top: 85%;
        }

        .card .additional .user-card svg {
            top: 50%;
        }

        .card .additional .more-info {
            width: 300px;
            float: left;
            position: absolute;
            left: 150px;
            height: 100%;
        }

        .card .additional .more-info h1 {
            color: #fff;
            margin-bottom: 0;
        }

        .card.green .additional .more-info h1 {
            color: #224C36;
        }

        .card .additional .coords {
            margin: 0 1rem;
            color: #fff;
            font-size: 1rem;
        }

        .card.green .additional .coords {
            color: #325C46;
        }

        .card .additional .coords span+span {
            float: right;
        }

        .card .additional .stats {
            font-size: 2rem;
            display: flex;
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            right: 1rem;
            top: auto;
            color: #fff;
        }

        .card.green .additional .stats {
            color: #325C46;
        }

        .card .additional .stats>div {
            flex: 1;
            text-align: center;
        }

        .card .additional .stats i {
            display: block;
        }

        .card .additional .stats div.title {
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .card .additional .stats div.value {
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1.5rem;
        }

        .card .additional .stats div.value.infinity {
            font-size: 2.5rem;
        }

        .card .general {
            width: 300px;
            height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
            box-sizing: border-box;
            padding: 1rem;
            padding-top: 0;
        }

        .card .general .more {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            font-size: 0.9em;
        }

        .cds {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.c {
  margin: 20px;
  padding: 20px;
  width: 300px;
  min-height: 100px;
  display: grid;
  grid-template-rows: 20px 50px 1fr 50px;
  border-radius: 10px;
  box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
  transition: all 0.2s;
}

.c:hover {
  box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
  transform: scale(1.01);
}

.card__link,
.card__exit,
.card__icon {
  position: relative;
  text-decoration: none;
  color: rgba(255, 255, 255, 0.9);
}

.card__link::after {
  position: absolute;
  top: 25px;
  left: 0;
  content: "";
  width: 0%;
  height: 3px;
  background-color: rgba(255, 255, 255, 0.6);
  transition: all 0.5s;
}

.card__link:hover::after {
  width: 100%;
}

.card__exit {
  grid-row: 1/2;
  justify-self: end;
}

.card__icon {
  grid-row: 2/3;
  font-size: 30px;
}

.card__title {
  grid-row: 3/4;
  font-weight: 400;
  color: #ffffff;
}

.card__apply {
  grid-row: 4/5;
  align-self: center;
}

/* CARD BACKGROUNDS */

.card-1 {
  background: radial-gradient(#1fe4f5, #3fbafe);
}

.card-2 {
  background: radial-gradient(#fbc1cc, #fa99b2);
}

.card-3 {
  background: radial-gradient(#76b2fe, #b69efe);
}

.card-4 {
  background: radial-gradient(#60efbc, #58d5c9);
}

.card-5 {
  background: radial-gradient(#f588d8, #c0a3e5);
}

/* RESPONSIVE */

@media (max-width: 1600px) {
  .cards {
    justify-content: center;
  }
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
                        <li><a href="./admin.php" class="nav-item nav-link">Account</a></li>
                        <li><a href="../../index.html" class="nav-item nav-link">University</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-item nav-link" style="color:#003150; text-decoration:none"
                                data-toggle="dropdown">Action</a>
                            <div class="dropdown-menu">
                                <a href="admin.php?admin_out='1'" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php 
    $conn=mysqli_connect("localhost","root","mysql","bourse");
    $q = "SELECT count(id) FROM `compte`";
    $r = mysqli_query($conn, $q);
    $number = 0;
        if($r)
        {
            
            while($row = mysqli_fetch_array($r))
            {
            $number  = $row["count(id)"];
            }
        }


    $q2 = "SELECT count(decision) FROM `formations` WHERE decision='accepted'";
    $r2 = mysqli_query($conn, $q2);
    $number2 = 0;
    if($r2)
        {
                
        while($row = mysqli_fetch_array($r2))
        {
            $number2  = $row["count(decision)"];
        }

        }


    $q3 = "SELECT max(MG) as maximum FROM `formations`";
    $r3 = mysqli_query($conn, $q3);
    $number3 = 0;
    if($r3)
        {
                    
        while($row = mysqli_fetch_array($r3))
        {
            $number3  = $row["maximum"];
        }
    
        }
    ?>
    <div class="container d-flex flex-row justify-content-center" style="margin-top: -100px; margin-bottom:100px;">
        <div class="row" style="margin-top: 100px;">
        <div class="cds">
    <div class="c card-1">
      <div class="card__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></div>
      <p class="card__exit"><i class="fas fa-times"></i></p>
      <h2 class="card__title text-center display-4"><?php echo $number3; ?></h2>
      <p class="card__apply text-white">
        Meilleur Moyenne General
      </p>
    </div>
    <div class="c card-4">
      <div class="card__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg></div>
      <p class="card__exit"><i class="fas fa-times"></i></p>
      <h2 class="card__title text-center display-4"><?php echo $number2; ?></h2>
      <p class="card__apply text-white">
        Candidats approuvé
      </p>

    </div>
    <div class="c card-3">
      <div class="card__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
      <p class="card__exit"><i class="fas fa-times"></i></p>
      <h2 class="card__title text-center display-4"><?php echo $number; ?></h2>
      <p class="card__apply text-white">
        Candidats inscrit
      </p>
    </div>
  </div>
        </div>
    </div>

        <div class="container-fluid bg-white" style="margin-top: -50px;">
    <div class="row">
    <?php

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $conn=mysqli_connect("localhost","root","mysql","bourse");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    }

    $total_pages_sql = "SELECT COUNT(*) FROM `etudiants`";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $sql = "SELECT * FROM `etudiants` LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($res_data)){
        $id = $row['id'];
        echo "<div class='col-md-4'>";
            echo "<div class='card p-3'>";
                echo "<div class='d-flex flex-row mb-3'><img src='../clients/image/".$row['image']."' width='70'>";
                echo  "<div class='d-flex flex-column ml-2'><span>".$row['prenom']."</span><span class='text-black-50'>".$row['nom']."</span><span class='ratings'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></span></div>
                </div>";
                echo "<h6>".$row['telephone']."</h6>";
                if($row['specilite'] == "BDD") { $title = "Base des données"; }
                else if($row['specilite'] == "DAW") { $title = "Developement application web"; }
                else if($row['specilite'] == "RS")  { $title = "Réseaux et securité"; }
                else { $title = "System d'information"; }
                echo "<div class='d-flex justify-content-between install mt-3'><span>".$title."</span><span class='text-primary'><a href='./print.php?id=".$row['id']."'>Details</a>&nbsp;<i class='fa fa-angle-right'></i></span></div>";

                    echo "<div class='d-flex justify-content-between install mt-3'><span class='badge bg-success text-white' style='height:25px;'>".$row["type"]."</span><span class='text-primary'><form action='./admin.php' method='POST' class='d-flex flex-row justify-content-between'><input type='text' name='id' value='$id' hidden><button class='btn btn-danger' name='FALSE' value='FALSE'>refused</button>&nbsp;<button class='btn btn-info' name='TRUE' value='TRUE'>acceptez</button></form>&nbsp;<i class='fa fa-angle-right'></i></span></div>";

            echo "</div>";
        echo "</div>";

    }
    mysqli_close($conn);
    ?>
    </div>
    <div class="row d-flex flex-row justify-content-center">
        <ul class="pagination d-flex flex-row justify-content-between" style="margin-top: 50px;">
        <li><a class="btn btn-success" href="?pageno=1">First</a>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        &nbsp;<a class="btn btn-success" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
        </a>&nbsp;
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        &nbsp;<a class="btn btn-success" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>
        </a>&nbsp;
        </li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
    </div>
        </div>
    <div class="container-fluid pb-5 mb-0 justify-content-center text-light ">
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
    <script>
        let select = document.querySelector('#select');
        let license = document.querySelector('#license');
        let master = document.querySelector('#master');
        select.addEventListener('click', () => {
            if (select.value === "License") {
                license.classList.remove('disappear');
                master.classList.add('disappear');
            } else if (select.value === "Master") {
                master.classList.remove('disappear');
                license.classList.remove('disappear');

            } else {
                master.classList.add('disappear');
                license.classList.add('disappear');
            }
        })
    </script>
    <script>
        // show image
        function showImage() {
            if (this.files && this.files[0]) {



                //let FileReader = require('filereader');
                let obj = new FileReader();
                obj.onload = function (data) {
                    let image = document.querySelector('#profile-picture');
                    image.src = data.target.result;
                    image.style.display = "block";
                }
                obj.readAsDataURL(this.files[0]);
            }



        }
    </script>
</body>
</html>

<!-- <html>
<head>
    <title>Pagination</title> -->
    <!-- Bootstrap CDN -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</body>
</html>
*/
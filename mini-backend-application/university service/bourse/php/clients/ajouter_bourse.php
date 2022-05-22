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

        $conn=mysqli_connect("localhost","root","mysql","bourse");
        $matricule = intval($_SESSION['username']);
        $sql = "UPDATE compte SET Isdeleted='true' WHERE matricule='$matricule'";
        $delete = mysqli_query($conn, $sql);
        if($delete)
        {
            $sql2 = "DELETE FROM etudiants WHERE matricule='$matricule'";
            $deleteInfo = mysqli_query($conn, $sql2);
            if($deleteInfo)
            {
                $sql3 = "SELECT * FROM compte WHERE matricule='$matricule'";
                $queryID = mysqli_query($conn, $sql3);

                if($queryID)
                {
                    while($row = mysqli_fetch_array($queryID))
                    {
                     
                     $id = $row["id"];
                    
                    }
                    $sql4 = "DELETE FROM formations WHERE id='$id'";
                    $deleteCalc = mysqli_query($conn, $sql4);
                }
                
            }
        }
        if($deleteCalc)
        {
            session_destroy();
            unset($_SESSION['username']);
            unset($_SESSION['id']);
            header("location: ./login.php");
        }
	}
    // connect to database
	$conn=mysqli_connect("localhost","root","mysql","bourse");
    $status = "";
    $id = 0;
    $nom;
    $prenom;
    $address;
    $tel;
    $img;
    $pay;
    $banque;
    $specialite;
    $general;
    $type;

    $matricule = intval($_SESSION['username']);
    $filter = "SELECT * FROM etudiants WHERE matricule='$matricule'";
    $data = mysqli_query($conn, $filter);
    if($data){
    while($row = mysqli_fetch_array($data))
    {
     $status = $row["status"];
     $id = $row["id"];
     $nom = $row["nom"];
     $prenom = $row["prenom"];
     $address = $row["address"];
     $telephone = $row["telephone"];
     $img = $row["image"];
     $pays = $row["pays"];
     $banque = $row["banque"];
     $specialite = $row["specilite"];
     $general = $row["general"];
     $type = $row["type"];
    
    }}

    if ($_POST['submit'] == 'submit' && isset($_POST['submit'])) {
		
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom     = mysqli_real_escape_string($conn, $_POST['prenom']);
		$address  = mysqli_real_escape_string($conn, $_POST['address']);
        $pays = mysqli_real_escape_string($conn, $_POST['pays']);
        $telephone     = mysqli_real_escape_string($conn, $_POST['telephone']);
		$banque  = mysqli_real_escape_string($conn, $_POST['compte']);
		$specialite  = mysqli_real_escape_string($conn, $_POST['specialite']);
        $info_general  = mysqli_real_escape_string($conn, $_POST['general']);
        $type  = mysqli_real_escape_string($conn, $_POST['type']);

        if(isset($_POST['S1']))
        {
            $s1 = floatval($_POST['S1']);
        }else{ $s1 = 0; }
        if(isset($_POST['S2']))
        {
            $s2 = floatval($_POST['S2']);
        }else{ $s2 = 0; }
        if(isset($_POST['S3']))
        {
            $s3 = floatval($_POST['S3']);
        }else{ $s3 = 0; }
        if(isset($_POST['S4']))
        {
            $s4 = floatval($_POST['S4']);
        }else{ $s4 = 0; }
        if(isset($_POST['S5']))
        {
            $s5 = floatval($_POST['S5']);
        }else{ $s5 = 0; }
        if(isset($_POST['S6']))
        {
            $s6 = floatval($_POST['S6']);
        }else{ $s6 = 0; }
        if(isset($_POST['PFE']))
        {
            $pfe = floatval($_POST['PFE']);
        }else{ $pfe = 0; }

        if(isset($_POST['MS1']))
        {
            $m1 = floatval($_POST['MS1']);
        }else{ $m1 = 0; }
        if(isset($_POST['MS2']))
        {
            $m2 = floatval($_POST['MS2']);
        }else{ $m2 = 0; }
        if(isset($_POST['MS3']))
        {
            $m3 = floatval($_POST['MS3']);
        }else{ $m3 = 0; }
        if(isset($_POST['MS4']))
        {
            $m4 = floatval($_POST['MS4']);
        }else{ $m4 = 0; }

        $image = $_FILES["upload"]["name"];
        $tempname = $_FILES["upload"]["tmp_name"];   
        $folder = "image/".$image;

        $requestdb  = "UPDATE `etudiants` SET `nom`='$nom',`prenom`='$prenom',`address`='$address',`telephone`='$telephone',`pays`='$pays',`banque`='$banque',`specilite`='$specialite',`general`='$info_general',`type`='$type',`status`='pending',`image`='$image' WHERE id='$id'";
        $executereq =  mysqli_query($conn, $requestdb);
        
        if($executereq)
        {
            $mg;
            $mme;
            $mm;
            $auto;
            
            if($type == "License")
            {
                $mg  = ($s1 + $s2 + $s3 + $s4 + $s5 + $s6)/6;
                $mm  = max($s1,$s2,$s3,$s4,$s5,$s6);
                $mme = min($s1,$s2,$s3,$s4,$s5,$s6);
                if($mme <= 8.50 || $mg <= 12 || $mm < 13 || $pfe < 14)
                {
                    $auto = 'rejected';
                }else
                {
                    $auto = 'accepted';
                }

            }else{

                $mg  = (($s1 + $s2 + $s3 + $s4 + $s5 + $s6)/6 + ($m1 + $m2 + $m3 + $m4)/4 )/2;
                $mm  = max($s1,$s2,$s3,$s4,$s5,$s6,$m1,$m2,$m3,$m4);
                $mme = min($s1,$s2,$s3,$s4,$s5,$s6,$m1,$m2,$m3,$m4);
                if($mme <= 8.50 || $mg <= 12 || $mm < 13 || $pfe < 14)
                {
                    $auto = 'rejected';
                }else
                {
                    $auto = 'accepted';
                }
            }
            
            $requestdb2  = "UPDATE formations SET s1='$s1' , s2='$s2' , s3='$s3', s4='$s4', s5='$s5', s6='$s6', pfe='$pfe', m1='$m1', m2='$m2', m3='$m3', m4='$m4', MG='$mg' , MM='$mm', MME='$mme', auto_decision='$auto' WHERE id=$id";
            $executereq2 =  mysqli_query($conn, $requestdb2);

            if($executereq2){
                
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder))  {
                $msg = "upload est realisé";
                header('location: ./ajouter_bourse.php');
            }else{
                $msg = "upload n'est pas realisé";
            }}
        }
               
        }



        if ($_POST['update'] == 'update' && isset($_POST['update'])) {
		
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $prenom     = mysqli_real_escape_string($conn, $_POST['prenom']);
            $address  = mysqli_real_escape_string($conn, $_POST['address']);
            $pays = mysqli_real_escape_string($conn, $_POST['pays']);
            $telephone     = mysqli_real_escape_string($conn, $_POST['telephone']);
            $banque  = mysqli_real_escape_string($conn, $_POST['compte']);
            $specialite  = mysqli_real_escape_string($conn, $_POST['specialite']);
            $info_general  = mysqli_real_escape_string($conn, $_POST['general']);
            $type  = mysqli_real_escape_string($conn, $_POST['type']);
    
            if(isset($_POST['S1']))
            {
                $s1 = floatval($_POST['S1']);
            }else{ $s1 = 0; }
            if(isset($_POST['S2']))
            {
                $s2 = floatval($_POST['S2']);
            }else{ $s2 = 0; }
            if(isset($_POST['S3']))
            {
                $s3 = floatval($_POST['S3']);
            }else{ $s3 = 0; }
            if(isset($_POST['S4']))
            {
                $s4 = floatval($_POST['S4']);
            }else{ $s4 = 0; }
            if(isset($_POST['S5']))
            {
                $s5 = floatval($_POST['S5']);
            }else{ $s5 = 0; }
            if(isset($_POST['S6']))
            {
                $s6 = floatval($_POST['S6']);
            }else{ $s6 = 0; }
            if(isset($_POST['PFE']))
            {
                $pfe = floatval($_POST['PFE']);
            }else{ $pfe = 0; }
    
            if(isset($_POST['MS1']))
            {
                $m1 = floatval($_POST['MS1']);
            }else{ $m1 = 0; }
            if(isset($_POST['MS2']))
            {
                $m2 = floatval($_POST['MS2']);
            }else{ $m2 = 0; }
            if(isset($_POST['MS3']))
            {
                $m3 = floatval($_POST['MS3']);
            }else{ $m3 = 0; }
            if(isset($_POST['MS4']))
            {
                $m4 = floatval($_POST['MS4']);
            }else{ $m4 = 0; }
            
            $image = $_FILES["upload"]["name"];
            if($image == 0)
            {
                $image = $img;
            }
            $tempname = $_FILES["upload"]["tmp_name"];   
            $folder = "image/".$image;
    
            $requestdb  = "UPDATE `etudiants` SET `nom`='$nom',`prenom`='$prenom',`address`='$address',`telephone`='$telephone',`pays`='$pays',`banque`='$banque',`specilite`='$specialite',`general`='$info_general',`type`='$type',`status`='pending',`image`='$image' WHERE id='$id'";
            $executereq =  mysqli_query($conn, $requestdb);
            
            if($executereq)
            {
                $mg;
                $mme;
                $mm;
                $auto;
    
                if($type == "License")
                {
                    $mg  = ($s1 + $s2 + $s3 + $s4 + $s5 + $s6)/6;
                    $mm  = max($s1,$s2,$s3,$s4,$s5,$s6);
                    $mme = min($s1,$s2,$s3,$s4,$s5,$s6);
                    if($mme <= 8.50 || $mg <= 12 || $mm < 13 || $pfe < 14)
                    {
                        $auto = 'rejected';
                    }else
                    {
                        $auto = 'accepted';
                    }
    
                }else{
    
                    $mg  = (($s1 + $s2 + $s3 + $s4 + $s5 + $s6)/6 + ($m1 + $m2 + $m3 + $m4)/4 )/2;
                    $mm  = max($s1,$s2,$s3,$s4,$s5,$s6,$m1,$m2,$m3,$m4);
                    $mme = min($s1,$s2,$s3,$s4,$s5,$s6,$m1,$m2,$m3,$m4);
                    if($mme <= 8.50 || $mg <= 12 || $mm < 13 || $pfe < 14)
                    {
                        $auto = 'rejected';
                    }else
                    {
                        $auto = 'accepted';
                    }
                }
                
                $requestdb2  = "UPDATE formations SET s1='$s1' , s2='$s2' , s3='$s3', s4='$s4', s5='$s5', s6='$s6', pfe='$pfe', m1='$m1', m2='$m2', m3='$m3', m4='$m4', MG='$mg' , MM='$mm', MME='$mme', auto_decision='$auto' WHERE id=$id";
                $executereq2 =  mysqli_query($conn, $requestdb2);
    
                if($executereq2){
                if($image != 0) {
                // Now let's move the uploaded image into the folder: image
                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "upload est realisé";
                    header('location: ./ajouter_bourse.php');
                }else{
                    $msg = "upload n'est pas realisé";
                }}
                                }
            }
                   
            }
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
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-column justify-content-center">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Salem Candidant !</strong> voici votre code de restoration de mot de passe.
                    <code><?php echo $_SESSION['code']; ?></code>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top: -100px;">

        <div class="container">
            <h2 class="my-5 text-center">Selectioner votre etape</h2>


            <div class="d-flex carousel-nav">
                <a href="#" class="col active">Inscription</a>
                <a href="#" class="col">Mettre à jour votre informations</a>
                <a href="#" class="col">voir les resultats</a>
            </div>

            <!-- This appreas only when the user didn't register a request -->
            <div class="owl-carousel owl-1">
                <?php 
                if($data)
                {
                if($status == "start") { ?>
                <!-- This appreas when user had already done a request  -->
                <!-- start item one -->
                <div class="media-29101">

                    <form action='./ajouter_bourse.php' method="POST" enctype="multipart/form-data">
                        <center>
                            <img class='img-fluid mb-5' display:' id='profile-picture'
                                style="width: 200px; height:200px; border-radius:50%; box-shadow: 1px 1px 10px 10px #eee; border: solid 1px #eee;"
                                src='../../images/bankrupt.png'>
                            <label for='upload'>
                                prendre photo:
                                <img src="../../images/camera.png" style="transform:scale(0.5); cursor:pointer;"
                                    alt=""></label>
                            <input id='upload' name='upload' type='file' onchange='showImage.call(this)'
                                accept='.jpg, .png, .jpeg' hidden required/>
                        </center>

                        <!-- row one -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="matricule">Matricule:</label>
                                    <input type="number" class="form-control" id="matricule"
                                        value="<?php echo '0151510' ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- row two -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" class="form-control" name="nom" id="nom" value="" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- row three -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Addresse:</label>
                                    <input type="text" class="form-control" name="address" id="address" value=""
                                        required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="telephone">Numero telephone:</label>
                                    <input type="number" class="form-control" name="telephone" id="telephone" value=""
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- choix de bourse row 4 -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pays">pays:</label>
                                    <input type="text" class="form-control" name="pays" id="pays" value="" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="compte">compte bancraire:</label>
                                    <input type="number" class="form-control" id="compte" name="compte" value=""
                                        required>
                                </div>
                            </div>
                        </div>
                        <!-- -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="specialite">Specilité:</label>
                                    <select class="form-control" name="specialite" id="specialite">
                                        <option value=""></option>
                                        <option value="RS">Reseaux informatique</option>
                                        <option value="SI">System informatique</option>
                                        <option value="BDD">Base de données</option>
                                        <option value="DAW">Developement web et application</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--  row 5 -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Selectioner type de bourse:</label>
                                    <select class="form-control" id="select" name="type">
                                        <option value=""></option>
                                        <option value="License">License</option>
                                        <option value="Master">Master</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- License row 6 -->
                        <div class="row sh disappear" id="license">
                            <div class="col-12">
                                <h4>Formation Licence:</h4>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S1">Semester 1:</label>
                                    <input type="number" class="form-control" name="S1" id="S1" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S2">Semester 2:</label>
                                    <input type="number" class="form-control" name="S2" id="S2" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S3">Semester 3:</label>
                                    <input type="number" class="form-control" name="S3" id="S3" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S4">Semester 4:</label>
                                    <input type="number" class="form-control" name="S4" id="S4" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S5">Semester 5:</label>
                                    <input type="number" class="form-control" name="S5" id="S5" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S6">Semester 6:</label>
                                    <input type="number" class="form-control" name="S6" id="S6" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="PFE">Note project fin d'etude:</label>
                                    <input type="number" class="form-control" name="PFE" id="PFE" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                        </div>


                        <!-- Master row 7-->
                        <div class="row sh disappear" id="master">

                            <div class="col-12">
                                <hr>
                                <h4>Formation Master:</h4>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS1">Semester 1:</label>
                                    <input type="number" class="form-control" name="MS1" id="MS1" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS2">Semester 2:</label>
                                    <input type="number" class="form-control" name="MS2" id="MS2" min='0' max='20'
                                        value="" step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS3">Semester 3:</label>
                                    <input type="number" class="form-control" name="MS3" id="MS3" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS4">Semester 4:</label>
                                    <input type="number" class="form-control" name="MS4" id="MS4" value="" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>
                            <div class="col-4">

                            </div>

                            <div class="col-4">

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Plus d'information general:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="general"></textarea>
                        </div>
                        <button class="btn btn-lg btn-success" type="submit" name="submit" value="submit">
                            Inscrivez vous.
                        </button>
                    </form>

                </div>
                <?php }else if($status == "pending" || $status == "end"){ ?>
                <!-- use if else in php to generate the right template  -->
                <!-- This appears when he submit the registration  -->

                <div class="media-29101 d-md-flex w-100">
                    <div class="img">
                        <img src="../../images/1000.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="text">
                        <a class="category d-block mb-4" href="#">Es-tu perdu ?</a>
                        <h2>Vous avez déjà soumis une demande à notre service</h2>
                        <p>Vous pouvez visiter votre box du resultat </a></p>
                    </div>
                </div>
                <?php } ?>
                <!-- End item one -->

                <!-- if not submitted yet can't update, this  code appreas -->
                <?php if($status == "start" || $status == "end") { ?>
                <div class="media-29101 d-md-flex w-100">
                    <div class="img">
                        <img src="../../images/2000.png" width="25%" height="25%" alt="Image" class="img-fluid">
                    </div>
                    <div class="text">
                        <a class="category d-block mb-4" href="#">modification &mdash; impossible</a>
                        <h2><a href="#">Vous devez d'abord envoyer une inscription pour mettre à jour vos
                                informations</a></h2>
                        <p>Retour à l'étape d'inscription s'il vous plaît.</p>
                    </div>
                </div>
                <?php }else if($status == "pending"){ 
    
                    
                    ?>
                <!-- This appears when he submit the registration  -->
                <!-- else this will appreas to keep possibiliy to get information updated -->
                <!-- This appreas when user had already done a request  -->
                <!-- start item one -->
                <div class="media-29101">

                    <form action='./ajouter_bourse.php' method="POST" enctype="multipart/form-data">
                        <center>
                            <img class='img-fluid mb-5' display:' id='profile-picture'
                                style="width: 200px; height:200px; border-radius:50%; box-shadow: 1px 1px 10px 10px #eee; border: solid 1px #eee;"
                                src='./image/<?php echo $img; ?>'>
                            <label for='upload'>
                                prendre photo:
                                <img src="../../images/camera.png" style="transform:scale(0.5); cursor:pointer;"
                                    alt=""></label>
                            <input id='upload' name='upload' type='file' onchange='showImage.call(this)'
                                accept='.jpg, .png, .jpeg' hidden required/>
                        </center>

                        <!-- row one -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="matricule">Matricule:</label>
                                    <input type="number" class="form-control" id="matricule"
                                        value="<?php echo '0151510' ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- row two -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom; ?>" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenom; ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- row three -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Addresse:</label>
                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="telephone">Numero telephone:</label>
                                    <input type="number" class="form-control" name="telephone" id="telephone" value="<?php echo $telephone; ?>"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- choix de bourse row 4 -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pays">pays:</label>
                                    <input type="text" class="form-control" name="pays" id="pays" value="<?php echo $pays; ?>" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="compte">compte bancraire:</label>
                                    <input type="number" class="form-control" id="compte" name="compte" value="<?php echo $banque; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="specialite">Specilité:</label>
                                    <select class="form-control" name="specialite" id="specialite">
                                        <option value=""></option>
                                        <?php if($specialite == "RS") { ?>
                                        <option value="RS" selected>Reseaux informatique</option>
                                        <?php }else { ?> <option value="RS">Reseaux informatique</option> <?php }?>
                                        <?php if($specialite == "SI") { ?>
                                        <option value="SI" selected>System informatique</option>
                                        <?php }else { ?> <option value="SI">System informatique</option> <?php }?>
                                        <?php if($specialite == "BDD") { ?>
                                        <option value="BDD" selected>Base de données</option>
                                        <?php }else { ?> <option value="BDD">Base de données</option> <?php }?>
                                        <?php if($specialite == "DAW") { ?>
                                        <option value="DAW" selected>Developement web et application</option>
                                        <?php }else { ?> <option value="DAW">Developement web et application</option> <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--  row 5 -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Selectioner type de bourse:</label>
                                    <select class="form-control" name="type">
                                        <option value=""></option>
                                        <?php if($type == "License") { ?>
                                        <option value="License" selected>License</option>
                                        <?php }?> 
                                        <?php if($type == "Master") { ?>
                                        <option value="Master" selected>Master</option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $connexion = mysqli_connect("localhost","root","mysql","bourse");
                        $sql = "SELECT * FROM formations WHERE id='$id'";
                        $notes = mysqli_query($connexion, $sql);
                                            
                        if($notes)
                        {
                            while($r = mysqli_fetch_array($notes))
                            {
                             $s1  = $r["s1"];
                             $s2 = $r["s2"];
                             $s3 = $r['s3'];
                             $s4 = $r['s4'];
                             $s5  = $r["s5"];
                             $s6 = $r["s6"];
                             $m1 = $r['m1'];
                             $m2 = $r['m2'];
                             $m3 = $r['m3'];
                             $m4 = $r['m4'];
                             $pfe= $r['pfe'];
                             $MG =  $r['MG'];
                             $MM =  $r['MM'];
                             $MME= $r['MME'];
                            }
                        }
                        
                        ?>
                        <!-- License row 6 -->
                        <div class="row sh">
                            <div class="col-12">
                                <h4>Formation Licence:</h4>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S1">Semester 1:</label>
                                    <input type="number" class="form-control" name="S1" id="S1" value="<?php echo $s1; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S2">Semester 2:</label>
                                    <input type="number" class="form-control" name="S2" id="S2" value="<?php echo $s2; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S3">Semester 3:</label>
                                    <input type="number" class="form-control" name="S3" id="S3" value="<?php echo $s3; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S4">Semester 4:</label>
                                    <input type="number" class="form-control" name="S4" id="S4" value="<?php echo $s4; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S5">Semester 5:</label>
                                    <input type="number" class="form-control" name="S5" id="S5" value="<?php echo $s5; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="S6">Semester 6:</label>
                                    <input type="number" class="form-control" name="S6" id="S6" value="<?php echo $s6; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>


                            <div class="col-3">
                                <div class="form-group">
                                    <label for="PFE">Note project fin d'etude:</label>
                                    <input type="number" class="form-control" name="PFE" id="PFE" value="<?php echo $pfe; ?>" min='0'
                                        max='20' step="0.01" required>
                                </div>
                            </div>

                        </div>

                        <!-- Master row 7-->
                        <div class="row sh <?php  if($type == "License") { echo "disappear";} ?>">

                            <div class="col-12">
                                <hr>
                                <h4>Formation Master:</h4>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS1">Semester 1:</label>
                                    <input type="number" class="form-control" name="MS1" id="MS1" value="<?php echo $m1; ?>" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS2">Semester 2:</label>
                                    <input type="number" class="form-control" name="MS2" id="MS2" min='0' max='20'
                                        value="<?php echo $m2; ?>" step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS3">Semester 3:</label>
                                    <input type="number" class="form-control" name="MS3" id="MS3" value="<?php echo $m3; ?>" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="MS4">Semester 4:</label>
                                    <input type="number" class="form-control" name="MS4" id="MS4" value="<?php echo $m4; ?>" min='0'
                                        max='20' step="0.01">
                                </div>
                            </div>
                            <div class="col-4">

                            </div>

                            <div class="col-4">

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Plus d'information general:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="general">
                            <?php echo $general ?>
                            </textarea>
                        </div>
                        <button class="btn btn-lg btn-success" type="submit" name="update" value="update">
                            modifier les informations.
                        </button>
                    </form>
                </div>
                <?php } ?>


                <!-- .item deux -->
                <?php if($status == "start"){ ?>
                <div class="media-29101 d-md-flex w-100">
                    <div class="img">
                        <img src="../../images/3000.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="text">
                        <a class="category d-block mb-4" href="#">OOPS !!! &mdash; Rien ici.</a>
                        <h2><a href="#">On dit que vous voulez voir les resultat sans envoyez votre informations ?</a>
                        </h2>
                        <p>Retour à l'étape d'inscription s'il vous plaît.</p>
                    </div>
                </div>
                <?php }else if($status == "pending" || $status == "end"){ 
                    
                        $connexion = mysqli_connect("localhost","root","mysql","bourse");
                        $sql = "SELECT * FROM formations WHERE id='$id'";
                        $notes = mysqli_query($connexion, $sql);
                                            
                        if($notes)
                        {
                            while($r = mysqli_fetch_array($notes))
                            {
                             $s1  = $r["s1"];
                             $s2 = $r["s2"];
                             $s3 = $r['s3'];
                             $s4 = $r['s4'];
                             $s5  = $r["s5"];
                             $s6 = $r["s6"];
                             $m1 = $r['m1'];
                             $m2 = $r['m2'];
                             $m3 = $r['m3'];
                             $m4 = $r['m4'];
                             $pfe= $r['pfe'];
                             $MG =  $r['MG'];
                             $MM =  $r['MM'];
                             $MME= $r['MME'];
                             $etat = $r['decision'];
                            }
                        }

                        if($etat == 'null')
                        {
                            $etat = 'pending';
                        }                    
                    ?>

                <div class="media-29101">
                    <div class="row">
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            <div class="card green">
                                <div class="additional">
                                    <div class="user-card">
                                        <div class="level center">
                                            <?php echo $status; ?>
                                        </div>
                                        <!-- <div class="level center">
                                            accepted
                                        </div> -->
                                        

                                        <img src="./image/<?php echo $img?>" style="position: absolute; top: 65px;" alt="">
                                    </div>
                                    <div class="more-info">
                                        <h1><small><?php echo $etat; ?></small></h1>
                                        <div class="coords">
                                            <span><?php echo $matricule ?></span>
                                            <span><?php echo $nom." ".$prenom; ?></span>
                                        </div>
                                        <div class="coords">
                                            <span><?php echo $telephone; ?></span>
                                        </div>
                                        <div class="stats">
                                            <div>
                                                <div class="title">MG</div>
                                                <i class="fa fa-trophy"></i>
                                                <div class="value"><?php echo $MG;?></div>
                                            </div>
                                            <div>
                                                <div class="title">MM</div>
                                                <i class="fa fa-gamepad"></i>
                                                <div class="value"><?php echo $MM;?></div>
                                            </div>
                                            <div>
                                                <div class="title">NME</div>
                                                <i class="fa fa-group"></i>
                                                <div class="value"><?php echo $MME;?></div>
                                            </div>
                                            <div>
                                                <div class="title">PFE</div>
                                                <i class="fa fa-coffee"></i>
                                                <div class="value"><?php echo $pfe;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="general">
                                    <h3><center><small><?php echo $nom." ".$prenom; ?></small></center></h3>
                                    <p>La resultat s'affiche ici apres la fin de delai d'inscription en 8/05/2022.</p>
                                    <span class="more">Passez la souris sur la carte</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Nos critaire d'accept:</p>
                            <ul>
                                <li>On doit acceptez 20 etudiant dans 30 jours. si le nombre n'est pas complet, les
                                    etudiant qui n'avoir pas tout les critaire vont comme meme etre acceptez sinon si on
                                    a 20 etudiant qui passera tout les critaire il seront pas acceptez</li>
                                <li><strong style="color:#3db166;">MG</strong>: moyenne general plus que 12/20</li>
                                <li><strong style="color:#3db166;">MM</strong>: avoir une meilleur moyenne en mois une
                                    fois plus ou egual a 13/20</li>
                                <li><strong style="color:#3db166;">MME</strong>: nombre des moyenne eleminatoir est 0,
                                    la moyenne elimantoir et moins ou equal a 8.50</li>
                                <li><strong style="color:#3db166;">PFE</strong>: avoir une note de project fin d'etude
                                    Master/License plus ou egale a 14</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php }}
                ?>
                <!-- .item trois -->



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
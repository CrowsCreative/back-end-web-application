<?php
  session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['ERROR'] = "You must log in first";
		header('location: ../login/login.php');
	}

	if (isset($_GET['logout_user'])) {
		session_destroy();
		unset($_SESSION['username']);
    unset($_SESSION['id']);
		header("location: ../login/login.php");
	}

  $clientID = $_SESSION['id'];
  unset($_SESSION['ERROR']);
  ?>
  <?php include("../../../server/firstdb.php"); ?>
  <?php include("../../../server/seconddb.php"); ?>


  <?php 
  if(isset($_POST['type_client'])) $type_client = $_POST['type_client'];
  else $type_client = '';

  if(isset($_POST['nature'])) $nature = $_POST['nature'];
  else $nature = 'NULL';

  if(isset($_POST['genre'])) $gender = $_POST['genre'];
  else $gender = '';

  if(isset($_POST['nom'])) $nom = $_POST['nom'];
  else $nom = '';

  if(isset($_POST['prenom'])) $prenom = $_POST['prenom'];
  else $prenom = '';

  if(isset($_POST['date_nais'])) $date_nais = $_POST['date_nais'];
  else $date_nais = '';

  if(isset($_POST['wilayaoui'])) $wilaya = $_POST['wilayaoui'];
  else $wilaya = '';
  
  if(isset($_POST['adresse'])) $address = $_POST['adresse'];
  else $address = '';

  if(isset($_POST['mobile'])) $mobile = $_POST['mobile'];
  else $mobile = '';

  if(isset($_POST['email'])) $email = $_POST['email'];
  else $email = '';

  if(isset($_POST['type_piece'])) $t_p = $_POST['type_piece'];
  else $t_p = '';

  if(isset($_POST['num_piece'])) $n_p = $_POST['num_piece'];
  else $n_p = '';

  if(isset($_POST['emetteur_piece'])) $e_p = $_POST['emetteur_piece'];
  else $e_p = '';

  if(isset($_POST['date_piece'])) $d_p = $_POST['date_piece'];
  else $d_p = '';

  $SQL = mysqli_query($conn, "INSERT INTO `demande`(`clientID`, `type_client`, `nature`, `genre`, `nom`, `prenom`, `date_nais`, `wilayaoui`, `adresse`, `mobile`, `email`, `type_piece`, `num_piece`, `emetteur_piece`, `date_piece`, `reponse`, `reponseContent`) VALUES ($clientID, '$type_client', '$nature', '$gender', '$nom', '$prenom', '$date_nais', '$wilaya', '$address', '$mobile', '$email', '$t_p', '$n_p', '$e_p', '$d_p', 'FALSE', 'NULL')");
  if($SQL)
  {
    header("Location: profile.php");
  }else
  {
    header("Location: profile.php");
  }
  
  ?>
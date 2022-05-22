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
  <?php include("../../../server/seconddb.php"); ?>
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
  <?php 

  if($_SESSION["isReset"] == 'false')
  {
    echo "<script>alert('veuillez reinitialiser votre mot de passe pour meilleur securité')</script>";
  }
  ?>
  <style>
    body {
      font-family: "Oswald", "Helvetica Neue";
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
      <a href="./userINF.php" class="menu-item fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="Information personelle"></a>
      <a href="./carte.php" class="menu-item fa fa-credit-card" data-toggle="tooltip" data-placement="left" title="Voir la carte"></a>
      <a href="./contact.php" class="menu-item fas fa-comment-alt"  data-toggle="tooltip" data-placement="left" title="Contact support"></a>
      <a href="#" class="menu-item fa fa-trash"  data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="left" title="Désabonement"></a>
    </menu>

  </div>


  <div id="circularMenu1" class="circular-menu circular-menu-left">

    <a class="floating-btn" id="f2">
      <i class="fa fa-bars"></i>
    </a>

    <menu class="items-wrapper">
      <a href="../../index.php" class="menu-item fa fa-home" data-toggle="tooltip" data-placement="right" title="Page d'accueil"></a>
      <a href="./purchase.php" class="menu-item fa fa-search" data-toggle="tooltip" data-placement="right" title="Page d'achat"></a>
      <a href="./profile.php" class="menu-item fa fa-id-card activation-circle-nav-navigation" data-toggle="tooltip" data-placement="right" title="Espace Client"></a>
      <a href="profile.php?logout='1'" class="menu-item fa fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Déconnexion"></a>
    </menu>

  </div>
    <aside id="trash">
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: transparent !important; outline: none;">
                  <img src="./assets/close.png"  alt="close icon" style="width:1.5em; height: 1.5em;">
              </button>
            </div>
            <div class="modal-body">
              <h5>Procedure du désabonement</h5>
              <div>
                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente iure fuga consectetur facilis repudiandae minima nemo! Nesciunt, voluptates debitis. Deserunt magni totam eveniet maiores ea similique natus nemo sunt repellendus!</p>
              </div>
              <form action="usub.php" method="POST">
                <div class="form-group">
                  <p for="recipient-name">Ecrire <code style="color: #00a959">" supprimez mon compte "</code> pour terminer l'operation: </p>
                  <input type="text" class="form-control" id="recipient-name" pattern="supprimez mon compte" placeholder="supprimez mon compte" required>
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
                <a id="item-nav-active" href="./profile.php" class="menu-item no-decoration text-center"><span id="nav-text">Espace
                    client</span></a>
                <a id="item-nav" href="./rechargement.php" class="menu-item no-decoration text-center"><span
                    id="nav-text">Rechargement</span></a>
                <a id="item-nav" href="./demande.php" class="menu-item no-decoration text-center"><span id="nav-text">Demande en
                    ligne</span></a>
                <a id="item-nav" href="./network.php" class="menu-item no-decoration text-center"><span id="nav-text">Notre
                    réseaux</span></a>
              </div>

              <div class="col-lg-8 d-md-none">
                <a class="btn btn-success d-md-none" data-toggle="collapse" href="#collapseExample" role="button"
                  aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></a>
                <div class="collapse" id="collapseExample">
                  <a id="item-sm-nav-active" href="./profile.php" class="menu-item no-decoration text-center"><span
                      id="nav-text">Espace client</span></a>
                  <a id="item-sm-nav" href="./rechargement.php" class="menu-item no-decoration text-center "><span
                      id="nav-text">Rechargement</span></a>
                  <a id="item-sm-nav" href="./demande.php" class="menu-item no-decoration text-center "><span id="nav-text">Demande
                      en ligne</span></a>
                  <a id="item-sm-nav" href="./network.php" class="menu-item no-decoration text-center "><span id="nav-text">Notre
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
          <div class="col-sm-12 col-md-6 col-lg-4 my-3 my-sm-3 my-md-3 my-lg-0">
            <div class="card">
              <div class="card-body">
              <?php 
              
              $queryModem = "SELECT COUNT(n_serie) as total_modem FROM `modem` WHERE status= $clientID";
              $total_modem_r = mysqli_query($conn, $queryModem);
              if($total_modem_r && mysqli_num_rows($total_modem_r) > 0)
            {
                
              $row_m = mysqli_fetch_assoc($total_modem_r); 
              $n_modem = (int)$row_m['total_modem'];
            
            }


            $queryCarte = "SELECT COUNT(n_serie) as total_carte FROM `carte` WHERE status= $clientID";
              $total_carte_r = mysqli_query($conn, $queryCarte);
              if($total_carte_r && mysqli_num_rows($total_carte_r) > 0)
            {
                
              $row_c = mysqli_fetch_assoc($total_carte_r); 
              $n_carte = (int)$row_c['total_carte'];
            
            }



            $info = "SELECT * FROM clientaccount,clients WHERE clientaccount.id= clients.id AND clientaccount.id =  $clientID";
            $racordsInfo = mysqli_query($conn, $info);
            $d = array();
            if($racordsInfo && mysqli_num_rows($racordsInfo) == 1)
            {
              
              while($r = mysqli_fetch_array($racordsInfo))
              {
                $d[] = $r; 
              }
          
            }
              
              ?>
                <h5 class="card-title">Les Activité <svg style="width: 1em; height: 1em; margin-bottom:4px;"
                    viewBox="0 -48 480 480" width="480pt" xmlns="http://www.w3.org/2000/svg">
                    <path d="m16 152h64v192h-64zm0 0" fill="#009698" />
                    <path d="m112 104h64v240h-64zm0 0" fill="#00b6bd" />
                    <path d="m208 184h64v160h-64zm0 0" fill="#00d7df" />
                    <path d="m304 96h64v248h-64zm0 0" fill="#00d7df" />
                    <path d="m400 0h64v344h-64zm0 0" fill="#00b6bd" />
                    <path
                      d="m472 384h-464c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h464c4.417969 0 8 3.582031 8 8s-3.582031 8-8 8zm0 0"
                      fill="#007579" />
                  </svg></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                  card's content.</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Type d'abonnement:</strong> <span
                    class="badge badge-clock display-5">ADSL</span></li>
                <li class="list-group-item"><strong>Nombre modem:</strong> <code style="font-size: 1.5em;"><?= $n_modem ?></code>/Modems<span class="float-right">
                    <svg style="width: 3em; height: 3em;position:absolute; bottom:5; right:8;"
                      viewBox="0 -75 512.00002 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="m494.34375 247.171875h-476.6875c-9.75 0-17.65625 7.90625-17.65625 17.65625v52.964844c0 9.75 7.90625 17.65625 17.65625 17.65625h476.6875c9.75 0 17.65625-7.90625 17.65625-17.65625v-52.964844c0-9.75-7.90625-17.65625-17.65625-17.65625zm-123.585938 61.792969c-9.75 0-17.652343-7.902344-17.652343-17.65625 0-9.75 7.902343-17.652344 17.652343-17.652344s17.65625 7.902344 17.65625 17.652344c0 9.753906-7.90625 17.65625-17.65625 17.65625zm70.621094 0c-9.75 0-17.65625-7.902344-17.65625-17.65625 0-9.75 7.90625-17.652344 17.65625-17.652344s17.65625 7.902344 17.65625 17.652344c0 9.753906-7.90625 17.65625-17.65625 17.65625zm0 0"
                        fill="#ffc477" />
                      <path
                        d="m123.585938 17.65625c0-9.75-7.90625-17.65625-17.65625-17.65625s-17.652344 7.90625-17.652344 17.65625v229.515625h35.308594zm0 0"
                        fill="#ffb655" />
                      <path
                        d="m423.722656 17.65625c0-9.75-7.902344-17.65625-17.652344-17.65625s-17.65625 7.90625-17.65625 17.65625v229.515625h35.308594zm0 0"
                        fill="#ffb655" />
                      <path
                        d="m459.035156 291.308594c0 9.753906-7.90625 17.65625-17.65625 17.65625s-17.65625-7.902344-17.65625-17.65625c0-9.75 7.90625-17.652344 17.65625-17.652344s17.65625 7.902344 17.65625 17.652344zm0 0"
                        fill="#ff7956" />
                      <path
                        d="m388.414062 291.308594c0 9.753906-7.90625 17.65625-17.65625 17.65625s-17.652343-7.902344-17.652343-17.65625c0-9.75 7.902343-17.652344 17.652343-17.652344s17.65625 7.902344 17.65625 17.652344zm0 0"
                        fill="#ff7956" />
                      <path d="m79.449219 335.449219h52.964843v26.480469h-52.964843zm0 0" fill="#787680" />
                      <path d="m379.585938 335.449219h52.964843v26.480469h-52.964843zm0 0" fill="#787680" />
                      <g fill="#ff5023">
                        <path
                          d="m158.894531 308.964844c-4.875 0-8.824219-3.953125-8.824219-8.828125v-17.65625c0-4.875 3.949219-8.824219 8.824219-8.824219s8.828125 3.949219 8.828125 8.824219v17.65625c0 4.875-3.949218 8.828125-8.828125 8.828125zm0 0" />
                        <path
                          d="m123.585938 308.964844c-4.875 0-8.828126-3.953125-8.828126-8.828125v-17.65625c0-4.875 3.953126-8.824219 8.828126-8.824219s8.828124 3.949219 8.828124 8.824219v17.65625c0 4.875-3.953124 8.828125-8.828124 8.828125zm0 0" />
                        <path
                          d="m88.277344 308.964844c-4.875 0-8.828125-3.953125-8.828125-8.828125v-17.65625c0-4.875 3.953125-8.824219 8.828125-8.824219s8.824218 3.949219 8.824218 8.824219v17.65625c0 4.875-3.949218 8.828125-8.824218 8.828125zm0 0" />
                        <path
                          d="m52.964844 308.964844c-4.875 0-8.828125-3.953125-8.828125-8.828125v-17.65625c0-4.875 3.953125-8.824219 8.828125-8.824219s8.828125 3.949219 8.828125 8.824219v17.65625c0 4.875-3.953125 8.828125-8.828125 8.828125zm0 0" />
                      </g>
                      <path d="m379.585938 335.449219h52.964843v8.828125h-52.964843zm0 0" fill="#57565c" />
                      <path d="m79.449219 335.449219h52.964843v8.828125h-52.964843zm0 0" fill="#57565c" />
                    </svg></span></li>
                <li class="list-group-item"><strong>Nombre cartes:</strong> <code style="font-size: 1.5em;"><?= $n_carte ?></code>/Cartes<span class="float-right"><svg
                      style="width: 2.5em; height: 2.5em;position:absolute; bottom:5; right:10;"
                      viewBox="-17 1 511 511.99925" width="511pt" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="m426.8125 187.617188-238.695312 238.699218c-10.789063 10.785156-28.277344 10.785156-39.0625 0l-140.464844-140.464844c-10.785156-10.789062-10.785156-28.277343 0-39.0625l238.695312-238.699218c10.789063-10.785156 28.277344-10.785156 39.0625 0l140.464844 140.464844c10.789062 10.785156 10.789062 28.277343 0 39.0625zm0 0"
                        fill="#8cbafa" />
                      <path
                        d="m426.8125 148.554688-17.527344-17.53125c9.605469 9.605468 8.644532 26.136718-2.140625 36.921874l-238.699219 238.699219c-10.785156 10.789063-27.316406 11.746094-36.921874 2.140625l17.53125 17.53125c10.785156 10.785156 28.273437 10.785156 39.0625 0l238.695312-238.699218c10.789062-10.785157 10.789062-28.277344 0-39.0625zm0 0"
                        fill="#5692d8" />
                      <path
                        d="m54.488281 276.027344c-1.921875 0-3.839843-.734375-5.304687-2.199219-2.929688-2.929687-2.929688-7.675781 0-10.605469l116.917968-116.917968c2.929688-2.929688 7.679688-2.929688 10.605469 0 2.929688 2.929687 2.929688 7.679687 0 10.605468l-116.917969 116.921875c-1.464843 1.460938-3.382812 2.195313-5.300781 2.195313zm0 0"
                        fill="#252d4c" />
                      <path
                        d="m91.644531 313.183594c-1.921875 0-3.839843-.734375-5.304687-2.199219-2.929688-2.929687-2.929688-7.675781 0-10.605469l116.917968-116.917968c2.929688-2.929688 7.679688-2.929688 10.605469 0 2.929688 2.929687 2.929688 7.679687 0 10.605468l-116.917969 116.917969c-1.464843 1.464844-3.382812 2.199219-5.300781 2.199219zm0 0"
                        fill="#252d4c" />
                      <path
                        d="m243.386719 62.496094-23.390625 23.386718c-9.195313 9.195313-9.195313 24.101563 0 33.296876 9.195312 9.195312 24.105468 9.195312 33.300781 0l23.386719-23.386719c9.195312-9.195313 9.195312-24.101563 0-33.296875-9.195313-9.195313-24.105469-9.195313-33.296875 0zm0 0"
                        fill="#ffcd34" />
                      <path
                        d="m449.351562 258.109375h-337.570312c-15.253906 0-27.621094 12.367187-27.621094 27.621094v198.648437c0 15.253906 12.367188 27.621094 27.621094 27.621094h337.570312c15.257813 0 27.621094-12.367188 27.621094-27.621094v-198.648437c.003906-15.253907-12.363281-27.621094-27.621094-27.621094zm0 0"
                        fill="#ffcd34" />
                      <path
                        d="m449.351562 258.109375h-24.722656c15.253906 0 27.621094 12.367187 27.621094 27.621094v198.648437c0 15.253906-12.367188 27.621094-27.621094 27.621094h24.722656c15.257813 0 27.621094-12.367188 27.621094-27.621094v-198.648437c.003906-15.253907-12.363281-27.621094-27.621094-27.621094zm0 0"
                        fill="#e69012" />
                      <path d="m84.160156 320.515625h392.816406v47.722656h-392.816406zm0 0" fill="#575b7a" />
                      <path d="m452.25 320.515625h24.722656v47.722656h-24.722656zm0 0" fill="#252d4c" />
                      <path
                        d="m380.429688 444.492188v29.433593c0 2.277344 1.84375 4.121094 4.121093 4.121094h46.816407c2.277343 0 4.121093-1.84375 4.121093-4.121094v-29.433593c0-2.277344-1.84375-4.121094-4.121093-4.121094h-46.816407c-2.277343 0-4.121093 1.84375-4.121093 4.121094zm0 0"
                        fill="#e9e9ea" />
                      <path
                        d="m239.273438 444.492188v29.433593c0 2.277344 1.847656 4.121094 4.121093 4.121094h99.023438c2.277343 0 4.121093-1.84375 4.121093-4.121094v-29.433593c0-2.277344-1.84375-4.121094-4.121093-4.121094h-99.023438c-2.273437 0-4.121093 1.84375-4.121093 4.121094zm0 0"
                        fill="#e9e9ea" />
                      <path
                        d="m198.910156 485.546875h-49.332031c-4.144531 0-7.5-3.359375-7.5-7.5 0-4.144531 3.355469-7.5 7.5-7.5h49.332031c4.144532 0 7.5 3.355469 7.5 7.5 0 4.140625-3.355468 7.5-7.5 7.5zm0 0"
                        fill="#252d4c" />
                    </svg></span></li>
              </ul>
              <div class="card-body">
                <strong>Total payées:</strong><span
                  class="ml-5 bg-light rounded text-primary display-5 d-inline-block mt-2"
                  style="font-family: Degital; font-size: 2em;" disabled><?= $d[0]['paiement'] ?><small>/DA</small></span>
              </div>
            </div>
          </div>
          <!-- hide only if medium -->
          <?php 
          
          $query = "SELECT * FROM clientaccount,clients WHERE clientaccount.id = clients.id AND clientaccount.id = $clientID";
          $res = mysqli_query($conn, $query);
          $data = array();
          if($res)
          {
            while($row = mysqli_fetch_array($res))
            {
              $data[] = $row; 
            }
          }else
          {
            echo "error";
          }
          
          
          ?>
          <div class="col-sm-12 d-block d-sm-block d-md-none d-lg-block d-xl-block col-lg-5 my-3 my-sm-3 my-md-3 my-lg-0">

            <div class="card card-custom bg-white border-white border-0" style="height: 450px">
              <div class="card-custom-img"
                style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);">
              </div>
              <div class="card-custom-avatar">
              <?php echo "<img class='img-fluid' src='profileImage.php?id=".$clientID."'>"; ?>
              </div>
              <div class="card-body" style="overflow-y: auto">
                <h4 class="card-title"><?php echo $data[0]["nom"]?> <?php echo $data[0]["prenom"]?></h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" colspan="3">Profile</th>
                      <th scope="col"></th>
                      <th scope="col">#ID: <?php echo $data[0]["id"]?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">utilisateur</th>
                      <td></td>
                      <td colspan="3">
                      <?php echo $data[0]["username"]?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">mot de passe</th>
                      <td></td>
                      <td colspan="3">
                        <div class="input-group">
                          <div class="input-group-append">
                            <span class="input-group-text" id="password" data-toggle="modal" data-target="#mypassword"><i class="fa fa-eye-slash"></i></span>
                          </div>
                          <input class="form-control" type="password" value="password" disabled>
                          <aside id="pass">
                            <div class="modal fade" id="mypassword" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div>
                                          <button type="button" class="close d-block float-right" data-dismiss="modal" aria-label="Close" style="background-color: transparent !important; outline: none;">
                                      <img class="d-block float-right" src="./assets/close.png"  alt="close icon" style="width:1.5em; height: 1.5em;">
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="update.php" method="POST" class="m-0">
                                    <h5 class="text-success">Changement du mot de passe</h5>
                                    <p class="text-secondary">La modification sera etablier directement sur votre compte</p>
                                        <div class="form-group" style="margin-top: -2.5em;">
                                          <label for="pass" style="margin-left: 4px;">Entrer votre mot de passe:</label>
                                        <input class="form-control" type="password" name="password" id="pass" style="outline: none;">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="" data-dismiss="modal">Annuler</button>
                                          <button type="submit" name="pass" value="submitted" class="">Envoyez</button>
                                        </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </aside>
                        </div>
                      </td>

                    </tr>
                    <tr>
                      <th scope="row">n° CCP</th>
                      <td></td>
                      <td colspan="3"><?php echo $data[0]["idBank"]?></td>

                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer" style="background: #2c5eaa; border-color: #2c5eaa;">
              <div class="d-flex justify-content-start">
              <label class="btn badge-clock d-inline m-0" data-toggle="modal" data-target="#update"><i class="fa fa-camera" ></i></label>
                <aside id="picture">
                  <div class="modal fade" id="update" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="">
                        <div class="card-custom-avatar">
                          <?php echo "<img class='img-fluid mb-5' display:' id='profile-picture' src='profileImage.php?id=".$clientID."'>"; ?>
                          </div>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: transparent !important; outline: none;">
                              <img src="./assets/close.png"  alt="close icon" style="width:1.5em; height: 1.5em;">
                          </button>
                        </div>
                        <div class="modal-body">
                          <h5 class="float-right text-success">Changer la Photo de Profile</h5>
                          <p class="float-right text-secondary">La modification sera etablier directement sur votre compte</p>
                          <form action="update.php" method="POST" style="height: 200px;" enctype="multipart/form-data">
                          <br>
                          <br>
                          <br>
                            <div class="form-group">
                            <?php echo "<label  for='upload' class='btn badge-clock d-inline m-0 rounded-pill'><i class='fa fa-camera' style=''aria-hidden='true'></i></label>"; ?>
                            <?php echo "<input  id='upload' name='upload' type='file' onchange='showImage.call(this)' accept='.jpg, .png, .jpeg'  />"; ?>
                            </div>
                           
                            <div class="modal-footer">
                              <button type="button" class="" data-dismiss="modal">Annuler</button>
                              <button type="submit" name="photo" value="submitted" class="">Modifier</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </aside>
              <span class="btn btn-transparent text-white" style="cursor: default;">Created:</span><a href="#" class="btn btn-light m-0 px-1 disabled" style="color: #2c5eaa;" id="created_at" ><?php echo $data[0]["created_at"] ?></a>  
            </div>
                
              </div>
            </div>

          </div>
          <?php 
          $idBank = $data[0]["idBank"];
          
          $apiQuery = "SELECT * FROM bankccp WHERE numero_check = $idBank";
          $racordBank = mysqli_query($connection,$apiQuery);
          $dataBank = array();
          if($racordBank)
          {
            while($rowbank = mysqli_fetch_array($racordBank))
            {
              $dataBank[] = $rowbank; 
            }
          }
          
          
          ?>

          <div class="col-sm-12 col-md-6 col-lg-3 my-3 my-sm-3 my-md-3 my-lg-0">
            <div class="card">

              <div class="card-body">
                <h5 class="card-title">Algerie post <img style="width: 2em; height: 2em; border-radius: 50%;"
                    src="https://eccp.poste.dz/img/logo.png" alt=""></h5>
                <p class="card-text">Bienvenue dans notre eccp algerie post api, cette application sert a vous aidez
                  decouvrire la balance du votre compte Sous l'égide d'algerie télécom.</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">CONNEXION ECCP <strong><span
                      style="color: rgba(240, 240, 0, 0.973);">API</span></strong></li>
                <li class="list-group-item"><strong>Votre Crédit:</strong></li>
                <li class="list-group-item bg-dark"><span class="ml-5 rounded display-5 d-inline-block mt-2"
                    style="color: rgba(240, 240, 0, 0.973);font-family: Degital; font-size: 2em;"
                    disabled><?php echo $dataBank[0]['compte'] ?><small>/DA</small></span></li>
              </ul>
            </div>
          </div>
          <!-- show only if medium -->
          <div class="col-md-12 d-md-block d-none d-sm-none d-lg-none d-xl-none my-3 my-sm-3 my-md-3 my-lg-0">

          <div class="card card-custom bg-white border-white border-0" style="height: 450px">
              <div class="card-custom-img"
                style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);">
              </div>
              <div class="card-custom-avatar">
              <?php echo "<img class='img-fluid' src='profileImage.php?id=".$clientID."'>"; ?>
              </div>
              <div class="card-body" style="overflow-y: auto">
                <h4 class="card-title"><?php echo $data[0]["nom"] ?> <?php echo $data[0]["prenom"] ?></h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" colspan="3">Profile</th>
                      <th scope="col"></th>
                      <th scope="col">#ID: <?php echo $data[0]["id"] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">utilisateur</th>
                      <td></td>
                      <td colspan="3">
                      <?php echo $data[0]["username"] ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">mot de passe</th>
                      <td></td>
                      <td colspan="3">
                        <div class="input-group">
                          <div class="input-group-append">
                            <span class="input-group-text" id="password" id="password" data-toggle="modal" data-target="#mypassword-md"><i class="fa fa-eye-slash"></i></span>
                          </div>
                          <input class="form-control" type="password" value="password" disabled>
                          <aside id="pass">
                            <div class="modal fade" id="mypassword-md" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div>
                                          <button type="button" class="close d-block float-right" data-dismiss="modal" aria-label="Close" style="background-color: transparent !important; outline: none;">
                                      <img src="./assets/close.png"  alt="close icon" style="width:1.5em; height: 1.5em;">
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="text-success">Changement du mot de passe</h5>
                                    <p class="text-secondary">La modification sera etablier directement sur votre compte</p>
                                      <form action="update.php" method="POST">
                                        <div class="form-group" style="margin-top: -2.5em;">
                                          <label for="pass"  style="margin-left: 4px;">Entrer votre mot de passe:</label>
                                        <input class="form-control" type="password" name="password" id="pass" style="outline: none;">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="" data-dismiss="modal">Annuler</button>
                                          <button type="submit" name="pass" value="submitted" class="">Modifier</button>
                                        </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </aside>
                        </div>
                      </td>

                    </tr>
                    <tr>
                      <th scope="row">n° CPP</th>
                      <td></td>
                      <td colspan="3"><?php echo $data[0]["idBank"]?></td>

                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer" style="background: #2c5eaa; border-color: #2c5eaa;">
              <div class="d-flex justify-content-start">
              <label class="btn badge-clock d-inline m-0" data-toggle="modal" data-target="#update-md"><i class="fa fa-camera" ></i></label>
                <aside id="picture">
                  <div class="modal fade" id="update-md" tabindex="-1" aria-labelledby="updateModellabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="">
                        <div class="card-custom-avatar">
                          <?php echo "<img class='img-fluid mb-5' display:' id='ppmd' src='profileImage.php?id=".$clientID."'>"; ?>
                          </div>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: transparent !important; outline: none;">
                              <img src="./assets/close.png"  alt="close icon" style="width:1.5em; height: 1.5em;">
                          </button>
                        </div>
                        <div class="modal-body">
                          <h5 class="float-right text-success">Changer la Photo de Profile</h5>
                          <p class="float-right text-secondary">La modification sera etablier directement sur votre compte</p>
                          <form action="update.php" method="POST" style="height: 200px;" enctype="multipart/form-data">
                          <br>
                          <br>
                          <br>
                            <div class="form-group">
                            <?php echo "<label  for='up' class='btn badge-clock d-inline m-0 rounded-pill'><i class='fa fa-camera' style=''aria-hidden='true'></i></label>"; ?>
                            <?php echo "<input  id='up' name='upload' type='file' onchange='showPictureMedium.call(this)' accept='.jpg, .png, .jpeg'  />"; ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="" data-dismiss="modal">Annuler</button>
                              <button type="submit" name="photo" value="submitted" class="">Modifier</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </aside>
              <span class="btn btn-transparent text-white" style="cursor: default;">Created:</span><a href="#" class="btn btn-light m-0 px-1 disabled" id="created_at" style="color: #2c5eaa;"><?php echo $data[0]["created_at"] ?></a>
              </div>
                
              </div>
            </div>

          </div>

        </div> <!-- first row-->
        <div class="row d-none d-sm-none d-md-none d-lg-none d-xl-block">
          <div class="col">
            <div class="card border-0 mt-4 ml-5" style="max-width: 18rem;">
              <div class="card-body bg-light">
                <div id="calendar"></div>
              </div>
            </div>

          </div>
        </div>
        <div class="row mt-5 mb-5" id="statistics">
          <div class="col-sm-12 col-md-12 col-lg-4" style="z-index: -100;">

          </div>
          <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow">
              <div class="card-header badge-primary d-flex align-items-baseline">
                <span class="mr-2">Visitez nos derniers</span> <span class="badge badge-clock display-5"> Nouvelle
                  !</span>
              </div>
              <div class="card-body">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="7"></li>
                  </ol>
                  <div class="carousel-inner">

                    <div class="carousel-item active">
                      <a href="https://www.algerietelecom.dz/fr/particuliers/idoom-fixe-prod1">
                        <img
                          src="https://www.algerietelecom.dz/docs/media/media/1/original/site-web-1600-450-idoom-fixe-fr-1216.jpg"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>


                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/particuliers/idoom-fibre-prod50">
                        <img
                          src="https://www.algerietelecom.dz/docs/media/media/1/original/affiche-fr-2-web-1600x450-1188.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>


                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/particuliers/idoom-adsl-prod3">
                        <img src="https://www.algerietelecom.dz/docs/media/media/1/original/1600-450-fr-1177.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>

                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/derangements">
                        <img src="https://www.algerietelecom.dz/docs/media/media/1/original/1600x450-FR-1008.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    </a>

                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/demande-na">
                        <img src="https://www.algerietelecom.dz/docs/media/media/1/original/1600-450-FR-1015.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>


                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/particuliers/carte-idoom-adsl-prod4">
                        <img src="https://www.algerietelecom.dz/docs/media/media/1/original/1600-450-fr-1002.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>

                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/entreprises/packs-jeunes-entrepreneurs-prod86">
                        <img
                          src="https://www.algerietelecom.dz/docs/media/media/1/original/Visuel-jeune-entrepreneur-version-finale-1600x450-fr2-1--1135.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>
                    <div class="carousel-item">
                      <a href="https://www.algerietelecom.dz/fr/page/bonus-paiement-en-ligne-p80">
                        <img src="https://www.algerietelecom.dz/docs/media/media/1/original/1600x450-FR-994.png"
                          class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                      </a>
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- second row-->



      </div>
    </div>
  </section>
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
            <p><a class="no-decoration-simple" href="https://www.algerietelecom.dz/fr/particuliers">Particuliers</a></p>
            <p><a class="no-decoration-simple" href="https://www.algerietelecom.dz/fr/entreprises">Professionnels</a>
            </p>
          </div>
          <div class="col-lg-4 d-flex flex-column justify-content-center" style="height: 10em;">
            <h4>Profile et operations</h4>
            <p><a class="no-decoration-simple" href="./userINF.php" style="display: block !important;">Voir vos informations</a></p>
            <p><a class="no-decoration-simple" href="./contact.php" style="display: block !important;">Voir vos contact</a></p>
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

            <img src="https://www.algerietelecom.dz/assets/front/img/logo.svg" style="width: 9em; height: 9em;" alt="">

          </div>
          <div class="col-lg-4 text-center d-flex justify-content-center align-items-center">
            <p style="margin-top: 2.5em;">Algérie Télécom &copy; e-commerce service 2021</p>
          </div>
          <div class="col-lg-1">

          </div>
          <div
            class="col-lg-2 d-flex justify-content-center align-items-center justify-content-lg-around align-items-lg-center"
            style="margin-top: 1.2em;">
            <a class="social linkedin mx-2 mx-lg-none  mb-3 mb-lg-0"
              href="http://www.linkedin.com/company/algerie-telecom"><i class="fab fa-linkedin"></i></a>
            <a class="social youtube mx-2 mx-lg-none  mb-3 mb-lg-0"
              href="https://www.youtube.com/user/Tvalgerietelecom"><i class="fab fa-youtube"></i></a>
            <a class="social discord mx-2 mx-lg-none  mb-3 mb-lg-0" href="https://discord.gg/csQcs7AJ"><i
                class="fab fa-discord"></i></a>
            <a class="instagram mx-2 mx-lg-none mb-3 mb-lg-0" href="http://www.instagram.com/algerietelecom"><i
                class="fab fa-instagram"></i></a>
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
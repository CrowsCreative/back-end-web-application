<?php include("../../../server/firstdb.php"); ?>
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
  <link rel="stylesheet" href="./assets/stylesheet/ground.css">
  <link rel="stylesheet" href="./assets/stylesheet/login.css">
  <link rel="stylesheet" href="./../profile/assets/stylesheet/style.css">
  <title>Algerie Telecom - e-produits</title>

  <style>
    body {
  width: 100%;
  margin: 0;
  padding: 0;
  font-family: "Oswald", "Helvetica Neue";  
}
        @font-face {
    font-family: Degital;
    src: url(./DS-DIGIB.TTF);
    }


    @media screen and (min-width: 576px)
    {
      #categorie
      {
        width: 21em;
        display: block;
        margin-left: 25px;
      }
    }
    .item
    {
      transform: scale(1) !important;
      transition: all 0.4s ease-out !important;
    }
    .item:hover,.item:focus 
    {
      transform: scale(1.02)  !important;
      box-shadow: 0px 0px 2.5px 2.5px #78dddd;
      
    }

    .background-blury
{
  -webkit-backdrop-filter: blur(5px) !important;
  backdrop-filter: blur(5px) !important;
  width: 100%;
  height: 100%;
 
}

@media screen and (max-width: 992px) {
  
  body {
    width: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Titillium Web', sans-serif;
    background-image: none;
    background-color:rgb(6,19,36) ;
    
  }

  
  .background-blury {
    background-color: rgb(6,19,36);
    background-image: none;
    height: 100%;
    color: white;
  }

  svg
{
  width: 10em;
  height: 10em;
}
}

.no-decoration-simple
{
  text-decoration: none !important;
  color: white !important;
  
}
.no-decoration-simple:hover
{
  text-decoration: underline !important;
  color: white !important;
  
}

.no-decoration
{
  text-decoration: none !important;
  transform: scale(1.5);
  padding-left: 2%;
  padding-right: 2% ;
  padding-bottom: 2%;
}

#item-nav-active{
  color: #f3f3f5;
  background-color: #2556a2;
  border: none;
}

#item-nav{
  color: #2556a2;
  background-color: transparent;
  border: none;
}

#item-nav:hover{
  color: #20b471;
  background-color: transparent;
  border: none;
}

#item-nav-active::after {
  position: absolute;
  bottom: -10px;
  left: 50%;
  content: '';
  width: 0;
  height: 0;
  border-left: 12px solid transparent;
  border-right: 12px solid transparent;
  border-top: 12px solid #2556a2;
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
}

#nav-text
{
  display: block;
  margin-top: 10px;
}


#item-nav-sm-active{
  color: #f3f3f5;
  background-color: #2556a2;
  border: none;
}

#item-sm-nav{
  color: #2556a2;
  background-color: transparent;
  border: none;
}

#item-sm-nav:hover{
  color: #20b471;
  background-color: transparent;
  border: none;
}

.badge-white
{
  background-color: white;
  color: #888888;
}

.social a:hover 
{
  -webkit-transform: scale(1.2);
  -ms-transform: scale(1.2);
  -o-transform: scale(1.2);
  transform: scale(1.2); 

}

.linkedin
{
  color: #838383;
  transform: scale(1);
  transition: all 0.2s ease-in-out;
}
.discord
{
  color: #838383;
  transform: scale(1);
  transition: all 0.2s ease-in-out;
}
.youtube
{
  color: #838383;
  transform: scale(1);
  transition: all 0.2s ease-in-out;
}
.instagram
{
  color:#838383;
  transform: scale(1);
  transition: all 0.2s ease-in-out;
}


.linkedin:hover
{
  color: #0077b5;
  transform: scale(1.5);
}
.discord:hover
{
  color: #405de6;
  transform: scale(1.5);
}
.youtube:hover
{
  color: #fa0000;
  transform: scale(1.5);
}
.instagram:hover
{
  color:#e224d2;
  transform: scale(1.5);
}

::-webkit-scrollbar {
  width: 12px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px #2556a2; 
  background: #2556a2;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #3277dd; 
  border-radius: 10px;
  border: 0px;

}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #367de7; 
}

.badge-primary
{
    background-color: rgb(6,19,36) !important;
    color: #78dddd;
}
  </style>
</head>

<body class="bg-light">

  <div id="preloader"></div>

  <div id="circularMenu1" class="circular-menu circular-menu-left" style="color: white;">

    <a class="floating-btn" onclick="document.getElementById('circularMenu1').classList.toggle('active');">
      <i class="fa fa-bars"></i>
    </a>
  
    <menu class="items-wrapper">
      <a href="../../index.php" class="menu-item fa fa-home"   data-toggle="tooltip" data-placement="right" title="Page d'accueil"></a>
      <a href="./view.php" class="menu-item fa fa-search"  data-toggle="tooltip" data-placement="right" title="Parcourir algérie télécom"></a>
      <a href="http://localhost/algerie%20telecom/clients/routes/login/rp.php?q=reset" class="menu-item fa fa-key"  data-toggle="tooltip" data-placement="right" title="Oublier mot de passe ?"></a>
      <a href="./login.php" class="menu-item fa fa-user"  data-toggle="tooltip" data-placement="right" title="Espace Client"></a>
    </menu>
    
  </div>
  <div class="background-blury">
       <!-- partial:index.partial.html -->
    <div id="particles-js"></div> 
  <section>
  <?php 
  
  $querySQL = "SELECT DISTINCT type FROM produits";
  $types = mysqli_query($conn, $querySQL);

  $arr = array();
  if($types && mysqli_num_rows($types) > 0)
  {
    while($row = mysqli_fetch_array($types))
    {
      $arr [] = $row; 
    }
  }else
  {
    echo "<script>alert('erreur du connexion client/serveur'); </script>";
  }

  if(isset($_GET['desktop-submit']) OR isset($_GET['mobile-submit']))
  {
    if(isset($_GET['mobile-submit'])) $categorie = $_GET["mobile-submit"];
    else $categorie = $_GET["categorie"];
    
    $SQL = "SELECT * FROM produits WHERE type= '$categorie'";
    $RES = mysqli_query($conn, $SQL);
  
    $prod = array();
    if($RES && mysqli_num_rows($RES) > 0)
    {
      while($row = mysqli_fetch_array($RES))
      {
        $prod [] = $row; 
      }
    }else
    {
      echo "<script>alert('erreur du connexion client/serveur'); </script>";
    }

  }else
  {
    //used for the first time
    $SQL = "SELECT * FROM produits";
    $RES = mysqli_query($conn, $SQL);
  
    $prod = array();
    if($RES && mysqli_num_rows($RES) > 0)
    {
      while($row = mysqli_fetch_array($RES))
      {
        $prod [] = $row; 
      }

      
    }else
    {
      echo "<script>alert('erreur du connexion client/serveur'); </script>";
    }
  }
  
  ?>
  
  <div class="container">
    <div class="container">
  <div class="row">
      <div class="col d-flex justify-content-center align-items center">
            <div class="jumbotron my-5 shadow rounded badge-primary">
        <div class="container">
            <h1 class="display-4">ALGERIE TELECOM
            <img src="./stores.png" style="width: 3.5rem; margin-bottom:15px;">
            </h1>
            <p class="lead">bienvenue dans algerie telecom store, la vous pouvez voir tous les produits qui nous vous offres.</p>
        </div>
        </div>
      </div>
  </div>
    <div class="row ">
    <?php foreach($prod as $product)
    { ?>
    <div class="col-sm-12 d-flex justify-content-center align-items-center col-md-6 col-lg-4 col-xl-4 my-4">
    <div class="card rounded item" style="width: 18rem;background-color: rgba(255,255,255,0.3) !important; color:white;">
  <?php echo "<img src='../profile/productImage.php?id=".$product['id']."' class='card-img-top img-fluid' style='height:18rem;overflow:hidden;'>"; ?>
  <div class="card-body" >
    <h5 class="card-title"><?= $product['nom'] ?> <span class="badge badge-primary"><?= $product['nature'] ?></span></h5>
    <p class="card-text bg-light p-3 rounded text-dark"><?= $product['description'] ?>.</p>
  </div>
  <div class="card-footer bg-white d-flex justify-content-between align-items-baseline" style="width: 18rem;background-color: rgba(255,255,255,0.3) !important; color:white;">
    <h5 class="card-title" style="width:text-content !important;">Prix:  <span class="badge badge-primary d-inline" style="font-family: Degital; font-size:1.2em;"><?= $product['prix'] ?></span> DA</h5>
    <p class="card-text  px-4 rounded badge-primary" style="font-family: monospace;"><?= $product['quantite'] ?></p>
    
  </div>
</div>
    </div>
    <?php 
    } ?>
    </div>
    </div>
  </div>
  </section>
  </div>
  <section id="footer" >
    <div class="container-fluid  d-none d-lg-block badge-primary">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 d-flex flex-column justify-content-center " style="height: 10em;">
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
  <section id="footer2" style="z-index: 1000; background-color:white;">
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

  
  <script src='https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js'></script>
  <script src="./assets/script/ground.js"></script>
  <script src="./../profile/assets/script/script.js"></script>
  <script src=" ./../profile/assets/script/purchase.js"></script>
  <script type="text/javascript">
   $('.menu-item').tooltip();
   $('.ccp').tooltip()
 </script>

</body>
</html>
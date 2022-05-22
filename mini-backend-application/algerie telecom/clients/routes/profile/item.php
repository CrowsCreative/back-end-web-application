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
  
        $prod = array();
        if(isset($_POST['SEARCH_ITEM']))
        {
          
          
        
            if(isset($_POST['SEARCH_ITEM'])) $itemID = (int)$_POST['SEARCH_ITEM'];
            else $itemID = 0;
            
            $SQL = "SELECT * FROM produits WHERE id= $itemID";
            $RES = mysqli_query($conn, $SQL);
            if($RES && mysqli_num_rows($RES) > 0)
            {
            while($row = mysqli_fetch_array($RES))
            {
                $prod [] = $row; 
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
      box-shadow: 0px 0px 2.5px 2.5px #ddd;
    }

    #CCP:hover,#CCP:focus{
      background-color: #343a40;
      color: #ffc107;
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
      <a href="./purchase.php" class="menu-item fa fa-search  activation-circle-nav-navigation" data-toggle="tooltip" data-placement="right" title="Page d'achat"></a>
      <a href="./profile.php" class="menu-item fa fa-id-card" data-toggle="tooltip" data-placement="right" title="Espace Client"></a>
      <a href="profile.php?logout_user='1'" class="menu-item fa fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Déconnexion"></a>
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
          <span class="date">date</span>
          &nbsp;&nbsp;&nbsp;
          <div class="text-info d-inline-block">
          <p class=" bg-light p-1 text-info rounded text-center d-inline-block ccp"  data-toggle="tooltip" data-placement="bottom" title="Compte ccp" ><span style="font-family: monospace;"><?=  $dataBank[0]['compte']?></span> DA</p>
          </div>
          
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
                <a id="item-nav" href="./profile.php" class="menu-item no-decoration text-center"><span id="nav-text">Espace
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
                  <a id="item-sm-nav" href="./profile.php" class="menu-item no-decoration text-center"><span
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


  <section>
  <div class="container">
    <div class="container">
    <div class="row my-5">
    <?php 
    
      
      foreach($prod as $product)
      { 
      
      ?>
    <div class="col-sm-12 d-flex justify-content-center align-items-center col-md-6 col-lg-4 col-xl-4 my-4">
    <div class="card rounded item" style="width: 18rem;">
  <?php echo "<img src='productImage.php?id=".$product['id']."' class='card-img-top img-fluid' style='height:18rem;overflow:hidden;'>"; ?>
  <div class="card-body">
    <h5 class="card-title" style=""> <?= $product['nom'] ?> <span class="badge badge-clock"><?= $product['nature'] ?></span></h5>
  </div>
  <div class="card-footer bg-white d-flex justify-content-between align-items-baseline">
    <h5 class="d-flex align-items-baseline justify-content-between">Prix: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="badge badge-success d-inline" style="font-family: Degital; font-size:1.2em;"><?= $product['prix'] ?> DA</div> </h5>
    </div>
   </div>
    </div>
    <?php 
     }
    
    ?>
    
     <form class="bg-white border" style="width: 35em;" action="purchaseQuery.php" method="POST">
     <div class="p-4" style="margin-top: -30px;">
     <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Nom">Nom produit:</label>
      <input type="text" class="form-control" name="nom" id="Nom" value="<?= $prod[0]['nom'] ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <label for="Nature">Nature produit:</label>
      <input type="text" class="form-control" name="nature" id="Nature" value="<?= $prod[0]['nature'] ?>" disabled>
    </div>
    </div>
  <div class="form-group">
    <label for="Description">Description:</label>
    <textarea type="text" class="form-control" name="description" id="Description" disabled><?= $prod[0]['description'] ?></textarea>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="n_achat">Nombre d'achat:</label>
    <input type="text" class="form-control" name="n_achats" id="n_achat" value="<?= $prod[0]['n_achats'] ?>" disabled>
  </div>
  <div class="form-group col-md-6">
    <label for="quantite">Quantite:</label>
    <input type="text" class="form-control" name="q" id="quantite" value="<?= $prod[0]['quantite'] ?>" disabled>
  </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="CCP">VOTRE CCP:</label>
      <input type="text" style="font-family: Degital; color:#ffc107;" class="form-control bg-dark" name="ccp" value="<?= $dataBank[0]['compte'] ?>" id="CCP" disabled>
    </div>
    <?php
    if($prod[0]['quantite'] > 0)
    {
      echo "<div class='form-group col-md-4'>";
      echo "<label for='quantite_acheter'>Chosir une quantité</label>";
      echo "<input type='number' class='form-control'  name='quantite_acheter' value='0' id='quantite_acheter' min='0' max='".$prod[0]['quantite']."' step='1'>";
      echo "</div>";
    }else
    {
      echo "<div class='form-group col-md-4'>";
      echo "<label for='quantite_acheter'>Chosir une quantité</label>";
      echo "<input style='background-color:#f03554 !important; color:white;' type='number' class='form-control'  name='quantite_acheter' value='0' id='quantite_acheter' min='0' max='".$prod[0]['quantite']."' step='1' disabled>";
      echo "</div>";
    }
    
    ?>
    <div class="col-md-2">
    <label for="showID">Id :</label>
      <input type="number" class="form-control"  name="showID" id="showID"  value="<?= $prod[0]['id'] ?>" disabled>
      <input type="number" class="form-control"  name="this_item_id" id="this_item_id"  value="<?= $prod[0]['id'] ?>" hidden>
    </div>

    <div class="col-sm-9 col-md-6 m-sm-0" >
      <input  name="purchase_date" id ="purchase_date" value="" hidden>
      <script type="text/javascript">
      let purchase_date = new Date();
          document.querySelector('#purchase_date').setAttribute('value', purchase_date);
      </script>
  </div>

  </div>
  <div class="alert alert-danger d-none" role="alert" id="ERR">
  <p>Imposible de continuer cette operation.</p>
    
  </div>
    
   
  
   <?php 
   if($prod[0]['quantite']>0)
   {
    echo " <button type='submit' name='ITEM' value='ITEM' id='purchaseTheItem' class='badge.clock mt-3' style='background-color: #20b471; color:white; padding:10px 2em;border:none;'>achat</button>";
   }
   ?> 
 
     </div>
</form>
<script type="text/javascript" >
const ccp = document.querySelector('#CCP');
const quantite = document.querySelector('#quantite_acheter');
const purchase = document.querySelector('#purchaseTheItem');
const product_price = Number(<?= $product['prix'] ?>);
console.log(product_price);
let cost = ccp.value;
quantite.addEventListener('input', e=>
{
  ccp.value = cost;
  ccp.value = ccp.value - (quantite.value * product_price);
  if(ccp.value < 0)
  {
    ccp.style.color= '#f03554';
    document.querySelector('#ERR').classList.remove('d-none');
    purchase.setAttribute('disabled', 'disabled');
    purchase.style.backgroundColor = '#eee';
    purchase.style.color = '#222';
    purchase.style.padding = '10px 2em';
    purchase.style.cursor = 'not-allowed';
    purchase.style.border = 'none';
  }else
  {
    ccp.style.color = '#ffc107';
    document.querySelector('#ERR').classList.add('d-none');
    purchase.removeAttribute('disabled');
    purchase.style.backgroundColor = '#20b471';
    purchase.style.color = 'white';
    purchase.style.padding = ' 10px 2em';
    purchase.style.cursor = 'pointer';
    purchase.style.border = 'none';
  }
});
quantite.addEventListener('keypress', e=>
{
  e.preventDefault();
});

</script>
    </div>
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


  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment-with-locales.min.js'></script>
  <script src="./assets/script/script.js"></script>
  <!--script src="./assets/script/purchase.js"></script-->
  <script type="text/javascript">
   $('.menu-item').tooltip();
   $('.ccp').tooltip()
 </script>
</body>
</html>
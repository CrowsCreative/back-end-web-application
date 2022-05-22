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

$sql = "SELECT * from carte WHERE status= '$clientID'";
$cards = mysqli_query($conn, $sql);

$userCards= array();
if($cards && mysqli_num_rows($cards) > 0)
{
  
  while($cards_row = mysqli_fetch_array($cards))
  {
    $userCards[] = $cards_row;
  }

}else
{
  $_SESSION['ERROR'] = "ERROR server: peuve pas retirez les carte veuillez essayez plus tard";
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
  <link rel="stylesheet" href="./assets/stylesheet/userINF.css">
  <link rel="stylesheet" href="./assets/stylesheet/style.css">
  <link rel="stylesheet" href="./assets/stylesheet/cards.css">
  <style>
    *
    {
      outline: none;
    }
    body {
      font-family: "Oswald", "Helvetica Neue";
    }

    .badge-danger
    {
      background-color: rgb(134, 12, 134) !important;
      color: white;
    }

    .badge-primary
    {
      background-color: rgb(24, 105, 255)  !important;
      color: white;
    }

    .badge-warning
    {
      background-color: rgb(231, 0, 231)  !important;
      color: white;
    }

    .badge-success
    {
      background-color: rgb(1, 207, 28)  !important;
      color: white;
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
      <a href="./userINF.php" class="menu-item fa fa-info-circle"  data-toggle="tooltip" data-placement="left" title="Information personelle"></a>
      <a href="./carte.php" class="menu-item fa fa-credit-card activation-circle-nav-profile"  data-toggle="tooltip" data-placement="left" title="Voir la carte"></a>
      <a href="./contact.php" class="menu-item fas fa-comment-alt"  data-toggle="tooltip" data-placement="left" title="Contact support"></a>
      <a href="#" class="menu-item fa fa-trash"  data-toggle="modal" data-target="#exampleModal"  data-toggle="tooltip" data-placement="left" title="Désabonement"></a>
    </menu>

  </div>


  <div id="circularMenu1" class="circular-menu circular-menu-left">

    <a class="floating-btn" id="f2">
      <i class="fa fa-bars"></i>
    </a>

    <menu class="items-wrapper">
      <a href="../../index.html" class="menu-item fa fa-home" data-toggle="tooltip" data-placement="right" title="Page d'accueil"></a>
      <a href="./purchase.php" class="menu-item fa fa-search" data-toggle="tooltip" data-placement="right" title="Page d'achat"></a>
      <a href="./profile.php" class="menu-item fa fa-id-card" data-toggle="tooltip" data-placement="right" title="Espace Client"></a>
      <a href="carte.php?logout='1'" class="menu-item fa fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Déconnexion"></a>
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
          <span class="date">date</span>
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
    <?php if(isset($_SESSION['ERROR']))
          {
            echo "<div class='alert alert-danger'>";
            echo $_SESSION['ERROR'];
            echo "</div>";
          }
    ?>
  </section>
   
    <section id="main">
        <div class="container">
          <div class="container">
          <?php if(isset($_GET['id']))
          { 
            $id = (int)$_GET['id'];
            $res = mysqli_query($conn, "SELECT code FROM carte WHERE n_serie= $id");
            $row = mysqli_fetch_assoc($res);
            $updated = mysqli_query($conn, "UPDATE carte SET isChecked='TRUE' WHERE n_serie= $id");
            if((int)$_GET['prix'] == 500)
            {
              $style = 'background-color: rgb(1, 207, 28)  !important; color: white;';
              $style_tag= 'background-color: #00a959; color: white;';
              
            }else if((int)$_GET['prix']== 1000){
            
              $style = 'background-color: rgb(231, 0, 231)  !important; color: white;';
              $style_tag= 'background-color: #910d90; color: white;';
              
            }else if((int)$_GET['prix'] == 2000)
            {
              $style = 'background-color: rgb(24, 105, 255)  !important; color: white;';
              $style_tag= 'background-color: #7a70ff; color: white;';

            }else if((int)$_GET['prix'] == 3000)
            {
              $style = 'background-color: rgb(134, 12, 134) !important; color: white;';
              $style_tag= 'background-color: #d13bd9; color: white;';
            }

  
          ?>
            <div class="row">
              <div class="col-lg-4 text-center text-secondary shadow rounded">
                <br>
                 <h2 class="">Code d'activation &nbsp;<i class="fas fa-credit-card" style="color:#1379bb"></i></h2>
                  <br>
                  <hr>
                  <p>Votre code d'activation du la carte sert a recharger votre connection internet.</p>
                  <br>
                  <p>Vous pouvez benefisez de notre rechargement secours <span style="font-size: 2em; color: #00a959 ; font-family: Degital, monospace;">96</span><strong>/H</strong>&nbsp; par appellez <span style="font-size: 2em; color: #00a959 ; font-family: Degital, monospace;">1500.</span></p>
                  <br>  
                  <p><strong>NB:</strong> la durées du rechargement est selon votre abonnement internet , pour plus d'information conntactez nos services.</p>
                  <hr>
                  <br>
              </div>
              <div class="col-lg-8  text-secondary shadow rounded bg-white d-flex justify-content-center align-items-center">
                <form class="my-5 my-lg-0" action="" method="" id="formdemande">
                
                    <div class="scratch-card" style="<?= $style ?>">
                        
                            <h3 style="color: white;"><small>CARTE RECHARGEMENT</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo (int)$_GET['prix']; ?></strong><sup><small>DA</small></sup></h3>
                            <h2><hr></h2>
                        
                        <p class="rounded text-center" style="<?= $style_tag ?>">Grattez pour obtenez votre code</p>
                        <div id="scratch-container" class="scratch-container scratch-card-background">
                          <canvas class="scratch-canvas" id="scratch-canvas" width="300" height="60" style="margin-right: 4em;"></canvas>
                          <p id="code" class="code">
                          <?= $row['code'] ?>   
                          </p>
                        </div>
                        
                      </div>
                   </form>               									
                </div>
            </div>
            <?php }else{  ?>
              <div class="row">
              <div class="col-lg-4 text-center text-secondary shadow rounded">
                <br>
                 <h2 class="">Code d'activation &nbsp;<i class="fas fa-credit-card" style="color:#1379bb"></i></h2>
                  <br>
                  <hr>
                  <p>Votre code d'activation du la carte sert a recharger votre connection internet.</p>
                  <br>
                  <p>Vous pouvez benefisez de notre rechargement secours <span style="font-size: 2em; color: #00a959 ; font-family: Degital, monospace;">96</span><strong>/H</strong>&nbsp; par appellez <span style="font-size: 2em; color: #00a959 ; font-family: Degital, monospace;">1500.</span></p>
                  <br>  
                  <p><strong>NB:</strong> la durées du rechargement est selon votre abonnement internet , pour plus d'information conntactez nos services.</p>
                  <hr>
                  <br>
              </div>
              <div class="col-lg-8  text-secondary shadow rounded bg-white d-flex justify-content-center align-items-center">
                <form class="my-5 my-lg-0" action="" method="" id="formdemande">
                
                    <div class="">
                    <blockquote class="blockquote text-center">
                    <p class="mb-0" style="color:#1379bb">Ensemble Pour L'Evolution.</p>
                    <footer class="blockquote-footer">Algerie Telecom <cite title="Source Title">2020/2021</cite></footer>
                  </blockquote>
                        <video class="rounded shadow" style="width:30em;" src="./assets/Home Video.mp4"  autoplay loop muted></video> 
                        
                      </div>
                   </form>               									
                </div>
            </div>
            <?php }
            
            ?>
            <div class="row my-5">
              <div class="container bootdey ">
                <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow overflow-auto" style="height: 500px;">
                <div class="card-body">
                    <table class="table table-striped table-light">
                        <thead>
                          <tr>
                            <th scope="col" style="color: #2c5eaa  !important;">N° serie</th>
                            <th scope="col" style="color: #2c5eaa  !important;">Prix</th>
                            <th scope="col" style="color: #2c5eaa  !important;">Nature</th>
                            <th scope="col" style="color: #2c5eaa  !important;">Status</th>
                            <th scope="col" style="color: #2c5eaa  !important;" class='text-center'>voir code</th>
                          </tr>
                        </thead>
                        <tbody  style="overflow-y: auto !important;">
                        <?php 
                        foreach($userCards as $carte)
                        {
                          $idItem = (int)$carte['idproduit'];
                          $card_color= '';
                          $badge = '';
                          $queries = "SELECT * FROM produits WHERE id= $idItem";
                          $racord = mysqli_query($conn, $queries);
                          $temp= array();
                          if($racord)
                          {
                            while($row = mysqli_fetch_array($racord))
                            {
                              $temp[] = $row;
                            }
                          }
                          if($temp[0]['prix'] == 500)
                          {
                            $card_color= 'card-500';
                            $badge = 'badge-success';
                            
                          }else if($temp[0]['prix'] == 1000)
                          {
                            $card_color= 'card-1000';
                            $badge = 'badge-warning';
                            
                          }else if($temp[0]['prix'] == 2000)
                          {
                            $card_color= 'card-2000';
                            $badge = 'badge-primary';

                          }else if($temp[0]['prix'] == 3000)
                          {
                            $card_color= 'card-3000';
                            $badge = 'badge-danger';
                          }
                          
                          echo "<tr>";
                          echo "<th scope='row' class='".$card_color."'>".$carte['n_serie']."</th>";
                          echo "<td> <span class='badge ".$badge."'>".$temp[0]['prix']."/DA<span></td>";
                          echo "<td>".$temp[0]['nature']."</td>";
                          if($carte['status'] != 'Active')
                          {
                            echo "<td>achetée</td>";
                          }
                          if($carte['isChecked'] == 'FALSE')
                          {
                            echo "<td class='text-center'><code><a href='carte.php?id=".$carte['n_serie']."&prix=".$temp[0]['prix']."' style='text-decoration:none;'>xxxx - xxxx - xxxx - xxxx<a></code></td>";
                          }else
                          {
                            echo "<td class='text-center'><kbd>".$carte['code']."</kbd></td>";
                          }
                         
                          echo "</tr>";
                          
                        }
                        ?>

                        </tbody>
                      </table>
                     
                </div>
                </div>
                </div>
                </div>
                </div>
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
  <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    })
  </script>

  <script type="text/javascript">
   $('.menu-item').tooltip()
 </script>
<script src="./assets/script/cards.js"></script>
</body>

</html>

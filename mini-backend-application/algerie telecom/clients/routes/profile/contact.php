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
<?php 

$query = "SELECT * FROM `message`,`reponse` WHERE message.idpropritaire = reponse.clientid AND message.id = reponse.messageid AND reponse.clientid = $clientID";
$racords = mysqli_query($conn, $query);

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
  <title>Espace Client - Account</title>
  <style>
    *
    {
      outline: none;
    }
    body {
      font-family: "Oswald", "Helvetica Neue";
    }
  </style>
   <?php 

if(isset($_POST['submit']))
{
  if(isset($_POST['suject']))   $suject= $_POST['suject'];
  else $suject="";
  if(isset($_POST['contenue']))  $contenue= $_POST['contenue'];
  else $contenue="";
  if(isset($_POST['envoyez_le']))  $envoyez_le= $_POST['envoyez_le'];
  else $envoyez_le="";
  function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
  
    return preg_replace('/[^A-Za-z0-9\-çèà]/', '', $string); // Removes special chars.
  }
  $contenue = clean($contenue);
  echo "<script>alert(".$clientID." - ".$suject." - ".  $contenue." - ".$envoyez_le.")</script>";
  $sql = "INSERT INTO message(idpropritaire,contenue,envoyez_le,suject) VALUES('$clientID','$contenue','$envoyez_le','$suject')"; 
  $result = mysqli_query($conn, $sql);
  if ($result) {
  
    $d_nombre = array();
    $get_nombre = "SELECT * FROM statistique";
    $r_nombre = mysqli_query($conn, $get_nombre);
    if($r_nombre){
        while($row = mysqli_fetch_array($r_nombre)){
            $d_nombre = $row;
        }
        $nombreMessage = $d_nombre['nombreMessage'] + 1;
        $update_nombre_message = "UPDATE `statistique` SET `nombreMessage`='$nombreMessage'";
        $r_update_nombre_message = mysqli_query($conn, $update_nombre_message);
        if($r_update_nombre_message){

          header("Location: contact.php");
       }
}

  } else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

?>
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
      <a href="./contact.php" class="menu-item fas fa-comment-alt activation-circle-nav-profile"  data-toggle="tooltip" data-placement="left" title="Contact support"></a>
      <a href="#" class="menu-item fa fa-trash"  data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="left" title="Désabonement"></a>
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
      <a href="contact.php?logout_user='1'" class="menu-item fa fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Déconnexion"></a>
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
  </section>

    <section id="main">
        <div class="container">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 text-center text-secondary shadow rounded">
                <br>
                 <h2 class="">Contact admin &nbsp;<i class="fas fa-comment-alt" style="color:#1379bb"></i></h2>
                  <br>
                  <hr>
                  <p>Bienvenu dans l’espace dédié aux demandes du support avec l'administration en ligne.</p>
                  <br>
                  <p>Que vous soyez Particulier, Professionnel ou revendeur déposez votre demande de ligne fixe ou de connexion Internet en remplissant le formulaire.</p>
                  <br>  
                  <p>Votre demande sera prise en charge dans les meilleurs délais et nous reviendrons vers vous après une étude de faisabilité et de disponibilité.</p>
                  <hr>
                  <br>
              </div>
              <div class="col-lg-8 text-secondary shadow rounded bg-white">
                <form action="contact.php" method="POST">
                
                    <div  class="form-group row d-flex  justify-content-around align-items-baseline">
                        <label for="type_client" class="col-sm-6 text-sm-center col-md-3 required">Type de support<span style="color: rgb(252, 39, 1);">*</span></label>
                        <div class="col-sm-9 col-md-6" >
                            <select name="suject"  class="form-control"  required>
                                    <option value="">---Choisir---</option>
                                    <option value="Technique">Technique</option>
                                    <option value="Information">Information</option>
                                    <option value="Problem de recevoire code carte">Problem de recevoire code carte</option>
                            </select>
                            <span class="text-danger" ></span>
                        </div>
                    </div>                									
                    <div  class="form-group row d-flex  justify-content-around align-items-baseline">
                        <label for="nature" class="col-sm-6 text-sm-center col-md-3 align-self-start required">Contenue du votre demande<span style="color: rgb(252, 39, 1);">*</span></label>
                        <div class="col-sm-9 col-md-6 m-sm-0" >
                            <textarea class="d-block" name="contenue" id="" cols="10" rows="7" style="width: 100%;" required></textarea>
                            <span class="text-danger" ></span>
                        </div>
                   </div>
                   <div class="form-group row d-flex  justify-content-around align-items-baseline" hidden>
                        <label for="nature" class="col-sm-6 text-sm-center col-md-3 align-self-start required" hidden>time<span style="color: rgb(252, 39, 1);">*</span></label>
                        <div class="col-sm-9 col-md-6 m-sm-0" >
                            <input  name="envoyez_le" id ="envoyez_le" value="" hidden>
                            <script>
                            let envoyez_le = new Date();
                                document.querySelector('#envoyez_le').setAttribute('value', envoyez_le);
                            </script>
                            <span class="text-danger" hidden></span>
                        </div>
                   </div>
                   <div id="block_nature" class="form-group row my-5 align-items-center">
                    
                    <div class="col-12">
                        <button type="sumbit" name="submit">SEND</button>
                        <span class="text-danger" ></span>
                    </div>
                  </div> 
                   </form>               									
                </div>
            </div>
            <div class="row my-5">
              <div class="container bootdey ">
                <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow overflow-auto" style="height: 500px;">
                <div class="card-body">
                <!-- Timeline start -->
                <div class="timeline">
                <?php 
                  
                  $timeline= array();
                  while($row = mysqli_fetch_array($racords))
                  {
                   $timeline[] = $row;
                  }

                  ?>

                  <?php 
                  foreach($timeline as $message)
                  {
                    
                    echo "<div class='timeline-row'>";
                    echo "<div class='timeline-time'><span id='time'>".$message["envoyez_le"]."</span><small>".$message["envoyez_le"]."</small>"; 
                    echo "</div>";
                    echo "<div class='timeline-dot fb-bg'></div>";
                    echo "<div class='timeline-content'>";
                    echo "<i class='fa fa-cube'></i>";
                    echo "<h4>".$message["suject"]."</h4>";
                    echo "<p class='text-content text-left'>".$message["contenue"]."</p>";
                    echo "<div>";
                    echo "<span class='badge badge-light'>ID: ".$message['messageid']."</span>";
                    echo "</div></div></div>";

                    echo "<div class='timeline-row'>";
                    echo "<div class='timeline-time'><span id='time'>".$message["envoyez_at"]."</span><small>".$message["envoyez_at"]."</small>"; 
                    echo "</div>";
                    echo "<div class='timeline-dot fb-bg'></div>";
                    echo "<div class='timeline-content'>";
                    echo "<i class='fa fa-cube'></i>";
                    echo "<h4>".$message["subject"]."</h4>";
                    echo "<p class='text-content'>".$message["content"]."</p>";
                    echo "<div>";
                    echo "<span class='badge badge-light'>ID: ".$message['id']."</span>";
                    echo "</div></div></div>";
                    
                  }

                  ?>
      
                </div>
                <!-- Timeline end -->
                </div>
                </div>
                </div>
                </div>
                </div>
            </div>
          </div>
        </div>
        <script>
        const timeline_time = document.querySelectorAll('.timeline-time');
        console.log(timeline_time);
              timeline_time.forEach(timeline => 
              {
                let time = timeline.querySelector("#time");
                let message_date = timeline.querySelector('small');
                let date = new Date(time.innerText);
                time.innerText = date.toLocaleTimeString();
                message_date.innerText = date.toDateString();
              })
        const texts = document.querySelectorAll(".text-content");
              console.log(texts);
              texts.forEach(text=>
              {
                text.innerText = text.innerText.replaceAll('-',' ');
              })
        </script>
        
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
</body>

</html>
<?php 
 mysqli_close($conn);
?>
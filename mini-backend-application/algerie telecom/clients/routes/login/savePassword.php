<?php include('../../../server/server.php'); ?>
<?php
unset($_SESSION['AUTHORIZED']);
if(isset($_SESSION['success']) && (string)$_SESSION['success'] == 'GCwUveguBGr4eDsYyzfINmP6JDpTdiKFJ0iElYHVO5I' && isset($_SESSION['successCODE']) && (string)$_SESSION['successCODE'] == 'I Love Programming (^3^)!')
{
  $clientID = $_SESSION['id'];
}else
{
  unset($_SESSION['success']);
  header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Espace Client</title>
  <link rel="shortcut icon"  href="https://www.algerietelecom.dz/assets/front/img/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
  <link rel="stylesheet" href="./assets/stylesheet/ground.css">
  <link rel="stylesheet" href="./assets/stylesheet/login.css">
  
  <style>
    body {
      font-family: "Oswald", "Helvetica Neue";
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #preloader {
      position: fixed;
      left: 0;
      top: 0;
      z-index: 999999;
      width: 100%;
      height: 100%;
      overflow: visible;
      background: #f5f5f5 url('https://pcsupport.lenovo.com/esv4/images/loading.gif') no-repeat center center;
    }
    .error
    {
      color: orange;
    }
  </style>
  <script src='../../js/jquery.js'></script>
  <script>
    jQuery(document).ready(function ($) {
      'use strict';
      $(window).load(function () {
        $('#preloader').fadeOut('slow', function () {
          $(this).remove();
        });
      });
    });
  </script>
</head>

<body >
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
  <div class="template">
    
    <!-- partial:index.partial.html -->
    <div id="particles-js"></div> 
    
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-lg-1">
  
          </div>
          <div class="col-sm-12 col-lg-4 d-flex justify-content-center align-items-center">
               <svg  id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 58.58"><defs><style>.cls-1{fill:#ffe}.cls-1,.cls-2,.cls-3{fill-rule:evenodd}.cls-2{fill:#eee}.cls-3{fill:#ffe}</style></defs><title>logo</title><path class="cls-1" d="M49.18 51.5v-2.2h1.69c0 .52.05 1 .12 1.57v.26l2.41.07a1.15 1.15 0 0 0-.06.32zm36.56.05c0-.65-.06-1.28-.09-1.92h-1.78a1.29 1.29 0 0 1 .06-.33h5.34v.31h-1.72c0 .61-.07 1.23-.09 1.87-.58.02-1.15.04-1.72.07zm4.44-.08v-2.18h4.31v.31h-2.44a.18.18 0 0 0-.12.09v.48c.84 0 1-.09 2.62-.23a2.12 2.12 0 0 0-.12.4c-.81.08-1.63.2-2.45.3v.47c.84 0 1.69.07 2.57.11a1.08 1.08 0 0 0-.15.31c-1.4-.03-2.84-.06-4.22-.06zm5.58.03v-2.23h1.65c0 .62.06 1.24.09 1.88l2.48.06a1 1 0 0 0-.15.31c-1.36-.02-2.72-.02-4.07-.02zm5.13 0c0-.74-.06-1.47-.06-2.2h4.37v.22h-2.56v.62l.39-.06c.72-.07 1.45-.14 2.17-.18v.31c-.81.08-1.63.18-2.41.28 0 .18-.06.35-.09.53l2.44.07h.06v.3h-2.26zm5.51-.22c0-.59-.06-1.19-.06-1.76a3.48 3.48 0 0 1 1.11-.25h3.12l.66.13a2 2 0 0 0-.06.44l-1.6.13a1.83 1.83 0 0 1-.06-.37h-1.29v1.52h1.29a.88.88 0 0 1 0-.31c.57-.07 1.18-.14 1.78-.18 0 .23-.06.45-.09.69-.85.23-3.89.44-4.8-.04zm-52.16-.02c0-.6 0-1.19.06-1.76a2.49 2.49 0 0 1 1.09-.23h3c.57.07.57.07.78.18v.4l-1.72.2v-.44h-1.33a5.23 5.23 0 0 0 0 1.52h1.24a2.07 2.07 0 0 1 0-.42 7.28 7.28 0 0 0-.75 0 .92.92 0 0 1 .06-.3c2-.2 2.11-.28 2.57-.28 0 .46-.06.92-.06 1.41-1.18-.07-3.91.16-4.94-.28zm6.58-1.99h4.1c0 .11.06.23.09.33l-2.48.07a2.74 2.74 0 0 0-.06.48c.75 0 .88-.09 2.54-.23a1.23 1.23 0 0 0-.07.36c-.82.08-1.66.19-2.47.3v.46a.55.55 0 0 0 .06.11h2.48v.26h-4.32c0-.75-.06-1.48-.06-2.21zm15.12 0H80l.09.33-2.47.07a2.16 2.16 0 0 0-.06.48c.75 0 .87-.09 2.53-.23a1.31 1.31 0 0 0-.06.36c-.81.08-1.66.19-2.47.3v.46a.33.33 0 0 0 .06.11h2.47v.26h-4.32c0-.75-.06-1.48-.06-2.21zm-9.72 0v2.23c-.09-2.23-.09-2.23 0-2.23zm6.34 0v2.23a9.11 9.11 0 0 1 0-2.23zm0 2.23v-2.23h1.72v2.23zm1.72 0v-2.23a9.11 9.11 0 0 1 0 2.23zm44.85-.03v-2c.09-.12.09-.12.79-.23h2.71a3.2 3.2 0 0 0 1 0h2.78l.79.18v2h-1.7c-.06-.61-.08-1.24-.12-1.85h-1.3c0 .6-.06 1.21-.06 1.83h-1.72v-1.83H121c-.06 0-.06 0-.12 1.85z"/><path class="cls-1" d="M51 51.1h.09l2.32.07z"/><path class="cls-1" d="M53.4 51.17l-2.32-.07c2.38 0 2.38 0 2.35.07zm2.72-1.54v1.52a5.23 5.23 0 0 1 0-1.52zm33.15-.03v-.31h-5.34l5.43-.06c0 .37 0 .37-.09.37zm-46.43-.11v2h-.12v-2zm1.69 2a5.58 5.58 0 0 1 .12-.77 4.06 4.06 0 0 1 1.27 0 7.55 7.55 0 0 0 0 .84h1.87c0-.69-.06-1.37-.06-2-.21 0-.42-.09-.6-.11h-3.56a1.37 1.37 0 0 0-.69.2v2c.5-.18 1.12-.18 1.65-.18zm1.29-1.32a3.29 3.29 0 0 1 .12-.53h-1.35v.66zm1.27-.82c0-.07 0-.07-3.56 0 1.19-.06 2.36-.03 3.56-.01zm19.13 2.15v-2.2h4.22a1.45 1.45 0 0 1 .67.18c0 .29.06.6.08.9-1.14.11-1.14.11-1.2.18l1.72.88a6.36 6.36 0 0 1-1.87 0A5.44 5.44 0 0 0 68 50.7c-.06.24-.12.51-.18.77-.51 0-1.06 0-1.6.03zm3-1.32c0-.2.05-.37.09-.55H68v.64c.39-.05.79-.07 1.21-.09zm1.23-.89h-4.22zm43.25 2.18h3.11v.11h-3.11zm3.11 0a1.87 1.87 0 0 0 .84-.22v-1.76l-.75-.2h-3.46c-.22 0-.76.09-.76.31 0 .56 0 1.1.06 1.67a2.1 2.1 0 0 0 1 .2zm-2.32-1.85v1.5h1.24c0-.51 0-1 .06-1.52zm2.41-.33c-3.46-.06-3.46-.06-3.46 0z"/><path class="cls-2" d="M60.52 41.41c0 .59.06 1.21.12 1.83a.59.59 0 0 1 .18 0h7C66.65 42.07 64 41.94 62.3 42c.45-.37.9-.75 1.35-1.1a10.72 10.72 0 0 1 5.82 1.61l1.27.79h1.81c0-.44 0-.86.06-1.28 0-1.08 0-2.16.06-3.24.61-.13 1.21-.27 1.81-.38v6.26H60.6c-.06 1.1-.36 3-2.62 2.65a7.4 7.4 0 0 1-1.06-1.06c.64-.06 1.45 0 1.75-.53v-4.06c.94-.1 1.06-.19 1.85-.25zm63.68 5.17c0-.22 0-.22.42-.64l.57-.06a5.59 5.59 0 0 1 .12-.67 4.53 4.53 0 0 1 1.6-.15c.21.17.43.37.64.57-.39 0-.78.09-1.18.16.54 0 1.08.11 1.63.17l-.63.57c-1.05.01-2.11.03-3.17.05z"/><path class="cls-2" d="M64.32 46.32a10.35 10.35 0 0 1 .06-1h1.9v1zm-19.64-.57c0-4 0-4 .06-4-.02 1.31-.06 2.65-.06 4zm10.71-7.37v6.26c0 .07 0 .07-1.82.07 0-2 .06-4 .09-6 .58-.1 1.16-.21 1.73-.33zm69.96 6.28v-5.9c.61-.13 1.21-.27 1.82-.38v6.28zm-49.06-4.1v-1.85l1.78-.33v4.27c0 .81-.06 1.32-.06 2h-1.78zm5.62 2.72c0 .06 6.46.06 6.46 0 0-.49.06-1 .08-1.43l1.73-.33v2.76a1.39 1.39 0 0 0-.06.37h-9.2c-1.15-.51-.91-1.23-.91-2.16.54-.13 1.12-.27 1.69-.37.09.34.15.74.21 1.16zm10.38-1.15v-3.37c.6-.13 1.21-.27 1.8-.38v3.46c1.08.47 1.08.55 2.14 0 0-1 .09-2.08.15-3.11.57-.13 1.18-.24 1.78-.35v3.75c-.36.18-.7.38-1 .58a5.5 5.5 0 0 0 1 .59c0 .44 0 .88.06 1.35h-5.97v-1.33a8 8 0 0 0 1-.61zm-36.9 2.51v-6.26h.12v6.26z"/><path class="cls-2" d="M51.77 41.56a10.83 10.83 0 0 0-1.72.26c-.06.47-.1.93-.12 1.39h-3.3c-.05-.62-.11-1.21-.14-1.81a8.62 8.62 0 0 0-1.75.31c0 1.32-.06 2.67-.06 4a2.56 2.56 0 0 1-1.78.49l1 1.12c2.74-.22 2.11-1 2.74-2.64h5.13zm48.51.73v-3.52a9.85 9.85 0 0 1 1.81-.33v4.91h2.41v-.11a.91.91 0 0 1 .06-.29c.46-.11.91-.2 1.39-.29a4.52 4.52 0 0 0 .15.62h.72c3.35-1.81 9.08-4.19 10.95 0v.11h3.83v-1.5c.57-.11 1.15-.22 1.75-.31 0 .42.06.84.09 1.25 0 .62-.06 1.23-.06 1.87h-17.14c-.73-.44-.75-.38-1.51 0-1.39 0-3.68.37-4.46-.59.04-.66.01-1.25.01-1.82zm15.63.95c-.7-2.05-4.67-.64-6.16-.09a.22.22 0 0 0 0 .13c2.05-.02 4.1-.05 6.16-.05zM83 41.69v-1.13h1.88c0 .38 0 .75.06 1.13zm2.5 0c0-.4 0-.77.06-1.14h1.87v1.08l-1.93.06zm-38.41-.55c-.06-.06-.06-.06.42-.67h.61c0-.84.42-.95 1.54-1 .27.22.54.44.84.66-1 .14-1 .14-1.18.22.51 0 1.05 0 1.59.09-.21.22-.39.44-.57.67-1.07.01-2.15.01-3.25.03zm11.47-.24v-1.11h2v1.11zm60-.09v-1.1h2v1.11zm2.44 0v-1.1h2v1.11z"/><path class="cls-3" d="M4.92 49.48v-3.74h3.71v3.75z"/><path class="cls-1" d="M32 40.32a25 25 0 0 1-5.31-1.7c-7.57-4-13.64-9-19.7-14 .33.08 3.53 1.72 6.12 3a5.93 5.93 0 0 0 2.32.64c0-1-1.12-2.19-1.6-3.14-.36-2 .24-2.72 2.47-3.94 7.79-2.7 17.38-2.31 23.93-6.52.39-.33.78-.66 1.21-1a8.21 8.21 0 0 0 2-3.14.68.68 0 0 1 .21-.22 47.3 47.3 0 0 1 12.98 18.2.43.43 0 0 0-.06.17 39.48 39.48 0 0 0-10.17 3.86c-.09.12-.88.54-3.65 2.52-2.44 1.94-2.44 1.94-5 3.82A10.17 10.17 0 0 1 32 40.32z"/><path class="cls-2" d="M53.1 53.09c-1.78.59-3 .81-3.14.89a26 26 0 0 1-8.83-1l-3.23-1.24c-12.7-5.92-21.69-15-30-23.38q-2.08-2.26-4.17-4.5c-.15-.29-.36-.52-.15-.79a11.52 11.52 0 0 1 2.2.73c0-.38-.84-.91-1.18-1.2-.12-.22-.24-.41-.36-.6a13.35 13.35 0 0 0 3 .4 5.19 5.19 0 0 1-.06-.7C5.53 19.24 2.9 17 .46 14.8-.15 16.2 0 18 0 19.46c.06.89.12 1.8.21 2.71a42.08 42.08 0 0 0 5.46 14.9c.12.17.24.34.36.54a.74.74 0 0 0 .15.24V38c.81 0 1.63 0 2.44.08v3.3h.21a7.29 7.29 0 0 0 .6 1 5.69 5.69 0 0 0 .4.48c6.17 6.89 14.66 14.21 27.7 15.72h4.37a19.57 19.57 0 0 0 11.37-4.9c.27-.36.57-.7.87-1-.35.1-.71.26-1.04.41zM34.39 13.13h-2.71C22.39 12.77 13.34 11 4.14 10.3H1.75C4 5.57 7.46 2.06 14.82.26c11.83-1.51 21.11 3.88 28.06 9.4-.01 2.56-5.44 3.34-8.49 3.47z"/><path class="cls-3" d="M4.92 41.78V38h1.27c.81 0 1.63 0 2.44.08v3.7z"/></svg>
          </div>
          <div class="col-sm-12 col-lg-2">
  
          </div>
          <div class="col-sm-12 col-lg-4 d-flex justify-content-center align-items-center">
            <form action="savePassword.php" method="POST" class="password-strength form p-4 bg-light text-dark">
            
            
              <h3 class="form__title text-center mb-4" style="color: #183969;">Modifier mot de passe <i class="fas fa-edit"></i></h3>
             
              <div class="form-group">
                <label for="password-input">Mot de passe:</label>
                <div class="input-group">
                  <input class="password-strength__input form-control" type="password" name="password1"
                    id="password-input" aria-describedby="passwordHelp" placeholder="Entrer le mot de passe" required />
                    
                  <div class="input-group-append">
                    <button class="password-strength__visibility btn btn-outline-secondary" type="button">

                      <span class="password-strength__visibility-icon" data-visible="hidden">
                        <i class="fas fa-eye-slash"></i>
                      </span>

                      <span class="password-strength__visibility-icon js-hidden" data-visible="visible">
                        <i class="fas fa-eye"></i>
                      </span>
                    
                    </button>
                  </div>

                </div><small class="password-strength__error text-danger js-hidden">Ce symbole n'est pas
                  autorisé!</small><small class="form-text text-muted mt-2" id="passwordHelp">Ajoutez 9 caractères ou
                  plus, des lettres minuscules, des lettres majuscules, des chiffres et des symboles pour rendre le mot
                  de passe vraiment fort!</small>
              </div>
              <div class="password-strength__bar-block progress mb-4">
                <div class="password-strength__bar progress-bar bg-danger" role="progressbar" aria-valuenow="0"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="form-group">
                <label for="password-input">confirmer mot de passe:</label>
                <div class="input-group">
                  <input class="password-strength__input form-control password" type="password" name="password2"
                    id="password-input" aria-describedby="passwordHelp" placeholder="Entrer le mot de passe" required />
                    
                  <div class="input-group-append">
                    <button class="password-strength__visibility_2 btn btn-outline-secondary" type="button">

                      <span class="password-strength__visibility-icon_2" data-visible="hidden">
                        <i class="fas fa-eye-slash"></i>
                      </span>

                      <span class="password-strength__visibility-icon_2 js-hidden" data-visible="visible">
                        <i class="fas fa-eye"></i>
                      </span>
                    
                    </button>
                  </div>

                </div>
              </div>
                <div class="form-group">
                  <label class="submit__control">
                    <label>Combien vaux: </label><br>
                    <div class="submit__generated">
                
                    </div>
                    <i class="fas fa-sync"></i>
                  </label>
                </div>
                <?php include('../../../server/error.php'); ?>
              <button id="shit" class="password-strength__submit d-flex m-auto button"
                 type="submit" name="PASSWORD" value="<?php echo $clientID; ?>" disabled="disabled">Continuer
              </button>
            </form>

          </div>
  <!--PEN CONTENT     -->
          </div>
        </div>
      </div>
      
  </div>
  
  <script src="./assets/script/save.js"></script>
  <script src='https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js'></script>
  <script src="./assets/script/ground.js"></script>
  <script>
    function allLetter(inputtxt) {
      var letters = /^[A-Za-z0-9]+$/;
      if (inputtxt.value.match(letters)) {
        return true;
      } else {
        alert("Only letters and numbers are allowed");
        return false;
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script type="text/javascript">
   $('.menu-item').tooltip()
 </script>
 

</body>

</html>

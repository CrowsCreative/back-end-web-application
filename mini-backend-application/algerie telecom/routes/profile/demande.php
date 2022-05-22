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
    unset($_SESSION['ERROR']);
	}
  ?>
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
  <link href="./assets/stylesheet/app.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="./assets/stylesheet/style.css">
  
  <title>Espace Client - Account</title>
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
      <a href="../../index.html" class="menu-item fa fa-home" data-toggle="tooltip" data-placement="right" title="Page d'accueil"></a>
      <a href="./purchase.php" class="menu-item fa fa-search" data-toggle="tooltip" data-placement="right" title="Page d'achat"></a>
      <a href="./profile.php" class="menu-item fa fa-id-card" data-toggle="tooltip" data-placement="right" title="Espace Client"></a>
      <a href="demande.php?logout='1'" class="menu-item fa fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Déconnexion"></a>
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
      <div class="card o-d-none border-0 shadow my-5 ">
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
                <a id="item-nav-active" href="./demande.php" class="menu-item no-decoration text-center"><span id="nav-text">Demande en
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
                  <a id="item-sm-nav-active" href="./demande.php" class="menu-item no-decoration text-center "><span id="nav-text">Demande
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
              <hr>
              <p>Bienvenu dans l’espace dédié aux demandes en ligne.</p>
              <br>
              <p>Que vous soyez Particulier, Professionnel ou revendeur déposez votre demande de ligne fixe ou de connexion Internet en remplissant le formulaire.</p>
              <br>  
              <p>Votre demande sera prise en charge dans les meilleurs délais et nous reviendrons vers vous après une étude de faisabilité et de disponibilité.</p>
              <hr>
              <br>
          </div>
          <div class="col-lg-8 text-secondary shadow rounded bg-white">
            <form action="send.php" method="POST" id="formdemande">
            <div id="div_non">
                <div id="block_type_client" class="form-group row d-flex  align-items-baseline">
                    <label for="type_client" class="col-sm-3 col-md-3 required">Type de Client<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <select name="type_client" id="type_client" class="form-control" onchange="changertypeclient()">
                                <option value="">---Choisir---</option>
                                <option value="Particulier">Particulier</option>
                                <option value="Professionnel">Professionnel</option>
                                <option value="Revendeur">Revendeur</option>
                        </select>
                        <span class="text-danger" ></span>
                    </div>
                </div>                									
                <div id="block_nature" class="form-group row d-flex  align-items-baseline">
                    <label for="nature" class="col-sm-3 col-md-3 required">Nature de la demande<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <select name="nature" id="nature" class="form-control">
                                <option value="">---Choisir---</option>
                        </select>
                        <span class="text-danger" ></span>
                    </div>
               </div>                									
               <div id="block_affirmation" class="form-group row d-none">
                    <label for="affirmation" class="col-sm-3 col-md-3 required">Possédez-vous une ligne fixe?</label>
                    <div class="col-sm-9 col-md-6" >
                        <div class="col-sm-6 col-md-6">
                            <label>Oui</label>
                            <input type="radio" name="affirmation" id="affirmation" value="oui" onclick="changerAffirmationOui()" />
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <label>Non</label>
                            <input type="radio" name="affirmation" id="affirmation" value="non" onclick="changerAffirmationNon()" />
                        </div>
                        <span class="text-danger" ></span>
                    </div>
               </div> 
             <div id="div_affirmation_non" class=" d-none d-none">
                <p>Vous devez au préalable disposer d’une ligne fixe.</p>
                <p>Effectuez votre demande en sélectionnant "Demande de ligne fixe" dans le champ nature de la demande. <b>Aussi vous pouvez choisir notre offre de connexion sans fil "<a href="particuliers/idoom-4g-lte-prod7">Idoom 4G LTE</a>" (Internet avec Voix)</b></p>
             </div>
             <div id="div_affirmation_oui" class="">				   
                <div id="block_raison_s" class="form-group row d-none">
                    <label for="raison_s" class="col-sm-3 col-md-3 required">Raison Sociale<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control" id="raison_s" name="raison_s" placeholder="Ex : Nom de l’entreprise">
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_numero_fixe" class="form-group row d-none">
                    <label for="numero_fixe" class="col-sm-3 col-md-3 required">Numéro de ligne Fixe<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control" id="numero_fixe" name="numero_fixe">
                        <span class="text-danger" ></span>
                    </div>
                </div>
               <div id="block_genre" class="form-group row d-flex  align-items-baseline">
                    <label for="genre" class="col-sm-3 col-md-3 required">Genre<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <select name="genre" id="genre" class="form-control">
                                <option  value="Monsieur">Monsieur</option>
                                <option value="Madame">Madame</option>  
                                <option value="Mademoiselle">Mademoiselle</option>
                        </select>
                        <span class="text-danger" ></span>
                    </div>
                </div> 
                                    <div id="block_nom" class="form-group row d-flex  align-items-baseline">
                    <label for="nom" class="col-sm-3 col-md-3 required">Nom<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="EN LETTRES MAJUSCULES">
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_prenom" class="form-group row d-flex  align-items-baseline">
                    <label for="prenom" class="col-sm-3 col-md-3 required">Prénom<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control"  id="prenom" name="prenom">
                        <span class="text-danger" ></span>
                    </div>
                </div>					
                
                                    <!--Suite à une demande de LOUNIS -->
                 <div id="block_date_nais" class="form-group row d-flex  align-items-baseline">
                    <label for="date_nais" class="col-sm-3 col-md-3 required">Date de naissance<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="date" class="form-control" id="date_nais" name="date_nais">
                        <span class="text-danger" ></span>
                    </div>
                </div>				
                
                 <div id="block_wilayaoui" class="form-group row d-flex  align-items-baseline">
                    <label for="wilayaoui" class="col-sm-3 col-md-3 required">Wilaya<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                       <!-- <input type="d-none" id="wilaya_name" name="wilaya_name"> -->
                        <select name="wilayaoui" id="wilayaoui" class="form-control" onchange="changerwilayaoui()">
                            <option value="" >---Choisir---</option>
                             
                                <option value="Adrar" >Adrar</option>
                             
                                <option value="Chlef" >Chlef</option>
                             
                                <option value="Laghouat" >Laghouat</option>
                             
                                <option value="OumElBouaghi" >OumElBouaghi</option>
                             
                                <option value="Batna" >Batna</option>
                             
                                <option value="AlgerCentre" >AlgerCentre</option>
                             
                                <option value="Bejaia" >Bejaia</option>
                             
                                <option value="Blida" >Blida</option>
                             
                                <option value="Bouira" >Bouira</option>
                             
                                <option value="Tebessa" >Tebessa</option>
                             
                                <option value="Tlemcen" >Tlemcen</option>
                             
                                <option value="Tiaret" >Tiaret</option>
                             
                                <option value="Biskra" >Biskra</option>
                             
                                <option value="Bechar" >Bechar</option>
                             
                                <option value="Tamanrasset" >Tamanrasset</option>
                             
                                <option value="TiziOuzou" >TiziOuzou</option>
                             
                                <option value="Djelfa" >Djelfa</option>
                             
                                <option value="Jijel" >Jijel</option>
                             
                                <option value="Setif" >Setif</option>
                             
                                <option value="Saida" >Saida</option>
                             
                                <option value="Skikda" >Skikda</option>
                             
                                <option value="SidiBelAbbes" >SidiBelAbbes</option>
                             
                                <option value="Annaba" >Annaba</option>
                             
                                <option value="Guelma" >Guelma</option>
                             
                                <option value="Constantine" >Constantine</option>
                             
                                <option value="Medea" >Medea</option>
                             
                                <option value="Mostaganem" >Mostaganem</option>
                             
                                <option value="Msila" >Msila</option>
                             
                                <option value="Mascara" >Mascara</option>
                             
                                <option value="Ouargla" >Ouargla</option>
                             
                                <option value="Oran" >Oran</option>
                             
                                <option value="ElBayadh" >ElBayadh</option>
                             
                                <option value="Illizi" >Illizi</option>
                             
                                <option value="BordjBouArreridj" >BordjBouArreridj</option>
                             
                                <option value="Boumerdes" >Boumerdes</option>
                             
                                <option value="ElTarf" >ElTarf</option>
                             
                                <option value="Tindouf" >Tindouf</option>
                             
                                <option value="Tissemsilt" >Tissemsilt</option>
                             
                                <option value="ElOued" >ElOued</option>
                             
                                <option value="Khenchela" >Khenchela</option>
                             
                                <option value="SoukAhras" >SoukAhras</option>
                             
                                <option value="Tipaza" >Tipaza</option>
                             
                                <option value="Mila" >Mila</option>
                             
                                <option value="AinDefla" >AinDefla</option>
                             
                                <option value="Naama" >Naama</option>
                             
                                <option value="AinTemouchent" >AinTemouchent</option>
                             
                                <option value="Ghardaia" >Ghardaia</option>
                             
                                <option value="Relizane" >Relizane</option>
                             
                                <option value="AlgerEst" >AlgerEst</option>
                             
                                <option value="AlgerOuest" >AlgerOuest</option>
                             
                        </select>
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_commune" class="form-group row d-flex  align-items-baseline" ></div>
                
                 <div id="block_adresse" class="form-group row d-flex  align-items-baseline">
                    <label for="adresse" class="col-sm-3 col-md-3 required">Adresse<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-8">
                        <textarea id="adresse" name="adresse" class="form-control" rows="7"></textarea>
                        <span class="text-danger" ></span>
                    </div>
                </div>
                
                <div id="block_mobile" class="form-group row d-flex  align-items-baseline">
                    <label for="mobile" class="col-sm-3 col-md-3 required">Mobile<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control"  id="mobile" name="mobile">
                        <span class="text-danger" ></span>
                    </div>
                </div>                    
                <div id="block_email" class="form-group row d-flex  align-items-baseline">
                    <label for="email" class="col-sm-3 col-md-3 required">Email<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-8" >
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="text-danger" ></span>
                    </div>
                </div>
               
                <div id="block_type_piece" class="form-group row d-flex  align-items-baseline">
                    <label for="type_piece" class="col-sm-3 col-md-3 required">Type de pièce d'identité<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <select name="type_piece" id="type_piece" class="form-control">
                                <option value="Carte" >Carte Nationale d'identité</option>
                                <option value="Permis de conduire">Permis de conduire</option>
                        </select>
                        <span class="text-danger" ></span>
                    </div>
                </div>                   
                <div id="block_num_piece" class="form-group row d-flex  align-items-baseline">
                    <label for="num_piece" class="col-sm-3 col-md-3 required">Numéro de pièce d'identité<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-8" >
                        <input type="text" class="form-control" id="num_piece" name="num_piece">
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_emetteur_piece" class="form-group row d-flex  align-items-baseline">
                    <label for="emetteur_piece" class="col-sm-3 col-md-3 required">Emetteur de la pièce d'identité<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        
                        <select name="emetteur_piece" id="emetteur_piece" class="form-control">
                           <option  value="APC">APC</option>
                           <!--<option value="Wilaya">Wilaya</option>-->
                           <option value="Daira">Daira</option>
                           <!--<option value="Centre National de Registre de Commerce">Centre National de Registre de Commerce</option>-->
                        </select>
                        <span class="text-danger" ></span>
                    </div>
                </div>                   
                <div id="block_date_piece" class="form-group row d-flex  align-items-baseline">
                    <label for="date_piece" class="col-sm-3 col-md-3 required">Date d'emission de la pièce d'identité<span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="date" class="form-control" id="date_piece" name="date_piece">
                        <span class="text-danger" ></span>
                    </div>
                </div>
            </div>
            </div>

            <!-- div pour la réponse oui-->
            <div id="div_oui" class="d-none">
                <div id="block_num_demande" class="form-group row d-flex  align-items-baseline">
                    <label for="num_demande" class="col-sm-3 col-md-3 required">Numéro Client <span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control"   id="num_demande" name="num_demande">
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_mobile" class="form-group row d-flex  align-items-baseline">
                    <label for="mobile1" class="col-sm-3 col-md-3 required">Mobile <span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="text" class="form-control"  id="mobile1" name="mobile1">
                        <span class="text-danger" ></span>
                    </div>
                </div>                    
                <div id="block_email" class="form-group row d-flex  align-items-baseline">
                    <label for="email1" class="col-sm-3 col-md-3 required">Email <span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-8" >
                        <input type="email" class="form-control" id="email1" name="email1">
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_adresse1" class="form-group row d-flex  align-items-baseline">
                    <label for="adresse1" class="col-sm-3 col-md-3 required">Adresse <span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-8">
                        <textarea id="adresse1" name="adresse1" class="form-control" rows="7"></textarea>
                        <span class="text-danger" ></span>
                    </div>
                </div>
                <div id="block_0" class="form-group row d-flex  align-items-baseline">
                    <label for="wilaya" class="col-sm-3 col-md-3 required">Wilaya <span style="color: rgb(252, 39, 1);">*</span></label>
                    <div class="col-sm-9 col-md-6" >
                        <input type="d-none" id="wilaya_name" name="wilaya_name">
                        <select name="wilayanon" id="wilayanon" class="form-control" onchange="changerwilayanon()">
                            <option value="" ></option>
                             
                                <option value="Adrar" >Adrar</option>
                             
                                <option value="Chlef" >Chlef</option>
                             
                                <option value="Laghouat" >Laghouat</option>
                             
                                <option value="OumElBouaghi" >OumElBouaghi</option>
                             
                                <option value="Batna" >Batna</option>
                             
                                <option value="AlgerCentre" >AlgerCentre</option>
                             
                                <option value="Bejaia" >Bejaia</option>
                             
                                <option value="Blida" >Blida</option>
                             
                                <option value="Bouira" >Bouira</option>
                             
                                <option value="Tebessa" >Tebessa</option>
                             
                                <option value="Tlemcen" >Tlemcen</option>
                             
                                <option value="Tiaret" >Tiaret</option>
                             
                                <option value="Biskra" >Biskra</option>
                             
                                <option value="Bechar" >Bechar</option>
                             
                                <option value="Tamanrasset" >Tamanrasset</option>
                             
                                <option value="TiziOuzou" >TiziOuzou</option>
                             
                                <option value="Djelfa" >Djelfa</option>
                             
                                <option value="Jijel" >Jijel</option>
                             
                                <option value="Setif" >Setif</option>
                             
                                <option value="Saida" >Saida</option>
                             
                                <option value="Skikda" >Skikda</option>
                             
                                <option value="SidiBelAbbes" >SidiBelAbbes</option>
                             
                                <option value="Annaba" >Annaba</option>
                             
                                <option value="Guelma" >Guelma</option>
                             
                                <option value="Constantine" >Constantine</option>
                             
                                <option value="Medea" >Medea</option>
                             
                                <option value="Mostaganem" >Mostaganem</option>
                             
                                <option value="Msila" >Msila</option>
                             
                                <option value="Mascara" >Mascara</option>
                             
                                <option value="Ouargla" >Ouargla</option>
                             
                                <option value="Oran" >Oran</option>
                             
                                <option value="ElBayadh" >ElBayadh</option>
                             
                                <option value="Illizi" >Illizi</option>
                             
                                <option value="BordjBouArreridj" >BordjBouArreridj</option>
                             
                                <option value="Boumerdes" >Boumerdes</option>
                             
                                <option value="ElTarf" >ElTarf</option>
                             
                                <option value="Tindouf" >Tindouf</option>
                             
                                <option value="Tissemsilt" >Tissemsilt</option>
                             
                                <option value="ElOued" >ElOued</option>
                             
                                <option value="Khenchela" >Khenchela</option>
                             
                                <option value="SoukAhras" >SoukAhras</option>
                             
                                <option value="Tipaza" >Tipaza</option>
                             
                                <option value="Mila" >Mila</option>
                             
                                <option value="AinDefla" >AinDefla</option>
                             
                                <option value="Naama" >Naama</option>
                             
                                <option value="AinTemouchent" >AinTemouchent</option>
                             
                                <option value="Ghardaia" >Ghardaia</option>
                             
                                <option value="Relizane" >Relizane</option>
                             
                                <option value="AlgerEst" >AlgerEst</option>
                             
                                <option value="AlgerOuest" >AlgerOuest</option>
                             
                        </select>
                        <span class="text-danger" ></span>
                    </div>
                </div>
                
            </div>
                <div class="form-group row my-5">
                    <label class="control-label col-sm-3 col-md-2"></label>
                    <div class="col-sm-9 col-md-8">
                        <button style="padding: 0.5em 1.2em;">Envoyer<img  id="loader" src="https://www.algerietelecom.dz/assets/front/img/loader.gif" style="display:none;margin:0 10px;height:20px"/>
                        </button>
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

  <script src='https://npmcdn.com/react@15.3.0/dist/react.min.js'></script>
  <script src='https://npmcdn.com/react-dom@15.3.0/dist/react-dom.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment-with-locales.min.js'></script>
  <script src="./assets/script/script.js"></script>
  <script type="text/javascript">
   $('.menu-item').tooltip()
 </script>
</body>

</html>

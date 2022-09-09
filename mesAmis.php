<?php

 session_start();

 $idUtilisateur = $_SESSION[idUtilisateur];

 $monPrenom = $_SESSION[prenom];

 // Pour afficher la liste des amis :

 // Connexion à la base :
 $link2 = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

 mysqli_select_db($link2,"base_club_cinema") or die ("Impossible de selectionner la base");

 // -1 Sélectionner l'ensemble des id ayant reçu une demande d'ajout de la part de l'utilisateur :
 $requeteSQL1 = "SELECT id_destinataire FROM t_amis WHERE `statut_amis`='accepter' AND `id_emetteur`= '$idUtilisateur'";

 $resultSQL1 = mysqli_query($link2,$requeteSQL1) or die ("Echec de la requete SQL1");

 // Booléen pour déclencher une condition si l'utilisateur n'a jamais envoyé de demande d'ajout
 $pasId = false;

 if(!$pasId){
       $zero = 0;
       $tabId1 = explode(" ", $zero);
 }

// Boucle pour récupérer tous les id si l'utilisateur a bien envoyé une ou plusieurs demande d'ajout :
 while($line1 = mysqli_fetch_assoc($resultSQL1)){
    $pasId = true;
    foreach ($line1 as $id){
       $tabId .= $id." ";
       $tabId1 = explode(" ", $tabId);
    }
}


// -2 Sélectionner ensemble des id ayant envoyé une demande d'ajout à l'utilisateur :
$requeteSQL2 = "SELECT id_emetteur FROM t_amis WHERE `statut_amis`='accepter' AND `id_destinataire`= '$idUtilisateur'";

$resultSQL2 = mysqli_query($link2,$requeteSQL2) or die ("Echec de la requete SQL1");

// Booléen pour déclencher une condition si l'utilisateur n'a jamais reçu de demande d'ajout
$pasId2 = false;

if(!$pasId2){
       $zero = 0;
       $tabId3 = explode(" ", $zero);
 }

// Boucle pour récupérer tous les id si l'utilisateur a bien reçu une ou plusieurs demande d'ajout :
while($line2 = mysqli_fetch_assoc($resultSQL2)){
   $pasId2 = true;
   foreach ($line2 as $id){
     $tabId2 .= $id." ";
     $tabId3 = explode(" ", $tabId2);
   }
}

// -3 Fusion des tableaux des id destinataire et des id emetteurs dans un seul tableau
$tabId4 = array_merge($tabId1,$tabId3);

 ?>
 <!doctype html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Mon profil</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500&family=Nunito:wght@300;400&display=swap" rel="stylesheet">

     <link href="styles/bootstrap.min.css" rel="stylesheet">

      <!-- Favicons -->
     <link rel="apple-touch-icon" href="logo/camera.png" sizes="180x180">
     <link rel="icon" href="logo/camera.png" sizes="32x32" type="image/png">

     <style>
       .bd-placeholder-img {
         font-size: 1.125rem;
         text-anchor: middle;
         -webkit-user-select: none;
         -moz-user-select: none;
         user-select: none;
       }

       @media (min-width: 768px) {
         .bd-placeholder-img-lg {
           font-size: 3.5rem;
         }
       }

       .b-example-divider {
         height: 3rem;
         background-color: rgba(0, 0, 0, .1);
         border: solid rgba(0, 0, 0, .15);
         border-width: 1px 0;
         box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
       }

       .b-example-vr {
         flex-shrink: 0;
         width: 1.5rem;
         height: 100vh;
       }

       .bi {
         vertical-align: -.125em;
         fill: currentColor;
       }

       .nav-scroller {
         position: relative;
         z-index: 2;
         height: 2.75rem;
         overflow-y: hidden;
       }

       .nav-scroller .nav {
         display: flex;
         flex-wrap: nowrap;
         padding-bottom: 1rem;
         margin-top: -1px;
         overflow-x: auto;
         text-align: center;
         white-space: nowrap;
         -webkit-overflow-scrolling: touch;
       }

       ul{
         list-style:none;
       }
     </style>

     <!-- Custom styles for this template -->
     <link href="styles/offcanvas-mesAmis.css" rel="stylesheet">
     </head>

     <body>

       <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

         <div class="container-fluid">
           <img src="logo/popcorn.png" width="40">
           <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
           </button>

           <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">

               <?php

                   $voirProfil=false;

                   if(isset($_GET[voirProfil]) && !empty($_GET[voirProfil])){

                     $voirProfil=true;
                     header ("Location: http://localhost:8888/app_cine/pageAccueilCC.php");
                   }

                   if (!$voirProfil){
                        echo "<form class=\"monProfil\" action=\"pageAccueilCC.php\" method=\"get\">";
                        echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"voirProfil\" value=\"MES POSTS\">";
                        echo "</form>";
                   }

                ?>
               </li>
             </ul>
           </div>
         </div>
       </nav>

        <main class="container">

          <div class="row">

            <div class="col-lg-3">

              <div class="my-3 p-3 bg-body rounded shadow-sm">

                <h3>Mes ami-e-s :</h3>

                 <?php

                      // Booléen pour lancer une condition si l'utilisateur n'a jamais ni envoyé ni reçu de demande d'ajout d'amis
                      $zeroAmi = false;

                      echo "<table>";

                      // -4 Boucle pour récupérer les logins correspondants de chacun des id utilisateurs amis
                     foreach($tabId4 as $id){

                        $requeteSQL5 = "SELECT login_utilisateur FROM t_utilisateur WHERE `id_utilisateur`='$id'";

                        $resultSQL5 = mysqli_query($link2,$requeteSQL5) or die ("Echec de la requete SQL5");

                          // On affiche la liste des logins correspondants sous la forme d'input radio
                          while ($line5 = mysqli_fetch_assoc($resultSQL5)){
                            $zeroAmi = true;
                            echo "<form action=\"suppressionAmi.php\" method=\"post\">";
                            echo "<tr><td><input type=\"hidden\" name=\"supAmi\" value=\"$id\"><a class=\"lienAmi\" href =\"http://localhost:8888/app_cine/pageAmi.php?idAmi=$id\">$line5[login_utilisateur]</a></td>";
                            echo "<td colspan=\"2\"></td><td><button class=\"btn btn-light\" type=\"submit\"><img src=\"logo/trash.png\" title=\"supprimer\" width=\"20\"></button></td>";
                            echo "</form>";
                          }
                        }

                        echo "</table>";


                      if(!$zeroAmi){
                        echo "<p><em>Vous n'avez pas encore d'amis.</em></p>";
                      }


                      mysqli_free_result($resultatSQL5);
                      mysqli_close($link2);
                  ?>
                </div>
              </div>

              <div class="col-lg-5">

                 <div class="my-3 p-3 bg-body rounded shadow-sm">

                   <h6 class="pb-2 mb-0 border-bottom fw-bold">Recherchez un(e) ami(e) :</h6>

                   <br>
                   <form action="mesAmis.php" method="post">
                     <label for="loginAmi">Indiquez son login :
                     <input type="text" id="loginAmi" name="loginAmi">
                     <button class="btn btn-light" type="submit" name="rechercherAmi"><img src="logo/loupe.png" title="supprimer" width="25"></button>
                   </form>
                   <br>

                   <?php

                     if(isset($_POST[loginAmi]) && !empty($_POST[loginAmi])){

                       $logAmi = $_POST[loginAmi];

                       $link = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

                       mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

                       $requeteSQL = "SELECT id_utilisateur, prenom_utilisateur, login_utilisateur FROM t_utilisateur WHERE `login_utilisateur`='$logAmi'";

                       $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la recherche d'un ami");

                       echo "<form action=\"traitMesAmis.php\" method=\"post\">";

                       $zeroLogin = false;

                       while($line = mysqli_fetch_assoc($resultSQL)){

                         $idDestinataire=$line[id_utilisateur];
                         $_SESSION[idDestinataire]=$idDestinataire;

                         $rechercheSQL = "SELECT id_amis FROM t_amis WHERE id_emetteur='$idDestinataire' AND id_destinataire = '$idUtilisateur'";

                         $resultatSQL = mysqli_query($link,$rechercheSQL) or die ("Echec de la requete");

                         $rechercheSQL2 = "SELECT id_amis FROM t_amis WHERE id_emetteur='$idUtilisateur' AND id_destinataire = '$idDestinataire'";

                         $resultatSQL2 = mysqli_query($link,$rechercheSQL2) or die ("Echec de la requete");

                         if($amiTouve = mysqli_fetch_assoc($resultatSQL)){

                           $zeroLogin = true;

                           echo "<br>";
                           echo "<h6 class=\"pb-2 mb-0 border-bottom fw-bold\">Login correspondant :</h6>";
                           echo "<br>";
                           echo "<ul class=\"text-center\">";
                           echo "<li><a class=\"lienAmi\" href =\"http://localhost:8888/app_cine/pageAmi.php?idAmi=$idDestinataire\">$line[login_utilisateur]</a> $line[prenom_utilisateur] <span class=\"dejaAmi\">Vous êtes amis</span></li>";
                           echo "</ul>";
                           break;

                         }elseif($amiTouve2 = mysqli_fetch_assoc($resultatSQL2)){

                           $zeroLogin = true;

                           echo "<br>";
                           echo "<h6 class=\"pb-2 mb-0 border-bottom fw-bold\">Login correspondant :</h6>";
                           echo "<br>";
                           echo "<ul class=\"text-center\">";
                           echo "<li><a class=\"lienAmi\" href =\"http://localhost:8888/app_cine/pageAmi.php?idAmi=$idDestinataire\">$line[login_utilisateur]</a> $line[prenom_utilisateur] <span class=\"dejaAmi\">Vous êtes amis</span></li>";
                           echo "</ul>";
                           break;

                         }else{

                           $zeroLogin = true;

                           echo "<br>";
                           echo "<h6 class=\"pb-2 mb-0 border-bottom fw-bold\">Login correspondant :</h6>";
                           echo "<br>";
                           echo "<ul class=\"text-center\">";
                           echo "<li><input type=\"hidden\" name=\"log\" value=\"$idDestinataire\"> <a class=\"lienAmi\" href =\"http://localhost:8888/app_cine/pageRechercheAmi.php?idAmi=$idDestinataire\">$line[login_utilisateur]</a> <em>$line[prenom_utilisateur]</em>   <input class=\"btn btn-light btn-block\" type=\"submit\" value=\"Envoyer une demande\"></li>";
                           echo "</ul>";
                           echo "</form>";
                       }

                    }
                    if(!$zeroLogin){
                      echo "<br>";
                      echo "<h6 class=\"pb-2 mb-0 fw-bold text-danger\">Pas de login correspondant.</h6>";
                    }
                  }

                    ?>
                  </div>
                </div>

                <div class="col-lg-4">

                   <div class="my-3 p-3 bg-body rounded shadow-sm">

                    <h3>Demandes en attente :</h3>

                      <?php

                        $link3 = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

                        mysqli_select_db($link3,"base_club_cinema") or die ("Impossible de selectionner la base");

                        // requête pour récupérer les id des demandes en attente :
                        $requeteSQL3 = "SELECT id_emetteur, id_amis FROM t_amis WHERE `statut_amis`='en attente' AND `id_destinataire`= '$idUtilisateur'";

                        $resultSQL3 = mysqli_query($link3,$requeteSQL3) or die ("Echec de la requete SQL3");

                        $zeroDemandeEnAttente = false;

                        echo "<ul class=\"text-center\">";

                        while($line3 = mysqli_fetch_assoc($resultSQL3)){

                          $idEmetteur3 = $line3[id_emetteur];
                          $idamis3 = $line3[id_amis];
                          $_SESSION[idAmis] = $idamis3;

                          // On récupère le login et le prenom des id des utilisateurs ayant fait la demande :
                          $requeteSQL4 = "SELECT login_utilisateur, prenom_utilisateur FROM t_utilisateur WHERE `id_utilisateur`= '$idEmetteur3'";

                          $resultSQL4 = mysqli_query($link3,$requeteSQL4) or die ("Echec de la requete SQL4");

                          //Affichage sous forme d'un formulaire des demandes à accepter ou à refuser :
                          if($line4 = mysqli_fetch_assoc($resultSQL4)){

                            $zeroDemandeEnAttente = true;

                            echo "<br>";
                            echo "<li>";
                            echo "<a class=\"lienAmi\" href=\"http://localhost:8888/app_cine/pageAmi.php?idAmi=$idDestinataire\">$line4[login_utilisateur] <em>$line4[prenom_utilisateur]</em></a> souhaite être votre ami(e) : ";
                            echo "<form action=\"OuiNonAmis.php\" method=\"post\"><input type=\"hidden\" name=\"OuiOuNon\" value=\"accepter\"> <input class=\"btn btn-sm btn-outline-success btn-block\" type=\"submit\" value=\"accepter\"></form> <form action=\"OuiNonAmis.php\" method=\"post\"><input type=\"hidden\" name=\"OuiOuNon\" value=\"refuser\"> <input class=\"btn btn-sm btn-outline-danger btn-block\" type=\"submit\" value=\"refuser\"></form>";
                            echo "</li>";
                          }

                        }

                        if(!$zeroDemandeEnAttente){
                          echo "<p><em>Vous n'avez pas de demande en attente pour le moment.</em></p>";
                        }

                        mysqli_free_result($resultatSQL4);
                        mysqli_close($link3);
                       ?>
                     </div>
                   </div>

       </div>
     </main>

     <script src="styles/bootstrap.bundle.min.js"></script>

     <script src="styles/offcanvas.js"></script>

   </body>
</html>

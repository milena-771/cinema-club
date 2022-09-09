<?php

  session_start();

  $idUtilisateur = $_SESSION[idUtilisateur];

 ?>
 <!doctype html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Mon profil</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&display=swap" rel="stylesheet">

     <!--<link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/offcanvas-navbar/">-->
     <!--<link rel="canonical" href="/bootstrap-5.2.0-beta1-examples/offcanvas-navbar/">-->

     <link href="styles/bootstrap.min.css" rel="stylesheet">
     <!--<link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

      <!-- Favicons
     <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
     <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
     <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
     <link rel="manifest" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/manifest.json">
     <link rel="mask-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
     <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon.ico">
     <meta name="theme-color" content="#712cf9">-->

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

     </style>

    <!-- Custom styles for this template -->
    <link href="styles/offcanvas.css" rel="stylesheet">

    <!-- Favicons -->
   <link rel="apple-touch-icon" href="logo/camera.png" sizes="180x180">
   <link rel="icon" href="logo/camera.png" sizes="32x32" type="image/png">

  </head>

  <body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

      <div class="container-fluid">
        <img src="logo/noyau.png" width="120">
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">

              <?php

              $retourProfil=false;

              if(isset($_GET[retourProfil]) && !empty($_GET[retourProfil])){

                $retourProfil=true;
                header ("Location: http://localhost:8888/app_cine/pageAccueilCC.php");
              }

              if (!$retourProfil){
                   echo "<form class=\"boutonFilm\" action=\"pageAccueilCC.php\" method=\"get\">";
                   echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"retourProfil\" value=\"MES POSTS\">";
                   echo "</form>";
              }

               ?>

            </li>

            <li class="nav-item">

              <?php

                  $deconnexion=false;

                  if(isset($_GET[deconnexion]) && !empty($_GET[deconnexion])){

                    $deconnexion=true;
                    header ("Location: http://localhost:8888/app_cine/deconnexion.php");
                  }

                  if (!$deconnexion){
                       echo "<form class=\"boutonFilm\" action=\"filPosts.php\" method=\"get\">";
                       echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"deconnexion\" value=\"DECONNEXION\">";
                       echo "</form>";
                  }

               ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>



    <main class="container">


          <h1>FIL DES POSTS DE MES AMIS :</h1>


      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!--<h6 class="border-bottom pb-2 mb-0">Publications récentes :</h6>-->

    <?php

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

   // Booléen pour lancer une condition si l'utilisateur n'a jamais ni envoyé ni reçu de demande d'ajout d'amis
   $zeroAmi = false;


   // -4 Boucle pour récupérer les logins correspondants de chacun des id utilisateurs amis
  foreach($tabId4 as $id){
      $idAmis .= " ".$id;
      $tabIdAmis = explode (" ", $idAmis);
      $_SESSION[idTousLesAmis] = $tabIdAmis;

      $requeteSQL5 = "SELECT login_utilisateur FROM t_utilisateur WHERE `id_utilisateur`='$id'";

      $resultSQL5 = mysqli_query($link2,$requeteSQL5) or die ("Echec de la requete SQL5");

      while($line5 = mysqli_fetch_assoc($resultSQL5)){

         $requeteSQL6 = "SELECT titre_post, opinion_post, date_post, id_fiche_film, id_post_film FROM t_post_film WHERE `id_utilisateur`='$id' ORDER BY `date_post` DESC";

         $resultSQL6 = mysqli_query($link2,$requeteSQL6) or die ("Echec de la requete SQL5");

         while($line6 = mysqli_fetch_assoc($resultSQL6)){

           $idPostCom = $line6[id_post_film];

            $zeroAmi = true;
            echo "<p>";
            echo "<span class=\"datePost\"> $line6[date_post] </span><br>";
            echo "<a class=\"lienAmi\" href =\"http://localhost:8888/app_cine/pageAmi.php?idAmi=$id\">$line5[login_utilisateur]</a> a écrit sur <a class=\"lienFilm\" href =\"http://localhost:8888/app_cine/ficheFilm.php?idFicheFilm=$line6[id_fiche_film]\">$line6[titre_post]</a> :";
            echo "<div class=\"textPost\">”$line6[opinion_post]”</div>";

            echo "<br>";

            echo "<form class=\"pb-3 mb-0 small lh-sm border-bottom\" action=\"commentaires.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"idPostCom\" value='$idPostCom'>";
            echo "<button class=\"btn btn-sm btn-light btn-block\" type=\"submit\">voir les commentaires</button>";
            echo "</form>";
            echo "</p>";



           }
         }
      }

   if(!$zeroAmi){
     echo "<p>Vous n'avez pas de posts car vous n'avez pas encore d'amis</p>";
   }

   mysqli_free_result($resultatSQL5);
   mysqli_close($link2);
     ?>
  </div>
</main>

     <!--<script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>-->
      <script src="styles/bootstrap.bundle.min.js"></script>

      <script src="styles/offcanvas.js"></script>

  </body>
 </html>

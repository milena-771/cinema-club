<?php
  session_start();

  $idUtilisateur = $_SESSION[idUtilisateur];

  $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

  mysqli_select_db($link, "base_club_cinema") or die ("Impossible de selectionner la base");

  $requeteSQL = "SELECT date_vu, titre_film, real_film, lieu_cinema, id_fiche_film, id_list_film FROM t_list_film_2022 WHERE id_utilisateur = '$idUtilisateur'";

  $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete");

  if(isset ($_POST[FilmVu]) && !empty ($_POST[FilmVu])){

     $idListFilm = $_POST[FilmVu];
     //$idUtilisateur = $_SESSION[idUtilisateur];

     //echo "id list film : $idListFilm";
     //echo "utilisateur numéro : $idUtilisateur";

     //$link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

     //mysqli_select_db($link, "base_club_cinema") or die ("Impossible de selectionner la base");

     $requeteSQL2 = "DELETE FROM t_list_film_2022 WHERE id_list_film = '$idListFilm' AND id_utilisateur ='$idUtilisateur'";

     $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete");

     header ("Location: http://localhost:8888/app_cine/pageListFilmsVus.php");

 }

 ?>
 <html>
  <head>
    <meta charset="utf-8">
    <title>Ma liste des films vus en 2022</title>
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

    </style>

    <!-- Custom styles for this template -->
    <link href="styles/offcanvas-pageListFilmsVus.css" rel="stylesheet">


  </head>
  <body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

      <div class="container-fluid">
        <img src="logo/chair.png" width="70">
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">

            <?php

            $voirFilPosts=false;

            if(isset($_GET[voirFilPosts]) && !empty($_GET[voirFilPosts])){

              $voirFilPosts=true;
              header ("Location: http://localhost:8888/app_cine/filPosts.php");
            }

            if (!$voirFilPosts){
                 echo "<form class=\"boutonFilm\" action=\"filPosts.php\" method=\"get\">";
                 echo "<input class=\"btn btn-sm btn-dark btn-block\"  type=\"submit\" name=\"voirFilPosts\" value=\"POSTS DE MES AMIS\">";
                 echo "</form>";
            }

             ?>
            </li>

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

            <li class="nav-item">
              <?php
              $boutonAjoutFilm=false;

              if(isset($_GET[AjoutFilm]) && !empty($_GET[AjoutFilm])){

                $boutonAjoutFilm=true;
                header ("Location: http://localhost:8888/app_cine/ajoutPostCC.php");
              }

              if (!$boutonAjoutFilm){
                   echo "<form class=\"boutonFilm\" action=\"pageAccueilCC.php\" method=\"get\">";
                   echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"AjoutFilm\" value=\"AJOUTER POST\">";
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

       <h1>FILMS VUS EN 2022 :</h1>


        <div class="my-3 p-3 bg-body rounded shadow-sm">

    <!--<form action="modifierUnFilmDeLaListe.php" method="post">-->

            <?php

                  $zeroFilmVu = false;

                   echo "<ol>";
                   while ($line = mysqli_fetch_assoc($resultSQL)){
                     //$id = $line[id_list_film];
                     $zeroFilmVu = true;

                     echo "<form action=\"pageListFilmsVus.php\" method=\"post\">";
                     echo "<div class=\"row\">";
                     echo "<div class=\"col-8\">";
                     echo "<li><input type=\"hidden\" name=\"FilmVu\" value=\"$line[id_list_film]\"><span class=\"dateVisionnage\">$line[date_vu]</span> - <a class=\"lienFilm\" href =\"http://localhost:8888/app_cine/ficheFilm.php?idFicheFilm=$line[id_fiche_film]\">$line[titre_film]</a> réalisé par <strong>$line[real_film]</strong> ($line[lieu_cinema])";
                     echo "</div>";
                     echo "<div class=\"col-2\">";
                     echo "<button class=\"btn btn-light\" type=\"submit\"><img src=\"logo/trash.png\" width=\"20\"></button></li>";
                     echo "</div>";
                     echo "</div>";
                     echo " </form>";
                  }
                  echo "</ol>";

                  if(!$zeroFilmVu){
                    echo "Vous n'avez pas ajouté de films à votre liste.";
                  }


             ?>

           </div>
         </main>

         <script src="styles/bootstrap.bundle.min.js"></script>

         <script src="styles/offcanvas.js"></script>

  </body>
 </html>

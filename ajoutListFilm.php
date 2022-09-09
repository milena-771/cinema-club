<?php

session_start();

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un nouveau post</title>
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
    <link href="styles/offcanvas-ajoutPostCC.css" rel="stylesheet">
  </head>
  <body>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

          <div class="container-fluid">
            <a class="navbar-brand" href="pageAccueilCC.php"><img src="logo/typewriter2.png" width="70"></a>
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
                     echo "<form class=\"boutonFilm\" action=\"ajoutPostCC.php\" method=\"get\">";
                     echo "<input class=\"btn btn-sm btn-dark btn-block\"  type=\"submit\" name=\"voirFilPosts\" value=\"POSTS DE MES AMIS\">";
                     echo "</form>";
                }

                 ?>
                </li>

                <li class="nav-item">

                  <?php
                      $retourProfil=false;

                      if(isset($_GET[retourProfil]) && !empty($_GET[retourProfil])){

                        $retourProfil=true;
                        header ("Location: http://localhost:8888/app_cine/pageAccueilCC.php");
                      }

                      if (!$retourProfil){
                           echo "<form class=\"boutonFilm\" action=\"ajoutPostCC.php\" method=\"get\">";
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


          <h1>MES FILMS VUS EN 2022 :</h1>


          <div class="my-3 p-3 bg-body rounded shadow-sm">

              <?php


                  $titreFilm = $_SESSION[titreFilm];
                  $realFilm = $_SESSION[real_film];
                  $dateVu = date('Y-m-d');
                  $monCinema = $_SESSION[monCinema];
                  $idFicheFilm = $_SESSION[idFicheFilm];
                  $idPostFilm = $_SESSION[idPostFilm];
                  $idUtilisateur = $_SESSION[idUtilisateur];

                  $valeurs = "'$dateVu', '$titreFilm', '$realFilm', '$monCinema', '$idFicheFilm','$idUtilisateur', '$idPostFilm'";

                  $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

                  mysqli_select_db($link, "base_club_cinema") or die ("Impossible de selectionner la base");

                  $requeteSQL = "SELECT id_list_film FROM t_list_film_2022 WHERE `id_fiche_film` = '$idFicheFilm' AND `id_utilisateur`= '$idUtilisateur'";

                  $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete pour verifier si film vu ou pas");

                  if($line = mysqli_fetch_assoc($resultSQL)){

                    echo "<div class=\"text-center fw-bold text-danger\">Vous avez déjà vu ce film en 2022, allez consulter votre liste.</div>";

                  }else {

                    $requeteSQL2 = "INSERT INTO `base_club_cinema`.`t_list_film_2022`(`date_vu`, `titre_film`, `real_film`, `lieu_cinema`,`id_fiche_film`, `id_utilisateur`,`id_post_film`) VALUES ($valeurs)";

                    $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete pour ajouter film a la liste");

                    $idListFilm = mysqli_insert_id($link);

                    $_SESSION[id_list_film] = $idListFilm;

                    //header ("Location: http://localhost:8888/app_cine/pageListFilmsVus.php");

                    $requeteSQL3 = "SELECT date_vu, titre_film, real_film, lieu_cinema, id_fiche_film, id_list_film FROM t_list_film_2022 WHERE id_utilisateur = '$idUtilisateur'";

                    $resultSQL3 = mysqli_query($link, $requeteSQL3) or die ("Echec de la requete");

                    echo "<ol class=\"lh-lg\">";
                    while ($line3 = mysqli_fetch_assoc($resultSQL3)){
                      //$id = $line3[id_list_film];
                      echo "<li><span class=\"dateVisionnage\">$line3[date_vu]</span> - <span class=\"titreFilm\">$line3[titre_film]</span> réalisé par <strong>$line3[real_film]</strong> ($line3[lieu_cinema])</li>";
                    }
                    echo "</ol>";
                   }

              ?>

          </div>
      </main>

      <script src="styles/bootstrap.bundle.min.js"></script>

      <script src="styles/offcanvas.js"></script>
   </body>
 </html>

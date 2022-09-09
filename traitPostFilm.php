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


          <h1>AJOUTEZ UN NOUVEAU POST :</h1>


          <div class="my-3 p-3 bg-body rounded shadow-sm">

              <?php

                  if (isset($_POST[monCinema]) && isset($_POST[critique]) && /*!empty($_POST[monCinema]) &&*/ !empty($_POST[critique])){

                    $link = mysqli_connect("localhost","root","root") or die ("Impossible de se connecter");

                    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

                    $titreFilm = $_SESSION[titreFilm];
                    $monCinema = mysqli_real_escape_string($link, $_POST[monCinema]);
                    $maCritique = mysqli_real_escape_string($link, $_POST[critique]);

                    date_default_timezone_set('Europe/Paris');
                    $datePost = date('Y-m-d');

                    $idFicheFilm = $_SESSION[idFicheFilm];
                    $idUtilisateur = $_SESSION[idUtilisateur];

                    $valeurs = "'$titreFilm','$maCritique', '$monCinema', '$datePost','$idUtilisateur','$idFicheFilm'";

                    $requeteSQL = "INSERT INTO `base_club_cinema`.`t_post_film` (`titre_post`, `opinion_post`, `lieu_cinema`, `date_post`,`id_utilisateur`,`id_fiche_film`) VALUES ($valeurs)";

                    $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete");

                    $idPostFilm = mysqli_insert_id($link);

                    $_SESSION[idPostFilm] = $idPostFilm;
                    $_SESSION[monCinema] = $monCinema;

                    echo "<div class=\"border-bottom text-center fw-bold\">Votre post a bien été publié !</div>";
                    echo "<br>";
                  }
               ?>

    <br>
    <p> Souhaitez-vous ajouter <span class="titreFilm"><?php echo $_SESSION[titreFilm]; ?></span> à votre liste de films vus en 2022 ?</p>
    <form action="ajoutListFilm.php" method="post">
      <button class="btn btn-light" type="submit">Ajouter</button>
    </form>

  </div>
</main>

<script src="styles/bootstrap.bundle.min.js"></script>

<script src="styles/offcanvas.js"></script>

  </body>
 </html>

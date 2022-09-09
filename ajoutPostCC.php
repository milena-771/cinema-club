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

      .noPost{
        display:flex;
      }

      .noPost input[type="submit"]{
        color:#6c757d;
      }

      .noPost input[type="submit"]:hover{
        background-color: rgba(0,0,0,0.7);
        color:#f5f5f5;
        font-weight:bold;
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="styles/offcanvas-ajoutPostCC.css" rel="stylesheet">
  </head>
  <body>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

          <div class="container-fluid">
            <img src="logo/typewriter2.png" width="90">
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


          <h1>AJOUTER UN NOUVEAU POST :</h1>


          <div class="my-3 p-3 bg-body rounded shadow-sm">

            <h6 class="pb-2 mb-0 fw-bold">Recherchez le dernier film que vous avez vu :</h6>


              <form action="ajoutPostCC.php" method="post">

                <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="titre" id="floatingInputGrid" placeholder="Les Temps Modernes">
                        <label for="floatingInputGrid">Titre du film</label>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="real" id="floatingInputGrid" placeholder="Prenom Nom">
                      <label for="floatingInputGrid">Prénom Nom du/de la cinéaste :</label>
                    </div>
                  </div>
                  <button class="btn btn-light" type="submit">RECHERCHER</button>

              </form>
              <br>
            </div>



          <?php
                if (isset($_POST['titre']) && isset($_POST['real'])&& !empty($_POST['titre']) && !empty($_POST['real'])) {

                  $unTitre = $_POST['titre'];
                  $nomReal = $_POST['real'];

                  $link = mysqli_connect ("localhost", "root", "root") or die ("Impossible de se connecter");

                  mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

                  $requeteSQL = "SELECT titre_film, real_film, id_fiche_film FROM t_fiche_film WHERE `titre_film`='$unTitre' and `real_film`='$nomReal'";

                  $resultSQL = mysqli_query($link,$requeteSQL) or die ("Le film n'est pas dans la base");

                  if ($line = mysqli_fetch_assoc($resultSQL)){

                    $leFilm = $line[titre_film];
                    $idFicheFilm = $line[id_fiche_film];

                    //$_SESSION[idFicheFilm] = $idFicheFilm;
                    //$_SESSION[titre] = $leFilm;

                    //header ("Location: http://localhost:8888/app_cine/postFilm.php");
                    //$idFicheFilm = $_SESSION[idFicheFilm];

                    $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

                    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

                    $requeteSQL = "SELECT titre_film, real_film, scenariste_film, operateur_film, interprete_principal, interprete_secondaire, compositeur_film, genre_film, date_sortie, affiche_film FROM t_fiche_film WHERE `id_fiche_film`='$idFicheFilm'";

                    $resultSQL = mysqli_query($link,$requeteSQL) or die ("Echec de la requete");

                    $line = mysqli_fetch_assoc($resultSQL);

                    echo "<h1> $line[titre_film] </h1>";
                    echo "<br>";
                    echo "<ul class=\"lh-lg\">";
                      echo "<div class=\"row g-2\">";

                        echo "<div class=\"col-md text-center\">";
                          echo "<img src='$line[affiche_film]' class=\"rounded\" width=\"70%\"/>";
                        echo "</div>";

                        echo "<br>";

                        echo "<div class=\"col-md\">";
                            echo "<br>";
                            echo "<li> <span class=\"fw-bold\">Cinéaste : </span>$line[real_film]</li>";
                            echo "<li> <span class=\"fw-bold\">Scénariste : </span>$line[scenariste_film]</li>";
                            echo "<li> <span class=\"fw-bold\">Chef opérateur/-trice : </span>$line[operateur_film]</li>";
                            echo "<li> <span class=\"fw-bold\">Interprète principal(e) : </span>$line[interprete_principal]</li>";
                            echo "<li> <span class=\"fw-bold\">Interprète secondaire : </span>$line[interprete_secondaire]</li>";
                            echo "<li> <span class=\"fw-bold\">Compositeur : </span>$line[compositeur_film]</li>";
                            echo "<li> <span class=\"fw-bold\">Genre : </span>$line[genre_film]</li>";
                            echo "<li> <span class=\"fw-bold\">Date de sortie: </span>$line[date_sortie]</li>";
                        echo "</div>";
                        echo "<br>";

                      echo "</div>";


                    echo "</ul>";

                    $_SESSION[real_film] = $line[real_film];
                    $_SESSION[titreFilm] = $line[titre_film];
                    $_SESSION[idFicheFilm]= $idFicheFilm;

                    echo "<h6 class=\"pb-3 mb-0 border-bottom fw-bold\">Rédigez votre post :</h6>";

                    echo "<br>";

                    echo "<form action=\"traitPostFilm.php\" method=\"post\">";
                      echo "<div class=\"mb-3\">";
                        echo "<label for=\"colForCinema\" class=\"form-label\">Cinéma/plateforme de visionnage : </label>";
                        echo "<input type=\"text\" name=\"monCinema\" class=\"form-control\" id=\"colForCinema\" placeholder=\"Nom du cinéma, ville/plateforme\" pattern=\"[A-Za-z\s,éèëêàçù‘]\">";
                       echo "</div>";

                       echo "<div class=\"mb-3\">";
                          echo "<label for=\"critique\" class=\"form-label\"> Partagez votre impression sur le film : </label>";
                          echo "<br>";
                          echo "<textarea class=\"form-control\" name=\"critique\" id=\"critique\" placeholder=\"Qu'en avez-vous pensé ?\" style=\"height:200px\"></textarea>";
                       echo "</div>";

                       echo "<button class=\"btn btn-light\" type=\"submit\">PUBLIER MON POST</button>";

                    echo "</form>";

                    echo "<br>";

                    echo "<form action=\"traitPostFilm2.php\" method=\"get\">";
                       echo "<div class=\"noPost\">";
                       echo "<input class=\"btn btn-light\" type=\"submit\" name=\"AjouterList\" value=\"AJOUTER À MA LISTE SANS POST\">";
                       echo "</div>";
                    echo "</form>";

                  }else{
                    //header ("Location: http://localhost:8888/app_cine/creerFicheFilm.php");
                    echo "<h1></h1>";

                    echo "<div class=\"border-bottom text-center fw-bold text-danger\">Le film n'est pas dans la base, il faut d'abord créer une fiche film</div>";
                    echo "<br>";

                    echo "<br>";
                    echo "<form enctype =\"multipart/form-data\" action=\"traitCreerFicheFilm.php\" method=\"post\">";

                    echo "<div class=\"row mb-3\">";
                      echo "<label for=\"titre\" class=\"col-sm-2 col-form-label\"> Titre :</label>";
                      echo "<div class=\"col-sm-10\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"titreFilm\" id=\"titre\" placeholder=\"ET L EXTRATERRESTRE\" minlength=\"1\" maxlength=\"100\" pattern=\"[A-Z\s]+\" required>";
                      echo "</div>";
                    echo "</div>";

                    echo "<div class=\"row mb-3\">";
                      echo "<label for=\"real\" class=\"col-sm-2 col-form-label\"> Cinéaste :</label>";
                      echo "<div class=\"col-sm-10\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"real\" id=\"real\" placeholder=\"STEVEN SPIELBERG\" pattern=\"[A-Z]+\s{1}[A-Z\s]+\" required>";
                      echo "</div>";
                    echo "</div>";

                    echo "<div class=\"row mb-3\">";
                        echo "<label for=\"scenariste\" class=\"col-sm-2 col-form-label\"> Scénariste :</label>";
                        echo "<div class=\"col-sm-4\">";
                          echo "<input type=\"text\" class=\"form-control\" name=\"scenariste\" id=\"scenariste\" placeholder=\"MELISSA MATHISON\" pattern=\"[A-Z]+\s{1}[A-Z\s]+\" required>";
                        echo "</div>";
                        echo "<label class=\"col-sm-2 col-form-label\" for=\"chefOp\"> Opérateur(-trice) :</label>";
                        echo "<div class=\"col-sm-4\">";
                          echo "<input type=\"text\" class=\"form-control\" name=\"chefOp\" id=\"chefOp\" placeholder=\"ALLEN DAVIAU\" pattern=\"[A-Z]+\s{1}[A-Z\s]+\" required>";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class=\"row mb-3\">";
                      echo "<label for=\"acteurPrincipal\" class=\"col-sm-2 col-form-label\"> Interprète principal :</label>";
                      echo "<div class=\"col-sm-4\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"acteurPrincipal\" id=\"acteurPrincipal\" placeholder=\"HENRY THOMAS\" pattern=\"[A-Z]+\s{1}[A-Z\s]+\" required>";
                      echo "</div>";
                      echo "<label class=\"col-sm-2 col-form-label\" for=\"acteurSecond\"> Second rôle :</label>";
                      echo "<div class=\"col-sm-4\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"acteurSecond\" id=\"acteurSecond\" placeholder=\"ROBERT MACNAUGHTON\" pattern=\"[A-Z]+\s{1}[A-Z\s]+\" required>";
                      echo "</div>";
                    echo "</div>";

                    echo "<div class=\"row mb-3\">";
                      echo "<label for=\"compositeur\" class=\"col-sm-2 col-form-label\"> Compositeur :</label>";
                      echo "<div class=\"col-sm-10\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"compositeur\" id=\"compositeur\" placeholder=\"JOHN WILLIAMS\" pattern=\"[A-Z]+\s{1}[A-Z\s]+\" required>";
                      echo "</div>";
                    echo "</div>";

                    echo "<div class=\"row mb-3\">";
                        echo "<label class=\"col-sm-2 col-form-label\" for=\"genre\"> Genre :</label>";
                        echo "<div class=\"col-sm-4\">";
                          echo "<select class=\"form-select\" name=\"genre\">";
                            echo "<option value=\"comédie\">comédie</option>";
                            echo "<option value=\"thriller\">thriller</option>";
                            echo "<option value=\"film d'animation\">film d'animation</option>";
                            echo "<option value=\"documentaire\">documentaire</option>";
                            echo "<option value=\"épouvante\">épouvante</option>";
                            echo "<option value=\"action\">action</option>";
                            echo "<option value=\"comédie romantique\">comédie romantique</option>";
                            echo "<option value=\"western\">western</option>";
                            echo "<option value=\"road movie\">road movie</option>";
                            echo "<option value=\"super héros\">super héros</option>";
                            echo "<option value=\"science-fiction\" selected>science-fiction</option>";
                            echo "<option value=\"film catastrophe\">film catastrophe</option>";
                            echo "<option value=\"film fantastique\">film fantastique</option>";
                            echo "<option value=\"film independant\">film independant</option>";
                         echo "</select>";
                       echo "</div>";
                      echo "<label class=\"col-sm-2 col-form-label\" for=\"dateSortie\">Date sortie :</label>";
                      echo "<div class=\"col-sm-4\">";
                        echo "<input class=\"form-control\" type=\"date\" name=\"dateSortie\" id=\"dateSortie\" placeholder=\"1982-05-26\" min=\"1895-01-01\">";
                      echo "</div>";
                    echo "</div>";

                    echo "<div class=\"row mb-3\">";
                      echo "<label class=\"col-sm-2 col-form-label\" for=\"afficheFilm\"> Affiche du film  :</label>";
                      echo "<div class=\"col-sm-5\">";
                        echo "<input class=\"form-control\" type=\"file\" name=\"afficheFilm\" id=\"afficheFilm\">";
                      echo "</div>";
                    echo "</div>";

                    echo "<button class=\"btn btn-light\" type=\"submit\">CRÉER</button>";
                    echo "</form>";
                  }


                }


           ?>

        </div>
      </main>

      <script src="styles/bootstrap.bundle.min.js"></script>

      <script src="styles/offcanvas.js"></script>

  </body>
</html>

<?php

  session_start();

  //echo "Compte de $_SESSION[prenom] <br>";

  //echo "L'identifiant du film est : $_SESSION[idFicheFilm]<br>";
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
      <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/offcanvas-navbar/">


      <link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

       <!-- Favicons -->
      <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
      <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
      <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
      <link rel="manifest" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/manifest.json">
      <link rel="mask-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
      <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon.ico">
      <meta name="theme-color" content="#712cf9">

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
    <link href="styles/offcanvas-postFilm.css" rel="stylesheet">
    </head>
    <body>
          <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

            <div class="container-fluid">
              <a class="navbar-brand" href="pageAccueilCC.php"><img src="logo/typewriter.png" width="70"></a>
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

                  $idFicheFilm = $_SESSION[idFicheFilm];

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

                  /*echo "<h3> $line[titre_film] </h3>";
                  echo "<ul>";
                  echo "<img src='$line[affiche_film]' width='20%';/>";
                  echo "<li> Cinéaste : $line[real_film]</li>";
                  echo "<li> Scénariste : $line[scenariste_film]</li>";
                  echo "<li> Chef opérateur/-trice : $line[operateur_film]</li>";
                  echo "<li> Interprète principal(e) : $line[interprete_principal]</li>";
                  echo "<li> Interprète secondaire : $line[interprete_secondaire]</li>";
                  echo "<li> Compositeur : $line[compositeur_film]</li>";
                  echo "<li> Genre : $line[genre_film]</li>";
                  echo "<li> Date de sortie: $line[date_sortie]</li>";
                  echo "</ul>";*/

                  $_SESSION[real_film] = $line[real_film];
                  $_SESSION[titreFilm] = $line[titre_film];
                  //$_SESSION[idFicheFilm]= $idFicheFilm;

              ?>

              <h6 class="pb-3 mb-0 border-bottom fw-bold">Rédigez votre post :</h6>

              <form action="traitPostFilm.php" method="post">

                <div class="mb-3">
                  <label for="monCinema" class="form-label">Cinéma/Plateforme de visionnage : </label>
                  <input type="text" class="form-control" name="monCinema" id="monCinema" placeholder="Nom du cinéma, (ville)/plateforme">
                </div>

                <div class="mb-3">
                  <label for="critique" class="form-label"> Partagez votre impression sur le film : </label>
                  <br>
                  <textarea name="critique" id="critique" class="form-control" style="height:200px" placeholder="Qu'en avez-vous pensé ?"></textarea>
               </div>

                <button class="btn btn-light" type="submit">PUBLIER MON POST</button>
              </form>

              <form action="traitPostFilm2.php" method="get">
                 <button class="btn btn-dark" type="submit" name="AjouterList">Ajouter à ma liste sans post</button>
              </form>

    </div>
  </main>

   <script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

   <script src="styles/offcanvas.js"></script>

</body>
</html>

<?php

  session_start();

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
    </style>

    <!-- Custom styles for this template -->
    <link href="styles/offcanvasProfil.css" rel="stylesheet">
    </head>

    <body>

      <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

        <div class="container-fluid">
          <img src="logo/clap2.png" width="85">
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
                   echo "<form class=\"boutonFilm\" action=\"PageAccueilCC.php\" method=\"get\">";
                   echo "<input class=\"btn btn-sm btn-dark btn-block\"  type=\"submit\" name=\"voirFilPosts\" value=\"POSTS DE MES AMIS\">";
                   echo "</form>";
              }

               ?>
              </li>

              <li class="nav-item">

                <?php
                  $boutonListeFilm=false;

                  if(isset($_GET[MesFilmsVus]) && !empty ($_GET[MesFilmsVus])){
                    $boutonListeFilm=true;
                    header ("Location: http://localhost:8888/app_cine/pageListFilmsVus.php");
                  }

                 if (!$boutonListeFilm){
                     echo "<form class=\"boutonFilm\" action=\"pageAccueilCC.php\" method=\"get\">";
                     echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"MesFilmsVus\" value=\"FILMS VUS\">";
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

         <h1>MES POSTS:</h1>

         <div class="row">

           <div class="col-lg-3">

             <div class="my-3 p-3 bg-body text-center rounded shadow-sm">

                   <img src="logo/theCameraman.jpeg" class="rounded" width="90%">

                   <br>

                   <?php

                         echo "<p class=\"pb-3 mb-0 small lh-sm border-bottom\">";
                         echo "<br><span class=\"monPrenom\"> Bienvenue $_SESSION[prenom] !</span><br>";

                         if ($_SESSION[statut] == "admin"){

                            echo "<span class=\"admin\">Vous êtes administratrice</span><br>";
                         }
                         echo"</p>";

                         $mesAmis=false;

                         if(isset($_GET[mesAmis]) && !empty($_GET[mesAmis])){

                           $mesAmis=true;
                           header ("Location: http://localhost:8888/app_cine/mesAmis.php");
                         }

                         if (!$mesAmis){
                              echo "<br>";
                              echo "<form action=\"mesAmis.php\" method=\"get\">";
                              echo "<button class=\"btn btn-sm btn-light btn-block\" type=\"submit\" name=\"mesAmis\">voir mes amis</button>";
                              echo "</form>";
                         }
                    ?>

             </div>
           </div>

          <div class="col-lg-5">

             <div class="my-3 p-3 bg-body rounded shadow-sm">

                    <?php

                        $idUtilisateur = $_SESSION[idUtilisateur];

                        $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");
                        mysqli_select_db($link, "base_club_cinema");

                        $requeteSQL = "SELECT titre_post, opinion_post, date_post, id_post_film FROM t_post_film WHERE `id_utilisateur`='$idUtilisateur' ORDER BY `date_post` DESC";
                        $resultSQL = mysqli_query($link,$requeteSQL) or die ("Echec de la requete");

                        $pasDePost = false;

                        while($line = mysqli_fetch_assoc($resultSQL)){

                          $idPostCom = $line[id_post_film];

                          $pasDePost = true;

                          echo "<p>";
                          echo "<small><span class=\"datePost\">$line[date_post]</span></small><br>";
                          echo "<span class=\"titreFilm\">$line[titre_post]</span><br>";
                          echo "<div class=\"textPost\">”$line[opinion_post]”</div>";

                          echo "<br>";

                          echo "<form class=\"pb-3 mb-0 small lh-sm border-bottom\" action=\"mesCommentaires.php\" method=\"get\">";
                          echo "<input type=\"hidden\" name=\"idPostCom\" value='$idPostCom'>";
                          echo "<button class=\"btn btn-sm btn-light btn-block\" type=\"submit\">voir les commentaires</button>";
                          echo "</form>";
                        }

                        if(!$pasDePost){
                          echo "Vous n'avez pas encore publié de post.";
                        }


                      ?>
              </div>
            </div>


      </main>

       <script src="styles/bootstrap.bundle.min.js"></script>

       <script src="styles/offcanvas.js"></script>

  </body>
</html>

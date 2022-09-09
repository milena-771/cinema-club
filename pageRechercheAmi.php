<?php

session_start();

if(isset($_GET[idAmi]) && !empty($_GET[idAmi])){

  $idDestinataire = $_GET[idAmi];

  $link = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

  mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

  $requeteSQL2 = "SELECT login_utilisateur, prenom_utilisateur FROM t_utilisateur WHERE `id_utilisateur`='$idDestinataire'";

  $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete");

  $line2 = mysqli_fetch_assoc($resultSQL2);


}

 ?>

 <html>
  <head>
    <meta charset="utf-8">
    <title>Page Recherche d'Amis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

      .lienFilm{
        color:SeaGreen;
        text-decoration:none;
        font-weight:bold;

      }

      .lienFilm:hover{
        color:black;
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="styles/offcanvas-rechercheAmi.css" rel="stylesheet">
    </head>

  <body>

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

                    $deconnexion=false;

                    if(isset($_GET[deconnexion]) && !empty($_GET[deconnexion])){

                      $deconnexion=true;
                      header ("Location: http://localhost:8888/app_cine/deconnexion.php");
                    }

                    if (!$deconnexion){
                         echo "<form class=\"boutonFilm\" action=\"deconnexion.php\" method=\"get\">";
                         echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"deconnexion\" value=\"DECONNEXION\">";
                         echo "</form>";
                    }

                 ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>


  <div class="nav-scroller bg-body shadow-sm">
    <nav class="nav" aria-label="Secondary navigation">

      <div class="row">

              <?php

                  echo "<form action=\"traitMesAmis.php\" method=\"post\">";
                  echo "<input type=\"hidden\" name=\"log\" value=\"$idDestinataire\">";
                  echo "bonjour";
                  //echo "$line2[login_utilisateur] <em>$line2[prenom_utilisateur] </em>";
                  //echo "<button class=\"btn btn-sm btn-light\" type=\"submit\">Envoyer une demande</button>";
                  echo "</form>";

               ?>
           </div>

     </nav>
   </div>

     <main class="container">

     <h4> SES POSTS :</h4>

     <div class="row">

       <div class="col-lg-3">

         <div class="my-3 p-3 bg-body text-center rounded shadow-sm">

               <img src="logo/theCameraman.jpeg" class="rounded" width="90%">

               <p class="pb-3 mb-0 small lh-sm border-bottom">
               <br>
               <span class="monPrenom"> <?php echo $line2[login_utilisateur]; ?> </span> <span class="admin"><?php echo $line2[prenom_utilisateur]; ?></span> </em>
               <br>

               <br>
           </div>
         </div>

         <div class="col-lg-6">

            <div class="my-3 p-3 bg-body rounded shadow-sm">

       <?php

         $requeteSQL = "SELECT titre_post, opinion_post, date_post, id_fiche_film FROM t_post_film WHERE `id_utilisateur`='$idDestinataire'";

         $resultSQL = mysqli_query($link,$requeteSQL) or die ("Echec de la requete");

         while ($line = mysqli_fetch_assoc($resultSQL)){

           echo "<small><span class=\"datePost\">$line[date_post]</span></small><br>";
           echo "<a class=\"lienFilm\" href =\"http://localhost:8888/app_cine/ficheFilm.php?idFicheFilm=$line[id_fiche_film]\">$line[titre_post]</a>";
           echo "<br>";
           echo "<br><div class=\"textPost\">”$line[opinion_post]”</div>";

           echo "<p class=\"pb-3 mb-0 small lh-sm border-bottom\"></p>";
         }

    ?>
    </div>
  </main>

    <script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="styles/offcanvas.js"></script>
</body>
</html>

<?php

  session_start();

  if (isset($_GET["idFicheFilm"]) && !empty ($_GET["idFicheFilm"])){

    $idFicheFilm = $_GET["idFicheFilm"];

    $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

    $requeteSQL = "SELECT titre_film, real_film, scenariste_film, operateur_film, interprete_principal, interprete_secondaire, compositeur_film, genre_film, date_sortie, affiche_film FROM t_fiche_film WHERE `id_fiche_film`='$idFicheFilm'";

    $resultSQL = mysqli_query($link,$requeteSQL) or die ("Echec de la requete");

    $line = mysqli_fetch_assoc($resultSQL);
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
         list-style-type:none;
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
                 $boutonListeFilm=false;

                 if(isset($_GET[MesFilmsVus]) && !empty ($_GET[MesFilmsVus])){
                   $boutonListeFilm=true;
                   header ("Location: http://localhost:8888/app_cine/pageListFilmsVus.php");
                 }

                if (!$boutonListeFilm){
                    echo "<form class=\"boutonFilm\" action=\"pageListFilmsVus.php\" method=\"get\">";
                    echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"MesFilmsVus\" value=\"FILMS VUS\">";
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

      <main class="container">

         <div class="my-3 p-3 bg-body rounded shadow-sm">

  <?php

    echo "<h1> $line[titre_film] </h1>";
    echo "<br>";
    echo "<ul class=\"lh-lg\">";
      echo "<div class=\"row g-2\">";

        echo "<div class=\"col-md text-center\">";
          echo "<img src=\"$line[affiche_film]\" class=\"rounded\" width=\"70%\";/>";
        echo "</div>";

        echo "<br>";

        echo "<div class=\"col-md\">";
          echo "<li> <span class=\"fw-bold\">Cinéaste :</span> $line[real_film]</li>";
          echo "<li> <span class=\"fw-bold\">Scénariste :</span> $line[scenariste_film]</li>";
          echo "<li> <span class=\"fw-bold\">Chef opérateur/-trice :</span> $line[operateur_film]</li>";
          echo "<li> <span class=\"fw-bold\">Interprète principal(e) :</span> $line[interprete_principal]</li>";
          echo "<li> <span class=\"fw-bold\">Interprète secondaire :</span> $line[interprete_secondaire]</li>";
          echo "<li> <span class=\"fw-bold\">Compositeur :</span> $line[compositeur_film]</li>";
          echo "<li> <span class=\"fw-bold\">Genre :</span> $line[genre_film]</li>";
          echo "<li> <span class=\"fw-bold\">Date de sortie:</span> $line[date_sortie]</li>";
        echo "</div>";

        echo "<br>";

      echo "</div>";

    echo "</ul>";

    $_SESSION[real_film] = $line[real_film];
    $_SESSION[titreFilm] = $line[titre_film];

  }

?>

  <script src="styles/bootstrap.bundle.min.js"></script>

  <script src="styles/offcanvas.js"></script>

 </body>
</html>

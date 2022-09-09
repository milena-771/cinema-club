<?php

session_start();

if(isset($_GET[idAmi]) && !empty($_GET[idAmi])){

  $idAmi = $_GET[idAmi];

  $link = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

  mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

  $requeteSQL2 = "SELECT login_utilisateur, prenom_utilisateur FROM t_utilisateur WHERE `id_utilisateur`='$idAmi'";

  $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete");

  $line2 = mysqli_fetch_assoc($resultSQL2);

  $logAmi = $line2[login_utilisateur];
  $prenomAmi =$line2[prenom_utilisateur];
}

?>

<html>
 <head>
   <meta charset="utf-8">
   <title>Page Amis</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
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

     .lienFilm{
       color:SeaGreen;
       text-decoration:none;
       font-weight:bold;

     }

     .lienFilm:hover{
       color:black;
     }

     .dateVisionnage{
       color:rgba(0,50,50,0.5);
       font-size:12px;
       font-style:italic;
     }
   </style>

   <!-- Custom styles for this template -->
   <link href="styles/offcanvasProfil.css" rel="stylesheet">
   </head>

   <body>

     <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

       <div class="container-fluid">
         <img src="logo/popcorn.png" width="35">
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

      <main class="container">

      <h1> Page de <?php echo $logAmi; ?> : </h1>

        <div class="row">

          <div class="col-lg-3">

            <div class="my-3 p-3 bg-body text-center rounded shadow-sm">

                  <img src="logo/theCameraman.jpeg" class="rounded" width="90%">

                  <p class="pb-3 mb-0 small lh-sm border-bottom">
                  <br>
                  <span class="monPrenom"> <?php echo $logAmi; ?> </span> <span class="admin"><?php echo $prenomAmi; ?></span> </em>
                  <br>

                  <br>
              </div>
            </div>

             <div class="col-lg-5">

                <div class="my-3 p-3 bg-body rounded shadow-sm">

                  <?php

                  if(isset($_GET[idAmi]) && !empty($_GET[idAmi])){

                   $idAmi = $_GET[idAmi];

                   $link = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

                   mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

                   $requeteSQL = "SELECT titre_post, opinion_post, date_post, id_post_film, id_fiche_film FROM t_post_film WHERE `id_utilisateur`='$idAmi'";

                   $resultSQL = mysqli_query($link,$requeteSQL) or die ("Echec de la requete");

                   while ($line = mysqli_fetch_assoc($resultSQL)){

                     $idPostCom = $line[id_post_film];

                     echo "<p>";
                     echo "<small><span class=\"datePost\">$line[date_post]</span></small><br>";
                     echo "<a class=\"lienFilm\" href =\"http://localhost:8888/app_cine/ficheFilm.php?idFicheFilm=$line[id_fiche_film]\">$line[titre_post]</a>";
                     echo "<div class=\"textPost\">”$line[opinion_post]”</div>";

                     echo "<br>";

                     echo "<form class=\"pb-3 mb-0 small lh-sm border-bottom\" action=\"commentaires.php\" method=\"get\">";
                     echo "<input type=\"hidden\" name=\"idPostCom\" value='$idPostCom'>";
                     echo "<button class=\"btn btn-sm btn-light btn-block\" type=\"submit\">voir les commentaires</button>";
                     echo "</form>";
                   }

                  }
                  ?>
                </div>
              </div>
              <div class="col-lg-4">

                <div class="my-3 p-3 bg-body rounded shadow-sm">

                  <?php

                    if(isset($_GET[idAmi]) && !empty($_GET[idAmi])){

                     $idAmi = $_GET[idAmi];

                     $link2 = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

                     mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

                     $requeteSQL2 = "SELECT date_vu, titre_film,id_fiche_film, id_list_film FROM t_list_film_2022 WHERE id_utilisateur = '$idAmi'";

                     $resultSQL2 = mysqli_query($link, $requeteSQL2) or die ("Echec de la requete");

                     $zeroFilmVu = false;

                     echo "<h6 class=\"pb-2 mb-0 border-bottom\">Liste de ses films vu en 2022 : </h6>";

                     echo "<br>";

                     echo "<ol>";
                     while ($line2 = mysqli_fetch_assoc($resultSQL2)){
                       //$id = $line[id_list_film];

                       $zeroFilmVu = true;

                       echo "<form action=\"pageAmi.php\" method=\"post\">";
                       echo "<div class=\"row\">";
                       echo "<div class=\"col-8\">";
                       echo "<li> <a class=\"lienFilm\" href =\"http://localhost:8888/app_cine/ficheFilm.php?idFicheFilm=$line2[id_fiche_film]\">$line2[titre_film]</a>";
                       echo "</div>";
                       echo "</div>";
                       echo " </form>";
                    }
                    echo "</ol>";

                  }

                    if(!$zeroFilmVu){
                      echo "<em>$logAmi n'a pas encore ajouté de film à sa liste.</em>";
                    }





                   ?>
               </div>
             </div>

            </div>
          </main>

          <script src="styles/bootstrap.bundle.min.js"></script>

          <script src="styles/offcanvas.js"></script>
</body>
</html>

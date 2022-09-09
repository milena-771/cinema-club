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
        flex-wrap:wrap;
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
                     echo "<form class=\"boutonFilm\" action=\"filPosts.php\" method=\"get\">";
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
                           echo "<form class=\"boutonFilm\" action=\"pageAccueilCC.php\" method=\"get\">";
                           echo "<input class=\"btn btn-sm btn-dark btn-block\" type=\"submit\" name=\"retourProfil\" value=\"MES POSTS\">";
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
                           echo "<form class=\"boutonFilm\" action=\"ajoutPostCC.php\" method=\"get\">";
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


          <h1>AJOUTEZ UN NOUVEAU POST :</h1>


          <div class="my-3 p-3 bg-body rounded shadow-sm">

                <?php

                if ( isset($_POST['titreFilm']) && isset($_POST['real']) && isset($_POST['scenariste']) && isset($_POST['chefOp']) && isset($_POST['acteurPrincipal']) && isset($_POST['acteurSecond']) && isset($_POST['compositeur'])
                && isset($_POST['genre']) && isset($_POST['dateSortie']) && !empty($_POST['titreFilm']) && !empty($_POST['real']) && !empty($_POST['scenariste']) && !empty($_POST['chefOp']) && !empty($_POST['acteurPrincipal'])
                && !empty($_POST['acteurSecond']) && !empty($_POST['compositeur'])&& !empty($_POST['genre']) && !empty($_POST['dateSortie'])) {

                  $titre = $_POST['titreFilm'];
                  $cineaste = $_POST['real'];
                  $scenariste = $_POST['scenariste'];
                  $chefOp = $_POST['chefOp'];
                  $actPrinc = $_POST['acteurPrincipal'];
                  $actSecond = $_POST['acteurSecond'];
                  $compositeur = $_POST['compositeur'];
                  $genre = $_POST['genre'];
                  $dateSortie = $_POST['dateSortie'];
                  $idUtilisateur = $_SESSION[idUtilisateur];
                  $afficheFilm = "./affiches/".$_FILES["afficheFilm"]["name"];

                  $tmp_file = $_FILES["afficheFilm"]["tmp_name"];

                  $errImage=0;

                  if(file_exists($afficheFilm)){
                    //exit("L'image existe déjà");
                    $errImage=1;
                  }

                  if( !is_uploaded_file($tmp_file) ){
                    //exit("Le fichier est introuvable");
                    $errImage=1;
                  }

                  $typeImage = $_FILES["afficheFilm"]["type"];
                  if($typeImage != "image/png" && $typeImage != "image/jpeg" && $typeImage != "image/jpg"){
                    //exit("Type fichier : $typeImage n'est pas une image !");
                    $errImage=1;
                  }
                  if (move_uploaded_file($tmp_file, $afficheFilm)) {
                      //print("Fichier enregistre ici: <br/> $afficheFilm cree\n") ;
                      $errImage=0;
                      //print_r($_FILES);
                  } else {
                     $errImage=1;
                         //print "Erreur: <br/>";
                         //print_r($_FILES);
                  }

                  if($errImage==1){
                    $afficheFilm = "Image non supportée";

                  }


                  $valeurs = "'$titre','$cineaste','$scenariste','$chefOp','$actPrinc','$actSecond','$compositeur','$genre','$dateSortie', '$afficheFilm', '$idUtilisateur'";

                  $link = mysqli_connect("localhost","root","root") or die ("Impossible de se connecter");

                  mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

                  $requeteSQLbis = "SELECT * FROM t_fiche_film WHERE `titre_film`='$titre'";

                  $resultSQLbis = mysqli_query($link, $requeteSQLbis) or die ("Echec de la requete pour rechercher le film dans la base");

                  $VasY=0;

                  if(mysqli_fetch_assoc($resultSQLbis)){

                    echo "<div class=\"border-bottom text-center fw-bold text-danger\">Le film est déjà dans la base, vérifier l'orthographe du prénom et du nom du cinéaste !</div>";

                  }else{

                    $requeteSQL = "INSERT INTO `base_club_cinema`.`t_fiche_film` (`titre_film`, `real_film`,`scenariste_film`, `operateur_film`, `interprete_principal`,`interprete_secondaire`,`compositeur_film`, `genre_film`,`date_sortie`, `affiche_film`,`id_utilisateur` ) VALUES ($valeurs)";

                    $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete pour ajouter la fiche film");

                    $idFicheFilm = mysqli_insert_id($link);

                    //header ("Location: http://localhost:8888/app_cine/postFilm.php");

                    //Pour afficher le film dont la fiche vient d'être créée
                    $requeteSQL2 = "SELECT titre_film, real_film, scenariste_film, operateur_film, interprete_principal, interprete_secondaire, compositeur_film, genre_film, date_sortie, affiche_film FROM t_fiche_film WHERE `id_fiche_film`='$idFicheFilm'";

                    $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete");

                    $line = mysqli_fetch_assoc($resultSQL2);

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
                        echo "<input type=\"text\" name=\"monCinema\" class=\"form-control\" id=\"colForCinema\" placeholder=\"Nom du cinéma, ville/plateforme\">";
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

                  }

                  }
                 ?>
         </div>
       </main>

       <script src="styles/bootstrap.bundle.min.js"></script>

       <script src="styles/offcanvas.js"></script>

   </body>
 </html>

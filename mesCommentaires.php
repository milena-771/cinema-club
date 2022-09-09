<?php

  session_start();

  $idUtilisateur = $_SESSION[idUtilisateur];

  if (isset ($_GET[idPostCom]) && !empty($_GET[idPostCom])){

    $idPost = $_GET[idPostCom];

    $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de sélectionner la base");

    //Récupère les infos du post:
    $requeteSQL = "SELECT titre_post, opinion_post, date_post, id_utilisateur, id_fiche_film FROM t_post_film WHERE  `id_post_film`='$idPost'";

    $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete pour récupérer infos du post");

    if($line = mysqli_fetch_assoc($resultSQL)){

      $idlogin = $line[id_utilisateur];

      $requeteSQL2 = "SELECT login_utilisateur FROM t_utilisateur WHERE `id_utilisateur`='$idlogin'";

      $resultSQL2 = mysqli_query($link, $requeteSQL2) or die ("Echec de la requete pour recuperer le login");

      $line2 = mysqli_fetch_assoc($resultSQL2);

    }
    //Récupère les infos de tous les commentaires sous le post
    $requeteSQL3 = "SELECT commentaire_post, date_commentaire, id_utilisateur, id_commentaire, id_post FROM t_commentaires WHERE `id_post`='$_GET[idPostCom]' ORDER BY `date_commentaire` DESC";

    $resultSQL3 = mysqli_query($link, $requeteSQL3) or die ("Echec de la requete pour récupérer les commentaires du post");

  }
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

       .datePost{
         color:rgba(0,50,50,0.5);
         font-size:12px;
         font-style:italic;
       }

       .textPost{
         text-align:center;
         text-indent:50px;
         font-size:17px;
         font-family:'Source Code Pro', monospace;
       }

       .commentaires{
         text-indent:50px;
         font-size:14px;
         font-family:'Source Code Pro', monospace;

       }

       .lienAmi {
         color:SlateBlue;
         text-decoration:none;
         font-weight:bold;
       }

       .lienFilm{
         color:SeaGreen;
         text-decoration:none;
         font-weight:bold;

       }

       [class^="lien"]:hover{
         color:black;
       }

       input[type="submit"]{
         color: #6c757d;
       }

       input[type="submit"]:hover{
         background-color: rgba(10,30,30,0.2);
         color: #6c757d;
         font-weight:bold;
       }

      .poubelle{
         background-color:#ffffff;
         border:none;
       }

       .poubelle:hover{
         border:1px solid #6c757d;
         background-color:#ffffff;
       }

     </style>

     <!-- Custom styles for this template -->
     <link href="styles/offcanvas-commentaires.css" rel="stylesheet">
     </head>

   <body>

     <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

       <div class="container-fluid">
         <img src="logo/clap2.png" width="75">
         <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>

         <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
           <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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

           //Affichage du post

           echo "<div class=\"text-center\"><small><span class=\"datePost\">$line[date_post]</span></small> - Vous avez écrit sur <a class=\"lienFilm\" href =\"http://localhost:8888/app_cine/ficheFilm.php?idFicheFilm=$line[id_fiche_film]\">$line[titre_post]</a> :<br>";
           echo "<br>";
           echo "<span class=\"textPost\">”$line[opinion_post]”</span>";
           echo "</div>";

           echo "<p class=\"pb-3 mb-0 small lh-sm border-bottom\"></p>";

          ?>

          <br>

           <!--Formulaire pour ajouter un commentaire -->
           <form action="ajouterMonCommentaire.php" method="post">
               <div class="form-floating">
                 <input type="hidden" name="idPostCom" value="<?php echo $_GET[idPostCom];?>">
                 <textarea class="form-control" name="monCommentaire" id="floatingCom" style="height:80px"></textarea>
                 <label for="floatingCom">Ajoutez un commentaire</label>
               </div>
               <br>
                 <input class="btn btn-light" type="submit" value="PUBLIER">

           </form>

           <?php

           $zeroCom = false;

           while($line3 = mysqli_fetch_assoc($resultSQL3)){

             $zeroCom = true;

             $idLoginCom = $line3[id_utilisateur];
             $idCom = $line3[id_commentaire];

             //Récupère le logins des auteurs des commentaires
             $requeteSQL4 = "SELECT login_utilisateur FROM t_utilisateur WHERE `id_utilisateur`='$idLoginCom'";

             $resultSQL4 = mysqli_query($link, $requeteSQL4) or die ("Echec de la requete pour récupérer les logins des commentaires");

             $line4 = mysqli_fetch_assoc($resultSQL4);

             echo "<br>";

             //Affichage des commentaires dans un formulaire pour pouvoir les supprimer
             echo"<form action=\"supprimerCom.php\" method=\"post\">";
              echo "<input type=\"hidden\" name=\"supprimerCom\" value=\"$idCom\">";
              echo "<input type=\"hidden\" name=\"idPostCom\" value=\"$_GET[idPostCom]\">";
              echo "<div class=\"pb-3 mb-0 small lh-sm border-bottom\">";
                echo "<small><span class=\"datePost\">$line3[date_commentaire]</span></small> - <span class=\"fw-bold\"> $line4[login_utilisateur]</span> a commenté :<br>";
                echo "<br>";
                echo "<span class=\"commentaires\">”$line3[commentaire_post]”</span> <button type=\"submit\" class=\"poubelle\" class=\"btn btn-light\"><img src=\"logo/trash.png\" width=\"20\"></button>";
              echo "</div>";
             echo "</form>";

           }

           if(!$zeroCom){
             echo "<br>";
             echo "<p class=\"pb-3 mb-0 small lh-sm fw-bold border-bottom\"> Ce post n'a pas encore été commenté.</p>";
           }

           /*if(isset($_POST[supprimerCom]) && !empty($_POST[supprimerCom])) {

             $idCom = $_POST[supprimerCom];

             $idPostCom = $_GET[idPostCom];

             $requeteSQL5 = "DELETE FROM t_commentaires WHERE id_commentaire = '$idCom'";

             $resultSQL5 = mysqli_query($link2, $requeteSQL5) or die ("Echec de la requete pour supprimer le commentaire");

             echo "<p>Commentaire supprimé</p>";

             header ("Location : http://localhost:8888/app_cine/mesCommentaires.php?idPostCom=$idPostCom");

           }*/

           mysqli_free_result($resultSQL3);
           mysqli_close($link);

            ?>

          </div>
        </main>

        <script src="styles/bootstrap.bundle.min.js"></script>

        <script src="styles/offcanvas.js"></script>

   </body>
 </html>

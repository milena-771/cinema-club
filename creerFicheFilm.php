<?php

  session_start();

  echo $_SESSION[prenom];

 ?>

<html>
 <head>
   <meta charset="utf-8">
   <title>Creer une fiche film</title>
 </head>

 <body>
   <h1>Le film n'est pas dans la base, créer une fiche film</h1>

   <form enctype = "multipart/form-data" action="traitCreerFicheFilm.php" method="post">

     <label for="titre"> Titre :</label>
     <input type="text" name="titreFilm" id="titre">
     <br>
     <label for="real"> Cinéaste :</label>
     <input type="text" name="real" id="real">
     <br>
     <label for="scenariste"> Scénariste :</label>
     <input type="text" name="scenariste" id="scenariste">
     <br>
     <label for="chefOp"> Opérateur(-trice) :</label>
     <input type="text" name="chefOp" id="chefOp">
     <br>
     <label for="acteurPrincipal"> Interprète principal :</label>
     <input type="text" name="acteurPrincipal" id="acteurPrincipal">
     <br>
     <label for="acteurSecond"> Interprète secondaire :</label>
     <input type="text" name="acteurSecond" id="acteurSecond">
     <br>
     <label for="compositeur"> Compositeur :</label>
     <input type="text" name="compositeur" id="compositeur">
     <br>
     <label for="genre"> Genre :</label>
     <select class="genre" name="genre">
       <option value="comédie">comédie</option>
       <option value="thriller">thriller</option>
       <option value="film d'animation">film d'animation</option>
       <option value="documentaire">documentaire</option>
       <option value="épouvante">épouvante</option>
       <option value="action">action</option>
       <option value="comédie romantique">comédie romantique</option>
       <option value="western">western</option>
       <option value="road movie">road movie</option>
       <option value="super héros">super héros</option>
       <option value="science-fiction">science-fiction</option>
       <option value="film catastrophe">film catastrophe</option>
       <option value="film fantastique">film fantastique</option>
       <option value="film independant">film independant</option>
     </select>
     <br>
     <label for="dateSortie">Date de sortie :</label>
     <input type="date" name="dateSortie" id="dateSortie">
     <br>
     <label for="afficheFilm"> Ajouter l'affiche du film  :</label>
     <input type="file" name="afficheFilm" id="afficheFilm">
     <br>
     <input type="submit" value="créer">
   </form>

   <?php
   $retourProfil=false;

   if(isset($_GET[retourProfil]) && !empty($_GET[retourProfil])){

     $retourProfil=true;
     header ("Location: http://localhost:8888/app_cine/pageAccueilCC.php");
   }

   if (!$retourProfil){
        echo "<form action=\"creerFicheFilm.php\" method=\"get\">";
        echo "<input type=\"submit\" name=\"retourProfil\" value=\"Retour Profil\">";
        echo "</form>";
   }
    ?>

 </body>
</html>

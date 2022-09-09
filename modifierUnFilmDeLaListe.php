<html>
 <head>
   <meta charset="utf-8">
   <title>Modifier un film de ma liste</title>
 </head>
 <body>
<?php

  session_start();

  if(isset ($_POST[FilmVu]) && !empty ($_POST[FilmVu])){

    $idListFilm = $_POST[FilmVu];
    $idUtilisateur = $_SESSION[idUtilisateur];
    $titreFilm = $_SESSION[titreFilm];
    $realFilm = $_SESSION[real_film];
    $dateVu = date('Y-m-d');
    $monCinema = $_SESSION[monCinema];
    $idFicheFilm = $_SESSION[idFicheFilm];
    $idPostFilm = $_SESSION[idPostFilm];
    $idUtilisateur = $_SESSION[idUtilisateur];

    echo "idListFilm : $idListFilm <br>";
    echo "idUtilisateur : $idUtilisateur <br>";
    echo "titre : $titreFilm <br>";
    echo "réal : $realFilm <br>";
    echo "date visionnage : $dateVu <br>";
    echo "lieu visionnage : $monCinema <br>";
    echo "id Fiche Film : $idFicheFilm<br>";
    echo "id Post Film : $idPostFilm <br>";
    echo " id Utilisateur : $idUtilisateur<br>";

    //echo "id list film : $idListFilm";
    //echo "utilisateur numéro : $idUtilisateur";

    /*$link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de selectionner la base");

    $requeteSQL = "DELETE FROM t_list_film_2022 WHERE id_list_film = '$idListFilm' AND id_utilisateur ='$idUtilisateur'";

    $resultSQL = mysqli_query($link,$requeteSQL) or die ("Echec de la requete");

    echo "Le film a bien été supprimé";*/

}


 ?>


</body>
 </html>

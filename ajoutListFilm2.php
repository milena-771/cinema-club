<?php

session_start();


$titreFilm = $_SESSION[titreFilm];
$realFilm = $_SESSION[real_film];
$dateVu = date('Y-m-d');
$monCinema = $_SESSION[monCinema];
$idFicheFilm = $_SESSION[idFicheFilm];
$idPostFilm = 000;
$idUtilisateur = $_SESSION[idUtilisateur];

$valeurs = "'$dateVu', '$titreFilm', '$realFilm', '$monCinema', '$idFicheFilm','$idUtilisateur', '$idPostFilm'";

$link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

mysqli_select_db($link, "base_club_cinema") or die ("Impossible de selectionner la base");

$requeteSQL = "SELECT id_list_film FROM t_list_film_2022 WHERE `id_fiche_film` = '$idFicheFilm' AND `id_utilisateur`= '$idUtilisateur'";

$resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete pour verifier si film vu ou pas");

if($line = mysqli_fetch_assoc($resultSQL)){

  echo "Vous avez déjà vu ce film en 2022";


}else {

  $requeteSQL2 = "INSERT INTO `base_club_cinema`.`t_list_film_2022`(`date_vu`, `titre_film`, `real_film`, `lieu_cinema`,`id_fiche_film`, `id_utilisateur`,`id_post_film`) VALUES ($valeurs)";

  echo $requeteSQL2;

  $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete pour ajouter film a la liste");

  $idListFilm = mysqli_insert_id($link);

  $_SESSION[id_list_film] = $idListFilm;

  header ("Location: http://localhost:8888/app_cine/pageListFilmsVus.php");

}

?>

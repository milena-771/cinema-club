<?php

session_start();

$idUtilisateur = $_SESSION[idUtilisateur];

if (isset($_POST[idPostCom]) && !empty($_POST[idPostCom]) && isset($_POST[monCommentaire]) && !empty($_POST[monCommentaire])) {

  $link = mysqli_connect("localhost","root","root") or die ("Impossible de se connecter");

  mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

  $idPostCom = $_POST[idPostCom];

  $monCommentaire = mysqli_real_escape_string($link, $_POST[monCommentaire]);

  date_default_timezone_set('Europe/Paris');
  $dateCom = date('Y-m-d');

  $valeurs = "'$monCommentaire', '$dateCom', '$idUtilisateur', '$idPostCom'";

  $requeteSQL = "INSERT INTO `base_club_cinema`.`t_commentaires` (`commentaire_post`, `date_commentaire`, `id_utilisateur`, `id_post`) VALUES ($valeurs)";

  $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete pour ajouter un commentaire");

  header ("Location: http://localhost:8888/app_cine/mesCommentaires.php?idPostCom=$idPostCom");




}

 ?>

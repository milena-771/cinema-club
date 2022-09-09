<?php

 session_start();

 if (isset($_POST[log]) && !empty($_POST[log])){

   $idEmetteur = $_SESSION[idUtilisateur];
   $idDestinataire = $_POST[log];
   $statuts = "en attente";

   $valeurs = "'$idEmetteur', '$idDestinataire', '$statuts'";

   $link = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

   mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

   $requeteSQL = "INSERT INTO `base_club_cinema`.`t_amis` (`id_emetteur`, `id_destinataire`, `statut_amis`) VALUES ($valeurs)";

   echo $requeteSQL;

   $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la demande d'ajout d'ami");

   header ("Location: http://localhost:8888/app_cine/mesAmis.php");
 }

 ?>

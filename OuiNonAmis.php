<?php

  session_start();

  $idAmis = $_SESSION[idAmis];

  if($_POST[OuiOuNon] == "accepter"){

    $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de sélectionner la base");

    $requeteSQL = "UPDATE t_amis SET `statut_amis`='accepter' WHERE `id_amis`='$idAmis'";

    mysqli_query($link, $requeteSQL) or die ("Echec de la requete");

    header ("Location: http://localhost:8888/app_cine/mesAmis.php");

  } elseif ($_POST[OuiOuNon] == "refuser") {

    $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de sélectionner la base");

    $requeteSQL2 = "DELETE FROM t_amis WHERE id_amis = '$idAmis'";

    mysqli_query($link, $requeteSQL2) or die ("Echec de la requete");

    header ("Location: http://localhost:8888/app_cine/mesAmis.php");
 
  }

 ?>

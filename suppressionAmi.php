<?php

session_start();

if(isset($_POST[supAmi]) && !empty($_POST[supAmi])){

  $idAmi = $_POST[supAmi];
  $idUtilisateur = $_SESSION[idUtilisateur];

  $link = mysqli_connect("localhost", "root","root") or die ("Impossible de se connecter");

  mysqli_select_db($link,"base_club_cinema") or die ("Impossible de selectionner la base");

  $requeteSQL1 = "SELECT id_amis FROM t_amis WHERE `id_emetteur`='$idAmi' AND `id_destinataire`= '$idUtilisateur'";

  $resultSQL1 = mysqli_query($link,$requeteSQL1) or die ("Echec de la requete");

  if ($line1 = mysqli_fetch_assoc($resultSQL1)){

    $idAmi1 = $line1[id_amis];

    $requeteSQL2 = "DELETE FROM t_amis WHERE id_amis = '$idAmi1'";

    $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete");

    header ("Location: http://localhost:8888/app_cine/mesAmis.php");
  }else{

    $requeteSQL3 = "SELECT id_amis FROM t_amis WHERE `id_emetteur`='$idUtilisateur' AND `id_destinataire`= '$idAmi'";

    $resultSQL3 = mysqli_query($link,$requeteSQL3) or die ("Echec de la requete");

    if($line2 = mysqli_fetch_assoc($resultSQL3)){

      $idAmi2 = $line2[id_amis];

      $requeteSQL2 = "DELETE FROM t_amis WHERE id_amis = '$idAmi2'";

      $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Echec de la requete");

      header ("Location: http://localhost:8888/app_cine/mesAmis.php");

    }

  }


}

 ?>

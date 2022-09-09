<?php

session_start();

if(isset($_POST[supprimerCom]) && !empty($_POST[supprimerCom]) && isset($_POST[idPostCom]) && !empty($_POST[idPostCom])){

  $idCom = $_POST[supprimerCom];

  $idPostCom = $_POST[idPostCom];

  $link = mysqli_connect("localhost", "root", "root") or die ("Impossible de se connecter");

  mysqli_select_db($link, "base_club_cinema") or die ("Impossible de selectionner la base");

  $requeteSQL = "DELETE FROM t_commentaires WHERE id_commentaire = '$idCom'";

  $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete pour supprimer le commentaire");

  //echo "commentaire supprimé";

  header ("Location: http://localhost:8888/app_cine/mesCommentaires.php?idPostCom=$idPostCom");

}

 ?>

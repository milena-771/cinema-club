<?php

  session_start();

  $connexionBD = mysqli_connect("localhost","root","root") or die ("Impossible de se connecter");

  mysqli_select_db($connexionBD,"base_club_cinema") or die ("La base n’a pas pu etre selectionnee");

  if (isset($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['login']) && !empty($_POST['mdp'])) {

    $login = $_POST['login'];
    $leMdp = $_POST['mdp'];

    $requeteSQL = "SELECT prenom_utilisateur, statut_utilisateur, id_utilisateur FROM t_utilisateur WHERE `login_utilisateur`='$login' AND `mdp_utilisateur`='$leMdp'";

    $resultSQL = mysqli_query($connexionBD, $requeteSQL) or die ("Erreur requete SQL");

    if($line = mysqli_fetch_assoc($resultSQL)){

      $lePrenom = $line[prenom_utilisateur];
      $leStatut = $line[statut_utilisateur];
      $idUtilisateur = $line[id_utilisateur];


        $_SESSION[prenom]=$lePrenom;
        $_SESSION[statut]=$leStatut;
        $_SESSION[idUtilisateur]=$idUtilisateur;


        header ("Location: http://localhost:8888/app_cine/filPosts.php");

    }else{
      header ("Location: http://localhost:8888/app_cine/loginCC.php");
    }
  }



 ?>

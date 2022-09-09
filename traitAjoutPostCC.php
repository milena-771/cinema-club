<?php

  session_start();

  function FormulairePost(){

  }

  function FicheFilm(){

  }

  if (isset($_POST['titre']) && isset($_POST['real'])&& !empty($_POST['titre']) && !empty($_POST['real'])) {

    $unTitre = $_POST['titre'];
    $nomReal = $_POST['real'];

    $link = mysqli_connect ("localhost", "root", "root") or die ("Impossible de se connecter");

    mysqli_select_db($link, "base_club_cinema") or die ("Impossible de se connecter à la base");

    $requeteSQL = "SELECT titre_film, real_film, id_fiche_film FROM t_fiche_film WHERE `titre_film`='$unTitre' and `real_film`='$nomReal'";

    $resultSQL = mysqli_query($link,$requeteSQL) or die ("Le film n'est pas dans la base");

    if ($line = mysqli_fetch_assoc($resultSQL)){

      $leFilm = $line[titre_film];
      $idFicheFilm = $line[id_fiche_film];

      $_SESSION[idFicheFilm] = $idFicheFilm;
      $_SESSION[titre] = $leFilm;

      header ("Location: http://localhost:8888/app_cine/postFilm.php");
    }else{
      header ("Location: http://localhost:8888/app_cine/creerFicheFilm.php");
    }


  }
?>

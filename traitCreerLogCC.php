<?php

 if ( isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['age']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['mdp'])
&& !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['mdp'])) {

  $prenomUtilisateur = $_POST['prenom'];
  $nomUtilisateur = $_POST['nom'];
  $ageUtilisateur = $_POST['age'];
  $emailUtilisateur = $_POST['email'];
  $loginUtilisateur = $_POST['login'];
  $mdpUtilisateur = $_POST['mdp'];


  $nouvelUtilisateurs = "'$nomUtilisateur','$prenomUtilisateur','$ageUtilisateur','$loginUtilisateur','$mdpUtilisateur','$emailUtilisateur'";

  $link = mysqli_connect("localhost","root","root") or die ("Impossible de se connecter");

  mysqli_select_db($link, "base_club_cinema") or die ("impossible de selctionner la base");

  $requeteSQL = "INSERT INTO `base_club_cinema`.`t_utilisateur` (`nom_utilisateur`, `prenom_utilisateur`,`age_utilisateur`, `login_utilisateur`, `mdp_utilisateur`,`mail_utilisateur`,`statut_utilisateur` ) VALUES ($nouvelUtilisateurs, 'normal')";

  $resultSQL = mysqli_query($link, $requeteSQL) or die ("Echec de la requete");

  echo "Votre compte a bien été crée !";
  echo "Connectez vous pour y accéder: <a href=\"http://localhost:8888/app_cine/loginCC.php\">page Login <\a>";

}else{
  echo "Le compte n'a pas pu être crée";
  echo "<a href=\"http://localhost:8888/app_cine/creerLogCC.html\"> Creer un compte <\a>";
}




 ?>

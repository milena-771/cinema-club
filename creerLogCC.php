<!doctype html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title> Créer un nouveau compte</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500&family=Nunito:wght@300;400&display=swap" rel="stylesheet">

    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
   <link rel="apple-touch-icon" href="logo/camera.png" sizes="180x180">
   <link rel="icon" href="logo/camera.png" sizes="32x32" type="image/png">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      button[type="submit"]{
        color: #6c757d;
      }

      button[type="submit"]:hover{
        background-color: rgba(10,30,30,0.2);
        color: #6c757d;
        font-weight:bold;
      }
    </style>


    <link href="styles/offcanvasProfil.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">

      <div class="container-fluid">
        <img src="logo/chaplin-silhouette2.png" width="60">
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="container">

      <h1>CRÉATION D'UN NOUVEAU PROFIL :</h1>

      <div class="my-3 p-3 bg-body rounded shadow-sm">

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

          $requeteSQL1 = "SELECT login_utilisateur FROM t_utilisateur WHERE `mail_utilisateur`= '$emailUtilisateur'";

          $resultSQL1 = mysqli_query($link,$requeteSQL1) or die ("L'adresse mail indiquée n'a pas pu être vérifiée");

          $requeteSQL2 = "SELECT mail_utilisateur FROM t_utilisateur WHERE `login_utilisateur`= '$loginUtilisateur'";

          $resultSQL2 = mysqli_query($link,$requeteSQL2) or die ("Le login indiqué n'a pas pu être vérifiée");

            if ($line1 = mysqli_fetch_assoc($resultSQL1)){

              echo "<div class=\"text-danger\"> Un compte a déjà été crée avec cette adresse mail</div>";

            }elseif ($line2 = mysqli_fetch_assoc($resultSQL2)) {

              echo "<div class=\"text-danger\"> Un login existe déjà à ce nom, trouvez en un autre</div>";
              echo "<br>";

            }else{

              $requeteSQL3 = "INSERT INTO `base_club_cinema`.`t_utilisateur` (`nom_utilisateur`, `prenom_utilisateur`,`age_utilisateur`, `login_utilisateur`, `mdp_utilisateur`,`mail_utilisateur`,`statut_utilisateur` ) VALUES ($nouvelUtilisateurs, 'normal')";

              $resultSQL3 = mysqli_query($link, $requeteSQL3) or die ("Echec de la requete");

              echo "<div class=\"text-success\">Votre compte a bien été crée, vous pouvez vous connecter <a href=\"http://localhost:8888/app_cine/loginCC.php\">ici</a></div>";
            }
      }

         ?>

        <form action="creerLogCC.php" method="post">

          <h6 class="border-bottom pb-2 mb-0 fw-bold">Vos Informations :</h6>

          <br>

            <div class="row mb-3">
             <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
               <div class="col-sm-3">
                 <input type="text" class="form-control" name="prenom" id="prenom" minlength="2" maxlength="20" pattern="[A-Z][a-z]+" required>
               </div>
             <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
               <div class="col-sm-3">
                 <input type="text" class="form-control" name="nom" id="nom" pattern="[A-Za-z‘]+" required>
               </div>
           </div>

            <div class="row mb-3">
              <label for="age" class="col-sm-2 col-form-label">Date de naissance :</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control" name="age" id="age" min="1922-01-01" max="2004-01-01">
                </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Mail :</label>
                <div class="col-sm-3">
                  <input type="mail" class="form-control" name="email" id="email" minlength="8" maxlength="50" pattern="\w+@{1}[a-z]+\.[a-z]{2,3}" placeholder="@gmail.com">
                </div>
            </div>

            <br>

          <h6 class="border-bottom pb-2 mb-0 fw-bold">Vos Identifiants :</h6>

          <br>

            <div class="row mb-3">
              <label for="login" class="col-sm-2 col-form-label">Login :</label>
               <div class="col-sm-3">
                 <input type="text" class="form-control" name="login" id="login" minlength="2" maxlength="10" pattern="\w+">
               </div>
              <label for="mdp" class="col-sm-2 col-form-label">Mot de passe :</label>
                <div class="col-sm-3">
                  <input type="password" class="form-control" name="mdp" id="mdp" minlength="3" maxlength="10">
                </div>
             </div>

              <button class="btn btn-light" type="submit">CRÉER</button>

        </form>

      </div>
    </main>

    <script src="styles/bootstrap.bundle.min.js"></script>

    <script src="styles/offcanvas.js"></script>

  </body>
</html>

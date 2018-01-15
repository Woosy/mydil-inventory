<?php

session_start();

include('includes/database.php');

?>



 <!DOCTYPE html>
 <html lang="fr">

 <!-- Metadonnées -->
 <head>
    <meta charset="utf-8">
    <title><?php if(isset($_SESSION['id'])) { echo $_SESSION['surname']; } ?> - MyDIL</title>
    <link rel="stylesheet" type="text/css" href="style/compte.css">
 </head>


<!-- Corps de la page -->
<body>

    <?php
      include('includes/header.php');
    ?>



    <?php // Utilisateur connecté
    if (isset($_SESSION['id'])) {

      include("includes/account/accountmenu.php");

      // VÉRIFICATION DE LA PAGE :
      if (isset($_GET['menu'])) {

        // SELECTION PARTIE MENU :
        switch ($_GET['menu']) {

          // DEMANDES
          case 'demandes':
          include('includes/account/demandes.php');
          break;

          // EMPRUNTS
          case 'emprunts':
            include('includes/account/emprunts.php');
          break;

          // DEMANDES EN ATTENTE (admin)
          case 'demandesattente':
            include('includes/account/demandesattente.php');
          break;

          // OBJETS PRÊTÉS (admin)
          case 'objetspretes':
            include('includes/account/objetspretes.php');
          break;

        }

      }
      ?>


      <?php
      // Utilisateur non connecté :
    } else {

    }?>






</body>

</html>

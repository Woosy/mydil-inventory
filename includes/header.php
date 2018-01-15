<link rel="stylesheet" href="style/includes/header.css">
<link rel="stylesheet" href="style/polices/polices.css">


<div id="header">


  <img id="header_logo" src="images/mydil-logo.png" alt="Image non-chargée"/>

  <h1 id="header_titre">INVENTORY</h1>


  <?php // SI L'UTILISATEUR EST CONNECTÉ :
  if (isset($_SESSION['id'])) {

    // UTILISATEUR = ÉLEVE :
    if ($_SESSION['isadmin'] == 0) { ?>

      <a class='header_bouton' href='deconnexion.php'>DECONNEXION</a>
      <a class='header_bouton' id='header_bouton_compte' href='compte.php?menu=emprunts'>MES EMPRUNTS</a>
      <a class='header_bouton' href='compte?menu=demandes'>MES DEMANDES</a>
      <a class='header_bouton' href='index.php'>ACCUEIL</a>

      <?php // UTILISATEUR = ADMIN :
    } else { ?>

      <a class='header_bouton' href='deconnexion.php'>DECONNEXION</a>
      <a class='header_bouton' href='compte.php?menu=demandesattente'>PANEL ADMIN</a>
      <a class='header_bouton' href='compte.php?menu=demandes'>PANEL PERSO</a>
      <a class='header_bouton' href='ajout.php'>AJOUTER</a>
      <a class='header_bouton' href='index.php'>ACCUEIL</a>

      <?php
    }

    // SI L'UTILISATEUR N'EST PAS CONNECTÉ :
  } else { ?>
    <a class='header_bouton' href='inscription.php'>S'INSCRIRE</a>
    <a class='header_bouton' href='connexion.php'>SE CONNECTER</a>
    <a class='header_bouton' href='index.php'>ACCUEIL</a>

    <?php
  } ?>
</div>

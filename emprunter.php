<?php

  session_start();

  include('includes/database.php');

  // Récupération informations objet :
  $reqobjet = $bdd -> prepare("SELECT * FROM stock WHERE id = ?");
  $reqobjet -> execute(array($_GET['id']));
  $objetinfos = $reqobjet -> fetch();

  $objetid = $objetinfos['id'];
  $objetnom = $objetinfos['nom'];
  $objetdesc = $objetinfos['description'];
  $objetdispo = $objetinfos['estdispo'];
  $objetdateretour = $objetinfos['dateretour'];
  $objetetat = $objetinfos['etat'];
  $objetcategorie = $objetinfos['categorie'];
  $objetsouscategorie = $objetinfos['souscategorie'];
  $objetimage = $objetinfos['photos'];

  // Récupération informations utilisateur :
  $userid = $_SESSION['id'];



  if (isset($_POST['sendform'])) {
    if (isset($_POST['objet']) AND isset($_POST['message'])) {
      $addmessage = $bdd -> prepare("INSERT INTO demandes(idutilisateur, idobjet, objet, message, statut, datecreation) VALUES(?, ?, ?, ?, ?, ?)");
      $addmessage -> execute(array($userid, $objetid, $_POST['objet'], $_POST['message'], "En attente", date("Y-m-d H:i:s")));
      echo "Le message a bien été envoyé !";
    }
  }

?>



<!DOCTYPE html>
<html lang="fr">

  <!-- Metadonnées -->
  <head>
    <meta charset="utf-8">
    <title>Emprunter - MyDIL</title>
    <link rel="stylesheet" type="text/css" href="style/emprunter.css" />
    <link rel="stylesheet" type="text/css" href="style/polices/polices.css"/>
  </head>


<!-- Corps de la page -->
<body>

<?php
include('includes/header.php');


// Si l'utilisateur est connecté:
if (isset($_SESSION["id"])) { ?>

  <div id="form">
    <form method="POST">

      <h2 id="form_titre">Emprunter "<?php echo $objetnom; ?>" :</h2>


      <p id="form_desc">Remplissez ce formulaire pour envoyer une demande de prêt, et vos informations</br>
                        seront automatiquement transmisent ! (Chaque champ est obligatoire !)</p>

      <div id="objet_image">
        <img id="objet_image_image" src="<?php echo $objetimage;?>" alt="(Image non chargée)"></img>
      </div>

      <input class="form_champ" name="objet" type="text" placeholder="Objet de la demande" required="" value="<?php if (isset($_POST['objet'])) { echo $_POST['objet']; } ?>"/></br>
      <textarea id="form_champ_desc" name="message" type="text" placeholder="Rédigez un message justifiant la raison de la demande d'emprunt" required=""><?php if (isset($_POST['message'])) { echo $_POST['message']; } ?></textarea>
      <input id="form_envoyer" name="sendform" type="submit" />
    </form>
  </div>
  <?php
  // Si l'utilisateur n'est pas connecté :
} else {
  echo "Veuillez vous connecter afin d'emprunter un objet !";
} ?>


</body>

</html>

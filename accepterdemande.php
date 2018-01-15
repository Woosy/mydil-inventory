<?php

include('includes/database.php');


if (isset($_GET['idObjet'])) {

  $idObjet = $_GET['idObjet'];
  $idDemande = $_GET['idDemande'];
  $idEmprunteur = $_GET['idEmprunteur'];


  $sql = $bdd -> prepare("UPDATE demandes SET statut='Accepté' WHERE id='$idDemande'");
  $sql -> execute(array());

  $sql2 = $bdd -> prepare("UPDATE stock SET idemprunteur='$idEmprunteur' WHERE id='$idObjet'");
  $sql2 -> execute(array());

  $sql3 = $bdd -> prepare("UPDATE stock SET estdispo='0' WHERE id='$idObjet'");
  $sql3 -> execute(array());

  header("Location: compte.php?menu=demandesattente");
}

 ?>

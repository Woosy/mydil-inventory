<?php

include('includes/database.php');


if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = $bdd -> prepare("UPDATE demandes SET statut='Refusé' WHERE id='$id'");
  $sql -> execute(array());

  header("Location: compte.php?menu=demandesattente");
}

 ?>

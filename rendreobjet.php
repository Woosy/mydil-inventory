<?php

include('includes/database.php');


if (isset($_GET['id'])) {

  $idObjet = $_GET['id'];


  $sql = $bdd -> prepare("UPDATE stock SET estdispo='1' WHERE id='$idObjet'");
  $sql -> execute(array());

  $sql2 = $bdd -> prepare("UPDATE stock SET idemprunteur='0' WHERE id='$idObjet'");
  $sql2 -> execute(array());


  header("Location: index.php");
}

 ?>

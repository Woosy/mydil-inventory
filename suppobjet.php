<?php

include('includes/database.php');


if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = $bdd -> prepare("UPDATE stock SET supprime=1 WHERE id='$id'");
  $sql -> execute(array());

  header("Location: index.php");
}

 ?>

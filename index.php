<?php
session_start();

include('includes/database.php');

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];

  // On effectue la requête :
  $requser = $bdd -> prepare('SELECT * FROM utilisateurs WHERE id = ?');
  $requser -> execute(array($id));
  $userinfo = $requser -> fetch();

  $id = $userinfo['id'];
  $surname = $userinfo['surname'];
  $lastname = $userinfo['lastname'];
  $email = $userinfo['email'];
  $class = $userinfo['class'];
  $isadmin = $userinfo['isadmin'];
}
?>


<!DOCTYPE html>
<html lang="fr">

<!-- Metadonnées -->
<head>
  <meta charset="utf-8">
  <title>MyDIL Inventory</title>
  <link rel="stylesheet" href="style/index.css">
  <link rel="stylesheet" href="style/polices/polices.css">
</head>

<!-- Corps de la page -->
<body>

  <?php
  include('includes/header.php');

  $sql = $bdd->prepare("SELECT * FROM stock");
  $sql->execute();
  $count = $sql->rowCount();
  ?>


  <div id="section">

    <?php
    for($i = 1; $i <= $count; $i++) {
      $req = $bdd -> prepare("SELECT * FROM stock WHERE id = ?");
      $req -> execute(array($i));
      $objInfos = $req -> fetch();

      if ($objInfos['supprime'] == 0) {
        $objId = $objInfos['id'];
        $objNom = $objInfos['nom'];
        $objDesc = $objInfos['description'];
        $objDispo = $objInfos['estdispo'];
        $objDateretour = $objInfos['dateretour'];
        $objEtat = $objInfos['etat'];
        $objCategorie = $objInfos['categorie'];
        $objSouscategorie = $objInfos['souscategorie'];
        $objImage = $objInfos['photos'];
        ?>

        <!-- les cases pour les objs -->
        <a href= "objet.php?id=<?php echo $objId; ?>">
          <div id="section_objet">
            <img id="section_objet_image" src="<?php echo $objImage; ?>"/>



            <div id="section_objet_infos">
              <h1 id="section_objet_infos_nom"> <?php echo $objNom; ?> </h1>

              <div id="section_objet_infos_categories">
                <p>
                  <?php echo $objCategorie; ?> </br>
                  <?php echo $objSouscategorie; ?>
                </p>
              </div>

              <h2>
                <?php
                  if (isset($_SESSION['id'])) {
                    if ($_SESSION['isadmin'] == 1) {
                      echo "<a id='section_objet_supp' href='suppobjet.php?id=$objId'><div>Supprimer</div></a>";
                    }
                  }
                  if ($objDispo == 1) { ?>
                    <p id="section_objet_infos_dispo"> <?php echo "Disponible"; ?> </p> <?php
                  } else { ?>
                    <p id=section_objet_infos_indispo>Indisponible</p>
                    <p id="section_objet_infos_dateretour">Retour le :</br> <?php echo $objDateretour; ?></p> <?php
                  } ?>
              </h2>
            </div>
          </div> </br>
        </a>

        <?php
      }
    } ?>
  </div>


  <?php
    include('includes/footer.php');
  ?>

  </body>

</html>

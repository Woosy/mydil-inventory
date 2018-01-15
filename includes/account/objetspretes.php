<link rel="stylesheet" type="text/css" href="style/includes/account/objetspretes.css">

<?php

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

      if ($objInfos['estdispo'] == 0) {
        $objId = $objInfos['id'];
        $objNom = $objInfos['nom'];
        $objDesc = $objInfos['description'];
        $objDispo = $objInfos['estdispo'];
        $objDateretour = $objInfos['dateretour'];
        $objEtat = $objInfos['etat'];
        $objCategorie = $objInfos['categorie'];
        $objSousCategorie = $objInfos['souscategorie'];
        $objImage = $objInfos['photos'];
        $objEmprunteurId = $objInfos['idemprunteur'];

        $req = $bdd -> prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $req -> execute(array($objEmprunteurId));
        $emprunteurInfos = $req -> fetch();

        $emprunteurPrenom = $emprunteurInfos['surname'];
        $emprunteurNom = $emprunteurInfos['lastname'];
        $emprunteurClasse = $emprunteurInfos['class'];
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
                <?php echo $objSousCategorie; ?> </br>
                <?php echo "<b>".$emprunteurPrenom." ".$emprunteurNom.", ".$emprunteurClasse."</b>"; ?>
              </p>
            </div>
          </div>

        </div>
        </a>
          <?php
        }
      } ?>
  </div> <?php
} ?>

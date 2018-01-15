<?php

session_start();

include('includes/database.php');

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

?>



 <!DOCTYPE html>
 <html lang="fr">

 <!-- Metadonnées -->
 <head>
   <meta charset="utf-8">
   <title><?php echo $objetnom; ?> - MyDil</title>
    <link rel="stylesheet" type="text/css" href="style/objet.css">
 </head>


  <!-- Corps de la page -->
  <body>

    <?php
      include('includes/header.php');
    ?>

    <div id="objet">

      <div>
        <p id="objet_titre"><?php echo $objetnom;?></p>
        <?php if ($objetdispo == 1) { echo "<a href='emprunter.php?id=$objetid'>Emprunter cet objet</a>"; }?>
      </div>

      <div id="objet_image">
        <img id="objet_image_image" src="<?php echo $objetimage;?>" alt="(Image non chargée)"></img>
      </div>

      <div id="objet_desc">
         <p class="titre">Description :</p>
         <p class="text"><?php echo $objetdesc;?></p>
      </div>

      <div id="objet_etat">
        <p class="titre">État :</p>
        <p class="text"><?php echo $objetetat;?></p>
      </div>

      <div id="objet_statut">
        <p class="titre">Statut :</p>
        <p class="text"><?php if ($objetdispo == 0) {
                                $objetemprunteur = $objetinfos['idemprunteur'];
                                $reqEmprunteur = $bdd -> prepare("SELECT * FROM utilisateurs WHERE id = ?");
                                $reqEmprunteur -> execute(array($objetemprunteur));
                                $emprunteurInfos = $reqEmprunteur -> fetch();

                                echo "<u>Emprunté par :</u><br/>".$emprunteurInfos['surname']." ".$emprunteurInfos['lastname']."<br/>".$emprunteurInfos['class'];
                                if ($_SESSION['isadmin'] == 1) {
                                  echo "<br /><br /><a style='text-decoration: none; color: black; font-size: 100%;' href='rendreobjet.php?id=$objetid'>RENDRE L'OBJET</a>";
                                }

                              } else {
                                echo "Disponible !";
                              }
        ?></p>
      </div>

      <div id="objet_souscategorie">
        <p class="titre">Sous-catégorie :</p>
        <p class="text"><?php echo $objetsouscategorie;?></p>
      </div>

      <div id="objet_categorie">
        <p class="titre">Catégorie :</p>
        <p class="text"><?php echo $objetcategorie;?></p>
      </div>

      <div id="objet_disponibilite">
        <p></p>
      </div>

    </div>



</body>

</html>

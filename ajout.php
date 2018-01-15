<?php
session_start();

include('includes/database.php');

// On vérifie que le formulaire ai été envoyé :
if (isset($_POST['ajouterobjetform'])) {

  // On récupère les informations :
  $name = htmlspecialchars($_POST['name']);
  $desc = htmlspecialchars($_POST['desc']);
  $etat = htmlspecialchars($_POST['etat']);
  $category = $_POST['category'];
  $subcategory = $_POST['subcategory'];


  // Constantes
  define('TARGET', 'images/');    // Repertoire cible
  define('MAX_SIZE', 25000000);    // Taille max en octets du fichier
  define('WIDTH_MAX', 5000);    // Largeur max de l'image en pixels
  define('HEIGHT_MAX', 5000);    // Hauteur max de l'image en pixels


  // Tableaux de donnees
  $tabExt = array('png','jpg','gif','jpeg');    // Extensions autorisees
  $infosImg = array();

  // Variables
  $nomfichier = md5(uniqid());
  $extension = '';
  $message = '';
  $nomImage = '';

  /************************************************************
   * Creation du repertoire cible si inexistant
   *************************************************************/
  if( !is_dir(TARGET) ) {
    if( !mkdir(TARGET, 0755) ) {
      exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
    }
  }




  // On vérifie qu'aucun champ ne soit vide :
  if (!empty($name) AND !empty($desc) AND !empty($etat) AND !empty($category) AND !empty($subcategory) AND !empty($_POST) AND !empty($_FILES['fichier']['name']) ) {
    // Recuperation de l'extension du fichier
    $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

    // On verifie l'extension du fichier
    if(in_array(strtolower($extension),$tabExt)) {

      // On recupere les dimensions du fichier
      $infosImg = getimagesize($_FILES['fichier']['tmp_name']);

      // On verifie le type de l'image
      if($infosImg[2] >= 1 && $infosImg[2] <= 50) {

        // On verifie les dimensions et taille de l'image
        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {

          // Parcours du tableau d'erreurs
          if(isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {

            // On renomme le fichier
            $nomImage = $nomfichier.".".$extension;

            // Si c'est OK, on teste l'upload
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage)) {
              $message = 'Upload réussi !';
            } else {
              // Sinon on affiche une erreur systeme
              $message = 'Problème lors de l\'upload !';
            }

          } else {
            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
          }

        } else {
          // Sinon erreur sur les dimensions et taille de l'image
          $message = 'Erreur dans les dimensions de l\'image !';
        }

      } else {
        // Sinon erreur sur le type de l'image
        $message = 'Image trop grande !';
      }

    } else {
      // Sinon on affiche une erreur pour l'extension
      $message = 'L\'extension du fichier est incorrecte !';
    }

    $insertobject = $bdd -> prepare("INSERT INTO stock(nom, description, etat, categorie, souscategorie, dateretour, estdispo, photos) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $insertobject -> execute(array($name, $desc, $etat, $category, $subcategory, NULL, 1, "images/".$nomfichier));

  } else {
    $message = "Veuillez remplir tout les champs !";
  }

}

?>




<!DOCTYPE html>
<html lang="fr">

<!-- Metadonnées -->
<head>
  <meta charset="utf-8">
  <title>Ajout matériel - MyDIL</title>
  <link rel="stylesheet" href="style/ajout.css">
  <link rel="stylesheet" href="style/polices/polices.css">
</head>


<!-- Corps de la page -->
<body>

  <?php
  include('includes/header.php')
  ?>

  <div id="form">

    <h2 id="form_titre">Ajouter du matériel :</h2>

    <p id="form_desc">Formulaire d'ajout de matériel.</br>
                      (Chaque champ est obligatoire !)</p>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <input class="form_champ" type="text" name="name" placeholder="Nom de l'objet" required="" value="<?php if(isset($name)){ echo $_POST['name']; }?>"  /> <br/>
        <textarea id="form_champ_desc" name="desc" placeholder="Entrez une description pour l'objet" required=""><?php if(isset($_POST['desc'])){echo htmlspecialchars($_POST['desc']);}?></textarea> <br/>
        <input class="form_champ" type="text" name="etat" placeholder="Etat de l'objet" required="" value="<?php if(isset($etat)){ echo $etat; }?>" /> <br/><br/>
        <select class="form_champ" name="category">
          <option value="null" <?php if (isset($_POST['category']) && $_POST['category'] == "null"){echo "selected";} ?>>--Séléctionnez une catégorie--
          <option value="Device" <?php if (isset($_POST['category']) && $_POST['category'] == "Device"){echo "selected";} ?>>Device
          <option value="Image" <?php if (isset($_POST['category']) && $_POST['category'] == " Image"){echo "selected";} ?>>Image
          <option value="IoT" <?php if (isset($_POST['category']) && $_POST['category'] == "IoT"){echo "selected";} ?>>IoT
          <option value="Mobilité" <?php if (isset($_POST['category']) && $_POST['category'] == "Mobilité"){echo "selected";} ?>>Mobilité
          <option value="PC" <?php if (isset($_POST['category']) && $_POST['category'] == "PC"){echo "selected";} ?>>PC
          <option value="Système embarqué" <?php if (isset($_POST['category']) && $_POST['category'] == "Système embarqué"){echo "selected";} ?>>Système embarqué
        </select> <br/> <br/>
        <select class="form_champ" name="subcategory">
          <option value="null" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "null"){echo "selected";} ?>>--Séléctionnez une sous-catégorie--
          <option value="Webcam" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Webcam"){echo "selected";} ?>>Webcam
          <option value="Appareil photo" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Appareil photo"){echo "selected";} ?>>Appareil photo
          <option value="Caméra" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Caméra"){echo "selected";} ?>>Caméra
          <option value="Ampoule" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Ampoule"){echo "selected";} ?>>Ampoule
          <option value="Drone" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Drone"){echo "selected";} ?>>Drone
          <option value="Bracelet" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Bracelet"){echo "selected";} ?>>Bracelet
          <option value="Montre" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Montre"){echo "selected";} ?>>Montre
          <option value="Smartphone" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Smartphone"){echo "selected";} ?>>Smartphone
          <option value="Tablette hybride" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Tablette hybride"){echo "selected";} ?>>Tablette hybride
          <option value="Barebone" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Barebone"){echo "selected";} ?>>Barebone
          <option value="PC portable" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "PC portable"){echo "selected";} ?>>PC portable
          <option value="Capteur" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Capteur"){echo "selected";} ?>>Capteur
          <option value="Module" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Module"){echo "selected";} ?>>Module
          <option value="Robot" <?php if (isset($_POST['subcategory']) && $_POST['subcategory'] == "Robot"){echo "selected";} ?>>Robot
        </select> <br/> <br/>
        <input name="fichier" type="file" id="fichier_a_uploader" />
        <input id="form_envoyer" type="submit" name="ajouterobjetform" value="Ajouter"/>
        <br/><br/>
      </form>


      <?php
        if (isset($message))
        {
          echo '<font color="red">'.$message.'</font>';
        }
      ?> <br/>


    </div>


  </body>

</html>

<?php
session_start();

include('includes/database.php');

// On vérifie que le formulaire ai été envoyé :
if (isset($_POST['registerform'])) {

  // On récupère les informations :
  $email = htmlspecialchars($_POST['email']);
  $surname = htmlspecialchars($_POST['surname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $class = $_POST['class'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $hashedpassword = sha1($password);

  $emaillenght = strlen($email);
  $surnamelenght = strlen($surname);
  $lastnamelenght = strlen($lastname);
  $passwordlenght = strlen($password);

  // On vérifie qu'aucun champ ne soit vide :
  if (!empty($_POST['email'] AND !empty($_POST['surname']) AND !empty('lastname') AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['class']))) {
    // On vérifie que la classe ait bien été séléctionnée
    if ($_POST['class'] != "null") {
      // Vérification de longueur des champs pour ne pas remplir la bdd inutilement :
      if ($emaillenght <= 32) {
        if ($surnamelenght <= 20) {
          if ($lastnamelenght <= 20) {
            if ($passwordlenght <= 32) {
              // On vérifie que les deux mots de passe correspondent :
              if ($password == $password2) {
                // On vérifie que l'email saisie est bien une adresse mail :
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  // On vérifie que l'adresse mail n'existe pas :
                  $reqmail = $bdd -> prepare("SELECT * FROM utilisateurs WHERE email = ?");
                  $reqmail -> execute(array($email));
                  $emailexist = $reqmail -> rowCount();
                  if ($emailexist == 0) {

                    // Tout est bon : on envoie les données dans la base de données :
                    $insertuser = $bdd -> prepare("INSERT INTO utilisateurs(surname, lastname, email, class, password, isadmin, issuperadmin) VALUES(?, ?, ?, ?, ?, ?, ?)");
                    $insertuser -> execute(array($surname, $lastname, $email, $class, $hashedpassword, 0, 0));
                    $erreur = "Votre compte a bien été créé !";

                    // L'inscription est valide : on envoie un email pour confirmer :
                    // $erreur = "Un email vient de vous être envoyé pour confirmer votre inscription (dans votre boîte finissant par @epsi.fr !)!<br/>Veuillez rentrer le code de vérification indiqué dans ce dernier.";

                  } else {
                    $erreur = "Erreur : il existe déjà un utilisateur utilisant cette adresse mail !";
                  }
                } else {
                  $erreur = "Erreur : veuillez saisir une adresse mail valide !";
                }
              } else {
                $erreur = "Erreur : veuillez saisir deux mots de passe identiques !";
              }
            } else {
              $erreur = "Erreur : votre mot de passe ne doit pas dépasser 32 caractères !";
            }
          } else {
            $erreur = "Erreur : votre nom de famille ne doit pas dépasser 20 caractères !";
          }
        } else {
          $erreur = "Erreur : votre prénom ne doit pas dépasser 20 caractères !";
        }
      } else {
        $erreur = "Erreur : votre email ne doit pas dépasser 32 caractères !";
      }
    } else {
      $erreur = "Erreur : veuillez séléctionner votre classe !";
    }
  }

}
?>

<!DOCTYPE html>
<html lang="fr">

<!-- Metadonnées -->
<head>
  <meta charset="utf-8">
  <title>MyDIL Inventory</title>
  <link rel="stylesheet" href="style/inscription.css">
  <link rel="stylesheet" href="style/polices/polices.css">
</head>

<!-- Corps de la page -->
<body>

  <?php
    include('includes/header.php')
  ?>

  <div id="form">


    <h2 id="form_titre">Créez vous un compte !</h2>

    <p id="form_desc">Créez vous un compte indiquant votre nom, prénom, classe, et votre email Epsi,</br>
      afin d'avoir par la suite la possibilité de louer du matériel en seulement quelques clics !</p>

    <form method="POST" action="">
      <input class="form_champ" type="text" name="email" placeholder="Adresse mail (@epsi.fr !)" required="" value="<?php if(isset($email)){ echo $_POST['email']; }?>" /> <br/>
      <input class="form_champ" type="text" name="surname" placeholder="Prénom" required="" value="<?php if(isset($surname)){ echo $surname; }?>" /> <br/>
      <input class="form_champ" type="text" name="lastname" placeholder="Nom de famille" required="" value="<?php if(isset($lastname)){ echo $lastname; }?>" /> <br/><br/>
      <select class="form_champ" name="class">
        <option value="null" <?php if (isset($_POST['class']) && $_POST['class'] == "null"){echo "selected";} ?>>--Sélectionnez votre classe--
        <option value="B1" <?php if (isset($_POST['class']) && $_POST['class'] == "B1"){echo "selected";} ?>>B1
        <option value="B2" <?php if (isset($_POST['class']) && $_POST['class'] == "B2"){echo "selected";} ?>>B2
        <option value="B3 (G1)" <?php if (isset($_POST['class']) && $_POST['class'] == "B3 (G1)"){echo "selected";} ?>>B3 (G1)
        <option value="B3 (G2)" <?php if (isset($_POST['class']) && $_POST['class'] == "B3 (G2)"){echo "selected";} ?>>B3 (G2)
        <option value="I4 (G1)" <?php if (isset($_POST['class']) && $_POST['class'] == "I4 (G1)"){echo "selected";} ?>>I4 (G1)
        <option value="I4 (G2)" <?php if (isset($_POST['class']) && $_POST['class'] == "I4 (G2)"){echo "selected";} ?>>I4 (G2)
        <option value="I5 (G1)" <?php if (isset($_POST['class']) && $_POST['class'] == "I5 (G1)"){echo "selected";} ?>>I5 (G1)
        <option value="I5 (G2)" <?php if (isset($_POST['class']) && $_POST['class'] == "I5 (G2)"){echo "selected";} ?>>I5 (G2)
      </select> <br/> <br/>
      <input class="form_champ" type="password" name="password" placeholder="Mot de passe" required=""/> <br/>
      <input class="form_champ" type="password" name="password2" placeholder="Confirmez votre mdp" required=""/> <br/><br/>
      <input id="form_envoyer" type="submit" name="registerform" value="S'inscrire"/> <br/><br/>
    </form>

    <a id="form_dejauncompte" href="connexion.php">Vous possédez déjà un compte ? Connectez-vous !</a>

    <?php
    if (isset($erreur)) {
      echo '<font color="red">'.$erreur.'</font>';
    }
    ?><br/>


  </div>


</body>

</html>

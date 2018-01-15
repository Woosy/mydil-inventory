<?php
session_start();

include('includes/database.php');

// On vérifié que le formulaire ai été envoyé :
if(isset($_POST['loginform'])) {

  $email = htmlspecialchars($_POST['email']);
  $password = sha1($_POST['password']);

  // On vérifie que les champs aient bien été remplis :
  if(!empty($email) AND !empty($password)) {
    // On vérifie que le combo utilisateur+mdp existe bien :
    $requser = $bdd -> prepare("SELECT * FROM utilisateurs WHERE email = ? AND password = ?");
    $requser -> execute(array($email, $password));
    $userexist = $requser -> rowCount();
    if ($userexist == 1) {

      // L'utilisateur est connecté avec succès, on le redirige sur sa page de profil :
      $userinfo = $requser -> fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['email'] = $userinfo['email'];
      $_SESSION['surname'] = $userinfo['surname'];
      $_SESSION['lastname'] = $userinfo['lastname'];
      $_SESSION['isadmin'] = $userinfo['isadmin'];
      header("Location: index.php");

    } else {
      $erreur = "Ces identifiants sont incorrects.";
    }
  } else {
    $erreur = "Veuillez remplir tout les champs.";
  }

}

?>
<!DOCTYPE html>
<html lang="fr">

<!-- Metadonnées -->
<head>
  <meta charset="utf-8">
  <title>Connexion - MyDIL</title>
  <link rel="stylesheet" href="style/connexion.css">
  <link rel="stylesheet" href="style/polices/polices.css">
</head>


<!-- Corps de la page -->
<body>

  <?php
    include('includes/header.php');
  ?>


  <div id="form">

    <h2 id="form_titre">Connectez vous à votre compte!</h2>

    <p id="form_desc">Connectez-vous à votre compte et accédez à la réservation de matériel,</br>
          et vérifiez les dates de retours du matériel déjà emprunté !</p>

    <form method="POST" action="">
      <input class="form_champ" type="email" name="email" placeholder="Adresse mail (@epsi.fr !)" required="" value="<?php if(isset($email)){ echo $email; }?>" /> <br/>
      <input class="form_champ" type="password" name="password" placeholder="Mot de passe" required=""/> <br/><br/>
      <input id="form_envoyer" type="submit" name="loginform" value="Connexion"/>
    </form> </br></br>

    <a id="form_pasdecompte" href="inscription.php">Vous n'avez pas de compte ? Inscrivez-vous !</a> </br>

    <?php
    if (isset($erreur)) {
      echo '<font color="red">'.$erreur.'</font>';
    }
    ?>

  </div>


</body>

</html>

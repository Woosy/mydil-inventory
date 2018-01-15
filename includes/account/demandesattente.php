<link rel="stylesheet" type="text/css" href="style/includes/account/demandesattente.css">

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
}

  $sql = $bdd->prepare("SELECT * FROM demandes");
  $sql->execute();
  $count = $sql->rowCount();
  ?>


  <div id="section">

    <?php
    for($i = $count; $i > 0; $i--) {
      $req = $bdd -> prepare("SELECT * FROM demandes WHERE id = ?");
      $req -> execute(array($i));
      $demandesInfos = $req -> fetch();

      $demId = $demandesInfos['id'];
      $demUserId = $demandesInfos['idutilisateur'];
      $demObjetId = $demandesInfos['idobjet'];
      $demObjet = $demandesInfos['objet'];
      $demMsg = $demandesInfos['message'];
      $demStatut = $demandesInfos['statut'];
      $demDateCrea = $demandesInfos['datecreation'];

      $req2 = $bdd -> prepare("SELECT * FROM utilisateurs WHERE id = ?");
      $req2 -> execute(array($demUserId));
      $targetUserInfos = $req2 -> fetch();

      if ($demStatut == "En attente") { ?>

        <!-- les cases pour les demandes -->
        <div id="section_demande">

          <div id="section_demande_infos"><br />
            <span id="section_demande_auteur"> <?php echo $targetUserInfos['surname']." ".$targetUserInfos['lastname'].", ".$targetUserInfos['class']; ?></span><br />
            <span id="section_demande_objet"> <?php echo $demObjet; ?></span><br />
            <span id="section_demande_statut"> <?php  if ($demStatut == "En attente") {
                                                        echo "<img id='section_demande_statut' src='images/attente.png'/>";
                                                      } else if ($demStatut == "Accepté") {
                                                        echo "<img id='section_demande_statut' src='images/accepté.png'/>";
                                                      } else {
                                                        echo "<img id='section_demande_statut' src='images/refusé.png'/>";
                                                      }
            ?></span><br />
            <span id="section_demande_date"> <?php echo "<u>Date :</u> ".$demDateCrea; ?></span>
          </div>

          <div id="section_demande_message">
            <span id="section_demande_msg"> <?php echo "<br />".$demMsg; ?></span>
          </div>

          <div id="section_demande_admin">
            <span id="section_demande_accepte"> <?php echo "<br /><br /><a href='accepterdemande.php?idDemande=$demId&idEmprunteur=$demUserId&idObjet=$demObjetId'>Accepter</a><br /><br />"; ?></span>
            <span id="section_demande_refuse"> <?php echo "<a href='refuserdemande.php?id=$demId'>Refuser</a>"; ?></span>
          </div>

        </div>

        <?php
      }
    } ?>
  </div>

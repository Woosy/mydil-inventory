<link rel="stylesheet" type="text/css" href="style/includes/footer.css" />
<link rel="stylesheet" type="text/css" href="style/polices/polices.css"/>

<?php
$url = $_SERVER['REQUEST_URI'];
?>

<div id="footer">
  <p id="footer_text">
    <a class='footer_link' href='mentions.php'>Mentions légales</a> | Tous droits réservés | <a class='footer_link' href='contact.php'>Contact</a>
  </p>
</div>
<?php
    // TODO : Supprimer ce bricolage dégeulasse
    // CORRECTION PROBLEMES DE FOOTER TROP HAUTS
    if ((strpos($url, 'objet.php') !== false) OR (strpos($url, 'ajout.php') !== false)) {
      echo "
        <style>
          #footer { position: fixed; }
        </style>";
    } else {
      echo "
        <style>
          #footer_text { padding-top: 16px; }
        </style>";
    }
?>

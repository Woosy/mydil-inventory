<link rel="stylesheet" href="style/computer/fonts.css" />
<link rel="stylesheet" href="style/includes/account/accountmenu.css"/>



<div id='compte_menu'>

  <?php
    // AFFICHAGE MENU :
    if (isset($_GET['menu'])) {

      // SELECTION PARTIE MENU :
      switch ($_GET['menu']) {


        // MES DEMANDES
        case 'demandes': ?>
          <div onclick="javascript:window.open('compte.php?menu=demandes', '_self')" id='compte_menu_demandes' class='compte_menu_selected'>
            <img id='compte_menu_demandes_logo' src='images/logo_demandes.png' />
            <p id='compte_menu_demandes_label'>Mes demandes</p>
          </div>

          <div onclick="javascript:window.open('compte.php?menu=emprunts', '_self')"id='compte_menu_emprunts'>
            <p id='compte_menu_emprunts_label'>Mes emprunts</p>
            <img id='compte_menu_emprunts_logo' src='images/logo_emprunts.png' />
          </div> <?php

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=demandesattente', '_self')" id='compte_menu_demandesattente'>
              <p id='compte_menu_demandesattente_label'>Demandes attente</p>
              <img id='compte_menu_demandesattente_logo' src='images/logo_demandesattente.png' />
            </div> <?php
          }

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=objetspretes', '_self')" id='compte_menu_objetspretes'>
              <p id='compte_menu_objetspretes_label'>Objets prêtés</p>
              <img id='compte_menu_objetspretes_logo' src='images/logo_objetspretes.png' />
            </div> <?php
          } ?>
        <?php break;


        // EMPRUNTS
        case 'emprunts': ?>
          <div onclick="javascript:window.open('compte.php?menu=demandes', '_self')" id='compte_menu_demandes'>
            <img id='compte_menu_demandes_logo' src='images/logo_demandes.png' />
            <p id='compte_menu_demandes_label'>Mes demandes</p>
          </div>

          <div onclick="javascript:window.open('compte.php?menu=emprunts', '_self')" id='compte_menu_emprunts' class='compte_menu_selected'>
            <p id='compte_menu_emprunts_label'>Mes emprunts</p>
            <img id='compte_menu_emprunts_logo' src='images/logo_emprunts.png' />
          </div> <?php

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=demandesattente', '_self')" id='compte_menu_demandesattente'>
              <p id='compte_menu_demandesattente_label'>Demandes attente</p>
              <img id='compte_menu_demandesattente_logo' src='images/logo_demandesattente.png' />
            </div> <?php
          }

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=objetspretes', '_self')" id='compte_menu_objetspretes'>
              <p id='compte_menu_objetspretes_label'>Objets prêtés</p>
              <img id='compte_menu_objetspretes_logo' src='images/logo_objetspretes.png' />
            </div> <?php
          } ?>
        <?php break;


        // ADMINISTRATEUR - DEMANDES EN ATTENTE
        case 'demandesattente': ?>
          <div onclick="javascript:window.open('compte.php?menu=demandes', '_self')" id='compte_menu_demandes'>
            <img id='compte_menu_demandes_logo' src='images/logo_demandes.png' />
            <p id='compte_menu_demandes_label'>Mes demandes</p>
          </div>

          <div onclick="javascript:window.open('compte.php?menu=emprunts', '_self')" id='compte_menu_emprunts'>
            <p id='compte_menu_emprunts_label'>Mes emprunts</p>
            <img id='compte_menu_emprunts_logo' src='images/logo_emprunts.png' />
          </div> <?php

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=demandesattente', '_self')" id='compte_menu_demandesattente' class='compte_menu_selected'>
              <p id='compte_menu_demandesattente_label'>Demandes attente</p>
              <img id='compte_menu_demandesattente_logo' src='images/logo_demandesattente.png' />
            </div> <?php
          }

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=objetspretes', '_self')" id='compte_menu_objetspretes'>
              <p id='compte_menu_objetspretes_label'>Objets prêtés</p>
              <img id='compte_menu_objetspretes_logo' src='images/logo_objetspretes.png' />
            </div> <?php
          } ?>
        <?php break;



        // ADMINISTRATEUR - OBJETS PRÊTÉS
        case 'objetspretes': ?>
          <div onclick="javascript:window.open('compte.php?menu=demandes', '_self')" id='compte_menu_demandes'>
            <img id='compte_menu_demandes_logo' src='images/logo_demandes.png' />
            <p id='compte_menu_demandes_label'>Mes demandes</p>
          </div>

          <div onclick="javascript:window.open('compte.php?menu=emprunts', '_self')" id='compte_menu_emprunts'>
            <p id='compte_menu_emprunts_label'>Mes emprunts</p>
            <img id='compte_menu_emprunts_logo' src='images/logo_emprunts.png' />
          </div> <?php

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=demandesattente', '_self')" id='compte_menu_demandesattente'>
              <p id='compte_menu_demandesattente_label'>Demandes attente</p>
              <img id='compte_menu_demandesattente_logo' src='images/logo_demandesattente.png' />
            </div> <?php
          }

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=objetspretes', '_self')" id='compte_menu_objetspretes' class='compte_menu_selected'>
              <p id='compte_menu_objetspretes_label'>Objets prêtés</p>
              <img id='compte_menu_objetspretes_logo' src='images/logo_objetspretes.png' />
            </div> <?php
          } ?>
        <?php break;




        // AUTRES
        default: ?>
          <div onclick="javascript:window.open('compte.php?menu=demandes', '_self')" id='compte_menu_demandes'>
            <img id='compte_menu_demandes_logo' src='images/logo_demandes.png' />
            <p id='compte_menu_demandes_label'>Mes demandes</p>
          </div>

          <div onclick="javascript:window.open('compte.php?menu=emprunts', '_self')" id='compte_menu_emprunts'>
            <p id='compte_menu_emprunts_label'>Mes emprunts</p>
            <img id='compte_menu_emprunts_logo' src='images/logo_emprunts.png' />
          </div> <?php

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=demandesattente', '_self')" id='compte_menu_demandesattente'>
              <p id='compte_menu_demandesattente_label'>Demandes attente</p>
              <img id='compte_menu_demandesattente_logo' src='images/logo_demandesattente.png' />
            </div> <?php
          }

          if ((isset($_SESSION['isadmin'])) && ($_SESSION['isadmin'] == 1)) { ?>
            <div onclick="javascript:window.open('compte.php?menu=objetspretes', '_self')" id='compte_menu_objetspretes'>
              <p id='compte_menu_objetspretes_label'>Objets prêtés</p>
              <img id='compte_menu_objetspretes_logo' src='images/logo_objetspretes.png' />
            </div> <?php
          } ?>
        <?php break;
      }
      ?>









      <?php
    } else {
      echo "ERREUR !";
    }
  ?>

</div>

<div id='compte_separation'>

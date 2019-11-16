<?php
if(!isset($_SESSION))
  session_start();

  function call($controller, $action) {
    require_once('controllers/' . $controller . 'Controller.php');

    switch($controller) {
      case 'Home':
        $controller = new HomeController();
        break;
      break;
      case 'Admin':
        $controller = new AdminController();
      break;
      case 'Demande':
        $controller = new DemandeController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
                       'Demande' => ['index','add', 'save','details','delete','traiter'],
      'Home' => ['index','error','verifLogin', 'addUser','saveUser','homeVisiteur','homeEmploye','homeSuperieur','logout'],
                       'Admin' => ['homeAdmin','indexProfil','addProfil','saveProfil','indexGroupe','addGroupe', 'saveGroupe','deleteProfil','deleteGroupe','error']
                       );

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      $_SESSION['titreErreur'] = "Objet non trouvé!";
      $_SESSION['messageErreur'] ="L'URL demandée n'a pas pu être trouvée sur ce serveur. Si vous avez tapé l'URL à la main, veuillez
      vérifier l'orthographe et réessayer.";
      call('Home', 'error');
    }
  } else {
    $_SESSION['titreErreur'] = "Objet non trouvé!";
    $_SESSION['messageErreur'] ="L'URL demandée n'a pas pu être trouvée sur ce serveur. Si vous avez tapé l'URL à la main, veuillez
    vérifier l'orthographe et réessayer.";
    call('Home', 'error');
  }
?>

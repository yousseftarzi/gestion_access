<?php

	if(!isset($_SESSION))
	session_start();

  require_once('connexion.php');

  if (isset($_GET['controller']) && isset($_GET['action']) ) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];

		if ($controller == "Admin")
		require_once 'views/admin.php';
		else {
			require_once 'views/layout.php';
		}
  } else {

    if(!isset($_SESSION['roleUser'])){
		$controller = 'Home';
    	$action = 'index';
		require_once 'views/layout.php';}
	else{
		if($_SESSION['roleUser'] == "visiteur"){
			$action = "homeVisiteur";
			$controller = 'Home';}
		else if($_SESSION['roleUser'] == "employe"){
			$action = "homeEmploye";
			$controller = 'Home';}
		else if($_SESSION['roleUser'] == "superieur"){
			$action = "homeSuperieur";
			$controller = 'Home';}
		else if ($_SESSION['roleUser'] == "admin"){
			$controller = 'Admin';
			$action ="homeAdmin";

		}
		else $action = "index";

		if ($controller!='Admin')
		require_once('views/layout.php');
		if ($controller=='Admin')
		require_once 'views/admin.php';
	}

}

?>

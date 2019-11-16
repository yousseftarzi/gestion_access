<?php 

class AccessControl{


	public static function restrictNotConnected()
	{
		if (!isset($_SESSION['roleUser'])){
			$_SESSION['titreErreur'] = "Accés interdit";
			$_SESSION['messageErreur'] ="Veuilez se connecter pour accéder à cette page";
			$_SESSION['lienRetour'] = "?controller=Home&action=index";
			header("Location:?controller=Home&action=error");	
			exit();
		}
	
	}


	public static function restrictVisiteur($lienRetour){

			if(isset($_SESSION['roleUser'])){	
				if ($_SESSION['roleUser']=="visiteur" ) {		
				$_SESSION['titreErreur'] = "Accés interdit";
				$_SESSION['messageErreur'] ="Vous n'avez pas acces a cette page";
				$_SESSION['lienRetour'] = $lienRetour;
				header("Location:?controller=Home&action=error");	
				exit();
				}
			}

	}


	public static function restrictEmploye($lienRetour){

			if(isset($_SESSION['roleUser']))
			{
			if ($_SESSION['roleUser']=="employe" ) {
		
			$_SESSION['titreErreur'] = "Accés interdit";
			$_SESSION['messageErreur'] ="Vous n'avez pas acces a cette page";
			$_SESSION['lienRetour'] = $lienRetour;
			header("Location:?controller=Home&action=error");	
			exit();
		}
	}

	}


	public static function restrictSuperieur($lienRetour){


			if(isset($_SESSION['roleUser']))
			{
			if ($_SESSION['roleUser']=="superieur" ) {
		
			$_SESSION['titreErreur'] = "Accés interdit";
			$_SESSION['messageErreur'] ="Vous n'avez pas acces a cette page";
			$_SESSION['lienRetour'] = $lienRetour;
			header("Location:?controller=Home&action=error");	
			exit();
		}

		}
	}


	public static function restrictAdmin($lienRetour){

			if(isset($_SESSION['roleUser']))
			{
			if ($_SESSION['roleUser']=="admin" ) {
		
			$_SESSION['titreErreur'] = "Accés interdit";
			$_SESSION['messageErreur'] ="Cette page est restreinte aux utilisateurs";
			$_SESSION['lienRetour'] = $lienRetour;
			header("Location:?controller=Home&action=error");	
			exit();
		}
	}

	}


	public static function restrictConnected($lienRetour){
		AccessControl::restrictVisiteur($lienRetour);
		AccessControl::restrictEmploye($lienRetour);
		AccessControl::restrictSuperieur($lienRetour);
		AccessControl::restrictAdmin($lienRetour);
	}

	public static function restrictNotVisiteur($lienRetour){

		AccessControl::restrictNotConnected();
		AccessControl::restrictEmploye($lienRetour);
		AccessControl::restrictSuperieur($lienRetour);
		AccessControl::restrictAdmin($lienRetour);

	}


	public static function restrictNotEmploye($lienRetour){

		AccessControl::restrictNotConnected();
		AccessControl::restrictVisiteur($lienRetour);
		AccessControl::restrictSuperieur($lienRetour);
		AccessControl::restrictAdmin($lienRetour);
	}


	public static function restrictNotSuperieur($lienRetour){

		AccessControl::restrictNotConnected();
		AccessControl::restrictVisiteur($lienRetour);
		AccessControl::restrictEmploye($lienRetour);
		AccessControl::restrictAdmin($lienRetour);
	}


	public static function restrictNotAdmin($lienRetour){

		AccessControl::restrictNotConnected();
		AccessControl::restrictVisiteur($lienRetour);
		AccessControl::restrictEmploye($lienRetour);
		AccessControl::restrictSuperieur($lienRetour);
	}

}


?>
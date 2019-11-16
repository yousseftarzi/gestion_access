<?php

require_once('models/Profil.php');
require_once('models/Groupe.php');
require_once('models/AccessControl.php');

class AdminController
{

	public function __construct(){}

	//Gestion des profils
    public function indexProfil()
	{
		$lienRoute="?controller=Home&Action=index";
	   AccessControl::restrictNotAdmin($lienRoute);
       $listProfil = Profil::findAll();
	   require_once('views/admin/profil/index_profil.php');
	}

	public function addProfil()
	{
		AccessControl::restrictNotAdmin("null");
		require_once('views/admin/profil/add_profil.php');
	}

	public function deleteProfil()
    {
        $profil = new Profil();
        $profil->setId($_GET['id']);
        $profil->delete();

        $this->indexProfil();
    }

	public function saveProfil()
	{
		AccessControl::restrictNotAdmin("null");
		if( isset($_POST['nom']))
		{
			$profil = new Profil();
			$profil->setNom($_POST['nom']);
			if( is_null( $profil->findByNom()->getId()) )
		{	$profil->create();
			header("Location:?controller=Admin&action=indexProfil");
			exit();}
			else {
						$_SESSION['titreErreur'] = "Information Incorrecte";
						$_SESSION['messageErreur'] ="Le Profil existe deja";
						$_SESSION['lienRetour'] ="?controller=Admin&action=addProfil";
						header("Location:?controller=Admin&action=error");
						exit();
			}
		}
		else {
			$_SESSION['titreErreur'] = "Champs vide";
			$_SESSION['messageErreur'] ="Veuillez saisir le nom du profil";
			header("Location:?controller=Admin&action=error");
			exit();
		}
	}


	//Gestion des groupes

	public function indexGroupe()
	{
	   AccessControl::restrictNotAdmin("null");
	   $listGroupe = Groupe::findAll();
       require_once('views/admin/groupe/index_groupe.php');
	}

	public function addGroupe()
	{
		AccessControl::restrictNotAdmin("null");
		require_once('views/admin/groupe/add_groupe.php');
	}

	public function saveGroupe()
	{
		AccessControl::restrictNotAdmin("null");
		if( isset($_POST['nom']) )
		{
			$groupe = new Groupe();
			$groupe->setNom($_POST['nom']);
			if( is_null( $groupe->findByNom()->getId()) )
			{$groupe->create();
			header("Location:?controller=Admin&action=indexGroupe");
			exit();}
			else
			$_SESSION['titreErreur'] = "Information Incorrecte";
			$_SESSION['messageErreur'] ="Le Groupe existe deja";
			$_SESSION['lienRetour'] ="?controller=Admin&action=addGroupe";
			header("Location:?controller=Admin&action=error");
			exit();
		}
		else {
			$_SESSION['titreErreur'] = "Champs vide";
			$_SESSION['messageErreur'] ="Veuillez saisir le nom du groupe";
			header("Location:?controller=Admin&action=error");
			exit();
		}
	}

	public function deleteGroupe()
    {
        $groupe = new Groupe();
        $groupe->setId($_GET['id']);
        $groupe->delete();

        $this->indexGroupe();
    }


		public function homeAdmin()
		{
			$lienRetour="";
			if(isset($_SESSION['roleUser']))
			{
				 if($_SESSION['roleUser'] == "employe")
					$lienRetour="?controller=Home&action=homeEmploye";
				else if($_SESSION['roleUser'] == "superieur")
					$lienRetour="?controller=Home&action=homeSuperieur";
				else if($_SESSION['roleUser'] == "admin")
					$lienRetour="?controller=Home&action=homeVisiteur";
			}
			AccessControl::restrictNotAdmin($lienRetour);
			require_once('views/admin/home_admin.php');

		}

		public static function error()
		{
			if(!isset($_SESSION))
				session_start();

			if(isset($_SESSION['titreErreur']) && isset($_SESSION['messageErreur']) && isset($_SESSION['lienRetour']) ){
				$titreErreur = $_SESSION['titreErreur'];
				$messageErreur = $_SESSION['messageErreur'];
				$lienRetour = $_SESSION['lienRetour'];
			}
			else {
	   		$titreErreur = "";
				$messageErreur = "";
				$lienRetour ="";
			}
			//Si l'utilisateur a actualiser la page d'erreur
			$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
			if($pageWasRefreshed ) {
				$titreErreur = $_SESSION['titreErreur'];
				$messageErreur = $_SESSION['messageErreur'];
				//$lienRetour = $_SESSION['lienRetour'];
			}

			require_once('views/erreurAdmin.php');
		}

}



?>

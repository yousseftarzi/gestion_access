<?php

if(!isset($_SESSION))
	session_start();

require_once('models/Utilisateur.php');
require_once('models/AccessControl.php');

class HomeController{

	public function index()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			else if($_SESSION['roleUser'] == "employe")
				$lienRetour="?controller=Home&action=homeEmploye";
			else if($_SESSION['roleUser'] == "superieur")
				$lienRetour="?controller=Home&action=homeSuperieur";
			else if($_SESSION['roleUser'] == "admin")
				$lienRetour="?controller=Home&action=homeAdmin";
			AccessControl::restrictConnected($lienRetour);
		}
		require_once('views/home/home.php');
	}

	public function addUser()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			else if($_SESSION['roleUser'] == "employe")
				$lienRetour="?controller=Home&action=homeEmploye";
			else if($_SESSION['roleUser'] == "superieur")
				$lienRetour="?controller=Home&action=homeSuperieur";
			else if($_SESSION['roleUser'] == "admin")
				$lienRetour="?controller=Home&action=homeAdmin";
			AccessControl::restrictConnected($lienRetour);
		}
		require_once('views/home/inscription.php');
	}

	public function saveUser()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			else if($_SESSION['roleUser'] == "employe")
				$lienRetour="?controller=Home&action=homeEmploye";
			else if($_SESSION['roleUser'] == "superieur")
				$lienRetour="?controller=Home&action=homeSuperieur";
			else if($_SESSION['roleUser'] == "admin")
				$lienRetour="?controller=Home&action=homeAdmin";

			AccessControl::restrictConnected($lienRetour);
		}

		if( isset($_POST['matricule']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['nom'])
			&& isset($_POST['prenom']) && isset($_POST['fonction']) && isset($_POST['departement']) && isset($_POST['emplacement'])
			&& isset($_POST['num_tel']) && isset($_POST['email']))
		{

			$user = new Utilisateur();
			$user->setMatricule($_POST['matricule']);
			$user->setLogin($_POST['login']);
			$user->setPassword($_POST['password']);
			$user->setNom($_POST['nom']);
			$user->setPrenom($_POST['prenom']);
			$user->setFonction($_POST['fonction']);
			$user->setDepartement($_POST['departement']);
			$user->setEmplacement($_POST['emplacement']);
			$user->setNumTel($_POST['num_tel']);
			$user->setEmail($_POST['email']);
			$user->setRole('visiteur');
			if ($user->checkUserExist() == ""){
				$user->create();
				header("Location:?controller=Home&action=index");
			}
			else{
				$_SESSION['titreErreur'] = "Traitement impossible";
				$_SESSION['messageErreur']=$user->checkUserExist();
				$_SESSION['lienRetour']="?controller=Home&action=addUser";
				header("Location:?controller=Home&action=error");
			}
		}
		else {
			$_SESSION['titreErreur'] = "Champs vides";
			$_SESSION['messageErreur'] ="Veuillez remplir le formulaire d'inscription pour s'inscrire";
			$_SESSION['lienRetour'] = "controller=Home&action=addUser";
			header("Location:?controller=Home&action=error");
			exit();
		}
	}

	public function verifLogin()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			else if($_SESSION['roleUser'] == "employe")
				$lienRetour="?controller=Home&action=homeEmploye";
			else if($_SESSION['roleUser'] == "superieur")
				$lienRetour="?controller=Home&action=homeSuperieur";
			else if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			AccessControl::restrictConnected();
		}

		if(isset($_POST['login']) && isset($_POST['password']))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$user = new Utilisateur();
			$user->setLogin($login);
			$user->setPassword($password);

			if($user->verifLogin())
				{
					$user = $user->findByLogin($login);
					$_SESSION['idUser'] = $user->getId();
					if ($user->getRole() == "visiteur")
					{
						$_SESSION['roleUser'] =  "visiteur";
						header("Location:?controller=Home&action=homeVisiteur");
						exit();
					}
					else if($user->getRole() == "employe")
					{
						$_SESSION['roleUser'] =  "employe";
						header("Location:?controller=Home&action=homeEmploye");
						exit();
					}
					else if ($user->getRole() == "superieur")
					{
						$_SESSION['roleUser'] =  "superieur";
						header("Location:?controller=Home&action=homeSuperieur");
						exit();
					}
					else if ($user->getRole() == "admin")
					{
						$_SESSION['roleUser'] =  "admin";
						header("Location:?controller=Admin&action=homeAdmin");
						exit();
					}

				}

				else{
					$_SESSION['titreErreur'] = "Information érronnées";
					$_SESSION['messageErreur'] ="Veuillez vérifier votre login et mot de passe";
					$_SESSION['lienRetour'] = "?controller=Home&action=index";
					header("Location:?controller=Home&action=error");
					exit();

				}
		}

		else{
			$_SESSION['titreErreur'] = "Champs vides";
			$_SESSION['messageErreur'] ="Veuillez remplir les champs login et mot de passe pour se connecter";
			$_SESSION['lienRetour'] = "?controller=Home&action=index";
			header("Location:?controller=Home&action=error");
			exit();
		}
	}

	public function logout()
	{
		AccessControl::restrictNotConnected();
		session_destroy();
		header("Location:?controller=Home&action=index");
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

		require_once('views/erreur.php');
	}

	public function homeVisiteur()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			 if($_SESSION['roleUser'] == "employe")
				$lienRetour="?controller=Home&action=homeEmploye";
			else if($_SESSION['roleUser'] == "superieur")
				$lienRetour="?controller=Home&action=homeSuperieur";
			else if($_SESSION['roleUser'] == "admin")
				$lienRetour="?controller=Home&action=homeAdmin";
		}
		AccessControl::restrictNotVisiteur($lienRetour);
		require_once('views/home/home_visiteur.php');
	}

	public function homeEmploye()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			 if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			else if($_SESSION['roleUser'] == "superieur")
				$lienRetour="?controller=Home&action=homeSuperieur";
			else if($_SESSION['roleUser'] == "admin")
				$lienRetour="?controller=Home&action=homeAdmin";
		}
		AccessControl::restrictNotEmploye($lienRetour);
		require_once('views/home/home_employe.php');
	}

	public function homeSuperieur()
	{
		$lienRetour="";
		if(isset($_SESSION['roleUser']))
		{
			 if($_SESSION['roleUser'] == "employe")
				$lienRetour="?controller=Home&action=homeEmploye";
			else if($_SESSION['roleUser'] == "visiteur")
				$lienRetour="?controller=Home&action=homeVisiteur";
			else if($_SESSION['roleUser'] == "admin")
				$lienRetour="?controller=Home&action=homeAdmin";
		}
		AccessControl::restrictNotSuperieur($lienRetour);
		require_once('views/home/home_superieur.php');
	}




}
















?>

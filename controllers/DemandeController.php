<?php

if(!isset($_SESSION))
	session_start();

require_once('models/Utilisateur.php');
require_once('models/Demande.php');
require_once('models/DemandeProfil.php');
require_once('models/DemandeGroupe.php');
require_once('models/Profil.php');
require_once('models/Groupe.php');
require_once('models/ProfilUtilisateur.php');
require_once('models/GroupeUtilisateur.php');
require_once('models/AccessControl.php');


class DemandeController
{
	public function __construct(){}

	public function index()
	{
		AccessControl::restrictNotConnected();
		$lienRetour="?controller=Home&action=homeAdmin";
		AccessControl::restrictAdmin($lienRetour);

		$demande = new Demande();
		$idCurrentUser = $_SESSION['idUser'];
		if( isset($_SESSION['roleUser']) && ($_SESSION['roleUser'] == "employe" || $_SESSION['roleUser'] == "visiteur") )
		{
			$demande->setIdUtilisateur($idCurrentUser);
			$listDemande = $demande->findByIdUser();
			require_once('views/demande/index_user.php');
		}
		else if(isset($_SESSION['roleUser']) && $_SESSION['roleUser'] == "superieur")
		{
			$demande->setIdSuperieur($idCurrentUser);
			$listDemande = $demande->findBySup();
			require_once('views/demande/index_superieur.php');
		}

	}

	//Fonction utilisé par l'utilisateur visiteur ou l'employe
	public function add()
	{
		AccessControl::restrictNotConnected();
		if($_SESSION['roleUser'] == "superieur"){
			$lienRetour="?controller=Home&action=homeSuperieur";
			AccessControl::restrictSuperieur($lienRetour);
		}
		else if($_SESSION['roleUser'] == "admin"){
			$lienRetour="?controller=Home&action=homeAdmin";
			AccessControl::restrictAdmin($lienRetour);
		}



		$user = new Utilisateur();
		$listSuperieur = $user->findAllSuperieur();
		$user->setId($_SESSION['idUser']);
		$profil = new Profil();
		$listProfil = $profil->findAll();
		$groupe = new Groupe();
		$listGroupe = $groupe->findAll();

		if(count($listSuperieur) >0 && count($listProfil) >0 && count($listGroupe)>0)
		{
			$demande = new Demande();
			$demande->setIdUtilisateur($user->getId());
			$listDemande = $demande->findByIdUser();
			if(count($listDemande) > 0)
			{
				$demandeProfil = new DemandeProfil();
				$demandeGroupe = new DemandeGroupe();
				foreach ($listDemande as $demandeTemp) {

					$demandeProfil->setIdDemande($demandeTemp->getId());
					$listDemandeProfil = $demandeProfil->findByIdDemande();
					$profilTemp = new Profil();
					foreach ($listDemandeProfil as $demandeProfilTemp) {
						$profilTemp->setId($demandeProfilTemp->getIdProfil());
						$profilTemp = $profilTemp->findById();
						foreach ($listProfil as $key => $value) {
							if($value->getId() == $profilTemp->getId())
								unset($listProfil[$key]);
						}
					}
					$demandeGroupe->setIdDemande($demandeTemp->getId());
					$listDemandeGroupe = $demandeGroupe->findByIdDemande();
					$groupeTemp = new Groupe();
					foreach ($listDemandeGroupe as $demandeGroupeTemp) {
						$groupeTemp->setId($demandeGroupeTemp->getIdGroupe());
						$groupeTemp = $groupeTemp->findById();
						foreach ($listGroupe as $key => $value) {
							if($value->getId() == $groupeTemp->getId())
								unset($listGroupe[$key]);
						}
					}

				}
			}

					$profilUser = new ProfilUtilisateur();
					$profilUser->setIdUtilisateur($user->getId());
					$listUserProfil = $profilUser->findByUserId();
					$profilTest = new Profil();
					foreach ($listUserProfil as $userProfilTemp) {
						$profilTest->setId($userProfilTemp->getIdProfil());
						$profilTest = $profilTest->findById();
						foreach ($listProfil as $key => $value) {
							if($value->getId() == $profilTest->getId())
								unset($listProfil[$key]);
						}
					}

					$groupeUser = new GroupeUtilisateur();
					$groupeUser->setIdUtilisateur($user->getId());
					$listUserGroupe = $groupeUser->findByUserId();
					$groupeTest = new Groupe();
					foreach ($listUserGroupe as $userGroupeTemp) {
						$groupeTest->setId($userGroupeTemp->getIdGroupe());
						$groupeTest = $groupeTest->findById();
						foreach ($listGroupe as $key => $value) {
							if($value->getId() == $groupeTest->getId())
								unset($listGroupe[$key]);
						}
					}

			if(count($listProfil) >0 || count($listGroupe)>0)
				require_once('views/demande/add.php');
			else{
				$_SESSION['titreErreur'] = "Service non disponible";
				$_SESSION['messageErreur'] ="Vous avez envoyé une ou plusieurs demande pour tous les profils et tous les groupes,
				ou vous avez été accepté dans tous les profils et tous les groupes";
				$_SESSION['lienRetour'] = "?controller=Demande&action=index";
				header("Location:?controller=Home&action=error");
				exit();
			}
		}
		else{
			$_SESSION['titreErreur'] = "Service non disponible";
			$_SESSION['messageErreur'] ="L'application a rencontré un problème, Veuillez ressayer ultérieurement (profil(s) ou groupe(s) ou supérieur(s) inexistant(s)";
			$_SESSION['lienRetour'] = "?controller=Demande&action=index";

			header("Location:?controller=Home&action=error");
			exit();
		}
	}



	public function save()
	{

		AccessControl::restrictNotConnected();
		if($_SESSION['roleUser'] == "superieur"){
			$lienRetour="?controller=Home&action=homeSuperieur";
			AccessControl::restrictSuperieur($lienRetour);
		}
		else if($_SESSION['roleUser'] == "admin"){
			$lienRetour="?controller=Home&action=homeAdmin";
			AccessControl::restrictAdmin($lienRetour);
		}


		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			if( isset($_SESSION['idUser'])  && isset($_SESSION['roleUser']) ){
				if( $_SESSION['roleUser'] == "visiteur" || $_SESSION['roleUser'] == "employe" ){
					$idSuperieur = $_POST['superieur'];
					$currentUserId = $_SESSION['idUser'];
					//Récupération des profils choisis par l'utilisateur
					$profil = new Profil();
					$listProfil = $profil->findAll();
					$listCheckedProfil = [];
					foreach ($listProfil as $profil)
						if(isset( $_POST[ $profil->getNom() ] ))
							$listCheckedProfil[] = $profil;
					//Récupération des groupes choisis par l'utilisateur
					$groupe = new Groupe();
					$listGroupe = $groupe->findAll();
					$listCheckedGroupe = [];
					foreach ($listGroupe as $groupe)
						if(isset( $_POST[ $groupe->getNom() ] ))
							$listCheckedGroupe[] = $groupe;


					$demande = new Demande();
					$demande->setIdUtilisateur($currentUserId);
					$demande->setIdSuperieur($idSuperieur);
					$demande->create();
					$demande = $demande->findByUserByDateEnvoi();  //Récupération de la demande créée

					$demandeProfil = new DemandeProfil();
					if(count($listCheckedProfil) > 0){
						foreach ($listCheckedProfil as $checkedProfil) {
							$demandeProfil->setIdDemande($demande->getId());
							$demandeProfil->setIdProfil($checkedProfil->getId());
							$demandeProfil->create();
						}
					}
					$demandeGroupe = new DemandeGroupe();
					if(count($listCheckedGroupe) > 0){
						foreach ($listCheckedGroupe as $checkedGroupe) {
							$demandeGroupe->setIdDemande($demande->getId());
							$demandeGroupe->setIdGroupe($checkedGroupe->getId());
							$demandeGroupe->create();
						}
					}
					//Redirection vers l'affichage
					header("Location:?controller=Demande&action=index");
					exit();
				}
			}

		}else{
			$_SESSION['titreErreur'] = "Accés interdit";
			$_SESSION['messageErreur'] ="Veuillez Cliquer sur le boutton valider pour envoyer votre demande";
			$_SESSION['lienRetour'] = "?controller=Demande&action=add";
			header("Location:?controller=Home&action=error");
			exit();
		}
	}





	public function delete()
	{

		AccessControl::restrictNotConnected();
		if($_SESSION['roleUser'] == "superieur"){
				$lienRetour="?controller=Home&action=homeSuperieur";
				AccessControl::restrictSuperieur($lienRetour);
		}
		else if($_SESSION['roleUser'] == "admin"){
				$lienRetour="?controller=Home&action=homeAdmin";
				AccessControl::restrictAdmin($lienRetour);
		}

		if(isset($_GET['id']))
		{
			$demande = new Demande();
			$demande->setId($_GET['id']);
			$demande = $demande->findById();
			if(!is_null($demande->getId()))
			{
				if($demande->getIdUtilisateur() == $_SESSION['idUser'])
				{
					//Suppression des demandes profils
					$demandeProfil = new DemandeProfil();
					$demandeProfil->setIdDemande($demande->getId());
					$listDemandeProfil = $demandeProfil->findByIdDemande();
					foreach ($listDemandeProfil as $demandeProfilTemp)
						$demandeProfil->delete();
					//Suppression des demandes groupes
					$demandeGroupe = new DemandeGroupe();
					$demandeGroupe->setIdDemande($demande->getId());
					$listDemandeGroupe = $demandeGroupe->findByIdDemande();
					foreach ($listDemandeGroupe as $demandeGroupeTemp)
						$demandeGroupe->delete();
					//Suppression de la demande
					$demande->delete();

					//Redirection vers l'affichage
					header("Location:?controller=Demande&action=index");
					exit();
				}
				else
				{
					$_SESSION['titreErreur'] = "Action invalide";
					$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes et ressayer de supprimer une";
					$_SESSION['lienRetour'] = "?controller=Demande&action=index";
					header("Location:?controller=Home&action=error");
					exit();
				}
			}
			else
			{
				$_SESSION['titreErreur'] = "Demande introuvable";
				$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes et ressayer de supprimer une";
				$_SESSION['lienRetour'] = "?controller=Demande&action=index";
				header("Location:?controller=Home&action=error");
				exit();
			}
		}
		else
		{
			$_SESSION['titreErreur'] = "Action invalide";
			$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes et ressayer de supprimer une";
			$_SESSION['lienRetour'] = "?controller=Demande&action=index";
			header("Location:?controller=Home&action=error");
			exit();
		}
	}

	//Fonctions dédiées pour le supérieur


	public function details()
	{
		AccessControl::restrictNotConnected();
		if($_SESSION['roleUser'] == "visiteur"){

			$lienRetour="?controller=Home&action=homeVisiteur";
			AccessControl::restrictNotSuperieur($lienRetour);
		}
		else if($_SESSION['roleUser'] == "employe"){
			$lienRetour="?controller=Home&action=homeEmploye";
				AccessControl::restrictNotSuperieur($lienRetour);
		}
		else if($_SESSION['roleUser'] == "admin"){
			$lienRetour="?controller=Home&action=homeAdmin";
			AccessControl::restrictNotSuperieur($lienRetour);
		}


		if(isset($_GET['id']))
		{
			$idDemande = $_GET['id'];
			$demande = new Demande();
			$demande->setId($idDemande);
			$demande = $demande->findById();
			if(!is_null($demande->getId()) )
			{
				$user = new Utilisateur();
				$user = $demande->findUserById();

				//Récupération de la liste des profils demandés (table demande_profil)
				$demandeProfil = new DemandeProfil();
				$demandeProfil->setIdDemande($idDemande);
				$listDemandeProfil = $demandeProfil->findByIdDemande();

				//Récupération des profils
				$listProfil = [];
				foreach ($listDemandeProfil as $demandeProfilTemp) {
					$profil = new Profil();
					$profil->setId($demandeProfilTemp->getIdProfil());
					$listProfil[] = $profil->findById();
				}
				//Récupération de la liste des groupes demandés (table demande_groupe)
				$demandeGroupe = new DemandeGroupe();
				$demandeGroupe->setIdDemande($idDemande);
				$listDemandeGroupe = $demandeGroupe->findByIdDemande();
				//Récupération des groupes
				$listGroupe = [];
				foreach ($listDemandeGroupe as $demandeGroupeTemp) {
					$groupe = new Groupe();
					$groupe->setId($demandeGroupeTemp->getIdGroupe());
					$listGroupe[] = $groupe->findById();
				}

			require_once('views/demande/details.php');
			}
			else{
				$_SESSION['titreErreur'] = "Demande introuvable";
				$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes";
				$_SESSION['lienRetour'] = "?controller=Demande&action=index";
				header("Location:?controller=Home&action=error");
				exit();
			}
		}
		else {
			$_SESSION['titreErreur'] = "Demande introuvable";
			$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes";
			$_SESSION['lienRetour'] = "?controller=Demande&action=index";
			header("Location:?controller=Home&action=error");
			exit();
		}
	}

	public function traiter()
	{

		AccessControl::restrictNotConnected();
		if($_SESSION['roleUser'] == "visiteur")
			$lienRetour="?controller=Home&action=homeVisiteur";
		else if($_SESSION['roleUser'] == "employe")
			$lienRetour="?controller=Home&action=homeEmploye";
		else if($_SESSION['roleUser'] == "admin")
			$lienRetour="?controller=Home&action=homeAdmin";

		AccessControl::restrictNotSuperieur($lienRetour);

		if(isset($_GET['idDemande']))
		{
			$idDemande = $_GET['idDemande'];
			$demande = new Demande();
			$demande->setId($idDemande);
			$demande = $demande->findById();
			//$demandeArray = (array) $demande;
			//var_dump(empty($demandeArray));
			if(!is_null($demande->getId()))
			{
				if($demande->getIdSuperieur() == $_SESSION['idUser'])
				{
					if($demande->getEtat() == "en_cours")
					{
						if(isset($_POST['accepter']))
						{
							// Mise à jour de l'etat de la demande et du role de l'utilisateur
							$demande->setEtat("Acceptee");
							$demande->updateEtat();
							$user = $demande->findUserById();
							$user->setRole("employe");
							$user->updateRole();
							//Ajout des profils demandés dans la table profil_utilisateur et suppression des demandes profils table demande_profil
							$demandeProfil = new DemandeProfil();
							$demandeProfil->setIdDemande($demande->getId());
							$listDemandeProfil = $demandeProfil->findByIdDemande();
							$profilUser = new ProfilUtilisateur();
							foreach ($listDemandeProfil as $demandeProfilTemp) {
							$profilUser->setIdUtilisateur($user->getId());
							$profilUser->setIdProfil($demandeProfilTemp->getIdProfil());
							$profilUser->create();
							$demandeProfilTemp->delete();
							header("Location:?controller=Demande&action=index");
						}
							//Ajout des groupes demandés dans la table groupe_utilisateur et suppression des demandes groupes table demande_groupe
							$demandeGroupe = new DemandeGroupe();
							$demandeGroupe->setIdDemande($demande->getId());
							$listDemandeGroupe = $demandeGroupe->findByIdDemande();
							$groupeUser = new GroupeUtilisateur();
							foreach ($listDemandeGroupe as $demandeGroupeTemp) {
								$groupeUser->setIdUtilisateur($user->getId());
								$groupeUser->setIdGroupe($demandeGroupeTemp->getIdGroupe());
								$groupeUser->create();
								$demandeGroupeTemp->delete();
							}
						}

						else if(isset($_POST['refuser']))
						{
							// Si la demande est refusée l'état de l'ultilisateur ne change pas
							$demande->setEtat("refusee");
							$demande->updateEtat();
							//Suppression demandes profils table demande_profil
							$demandeProfil = new DemandeProfil();
							$demandeProfil->setIdDemande($demande->getId());
							$listDemandeProfil = $demandeProfil->findByIdDemande();

							foreach ($listDemandeProfil as $demandeProfilTemp)
								$demandeProfilTemp->delete();

							//Suppression demandes profils table demande_profil table demande_groupe
							$demandeGroupe = new DemandeGroupe();
							$demandeGroupe->setIdDemande($demande->getId());
							$listDemandeGroupe = $demandeGroupe->findByIdDemande();

							foreach ($listDemandeGroupe as $demandeGroupeTemp)
								$demandeGroupeTemp->delete();
							header("Location:?controller=Demande&action=index");

						}

						else {
							$_SESSION['titreErreur'] = "Action invalide";
							$_SESSION['messageErreur'] ="Veuillez choisir une action pour traiter la demande (Accepter/Refuser) ";
							header("Location:?controller=Home&action=error");
							exit();
						}
					}

					else {
						$_SESSION['titreErreur'] = "Action invalide";
						$_SESSION['messageErreur'] ="Cette demande a déja été traitée!";
						header("Location:?controller=Home&action=error");
						exit();
					}


				}
			}
			else {
				$_SESSION['titreErreur'] = "Demande introuvable";
				$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes";
				header("Location:?controller=Home&action=error");
				exit();
			}
		}
		else{
			$_SESSION['titreErreur'] = "Demande introuvable";
			$_SESSION['messageErreur'] ="Veuillez actualiser la page de la liste des demandes";
			header("Location:?controller=Home&action=error");
			exit();
		}

	}

}


?>

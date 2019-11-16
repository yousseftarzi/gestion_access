<?php

class ProfilUtilisateur
{
	private $id;
	private $idUtilisateur;
	private $idProfil;

	public function __construct(){}

	public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO profil_utilisateur VALUES(null, ?, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_STR);
    	$statement->bindValue(2, $this->getIdProfil(), PDO::PARAM_STR);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM profil_utilisateur WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function findByUserId()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM profil_utilisateur WHERE id_utilisateur = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
        $listProfilUser = [];
    	foreach ($result as $key => $profilUserTemp)
    	{
    		$profilUser = new ProfilUtilisateur();
    		$profilUser->setId($profilUserTemp->id);
    		$profilUser->setIdUtilisateur($profilUserTemp->id_utilisateur);
    		$profilUser->setIdProfil($profilUserTemp->id_profil);
    		$listProfilUser[] = $profilUser;
    	} 
    		   
    	return $listProfilUser;	
    }


	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getIdUtilisateur()
	 {
	 	return $this->idUtilisateur;
	 }

	 public function setIdUtilisateur($userId)
	 {
	 	$this->idUtilisateur = $userId;
	 }

	 public function getIdProfil()
	 {
	 	return $this->idProfil;
	 }

	 public function setIdProfil($idProfil)
	 {
	 	$this->idProfil = $idProfil;
	 }


}

?>
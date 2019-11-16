<?php

class GroupeUtilisateur
{
	private $id;
	private $idUtilisateur;
	private $idGroupe;

	public function __construct(){}

	public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO groupe_utilisateur VALUES(null, ?, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
    	$statement->bindValue(2, $this->getIdGroupe(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM groupe_utilisateur WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function findByUserId()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM groupe_utilisateur WHERE id_utilisateur = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $listGroupeUser = [];
    	foreach ($result as $key => $groupeUserTemp)
    	{
    		$groupeUser = new GroupeUtilisateur();
    		$groupeUser->setId($groupeUserTemp->id);
    		$groupeUser->setIdUtilisateur($groupeUserTemp->id_utilisateur);
    		$groupeUser->setIdGroupe($groupeUserTemp->id_groupe);
    		$listGroupeUser[] = $groupeUser;
    	} 
    		   
    	return $listGroupeUser;	
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

	 public function getIdGroupe()
	 {
	 	return $this->idGroupe;
	 }

	 public function setIdGroupe($idGroupe)
	 {
	 	$this->idGroupe = $idGroupe;
	 }


}

?>
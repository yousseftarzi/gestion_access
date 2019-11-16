 	<?php

class DemandeGroupe
{
	private $id;
	private $idDemande;
	private $idGroupe;

	public function __construct(){}

	public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO demande_groupe VALUES(null, ?, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdDemande(), PDO::PARAM_STR);
    	$statement->bindValue(2, $this->getIdGroupe(), PDO::PARAM_STR);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM demande_groupe WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function findByIdDemande()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM demande_groupe WHERE id_demande = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdDemande(), PDO::PARAM_INT);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $listDemandeGroupe = [];
    	foreach ($result as $key=> $demandeGroupeTemp)
    	{
    		$demandeGroupe = new DemandeGroupe();
    		$demandeGroupe->setId($demandeGroupeTemp->id);
    		$demandeGroupe->setIdDemande($demandeGroupeTemp->id_demande);
    		$demandeGroupe->setIdGroupe($demandeGroupeTemp->id_groupe);
    		$listDemandeGroupe[] = $demandeGroupe;
    	} 
    		   
    	return $listDemandeGroupe;
    }

	public function getId()
	 {
	 	return $this->id;
	 }

	 public function setId($id)
	 {
	 	$this->id = $id;
	 }

	 public function getIdDemande()
	 {
	 	return $this->idDemande;
	 }
	 
	 public function setIdDemande($idDemande)
	 {
	 	$this->idDemande = $idDemande;
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
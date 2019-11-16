<?php

class DemandeProfil
{
	private $id;
	private $idDemande;
	private $idProfil;

	public function __construct(){}

	public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO demande_profil VALUES(null, ?, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdDemande(), PDO::PARAM_INT);
    	$statement->bindValue(2, $this->getIdProfil(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM demande_profil WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function findByIdDemande()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM demande_profil WHERE id_demande = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getIdDemande(), PDO::PARAM_INT);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $listDemandeProfil = [];
    	foreach ($result as $key=> $demandeProfilTemp)
    	{
    		$demandeProfil = new DemandeProfil();
    		$demandeProfil->setId($demandeProfilTemp->id);
    		$demandeProfil->setIdDemande($demandeProfilTemp->id_demande);
    		$demandeProfil->setIdProfil($demandeProfilTemp->id_profil);
    		$listDemandeProfil[] = $demandeProfil;
    	} 
    		   
    	return $listDemandeProfil;
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
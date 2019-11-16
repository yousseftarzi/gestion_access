<?php

class Groupe
{
	private $id;
	private $nom;

	public function __construct(){}

	public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO groupe VALUES(null, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getNom(), PDO::PARAM_STR);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM groupe WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function findAll()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM groupe";
    	$statement = $db->prepare($sql);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $listGroupe = [];
    	foreach ($result as $key=> $groupeTemp) {
            $groupe = new Groupe();
    		$groupe->setId($groupeTemp->id);
    		$groupe->setNom($groupeTemp->nom);
    		$listGroupe[] = $groupe;
    	}
    	return $listGroupe;
    }

    public function findById()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM groupe WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $groupe = new Groupe();
        foreach ($result as $key=> $groupeTemp)
        {
            $groupe->setId($groupeTemp->id);
            $groupe->setNom($groupeTemp->nom);
        } 
            
   
        return $groupe;
    }

    public function findByNom()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM groupe WHERE nom = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getNom(), PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $groupe = new Groupe();
        foreach ($result as $key=> $groupeTemp)
        {
            $groupe->setId($groupeTemp->id);
            $groupe->setNom($groupeTemp->nom);
        } 
            
   
        return $groupe;
    }



	public function getId()
	 {
	 	return $this->id;
	 }

	 public function setId($id)
	 {
	 	$this->id = $id;
	 }

	 public function getNom()
	 {
	 	return $this->nom;
	 }

	 public function setNom($nom)
	 {
	 	$this->nom = $nom;
	 }

}



?>
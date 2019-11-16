<?php

class Profil
{
	private $id;
	private $nom;

	public function __construct(){}

	public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO profil VALUES(null, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getNom(), PDO::PARAM_STR);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM profil WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function findAll()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM profil";
    	$statement = $db->prepare($sql);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);

        $listProfil = [];
    	foreach ($result as $key=> $profilTemp) {
            $profil = new Profil();
    		$profil->setId($profilTemp->id);
    		$profil->setNom($profilTemp->nom);
    		$listProfil[] = $profil;
    	}
    	return $listProfil;
    }

    public function findById()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM profil WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $profil = new Profil();
        foreach ($result as $key=> $profilTemp)
        {
            $profil->setId($profilTemp->id);
            $profil->setNom($profilTemp->nom);
        }


        return $profil;
    }

    public function findByNom()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM profil WHERE nom = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getNom(), PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $profil = new Profil();
        foreach ($result as $key=> $profilTemp)
        {
            $profil->setId($profilTemp->id);
            $profil->setNom($profilTemp->nom);
        }


        return $profil;
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

<?php
class Utilisateur
{
	private $id;
	private $matricule;
	private $login;
	private $password;
	private $nom;
	private $prenom;
	private $fonction;
	private $departement;
	private $emplacement;
	private $numTel;
	private $email;
	private $role;
	
	public function __construct(){}
    
    public function create()
    {
    	$db = Db::getInstance();
    	$sql = 'INSERT INTO utilisateur VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getMatricule(), PDO::PARAM_STR);
    	$statement->bindValue(2, $this->getLogin(), PDO::PARAM_STR);
    	$statement->bindValue(3, $this->getPassword(), PDO::PARAM_STR);
    	$statement->bindValue(4, $this->getNom(), PDO::PARAM_STR);
    	$statement->bindValue(5, $this->getPrenom(), PDO::PARAM_STR);
    	$statement->bindValue(6, $this->getFonction(), PDO::PARAM_STR);
    	$statement->bindValue(7, $this->getDepartement(), PDO::PARAM_STR);
    	$statement->bindValue(8, $this->getEmplacement(), PDO::PARAM_STR);
    	$statement->bindValue(9, $this->getNumTel(), PDO::PARAM_INT);
    	$statement->bindValue(10, $this->getEmail(), PDO::PARAM_STR);
    	$statement->bindValue(11, $this->getRole(), PDO::PARAM_STR);
    	return $statement->execute();
    }

    public function delete()
    {
    	$db = Db::getInstance();
    	$sql = "DELETE FROM utilisateur WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this, PDO::PARAM_INT);
    	return $statement->execute();
    }

    public function updateRole()
    {
    	$db = Db::getInstance();
    	$sql = "UPDATE utilisateur SET role=? WHERE id=?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getRole(), PDO::PARAM_STR);
    	$statement->bindValue(2, $this->getId(), PDO::PARAM_INT);
    	return $statement->execute();
    }


    public function findByLogin()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM utilisateur WHERE login = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getLogin(), PDO::PARAM_STR);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $user = new Utilisateur();
    	foreach ($result as $key=> $userTemp)
    	{ 
    		$user->setId($userTemp->id);
            $user->setNom($userTemp->nom);
            $user->setPrenom($userTemp->prenom);
            $user->setMatricule($userTemp->matricule);
            $user->setPassword($userTemp->password);
            $user->setLogin($userTemp->login);
            $user->setFonction($userTemp->fonction);
            $user->setDepartement($userTemp->departement);
            $user->setEmplacement($userTemp->emplacement);
            $user->setNumTel($userTemp->num_tel);
            $user->setEmail($userTemp->email);
            $user->setRole($userTemp->role);			
   		}
    	return $user;
    }


    public function findAllSuperieur()
    {
    	$db = Db::getInstance();
    	$sql = "SELECT * FROM utilisateur where role = ? ";
    	$statement = $db->prepare($sql);
    	$role = "superieur";
    	$statement->bindValue(1, $role , PDO::PARAM_STR);
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_OBJ);
          
        $listSuperieur = [];
    	foreach ($result as $key=> $superieurTemp) {
            $superieur = new Utilisateur();
    		$superieur->setId($superieurTemp->id);
    		$superieur->setNom($superieurTemp->nom);
    		$superieur->setPrenom($superieurTemp->prenom);
    		$listSuperieur[] = $superieur;
    	}
    	return $listSuperieur;
    }

    public function verifLogin()
    {

    	$db = Db::getInstance();
    	$sql = "SELECT * FROM utilisateur WHERE login = ? and password  = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getLogin(), PDO::PARAM_STR);
    	$statement->bindValue(2, $this->getPassword(), PDO::PARAM_STR);
    	$statement->execute();

   		if($statement->rowCount() > 0)
   			return true;
    	return false;
    }


   public function checkUserExist(){

   		$messageErreur = "";
   	    $db = Db::getInstance();
    	$sql = "SELECT * FROM utilisateur WHERE login = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getLogin(), PDO::PARAM_STR);
    	$statement->execute();

   		if($statement->rowCount() > 0)
   		{
   			$messageErreur = "Login Existant";
   			return $messageErreur;
   		}
    	
		$sql = "SELECT * FROM utilisateur WHERE email = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getEmail(), PDO::PARAM_STR);
    	$statement->execute();

   		if($statement->rowCount() > 0)
   		{
   			$messageErreur = "Email Existant";
   			return $messageErreur;
   		}
    	

    	$sql = "SELECT * FROM utilisateur WHERE matricule = ?";
    	$statement = $db->prepare($sql);
    	$statement->bindValue(1, $this->getMatricule(), PDO::PARAM_STR);
    	$statement->execute();

   		if($statement->rowCount() > 0)
   		{
   			$messageErreur = "Matricule Existant" ;
   			return  $messageErreur;
   		}

   		return $messageErreur;

   }


	public function getId()
	 {
	 	return $this->id;
	 }

	 public function setId($id)
	 {
	 	$this->id = $id;
	 }

	 public function getMatricule()
	 {
	 	return $this->matricule;
	 }

	 public function setMatricule($matricule)
	 {
	 	$this->matricule = $matricule;
	 }

	 public function getLogin()
	 {
	 	return $this->login;
	 }

	 public function setLogin($login)
	 {
	 	$this->login = $login;
	 }

	 public function getPassword()
	 {
	 	return $this->password;
	 }

	 public function setPassword($password)
	 {
	 	$this->password = $password;
	 }

	 public function getNom()
	 {
	 	return $this->nom;
	 }

	 public function setNom($nom)
	 {
	 	$this->nom = $nom;
	 }

	 public function getPrenom()
	 {
	 	return $this->prenom;
	 }

	 public function setPrenom($prenom)
	 {
	 	$this->prenom = $prenom;
	 }

	 public function getFonction()
	 {
	 	return $this->fonction;
	 }

	 public function setFonction($fonction)
	 {
	 	$this->fonction = $fonction;
	 }

	 public function getDepartement()
	 {
	 	return $this->departement;
	 }

	 public function setDepartement($departement)
	 {
	 	$this->departement = $departement;
	 }

	 public function getEmplacement()
	 {
	 	return $this->emplacement;
	 }

	 public function setEmplacement($emplacement)
	 {
	 	$this->emplacement = $emplacement;
	 }

	 public function getNumTel()
	 {
	 	return $this->numTel;
	 }

	 public function setNumTel($numTel)
	 {
	 	$this->numTel = $numTel;
	 }

	 public function getEmail()
	 {
	 	return $this->email;
	 }

	 public function setEmail($email)
	 {
	 	$this->email = $email;
	 }

	 public function getRole()
	 {
	 	return $this->role;
	 }

	 public function setRole($role)
	 {
	 	$this->role = $role;
	 }

}





?>
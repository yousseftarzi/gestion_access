
<?php

require_once('models/Utilisateur.php');

class Demande
{
    private $id;
    private $idUtilisateur;
    private $idSuperieur;
    private $dateEnvoi;
    private $etat; // en_cours ou acceptee ou refusee

    public function __construct()
    {
        $now = new DateTime(null, new DateTimeZone('Europe/London'));
        $this->dateEnvoi = $now->format('Y-m-d H:i:s');
        $this->etat = "en_cours";
    }

    public function create()
    {
        $db = Db::getInstance();
        $sql = "INSERT INTO demande VALUES(null, ?, ?, ?, ?)";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
        $statement->bindValue(2, $this->getIdSuperieur(), PDO::PARAM_INT);
        $statement->bindValue(3, $this->getDateEnvoi(), PDO::PARAM_STR);
        $statement->bindValue(4, $this->getEtat(), PDO::PARAM_STR);
        return $statement->execute();
    }

    public function delete()
    {
        $db = Db::getInstance();
        $sql = "DELETE FROM demande WHERE id=?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function findById()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM demande WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $demande = new Demande();
        foreach ($result as $key=> $demandeTemp) {
            $demande->setId($demandeTemp->id);
            $demande->setIdUtilisateur($demandeTemp->id_utilisateur);
            $demande->setIdSuperieur($demandeTemp->id_superieur);
            $demande->setDateEnvoi($demandeTemp->date_envoi);
            $demande->setEtat($demandeTemp->etat);
        }


        return $demande;
    }

    public function findByUserByDateEnvoi()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM demande WHERE id_utilisateur = ? and date_envoi = ? ";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
        $statement->bindValue(2, $this->getDateEnvoi(), PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $demande = new Demande();
        foreach ($result as $key=> $demandeTemp) {
            $demande->setId($demandeTemp->id);
            $demande->setIdUtilisateur($demandeTemp->id_utilisateur);
            $demande->setIdSuperieur($demandeTemp->id_superieur);
            $demande->setDateEnvoi($demandeTemp->date_envoi);
            $demande->setEtat($demandeTemp->etat);
        }

        return $demande;
    }

    //cette fonction retourne la list des demandes en état accepte ou en_cours
    public function findByUserByEtat()
    {
        $db = Db::getInstance();
        $sql= "SELECT * FROM demande WHERE id_utilisateur = ? and etat = ? ";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
        $statement->bindValue(2, "en_cours", PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $listDemande = [];
        foreach ($result as $key=> $demandeTemp) {
            $demande = new Demande();
            $demande->setId($demandeTemp->id);
            $demande->setIdUtilisateur($demandeTemp->id_utilisateur);
            $demande->setIdSuperieur($demandeTemp->id_superieur);
            $demande->setDateEnvoi($demandeTemp->date_envoi);
            $demande->setEtat($demandeTemp->etat);
            $listDemande[] = $demande;
        }
        return $listDemande;
    }

    //Retourne la liste des demandes encore non traitées pour le supérieur connécté
    public function findBySup()
    {
        $db = Db::getInstance();
        $sql= "SELECT * FROM demande WHERE id_superieur = ? and etat = ? ";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdSuperieur(), PDO::PARAM_INT);
        $statement->bindValue(2, "en_cours", PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $listDemande = [];
        foreach ($result as $key=> $demandeTemp) {
            $demande = new Demande();
            $demande->setId($demandeTemp->id);
            $demande->setIdUtilisateur($demandeTemp->id_utilisateur);
            $demande->setIdSuperieur($demandeTemp->id_superieur);
            $demande->setDateEnvoi($demandeTemp->date_envoi);
            $demande->setEtat($demandeTemp->etat);
            $listDemande[] = $demande;
        }
        return $listDemande;
    }

    public function findByIdUser()
    {
        $db = Db::getInstance();
        $sql= "SELECT * FROM demande WHERE id_utilisateur = ? ";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $listDemande = [];
        foreach ($result as $key=> $demandeTemp) {
            $demande = new Demande();
            $demande->setId($demandeTemp->id);
            $demande->setIdUtilisateur($demandeTemp->id_utilisateur);
            $demande->setIdSuperieur($demandeTemp->id_superieur);
            $demande->setDateEnvoi($demandeTemp->date_envoi);
            $demande->setEtat($demandeTemp->etat);
            $listDemande[] = $demande;
        }
        return $listDemande;
    }

    public function findUserById()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdUtilisateur(), PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $user = new Utilisateur();
        foreach ($result as $key=> $userTemp) {
            $user->setId($userTemp->id);
            $user->setNom($userTemp->nom);
            $user->setPrenom($userTemp->prenom);
            $user->setMatricule($userTemp->matricule);
            $user->setLogin($userTemp->login);
            $user->setFonction($userTemp->fonction);
            $user->setDepartement($userTemp->departement);
            $user->setEmplacement($userTemp->emplacement);
            $user->setNumTel($userTemp->num_tel);
        }

        return $user;
    }



    public function findSuperieurById()
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE id = ? and role = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getIdSuperieur(), PDO::PARAM_INT);
        $statement->bindValue(2, "superieur", PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $user = new Utilisateur();
        foreach ($result as $key=> $userTemp) {
            $user->setId($userTemp->id);
            $user->setNom($userTemp->nom);
            $user->setPrenom($userTemp->prenom);
            $user->setMatricule($userTemp->matricule);
            $user->setLogin($userTemp->login);
            $user->setFonction($userTemp->fonction);
            $user->setDepartement($userTemp->departement);
            $user->setEmplacement($userTemp->emplacement);
            $user->setEmail($userTemp->email);
            $user->setNumTel($userTemp->num_tel);
        }

        return $user;
    }
    public function updateEtat()
    {
        $db = Db::getInstance();
        $sql = "UPDATE demande SET etat=? WHERE id=?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->getEtat(), PDO::PARAM_STR);
        $statement->bindValue(2, $this->getId(), PDO::PARAM_INT);
        return $statement->execute();
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

    public function getIdSuperieur()
    {
        return $this->idSuperieur;
    }

    public function setIdSuperieur($idSuperieur)
    {
        $this->idSuperieur = $idSuperieur;
    }

    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }
}



?>

<?php

 namespace App\Model;

 use PDO;

class CreateUserManager extends AbstractManager
{
     /**
     * Name of the table in the database
     */
    public const TABLE = 'association';

    public function createUser(array $createuser)
    {
        $statement = '';
        if ($createuser['type'] === "association") {
            // Insertion des données dans la table Association
            $statement = $this->pdo->prepare(
                "INSERT INTO association (name, email, phone, password, description, address,dateCreate, type)  
            VALUES (:prenom, :email, :phone, :password, :description, :address, :date, :type)"
            );
        }
        if ($createuser['type'] === "particulier") {
            // Insertion des données dans la table Particulier
            $statement = $this->pdo->prepare(
                "INSERT INTO particulier (name, email, phone, password, description, address, type)  
            VALUES (:prenom, :email, :phone, :password, :description, :address, :type)"
            );
        }

        $password = md5($createuser['password']);

        $statement->bindValue(':prenom', $createuser['prenom'], PDO::PARAM_STR);
        $statement->bindValue(':email', $createuser['email'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $createuser['phone'], PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':description', $createuser['description'], PDO::PARAM_STR);
        $statement->bindValue(':address', $createuser['address'], PDO::PARAM_STR);
        $statement->bindValue(':type', $createuser['type'], PDO::PARAM_INT);
        if ($createuser['type'] === "association") {
            $statement->bindValue(':date', $createuser['date'], PDO::PARAM_STR);
        }
        $statement->execute();
    }

    public function createLogin(array $createuser): void
    {

        $statement = $this->pdo->prepare("INSERT INTO user (login, password) VALUES (:prenom, :password)");

        $password = md5($createuser['password']);

        $statement->bindValue(':prenom', $createuser['prenom'], PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);

        $statement->execute();
    }
}

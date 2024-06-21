<?php

class UserModel extends Model {

    protected $table = "utilisateur";

    public function findUser(string $email, string $password)
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();
        if (!empty($user)) {
            if (password_verify($password, $user->password)) {
                return $user;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function add(string $prenom, string $nom, string $email, string $password)
    {
        $query = $this->pdo->prepare("INSERT INTO $this->table VALUES(null, 1, :prenom, :nom, :email, :password)");
        $query->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function findAllLivreurs()
    {
        $query = $this->pdo->query("SELECT * FROM utilisateur WHERE id_role = 2");
        return $query->fetchAll();
    }

}
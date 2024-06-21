<?php

class PanierModel extends Model {
    protected $table = "panier";

    public function findByUser(int $id)
    {
        $query = $this->pdo->prepare("SELECT m.id, m.nom, m.prix, COUNT(id_menu) AS quantite FROM $this->table 
        JOIN menu AS m
        ON panier.id_menu = m.id
        WHERE id_utilisateur = :id
        GROUP BY(id_menu)");
        $query->execute(['id' => $id]);
        $panier = $query->fetchAll();
        return $panier;
    }

    public function add(int $id_utilisateur, int $id_menu)
    {
        $query = $this->pdo->prepare("INSERT INTO $this->table VALUES(:id_utilisateur, :id_menu)");
        $query->execute([
            'id_utilisateur' => $id_utilisateur,
            'id_menu' => $id_menu
        ]);
    }

    public function delete(int $id_utilisateur, int $id_menu)
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id_utilisateur = :id_utilisateur AND id_menu = :id_menu");
        $query->execute([
            'id_utilisateur' => $id_utilisateur,
            'id_menu' => $id_menu,
        ]);
    }

    public function reduce(int $id_utilisateur, int $id_menu)
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id_utilisateur = :id_utilisateur AND id_menu = :id_menu LIMIT 1");
        $query->execute([
            'id_utilisateur' => $id_utilisateur,
            'id_menu' => $id_menu,
        ]);
    }
    
    public function clear(int $id_utilisateur)
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id_utilisateur = :id_utilisateur");
        $query->execute(['id_utilisateur' => $id_utilisateur]);
    }
}
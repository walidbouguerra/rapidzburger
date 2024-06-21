<?php

class LivraisonModel extends Model {
    protected $table = "livraison";

    public function add(int $id_commande, int $id_livreur)
    {
        $query = $this->pdo->prepare("INSERT INTO $this->table VALUES(null, :id_livreur, :id_commande, default, null)");
        $query->execute([
            'id_livreur' => $id_livreur,
            "id_commande" => $id_commande
        ]);
    }

    public function findAllByLivreur(int $id)
    {
        $query = $this->pdo->prepare("SELECT *, livraison.id FROM livraison 
        JOIN commande ON commande.id = livraison.id_commande
        JOIN utilisateur ON utilisateur.id = commande.id_utilisateur 
        WHERE id_livreur = :id AND date_fin IS NULL");
        $query->execute(['id' => $id]);
        $livraisons = $query->fetchAll();

        foreach ($livraisons as $livraison) {
            $query = $this->pdo->prepare("SELECT nom, quantite FROM commande_menu 
            JOIN menu
            ON commande_menu.id_menu = menu.id
            WHERE id_commande = :id");
            $query->execute(['id' => $livraison->id_commande]);
            $livraison->menus = $query->fetchAll();
        }

        return $livraisons;
    }

    public function delivered(int $id)
    {
        $query = $this->pdo->prepare("UPDATE livraison SET date_fin = CURRENT_TIMESTAMP WHERE id = :id");
        $query->execute(['id' => $id]);
    }

}
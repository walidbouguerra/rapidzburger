<?php

class CommandeModel extends Model {

    protected $table = "commande";

    public function add(int $id_user, array $panier, float $prix, string $adresse, string $telephone)
    {
        $query = $this->pdo->prepare("INSERT INTO $this->table VALUES(null, :id_user, :prix, :adresse, :telephone, default)");
        $query->execute([
            'id_user' => $id_user,
            'prix' => $prix,
            'adresse' => $adresse,
            'telephone' => $telephone
        ]);
        $id_commande = $this->pdo->lastInsertId();

        foreach ($panier as $menu) {
            $query = $this->pdo->exec("INSERT INTO commande_menu VALUES($id_commande, $menu->id, $menu->quantite)");
        }
    }

    public function findAllByUser(int $id_user) {
        $query = $this->pdo->prepare("SELECT *, commande.id FROM $this->table JOIN utilisateur ON $this->table.id_utilisateur = utilisateur.id WHERE id_utilisateur = :id");
        $query->execute(['id' => $id_user]);
        $res = $query->fetchAll();
        $orders = [];
        $orders['livree'] = [];
        $orders['en_cours'] = [];
        $orders['en_attente'] = [];

        foreach ($res as $order) {
            $query = $this->pdo->prepare("SELECT nom, quantite FROM commande_menu 
            JOIN menu
            ON commande_menu.id_menu = menu.id
            WHERE id_commande = :id");
            $query->execute(['id' => $order->id]);
            $orderMenus = $query->fetchAll();
            $order->menus = $orderMenus;
            
            $query = $this->pdo->query("SELECT * FROM $this->table JOIN livraison ON commande.id = id_commande WHERE id_commande = $order->id");
            $livraison = $query->fetch();
            if ($livraison != null) {
                $query = $this->pdo->query("SELECT prenom, nom, date_fin FROM livraison JOIN utilisateur ON utilisateur.id = livraison.id_livreur WHERE livraison.id = $livraison->id");
                $livreur = $query->fetch();
                $order->livreur = $livreur;
                if ($livraison->date_fin != null) {
                    $orders['livree'][] = $order;
                } else {
                    $orders['en_cours'][]= $order;
                }
            } else {
                $orders['en_attente'][] = $order;
            }
        }
        return $orders;
    }

    public function findAll() {
        $query = $this->pdo->query("SELECT *, commande.id FROM $this->table JOIN utilisateur ON $this->table.id_utilisateur = utilisateur.id");
        $res = $query->fetchAll();
        $orders = [];
        $orders['livree'] = [];
        $orders['en_cours'] = [];
        $orders['en_attente'] = [];

        foreach ($res as $order) {
            $query = $this->pdo->prepare("SELECT nom, quantite FROM commande_menu 
            JOIN menu
            ON commande_menu.id_menu = menu.id
            WHERE id_commande = :id");
            $query->execute(['id' => $order->id]);
            $orderMenus = $query->fetchAll();
            $order->menus = $orderMenus;
            
            $query = $this->pdo->query("SELECT * FROM $this->table JOIN livraison ON commande.id = id_commande WHERE id_commande = $order->id");
            $livraison = $query->fetch();
            if ($livraison != null) {
                $query = $this->pdo->query("SELECT prenom, nom, date_fin FROM livraison JOIN utilisateur ON utilisateur.id = livraison.id_livreur WHERE livraison.id = $livraison->id");
                $livreur = $query->fetch();
                $order->livreur = $livreur;
                if ($livraison->date_fin != null) {
                    $orders['livree'][] = $order;
                } else {
                    $orders['en_cours'][]= $order;
                }
            } else {
                $orders['en_attente'][] = $order;
            }
        }
        return $orders;
    }

    public function deleteById(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM commande_menu WHERE id_commande = :id");
		$query->execute(['id' => $id]);

        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
		$query->execute(['id' => $id]);
    }

}
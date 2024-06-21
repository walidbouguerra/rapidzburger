<?php

class PanierController extends Controller {

    private $menuModel;
    private $panierModel;
    
    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->panierModel = new PanierModel();
    }

    // Page du panier
    public function index()
    {
        $total = $_SESSION['total'] ?? 0;
        $panier = $_SESSION['panier'] ?? [];
        $this->render('panier', compact('panier', 'total'));
    }

    // Page de paiement pour valider le panier
    public function checkout()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
            if (!empty($_SESSION['panier']) && !empty($_SESSION['total'])) {
                $total = $_SESSION['total'] ?? 0;
                $this->render('client/checkout', compact('total'));
            } else {
                header('Location: /');
            }
        } else {
            header('Location: /login');
        }
    }


    // Ajout d'un produit dans le panier
    public function add(int $id)
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
            $_SESSION['total'] = 0;
        }
        $menu = $this->menuModel->findById($id);
        if (isset($_SESSION['panier'][$menu->id])) {
            $_SESSION['panier'][$menu->id]->quantite++;
        } else {
            $_SESSION['panier'][$menu->id] = $menu;
            $_SESSION['panier'][$menu->id]->quantite = 1;
        }
        $_SESSION['total'] += $menu->prix;
        if (isset($_SESSION['user'])) {
            $this->panierModel->add($_SESSION['user'], $menu->id);
        }
        $this->index();
    }
    
    // Diminution de la quantité d'un produit dans le panier
    public function reduce(int $id)
    {
        $_SESSION['panier'][$id]->quantite--;
        $_SESSION['total'] -= $_SESSION['panier'][$id]->prix;
        if($_SESSION['panier'][$id]->quantite < 1) {
            $this->panierModel->delete($_SESSION['user'], $_SESSION['panier'][$id]->id);
            unset($_SESSION['panier'][$id]);
        } else {
            if (isset($_SESSION['user'])) {
                $this->panierModel->reduce($_SESSION['user'], $_SESSION['panier'][$id]->id);
            }
        }
        $this->index();
    }

    // Suppression d'un produit dans le panier
    public function delete(int $id)
    {
        $_SESSION['total'] -= ($_SESSION['panier'][$id]->prix * $_SESSION['panier'][$id]->quantite);
        if (isset($_SESSION['user'])) {
            $this->panierModel->delete($_SESSION['user'], $_SESSION['panier'][$id]->id);
        }
        unset($_SESSION['panier'][$id]);
        $this->index();
    }
}
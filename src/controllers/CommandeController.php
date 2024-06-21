<?php

class CommandeController extends Controller {
    private $commandeModel;
    private $panierModel;
    private $livraisonModel;

    public function __construct()
    {
        $this->commandeModel = new CommandeModel();
        $this->panierModel = new PanierModel();
        $this->livraisonModel = new LivraisonModel();
    }

    public function add()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
            if (!empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['cb'])) {
    
                $adresse = htmlspecialchars($_POST['adresse']);
                $telephone = htmlspecialchars($_POST['telephone']);
                $cb = htmlspecialchars($_POST['cb']);
                
                $id_user = $_SESSION['user'];
                $panier = $_SESSION['panier'];
                $prix = $_SESSION['total'];
             
                $this->commandeModel->add($id_user, $panier, $prix, $adresse, $telephone);
                $this->panierModel->clear($id_user);
                unset($_SESSION['panier']);
                unset($_SESSION['total']);
                header('Location: /client');
            } else {
                $_SESSION['errors'][] = "Veuillez remplir tous les champs de livraison et de paiement !";
                $total = $_SESSION['total'] ?? 0;
                $this->render('client/checkout', compact('total'));
            }
        } else {
            header('Location: /user/logout');
        }
            
    }

    public function delete(int $id)
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            $this->commandeModel->deleteById($id);
            header('Location: /admin');
        } else {
            header('Location: /user/logout');
        }
    }

    public function confirm(int $id_commande)
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            if (!empty($_POST['id_livreur'])) {
                $id_livreur = htmlspecialchars($_POST['id_livreur']);
                $this->livraisonModel->add($id_commande, $id_livreur);
            } else {
                $_SESSION['errors'][] = "Veuillez selectionner un livreur !";
            }
            header('Location: /admin');
        } else {
            header('Location: /user/logout');
        }
    }
}
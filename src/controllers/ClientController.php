<?php

class ClientController extends Controller {
    private $userModel;
    private $panierModel;
    private $commandeModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->panierModel = new PanierModel();
        $this->commandeModel = new CommandeModel();
    }

    // Inscription d'un client
    public function add()
    {
        if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $this->userModel->add($prenom, $nom, $email, $password);

        } else {
            $_SESSION['errors'][] = "Veuillez remplir tous les champs d'inscription !";
            $this->render('register');
        }
    }
    
    // Sauvegarde du panier session dans la base de données
    public function save()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
            if (isset($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $menu) {
                    for ($i=0; $i < $menu->quantite; $i++) { 
                        $this->panierModel->add($_SESSION['user'], $menu->id);
                    }
                }
            }

            $panier = $this->panierModel->findByUser($_SESSION['user']);
            $_SESSION['total'] = 0;

            foreach ($panier as $menu) {
                $_SESSION['panier'][$menu->id] = $menu;
                $_SESSION['total'] += ($menu->prix * $menu->quantite);
            }
            header('Location: /client');
        } else {
            header('Location: /');
        }
    }

       // Page des commandes d'un client
       public function index()
       {
           if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
               $commandes = $this->commandeModel->findAllByUser($_SESSION['user']);
               $this->render('client/commandes', compact('commandes'));
           } else {
               header('Location: /');
           }
       }


}
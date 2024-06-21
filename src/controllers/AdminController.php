<?php

class AdminController extends Controller {

    private $commandeModel;
    private $menuModel;
    private $userModel;

    public function __construct()
    {
        $this->commandeModel = new commandeModel();
        $this->menuModel = new MenuModel();
        $this->userModel = new UserModel();
    }

    // Page de gestions des commandes
    public function index()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            $commandes = $this->commandeModel->findAll();
            $livreurs = $this->userModel->findAllLivreurs();
            $this->render('admin/commandes', compact('commandes', 'livreurs'));
        } else {
            $this->userModel->logout();
        }
    }

    // Page de gestions des menus
    public function menus()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            $menus = $this->menuModel->findAll();
            $this->render('admin/menus', compact('menus'));
        } else {
            $this->userModel->logout();
        }
    }

    // Formulaire d'ajout de menu
    public function addmenu()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            $this->render('admin/addmenu');
        } else {
            $this->userModel->logout();
        }
    }

    // Formulaire de modification de menu
    public function updatemenu(int $id_menu)
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            $menu = $this->menuModel->findById($id_menu);
            $this->render('admin/updatemenu', compact('menu'));
        } else {
            $this->userModel->logout();
        }
    }
}
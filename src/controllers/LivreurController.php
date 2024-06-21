<?php

class LivreurController extends Controller {

    private $livraisonModel;

    public function __construct()
    {
        $this->livraisonModel = new LivraisonModel();
    }

    public function index()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2) {
            $id = $_SESSION['user'];

            $livraisons = $this->livraisonModel->findAllByLivreur($id);
            $this->render('livreur/livraisons', compact('livraisons'));
        } else {

        }
    }
}
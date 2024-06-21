<?php 

class UserController extends Controller {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Page de connexion
    public function login()
    {
        $this->render('login');
    }

    // Page d'inscription
    public function register()
    {
        $this->render('register');
    }

    // Vérification de l'auhentification
    public function verify()
    {
        $errors = [];
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $user = $this->userModel->findUser($email, $password);

            if(!empty($user)) {
                $_SESSION['user'] = $user->id;
                $_SESSION['user_role'] = $user->id_role;
                if ($_SESSION['user_role'] == 1) {
                    header('Location: /client/save');
                } else if ($_SESSION['user_role'] == 2) {
                    header('Location: /livreur');
                } else if ($_SESSION['user_role'] == 3) {
                    header('Location: /admin');
                }
            } else {
                $_SESSION['errors'][] = 'Email ou mot de passe incorrect(s) !';
                $this->render('login');
            }
        } else {
            $_SESSION['errors'][] = 'Veuillez remplir tous les champs de connexion !';
            $this->render('login');
        }
    }

    // Déconnexion d'un utilisateur
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
    }
 
}
<?php

class MenuController extends Controller {

    private $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    // Page d'accueil
    public function index()
    {
        $menus = $this->menuModel->findAll();
        $this->render('home', compact('menus'));
    }

    public function add()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            if (isset($_POST['submit'])) {
                $fileName = $_FILES['image']['name'];
                $fileTempName = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                $fileError = $_FILES['image']['error'];
                $fileType = $_FILES['image']['type'];

                $newFileName = str_replace(" ", "-", strtolower($_POST['nom']));

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
                
                if (in_array($fileActualExt, $allowedExt)) {
                    if ($fileError === 0) {
                        if ($fileSize < 50000) {
                            $newFileName.= '.' . $fileActualExt;
                            $fileDestination = 'img/' . $newFileName;
                            move_uploaded_file($fileTempName, $fileDestination);

                            $nom = htmlspecialchars($_POST['nom']);
                            $prix = htmlspecialchars($_POST['prix']);
                            $description = htmlspecialchars($_POST['description']);
                            $this->menuModel->add($nom, $prix, $description, $newFileName);
                            header('Location: /admin/menus');
                        } else {
                            echo "Fichier trop volumineux !";
                        }
                    } else {
                        echo "Erreur de téléchargement du fichier !";
                    }
                } else {
                    echo "Vous ne pouvez pas charger des fichiers de ce type !";
                }
                
            }
        } else {
            header('Location: /');
        }
    }

    public function update(int $id)
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            if (isset($_POST['submit'])) {
                $menu = $this->menuModel->findById($id);
                unlink('img/' . $menu->image);
                $fileName = $_FILES['image']['name'];
                $fileTempName = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                $fileError = $_FILES['image']['error'];
                $fileType = $_FILES['image']['type'];

                $newFileName = str_replace(" ", "-", strtolower($_POST['nom']));

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
                
                if (in_array($fileActualExt, $allowedExt)) {
                    if ($fileError === 0) {
                        if ($fileSize < 50000) {
                            $newFileName.= '.' . $fileActualExt;
                            $fileDestination = 'img/' . $newFileName;
                            move_uploaded_file($fileTempName, $fileDestination);

                            $nom = htmlspecialchars($_POST['nom']);
                            $prix = htmlspecialchars($_POST['prix']);
                            $description = htmlspecialchars($_POST['description']);
                            $this->menuModel->update($id, $nom, $prix, $description, $newFileName);
                            header('Location: /admin/menus');
                        } else {
                            echo "Fichier trop volumineux !";
                        }
                    } else {
                        echo "Erreur de téléchargement du fichier !";
                    }
                } else {
                    echo "Vous ne pouvez pas charger des fichiers de ce type !";
                }
                
            }
        } else {
            header('Location: /');
        }
    }

    public function delete(int $id)
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 3) {
            $menu = $this->menuModel->findById($id);
            unlink('img/' . $menu->image);
            $this->menuModel->deleteById($id);
            header('Location: /admin/menus');
        } else {
            header('Location: /');
        }
    }   
}
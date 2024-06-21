<?php

class Controller
{
    public function render($view, $data = [])
    {
        $nav = $this->navbarRender();
        
        ob_start();

        extract($data);

        include '../src/views/' . $view . '.php';

        $contenu = ob_get_clean();

        include '../src/views/layouts/default.php';
    }

    public function navbarRender()
    {
        $navPath = "";

        if (isset($_SESSION['user_role'])) {
            switch ($_SESSION['user_role']) {
                case 1:
                    $navPath = "client";
                    break;
                case 2:
                    $navPath = "livreur";
                    break;
                case 3:
                    $navPath = "admin";
                    break;
                
                default:
                    $navPath = "default";
                    break;
            }
        } else {
            $navPath = "default";
        }

        ob_start();

        include '../src/views/layouts/nav/' . $navPath . '.php';

        return ob_get_clean();
    }

}
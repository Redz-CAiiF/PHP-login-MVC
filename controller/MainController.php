<?php

class MainController
{
    public function route(){
        if(isset($_GET['controller'])){
            $controller = $_GET['controller'];
        }else{
            $controller = 'HomeController'; //default
        }

        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'visualizza'; //default
        }

        require_once './controller/'.$controller.'.php';

        $controller = new $controller();
        $controller->$action();
    }
}

?>
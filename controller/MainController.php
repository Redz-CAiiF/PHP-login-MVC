<?php

class MainController
{
    public function route(){
        if(isset($_GET['controller'])){
            $controller = $_GET['controller'];
        }else{
            $controller = 'LoginController'; //default
        }

        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'loadPage'; //default
        }

        include_once './controller/'.$controller.'.php';

        $controller = new $controller();
        $controller->$action("");
    }
}

?>
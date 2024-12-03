<?php

use App\Core\Router;

class App{
    public function run(){
        require "../routes/web.php";

        $path = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        Router::route($_SERVER['REQUEST_METHOD'], $path);
    }
}
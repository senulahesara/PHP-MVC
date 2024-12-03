<?php

use App\Controllers\HomeController;
use App\Core\Router;

Router::get('/404', function(){
    require '404.php';
});

Router::get('/', [new HomeController, "index"]);

// Router::pathNotFound(function ($path) {
//     http_response_code(404);
//     require('404.php');
// });
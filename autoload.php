<?php

foreach (glob("../config/*.php") as $filename) {
    require $filename;
}

foreach (glob("../core/*.php") as $filename) {
    require $filename;
}

spl_autoload_register(function ($class) {
    $file = "../" . str_replace('\\', '/', $class) . '.php';

    if(file_exists($file)){
        require $file;
    }
});

$app = new App;
$app->run();

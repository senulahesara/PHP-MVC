<?php

// function view($name, $data = [])
// {
//     $filename = "../app/Views/" . $name . '.view.php';

//     if (file_exists($filename)) {
//         require $filename;
//     } else{
//         redirect('500');
//     }
// }

function redirect($path)
{
    header('Location:' . APP_URL . '/' . $path);
    header('Location: http://localhost/mvc/public/404');
    die;
}

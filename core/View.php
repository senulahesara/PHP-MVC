<?php

namespace App\Core;

class View
{
    public static function render($name, $data = [])
    {
        $filename = "../app/Views/" . $name . '.view.php';

        if (file_exists($filename)) {
            if (!empty($data))
                extract($data);
            require $filename;
        } else {
            redirect('500');
        }
    }
}

<?php

namespace App\Core;

use BadMethodCallException;

abstract class Controller
{
    public function __call($name, $arguments)
    {
        throw new BadMethodCallException(sprintf(
            'Method "%s" is not implemented in class "%s".',
            $name,
            get_class(($this))
        ));
    }
}

<?php

namespace App\Core\Filtros;

class Filtro
{
    public function __call(string $name, array $arguments)
    {
        if (substr_count($name, 'has', 0, 3) != 0)
        {
            $attribute = lcfirst(str_replace('has', '', $name));

            return isset($this->{$attribute}) ;
        }
    }
}

<?php

namespace Bulletproof\Crud\app\config;

class View
{
    public static function render(string $view , $model){
        require __DIR__ . '/../views/' . $view . '.php';
    }
}

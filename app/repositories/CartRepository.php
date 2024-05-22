<?php

namespace repositories;

use Bulletproof\Crud\app\models\Cart;

interface CartRepository
{

//    All User
    function add(Cart $cart) : void;
    function update(int $id , Cart $cart) : void;
    function delete(int $id) : void;
    function all() : array;

}
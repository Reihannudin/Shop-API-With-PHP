<?php

namespace repositories;

use Bulletproof\Crud\app\models\Cart;
use Bulletproof\Crud\app\models\Wishlist;

interface WishlistRepository
{
    function add(Wishlist $wishlist) : void;

    function delete(int $id) : void;

    function all() : array;
}
<?php

namespace repositories;

use Bulletproof\Crud\app\models\Product;
use Bulletproof\Crud\app\models\Shop;

interface ShopRepository
{

//  Shop
    function create(Shop $shop) : void;
    function update(Shop $shop) : void;
    function myShop() : array;
//    All User
    function show(int $id) : array;
    function all() : array;
}
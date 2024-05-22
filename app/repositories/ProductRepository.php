<?php

namespace repositories;

require_once __DIR__ .  '/../models/Product.php';

use Bulletproof\Crud\app\models\Product;

interface ProductRepository
{

//  Shop
    function create(Product $product) : void;
    function update( int $id, Product $product) : void;
    function delete(int $id) : void;
    function show(int $id) : array;
    function all() : array;

}
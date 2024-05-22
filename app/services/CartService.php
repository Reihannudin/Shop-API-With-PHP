<?php

namespace Bulletproof\Crud\services;

interface CartService
{

    function add( int $quantity , int $total , int $productId , int $shopId) : void;
    function update(int $id, int $quantity , int $total  ) : void;
    function delete(int $id) : void;
    function all() : array;
}
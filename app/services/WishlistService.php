<?php

namespace Bulletproof\Crud\services;

interface WishlistService
{
    function add(int $productId , int $userId , int $shopId ) : void;
    function delete(int $id ) : void ;
    function all() : array;
}
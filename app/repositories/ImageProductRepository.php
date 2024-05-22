<?php

namespace Bulletproof\Crud\repositories;

require_once __DIR__ .  '/../models/ImageProduct.php';

use Bulletproof\Crud\models\ImageProduct;

interface ImageProductRepository
{

//  Shop
    function create(ImageProduct $imageProduct) : void;
    function update( int $id, ImageProduct $imageProduct) : void;
    function delete(int $id) : void;
    function show(int $id) : array;
    function all() : array;

}
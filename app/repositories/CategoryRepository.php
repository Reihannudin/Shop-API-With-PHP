<?php

namespace repositories;

use Bulletproof\Crud\app\models\Address;
use Bulletproof\Crud\app\models\Category;

interface CategoryRepository
{

//    Admin
    function create(Category $category) : void;
    function update( int $id, Category $category) : void;
    function delete(int $id) : void;

//    All User
    function show(int $id) : array;
    function all() : array;

}
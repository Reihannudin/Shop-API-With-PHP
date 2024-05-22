<?php

namespace Bulletproof\Crud\app\repository;


use Bulletproof\Crud\app\models\Address;

interface AddressRepository
{

//    All User
    function create(Address $address) : void;
    function update( int $id, Address $address) : void;
    function delete(int $id) : void;
    function show(int $id) : array;
    function all() : array;
}
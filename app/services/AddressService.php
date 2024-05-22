<?php

namespace Bulletproof\Crud\services;

interface AddressService
{

    function create(string $name , string $contact , string $address , string $location , string $codePos , string $maps) : void;
    function update( int $id, string $name , string $contact , string $address , string $location , string $codePos , string $maps) : void;
    function delete(int $id) : void;
    function show(int $id) : array;
    function all() : array;

}
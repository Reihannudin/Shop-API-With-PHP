<?php

namespace Bulletproof\Crud\app\service;

interface UserService
{
    function register(string $email , string $name , string  $password , string $contact ,string $address) : void;
    function login(string $email , string $password) : void;
    function update(string $name , string $contact ,string $address) : void;
    function topUp(int $balance ) : void;
    function logout() : void;
    function show() : array;
}


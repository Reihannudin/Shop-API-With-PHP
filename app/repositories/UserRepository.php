<?php

namespace repositories;


require_once __DIR__ . '/../models/User.php';

use Bulletproof\Crud\app\models\User;

interface UserRepository
{
//    All User
    function register(User $user) : void;
    function login(User $user) : void;
    function logout() : void;
    function show() : array;
    function update(User $user) : void;
    function topUp(User $user) : void;

}




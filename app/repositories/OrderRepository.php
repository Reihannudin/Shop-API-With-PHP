<?php

namespace repositories;

use Bulletproof\Crud\app\models\Order;

interface OrderRepository
{

    function order(Order $order) : void;

    function show(int $id) : array;

    function all() : array;


}
<?php

namespace Bulletproof\Crud\services;

interface OrderService
{
    function order(int $total , string $date , string $status, array $products ,  int $addressId , int $voucherId , int $paymentId , int $shipmentId) : void;

    function show(int $id) : array;

    function all() : array;

}
<?php

namespace repositories;

use Bulletproof\Crud\app\models\Product;
use Bulletproof\Crud\app\models\Voucher;

interface VoucherRepository
{

//    Shop
    function create(Voucher $voucher) : void;
    function update( int $id, Voucher $voucher) : void;
    function delete(int $id) : void;

//    All User
    function show(int $id) : array;
    function all() : array;
}
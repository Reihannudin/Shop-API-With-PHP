<?php

namespace Bulletproof\Crud\services;

interface VoucherService
{
    function create(string $name , string $disc  , string $code , string $start , string $end , int $productId): void;
    function update(int $id ,string $name , string $disc  , string $code  , string $start , string $end , int $productId): void;
    function delete(int $id): void;
    function show(int $id): array;
    function all(): array;
}
<?php

namespace Bulletproof\Crud\services;

interface ShopService
{
    function create(string $name , string $image , string $description , string $address , string $type , string $location ): void;
    function update(string $name , string $image , string $description , string $address , string $type , string $location ): void;
    function myShop(): array;
    function show(int $id): array;
    function all(): array;
}
<?php

namespace Bulletproof\Crud\services;

interface ImageProductService
{
    function create( string $image ,string $name , int $productId , int $shopId ): void;
    function update(int $id ,  string $image ,string $name , int $productId , int $shopId): void;
    function delete(int $id): void;
    function show(int $id): array;
    function all(): array;
}
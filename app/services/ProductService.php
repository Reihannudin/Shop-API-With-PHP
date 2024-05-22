<?php

namespace Bulletproof\Crud\app\service;

interface ProductService
{

    function create(string $name , string $image , string $description , int $quantity , int $price , int $categoryId): void;
    function update(int $id , string $name , string $image , string $description , int $quantity , int $price , int $categoryId): void;
    function delete(int $id): void;
    function show(int $id): array;
    function all(): array;

}
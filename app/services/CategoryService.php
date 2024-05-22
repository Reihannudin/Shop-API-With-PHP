<?php

namespace Bulletproof\Crud\services;

interface CategoryService
{
    function create( string $name ): void;
    function update(int $id , string $name): void;
    function delete(int $id): void;
    function show(int $id): array;
    function all(): array;
}
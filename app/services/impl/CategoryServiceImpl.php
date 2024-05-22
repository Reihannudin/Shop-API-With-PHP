<?php

namespace Bulletproof\Crud\services\impl;

require_once __DIR__ . '/../CategoryService.php';
require_once __DIR__ . '/../../repositories/CategoryRepository.php';
require_once __DIR__ . '/../../models/Category.php';

use Bulletproof\Crud\app\models\Category;
use Bulletproof\Crud\services\CategoryService;
use repositories\CategoryRepository;

class CategoryServiceImpl implements CategoryService
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    function create(string $name): void
    {
        // TODO: Implement create() method.
        $data = new Category();
        $data->setName($name);
        $this->categoryRepository->create($data);
    }

    function update(int $id, string $name): void
    {
        // TODO: Implement update() method.
        $data = new Category();
        $data->setName($name);
        $this->categoryRepository->update($id , $data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->categoryRepository->delete($id);
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->categoryRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->categoryRepository->all();
    }
}
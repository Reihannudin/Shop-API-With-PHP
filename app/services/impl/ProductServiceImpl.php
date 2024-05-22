<?php

namespace Bulletproof\Crud\app\service\impl;

use Bulletproof\Crud\app\models\Product;
use Bulletproof\Crud\app\service\ProductService;
use repositories\ProductRepository;

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../ProductService.php';
require_once __DIR__ . '/../../repositories/ProductRepository.php';



class ProductServiceImpl implements ProductService
{

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    function create(string $name, string $image, string $description, int $quantity, int $price , int $categoryId): void
    {
        // TODO: Implement create() method.
        $data = new Product();
        $data->setName($name);
        $data->setImage($image);
        $data->setDescription($description);
        $data->setQuantity($quantity);
        $data->setPrice($price);
        $data->setCategoryId($categoryId);
        $this->productRepository->create($data);
    }

    function update(int $id, string $name, string $image, string $description, int $quantity, int $price , int $categoryId): void
    {
        // TODO: Implement update() method.
        $data = new Product();
        $data->setName($name);
        $data->setImage($image);
        $data->setDescription($description);
        $data->setQuantity($quantity);
        $data->setPrice($price);
        $data->setCategoryId($categoryId);
        $this->productRepository->update($id ,$data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->productRepository->delete($id);
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->productRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->productRepository->all();
    }
}
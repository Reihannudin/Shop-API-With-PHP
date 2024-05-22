<?php

namespace Bulletproof\Crud\services\impl;

use Bulletproof\Crud\models\ImageProduct;
use Bulletproof\Crud\repositories\ImageProductRepository;
use Bulletproof\Crud\services\ImageProductService;

require_once __DIR__ . '/../ImageProductService.php';
require_once __DIR__ . '/../../repositories/ImageProductRepository.php';
require_once __DIR__ . '/../../models/ImageProduct.php';

class ImageProductServiceImpl implements ImageProductService
{

    private $imageProductRepository;

    public function __construct(ImageProductRepository $imageProductRepository)
    {
        $this->imageProductRepository = $imageProductRepository;
    }

    function create(string $image, string $name, int $productId, int $shopId): void
    {
        // TODO: Implement create() method.
        $data = new ImageProduct();
        $data->setImage($image);
        $data->setName($name);
        $data->setProductId($productId);
        $data->setShopId($shopId);
        $this->imageProductRepository->create($data);
    }

    function update(int $id, string $image, string $name, int $productId, int $shopId): void
    {
        // TODO: Implement update() method.
        $data = new ImageProduct();
        $data->setImage($image);
        $data->setName($name);
        $data->setProductId($productId);
        $data->setShopId($shopId);
        $this->imageProductRepository->update($id , $data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->imageProductRepository->delete($id);
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->imageProductRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->imageProductRepository->all();
    }
}
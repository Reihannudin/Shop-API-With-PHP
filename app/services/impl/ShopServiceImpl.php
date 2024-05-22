<?php

namespace Bulletproof\Crud\services\impl;

require_once __DIR__ . '/../ShopService.php';
require_once __DIR__ . '/../../repositories/ShopRepository.php';
require_once __DIR__ . '/../../models/Shop.php';

use Bulletproof\Crud\app\models\Shop;
use Bulletproof\Crud\services\ShopService;
use repositories\ShopRepository;

class ShopServiceImpl implements ShopService
{

    private $shopRepository;

    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    function create(string $name, string $image, string $description, string $address, string $type, string $location): void
    {
        // TODO: Implement create() method.
        $data = new Shop();
        $data->setName($name);
        $data->setImage($image);
        $data->setDescription($description);
        $data->setAddress($address);
        $data->setType($type);
        $data->setLocation($location);
        $this->shopRepository->create($data);
    }

    function update(string $name, string $image, string $description, string $address, string $type, string $location): void
    {
        // TODO: Implement update() method.
        $data = new Shop();
        $data->setName($name);
        $data->setImage($image);
        $data->setDescription($description);
        $data->setAddress($address);
        $data->setType($type);
        $data->setLocation($location);
        $this->shopRepository->update($data);
    }


    function myShop(): array
    {
        // TODO: Implement myShop() method.
        return $this->shopRepository->myShop();
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->shopRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->shopRepository->all();
    }
}
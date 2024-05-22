<?php

namespace Bulletproof\Crud\services\impl;

require_once __DIR__ . '/../CartService.php';
require_once __DIR__ . '/../../repositories/CartRepository.php';
require_once __DIR__ . '/../../models/Cart.php';

use Bulletproof\Crud\app\models\Cart;
use Bulletproof\Crud\services\CartService;
use repositories\CartRepository;

class CartServiceImpl implements CartService
{
    private $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    function add(int $quantity, int $total, int $productId,  int $shopId): void
    {
        // TODO: Implement add() method.
        $data = new Cart();
        $data->setQuantity($quantity);
        $data->setTotal($total);
        $data->setProductId($productId);
        $data->setShopId($shopId);
        $this->cartRepository->add($data);
    }

    function update(int $id, int $quantity, int $total): void
    {
        // TODO: Implement update() method.
        $data = new Cart();
        $data->setQuantity($quantity);
        $data->setTotal($total);
        $this->cartRepository->update($id , $data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->cartRepository->delete($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->cartRepository->all();
    }
}
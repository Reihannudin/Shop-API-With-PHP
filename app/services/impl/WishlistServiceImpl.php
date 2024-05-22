<?php

namespace Bulletproof\Crud\services\impl;

require_once __DIR__ . '/../WishlistService.php';
require_once __DIR__ . '/../../repositories/WishlistRepository.php';
require_once __DIR__ . '/../../models/Wishlist.php';

use Bulletproof\Crud\app\models\Wishlist;
use Bulletproof\Crud\services\WishlistService;
use repositories\WishlistRepository;

class WishlistServiceImpl implements WishlistService
{

    private $wishlistRepository;

    public function __construct(WishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    function add(int $productId, int $userId, int $shopId): void
    {
        // TODO: Implement add() method.
        $data = new Wishlist();
        $data->setProductId($productId);
        $data->setUserId($userId);
        $data->setShopId($shopId);
        $this->wishlistRepository->add($data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->wishlistRepository->delete($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->wishlistRepository->all();
    }
}
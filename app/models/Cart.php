<?php

namespace Bulletproof\Crud\app\models;

class Cart
{
    private int $id;
    private int $quantity;
    private int $productId;
    private int $userId;
    private int $total;
    private int $shopId;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getShopId(): int
    {
        return $this->shopId;
    }

    public function setShopId(int $shopId): void
    {
        $this->shopId = $shopId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }




    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }


}
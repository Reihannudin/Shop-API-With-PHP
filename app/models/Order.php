<?php

namespace Bulletproof\Crud\app\models;

class Order
{

    private int $id;
    private int $invoice;
    private array $products;
    private int $total;
    private string $date;
    private string $status;
    private int $shipmentId;
    private int $paymentId;
    private int $voucherId;
    private int $addressId;
    private int $userId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getInvoice(): int
    {
        return $this->invoice;
    }

    public function setInvoice(int $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getShipmentId(): int
    {
        return $this->shipmentId;
    }

    public function setShipmentId(int $shipmentId): void
    {
        $this->shipmentId = $shipmentId;
    }

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getVoucherId(): int
    {
        return $this->voucherId;
    }

    public function setVoucherId(int $voucherId): void
    {
        $this->voucherId = $voucherId;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

}
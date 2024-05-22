<?php

namespace Bulletproof\Crud\services\impl;

require_once __DIR__ . '/../OrderService.php';
require_once __DIR__ . '/../../repositories/OrderRepository.php';
require_once __DIR__ . '/../../models/Order.php';


use Bulletproof\Crud\app\models\Order;
use Bulletproof\Crud\services\OrderService;
use repositories\OrderRepository;

class OrderServiceImpl implements  OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    function order(int $total, string $date  , string $status , array $products  ,int $addressId, int $voucherId, int $paymentId, int $shipmentId): void
    {
        // TODO: Implement order() method.
        $data = new Order();
        $data->setTotal($total);
        $data->setDate($date);
        $data->setStatus($date);
        $data->setProducts($products);
        $data->setAddressId($addressId);
        $data->setVoucherId($voucherId);
        $data->setPaymentId($paymentId);
        $data->setShipmentId($shipmentId);
        $this->orderRepository->order($data);
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->orderRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->orderRepository->all();
    }
}
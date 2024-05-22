<?php

namespace Bulletproof\Crud\repositories\impl;

require_once __DIR__ . '/../../models/Order.php';
require_once __DIR__ . '/../OrderRepository.php';


use Bulletproof\Crud\app\models\Order;
use repositories\OrderRepository;

class OrderRepositoryImpl implements OrderRepository
{
    private $connection;
    private $user;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    private function startSession(){
        if (session_start() === PHP_SESSION_NONE){
            session_start();
        }
    }

    private function isLogin() : bool{
        $this->startSession();
        $userId = $_SESSION['user_id'];
        if (empty($userId)){
            echo "You dont have session";
            return false;
        }

        $sqlUser = $this->connection->prepare('select * from users where id = ?');
        $sqlUser->execute([$userId]);
        $this->user = $sqlUser->fetch(\PDO::FETCH_ASSOC);
        if (!$this->user){
            echo "User invalid";
            return false;
        }

        return true;
    }

    function order(Order $order): void
    {
        // TODO: Implement order() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql = $this->connection->prepare(
                'INSERT INTO orders (invoice, total, date, status, address_id, voucher_id, payment_id, shipment_id, user_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );

            $sql->execute([
                "Inv239nhrd",
                $order->getTotal(),
                $order->getDate(),
                $order->getStatus(),
                $order->getAddressId(),
                $order->getVoucherId(),
                $order->getPaymentId(),
                $order->getShipmentId(),
                $this->user['id'],
            ]);

            $orderId = $this->connection->lastInsertId();
            $products = $order->getProducts();
            foreach ($products as $product) {
                $sqlProduct = $this->connection->prepare(
                    'INSERT INTO pivot_product_orders (name, quantity, total, price, order_id, user_id, shop_id, product_id) 
                    VALUES (?, ?, ?, ?, ?, ? , ? , ?)'
                );
                $sqlProduct->execute([
                    $product['name'],
                    $product['quantity'],
                    $product['total'],
                    $product['price'],
                    $orderId,
                    $this->user['id'],
                    $product['shop_id'],
                    $product['product_id']
                ]);
            }

            echo "Success create order";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        if (!$this->isLogin()){
            return[];
        }
        try {
            $sql =  $this->connection->prepare('select * from orders where id =  ? and user_id = ?');
            $sql->execute([$id , $this->user['id']]);
            $data = $sql->fetch(\PDO::FETCH_ASSOC);

            if (!$data){
                return[];
            }

            return $data;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return [];
        }
    }

    function all(): array
    {
        // TODO: Implement all() method.
        if (!$this->isLogin()){
            return[];
        }
        try {
            $sql =  $this->connection->prepare('select * from orders where user_id = ?');
            $sql->execute([$this->user['id']]);
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);

            if (!$data){
                return[];
            }

            return $data;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return [];
        }
    }
}
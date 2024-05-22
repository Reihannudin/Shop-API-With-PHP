<?php

namespace Bulletproof\Crud\repositories\impl;

require_once __DIR__ . '/../../models/Cart.php';
require_once __DIR__ . '/../CartRepository.php';



use Bulletproof\Crud\app\models\Cart;
use repositories\CartRepository;

class CartRepositoryImpl implements CartRepository
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

    function add(Cart $cart): void
    {
        // TODO: Implement add() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('insert into carts (quantity , total , product_id , user_id  ,  shop_id) values (? , ? , ? , ? , ? )');
            $sql->execute([$cart->getQuantity() , $cart->getTotal() ,  $cart->getProductId() , $this->user['id'] ,$cart->getShopId()]);
            echo "Success add product to cart";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(int $id , Cart $cart): void
    {
        // TODO: Implement update() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('update carts set quantity = ? , total = ?  where id = ?');
            $sql->execute([$cart->getQuantity() , $cart->getTotal() , $id]);
            echo "Success add update to cart";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('delete from carts where id = ?');
            $sql->execute([$id]);
            echo "Success delete product in cart";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function all(): array
    {
        // TODO: Implement all() method.
        if (!$this->isLogin()){
            return[];
        }
        try {
            $sql =  $this->connection->prepare('select * from carts where user_id = ?');
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
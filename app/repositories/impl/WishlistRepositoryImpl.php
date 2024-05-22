<?php

namespace Bulletproof\Crud\repositories\impl;

require_once __DIR__ . '/../../models/Wishlist.php';
require_once __DIR__ . '/../WishlistRepository.php';


use Bulletproof\Crud\app\models\Wishlist;
use repositories\WishlistRepository;

class WishlistRepositoryImpl implements WishlistRepository
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


    function add(Wishlist $wishlist): void
    {
        // TODO: Implement add() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('insert into wishlists (product_id , user_id  ,  shop_id) values (? , ? , ? )');
            $sql->execute([$wishlist->getProductId() , $this->user['id'] ,$wishlist->getShopId()]);
            echo "Success add product to wishlist";
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
            $sql =  $this->connection->prepare('delete from wishlists where id = ?');
            $sql->execute([$id]);
            echo "Success add product to wishlist";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function all(): array
    {
        // TODO: Implement all() method.
        if (!$this->isLogin()){
            return [];
        }
        try {
            $sql =  $this->connection->prepare('select * from wishlists where user_id = ?');
            $sql->execute([$this->user['id']]);
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);

            if (!$data){
                return [];
            }

            return $data;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return [];

        }
    }
}
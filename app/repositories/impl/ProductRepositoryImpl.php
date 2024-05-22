<?php

namespace repositories\impl;

use Bulletproof\Crud\app\models\Product;
use repositories\ProductRepository;

require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../ProductRepository.php';


class ProductRepositoryImpl implements ProductRepository
{
    private $connection;
    private $shop;
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

    private function isOwnerShop() : bool{
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

        $sqlShop = $this->connection->prepare('select * from shops where user_id = ?');
        $sqlShop->execute([$userId]);
        $this->shop = $sqlShop->fetch(\PDO::FETCH_ASSOC);
        if (!$this->shop){
            echo "Shop invalid";
            return false;
        }

        return true;
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

    function create(Product $product): void
    {
        // TODO: Implement create() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('insert into products (name , image , description , quantity , price , category_id , shop_id ,user_id ) values (? , ? , ? , ? , ? , ? , ? , ?)');
            $sql->execute([$product->getName() , $product->getImage() , $product->getDescription()  , $product->getQuantity() , $product->getPrice() , $product->getCategoryId() , $this->shop['id'] , $this->user['id']]);
            echo "Success created product";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(int $id, Product $product): void
    {
        // TODO: Implement update() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('update products set name = ?  , image = ? , description = ? , quantity = ? ,  price = ? , category_id = ?  where id = ?');
            $sql->execute([$product->getName() , $product->getImage() , $product->getDescription()  , $product->getQuantity() , $product->getPrice() , $product->getCategoryId() , $id ]);
            echo "Success updated product";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('delete from products  where id = ? ');
            $sql->execute([ $id]);

            echo "Success deleted product";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        if (!$this->isLogin()){
            return [];
        }
        try {
            $sql =  $this->connection->prepare('select * from products  where id = ? ');
            $sql->execute([$id]);
            $data = $sql->fetch(\PDO::FETCH_ASSOC);
            if (!$data){
                return [];
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
            return [];
        }
        try {
            $sql =  $this->connection->query('select * from products');
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
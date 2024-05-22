<?php

namespace Bulletproof\Crud\repositories\impl;

require_once __DIR__ . '/../../models/Shop.php';
require_once __DIR__ . '/../ShopRepository.php';

use Bulletproof\Crud\app\models\Shop;
use repositories\ShopRepository;

class ShopRepositoryImpl implements ShopRepository
{

    private $connection;
    private $user;
    private $shop;

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


    function create(Shop $shop): void
    {
        // TODO: Implement create() method.
        if ($this->isOwnerShop()){
            echo "You already have shop";
            return;
        }
        try {
            $sql = $this->connection->prepare('insert into shops (name , image , description, address,  type , rating , location , user_id) values(? ,? ,? ,? , ? , ? , ? , ? )');
            $sql->execute([$shop->getName(), $shop->getImage() , $shop->getDescription() , $shop->getAddress() , $shop->getType() , 0, $shop->getLocation() , $this->user['id']]);
            echo "Success created shop";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(Shop $shop): void
    {
        // TODO: Implement update() method.
        if (!$this->isOwnerShop()){
            echo "You dont have shop";
            return;
        }
        try {
            $sql = $this->connection->prepare('update shops set name = ?, image = ? , description = ?, address = ?,  type = ? , location = ? where user_id = ?');
            $sql->execute([$shop->getName(), $shop->getImage() , $shop->getDescription() , $shop->getAddress() , $shop->getType() , $shop->getLocation() , $this->user['id'] ]);
            echo "Success updated shop";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function myShop(): array
    {
        // TODO: Implement myShop() method.
        if (!$this->isOwnerShop()){
            echo "You dont have shop";
            return [];
        }
        try {
            $sql = $this->connection->prepare('select * from shops where id = ?');
            $sql->execute([$this->shop['id']]);
            $data = $sql->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                return [];
            }

            return $data;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return [];
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        try {
            $sql = $this->connection->prepare('select * from shops where id = ?');
            $sql->execute([$id]);
            $data = $sql->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
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
        try {
            $sql = $this->connection->query('select * from shops');
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);

            if (!$data) {
                return [];
            }

            return $data;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return [];
        }
    }

}
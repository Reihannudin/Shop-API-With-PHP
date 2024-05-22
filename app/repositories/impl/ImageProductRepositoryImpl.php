<?php

namespace Bulletproof\Crud\repositories\impl;

use Bulletproof\Crud\models\ImageProduct;
use Bulletproof\Crud\repositories\ImageProductRepository;

require_once __DIR__ . '/../../models/ImageProduct.php';
require_once __DIR__ . '/../ImageProductRepository.php';

class ImageProductRepositoryImpl implements ImageProductRepository
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


    function create(ImageProduct $imageProduct): void
    {
        // TODO: Implement create() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('insert into image_products (image , name , product_id ,  shop_id) values (? , ? , ? ,?)');
            $sql->execute([$imageProduct->getImage() , $imageProduct->getName() , $imageProduct->getProductId() , $this->shop['id']]);
            echo "Success created image product";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(int $id, ImageProduct $imageProduct): void
    {
        // TODO: Implement update() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('update image_products set image = ?, name = ? , product_id = ?  where id = ? ');
            $sql->execute([$imageProduct->getImage() , $imageProduct->getName() , $imageProduct->getProductId() , $id]);
            echo "Success updated image product";
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
            $sql =  $this->connection->prepare('delete from image_products where id = ? ');
            $sql->execute([$id]);
            echo "Success deleted image product";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        try {
            $sql =  $this->connection->prepare('select * from image_products where id = ? ');
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
        try {
            $sql =  $this->connection->query('select * from image_products');
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
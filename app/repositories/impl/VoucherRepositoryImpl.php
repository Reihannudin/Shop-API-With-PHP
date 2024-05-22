<?php

namespace Bulletproof\Crud\repositories\impl;

use Bulletproof\Crud\app\models\Voucher;
use repositories\VoucherRepository;

require_once __DIR__ . '/../../models/Voucher.php';
require_once __DIR__ . '/../VoucherRepository.php';


class VoucherRepositoryImpl implements VoucherRepository
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


    function create(Voucher $voucher): void
    {
        // TODO: Implement create() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $code = "3945jgngr";
            $sql =  $this->connection->prepare('insert into vouchers (name , code , disc , start , end , product_id , shop_id ,user_id ) values (? ,? ,? ,? , ?, ? ,? , ? )');
            $sql->execute([$voucher->getName() , $voucher->getCode()  , $voucher->getDisc() , $voucher->getStart() , $voucher->getEnd() , $voucher->getProductId() , $this->shop['id'] , $this->user['id']]);
            echo "Success created voucher";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(int $id, Voucher $voucher): void
    {
        // TODO: Implement update() method.
        if (!$this->isOwnerShop()){
            return;
        }
        try {
            $sql =  $this->connection->prepare('update vouchers set name = ? , code = ? , disc = ? , start = ? , end = ? , product_id = ? where id = ? ');
            $sql->execute([$voucher->getName() , $voucher->getCode() , $voucher->getDisc() , $voucher->getStart() , $voucher->getEnd() , $voucher->getProductId() , $id]);
            echo "Success updated voucher";
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
            $sql =  $this->connection->prepare('delete from vouchers where id = ?');
            $sql->execute([$id]);
            echo "Success deleted voucher";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        try {
            $sql =  $this->connection->prepare('select * from vouchers  where id = ? ');
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
            $sql =  $this->connection->query('select * from vouchers ');
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
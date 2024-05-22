<?php

namespace Bulletproof\Crud\repositories\impl;

require_once __DIR__ . '/../../models/Address.php';
require_once __DIR__ . '/../AddressRepository.php';

use Bulletproof\Crud\app\models\Address;
use Bulletproof\Crud\app\repository\AddressRepository;


class AddressRepositoryImpl implements AddressRepository
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
            echo "User not found";
            return false;
        }

        return true;
    }

    function create(Address $address): void
    {
        // TODO: Implement create() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql = $this->connection->prepare('insert into address (name , contact , address , location , code_pos  , maps , user_id) values  (? , ? , ? ,? ,? ,? ,?)');
            $sql->execute([$address->getName() , $address->getContact() , $address->getAddress() , $address->getLocation() , $address->getCodePos() , $address->getMaps() , $this->user['id']]);
            echo "Success created address";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(int $id, Address $address): void
    {
        // TODO: Implement update() method.
        if (!$this->isLogin()){
            return;
        }
        try {
            $sql = $this->connection->prepare('update address set name = ? , contact = ?, address = ?, location = ?, code_pos = ?, maps = ? where  id = ?');
            $sql->execute([$address->getName() , $address->getContact() , $address->getAddress() , $address->getLocation() , $address->getCodePos() , $address->getMaps() , $id]);
            echo "Success updated address";
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
            $sql = $this->connection->prepare('delete from address  where  id = ?');
            $sql->execute([$id]);
            echo "Success deleted address";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        if (!$this->isLogin()){
            return [ ];
        }
        try{
            $sql =  $this->connection->prepare('select * from address where id = ? and user_id = ?');
            $sql->execute([$id , $this->user['id']]);
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
            return [ ];
        }
        try{
            $sql =  $this->connection->prepare('select * from address where user_id = ?');
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
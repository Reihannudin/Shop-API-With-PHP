<?php

namespace Bulletproof\Crud\repositories\impl;

require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../CategoryRepository.php';


use Bulletproof\Crud\app\models\Category;
use repositories\CategoryRepository;

class CategoryRepositoryImpl implements CategoryRepository
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    private function startSession(){
        if (session_start() === PHP_SESSION_NONE){
            session_start();
        }
    }

    private function isAdmin() :bool{
        $this->startSession();
        $userId = $_SESSION['user_id'];
        if (empty($userId)){
            echo "You dont have session";
            return false;
        }

        $sqlUser = $this->connection->prepare('SELECT * FROM users WHERE id = ? AND type = ?');
//        $sqlUser = $this->connection->prepare('select * from users where id = ? and where type = ?');
        $sqlUser->execute([$userId , 'admin']);
        $user = $sqlUser->fetch(\PDO::FETCH_ASSOC);
        if (!$user){
            echo "You not admin";
            return false;
        }

        return true;
    }

    function create(Category $category): void
    {
        // TODO: Implement create() method.
        if (!$this->isAdmin()){
            return;
        }

        try {
            $sql = $this->connection->prepare('insert into categories (name) values  (?)');
            $sql->execute([$category->getName()]);
            echo "Success created category";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function update(int $id, Category $category): void
    {
        // TODO: Implement update() method.
        if (!$this->isAdmin()){
            return;
        }

        try {
            $sql = $this->connection->prepare('update categories set name = ? where id = ?');
            $sql->execute([$category->getName() , $id]);
            echo "Success  updated category";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        if (!$this->isAdmin()){
            return;
        }

        try {
            $sql = $this->connection->prepare('delete from categories where id = ?');
            $sql->execute([$id]);
            echo "Success  deleted category";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        try{
            $sql =  $this->connection->query('select * from categories where id = ?');
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
        try{
            $sql =  $this->connection->query('select * from categories ');
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
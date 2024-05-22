<?php

namespace Bulletproof\Crud\app\repository\impl;

use Bulletproof\Crud\app\models\User;
use repositories\UserRepository;

require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../UserRepository.php';

class UserRepositoryImpl implements UserRepository
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

    function register(User $user): void
    {
        // TODO: Implement register() method.
        try {

            $check = $this->connection->prepare('select * from users where  email = ?');
            $check->execute([$user->getEmail()]);
            $checkUser = $check->fetch(\PDO::FETCH_ASSOC);
            if ($checkUser){
                echo "You already registered";
                return;
            }
            $hash = password_hash($user->getPassword() , PASSWORD_BCRYPT);
            $sql =  $this->connection->prepare('insert into users (name, email, password, contact, address , type , balance) values (? , ? , ? , ? , ? , ? , ?)');
            $sql->execute([$user->getName() , $user->getEmail() , $hash  , $user->getContact()  , $user->getAddress() , 'user' , 0]);
            echo "success registered";
            return;
//            header('Location: /login');
//            exit;

        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }


    function login(User $user): void
    {
        // TODO: Implement login() method.
        try {
            $check = $this->connection->prepare('select * from users where  email = ?');
            $check->execute([$user->getEmail()]);
            $checkUser = $check->fetch(\PDO::FETCH_ASSOC);
            if (!$checkUser){
                $checkUser = $check->fetch(\PDO::FETCH_ASSOC);
                echo "You dont have account";
            }

            $checkPassword = password_verify($user->getPassword() , $checkUser['password']);
            if (!$checkPassword){
                echo "Invalid password";
                return;
            }

            $token = bin2hex(random_bytes(16));
            $sql =  $this->connection->prepare('update users set token = ? where id = ?');
            $sql->execute([$token , $checkUser['id']]);

            $this->startSession();
            $_SESSION['user_id'] = $checkUser['id'];
            $_SESSION['user_token'] = $token;

            echo "success Login";
            return;
//            header('Location: /profile');
//            exit;

        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }
    function logout(): void
    {
        // TODO: Implement logout() method.
        try{
            $this->startSession();
            $userId = $_SESSION['user_id'];
            if (empty($userId)){
                echo "You dot have session";
                return;
            }

            $sql = $this->connection->prepare('update users set token = ? where id = ?');
            $sql->execute([null  , $userId]);
            $_SESSION = [];
            session_destroy();
            echo "Success logout";
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
        }
    }


    function topUp(User $user): void
    {
        // TODO: Implement topUp() method.
        try{
            $this->startSession();
            $userId = $_SESSION['user_id'];
            if (empty($userId)){
                echo "You dot have session";
            }

            $check = $this->connection->prepare('select * from users where id = ?');
            $check->execute([$userId]);
            $checkUser = $check->fetch(\PDO::FETCH_ASSOC);
            if (!$checkUser){
                $checkUser = $check->fetch(\PDO::FETCH_ASSOC);
                echo "You dont have account";
            }

            $sql = $this->connection->prepare('update users set balance = ? where id = ?');
            $sql->execute([$user->getBalance() , $checkUser['id']]);
//            header('Location: /profile');

            echo "success add balance";
            return;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return;
        }
    }

    function update(User $user): void
    {
        // TODO: Implement update() method.
        try{

            $this->startSession();
            $userId = $_SESSION['user_id'];
            if (empty($userId)){
                echo "You dot have session";
            }

            $check = $this->connection->prepare('select * from users where id = ?');
            $check->execute([$userId]);
            $checkUser = $check->fetch(\PDO::FETCH_ASSOC);

            if (!$checkUser){
                $checkUser = $check->fetch(\PDO::FETCH_ASSOC);
                echo "You dont have account";
            }

            $sql = $this->connection->prepare('update users set name = ? , contact = ? , address = ? where id = ?');
            $sql->execute([$user->getName() , $user->getContact() , $user->getAddress() , $checkUser['id']]);
//            header('Location: /profile');
            echo "success update user";
            return;

        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return;
        }
    }

    function show(): array
    {
        // TODO: Implement show() method.
        try{

            $this->startSession();
            $userId = $_SESSION['user_id'];

            if (empty($userId)){
                echo "You dot have session";
                return[];
            }

            $sql = $this->connection->prepare('select * from users where id = ?');
            $sql->execute([$userId]);
            $data =  $sql->fetch(\PDO::FETCH_ASSOC);

            if (!$data){
                return[];
            }

            return $data;
        }catch (\PDOException $e){
            echo "Terjadi kesalahan : " . $e->getMessage();
            return[];
        }
    }

}
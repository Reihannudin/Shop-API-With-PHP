<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\app\repository\impl\UserRepositoryImpl;
use Bulletproof\Crud\app\service\impl\UserServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/View.php';
require_once __DIR__ . '/../services/impl/UserServiceImpl.php';
require_once __DIR__ . '/../repositories/impl/UserRepositoryImpl.php';

class UserController
{

    private $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new UserRepositoryImpl($connection);
        $this->userService = new UserServiceImpl($repository);
    }

    public function register() : void{
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET'){
            echo "Register";
        }
        if ($method == 'POST'){
//            Input content
//            $request = $_POST;

//            Input API
            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $email = $request['email'] ?? null;
            $name = $request['name'] ?? null;
            $password = $request['password'] ?? null;
            $contact = $request['contact'] ?? null;
            $address = $request['address'] ?? null;
            try {
                if (!empty($email) && !empty($password) && !empty($name) && !empty($contact)){
                    $this->userService->register($email , $name , $password , $contact , $address);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success registered']);
                }else{
                    http_response_code(400);
                    echo json_encode(['error' => 'You should fill all input']);
                }
            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }

    public function login() : void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST'){
            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $email = $request['email'] ?? null;
            $password = $request['password'] ?? null;

            try {
                if (!empty($email) && !empty($password)){
                    $this->userService->login($email ,$password );
                    http_response_code(200);
                    echo json_encode(['message' => 'Success login']);
                }else{
                    http_response_code(400);
                    echo json_encode(['error' => 'You should fill all input']);
                }
            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }

    public function logout() : void{
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET'){
            echo "Register";
        }

        if ($method == 'POST'){
            try {
                $this->userService->logout();
                http_response_code(200);
                echo json_encode(['message' => 'Success logout']);
            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }


    public function show() : void{
        try {
            $data = $this->userService->show();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function update() : void{
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET'){
            echo "Register";
        }
        if ($method == 'POST'){
//            Input content
//            $request = $_POST;

//            Input API
            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $name = $request['name'] ?? null;
            $contact = $request['contact'] ?? null;
            $address = $request['address'] ?? null;
            try {
                if (!empty($name) && !empty($contact)){
                    $this->userService->update($name , $contact , $address);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success updated']);
                }else{
                    http_response_code(400);
                    echo json_encode(['error' => 'You should fill all input']);
                }
            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }


    public function topup() : void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST'){
            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $balance = $request['balance'] ?? null;

            try {
                if (!empty($balance)){
                    $this->userService->topUp($balance);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success TopUp']);
                }else{
                    http_response_code(400);
                    echo json_encode(['error' => 'You should fill all input']);
                }
            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }
}
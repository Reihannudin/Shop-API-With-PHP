<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\AddressRepositoryImpl;
use Bulletproof\Crud\services\impl\AddressServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/AddressRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/AddressServiceImpl.php';

class AddressController
{

    private $addressService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new AddressRepositoryImpl($connection);
        $this->addressService = new AddressServiceImpl($repository);
    }

    public function create() : void{
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET'){
            echo "Register";
        }

        if ($method == 'POST'){
//            $request = $_POST;
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
            $location = $request['location'] ?? null;
            $codePost = $request['code_post'] ?? null;
            $maps = $request['maps'] ?? null;


            try {
                if (!empty($name) && !empty($contact) && !empty($location) && !empty($codePost) && !empty($maps)){
                    $this->addressService->create($name , $contact , $address , $location , $codePost , $maps);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create address']);
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

    public function update(int $id) : void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'GET'){
            echo "Register";
        }

        if ($method == 'POST'){
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
            $location = $request['location'] ?? null;
            $codePost = $request['code_post'] ?? null;
            $maps = $request['maps'] ?? null;

            try {

                if (!empty($name) && !empty($contact) && !empty($location) && !empty($codePost) && !empty($maps)){
                    $this->addressService->update($id , $name , $contact , $address , $location , $codePost , $maps);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update address']);
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

    public function delete(int $id) : void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'GET'){
            echo "Delete";
        }

        if ($method == 'POST'){

            try {
                $this->addressService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success Delete address']);

            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }

        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }

    public function show(int $id) : void{
        try {
            $data = $this->addressService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function all() : void{
        try{
            $data = $this->addressService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);

        }
    }

}
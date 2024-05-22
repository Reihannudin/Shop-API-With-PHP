<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\ShopRepositoryImpl;
use Bulletproof\Crud\services\impl\ShopServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/ShopRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/ShopServiceImpl.php';


class ShopController
{

    private $shopService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new ShopRepositoryImpl($connection);
        $this->shopService = new ShopServiceImpl($repository);
    }


    function create( ): void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST'){

            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $name = $request['name'] ?? null;
            $image = $request['image'] ?? null;
            $description = $request['description'] ?? null;
            $address = $request['address'] ?? null;
            $type = $request['type'] ?? null;
            $location = $request['location'] ?? null;

            try {

                if (!empty($name) && !empty($image) && !empty($description) && !empty($address) && !empty($type) && !empty($location) ){
                    $this->shopService->create($name ,$image , $description , $address , $type, $location  );
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create shop']);
                }else{
                    http_response_code(400);
                    echo json_encode(['error' => 'You should fill all input']);
                }

            }catch (Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }

        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }

    function update(): void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST'){

            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $name = $request['name'] ?? null;
            $image = $request['image'] ?? null;
            $description = $request['description'] ?? null;
            $address = $request['address'] ?? null;
            $type = $request['type'] ?? null;
            $location = $request['location'] ?? null;

            try {

                if (!empty($name) && !empty($image) && !empty($description) && !empty($address) && !empty($type) && !empty($location) ){
                    $this->shopService->update($name ,$image , $description , $address , $type, $location  );
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update shop']);
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
    function myShop(): void{
        try {
            $data = $this->shopService->myShop();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    function show(int $id): void{
        try {
            $data = $this->shopService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    function all(): void{
        try {
            $data = $this->shopService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

}
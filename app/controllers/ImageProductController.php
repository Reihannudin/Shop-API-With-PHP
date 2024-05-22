<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\ImageProductRepositoryImpl;
use Bulletproof\Crud\services\impl\ImageProductServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/ImageProductRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/ImageProductServiceImpl.php';


class ImageProductController
{

    private $imageProductService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new ImageProductRepositoryImpl($connection);
        $this->imageProductService = new ImageProductServiceImpl($repository);
    }

    public function create() : void{
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET'){
            echo "Create";
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

            $image = $request['image'] ?? null;
            $name = $request['name'] ?? null;
            $shopId = $request['shop_id'] ?? null;
            $productId = $request['product_id'] ?? null;
            try {
                if (!empty($image) && !empty($name) && !empty($productId) && !empty($shopId)){
                    $this->imageProductService->create($image , $name , $productId , $shopId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create image product']);
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
            echo "Create";
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

            $image = $request['image'] ?? null;
            $name = $request['name'] ?? null;
            $shopId = $request['shop_id'] ?? null;
            $productId = $request['product_id'] ?? null;
            try {
                if (!empty($image) && !empty($name) && !empty($productId) && !empty($shopId)){
                    $this->imageProductService->update($id ,$image , $name , $productId , $shopId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update image product']);
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
            echo 'Delete';
        }
        if ($method == 'POST'){
            try {
                $this->imageProductService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success delete image product']);
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
        try{
            $data = $this->imageProductService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function all() : void{
        try{
            $data = $this->imageProductService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }
}
<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\app\service\impl\ProductServiceImpl;
use repositories\impl\ProductRepositoryImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../services/impl/ProductServiceImpl.php';
require_once __DIR__ . '/../repositories/impl/ProductRepositoryImpl.php';


class ProductController
{

    private $productService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new ProductRepositoryImpl($connection);
        $this->productService = new ProductServiceImpl($repository);
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
            $image = $request['image'] ?? null;
            $description = $request['description'] ?? null;
            $quantity = $request['quantity'] ?? null;
            $price = $request['price'] ?? null;
            $categoryId = $request['category_id'] ?? null;

            try {

                if (!empty($name) && !empty($image) && !empty($description) && !empty($quantity) && !empty($price)){
                    $this->productService->create($name , $image , $description , $quantity , $price , $categoryId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create product']);
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
            $image = $request['image'] ?? null;
            $description = $request['description'] ?? null;
            $quantity = $request['quantity'] ?? null;
            $price = $request['price'] ?? null;
            $categoryId = $request['category_id'] ?? null;


            try {

                if (!empty($name) && !empty($image) && !empty($description) && !empty($quantity) && !empty($price)){
                    $this->productService->update($id , $name , $image , $description , $quantity , $price , $categoryId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update product']);
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

    public function delete(int $id) : void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'GET'){
            echo "Register";
        }

        if ($method == 'POST'){

            try {
                $this->productService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success Delete product']);

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
            $data = $this->productService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function all() : void{
        try {
            $data = $this->productService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

}
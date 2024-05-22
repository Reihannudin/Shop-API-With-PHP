<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\CartRepositoryImpl;
use Bulletproof\Crud\services\impl\CartServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/CartRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/CartServiceImpl.php';


class CartController
{

    private $cartService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new CartRepositoryImpl($connection);
        $this->cartService = new CartServiceImpl($repository);
    }

    public function add() : void{
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

            $quantity = $request['quantity'] ?? null;
            $total = $request['total'] ?? null;
            $productId = $request['product_id'] ?? null;
            $shopId = $request['shop_id'] ?? null;
            try {
                if (!empty($productId)){
                    $this->cartService->add( $quantity , $total , $productId ,$shopId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success add cart']);
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
            echo "Update";
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

            $quantity = $request['quantity'] ?? null;
            $total = $request['total'] ?? null;
            try {
                if (!empty($quantity)){
                    $this->cartService->update($id , $quantity , $total);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update cart']);
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
                $this->cartService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success Delete cart']);
            }catch (\Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }

    public function all() : void{
        try{
            $data = $this->cartService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }


}
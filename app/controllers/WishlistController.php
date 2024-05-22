<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\WishlistRepositoryImpl;
use Bulletproof\Crud\services\impl\WishlistServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/WishlistRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/WishlistServiceImpl.php';


class WishlistController
{

    private $wishlistService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new WishlistRepositoryImpl($connection);
        $this->wishlistService = new WishlistServiceImpl($repository);
    }

    public function add() : void{
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST'){

//            $request = $_POST;

            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $productId = $request['product_id'] ?? null;
            $userId = $request['user_id'] ?? null;
            $shopId = $request['shop_id'] ?? null;

            try {
                if (!empty($productId) && !empty($userId) && !empty($shopId)){
                    $this->wishlistService->add($productId , $userId , $shopId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success add wishlist']);
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

        if ($method == 'POST'){
            try {
                $this->wishlistService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success delete wishlist']);
            }catch (Exception $e){
                http_response_code(505);
                echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
            }
        }else{
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
    }

    public function all() : void{
        try {
            $data = $this->wishlistService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

}
<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\CategoryRepositoryImpl;
use Bulletproof\Crud\services\impl\CategoryServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/CategoryRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/CategoryServiceImpl.php';


class CategoryController
{

    private $categoryService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new CategoryRepositoryImpl($connection);
        $this->categoryService = new CategoryServiceImpl($repository);
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
            $name = $request['name'] ?? null;
            try {
                if (!empty($name)){
                    $this->categoryService->create($name);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create category']);
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
            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }
            $name = $request['name'] ?? null;
            try {
                if (!empty($name)){
                    $this->categoryService->update($id , $name);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update category']);
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
                $this->categoryService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success Delete category']);
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
            $data = $this->categoryService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function all() : void{
        try{
            $data = $this->categoryService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }
}
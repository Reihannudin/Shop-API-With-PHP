<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\VoucherRepositoryImpl;
use Bulletproof\Crud\services\impl\VoucherServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/VoucherRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/VoucherServiceImpl.php';



class VoucherController
{

    private $voucherService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new VoucherRepositoryImpl($connection);
        $this->voucherService = new VoucherServiceImpl($repository);
    }

    public function create() : void{
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

            $name = $request['name'] ?? null;
            $code = $request['code'] ?? null;
            $disc = $request['disc'] ?? null;
            $start = $request['start'] ?? null;
            $end = $request['end'] ?? null;
            $productId = $request['product_id'] ?? null;

            try {

                if (!empty($name) && !empty($code) && !empty($disc) && !empty($start) && !empty($end) && !empty($productId) ){
                    $this->voucherService->create($name ,$disc, $code, $start, $end , $productId  );
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create voucher']);
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
            $code = $request['code'] ?? null;
            $disc = $request['disc'] ?? null;
            $start = $request['start'] ?? null;
            $end = $request['end'] ?? null;
            $productId = $request['product_id'] ?? null;

            try {

                if (!empty($name) && !empty($code) && !empty($disc) && !empty($start) && !empty($end) && !empty($productId) ){
                    $this->voucherService->update($id , $name ,$disc, $code, $start, $end , $productId  );
                    http_response_code(200);
                    echo json_encode(['message' => 'Success update voucher']);
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
                $this->voucherService->delete($id);
                http_response_code(200);
                echo json_encode(['message' => 'Success Delete voucher']);

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
            $data = $this->voucherService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function all() : void{
        try {
            $data = $this->voucherService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

}
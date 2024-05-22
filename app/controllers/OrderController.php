<?php

namespace Bulletproof\Crud\controllers;

use Bulletproof\Crud\app\config\Database;
use Bulletproof\Crud\repositories\impl\OrderRepositoryImpl;
use Bulletproof\Crud\services\impl\OrderServiceImpl;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repositories/impl/OrderRepositoryImpl.php';
require_once __DIR__ . '/../services/impl/OrderServiceImpl.php';


class OrderController
{

    private $orderService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $repository = new OrderRepositoryImpl($connection);
        $this->orderService = new OrderServiceImpl($repository);
    }

    public function order(){
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET'){
            echo "Order";
        }
        if ($method == 'POST'){

            $input = file_get_contents('php://input');
            $request = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

//            $request = $_POST;
            $total = $request['total'] ?? null;
            $date = $request['date'] ?? null;
            $status = $request['status'] ?? null;
            $products = $request['products'] ?? null;
            $addressId = $request['address_id'] ?? null;
            $voucherId = $request['voucher_id'] ?? null;
            $paymentId = $request['payment_id'] ?? null;
            $shipmentId = $request['shipment_id'] ?? null;
            try {
                if (!empty($total) && !empty($date) && !empty($status) && !empty($addressId) && !empty($voucherId) && !empty($paymentId) && !empty($shipmentId)){
                    $this->orderService->order($total , $date  , $status , $products , $addressId , $voucherId , $paymentId , $shipmentId);
                    http_response_code(200);
                    echo json_encode(['message' => 'Success create order']);
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

    public function show(int $id){
        try{
            $data = $this->orderService->show($id);
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

    public function all(){
        try{
            $data = $this->orderService->all();
            $jsonData = json_encode($data);
            echo $jsonData;
        }catch (\Exception $e){
            http_response_code(505);
            echo json_encode(['error' => 'There some internal error : ' .$e->getMessage()]);
        }
    }

}
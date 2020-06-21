<?php


namespace App\Controllers;


use App\Services\OrderCreator;

class OrderController
{

    public function create(array $data, OrderCreator $orderCreator)
    {
        $order = $orderCreator->invoke($data);
        $message = "User selected ".$data['name'].' and paid $'.$data['total'].' with '.$data['payment_type'];
        header('Content-Type: application/json');
        echo json_encode([
            "data" => $order,
            "message" => $message,
        ]);
    }

}
<?php


namespace App\Controllers;


use App\Repositories\ItemRepositoryInterface;
use App\Services\ItemCreator;

class ItemController
{
    public function list(ItemRepositoryInterface $itemRepository)
    {
        $data = $itemRepository->list();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function create(array $data, ItemCreator $itemCreator)
    {
        header('Content-Type: application/json');
        echo json_encode([
            "data" => $itemCreator->invoke($data),
            "message" => "Item is added",
        ]);
    }

}
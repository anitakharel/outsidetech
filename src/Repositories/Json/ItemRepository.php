<?php


namespace App\Repositories\Json;


use App\Models\Item;
use App\Repositories\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
{

    public function list(): array
    {
        return [
            [
                "id" => 1,
                "name" => "Monitor",
                "price" => 100,
                "description" => "32inch LED monitor",
                "image" => "monitor.jpg",
                "quantity" => 1,
                "total_amount" => 100
            ],
            [
                "id" => 2,
                "name" => "T-Shirt",
                "price" => 50,
                "description" => "Dark blue collar T-Shirt",
                "image" => "tshirt.jpg",
                "quantity" => 1,
                "total_amount" => 50
            ],
        ];
    }

    public function add(Item $item): array
    {
        // add to json here
        return array_merge($item->toArray(), ["id" => 3]);
    }
}
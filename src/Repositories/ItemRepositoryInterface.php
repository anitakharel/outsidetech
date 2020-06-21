<?php


namespace App\Repositories;


use App\Models\Item;

interface ItemRepositoryInterface
{
    public function list(): array;

    public function add(Item $item):array;

}
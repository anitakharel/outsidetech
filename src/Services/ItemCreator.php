<?php


namespace App\Services;


use App\Models\Item;
use App\Repositories\ItemRepositoryInterface;

class ItemCreator
{
    protected $itemRepository;

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function invoke(array $data): array
    {
        $item = new Item();
        $item->setName($data["name"]);
        $item->setPrice($data["price"]);
        $item->setDescription($data["description"]);
        $item->setImage($data["image"]);


        return $this->itemRepository->add($item);
    }

}
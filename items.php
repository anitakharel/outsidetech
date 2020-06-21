<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\ItemController;
use App\Repositories\Json\ItemRepository;
use App\Services\ItemCreator;

$itemController = new ItemController();
$itemRepository = new ItemRepository();
$itemCreator = new ItemCreator($itemRepository);

// array holding allowed Origin domains
$allowedOrigins = array(
  '(http(s)://)?(localhost)'
);
 
if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] != '') {
  foreach ($allowedOrigins as $allowedOrigin) {
    if (preg_match('#' . $allowedOrigin . '#', $_SERVER['HTTP_ORIGIN'])) {
      header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
      break;
    }
  }
}
$requestMethod = $_SERVER['REQUEST_METHOD'];
switch ($requestMethod) {
    case 'GET':
        $itemController->list($itemRepository);
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $itemController->create($data, $itemCreator);
        break;
    default:
        echo "unexpected method used";
}



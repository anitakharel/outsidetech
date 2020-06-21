<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\OrderController;
use App\Services\OrderCreator;
use App\Services\Payments\Stripe\StripePayment;

$orderController = new OrderController();

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
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $payment = null;
        if ($data['payment_type'] == "stripe") {
            $payment = new StripePayment();
        }
        //depending on payment selected, we will create its instance here and inject
        $orderCreator = new OrderCreator($payment);
        $orderController->create($data, $orderCreator);
        break;
    default:
        echo "unexpected method used";
}



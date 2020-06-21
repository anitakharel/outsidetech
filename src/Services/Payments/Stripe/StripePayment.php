<?php


namespace App\Services\Payments\Stripe;


use App\Services\Payments\PaymentInterface;

class StripePayment implements PaymentInterface
{

    public function confirm(string $paymentId): bool
    {
        //@todo implement actual confirmation here
        return true;
    }
}
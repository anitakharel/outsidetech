<?php


namespace App\Services\Payments;


interface PaymentInterface
{
    public function confirm(string $paymentId): bool;
}
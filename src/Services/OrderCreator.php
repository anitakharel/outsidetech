<?php


namespace App\Services;


use App\Services\Payments\PaymentInterface;

class OrderCreator
{
    protected $payment;

    public function __construct(?PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function invoke(array $data): array
    {
        if ($this->payment) {
            $paymentSuccess = $this->payment->confirm($data['payment_id']);
            if (!$paymentSuccess) {
                throw new \Exception("payment is not confirmed");
            }
        }
        //@todo order added  here
        return $data;
    }

}
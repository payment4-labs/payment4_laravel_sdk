<?php

namespace Payment4\CryptoGateway;

use Payment4\CryptoGateway\Http\PaymentHttpRequest;

class Payment4
{
    public PaymentHttpRequest $paymentHttp;

    public function __construct(array $initParams = [])
    {
        $this->paymentHttp = new PaymentHttpRequest($initParams);
    }

    public function requestPayment(float $amount, array $options = []): \stdClass
    {
        return $this->paymentHttp->createNewRequest($amount, $options);
    }

    public function verifyPayment(string $paymentUid, float $amount, array $options = []): \stdClass
    {
        return $this->paymentHttp->verifyRequest($paymentUid, $amount, $options);
    }
}

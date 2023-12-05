<?php

namespace Payment4\CryptoGateway\Http;

use Payment4\CryptoGateway\Traits\Payment4Trait;

class PaymentHttpRequest
{
    use Payment4Trait {
        __construct as private __Payment4TraitConstruct;
    }

    public function __construct(array $initParams = [])
    {
        $this->__Payment4TraitConstruct();

        $this->setInitParams($initParams);
    }

    public function createNewRequest(float $amount, array $options): \stdClass
    {
        $this->setOptionParams($options);

        $response = $this->httpClient->post(self::$BASE_URL . self::$CREATE_PAYMENT, [
            'amount' => $amount,
            'callbackUrl' => $this->callbackUrl,
            'callbackParams' => $this->callbackParams,
            'webhookUrl' => $this->webhookUrl,
            'webhookParams' => $this->webhookParams,
            'currency' => $this->currency,
            'language' => $this->language,
            'sandBox' => $this->sandBox,
        ]);

        $this->setResponse($response);

        return $this->response;
    }

    public function verifyRequest(string $paymentUid, float $amount, array $options): \stdClass
    {
        $this->setOptionParams($options);

        $response = $this->httpClient->put(self::$BASE_URL . self::$VERIFY_PAYMENT, [
            'paymentUid' => $paymentUid,
            'amount' => $amount,
            'currency' => $this->currency,
        ]);

        $this->setResponse($response);

        return $this->response;
    }

}

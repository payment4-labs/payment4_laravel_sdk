<?php

namespace Payment4\CryptoGateway\Traits;

use Payment4\CryptoGateway\Exceptions\HttpException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use stdClass;

trait Payment4Trait
{
    # Endpoint url
    public static string $BASE_URL = 'https://service.payment4.com/api/v1';
    public static string $CREATE_PAYMENT = '/payment';
    public static string $VERIFY_PAYMENT = '/payment/verify';

    #params
    public string $callbackUrl;
    public string $webhookUrl;
    public string $apiKey;
    public string $currency;
    public string $language;
    public bool $sandBox;
    public array|null $callbackParams;
    public array|null $webhookParams;

    public stdClass $response;
    private PendingRequest $httpClient;

    public function __construct()
    {
        $this->apiKey = config('payment4.apiKey');
        $this->callbackUrl = config('payment4.callbackUrl');
        $this->webhookUrl = config('payment4.webhookUrl');
        $this->language = config('payment4.language', 'EN');
        $this->sandBox = config('payment4.sandBox', false);
        $this->currency = config('payment4.currency', 'USD');

        $this->webhookParams = null;
        $this->callbackParams = null;
        $this->response = new stdClass();
    }

    public function setInitParams(array $initParams): void
    {
        $this->apiKey = Arr::exists($initParams, 'apiKey') ? $initParams['apiKey'] : $this->apiKey;
        $this->sandBox = Arr::exists($initParams, 'sandBox') ? $initParams['sandBox'] : $this->sandBox;

        $this->setHttpClient();
    }

    protected function setHttpClient(): void
    {
        $this->httpClient = Http::timeout(90)
            ->withHeaders([
                'x-api-key' => $this->apiKey,
            ]);
    }

    protected function setOptionParams(array $options): void
    {
        $this->language = Arr::exists($options, 'language') ? $options['language'] : $this->language;
        $this->currency = Arr::exists($options, 'currency') ? $options['currency'] : $this->currency;
        $this->webhookUrl = Arr::exists($options, 'webhookUrl') ? $options['webhookUrl'] : $this->webhookUrl;
        $this->callbackUrl = Arr::exists($options, 'callbackUrl') ? $options['callbackUrl'] : $this->callbackUrl;
        $this->webhookParams = Arr::exists($options, 'webhookParams') && !empty($options['webhookParams']) ? $options['webhookParams'] : $this->webhookParams;
        $this->callbackParams = Arr::exists($options, 'callbackParams') && !empty($options['callbackParams']) ? $options['callbackParams'] : $this->callbackParams;
    }

    protected function setResponse(Response $response): void
    {
        if ($response->successful()) {
            $this->response->data = $response->object();
            $this->response->statusCode = $response->status();
            $this->response->status = true;
        } elseif ($response->clientError()) {
            $data = $response->object();
            $this->response->api_message = $data->message;
            $this->response->errorCode = $data->errorCode ?? 0;
            $this->response->message = HttpException::getError($this->response->errorCode);
            $this->response->statusCode = $response->status();
        } else {
            $this->response->message = json_decode($response->body()) ?? $response->body();
            $this->response->statusCode = $response->status();
        }
    }
}

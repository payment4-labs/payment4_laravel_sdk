# Payment4 Official SDK Documentation

Payment4 revolutionizes the way businesses transact. Seamlessly accept a variety of digital currencies, ensuring swift, secure, and borderless transactions to empower your global enterprise.

- Streamlined and Efficient
- Promises/A+ Compatibility
- Secure Sandboxing

## Installation

You can install the package via composer:

```bash
composer require payment4/cryptogateway
```

Next, you should publish the configuration file using the `vendor:publish` Artisan command. The configuration file will be placed in your application's `config` directory.

```bash
 php artisan vendor:publish --provider="Payment4\CryptoGateway\Payment4ServiceProvider"
```

## Requirements

- php "^7.2|^8.0"
- laravel-framework "^7.0|^8.0|^9.0|^10.0"
- Register for Free or Login on the https://payment4.com
- Create new gateway and get apiKey

## Configuration

#### Add your APIKEY in Payment4 config.

```bash
'apiKey' => env('PAYMENT4_API_KEY', ''),
```

furthermore, you can add your APIKEY to .env file, please look at to following example:

```bash
PAYMENT4_API_KEY= __YOUR_API_KEY
```
#### If you use callbackUrl as static url you can set it here, otherwise, leave it blank.

```bash
'callbackUrl' => env('PAYMENT4_CALLBACK_URL', ''),
```

#### If you use webhookUrl as static url you can set it here, otherwise, leave it blank.

```bash
'webhookUrl' => env('PAYMENT4_WEBHOOK_URL', ''),
```

#### languages

```bash
'language' => 'EN',
```
#### Supported Languages :
- FR 
- ES
- AR 
- TR 
- FA 
- EN

Note : non-sensitive to uppercase or lowercase

#### currency

```bash
'currency' => 'USD',
```
#### Supported Currencies :
- USD  
- EUR  
- TRY  
- GBP
- AED  
- IRT

Note : non-sensitive to uppercase or lowercase

- sandBox

to activation set True
```bash
'sandBox' => false,
```

## Usage

### Create Payment4 instance

#### Ex1:
```bash

/**
* apiKey and sandBox are optional if already set them to config file.
*/

$initParams = [
'apiKey' => '######',
'sandBox' => false,
];

$paymentInstance = Payment4($initParams);

```
#### Ex2:

```bash
$paymentInstance = Payment4();
```

### Requesting a Payment

```bash
/**
 * amount is required
 * callbackParams, webhookParams, webhookUrl, language, currency are optional.
 * callbackUrl is optional if already set it to config file.
 * If no language is provided, the default language is set to 'en'.
 * If no currency is provided, the default currency is set to 'USD'.
 */
 
$amount = 10;
$options = [
  'callbackUrl' => "https://your-domain.com/callback",
  'callbackParams' => [
    'your key' => 'your value',
    'your key' => 'your value',
  ],
  'webhookUrl' => "https://your-domain.com/webhook",
  'webhookParams' => [
    'your key' => 'your value',
    'your key' => 'your value',
  ],
  'language' => 'EN',
  'currency' => 'USD',
];

$response = $paymentInstance->requestPayment($amount, $options);

if ($createPayment->status) {
    return responseSuccess(
        [
            'url' => $createPayment->data->paymentUrl,
        ]
    );
} else {
   return responseError(
        [
            'message' => $createPayment->message ?? '',
        ]
    );
}

```

### Verifying a Payment 

```bash
/**
 * amount and paymentUid are required
 */
 
$paymentUid = '';
$amount = 10;
$options = [
  'currency' => 'USD',
];

$response = $paymentInstance->verifyPayment($paymentUid, $amount, $options);

```

---

Powered by [Payment4](https://payment4.com)

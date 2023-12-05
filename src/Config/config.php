<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    |
    | Authorization apikey in Payment4
    |
    */

    'apiKey' => env('PAYMENT4_API_KEY', ''),


    /*
    |--------------------------------------------------------------------------
    | Callback Url
    |--------------------------------------------------------------------------
    |
    | If you use callbackUrl as static url you can set it here, otherwise, leave it blank.
    |
    */

    'callbackUrl' => env('PAYMENT4_CALLBACK_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Webhook Url
    |--------------------------------------------------------------------------
    |
    | If you use webhookUrl as static url you can set it here, otherwise, leave it blank.
    |
    */

    'webhookUrl' => env('PAYMENT4_WEBHOOK_URL', ''),


    /*
    |--------------------------------------------------------------------------
    | Payment4 language
    |--------------------------------------------------------------------------
    |
    | Currently Payment4 support following languages:
    | EN => English
    | FA => Farsi
    | FR => French
    | ES => Spanish
    | AR => Arabic
    | TR => Turkish
    | Note : non-sensitive to uppercase or lowercase
    | If no language given, the language default is EN
    */

    'language' => 'EN',

    /*
    |--------------------------------------------------------------------------
    | Payment4 currency
    |--------------------------------------------------------------------------
    |
    | Currently Payment4 support following currencies:
    |   USD
    |   EUR
    |   TRY
    |   GBP
    |   AED
    |   IRT
    | Note : non-sensitive to uppercase or lowercase
    | If no currency given, the currency default is USD
    */

    'currency' => 'USD',


    /*
    |--------------------------------------------------------------------------
    | Developer mode
    |--------------------------------------------------------------------------
    |
    | As developer you can use sandboxes to test Payment4.
    | to activation set True
    */

    'sandBox' => false,

];



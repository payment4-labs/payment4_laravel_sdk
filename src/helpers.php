<?php


use Payment4\CryptoGateway\Payment4;

if (!function_exists('Payment4')) {
    function Payment4(array $initParams = []): Payment4
    {
        return new Payment4($initParams);
    }
}

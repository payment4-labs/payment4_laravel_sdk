<?php

namespace Payment4\CryptoGateway\Exceptions;

class HttpException
{
    public static function getError(int $status): string
    {
        return match ($status) {
            1001 => __('payment4::messages.1001'),
            1002 => __('payment4::messages.1002'),
            1003 => __('payment4::messages.1003'),
            1004 => __('payment4::messages.1004'),
            1005 => __('payment4::messages.1005'),
            1006 => __('payment4::messages.1006'),
            1007 => __('payment4::messages.1007'),
            1008 => __('payment4::messages.1008'),
            1010 => __('payment4::messages.1010'),
            1011 => __('payment4::messages.1011'),
            1012 => __('payment4::messages.1012'),
            1013 => __('payment4::messages.1013'),
            default => $status,
        };
    }
}

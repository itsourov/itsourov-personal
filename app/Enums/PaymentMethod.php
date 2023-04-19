<?php

namespace App\Enums;

enum PaymentMethod: string
{
    const bkash = 'bkash';
    const stripe = 'stripe';

    public static function toArray()
    {
        return [
            self::bkash,
            self::stripe,
        ];
    }
}
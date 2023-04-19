<?php

namespace App\Enums;

enum PaymentStatus: string
{
    const Paid = 'paid';
    const Unpaid = 'unpaid';
    const Refunded = 'refunded';


    public static function toArray()
    {
        return [
            self::Paid,
            self::Unpaid,
            self::Refunded,
        ];
    }

    public static function getClass()
    {
        return [
            self::Paid => "border border-green-400 ",
            self::Unpaid => "border border-orange-400 ",
            self::Refunded => "border border-red-400 ",
        ];
    }
}
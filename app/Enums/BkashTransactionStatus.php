<?php

namespace App\Enums;

enum BkashTransactionStatus: string
{
    const Completed = 'Completed';
    const Initiated = 'Initiated';
    const Refunded = 'Refunded';


    public static function toArray()
    {
        return [
            self::Completed,
            self::Initiated,
            self::Refunded,
        ];
    }

    public static function getClass()
    {
        return [
            self::Completed => "border border-green-400 ",
            self::Initiated => "border border-orange-400 ",
            self::Refunded => "border border-red-400 ",
        ];
    }
}
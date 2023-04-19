<?php

namespace App\Enums;

enum OrderStatus: string
{

    const pendingPayment = 'Pending Payment';
    const processing = 'Processing';
    const Cancled = 'Cancled';

    public static function toArray()
    {
        return [
            self::pendingPayment,
            self::processing,
            self::Cancled,
        ];
    }
    public static function getClass()
    {
        return [
            self::pendingPayment => "border border-yellow-400 ",
            self::processing => "border border-green-400 ",
            self::Cancled => "border border-red-400 ",
        ];
    }


}
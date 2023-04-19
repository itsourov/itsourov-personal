<?php

namespace App\Enums;

enum CategoryType: string
{

    const productCategory = 'Product Category';
    const postCategory = 'Post Category';

    public static function toArray()
    {
        return [
            self::productCategory,
            self::postCategory,
        ];
    }
}
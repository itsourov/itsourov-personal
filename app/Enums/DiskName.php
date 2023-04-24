<?php

namespace App\Enums;

enum DiskName: string
{

    const profileImages = 'profile-images';
    const postThumbnails = 'post-thumbnails';
    const productThumbnails = 'product-thumbnails';
    const productImages = 'product-images';


    public static function toArray()
    {
        return [
            self::profileImages,
            self::postThumbnails,
            self::productThumbnails,
            self::productImages,
        ];
    }



}
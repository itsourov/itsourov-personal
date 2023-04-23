<?php

namespace App\Http\Helpers;

class Cart{
    
    public static function getCartItemsCount():int
    {
        if (auth()->user()) {
         return  auth()->user()->loadCount('cartItems')->cart_items_count;
        }else{
            return 0;
        }
    }
}
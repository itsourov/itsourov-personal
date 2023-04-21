<?php

namespace App\Http\Helpers;

class Error
{

    public static function formatArrayError($errorMsg): string
    {
        // Use regular expression to find the number after the dot
        $new_string = preg_replace_callback(
            '/(\.\d+\s)/',
            function ($matches) {
                // Extract the number after the dot
                $num = substr($matches[0], 1, -1);
                // Increment the number
                $num++;
                // Return the updated number with a space
                return ' ' . $num . ' ';
            },
            $errorMsg,
        );

        // Replace the dot with a space
        $new_string = str_replace('.', ' ', $new_string);
        return $new_string;
    }
}
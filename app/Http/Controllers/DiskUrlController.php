<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiskUrlController extends Controller
{
    public function postThumbnails($filepath)
    {
        $filepath = storage_path('app/post-thumbnail/' . $filepath);
        if (file_exists($filepath)) {
            return response()->file($filepath);
        } else {
            abort(404);
        }

    }
    public function profileImages($filepath)
    {
        $filepath = storage_path('app/profile-image/' . $filepath);
        if (file_exists($filepath)) {
            return response()->file($filepath);
        } else {
            abort(404);
        }
    }
}
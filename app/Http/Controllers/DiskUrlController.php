<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiskUrlController extends Controller
{
    public function postThumbnails($filepath)
    {
        return response()->file(storage_path('app/post-thumbnails/' . $filepath));
    }
    public function profileImages($filepath)
    {
        return response()->file(storage_path('app/profile-images/' . $filepath));
    }
}
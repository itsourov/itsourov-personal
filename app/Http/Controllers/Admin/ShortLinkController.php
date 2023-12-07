<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function index()
    {
        return view('admin.shortlinks');
    }

    public function show(ShortLink $shortLink)
    {
        return redirect($shortLink->long_url);
        // return view('short-links.redirect', compact('shortLink'));

    }

}

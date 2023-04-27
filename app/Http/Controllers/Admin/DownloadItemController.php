<?php

namespace App\Http\Controllers\Admin;

use App\Models\DownloadItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\DownloadLinkType;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class DownloadItemController extends Controller
{
    public function index(Product $product)
    {

        return view('admin.products.download-items', compact('product'));
    }

}
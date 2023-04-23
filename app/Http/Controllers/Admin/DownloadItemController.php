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
        $product = $product->loadMissing('downloadItems');
        return view('admin.products.download-items', compact('product'));
    }
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            'type' => ['required', Rule::in(DownloadLinkType::toArray())],
        ]);
        $product->downloadItems()->create($validated);

        return back()->with('message', 'Download Link added');
    }
    public function destroy(Request $request, DownloadItem $downloadItem)
    {
        $downloadItem->delete();
        return back()->with('message', 'Download Link Deleted');
    }
}
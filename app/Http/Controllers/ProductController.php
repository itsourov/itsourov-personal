<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->with('media')->withCount('reviews')->withAvg('reviews', 'rating')->paginate(12);


        return view('products.index', [
            'products' => $products,
        ]);
    }
    public function show(Product $product)
    {
        $product->loadMissing('categories', 'media')->loadAvg('reviews', 'rating');

        $reviews = $product->reviews()->with('user')->paginate(3, ['*'], 'reviews_page');
        $links = $product->downloadItems()->paginate(3);


        return view('products.show', compact('product', 'reviews', 'links'));
    }

}
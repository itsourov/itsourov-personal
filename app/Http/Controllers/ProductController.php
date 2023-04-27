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

        // return $products;

        return view('products.index', [
            'products' => $products,
        ]);
    }
    public function show(Product $product)
    {
        $product->loadMissing('categories', 'media')->loadAvg('reviews', 'rating')->loadCount('reviews');

        // $links = $product->downloadItems()->paginate(3);


        return view('products.show', compact('product'));
    }

}
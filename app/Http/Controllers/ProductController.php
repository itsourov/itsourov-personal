<?php

namespace App\Http\Controllers;

use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {

        return view('products.index');
    }
    public function show(Product $product)
    {
        $product->loadMissing('categories', 'media')->loadAvg('reviews', 'rating')->loadCount('reviews');

        // $links = $product->downloadItems()->paginate(3);


        return view('products.show', compact('product'));
    }

}
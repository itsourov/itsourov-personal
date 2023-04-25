<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user_count = User::count();
        $product_count = Product::count();
        return view('admin.dashboard.index', compact('user_count', 'product_count'));
    }
}
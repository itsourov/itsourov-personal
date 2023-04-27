<?php

namespace App\Http\Controllers\Admin\Bkash;

use Illuminate\Http\Request;
use App\Models\BkashTransaction;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = BkashTransaction::paginate(10);
        return view('admin.bkash.transactions.index', compact('transactions'));
    }
    public function showtTransaction(Request $request, BkashTransaction $bkashTransaction)
    {
        return view('admin.bkash.transactions.show', compact('bkashTransaction'));
    }
}
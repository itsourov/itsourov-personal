<?php

namespace App\Http\Controllers\Admin\Bkash;

use App\Http\Helpers\BkashTokenized;
use Illuminate\Http\Request;
use App\Models\BkashTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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

    public function searchTransaction(Request $request)
    {
        if ($request->trxID) {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'authorization' => BkashTokenized::getToken(),
                'x-app-key' => config('bkash.tokenized.app_key'),
            ])->post(config('bkash.tokenized.searchTransactionUrl'), [
                    'trxID' => $request->trxID,
                ]);

            $response = $response->json();

        } else {
            $response = [];
        }

        return view('admin.bkash.transactions.search', compact('response'));
    }
    public function refundStatus(Request $request)
    {
        if ($request->trxID && $request->paymentID) {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'authorization' => BkashTokenized::getToken(),
                'x-app-key' => config('bkash.tokenized.app_key'),
            ])->post(config('bkash.tokenized.refundStatusURL'), [
                    'trxID' => $request->trxID,
                    'paymentID' => $request->paymentID,
                ]);

            $response = $response->json();

        } else {
            $response = [];
        }


        return view('admin.bkash.transactions.refund_status', compact('response'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BkashTransaction extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bkash_transactionable_id',
        'bkash_transactionable_type',
        'amount',
        'paymentCreateTime',
        'paymentExecuteTime',
        'currency',
        'customerMsisdn',
        'payerReference',
        'intent',
        'merchantInvoiceNumber',
        'paymentID',
        'transactionStatus',
        'trxID',
        'refundTime',
        'refundTrxID',

    ];

    public function bkashTransactionable(): MorphTo
    {
        return $this->morphTo();
    }
}
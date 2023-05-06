<?php

namespace App\Models;

use App\Models\Activity;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $appends = array('isPaid');
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_total',
        'order_status',
        'payment_status',
        'order_note',
        'name',
        'email',
        'phone',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function getIsPaidAttribute()
    {
        return $this->payment_status == PaymentStatus::Paid;
    }
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'activityable');
    }
    public function bkashTransactions(): MorphMany
    {
        return $this->morphMany(BkashTransaction::class, 'bkash_transactionable');
    }
}
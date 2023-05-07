<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BkashAgreement;
use Spatie\Image\Manipulations;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'access_token',
        'refresh_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaConversions(Media $media = null): void
    {

        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->nonQueued();
    }
    public function cartItems()
    {
        return $this->belongsToMany(Product::class, CartItem::class)->withPivot('quantity');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function purchasedItems()
    {
        return $this->belongsToMany(Product::class)->withPivot('expiration_date');
    }

    /**
     * Get the phone associated with the user.
     */
    public function bkashAgreement(): HasOne
    {
        return $this->hasOne(BkashAgreement::class);
    }
}
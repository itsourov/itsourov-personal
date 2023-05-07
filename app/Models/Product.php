<?php

namespace App\Models;

use App\Models\DownloadItem;
use App\Models\ProductCategory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $appends = array('isPurchased');
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'selling_price',
        'original_price',
        'short_description',
        'long_description',
        'aditional_info',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function registerMediaConversions(Media $media = null): void
    {

        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 500, 280)
            ->nonQueued();


    }


    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }


    public function downloadItems()
    {
        return $this->morphMany(DownloadItem::class, 'download_itemable');
    }

    public function reviews()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->with(['user.media', 'replies.user.media'])->withTrashed();
    }

    public function getFallbackImage()
    {
        return view('inc.fallback-image');
    }
    public function getFallbackImageUrl(): string
    {
        return asset('images/fallback.png');
    }
    public function getIsPurchasedAttribute(): bool
    {
        return auth()->user()?->purchasedItems->contains($this) ?? false;
    }

}
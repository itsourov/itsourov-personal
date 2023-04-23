<?php

namespace App\Models;

use App\Models\DownloadItem;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'images',
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



    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function downloadItems()
    {
        return $this->morphMany(DownloadItem::class, 'download_itemable');
    }

    public function reviews()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->with(['user.media', 'replies.user.media'])->withTrashed();
    }

}
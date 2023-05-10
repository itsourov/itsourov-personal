<?php

namespace App\Models;

use App\Enums\VisibilityStatus;
use App\Models\User;
use App\Models\PostCategory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'count',
        'title',
        'slug',
        'content',
    ];


    protected static function boot()
    {
        parent::boot();

    }

    public function scopeSearch($query, $searchQuery)
    {


        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('content', 'like', '%' . $searchQuery . '%');
        }


    }
    public function scopePublic($query)
    {
        return $query->where('status', VisibilityStatus::public );
    }
    public function scopeDraft($query)
    {
        return $query->where('status', VisibilityStatus::draft);
    }

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
    public function getFallbackImage(): string
    {
        return view('inc.fallback-image');
    }
    public function getFallbackImageUrl(): string
    {
        return asset('images/fallback.png');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->with(['user.media', 'replies.user.media'])->withTrashed();
    }
    public function categories()
    {
        return $this->belongsToMany(PostCategory::class);
    }





}
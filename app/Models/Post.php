<?php

namespace App\Models;

use App\Jobs\SubscribePost;
use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'image'];

    protected $policy = PostPolicy::class;


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {

            $post->slug = Str::slug($post->title);

            if ($post->isDirty('title') && static::where('title', $post->title)->exists()) {
                $count = 1;

                while (static::where('slug', $post->slug)->where('id', '!=', $post->id)->exists()) {
                    $count++;
                    $post->slug = Str::slug($post->title) . '-' . $count;
                }
            }
        });

        static::created(function () {

            $subscribers = Subscription::get();

            foreach ($subscribers as $subscriber) {
                dispatch(new SubscribePost($subscriber->subscribe_email));
            }

        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->with("category")->first();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=["name"];

    use HasFactory;


    public static function findByName($name)
    {
        return self::where('name', $name)->first();
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}

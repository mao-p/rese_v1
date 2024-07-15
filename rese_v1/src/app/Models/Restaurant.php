<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre',
        'area',
        'image',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
    {
    return $this->belongsToMany(User::class, 'favorite_restaurants', 'restaurant_id', 'user_id')->withTimestamps();
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/images/' . $this->image) : asset('storage/images/default.png');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id'); // 新しい画像テーブルとの関連付け
    }


}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    //Usersテーブルと紐付け
    public function user()
        {
            return $this->belongsTo(User::class);
        }

    protected $fillable = [
        'user_id',
        'item_name',
        'condition',
        'status',
        'description',
        'price',
    ];

    //itemimageテーブルとのリレーション
    public function itemImages()
    {
        return $this->hasMany(ItemImage::class);
    }

    //favoriteテーブルとのリレーション
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    //purchasesテーブルとのリレーション
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    //commentテーブルとのリレーション
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

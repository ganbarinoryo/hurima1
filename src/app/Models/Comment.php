<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'item_id', 'comment', 'created_at', 'updated_at', 'deleted_at'];

    //usereテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //itemsテーブルとのリレーション
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

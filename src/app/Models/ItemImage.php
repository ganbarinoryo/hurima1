<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['item_id', 'image_url', 'created_at', 'updated_at', 'deleted_at'];

    //itemsテーブルとのリレーション
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

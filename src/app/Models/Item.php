<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

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
}

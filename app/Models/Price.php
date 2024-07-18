<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;


class Price extends Model
{
    public function store() {
        return $this->belongsTo(Store::class);
    }

    protected $fillable = [
        'date',
        'item_id',
        'average_price',
        'high_price',
        'low_price',
    ];
}

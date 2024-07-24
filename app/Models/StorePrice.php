<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorePrice extends Model
{
    use HasFactory;

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    protected $fillable = [
        'date',
        'item_id',
        'store_id',
        'average_price',
        'high_price',
        'low_price',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyPrice extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected $fillable = [
        'month',
        'item_id',
        'average_price',
        'high_price',
        'low_price',
    ];
}

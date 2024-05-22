<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function store_items() {
        return $this->belongsToMany(Store::class)->withTimestamps();
    }

    public function follower_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

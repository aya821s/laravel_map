<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function favorited_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}

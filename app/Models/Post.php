<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PostCreated;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function favorited_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    //メール通知
    protected $fillable = ['user_id', 'item_id', 'price', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            event(new PostCreated($post));
        });
    }

}

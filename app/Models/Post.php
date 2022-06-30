<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "heading",
        "slug",
        "content",
        "user_id",
        "tags",
        "cover_image",
        "public"
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function scopeFilter($querry, array $filters) {
        if($filters["q"] ?? false) {
            $querry->where("heading", 'like', '%' . request('q') . '%')->orWhere("content", 'like', '%' . request('q') . '%')->orWhere("tags", 'like', '%' . request('q') . '%');
        }
    }

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function likes() {
        return $this->belongsToMany(User::class, "likes");
    }

    public function comments() {
        return $this->hasMany(Comment::class, "post_id");
    }
}
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
        "content"
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
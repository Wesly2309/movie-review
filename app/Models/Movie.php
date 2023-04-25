<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cast;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'description', 'rating_star'];

    public function casts() {
        return $this->belongsToMany(Cast::class)->withPivot('role')->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    
}

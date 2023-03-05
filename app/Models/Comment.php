<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id', 'content'];
    public function user() {
        return $this->belongsToMany(User::class);
    }

    public function movie() {
        return $this->belongsToMany(Movie::class);
    }
}

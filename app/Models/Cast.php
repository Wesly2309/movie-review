<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'role'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class)->withPivot('role');
    }
}

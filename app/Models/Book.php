<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;
    protected $fillable = ['title', 'author', 'category', 'stock', 'foto', 'sinopsis'];

    public function reviews() {
        return $this->hasMany(Review::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loan extends Model{

    use HasFactory;

    protected $fillable = [
        'book_id', 'user_id', 'borrow_date', 'return_date', 'status', 'fine '
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

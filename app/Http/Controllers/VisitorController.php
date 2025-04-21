<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller {
    public function index() {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access'); // User belum login
        }

        if (Auth::user()->role !== 'visitor') {
            abort(403, 'Access denied'); // Role tidak sesuai
        }
        $books = Book::all();
        return view('visitor.index', compact('books'));

    }
}

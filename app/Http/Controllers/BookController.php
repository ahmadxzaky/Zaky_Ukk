<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotodata', 'public');
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'stock' => $request->stock,
            'foto' => $fotoPath,
            'sinopsis' => $request->sinopsis
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category' => 'required|string',
            'stock' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sinopsis' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotodata', 'public');
            $book->foto = $fotoPath;
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'stock' => $request->stock,
            'foto' => $book->foto,
            'sinopsis' => $request->sinopsis
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function show(Book $book, $id)
{
    $book = Book::findOrFail($id);
    return view('books.show', compact('book'));
}

}

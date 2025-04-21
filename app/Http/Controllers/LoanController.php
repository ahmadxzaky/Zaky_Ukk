<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;



class LoanController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        // Kalau visitor, ambil hanya peminjamannya sendiri
        if ($user->role === 'visitor') {
            $loans = Loan::with('book')
                ->where('user_id', $user->id)
                ->get();
        } else {
            // Kalau admin atau officer, ambil semua data peminjaman
            $loans = Loan::with('user', 'book')->get();
        }

        return view('loans.index', compact('loans'));
    }


    public function create()
    {
        $books = Book::where('stock', '>', 0)->get(); // Hanya tampilkan buku dengan stok > 0
        if ($books->isEmpty()) {
            return redirect()->route('books.index')->with('error', 'Tidak ada buku yang tersedia untuk dipinjam.');
        }
        return view('loans.create', compact('books'));
    }

    public function show($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loans.show', compact('loan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);
        if ($book->stock < 1) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        Loan::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'borrow_date' => now(),
            'status' => 'borrowed',
        ]);

        // Kurangi stok buku
        $book->decrement('stock');

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dipinjam!');
    }

    public function destroy($id)
    {
        $loan = Loan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($loan->status === 'borrowed') {
            return redirect()->back()->with('error', 'Buku masih dipinjam, tidak bisa dihapus.');
        }

        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status === 'returned') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya!');
        }

        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        $loan->book->increment('stock');

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan!');
    }



    public function exportPdf()
    {
        $loans = auth()->user()->role === 'visitor'
            ? Loan::with('book')->where('user_id', auth()->id())->get()
            : Loan::with('user', 'book')->get();

        $pdf = PDF::loadView('loans.report', compact('loans'));
        return $pdf->download('laporan_peminjaman.pdf');
    }
}

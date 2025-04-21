<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;

class OfficerController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user', 'book')->get();
        return view('officers.index', compact('loans'));
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->route('officers.index')->with('success', 'Loan deleted successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book added successfully');
    }

}
?>

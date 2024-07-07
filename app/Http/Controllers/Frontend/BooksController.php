<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        // $books = Book::all();
        $books = Book::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $books->where('title', 'like', '%' . $request->keyword . '%');
        }
        $books = $books->where('status', 1)->paginate(8);

        return view('frontend.books.index', compact('books'));
    }

    /**
     * Single books
     */

    // public function show($slug)
    // {

    //     $book = Book::where('slug', $slug)->first();

    //     return view('frontend.books.show', compact('book'));
    // }

    public function detail($id)
    {

        $book = Book::findOrFail($id);

        // if ($book->status == 0) {
        //     abort(404);
        // }

        $relatedBooks = Book::where('status', 1)->take(3)->where('id', "!=", $id)->inRandomOrder()->get();
        // dd($relatedBooks);

        return view('frontend.book-details', compact('book', 'relatedBooks'));

    }

}

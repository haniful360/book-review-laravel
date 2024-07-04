<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('frontend.books.index', compact('books'));
    }

    /**
     * Single books
     */

    public function show($slug)
    {

        $book = Book::where('slug', $slug)->first();

        return view('frontend.books.show', compact('book'));
    }

}

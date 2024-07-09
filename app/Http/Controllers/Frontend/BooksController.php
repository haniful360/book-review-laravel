<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $book = Book::with(['reviews.user', 'reviews' => function ($query) {
            $query->where('status', 1);
        }])->findOrFail($id);

        $book = Book::with('reviews', 'reviews.user')->findOrFail($id);

        // echo $book;
        // if ($book->status == 0) {
        //     abort(404);
        // }

        $relatedBooks = Book::where('status', 1)->take(3)->where('id', "!=", $id)->inRandomOrder()->get();
        // dd($relatedBooks);

        return view('frontend.book-details', compact('book', 'relatedBooks'));

    }

    public function saveReview(ReviewRequest $request)
    {

        // $bookId = Book::where('id', $book_id)->first();

        $countReview = Review::where('user_id', Auth::user()->id)
            ->where('book_id', $request->book_id)
            ->count();

        if ($countReview > 0) {
            // session()->flash('error', 'You already submited a review');
            return redirect()->back()->with('error', 'You already submited a review');
        }

        $review = new Review();

        $review->reviews = $request->reviews;
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->book_id = $request->book_id;
        $review->save();

        return redirect()->back()->with('success', 'Review submited Successfully');
    }
}

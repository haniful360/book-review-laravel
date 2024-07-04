<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $books = Book::orderBy('created_at', 'asc');
        if (!empty($request->keyword)) {
            $books->where('title', 'like', '%' . $request->keyword . '%');
        }

        $books = $books->paginate(3);

        return view('books.list', [
            'books' => $books,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->title);

        $countSlug = Book::where('slug', $slug)->count();
        if ($countSlug > 0) {
            $slug = $slug . '-' . time();
        }

        $book = new Book();
        $book->title = $request->title;
        $book->slug = $slug;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        // upload book image

        if ($request->hasFile('image')) {

            if ($book->image) {
                File::delete(public_path('uploads/books/' . $book->image));
            }

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/books'), $imageName);

            $book->image = $imageName;
            $book->save();
        }

        return redirect()->route('books.index', [
            'book' => $book,
        ])->with('success', 'Books added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrfail($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrfail($id);

        // $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        // upload book image

        if ($request->hasFile('image')) {

            if ($book->image) {
                File::delete(public_path('uploads/books/' . $book->image));
            }

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/books'), $imageName);

            $book->image = $imageName;
            $book->save();
        }

        return redirect()->route('books.index', [
            'book' => $book,
        ])->with('success', 'Books update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrfail($id);
    }
}

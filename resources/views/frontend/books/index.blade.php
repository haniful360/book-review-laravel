@extends('layouts.app')

@section('main')
    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-3">Books</h2>
                    <div class="mt-2">
                        <a href="{{ url('/') }}" class="text-dark">Clear</a>
                    </div>
                </div>
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <form action="{{ url('') }}" method="GET">
                            <div class="row">
                                <div class="col-lg-11 col-md-11">
                                    <input type="text" name='keyword' class="form-control form-control-lg"
                                        placeholder="Search by title">
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <button class="btn btn-primary btn-lg w-100"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($books as $book)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card border-0 shadow-lg">
                                <a href="{{route('book.detail', $book->id)}}">
                                    @if ($book->image)
                                        <img src="{{ asset('uploads/books/' . $book->image) }}" alt="book"
                                            class="card-img-top">
                                    @else
                                        <img src="https://via.placeholder.com/990x1500?text=No Image" alt="book"
                                            class="img-fluid card-img-top">
                                    @endif
                                </a>
                                <div class="card-body">
                                    {{-- <a href="{{ route('single.books', $book->slug) }}"
                                        class="stretched-link"></a> --}}
                                    <h3 class="h4 heading">
                                            {{ $book->title }}</h3>
                                    <p>by {{ $book->author }}</p>
                                    <div class="star-rating d-inline-flex ml-2" title="">
                                        <span class="rating-text theme-font theme-yellow">5.0</span>
                                        <div class="star-rating d-inline-flex mx-2" title="">
                                            <div class="back-stars ">
                                                <i class="fa fa-star " aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>

                                                <div class="front-stars" style="width: 100%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="theme-font text-muted">(2 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- pagination --}}
                    {{ $books->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection

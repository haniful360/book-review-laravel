@extends('layouts.app')

@section('main')
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card " style="width: 40rem;">
            <img style="height: 400px" class="w-100 rounded mx-auto" src="{{ asset('uploads/books/' . $book->image) }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

    </div>
@endsection

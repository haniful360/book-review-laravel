@extends('layouts.app')
@section('main')
    <div class="card  w-50 mx-auto mt-5">
        <div class="row g-0">
            <div class="col">
                <div class="card-body ">
                    <h2 class="card-title">
                        <a href="" class="stretched-link">
                            {{ $book->title }}</a>
                        <p>{{ $book->author }}</p>
                    </h2><small></small>
                    <p class="mt-1 card-text text-muted"><small>Tag:
                            <strong class="tag javascript">{{ $book->status ? 'Active' : 'Block' }}</strong></small>
                    </p>
                    <p>{{ $book->description }}</p>
                    <img style='width:500px; height:350px' src="{{ asset('uploads/books/' . $book->image) }}"
                        class="img-fluid rounded mt-4 mx-auto" alt="Luna John">
                        <br>
                    {{ date('Y-m-d', strtotime($book->created_at)) }}
                </div>
            </div>
        </div>
    </div>
@endsection

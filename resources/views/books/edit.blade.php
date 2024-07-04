@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                        Welcome, {{ Auth::user()->name }}
                        {{-- @php
                        $user = Auth::user();
                        dd($user);
                    @endphp --}}
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if (Auth::user()->image)
                                <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}"
                                    class="img-fluid w-50 h-50 rounded-circle" alt="Luna John">
                            @endif
                        </div>
                        <div class="h5 text-center">
                            <strong>{{ Auth::user()->name }}</strong>
                            <p class="h6 mt-2 text-muted">5 Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-lg mt-3">
                    <div class="card-header  text-white">
                        Navigation
                    </div>
                    <div class="card-body sidebar">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Update Book
                    </div>
                    <form action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                    value="{{ $book->title }}" placeholder="Title" name="title" id="title" />
                                @error('title')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" value="{{ $book->author }}"
                                    class="form-control  @error('author') is-invalid @enderror" placeholder="Author"
                                    name="author" id="author" />
                                @error('author')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30"
                                    rows="5">
                                    {{ $book->description }}
                                </textarea>

                            </div>

                            <div class="mb-3">
                                <label for="Image" class="form-label">Image</label>
                                <input type="file" class="form-control  @error('image') is-invalid  @enderror"
                                    name="image" id="image" />
                                @error('image')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror

                            </div>
                            <div>
                                {{-- @if (!empty($book->image))
                                    <img src="{{ asset('uploads/books/') . $book->image }}" alt="book">
                                @endif --}}
                                <img class="w-25 h-25" src="{{ asset('uploads/books/'. $book->image )}}" alt="book">
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $book->status === 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $book->status === 0 ? 'selected' : '' }}>Block</option>
                                </select>
                            </div>
                            <button class="btn btn-primary mt-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

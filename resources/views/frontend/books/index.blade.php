<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- {{ $books }} --}}
    @foreach ($books as $book)
        <div class="card border-0 mb-5">
            <div class="row g-0">
                <div class="col">
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="{{ route('single.books', $book->slug) }}" class="stretched-link">
                                {{ $book->title }}</a>
                        </h2><small></small>
                        <p class="mt-1 card-text text-muted"><small>Tag:
                                <strong class="tag javascript">{{ $book->status ? 'Active' : 'Block' }}</strong></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="card border-0 mb-5">
        <div class="row g-0">
            <div class="col">
                <div class="card-body">
                    <h2 class="card-title">
                        <a href="" class="stretched-link">
                            {{ $book->title }}</a>
                        <p>{{ $book->author }}</p>
                    </h2><small></small>
                    <p class="mt-1 card-text text-muted"><small>Tag:
                            <strong class="tag javascript">{{ $book->status ? 'Active' : 'Block' }}</strong></small>
                    </p>
                    <p>{{ $book->description }}</p>
                    <img style='width:200px; height:200px' src="{{ asset('uploads/books/' . $book->image) }}"
                        class="img-fluid rounded mt-4" alt="Luna John">
                    {{ date('Y-m-d', strtotime($book->created_at)) }}
                </div>
            </div>
        </div>
    </div>

</body>

</html>

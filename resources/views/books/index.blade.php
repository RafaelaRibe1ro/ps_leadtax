<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Disponíveis</title>
    <link rel="stylesheet" href="{{ asset('css/styleBook.css') }}">
</head>
<body>
    <h1>Scraping de Produtos de um E-commerce - Livros</h1>
    <div class="products-container">
        @foreach($books as $book)
            <div class="product-card">
                <img src="{{ $book->image_url }}" alt="{{ $book->title }}">
                <h2>{{ $book->title }}</h2>
                <p class="price">{{ $book->price }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Scraping de Produtos de um E-commerce - Produtos</h1>
    <div class="product-container">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <h2>{{ $product->name }}</h2>
                <p class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="description">{{ $product->description }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>

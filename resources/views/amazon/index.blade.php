<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos da Amazon</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Scraping de Produtos de um E-commerce - Gaming mouse</h1>
    <div class="products-container">
        @foreach($amazonProducts as $product)
            <div class="product-card">
                <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
                <h2>{{ $product->title }}</h2>
                <p class="price">{{ $product->price }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>

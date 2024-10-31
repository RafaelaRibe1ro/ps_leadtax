<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function storeBooks(Request $request)
    {
        $books = $request->input('books');

        foreach ($books as $bookData) {
            Book::create([
                'title' => $bookData['title'],
                'price' => $bookData['price'],
                'image' => $bookData['image'],
            ]);
        }

        return response()->json(['message' => 'Books saved successfully!']);
    }
}

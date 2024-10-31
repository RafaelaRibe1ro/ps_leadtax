<?php

namespace App\Http\Controllers;

use App\Models\AmazonProduct;

class AmazonProductController extends Controller
{
    public function index()
    {
        $amazonProducts = AmazonProduct::all();
        return view('amazon.index', compact('amazonProducts'));
    }
}

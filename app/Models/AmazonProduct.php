<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'image_url',
    ];
}

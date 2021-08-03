<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    public function store()
    {
        Book::create([
            "title" => request("title"),
            "description" => request("description"),
            "author_id" => request("author_id"),
            "ISBN" => request("ISBN"),
        ]);

        return response(["message" => "Created"], 201);
    }


    
}

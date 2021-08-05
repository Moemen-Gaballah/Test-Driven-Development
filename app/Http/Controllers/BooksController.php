<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookRequest;

class BooksController extends Controller
{
    public function create()
    {
        return view('books.book_creation');
    }

    public function store(BookRequest $request)
    {
        // $request->validate(["title" => "required"]);

        Book::create([
            "title" => request("title"),
            "description" => request("description"),
            "author_id" => request("author_id"),
            "ISBN" => request("ISBN"),
        ]);

        return response(["message" => "Created"], 201);
    }


    
}

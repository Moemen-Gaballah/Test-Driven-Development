<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookRequest;

class BooksController extends Controller
{
    public function index()
    {
        return response()->json(["books" => BookResource::collection(Book::all())]);
    }

    public function create()
    {
        return view('books.book_creation');
    }

    public function store(BookRequest $request)
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

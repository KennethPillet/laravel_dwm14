<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $books = Book::filter('', 'genres');
            return new BookCollection($books->paginate(10));
        /* if(){
            $books = Book::orderBy('title', 'asc');
            return new BookCollection($books->paginate(10));
        }
        else if(){
            $books = Book::orderBy('description', 'asc');
            return new BookCollection($books->paginate(10));
        } else if(){
            
        }
        else{
            return new BookCollection(Book::paginate(10));
        } */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newBook = Book::addBook($request->all());

        return response()->json($newBook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json($book, 200); 
        return response()->json("Ce livre n'existe pas", 404); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $updatedBook =  Book::updateBook($book, $request->all());

        return response()->json($updatedBook, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json('', 204);
    }
}

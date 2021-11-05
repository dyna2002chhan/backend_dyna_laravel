<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Book::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $book = new Book();
        $book->author_id=$request->author_id;
        $book->title=$request->title;
        $book->body=$request->body;
        $book->save();
        return response()->json(['Book'=>'Created'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Book::with('author')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $book = Book::findOrFail($id);
        // $book->author_id=$request->author_id;
        $book->title=$request->title;
        $book->body=$request->body;
        $book->save();
        return response()->json(['Book'=>'Updated'],200);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = Book::destroy($id);
        if($isDeleted === 1){
            return response()->json(['message' => 'deleted'], 200);
        }else{
            return response()->json(['message' => 'id not found'],404);
        }
    }
}

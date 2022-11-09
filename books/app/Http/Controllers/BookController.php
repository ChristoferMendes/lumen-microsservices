<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BookController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of authors
     *
     * @return Response
     */
    public function index() {
        $books = Book::all();
 
        return $this->successResponse($books);
    }

    /**
     * Create an author
     *
     * @return Response
     */
    public function store(Request $request) {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Show details of an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function show($id) {
       $book = Book::findOrFail($id);

       return $this->successResponse($book);
      
    }

    /**
     * Modify an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request) {
        $book = Book::findOrFail($id);

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);
        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change',
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);
    }

    /**
     * Remove an axisting author
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id) {
       
    }
    
}

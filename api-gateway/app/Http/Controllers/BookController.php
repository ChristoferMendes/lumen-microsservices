<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class BookController extends Controller
{

    use ApiResponser;

    /**
     * The service to consume the books microsservice
     *
     * @var BookService
     */
    public $bookService;

    /**
     * The service to consume the authors microsservice
     *
     * @var AuthorService
     */
    public $authorService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return the list of books
     *
     * @return Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create an book
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $this->authorService->obtainAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($data, Response::HTTP_CREATED));
    }

    /**
     * Show details of an existing book
     *
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {

        return $this->successResponse($this->bookService->obtainBook($id));
    }

    /**
     * Modify an existing book
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        return $this->successResponse($this->bookService->editBook($id, $data));
    }

    /**
     * Remove an axisting book
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse($this->bookService->deleteBook($id));
    }
}

<?php

namespace App\Http\Controllers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Return the list of authors
     *
     * @return Response
     */
    public function index() {
      return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create an author
     *
     * @return Response
     */
    public function store(Request $request) {
       
    }

    /**
     * Show details of an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function show($id) {
       
      
    }

    /**
     * Modify an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request) {
       
    }

    /**
     * Remove an axisting author
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }
    
}

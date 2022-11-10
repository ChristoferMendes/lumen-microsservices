<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class AuthorController extends Controller
{


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

<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
        $authors = Author::all();
        

        return $this->successResponse($authors);
    }

    /**
     * Create an author
     *
     * @return Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * Show details of an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function show($id) {
        $author = Author::findOrFail($id);

        return $this->successResponse($author);
      
    }

    /**
     * Modify an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request) {
        $author = Author::findOrFail($id);

        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse('At least one value must change',
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author);
    }

    /**
     * Remove an axisting author
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id) {
        $author = Author::findOrFail($id);

        $author->delete();

        return $this->successResponse($author);
    }
    
}

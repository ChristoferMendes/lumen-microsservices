<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\AuthorService;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return the list of authors
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create one new author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();
        return $this->successResponse($this->authorService->createAuthor($all, Response::HTTP_CREATED));
    }

    /**
     * Obtains and show one author
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->authorService->obtainAuthor($id));
    }

    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->successResponse($this->authorService->editAuthor($id, $data));
    }

    /**
     * Remove an existing author
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse($this->authorService->deleteAuthor($id));
    }
}
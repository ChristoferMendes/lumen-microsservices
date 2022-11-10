<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the authors service
     * @var string
     */
    public $baseUri;
    
    /**
     * The secret of authors
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    

    /**
     * Obtain the full list of author from the author service
     * @return string
     */
    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');

    }

    /**
     * Create one author using the author service
     * @return string
     */
    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Obtain one single author from the author service
     * @return string
     */
    public function obtainAuthor($id)
    {
       return $this->performRequest('GET', "/authors/$id");
    }

    /**
     * Update an instance of author using the author service
     * @return string
     */
    public function editAuthor($id, $data)
    {
       return $this->performRequest('PUT', "/authors/$id", $data);
    }

    /**
     * Remove a single author using the author service
     * @return string
     */
    public function deleteAuthor($id)
    {
       return $this->performRequest('DELETE', "/authors/$id");
    }
}

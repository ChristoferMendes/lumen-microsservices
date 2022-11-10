<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService {
  use ConsumesExternalService;

  /**
   * THe base uri to consume books service
   * @var string
   */

   public $baseUri;

   public function __construct() {
    
    $this->baseUri = config('services.books.base_uri');
    
   }

    /**
     * Obtain the full list of author from the author service
     * @return string
     */
    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }
}

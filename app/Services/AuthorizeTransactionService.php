<?php

namespace App\Services;

use App\Contracts\Authorizable;

class AuthorizeTransactionService
{
    public function __construct(
        protected Authorizable $authorizer = new MockyAuthorizer
    ) {
    }
    
    public function authorize(): bool
    {
        return $this->authorizer->authorize();
    }
}

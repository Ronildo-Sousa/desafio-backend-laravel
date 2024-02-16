<?php

namespace App\Services;

use App\Contracts\Authorizable;
use Illuminate\Support\Facades\Http;

class MockyAuthorizer implements Authorizable
{
    private string $url;

    public function __construct()
    {
        $this->url = config('mocky-authorizer.url');
    }

    public function authorize(): bool
    {
        $response = Http::get($this->url);
        
        return $response->json()['message'] === 'Autorizado';
    }
}

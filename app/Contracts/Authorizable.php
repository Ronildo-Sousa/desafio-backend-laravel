<?php
namespace App\Contracts;

use App\Models\Wallet;

interface Authorizable
{
    public function authorize(): bool;
}
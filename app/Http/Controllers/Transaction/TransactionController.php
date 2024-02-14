<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private TransactionService $transactionService
    ) {
    }

    public function index()
    {
        return 'transactions endpoint';
    }

    public function store(Request $request)
    {
        $this->transactionService->makeTransaction();
    }

    public function show(string $id)
    {
        //
    }
}

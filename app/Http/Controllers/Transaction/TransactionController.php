<?php

namespace App\Http\Controllers\Transaction;

use App\DTOs\TransactionDTO;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $result = $this->transactionService->makeTransaction(TransactionDTO::make($request->all()));

        return response()->json(['transaction' => $result], Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        //
    }
}

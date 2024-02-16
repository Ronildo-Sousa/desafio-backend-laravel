<?php

namespace App\Http\Controllers\Transaction;

use App\DTOs\TransactionDTO;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Exception;
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
        try {
            $transaction = $this->transactionService->makeTransaction(TransactionDTO::make($request->all()));

            return response()->json(['data' => $transaction], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function show(string $id)
    {
        //
    }
}

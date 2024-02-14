<?php
namespace App\Services;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function makeTransaction(TransactionDTO $transactionDTO): TransactionDTO
    {
        try {
            DB::beginTransaction();

            $transaction = Transaction::query()->create($transactionDTO->toArray());
            return TransactionDTO::make($transaction->toArray());
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
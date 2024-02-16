<?php

namespace App\Services;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function makeTransaction(TransactionDTO $transactionDTO): TransactionDTO
    {
        try {
            DB::beginTransaction();

            $sender = Wallet::find($transactionDTO->sender_id);
            $receiver = Wallet::find($transactionDTO->receiver_id);

            $sender->decrement('balance', ($transactionDTO->amount * 100));
            $receiver->increment('balance', ($transactionDTO->amount * 100));
            
            $sender->update();
            $receiver->update();
        
            $transaction = Transaction::query()->create($transactionDTO->toArray());

            DB::commit();

            return TransactionDTO::make($transaction->toArray());
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}

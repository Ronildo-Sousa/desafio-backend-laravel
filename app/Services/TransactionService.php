<?php

namespace App\Services;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TransactionService
{
    public function makeTransaction(TransactionDTO $transactionDTO)
    {
        DB::beginTransaction();

        $sender = Wallet::find($transactionDTO->sender_id);
        $receiver = Wallet::find($transactionDTO->receiver_id);

        $sender->balance = (($sender->balance * 100) - ($transactionDTO->amount * 100)) / 100;
        $receiver->balance = (($receiver->balance * 100) + ($transactionDTO->amount * 100)) / 100;
        
        if ($sender->balance < 0) {
            DB::rollBack();
            throw new Exception('insufficient balance', Response::HTTP_UNAUTHORIZED);
        }

        $isAuthorized = (new AuthorizeTransactionService)->authorize();
        if (!$isAuthorized) {
            throw new Exception('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $sender->update();
        $receiver->update();

        $transaction = Transaction::query()->create($transactionDTO->toArray());

        DB::commit();

        return TransactionDTO::make($transaction->toArray());
    }
}

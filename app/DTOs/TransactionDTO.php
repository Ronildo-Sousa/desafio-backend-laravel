<?php
namespace App\DTOs;

use App\DTOs\DTOInterface;
use App\Enums\TransactionStatus;

class TransactionDTO implements DTOInterface
{   
    public function __construct(
        private readonly int $sender_id,
        private readonly int $receiver_id,
        private readonly float $amount,
        private readonly ?string $status,
    ){    
    }

    public static function make(array $data): self
    {
        return new TransactionDTO(
            sender_id: data_get($data, 'sender_id'),
            receiver_id: data_get($data, 'receiver_id'),
            amount: data_get($data, 'amount'),
            status: data_get($data, 'status') ?? TransactionStatus::Pending->value,
        );
    }

    public function toArray(): array
    {
        return [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ];
    }
}
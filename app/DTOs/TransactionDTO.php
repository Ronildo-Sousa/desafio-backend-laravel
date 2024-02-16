<?php
namespace App\DTOs;

use App\DTOs\DTOInterface;
use App\Enums\TransactionStatus;
use Money\Currencies\ISOCurrencies;
use Money\Money;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;

class TransactionDTO implements DTOInterface
{   
    public function __construct(
        public readonly int $sender_id,
        public readonly int $receiver_id,
        public readonly float $amount,
        public readonly ?string $status,
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
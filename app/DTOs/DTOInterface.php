<?php
namespace App\DTOs;

interface DTOInterface
{
    public static function make(array $data): self;
    public function toArray(): array;
}

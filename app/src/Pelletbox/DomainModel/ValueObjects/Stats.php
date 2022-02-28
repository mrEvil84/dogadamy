<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

use DateTime;

final class Stats
{
    private int $bagAmount;
    private DateTime $date;

    public function __construct(int $bagAmount, DateTime $date)
    {
        $this->bagAmount = $bagAmount;
        $this->date = $date;
    }

    public static function formRaw(\stdClass $rawItem): self
    {
        return new self(
            $rawItem->bagAmount,
            DateTime::createFromFormat('Y-m-d H:i:s', $rawItem->createdAt)
        );
    }

    public function getBagAmount(): int
    {
        return $this->bagAmount;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getDateAsString(): string
    {
        return $this->date->format('Y-m-d');
    }

    public function toArray(): array
    {
        return [
            'bagAmount' => $this->bagAmount,
            'createdAt' => $this->date->format('Y-m-d H:i:s'),
        ];
    }
}

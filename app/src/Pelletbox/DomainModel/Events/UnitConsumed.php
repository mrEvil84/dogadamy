<?php

namespace App\src\Pelletbox\DomainModel\Events;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use DateTime;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use JsonException;

final class UnitConsumed extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Unit $unit;
    private DateTime $consumedAt;

    public function __construct(Unit $unit, DateTime $consumedAt)
    {
        $this->unit = $unit;
        $this->consumedAt = $consumedAt;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function getConsumedAt(): DateTime
    {
        return $this->consumedAt;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('pellet-consumed');
    }

    /**
     * @throws JsonException
     */
    public function getJsonEncoded(): string
    {
        return json_encode(
            $this->unit->toArray(),
         JSON_THROW_ON_ERROR);
    }
}

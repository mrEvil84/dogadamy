<?php

namespace App\src\Pelletbox\DomainModel\Events;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

final class PelletStatsCached extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private StatsCollection $statsCollection;

    public function __construct(StatsCollection $statsCollection)
    {
        $this->statsCollection = $statsCollection;
    }

    public function getStatsCollection(): StatsCollection
    {
        return $this->statsCollection;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('pellet-stats-cached');
    }
}

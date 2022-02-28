<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

class StatsCollectionAggregator
{
    private StatsCollection $statsCollection;

    public function __construct(StatsCollection $statsCollection)
    {
        $this->statsCollection = $statsCollection;
    }

    public function aggregateByDate(): array
    {
        $collection = $this->statsCollection->getCollection();
        $keys = array_keys($collection);
        $aggregated = [];
        foreach ($keys as $key) {
            /** @var \SplObjectStorage $storage */
            $storage = $collection[$key];
            $sum = 0;
            /** @var Stats $stats */
            foreach ($storage as $stats) {
                $sum += $stats->getBagAmount();
            }
            $aggregated[$key] = $sum;
        }
        return $aggregated;
    }
}

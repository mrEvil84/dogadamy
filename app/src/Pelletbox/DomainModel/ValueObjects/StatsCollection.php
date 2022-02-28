<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

final class StatsCollection
{
    private array $collection = [];

    public function add(Stats $stats): void
    {
        if (array_key_exists($stats->getDateAsString(), $this->collection)) {
            /** @var \SplObjectStorage $keyCollection */
            $keyCollection = $this->collection[$stats->getDateAsString()];
            $this->attach($keyCollection, $stats);

        } else {
            $keyCollection = new \SplObjectStorage();
            $this->attach($keyCollection, $stats);
            $this->collection[$stats->getDateAsString()] = $keyCollection;

        }
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    private function attach(\SplObjectStorage $collection, Stats $stats): void
    {
        if ($collection->contains($stats)) {
            return;
        }
        $collection->attach($stats);
    }

    public static function fromRawData(array $rawData): self
    {
        $statsCollection = new self();
        foreach ($rawData as $rawItem) {
            $statsCollection->add(Stats::formRaw($rawItem));
        }

        return $statsCollection;
    }

    public function toArray(): array
    {
        $data = [];
        $keys = array_keys($this->collection);

        foreach ($keys as $key) {
            /** @var \SplObjectStorage $storage */
            $storage = $this->collection[$key];
           /** @var Stats $stats */
            foreach ($storage as $stats) {
                $data[$key][] = $stats->toArray();
            }
        }

        return $data;
    }
}

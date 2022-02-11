<?php

declare(strict_types=1);

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidDataStructure;
use App\src\Pelletbox\Exceptions\InvalidValueException;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class PelletDbRepositoryProxy extends PelletDbRepository
{
    /**
     * @throws InvalidValueException
     * @throws InvalidDataStructure
     * @throws \JsonException
     */
    public function process(AMQPMessage $message): void
    {
        parent::process($message);
        Log::channel('pellet-db-logger-processed')->debug('processed:' . $message->body);
    }

    public function store(Unit $unit): void
    {
        parent::store($unit);
        Log::channel('pellet-db-logger-inserted')->debug('inserted:' . $unit);

    }
}

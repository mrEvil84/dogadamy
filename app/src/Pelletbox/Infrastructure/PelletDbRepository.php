<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\StoreRepository;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidDataStructure;
use App\src\Pelletbox\Exceptions\InvalidValueException;
use App\src\Utils\rabbitmq\AmqpConsumerProcessor;
use Illuminate\Support\Facades\DB;
use PhpAmqpLib\Message\AMQPMessage;

class PelletDbRepository implements StoreRepository, AmqpConsumerProcessor
{
    private DB $dbHandler;

    public function __construct(DB $dbHandler)
    {
        $this->dbHandler = $dbHandler;
    }

    /**
     * @throws InvalidValueException
     * @throws InvalidDataStructure
     * @throws \JsonException
     */
    public function process(AMQPMessage $message): void
    {
        $messageBody = json_decode($message->body, true, 512, JSON_THROW_ON_ERROR);
        $this->store(Unit::fromRawData($messageBody));
    }

    public function store(Unit $unit): void
    {
        $sql = '
                INSERT INTO
                     pellet_usage (bag_amount, producer_id)
                VALUES
                    (:bagAmount, :producerId)';

        $this->dbHandler->insert(
            $sql,
            [
                'bagAmount' => $unit->getUnitCount(),
                'producerId' => $unit->getProducer()->getId()
            ]
        );
    }
}

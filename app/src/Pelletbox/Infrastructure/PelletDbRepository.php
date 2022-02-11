<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\StoreRepository;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidDataStructure;
use App\src\Pelletbox\Exceptions\InvalidValueException;
use App\src\Utils\rabbitmq\AmqpConsumerProcessor;
use Illuminate\Database\ConnectionInterface;
use PhpAmqpLib\Message\AMQPMessage;

class PelletDbRepository implements StoreRepository, AmqpConsumerProcessor
{
    private ConnectionInterface $dbHandler;

    public function __construct(ConnectionInterface $dbHandler)
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
        $message->ack();
    }

    public function store(Unit $unit): void
    {
        $sql = '
                INSERT INTO
                     pelletbox.pellet_usage (bag_amount, producer_id, created_at)
                VALUES
                    (:bagAmount, :producerId, :createdAt)';

        $this->dbHandler->insert(
            $sql,
            [
                'bagAmount' => $unit->getUnitCount(),
                'producerId' => $unit->getProducer()->getId(),
                'createdAt' => date('Y-m-d H:i:s'),
            ]
        );
    }
}

<?php

namespace App\Console\Commands;

use App\src\Pelletbox\DomainModel\Consumer;
use Illuminate\Console\Command;

class ConsumePelletUnit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pellet:consume-unit {queue.name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume pellet logs from pellet broker by queue name \'pellet.consumed\'';

    private Consumer $consumer;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Consumer $consumer)
    {
        parent::__construct();
        $this->consumer = $consumer;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $queueName = $this->argument('queue.name') ?? 'pellet.consumed';

        echo 'Consuming: ... ' . PHP_EOL;
        $this->consumer->consumeMessage($queueName);
        echo 'Stop consuming ... ' . PHP_EOL;
        return 0;
    }
}

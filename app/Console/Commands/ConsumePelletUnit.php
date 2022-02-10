<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConsumePelletUnit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pellet:consume-unit {routing.key?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume pellet logs from pellet broker by routing key \'pellet.consumed\'';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routingKey = $this->argument('routing.key') ?? 'pellet.consumed';

        echo 'todo: consume' . PHP_EOL;
        return 0;
    }
}

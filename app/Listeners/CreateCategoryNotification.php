<?php

namespace App\Listeners;

use App\Events\CreateCategoryProcessed;
use Illuminate\Support\Facades\Log;

class CreateCategoryNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateCategoryProcessed  $event
     * @return void
     */
    public function handle(CreateCategoryProcessed $event)
    {
        Log::info('Category : ' . $event->getCategoryName() . ' created. ');
    }
}

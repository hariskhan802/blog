<?php

namespace App\Listeners;

use App\Events\MyE;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MyL
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
     * @param  \App\Events\MyE  $event
     * @return void
     */
    public function handle(MyE $event)
    {
        // dd($event->user);
        \App\Jobs\SendEmailJob::dispatch($event->user)->delay(now()->addSeconds(4));
    }
}

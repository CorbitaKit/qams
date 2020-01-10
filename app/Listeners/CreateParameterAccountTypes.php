<?php

namespace App\Listeners;

use App\Events\ParameterAccountTypes;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ParameterAccountType;
class CreateParameterAccountTypes
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
     * @param  ParameterAccountTypes  $event
     * @return void
     */
    public function handle(ParameterAccountTypes $event)
    {

        $event->parameter->account_types()->attach($event->account_types);
    }
}

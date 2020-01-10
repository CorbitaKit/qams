<?php

namespace App\Listeners;

use App\Events\EmployeeAccounts;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\AccountEmployee;
class CreateEmployeeAccounts
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
     * @param  EmployeeAccounts  $event
     * @return void
     */
    public function handle(EmployeeAccounts $event)
    {
        $event->employee->accounts()->attach($event->accounts);
    }
}

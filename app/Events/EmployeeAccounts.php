<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Employee;
use App\Account;

class EmployeeAccounts
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $employee;
    public $accounts;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($employee_id,$account_id)
    {

        $this->employee = Employee::where("id",$employee_id)->first();

  

        $this->accounts = Account::find($account_id);


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return [];
    }
}

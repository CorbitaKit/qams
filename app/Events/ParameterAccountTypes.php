<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Parameter;
use App\AccountType;
class ParameterAccountTypes
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $parameter_id;
    public $account_type_ids;
    public $account_type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($parameter_id,$account_type_ids)
    {
        $this->parameter = Parameter::where('id',$parameter_id)->first();
        $this->account_type_ids = explode(",",$account_type_ids);

        $this->account_types = AccountType::find($this->account_type_ids);
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

<?php

namespace App\Events;
use App\Models\AccountsTab;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg;
    public $accountID;

    public function __construct($accountID , $msg)
    {
        $this->msg = $msg;
        $this->accountID = $accountID;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->accountID);
    }

    public function broadcastAs() {
         return 'UserNotification';
    }

}

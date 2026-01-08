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

class ChatMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $senderName;
    public $receiverID;
    public $msg;

    public function __construct($receiverID , $msg , $senderName)
    {
        $this->senderName = $senderName;
        $this->receiverID = $receiverID;
        $this->msg = $msg;
    }

    public function broadcastOn()
    {
        // Send only to the recipient's channel
        return new PrivateChannel('user.' . $this->receiverID);
    }

    public function broadcastAs()
    {
        return 'ChatMessageSent';
    }
}

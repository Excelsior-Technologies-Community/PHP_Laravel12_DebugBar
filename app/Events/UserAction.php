<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $details;

    public function __construct($action, $details)
    {
        $this->action = $action;
        $this->details = $details;
    }
}
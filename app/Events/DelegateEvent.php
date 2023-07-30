<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class DelegateEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //when set property to public it will be visible at listener
    public $data;

    /**
     * Create a new event instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['new-notification'];
    }

    /**
     * @return string
     */
    public function broadcastAS()
    {
        /* this is name allies for namespace of this event which you will deal with it
            inside pusherNotification.js in line 10 in bind method */
        return 'my-event';
    }
}

<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id, $full_name, $email, $date, $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->user_id  = $data['user_id'];
        $this->full_name  = $data['full_name'];
        $this->email  = $data['email'];
        $this->date = date('Y-m-d', strtotime(Carbon::now()));
        $this->time = date('h: i A', strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['new-notification'];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}

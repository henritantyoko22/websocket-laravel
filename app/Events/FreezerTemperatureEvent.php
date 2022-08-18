<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FreezerTemperatureEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $freezer_temperature;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $timestamp = date('Y-m-d H:i:s');
        $roomIds = [
            "Room 1" => 1,
            "Room 2" => 2,
            "Room 3" => 3,
            "Room 4" => 4,
            "Room 5" => 5,
        ];
        $data = explode("~", $message);
        $this->freezer_temperature = [
            'room_id' => $roomIds[ $data[0] ],
            'room_name' => $data[0],
            'freezer_temperature' => $data[1],
            'timestamp' => $timestamp
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel( env('SOCKET_CHANNEL_NAME') );
    }

    public function broadcastAs()
    {
        return 'freezer-temperature';
    }

    
}

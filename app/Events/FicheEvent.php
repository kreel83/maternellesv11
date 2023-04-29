<?php

namespace App\Events;

use App\Models\Fiche;
use App\Models\Item;
use App\Models\Personnel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FicheEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Fiche $fiche)
    {


        if ($fiche->parent_type == 'personnels') {

            $item = Personnel::find($fiche->item_id);
            $fiche->item = $item;
            $fiche->user_id = $item->user_id;
        } else {

            $item = Item::find($fiche->item_id);

            $fiche->item = $item;
          
            $fiche->user_id = $item->user_id;
        }

        $fiche->user_id = $fiche->item->user_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

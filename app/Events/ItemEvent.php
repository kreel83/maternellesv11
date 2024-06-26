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

class ItemEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Item $item)
    {

        
        if(Item::$FIRE_EVENTS) {
            if ($item->image_nom) {
                $item->image_name = 'storage/items/'.$item->section_id.'/'.$item->image_nom;

            } else {
                $item->image_name = 'storage/items/none/'.$item->section_id.'-none.png';

            }   
            
              
        }

        



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

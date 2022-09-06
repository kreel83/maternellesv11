<?php

namespace App\Events;


use App\Models\Enfant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class EleveEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Enfant $enfant)
    {
    $mails = explode(';', $enfant->mail);
    $enfant->mail1 = isset($mails[0]) ? $mails[0] : null;
    $enfant->mail2 = isset($mails[1]) ? $mails[1] : null;
    if ($enfant->photo) {
        $enfant->photoEleve = Storage::url($enfant->photo);
    } else {
        $enfant->photoEleve = 'img/avatar/avatar'.$enfant->genre.'.jpg';
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

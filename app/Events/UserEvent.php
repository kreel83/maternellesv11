<?php

namespace App\Events;

use App\Models\Fiche;
use App\Models\Item;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {

        
        $first = $user->groupes;
        if (!$first) $user->type_groupe = null;
        if (substr($first,0,1) == '#') {
            $user->type_groupe = 'colors';  
            $user->groupe = explode('/', $user->groupes)      ;
        } else {
            $user->type_groupe = 'termes';
            $user->groupe = explode('/', $user->groupes)      ;
        }
    }
}

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


        $user->groupes = $user->groupes() ?? null;
        //$user->equipes = $user->equipes() ?? null ;
        $user->periodes = $user->periodes() ?? null;

    }
}

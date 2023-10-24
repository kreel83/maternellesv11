<?php

namespace App\Events;

use App\Models\Configuration;
use App\Models\Enfant;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EleveEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private function convertDate($d) {
        $d = str_replace([' years', ' year'], ' ans', $d);
        $d = str_replace([' months', ' month'], ' mois', $d);
        $d = str_replace([' weeks', ' week'], ' semaine(s)', $d);
        $d = str_replace([' days', ' day'], ' jour(s)', $d);
        $d = str_replace([' hours', ' hour'], ' heure(s)', $d);
        $d = str_replace([' ago'], '', $d);
        return $d;
    }
    
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
        $enfant->jour = Carbon::parse($enfant->ddn)->format('d');
        $enfant->age = $this->convertDate(Carbon::parse($enfant->ddn)->diffForHumans([ 'parts'=>2, 'short'=>false, ]));
        if ($enfant->photo) {
            $enfant->photoEleve = Storage::url($enfant->photo);
        } else {
            $enfant->photoEleve = 'img/avatar/avatar'.$enfant->genre.'.jpg';
        }

        // PDF pour Parent pas de Auth::
        $lesgroupes = Configuration::select('groupes')->where('user_id', $enfant->user_id)->first();
        $lesgroupes = json_decode($lesgroupes->groupes, true);
        //$lesgroupes = json_decode(Auth::user()->groupes, true);

        $enfant->groupeFormatted = $enfant->groupe ? $lesgroupes[$enfant->groupe] : null;
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

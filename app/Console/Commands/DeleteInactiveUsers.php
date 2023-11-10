<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DeleteInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Supprime les utilisateurs non actifs au bout de 30 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        Log::info('Cron: delete-inactive-users {id}', ['id' => Carbon::now()->subMinutes(30)->toDateTimeString()]);
        // Users et Admin self registration - le mot de passe est renseigné
        User::where([
            ['actif', '=', '0'],
            ['password', '<>', ''],
            ['created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString()]
        ])->delete();
        // Users crées par un Admin, délai plus long - le mot de passe est vide
        User::where([
            ['actif', '=', '0'],
            ['password', '=', ''],
            ['created_at', '<=', Carbon::now()->subDays(7)->toDateTimeString()]
        ])->delete();
        */
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;

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
        User::where('actif', 0)
        ->where('created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString())
        ->delete();
    }
}

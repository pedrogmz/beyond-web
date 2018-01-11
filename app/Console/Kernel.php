<?php

namespace App\Console;

use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            // Ranking
            $ranking = DB::table('player.player')
                ->join('player.player_index', 'player.id', '=', 'player_index.id')
                ->join('account.account', 'player.account_id', '=', 'account.id')
                ->select('player.name', 'player.level', 'player.exp', 'player.playtime', 'player_index.empire')
                ->where('account.status', '!=' , 'BLOCK')
                ->where('player.name', 'not like', '[%]%')
                ->orderBy('level', 'desc')
                ->orderBy('exp', 'desc')
                ->orderBy('playtime', 'desc')
                ->get();
            Storage::disk('local')->put('ranking.txt', $ranking);

            // Online players now
            $onlinePlayers = DB::table('player.player')
                ->whereRaw('DATE_SUB(NOW(), INTERVAL 100 MINUTE) < last_play')
                ->count();
            Storage::disk('local')->put('online_players.txt', $onlinePlayers);

            // Total accounts created
            $accountsCreated = DB::table('account.account')->count();
            Storage::disk('local')->put('total_accounts.txt', $accountsCreated);

            // Total characters created
            $charsCreated = DB::table('player.player')->count();
            Storage::disk('local')->put('total_characters.txt', $charsCreated);

            // Last character
            $lastChar = DB::table('player.player')
                ->select('name')
                ->orderBy('id', 'desc')
                ->first();
            Storage::disk('local')->put('last_char.txt', $lastChar->name);
        })->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

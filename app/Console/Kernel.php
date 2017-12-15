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
            $ranking = DB::table('player.player')
                ->join('player.player_index', 'player.id', '=', 'player_index.id')
                ->select('player.name', 'player.level', 'player.exp', 'player.playtime', 'player_index.empire')
                ->orderBy('level', 'desc')
                ->orderBy('exp', 'desc')
                ->orderBy('playtime', '')
                ->get();
            Storage::disk('local')->put('ranking.txt', $ranking);
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

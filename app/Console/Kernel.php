<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('prices:update')
                 ->timezone('Asia/Tokyo')
                 ->dailyAt('00:00')
                 ->withoutOverlapping()
                 ->onSuccess(function () {
                    Log::info('Prices update command successful.');
                    })
                 ->onFailure(function () {
                    Log::error('Prices update command failed!');
                 });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console;

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
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('nova-exports:clean')->daily()->at('03:00')->onOneServer();
        $schedule->command('backup:clean')->daily()->at('19:00')->environments(['development', 'staging'])->onOneServer();
        $schedule->command('backup:run')->daily()->at('20:00')->environments(['development', 'staging'])->onOneServer();

        $schedule->command('backup:clean')->daily()->at('01:00')->environments(['production'])->onOneServer();
        $schedule->command('backup:run')->daily()->at('02:00')->environments(['production'])->onOneServer();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}

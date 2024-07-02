<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('reports:delete-old')->everyMinute();

         // Tarefa temporária
         $schedule->call(function () {
            \Log::info('Scheduler test executed successfully.');
            // Ou crie um arquivo para verificação
            file_put_contents('/home/u620638499/domains/devrocha.online/public_html/scheduler-test.txt', 'Scheduler test executed at ' . now() . PHP_EOL, FILE_APPEND);
        })->everyMinute();
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

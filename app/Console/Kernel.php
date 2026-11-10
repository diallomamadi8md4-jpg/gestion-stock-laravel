<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Définir les tâches planifiées.
     */
    protected function schedule(Schedule $schedule): void
    {
        //rapport mensuel
        $schedule->command('rapport:generer')->monthly();


        $schedule->command('stocks:verifier')->hourly();

         //rapport quotidien à minuit
        // $schedule->command('rapport:generer')->dailyAt('00:00');
    }

    /**
     * Enregistrer les commandes artisan.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

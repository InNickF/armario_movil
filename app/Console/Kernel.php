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
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // $schedule->command('telescope:prune')->daily()
        // 	->onSuccess(function () {
        // 		\Log::info('Cron telescope:prune succeeded');
        // 	})
        // 	->onFailure(function () {
        // 		\Log::error('Cron telescope:prune failed');
        // 	});

        $schedule->command('subscriptions:renew')->dailyAt('9:00')
            ->onSuccess(function () {
                \Log::channel('daily_cronjobs')->info('Cron subscriptions:renew succeeded');
            })
            ->onFailure(function () {
                \Log::channel('daily_cronjobs')->error('Cron subscriptions:renew failed');
            })->appendOutputTo(storage_path('logs/cronjobs.log'));

        $schedule->command('products:expire')->dailyAt('13:00')
            ->onSuccess(function () {
                \Log::channel('daily_cronjobs')->info('Cron products:expire succeeded');
            })
            ->onFailure(function () {
                \Log::channel('daily_cronjobs')->error('Cron products:expire failed');
            })->appendOutputTo(storage_path('logs/cronjobs.log'));

        $schedule->command('order_items:ship')->everyThirtyMinutes()
            ->onSuccess(function () {
                \Log::channel('daily_cronjobs')->info('Cron order_items:ship succeeded');
            })
            ->onFailure(function () {
                \Log::channel('daily_cronjobs')->error('Cron order_items:ship failed');
            })->appendOutputTo(storage_path('logs/cronjobs.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
<?php

namespace App\Console;

use App\Models\activityLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
    protected $commands = [
        Commands\SendBirthdayNotifications::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('birthday:notifications')->dailyAt('00:00');

        // Hapus data log tiap bulan, tapi sisa kan 1 bulan sebelumnya
        $schedule->call(function () {
            activityLog::all()->each(function ($log) {
                $date_time = Carbon::createFromFormat('D, M d, Y g:i A', $log->date_time);
                if ($date_time < now()->subMonths(2)->startOfMonth()) {
                    $log->delete();
                }
            });
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

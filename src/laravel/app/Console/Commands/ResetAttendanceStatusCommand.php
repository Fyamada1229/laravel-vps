<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class ResetAttendanceStatusCommand extends Command
{

    protected $signature = 'reset:status';
    protected $description = 'Reset the attendance status at 00:00 daily';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('employee_attendances')
            ->where('next_reset_time', 1)
            ->update(['next_reset_time' => 0]);

        DB::table('departures')
            ->where('next_reset_time', 1)
            ->update(['next_reset_time' => 0]);

        $this->info('Attendance statuses have been reset.');
    }
}

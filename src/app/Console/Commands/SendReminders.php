<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Batch;
use App\Models\User;
use App\Jobs\SendReminderEmail;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to all users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        $jobs = $users->map(function ($user) {
            return new SendReminderEmail($user);
        });

        $batch = Batch::dispatch(...$jobs);
        
        $this->info('Reminder emails have been dispatched!');
    }
}

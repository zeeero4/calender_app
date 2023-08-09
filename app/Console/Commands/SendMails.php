<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Schedule;
use App\Models\User;
use Carbon\Carbon;

class SendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduled email sending';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereHas('events', function ($query) {
            // 日付で絞り込み
            $tomorrow = Carbon::now()->addDay(1);
            $query->whereDate('start', $tomorrow);
        })->with(['events' => function ($query) {
            // 日付で絞り込み
            $tomorrow = Carbon::now()->addDay(1);
            $query->whereDate('start', $tomorrow);
        }])->get();
        foreach ($users as $user) {
            Mail::to($user->email)
                ->send(new Schedule($user));
        }
    }
}
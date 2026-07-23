<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Models\ChangeHistory;
use App\Notifications\KitExpiryReminder;
use Carbon\Carbon;

#[Signature('app:send-kit-expiry-reminder')]
#[Description('Command description')]
class SendKitExpiryReminder extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::today()->addDays(5);

        $histories = ChangeHistory::with('user')
            ->whereDate('next_change_date', $date)
            ->get();

        foreach ($histories as $history) {
            $history->user->notify(
                new KitExpiryReminder($history)
            );
        }

        return self::SUCCESS;
    }
}

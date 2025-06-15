<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginLog;
use Carbon\Carbon;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        LoginLog::create([
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
            'login_at' => Carbon::now(),
        ]);
    }
}
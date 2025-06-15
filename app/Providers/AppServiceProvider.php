<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\LogSuccessfulLogin;
use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);
    }

    protected $listen = [
        // ... other listeners
        Login::class => [
            LogSuccessfulLogin::class,
        ],
    ];
    public function view(User $user, Transaction $transaction): bool
{
    return $user->id === $transaction->wallet->user_id;
}
public function update(User $user, Transaction $transaction): bool
{
    return $user->id === $transaction->wallet->user_id;
}
public function delete(User $user, Transaction $transaction): bool
{
    return $user->id === $transaction->wallet->user_id;
    
}
}

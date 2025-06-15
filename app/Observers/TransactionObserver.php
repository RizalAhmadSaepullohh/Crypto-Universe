<?php
namespace App\Observers;

use App\Models\Transaction;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        $this->logAction('created', $transaction);
    }

    public function updated(Transaction $transaction): void
    {
        $this->logAction('updated', $transaction);
    }

    public function deleted(Transaction $transaction): void
    {
        $this->logAction('deleted', $transaction);
    }

    private function logAction(string $action, Transaction $transaction): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => Transaction::class,
            'model_id' => $transaction->id,
            'details' => "Transaction #{$transaction->id} was {$action}."
        ]);
    }
}
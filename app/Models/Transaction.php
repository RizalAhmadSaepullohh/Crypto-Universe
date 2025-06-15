<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['wallet_id', 'cryptocurrency_id', 'type', 'amount', 'price_at_transaction', 'transaction_date'];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function cryptocurrency(): BelongsTo
    {
        return $this->belongsTo(Cryptocurrency::class);
    }
}
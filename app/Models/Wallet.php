<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'wallet_address', 'balance'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'balance' => 'decimal:2', // <-- TAMBAHAN: Pastikan balance adalah desimal 2 angka
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
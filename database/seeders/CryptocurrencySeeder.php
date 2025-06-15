<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Cryptocurrency;

class CryptocurrencySeeder extends Seeder
{
    public function run(): void
    {
        Cryptocurrency::create(['name' => 'Bitcoin', 'symbol' => 'BTC']);
        Cryptocurrency::create(['name' => 'Ethereum', 'symbol' => 'ETH']);
        Cryptocurrency::create(['name' => 'Ripple', 'symbol' => 'XRP']);
    }
}